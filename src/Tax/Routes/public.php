<?php

Route::group(['middleware' => 'web'], function () {

    Route::post('cart/taxes', 'CartTaxController@store')->name('cart.taxes.store');


});