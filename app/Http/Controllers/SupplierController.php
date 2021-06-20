<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $supplier = Supplier::all();
        return Inertia::render("Supplier/Index");
    }

    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;
        
        $supplier = auth()->user()->organization->suppliers();
        if($request->has('search') && $request->search != ''){

            $supplier->where('name', 'LIKE', '%'.$request->search .'%')
                    ->orWhere('contact','LIKE', '%'.$request->search .'%')
                    ->orWhere('sales_rep','LIKE', '%'.$request->search .'%')
                    ->orWhere('sales_rep_contact','LIKE', '%'.$request->search .'%');
        }
        $supplier = $supplier->paginate($pagination);
    	return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string',
            'contact' => 'required|string',
        ]);

        if(Supplier::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'sales_rep' => $request->sales_rep,
            'sales_rep_contact' => $request->sales_rep_contact,
            'organization_id' => auth()->user()->organization->id,
        ])){
            return response()->json(['success' => 'Supplier Successfully created'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'contact' => 'required|string',
        ]);

        if($supplier->update($request->only(['name', 'contact', 'sales_rep', 'sales_rep_contact']))){
            return response()->json(['success' => 'Supplier Successfully Updated'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->delete()){
            return response()->json(['success' => 'Supplier Successfully created'], 200);
        };
    }
}
