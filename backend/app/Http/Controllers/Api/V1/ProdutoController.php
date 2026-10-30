<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Catalogo;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListarProdutosRequest;
use App\Http\Resources\ProdutoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProdutoController extends Controller
{
    public function index(ListarProdutosRequest $request, Catalogo $catalogo): AnonymousResourceCollection
    {
        return ProdutoResource::collection($catalogo->paginarProdutos($request->pagina()));
    }

    public function show(Catalogo $catalogo, string $id): ProdutoResource|JsonResponse
    {
        $idValidado = filter_var($id, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);

        $produto = $idValidado === false
            ? null
            : $catalogo->buscarProduto($idValidado);

        if ($produto === null) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return new ProdutoResource($produto);
    }
}
