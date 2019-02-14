<?php

Route::group(['middleware' => ['api']], function () {

    Route::get('/auth', 'AdminController@logIn')->name('log_in');
    Route::post('/authorize', 'AuthController@authorizeAdmin')->name('authorize');

});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@home')->name('admin_home');
    Route::post('/logout', 'AuthController@logout');

    Route::get('/users/stars', 'UserController@usersStars');
    Route::get('/users/codes', 'UserController@usersCodes');
    Route::get('/users/recent', 'UserController@recent');

    Route::resource('/users', 'UserController')->except(['create', 'store', 'show', 'destroy']);
    Route::get('/moderate', 'UserController@moderate');
    Route::get('/winners', 'UserController@winners');
    Route::get('/winners/{id}', 'UserController@winnersOfPrize');

    Route::get('/feedbacks/active', 'FeedbackController@feedbackActive');
    Route::get('/feedbacks/inactive', 'FeedbackController@feedbackInActive');
    Route::get('/feedbacks/deactivate/{id}', 'FeedbackController@deactivate')->name('deactivate');
    Route::resource('/feedbacks', 'FeedbackController')->except(['create', 'store', 'edit', 'destroy']);

    Route::get('/download-all', 'UserController@exportAll')->name('download_all_users');
    Route::get('/download-stars', 'UserController@exportStars')->name('download_stars');
    Route::get('/download-users-with-code', 'UserController@exportUsersWithCode')->name('download_users_with_code');
});
