<?php

namespace Tests\Feature;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Carbon;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginRateLimiterTest extends TestCase
{
    private int $chamadas = 0;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assertSame('array', config('cache.default'));
        $this->travelTo(Carbon::create(2026, 11, 4, 12, 0, 0, 'UTC'));
    }

    protected function tearDown(): void
    {
        $this->travelBack();

        parent::tearDown();
    }

    #[DataProvider('formatosAccept')]
    public function test_bloqueia_sexto_pedido_do_mesmo_ip_com_json_e_cabecalhos(?string $accept): void
    {
        for ($pedido = 1; $pedido <= 5; $pedido++) {
            $this->pedir(accept: $accept)
                ->assertNoContent()
                ->assertHeader('X-RateLimit-Remaining', (string) (5 - $pedido));
        }

        $resposta = $this->pedir(email: 'bruno@example.test', accept: $accept);

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
        $this->assertSame(5, $this->chamadas);
    }

    public function test_espera_diminui_sem_prorrogar_janela_e_libera_apos_expiracao(): void
    {
        for ($pedido = 1; $pedido <= 5; $pedido++) {
            $this->pedir()->assertNoContent();
        }

        $this->pedir()->assertStatus(429)->assertHeader('Retry-After', '60');

        $this->travel(30)->seconds();
        $this->pedir()->assertStatus(429)->assertHeader('Retry-After', '30');
        $this->assertSame(5, $this->chamadas);

        $this->travel(30)->seconds();
        $this->pedir()->assertNoContent()->assertHeader('X-RateLimit-Remaining', '4');
        $this->assertSame(6, $this->chamadas);
    }

    public function test_outro_ip_tem_contador_independente(): void
    {
        for ($pedido = 1; $pedido <= 5; $pedido++) {
            $this->pedir()->assertNoContent();
        }

        $this->pedir()->assertStatus(429);
        $this->pedir(ip: '127.0.0.2')->assertNoContent()->assertHeader('X-RateLimit-Remaining', '4');
        $this->pedir()->assertStatus(429);
        $this->assertSame(6, $this->chamadas);
    }

    public function test_falhas_na_proxima_etapa_tambem_consumem_o_limite(): void
    {
        for ($pedido = 1; $pedido <= 5; $pedido++) {
            $this->pedir(falharDepois: true)->assertStatus(422);
        }

        $this->pedir(falharDepois: true)->assertStatus(429)->assertHeader('Retry-After', '60');
        $this->assertSame(5, $this->chamadas);
    }

    public static function formatosAccept(): array
    {
        return [
            'JSON' => ['application/json'],
            'HTML' => ['text/html'],
            'ausente' => [null],
        ];
    }

    private function pedir(
        string $ip = '127.0.0.1',
        string $email = 'ana@example.test',
        ?string $accept = 'application/json',
        bool $falharDepois = false,
    ): TestResponse {
        $servidor = ['REMOTE_ADDR' => $ip, 'CONTENT_TYPE' => 'application/json'];

        $request = Request::create('/api/v1/login', 'POST', [], [], [], $servidor,
            json_encode(['email' => $email], JSON_THROW_ON_ERROR),
        );

        if ($accept === null) {
            $request->headers->remove('Accept');
        } else {
            $request->headers->set('Accept', $accept);
        }

        $this->assertSame($accept !== null, $request->headers->has('Accept'));
        $this->assertSame($accept, $request->headers->get('Accept'));

        try {
            $resposta = $this->app->make(ThrottleRequests::class)->handle(
                $request,
                function (Request $request) use ($falharDepois) {
                    $this->chamadas++;

                    if ($falharDepois) {
                        throw ValidationException::withMessages(['email' => ['Erro fictício do teste.']]);
                    }

                    return response()->noContent();
                },
                'login',
            );
        } catch (HttpResponseException $exception) {
            $resposta = $exception->getResponse();
        } catch (ValidationException $exception) {
            $resposta = $this->app->make(ExceptionHandler::class)->render($request, $exception);
        }

        return TestResponse::fromBaseResponse($resposta);
    }
}
