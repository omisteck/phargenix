<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SetupController extends Controller
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
        $organization = optional(auth()->user()->organization);
        $branches = optional($organization)->branches;

        return Inertia::render("Setup/Index",[ 'business' => $organization, 'branches' => $branches ]);
    }

}
