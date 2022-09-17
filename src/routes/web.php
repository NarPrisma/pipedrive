<?php

use Illuminate\Support\Facades\Route;

/***** Pipedrive Routes *****/
Route::group(['prefix' => 'pipedrive', 'as' => 'pipedrive.'], function () {
    Route::view('/', 'theme::integration.index')->name('index');
    Route::get('/redirect', '\Pipedrive\Http\Controllers\PipeController@redirect')->name('redirect');
    Route::get('/callback', '\Pipedrive\Http\Controllers\PipeController@init');
    Route::get('/custom_ui/callback','\Pipedrive\Http\Controllers\PipeController@customUi');
    Route::get('/modal','\Pipedrive\Http\Controllers\PipeController@token');
});