# Aula 5.88 — HAVING com Query Builder

## Objetivo e estado

Filtrar grupos por quantidade usando havingRaw no Query Builder.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.87 confirmada com "entendi" e publicada em
9416c4f28f276ad91cfccc4df0149b3432f8dc89. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário
/tmp/curso-588-having-query-builder.php executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-588-having-query-builder.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios com Caneca. SQL HAVING
da 5.87 comparado ao Builder nos mesmos dados. Listener DB::listen conta apenas
SELECTs das leituras, fora da preparação e reiniciando contador entre casos.

## Consulta com havingRaw

```php
$linhas = DB::table('produtos')
    ->select('categoria_id')
    ->selectRaw('COUNT(*) as total')
    ->whereIn('categoria_id', [$roupas->id, $acessorios->id])
    ->groupBy('categoria_id')
    ->havingRaw('COUNT(*) >= ?', [2])
    ->orderBy('categoria_id')
    ->get();
```

HavingRaw acrescenta uma condição SQL ao HAVING. O primeiro argumento contém
a expressão COUNT(*) >= ?. O segundo é o array de valores dos placeholders:
[2] fornece o mínimo de dois produtos. A expressão é fixa no código e o valor
é enviado separadamente como parâmetro.

WhereIn seleciona produtos das duas categorias; groupBy reúne produtos por
categoria_id; selectRaw inclui a contagem na seleção; havingRaw mantém grupos
que atendem ao mínimo. Get executa e devolve Collection com uma linha por grupo
que passou pelo filtro.

Antes de get, o diagnóstico conferiu zero SELECTs e getBindings com os dois IDs
e limite 2 na ordem esperada. SQL gerado contém GROUP BY categoria_id HAVING
COUNT(*) >= ?, com o limite passado separadamente.

Roupas tem dois produtos e aparece com total 2. Acessórios tem um e fica fora
do resultado. Cada linha retornada tem categoria_id/total, como no agrupamento
anterior; o nome exibido vem do mapa PHP dos models preparados.

## Resultado observado

```text
categoria_id=105 (Roupas) | total=2
SQL: 1 SELECT; Query Builder: 1 SELECT; somente Roupas/2 nos dois casos.
Antes de get: zero SELECTs; limite 2 passado por binding; retorno: Collection com um grupo.
Rollback executado.
```

105 foi o ID gerado para Roupas nesta execução; código verifica o ID do model,
sem fixar esse número. Valores numéricos normalizados apenas na comparação.
Binding significa o valor enviado separadamente para preencher um placeholder.

## Verificações e limites

Diagnóstico código 0; SQL/Builder com mesmo ID de Roupas/total 2, um SELECT por
caso, zero antes de get, parâmetros e retorno conferidos. Finally executou
rollback. Consultas posteriores pelo diagnóstico da 5.69 em processos PHP Docker
separados conferiram loja_test/loja_testes com 0 categorias/0 produtos/3 migrations
e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.88 confirmada com "entendi". Publicar e iniciar somente 5.89: LEFT JOIN a partir de categorias e COUNT(produtos.id),
GROUP BY categorias.id/categorias.nome, com Roupas/2 e Acessórios/0. Explicar
COUNT de coluna ignora NULL da linha sem correspondência. Diagnóstico SQL
temporário loja_test com identidade e rollback, sem mudar aplicação.
