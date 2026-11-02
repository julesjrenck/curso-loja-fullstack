<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $capturar = getenv('CAPTURAR_CONTRATO_LISTAGEM_200') === '1';
        $caminhoCaptura = storage_path('app/private/contratos/listagem-200.json');

        if ($capturar && File::exists($caminhoCaptura)) {
            $this->assertTrue(File::delete($caminhoCaptura));
        }

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

        if ($capturar) {
            $corpo = $resposta->getContent();
            json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

            File::ensureDirectoryExists(dirname($caminhoCaptura));
            $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
        }
    }

    public function test_retorna_produto_ativo_pelo_id_em_json(): void
    {
        $capturar = getenv('CAPTURAR_CONTRATO_200') === '1';
        $caminhoCaptura = storage_path('app/private/contratos/consulta-200.json');

        if ($capturar && File::exists($caminhoCaptura)) {
            $this->assertTrue(File::delete($caminhoCaptura));
        }

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

        if ($capturar) {
            $corpo = $resposta->getContent();
            json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

            File::ensureDirectoryExists(dirname($caminhoCaptura));
            $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
        }
    }

    public function test_retorna_404_em_json_para_id_inexistente(): void
    {
        $capturar = getenv('CAPTURAR_CONTRATO_404') === '1';
        $caminhoCaptura = storage_path('app/private/contratos/consulta-404.json');

        if ($capturar && File::exists($caminhoCaptura)) {
            $this->assertTrue(File::delete($caminhoCaptura));
        }

        $resposta = $this->getJson('/api/v1/produtos/1');

        $resposta
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'message' => 'Produto não encontrado.',
            ]);

        if ($capturar) {
            $corpo = $resposta->getContent();
            json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

            File::ensureDirectoryExists(dirname($caminhoCaptura));
            $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
        }
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

    public function test_retorna_pagina_vazia_quando_nome_nao_corresponde_a_ativos(): void
    {
        Produto::factory()->create([
            'nome' => 'Caneca',
            'status' => 'ativo',
            'preco_em_centavos' => 2990,
        ]);

        Produto::factory()->inativo()->create([
            'nome' => 'Camiseta',
            'preco_em_centavos' => 4990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos?nome=camiseta');
        $url = url('/api/v1/produtos').'?nome=camiseta&page=1';

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [])
            ->assertJsonPath('links', [
                'first' => $url,
                'last' => $url,
                'prev' => null,
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 0)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', null)
            ->assertJsonPath('meta.to', null);
    }

    public function test_retorna_pagina_apos_ultima_filtrada_sem_perder_total_e_nome(): void
    {
        Produto::factory()->count(11)->create([
            'nome' => 'Camiseta',
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

        $resposta = $this->getJson('/api/v1/produtos?nome=camiseta&page=3');
        $url = url('/api/v1/produtos').'?nome=camiseta&page=';

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [])
            ->assertJsonPath('links', [
                'first' => $url.'1',
                'last' => $url.'2',
                'prev' => $url.'2',
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 3)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 11)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.from', null)
            ->assertJsonPath('meta.to', null);
    }

    #[DataProvider('nomesLiterais')]
    public function test_busca_nome_literal_e_preserva_texto_nos_links(string $nome): void
    {
        $correspondente = Produto::factory()->create([
            'nome' => 'Produto '.$nome.' especial',
            'status' => 'ativo',
            'preco_em_centavos' => 4990,
        ]);

        Produto::factory()->create([
            'nome' => 'Produto comum',
            'status' => 'ativo',
            'preco_em_centavos' => 2990,
        ]);

        Produto::factory()->inativo()->create([
            'nome' => 'Produto '.$nome.' inativo',
            'preco_em_centavos' => 1990,
        ]);

        $resposta = $this->getJson('/api/v1/produtos?'.http_build_query(['nome' => $nome]));
        $url = url('/api/v1/produtos').'?'.http_build_query([
            'nome' => $nome,
            'page' => 1,
        ]);

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [
                [
                    'id' => $correspondente->id,
                    'nome' => 'Produto '.$nome.' especial',
                    'preco_em_centavos' => 4990,
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
            ->assertJsonPath('meta.total', 1)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', 1)
            ->assertJsonPath('meta.to', 1);
    }

    public static function nomesLiterais(): array
    {
        return [
            'porcentagem' => ['%'],
            'sublinhado' => ['_'],
            'colchete' => ['['],
            'apóstrofo' => ["'"],
            'mais' => ['+'],
            'e comercial' => ['&'],
            'zero como texto' => ['0'],
            'limite de 100 caracteres ASCII' => [str_repeat('a', 100)],
            'limite de 100 caracteres Unicode' => [str_repeat('á', 100)],
        ];
    }

    #[DataProvider('buscasComAcentos')]
    public function test_distingue_acentos_e_ignora_caixa_na_busca_por_nome(string $nome, string $chaveEsperada): void
    {
        $produtos = [
            'sem acento' => Produto::factory()->create([
                'nome' => 'Kit de tenis',
                'status' => 'ativo',
                'preco_em_centavos' => 4990,
            ]),
            'com acento' => Produto::factory()->create([
                'nome' => 'Kit de tênis',
                'status' => 'ativo',
                'preco_em_centavos' => 5990,
            ]),
        ];
        $esperado = $produtos[$chaveEsperada];
        $resposta = $this->getJson('/api/v1/produtos?'.http_build_query(['nome' => $nome]));
        $url = url('/api/v1/produtos').'?'.http_build_query([
            'nome' => $nome,
            'page' => 1,
        ]);

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [
                [
                    'id' => $esperado->id,
                    'nome' => $esperado->nome,
                    'preco_em_centavos' => $esperado->preco_em_centavos,
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
            ->assertJsonPath('meta.total', 1)
            ->assertJsonPath('meta.last_page', 1)
            ->assertJsonPath('meta.from', 1)
            ->assertJsonPath('meta.to', 1);
    }

    public static function buscasComAcentos(): array
    {
        return [
            'sem acento em minúsculas' => ['tenis', 'sem acento'],
            'sem acento em maiúsculas' => ['TENIS', 'sem acento'],
            'com acento em minúsculas' => ['tênis', 'com acento'],
            'com acento em maiúsculas' => ['TÊNIS', 'com acento'],
        ];
    }

    public function test_mantem_filtro_e_total_ao_seguir_proxima_pagina(): void
    {
        $primeiroEmpate = Produto::factory()->create([
            'nome' => 'Camiseta 10',
            'status' => 'ativo',
            'preco_em_centavos' => 1000,
        ]);

        $segundoEmpate = Produto::factory()->create([
            'nome' => 'Camiseta 10',
            'status' => 'ativo',
            'preco_em_centavos' => 2000,
        ]);

        $iniciais = [];
        for ($numero = 9; $numero >= 1; $numero--) {
            $iniciais[] = Produto::factory()->create([
                'nome' => sprintf('Camiseta %02d', $numero),
                'status' => 'ativo',
                'preco_em_centavos' => $numero * 100,
            ]);
        }

        $kit = Produto::factory()->create([
            'nome' => 'Kit de camiseta',
            'status' => 'ativo',
            'preco_em_centavos' => 6990,
        ]);

        for ($numero = 1; $numero <= 8; $numero++) {
            Produto::factory()->create([
                'nome' => sprintf('Caneca %02d', $numero),
                'status' => 'ativo',
                'preco_em_centavos' => 2990,
            ]);
        }

        Produto::factory()->inativo()->create([
            'nome' => 'Camiseta 00',
            'preco_em_centavos' => 1990,
        ]);

        $esperadosPrimeiraPagina = array_map(
            fn (Produto $produto): array => [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco_em_centavos' => $produto->preco_em_centavos,
            ],
            array_merge(array_reverse($iniciais), [$primeiroEmpate]),
        );
        $url = url('/api/v1/produtos').'?nome=camiseta&page=';
        $primeira = $this->getJson('/api/v1/produtos?nome=camiseta');

        $primeira
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', $esperadosPrimeiraPagina)
            ->assertJsonPath('links', [
                'first' => $url.'1',
                'last' => $url.'2',
                'prev' => null,
                'next' => $url.'2',
            ])
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 12)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.from', 1)
            ->assertJsonPath('meta.to', 10)
            ->assertJsonCount(4, 'meta.links')
            ->assertJsonPath('meta.links.0.url', null)
            ->assertJsonPath('meta.links.0.page', null)
            ->assertJsonPath('meta.links.0.active', false)
            ->assertJsonPath('meta.links.1.url', $url.'1')
            ->assertJsonPath('meta.links.1.page', 1)
            ->assertJsonPath('meta.links.1.active', true)
            ->assertJsonPath('meta.links.2.url', $url.'2')
            ->assertJsonPath('meta.links.2.page', 2)
            ->assertJsonPath('meta.links.2.active', false)
            ->assertJsonPath('meta.links.3.url', $url.'2')
            ->assertJsonPath('meta.links.3.page', 2)
            ->assertJsonPath('meta.links.3.active', false);

        $segunda = $this->getJson($primeira->json('links.next'));

        $segunda
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('data', [
                [
                    'id' => $segundoEmpate->id,
                    'nome' => 'Camiseta 10',
                    'preco_em_centavos' => 2000,
                ],
                [
                    'id' => $kit->id,
                    'nome' => 'Kit de camiseta',
                    'preco_em_centavos' => 6990,
                ],
            ])
            ->assertJsonPath('links', [
                'first' => $url.'1',
                'last' => $url.'2',
                'prev' => $url.'1',
                'next' => null,
            ])
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 12)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.from', 11)
            ->assertJsonPath('meta.to', 12)
            ->assertJsonCount(4, 'meta.links')
            ->assertJsonPath('meta.links.0.url', $url.'1')
            ->assertJsonPath('meta.links.0.page', 1)
            ->assertJsonPath('meta.links.0.active', false)
            ->assertJsonPath('meta.links.1.url', $url.'1')
            ->assertJsonPath('meta.links.1.page', 1)
            ->assertJsonPath('meta.links.1.active', false)
            ->assertJsonPath('meta.links.2.url', $url.'2')
            ->assertJsonPath('meta.links.2.page', 2)
            ->assertJsonPath('meta.links.2.active', true)
            ->assertJsonPath('meta.links.3.url', null)
            ->assertJsonPath('meta.links.3.page', null)
            ->assertJsonPath('meta.links.3.active', false);
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

    #[DataProvider('nomesInvalidos')]
    public function test_retorna_422_em_json_para_nome_invalido(string $query): void
    {
        $resposta = $this->getJson('/api/v1/produtos?'.$query);

        $resposta
            ->assertStatus(422)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure(['message'])
            ->assertJsonValidationErrors(['nome']);
    }

    public static function nomesInvalidos(): array
    {
        return [
            'vazio' => ['nome='],
            'somente espaços' => ['nome=%20%20%20'],
            'array simples' => ['nome[]=camiseta'],
            'array associativo' => ['nome[valor]=camiseta'],
            'acima do limite ASCII' => ['nome='.str_repeat('a', 101)],
            'acima do limite Unicode' => ['nome='.rawurlencode(str_repeat('á', 101))],
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
