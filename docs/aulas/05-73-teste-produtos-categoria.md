# Aula 5.73 — Teste dos produtos de uma categoria

## Objetivo e estado

Conferir a leitura de produtos usando Categoria::produtos(), definida com hasMany.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.72 confirmada com "entendi" e publicada em
593cb81fc3e68e2f62f8706e0c8fdfff4f2b7626. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Arquivo adicionado

Somente backend/tests/Feature/CategoriaProdutosTest.php adicionado no código.
Namespace Tests\Feature organiza a classe que herda de Tests\TestCase. Imports
disponibilizam Categoria, Produto, Eloquent Collection, DatabaseTransactions e DB.

SetUp chama parent::setUp e consulta DB_NAME/SUSER_SNAME. Duas asserções exigem
loja_test/loja_testes antes dos cadastros. DatabaseTransactions envolve o cenário
em transação e desfaz as gravações ao terminar. É a preparação já utilizada no
teste da relação Produto->Categoria; TestCase compartilhado continua preservado.

O único cenário, test_categoria_carrega_somente_seus_produtos, prepara:

| Categoria | Produtos |
| --- | --- |
| Roupas | Camiseta, Calça |
| Acessórios | Caneca |

Categoria::create devolve o model salvo, com ID gerado pelo banco. Cada
Produto::factory()->create persiste um produto com nome, status e categoria_id
explícitos; a factory fornece o preço fictício. Os dois primeiros recebem
$roupas->id, enquanto Caneca recebe $acessorios->id. Não fixamos números de IDs.

Depois dos cadastros, o trecho central é:

```php
$roupas = Categoria::findOrFail($roupas->id);
$produtos = $roupas->produtos;

$this->assertInstanceOf(Collection::class, $produtos);
$this->assertCount(2, $produtos);
$this->assertEqualsCanonicalizing(
    [$camiseta->id, $calca->id],
    $produtos->modelKeys()
);
```

FindOrFail busca a categoria novamente pelo ID. A propriedade produtos usa a
definição de hasMany para buscar os produtos cujo categoria_id aponta para ela.
Recebemos uma coleção de models Produto, e não um produto único.

AssertInstanceOf verifica a coleção Eloquent. AssertCount exige dois elementos.
ModelKeys devolve um array com as chaves primárias dos models da coleção.
AssertEqualsCanonicalizing compara seu conteúdo aos IDs esperados sem exigir
ordem. Assim, ter dois produtos quaisquer não basta: precisam ser Camiseta e
Calça. A Caneca não pode estar nessa coleção. O relacionamento não define ordem.

## Comandos e verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CategoriaProdutosTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado; -T dispensa terminal interativo. PHP executa PHPUnit
instalado e o caminho seleciona somente o arquivo novo. Testdox apresenta nomes
dos cenários, colors=never remove cores e do-not-cache-result evita cache de
resultados no código montado somente para leitura.

Resultado: OK (1 test, 5 assertions), código 0. São duas asserções de identidade
e três de comportamento da coleção retornada.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem o caminho, executa a suíte completa configurada em phpunit.xml.
Resultado: OK (9 tests, 28 assertions), código 0.

Diagnóstico de contagens da 5.69 em processos PHP Docker separados após suíte:
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Rollback conferido; nenhum cadastro de teste permaneceu.
Git diff --check passou; arquivos privados de ambiente fora do índice. Models,
migrations, factories, seeders, testes existentes e serviços preservados.

## Continuidade

5.73 confirmada com "entendi". Publicar e iniciar somente 5.74: adicionar cenário de categoria sem produtos no mesmo
arquivo, recarregando categoria e conferindo coleção vazia com o mesmo setUp
e rollback. Sem outros cenários nessa etapa.
