<?php


// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to user module
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::get('/storeSetting', 'Tir\Store\StoreSetting\Http\Controllers\AdminStoreSettingController@editSetting')->name('test.edit');
        Route::get('/storeSetting', 'Tir\Store\StoreSetting\Http\Controllers\AdminStoreSettingController@editSetting')->name('storeSetting.index');
        Route::put('/storeSetting', 'Tir\Store\StoreSetting\Http\Controllers\AdminStoreSettingController@updateSetting')->name('storeSetting.update');
    });

});