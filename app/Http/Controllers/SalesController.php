<?php

namespace App\Http\Controllers;

use Keygen\Keygen;
use Inertia\Inertia;
use App\Models\Sales;
use App\Models\Staff;
use App\Models\Branch;
use App\Helpers\Helpers;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:Manage Product'])->except(['invoice_number', 'create', 'old_sales','store']);
    }


    public function invoice_number(){
        
        if(session('used_invoice') == false && (session('invoice') == null || session('invoice') == '')){
            session(['invoice' => Helpers::generateInvoiceNumber()]);
        }elseif(session('used_invoice') == true && (session('invoice') != null)){
            session(['invoice' => Helpers::generateInvoiceNumber()]);
            session(['used_invoice' => false ]);
            session()->save();
        }
        
        return response()->json(['invoice' => session('invoice'),'used_invoice' => session('used_invoice') ], 200);
    }

    public function index()
    {
        return Inertia::render('Sales/Index');
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        if(auth()->user()->level == 'admin'){
            $sales = Sales::where('branch_id', Helpers::active_branch()['id'])->with(['user', 'branch']);
        }else{
            $sales = auth()->user()->sales()->where('branch_id', Helpers::active_branch()['id'])->with(['user','branch']);
        }
        

        if($request->has('search') && $request->search != ''){
            $sales->where('data->name','LIKE', '%'.$request->search .'%')
            ->orWhere('invoice_number', 'LIKE', '%'.$request->search .'%')
            ->orWhere('shift', 'LIKE', '%'.$request->search .'%')
            ->orWhere('mode', 'LIKE', '%'.$request->search .'%')
            ->orWhereHas('branch', function($q) use($request) {
                $q->where('name', 'LIKE', '%'.$request->search .'%');
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
        $user = auth()->user();
        $products = product::where('branch_id', Helpers::active_branch()['id'])->get();
        $branchies = Staff::where('user_id', auth()->user()->id)->with('branch');
        $categories = $user->organization->categories;
        $data = collect();
        foreach($products as $product){
            $product["instore"] = Helpers::get_instore_value($product["id"]);
            $data->push($product);
        }

        if(!Session::has('shift') && session('shift') == ""){
            session(['shift' => Helpers::shift()]);
            session()->save();
        }
        
        // if(!Session::has('invoice') && session('invoice') == ""){
        //     session(['invoice' => Helpers::generateInvoiceNumber()]);
        //     session()->save();
        // }

        
        return Inertia::render('Sales/Sale', ['products' => $data, 'shift' => session('shift') , 'branchies' => $branchies->get(), 'categories' => $categories]);
    }




    public function old_sales()
    {
        $user = auth()->user();
        $products = product::where('branch_id', Helpers::active_branch()['id'])->get();
        $data = collect();
        foreach($products as $product){
            $product["instore"] = Helpers::get_instore_value($product["id"]);
            $data->push($product);
        }

        if(!Session::has('shift') && session('shift') == ""){
            session(['shift' => Helpers::shift()]);
            session()->save();
        }
        
        return Inertia::render('Sales/Old', ['products' => $data, 'shift' => session('shift') ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'invoice' => 'required|numeric',
            'items' => 'required|array',
            'mode' => 'required|string',
            'paid' => 'required|numeric'
        ]); 

        foreach($request->items as $item){
            if($request->has('date')){
                Sales::create([
                    'user_id' => Auth::user()->id,
                    'invoice_number' => $request->invoice,
                    'data' => json_encode($item['item']),
                    'shift' => Helpers::get_shift(),
                    'qty' => $item['qty'],
                    'total' => $item['total'],
                    'invoice_total' => collect($request->items)->sum('total') - $request->discount,
                    'invoice_discount' => $request->discount,
                    'invoice_paid' => $request->paid,
                    'branch_id' => Helpers::active_branch()["id"],
                    'mode' => $request->mode,
                    'created_at' =>  $request->date
                ]);
            }else{
                Sales::create([
                    'user_id' => Auth::user()->id,
                    'invoice_number' => $request->invoice,
                    'data' => json_encode($item['item']),
                    'shift' => Helpers::get_shift(),
                    'qty' => $item['qty'],
                    'total' => $item['total'],
                    'invoice_total' => collect($request->items)->sum('total') - $request->discount,
                    'invoice_discount' => $request->discount,
                    'invoice_paid' => $request->paid,
                    'branch_id' => Helpers::active_branch()["id"],
                    'mode' => $request->mode
                ]);
            }
            
        }
        session(['used_invoice' => true ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit($sales)
    {
        $transaction = Sales::where('invoice_number', $sales)->get();
        
        $user = auth()->user();
        $products = product::where('branch_id', Helpers::active_branch()['id'])->get();
        $data = collect();
        foreach($products as $product){
            $product["instore"] = Helpers::get_instore_value($product["id"]);
            $data->push($product);
        }

        $invoice_number = $transaction[0]->invoice_number;
        $discount = $transaction[0]->invoice_discount;
        $paid = $transaction[0]->invoice_paid;
        $mode = $transaction[0]->mode;
        $items = collect();


        foreach($transaction as $trans){
            $formated = [
                'qty' => $trans->qty,
                'shift' => $trans->shift,
                'total' => $trans->total,
                'item' => json_decode($trans->data),
                'ref' => $trans->id
            ];
            $items = $items->push(collect($formated));
        }

        $formated = [
            'invoice'=> $invoice_number,
            'discount' => $discount,
            'mode' => $mode,
            'items' => $items,
            'paid' => $paid
        ];
        
        return Inertia::render('Sales/Edit', ['products' => $data, "invoice_number" => $invoice_number ,'shift' => $transaction[0]->shift, 'formated' => $formated ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sales)
    {
        $this->validate($request, [
            'invoice' => 'required|numeric',
            'items' => 'required|array',
            'mode' => 'required|string',
            'paid' => 'required|numeric'
        ]); 
        $sale = Sales::where('invoice_number',$sales)->first();
        (!empty($sale))? $sold=$sale->user_id : $sold = Auth::user()->id;
        $sum = collect($request->items)->sum('total');
        foreach($request->items as $item){
            if(isset($item["ref"])){
                Sales::where('id', $item["ref"])
                ->update([
                    'qty' => $item["qty"],
                    'shift' => $item["shift"],
                    'total' => $item["total"],
                    'data' => json_encode($item["item"]),
                    'mode' => $request->mode,
                    'invoice_paid' => $request->paid,
                    'invoice_discount' => $request->discount,
                    'invoice_total' => $sum - $request->discount,
                ]);
            }else{

                Sales::create([
                    'user_id' => $sold,
                    'invoice_number' => $request->invoice,
                    'data' => json_encode($item['item']),
                    'shift' => $item["shift"],
                    'qty' => $item['qty'],
                    'total' => $item['total'],
                    'invoice_total' => $sum -$request->discount,
                    'invoice_discount' => $request->discount,
                    'invoice_paid' => $request->paid,
                    'branch_id' => Helpers::active_branch()["id"],
                    'mode' => $request->mode
                ]);

            }
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy($sales)
    {
        $sale = Sales::where('id',$sales);
        $sale->delete();
    }

    public function delete_sale( $sales )
    {
        $sale = Sales::where('id', $sales);
        $sale_data = $sale->first();
        $invoice_number = $sale_data->invoice_number;
        $sale->delete();
        $sum = (Sales::where('invoice_number', $invoice_number)->sum('total') - $sale_data->invoice_discount );
        $update =  Sales::where('invoice_number', $invoice_number)->update(['invoice_total' => $sum]);

    }
}
