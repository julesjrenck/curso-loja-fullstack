# Aula 5.91 — Contagem pelo Eloquent com withCount

## Objetivo e estado

Obter a quantidade de produtos usando o relacionamento definido em Categoria.
Demonstração, explicação e verificações em 21/10/2026; entendimento confirmado
com "entendi" em 21/10/2026. Checkpoint concluído para publicação.

5.90 confirmada com "entendi" e publicada em
1d801ae15aeff65989ec35cd245f891b8844c3cc. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário /tmp/curso-591-with-count-produtos.php,
executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-591-with-count-produtos.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos. Listener
DB::listen mede só SELECTs da leitura, fora da preparação. Nenhuma alteração em
models, relações, migrations, seeders, factories ou serviços.

## Consulta executada

```php
$categorias = Categoria::query()
    ->whereIn('id', [$roupas->id, $acessorios->id])
    ->withCount('produtos')
    ->orderBy('id')
    ->get();

foreach ($categorias as $categoria) {
    echo $categoria->nome.' -> '.$categoria->produtos_count;
}
```

Categoria::query inicia consulta Eloquent. WhereIn limita aos IDs preparados.
WithCount recebe o nome do relacionamento produtos, definido em Categoria::produtos()
com hasMany. Eloquent usa essa definição para calcular a quantidade relacionada.
OrderBy define a ordem pelo ID; get executa e devolve Eloquent Collection de
models Categoria, cada um com o atributo adicional produtos_count.

O atributo produtos_count vem do resultado da consulta. Não foi criada coluna
na tabela. Podemos ler nome e produtos_count diretamente no model retornado.

SQL observado executou SELECT categorias.* com uma subconsulta de contagem:

```sql
SELECT categorias.*,
       (SELECT COUNT(*) FROM produtos
        WHERE categorias.id = produtos.categoria_id) AS produtos_count
FROM categorias
WHERE id IN (?, ?)
ORDER BY id ASC
```

Esse SQL possui uma contagem relacionada dentro do SELECT principal, executado
como uma única consulta enviada ao banco. Cada categoria recebe sua quantidade.

## Resultado observado

```text
Roupas -> produtos_count=2 | coleção produtos não carregada
Acessórios -> produtos_count=0 | coleção produtos não carregada
Um SELECT, dois models Categoria; totais 2/0; zero SELECTs extras no foreach.
Rollback executado.
```

WithCount disponibiliza o total e não carrega os models Produto relacionados.
RelationLoaded('produtos') foi conferido como false em cada categoria. Pelo mesmo
mecanismo de carregamento antecipado visto com with('categoria'), with('produtos')
disponibilizaria a coleção dos produtos. Com withCount, lemos somente a quantidade
pelo atributo adicional.

## Verificações e limites

Diagnóstico código 0; zero SELECTs na montagem, um após get e mesmo total após
foreach. Tipos Eloquent Collection/Categoria, IDs/nomes, totais 2/0 e relação
produtos sem carregar conferidos. Valores numéricos normalizados apenas na
comparação. Finally executou rollback.

Consultas posteriores pelo diagnóstico da 5.69 em processos PHP Docker separados
conferiram loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e
loja/loja_app com 0/1/3. Dados temporários removidos. Aplicação/testes preservados;
suíte não reexecutada. Última execução permanece 14 testes/54 asserções da 5.80.
Git diff --check passou; arquivos privados de ambiente fora do índice.

## Continuidade

5.91 confirmada com "entendi". Publicar e iniciar somente 5.92: revisão da entrega persistida, caminho GET /loja/LojaController/
Catalogo/binding/CatalogoEloquent/Produto/view loja, resposta HTTP e pendências
registradas do módulo 5. Sem iniciar módulo 6 ou concluir o módulo sem confirmação.
