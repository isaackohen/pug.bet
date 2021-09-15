<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\GameController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* Route::middleware(['web', 'fortify'])->group(function () {
	Route::post('token', 'App\Http\Controllers\UserController@token')->middleware('fortify');
}); */

Route::any('callback/poker', 'App\Http\Controllers\GameController@pokerCallback')->name('poker.callback');


Route::any('callback/apigamble/payment', 'App\Http\Controllers\PaymentController@callback')->name('payment.callback');
Route::any('callback/offertoro/complete', 'App\Http\Controllers\PaymentController@offertoroCallback')->name('offertoro.callback');


Route::any('callback/apigamble/slots/balance', 'App\Http\Controllers\GameController@getBalance')->name('slots.getBalance');
Route::any('callback/apigamble/slots/bet', 'App\Http\Controllers\GameController@bet')->name('slots.bet');
