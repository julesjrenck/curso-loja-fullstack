<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoriaProdutosTest extends TestCase
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
    }

    public function test_categoria_carrega_somente_seus_produtos(): void
    {
        $roupas = Categoria::create(['nome' => 'Roupas']);
        $acessorios = Categoria::create(['nome' => 'Acessórios']);

        $camiseta = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'categoria_id' => $roupas->id,
        ]);

        $calca = Produto::factory()->create([
            'nome' => 'Calça',
            'status' => 'ativo',
            'categoria_id' => $roupas->id,
        ]);

        Produto::factory()->create([
            'nome' => 'Caneca',
            'status' => 'ativo',
            'categoria_id' => $acessorios->id,
        ]);

        $roupas = Categoria::findOrFail($roupas->id);
        $produtos = $roupas->produtos;

        $this->assertInstanceOf(Collection::class, $produtos);
        $this->assertCount(2, $produtos);
        $this->assertEqualsCanonicalizing(
            [$camiseta->id, $calca->id],
            $produtos->modelKeys()
        );
    }

    public function test_categoria_sem_produtos_retorna_colecao_vazia(): void
    {
        $categoria = Categoria::create(['nome' => 'Roupas']);

        $categoria = Categoria::findOrFail($categoria->id);
        $produtos = $categoria->produtos;

        $this->assertInstanceOf(Collection::class, $produtos);
        $this->assertCount(0, $produtos);
    }
}
