<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class OrganizationController extends Controller
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
        return response()->json(['business' => Auth::user()->organization], 200); 
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
            'name' => 'required|string',
        ]);

        if($request->newLogo != ''){
            if (!str_contains($request->newLogo[0], '/images/logos/')){
                $old_logo = optional(Auth::user()->organization)->logo;

                if($old_logo != ''){
                    File::delete(public_path($old_logo));
                };
                $pdate = $request->name.strtotime(date('y-m-d h:i:s')).'.png';
                $logo_path = '/images/profile/'.$pdate;
                Image::make($request->newLogo[0])->save(public_path('images/profile/').$pdate);
           }
        }
        if(!isset($logo_path)){
            $data = [
                'name' => $request->name,
                'user_id' => auth()->user()->id
            ];
        }else{
            $data = [
                'name' => $request->name,
                'logo' => $logo_path,
                'user_id' => auth()->user()->id
            ];
        }

        if(Organization::updateOrCreate([
            'user_id' => auth()->user()->id
        ],$data)){
            return response()->json(['success' => 'Organization created successfully!'], 200);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
