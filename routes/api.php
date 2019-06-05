<?php

use Illuminate\Http\Request;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthApiController@login');
    Route::group([
        'middleware' => 'auth:api'
      ], function() {
          Route::get('logout', 'Auth\AuthApiController@logout');
          Route::get('user', 'Auth\AuthApiController@user');
      });
});

Route::apiResource('users', 'Api\UserController');
