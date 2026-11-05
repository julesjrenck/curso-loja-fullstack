<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    private const SENHA = 'senha-ficticia-do-teste';

    private User $usuario;

    protected function setUp(): void
    {
        parent::setUp();

        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);
        $this->assertSame('array', config('session.driver'));

        User::query()->delete();

        $this->usuario = User::query()->create([
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
            'password' => self::SENHA,
        ]);

        $this->app['session']->driver()->start();
        $this->assertGuest('web');
    }

    public function test_autentica_renova_sessao_e_retorna_204_sem_corpo(): void
    {
        $request = $this->criarRequest($this->usuario->email, self::SENHA);
        $sessao = $request->session();
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();

        $resposta = TestResponse::fromBaseResponse(
            (new LoginController())->store($request),
        );

        $resposta->assertNoContent()->assertHeaderMissing('Location');

        $this->assertAuthenticatedAs($this->usuario, 'web');
        $this->assertSame($this->usuario->id, $sessao->get(Auth::guard('web')->getName()));
        $this->assertNotSame($idAnterior, $sessao->getId());
        $this->assertNotSame($tokenAnterior, $sessao->token());
        $this->assertNull($this->usuario->fresh()->remember_token);
    }

    public function test_falhas_de_credenciais_retornam_o_mesmo_erro_e_preservam_sessao_de_visitante(): void
    {
        $corpos = [];

        foreach ([
            'senha incorreta' => [$this->usuario->email, 'outra-senha-ficticia'],
            'email inexistente' => ['ausente@example.test', self::SENHA],
        ] as $caso => [$email, $senha]) {
            $request = $this->criarRequest($email, $senha);
            $sessao = $request->session();
            $idAnterior = $sessao->getId();
            $tokenAnterior = $sessao->token();

            try {
                (new LoginController())->store($request);
            } catch (ValidationException $exception) {
                $this->assertSame(['email'], array_keys($exception->errors()));

                $resposta = TestResponse::fromBaseResponse(
                    $this->app->make(ExceptionHandler::class)->render($request, $exception),
                );

                $resposta
                    ->assertStatus(422)
                    ->assertHeader('Content-Type', 'application/json')
                    ->assertHeaderMissing('Location')
                    ->assertJsonValidationErrors(['email']);

                $this->assertGuest('web');
                $this->assertSame($idAnterior, $sessao->getId());
                $this->assertSame($tokenAnterior, $sessao->token());

                $dados = $resposta->json();
                $this->assertSame(['message', 'errors'], array_keys($dados));
                $this->assertIsString($dados['message']);
                $this->assertCount(1, $dados['errors']['email']);
                $this->assertIsString($dados['errors']['email'][0]);
                $corpos[] = $dados;

                continue;
            }

            $this->fail('O caso '.$caso.' deveria recusar as credenciais.');
        }

        $this->assertSame($corpos[0], $corpos[1]);
    }

    public function test_logout_autenticado_limpa_sessao_renova_id_e_token_e_retorna_204(): void
    {
        $sessao = $this->app['session']->driver();
        $request = Request::create('/api/v1/logout', 'POST', [], [], [], [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request->setLaravelSession($sessao);
        $this->app->instance('request', $request);

        $guard = Auth::guard('web');
        $guard->login($this->usuario);
        $this->assertAuthenticatedAs($this->usuario, 'web');
        $this->assertSame($this->usuario->id, $sessao->get($guard->getName()));

        $sessao->put('marcador', 'sessao-autenticada');
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();
        $this->assertIsString($tokenAnterior);
        $this->assertNotEmpty($tokenAnterior);
        $sessao->save();
        $this->assertNotSame('', $sessao->getHandler()->read($idAnterior));

        $resposta = TestResponse::fromBaseResponse(
            (new LoginController())->destroy($request),
        );

        $resposta->assertNoContent()->assertHeaderMissing('Location');
        $this->assertGuest('web');
        $this->assertNull($guard->id());
        $this->assertArrayNotHasKey($guard->getName(), $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertNotSame($idAnterior, $sessao->getId());
        $this->assertIsString($sessao->token());
        $this->assertNotEmpty($sessao->token());
        $this->assertNotSame($tokenAnterior, $sessao->token());
        $this->assertSame('', $sessao->getHandler()->read($idAnterior));

        $idNovo = $sessao->getId();
        $tokenNovo = $sessao->token();
        $sessao->save();
        $sessao->flush();
        Auth::forgetGuards();
        $sessao->start();

        $this->assertGuest('web');
        $this->assertNull(Auth::guard('web')->id());
        $this->assertArrayNotHasKey(Auth::guard('web')->getName(), $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertSame($idNovo, $sessao->getId());
        $this->assertSame($tokenNovo, $sessao->token());
    }

    public function test_logout_visitante_limpa_sessao_renova_id_e_token_e_retorna_204(): void
    {
        $sessao = $this->app['session']->driver();
        $request = Request::create('/api/v1/logout', 'POST', [], [], [], [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request->setLaravelSession($sessao);
        $this->app->instance('request', $request);

        $guard = Auth::guard('web');
        $this->assertGuest('web');
        $this->assertNull($guard->id());
        $this->assertArrayNotHasKey($guard->getName(), $sessao->all());

        $sessao->put('marcador', 'sessao-visitante');
        $idAnterior = $sessao->getId();
        $tokenAnterior = $sessao->token();
        $this->assertIsString($tokenAnterior);
        $this->assertNotEmpty($tokenAnterior);
        $sessao->save();
        $this->assertNotSame('', $sessao->getHandler()->read($idAnterior));

        $resposta = TestResponse::fromBaseResponse(
            (new LoginController())->destroy($request),
        );

        $resposta->assertNoContent()->assertHeaderMissing('Location');
        $this->assertGuest('web');
        $this->assertNull($guard->id());
        $this->assertArrayNotHasKey($guard->getName(), $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertNotSame($idAnterior, $sessao->getId());
        $this->assertIsString($sessao->token());
        $this->assertNotEmpty($sessao->token());
        $this->assertNotSame($tokenAnterior, $sessao->token());
        $this->assertSame('', $sessao->getHandler()->read($idAnterior));

        $idNovo = $sessao->getId();
        $tokenNovo = $sessao->token();
        $sessao->save();
        $sessao->flush();
        Auth::forgetGuards();
        $sessao->start();

        $this->assertGuest('web');
        $this->assertNull(Auth::guard('web')->id());
        $this->assertArrayNotHasKey(Auth::guard('web')->getName(), $sessao->all());
        $this->assertArrayNotHasKey('marcador', $sessao->all());
        $this->assertSame($idNovo, $sessao->getId());
        $this->assertSame($tokenNovo, $sessao->token());
    }

    private function criarRequest(string $email, string $senha): LoginRequest
    {
        $request = LoginRequest::create('/api/v1/login', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
        ], json_encode([
            'email' => $email,
            'password' => $senha,
            'remember' => true,
            'id' => 999,
        ], JSON_THROW_ON_ERROR));

        $request->setContainer($this->app)->setRedirector($this->app['redirect']);
        $request->setLaravelSession($this->app['session']->driver());
        $this->app->instance('request', $request);
        $request->validateResolved();

        return $request;
    }
}
