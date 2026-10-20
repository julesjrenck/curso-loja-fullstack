# Aula 5.81 — INNER JOIN entre produtos e categorias

## Objetivo e estado

Combinar dados de produtos e categorias em uma consulta SQL com INNER JOIN.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.80 confirmada com "entendi" e publicada em
362795246c945b1adca0abef77ccbb65310beaca. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Demonstração no script temporário
/tmp/curso-581-inner-join.php, executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-581-inner-join.php
```

Exec usa o backend iniciado; -T dispensa terminal interativo. O redirecionamento
entrega o script local à entrada do PHP no container. A aplicação recebe
--env=testing. O script carrega autoload/bootstrap de /app e exige ambiente
testing/banco loja_test/login loja_testes antes dos cadastros.

Transação cria Roupas e dois produtos: Camiseta com categoria_id de Roupas e
Caneca sem categoria. DB::listen mede somente o SELECT do JOIN; preparação e
leitura posterior da Caneca ficam fora da contagem. O script é temporário,
não pertence à aplicação ou à suíte permanente.

## Consulta executada

SQL entregue a DB::select, com IDs dos produtos passados separadamente:

```sql
SELECT produtos.nome AS produto, categorias.nome AS categoria
FROM dbo.produtos
INNER JOIN dbo.categorias
    ON categorias.id = produtos.categoria_id
WHERE produtos.id IN (?, ?)
ORDER BY produtos.id
```

- SELECT escolhe os dois nomes; AS nomeia as colunas do resultado como produto
  e categoria, distinguindo as duas colunas que se chamam nome nas tabelas.
- FROM indica a tabela produtos, no schema dbo.
- INNER JOIN combina cada produto com a categoria correspondente.
- ON define essa correspondência: categorias.id deve ser igual a produtos.categoria_id.
- WHERE limita aos dois produtos criados no diagnóstico. Os dois ? recebem os
  IDs reais pelo array de parâmetros [$camiseta->id, $caneca->id].
- ORDER BY define a ordem pelo ID do produto.

DB::select devolve um array de linhas simples com propriedades produto/categoria.
Os nomes das colunas resultantes permitem acessar $linha->produto e
$linha->categoria. Não são models Produto ou Categoria carregados pelo Eloquent.

## Resultado observado

```text
Preparação: Camiseta -> Roupas; Caneca -> sem categoria.
INNER JOIN: Camiseta -> Roupas
SELECTs do JOIN: 1; linhas retornadas: 1
Caneca ainda existe no banco com categoria_id NULL.
Rollback executado.
```

O INNER JOIN retorna somente combinações que atendem à condição ON. Camiseta
aponta para o ID de Roupas, portanto forma uma linha com ela. Caneca tem
categoria_id NULL e não encontra uma categoria correspondente; fica fora do
resultado desse SELECT.

Consulta não excluiu Caneca. Leitura posterior por findOrFail encontrou o produto
e conferiu categoria_id null. O SELECT do JOIN retornou uma linha com os dois
nomes em uma única consulta. Não foi feito acesso a relacionamento em foreach.

## Verificações e limites

Script exigiu uma consulta, uma linha e nomes Camiseta/Roupas; código 0.
Finally executou rollback. Consultas posteriores pelo diagnóstico da 5.69 em
processos PHP Docker separados conferiram loja_test/loja_testes com 0 categorias/
0 produtos/3 migrations e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.81 confirmada com "entendi". Publicar e iniciar somente 5.82: comparar INNER JOIN com LEFT JOIN nos mesmos produtos,
conferindo que LEFT JOIN inclui Caneca com categoria null. Diagnóstico SQL
parametrizado em loja_test com identidade conferida e rollback, sem mudar
aplicação ou introduzir outros tipos de JOIN.
