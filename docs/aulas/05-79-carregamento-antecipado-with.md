# Aula 5.79 — Carregamento antecipado com with

## Objetivo e estado

Carregar antecipadamente as categorias dos produtos e comparar as consultas
com o carregamento sob demanda. Demonstração, explicação e verificações em
20/10/2026; entendimento confirmado com "entendi" em 20/10/2026. Checkpoint
concluído para publicação.

5.78 confirmada com "entendi" e publicada em
55d0045667f7fe0f16ac9a3b3caa501938691b1c. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde e como foi executado

Somente documentação alterada no projeto. Demonstração no script temporário
/tmp/curso-579-carregamento-antecipado.php, executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-579-carregamento-antecipado.php
```

Exec usa o backend iniciado; -T dispensa terminal interativo. Redirecionamento
entrega o script local ao PHP no container. A aplicação recebe --env=testing e
carrega autoload/bootstrap de /app. Script exige testing/loja_test/loja_testes,
conferidos antes dos cadastros. Não é arquivo da aplicação ou teste permanente.

Transação prepara Roupas/Acessórios e Camiseta/Calça/Caneca, conforme a 5.78.
IDs gerados limitam a leitura por whereIn. DB::listen conta somente SELECTs após
preparação, com contador reiniciado entre os dois casos. Cada caso executa get
novamente, recebendo novas instâncias, sem aproveitar relações do caso anterior.

## Consulta com carregamento antecipado

Trecho central do caso com with, depois da preparação dos dados:

```php
$produtos = Produto::query()
    ->whereIn('id', $ids)
    ->orderBy('id')
    ->with('categoria')
    ->get();

foreach ($produtos as $produto) {
    $linhas[] = $produto->nome.' -> '.$produto->categoria->nome;
}
```

With recebe o nome do relacionamento, categoria, definido em Produto::categoria().
Pede ao Eloquent que carregue as categorias junto com o processamento da busca.
Get executa as consultas e devolve a coleção com as relações já carregadas.

Nesta busca, Eloquent executa uma consulta de produtos e outra de categorias,
usando WHERE categorias.id IN (IDs das duas categorias). Depois liga cada model
Categoria aos produtos correspondentes usando categoria_id/id. Assim, no foreach,
os objetos Categoria já estão disponíveis em memória.

Esse comportamento é chamado carregamento antecipado, também conhecido como
eager loading. O resultado de negócio continua igual; diminui a quantidade de
consultas ao banco para esta leitura.

## Resultado observado

```text
Sem with: após get = 1; após foreach = 4 SELECTs
Camiseta -> Roupas | Calça -> Roupas | Caneca -> Acessórios
Com with: após get = 2; após foreach = 2 SELECTs
Camiseta -> Roupas | Calça -> Roupas | Caneca -> Acessórios
Resultados iguais, consultas reduzidas de 4 para 2; foreach com with não acrescentou SELECTs.
Rollback executado.
```

| Caso | Após get | Após foreach |
| --- | ---: | ---: |
| Sob demanda | 1 SELECT | 4 SELECTs |
| Com with('categoria') | 2 SELECTs | 2 SELECTs |

RelationLoaded('categoria') foi conferido false antes dos acessos no primeiro
caso e true no segundo. O script exigiu três produtos, nomes corretos nos dois
casos e totais de consultas esperados. Código 0.

## Verificações e limites

Finally executou rollback. Consultas posteriores pelo diagnóstico da 5.69 em
processos PHP Docker separados conferiram loja_test/loja_testes com 0 categorias/
0 produtos/3 migrations e loja/loja_app com 0/1/3. Nenhum dado temporário permaneceu.

Aplicação/testes preservados; suíte não reexecutada. Última execução permanece
13 testes/49 asserções da 5.77. Git diff --check passou; arquivos privados de
ambiente fora do índice. Sem dependências ou serviços novos.

## Continuidade

5.79 confirmada com "entendi". Publicar e iniciar somente 5.80: um cenário permanente em ProdutoCategoriaTest com
with('categoria'), vários produtos/duas categorias, resultados corretos e duas
consultas de leitura, sem SQL adicional no foreach. Medição após fixtures e
desativada ao final; mesmo setUp/rollback, sem mudanças na aplicação.
