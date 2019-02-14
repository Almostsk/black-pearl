<?php

Route::group(['middleware' => 'jwt.auth'], function ($router) {


    Route::post('send-sms', 'Api\UserController@sendSms');
    Route::post('logout', 'AuthController@logout');

});
Route::get('/cabinet', 'Api\UserController@getCabinet');
Route::post('/cabinet/code', 'Api\UserController@getCabinet');
Route::post('feedback/create', 'Api\FeedbackController@store');
Route::group(['middleware' => 'api'], function () {
    Route::get('stars', 'Api\UserController@getOurStars');
    Route::get('gallery', 'Api\UserController@getGallery');
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');
    Route::get('cities', 'Api\CityController@index');
    Route::get('stars', 'Api\UserController@getOurStars');
});
