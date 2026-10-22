<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CatalogoApiTest extends TestCase
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

    public function test_retorna_json_com_lista_vazia_quando_nao_ha_produtos(): void
    {
        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson(['data' => []]);
    }

    public function test_retorna_nome_do_produto_ativo_em_json(): void
    {
        Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson(['data' => ['Camiseta']]);
    }

    public function test_omite_produtos_inativos_da_resposta_json(): void
    {
        Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
        ]);

        Produto::factory()->inativo()->create([
            'nome' => 'Caneca',
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson(['data' => ['Camiseta']]);
    }
}
