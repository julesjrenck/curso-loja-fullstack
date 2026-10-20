# Aula 5.84 — Contar produtos por categoria com count()

## Objetivo e estado

Obter o total de produtos de uma categoria sem carregar a lista dos produtos.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.83 confirmada com "entendi" e publicada em
829236f24585c77975b679410afccdec04203538. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário /tmp/curso-584-count-produtos.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-584-count-produtos.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes dos
cadastros; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos. Categorias
usam create; produtos usam factory com nome/status/categoria_id explícitos.
DB::listen mede somente SELECTs das contagens, fora da preparação e com contador
reiniciado entre as categorias.

## Código central

Para cada categoria preparada, executamos:

```php
$total = DB::table('produtos')
    ->where('categoria_id', $categoria->id)
    ->count();
```

DB::table define a tabela produtos. Where limita aos registros cujo categoria_id
corresponde à categoria atual. Count executa a contagem no banco e devolve um
número inteiro. Não é necessário chamar get antes; não recebemos uma coleção
de produtos nesse resultado.

SQL observado pelo listener:

```sql
select count(*) as [aggregate]
from [produtos]
where [categoria_id] = ?
```

COUNT(*) conta as linhas que atendem ao filtro. O ? recebe o ID real da categoria
como parâmetro. Aggregate é o alias interno usado pelo Laravel para ler o total.

O banco calcula o total e retorna esse valor. Não transfere os nomes, preços e
demais campos de cada produto para que o PHP os conte em uma lista.

## Resultado observado

```text
Roupas: 2 produtos | retorno inteiro | 1 SELECT
Acessórios: 0 produtos | retorno inteiro | 1 SELECT
Totais 2 e 0 conferidos; nenhuma lista de produtos foi carregada pela contagem.
Rollback executado.
```

Roupas tem dois produtos associados e retorna 2. Acessórios existe, mas não tem
produtos associados, portanto retorna 0. Foram duas chamadas de count, cada uma
com filtro de uma categoria e uma consulta ao banco. Ainda não agrupamos várias
categorias em uma só consulta.

## Verificações e limites

Script exigiu totais estritamente iguais aos inteiros 2 e 0, um SELECT por caso
e SQL contendo COUNT(*); código 0. Finally executou rollback. Consultas posteriores
pelo diagnóstico da 5.69 em processos PHP Docker separados conferiram
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Nenhum dado temporário permaneceu.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.84 confirmada com "entendi". Publicar e iniciar somente 5.85: GROUP BY categoria_id com COUNT(*) em uma consulta SQL
parametrizada sobre produtos; duas categorias com totais 2/1. Diagnóstico temporário
loja_test com identidade e rollback, sem alterar aplicação ou introduzir JOIN com
agregação ainda.
