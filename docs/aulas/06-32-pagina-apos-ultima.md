# Aula 6.32 — Página válida após a última preserva o total

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação da 6.31
com "entendi" e publicação em 3a782ca8ba8055b5de5f0e4db31ab3db63df24ed.
HEAD, origin/main e main remota coincidiram após push. Entendimento da 6.32
confirmado com "entendi" em 30/10/2026; checkpoint publicado em
db652dd14c6470319f15375328f6d10903c863e7, com remoto conferido.

Uma alteração de código em backend/tests/Feature/CatalogoApiTest.php: novo teste
test_retorna_pagina_vazia_apos_a_ultima_sem_perder_total. O cenário foi conferido
por diagnóstico anteriormente; agora fica na suíte versionada.

## Preparação e requisição

```php
Produto::factory()->create([
    'nome' => 'Camiseta',
    'status' => 'ativo',
    'preco_em_centavos' => 4990,
]);

$resposta = $this->getJson('/api/v1/produtos?page=2');
$url = url('/api/v1/produtos');
```

O setUp da classe confere a identidade loja_test/loja_testes e limpa os produtos
dentro da transação. Factory cria um ativo; como cabem dez por página, ele ocupa
a primeira página e a última página é 1. Pedimos explicitamente a página 2.

Page=2 passa pelas regras do Form Request. O número respeita a faixa permitida,
mesmo que não existam itens nessa página do catálogo atual. O controller chama
o serviço paginado e o resource monta a resposta JSON pelo fluxo existente.

## Asserções e significado

```php
$resposta
    ->assertStatus(200)
    ->assertHeader('Content-Type', 'application/json')
    ->assertJsonPath('data', [])
    ->assertJsonPath('links', [
        'first' => $url.'?page=1',
        'last' => $url.'?page=1',
        'prev' => $url.'?page=1',
        'next' => null,
    ])
    ->assertJsonPath('meta.current_page', 2)
    ->assertJsonPath('meta.per_page', 10)
    ->assertJsonPath('meta.total', 1)
    ->assertJsonPath('meta.last_page', 1)
    ->assertJsonPath('meta.from', null)
    ->assertJsonPath('meta.to', null);
```

O status 200 indica sucesso da consulta; data [] confirma que a página solicitada
não contém itens. Total 1 descreve o conjunto de ativos do catálogo, e não a
quantidade de itens recebida nesta página. Isso evita interpretar uma página
vazia como um catálogo sem produtos.

Current_page mantém 2, a página solicitada. Last_page é 1, calculada a partir do
total e do tamanho da página. São informações diferentes e podem ter esses
valores simultaneamente. From/to ficam nulos porque não existem posições de
itens nesta página. Eles representam posições no resultado, não IDs do banco.

First/last apontam para a página 1; prev também, pois solicitamos a página 2.
Next é nulo. Url monta a base conforme o ambiente, sem fixar host ou porta.

O helper assertPaginaUnica não serve para este cenário: ele exige current_page 1
e from/to preenchidos quando o catálogo tem ativos. Por isso escrevemos as
expectativas próprias do novo método. DatabaseTransactions desfaz a fixture.

Uma entrada inválida como page=0 continua retornando 422. Uma página positiva
permitida além da última retorna 200 com lista vazia, conforme o contrato atual.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Sintaxe válida; classe da API com 26 testes/221 asserções e suíte completa com
40 testes/275 asserções passaram. Um cenário e treze asserções foram acrescentados.
--filter seleciona a classe e --do-not-cache-result evita escrita do cache de
resultados na montagem de código somente para leitura.

SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram loja_test/loja_testes
com 0 categorias/0 produtos e loja/loja_app com 0 categorias/1 produto. A transação
desfez o produto temporário. Git diff --check passou. Código da aplicação preservado.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026; checkpoint publicado em
db652dd14c6470319f15375328f6d10903c863e7, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.33](06-33-limite-paginacao.md), ampliando o teste
para o limite válido page=1000000.
