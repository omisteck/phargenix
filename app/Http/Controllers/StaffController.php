<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Sales;
use App\Models\Staff;
use App\Models\Branch;
use App\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

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
        if(auth()->user()->level == 'admin'){
            $branches = Auth::user()->organization->branches->pluck('name');
            $roles = Role::all();
        }else{
            $branches = Auth::user()->branch->pluck('name');
            $roles = Role::where('name', '!=', 'manager')->get();
        }
        $permissions = Permission::all();
        return Inertia::render("Staff/Index", ['branches' => $branches, 'roles' => $roles, 'permissions' => $permissions  ]);
    }

    public function loginAs(Request $request)
    {   
        if(!$request->has('user_type')){
            session(['admin' => auth()->user()->id ]);
            session()->save();
        }else{
            session()->forget('admin');
        }

        Auth::loginUsingId($request->user_id);
    }

    public function permission(Request $request)
    {   
        $this->validate($request, [
            'user' => 'required|array',
            'access' => 'array'
        ]);
        
        DB::table('model_has_permissions')->where('model_id', $request->user['id'])->delete();
        User::find($request->user['id'])->syncPermissions($request->access);
        return response()->json(['success' => 'Permission updated successfully'],200);
    }

    public function current_permission(Request $request){
        $staff = $request->id;

        $roles = User::find($staff)->getAllPermissions();
        return response()->json($roles);
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        if(auth()->user()->level == 'admin'){
            $staffs = auth()->user()->organization->staffs()->with(['user', 'branch']);
        }else{
            $staffs = Staff::where( 'branch_id', Helpers::active_branch()['id'])->with(['user', 'branch']);
        }
        if($request->has('search') && $request->search != ''){

            $staffs->whereHas('user', function($q) use($request) {
                $q->where('name', 'LIKE', '%'.$request->search .'%')
                    ->orWhere('position','LIKE', '%'.$request->search .'%');
             })->orWhereHas('branch', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%')
                 ->orWhere('shortname','LIKE', '%'.$request->search .'%');
        });
        }
        $staffs = $staffs->orderBy('created_at', 'desc')->paginate($pagination);
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
    public function sales_record(Request $request)
    {
        $this->validate($request, [
            'staff' => 'required',
            'date' => 'required',
        ]);

            $sales = Sales::where('user_id', $request->staff)->with(['user']);
            // dd($sales->get());
            if($request->has('date') && $request->date != '' && $request->date != null){
                $date = Carbon::parse($request->date);
                $sales->whereDate('created_at', $date);
            }
            // dd($request->date);
            if($request->has('shift') && $request->shift != ''&& $request->shift != null ){
                $sales->where('shift', $request->shift);
            }
            // dd($sales->get());

            $sales = $sales->orderBy('created_at','desc')->orderBy('shift','desc');

            $static = Sales::where('user_id', $request->staff)
            ->when($request->has('date'), function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })
            ->when($request->has('shift'), function ($query) use ($request) {
                $query->where('shift', $request->shift);
            })
            ->groupBy(['invoice_number', 'invoice_discount'])->get(['invoice_discount','invoice_number'])->sum('invoice_discount');

            return Inertia::render('Sales/List', ['sales' => $sales->get(), 'total' => $sales->sum('total'), 'sum' => $sales->sum('total') - $static , 'discount'=> $static ]);
    }

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
