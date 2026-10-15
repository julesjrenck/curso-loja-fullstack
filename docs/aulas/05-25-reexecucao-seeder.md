# Aula 5.25 — Reexecução sequencial do seeder

## Objetivo

Observar o seeder com firstOrCreate reutilizando a Camiseta existente.
A 5.24 foi confirmada com "entendi" em 15/10/2026 e publicada em 162b7aa,
SHA completo 162b7aa2837f10450b4825ece1513ae3a5395c9d, conferido na main remota.
Nenhum arquivo de código alterado nesta etapa.

## Como executamos a demonstração

Um diagnóstico temporário em PHP Docker inicializou Laravel e conferiu banco
loja, login loja_app e uma Camiseta id 1, preço 4990 e status ativo.
Guardou em memória os valores das seis colunas antes das reexecuções.

O diagnóstico chamou o comando pelo kernel do Artisan duas vezes em sequência:

```php
$kernel->call('db:seed', [
    '--class' => 'ProdutoSeeder',
    '--database' => 'sqlsrv',
    '--no-interaction' => true,
    '--no-ansi' => true,
]);
```

$kernel é o kernel de console do Laravel carregado no diagnóstico. call
executa um comando registrado; o array informa as opções. true ativa as
opções sem valor, como --no-ansi. O código retornado foi 0 em ambas as chamadas.
Isso executa o mesmo comando usado no terminal:

```bash
docker compose exec -T backend php artisan db:seed --class=ProdutoSeeder --database=sqlsrv --no-interaction --no-ansi
```

O diagnóstico foi enviado pela entrada padrão de docker compose exec -T
backend php. Não criamos comando novo no projeto nem salvamos um teste de
integração. Não é necessário conhecer o código interno do diagnóstico para
acompanhar o seeder; usamos essa forma para comparar cada resultado e capturar
o SQL no mesmo processo. O comando de cadastro foi chamado duas vezes no total.

## Resultado observado

| Momento | Quantidade | id | nome | preço em centavos | status |
| --- | --- | --- | --- | --- | --- |
| Antes | 1 | 1 | Camiseta | 4990 | ativo |
| Depois da execução 1 | 1 | 1 | Camiseta | 4990 | ativo |
| Depois da execução 2 | 1 | 1 | Camiseta | 4990 | ativo |

As datas também permaneceram exatamente iguais: created_at e updated_at
brutos em 2026-10-15 22:43:40.239. Nenhuma conversão de fuso aplicada.
Cada leitura após a chamada foi comparada com os seis campos originais;
não bastou conferir somente a quantidade.

As saídas do Artisan mostraram ProdutoSeeder RUNNING e DONE, respectivamente
49 ms e 2 ms; tempos são observações desta execução, não um desempenho garantido.

## O SQL explica o resultado

Um observador temporário de QueryExecuted capturou, em cada chamada do seeder,
exatamente uma consulta na conexão sqlsrv:

```sql
select top 1 * from [produtos] where ([nome] = ?)
```

O parâmetro recebido foi Camiseta. O ponto de interrogação é um marcador de
parâmetro: o valor é enviado separadamente em bindings, não concatenado no SQL.
SELECT lê, TOP 1 limita a um registro, * escolhe as colunas e WHERE filtra
pelo nome. O Eloquent gerou esse SQL para SQL Server; não o escrevemos no seeder.

Como a busca encontrou a Camiseta, firstOrCreate devolveu o model existente.
Não houve INSERT, UPDATE ou DELETE nas duas chamadas. Por isso o id e as
datas foram preservados. O segundo array não precisou ser usado para criar.

Nesse estado, repetir a operação preservou o resultado no banco: é um exemplo
de comportamento idempotente para essas reexecuções sequenciais. A conclusão
vale para o caminho de registro existente observado. Não demonstramos criação
quando ausente, atualização com preço diferente ou execuções simultâneas.
Os limites de nome sem unique explicados na 5.24 continuam válidos.

## Leitura posterior em outro processo

```bash
docker compose exec -T backend php artisan loja:consultar-produtos --no-ansi
```

Código 0, saída real:

```text
Produtos encontrados: 1
1 | Camiseta | 4990 centavos | ativo
```

Esta é uma leitura. Não reexecuta o seeder. O registro continua disponível
depois que o diagnóstico encerrou.

## Continuidade

Demonstração no banco da aplicação, com a Camiseta já existente, sem gerar
dados descartáveis. Testes SQL de integração terão banco exclusivo.
Sem alteração do produto, limpeza, rollback, DDL ou novo código. git diff
--check passou; configuração/credenciais, dependências e serviços preservados.
O catálogo HTTP ainda usa CatalogoDemonstracao em memória.

Execução, explicação e verificação da 5.25 concluídas. Entendimento confirmado
com "entendi" em 15/10/2026. Checkpoint preparado para publicação autorizada;
último publicado 162b7aa.

Próximo passo exato: publicar 5.25 e iniciar 5.26, criar
App\Services\CatalogoEloquent implementando App\Contracts\Catalogo, com
listarNomes lendo os nomes da tabela produtos. Apresentar implementação e
verificar leitura sem mudar ainda o binding em AppServiceProvider.

Fonte consultada em 15/10/2026:

- [Buscar ou criar models no Laravel 13](https://laravel.com/docs/13.x/eloquent#retrieving-or-creating-models).
