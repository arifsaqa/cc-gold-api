<?php

namespace App\Http\Controllers;

use App\Models\BuyPrice;
use App\Models\Faq;
use App\Models\PaymentMethod;
use App\Models\Policy;
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
        $transaction_pending = Transaction::where('status', 0)->get();
        $transaction_completed = Transaction::where('status', 1)->get();
        $transaction_failed = Transaction::where('status', 2)->get();
        return view('pages.index', compact('buy_latest', 'sell_latest', 'transactions', 'transaction_pending', 'transaction_failed', 'users'));
    }
    public function buyPrice()
    {
        $buy_price = BuyPrice::orderBy('created_at', 'DESC')->get();
        return view('pages.buy_price.index', compact('buy_price'));
    }
    public function sellPrice()
    {
        $sell_price = SellPrice::orderBy('created_at', 'DESC')->get();
        return view('pages.sell_price.index', compact('sell_price'));
    }
    public function transactionPending()
    {
        $buys = Transaction::where('status', 0)->where('type', 1)->get();
        $sells = Transaction::where('status', 0)->where('type', 2)->get();
        $transfers = Transaction::where('status', 0)->where('type', 3)->get();
        return view('pages.transaction.pending', compact('buys', 'sells', 'transfers'));
    }
    public function transactionCompleted()
    {
        $buys = Transaction::where('status', 1)->where('type', 1)->get();
        $sells = Transaction::where('status', 1)->where('type', 2)->get();
        $transfers = Transaction::where('status', 1)->where('type', 3)->get();
        return view('pages.transaction.completed', compact('buys', 'sells', 'transfers'));
    }
    public function transactionFailed()
    {
        $buys = Transaction::where('status', 2)->where('type', 1)->get();
        $sells = Transaction::where('status', 2)->where('type', 2)->get();
        $transfers = Transaction::where('status', 2)->where('type', 3)->get();
        return view('pages.transaction.failed', compact('buys', 'sells', 'transfers'));
    }
    public function promotions()
    {
        $promos = Promo::all();
        return view('pages.promo.index', compact('promos'));
    }
    public function users()
    {
        $users = User::where('role', '!=', 1)->get();
        return view('pages.pengaturan.users', compact('users'));
    }
    public function paymentMethods()
    {
        $payment_methods = PaymentMethod::all();
        return view('pages.pengaturan.payment', compact('payment_methods'));
    }
    public function faqs()
    {
        $faqs = Faq::all();
        return view('pages.pengaturan.faq', compact('faqs'));
    }
    public function policies()
    {
        $policies = Policy::all();
        return view('pages.pengaturan.policy', compact('policies'));
    }
}
