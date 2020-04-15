<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to product package
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/attributeSet', 'Tir\Store\Attribute\Controllers\AdminAttributeSetController');

        Route::get('/attribute/{id}/values', 'Tir\Store\Attribute\Controllers\AdminAttributeController@values');

        Route::resource('/attribute', 'Tir\Store\Attribute\Controllers\AdminAttributeController');
    });

});

