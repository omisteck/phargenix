<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Expenses/Index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|min:1',
            'description' => 'nullable|string',
            'date' => 'required|date'
        ]);

        Expenses::create([
            'amount' => $request->amount,
            'description' => $request->description,
            'created_at' => $request->date,
            'user_id' => auth()->user()->id,
            'branch_id' => Helpers::active_branch()['id'],
        ]);

        return response()->json(['success' => 'Expenses added successfully']);
    }


    public function search(Request $request){

        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        if(auth()->user()->level == 'admin'){
            $expenses = Expenses::with(['user','branch']);    
        }else{
            $expenses = auth()->user()->expenses()->with(['user','branch']);
        }

        if($request->has('search') && $request->search != ''){
            $expenses->where('description','LIKE', '%'.$request->search .'%')
            ->orWhere('amount', 'LIKE', '%'.$request->search .'%')
            ->orWhereHas('branch', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }
        
    	$expenses = $expenses->paginate($pagination);
    	return response()->json($expenses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expenses)
    {
        $this->validate($request, [
            'amount' => 'required|min:1',
            'description' => 'nullable|string',
            'date' => 'required|date'
        ]);
        
        Expenses::where('id', $expenses)->update([
            'amount' => $request->amount,
            'description' => $request->description,
            'created_at' => $request->date,
        ]);

        return response()->json(['success' => 'Expenses Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($expenses)
    {
        Expenses::where('id', $expenses)->delete();
    }
}
