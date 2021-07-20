<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Branch;
use Inertia\Inertia;
use App\Models\product;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:Transfer']);
    }
    
    public function index()
    {
        $branchies = Branch::where('id','!=', Helpers::active_branch()['id'])->where('organization_id', auth()->user()->organization->id )->get();
        $all_branchies = Branch::where('organization_id', auth()->user()->organization->id )->get();
        return Inertia::render("Transfer/Index", ['branchies' => $branchies, 'all_branchies' => $all_branchies ] );
    }

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        
        if(auth()->user()->level == 'admin'){
            $transfers = Transfer::with(['to_branches', 'from_branches', 'user']);
        }else{
            $transfers = auth()->user()->transfers()->with(['to_branches', 'from_branches', 'user']);
        }

        ($request->has('to_branch') && $request->to_branch != '')? $transfers = $transfers->where('branch_to', $request->to_branch) : '';
        ($request->has('date') && $request->date != '')? $transfers = $transfers->whereDate('created_at', $request->date) : '';
        //  dd($request->all());
        if($request->has('search') && $request->search != ''){
            $transfers->where('from_product->name', 'LIKE', '%'.$request->search .'%')
            ->orWhere('to_product->name', 'LIKE', '%'.$request->search .'%')
                ->orWhereHas('to_branches', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('from_branches', function( $query ) use ( $request ){
                 $query->where('shortname', 'LIKE', '%'.$request->search .'%');
            })->orWhereHas('user', function( $query ) use ( $request ){
                $query->where('name', 'LIKE', '%'.$request->search .'%');
           });

        }
        
    	$transfers = $transfers->paginate($pagination);
    	return response()->json($transfers);
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
                'to' => 'required|array',
                'from' =>  'required|array',
                'date' => 'required|string',
                'branch' => 'required|integer|exists:branches,id',
                'qty' => 'required|integer'
            ]);

            Transfer::create([
                "user_id" => auth()->user()->id,
                "branch_from" => Helpers::active_branch()["id"],
                "from_product" => json_encode($request->from),
                "branch_to" => $request->branch,
                "to_product" => json_encode($request->to),
                'qty' => $request->qty,
                'created_at' => $request->date
            ]);

            return response()->json(['success' => 'You have successfully transfer '.$request->from['name'] ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $transfer->delete();
    }
}
