<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Services\CatalogoEloquent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CatalogoEloquentTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);

        Produto::query()->delete();
    }

    public function test_retorna_lista_vazia_quando_nao_ha_produtos(): void
    {
        $catalogo = new CatalogoEloquent;

        $this->assertSame([], $catalogo->listarNomes());
    }

    public function test_retorna_nome_do_produto_ativo(): void
    {
        Produto::create([
            'nome' => 'Camiseta',
            'preco_em_centavos' => 4990,
            'status' => 'ativo',
        ]);

        $catalogo = new CatalogoEloquent;

        $this->assertSame(['Camiseta'], $catalogo->listarNomes());
    }

    public function test_omite_produtos_inativos_do_catalogo(): void
    {
        Produto::create([
            'nome' => 'Camiseta',
            'preco_em_centavos' => 4990,
            'status' => 'ativo',
        ]);

        Produto::create([
            'nome' => 'Caneca',
            'preco_em_centavos' => 2990,
            'status' => 'inativo',
        ]);

        $catalogo = new CatalogoEloquent;

        $this->assertSame(['Camiseta'], $catalogo->listarNomes());
    }
}
