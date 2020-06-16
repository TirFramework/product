<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    Route::get('countries/{code}/states', 'Tir\Store\Support\Http\Controllers\CountryStateController@index')->name('countries.states.index');


});
