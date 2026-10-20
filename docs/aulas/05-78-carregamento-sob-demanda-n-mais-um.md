# Aula 5.78 — Carregamento sob demanda e problema N+1

## Objetivo e estado

Observar quantas consultas ocorrem ao listar produtos e acessar suas categorias.
Demonstração, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.77 confirmada com "entendi" e publicada em
7d94759bc56a862794443e504fd44c4a9cb2e7bd. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Onde foi executado

Somente documentação alterada no projeto. O exemplo foi executado no script
temporário /tmp/curso-578-n-mais-um.php, enviado ao PHP do container backend:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-578-n-mais-um.php
```

Exec usa o backend iniciado; -T dispensa terminal interativo. O redirecionamento
entrega o conteúdo do script local ao PHP no container. A aplicação recebe
--env=testing. O script carrega autoload/bootstrap de /app e confere ambiente,
DB_NAME e SUSER_SNAME antes dos cadastros, exigindo testing/loja_test/loja_testes.
O script temporário não é um arquivo da aplicação ou teste permanente.

## Preparação e medição

Uma transação cria Roupas/Acessórios e três produtos, usando Categoria::create e
Produto::factory()->create com nome/status/categoria_id explícitos:

| Produto | Categoria |
| --- | --- |
| Camiseta | Roupas |
| Calça | Roupas |
| Caneca | Acessórios |

Os IDs gerados são guardados em $ids. DB::listen observa QueryExecuted; uma flag
ativa a contagem apenas após os cadastros e inclui somente SELECTs. Assim, INSERTs,
consultas de identidade e consultas posteriores não entram no resultado.

Trecho central do diagnóstico, com os dados já preparados:

```php
$produtos = Produto::query()
    ->whereIn('id', $ids)
    ->orderBy('id')
    ->get();

foreach ($produtos as $produto) {
    $linhas[] = $produto->nome.' -> '.$produto->categoria->nome;
}
```

WhereIn limita a leitura aos produtos do diagnóstico. OrderBy usa ID para tornar
a ordem da demonstração previsível. Get executa uma consulta de produtos e monta
três objetos Produto. Ainda não foram carregados os objetos Categoria.

Ao acessar categoria pela primeira vez em cada produto, Eloquent usa belongsTo
para consultar essa categoria. É o carregamento sob demanda, também chamado
lazy loading. RelationLoaded('categoria') foi conferido como false antes e true
depois de cada primeiro acesso.

## Resultado observado

```text
Após get: 1 SELECT
Camiseta -> Roupas | SELECTs acumulados: 2
Calça -> Roupas | SELECTs acumulados: 3
Caneca -> Acessórios | SELECTs acumulados: 4
Confirmado: 1 SELECT de produtos + 3 SELECTs de categorias = 4.
Rollback executado.
```

O listener registrou uma consulta a produtos com WHERE id IN (?, ?, ?) e três
consultas SELECT TOP 1 a categorias, cada uma com WHERE categorias.id = ?.

Mesmo Camiseta e Calça apontando para Roupas, cada instância de Produto carregou
sua categoria separadamente. O primeiro acesso em um produto não preencheu a
relação do outro objeto Produto.

Esse padrão é chamado N+1: uma consulta busca a lista, e N consultas adicionais
buscam as categorias dos N produtos. Neste exemplo, N=3 e total=4. O problema
é o crescimento do número de consultas conforme aumenta a lista.

## Verificações e limites

O script exigiu três produtos, um SELECT após get, os três nomes de categoria
esperados e quatro SELECTs ao final. Código 0. Finally executou rollback mesmo
se alguma verificação falhasse.

Consultas posteriores pelo diagnóstico de contagens da 5.69, em processos PHP
Docker separados, conferiram loja_test/loja_testes com 0 categorias/0 produtos/
3 migrations e loja/loja_app com 0/1/3. Nenhum dado da demonstração permaneceu.

Aplicação e testes preservados; suíte não reexecutada nesta etapa. Última suíte:
13 testes/49 asserções na 5.77. Git diff --check passou; arquivos privados de
ambiente continuam fora do índice. Nenhuma dependência ou serviço adicionado.

## Continuidade

5.78 confirmada com "entendi". Publicar e iniciar somente 5.79: repetir diagnóstico com with('categoria'), explicar
carregamento antecipado e comparar 4 SELECTs com 2 para os mesmos dados/resultados,
com identidade conferida e rollback. Sem mudar catálogo ou adicionar serviços.
