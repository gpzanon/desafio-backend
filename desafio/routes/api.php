<?php

use Illuminate\Http\Request;

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout');
// Route::get('user', 'AuthController@getAuthUser');

Route::apiResource('users', 'UserController');