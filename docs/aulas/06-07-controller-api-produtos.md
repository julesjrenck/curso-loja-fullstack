# Aula 6.7 — Controller da API de produtos

## Objetivo e estado

Extrair a função da rota para ProdutoController@index e ligar a rota ao método.
Implementação, explicação e verificações em 22/10/2026; entendimento confirmado
pelo aluno com "entendi" em 22/10/2026.
Dois arquivos de código formam o conjunto desta etapa: controller
novo e routes/api.php. A resposta continua sendo a lista de nomes ativos ordenados.

Etapa anterior 6.6 confirmada com "entendi" em 22/10/2026 e publicada em
daffb9511b15c10f2b358658295f00f332bd17bf. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O controller

Arquivo novo backend/app/Http/Controllers/Api/V1/ProdutoController.php:

```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Catalogo;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    public function index(Catalogo $catalogo): JsonResponse
    {
        return response()->json([
            'data' => $catalogo->listarNomes(),
        ]);
    }
}
```

Namespace acompanha o caminho app/Http/Controllers/Api/V1 conforme o mapeamento
App\ do Composer. Api/V1 organiza os controllers desta versão. Essa pasta não
cria a URL: o prefixo público api/v1 continua configurado em bootstrap/app.php.
O arquivo foi criado diretamente no workspace; PHP e verificações executados
em Docker. Não foi necessário gerar novamente o autoload ou instalar pacotes.

Os imports permitem usar o contrato Catalogo, o Controller base da aplicação
e JsonResponse pelos nomes curtos. Como a classe está em um namespace mais
profundo, importamos explicitamente o Controller base.

Index é a convenção para a ação que lista uma coleção. O método público pode
ser chamado pelo Laravel quando a rota corresponder. O tipo Catalogo do
parâmetro pede a dependência ao container, que usa o binding existente em
AppServiceProvider para resolver CatalogoEloquent. Essa é injeção no método,
já vista no curso; não foi acrescentado construtor ou propriedade nesta classe.

O corpo da função anterior foi movido para index: listarNomes consulta os ativos
ordenados pelo serviço, e response()->json monta a resposta com data. O tipo
JsonResponse descreve o objeto retornado. A consulta SQL continua no serviço.

## A rota

Backend/routes/api.php agora contém:

```php
<?php

use App\Http\Controllers\Api\V1\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutoController::class, 'index']);
```

O primeiro use importa o controller novo. ProdutoController::class fornece seu
nome completo como string; não instancia o objeto. O array informa ao Laravel
qual classe e qual método devem atender à requisição. O container resolve o
controller e injeta a dependência no método ao executá-lo.

Fluxo atual:

```text
GET /api/v1/produtos -> rota -> ProdutoController@index
                    -> Catalogo/CatalogoEloquent -> Produto/SQL Server
                    -> nomes -> resposta JSON
```

A rota identifica o destino; o controller coordena consulta e resposta; o
serviço implementa a consulta. O contrato público está em docs/api/catalogo.md.
Os quatro cenários HTTP existentes verificam a resposta sem depender de a ação
estar escrita como função de rota ou método de controller.

## Verificações executadas

```bash
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/ProdutoController.php
docker compose exec -T backend php -l routes/api.php
docker compose exec -T backend php artisan route:list --path=api -vv
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
docker compose exec -T backend php < /tmp/curso-62-http.php
```

Php -l verifica sintaxe. Route:list --path=api -vv mostra o destino e o grupo
de middleware: GET|HEAD api/v1/produtos -> Api\V1\ProdutoController@index, grupo
api. --filter seleciona os cenários da API; sem filtro executamos a suíte toda.
Exec -T executa no container backend existente sem terminal interativo;
--do-not-cache-result evita gravar cache na montagem somente leitura.

Resultados, todos com código 0:

- Sintaxe válida nos dois arquivos; registro do controller e grupo api corretos.
- Classe CatalogoApiTest existente, sem alterações: 4 testes/24 asserções passaram.
- Suíte completa: 18 testes/78 asserções passaram.
- HTTP real pelo diagnóstico /tmp/curso-62-http.php: API 200/application/json e
  {"data":["Camiseta"]}; /loja 200/text/html; charset=utf-8 e item Camiseta.
  O script exige status, tipo e corpo esperado; não exibe cabeçalhos de sessão.
- SELECTs separados por /tmp/curso-62-contagens.php após a suíte/HTTP:
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

Sem migration, seeder, nova dependência ou cadastro permanente. Testes,
CatalogoEloquent, binding e configuração de prefixo preservados.

Referência oficial consultada:
[Controllers e injeção de dependências no Laravel](https://laravel.com/framework/docs/13.x/controllers).

## Continuidade

Entendimento da 6.7 confirmado. Publicar o checkpoint e iniciar somente a 6.8,
desenhando a representação JSON de
produto com id, nome e preco_em_centavos e discutir o impacto no contrato e nos
testes antes de mudar a consulta ou a serialização. Etapa de desenho documental,
sem implementar antecipadamente a nova representação.
Exercício manual sugerido no DBeaver continua sem relato.
