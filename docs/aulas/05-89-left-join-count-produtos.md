# Aula 5.89 — LEFT JOIN com contagem de produtos

## Objetivo e estado

Contar produtos por categoria incluindo categorias sem produtos, com total zero.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 21/10/2026. Checkpoint concluído para publicação.

5.88 confirmada com "entendi" e publicada em
0aa0ebc2ad2d2a09124ce1826e94b47e06b6cb38. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário /tmp/curso-589-left-join-count.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-589-left-join-count.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos. Listener
DB::listen mede só o SELECT de leitura, fora da preparação.

## Consulta executada

```sql
SELECT categorias.id AS categoria_id,
       categorias.nome AS categoria,
       COUNT(produtos.id) AS total
FROM dbo.categorias
LEFT JOIN dbo.produtos
    ON produtos.categoria_id = categorias.id
WHERE categorias.id IN (?, ?)
GROUP BY categorias.id, categorias.nome
ORDER BY categorias.id
```

IDs reais de Roupas/Acessórios enviados separadamente ao DB::select nos dois
parâmetros. Desta vez, categorias está à esquerda, no FROM. LEFT JOIN mantém as
categorias selecionadas mesmo quando não encontra produtos correspondentes.

GROUP BY usa ID/nome, as duas colunas selecionadas fora da contagem. ID mantém
categorias distintas mesmo se tiverem nomes iguais. SELECT retorna ID, nome da
categoria e total, agora trazendo o nome diretamente pela consulta SQL.

## Por que COUNT(produtos.id)

Para Roupas, o JOIN encontra dois produtos com IDs preenchidos: COUNT(produtos.id)
retorna 2. Para Acessórios, o LEFT JOIN mantém uma linha com campos do produto
como NULL. COUNT de uma coluna conta somente valores não nulos: retorna 0.

COUNT(*) contaria a linha preservada para a categoria vazia e produziria 1.
COUNT(produtos.id) conta os produtos encontrados, por isso representa o total
desejado. A consulta combina o comportamento do LEFT JOIN com a contagem por grupo.

## Resultado observado

```text
Roupas -> 2 produtos
Acessórios -> 0 produtos
Um SELECT, duas categorias; COUNT(produtos.id) retornou zero na categoria vazia.
Rollback executado.
```

O diagnóstico confere IDs/nome/totais exatos após normalizar valores numéricos para
inteiros. Também exige que o total da categoria vazia seja diferente de null na
linha original. O zero é o resultado da contagem; as categorias continuam existindo
durante a transação.

## Verificações e limites

Diagnóstico código 0, um SELECT/duas categorias, totais 2/0 e nomes corretos.
Finally executou rollback. Consultas posteriores pelo diagnóstico da 5.69 em
processos PHP Docker separados conferiram loja_test/loja_testes com 0 categorias/
0 produtos/3 migrations e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.89 confirmada com "entendi" em 21/10/2026. Publicar e iniciar somente 5.90: mesma consulta no Query Builder a partir de categorias,
leftJoin produtos/select ID/nome/selectRaw COUNT(produtos.id)/whereIn/groupBy
ID/nome/orderBy/get, comparando ao SQL nos mesmos dados com totais 2/0 e um SELECT
por caso. Diagnóstico temporário loja_test com identidade e rollback, sem mudar aplicação.
