<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Catalogo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProdutoController extends Controller
{
    public function index(Catalogo $catalogo): AnonymousResourceCollection
    {
        return ProdutoResource::collection($catalogo->listarProdutos());
    }
}
