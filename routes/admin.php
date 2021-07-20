<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\OrganizationController;

Route::middleware(['isAdmin'])->group(function () {
    Route::resource('setup', SetupController::class);
    Route::resource('organization', OrganizationController::class);
});




Route::resource('branch', BranchController::class);

Route::get('api/branch', [BranchController::class , 'search'])->name("getBranch");

Route::post('/change/shift', [StaffController::class, 'changeShift'])->name('changeShift');

?>