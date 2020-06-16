<?php

Route::group(['middleware' => 'web'], function () {

    Route::post('cart/taxes', 'Tir\Store\Tax\Http\Controllers\CartTaxController@store')->name('cart.taxes.store');


});