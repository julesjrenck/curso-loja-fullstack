<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
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

        $this->assertPaginaUnica($resposta, []);
    }

    public function test_retorna_produto_ativo_em_json(): void
    {
        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos');

        $this->assertPaginaUnica($resposta, [
            [
                'id' => $camiseta->id,
                'nome' => 'Camiseta',
                'preco_em_centavos' => 4990,
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

        $this->assertPaginaUnica($resposta, [
            [
                'id' => $camiseta->id,
                'nome' => 'Camiseta',
                'preco_em_centavos' => 4990,
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

        $this->assertPaginaUnica($resposta, [
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
        ]);
    }

    #[DataProvider('buscasPorNome')]
    public function test_filtra_ativos_por_trecho_do_nome_no_json(string $query, string $nomeNosLinks): void
    {
        $kit = Produto::factory()->create([
            'nome' => 'Kit de camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 6990,
        ]);

        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta azul',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        Produto::factory()->create([
            'nome' => 'Caneca',
            'status' => 'ativo',
            'preco_em_centavos' => 2990,
        ]);

        Produto::factory()->inativo()->create([
            'nome' => 'Camiseta antiga',
            'preco_em_centavos' => 1990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos?'.$query);
        $url = url('/api/v1/produtos').'?'.http_build_query([
            'nome' => $nomeNosLinks,
            'page' => 1,
        ]);

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [
                [
                    'id' => $camiseta->id,
                    'nome' => 'Camiseta azul',
                    'preco_em_centavos' => 4990,
                ],
                [
                    'id' => $kit->id,
                    'nome' => 'Kit de camiseta',
                    'preco_em_centavos' => 6990,
                ],
            ])
            ->assertJsonPath('links', [
                'first' => $url,
                'last' => $url,
                'prev' => null,
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 2)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', 1)
            ->assertJsonPath('meta.to', 2);
    }

    public static function buscasPorNome(): array
    {
        return [
            'nome simples' => ['nome=camiseta', 'camiseta'],
            'espaços externos e caixa' => ['nome=%20%20CAMISETA%20%20', 'CAMISETA'],
            'parâmetro desconhecido' => ['nome=camiseta&ignorado=valor', 'camiseta'],
        ];
    }

    public function test_retorna_segunda_pagina_com_ativos_e_desempate_por_id(): void
    {
        Produto::factory()->create([
            'nome' => 'Produto 10',
            'status' => 'ativo',
            'preco_em_centavos' => 1000,
        ]);

        $ultimoProduto = Produto::factory()->create([
            'nome' => 'Produto 10',
            'status' => 'ativo',
            'preco_em_centavos' => 2000,
        ]);

        for ($numero = 9; $numero >= 1; $numero--) {
            Produto::factory()->create([
                'nome' => sprintf('Produto %02d', $numero),
                'status' => 'ativo',
                'preco_em_centavos' => $numero * 100,
            ]);
        }

        Produto::factory()->inativo()->create([
            'nome' => 'Produto 00',
            'preco_em_centavos' => 500,
        ]);

        $resposta = $this->getJson('/api/v1/produtos?page=2');
        $url = url('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [
                [
                    'id' => $ultimoProduto->id,
                    'nome' => 'Produto 10',
                    'preco_em_centavos' => 2000,
                ],
            ])
            ->assertJsonPath('links', [
                'first' => $url.'?page=1',
                'last' => $url.'?page=2',
                'prev' => $url.'?page=1',
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 11)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.from', 11)
            ->assertJsonPath('meta.to', 11);
    }

    #[DataProvider('paginasAposUltima')]
    public function test_retorna_pagina_vazia_apos_a_ultima_sem_perder_total(int $pagina, int $paginaAnterior): void
    {
        Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos?page='.$pagina);
        $url = url('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [])
            ->assertJsonPath('links', [
                'first' => $url.'?page=1',
                'last' => $url.'?page=1',
                'prev' => $url.'?page='.$paginaAnterior,
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', $pagina)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 1)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', null)
            ->assertJsonPath('meta.to', null);
    }

    public static function paginasAposUltima(): array
    {
        return [
            'logo após a última' => [2, 1],
            'limite superior válido' => [1000000, 999999],
        ];
    }

    #[DataProvider('paginasInvalidas')]
    public function test_retorna_422_em_json_para_pagina_invalida(string $query): void
    {
        $resposta = $this->getJson('/api/v1/produtos?'.$query);

        $resposta
            ->assertStatus(422)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure(['message'])
            ->assertJsonValidationErrors(['page']);
    }

    public static function paginasInvalidas(): array
    {
        return [
            'zero' => ['page=0'],
            'vazia' => ['page='],
            'negativa' => ['page=-1'],
            'decimal' => ['page=1.5'],
            'zero inicial' => ['page=01'],
            'letras' => ['page=abc'],
            'array' => ['page[]=1'],
            'sinal positivo' => ['page=%2B1'],
            'notação científica' => ['page=1e3'],
            'acima do limite' => ['page=1000001'],
            'acima da faixa de int' => ['page='.PHP_INT_MAX.'0'],
        ];
    }

    private function assertPaginaUnica(TestResponse $resposta, array $produtos): void
    {
        $total = count($produtos);
        $url = url('/api/v1/produtos');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', $produtos)
            ->assertJsonPath('links', [
                'first' => $url.'?page=1',
                'last' => $url.'?page=1',
                'prev' => null,
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', $total)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', $total === 0 ? null : 1)
            ->assertJsonPath('meta.to', $total === 0 ? null : $total);
    }
}
