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

Route::get('/cadastro', 'CadastroController@index');
Route::get('/cadastro/{id}', 'CadastroController@index', function($id)
{
    return $id;
});

Route::post('/cadastro/create', 'CadastroController@store');
Route::post('/cadastro/edit/{id}', 'CadastroController@update', function($id)
{
    return 'ID '. $id.' editado';
});

Route::delete('/cadastro/delete/{id}', 'CadastroController@destroy', function($id)
{
    return 'ID '. $id.' deletado';
});
