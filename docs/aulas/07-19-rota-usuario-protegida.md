# Aula 7.19 — Rota do usuário protegida pelo Sanctum

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.18 com "entendi". Checkpoint anterior publicado e conferido em
6523c31f2123a2a396a5e8c5bc41794b6899d4d2; HEAD/origin/main/main remota iguais.
Entendimento da 7.19 confirmado com "entendi" em 04/11/2026.

## Rota e autenticação

Em [routes/api.php](../../backend/routes/api.php), importamos UsuarioController
e acrescentamos:

```php
Route::get('/usuario', [UsuarioController::class, 'show'])
    ->middleware('auth:sanctum');
```

Get registra a leitura; o array identifica classe e método que atenderão o
pedido. O prefixo api/v1 já configurado em bootstrap/app.php completa o caminho
GET /api/v1/usuario. Não repetimos o prefixo dentro do arquivo de rotas.
Route::get também registra HEAD, como nas leituras do catálogo.

Middleware associa auth somente a essa rota. Auth é o alias do middleware
Authenticate e sanctum é o parâmetro que escolhe o guard. O middleware exige
um usuário autenticado antes da ação show. Na interface própria, o fluxo será
baseado em sessão/cookie. Essa linha não cria login, usuários ou tokens.

O catálogo continua sem auth:sanctum. StatefulApi prepara a sessão das origens
reconhecidas; auth:sanctum exige autenticação na consulta privada.

Referência: [proteção de rotas do Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes).

## Ajuste inseparável no bootstrap

O primeiro diagnóstico passou com Accept: application/json, mas encontrou erro
500 com Accept: text/html: o middleware tentou calcular route('login') antes
de a exceção de autenticação chegar ao renderizador JSON. Essa rota não existe.
Para cumprir a resposta 401 JSON do contrato, acrescentamos no closure existente
de [bootstrap/app.php](../../backend/bootstrap/app.php), após statefulApi:

```php
$middleware->redirectGuestsTo(
    fn (Request $request) => $request->is('api/*') ? null : route('login'),
);
```

RedirectGuestsTo configura como o middleware obterá o destino do visitante.
A função recebe a requisição; o ternário devolve null para api/*, sem calcular
route('login') nesse ramo. Para os demais caminhos mantém a busca padrão de
login, a ser usada caso uma futura rota web seja protegida. Não criamos essa rota.

A configuração shouldRenderJsonWhen existente continua responsável por renderizar
exceções da API em JSON. As duas configurações atuam em momentos diferentes:
evitar a tentativa de redirecionamento e escolher a representação da exceção.

## Verificação pelo kernel HTTP

Após a correção, diagnóstico PHP Docker/testing criou uma aplicação por caso e
enviou Request ao kernel HTTP real do Laravel, com sessão array apenas na
instância. Não há conexão HTTP de rede. Sem Origin/Referer, cookie ou Authorization;
não usamos setUserResolver nem simulamos guard. O pipeline real inclui auth.

| Accept do visitante | Status observado | Corpo observado |
| --- | --- | --- |
| application/json | 401 | message: Unauthenticated. |
| text/html | 401 | message: Unauthenticated. |
| Ausente | 401 | message: Unauthenticated. |

Corpo dos três casos:

```json
{
  "message": "Unauthenticated."
}
```

Sete condições por caso passaram: status 401, Content-Type application/json,
somente message string sem data, ausência de Location, ação UsuarioController@show
correta na rota, auth:sanctum associado e zero SQL por listener. Código 0.
Não autenticamos usuário nem testamos sucesso 200 por sessão real. Não gravamos
sessões em disco. O diagnóstico inicial com erro foi corrigido e repetido.

## Rotas, sintaxe e suíte

```sh
docker compose exec -T backend php -l routes/api.php
docker compose exec -T backend php -l bootstrap/app.php
docker compose exec -T backend php artisan route:list --path=api/v1 -vv --no-ansi
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida nos dois arquivos. Route:list mostrou três rotas: a consulta
privada tem EnsureFrontendRequestsAreStateful, Authenticate:sanctum e bindings;
as duas leituras do catálogo continuam com Sanctum stateful/bindings, sem auth.
O diagnóstico também conferiu ausência de auth:sanctum nas rotas do catálogo.

Suíte existente: 67 testes/635 asserções, código 0, incluindo os cenários de
catálogo sem login. Não criamos teste permanente nesta etapa. SELECT posterior
confirmou loja_test/loja_testes, seis tabelas, quatro migrations/lotes 1/2/3/4 e
zero users/password_reset_tokens/sessions/produtos/categorias. Nenhuma migration,
dependência ou ambiente alterado. OpenAPI do catálogo preservado; endpoint novo
ainda não integrado nele. Auditoria/snapshot normal/quatro contratos não repetidos.

## Continuidade

Rota implementada, resposta de visitante conferida e explicação apresentada;
entendimento confirmado com "entendi" em 04/11/2026; publicação conferida em
5d6a4d8a9e642f08fe0f2b2a44139cb18f343552, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.
Após publicar: 7.20 — criar teste automatizado de visitante para
GET /api/v1/usuario, cobrindo Accept JSON, HTML e ausente para preservar 401 JSON,
antes de testar acesso autenticado ou implementar login.
