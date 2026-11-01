# Aula 6.45 — Teste permanente de busca sem correspondência

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.44
com "entendi" e publicação em 2adfac2afde138762e3549503e376968705b53b0.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.45
confirmado com "entendi" em 01/11/2026; publicação em preparação.

Um método novo em backend/tests/Feature/CatalogoApiTest.php:
test_retorna_pagina_vazia_quando_nome_nao_corresponde_a_ativos.
O comportamento já existia; agora ganha cobertura permanente.

## Preparar o cenário

```php
Produto::factory()->create([
    'nome' => 'Caneca',
    'status' => 'ativo',
    'preco_em_centavos' => 2990,
]);

Produto::factory()->inativo()->create([
    'nome' => 'Camiseta',
    'preco_em_centavos' => 4990,
]);
```

A Caneca está ativa, mas não corresponde à busca por camiseta. A Camiseta
corresponde ao nome, mas está inativa. Nenhuma pode aparecer na resposta.
O banco contém produtos; o resultado vazio depende dos filtros combinados.
Não guardamos os models em variáveis porque não esperamos nenhum ID em data.

## Entrada e resposta esperada

```php
$resposta = $this->getJson('/api/v1/produtos?nome=camiseta');
$url = url('/api/v1/produtos').'?nome=camiseta&page=1';
```

getJson executa o GET pelo fluxo da aplicação de teste, pedindo JSON.
Page foi omitido, então o Form Request usa a primeira página. A variável $url
monta a expectativa dos links usando a base da requisição e o filtro explícito.

O teste exige status 200 e Content-Type application/json, seguidos por:

```php
->assertJsonPath('data', [])
->assertJsonPath('links', [
    'first' => $url,
    'last' => $url,
    'prev' => null,
    'next' => null,
])
->assertJsonPath('meta.current_page', 1)
->assertJsonPath('meta.per_page', 10)
->assertJsonPath('meta.total', 0)
->assertJsonPath('meta.last_page', 1)
->assertJsonPath('meta.from', null)
->assertJsonPath('meta.to', null);
```

Data deve ser exatamente uma lista vazia. Total zero conta os produtos ativos
correspondentes, e per_page continua dez como configuração da paginação.
From e to ficam null porque não há posições ocupadas por itens nesta resposta.

O paginador mantém last_page em pelo menos 1, mesmo com total zero. Por isso,
first e last apontam para a primeira página, preservando nome=camiseta.
Prev e next ficam null porque não há página anterior ou seguinte neste cenário.

A pesquisa é válida e concluiu com sucesso: retorna 200 sem resultados.
A consulta individual de um ID ausente usa 404, e entradas inválidas usam 422;
esses contratos continuam cobertos pelos testes anteriores.

## Relação com os arquivos existentes

ListarProdutosRequest valida nome e define a página padrão. ProdutoController
envia página/nome ao catálogo e preserva nome nos links. CatalogoEloquent
combina status ativo e trecho do nome antes de paginar. ProdutoResource e o
paginador produzem data/links/meta.

Esses arquivos de produção não foram alterados. O helper assertPaginaUnica
também foi preservado: suas expectativas atuais usam links sem nome.
Este teste confere diretamente os links da busca filtrada, sem novas medições
SQL ou asserções de meta.links.

## Verificações e isolamento

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica a sintaxe; --filter seleciona a classe. A última execução
inclui a suíte inteira. --do-not-cache-result evita escrita de cache na montagem
de código. Resultado: sintaxe válida, classe com 45 testes/449 asserções e suíte
com 59 testes/503 asserções. Um teste e 13 asserções a mais que na 6.44.

SetUp confere loja_test/loja_testes e limpa os produtos dentro da transação.
DatabaseTransactions desfaz as alterações ao terminar. Não presumimos reinício
dos IDs. SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram teste
com 0 categorias/0 produtos e normal com 0 categorias/1 produto. Git diff --check
e links locais da documentação conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação em preparação.
Publicar e iniciar somente 6.46: teste permanente de
página após a última em busca filtrada, preservando total e nome nos links.
