<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Category/Index');
    }

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        if($request->has('search') && $request->search != ''){
            $data = category::where('name','LIKE', '%'.$request->search .'%')->orWhere('status','LIKE', '%'.$request->search .'%')->paginate($pagination);
        }else{

            $data = category::paginate($pagination);
        }

    	return response()->json($data);
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
            'name' => 'required|string|unique:categories,name'
        ]);
        $data = [
            'name' => $request->name,
            'organization_id' => auth()->user()->organization->id
        ];
        if(category::create($data)){
            return response()->json(['success' => 'Category Successfully created'], 200);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:categories,name'
        ]);

        if($category->update($request->only(['name']))){
            return response()->json(['success' => 'Category Updated Successfully'], 200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        if($category->delete()){
            return response()->json(['success' => 'Category Successfully deleted'], 200);
        }
    }
}
