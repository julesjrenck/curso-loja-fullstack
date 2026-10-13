<?php

use App\Http\Controllers\LojaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loja', [LojaController::class, 'index']);
