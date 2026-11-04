# Aula 7.18 — Controller da consulta do próprio usuário

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.17 com "entendi". Checkpoint anterior publicado e conferido em
8cceb303214e66f63cfb3c6ed4a5cf4cecc5733d; HEAD/origin/main/main remota iguais.
Entendimento da 7.18 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos [UsuarioController](../../backend/app/Http/Controllers/Api/V1/UsuarioController.php)
com uma ação show. Ela recebe a requisição e entrega o usuário associado a ela
à [UsuarioResource](../../backend/app/Http/Resources/UsuarioResource.php), que
seleciona os campos do [contrato planejado](../api/autenticacao.md).
Arquivo escrito pelo editor, sem gerador Artisan.

```php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(Request $request): UsuarioResource
    {
        return new UsuarioResource($request->user());
    }
}
```

O namespace acompanha a organização Api/V1 de ProdutoController. Os imports
trazem o controller base da aplicação, o Resource da 7.17 e Request do Laravel.
Extends segue a estrutura dos controllers existentes. Public permite que o
framework chame show, nome convencional para consultar um recurso individual.

Request $request declara o objeto esperado pelo método; quando a rota existir,
o Laravel fornecerá a requisição atual por injeção de dependência. O retorno
: UsuarioResource declara que a ação devolve esse tipo de objeto.

$request->user() obtém o usuário resolvido pela autenticação. Não lê um campo
user, id ou email enviado pelo cliente. New UsuarioResource(...) envolve esse
objeto para controlar sua representação; o controller não monta manualmente
o JSON nem o envelope data. Não precisamos buscar User por um ID da URL.

Referência: [usuário autenticado pela Request e injeção no controller](https://laravel.com/docs/13.x/authentication#retrieving-the-authenticated-user).

## Papel da futura proteção

Este método pressupõe uma requisição autenticada. A rota que criaremos na 7.19
terá auth:sanctum, que deverá interromper o visitante antes da ação e produzir
401 JSON pela configuração existente. O controller não faz login e não verifica
senha. Sem autenticação, user() pode devolver null; criar o controller sozinho
não protege uma rota nem implementa a resposta 401.

Nenhuma rota foi registrada nesta aula. O arquivo routes/api.php continua com
apenas as duas leituras públicas do catálogo.

## Diagnóstico em memória

PHP Docker/testing, aplicação inicializada e listener SQL. Instanciamos o
controller e construímos dois Users não persistidos com setRawAttributes:
Ana/ID 42 e Bruno/ID 73, nomes/e-mails e senha/token todos fictícios. Nenhum
cast de hash ou cadastro foi executado.

Para cada User, criamos um Request GET ilustrativo com Accept JSON e query
id=999&email=outro@example.test. Somente no diagnóstico, setUserResolver recebeu
uma função que devolve o User daquela rodada. Isso simula o resultado já
resolvido; não testa guard, cookie, sessão ou middleware de autenticação.

```php
$request->setUserResolver(fn ($guard = null) => $usuario);
$resource = $controller->show($request);
$response = $resource->toResponse($request);
```

Oito condições passaram em cada rodada: tipo UsuarioResource, mesmo objeto
User recebido pelo Resource, resolver chamado uma vez, status 200, Content-Type
application/json, JSON exato com data/id/name/email daquele User, atributos
originais e exists false preservados, zero SQL. Os parâmetros enviados não
escolheram outro usuário. A lista de rotas também confirmou api/v1/usuario
ausente. Código 0, sem HTTP real, sessão ou valores privados impressos.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/UsuarioController.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

O primeiro verifica a sintaxe do arquivo; o segundo executa a suíte existente
sem cache de resultados. Sintaxe válida; 67 testes/635 asserções passaram,
código 0. Controller novo exercitado pelo diagnóstico; nenhum teste permanente
novo. SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro
migrations/lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/
categorias. Não aplicamos migrations nem alteramos dependências ou ambientes.
Auditoria, snapshot normal e quatro contratos não foram repetidos.

## Continuidade

Controller criado e explicado; rota/login ainda ausentes. Entendimento
confirmado com "entendi" em 04/11/2026; publicação pendente.
Após publicar: 7.19 — registrar GET /api/v1/usuario apontando para
UsuarioController::show com auth:sanctum e verificar 401 JSON para visitante,
mantendo o catálogo público, antes de implementar login.
