<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\product;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        //
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
