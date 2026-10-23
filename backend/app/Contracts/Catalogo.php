<?php

namespace App\Contracts;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;

interface Catalogo
{
    public function listarNomes(): array;

    /**
     * @return Collection<int, Produto>
     */
    public function listarProdutos(): Collection;

    public function buscarProduto(int $id): ?Produto;
}
