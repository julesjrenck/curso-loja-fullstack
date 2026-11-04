# Aula 7.34 — Testes de entrada inválida e limite pela rota de login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.33 com "entendi". Checkpoint anterior publicado e conferido em
54cea249b28ebadf13cae6f17b3f8902663319e9; HEAD/origin/main/main remota iguais.
Entendimento da 7.34 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginApiTest.php](../../backend/tests/Feature/LoginApiTest.php),
transformando o diagnóstico anterior em cobertura permanente da rota real.
O teste passa pelo kernel HTTP, roteamento, middleware nomeado e LoginRequest.
Verifica entrada vazia/422 e excesso/429; não chama o controller diretamente.

Imports trazem contrato Kernel, Request, Carbon, TestResponse, DataProvider e
TestCase do projeto. A classe estende TestCase para carregar a aplicação de
testes e disponibilizar asserções/controle do relógio.

## Preparação e isolamento

SetUp chama parent, exige cache.default e session.driver array e fixa o horário
com travelTo/Carbon. Cada execução recebe sua aplicação e cache em memória.
Não mexemos nos contadores file ou nas sessões file do ambiente normal.
TearDown chama travelBack e parent para restaurar relógio e encerrar aplicação,
inclusive quando uma asserção falha. Não esperamos um minuto real.

Não há fixture, escrita de usuário, actingAs ou trait de banco neste arquivo.
Os pedidos falham na validação antes da tentativa de autenticação ou são
barrados pelo limitador. A suíte continua configurada para loja_test.

## Provedor e cinco respostas de validação

DataProvider formatosAccept fornece application/json, text/html e null.
Null representa ausência real, preparada no helper. Um método com três
conjuntos resulta em três execuções PHPUnit e 18 pedidos ao kernel.

```php
for ($pedido = 1; $pedido <= 5; $pedido++) {
    $resposta = $this->pedir($accept);

    $resposta
        ->assertStatus(422)
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeaderMissing('Location')
        ->assertJsonValidationErrors(['email', 'password']);
}
```

O corpo enviado é {}. Em cada uma das cinco respostas, também exigimos somente
message string/errors e exatamente email/password como campos de erro, mantendo
o guard web visitante. Não fixamos tradução ou texto das mensagens.
As cinco respostas 422 demonstram que o limitador deixa seguir dentro da
capacidade e que o endpoint realmente chega à validação.

## Sexto pedido

Depois do laço, pedir é chamado uma sexta vez com mesmo IP e relógio. A resposta
deve ser 429 JSON, sem Location, Retry-After 60, X-RateLimit-Limit 5 e
X-RateLimit-Remaining 0. Exigimos somente message string, diretiva no-store
e visitante. O corpo não contém errors da validação: o limitador interrompe
o pedido antes dela. As entradas inválidas anteriores consumiram o limite.

## Helper, origem e correção de Accept ausente

Pedir recebe ?string e retorna TestResponse. Prepara REMOTE_ADDR 127.0.0.1,
CONTENT_TYPE application/json e HTTP_ORIGIN http://127.0.0.1:8002. Request::create
recebe URL completa, POST, parâmetros/cookies/arquivos vazios, servidor e corpo
{}. A origem é reconhecida pela configuração local do Sanctum.

O construtor instalado coloca um Accept padrão quando o omitimos. Um diagnóstico
com autoload apenas comprovou has=true e valor text/html,application/xhtml+xml,
application/xml;q=0.9,*/*;q=0.8. Até HTTP_ACCEPT null deixa has=true com valor null.
Por isso removemos a entrada explicitamente no caso ausente:

```php
if ($accept === null) {
    $request->headers->remove('Accept');
} else {
    $request->headers->set('Accept', $accept);
}
```

Duas asserções conferem presença e valor antes de cada pedido, para garantir que
os três casos realmente diferem como declarado. Corrigimos o registro da 7.33:
seu terceiro diagnóstico tinha o padrão do construtor, não ausência real.
O helper de LoginRateLimiterTest da 7.31 possui a mesma omissão; sua correção
fica registrada como próximo passo, sem alterar um segundo arquivo de teste aqui.

```php
$kernel = $this->app->make(Kernel::class);
$resposta = $kernel->handle($request);
$kernel->terminate($request, $resposta);
```

Make resolve o kernel HTTP; handle executa a cadeia real da aplicação;
terminate completa o ciclo dos middlewares termináveis. Conferimos hasSession
após cada pedido: sessão foi preparada pelo fluxo de origem reconhecida.
TestResponse::fromBaseResponse envolve a resposta e a requisição para as asserções.
Nenhuma rota ou middleware substituído/desativado manualmente pelo teste.

Esses pedidos não usam rede ou navegador. Testing dispensa a validação CSRF;
o teste não comprova transporte real de cookies/tokens ou sucesso do login.
Referências: [testes HTTP Laravel](https://laravel.com/docs/13.x/http-tests#making-requests)
e [controle do tempo nos testes](https://laravel.com/docs/13.x/mocking#interacting-with-time).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/LoginApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado: 3 testes/267 asserções, código 0. Suíte completa:
99 testes/1.226 asserções, código 0, somando 3/267 aos 96/959 anteriores.
SELECT posterior: loja_test/loja_testes, seis tabelas, quatro migrations/lotes
1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Não repetimos auditoria, snapshot normal ou os quatro contratos de catálogo.

## Continuidade

Teste criado, explicado e verificado; entendimento confirmado com "entendi" em 04/11/2026.
Documentos/contratos atualizados; nenhum arquivo de aplicação/configuração/
dependência/migration/OpenAPI alterado. Publicação da 7.34 concluída e conferida
em 019c99ba9793a14d8adbded0ad910fb4754746b1; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.35 —
corrigir somente o caso Accept ausente no
helper de LoginRateLimiterTest, removendo o cabeçalho padrão e verificando a
entrada antes do middleware. Sucesso do login por HTTP e fluxo real de
CSRF/cookies continuam pendentes para etapas seguintes.
