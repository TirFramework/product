<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to product package
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/transaction', 'Tir\Store\Transaction\Http\Controllers\AdminTransactionController');

    });

});
