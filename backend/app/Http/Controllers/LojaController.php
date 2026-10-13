<?php

namespace App\Http\Controllers;

class LojaController extends Controller
{
    public function index(): string
    {
        return 'Bem-vindo à '.config('app.name').'!';
    }
}
