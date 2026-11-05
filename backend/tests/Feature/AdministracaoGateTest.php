<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use LogicException;
use Tests\TestCase;

class AdministracaoGateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(app()->environment('testing'));
        $this->assertTrue(Gate::has('acessar-administracao'));

        DB::connection()->beforeExecuting(static function () {
            throw new LogicException('Os testes do Gate não devem executar SQL.');
        });
    }

    public function test_cliente_nao_pode_acessar_administracao(): void
    {
        $cliente = new User;
        $cliente->setRawAttributes(['is_admin' => 0], true);

        $this->assertFalse(
            Gate::forUser($cliente)->allows('acessar-administracao')
        );
    }

    public function test_administrador_pode_acessar_administracao(): void
    {
        $administrador = new User;
        $administrador->setRawAttributes(['is_admin' => 1], true);

        $this->assertTrue(
            Gate::forUser($administrador)->allows('acessar-administracao')
        );
    }

    public function test_visitante_nao_pode_acessar_administracao(): void
    {
        $this->assertFalse(
            Gate::forUser(null)->allows('acessar-administracao')
        );
    }

    public function test_usuario_sem_indicador_nao_pode_acessar_administracao(): void
    {
        $usuario = new User;

        $this->assertFalse(
            Gate::forUser($usuario)->allows('acessar-administracao')
        );
    }
}
