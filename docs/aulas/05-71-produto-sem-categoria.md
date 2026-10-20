# Aula 5.71 — Produto sem categoria

## Objetivo e estado

Conferir como o relacionamento se comporta quando o produto não tem categoria.
Implementação, explicação e verificações em 20/10/2026. Entendimento confirmado
com "entendi" em 20/10/2026; checkpoint concluído para publicação.

A 5.70 foi confirmada com "entendi" e publicada em
68b586fb05548f70a1a0b7160ce4bd2e8985e2c2. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração e explicação

Somente backend/tests/Feature/ProdutoCategoriaTest.php alterado no código.
Acrescentado um segundo cenário, preservando o primeiro, o setUp que verifica
loja_test/loja_testes e o trait DatabaseTransactions.

```php
public function test_produto_sem_categoria_retorna_relacao_nula(): void
{
    $produto = Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    $produto = Produto::findOrFail($produto->id);

    $this->assertNull($produto->categoria_id);
    $this->assertNull($produto->categoria);
}
```

Factory fornece preço fictício; nome e status são controlados pelo cenário.
Nem o array nem ProdutoFactory definem categoria_id. A coluna aceita NULL desde
a migration da 5.64, já aplicada nos dois bancos. Create persiste o produto.

FindOrFail busca novamente o produto pelo ID para verificar os valores persistidos.
O produto existe, mas não aponta para uma categoria: essa ausência não equivale
a nome vazio ou ID zero. No banco fica NULL; em PHP recebemos null.

Primeira asserção confere a chave estrangeira. A segunda confere o comportamento
do relacionamento definido em Produto::categoria(): com FK null, a propriedade
$produto->categoria retorna null. Não recebemos um model Categoria nem tentamos
ler seu nome. AssertNull exige que o valor seja realmente null.

DatabaseTransactions desfaz o cadastro ao final do cenário. Nenhum model,
migration, factory, seeder ou serviço foi alterado.

## Verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/ProdutoCategoriaTest.php --testdox --colors=never --do-not-cache-result
```

Exec executa no backend iniciado; -T dispensa terminal interativo. PHP executa
PHPUnit instalado; o caminho seleciona os dois cenários do arquivo. Testdox
apresenta os nomes dos cenários, colors=never remove cores e do-not-cache-result
evita gravar cache no código montado somente para leitura.

Resultado: OK (2 tests, 9 assertions), código 0. O cenário novo soma quatro
asserções: duas de identidade no setUp e duas assertNull.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem o caminho do arquivo, executa toda a suíte configurada no phpunit.xml.
Resultado: OK (8 tests, 23 assertions), código 0.

Diagnóstico de contagens da 5.69 executado pelo PHP Docker em processos separados,
com --env=testing e sem essa opção, após a suíte. Conferiu loja_test/loja_testes
com 0 categorias/0 produtos/3 migrations e loja/loja_app com 0/1/3.
Git diff --check passou; arquivos locais privados continuam fora do índice.

## Continuidade

5.71 confirmada com "entendi". Publicar e iniciar somente 5.72: definir Categoria::produtos() com hasMany, explicando a
direção inversa e conferindo sua configuração em memória. Testar a relação
inversa com registros fica para outra etapa.
