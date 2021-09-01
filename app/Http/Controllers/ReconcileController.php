<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Branch;
use App\Helpers\Helpers;
use App\Models\product;
use App\Models\Reconcile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReconcileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Stock Reconciliation']);
    }

    public function index(){
        
        return Inertia::render('product/Reconcile');
    }

    public function search(Request $request){

        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        if(auth()->user()->level == 'admin'){
            $reconcile = Reconcile::with(['user','branch']);    
        }else{
            $reconcile = auth()->user()->reconciles()->with(['user','branch']);
        }

        if($request->has('search') && $request->search != ''){
            $reconcile->where('data->name','LIKE', '%'.$request->search .'%')
            ->orWhere('remark', 'LIKE', '%'.$request->search .'%')
            ->orWhereHas('branch', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }
        
    	$reconcile = $reconcile->orderBy('created_at', 'desc')->paginate($pagination);
    	return response()->json($reconcile);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'item' => 'required|array',
            'qty' => 'required|int',
            'type' => 'required|string',
        ]); 

        Reconcile::create([
            "data" => json_encode($request->item),
            "qty" => $request->qty,
            "type" => $request->type,
            "remark" => $request->remark,
            "branch_id" => Helpers::active_branch()['id'],
            "user_id" => auth()->user()->id
        ]);
        return response()->json(['success' => 'Product reconcile successfully'], 200);
    }
    

    public function update(Reconcile $reconcile, Request $request ){
        $this->validate($request, [
            'details' => 'required',
            'data' => 'required',
        ]);
        
        $reconcile->update([
            'qty' => $request->details['qty'],
            'type' => $request->details['type'],
            'remark' => $request->details['remark'],
            'data' => json_encode($request->data)]);
        return response()->json(['success' => 'Product reconcile successfully updated'], 200);
    }

    public function destroy( Reconcile $reconcile ){
        $reconcile->delete();
    }
}
