<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
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
        $branches = Auth::user()->organization->branches;
        $roles = Role::all();

        return Inertia::render('Staff/Create', ['branches' => $branches, 'roles' => $roles ]);
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
                DB::table('branch_user')->create([]);
            }
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
        //
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
        //
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
