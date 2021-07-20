<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $transactions = Sales::orderBy('created_at', 'desc')->limit(4)->get();
        return Inertia::render('Dashboard', ['transactions' => $transactions]);
    }

    
}
