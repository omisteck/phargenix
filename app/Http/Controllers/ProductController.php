<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sales;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\product;
use App\Helpers\Helpers;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Models\Reconcile;
use App\Models\Sales_Return;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = auth()->user()->organization;
        $branches = $organization->branches;
        $categories = $organization->categories;
        return Inertia::render('product/Index', ['branchies' => $branches, 'categories' => $categories]);
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        $products = auth()->user()->organization->products()->with(['branch','category']);
        if($request->has('search') && $request->search != ''){
            $products->where('name', 'LIKE', '%'.$request->search .'%')
                ->orWhereHas('branch', function($q) use($request) {
                $q->where('name', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('category', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }
        
    	$products = $products->paginate($pagination);
        $products = $products->toArray();
        $data = collect();
        foreach($products["data"] as $single_record){
            $single_record["instore"] = Helpers::get_instore_value($single_record["id"]);
            $data->push($single_record);
        }
        $products['data'] = $data;

    	return response()->json($products);
    }


    public function ledger_search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        $data = collect(); $sales_formated = collect(); $transfers_formated = collect(); $sales_returns_formated = collect();$reconciles_formated = collect(); $purchases_formated = collect();
        $sales = $transfer = $sales_returns = $reconciles = $purchases ='';
        // dd($request->all());
        if(($request->from_date != null || $request->to_date != null) &&
            !($request->from_date != null && $request->to_date != null)
        ){

            $request->from_date ? $date = $request->from_date : $date = $request->to_date;
            $sales = Sales::where('data->id', $request->search)->whereDate('created_at', $date)->with(['user']);
            $transfers = Transfer::whereDate('created_at', $date)->where('from_product->id', $request->search)->orWhere('to_product->id', $request->search)->with(['user']);
            $sales_returns = Sales_Return::where('data->id', $request->search)->whereDate('created_at', $date)->with(['user']);
            $reconciles = Reconcile::where('data->id', $request->search)->whereDate('created_at', $date)->with(['user']);
            $purchases = Purchase::where('product->id', $request->search)->whereDate('created_at', $date)->with(['user']);
        }elseif(($request->has('from_date') && $request->from_date !='' ) && ($request->has('to_date') && $request->to_date !='')){
            $from = $request->from_date;
            $to = $request->to_date;
            $sales = Sales::where('data->id', $request->search)->whereBetween('created_at', [$from, $to])->with(['user']);
            $transfers = Transfer::whereBetween('created_at', [$from, $to])->where('from_product->id', $request->search)->orWhere('to_product->id', $request->search)->with(['user']);
            $sales_returns = Sales_Return::where('data->id', $request->search)->whereBetween('created_at', [$from, $to])->with(['user']);
            $reconciles = Reconcile::where('data->id', $request->search)->whereBetween('created_at', [$from, $to])->with(['user']);
            $purchases = Purchase::where('product->id', $request->search)->whereBetween('created_at', [$from, $to])->with(['user']);
        }else{
            $sales = Sales::where('data->id', $request->search)->with(['user']);
            $transfers = Transfer::where('from_product->id', $request->search)->orWhere('to_product->id', $request->search)->with(['user']);
            $sales_returns = Sales_Return::where('data->id', $request->search)->with(['user']);
            $reconciles = Reconcile::where('data->id', $request->search)->with(['user']);
            $purchases = Purchase::where('product->id', $request->search)->with(['user', 'supplier']);
        }

        $sales= $sales->get();

        foreach($sales as $sale){
            $sale["desc"] = 'Product sales';
            $sale["type"] = 'sales';
            $sales_formated->push($sale);
        }
        // dd($sales_formated);
        $transfers = $transfers->get();

        foreach($transfers as $transfer){
            $transfer["desc"] = 'Product Transfer';
            $transfer["type"] = 'transfer';
            $transfers_formated->push($transfer);
        }

        $sales_returns = $sales_returns->get();

        foreach($sales_returns as $sales_return){
            $sales_return["desc"] = 'Sales returned';
            $sales_return["type"] = 'sales returned';
            $sales_returns_formated->push($sales_return);
        }
        $reconciles = $reconciles->get();

        foreach($reconciles as $reconcile){
            $reconcile["desc"] = 'Product Reconcile';
            $reconcile["types"] = 'reconcile';
            $reconciles_formated->push($reconcile);
        }
        // dd($reconciles_formated);
        $purchases = $purchases->get();

        foreach($purchases as $purchase){
            $purchase["desc"] = 'Product Purchases';
            $purchase["type"] = 'purchases';
            $purchases_formated->push($purchase);
        }
        $data = $data->merge($sales_formated);
        $data = $data->merge($transfers_formated);
        $data = $data->merge($sales_returns_formated);
        $data = $data->merge($reconciles_formated);
        $data = $data->merge($purchases_formated);
        $data =  $data->sortBy(function($col)
        {
            return strtotime($col['created_at']);
        })->values()->all();

        $page = LengthAwarePaginator::resolveCurrentPage();
        $currentPage = $page - 1;
        $currentPage < 0 ? $currentPage = 0 : '';
        $collection = new Collection($data);
        $perPage = $pagination;
        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $url = $request->path();
        $path = "";
        $path !="" ? $path : $url;
        $paginator->setPath($path);
        $array = $paginator->toArray();
        $array['instore'] = Helpers::get_instore_value($request->search);

    	return response()->json($array);
    }


    public function branchProduct($branch){
        $products = product::where('branch_id',$branch)->get();
        return response()->json(['products' => $products]);
    }


    public function ledger(){
        $user = auth()->user();
        $branchies = Staff::where('user_id', $user->id)->with('branch');
        $products = $user->organization->products;
        return Inertia::render('Ledger/Index', ['branchies' => $branchies, 'products' => $products]);
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
            'name' => 'required|string',
            'selling_price' => 'required|int|gt:-1',
            'cost_price' => 'required|int|gt:-1',
            'branch_id' => 'required|int|gt:0',
            'category_id' => 'required|int|gt:0',
        ]);

        product::create([
            'name' => $request->name,
            'selling_price' => $request->selling_price,
            'cost_price' => $request->cost_price,
            'branch_id' => $request->branch_id,
            'organization_id' => auth()->user()->organization->id,
            'category_id' => $request->category_id
        ]);
        return response()->json(['success' => 'Product Successfully created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        $product->instore = Helpers::get_instore_value($product->id);
        return response()->json([$product],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'selling_price' => 'required|int|gt:-1',
            'cost_price' => 'required|int|gt:-1',
            'branch_id' => 'required|int|gt:0',
            'category_id' => 'required|int|gt:0',
        ]);

        if($product->update($request->only(['name','selling_price','cost_price','branch_id','category_id']))){
            return response()->json(['success' => 'Product Successfully Updated'], 200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
    }
}
