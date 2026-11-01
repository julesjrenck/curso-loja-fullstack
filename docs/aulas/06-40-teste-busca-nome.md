# Aula 6.40 — Teste permanente da busca por nome

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.39
com "entendi" e publicação em a1ded6b8bd8994a956ac5a52efeb576737af641f.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.40
confirmado com "entendi" em 01/11/2026; checkpoint publicado em
851adef50e2973dcb66d223fe4424f1326a89677, com remoto conferido.

Uma alteração de código em backend/tests/Feature/CatalogoApiTest.php: novo método
test_filtra_ativos_por_trecho_do_nome_no_json. O fluxo que foi conferido por
diagnóstico agora ganha um cenário permanente na suíte versionada.

## Preparação dos produtos

As factories criam quatro produtos no banco exclusivo de testes:

| Ordem de criação | Nome | Status | Preço em centavos |
| --- | --- | --- | --- |
| 1 | Kit de camiseta | ativo | 6990 |
| 2 | Camiseta azul | ativo | 4990 |
| 3 | Caneca | ativo | 2990 |
| 4 | Camiseta antiga | inativo | 1990 |

Kit e Camiseta azul são guardados em variáveis para comparar seus IDs gerados
com a resposta. A Caneca é um ativo que não combina com o trecho, e a Camiseta
antiga combina com ele, mas deve ser omitida por estar inativa.

Criamos o Kit primeiro para exigir ordenação diferente da inserção: Camiseta
azul precisa vir antes dele no resultado. Nome em minúsculas também deve encontrar
Camiseta com inicial maiúscula, e o Kit exercita a ocorrência no meio do nome.

## Requisição e produtos esperados

```php
$resposta = $this->getJson('/api/v1/produtos?nome=camiseta');
$url = url('/api/v1/produtos');
```

GetJson passa pelo fluxo HTTP da aplicação de teste: middleware, Form Request,
controller, contrato, Eloquent/SQL Server e resource. Url monta a base esperada
para os links sem fixar host ou porta.

O teste exige 200/application/json e compara toda a lista data:

```php
->assertJsonPath('data', [
    [
        'id' => $camiseta->id,
        'nome' => 'Camiseta azul',
        'preco_em_centavos' => 4990,
    ],
    [
        'id' => $kit->id,
        'nome' => 'Kit de camiseta',
        'preco_em_centavos' => 6990,
    ],
])
```

Essa comparação protege itens, IDs, nomes, preços, tipos e ordem. Não basta
encontrar um produto: a resposta inteira deve conter somente os dois ativos
correspondentes. IDs são lidos dos models criados, sem assumir numeração inicial.

## Links e metadados

First e last devem apontar para a base com ?nome=camiseta&page=1. Prev e next
devem ser null, pois os dois produtos cabem em uma página. Os metadados exigidos:

- Current_page 1: padrão quando page foi omitido.
- Per_page 10: capacidade fixa, mesmo recebendo dois itens.
- Total 2: somente os ativos correspondentes, excluindo Caneca e inativo.
- Last_page 1: os dois correspondentes cabem na primeira página.
- From 1 e to 2: posições dos produtos no resultado, não IDs do banco.

O helper assertPaginaUnica anterior espera links sem nome. O novo cenário
escreve suas expectativas de links filtrados diretamente, preservando os demais
testes. SetUp continua conferindo loja_test/loja_testes e limpando produtos
dentro da transação. DatabaseTransactions desfaz as fixtures ao finalizar.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

Php -l conferiu a sintaxe. --filter selecionou a classe da API: 28 testes/247
asserções passaram. Sem filtro, a suíte completa passou com 42 testes/301 asserções.
Um cenário e treze asserções foram acrescentados em relação à 6.39.
--do-not-cache-result evita escrita do cache de resultados na montagem de código.

SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram teste com
0 categorias/0 produtos e normal com 0 categorias/1 produto. As fixtures foram
desfeitas. Git diff --check e links locais da documentação conferidos.

Código da aplicação preservado. Outros casos da busca, como normalização,
desconhecidos nos links, caracteres especiais, páginas filtradas e erros de nome,
continuam nos diagnósticos anteriores, sem novos testes permanentes deles aqui.

## Continuidade

Entendimento confirmado com "entendi" em 01/11/2026; checkpoint publicado em
851adef50e2973dcb66d223fe4424f1326a89677, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.41](06-41-teste-nome-normalizado.md), ampliando
o teste com DataProvider para nome normalizado e desconhecidos fora dos links.
