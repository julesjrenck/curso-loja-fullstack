# Aula 5.83 — LEFT JOIN com Query Builder

## Objetivo e estado

Expressar o LEFT JOIN usando métodos PHP do Query Builder e comparar com SQL.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.82 confirmada com "entendi" e publicada em
c700173349f2b5a8e8dce074588c67b6572b27c3. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário
/tmp/curso-583-query-builder-left-join.php executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-583-query-builder-left-join.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento
entrega script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação cria Roupas, Camiseta associada e Caneca sem categoria. Executa o SQL
parametrizado da etapa anterior por DB::select e compara com Query Builder.
DB::listen conta apenas SELECTs de cada caso, fora da preparação.

## Consulta no Query Builder

Trecho executado após preparação, usando IDs reais dos dois produtos:

```php
$linhas = DB::table('produtos')
    ->leftJoin('categorias', 'categorias.id', '=', 'produtos.categoria_id')
    ->select('produtos.nome as produto', 'categorias.nome as categoria')
    ->whereIn('produtos.id', [$camiseta->id, $caneca->id])
    ->orderBy('produtos.id')
    ->get();
```

| Método | Parte da consulta SQL |
| --- | --- |
| DB::table('produtos') | FROM produtos |
| leftJoin(...) | LEFT JOIN categorias ON categorias.id = produtos.categoria_id |
| select(...) | Colunas selecionadas e aliases produto/categoria |
| whereIn(...) | WHERE produtos.id IN (?, ?) |
| orderBy(...) | ORDER BY produtos.id ASC |
| get() | Executa e devolve os resultados |

Os quatro argumentos de leftJoin informam tabela, primeira coluna, operador de
comparação e segunda coluna. São nomes de colunas; os IDs usados no whereIn são
valores passados separadamente ao SQL gerado pelo Laravel.

Antes de get, os métodos preparam a consulta. O diagnóstico guardou esse builder
em $consulta e usou toSql() para mostrar o SQL gerado, sem executá-lo. Depois,
$consulta->get() executou a busca. Zero SELECTs antes e um após get conferidos.

Retorno de get conferido como Illuminate\Support\Collection com linhas stdClass.
Cada linha tem propriedades produto e categoria, definidas pelos aliases.
Podemos ler $linha->produto e $linha->categoria. Essa consulta por DB::table
retorna linhas simples, sem instanciar models Produto ou Categoria.

## Resultado observado

```text
Camiseta -> Roupas
Caneca -> NULL
SQL: 1 SELECT; Query Builder: 1 SELECT; resultados iguais, 2 linhas.
Antes de get: 0 SELECTs; retorno de get: Collection de stdClass.
Rollback executado.
```

SQL gerado contém LEFT JOIN/ON equivalentes, WHERE com dois placeholders e ordem
por ID. Os resultados dos dois casos foram convertidos em arrays para comparação
estrita de colunas, valores e ordem. Exigidos Camiseta/Roupas e Caneca/null real;
NULL é somente a representação da ausência de categoria na saída.

## Verificações e limites

Diagnóstico código 0; mesma saída esperada no SQL e Builder, um SELECT por caso,
construção sem SELECT, Collection/tipo de linha conferidos. Finally executou
rollback. Consultas posteriores pelo diagnóstico da 5.69 em processos PHP Docker
separados conferiram loja_test/loja_testes com 0 categorias/0 produtos/3 migrations
e loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.83 confirmada com "entendi". Publicar e iniciar somente 5.84: count() no Query Builder para contar produtos sem carregar
lista, com Roupas contendo dois produtos e outra categoria vazia; conferir totais
2/0 e SQL COUNT gerado em diagnóstico temporário loja_test com identidade e rollback.
Sem mudar aplicação ou introduzir agrupamento ainda.
