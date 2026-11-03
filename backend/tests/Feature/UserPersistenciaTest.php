<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserPersistenciaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_persiste_usuario_e_consulta_pelo_id(): void
    {
        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);

        User::query()->delete();

        $senha = 'senha-ficticia-do-teste';

        $usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => $senha,
        ]);

        $this->assertIsInt($usuario->getKey());
        $this->assertGreaterThan(0, $usuario->getKey());

        $consultado = User::query()->findOrFail($usuario->getKey());

        $this->assertSame('Ana Exemplo', $consultado->name);
        $this->assertSame('ana@example.test', $consultado->email);

        $this->assertNotSame($senha, $consultado->password);
        $this->assertTrue(Hash::check($senha, $consultado->password));
        $this->assertFalse(Hash::check('outra-senha-ficticia', $consultado->password));
    }
}
