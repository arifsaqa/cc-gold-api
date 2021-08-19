<?php

namespace App\Http\Controllers;

use App\Models\BuyPrice;
use App\Models\Promo;
use App\Models\SellPrice;
use App\Models\Transaction;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

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
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $buy_latest = BuyPrice::latest('created_at')->first();
        $sell_latest = SellPrice::latest('created_at')->first();
        $transactions = Transaction::all();
        $users = User::all();
        return view('pages.index', compact('buy_latest', 'sell_latest', 'transactions', 'users'));
    }
    public function buyPrice()
    {
        $buy_price = BuyPrice::all();
        return view('pages.buy_price.index', compact('buy_price'));
    }
    public function sellPrice()
    {
        $sell_price = SellPrice::all();
        return view('pages.sell_price.index', compact('sell_price'));
    }
    public function transactionPending()
    {
        $transactions = Transaction::where('status', 0)->get();
        return view('pages.transaction.pending', compact('transactions'));
    }
    public function transactionCompleted()
    {
        $transactions = Transaction::where('status', 1)->get();
        return view('pages.transaction.completed', compact('transactions'));
    }
    public function promotions()
    {
        $promos = Promo::all();
        return view('pages.promo.index', compact('promo'));
    }
}
