# Aula 5.82 — LEFT JOIN entre produtos e categorias

## Objetivo e estado

Comparar INNER JOIN e LEFT JOIN mantendo os mesmos produtos e condição ON.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.81 confirmada com "entendi" e publicada em
dca90ec1e18f06b7d8d3f2258a09c780c9bc4ad4. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde e como foi executado

Somente documentação alterada. Script temporário /tmp/curso-582-left-join.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-582-left-join.php
```

Exec usa o backend iniciado; -T dispensa terminal interativo. Redirecionamento
envia script local ao PHP no container. A aplicação recebe --env=testing. O script
carrega autoload/bootstrap de /app e exige testing/loja_test/loja_testes antes dos
cadastros. Não é arquivo da aplicação ou teste permanente.

Transação cria Roupas, Camiseta associada e Caneca sem categoria. DB::select
executa INNER JOIN e LEFT JOIN sobre esses mesmos dados. Listener DB::listen
conta somente SELECTs de cada caso, reiniciando contador entre eles. Preparação
e leitura posterior da Caneca ficam fora da medição.

## Consulta com LEFT JOIN

```sql
SELECT produtos.nome AS produto, categorias.nome AS categoria
FROM dbo.produtos
LEFT JOIN dbo.categorias
    ON categorias.id = produtos.categoria_id
WHERE produtos.id IN (?, ?)
ORDER BY produtos.id
```

A mudança em relação ao caso anterior é LEFT JOIN no lugar de INNER JOIN.
Condição ON, colunas selecionadas, filtros e ordem permanecem iguais. Os IDs
reais de Camiseta/Caneca são passados separadamente ao DB::select, no array de
parâmetros dos dois placeholders ?.

Produtos é a tabela à esquerda, por estar no FROM. LEFT JOIN mantém os produtos
selecionados mesmo quando não encontram uma categoria pela condição ON. Nesses
casos, as colunas vindas de categorias recebem NULL no resultado.

Camiseta encontra Roupas e retorna os dois nomes. Caneca tem categoria_id NULL,
sem correspondência em categorias, mas aparece com a coluna categoria como NULL.
Isso não cadastra uma categoria para ela; apenas define o resultado da consulta.

## Comparação observada

```text
INNER JOIN: 1 SELECT, 1 linha
Camiseta -> Roupas
LEFT JOIN: 1 SELECT, 2 linhas
Camiseta -> Roupas
Caneca -> NULL
Mesmo conjunto de produtos e mesma condição ON; Caneca segue sem categoria.
Rollback executado.
```

| Produto | Resultado INNER JOIN | Resultado LEFT JOIN |
| --- | --- | --- |
| Camiseta | Roupas | Roupas |
| Caneca | Fora do resultado | Categoria NULL |

O script confere null real na propriedade categoria da segunda linha; NULL é
somente sua representação na saída. Leitura separada da Caneca confirma que
categoria_id continua null no banco. DB::select devolve linhas simples com
colunas produto/categoria, como na etapa anterior.

## Verificações e limites

Diagnóstico código 0: uma consulta por caso; uma linha no INNER e duas no LEFT;
nomes e null esperados conferidos. Finally executou rollback. Consultas posteriores
pelo diagnóstico da 5.69 em processos PHP Docker separados conferiram
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Nenhum dado temporário permaneceu.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.82 confirmada com "entendi". Publicar e iniciar somente 5.83: Query Builder para o mesmo LEFT JOIN por
DB::table/leftJoin/select/whereIn/orderBy/get, comparando com SQL parametrizado
nos mesmos dados. Diagnóstico temporário em loja_test com identidade conferida e
rollback, sem mudar aplicação ou introduzir outros tipos de JOIN.
