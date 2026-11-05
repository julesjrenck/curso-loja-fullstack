<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AdministracaoController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'data' => [
                'mensagem' => 'Bem-vindo à administração da loja.',
            ],
        ]);
    }
}
