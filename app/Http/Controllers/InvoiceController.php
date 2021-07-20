<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sales;
use Barryvdh\DomPDF\PDF;
use App\Mail\InvoiceMail;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function show($invoice_number, Request $request){
        if($request->has('purchase')){
            $data = Purchase::where('invoice_number', $invoice_number)->with(['user','supplier', 'branch'])->get();
            return Inertia::render('Invoice/Purchase', [ 'purchases' => $data]);
        }else{
            $data = Sales::where('invoice_number', $invoice_number)->with(['user'])->get();
            return Inertia::render('Invoice/Sales', [ 'sales' => $data]);
        }
        // return view('invoice/pdf', [ 'sales' => $Sales]);

    }

    public function export_pdf($invoice_number){

        // Fetch all customers from database

        $Sales = Sales::where('invoice_number', $invoice_number)->get();

        // Send data to the view using loadView function of PDF facade

        $pdf = \PDF::loadView('invoice.pdf', [ 'sales' => $Sales]);

        // Finally, you can download the file using download function

        return $pdf->download("invoice_$invoice_number.pdf");
    }

    public function mail_invoice(Request $request){

        $Sales = Sales::where('invoice_number', $request->invoice)->get();
        
        if(Mail::to($request->to)->send(new InvoiceMail([ 'sales' => $Sales]))){
            return response()->json(['success' => 'E-mail sent successfully'], 200);
        };

        return response()->json(['errors' => [['There was an error when trying to send email trying again later']]], 428);
    }
}
