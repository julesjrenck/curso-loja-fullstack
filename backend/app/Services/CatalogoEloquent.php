<?php

namespace App\Services;

use App\Contracts\Catalogo;
use App\Models\Produto;

class CatalogoEloquent implements Catalogo
{
    public function listarNomes(): array
    {
        return Produto::query()
            ->where('status', 'ativo')
            ->pluck('nome')
            ->all();
    }
}
