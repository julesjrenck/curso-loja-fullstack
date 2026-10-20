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
}
