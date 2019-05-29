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



//Route::resource('/','HomeController');
Route::resource('/','UsuarioController');

Route::get('lista','UsuarioController@getCliente');
Route::get('usuario/{id}/edit','UsuarioController@edit');
Route::post('edita','UsuarioController@update');
Route::post('criar','UsuarioController@criar');

Route::delete('delete/{id}','UsuarioController@destroy');


