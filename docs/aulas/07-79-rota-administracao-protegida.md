# Aula 7.79 — Rota administrativa protegida

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.78](07-78-controller-administracao.md) com "entendi".
Checkpoint anterior publicado e conferido em
e853f90a5f1158ad0497ff011c23827f4806f434; HEAD/origin/main/main remota iguais.
Entendimento da 7.79 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Rota e middlewares

Em [routes/api.php](../../backend/routes/api.php), importamos
AdministracaoController e registramos:

```php
Route::get('/administracao', [AdministracaoController::class, 'show'])
    ->middleware(['auth:sanctum', 'can:acessar-administracao']);
```

Get registra a consulta; o array aponta para a classe do controller e seu
método show. O prefixo api/v1 já vem de bootstrap/app.php, formando
GET /api/v1/administracao. Não repetimos esse prefixo no caminho da rota.

O array de middleware exige autenticação antes da autorização. Auth:sanctum
identifica o usuário ou encerra com 401. Can consulta o Gate pelo nome
acessar-administracao e recusa com 403 quando a identidade não tem permissão.
Se ambos passarem, o controller monta o JSON 200. Fontes:
[proteção com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [middleware de autorização](https://laravel.com/docs/13.x/authorization#via-middleware).

## Ajuste necessário no formato do 403

A primeira verificação completa encontrou os status corretos, mas o 403
incluía exception/file/line/trace porque a depuração estava ativa. Isso
descumpria o contrato, que prevê somente message. O diagnóstico informou
apenas os nomes dessas chaves, sem copiar os detalhes da exceção.

Alteramos também [bootstrap/app.php](../../backend/bootstrap/app.php), formando
com a rota o conjunto necessário para cumprir o contrato. Importamos
JsonResponse e AccessDeniedHttpException e registramos em withExceptions:

```php
$exceptions->render(function (AccessDeniedHttpException $exception, Request $request): ?JsonResponse {
    if (! $request->is('api/*')) {
        return null;
    }

    return response()->json(['message' => 'Acesso não permitido.'], 403);
});
```

O handler instalado converte a recusa padrão do Gate em AccessDeniedHttpException.
O tipo do primeiro argumento seleciona essa exceção para o callback. Request
permite limitar o tratamento a api/*. A resposta é JSON genérico com 403;
fora da API retornamos null para o Laravel seguir com o tratamento padrão.
O retorno ?JsonResponse aceita esses dois resultados.

Esse callback padroniza recusas de autorização convertidas nessa exceção nas
rotas api/*. Não desativa a depuração nem altera autenticação, outras classes
de erro ou o Gate. O shouldRenderJsonWhen existente foi mantido.
Referência: [renderização de exceções](https://laravel.com/docs/13.x/errors#rendering-exceptions).

## Verificação pelo kernel HTTP

O diagnóstico criou uma aplicação Laravel nova para cada cenário, ambiente
testing/configuração sem cache/sqlsrv/loja_test. Vinculou a Request à aplicação
antes de preparar o guard. Sessão/cache foram array apenas no processo;
qualquer SQL na conexão padrão estava bloqueado e PDO permaneceu fechado.

Para cliente e administrador, User em memória recebeu ID fictício e indicador
bruto zero/um; Auth::guard('web')->setUser preparou o contexto do diagnóstico.
Não houve login por credenciais ou persistência desses objetos. O visitante
ficou sem usuário. Kernel::handle atravessou a rota e os middlewares reais.

| Cenário | Status observado | Corpo verificado |
| --- | --- | --- |
| Visitante, debug ligado | 401 | Somente message string |
| Cliente, debug ligado | 403 | Somente message: Acesso não permitido. |
| Administrador, debug ligado | 200 | Objeto data/mensagem exato do contrato |
| Cliente, debug desligado | 403 | O mesmo objeto message |

Seis controles por cenário passaram, total 24: status, Content-Type JSON,
ausência de Location, corpo do contrato, zero SQL e PDO não aberto. Código 0.
Outro diagnóstico de renderização, em memória e fora de api/*, confirmou 403
e mensagem original preservados; dois controles passaram, código 0.

O primeiro programa de diagnóstico havia parado ao preparar o guard sem
Request vinculada. Corrigimos somente sua preparação antes da execução
completa; essa tentativa interrompida não comprova os cenários. Depois foi
identificada e corrigida a diferença real do corpo 403 descrita acima.

As verificações finais atravessam o kernel HTTP, mas não usam rede, navegador,
cookies transportados ou usuário persistido. Não comprovam login administrativo
real. Saída somente status/booleanos e nomes públicos de chaves; nenhum dado
privado, senha/hash ou valor de cookie copiado. Diagnósticos pela entrada padrão,
sem arquivos auxiliares persistidos ou alteração de arquivos de ambiente.

## Comandos e resultados

```sh
docker compose exec -T backend php -l /app/routes/api.php
docker compose exec -T backend php -l /app/bootstrap/app.php
docker compose exec -T backend php artisan route:list --path=api/v1/administracao -vv --no-ansi
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec -T usa o backend sem terminal interativo. Php -l confere sintaxe; ambos
passaram. Route:list restringe ao caminho indicado e -vv expande middlewares.
Confirmou GET|HEAD para AdministracaoController@show com EnsureFrontendRequestsAreStateful,
Authenticate:sanctum, SubstituteBindings e Authorize:acessar-administracao.
Essa listagem não é uma requisição HTTP.

Artisan test executa a suíte configurada; compact reduz saída, do-not-cache-result
evita cache no código readonly e colors=never remove cores. Suíte completa
atual: 112 testes/1.618 asserções passaram, código 0. Não criamos testes
permanentes nesta etapa; a verificação da rota foi pelo diagnóstico focado.

## Continuidade

[Contrato](../api/administracao.md) atualizado para os resultados do kernel e
a mensagem genérica do 403. OpenAPI continua sem a operação, para etapa própria.
User/Gate/controller, banco normal e contas não foram alterados.

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.80 — criar testes HTTP
permanentes da consulta administrativa, cobrindo 401/403/200 e formato JSON
do 403 com depuração ligada, usando usuários em memória e SQL bloqueado.
Módulos 8 a 23 não iniciados.
