<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UsuarioApiTest extends TestCase
{
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
