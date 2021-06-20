<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Staff;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Auth::user()->organization->branches->pluck('name');
        $roles = Role::all();
        return Inertia::render("Staff/Index", ['branches' => $branches, 'roles' => $roles ]);
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        
        $staffs = auth()->user()->organization->staffs()->with(['user', 'branch']);
        if($request->has('search') && $request->search != ''){

            $staffs->whereHas('user', function($q) use($request) {
                $q->where('name', 'LIKE', '%'.$request->search .'%')
                    ->orWhere('position','LIKE', '%'.$request->search .'%');
             })->orWhereHas('branch', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%')
                 ->orWhere('shortname','LIKE', '%'.$request->search .'%');
        });
        }
        $staffs = $staffs->paginate($pagination);
    	return response()->json($staffs);
    }

    public function changeShift(Request $request){
            session(['shift' => $request->shift ]);
            session()->save();
    }

    public function user_branches(User $user){
        $branches = $user->branch->pluck('name');
        return response()->json($branches);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
