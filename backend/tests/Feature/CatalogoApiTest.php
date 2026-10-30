<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
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

    public function test_retorna_produto_ativo_em_json(): void
    {
        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'data' => [
                    [
                        'id' => $camiseta->id,
                        'nome' => 'Camiseta',
                        'preco_em_centavos' => 4990,
                    ],
                ],
            ]);
    }

    public function test_retorna_produto_ativo_pelo_id_em_json(): void
    {
        Produto::factory()->create([
            'nome' => 'Caneca',
            'status' => 'ativo',
            'preco_em_centavos' => 2990,
        ]);

        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos/'.$camiseta->id);

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'data' => [
                    'id' => $camiseta->id,
                    'nome' => 'Camiseta',
                    'preco_em_centavos' => 4990,
                ],
            ]);
    }

    public function test_retorna_404_em_json_para_id_inexistente(): void
    {
        $resposta = $this->getJson('/api/v1/produtos/1');

        $resposta
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'message' => 'Produto não encontrado.',
            ]);
    }

    public function test_retorna_404_em_json_para_produto_inativo(): void
    {
        $caneca = Produto::factory()->inativo()->create([
            'nome' => 'Caneca',
            'preco_em_centavos' => 2990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos/'.$caneca->id);

        $resposta
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'message' => 'Produto não encontrado.',
            ]);

        $this->assertDatabaseHas('produtos', [
            'id' => $caneca->id,
            'status' => 'inativo',
        ]);
    }

    #[DataProvider('idsMalformados')]
    public function test_retorna_404_em_json_para_id_malformado(string $id): void
    {
        $resposta = $this->getJson('/api/v1/produtos/'.$id);

        $resposta
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure(['message']);
    }

    public static function idsMalformados(): array
    {
        return [
            'letras' => ['abc'],
            'zero' => ['0'],
            'negativo' => ['-1'],
            'decimal' => ['1.5'],
            'zero inicial' => ['01'],
        ];
    }

    public function test_retorna_404_em_json_para_id_acima_da_faixa_de_int(): void
    {
        $idForaDaFaixa = PHP_INT_MAX.'0';

        $resposta = $this->getJson('/api/v1/produtos/'.$idForaDaFaixa);

        $resposta
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'message' => 'Produto não encontrado.',
            ]);
    }

    public function test_omite_produtos_inativos_da_resposta_json(): void
    {
        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        Produto::factory()->inativo()->create([
            'nome' => 'Caneca',
            'preco_em_centavos' => 2990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'data' => [
                    [
                        'id' => $camiseta->id,
                        'nome' => 'Camiseta',
                        'preco_em_centavos' => 4990,
                    ],
                ],
            ]);
    }

    public function test_retorna_produtos_em_ordem_alfabetica_no_json(): void
    {
        $caneca = Produto::factory()->create([
            'nome' => 'Caneca',
            'status' => 'ativo',
            'preco_em_centavos' => 2990,
        ]);

        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'data' => [
                    [
                        'id' => $camiseta->id,
                        'nome' => 'Camiseta',
                        'preco_em_centavos' => 4990,
                    ],
                    [
                        'id' => $caneca->id,
                        'nome' => 'Caneca',
                        'preco_em_centavos' => 2990,
                    ],
                ],
            ]);
    }
}
