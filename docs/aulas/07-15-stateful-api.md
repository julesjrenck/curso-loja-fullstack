# Aula 7.15 — Requisições stateful na API

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.14 com "entendi". Checkpoint anterior publicado e conferido em
601c10350871d186c2b8a73b24f52586f64de50c; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.15 confirmado com "entendi" em 04/11/2026.

## Objetivo e alteração

Em [bootstrap/app.php](../../backend/bootstrap/app.php), substituímos somente
o comentário da configuração de middlewares por uma chamada:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->statefulApi();
})
```

A função recebe o objeto de configuração Middleware do Laravel. statefulApi
habilita a inclusão de EnsureFrontendRequestsAreStateful no grupo api.
Esse middleware decide quando preparar sessão/cookies/CSRF para requisições
reconhecidas como da interface própria. Stateful aqui se refere ao uso desse
estado de sessão entre requisições.

| Grupo api antes | Grupo api depois |
| --- | --- |
| SubstituteBindings | EnsureFrontendRequestsAreStateful, depois SubstituteBindings |

Essa chamada não exige login nas rotas. auth:sanctum continua sendo a peça
que aplicaremos a endpoints protegidos. As duas leituras existentes do
[catálogo](../../backend/routes/api.php) permanecem públicas.

## Como a interface é reconhecida

Conferimos os trechos relevantes de EnsureFrontendRequestsAreStateful e a
configuração do Sanctum v4.3.3 instalado. O reconhecimento usa Referer e, na
sua ausência, Origin, comparando o endereço com sanctum.stateful. Portas
importam nessa comparação. Ainda não publicamos um arquivo config/sanctum.php;
usamos os padrões do pacote, mesclados pelo provider.

A origem http://127.0.0.1:8002 já é reconhecida na configuração atual, que
inclui a URL da aplicação via currentApplicationUrlWithPort. Usamos essa URL
local para a demonstração. Os endereços concretos da futura interface e CORS
serão configurados quando essa integração for utilizada.

Referência: [configuração SPA do Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication).

## Diagnóstico em memória

Para cada caso, um diagnóstico PHP no Docker criou aplicação/kernel e uma
requisição GET ilustrativa para /api/v1/produtos, com Accept application/json.
Alterou session.driver para array somente naquela instância de diagnóstico,
sem mudar arquivos ou o driver file do ambiente normal. Assim não gravou
sessões em disco.

Chamamos fromFrontend e o middleware instalado, usando uma próxima função
que apenas observa o pedido e devolve uma resposta simples. Ela não chama
o controller do catálogo. Conferimos marcador sanctum, sessão anexada/iniciada,
token CSRF presente, nomes de cookies e estado do guard web. Nenhum valor
privado foi impresso.

| Caso construído | Reconhecido? | Sessão e cookies preparados? | Guard web autenticado? |
| --- | --- | --- | --- |
| Sem Origin/Referer | Não | Não | Não |
| Origin: http://127.0.0.1:8002 | Sim | Sim | Não |
| Referer: http://127.0.0.1:8002/loja | Sim | Sim | Não |
| Origin: https://origem-nao-confiavel.example | Não | Não | Não |

Nos dois casos reconhecidos, apareceram XSRF-TOKEN e loja-fullstack-session,
com sessão iniciada e token presente. Nos demais, o middleware não acrescentou
essa preparação. Todos os resultados corresponderam às expectativas, código 0;
listeners contaram zero SQL nos quatro casos.

Reconhecimento de origem não autentica o usuário. Origem não reconhecida também
não significa recusa automática de acesso ao catálogo público: o diagnóstico
verifica preparação de sessão, não uma regra de autorização ou CORS.
São cabeçalhos construídos em memória, não testes de comportamento do navegador.

## Sintaxe, rotas e suíte

```sh
docker compose exec -T backend php -l bootstrap/app.php
docker compose exec -T backend php artisan route:list --path=api/v1 -vv --no-ansi
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Route:list mostrou as duas rotas com EnsureFrontendRequestsAreStateful
antes de SubstituteBindings, sem auth:sanctum. A suíte existente passou com
67 testes/635 asserções, código 0. Não criamos testes permanentes nesta etapa.

Consultas após a suíte confirmaram loja_test/loja_testes com seis tabelas,
quatro migrations/lotes 1/2/3/4 e zero users/tokens/sessions/produtos/categorias.
Nenhuma dependência, rota, model ou migration foi alterada. Snapshot normal,
auditoria e quatro contratos não foram repetidos. Última auditoria continua
a 7.12, código 0; as versões permaneceram como estavam.

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.16 — desenhar o contrato de GET /api/v1/usuario para consultar o usuário
autenticado, incluindo sucesso e resposta ao visitante, antes de criar a rota
ou implementar login. Alteração explicada/verificada e entendimento confirmado.
Checkpoint publicado e conferido em
46742792a5ec9f4015f54a2eb55afe6fae53445f; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.
