<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Helpers::check_organization_setup()){
                    $branches = Auth::user()->branch;
                    if(!Session::has('active_branch') && session('active_branch') == ""){
                        session(['active_branch' => $branches[0] ]);
                        session()->save();
                    }
            return $next($request);

        }else{

            return redirect()->route('setup.index')->with('error', 'Please setup your business and branches');
        }
    }
}
