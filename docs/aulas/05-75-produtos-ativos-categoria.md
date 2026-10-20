# Aula 5.75 — Consulta de produtos ativos da categoria

## Objetivo e estado

Acrescentar um filtro à consulta de produtos de uma categoria usando o método
do relacionamento. Implementação, explicação e verificações em 20/10/2026;
entendimento confirmado com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.74 confirmada com "entendi" e publicada em
5b9d80059fc54f412bdd32a095e404ce2d52c088. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração

Somente backend/tests/Feature/CategoriaProdutosTest.php alterado no código.
Terceiro cenário test_categoria_consulta_somente_seus_produtos_ativos adicionado;
imports, setUp, DatabaseTransactions e cenários anteriores preservados.

O cenário cadastra:

| Categoria | Produto | Status | Deve retornar? |
| --- | --- | --- | --- |
| Roupas | Camiseta | ativo | Sim |
| Roupas | Calça | inativo | Não, pelo status |
| Acessórios | Caneca | ativo | Não, pela categoria |

Categorias são criadas por Categoria::create. Produtos usam factory com nome e
categoria_id explícitos e preço fictício padrão. Camiseta/Caneca recebem status
ativo; Calça usa inativo()->create, estado já existente na ProdutoFactory.

Depois de recarregar a categoria por ID, o trecho central é:

```php
$roupas = Categoria::findOrFail($roupas->id);
$produtos = $roupas->produtos()
    ->where('status', 'ativo')
    ->get();

$this->assertCount(1, $produtos);
$this->assertSame([$camiseta->id], $produtos->modelKeys());
```

produtos() retorna o objeto de relacionamento, que já limita a consulta aos
produtos com categoria_id igual ao ID de Roupas. Where acrescenta a condição
status igual a ativo. Get executa a busca no banco e devolve uma coleção.

A condição pode ser entendida como WHERE categoria_id = ID_de_Roupas AND
status = 'ativo'; esse é um esboço conceitual, não uma transcrição do SQL gerado.

AssertCount exige um produto. ModelKeys extrai seus IDs e assertSame exige
exatamente o ID da Camiseta. Ter um ativo qualquer não basta: Caneca está em
outra categoria. Ter um produto qualquer de Roupas também não basta: Calça
está inativa.

Diferença de uso: $roupas->produtos carrega a coleção de produtos relacionados;
$roupas->produtos() permite compor a consulta antes de executá-la. Aqui o filtro
é aplicado no banco. Não estamos filtrando uma coleção já carregada em memória.
O método produtos/hasMany do model não mudou; o filtro vale para essa consulta.

## Comandos e verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CategoriaProdutosTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado; -T dispensa terminal interativo. PHP executa PHPUnit
instalado e o caminho seleciona esse arquivo. Testdox mostra os cenários,
colors=never remove cores e do-not-cache-result evita gravar cache de resultados
no código montado somente para leitura.

Resultado: OK (3 tests, 13 assertions), código 0. Cenário novo soma quatro:
duas asserções de identidade no setUp e duas sobre os produtos retornados.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sem caminho, executa a suíte completa configurada em phpunit.xml.
Resultado: OK (11 tests, 36 assertions), código 0.

Contagens posteriores pelo diagnóstico da 5.69, em processos PHP Docker separados:
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Rollback conferido. Git diff --check passou; arquivos privados de
ambiente fora do índice. Models, migrations, factory, seeders e serviços preservados.

## Continuidade

5.75 confirmada com "entendi". Publicar e iniciar somente 5.76: um cenário em ProdutoCategoriaTest criando produto sem
categoria e uma categoria, usando categoria()->associate($categoria), save e
recarga para conferir FK/relação persistidas. Explicar associação em memória e
gravação, com mesmo setUp/rollback e sem outros cenários nessa etapa seguinte.
