<?php

use App\Contracts\Catalogo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', function (Catalogo $catalogo): JsonResponse {
    return response()->json([
        'data' => $catalogo->listarNomes(),
    ]);
});
