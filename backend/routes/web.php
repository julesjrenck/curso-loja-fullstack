<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loja', function (): string {
    return 'Bem-vindo à '.config('app.name').'!';
});
