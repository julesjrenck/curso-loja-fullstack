# Aula 6.48 — Testes de acentos e caixa na busca por nome

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.47
com "entendi" e publicação em 716032b43e3cd2fb2eb0543210c2cf0b961e38bd.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.48
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Objetivo e configuração existente

Verificar pelo HTTP a regra de comparação de nomes já documentada. A coluna
usa SQL_Latin1_General_CP1_CI_AS no projeto. CI indica comparação sem diferença
entre maiúsculas/minúsculas; AS distingue caracteres acentuados dos não acentuados.
Essas opções são explicadas na
[documentação Microsoft](https://learn.microsoft.com/en-us/sql/relational-databases/collations/collation-and-unicode-support/).

Criamos dois produtos ativos: Kit de tenis, preço 4990, e Kit de tênis, preço
5990 centavos. Os dois existem em cada execução. Se a comparação passar a
ignorar acentos, a busca retornará dois objetos e o teste falhará.

## Provider e expectativa independente da consulta

Conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: método
test_distingue_acentos_e_ignora_caixa_na_busca_por_nome, atributo DataProvider
e provider público estático buscasComAcentos:

```php
return [
    'sem acento em minúsculas' => ['tenis', 'sem acento'],
    'sem acento em maiúsculas' => ['TENIS', 'sem acento'],
    'com acento em minúsculas' => ['tênis', 'com acento'],
    'com acento em maiúsculas' => ['TÊNIS', 'com acento'],
];
```

Cada linha fornece os argumentos string $nome e string $chaveEsperada.
As chaves externas nomeiam os casos no relatório. No teste, $produtos é um
array associativo: sem acento aponta para o model Kit de tenis e com acento
para Kit de tênis. Ambos vêm de factories com nome, status e preço explícitos.

```php
$esperado = $produtos[$chaveEsperada];
```

A linha seleciona o model esperado nas fixtures. Não usa o catálogo ou uma
nova consulta para descobrir a resposta. A expectativa de data contém apenas
seu ID gerado, nome e preço. Comparar a lista inteira verifica que o outro
produto não apareceu.

## Requisição, links e metadados

```php
$resposta = $this->getJson('/api/v1/produtos?'.http_build_query(['nome' => $nome]));
$url = url('/api/v1/produtos').'?'.http_build_query([
    'nome' => $nome,
    'page' => 1,
]);
```

Http_build_query codifica a entrada e os links esperados, incluindo o acento.
GetJson executa o GET pelo fluxo HTTP da aplicação de teste, pedindo JSON.

Cada resposta deve ter 200/application/json, único objeto completo, total 1,
current_page 1, per_page 10, last_page 1 e from/to 1. First/last devem ser $url;
prev/next, null.

Ignorar caixa na comparação não significa converter o parâmetro para minúsculas.
O link de uma busca por TÊNIS deve preservar TÊNIS, e o nome do produto retornado
continua Kit de tênis. O teste verifica essas duas representações separadamente.

ListarProdutosRequest, ProdutoController, CatalogoEloquent e ProdutoResource
permanecem como estavam; nenhuma collation foi alterada. Este teste observa
resultados HTTP, sem medir SQL ou acrescentar asserções meta.links. Os quatro
casos não representam cobertura de todas as equivalências Unicode.

## Verificações e isolamento

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica sintaxe; --filter seleciona a classe; a última execução inclui
a suíte inteira. --do-not-cache-result evita escrita de cache na montagem de
código. Sintaxe válida, classe com 52 testes/540 asserções e suíte com 66
testes/594 asserções: quatro casos e 52 asserções a mais que na 6.47.

SetUp confere loja_test/loja_testes e limpa produtos dentro da transação.
DatabaseTransactions desfaz as alterações. SELECTs antes/depois por
/tmp/curso-618-contagens.php: teste com 0 categorias/0 produtos e normal com
0 categorias/1 produto. Git diff --check e links locais conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação em preparação.
Publicar e iniciar somente 6.49: teste permanente de
preservação do filtro em meta.links, sem fixar rótulos traduzidos.
