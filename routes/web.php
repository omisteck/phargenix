<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;

use App\Http\Controllers\SetupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\BreakdownController;
use App\Http\Controllers\ReconcileController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RemitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware(['auth','isSetup'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
        Route::post('branch/delete', [BranchController::class, 'delete'])->name('deleteBranch');
        Route::post('/change/branch', [BranchController::class, 'changeBranch'])->name('changeBranch');
        
        Route::resource('staffs', StaffController::class);
        Route::get('api/staffs', [StaffController::class, 'search'])->name('staffs.search');
        Route::get('staff/sales/details', [StaffController::class, 'sales_record'])->name('sales.record');
    
        Route::resource('user', UserController::class);
        Route::get('user/branches/{user}', [StaffController::class, 'user_branches'])->name('staff.branches');
    
        Route::resource('suppliers', SupplierController::class);
        Route::get('api/suppliers', [SupplierController::class, 'search'])->name('supplier.search');
        
        Route::resource('categories', CategoryController::class);
        Route::get('api/categories', [CategoryController::class, 'search'])->name('categories.search');
    
        Route::resource('products', ProductController::class);
        Route::get('api/products', [ProductController::class, 'search'])->name('products.search');
        Route::get('/get/products', [ProductController::class, 'products'])->name('products.list');
        Route::get('api/branch/products/{branch}', [ProductController::class, 'branchProduct'])->name('branchProduct');
    
        Route::group(['middleware' => ['permission:Ledger Card']], function () {
            Route::get('ledger/products', [ProductController::class, 'ledger'])->name('ledger');
            Route::get('api/ledger', [ProductController::class, 'ledger_search'])->name('ledger.search');
        });

        Route::resource('sales', SalesController::class);
        Route::get('api/invoice', [SalesController::class, 'invoice_number']);
        Route::delete('sale/{sales:id}', [SalesController::class, 'delete_sale'])->name('delete_sale');
        // Route::get('api/sales', [SalesController::class, 'search'])->name('categories.search');
        Route::get('api/sales', [SalesController::class, 'search'])->name('sales.search');

        Route::group(['middleware' => ['permission:Old Sales']], function () {
            Route::get('old/sales', [SalesController::class, 'old_sales']);
            Route::post('old/sales', [SalesController::class, 'save_old_sales'])->name('save.old_sales');
        });

    
        Route::resource('return/sold', SalesReturnController::class);
        Route::get('api/return/sold', [SalesReturnController::class, 'search'])->name('sold.search');
    
        Route::get('invoices/{sales}', [InvoiceController::class, 'show']);
        Route::get('export/invoices/pdf/{sales}', [InvoiceController::class, 'export_pdf'])->name('export.pdf');
        Route::post('export/invoices/mail', [InvoiceController::class, 'mail_invoice'])->name('mail.invoice');    
    
        Route::resource('reconcile', ReconcileController::class);
        Route::get('api/reconcile', [ReconcileController::class, 'search'])->name('reconcile.search');
    
        Route::resource('transfer', TransferController::class);
        Route::get('api/transfer', [TransferController::class, 'search'])->name('transfer.search');
    
    
        Route::resource('purchases', PurchaseController::class);
        Route::get('api/purchases', [PurchaseController::class, 'search'])->name('purchase.search');
        Route::delete('purchase/{purchase:id}', [PurchaseController::class, 'delete_purchase'])->name('delete_purchase');
    
    
        Route::resource('payments', PaymentController::class);
        Route::get('api/payments', [PaymentController::class, 'search'])->name('payment.search');
    
        Route::get('breakdown/sales', [BreakdownController::class, 'index'])->name('sales.breakdown');
        Route::get('api/breakdown', [BreakdownController::class, 'search'])->name('breakdown.search');

        Route::resource('expenses', ExpensesController::class );
        Route::get('api/expenses', [ExpensesController::class, 'search'])->name('expenses.search');

        Route::get('remit', [RemitController::class, 'index'] );
        Route::post('remit/stat', [RemitController::class, 'stat']);
        Route::put('remit', [RemitController::class, 'store'])->name('remit.store');
        Route::delete('remit/{remit}', [RemitController::class, 'destroy'])->name('remit.destroy');
        Route::put('remit/{remit}', [RemitController::class, 'update'])->name('remit.update');
        Route::get('api/remit', [RemitController::class, 'search'])->name('expenses.search');

});

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');

Route::middleware('auth')->group(function () {

    include_once "admin.php";

});
