<?php

use App\Http\Controllers\Api\UsuarioController;

// DEFINIÇÃO DAS ROTAS PARA CADA TIPO DE REQUEST
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{idUsuario}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{idUsuario}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{idUsuario}', [UsuarioController::class, 'destroy']);

