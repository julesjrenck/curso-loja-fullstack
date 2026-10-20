# Aula 5.42 — Produto ativo e preparação compartilhada

## Objetivo e estado

Verificar o retorno de um produto ativo e compartilhar a preparação entre
os dois cenários de CatalogoEloquentTest. Implementação, explicação e
verificações em 19/10/2026; entendimento confirmado com "entendi" nessa data.

A 5.41 foi confirmada com "entendi" e publicada em 94e4e3d. HEAD, origin/main
e consulta direta à main remota retornaram
94e4e3dff652e5c76b74064b0e43b12f4d6573c6 após o push.

## Preparação antes de cada teste

Somente backend/tests/Feature/CatalogoEloquentTest.php foi alterado.
A conferência da conexão e o DELETE foram movidos para:

```php
protected function setUp(): void
{
    parent::setUp();

    $identidade = DB::selectOne(
        'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
    );

    $this->assertSame('loja_test', $identidade->banco);
    $this->assertSame('loja_testes', $identidade->login);

    Produto::query()->delete();
}
```

setUp é um método do ciclo de testes: PHPUnit o chama antes de cada método
de teste. protected permite seu uso na hierarquia de classes; void mantém
a assinatura do método herdado. Não precisamos chamar setUp dentro dos testes.

parent::setUp chama a preparação herdada de Tests\TestCase/Laravel. Isso
inicializa a aplicação e aciona DatabaseTransactions antes da preparação
adicionada nesta classe. Assim as verificações de destino continuam antes
de DELETE e cada cenário recebe produtos vazia dentro da sua própria transação.

O cenário vazio continua exigindo [] de listarNomes. A preparação compartilhada
evita repetir o mesmo trecho em cada método e será executada novamente para
o cenário de produto ativo. Cada execução tem seu rollback ao terminar.

## Novo cenário

```php
public function test_retorna_nome_do_produto_ativo(): void
{
    Produto::create([
        'nome' => 'Camiseta',
        'preco_em_centavos' => 4990,
        'status' => 'ativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta'], $catalogo->listarNomes());
}
```

Produto::create grava um produto real em loja_test dentro da transação atual.
Usa os atributos permitidos pelo model: nome, preço em centavos e status.
4990 representa R$ 49,90. O nome do produto é o mesmo do exemplo da loja,
mas o registro desta preparação pertence exclusivamente ao banco de testes.

Depois o serviço listarNomes consulta produtos por Eloquent, filtrando ativos,
e retorna o array de nomes. assertSame exige exatamente ['Camiseta'], incluindo
tipo e conteúdo. Esse caso verifica um único produto ativo; filtro de inativos
e ordenação terão cenários próprios.

Ao terminar, rollback desfaz a inserção e a preparação. Cada teste controla
os dados de que precisa, sem depender do registro criado pelo outro cenário.
Serviço, model, configurações, migrations e seeders foram preservados.

## Verificações realizadas

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoEloquentTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --order-by=reverse --testdox --colors=never --do-not-cache-result
```

Sintaxe passou. Execução focada passou com OK (2 tests, 6 assertions), código 0.
São duas verificações de destino em setUp para cada teste e uma asserção de
comportamento em cada método, totalizando seis.

A suíte completa usou --order-by=reverse para executar em ordem inversa,
verificando a convivência dos casos em outra sequência. Resultado:
OK (4 tests, 8 assertions), código 0. Dois cenários do catálogo mais os dois
exemplos já existentes. As demais flags são as estudadas na 5.39.

SELECT separado após a suíte confirmou zero produtos em loja_test, esquema
produtos e registro de migration preservados. A inserção da Camiseta foi
desfeita. Consulta normal confirmou loja/loja_app com um produto e uma migration.

git diff --check passou; segredos seguem ignorados/fora do índice. Nenhuma
nova dependência, migration, seeder, conta ou credencial. Esta etapa mudou
apenas o arquivo de teste e os registros da aula.

## Continuidade

Entendimento da 5.42 confirmado com "entendi" em 19/10/2026. Publicar o checkpoint
e iniciar 5.43, acrescentando um cenário com produto ativo e inativo para
verificar que somente o ativo aparece. Não antecipar o teste de ordenação.
