<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    public function getBranch(){
        $branches = auth()->user()->organization->branches;
        return response()->json(['branches' => $branches ], 200 );
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'name' => 'required|string|unique:branches,name',
            'shortname' => 'required|string|max:8|unique:branches,shortname',
            'email' => 'email|required',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $data = $request->toArray();
        $data['organization_id'] = auth()->user()->organization->id;
        if(empty($data['organization_id'])){
            return response()->json(['error' => 'Create Organization first'], 428);
        }
            
        if(Branch::create($data)){
            return response()->json(['success' => 'Branch Created Successfully'], 200);
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'shortname' => 'required|string|max:8',
            'email' => 'email|required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'id' => 'required',
        ]);

        if(Branch::find($request->id)->update($request->all())){
            return response()->json(['success' => 'Branch Updated Successfully'], 200);
        };
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {

        if($branch->delete()){
            return response()->json(['success' => 'Branch Successfully Deleted'], 200);
        }

    }
}
