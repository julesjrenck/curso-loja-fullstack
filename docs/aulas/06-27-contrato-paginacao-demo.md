# Aula 6.27 — Paginação no contrato Catalogo e na demonstração em memória

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.26 em 407e9a57cdd3c577f74f26c157904043d039bbc5. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.27 confirmado
pelo aluno com "entendi" em 30/10/2026. Dois arquivos de aplicação alterados como um conjunto
inseparável: contrato Catalogo e CatalogoDemonstracao. Ainda sem ligação à rota.

## Contrato

Em backend/app/Contracts/Catalogo.php, acrescentado o import:

```php
use Illuminate\Pagination\LengthAwarePaginator;
```

E a declaração:

```php
/**
 * @return LengthAwarePaginator<int, Produto>
 */
public function paginarProdutos(int $pagina): LengthAwarePaginator;
```

A interface exige o método e seus tipos; não contém implementação. O parâmetro
é inteiro e o retorno é um LengthAwarePaginator. O PHPDoc descreve itens Produto
com chaves inteiras. Assim, quem recebe Catalogo pode chamar a paginação sem
depender do nome de uma implementação concreta. CatalogoEloquent já possui esse
método desde a 6.26. A demo precisa atender à nova exigência no mesmo conjunto
de alterações para continuar implementando Catalogo.

## Demonstração

Em backend/app/Services/CatalogoDemonstracao.php, acrescentado o mesmo import e:

```php
/**
 * @return LengthAwarePaginator<int, Produto>
 */
public function paginarProdutos(int $pagina): LengthAwarePaginator
{
    $produtos = $this->listarProdutos();

    return new LengthAwarePaginator(
        $produtos->forPage($pagina, 10)->values(),
        $produtos->count(),
        10,
        $pagina,
        [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ],
    );
}
```

ListarProdutos monta a coleção existente com Calça/ID 2/12990,
Camiseta/ID 1/4990 e Tênis/ID 3/19990, na ordem já definida. Todos são models
ativos em memória; nenhum save ou create é executado. Os valores e os outros
métodos foram preservados.

ForPage($pagina, 10) é um método da coleção: recorta os itens correspondentes
à página, com até dez por página. Values reorganiza as chaves a partir de zero;
isso prepara índices sequenciais para a lista. Esses métodos trabalham com a
coleção em memória. No Eloquent da 6.26, paginate faz o recorte na consulta SQL.

O construtor recebe, em ordem: itens da página, total da coleção original,
tamanho 10, página atual e opções. Count deve usar a coleção inteira, pois a
quantidade de itens da página pode ser menor que o total. Com três produtos,
page 1 tem três itens e page 2 tem zero; em ambas, total é 3 e última página é 1.

Path usa o endereço atual sem a query string para gerar as URLs; resolveCurrentPath
é herdado do paginador base. PageName define o nome page nos links. A página
atual é passada explicitamente por $pagina, como no serviço Eloquent.

O retorno tem o mesmo tipo do Eloquent. Quando integrado ao HTTP, a coleção de
ProdutoResource poderá serializar qualquer uma das implementações. O binding
em AppServiceProvider continua Catalogo -> CatalogoEloquent; a demo não foi
ativada na aplicação. Controller continua chamando listarProdutos e a API
segue sem paginação/validação de page. Form Request e rota foram preservados.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Contracts/Catalogo.php
docker compose exec -T backend php -l app/Services/CatalogoDemonstracao.php
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-627-contrato-paginacao.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l verifica sintaxe. APP_ENV=testing seleciona o banco exclusivo para a
consulta Eloquent do diagnóstico. O redirecionamento envia o script temporário
ao PHP do container. O script confere loja_test/loja_testes, assinatura por
Reflection e o tipo resolvido por Catalogo. Cria uma requisição sintética com
page=99 e informa 1/2 explicitamente aos métodos, verificando a página recebida.

- Sintaxes válidas e implementações compatíveis com o contrato ampliado.
- Demo: páginas 1/2 com 3/0 itens, tamanho 10, total 3 e última 1. Models ativos
  com exists false e IDs/nomes/preços previstos conferidos antes da serialização.
- ProdutoResource::collection(...)->toResponse(...) conferiu 200/application/json,
  data em lista com valores exatos, meta e links first/last/prev/next. Caminho
  local correto, página explícita respeitada e zero SQL da demo observado.
- ListarNomes e buscarProduto da demo preservados.
- Binding continua CatalogoEloquent; paginarProdutos(1) no serviço resolvido por
  Catalogo retornou paginator vazio do banco de testes, com um COUNT parametrizado
  por ativo. Somente leitura, sem novas fixtures ou transação nesta etapa.
- Suíte existente: 27 testes/133 asserções passaram. Sem teste permanente novo
  de contrato/demo nesta etapa; cenários novos estão no diagnóstico temporário.
- SELECTs separados antes/depois por /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.
- Git diff --check passou.

Diagnóstico direto dos objetos e da serialização, sem kernel/rota/socket.
Não comprova integração HTTP futura. Sem cadastro permanente, migration ou
dependência nova.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
431fced2fbb03b5e1e053961deac7f6860ed49d4, `feat: declara paginação no contrato do catálogo`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem incluir o SHA no próprio commit.
Continuidade realizada na 6.28: integrar ListarProdutosRequest/paginarProdutos
em ProdutoController@index e adaptar os quatro testes de listagem e contrato
ativo ao JSON paginado, preservando show.
