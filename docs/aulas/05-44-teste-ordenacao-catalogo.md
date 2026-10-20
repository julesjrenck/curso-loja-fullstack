# Aula 5.44 — Teste da ordenação dos nomes do catálogo

## Objetivo e estado

Verificar a ordem alfabética dos nomes com dois produtos ativos cadastrados
em outra sequência. Implementação, explicação e verificações em 19/10/2026;
entendimento confirmado com "entendi" em 19/10/2026.

A 5.43 foi confirmada com "entendi" e publicada em 62f465e. HEAD, origin/main
e consulta direta à main remota retornaram
62f465e0d1c266d61fb534bb895e4968ac327276 após o push.

## Cenário adicionado

Somente um método foi acrescentado a
backend/tests/Feature/CatalogoEloquentTest.php:

```php
public function test_retorna_nomes_em_ordem_alfabetica(): void
{
    Produto::create([
        'nome' => 'Caneca',
        'preco_em_centavos' => 2990,
        'status' => 'ativo',
    ]);

    Produto::create([
        'nome' => 'Camiseta',
        'preco_em_centavos' => 4990,
        'status' => 'ativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta', 'Caneca'], $catalogo->listarNomes());
}
```

O setUp continua preparando produtos vazia após conferir banco/login, dentro
da transação de DatabaseTransactions. As duas chamadas Produto::create
cadastram primeiro Caneca e depois Camiseta, ambas ativas. Assim os dois
registros devem participar do resultado, permitindo observar a ordem.

A expectativa começa por Camiseta, porque ela vem antes de Caneca na ordem
alfabética. Se o retorno for ['Caneca', 'Camiseta'], assertSame falhará, mesmo
com os dois nomes presentes. A comparação de arrays exige conteúdo, tipo e
ordem correspondentes.

O serviço existente já usa orderBy('nome'), que produz ordenação ascendente
por nome no SQL Server. pluck('nome') e all() devolvem os nomes mantendo essa
ordem. Nenhuma mudança foi feita na consulta ou no model.

Esse cenário controla a sequência de cadastro e exige a sequência desejada
na saída. Não devemos depender de uma ordem implícita dos resultados SQL
quando a consulta não informa ORDER BY.

Ao terminar, rollback desfaz as duas inserções. Preparação, outros cenários,
configuração, migrations e seeders foram preservados.

## Comandos e resultados

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoEloquentTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sintaxe passou. Arquivo do catálogo: OK (4 tests, 12 assertions), código 0.
Suíte completa: OK (6 tests, 14 assertions), código 0. Cada cenário do catálogo
tem duas asserções de destino em setUp e uma de comportamento. A suíte inclui
também os dois exemplos iniciais. Comandos/flags são os já estudados.

Os quatro cenários do catálogo agora verificam: tabela sem produtos, retorno
de um ativo, exclusão de um inativo e ordem dos nomes de dois ativos.

SELECT separado depois confirmou loja_test/loja_testes com zero produtos e
uma migration; loja/loja_app com um produto e uma migration. Inserções dos
testes desfeitas. git diff --check passou; segredos seguem ignorados/fora
do índice. Nenhuma instalação, conta nova ou alteração de credencial.

## Continuidade

Entendimento da 5.44 confirmado com "entendi" em 19/10/2026. Publicar o checkpoint
e iniciar 5.45: explicar factories como preparação de dados e gerar somente
a estrutura de ProdutoFactory. Preencher os atributos e usar a factory nos
testes serão etapas posteriores; não antecipar essas alterações.
