<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [

            // Synchronously
            'appName' => config('app.name'),

            // Lazily
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,

                'user.access' => fn () => $request->user()
                ? $request->user()->only('position','level')
                : null,

            'user.branches' => function(){ 
                global $request;
                
                if($request->user()){
                    $branches = $request->user()->branch;
                    if($branches->count() < 1 && $request->user()->level =='admin'){
                        return null;
                    }elseif($branches->count() > 0){
                        if(!Session::has('active_branch') && session('active_branch') == ""){
                            session(['active_branch' => $branches[0] ]);
                            session()->save();
                        }
                        return $branches;
                    }
                    
                }else{
                    return null;
                }
            },

            'user.branch.active' => function(){
                global $request;
                if(Session::has('active_branch')){
                    return session('active_branch');
                }elseif(!Session::has('active_branch') && $request->user()->level =='admin' ){
                    return null;
                }else{
                    return abort(404);
                }
            },
            'user.admin' => function(){
                global $request;
                if(Session::has('admin')){
                    return session('admin');
                }
            } 
        ]);
    }
}
