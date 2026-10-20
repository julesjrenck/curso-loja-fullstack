# Aula 5.87 — HAVING para filtrar grupos

## Objetivo e estado

Selecionar somente categorias que tenham pelo menos dois produtos no agrupamento.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.86 confirmada com "entendi" e publicada em
a764ac58e37f54300634de971ae97ece93c0596b. HEAD, origin/main e consulta direta
à main remota coincidiram após o push. A primeira tentativa teve timeout da
revisão automática antes de iniciar comandos Git; uma repetição concluiu o envio.

## Onde foi executado

Somente documentação alterada. Script temporário /tmp/curso-587-having-grupos.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-587-having-grupos.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios com Caneca. DB::listen
mede só o SELECT da leitura, após a preparação dos dados.

## Consulta executada

```sql
SELECT categoria_id, COUNT(*) AS total
FROM dbo.produtos
WHERE categoria_id IN (?, ?)
GROUP BY categoria_id
HAVING COUNT(*) >= ?
ORDER BY categoria_id
```

DB::select recebe esse SQL e, separadamente, os parâmetros:
[$roupas->id, $acessorios->id, 2]. Os dois primeiros ? selecionam categorias;
o terceiro define a quantidade mínima de produtos por grupo.

A leitura pode ser entendida nesta sequência:

1. WHERE seleciona os produtos das duas categorias.
2. GROUP BY reúne os produtos com mesmo categoria_id.
3. COUNT(*) calcula a quantidade em cada grupo.
4. HAVING mantém os grupos cuja quantidade é maior ou igual a dois.
5. ORDER BY ordena os grupos retornados pelo ID da categoria.

WHERE filtra linhas usadas no agrupamento; HAVING filtra os grupos com base
nessa contagem. O filtro da quantidade usa COUNT(*) diretamente no HAVING.

Roupas tem dois produtos, portanto atende ao mínimo. Acessórios tem um produto,
portanto seu grupo fica fora do resultado. Os registros preparados continuam
existindo durante a transação; o SELECT somente calcula e seleciona os grupos.

## Resultado observado

```text
Preparação: Roupas tem 2 produtos; Acessórios tem 1.
categoria_id=103 (Roupas) | total=2
HAVING COUNT(*) >= 2: um SELECT, um grupo retornado (Roupas/2).
Rollback executado.
```

103 foi o ID de Roupas nesta execução; verificações usam o ID do model sem fixar
o número. Valores numéricos normalizados para inteiros na comparação. O nome
exibido veio de mapa PHP dos models preparados; SQL retorna categoria_id/total.

## Verificações e limites

Script exigiu um SELECT e somente o grupo de Roupas com total 2; código 0.
Finally executou rollback. Consultas posteriores pelo diagnóstico da 5.69 em
processos PHP Docker separados conferiram loja_test/loja_testes com 0 categorias/
0 produtos/3 migrations e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.87 confirmada com "entendi". Publicar e iniciar somente 5.88: mesmo filtro com Query Builder por
havingRaw('COUNT(*) >= ?', [2]), comparando ao SQL nos mesmos dados. Diagnóstico
temporário loja_test com identidade e rollback, sem mudar aplicação ou combinar
JOIN com agregação ainda.
