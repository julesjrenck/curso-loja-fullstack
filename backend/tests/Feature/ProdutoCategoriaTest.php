<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProdutoCategoriaTest extends TestCase
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

    public function test_produto_carrega_sua_categoria(): void
    {
        Categoria::create(['nome' => 'Acessórios']);
        $categoria = Categoria::create(['nome' => 'Roupas']);

        $produto = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'categoria_id' => $categoria->id,
        ]);

        $produto = Produto::findOrFail($produto->id);
        $categoriaLida = $produto->categoria;

        $this->assertInstanceOf(Categoria::class, $categoriaLida);
        $this->assertSame($categoria->id, $categoriaLida->id);
        $this->assertSame('Roupas', $categoriaLida->nome);
    }

    public function test_produto_sem_categoria_retorna_relacao_nula(): void
    {
        $produto = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
        ]);

        $produto = Produto::findOrFail($produto->id);

        $this->assertNull($produto->categoria_id);
        $this->assertNull($produto->categoria);
    }

    public function test_produto_pode_ser_associado_a_uma_categoria(): void
    {
        $produto = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
        ]);
        $categoria = Categoria::create(['nome' => 'Roupas']);

        $produto->categoria()->associate($categoria);

        $this->assertSame($categoria->id, $produto->categoria_id);
        $this->assertNull(Produto::findOrFail($produto->id)->categoria_id);

        $produto->save();
        $produto = Produto::findOrFail($produto->id);

        $this->assertSame($categoria->id, (int) $produto->categoria_id);
        $this->assertSame($categoria->id, $produto->categoria->id);
    }

    public function test_produto_pode_ficar_sem_categoria_apos_dissociacao(): void
    {
        $categoria = Categoria::create(['nome' => 'Roupas']);
        $produto = Produto::factory()->create([
            'nome' => 'Camiseta',
            'status' => 'ativo',
            'categoria_id' => $categoria->id,
        ]);

        $produto->categoria()->dissociate();

        $this->assertNull($produto->categoria_id);
        $this->assertSame(
            $categoria->id,
            (int) Produto::findOrFail($produto->id)->categoria_id
        );

        $produto->save();
        $produto = Produto::findOrFail($produto->id);

        $this->assertNull($produto->categoria_id);
        $this->assertNull($produto->categoria);
        $this->assertSame($categoria->id, Categoria::findOrFail($categoria->id)->id);
    }
}
