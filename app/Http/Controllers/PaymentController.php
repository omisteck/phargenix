<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Payment;
use App\Helpers\Helpers;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Payment/Index');
    }


    public function search(Request $request){
        
        ($request->has('pagination'))? $pagination = $request->pagination : $pagination = 5;

        $payments = Payment::where('branch_id', Helpers::active_branch()['id'])->with(['branch','user', 'supplier']);
        if($request->has('search') && $request->search != ''){
            $payments->where('invoice_number', 'LIKE', '%'.$request->search .'%')
            ->orWhere('amount', 'LIKE', '%'.$request->search .'%')
            ->orWhere('mode', 'LIKE', '%'.$request->search .'%')
                ->orWhereHas('branch', function($q) use($request) {
                $q->where('shortname', 'LIKE', '%'.$request->search .'%');
             })->orWhereHas('user', function( $query ) use ( $request ){
                 $query->where('name', 'LIKE', '%'.$request->search .'%');
            })->orWhereHas('supplier', function( $query ) use ( $request ){
                $query->where('name', 'LIKE', '%'.$request->search .'%');
           });

        }
        
    	$payments = $payments->orderBy('created_at', 'desc')->paginate($pagination);
    	return response()->json($payments);
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
        // dd($request->all());
        $this->validate($request , [
            'invoice_number' => 'required|string|exists:purchases,invoice_number',
            'date' => 'required|date',
            'amount' => 'required|integer|min:1',
            'mode' => 'required|string',
            'remark' => 'required|string',
        ]);
        
        $check = Purchase::where('invoice_number',$request->invoice_number )->where('branch_id', "!=", Helpers::active_branch()['id'])->get();
        if($check->count() > 0){
            return response()->json(['errors' => [['No invoice number with '.$request->invoice_number." at this branch"]]], 428);
        }

        $purchases = Purchase::where('invoice_number',$request->invoice_number );
        $payments = Payment::where('invoice_number',$request->invoice_number )->get();
        $purchases_sum  = $purchases->get()->sum('total');
        $payments_sum = $payments->sum('amount');

        if($payments_sum+$request->amount == $purchases_sum){

        Payment::create([
            'invoice_number' => $request->invoice_number,
            'created_at' => $request->date,
            'amount' => $request->amount,
            'mode' => $request->mode,
            'remark' => $request->remark,
            'supplier_id' => $purchases->first()->supplier,
            'user_id' => Auth::user()->id,
            'branch_id' => Helpers::active_branch()['id'],
        ]);

        // dd($purchases->get());
        Purchase::where('invoice_number',$request->invoice_number )->update(['settlement' => 'true' ]); 

        }elseif($payments_sum+$request->amount  >= $purchases_sum){
            return response()->json(['errors' => [['The amount enter is more than the balance of this invoice']]], 428);
        }else{
            Payment::create([
                'invoice_number' => $request->invoice_number,
                'created_at' => $request->date,
                'amount' => $request->amount,
                'mode' => $request->mode,
                'remark' => $request->remark,
                'supplier_id' => $purchases->first()->supplier,
                'user_id' => Auth::user()->id,
                'branch_id' => Helpers::active_branch()['id'],
            ]);
        }

        return response()->json(['success' => 'Payment added successfully'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($payment)
    {
        $payments = Payment::where('invoice_number', $payment)->with(['branch','user', 'supplier'])->get();
        return Inertia::render('Payment/Single', [ 'payments' => $payments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->validate($request , [
            'invoice_number' => 'required|integer|exists:purchases,invoice_number',
            'created_at' => 'required|date',
            'amount' => 'required|integer|min:1',
            'mode' => 'required|string',
            'remark' => 'required|string',
        ]);

        $check = Purchase::where('invoice_number',$request->invoice )->where('branch_id', "!=", Helpers::active_branch()['id'])->get();
        if($check->count() > 0){
            return response()->json(['errors' => [['No invoice number with '.$request->invoice_number." at this branch"]]], 428);
        }

        $purchases = Purchase::where('invoice_number',$request->invoice_number );
        $payments = Payment::where('invoice_number',$request->invoice_number )->get();
        $purchases_sum  = $purchases->get()->sum('total');
        $payments_sum = $payments->sum('amount');

        if(($payments_sum -$payment->amount)+$request->amount  == $purchases_sum){
            $payment->update([
                'invoice_number' => $request->invoice_number,
                'created_at' => $request->created_at,
                'amount' => $request->amount,
                'mode' => $request->mode,
                'remark' => $request->remark,
                'supplier_id' => $purchases->first()->supplier,
            ]);
            $purchases->update(['settlement' => 'true' ]); 
        }elseif(($payments_sum -$payment->amount)+$request->amount  < $purchases_sum){
            $payment->update([
                'invoice_number' => $request->invoice_number,
                'created_at' => $request->created_at,
                'amount' => $request->amount,
                'mode' => $request->mode,
                'remark' => $request->remark,
                'supplier_id' => $purchases->first()->supplier,
                'settlement' => 'false'
            ]);
        }else{
            return response()->json(['errors' => [['The amount enter is more than the balance of this invoice']]], 428);
        }

        return response()->json(['success' => 'Payment Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment_invoice = $payment->invoice_number;
        $purchase = Purchase::where('invoice_number', $payment_invoice);

        //check if the status is settle
        if($purchase->get()[0]->settlement == true){
            $purchase->update(['settlement' => 'false']);
        }
        $payment->delete();
    }
}
