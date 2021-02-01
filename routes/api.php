<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return [
        'ping' => 'pong',
        'data' => Carbon::now()->toDateTimeString()
    ];
});

Route::get('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('index', 'UserController@index');
    Route::get('me', 'AuthController@me');
    Route::get('user/{id}', 'UserController@show');
    Route::post('store', 'UserController@store');
    Route::post('update/{id}', 'UserController@update');
    Route::delete('delete/{id}', 'UserController@destroy');
});
