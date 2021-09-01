<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Remit;
use App\Models\Sales;
use App\Models\Staff;
use App\Models\Branch;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class RemitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:Remit']);
    }

    public function index()
    {
        $staffs = Staff::where('branch_id', Helpers::active_branch()['id'])->with(['user'])->get();
        return Inertia::render('Remit/Index', ['staffs' => $staffs]);
    }

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        $remit = Remit::where('branch_id', Helpers::active_branch()['id'])->with(['user']);

        if($request->has('search') && $request->search != ''){
            $remit->whereDate('created_at','LIKE', '%'.$request->search .'%')
            ->orWhere('balance', 'LIKE', '%'.$request->search .'%')
            ->orWhere('remitted', 'LIKE', '%'.$request->search .'%')
            ->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }
        
    	$remit = $remit->orderBy('created_at', 'desc')->paginate($pagination);
    	return response()->json($remit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function stat(Request $request)
    {
        $this->validate($request, [
            'staff' => 'required|integer',
            'date' => 'required|date'
        ]);

        $sales['cash'] = number_format(Sales::where('user_id', $request->staff)->whereDate('created_at', $request->date)->where('mode' , 'cash')->sum('total'));
        $sales['transfer'] = number_format(Sales::where('user_id', $request->staff)->whereDate('created_at', $request->date)->where('mode' , 'transfer')->sum('total'));
        $sales['pos'] = number_format(Sales::where('user_id', $request->staff)->whereDate('created_at', $request->date)->where('mode' , 'pos')->sum('total'));
        $sales['total'] = Sales::where('user_id', $request->staff)->whereDate('created_at', $request->date)->sum('total');

        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'staff' => 'required|integer',
            'total' => 'required',
            'pos' => 'required',
            'cash' => 'required',
            'transfer' => 'required',
            'remitted' => 'required',
            'date' => 'required|date',
        ]);

        $count = Remit::where('user_id', $request->staff)->whereDate('date', $request->date)->get();

        if(count($count) > 0){
            return response()->json(['errors' => [['Staff sales already remitted for that date']]], 428);
        }

        Remit::create([
            'user_id' => $request->staff,
            'branch_id' => Helpers::active_branch()['id'],
            'POS' => $request->pos,
            'Cash' => $request->cash,
            'Transfer' => $request->transfer,
            'total' => $request->total,
            'Remitted' => $request->remitted,
            'Balance' => ($request->remitted - $request->total),
            'date' => $request->date,
            'approve_by' => auth()->user()->id,
        ]);

       if(count($count) > 0){
            return response()->json(['success' => 'Staff Sales remitted successfully'], 200);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remit  $remit
     * @return \Illuminate\Http\Response
     */
    public function show(Remit $remit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remit  $remit
     * @return \Illuminate\Http\Response
     */
    public function edit(Remit $remit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remit  $remit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remit $remit)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'Remitted' => 'required',
        ]);

        $remit->update([
            'Balance' => ($request->Remitted - $request->Total),
            'Remitted' => $request->Remitted
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remit  $remit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remit $remit)
    {
        $remit->delete();
    }
}
