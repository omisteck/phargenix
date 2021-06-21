<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReconcileController;
use App\Http\Controllers\SalesReturnController;

Route::resource('setup', SetupController::class);

Route::resource('organization', OrganizationController::class);

Route::resource('branch', BranchController::class);

Route::get('api/branch', [BranchController::class , 'search'])->name("getBranch");

Route::post('/change/shift', [StaffController::class, 'changeShift'])->name('changeShift');

Route::middleware(['isSetup'])->group(function () {
    
    Route::post('branch/delete', [BranchController::class, 'delete'])->name('deleteBranch');
    Route::post('/change/branch', [BranchController::class, 'changeBranch'])->name('changeBranch');
    
    Route::resource('staffs', StaffController::class);
    Route::get('api/staffs', [StaffController::class, 'search'])->name('staffs.search');

    Route::resource('user', UserController::class);
    Route::get('user/branches/{user}', [StaffController::class, 'user_branches'])->name('staff.branches');

    Route::resource('suppliers', SupplierController::class);
    Route::get('api/suppliers', [SupplierController::class, 'search'])->name('supplier.search');
    
    Route::resource('categories', CategoryController::class);
    Route::get('api/categories', [CategoryController::class, 'search'])->name('categories.search');

    Route::resource('products', ProductController::class);
    Route::get('api/products', [ProductController::class, 'search'])->name('categories.search');

    Route::resource('sales', SalesController::class);
    Route::get('api/invoice', [SalesController::class, 'invoice_number']);
    Route::delete('sale/{sales:id}', [SalesController::class, 'delete_sale'])->name('delete_sale');
    Route::get('api/sales', [SalesController::class, 'search'])->name('categories.search');
    Route::get('old/sales', [SalesController::class, 'old_sales']);
    Route::post('old/sales', [SalesController::class, 'save_old_sales'])->name('save.old_sales');
    Route::get('api/sales', [SalesController::class, 'search'])->name('sales.search');

    Route::resource('return/sold', SalesReturnController::class);
    Route::get('api/return/sold', [SalesReturnController::class, 'search'])->name('sold.search');

    Route::get('invoices/{sales}', [InvoiceController::class, 'show']);
    Route::get('export/invoices/pdf/{sales}', [InvoiceController::class, 'export_pdf'])->name('export.pdf');
    Route::post('export/invoices/mail', [InvoiceController::class, 'mail_invoice'])->name('mail.invoice');    

    Route::resource('reconcile', ReconcileController::class);
    Route::get('api/reconcile', [ReconcileController::class, 'search'])->name('reconcile.search');
    
});


?>