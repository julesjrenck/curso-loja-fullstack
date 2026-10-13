<?php

namespace App\Http\Controllers;

use App\Services\CatalogoDemonstracao;
use Illuminate\View\View;

class LojaController extends Controller
{
    public function __construct(private CatalogoDemonstracao $catalogo)
    {
    }

    public function index(): View
    {
        return view('loja', [
            'nomeLoja' => config('app.name'),
            'produtos' => $this->catalogo->listarNomes(),
        ]);
    }
}
