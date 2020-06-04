<?php
// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::post('cart/coupon', 'Tir\Store\Coupon\Http\Controllers\CartCouponController@store')->name('cart.coupon.store');


});
