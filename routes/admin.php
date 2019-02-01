<?php

Route::get('/', function () {
   return view('admin.app');
});

Route::get('/users', 'Admin\UserController@index');