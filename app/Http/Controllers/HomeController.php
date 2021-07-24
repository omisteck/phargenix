<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Sales;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = auth()->user();

        if($user->position == 'cashier'){
            $numberOfMonth = 6;
            $mouthLabel = [];
            $mouthvalue = [];
            $expenses_data = [];

            $sales_month = Sales::where('user_id', $user->id)->whereMonth('created_at', Carbon::now()->format('m'))
                    ->get()->sum('invoice_total');

            $expenses_month = Expenses::where('user_id', $user->id)->whereMonth('created_at', Carbon::now()->format('m'))
                    ->get()->sum('amount');

            $stat = ['sales' => $sales_month, 'expenses' => $expenses_month ];
            for ($i=0; $i < $numberOfMonth ; $i++) { 
                $sales = Sales::where('user_id', $user->id)->whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                    ->get()->sum('invoice_total');

                $expenses = Expenses::where('user_id', $user->id)->whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                    ->get()->sum('amount');
                array_push($mouthvalue, $sales);
                array_push($expenses_data, $expenses);
                array_push($mouthLabel, Carbon::now()->subMonths($i)->format('M'));
            }
            $transactions = Sales::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(4)->get();
            $expenses = Expenses::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(4)->get();
        }else{
            $numberOfMonth = 6;
            $mouthLabel = [];
            $mouthvalue = [];
            $expenses_data = [];

            $sales_month = Sales::whereMonth('created_at', Carbon::now()->format('m'))
                    ->get()->sum('invoice_total');

            $expenses_month = Expenses::whereMonth('created_at', Carbon::now()->format('m'))
                    ->get()->sum('amount');

            $stat = ['sales' => $sales_month, 'expenses' => $expenses_month ];
            for ($i=0; $i < $numberOfMonth ; $i++) { 
                $sales = Sales::whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                    ->get()->sum('invoice_total');

                $expenses = Expenses::whereYear('created_at', Carbon::now()->subMonths($i)->format('Y'))
                    ->whereMonth('created_at', Carbon::now()->subMonths($i)->format('m'))
                    ->get()->sum('amount');
                array_push($mouthvalue, $sales);
                array_push($expenses_data, $expenses);
                array_push($mouthLabel, Carbon::now()->subMonths($i)->format('M'));
            }
            $transactions = Sales::orderBy('created_at', 'desc')->limit(4)->get();
            $expenses = Expenses::orderBy('created_at', 'desc')->limit(4)->get();

        }

         $profit = collect($mouthvalue)->sum() - collect($expenses_data)->sum();
        return Inertia::render('Dashboard', [ "expenses" => $expenses,'stat' => $stat,'transactions' => $transactions, 'mouthLabel' => $mouthLabel, 'mouthvalue' => $mouthvalue, 'expenses_data' => $expenses_data , 'profit' => "N". number_format($profit)]);
    }

    
}
