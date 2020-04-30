<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::get('products', 'ProductController@index')->name('products.index');
    Route::get('products/{slug}', 'Tir\Store\Product\Controllers\ProductController@show')->name('products.show');

});

