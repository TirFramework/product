<?php
// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::get('cart', 'Tir\Store\Cart\Http\Controllers\CartController@index')->name('cart.index');

    Route::post('cart/items', 'Tir\Store\Cart\Http\Controllers\CartItemController@store')->name('cart.items.store');
    Route::put('cart/items/{cartItemId}', 'Tir\Store\Cart\Http\Controllers\CartItemController@update')->name('cart.items.update');
    Route::delete('cart/items/{cartItemId}', 'Tir\Store\Cart\Http\Controllers\CartItemController@destroy')->name('cart.items.destroy');

    Route::post('cart/shipping-method', 'Tir\Store\Cart\Http\Controllers\CartShippingMethodController@store')->name('cart.shipping_method.store');

});

