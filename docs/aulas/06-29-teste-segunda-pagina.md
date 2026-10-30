# Aula 6.29 — Teste permanente da segunda página do catálogo

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação da 6.28
com "entendi" e publicação em ed21a330288ff3af17d777e1bbcb53e95016e90b.
HEAD, origin/main e main remota coincidiram após push. Entendimento da 6.29
confirmado com "entendi" em 30/10/2026; publicação em preparação.

Uma alteração de código em backend/tests/Feature/CatalogoApiTest.php:
test_retorna_segunda_pagina_com_ativos_e_desempate_por_id. O comportamento que
foi conferido por diagnóstico temporário agora fica na suíte versionada.

## Preparação dos dados

As factories criam dois ativos chamados Produto 10, com preços 1000 e 2000.
O segundo model fica em $ultimoProduto, para comparar seu ID real com a resposta.
Não assumimos que os IDs começam em 1 ou que serão iguais entre execuções.

Depois criamos nove ativos em ordem decrescente:

```php
for ($numero = 9; $numero >= 1; $numero--) {
    Produto::factory()->create([
        'nome' => sprintf('Produto %02d', $numero),
        'status' => 'ativo',
        'preco_em_centavos' => $numero * 100,
    ]);
}
```

O for começa em 9, continua enquanto o número for pelo menos 1 e decrementa
após cada repetição. Sprintf devolve uma string formatada: %d representa inteiro,
2 pede largura mínima de dois caracteres e 0 preenche à esquerda. Resultam nomes
Produto 09 até Produto 01. A multiplicação gera preços em centavos.

Por fim, factory()->inativo()->create cria Produto 00 com preço 500. Esse nome
viria primeiro na ordenação caso o filtro de ativos deixasse de funcionar.
Temos doze registros, mas somente onze devem contar para a paginação.

A API ordena por nome e depois ID; a ordem de criação foi diferente. Os nove
nomes distintos vêm antes dos dois Produto 10. Entre os homônimos, o menor ID
vem primeiro. Como cada página tem dez itens, o primeiro Produto 10 termina
a página 1 e $ultimoProduto começa a página 2, sozinho.

## Requisição e asserções

```php
$resposta = $this->getJson('/api/v1/produtos?page=2');
$url = url('/api/v1/produtos');
```

GetJson envia GET pelo fluxo HTTP da aplicação de teste: middleware, validação,
controller, contrato, Eloquent/SQL Server e resource. Url obtém a URL base do
ambiente para comparar os links sem fixar host ou porta.

O teste exige status 200 e Content-Type application/json. AssertJsonPath('data',
...) compara toda a lista: somente um objeto, com ID de $ultimoProduto, nome
Produto 10 e preco_em_centavos inteiro 2000. Não basta encontrar o nome, pois
os dois produtos empatados o compartilham.

Links deve ter first e prev apontando para page=1, last para page=2 e next null.
Os metadados exigidos são:

| Campo de meta | Valor | Significado |
| --- | --- | --- |
| current_page | 2 | Página solicitada |
| per_page | 10 | Limite de itens por página |
| total | 11 | Todos os ativos, sem o inativo |
| last_page | 2 | Onze ativos precisam de duas páginas |
| from | 11 | Posição inicial nesta página |
| to | 11 | Posição final nesta página |

From/to são posições no resultado ordenado, não IDs do banco. O helper
assertPaginaUnica continua atendendo aos cenários anteriores; o novo cenário
escreve suas expectativas próprias porque tem duas páginas.

SetUp mantém as verificações de identidade loja_test/loja_testes antes de limpar
os produtos para o teste. DatabaseTransactions desfaz as alterações no fim.
Rollback não exige que a numeração identity seja reiniciada; usamos IDs reais.

## Verificação

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l conferiu a sintaxe. O filtro executou a classe da API: 14 testes e 120
asserções passaram. Sem filtro, a suíte completa passou com 28 testes e 174
asserções. A etapa acrescentou um cenário e treze asserções em relação à 6.28.
--do-not-cache-result evita escrita de cache no código montado somente para leitura.

SELECTs separados antes/depois, pelo script temporário /tmp/curso-618-contagens.php,
confirmaram loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
0 categorias/1 produto. Git diff --check passou. Sem alterações no código da
aplicação, migrations, dependências ou cadastros permanentes.

## Continuidade

Registro de progresso, roteiro e cobertura do contrato atualizados. Entendimento
da 6.29 confirmado com "entendi" em 30/10/2026; publicação em preparação.
Próximo passo: publicar e iniciar somente 6.30: um teste permanente de
page=0 com 422/JSON e errors.page. Demais limites e erros seguem nos diagnósticos
anteriores; não foram acrescentados à suíte nesta etapa.
