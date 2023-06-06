<?php

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

use Modules\Customer\Http\Controllers\CustomerController;
use Modules\Customer\Http\Controllers\OrderController;

Route::prefix('customer')->middleware(['auth','permission:3'])->group(function() {
    Route::get('/index', [CustomerController::class,'index'])->name('customer.index');
    
    Route::get('/cart', [CustomerController::class,'cart'])->name('customer.cart');
    Route::delete('/cart/{order}/{product}', [CustomerController::class,'deleteCart'])->name('customer.deleteCart');

    Route::get('/detailProduct/{product}', [CustomerController::class,'detailProduct'])->name('customer.detailProduct');
    Route::post('/detailProduct/{product}', [CustomerController::class, 'addCart'])->name('customer.addCart');
    Route::put('/detailProduct/{product}', [CustomerController::class, 'updateCart'])->name('customer.updateCart');

    Route::prefix('order')->group(function() {
        Route::post('/buy}', [OrderController::class, 'buy'])->name('order.buy');
    });

    Route::prefix('history')->group(function() {
        Route::get('/', 'HistoryOrderController@index')->name('customer.history.index');
        Route::get('/{order}', 'HistoryOrderController@show')->name('customer.history.show');
    });

});