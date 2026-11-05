# Aula 7.47 — Rota de logout

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.46 com "entendi". Checkpoint anterior publicado e conferido em
fc3c8e99191e4d01dce6fe9e16125923e0f7cc13; HEAD/origin/main/main remota iguais.
Entendimento da 7.47 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Alteramos somente [routes/api.php](../../backend/routes/api.php) na aplicação,
acrescentando a ligação entre rota e método já implementado:

```php
Route::post('/logout', [LoginController::class, 'destroy']);
```

Post escolhe o método HTTP. O caminho local recebe /api/v1 do apiPrefix em
[bootstrap/app.php](../../backend/bootstrap/app.php), que já carrega routes/api.php.
O caminho final é POST /api/v1/logout, localmente na porta 8002. LoginController
já estava importado; ::class produz o nome completo da classe e destroy indica
o método de instância que Laravel resolverá/chamará ao receber o pedido.

Seguindo o [contrato](../api/logout.md), não exigimos auth:sanctum nessa rota:
visitantes com sessão/CSRF válidos também devem concluir a ação. Não aplicamos
throttle:login ao logout. Login mantém seu limitador, e GET usuario mantém
auth:sanctum. Controller, bootstrap e outras rotas continuam iguais.

StatefulApi continua configurado: origens reconhecidas pelo Sanctum recebem
middleware de cookies/sessão/CSRF. A rota não oferece logout stateless ou uma
exceção de CSRF. POST expressa a alteração do estado da sessão.

## Sintaxe e rota efetiva

```sh
docker compose exec -T backend php -l routes/api.php
docker compose exec -T backend php artisan route:list --path=api/v1/logout -vv
```

PHP -l passou. Route:list filtrou o caminho e mostrou detalhes dos middleware:
uma rota POST api/v1/logout para Api\V1\LoginController@destroy, com
EnsureFrontendRequestsAreStateful e SubstituteBindings. Não há auth:sanctum
ou throttle:login na rota efetiva. Listagem código 0; não executa o endpoint.

## Diagnóstico pelo kernel HTTP

Script temporário /tmp/curso-7-47-rota-logout.php no host, não versionado,
enviado por stdin ao PHP Docker com APP_ENV testing. Cada caso criou aplicação
própria e configurou sessão/cache array somente na instância. Configuração e
identidade loja_test/loja_testes exigidas antes do pedido; DB::listen após essa
consulta confirmou nenhuma outra instrução SQL durante o diagnóstico de cada caso.
Nenhum User criado ou autenticado, sem arquivos de sessão ou cookies persistidos.

Request POST sem corpo/cookies para URL 127.0.0.1:8002 e Origin reconhecido igual.
Três casos Accept: application/json, text/html e realmente ausente. No último,
removemos explicitamente o cabeçalho padrão do construtor; presença/valor
conferidos. Kernel handle executou middleware/rota/controller; terminate
concluiu o ciclo. Nenhuma chamada de rede para o servidor habitual.

Treze condições por caso passaram: Accept exato; método/caminho POST; ação
destroy; middleware stateful/atributo sanctum ativos; sem auth/limitador login;
204; corpo vazio; sem Location; sessão array; guard visitante/ID null/chave de
login ausente; token presente; cookies de sessão/CSRF emitidos; zero SQL após
identidade. Código 0, sucesso true nos três casos.

A emissão dos cookies foi conferida pelos nomes, sem imprimir valores. Isso
não testa armazenamento/reenvio pelo navegador. Console e runningUnitTests
true conferidos: a proteção CSRF é ignorada nesse diagnóstico de testing.
Ele não comprova resposta 419, origem de navegador, CORS ou logout autenticado
pela rota. Esses controles ficam para etapas posteriores.

```sh
docker compose exec -T backend php -l < /tmp/curso-7-47-rota-logout.php
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-7-47-rota-logout.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Exec -T usa o serviço backend sem terminal interativo; redirecionamento envia
o script do host ao PHP do container. Sintaxe do script válida. Suíte existente
passou: 103 testes/1.464 asserções, código 0. Não adicionamos teste permanente
da rota nesta etapa; o diagnóstico exercitou o fluxo de visitante pelo kernel.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero categorias/produtos/users/password_reset_tokens/sessions.
Lotes convertidos para int; nenhum dado de teste permaneceu. Sem valores reais
de senha/hash/cookie/token/ID impressos ou versionados.

Git diff --check passou. Links locais válidos: logout três, login quatro,
consulta cinco, limite um, aulas 7.46/7.47 dois e três respectivamente.
Escopo conferido: somente routes/api.php e documentos; índice vazio.
Controller/testes/bootstrap/Compose/OpenAPI sem diff, OpenAPI ainda sem logout.

## Continuidade

Rota implementada, explicada e verificada; entendimento confirmado em 04/11/2026.
Ambientes, dependências, serviços, migrations, controller, bootstrap, Compose
e OpenAPI preservados. Sem auditoria/snapshot normal, logout autenticado pela
rota, GET usuario após logout, CSRF ativo de logout ou navegador/CORS.
Publicação da 7.47 concluída e conferida em
e6c30c69e682eed035e1a64e2633151d4d4d9f94; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.48 —
LogoutApiTest com visitante nos três Accept.
