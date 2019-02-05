<?php

Route::get('/', function () {
   return view('admin.app');
});

Route::resource('/users', 'Admin\UserController')->except(['create', 'store', 'show', 'destroy']);
Route::get('/winners', 'Admin\UserController@winners');
Route::get('/moderate', 'Admin\UserController@moderate');

Route::get('/download-all', 'Admin\UserController@exportAll')->name('download_all_users');
