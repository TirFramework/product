<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to product package
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/category', 'Tir\Store\Controllers\AdminCategoryController');

        Route::resource('/product', 'Tir\Store\Controllers\AdminProductController');
        Route::resource('/productDescription', 'Tir\Store\Controllers\AdminProductDescriptionController');

        Route::resource('/weightType', 'Tir\Store\Controllers\AdminWeightTypeController');
        Route::resource('/weightTypeDescription', 'Tir\Store\Controllers\AdminWeightTypeDescriptionController');
        
        Route::resource('/sizeType', 'Tir\Store\Controllers\AdminSizeTypeController');
        Route::resource('/sizeTypeDescription', 'Tir\Store\Controllers\AdminSizeTypeDescriptionController');

        Route::resource('/attributeGroup', 'Tir\Store\Controllers\AdminAttributeGroupController');
        Route::resource('/attributeGroupDescription', 'Tir\Store\Controllers\AdminAttributeGroupDescriptionController');

        Route::resource('/attribute', 'Tir\Store\Controllers\AdminAttributeController');
        Route::resource('/attributeDescription', 'Tir\Store\Controllers\AdminAttributeDescriptionController');
    });

});

