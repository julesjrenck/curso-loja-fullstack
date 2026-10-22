<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Catalogo;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    public function index(Catalogo $catalogo): JsonResponse
    {
        return response()->json([
            'data' => $catalogo->listarNomes(),
        ]);
    }
}
