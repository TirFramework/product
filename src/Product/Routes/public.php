<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::get('products', 'Tir\Store\Product\Controllers\ProductController@index')->name('products.index');
    Route::get('products/{slug}', 'Tir\Store\Product\Controllers\ProductController@show')->name('products.show');

});

