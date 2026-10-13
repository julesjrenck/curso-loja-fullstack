<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LojaController extends Controller
{
    public function index(): View
    {
        return view('loja', [
            'nomeLoja' => config('app.name'),
            'produtos' => ['Camiseta', 'Calça', 'Tênis'],
        ]);
    }
}
