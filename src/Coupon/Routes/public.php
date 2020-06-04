<?php
// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::post('cart/coupon', 'CartCouponController@store')->name('cart.coupon.store');


});
