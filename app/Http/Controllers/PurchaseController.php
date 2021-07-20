<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Staff;
use App\Models\product;
use App\Helpers\Helpers;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Manage Purchase','auth']);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Purchase/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $branchies = Staff::where('user_id', auth()->user()->id)->with('branch');
        $suppliers = $user->organization->suppliers;
        $categories = $user->organization->categories;
        $products = product::where('branch_id', Helpers::active_branch()['id'])->get();
        $data = collect();
        foreach($products as $product){
            $product["instore"] = Helpers::get_instore_value($product["id"]);
            $data->push($product);
        }

        return Inertia::render('Purchase/Purchase', ['products' => $data, 'suppliers' => $suppliers, 'branchies' => $branchies->get(), 'categories' => $categories]);
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        $purchases = auth()->user()->purchases()->where('branch_id', Helpers::active_branch()['id'])
        ->distinct()
        ->select('invoice_number','supplier','settlement','user_id', 'branch_id','created_at')
        ->with(['user','branch', 'supplier']);

        if($request->has('search') && $request->search != ''){
            $purchases->where('invoice_number','LIKE', '%'.$request->search .'%')
            ->orWhereHas('branch', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })
             ->orWhereHas('supplier', function($q) use($request) {
                $q->where('name', 'LIKE', '%'.$request->search .'%');
             })
             ->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            });

        }

    	$purchases = $purchases->orderBy('created_at', 'desc')->paginate($pagination);
    	return response()->json($purchases);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'items' => "required|array",
            'invoice' => 'required|unique:purchases,invoice_number',
        ]);

        foreach($request->items as $purchase){

            //update the selling price and the cost;
            product::where('id', $purchase["item"]["id"])->update(["cost_price" => round( $purchase['total'] / $purchase['qty'],2) , "selling_price" => $purchase["item"]["selling_price"]]);

            Purchase::create([
                "invoice_number" => $purchase["invoice"],
                "product" => json_encode($purchase["item"]),
                "supplier" => $purchase["supplier"],
                "branch_id" => Helpers::active_branch()['id'],
                "qty" => $purchase["qty"],
                "total" => $purchase["total"],
                "unit" => $purchase["total"] / $purchase["qty"],
                "user_id" => auth()->user()->id,
                "created_at" => $purchase["date"],
            ]);
        }

        return response()->json(['success' => 'Purchase Created successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($purchase)
    {
        $purchases = Purchase::where('invoice_number', $purchase)->get();
        
        $user = auth()->user();
        $branchies = Staff::where('user_id', auth()->user()->id)->with('branch');
        $categories = $user->organization->categories;
        $products = $user->organization->products;
        $suppliers = $user->organization->suppliers;
        $data = collect();
        foreach($products as $product){
            $product["instore"] = Helpers::get_instore_value($product["id"]);
            $data->push($product);
        }


        $items = collect();


        foreach($purchases as $purchase){
            $formated = [
                'id' => $purchase->id,
                'qty' => $purchase->qty,
                'date' => $purchase->created_at->format('Y-m-d'),
                'total' => $purchase->total,
                'item' => json_decode($purchase->product),
                'supplier' => $purchase->supplier,
                'invoice' => $purchase->invoice_number
            ];
            $items = $items->push($formated);
        }

        return Inertia::render('Purchase/Edit', ['products' => $data, 'suppliers' => $suppliers, 'data' => $items,'branchies' => $branchies->get(), 'categories' => $categories ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $purchase)
    {
        $this->validate($request, [
            'items' => "required|array",
        ]);

        foreach($request->items as $purchase){
            if(isset($purchase['id']) && $purchase['id'] != ""){
                $purchase_record = Purchase::where('id',$purchase['id'])->first();
                $purchase_record->update([
                    "invoice_number" => $purchase["invoice"],
                    "supplier" => $purchase["supplier"],
                    "created_at" => $purchase["date"],
                ]);
            }else{
                Purchase::create([
                    "invoice_number" => $purchase["invoice"],
                    "product" => json_encode($purchase["item"]),
                    "supplier" => $purchase["supplier"],
                    "branch_id" => Helpers::active_branch()['id'],
                    "qty" => $purchase["qty"],
                    "total" => $purchase["total"],
                    "unit" => $purchase["total"] / $purchase["qty"],
                    "user_id" => auth()->user()->id,
                    "created_at" => $purchase["date"],
                ]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchase)
    {
        $purchases = Purchase::where('id',$purchase);
        $purchases->delete();
    }

    public function delete_purchase( $purchase )
    {
        $purchase = Purchase::where('invoice_number', $purchase);
        $purchase->delete();
    }
}
