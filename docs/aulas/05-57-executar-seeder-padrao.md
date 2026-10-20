# Aula 5.57 — Execução do seeder padrão com rollback

## Objetivo e estado

Conferir o caminho db:seed → DatabaseSeeder → ProdutoSeeder → cadastro da
Camiseta, no banco de testes e dentro de uma transação desfeita ao terminar.
Execução, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" na mesma data. Nenhum código da aplicação alterado.

A 5.56 foi confirmada com "entendi" e publicada em
07af1238a439706caa32d5f543c26bdfd16f88d2. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Local e comando da demonstração

O script temporário /tmp/curso-557-executar-seeder-padrao.php, no host, foi
enviado ao PHP do serviço backend pela entrada padrão:

```bash
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-557-executar-seeder-padrao.php
```

Exec executa no container já iniciado; -T dispensa terminal interativo. O shell
do host lê o arquivo com < e PHP o recebe por /dev/stdin. --env=testing é lido
ao inicializar Laravel, para selecionar o ambiente de testes.

Antes de qualquer cadastro, o script conferiu ambiente testing, conexão sqlsrv,
banco loja_test, login loja_testes, zero produtos, uma migration e nenhuma
transação aberta. Se uma dessas condições não fosse atendida, encerraria antes
de executar o seeder.

## Execução dentro da transação

Depois das checagens, o trecho central executado foi:

```php
$conexao->beginTransaction();
try {
    $codigo = $kernel->call('db:seed', [
        '--database' => 'sqlsrv',
        '--no-interaction' => true,
        '--no-ansi' => true,
    ]);

    // Aqui o diagnóstico consulta e confere o produto e o catálogo.
} finally {
    $conexao->rollBack();
}
```

$conexao é a conexão sqlsrv do Laravel, já conferida como loja_test/loja_testes.
$kernel é o kernel de console inicializado no script. Call executa o comando
Artisan registrado: --database escolhe a conexão, --no-interaction dispensa
perguntas e --no-ansi remove códigos de cor. Nenhuma opção --class foi passada;
assim a entrada padrão DatabaseSeeder foi usada. Não criamos novo comando na
aplicação. A implementação instalada de SeedCommand foi consultada para conferir
o uso da conexão já aberta.

DatabaseSeeder chamou ProdutoSeeder, que usou firstOrCreate. Como a tabela
estava vazia, houve cadastro de Camiseta com preço 4990 centavos e status ativo.
Durante a transação, o script consultou Produto e CatalogoEloquent; finally
desfez a transação, inclusive se alguma verificação lançasse exceção.

Esse rollback foi acrescentado pelo diagnóstico. Db:seed sozinho não desfaz
automaticamente seus cadastros, e a alteração era real no SQL Server, visível
à própria conexão durante a transação.

## Resultados

Artisan mostrou Database\Seeders\ProdutoSeeder RUNNING/DONE. O comando retornou
0 e um listener observou um INSERT na tabela produtos.

| Momento | Quantidade de produtos em loja_test |
| --- | --- |
| Antes da transação | 0 |
| Após db:seed, dentro da transação | 1 |
| Após rollback | 0 |

O model consultado tinha nome Camiseta, preço inteiro 4990, status ativo,
exists true e ID/datas preenchidos. CatalogoEloquent::listarNomes retornou
exatamente ['Camiseta']. Depois do rollback: uma migration e zero transações
abertas. Não prometemos reutilização do ID gerado: contadores de identidade do
SQL Server podem avançar mesmo quando a inserção é desfeita.

Consultas separadas, em novos processos PHP, confirmaram:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

O seeder não foi executado no banco normal. Nenhuma migration ou configuração
alterada. Git diff --check passou; segredos continuam ignorados e fora do índice.
Suíte não repetida após esta verificação dirigida; último resultado 6 testes/14
asserções continua sendo o da 5.53.

## Continuidade

Entendimento da 5.57 confirmado. Publicar o checkpoint
e iniciar 5.58: apresentar categorias e relação um para muitos com produtos,
explicando chave estrangeira na modelagem, sem criar tabelas/models ainda.
