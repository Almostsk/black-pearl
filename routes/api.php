<?php

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    
    Route::post('send-sms', 'Api\UserController@sendSms');
    Route::post('logout', 'AuthController@logout');

});

Route::post('feedback/create', 'Api\FeedbackController@store');
Route::group(['middleware' => 'api'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');
    Route::get('cities', 'Api\CityController@index');
    Route::get('stars', 'Api\UserController@getOurStars');
});