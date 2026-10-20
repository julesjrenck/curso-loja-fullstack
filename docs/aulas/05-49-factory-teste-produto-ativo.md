# Aula 5.49 — Factory no teste de produto ativo

## Objetivo e estado

Usar a factory para preparar o produto do cenário ativo, mantendo os atributos
necessários à expectativa sob controle. Implementação, explicação e verificação
em 19/10/2026; entendimento confirmado com "entendi" na mesma data.

A 5.48 foi confirmada com "entendi" após esclarecer que make foi executado
somente em um diagnóstico temporário. Checkpoint publicado em
d4657785aaa6b481cd241c3358b9f84a2ec437d6, conferido em HEAD, origin/main e
consulta direta à main remota após o push.

## Alteração e relações entre arquivos

Somente backend/tests/Feature/CatalogoEloquentTest.php foi alterado no código,
no método test_retorna_nome_do_produto_ativo:

```php
public function test_retorna_nome_do_produto_ativo(): void
{
    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta'], $catalogo->listarNomes());
}
```

Antes, Produto::create recebia nome, preço 4990 e status. Agora:

- Produto::factory() usa o HasFactory em app/Models/Produto.php e resolve
  database/factories/ProdutoFactory.php.
- A definição da factory fornece nome fictício, preço inteiro entre 100 e
  50000 centavos e status ativo. O array passado a create sobrescreve nome e
  status. O preço fica com o valor gerado, pois não é usado nessa expectativa.
- create monta o model e o salva no SQL Server; retorna o Produto persistido.
  O teste não precisa guardar o retorno em uma variável: o catálogo consulta
  o banco para buscar os nomes.
- CatalogoEloquent::listarNomes filtra ativos, ordena por nome e devolve um
  array de nomes. assertSame exige exatamente ['Camiseta'].

O nome precisa ser previsível para comparar o resultado. Status foi informado
explicitamente para declarar a condição que o cenário verifica, embora o
padrão atual também seja ativo. Um preço aleatório válido não muda o resultado
da consulta. Não há make no teste: precisamos de um registro para a consulta.

As checagens compartilhadas de banco/login no setUp continuam exigindo
loja_test/loja_testes antes de limpar os produtos. DatabaseTransactions abre
a transação no preparo e desfaz as alterações no encerramento do teste.
Os outros cenários continuam com Produto::create nesta etapa.

## Comandos e resultados

Teste alterado:

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --filter test_retorna_nome_do_produto_ativo --testdox --colors=never --do-not-cache-result
```

exec executa dentro do serviço backend já iniciado; -T dispensa terminal
interativo. PHP executa o PHPUnit instalado. O caminho seleciona o arquivo e
--filter restringe ao método alterado. --testdox apresenta os nomes dos
cenários, --colors=never remove códigos de cor e --do-not-cache-result evita
gravar cache no código montado como somente leitura.

Resultado: OK (1 test, 3 assertions), código 0. Duas asserções conferem
banco/login no setUp e uma confere o catálogo.

Suíte completa:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (6 tests, 14 assertions), código 0. São quatro cenários de
catálogo e dois exemplos existentes. Os testes seguem consultando SQL real.

Um script temporário enviado pela entrada padrão ao PHP do container consultou
DB_NAME(), SUSER_SNAME() e as contagens de produtos/migrations após a suíte:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

Isso confirma que os produtos dos testes não permaneceram após o rollback e
que o banco normal continua com seu produto anterior. git diff --check passou;
segredos locais continuam ignorados e fora do índice.

## Continuidade

Entendimento da 5.49 confirmado. Publicar o checkpoint
e iniciar 5.50: usar factory()->create nos dois cadastros do cenário de
ativo/inativo, controlando nome/status e conferindo resultado/rollback.
