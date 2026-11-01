# Aula 6.46 — Teste permanente de página após a última filtrada

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.45
com "entendi" e publicação em be303c9cb3874121e57ec22c866dd33f94accdca.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.46
confirmado com "entendi" em 01/11/2026; publicação verificada em
466053ab71a1faac095b8d42a53795847afe702b, com referências local e remotas coincidentes.

Um método novo em backend/tests/Feature/CatalogoApiTest.php:
test_retorna_pagina_apos_ultima_filtrada_sem_perder_total_e_nome.
O comportamento já existia; agora ganha cobertura permanente.

## Preparar mais de uma página

```php
Produto::factory()->count(11)->create([
    'nome' => 'Camiseta',
    'status' => 'ativo',
    'preco_em_centavos' => 4990,
]);
```

count(11) configura a factory para criar onze registros. Create persiste todos
com os atributos informados; cada produto recebe seu próprio ID. Nomes iguais
são permitidos. Neste teste, a quantidade importa para a paginação; a ordem e
o desempate dos objetos já têm testes específicos.

Também criamos uma Caneca ativa e uma Camiseta antiga inativa. São treze
produtos, doze ativos e onze ativos correspondentes ao trecho camiseta.
A Caneca detecta perda do filtro por nome, e a Camiseta inativa detecta perda
do filtro por status: incluir qualquer uma elevaria o total esperado.

Com dez itens por página, os onze correspondentes ocupam duas páginas.

## Pedir a página seguinte à última

```php
$resposta = $this->getJson('/api/v1/produtos?nome=camiseta&page=3');
$url = url('/api/v1/produtos').'?nome=camiseta&page=';
```

getJson executa o GET pelo fluxo HTTP da aplicação de teste, pedindo JSON.
A página 3 é uma entrada válida, mesmo que o conjunto só tenha duas páginas
com itens. A resposta mantém current_page 3; não troca a página solicitada
pela última existente.

| Campo | Expectativa | Motivo |
| --- | --- | --- |
| data | [] | Não há itens na página 3 |
| meta.current_page | 3 | Página solicitada |
| meta.per_page | 10 | Capacidade fixa |
| meta.total | 11 | Correspondentes ativos em todas as páginas |
| meta.last_page | 2 | Onze itens ocupam duas páginas |
| meta.from / meta.to | null / null | Não há posições ocupadas nesta página |

AssertStatus exige 200 e assertHeader exige Content-Type application/json.
AssertJsonPath compara data exatamente com [] e os metadados com esses valores.
Não esperamos IDs ou objetos porque a página está vazia.

## Links continuam descrevendo a busca

```php
->assertJsonPath('links', [
    'first' => $url.'1',
    'last' => $url.'2',
    'prev' => $url.'2',
    'next' => null,
])
```

A variável $url contém a base da requisição, nome=camiseta e o começo de page.
First aponta para a primeira página, last para a segunda, e prev para a página
anterior à solicitada, também a segunda. Next é null. Todos os links não nulos
preservam o filtro, permitindo voltar aos resultados da mesma busca.

Na 6.45, a busca inteira não tinha correspondentes e total era zero. Aqui,
somente a página pedida está vazia: total continua onze. O cliente deve usar
meta.total para conhecer a quantidade encontrada em todas as páginas.

## Relação com os arquivos existentes

ListarProdutosRequest valida page/nome. ProdutoController envia os valores ao
catálogo e preserva nome nos links. CatalogoEloquent filtra ativos e trecho do
nome antes de contar/paginar. O paginador e ProdutoResource montam o envelope.
Esses arquivos de produção não foram alterados. O teste observa a resposta
HTTP, sem medição SQL ou novas asserções de meta.links.

## Verificações e isolamento

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica a sintaxe, --filter seleciona a classe e a última execução
inclui a suíte inteira. --do-not-cache-result evita escrita de cache na montagem
de código. Resultado: sintaxe válida, classe com 46 testes/462 asserções e suíte
com 60 testes/516 asserções. Um teste e 13 asserções a mais que na 6.45.

SetUp confere loja_test/loja_testes e limpa os produtos dentro da transação.
DatabaseTransactions desfaz as alterações ao terminar. Não presumimos reinício
dos IDs. SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram teste
com 0 categorias/0 produtos e normal com 0 categorias/1 produto. Git diff --check
e links locais da documentação conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação verificada em
466053ab71a1faac095b8d42a53795847afe702b, com referências local e remotas coincidentes.
Continuidade na [aula 06-47](06-47-testes-limite-nome.md).
