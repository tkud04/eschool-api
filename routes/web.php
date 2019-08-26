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

#Route::get('/', function(){return "<h2 style='color: red;'>Out of service</h2>";});

Route::get('/', 'MainController@getIndex');
Route::get('push-token', 'MainController@getPushToken');
Route::get('tokens', 'MainController@getTokens');
Route::get('token', 'MainController@getToken');
Route::get('logout', 'MainController@getLogout');


