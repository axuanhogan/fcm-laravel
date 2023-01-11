<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('index', 'FCMJobController@index');

Route::group(['prefix' => 'user'], function () {
    Route::post('save-notification-token', 'UserController@saveNotificationToken');
});
