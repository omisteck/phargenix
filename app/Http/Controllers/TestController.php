<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function index(){
        if( ($user->level == 'admin') && (empty($user->organization_id)) ){
            return redirect()->route('organization.index');
        }
        return Inertia::render('Test/Show', [
            'name' => 'Rasheed',
            'newClass' => 'SS1'
        ]);
        
    }
}
