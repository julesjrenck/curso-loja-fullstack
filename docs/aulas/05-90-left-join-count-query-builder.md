# Aula 5.90 — LEFT JOIN e contagem no Query Builder

## Objetivo e estado

Expressar a contagem por categoria com LEFT JOIN no Query Builder, incluindo
categoria vazia. Demonstração, explicação e verificações em 21/10/2026;
entendimento confirmado com "entendi" em 21/10/2026. Checkpoint concluído para publicação.

5.89 explicada/verificada em 20/10/2026, confirmada com "entendi" em 21/10/2026
e publicada em d7a9051a18bc3dc54dbbca97cb4226fc3ce5c280. HEAD, origin/main e
consulta direta à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário
/tmp/curso-590-left-join-count-query-builder.php executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-590-left-join-count-query-builder.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos. SQL da
5.89 comparado ao Builder nos mesmos dados. Listener mede somente SELECTs das
leituras, fora de preparação e reiniciando contador entre casos.

## Consulta no Query Builder

```php
$linhas = DB::table('categorias')
    ->leftJoin('produtos', 'produtos.categoria_id', '=', 'categorias.id')
    ->select('categorias.id as categoria_id', 'categorias.nome as categoria')
    ->selectRaw('COUNT(produtos.id) as total')
    ->whereIn('categorias.id', [$roupas->id, $acessorios->id])
    ->groupBy('categorias.id', 'categorias.nome')
    ->orderBy('categorias.id')
    ->get();
```

DB::table define categorias como origem. LeftJoin mantém as categorias selecionadas
mesmo sem produtos, usando a igualdade da FK com o ID da categoria. Select escolhe
ID/nome com aliases; selectRaw inclui a expressão SQL de contagem dos IDs de produtos.
WhereIn limita às duas categorias e envia IDs separadamente como parâmetros.

GroupBy recebe as duas colunas, ID e nome, para formar uma linha por categoria.
OrderBy define a ordem pelo ID. Get executa a consulta e devolve Collection de
linhas simples stdClass, com categoria_id/categoria/total.

Roupas possui dois IDs de produto preenchidos, portanto total 2. Acessórios
permanece no resultado pelo LEFT JOIN; seus campos de produto ficam NULL, que
COUNT(produtos.id) ignora, retornando zero. O filtro se aplica aos IDs de
categorias, preservando a categoria vazia.

## Resultado observado

```text
Roupas -> 2 produtos
Acessórios -> 0 produtos
SQL: 1 SELECT; Query Builder: 1 SELECT; mesmas categorias e totais 2/0.
Zero SELECTs antes de get; Collection de linhas simples; total zero distinto de NULL.
Rollback executado.
```

SQL gerado pelo Builder contém LEFT JOIN, COUNT(produtos.id), WHERE com dois
placeholders, GROUP BY ID/nome e ordem pelo ID. Bindings dos IDs conferidos antes
de get; nenhuma consulta até essa execução. IDs, nomes, totais e ordem iguais
aos do SQL da etapa anterior. Normalização de valores numéricos apenas na
comparação; total da categoria vazia conferido como diferente de null.

## Verificações e limites

Diagnóstico código 0, um SELECT por caso, nomes/totais 2/0 e retorno/parâmetros
esperados. Finally executou rollback. Consultas posteriores pelo diagnóstico da
5.69 em processos PHP Docker separados conferiram loja_test/loja_testes com
0 categorias/0 produtos/3 migrations e loja/loja_app com 0/1/3.

Docker Compose ps conferiu backend/php/sqlserver já em execução. Aplicação/testes
preservados; suíte não reexecutada. Última execução permanece 14 testes/54 asserções
da 5.80. Git diff --check passou; arquivos privados de ambiente fora do índice.
Sem dependências ou serviços novos.

## Continuidade

5.90 confirmada com "entendi". Publicar e iniciar somente 5.91: withCount('produtos') na consulta Eloquent de Categoria,
conferindo produtos_count 2/0, models retornados, um SELECT e coleção da relação
produtos sem carregar. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação.
