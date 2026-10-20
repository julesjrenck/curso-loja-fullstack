# Aula 5.85 — GROUP BY e COUNT por categoria

## Objetivo e estado

Contar produtos de várias categorias em uma única consulta, com uma linha por grupo.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.84 confirmada com "entendi" e publicada em
fd95bdd4e3a77e67db5ff9f9d62fbb937c5c5d34. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário /tmp/curso-585-group-by-categoria.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-585-group-by-categoria.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios com Caneca. DB::listen
mede apenas SELECT da leitura, após cadastros. Acessórios agora recebe um produto
para demonstrar dois grupos presentes na tabela produtos.

## Consulta executada

```sql
SELECT categoria_id, COUNT(*) AS total
FROM dbo.produtos
WHERE categoria_id IN (?, ?)
GROUP BY categoria_id
ORDER BY categoria_id
```

Os dois ? recebem os IDs reais de Roupas/Acessórios separadamente pelo array de
parâmetros do DB::select. WHERE seleciona os produtos dessas duas categorias.

GROUP BY categoria_id reúne os produtos com o mesmo ID de categoria. COUNT(*)
conta as linhas de cada grupo; AS total nomeia a coluna com essa quantidade.
ORDER BY define a ordem dos grupos pelo ID. Resultado contém categoria_id e total,
uma linha por grupo, em vez de uma linha para cada produto.

Exemplo da preparação:

| Produto | Categoria |
| --- | --- |
| Camiseta | Roupas |
| Calça | Roupas |
| Caneca | Acessórios |

Os dois primeiros produtos entram no mesmo grupo e produzem total 2. Caneca
entra no grupo de Acessórios e produz total 1. Os três produtos continuam sendo
três registros no banco; o agrupamento muda o formato do resultado do SELECT.

## Resultado observado

```text
categoria_id=99 (Roupas) | total=2
categoria_id=100 (Acessórios) | total=1
Um SELECT, dois grupos e três produtos contados.
Rollback executado.
```

99/100 foram os IDs gerados nesta execução. O script usa os IDs dos models nas
verificações; não depende desses números fixos. Normaliza os valores numéricos
retornados para inteiros antes de comparar IDs/totais.

SQL retorna somente IDs e totais. Os nomes exibidos entre parênteses vêm de um
mapa PHP dos models já criados. Não houve JOIN ou consulta extra de nomes.

## Verificações e limites

Script exigiu um SELECT e dois grupos com os IDs corretos e totais 2/1; código 0.
Finally executou rollback. Consultas posteriores pelo diagnóstico da 5.69 em
processos PHP Docker separados conferiram loja_test/loja_testes com 0 categorias/
0 produtos/3 migrations e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.85 confirmada com "entendi". Publicar e iniciar somente 5.86: mesmo agrupamento com Query Builder por select de
categoria_id/selectRaw COUNT(*)/whereIn/groupBy/orderBy/get, comparar com SQL
nos mesmos dados. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação ou combinar JOIN com agregação ainda.
