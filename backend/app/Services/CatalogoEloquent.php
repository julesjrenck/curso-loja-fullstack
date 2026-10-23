<?php

namespace App\Services;

use App\Contracts\Catalogo;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;

class CatalogoEloquent implements Catalogo
{
    public function listarNomes(): array
    {
        return Produto::query()
            ->where('status', 'ativo')
            ->orderBy('nome')
            ->pluck('nome')
            ->all();
    }

    /**
     * @return Collection<int, Produto>
     */
    public function listarProdutos(): Collection
    {
        return Produto::query()
            ->where('status', 'ativo')
            ->orderBy('nome')
            ->get(['id', 'nome', 'preco_em_centavos']);
    }

    public function buscarProduto(int $id): ?Produto
    {
        return Produto::query()
            ->where('status', 'ativo')
            ->whereKey($id)
            ->first(['id', 'nome', 'preco_em_centavos']);
    }
}
