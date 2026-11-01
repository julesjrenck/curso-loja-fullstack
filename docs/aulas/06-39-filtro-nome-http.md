# Aula 6.39 — Filtro por nome e links no HTTP

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.38
com "entendi" e publicação em 90cdc350c849b6d0731e13a63aa251139bd0c01e.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.39
confirmado com "entendi" em 01/11/2026; publicação em preparação.

Uma alteração de código em backend/app/Http/Controllers/Api/V1/ProdutoController.php:
ligar os componentes preparados e manter a busca nos links de paginação.

## Controller alterado

```php
public function index(ListarProdutosRequest $request, Catalogo $catalogo): AnonymousResourceCollection
{
    $paginacao = $catalogo->paginarProdutos($request->pagina(), $request->nome());
    $paginacao->appends($request->safe()->only(['nome']));

    return ProdutoResource::collection($paginacao);
}
```

O Laravel valida o Form Request antes de executar index. Pagina fornece o inteiro
ou padrão 1; nome fornece texto normalizado ou null quando omitido. Passamos os
dois argumentos ao contrato Catalogo, cujo binding continua CatalogoEloquent.

O serviço já filtra ativos e nome antes de contar e recortar. Assim o paginator
guardado em paginacao contém itens da página e metadados do conjunto filtrado.
ProdutoResource::collection transforma cada item e preserva o envelope com
data, links e meta. A assinatura de retorno continua AnonymousResourceCollection.

## Nome nos links

```php
$paginacao->appends($request->safe()->only(['nome']));
```

Safe fornece um objeto com os dados validados; only seleciona nome como array.
Se nome foi omitido, esse array fica vazio. Page não precisa ser acrescentado
porque o paginador já gerencia o número de cada URL. Parâmetros desconhecidos
não entram nessa seleção.

Appends acrescenta os pares informados à query dos links gerados pelo paginator.
Ele não aplica filtro SQL: o filtro já foi usado ao buscar os dados. Referência:
[Laravel — parâmetros nos links de paginação](https://laravel.com/docs/13.x/pagination#appending-query-string-values).
A implementação instalada de AbstractPaginator::appends também foi consultada.

Para GET /api/v1/produtos?nome=camiseta, havendo doze correspondentes, next aponta
para uma URL equivalente a /api/v1/produtos?nome=camiseta&page=2. Ao segui-la,
o consumidor continua vendo os produtos da mesma busca. O nome também acompanha
as URLs em meta.links. A ordem dos parâmetros não tem significado para o contrato.

O nome repassado já está normalizado: '  CAMISETA  ' vira 'CAMISETA' e esse texto
é mantido nos links. Caracteres reservados e Unicode são codificados na URL e
recuperados na próxima requisição; + precisa ser representado como %2B.

## Resultado agora disponível

Nome opcional passa a funcionar pela API. Omitido mantém a listagem de ativos.
Informado e válido busca o trecho literal, ignorando caixa e distinguindo acentos
conforme a collation atual. Vazio/array/excesso continua 422/errors.nome.
Regras de page, rota individual e Blade foram preservadas.

Exemplo verificado no banco de testes: vinte ativos, doze correspondentes, mais
um inativo correspondente. Com nome=camiseta, páginas 1/2/3/1000000 retornam
10/2/0/0 itens; total 12 e última 2 em todas. Sem nome, total 20. Sem correspondência,
200/data [], total 0, última 1 e posições nulas, com nome ainda presente nos links.

O [contrato atual](../api/catalogo.md) foi atualizado para descrever esse
comportamento executável. As etapas anteriores permanecem como histórico.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/ProdutoController.php
docker compose exec -T backend php artisan test --do-not-cache-result --compact
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-639-http-filtro-nome.php
docker compose exec -T backend php < /tmp/curso-639-http-real.php
```

Sintaxe válida; suíte existente passou com 41 testes/288 asserções. Ainda sem
teste permanente novo do filtro HTTP nesta etapa; os diagnósticos são separados.

- Diagnóstico exige loja_test/loja_testes vazio e passa pelo kernel HTTP completo
  em transação. Dezenove sucessos com vazio, '0', padrão, páginas/limites/empate,
  normalização/desconhecidos, trecho no meio, sem correspondência, sem nome,
  símbolos literais, reservados/Unicode, caixa/acentos e texto SQL literal.
- Produtos exatos por IDs gerados, campos/tipos, totais, posições e bindings
  conferidos. Zero correspondências faz um COUNT; total positivo faz duas consultas.
- Links e meta.links conferidos por query decodificada: nome normalizado e page,
  desconhecidos excluídos e URLs nulas preservadas. Seguir next manteve o filtro.
- Seis inválidos mantiveram 422/JSON/message/errors e zero SQL. Individual ativo
  manteve 200, inativo 404 e seu cadastro antes do rollback. Transação desfeita.
- HTTP real por socket ao servidor normal, somente leitura: Camiseta/4990, nome
  normalizado nos links, página 2 vazia com total 1, termo inexistente com total 0,
  erros de nome/page, individual pelo ID observado e /loja HTML/produto preservados.
  Snapshot em /tmp/curso-639-http-real.json. ID 1 foi observado, não fixado no script.
- SELECTs antes/depois: teste 0 categorias/0 produtos; normal 0 categorias/1
  produto. Sem cadastro permanente. Git diff --check e links locais conferidos.

## Continuidade

Roteiro, progresso e contrato atual atualizados. Entendimento confirmado com
"entendi" em 01/11/2026; publicação em preparação. Publicar e iniciar somente 6.40: um teste
HTTP permanente da busca por nome, exigindo ativos correspondentes, total e links.
