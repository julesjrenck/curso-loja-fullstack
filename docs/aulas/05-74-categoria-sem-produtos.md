# Aula 5.74 — Categoria sem produtos

## Objetivo e estado

Verificar o retorno de hasMany quando a categoria ainda não tem produtos.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.73 confirmada com "entendi" e publicada em
6ad0d19d0628b99647c0d562eafaadf3a55863ce. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração

Somente backend/tests/Feature/CategoriaProdutosTest.php alterado no código.
O primeiro cenário, imports, setUp e DatabaseTransactions foram preservados.
Acrescentado este segundo cenário:

```php
public function test_categoria_sem_produtos_retorna_colecao_vazia(): void
{
    $categoria = Categoria::create(['nome' => 'Roupas']);

    $categoria = Categoria::findOrFail($categoria->id);
    $produtos = $categoria->produtos;

    $this->assertInstanceOf(Collection::class, $produtos);
    $this->assertCount(0, $produtos);
}
```

Create cadastra a categoria e devolve seu model com ID. Nenhum produto é cadastrado.
FindOrFail busca a categoria novamente pelo ID; ela existe no banco. A propriedade
produtos usa hasMany para procurar produtos com categoria_id igual a esse ID.

Como não há produtos associados, recebemos uma coleção Eloquent vazia.
AssertInstanceOf exige esse tipo e assertCount exige zero elementos. O retorno
continua sendo uma coleção, que pode ter zero, um ou vários produtos.

Comparação com 5.71: belongsTo busca uma categoria e retorna null se o produto
estiver sem associação; hasMany busca vários produtos e retorna coleção vazia
se nenhum estiver associado. Essa diferença acompanha o formato de cada relação.

SetUp confere loja_test/loja_testes antes do cadastro, e DatabaseTransactions
desfaz a categoria ao terminar o cenário. Models, migrations, factory e serviços
não precisaram de alteração.

## Comandos e verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CategoriaProdutosTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o container backend iniciado e -T dispensa terminal interativo. PHP
executa PHPUnit instalado; o caminho seleciona os dois cenários desse arquivo.
Testdox mostra seus nomes, colors=never remove cores e do-not-cache-result evita
cache de resultados no código montado somente para leitura.

Resultado: OK (2 tests, 9 assertions), código 0. O novo cenário soma quatro:
duas asserções de identidade no setUp e duas de coleção vazia.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem caminho de arquivo, executa a suíte completa configurada em phpunit.xml.
Resultado: OK (10 tests, 32 assertions), código 0.

Consultas posteriores pelo diagnóstico de contagens da 5.69, em processos PHP
Docker separados: loja_test/loja_testes com 0 categorias/0 produtos/3 migrations
e loja/loja_app com 0/1/3. Rollback conferido. Git diff --check passou e arquivos
privados de ambiente continuam fora do índice.

## Continuidade

5.74 confirmada com "entendi". Publicar e iniciar somente 5.75: um cenário no mesmo arquivo usando
$categoria->produtos()->where('status', 'ativo')->get(). Cadastrar ativo/inativo
da categoria e ativo de outra categoria, exigindo somente o ativo da primeira.
Explicar método para acrescentar filtro e get para executar, com mesmo setUp e
rollback, sem outros cenários ou mudanças em model.
