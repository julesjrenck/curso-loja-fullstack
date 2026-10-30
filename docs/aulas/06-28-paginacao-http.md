# Aula 6.28 — Paginação e validação de page na resposta HTTP da listagem

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.27 em 431fced2fbb03b5e1e053961deac7f6860ed49d4. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.28 confirmado
pelo aluno com "entendi" em 30/10/2026. Controller e quatro testes de listagem alterados como
conjunto inseparável; contrato ativo atualizado junto com o formato HTTP.

## Controller e fluxo da requisição

Em backend/app/Http/Controllers/Api/V1/ProdutoController.php, importado
App\Http\Requests\ListarProdutosRequest e alterado index:

```php
public function index(ListarProdutosRequest $request, Catalogo $catalogo): AnonymousResourceCollection
{
    return ProdutoResource::collection($catalogo->paginarProdutos($request->pagina()));
}
```

O controller recebe duas dependências pelo container. ListarProdutosRequest é
resolvido e validado antes da execução de index: authorize permite a leitura
pública, rules confere page, e pagina() fornece o inteiro ou padrão 1.
Se a validação falha, index não executa; o tratamento de exceção existente
produz 422 JSON com message/errors.page para a rota de API.

Catalogo continua sendo resolvido para CatalogoEloquent pelo binding existente.
PaginarProdutos recebe a página validada, filtra ativos, ordena nome/ID e busca
até dez registros, além da contagem total. ProdutoResource::collection transforma
os produtos e o Laravel usa o paginador para acrescentar links/meta ao JSON.
O retorno do método continua AnonymousResourceCollection.

O caminho GET /api/v1/produtos foi preservado; agora ?page=2 é utilizado.
Regras e tipos dos arquivos preparados nas 6.24–6.27 não foram modificados.
Show, rota individual, resource, serviços, contrato interno e binding preservados.
ListarNomes continua atendendo à página Blade.

## Entrada e saída agora implementadas

- Page ausente: página 1. Inteiro decimal positivo sem sinal/zero inicial,
  entre 1 e 1000000, avaliado após a normalização de entrada do Laravel.
- Até dez ativos por página. Resposta de sucesso com data, links e meta.
- Data contém somente a página atual e os três campos de produto conhecidos.
- Links fornece URLs; meta contém total, tamanho, página atual, última página,
  posições e navegação gerada pelo paginador.
- Catálogo vazio ou página válida após a última: 200 com data [], from/to null.
- Page inválido: 422/application/json com message/errors.page; textos livres.
- Consulta individual indisponível continua 404, conforme contrato anterior.

O contrato completo executável está em [docs/api/catalogo.md](../api/catalogo.md),
incluindo exemplo observado no servidor. A partir desta etapa, consumidores
precisam navegar pelas páginas para obter todos os ativos.

## Testes adaptados

Backend/tests/Feature/CatalogoApiTest.php importa Illuminate\Testing\TestResponse
e mantém os mesmos quatro cenários de listagem: vazio, ativo, omitir inativo e
ordem alfabética. Fixtures continuam explícitas e com IDs reais. Agora cada um
chama o helper privado assertPaginaUnica, pois todos têm até dois ativos:

```php
private function assertPaginaUnica(TestResponse $resposta, array $produtos): void
{
    $total = count($produtos);
    $url = url('/api/v1/produtos');

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonPath('data', $produtos)
        ->assertJsonPath('links', [
            'first' => $url.'?page=1',
            'last' => $url.'?page=1',
            'prev' => null,
            'next' => null,
        ])
        ->assertJsonPath('meta.current_page', 1)
        ->assertJsonPath('meta.per_page', 10)
        ->assertJsonPath('meta.total', $total)
        ->assertJsonPath('meta.last_page', 1)
        ->assertJsonPath('meta.from', $total === 0 ? null : 1)
        ->assertJsonPath('meta.to', $total === 0 ? null : $total);
}
```

Private mantém o helper dentro da classe; seu nome não começa com test e ele
não é uma execução independente. Recebe a resposta do getJson e a lista exata
de produtos esperados. Count calcula o total esperado dessas fixtures, que
cabem em uma página. Url monta a base do ambiente de teste.

AssertJsonPath usa caminhos no JSON, por exemplo meta.total para o campo total
dentro de meta. Para data, compara a lista completa, incluindo todos os campos,
tipos e ordem dos produtos. Para links, compara o objeto de navegação inteiro.
Os metadados são conferidos separadamente; rótulos localizáveis de meta.links
não são fixados. O vazio exige total 0 e from/to null; preenchidos, posições
de 1 até o total. A assinatura de assertJsonPath foi conferida na fonte instalada.

Assim os testes acompanham os novos metadados mantendo a exigência de produtos
corretos. Os nove casos individuais, setUp, identidade e DatabaseTransactions
foram preservados. Testes permanentes específicos de página 2 e validação 422
entrarão nas próximas etapas; nesta etapa foram verificados por diagnóstico.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/ProdutoController.php
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-628-http-paginacao.php
docker compose exec -T backend php artisan test --do-not-cache-result
docker compose exec -T backend php < /tmp/curso-628-http-real.php
```

Php -l verifica sintaxe; --filter seleciona a classe da API e sem filtro executa
a suíte completa. --do-not-cache-result evita cache no código montado somente
para leitura. Redirecionamentos enviam scripts temporários ao PHP do container;
APP_ENV=testing seleciona o ambiente exclusivo para o diagnóstico com fixtures.

- Sintaxes válidas; classe 13 testes/107 asserções e suíte 27 testes/161 asserções
  passaram. Mesma quantidade de testes; 28 asserções novas de paginação.
- Diagnóstico pelo kernel HTTP exige loja_test/loja_testes antes de abrir
  transação. Passa por rota, middleware, Form Request, controller, contrato,
  Eloquent/SQL Server e resource. Finally faz rollback das fixtures.
- Conferiu vazio e padrão 1. Com onze ativos e um inativo, empate nas posições
  10/11 por ID: page=1/2/3/1000000 devolvem 10/1/0/0 itens, total 11, última 2,
  posições/links/metadados corretos. Vazio faz um COUNT, demais páginas duas
  consultas com status ativo parametrizado.
- Onze entradas inválidas: vazio, 0, -1, 1.5, 01, abc, array, +1 codificado,
  1e3, 1000001 e PHP_INT_MAX.'0'. Todas geraram 422/application/json,
  message/errors.page com um erro e zero SQL.
- Individual ativo manteve 200/data objeto, inativo manteve 404/message e seu
  cadastro antes do rollback. Transação encerrada e zero produtos no teste.
- Diagnóstico real conecta por socket à porta 8000 dentro do backend, usando
  Host 127.0.0.1:8002 para conferir URLs da porta exposta. Somente leitura no
  ambiente normal: listagem paginada/Camiseta/4990, page=2 vazia, individual pelo
  ID obtido da lista, page=0 com 422 e /loja 200/text/html com Camiseta.
  ID 1 foi observado, não fixado na verificação. Snapshot temporário em
  /tmp/curso-628-http-real.json forneceu o exemplo do contrato ativo.
- SELECTs separados antes/depois por /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.
- Git diff --check passou.

Kernel HTTP no teste e conexão por socket foram conferidos separadamente.
Sem cadastro permanente, migration, configuração ou dependência nova.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
ed21a330288ff3af17d777e1bbcb53e95016e90b; HEAD/origin/main/main remota coincidiram
após push. Continuidade realizada na [aula 6.29](06-29-teste-segunda-pagina.md),
com um teste permanente da segunda página.
