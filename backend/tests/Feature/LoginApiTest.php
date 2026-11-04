<?php

namespace Tests\Feature;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->assertSame('array', config('cache.default'));
        $this->assertSame('array', config('session.driver'));
        $this->travelTo(Carbon::create(2026, 11, 4, 12, 0, 0, 'UTC'));
    }

    protected function tearDown(): void
    {
        $this->travelBack();

        parent::tearDown();
    }

    #[DataProvider('formatosAccept')]
    public function test_entrada_vazia_retorna_422_e_sexto_pedido_retorna_429(?string $accept): void
    {
        for ($pedido = 1; $pedido <= 5; $pedido++) {
            $resposta = $this->pedir($accept);

            $resposta
                ->assertStatus(422)
                ->assertHeader('Content-Type', 'application/json')
                ->assertHeaderMissing('Location')
                ->assertJsonValidationErrors(['email', 'password']);

            $dados = $resposta->json();
            $this->assertSame(['message', 'errors'], array_keys($dados));
            $this->assertIsString($dados['message']);
            $this->assertSame(['email', 'password'], array_keys($dados['errors']));
            $this->assertGuest('web');
        }

        $resposta = $this->pedir($accept);

        $resposta
            ->assertStatus(429)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Retry-After', '60')
            ->assertHeader('X-RateLimit-Limit', '5')
            ->assertHeader('X-RateLimit-Remaining', '0')
            ->assertHeaderMissing('Location');

        $dados = $resposta->json();
        $this->assertSame(['message'], array_keys($dados));
        $this->assertIsString($dados['message']);
        $this->assertTrue($resposta->headers->hasCacheControlDirective('no-store'));
        $this->assertGuest('web');
    }

    public static function formatosAccept(): array
    {
        return [
            'JSON' => ['application/json'],
            'HTML' => ['text/html'],
            'ausente' => [null],
        ];
    }

    private function pedir(?string $accept): TestResponse
    {
        $servidor = [
            'REMOTE_ADDR' => '127.0.0.1',
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ORIGIN' => 'http://127.0.0.1:8002',
        ];

        $request = Request::create(
            'http://127.0.0.1:8002/api/v1/login', 'POST', [], [], [], $servidor, '{}',
        );

        if ($accept === null) {
            $request->headers->remove('Accept');
        } else {
            $request->headers->set('Accept', $accept);
        }

        $this->assertSame($accept !== null, $request->headers->has('Accept'));
        $this->assertSame($accept, $request->headers->get('Accept'));

        $kernel = $this->app->make(Kernel::class);
        $resposta = $kernel->handle($request);
        $kernel->terminate($request, $resposta);

        $this->assertTrue($request->hasSession());

        return TestResponse::fromBaseResponse($resposta, $request);
    }
}
