<?php

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('send-sms', 'UserController@sendSms');
    Route::post('verify-code', 'UserController@verifyCode');
    Route::post('logout', 'AuthController@logout');

});

Route::group(['middleware' => 'api'], function () {

    Route::get('cabinet', 'UserController@getCabinet');
    Route::post('cabinet/code', 'CodeController@register');

    Route::post('feedback/create', 'FeedbackController@store');

    // dictionaries
    Route::get('winners', 'UserController@winners');
    Route::get('stars', 'UserController@getOurStars');
    Route::get('gallery', 'UserController@getGallery');
    Route::get('cities', 'CityController@index');

    // auth
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');

});
