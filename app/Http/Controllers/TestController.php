<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\Supplier;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TestController extends Controller
{
    //

    public function index(Request $request){


         $suppliers = DB::table('suppliers_old')->where('status', 1)->get();
        foreach($suppliers as $supplier){
            Supplier::create([
                'id' => $supplier->id,
                'name' => $supplier->name,
                'contact' => '09064629981',
                'organization_id' => 1,
            ]);
        };

        // $products = DB::table('products_old')->where('status', 1)->get();
        // foreach($products as $product){
        //     product::create([
        //         'id' => $product->id,
        //         'name' => $product->name,
        //         'category_id' => 1,
        //         'organization_id' => 1,
        //         'branch_id' => $product->branch,
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
