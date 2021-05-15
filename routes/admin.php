<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrganizationController;

Route::resource('setup', SetupController::class);

Route::resource('organization', OrganizationController::class);

Route::resource('branch', BranchController::class);

Route::get('branch/get/all', [BranchController::class , 'getBranch'])->name("getBranch");

Route::middleware(['isSetup'])->group(function () {
    
    
    Route::resource('staffs', StaffController::class);
    Route::resource('user', UserController::class);
});


?>