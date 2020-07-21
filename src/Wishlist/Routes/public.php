<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {
    Route::post('wishlist', 'Tir\Store\Wishlist\Http\Controllers\WishlistController@store')->middleware('auth')->name('wishlist.store');
});