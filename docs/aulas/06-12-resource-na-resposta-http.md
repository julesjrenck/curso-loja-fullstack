# Aula 6.12 — ProdutoResource na resposta HTTP

## Objetivo e estado

Conectar a leitura de produtos ao resource e trocar a resposta de nomes por
objetos com ID, nome e preço, atualizando os testes e o contrato juntos.
Implementação, explicação e verificações em 23/10/2026; entendimento confirmado
pelo aluno com "entendi" em 23/10/2026, após esclarecer onde a consulta é executada.
Conjunto de código: ProdutoController.php e CatalogoApiTest.php.
Resource, serviço, interface, binding e rota existentes preservados.

Etapa anterior 6.11 confirmada com "entendi" em 23/10/2026 e publicada em
11ccc75015471663258a355445e40fe8d47a70af. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O controller

Backend/app/Http/Controllers/Api/V1/ProdutoController.php:

```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Catalogo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProdutoController extends Controller
{
    public function index(Catalogo $catalogo): AnonymousResourceCollection
    {
        return ProdutoResource::collection($catalogo->listarProdutos());
    }
}
```

Os imports novos são ProdutoResource e AnonymousResourceCollection. O primeiro
define os campos de cada produto; o segundo é o tipo do objeto devolvido por
collection(). O tipo de retorno de index foi ajustado para esse objeto, que o
Laravel converterá em resposta HTTP.

Catalogo continua sendo recebido por injeção no método. ListarProdutos usa a
implementação ligada pelo container, CatalogoEloquent, e devolve uma coleção de
models Produto ativos e ordenados. ProdutoResource::collection envolve esses
models para aplicar a transformação de cada item. Ao montar a resposta, o
Laravel usa toArray de ProdutoResource e cria o envelope externo data conforme
o padrão de resources, que não foi desabilitado na aplicação.

O controller não monta manualmente outro array data nem chama response()->json.
ToArray continua descrevendo um único produto; o envelope pertence à coleção
retornada como resposta. Fluxo:

```text
GET /api/v1/produtos -> ProdutoController@index -> Catalogo::listarProdutos
                    -> CatalogoEloquent/SQL Server -> coleção de Produto
                    -> ProdutoResource por item -> JSON com data em lista
```

Agora o resource participa efetivamente da resposta da API. A URL permanece a
mesma, e a troca para objetos está descrita no contrato ativo docs/api/catalogo.md.
ListarNomes continua atendendo à página Blade por LojaController.

## Os testes atualizados

Backend/tests/Feature/CatalogoApiTest.php conserva os quatro comportamentos:

| Cenário | Exigência atual |
| --- | --- |
| Sem produtos | 200, application/json e data: []. |
| Produto ativo | Um objeto com seu ID, nome e preço. |
| Ativo e inativo | Somente o objeto do ativo. |
| Dois ativos inseridos em ordem inversa | Objetos em ordem alfabética pelo nome. |

Nos três cenários com cadastros, os preços passaram a ser explícitos: Camiseta
4990 e Caneca 2990. As variáveis recebem o model retornado por factory()->create,
permitindo comparar com o ID realmente gerado no banco de testes. Não assumir
que esse ID seja 1, pois identidades não precisam ser reutilizadas após rollback.

Exemplo do cenário de ativo:

```php
$camiseta = Produto::factory()->create([
    'nome' => 'Camiseta',
    'status' => 'ativo',
    'preco_em_centavos' => 4990,
]);

$resposta = $this->getJson('/api/v1/produtos');

$resposta
    ->assertStatus(200)
    ->assertHeader('Content-Type', 'application/json')
    ->assertExactJson([
        'data' => [
            [
                'id' => $camiseta->id,
                'nome' => 'Camiseta',
                'preco_em_centavos' => 4990,
            ],
        ],
    ]);
```

A comparação exige os três campos e valores, sem extras. No cenário de ordenação,
cadastramos Caneca antes de Camiseta e exigimos os objetos na sequência inversa.
Os nomes dos métodos de ativo e ordenação foram ajustados de nomes para produtos.
SetUp, guardas loja_test/loja_testes e DatabaseTransactions foram mantidos.

## Verificações executadas

```bash
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/ProdutoController.php
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
docker compose exec -T backend php < /tmp/curso-612-http.php
```

Php -l verifica sintaxe; --filter seleciona os quatro cenários da API; sem filtro
roda toda a suíte. Exec -T usa o container existente sem terminal interativo;
--do-not-cache-result evita gravar cache na montagem somente leitura.

Resultados, código 0:

- Sintaxes válidas nos dois arquivos.
- Classe CatalogoApiTest: 4 testes/24 asserções passaram com objetos na resposta.
- Suíte completa: 18 testes/78 asserções passaram.
- HTTP real pelo diagnóstico novo /tmp/curso-612-http.php:

```text
GET /api/v1/produtos | HTTP/1.1 200 OK | Content-Type: application/json
Corpo JSON: {"data":[{"id":1,"nome":"Camiseta","preco_em_centavos":4990}]}
Objeto com três campos; ID inteiro positivo sem assumir valor fixo.
GET /loja | HTTP/1.1 200 OK | Content-Type: text/html; charset=utf-8
Corpo HTML contém <li>Camiseta</li>: sim
```

O diagnóstico usou file_get_contents no servidor interno porta 8000. Conferiu
200, tipo, envelope data com um item, campos exatos e valores/tipos do catálogo
atual; exigiu ID inteiro positivo sem fixá-lo em 1. Não exibiu cookies de sessão.
O ID 1 acima foi o observado nessa requisição, não um ID imposto ao teste.
O script anterior /tmp/curso-62-http.php espera o formato histórico de strings;
usar o diagnóstico da 6.12 para a representação atual.

SELECTs separados por /tmp/curso-62-contagens.php após suíte/HTTP confirmaram
loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
0 categorias/1 produto. Não houve cadastro permanente, migration, seeder ou
dependência nova. Os testes usam SQL Server real e rollback.

Referência oficial consultada:
[Coleções de resources e envelope data](https://laravel.com/framework/docs/13.x/eloquent-resources).

## Continuidade

Entendimento da 6.12 confirmado. Publicar o checkpoint e iniciar somente a 6.13,
desenhando a consulta individual
GET /api/v1/produtos/{id}, resposta 200 com um produto e 404 para inexistente ou
inativo, antes de implementar. Etapa de contrato e conceitos de recurso individual.
Exercício manual sugerido no DBeaver continua sem relato.
