<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::post('products/{productId}/reviews', 'Tir\Store\Review\Controllers\ProductReviewController@store')->name('products.reviews.store');


});
