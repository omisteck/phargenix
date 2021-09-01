<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\Purchase;
use App\Models\Remit;
use App\Models\Sales;
use App\Models\Sales_Return;
use App\Models\Supplier;
use App\Models\Transfer;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// 
class TestController extends Controller
{
    //

    public function index(Request $request){
        $branch_old = ['1'=>1, '3' =>2, "4" => 3];
        $staff_old = ['1'=>6, '2' =>7, "3" => 8, "4" => 9,"5" => 10,"7" => 11,"8" => 12,"9" => 13,"10" => 1,"13" => 1,"14" => 1,"15" => 1,"16" => 1,"6" => 1, "11" => 14,"12" => 1, "17" => 15, "18" => 16, '6'=>1,'19'=>1,'20'=>1,];
        $manager_old = [' '=>1, '1'=>3, '2' =>4, "3" => 4, "4" => 4,"5" => 3,"7" => 2,"8" => 2,"9" => 2,"10" => 1,"13" => 5,"14" => 2,"15" => 1,"16" => 1,"6" => 3, "11" => 5,"12" => 5, "17" => 2, "18" => 2, '6'=>1,'19'=>2];

        // $transfers = DB::table('transfer')->where('id','>', 9886)->where('status', 1)->get();

        // foreach($transfers as $transfer){
        //     $from_product = product::where('id', $transfer->product);
        //     $to_product = product::where('id', $transfer->product_second);
        // if($from_product->count() > 0 && $to_product->count() > 0 ){
        //     Transfer::create([
        //             'branch_from' => $branch_old[$transfer->branch],
        //             'from_product' => $from_product->first(),
        //             'branch_to' => $branch_old[$transfer->to_branch],
        //             'to_product' => $to_product->first(),
        //             'old' => true,
        //             'qty' => $transfer->qty,
        //             'user_id' => $manager_old[$transfer->by_who],
        //             'created_at' => $transfer->real_date
        //         ]);

        // }
        // };




        // $purchases = DB::table('items')->where('id','>', 8578)->where('status', 1)->get();

        // foreach($purchases as $purchase){
        //     $recored = DB::table('purchases_old')->where('invoice_no', $purchase->invoice_no)->first();
        // if(product::where('id', $purchase->product)->count() > 0 && !empty($recored) ){
        //     echo $recored->id, '<br/>';
        //     Purchase::create([
        //             'user_id' => $manager_old[$recored->create_by],
        //             'invoice_number' => $purchase->invoice_no,
        //             'product' => product::where('id', $purchase->product)->first(),
        //             'supplier' => $recored->supplier,
        //             'old' => true,
        //             'qty' => $purchase->qty,
        //             'total' => $purchase->total,
        //             'unit' => $purchase->cost,
        //             'branch_id' => $branch_old[$recored->branch],
        //             'settlement'=> true,
        //             'created_at' => $purchase->real_date
        //         ]);
        //         // echo DB::table('sales_old')->where('sales_no', $sale->invoice_no)->first()->id,'-------',$staff_old[DB::table('sales_old')->where('sales_no', $sale->invoice_no)->first()->sale_by],'<br/>' ;
        // }
        // };




        // $sales = DB::table('sales_items')->where('id','>', 476375)->where('status', 1)->get();

        // foreach($sales as $sale){
        //     $recored = DB::table('sales_old')->where('sales_no', $sale->invoice_no)->first();
        // if(product::where('id', $sale->product)->count() > 0 && !empty($recored) ){
        //     Sales::create([
        //             'user_id' => $staff_old[$recored->sale_by],
        //             'invoice_number' => $sale->invoice_no,
        //             'data' => product::where('id', $sale->product)->first(),
        //             'shift' => 'Morning',
        //             'old' => true,
        //             'qty' => $sale->qty,
        //             'total' => $sale->total,
        //             'invoice_discount' => $recored->discount,
        //             'invoice_paid' => $recored->paid,
        //             'invoice_total' => $recored->total,
        //             'mode'=> 'Cash',
        //             'branch_id' => $branch_old[$recored->branch],
        //             'settlement'=> true,
        //             'created_at' => $sale->real_date
        //         ]);
        //         // echo DB::table('sales_old')->where('sales_no', $sale->invoice_no)->first()->id,'-------',$staff_old[DB::table('sales_old')->where('sales_no', $sale->invoice_no)->first()->sale_by],'<br/>' ;
        // }
        // };

       
        // $remits = DB::table('remit')->where('status', 1)->get();

        // foreach($remits as $remit){

        //     Remit::create([
        //         'user_id' => $staff_old[$remit->staff_id],
        //         'POS' => $remit->pos,
        //         'Cash' => $remit->physical,
        //         'Transfer' => $remit->transfer,
        //         'old' => true,
        //         'Total' => $remit->total,
        //         'Remitted' => $remit->total_s,
        //         'Balance' => $remit->balance,
        //         'date' => $remit->date,
        //         'approve_by' => 1,
        //         'branch_id' => $branch_old[$remit->branch],
        //         'created_at' => $remit->date,
        //     ]);
        // };

        // $staffs = DB::table('account')->where('status', 1)->get();
        // foreach($staffs as $staff){
        //     User::create([
        //         'name' => $staff->name,
        //         'username' => $staff->name,
        //         'phone' => $staff->name,
        //         'address' => $staff->name,
        //         'email_verified_at' => Carbon::now(),
        //         'level' => "staff",
        //         'position' => "cashier",
        //         'password' => $staff->password,
        //         'organization_id' => 1,
        //     ]);
        // };


        // $suppliers = DB::table('supplier')->where('status', 1)->get();
        // foreach($suppliers as $supplier){
        //     Supplier::create([
        //         'id' => $supplier->id,
        //         'name' => $supplier->name,
        //         'contact' => '09064629981',
        //         'organization_id' => 1,
        //     ]);
        // };

        // $products = DB::table('products_old')->where('status', 1)->get();
        // foreach($products as $product){
        //     product::create([
        //         'id' => $product->id,
        //         'name' => $product->name,
        //         'category_id' => 1,
        //         'organization_id' => 1,
        //         'branch_id' => $branch_old[$product->branch],
        //         'cost_price' => $product->cost,
        //         'selling_price' => $product->selling,
        //     ]);
        // };



        // $role = Role::create(['name' => 'cashier']);

        // $permission = Permission::create(['name' => 'Enter Sales']);
        // $permission = Permission::create(['name' => 'Browse Sales']);
        // $permission = Permission::create(['name' => 'Sales Returns']);
        // $permission = Permission::create(['name' => 'Old Sales']);

        // $role = Role::create(['name' => 'supervisor']);

        // $permission = Permission::create(['name' => 'Manage Sales']);
        // $permission = Permission::create(['name' => 'Ledger Card']);
        // $permission = Permission::create(['name' => 'Stock Reconciliation']);
        // $permission = Permission::create(['name' => 'Manage Expenses']);
        // $permission = Permission::create(['name' => 'add Expenses']);
        // $permission = Permission::create(['name' => 'Remit']);
        // $permission = Permission::create(['name' => 'Manage Sales Return']);
        // $permission = Permission::create(['name' => 'Transfer']);

        // $role = Role::create(['name' => 'manager']);
        // $permission = Permission::create(['name' => 'Manage Product']);
        // $permission = Permission::create(['name' => 'Manage Purchase']);
        // $permission = Permission::create(['name' => 'Manage Supplier']);
        // $permission = Permission::create(['name' => 'Event']);
        // $permission = Permission::create(['name' => 'Todo']);
        // $permission = Permission::create(['name' => 'Notes']);
        // $permission = Permission::create(['name' => 'Scrumboard']);
        // $permission = Permission::create(['name' => 'Contacts']);

        // $role = Role::where('id', 3)->first();
        // $permissions = Permission::where('id', '>=' ,0)->where('id', '<=', 20)->get();
        // $role->syncPermissions($permissions);
        // return Inertia::render('Test/Show', [
        //     'name' => 'Rasheed',
        //     'newClass' => 'SS1'
        // ]);

        // $permission = Permission::where('name', 'old sales')->first();
        // $role = Role::where('name', 'cashier')->first();
        // $permission->removeRole($role);
    }
}
