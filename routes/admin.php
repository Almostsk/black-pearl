<?php

Route::group(['middleware' => ['api']], function () {

    Route::get('/auth', 'Admin\AdminController@logIn')->name('log_in');
    Route::post('/authorize', 'Admin\UserController@authorizeAdmin')->name('authorize');

});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', 'Admin\AdminController@home')->name('admin_home');

    Route::get('/users/stars', 'Admin\UserController@usersStars');
    Route::get('/users/codes', 'Admin\UserController@usersCodes');

    Route::resource('/users', 'Admin\UserController')->except(['create', 'store', 'show', 'destroy']);
    Route::get('/moderate', 'Admin\UserController@moderate');
    Route::get('/winners', 'Admin\UserController@winners');
    Route::get('/winners/{id}', 'Admin\UserController@winnersOfPrize');

    Route::get('/feedbacks/active', 'Admin\FeedbackController@feedbackActive');
    Route::get('/feedbacks/inactive', 'Admin\FeedbackController@feedbackInActive');
    Route::get('/feedbacks/deactivate/{id}', 'Admin\FeedbackController@deactivate')->name('deactivate');
    Route::resource('/feedbacks', 'Admin\FeedbackController')->except(['create', 'store', 'edit', 'destroy']);

    Route::get('/download-all', 'Admin\UserController@exportAll')->name('download_all_users');
    Route::get('/download-stars', 'Admin\UserController@exportStars')->name('download_stars');
    Route::get('/download-users-with-code', 'Admin\UserController@exportUsersWithCode')->name('download_users_with_code');
});
