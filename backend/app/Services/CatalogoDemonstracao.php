<?php

namespace App\Services;

use App\Contracts\Catalogo;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;

class CatalogoDemonstracao implements Catalogo
{
    public function listarNomes(): array
    {
        return ['Camiseta', 'Calça', 'Tênis'];
    }

    /**
     * @return Collection<int, Produto>
     */
    public function listarProdutos(): Collection
    {
        $calca = new Produto([
            'nome' => 'Calça',
            'preco_em_centavos' => 12990,
            'status' => 'ativo',
        ]);
        $calca->id = 2;

        $camiseta = new Produto([
            'nome' => 'Camiseta',
            'preco_em_centavos' => 4990,
            'status' => 'ativo',
        ]);
        $camiseta->id = 1;

        $tenis = new Produto([
            'nome' => 'Tênis',
            'preco_em_centavos' => 19990,
            'status' => 'ativo',
        ]);
        $tenis->id = 3;

        return new Collection([$calca, $camiseta, $tenis]);
    }
}
