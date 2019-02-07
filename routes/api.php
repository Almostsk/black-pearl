<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'RegisterController@register');

Route::post('login', 'AuthController@login');
Route::get('stars', 'Api\UserController@getOurStars');
Route::post('send-sms', 'Api\UserController@sendSms');
Route::get('cities', 'Api\CityController@index');
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function ($router) {



    Route::post('logout', 'AuthController@logout');

});

