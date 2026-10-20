# Aula 5.77 — Dissociar produto da categoria

## Objetivo e estado

Remover a ligação de um produto com uma categoria, preservando os dois registros.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.76 confirmada com "entendi" e publicada em
07302047a83fa48c66b619403a85e0690056d7f8. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração e explicação

Somente backend/tests/Feature/ProdutoCategoriaTest.php alterado no código.
Imports, setUp com identidade loja_test/loja_testes, DatabaseTransactions e os
três primeiros cenários preservados. Acrescentado:

```php
public function test_produto_pode_ficar_sem_categoria_apos_dissociacao(): void
{
    $categoria = Categoria::create(['nome' => 'Roupas']);
    $produto = Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
        'categoria_id' => $categoria->id,
    ]);

    $produto->categoria()->dissociate();

    $this->assertNull($produto->categoria_id);
    $this->assertSame(
        $categoria->id,
        (int) Produto::findOrFail($produto->id)->categoria_id
    );

    $produto->save();
    $produto = Produto::findOrFail($produto->id);

    $this->assertNull($produto->categoria_id);
    $this->assertNull($produto->categoria);
    $this->assertSame($categoria->id, Categoria::findOrFail($categoria->id)->id);
}
```

Categoria::create cadastra Roupas. Factory cria Camiseta já ligada a ela pelo
categoria_id, com preço fictício padrão. Categoria() devolve BelongsTo, que
oferece dissociate. Esse método coloca categoria_id como null no objeto PHP e
remove a associação em memória. A coluna aceita NULL desde a migration anterior.

Antes de save, assertNull confere a FK em memória. A leitura separada do produto
por findOrFail ainda encontra o ID de Roupas no banco. Essa busca não substitui
$produto; preservamos o objeto que contém a alteração pendente de gravação.
Usamos (int) na comparação da FK numérica, conforme a diferença de tipo encontrada
na 5.76. Não foi alterado cast no model.

Save grava categoria_id NULL no produto existente. FindOrFail recarrega a Camiseta
para conferir o valor persistido. Asserções exigem FK null e propriedade categoria
null. A busca de Roupas e comparação do ID comprovam que ela continua cadastrada.

O produto também permanece no banco, pois foi encontrado novamente pelo ID.
Dissociate remove a associação; não executa exclusão do produto ou da categoria.

## Comandos e verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/ProdutoCategoriaTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado; -T dispensa terminal interativo. PHP executa PHPUnit
instalado e o caminho seleciona o arquivo. Testdox mostra os cenários,
colors=never remove cores e do-not-cache-result evita cache de resultados no
código montado somente para leitura.

Resultado: OK (4 tests, 22 assertions), código 0. Cenário novo soma sete:
duas asserções de identidade, duas antes de save e três depois de save/recarga.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem caminho, executa toda a suíte configurada em phpunit.xml.
Resultado: OK (13 tests, 49 assertions), código 0.

Consultas posteriores pelo diagnóstico de contagens da 5.69, em processos PHP
Docker separados: loja_test/loja_testes com 0 categorias/0 produtos/3 migrations
e loja/loja_app com 0/1/3. DatabaseTransactions desfez os dados do teste.
Git diff --check passou; arquivos privados de ambiente fora do índice. Models,
migrations, factory, seeders e serviços preservados.

## Continuidade

5.77 confirmada com "entendi". Publicar e iniciar somente 5.78: demonstrar carregamento sob demanda e problema N+1 numa
lista de produtos/categorias, com diagnóstico temporário em loja_test, identidade
conferida, transação/rollback e contagem dos SELECTs apenas da leitura. Preparação
dos dados fora da medição; sem otimização ou mudança na aplicação ainda.
