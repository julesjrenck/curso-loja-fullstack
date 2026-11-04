<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UsuarioApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_usuario_autenticado_recebe_seus_dados_em_json(): void
    {
        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);

        User::query()->delete();

        $usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => 'senha-ficticia-do-teste',
        ]);

        $this->assertIsInt($usuario->getKey());
        $this->assertGreaterThan(0, $usuario->getKey());

        $resposta = $this->actingAs($usuario, 'web')->getJson('/api/v1/usuario');

        $resposta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertExactJson([
                'data' => [
                    'id' => $usuario->id,
                    'name' => 'Ana Exemplo',
                    'email' => 'ana@example.test',
                ],
            ]);
    }

    #[DataProvider('cabecalhosDeVisitante')]
    public function test_visitante_recebe_401_json_independentemente_do_accept(array $cabecalhos): void
    {
        $resposta = $this->get('/api/v1/usuario', $cabecalhos);

        $resposta
            ->assertStatus(401)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeaderMissing('Location');

        $dados = $resposta->json();

        $this->assertSame(['message'], array_keys($dados));
        $this->assertIsString($dados['message']);
    }

    public static function cabecalhosDeVisitante(): array
    {
        return [
            'accept JSON' => [['Accept' => 'application/json']],
            'accept HTML' => [['Accept' => 'text/html']],
            'sem accept' => [[]],
        ];
    }
}
