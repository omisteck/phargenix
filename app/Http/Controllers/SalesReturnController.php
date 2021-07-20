<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sales;
use App\Helpers\Helpers;
use App\Models\Sales_Return;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Sales/Return');
    }

    public function search(Request $request){

        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        if(auth()->user()->level == 'admin'){
            $sales = Sales_Return::where('branch_id', Helpers::active_branch()['id'])->with(['user','branch']);
        }else{
            $sales = auth()->user()->sales_returns()->with(['user','branch']);
        }

        if($request->has('search') && $request->search != ''){
            $sales->where('data->name','LIKE', '%'.$request->search .'%')
            ->orWhere('invoice_number', 'LIKE', '%'.$request->search .'%')
            ->orWhereHas('branch', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }
        
    	$sales = $sales->orderBy('created_at', 'desc')->paginate($pagination);
    	return response()->json($sales);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'invoice_number' => 'required|exists:sales,invoice_number',
            'id' => 'required|exists:sales,id',
        ]);

        Sales::where('id', $request->id)->delete();
        $sum = Sales::where('invoice_number', $request->invoice_number)->sum('total');
        Sales::where('invoice_number', $request->invoice_number)->update(['invoice_total' => $sum]);
        Sales_Return::create([
            'invoice_number' => $request->invoice_number,
            'data' => $request->data,
            'qty' => $request->qty,
            'user_id' => Auth::user()->id,
            'sale_id' => $request->id,
            'branch_id' => $request->branch_id,
        ]);

        return response()->json(['success' => 'You have return'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales_Return  $sales_Return
     * @return \Illuminate\Http\Response
     */
    public function show($sales)
    {
        $details = Sales::where('invoice_number',$sales)->get();

        if($details->count() > 0){
            return response()->json($details, 200);
        }else{
            return response()->json(['errors' => [['No invoice with the invoice number #'.$sales]]], 428);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales_Return  $sales_Return
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales_Return $sales_Return)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales_Return  $sales_Return
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales_Return $sales_Return)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales_Return  $sales_Return
     * @return \Illuminate\Http\Response
     */
    public function destroy($Sales_Return)
    {
        $sale = Sales_Return::where('id', $Sales_Return )->first();
        $sales_id = $sale->sale_id;
        Sales::where('id', $sales_id)->restore();
        $sum = Sales::where('invoice_number', $sale->invoice_number)->sum('total');
        Sales::where('invoice_number', $sale->invoice_number)->update(['invoice_total' => $sum]);
        $sale->delete();
    }
}
