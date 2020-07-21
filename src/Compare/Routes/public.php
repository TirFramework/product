<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::get('compare', 'Tir\Store\Compare\Http\Controllers\CompareController@index')->name('compare.index');
    Route::post('compare', 'Tir\Store\Compare\Http\Controllers\CompareController@store')->name('compare.store');
    Route::delete('compare/{id}', 'Tir\Store\Compare\Http\Controllers\CompareController@destroy')->name('compare.destroy');

});

