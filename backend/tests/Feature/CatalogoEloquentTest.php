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

    public function test_retorna_lista_vazia_quando_nao_ha_produtos(): void
    {
        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);

        Produto::query()->delete();

        $catalogo = new CatalogoEloquent;

        $this->assertSame([], $catalogo->listarNomes());
    }
}
