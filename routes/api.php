<?php

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('send-sms', 'UserController@sendSms');
    Route::post('logout', 'AuthController@logout');

});

Route::group(['middleware' => 'api'], function () {
    Route::get('/cabinet', 'UserController@getCabinet');
    Route::post('/cabinet/code', 'CodeController@register');
    Route::post('feedback/create', 'FeedbackController@store');
    Route::get('stars', 'UserController@getOurStars');
    Route::get('gallery', 'UserController@getGallery');
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');
    Route::get('cities', 'CityController@index');
    Route::get('stars', 'UserController@getOurStars');
});
