<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	Route::prefix('v1')->group(function(){

		Route::post('login', 'Api\AuthController@login'); 

		Route::group(['middleware' => 'auth:api'], function(){
			Route::get('getUser', 'Api\AuthController@getUser');
			Route::post('registerUser', 'Api\UserController@register');
			Route::post('editUser', 'Api\UserController@edit');
			Route::post('removeUser', 'Api\UserController@remove');
			Route::post('logout', 'Api\AuthController@logout');
		});
	});