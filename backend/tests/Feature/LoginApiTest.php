<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    use DatabaseTransactions;

    private const SENHA = 'senha-ficticia-do-teste';

    protected function setUp(): void
    {
        parent::setUp();

        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);
        $this->assertSame('array', config('cache.default'));
        $this->assertSame('array', config('session.driver'));
        $this->travelTo(Carbon::create(2026, 11, 4, 12, 0, 0, 'UTC'));
    }

    protected function tearDown(): void
    {
        $this->travelBack();

        parent::tearDown();
    }

    public function test_login_valido_renova_sessao_e_permite_consultar_usuario(): void
    {
        User::query()->delete();

        $usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => self::SENHA,
        ]);

        $this->withSession(['marcador_visitante' => 'sessao-do-teste']);
        $sessao = $this->app['session']->driver();
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();
        $sessao->save();

        $this->assertGuest('web');
        $this->withCookie(config('session.cookie'), $idAnterior);

        $resposta = $this->pedir('application/json', [
            'email' => $usuario->email,
            'password' => self::SENHA,
        ]);

        $resposta
            ->assertNoContent()
            ->assertHeaderMissing('Location')
            ->assertCookie(config('session.cookie'), $sessao->getId());

        $this->assertSame($idAnterior, $resposta->baseRequest->cookies->get(config('session.cookie')));
        $this->assertAuthenticatedAs($usuario, 'web');
        $this->assertSame($usuario->id, $sessao->get(Auth::guard('web')->getName()));
        $this->assertSame('sessao-do-teste', $sessao->get('marcador_visitante'));
        $this->assertNotSame($idAnterior, $sessao->getId());
        $this->assertNotSame($tokenAnterior, $sessao->token());

        $cookieAutenticado = $resposta->getCookie(config('session.cookie'));
        $this->assertNotNull($cookieAutenticado);
        $idAutenticado = $cookieAutenticado->getValue();
        $chaveIdentidade = Auth::guard('web')->getName();

        $sessao->flush();
        $this->assertNull($sessao->get($chaveIdentidade));
        Auth::forgetGuards();

        $consulta = $this->withCookie(config('session.cookie'), $idAutenticado)
            ->withCredentials()
            ->getJson('http://127.0.0.1:8002/api/v1/usuario', [
                'Origin' => 'http://127.0.0.1:8002',
            ]);

        $consulta
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeaderMissing('Location')
            ->assertExactJson([
                'data' => [
                    'id' => $usuario->id,
                    'name' => 'Ana Exemplo',
                    'email' => 'ana@example.test',
                ],
            ]);

        $this->assertSame($idAutenticado, $consulta->baseRequest->cookies->get(config('session.cookie')));
        $this->assertSame($idAutenticado, $sessao->getId());
        $this->assertSame('sessao-do-teste', $sessao->get('marcador_visitante'));
        $this->assertAuthenticatedAs($usuario, 'web');
    }

    public function test_credenciais_recusadas_retornam_mesmo_422_e_preservam_visitante(): void
    {
        User::query()->delete();

        $usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => self::SENHA,
        ]);

        $this->withSession(['marcador_visitante' => 'sessao-do-teste']);
        $sessao = $this->app['session']->driver();
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();
        $sessao->save();

        $this->assertGuest('web');
        $this->withCookie(config('session.cookie'), $idAnterior);
        $corpos = [];

        foreach ([
            [$usuario->email, 'outra-senha-ficticia'],
            ['ausente@example.test', self::SENHA],
        ] as [$email, $senha]) {
            $resposta = $this->pedir('application/json', [
                'email' => $email,
                'password' => $senha,
            ]);

            $resposta
                ->assertStatus(422)
                ->assertHeader('Content-Type', 'application/json')
                ->assertHeaderMissing('Location')
                ->assertCookie(config('session.cookie'), $idAnterior)
                ->assertJsonValidationErrors(['email']);

            $dados = $resposta->json();
            $this->assertSame(['message', 'errors'], array_keys($dados));
            $this->assertIsString($dados['message']);
            $this->assertSame(['email'], array_keys($dados['errors']));
            $this->assertCount(1, $dados['errors']['email']);
            $this->assertIsString($dados['errors']['email'][0]);

            $this->assertGuest('web');
            $this->assertNull($sessao->get(Auth::guard('web')->getName()));
            $this->assertSame($idAnterior, $resposta->baseRequest->cookies->get(config('session.cookie')));
            $this->assertSame($idAnterior, $sessao->getId());
            $this->assertSame($tokenAnterior, $sessao->token());
            $this->assertSame('sessao-do-teste', $sessao->get('marcador_visitante'));
            $corpos[] = $dados;
        }

        $this->assertSame($corpos[0], $corpos[1]);
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

    private function pedir(?string $accept, array $dados = []): TestResponse
    {
        $servidor = [
            'REMOTE_ADDR' => '127.0.0.1',
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ORIGIN' => 'http://127.0.0.1:8002',
        ];

        $request = Request::create(
            'http://127.0.0.1:8002/api/v1/login', 'POST', [], $this->prepareCookiesForRequest(), [], $servidor,
            json_encode((object) $dados, JSON_THROW_ON_ERROR),
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
