# Aula 5.53 — Estado inativo aplicado ao teste

## Objetivo e estado

Usar o estado inativo da factory no cenário que verifica o filtro do catálogo.
Implementação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" na mesma data.

A 5.52 foi confirmada com "entendi" e publicada em
edd34114bb9943bf6860a324368cee4739388d4e. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Alteração e fluxo dos dados

Somente backend/tests/Feature/CatalogoEloquentTest.php foi alterado no código,
no cadastro da Caneca de test_omite_produtos_inativos_do_catalogo:

```php
Produto::factory()->inativo()->create([
    'nome' => 'Caneca',
]);
```

Antes, esse cadastro passava status inativo diretamente no array. Agora:

1. factory usa HasFactory no model Produto para obter ProdutoFactory.
2. inativo chama state, preparando a substituição do status ativo padrão.
3. create recebe o nome Caneca e salva o produto com status inativo e preço
   vindo de definition. O retorno é o model persistido; não precisamos guardar
   esse retorno porque o catálogo consulta os registros no banco.

A Camiseta continua sendo cadastrada com nome/status explícitos. A expectativa
permanece:

```php
$catalogo = new CatalogoEloquent;
$this->assertSame(['Camiseta'], $catalogo->listarNomes());
```

CatalogoEloquent filtra status ativo. A Caneca existe durante o cenário, mas
não deve aparecer no resultado. O método inativo é chamado no arquivo de teste
do projeto nesta etapa; a demonstração da 5.52 havia sido apenas temporária.

SetUp continua conferindo banco loja_test/login loja_testes antes da limpeza.
DatabaseTransactions desfaz os cadastros ao encerrar cada cenário.

## Comandos e resultados

Teste alterado:

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --filter test_omite_produtos_inativos_do_catalogo --testdox --colors=never --do-not-cache-result
```

exec executa no serviço backend iniciado; -T dispensa terminal interativo.
PHP executa o PHPUnit instalado, o caminho seleciona o arquivo e --filter
restringe ao método alterado. --testdox apresenta cenários, --colors=never
remove cores e --do-not-cache-result evita cache no código somente para leitura.

Resultado: OK (1 test, 3 assertions), código 0. Duas asserções conferem
banco/login no setUp e a terceira confere a saída do catálogo.

Suíte completa:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (6 tests, 14 assertions), código 0. O cenário alterado agora
exercita o método inativo junto à persistência e ao filtro reais.

SELECT posterior pelo diagnóstico temporário de contagens confirmou:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

Rollback conferido; banco normal mantém o produto anterior. git diff --check
passou; credenciais locais continuam ignoradas e fora do índice.

## Continuidade

Entendimento da 5.53 confirmado. Publicar o checkpoint
e iniciar 5.54: apresentar DatabaseSeeder existente, distinguir seeders,
factories e migrations e analisar dependências, sem executar db:seed.
