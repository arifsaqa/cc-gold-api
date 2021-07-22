<?php

use App\Http\Controllers\PromoController;
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
    }
);