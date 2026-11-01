# Aula 6.49 — Filtro e estado de navegação em meta.links

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.48
com "entendi" e publicação em 35c4bacea337f1ee2c07001adbf60a39f2a9a65d.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.49
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Objetivo e alteração

Em backend/tests/Feature/CatalogoApiTest.php, ampliamos o método
test_mantem_filtro_e_total_ao_seguir_proxima_pagina, criado na 6.43.
Ele já prepara doze ativos correspondentes entre vinte ativos, um inativo
correspondente e navega para a segunda página usando links.next recebido.

Os atalhos links.first/last/prev/next já eram conferidos. Agora verificamos
também meta.links nas duas respostas. Essa lista representa as opções de
navegação: anterior, números das páginas e seguinte. Cada entrada tem url,
page, active e label na versão instalada. O teste acrescenta verificações
de quantidade, URL, página de destino e estado ativo.

## Caminhos com índices

Um trecho das novas asserções da primeira resposta:

```php
->assertJsonCount(4, 'meta.links')
->assertJsonPath('meta.links.2.url', $url.'2')
->assertJsonPath('meta.links.2.page', 2)
->assertJsonPath('meta.links.2.active', false)
```

AssertJsonCount exige quatro entradas nesse cenário. No caminho meta.links.2,
o índice 2 acessa a terceira entrada, porque a numeração começa em zero.
Ela corresponde ao botão da página 2. $url já contém a base da listagem e
?nome=camiseta&page=; acrescentar '2' monta a URL esperada com o filtro.

Page informa o destino da opção. Active indica se a opção numérica representa
a página atual; não é um indicador genérico de link habilitado. Na primeira
resposta, a opção da página 2 tem URL, mas active false.

## Expectativas nas duas respostas

| Índice / opção | Página 1: destino / active | Página 2: destino / active |
| --- | --- | --- |
| 0 / anterior | null / false | 1 / false |
| 1 / página 1 | 1 / true | 1 / false |
| 2 / página 2 | 2 / false | 2 / true |
| 3 / seguinte | 2 / false | null / false |

Destino null significa que url e page são null. Quando existe destino, a URL
deve conter nome=camiseta e a página correspondente. Na segunda resposta,
somente a opção numérica da página 2 fica ativa. Anterior/seguinte permanecem
active false neste cenário, mesmo quando têm destino.

Labels como Previous/Next podem variar com a tradução. As novas asserções não
fixam seu texto: verificam os dados usados para navegar e identificar a página.
As quatro entradas são esperadas neste cenário de duas páginas; não afirmamos
que listas com muitas páginas terão sempre quatro opções.

## Relação com a aplicação e verificações

ProdutoController já preserva nome com appends no paginador. A resposta de
ProdutoResource com paginação inclui links e meta.links. Nenhum código de
produção foi alterado. Os mesmos produtos, ordem, total doze, posições e
navegação por links.next continuam sendo conferidos. Não medimos SQL.

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica a sintaxe; --filter seleciona a classe; a última execução
inclui a suíte inteira. --do-not-cache-result evita escrita de cache na montagem
de código. Sintaxe válida, classe com 52 testes/566 asserções e suíte com
66 testes/620 asserções: mesma quantidade de testes, 26 asserções novas.

SetUp confere loja_test/loja_testes e limpa produtos dentro da transação.
DatabaseTransactions desfaz as alterações. SELECTs antes/depois por
/tmp/curso-618-contagens.php: teste com 0 categorias/0 produtos e normal com
0 categorias/1 produto. Git diff --check e links locais conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação em preparação.
Publicar e iniciar somente 6.50: introdução ao OpenAPI
e desenho do primeiro documento da listagem do catálogo, antes de escrevê-lo.
