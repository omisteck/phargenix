<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;

Route::resource('setup', SetupController::class);

Route::resource('organization', OrganizationController::class);

Route::resource('branch', BranchController::class);
Route::get('branch/get/all', [BranchController::class , 'getBranch'])->name("getBranch");
?>