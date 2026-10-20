# Aula 5.86 — GROUP BY com Query Builder

## Objetivo e estado

Expressar o agrupamento por categoria usando métodos do Query Builder.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.85 confirmada com "entendi" e publicada em
d797c48f93f53c94af8cb9a587d9a7881b088dee. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada. Script temporário
/tmp/curso-586-group-by-query-builder.php executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-586-group-by-query-builder.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Aplicação recebe --env=testing e carrega
autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes antes de
cadastro; não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas com Camiseta/Calça e Acessórios com Caneca. SQL agrupado
da 5.85 comparado ao Builder nos mesmos dados. DB::listen mede apenas SELECTs
da leitura, fora da preparação, com contador reiniciado entre casos.

## Consulta no Query Builder

```php
$linhas = DB::table('produtos')
    ->select('categoria_id')
    ->selectRaw('COUNT(*) as total')
    ->whereIn('categoria_id', [$roupas->id, $acessorios->id])
    ->groupBy('categoria_id')
    ->orderBy('categoria_id')
    ->get();
```

Select escolhe categoria_id. SelectRaw acrescenta a expressão SQL COUNT(*) AS
total à seleção. Nesse trecho, a expressão é texto SQL fixo escrito no código.
WhereIn limita às categorias da demonstração, passando seus IDs como parâmetros.
GroupBy define grupos pelo categoria_id. OrderBy ordena os grupos pelo ID.
Get executa a consulta e devolve a coleção com uma linha por grupo.

SelectRaw prepara uma parte do SELECT; ele não executa a consulta sozinho.
O diagnóstico guardou o builder antes de get e conferiu zero SELECTs até ali.
Após get houve um SELECT, com SQL observado equivalente a:

```sql
SELECT categoria_id, COUNT(*) AS total
FROM produtos
WHERE categoria_id IN (?, ?)
GROUP BY categoria_id
ORDER BY categoria_id ASC
```

Get devolve Collection de linhas stdClass com propriedades categoria_id/total.
Cada total é a contagem de produtos daquela categoria. O resultado contém dois
grupos; os produtos contados são três. Os nomes usados na exibição vêm de mapa
PHP dos models da preparação, sem JOIN ou consulta adicional.

## Resultado observado

```text
categoria_id=101 (Roupas) | total=2
categoria_id=102 (Acessórios) | total=1
SQL: 1 SELECT; Query Builder: 1 SELECT; mesmos dois grupos, totais 2/1.
Antes de get: zero SELECTs; retorno: Collection de linhas categoria_id/total.
Rollback executado.
```

101/102 foram IDs gerados nesta execução; verificações usam IDs dos models,
sem fixá-los. Valores numéricos normalizados para inteiros apenas na comparação.
SQL e Builder exigidos com mesmos IDs, totais e ordem, além dos valores esperados.

## Verificações e limites

Diagnóstico código 0; um SELECT por caso, zero antes de get no Builder, mesmos
grupos/totais 2/1, Collection/stdClass conferidos. Finally executou rollback.
Consultas posteriores pelo diagnóstico da 5.69 em processos PHP Docker separados
conferiram loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e
loja/loja_app com 0/1/3. Dados temporários removidos.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
14 testes/54 asserções da 5.80. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.86 confirmada com "entendi". Publicar e iniciar somente 5.87: HAVING COUNT(*) >= 2 em SQL parametrizado sobre grupos com
totais 2/1, exigindo só Roupas/2. Explicar WHERE filtra linhas e HAVING filtra
resultado dos grupos. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação ou combinar JOIN com agregação ainda.
