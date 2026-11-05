<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LogoutApiTest extends TestCase
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
        $this->assertSame('array', config('cache.default'));
        $this->assertSame('array', config('session.driver'));
    }

    #[DataProvider('formatosAccept')]
    public function test_visitante_recebe_204_sem_corpo_independentemente_do_accept(?string $accept): void
    {
        $this->assertGuest('web');

        $request = Request::create('http://127.0.0.1:8002/api/v1/logout', 'POST', [], [], [], [
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_ORIGIN' => 'http://127.0.0.1:8002',
        ]);

        if ($accept === null) {
            $request->headers->remove('Accept');
        } else {
            $request->headers->set('Accept', $accept);
        }

        $this->assertSame($accept !== null, $request->headers->has('Accept'));
        $this->assertSame($accept, $request->headers->get('Accept'));
        $this->assertSame([], $request->cookies->all());
        $this->assertSame('', $request->getContent());

        $kernel = $this->app->make(Kernel::class);
        $resposta = $kernel->handle($request);
        $kernel->terminate($request, $resposta);

        TestResponse::fromBaseResponse($resposta, $request)
            ->assertNoContent()
            ->assertHeaderMissing('Location')
            ->assertCookie(config('session.cookie'))
            ->assertCookie('XSRF-TOKEN');

        $this->assertTrue($request->hasSession());
        $this->assertTrue($request->attributes->get('sanctum'));
        $this->assertGuest('web');
        $this->assertNull(Auth::guard('web')->id());
        $this->assertArrayNotHasKey(Auth::guard('web')->getName(), $request->session()->all());
    }

    public function test_logout_autenticado_invalida_sessao_e_consulta_seguinte_recebe_401(): void
    {
        $usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => 'senha-ficticia-do-teste',
        ]);

        $sessao = $this->app['session']->driver();
        $sessao->start();
        $this->assertGuest('web');
        Auth::guard('web')->login($usuario);
        $this->assertAuthenticatedAs($usuario, 'web');
        $chaveIdentidade = Auth::guard('web')->getName();
        $this->assertSame($usuario->id, $sessao->get($chaveIdentidade));

        $sessao->put('marcador', 'sessao-autenticada');
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();
        $this->assertIsString($tokenAnterior);
        $this->assertNotEmpty($tokenAnterior);
        $sessao->save();
        $this->assertNotSame('', $sessao->getHandler()->read($idAnterior));

        $sessao->flush();
        Auth::forgetGuards();
        $this->assertArrayNotHasKey($chaveIdentidade, $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertGuest('web');
        $this->withCookie(config('session.cookie'), $idAnterior);

        $request = Request::create(
            'http://127.0.0.1:8002/api/v1/logout', 'POST', [], $this->prepareCookiesForRequest(), [], [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_ORIGIN' => 'http://127.0.0.1:8002',
                'REMOTE_ADDR' => '127.0.0.1',
            ],
        );

        $kernel = $this->app->make(Kernel::class);
        $resposta = $kernel->handle($request);
        $kernel->terminate($request, $resposta);

        $respostaLogout = TestResponse::fromBaseResponse($resposta, $request);

        $respostaLogout
            ->assertNoContent()
            ->assertHeaderMissing('Location')
            ->assertCookie(config('session.cookie'), $sessao->getId())
            ->assertCookie('XSRF-TOKEN');

        $this->assertTrue($request->hasSession());
        $this->assertTrue($request->attributes->get('sanctum'));
        $this->assertSame($idAnterior, $request->cookies->get(config('session.cookie')));
        $this->assertSame($sessao, $request->session());
        $this->assertGuest('web');
        $this->assertNull(Auth::guard('web')->id());
        $this->assertArrayNotHasKey($chaveIdentidade, $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertNotSame($idAnterior, $sessao->getId());
        $this->assertIsString($sessao->token());
        $this->assertNotEmpty($sessao->token());
        $this->assertNotSame($tokenAnterior, $sessao->token());
        $this->assertSame('', $sessao->getHandler()->read($idAnterior));

        $cookieVisitante = $respostaLogout->getCookie(config('session.cookie'));
        $this->assertNotNull($cookieVisitante);
        $idVisitante = $cookieVisitante->getValue();
        $this->assertSame($sessao->getId(), $idVisitante);
        $tokenVisitante = $sessao->token();

        $sessao->flush();
        Auth::forgetGuards();

        $consulta = $this->withCookie(config('session.cookie'), $idVisitante)
            ->withCredentials()
            ->getJson('http://127.0.0.1:8002/api/v1/usuario', [
                'Origin' => 'http://127.0.0.1:8002',
            ]);

        $consulta
            ->assertStatus(401)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeaderMissing('Location');

        $dados = $consulta->json();
        $this->assertSame(['message'], array_keys($dados));
        $this->assertIsString($dados['message']);
        $this->assertSame($idVisitante, $consulta->baseRequest->cookies->get(config('session.cookie')));
        $this->assertFalse($consulta->baseRequest->headers->has('Authorization'));
        $this->assertTrue($consulta->baseRequest->hasSession());
        $this->assertSame($idVisitante, $sessao->getId());
        $this->assertSame($tokenVisitante, $sessao->token());
        $this->assertGuest('web');
        $this->assertNull(Auth::guard('web')->id());
        $this->assertArrayNotHasKey($chaveIdentidade, $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
    }

    public static function formatosAccept(): array
    {
        return [
            'JSON' => ['application/json'],
            'HTML' => ['text/html'],
            'ausente' => [null],
        ];
    }
}
