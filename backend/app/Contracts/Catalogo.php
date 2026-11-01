<?php

namespace App\Contracts;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Catalogo
{
    public function listarNomes(): array;

    /**
     * @return Collection<int, Produto>
     */
    public function listarProdutos(): Collection;

    /**
     * @return LengthAwarePaginator<int, Produto>
     */
    public function paginarProdutos(int $pagina, ?string $nome = null): LengthAwarePaginator;

    public function buscarProduto(int $id): ?Produto;
}
