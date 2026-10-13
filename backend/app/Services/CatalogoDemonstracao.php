<?php

namespace App\Services;

use App\Contracts\Catalogo;

class CatalogoDemonstracao implements Catalogo
{
    public function listarNomes(): array
    {
        return ['Camiseta', 'Calça', 'Tênis'];
    }
}
