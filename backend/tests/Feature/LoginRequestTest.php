<?php

namespace Tests\Feature;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    #[DataProvider('entradasValidas')]
    public function test_visitante_valida_e_obtem_somente_as_credenciais(array $entrada, array $esperado): void
    {
        $request = $this->criarRequestNormalizada($entrada);

        $this->assertNull($request->user());
        $this->assertTrue($request->authorize());

        $request->validateResolved();

        $this->assertSame($esperado, $request->validated());
    }

    #[DataProvider('entradasInvalidas')]
    public function test_recusa_entrada_invalida_com_erros_nos_campos_esperados(array $entrada, array $campos): void
    {
        $request = $this->criarRequestNormalizada($entrada);

        try {
            $request->validateResolved();
        } catch (ValidationException $exception) {
            $this->assertSame($campos, array_keys($exception->errors()));

            $resposta = TestResponse::fromBaseResponse(
                $this->app->make(ExceptionHandler::class)->render($request, $exception),
            );

            $resposta
                ->assertStatus(422)
                ->assertHeader('Content-Type', 'application/json')
                ->assertJsonValidationErrors($campos);

            return;
        }

        $this->fail('A entrada inválida deveria ter sido recusada.');
    }

    public static function entradasValidas(): array
    {
        return [
            'entrada comum' => [
                ['email' => 'ana@example.test', 'password' => 'senha-ficticia'],
                ['email' => 'ana@example.test', 'password' => 'senha-ficticia'],
            ],
            'normaliza email, preserva senha e exclui extras' => [
                ['email' => '  ana@example.test  ', 'password' => '  senha-ficticia  ', 'remember' => true, 'id' => 99],
                ['email' => 'ana@example.test', 'password' => '  senha-ficticia  '],
            ],
            'senha curta passa pelo formato de login' => [
                ['email' => 'ana@example.test', 'password' => 'a'],
                ['email' => 'ana@example.test', 'password' => 'a'],
            ],
        ];
    }

    public static function entradasInvalidas(): array
    {
        $email = 'ana@example.test';
        $senha = 'senha-ficticia';

        return [
            'email ausente' => [['password' => $senha], ['email']],
            'senha ausente' => [['email' => $email], ['password']],
            'ambos ausentes' => [[], ['email', 'password']],
            'email null' => [['email' => null, 'password' => $senha], ['email']],
            'email array' => [['email' => [], 'password' => $senha], ['email']],
            'email numero' => [['email' => 123, 'password' => $senha], ['email']],
            'email vazio' => [['email' => '', 'password' => $senha], ['email']],
            'email malformado' => [['email' => 'invalido', 'password' => $senha], ['email']],
            'email acima do limite' => [['email' => str_repeat('a', 256).'@example.test', 'password' => $senha], ['email']],
            'senha null' => [['email' => $email, 'password' => null], ['password']],
            'senha array' => [['email' => $email, 'password' => []], ['password']],
            'senha numero' => [['email' => $email, 'password' => 123], ['password']],
            'senha vazia' => [['email' => $email, 'password' => ''], ['password']],
            'senha com espacos' => [['email' => $email, 'password' => '   '], ['password']],
        ];
    }

    private function criarRequestNormalizada(array $entrada): LoginRequest
    {
        $request = Request::create('/api/v1/login', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
        ], json_encode($entrada, JSON_THROW_ON_ERROR));
        $request->setUserResolver(fn () => null);

        $normalizada = (new Pipeline($this->app))
            ->send($request)
            ->through([TrimStrings::class, ConvertEmptyStringsToNull::class])
            ->then(fn (Request $pedido) => $pedido);

        $form = LoginRequest::createFrom($normalizada);
        $form->setContainer($this->app)->setRedirector($this->app['redirect']);

        return $form;
    }
}
