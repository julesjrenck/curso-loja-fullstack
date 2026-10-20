# Aula 5.51 — Factory no cenário de ordenação

## Objetivo e estado

Usar a factory nos dois cadastros do teste de ordenação, mantendo os nomes e
a ordem de inserção. Implementação, explicação e verificações em 19/10/2026;
entendimento confirmado com "entendi" em 19/10/2026.

A 5.50 foi confirmada com "entendi" e publicada em
10e723b30cd8d6906c8a4be95800952c4ca8fb97. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Código e relações

Somente backend/tests/Feature/CatalogoEloquentTest.php foi alterado no código,
no método existente:

```php
public function test_retorna_nomes_em_ordem_alfabetica(): void
{
    Produto::factory()->create([
        'nome' => 'Caneca',
        'status' => 'ativo',
    ]);

    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta', 'Caneca'], $catalogo->listarNomes());
}
```

Produto::factory() usa HasFactory no model para resolver ProdutoFactory.
Cada create recebe nome/status explícitos, que substituem os padrões da
definição. Os preços 2990 e 4990 foram retirados: cada produto recebe o preço
inteiro gerado pela factory, pois preço não participa da consulta de nomes.

Os nomes ficam fixos para termos uma expectativa previsível. Caneca é inserida
primeiro, Camiseta depois; o catálogo deve devolver Camiseta antes de Caneca.
CatalogoEloquent::listarNomes usa where('status', 'ativo'), orderBy('nome'),
pluck('nome') e all() para produzir o array. assertSame compara o conteúdo,
os tipos e a ordem: ['Caneca', 'Camiseta'] não atende à expectativa.

Não estamos impondo que SQL retorne linhas em ordem de inserção quando falta
orderBy: essa ordem não é garantida. A asserção verifica a ordem desejada da
saída produzida pela consulta atual.

Cada create persiste um registro durante o teste. O setUp continua verificando
loja_test/loja_testes; DatabaseTransactions desfaz a transação ao encerrar.
Com esta alteração, os cinco cadastros de produtos deste arquivo usam factory.

## Comandos e resultados

Teste alterado:

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --filter test_retorna_nomes_em_ordem_alfabetica --testdox --colors=never --do-not-cache-result
```

exec executa no serviço backend iniciado, -T dispensa terminal interativo e
PHP executa o PHPUnit instalado. O arquivo limita a busca; --filter seleciona
o cenário de ordenação. --testdox apresenta os cenários, --colors=never remove
cores e --do-not-cache-result evita gravar cache no código somente para leitura.

Resultado: OK (1 test, 3 assertions), código 0. Duas asserções conferem
banco/login no setUp; a terceira confere o array retornado pelo catálogo.

Suíte completa:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (6 tests, 14 assertions), código 0.

Após a suíte, o diagnóstico temporário enviado pela entrada padrão ao PHP do
container consultou identidade e contagens dos bancos:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

Os produtos dos testes não permaneceram após o rollback. O banco normal
mantém seu produto anterior. git diff --check passou; credenciais locais
continuam ignoradas e fora do índice. Nenhuma nova migration ou dependência.

## Continuidade

Entendimento da 5.51 confirmado. Publicar o checkpoint
e iniciar 5.52: adicionar um estado inativo em ProdutoFactory e conferir com
make em memória. Aplicar esse estado aos testes ficará para outra etapa.
