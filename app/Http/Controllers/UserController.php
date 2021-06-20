<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
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
            'name' => 'required|string|unique:users,name',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'phone' => 'required|string|unique:users,phone|max:20',
            'position' => 'required|string',
            'branch' => 'required',
        ]);

        $password = Hash::make($request->password);
        $newStaff = User::create([
            'name' => $request->name, 
            'password'  => $password,
            'username'  => $request->username,
            'phone'  =>     $request->phone,
            'position'  => $request->position,
            'address'  => $request->address,
            'email'  => $request->email
            ]);

        $newStaff->assignRole($request->position);

            foreach($request->branch as $branch){
                $bran = Branch::where('name',$branch)->first();
                DB::table('branch_user')->insert(['user_id' => $newStaff->id, 'branch_id' => $bran->id, 'organization_id' => auth()->user()->organization->id]);
            }
            return response()->json(['success' => 'Staff Successfully Created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $branches = Auth::user()->organization->branches->pluck('name');
        $userBranchs = $user->branch->pluck('name');
        $roles = Role::all();
        return Inertia::render('Staff/Edit',['staff' => $user, 'roles' => $roles, 'branch' => $userBranchs, "branches" => $branches ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
     
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|string',
            'phone' => 'required|string|max:20',
            'position' => 'required|string',
            'branch' => 'required',
        ]);

        if($request->has('password')){
            $password = Hash::make($request->password);
            
            $user->update([
                'name' => $request->name, 
                'password'  => $password,
                'username'  => $request->username,
                'phone'  =>     $request->phone,
                'position'  => $request->position,
                'address'  => $request->address,
                'email'  => $request->email
                ]);
        }else{
            $user->update([
                'name' => $request->name, 
                'username'  => $request->username,
                'phone'  =>     $request->phone,
                'position'  => $request->position,
                'address'  => $request->address,
                'email'  => $request->email
            ]);
        }

        if(!$user->hasRole($request->position)){
            $user->syncRoles($request->position);
        } 
        $connected_branch = $user->branch;
        foreach($request->branch as $branch){
            if(!in_array($branch, $connected_branch->pluck('name')->toArray())){
                $bran = Branch::where('name',$branch)->first();
                DB::table('branch_user')->insert(['user_id' => $user->id, 'branch_id' => $bran->id, 'organization_id' => auth()->user()->organization->id]);
            }
        }
        

        return response()->json(['success' => 'Staff Successfully Updated'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->level != 'admin'){
            if($user->delete()){
                return response()->json(['success' => 'Staff Successfully Deleted'], 200);
            }
        }else{
            return response()->json(['errors' => [['You can only delete Staff of your organization']]], 428);
        }
    }
}
