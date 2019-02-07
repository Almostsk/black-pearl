<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('admin.app');
    });

    Route::get('/users/stars', 'Admin\UserController@usersStars');
    Route::get('/users/codes', 'Admin\UserController@usersCodes');

    Route::resource('/users', 'Admin\UserController')->except(['create', 'store', 'show', 'destroy']);
    Route::get('/winners', 'Admin\UserController@winners');
    Route::get('/moderate', 'Admin\UserController@moderate');

    Route::get('/download-all', 'Admin\UserController@exportAll')->name('download_all_users');
    Route::get('/download-stars', 'Admin\UserController@exportStars')->name('download_stars');
});