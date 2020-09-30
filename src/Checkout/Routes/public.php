<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('checkout', 'Tir\Store\Checkout\Http\Controllers\CheckoutController@create')->name('checkout.create');
    Route::post('checkout', 'Tir\Store\Checkout\Http\Controllers\CheckoutController@store')->name('checkout.store');

    //This is call back url
    Route::get('checkout/payment-callback/{paymentGateway}', 'Tir\Store\Checkout\Http\Controllers\CheckoutPaymentController@callback')->name('checkout.payment.check');

    Route::get('checkout/complete/{orderId}/{paymentGateway}', 'Tir\Store\Checkout\Http\Controllers\CheckoutCompleteController@store')->name('checkout.complete.store');
    Route::get('checkout/complete', 'Tir\Store\Checkout\Http\Controllers\CheckoutCompleteController@show')->name('checkout.complete.show');


    Route::get('checkout/payment-canceled/{orderId}', 'Tir\Store\Checkout\Http\Controllers\PaymentCanceledController@store')->name('checkout.payment_canceled.store');

});