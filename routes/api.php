<?php

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function ($router) {

    Route::get('stars', 'Api\UserController@getOurStars');
    Route::post('send-sms', 'Api\UserController@sendSms');
    Route::get('cities', 'Api\CityController@index');
    Route::post('logout', 'AuthController@logout');

});

Route::post('feedback/create', 'Api\FeedbackController@store');
Route::group(['middleware' => 'web', 'prefix' => 'auth'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');
});