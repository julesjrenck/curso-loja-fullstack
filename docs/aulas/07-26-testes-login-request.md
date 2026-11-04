# Aula 7.26 — Testes automatizados da entrada do login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.25 com "entendi". Checkpoint anterior publicado e conferido em
ad9f45bfb0f30bc2b3375be441517706e9b356bc; HEAD/origin/main/main remota iguais.
Entendimento da 7.26 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginRequestTest](../../backend/tests/Feature/LoginRequestTest.php)
para preservar o comportamento da LoginRequest segundo o [contrato](../api/login.md).
O teste avalia dados aceitos/recusados e sua transformação. Não compara um array
de regras com outro, nem implementa autenticação ou uma rota temporária.

Tests\Feature usa o TestCase da aplicação para inicializar o Laravel. Imports
trazem LoginRequest, Request, Pipeline, os dois normalizadores, ValidationException,
handler de exceções, TestResponse e DataProvider. Não há traits de banco ou
fixtures: essa validação não precisa criar usuários ou consultar credenciais.

## Preparação compartilhada em memória

O método privado criarRequestNormalizada recebe um array de entrada. Cria
Request POST JSON para o caminho ilustrativo /api/v1/login, com Content-Type e
Accept JSON; JSON_THROW_ON_ERROR impede falhas silenciosas ao montar o corpo.
SetUserResolver indica visitante, não prepara guard autenticado.

Pipeline aplica TrimStrings e ConvertEmptyStringsToNull reais; a função final
devolve a requisição normalizada. LoginRequest::createFrom copia essa entrada,
e setContainer/setRedirector fornecem os serviços usados pelo FormRequest.
O helper devolve LoginRequest ainda sem executar validateResolved.
Não chama kernel HTTP, rota, rede ou sessão; normalização é aplicada explicitamente
pelo teste. O caminho serve para a renderização JSON já configurada para api/*.

## Três entradas válidas

```php
$request = $this->criarRequestNormalizada($entrada);

$this->assertNull($request->user());
$this->assertTrue($request->authorize());

$request->validateResolved();

$this->assertSame($esperado, $request->validated());
```

EntradasValidas é um provedor público/estático com três conjuntos nomeados,
cada um contendo entrada e resultado esperado. O atributo DataProvider entrega
esses dois argumentos ao método de teste. Os casos cobrem entrada comum,
normalização/extras e senha de um caractere, válida somente quanto ao formato.

AssertNull e assertTrue confirmam visitante permitido; validateResolved executa
a validação real. AssertSame compara campos, tipos e valores de validated.
O cenário com espaços exige email normalizado, senha preservada e exclusão de
remember/id do resultado validado. Não remove os campos da entrada original.

## Quatorze entradas inválidas

EntradasInvalidas fornece entrada e campos de erro esperados: email/password/
ambos ausentes; email null/array/número/vazio/malformado/longo; password null/
array/número/vazio/espaços. Dados fictícios, sem referências a contas reais.

O teste chama validateResolved dentro de try. Ao capturar ValidationException,
compara as chaves exatas de errors com os campos esperados. Depois renderiza
a exceção pelo handler existente e envolve a resposta em TestResponse:

```php
$resposta = TestResponse::fromBaseResponse(
    $this->app->make(ExceptionHandler::class)->render($request, $exception),
);

$resposta
    ->assertStatus(422)
    ->assertHeader('Content-Type', 'application/json')
    ->assertJsonValidationErrors($campos);
```

FromBaseResponse permite usar as asserções de teste na resposta montada em
memória. AssertJsonValidationErrors exige os erros nos campos informados,
sem fixar mensagens traduzidas. Essa renderização não é chamada HTTP real.
Return encerra o cenário após as asserções. Se validateResolved não recusar a
entrada, o fluxo sai do try e chega a fail, tornando a aceitação indevida uma falha.

Referências: [erros JSON nos testes Laravel](https://laravel.com/docs/13.x/http-tests#assert-json-validation-errors)
e [provedores de dados no PHPUnit 12.5](https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html#data-providers).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/LoginRequestTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginRequestTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado com nomes dos conjuntos: 17 testes/94 asserções, código 0.
Suíte completa: 88 testes/756 asserções, código 0, somando os 17/94 aos 71/662
anteriores. Nenhum código de aplicação alterado. Estes testes não exercitam
CSRF, tentativa de login, cookies ou resposta 204; ainda não há endpoint de login.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Sem mudança de ambientes, dependências, rotas, bootstrap ou OpenAPI. Auditoria,
snapshot normal e quatro contratos não foram repetidos.

## Continuidade

Testes criados, explicados e verificados; entendimento confirmado com "entendi"
em 04/11/2026; publicação pendente. Após publicar: 7.27 —
criar LoginController::store usando credenciais validadas, guard web, erro
genérico de credenciais e sucesso 204 após renovar sessão, sem registrar rota.
Limitação de tentativas terá regra própria antes de disponibilizar login completo.
