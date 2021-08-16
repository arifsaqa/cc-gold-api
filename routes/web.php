<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyPriceController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/buy/price', [HomeController::class, 'buyPrice'])->name('buyprice');
Route::get('/transaction/pending', [HomeController::class, 'transactionPending'])->name('transaction.pending');
Route::get('/transaction/completed', [HomeController::class, 'transactionCompleted'])->name('transaction.completed');
Route::get('/transaction/confirm/{id}', [TransactionController::class, 'updateStatus'])->name('confirmation.transaction');
Route::get('/sell/price', [HomeController::class, 'sellPrice'])->name('sellprice');
Route::post('/buy/create', [BuyPriceController::class, 'create'])->name('buycreate');
Route::post('/sell/create', [SellPriceController::class, 'create'])->name('sellcreate');
