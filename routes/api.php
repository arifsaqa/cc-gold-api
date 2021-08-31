<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BuyPriceController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RefferalController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SellPriceController;
use App\Http\Controllers\TransactionController;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'],
     function()
    {

        Route::post('/login',[AuthController::class, 'login']);
        Route::get('/getUserById/{id}', [AuthController::class, 'getUserById']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/checkToken', [AuthController::class, 'isTokenValid']);
        Route::post('/reloginWithPin', [AuthController::class, 'reloginWithPin']);
        Route::get('/getAllUsers', [AuthController::class, 'getAllUsers']);
        Route::post('/user/upload', [AuthController::class, 'upload']);
        Route::post('/updateIsVerified/{id}', [AuthController::class, 'updateIsVerified']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/verifiedByOTP', [AuthController::class, 'verifiedByOTP']);
        Route::post('/resetPasswordOTP', [AuthController::class, 'resetPasswordOTP']);
        Route::get('/numbers', [AuthController::class, 'getAllNumbers']);

        Route::post('/refferal', [RefferalController::class, 'store']);

        Route::get('/points/{id}', [PointController::class, 'index']);
        Route::post('/points/use/', [PointController::class, 'use']);


        Route::get('/promos', [PromoController::class, 'index']);
        Route::post('/promos/store/{id}', [PromoController::class, 'store']);
        Route::post('/promos/upload', [PromoController::class, 'upload']);
        Route::post('/promos', [PromoController::class, 'create']);
        Route::patch('/promos/{id}', [PromoController::class, 'update']);
        Route::delete('/promos/{id}', [PromoController::class, 'destroy']);


        Route::get('/transactions/{id}', [TransactionController::class, 'index']);
        Route::post('/transactions/{id}', [TransactionController::class, 'create']);
        Route::post('/transactions/uploadBarcode', [TransactionController::class, 'uploadBarcode']);
        // Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
        // Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
        Route::get('/saldo/{id}', [SaldoController::class, 'index']);
        Route::post('/saldo', [SaldoController::class, 'create']);
        Route::post('/saldo/delete', [BuyPriceController::class, 'destroy']);

        Route::get('/buyPrices', [BuyPriceController::class, 'index']);
        Route::get('/buyGraph/{timeline}', [BuyPriceController::class, 'graph']);
        Route::get('/currentBuyPrice', [BuyPriceController::class, 'getCurrentPrice']);
        Route::post('/buyprice', [BuyPriceController::class, 'create']);
        Route::get('/buyprice/{id}', [BuyPriceController::class, 'show']);

        Route::get('/bankAccounts/{id}', [BankAccountController::class, 'index']);
        Route::post('/bankAccounts/{id}', [BankAccountController::class, 'create']);

        Route::get('/sellPrices', [SellPriceController::class, 'index']);
        Route::get('/currentSellPrice', [SellPriceController::class, 'getCurrentPrice']);
        Route::post('/sellPrice', [SellPriceController::class, 'create']);
        Route::get('/sellPrice/{id}', [SellPriceController::class, 'show']);

        Route::get('/paymentMethods', [PaymentMethodController::class, 'index']);
        Route::post('/paymentMethods/upload', [PaymentMethodController::class, 'upload']);
        Route::post('/paymentMethods', [PaymentMethodController::class, 'create']);
        Route::patch('/paymentMethods/{id}', [PaymentMethodController::class, 'update']);
        // Route::delete('/paymentMethods/{id}', [PromoController::class, 'destroy']);

        Route::get('/faqs', [FaqController::class, 'index']);
        Route::get('/policy', [Policy::class, 'index']);
    }
);
