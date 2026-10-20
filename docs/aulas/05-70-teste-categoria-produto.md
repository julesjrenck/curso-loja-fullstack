# Aula 5.70 — Teste de leitura da categoria do produto

## Objetivo e estado

Cadastrar produto/categoria e conferir a categoria obtida pelo relacionamento.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026.

A 5.69 foi confirmada com "entendi" e publicada em
6292b4b5019d8a16f3868089ccae28d1b6afb29b. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Arquivo e preparação

Único arquivo funcional adicionado: backend/tests/Feature/ProdutoCategoriaTest.php.
Namespace Tests\Feature organiza a classe; imports disponibilizam os dois models,
trait de transações, facade DB e TestCase da aplicação Laravel.

DatabaseTransactions envolve cada cenário em transação e rollback. SetUp chama
parent::setUp e consulta DB_NAME/SUSER_SNAME, exigindo loja_test/loja_testes antes
dos cadastros. Essas duas asserções seguem o cuidado já usado no teste de catálogo.
Não houve mudança no TestCase compartilhado ou nos cenários anteriores.

## Cenário adicionado

```php
public function test_produto_carrega_sua_categoria(): void
{
    Categoria::create(['nome' => 'Acessórios']);
    $categoria = Categoria::create(['nome' => 'Roupas']);

    $produto = Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
        'categoria_id' => $categoria->id,
    ]);

    $produto = Produto::findOrFail($produto->id);
    $categoriaLida = $produto->categoria;

    $this->assertInstanceOf(Categoria::class, $categoriaLida);
    $this->assertSame($categoria->id, $categoriaLida->id);
    $this->assertSame('Roupas', $categoriaLida->nome);
}
```

Acessórios é cadastrada antes de Roupas para haver mais de uma categoria possível.
O cenário verifica a categoria apontada pela FK. Create retorna o model da
categoria salva e o banco gera seu ID; não supomos um número fixo.

ProdutoFactory fornece preço padrão. Nome/status e categoria_id são controlados
pelo teste. FindOrFail recarrega o produto pelo ID, de modo que a leitura seguinte
use os dados recuperados do banco, inclusive a referência persistida.

Categoria sem parênteses é uma propriedade de relacionamento interpretada pelo
Eloquent. Nesse primeiro acesso no produto recarregado, ele usa a definição de
categoria(), consulta categorias.id usando produtos.categoria_id e retorna um
model Categoria. Categoria() com parênteses devolve o objeto BelongsTo que
descreve/prepara a relação; são usos diferentes do mesmo relacionamento.

AssertInstanceOf verifica o tipo retornado; assertSame compara o ID da categoria
esperada e o nome Roupas. Acessar a categoria não exige que escrevamos uma consulta
manual nesse trecho. SQL Server e Eloquent estão sendo usados de verdade, sem mock.

## Comandos e resultados

Teste focado:

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/ProdutoCategoriaTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado, -T dispensa terminal interativo e PHP executa o
PHPUnit instalado. O caminho seleciona o arquivo novo; --testdox apresenta
cenários, --colors=never remove cores e --do-not-cache-result evita gravar cache
no código somente para leitura. Resultado: OK (1 test, 5 assertions), código 0.
São duas asserções de identidade e três de relacionamento.

Suíte completa:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (7 tests, 19 assertions), código 0. Consultas separadas após suíte
pelo diagnóstico de contagens da 5.69 confirmaram teste 0 categorias/0 produtos/
3 migrations e normal 0 categorias/1 produto/3 migrations. Rollback conferido.

Git diff --check passou; segredos continuam ignorados/fora do índice. Models,
migrations, factories, seeders e serviços preservados. Nenhum outro cenário ou
relação inversa acrescentado nesta etapa.

## Continuidade

5.70 confirmada com "entendi". Publicar o checkpoint concluído e iniciar 5.71: adicionar somente cenário de produto sem categoria, conferindo
categoria_id e relação como NULL, com o mesmo setUp/rollback e sem outros cenários.
