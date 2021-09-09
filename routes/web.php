<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyPriceController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\SellPriceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buy/price', [HomeController::class, 'buyPrice'])->name('buyprice');
Route::post('/buy/create', [BuyPriceController::class, 'create'])->name('buycreate');

Route::get('/sell/price', [HomeController::class, 'sellPrice'])->name('sellprice');
Route::post('/sell/create', [SellPriceController::class, 'create'])->name('sellcreate');

Route::get('/promos', [HomeController::class, 'promotions'])->name('promotions');
Route::post('/promos/create', [PromoController::class, 'add'])->name('promo.add');
Route::resource('promo', PromoController::class);

Route::get('/payment', [HomeController::class, 'paymentMethods'])->name('paymentMethod');
Route::post('/payment-method/create', [PaymentMethodController::class, 'create'])->name('paymentMethod.create');
Route::resource('payment-method', PaymentMethodController::class);

Route::get('/faqs', [HomeController::class, 'faqs'])->name('faq');
Route::resource('faq', FaqController::class);

Route::get('/policies', [HomeController::class, 'policies'])->name('policy');
Route::resource('policy', PolicyController::class);

Route::get('/user', [HomeController::class, 'users'])->name('users');

Route::get('/transaction/pending', [HomeController::class, 'transactionPending'])->name('transaction.pending');
Route::get('/transaction/completed', [HomeController::class, 'transactionCompleted'])->name('transaction.completed');
Route::post('/transaction/confirm/{id}', [TransactionController::class, 'updateStatus'])->name('confirmation.transaction');

