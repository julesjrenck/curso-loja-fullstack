<?php

namespace App\Http\Controllers;

use App\Services\CatalogoDemonstracao;
use Illuminate\View\View;

class LojaController extends Controller
{
    public function index(CatalogoDemonstracao $catalogo): View
    {
        return view('loja', [
            'nomeLoja' => config('app.name'),
            'produtos' => $catalogo->listarNomes(),
        ]);
    }
}
