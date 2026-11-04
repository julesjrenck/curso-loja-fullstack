<?php

use App\Http\Controllers\Api\V1\ProdutoController;
use App\Http\Controllers\Api\V1\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/usuario', [UsuarioController::class, 'show'])
    ->middleware('auth:sanctum');

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])
    ->where('id', '[1-9][0-9]*');
