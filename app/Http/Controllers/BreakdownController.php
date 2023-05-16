<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sales;
use App\Models\Staff;
use App\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BreakdownController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Remit']);
    }
    
    public function index(){
        // $staffs = Staff::where('branch_id', Helpers::active_branch()['id'])->with(['user'])->get();
        $staffs = auth()->user()->organization->staffs()->with(['user','branch'])->get();
        return Inertia::render('Sales/Breakdown', [ 'staffs' => $staffs ]);
    }

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        $sales = Sales::where('user_id', $request->staff)->with(['branch','user']);
        // dd($sales->get());
        if($request->has('date') && $request->date != '' && $request->date != null){
            $sales->whereDate('created_at', $request->date);
        }
        // dd($request->date);
        if($request->has('shift') && $request->shift != ''&& $request->shift != null ){
            $sales->where('shift', $request->shift);
        }
        // dd($sales->get());
        $sales = $sales->orderBy('created_at','desc')->get()->groupBy(function($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
       });
       
       $static = Sales::where('user_id', $request->staff)
            ->when($request->has('date'), function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })
            ->when($request->has('shift'), function ($query) use ($request) {
                $query->where('shift', $request->shift);
            })
            ->groupBy(['invoice_number', 'invoice_discount'])->get(['invoice_discount','invoice_number'])->sum('invoice_discount');

       foreach($sales as $key => $sale){
        $sale['count'] = $sale->count();
        $sale['date'] = $key;
        $sale['grandTotal'] = number_format($sale->sum('total') - $static, 2  );

    }

       $page = LengthAwarePaginator::resolveCurrentPage();
        $currentPage = $page - 1;
        $currentPage < 0 ? $currentPage = 0 : '';
        $collection = new Collection($sales);
        $perPage = $pagination;
        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $url = $request->path();
        $path = "";
        $path !="" ? $path : $url;
        $paginator->setPath($path);
        $array = $paginator->toArray();


    	return response()->json($array);
    }
}
