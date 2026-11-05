<?php

namespace Tests\Feature;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use LogicException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdministracaoApiTest extends TestCase
{
    private int $tentativasSql = 0;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assertTrue(app()->environment('testing'));
        config(['app.debug' => true]);

        DB::connection()->beforeExecuting(function () {
            $this->tentativasSql++;

            throw new LogicException('Os testes da administração não devem executar SQL.');
        });
    }

    public function test_visitante_recebe_401_json_sem_redirecionamento(): void
    {
        $resposta = $this->getJson('/api/v1/administracao');

        $this->conferirResposta($resposta, 401);

        $dados = $resposta->json();
        $this->assertSame(['message'], array_keys($dados));
        $this->assertIsString($dados['message']);
    }

    #[DataProvider('modosDepuracao')]
    public function test_cliente_recebe_403_json_sem_detalhes_de_excecao(bool $debug): void
    {
        config(['app.debug' => $debug]);

        $cliente = new User;
        $cliente->setRawAttributes(['id' => 1, 'is_admin' => 0], true);

        $resposta = $this->actingAs($cliente, 'web')
            ->getJson('/api/v1/administracao');

        $this->conferirResposta($resposta, 403);

        $dados = $resposta->json();
        $this->assertSame(['message'], array_keys($dados));
        $this->assertIsString($dados['message']);
    }

    public function test_administrador_recebe_mensagem_do_contrato(): void
    {
        $administrador = new User;
        $administrador->setRawAttributes(['id' => 1, 'is_admin' => 1], true);

        $resposta = $this->actingAs($administrador, 'web')
            ->getJson('/api/v1/administracao');

        $this->conferirResposta($resposta, 200);

        $resposta->assertExactJson([
            'data' => [
                'mensagem' => 'Bem-vindo à administração da loja.',
            ],
        ]);
    }

    public static function modosDepuracao(): array
    {
        return [
            'depuração ligada' => [true],
            'depuração desligada' => [false],
        ];
    }

    private function conferirResposta(TestResponse $resposta, int $status): void
    {
        $resposta
            ->assertStatus($status)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeaderMissing('Location');

        $this->assertSame(0, $this->tentativasSql);
        $this->assertInstanceOf(Closure::class, DB::connection()->getRawPdo());
    }
}
