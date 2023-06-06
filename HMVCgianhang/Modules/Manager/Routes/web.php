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

Route::prefix('manager')->middleware(['auth', 'permission:1,2'])->group(function() {
    Route::get('/', 'ManagerController@index')->name('manager.index');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    Route::prefix('order')->group(function() {
        Route::get('/', 'OrderController@index')->name('manager.order.index');
        Route::get('/{order}','OrderController@show')->name('manager.order.show');
        route::post('/{order}','OrderController@confirm')->name('manager.order.confirm');
    });

    Route::prefix('statistical')->group(function() {
        Route::get('/','StatisticalController@index')->name('manager.statistical.index');
        Route::post('/','StatisticalController@show')->name('manager.statistical.show');
    });

});
