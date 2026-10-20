# Aula 5.50 — Factory no cenário de ativo/inativo

## Objetivo e estado

Preparar dois produtos pela factory e controlar os status necessários para
verificar o filtro do catálogo. Implementação, explicação e verificações em
19/10/2026; entendimento confirmado com "entendi" na mesma data.

A 5.49 foi confirmada com "entendi" e publicada em
9a08b80eec48aad16cd233bdff2be54dc8ac3acc. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Código e relações

Somente backend/tests/Feature/CatalogoEloquentTest.php foi alterado no código,
no cenário já existente:

```php
public function test_omite_produtos_inativos_do_catalogo(): void
{
    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    Produto::factory()->create([
        'nome' => 'Caneca',
        'status' => 'inativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta'], $catalogo->listarNomes());
}
```

Cada chamada usa HasFactory no model Produto para obter ProdutoFactory. Sua
definition fornece nome/preço fictícios e status ativo. O array de create
substitui os atributos informados. Na segunda chamada, inativo substitui o
ativo padrão: não precisamos alterar a definição para preparar esse cenário.
Os preços explícitos 4990 e 2990 foram retirados; o preço gerado não participa
da consulta de nomes.

Cada create salva um produto no SQL Server. Durante o teste, existem uma
Camiseta ativa e uma Caneca inativa. CatalogoEloquent::listarNomes filtra
status ativo, ordena por nome e retorna um array. A asserção exige exatamente
['Camiseta']; devolver também Caneca faria o cenário falhar.

O setUp continua conferindo loja_test/loja_testes antes da limpeza. O trait
DatabaseTransactions desfaz os cadastros no encerramento de cada teste.
O cadastro único da 5.49 já usa factory; os dois do cenário de ordenação
continuam com Produto::create, aguardando a próxima etapa.

## Verificações

Teste alterado, executado no PHP do serviço backend:

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --filter test_omite_produtos_inativos_do_catalogo --testdox --colors=never --do-not-cache-result
```

exec executa no container iniciado; -T dispensa terminal interativo. O caminho
seleciona o arquivo; --filter restringe ao cenário alterado. --testdox mostra
os cenários, --colors=never evita códigos de cor e --do-not-cache-result evita
gravar cache no código montado somente para leitura.

Resultado: OK (1 test, 3 assertions), código 0. Duas asserções são as checagens
de banco/login do setUp; a terceira compara os nomes retornados.

Suíte completa:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (6 tests, 14 assertions), código 0.

Após a suíte, um diagnóstico temporário enviado pela entrada padrão ao PHP
do container consultou a identidade do banco e as contagens:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

Os cadastros dos testes não permaneceram após o rollback. O banco normal
continua com o produto anterior. git diff --check passou; credenciais locais
continuam ignoradas e fora do índice. Nenhuma nova dependência ou migration.

## Continuidade

Entendimento da 5.50 confirmado. Publicar o checkpoint
e iniciar 5.51: usar factory nos dois cadastros do cenário de ordenação,
preservando ordem de inserção e expectativa e verificando resultado/rollback.
