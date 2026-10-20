# Aula 5.76 — Associar produto à categoria

## Objetivo e estado

Associar um produto existente a uma categoria usando o relacionamento belongsTo.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.75 confirmada com "entendi" e publicada em
617408b86bb0aa90b23f2704d81870d3d9c7a489. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração e explicação

Somente backend/tests/Feature/ProdutoCategoriaTest.php alterado no código.
Imports, setUp com identidade loja_test/loja_testes, DatabaseTransactions e os
dois primeiros cenários foram preservados. Acrescentado:

```php
public function test_produto_pode_ser_associado_a_uma_categoria(): void
{
    $produto = Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);
    $categoria = Categoria::create(['nome' => 'Roupas']);

    $produto->categoria()->associate($categoria);

    $this->assertSame($categoria->id, $produto->categoria_id);
    $this->assertNull(Produto::findOrFail($produto->id)->categoria_id);

    $produto->save();
    $produto = Produto::findOrFail($produto->id);

    $this->assertSame($categoria->id, (int) $produto->categoria_id);
    $this->assertSame($categoria->id, $produto->categoria->id);
}
```

Factory cria Camiseta sem categoria, com preço fictício. Categoria::create salva
Roupas e devolve seu model com ID. Categoria() retorna BelongsTo, que oferece o
método associate. Ao receber o model da categoria, associate preenche a FK do
produto em memória e disponibiliza essa categoria no relacionamento do objeto.

A primeira asserção confere o ID preenchido no objeto. A segunda busca outra
instância do produto pelo ID e confere que o banco ainda contém NULL; essa busca
não substitui $produto, portanto preservamos o objeto com a alteração em memória.

Save grava a alteração do produto existente. Não cria outra Camiseta. FindOrFail
recarrega o registro salvo, e as últimas duas asserções conferem FK e categoria
obtida pelo relacionamento a partir desse produto recarregado.

## Diferença de tipo encontrada

Na primeira execução, a asserção da FK recarregada falhou porque o driver retornou
essa coluna BIGINT como texto, enquanto o ID do model Categoria era inteiro.
AssertSame verifica tanto valor quanto tipo. Na memória, associate havia recebido
o ID inteiro; depois da leitura, a FK sem cast próprio era uma string numérica.

Corrigida somente a comparação da FK recarregada: (int) converte esse valor para
inteiro na asserção. O model e o schema não foram alterados. O cast de preço já
existente também não mudou. O teste passa a comparar os IDs como inteiros.

Primeira execução focada: 3 testes/14 asserções e uma falha; primeira suíte:
12 testes/41 asserções e uma falha. Depois do ajuste, resultados abaixo.

## Comandos e resultados finais

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/ProdutoCategoriaTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado; -T dispensa terminal interativo. PHP executa PHPUnit
instalado e o caminho seleciona o arquivo. Testdox apresenta cenários,
colors=never remove cores e do-not-cache-result evita cache de resultados no
código montado somente para leitura.

Resultado final: OK (3 tests, 15 assertions), código 0. Cenário novo soma seis:
duas de identidade, duas antes de save e duas depois de save/recarga.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem caminho, executa toda a suíte configurada em phpunit.xml.
Resultado final: OK (12 tests, 42 assertions), código 0.

Consultas posteriores pelo diagnóstico de contagens da 5.69, em processos PHP
Docker separados: loja_test/loja_testes com 0 categorias/0 produtos/3 migrations
e loja/loja_app com 0/1/3. Rollback conferido. Git diff --check passou; arquivos
privados de ambiente fora do índice. Models, migrations, factory e serviços
preservados; não houve cadastro permanente de dados do teste.

## Continuidade

5.76 confirmada com "entendi". Publicar e iniciar somente 5.77: cenário com produto já associado, usando
categoria()->dissociate(), save e recarga para conferir FK/relação null e categoria
preservada. Mesmo setUp/rollback, sem outros cenários nessa etapa seguinte.
