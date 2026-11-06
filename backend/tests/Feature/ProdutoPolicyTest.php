<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\User;
use App\Policies\ProdutoPolicy;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use LogicException;
use Tests\TestCase;

class ProdutoPolicyTest extends TestCase
{
    private int $tentativasSql = 0;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(app()->environment('testing'));

        DB::connection()->beforeExecuting(function () {
            $this->tentativasSql++;

            throw new LogicException('Os testes da Policy não devem executar SQL.');
        });
    }

    public function test_descobre_policy_de_produto_automaticamente(): void
    {
        $this->assertInstanceOf(
            ProdutoPolicy::class,
            Gate::getPolicyFor(Produto::class)
        );

        $this->conferirAusenciaDeSql();
    }

    public function test_cliente_nao_pode_atualizar_produto(): void
    {
        $cliente = new User;
        $cliente->setRawAttributes(['is_admin' => 0], true);

        $this->conferirPermissao($cliente, false);
    }

    public function test_administrador_pode_atualizar_produto(): void
    {
        $administrador = new User;
        $administrador->setRawAttributes(['is_admin' => 1], true);

        $this->conferirPermissao($administrador, true);
    }

    public function test_usuario_sem_indicador_nao_pode_atualizar_produto(): void
    {
        $this->conferirPermissao(new User, false);
    }

    public function test_visitante_nao_pode_atualizar_produto(): void
    {
        $this->conferirPermissao(null, false);
    }

    private function conferirPermissao(?User $usuario, bool $permitido): void
    {
        foreach ([1, 2] as $id) {
            $produto = new Produto;
            $produto->setRawAttributes([
                'id' => $id,
                'nome' => 'Produto fictício',
                'preco_em_centavos' => 1000,
                'status' => 'ativo',
            ], true);
            $atributos = $produto->getAttributes();

            $this->assertSame(
                $permitido,
                Gate::forUser($usuario)->allows('update', $produto)
            );
            $this->assertSame($atributos, $produto->getAttributes());
            $this->assertFalse($produto->isDirty());
        }

        $this->conferirAusenciaDeSql();
    }

    private function conferirAusenciaDeSql(): void
    {
        $this->assertSame(0, $this->tentativasSql);
        $this->assertInstanceOf(Closure::class, DB::connection()->getRawPdo());
    }
}
