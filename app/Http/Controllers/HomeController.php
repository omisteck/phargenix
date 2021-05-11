<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkSetup(){
        $user = auth()->user();

        // check if the login user is the business owner and have setup the business
        if( $user->level == 'admin' && optional($user->organization)->count() < 1 ){
            return false;
            // dd(1);
        }
        // dd(1);
        return true;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

        if(!$this->checkSetup()){
           return redirect()->route('setup.index');
        };
        // dd(1);
        return view('home');
    }

    
}
