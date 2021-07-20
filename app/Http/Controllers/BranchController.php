<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        
        $branches = auth()->user()->organization->branches();
        if($request->has('search') && $request->search != ''){

            $branches->where('name', 'LIKE', '%'.$request->search .'%')
                    ->orWhere('shortname','LIKE', '%'.$request->search .'%')
                    ->orWhere('phone','LIKE', '%'.$request->search .'%')
                    ->orWhere('email','LIKE', '%'.$request->search .'%');
        }
        $branches = $branches->paginate($pagination);
    	return response()->json($branches);
    }

    public function changeBranch(Request $request){
        $this->validate($request, [
            'id' => 'required|integer|exists:branches,id',
            'name' => 'required|string|exists:branches,name',
            'shortname' => 'required|string|exists:branches,shortname',
        ]);

            session(['active_branch' => $request->all() ]);
            session()->save();

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
        $data['organization_id'] = optional(auth()->user()->organization)->id;
        if(empty($data['organization_id'])){
            return response()->json(['errors' => [['Create Organization first']]], 428);
        }
            // dd($data);
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

    public function delete( Request $request)
    {
        $bran = Branch::where('name',$request->branch)->first();
        Staff::where('branch_id', $bran->id)->where('user_id', $request->user)->where('organization_id', auth()->user()->organization->id)->delete();
        return response()->json(['success' => 'User successfully removed from a branch'], 200);
    }
}
