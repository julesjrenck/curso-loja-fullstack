<?php

namespace App\Services;

use App\Contracts\Catalogo;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * @return LengthAwarePaginator<int, Produto>
     */
    public function paginarProdutos(int $pagina, ?string $nome = null): LengthAwarePaginator
    {
        $consulta = Produto::query()
            ->where('status', 'ativo');

        if ($nome !== null) {
            $consulta->whereRaw('CHARINDEX(?, [nome]) > 0', [$nome]);
        }

        return $consulta
            ->orderBy('nome')
            ->orderBy('id')
            ->paginate(10, ['id', 'nome', 'preco_em_centavos'], 'page', $pagina);
    }

    public function buscarProduto(int $id): ?Produto
    {
        return Produto::query()
            ->where('status', 'ativo')
            ->whereKey($id)
            ->first(['id', 'nome', 'preco_em_centavos']);
    }
}
