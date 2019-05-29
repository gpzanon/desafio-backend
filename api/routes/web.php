<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'usuario'],function(){
    Route::get('lista','UsuarioController@index');
    Route::get('get/{id}','UsuarioController@edit');

    Route::post('criar','UsuarioController@store');
    Route::post('editar','UsuarioController@update');
    
    Route::delete('{id}','UsuarioController@destroy');
});
