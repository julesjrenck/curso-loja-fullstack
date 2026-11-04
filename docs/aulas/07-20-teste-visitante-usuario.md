# Aula 7.20 — Teste do visitante na consulta do usuário

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.19 com "entendi". Checkpoint anterior publicado e conferido em
5d6a4d8a9e642f08fe0f2b2a44139cb18f343552; HEAD/origin/main/main remota iguais.
Entendimento da 7.20 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos [UsuarioApiTest](../../backend/tests/Feature/UsuarioApiTest.php) para
preservar a resposta de visitante do [contrato](../api/autenticacao.md).
Na 7.19, a tentativa de redirecionar para login causou erro com Accept HTML;
agora os três casos verificados ficam registrados como teste de regressão.
Não alteramos código de aplicação nesta etapa.

Tests\Feature é o namespace do arquivo. Importamos DataProvider do PHPUnit
e TestCase da aplicação, que inicializa o Laravel para testes HTTP.
A classe herda esse TestCase; cada conjunto de dados executa um cenário
isolado, com uma requisição ao kernel da aplicação, sem servidor de rede.

## Mesmo cenário com três entradas

```php
public static function cabecalhosDeVisitante(): array
{
    return [
        'accept JSON' => [['Accept' => 'application/json']],
        'accept HTML' => [['Accept' => 'text/html']],
        'sem accept' => [[]],
    ];
}
```

O método público/estático fornece os dados ao PHPUnit antes de cada execução.
Cada nome identifica uma execução na saída. O array externo de cada conjunto
é a lista de argumentos; seu único item é o array de cabeçalhos recebido pelo
parâmetro $cabecalhos. Por isso o caso sem cabeçalho usa [[]]: um argumento vazio.

```php
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
```

O atributo DataProvider liga o teste ao fornecedor dos argumentos. Usamos get
com os cabeçalhos de cada caso: getJson acrescentaria Accept JSON e impediria
representar as outras duas entradas como pretendido. Não usamos actingAs,
cookies, tokens, setUserResolver ou desativação de middleware; é um visitante.

AssertStatus exige 401; assertHeader verifica presença e valor de Content-Type;
assertHeaderMissing exige ausência de Location. Json decodifica a resposta;
array_keys deve conter somente message, excluindo data e outros campos.
AssertIsString verifica o tipo da mensagem sem fixar texto ou idioma.
Void indica que o teste não devolve valor útil: ele passa ou acusa uma falha.

Não criamos fixtures nem usamos DatabaseTransactions/RefreshDatabase, pois este
cenário não precisa persistir dados. O ambiente testing e sessão array já vêm
de phpunit.xml. Não afirmamos zero SQL como asserção deste teste; esse resultado
foi observado no diagnóstico da 7.19. Sucesso autenticado ainda não está coberto.

Referência: [requisições internas e asserções de testes HTTP do Laravel](https://laravel.com/docs/13.x/http-tests).

## Comandos e resultados

```sh
docker compose exec -T backend php -l tests/Feature/UsuarioApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UsuarioApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Php -l verificou a sintaxe. O segundo comando executou somente esse arquivo;
testdox mostrou os nomes dos três conjuntos. Resultado: 3 testes/18 asserções,
código 0. AssertHeader conta presença e valor separadamente, totalizando seis
asserções por execução. A suíte completa passou com 70 testes/653 asserções,
código 0: os três novos cenários somam-se aos 67 testes/635 asserções anteriores.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas e quatro migrations
nos lotes 1/2/3/4, com zero users/password_reset_tokens/sessions/produtos/categorias.
Sem dependências, migrations, rotas, bootstrap ou ambientes alterados. OpenAPI
preservado; integração dessa operação nele continua pendente. Auditoria,
snapshot normal e quatro contratos não foram repetidos.

## Continuidade

Teste criado, explicado e verificado; entendimento confirmado com "entendi"
em 04/11/2026; publicação pendente. Após publicar: 7.21 — adicionar
cenário autenticado de GET /api/v1/usuario, usando actingAs com guard web e
User persistido somente em loja_test, conferindo 200 e os campos do contrato;
distinguir autenticação preparada pelo teste de login real.
