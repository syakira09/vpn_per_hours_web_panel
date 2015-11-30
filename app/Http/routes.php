<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MenuController@index');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');


Route::get('verify/{token?}','UserVerificationController@verify');

Route::get('dashboard','DashboardController@index');
Route::resource('vpnusers','VpnUsersController');
Route::resource('servers','ServersController');
Route::resource('randomserver','RandomServersController');

Route::post('poweroff','ServersController@powerOff');
Route::post('poweron','ServersController@powerOn');

Route::get('enablerandomserver','RandomServersController@enable');
Route::get('disablerandomserver','RandomServersController@disable');
Route::get('nextrandomserver','RandomServersController@nextserver');