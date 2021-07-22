<?php

use App\Http\Controllers\BuyPriceController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\SellPriceController;
use App\Http\Controllers\TransactionController;
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
        Route::get('/promos', [PromoController::class, 'index']);
        Route::post('/promos/upload', [PromoController::class, 'upload']);
        Route::post('/promos', [PromoController::class, 'create']);
        Route::patch('/promos/{id}', [PromoController::class, 'update']);
        Route::delete('/promos/{id}', [PromoController::class, 'destroy']);


        Route::get('/transactions/{id}', [TransactionController::class, 'index']);
        Route::post('/transactions/{id}', [TransactionController::class, 'create']);
        // Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
        // Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

        Route::get('/buyPrices', [BuyPriceController::class, 'index']);
        Route::get('/currentBuyPrice', [BuyPriceController::class, 'getCurrentPrice']);
        Route::post('/buyprice', [BuyPriceController::class, 'create']);

        Route::get('/sellPrices', [SellPriceController::class, 'index']);
        Route::get('/currentSellPrice', [SellPriceController::class, 'getCurrentPrice']);
        Route::post('/sellPrice', [SellPriceController::class, 'create']);
    }
);