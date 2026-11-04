# Aula 7.33 — Rota de login com limite de frequência

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.32 com "entendi". Checkpoint anterior publicado e conferido em
a79946a23fcd964e7f41c8a3d79ecfca99c54214; HEAD/origin/main/main remota iguais.
Entendimento da 7.33 confirmado com "entendi" em 04/11/2026.

## Objetivo e único arquivo de aplicação

Alteramos somente [routes/api.php](../../backend/routes/api.php): import do
LoginController e registro da rota. Controller, LoginRequest e limitador já
foram estudados/verificados. Agora conectamos essas partes ao roteamento.

```php
use App\Http\Controllers\Api\V1\LoginController;

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:login');
```

Use disponibiliza o nome curto da classe. Route::post registra método POST e
caminho /login. O array indica classe e método store; o Laravel resolve o
controller pelo container e prepara a LoginRequest antes de chamar store.
O prefixo api/v1 já está em bootstrap/app.php: caminho final /api/v1/login.
Não repetimos o prefixo no arquivo de rotas.

Middleware anexa throttle com parâmetro login, nome registrado no
AppServiceProvider::boot. A regra permite cinco pedidos/IP na janela de 60s;
se esgotada, sua resposta 429 interrompe o fluxo antes da validação/controller.
Se permite, a LoginRequest valida email/password; store usa somente validated
na tentativa com guard web. Contrato: credenciais aceitas renovam sessão e
produzem 204 vazio; recusadas geram erro genérico 422 em email.

Login recebe visitantes. GET /usuario mantém auth:sanctum e só retorna dados
quando houver identidade autenticada. Catálogo e rotas anteriores preservados.

## Sessão e ordem dos middlewares

StatefulApi já está habilitado. Para origem reconhecida via Origin/Referer,
EnsureFrontendRequestsAreStateful prepara cookies/sessão/CSRF antes de seguir.
Throttle:login limita os pedidos que chegam a ele; SubstituteBindings permanece
no grupo API. Nenhuma proteção CSRF foi removida. Pedido recusado antes do
limitador não chega a consumir seu contador.

O frontend próprio deve manter o fluxo /sanctum/csrf-cookie, cookies e header
X-XSRF-TOKEN já documentado. A rota não constitui um login stateless genérico.
Fontes: [limitador aplicado à rota](https://laravel.com/docs/13.x/routing#attaching-rate-limiters-to-routes)
e [autenticação SPA/Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication).

## Verificações em Docker

```sh
docker compose exec -T backend php -l routes/api.php
docker compose exec -T backend php artisan route:list --path=api/v1 -vv --no-ansi
```

Sintaxe válida. Route:list mostrou quatro rotas API, incluindo POST api/v1/login
para LoginController@store, com EnsureFrontendRequestsAreStateful,
ThrottleRequests:login e SubstituteBindings. GET usuario continua com
Authenticate:sanctum; catálogo preservado. Listagem não faz uma tentativa de login.

Diagnóstico PHP temporário, enviado ao Docker pela entrada padrão:

```sh
docker compose exec -T -e CACHE_STORE=array -e SESSION_DRIVER=array backend \
  php /dev/stdin --env=testing < /tmp/curso-7-33-http.php
```

As opções -e valem só nesse processo. Conferimos ambiente testing, cache/sessão
array e identidade loja_test/loja_testes antes dos pedidos. Sem fixtures ou
escritas SQL. Kernel HTTP real, rota real e JSON vazio {}; Origin local
http://127.0.0.1:8002 reconhecido pelo Sanctum; relógio Carbon fixado/restaurado.

Para cada Accept (application/json, text/html e padrão do construtor), usamos IP próprio e
enviamos seis pedidos na mesma janela. Resultado por caso:

```text
422, 422, 422, 422, 422, 429
```

Cada 422 contém somente message string e errors com email/password. Cada 429
contém somente message string, Retry-After 60, limite 5/restante 0/no-store.
Todos JSON/sem Location, com sessão preparada e guard web visitante. Listener
confirmou zero consultas SQL depois da conferência de identidade. Código 0.
Os 18 pedidos verificam ligação de rota/validação/limitador pelo kernel, sem
transporte de rede ou navegador. O ambiente testing dispensa validação CSRF;
este diagnóstico não comprova o fluxo real de token/cookies do navegador.
Também não verificamos credenciais válidas ou recusadas pelo endpoint nesta etapa.

Correção registrada na 7.34: o terceiro caso foi apresentado como Accept ausente,
mas Request::create adicionou seu valor padrão. O diagnóstico da 7.33 não
comprovou ausência real. LoginApiTest da 7.34 remove explicitamente o cabeçalho,
confere presença/valor e verifica o comportamento com ausência real.

```sh
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Suíte existente: 96 testes/959 asserções, código 0. SELECT posterior confirmou
loja_test/loja_testes, seis tabelas/quatro migrations/lotes 1/2/3/4 e zero users/
password_reset_tokens/sessions/produtos/categorias. Nenhum teste permanente novo.
Não repetimos auditoria, snapshot normal ou quatro contratos de catálogo.

## Continuidade

Implementação, explicação e verificações concluídas; entendimento confirmado com
"entendi" em 04/11/2026. Contratos/registros atualizados. Apenas routes/api.php
alterado no backend; nenhuma dependência, configuração, migration ou OpenAPI.
Publicação da 7.33 concluída e conferida em
54cea249b28ebadf13cae6f17b3f8902663319e9; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.34 — criar somente
LoginApiTest para automatizar entrada inválida e bloqueio por frequência no
kernel HTTP, usando cache/sessão em memória e origem reconhecida. Sucesso de
login por HTTP e fluxo real de CSRF/cookies continuam pendentes.
