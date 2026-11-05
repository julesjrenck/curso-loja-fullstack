<?php

namespace Tests\Feature;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LogoutApiTest extends TestCase
{
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

    public static function formatosAccept(): array
    {
        return [
            'JSON' => ['application/json'],
            'HTML' => ['text/html'],
            'ausente' => [null],
        ];
    }
}
