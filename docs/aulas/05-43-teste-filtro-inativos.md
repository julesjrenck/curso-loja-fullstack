# Aula 5.43 — Teste do filtro de produtos inativos

## Objetivo e estado

Verificar que o catálogo retorna somente produtos ativos quando há registros
dos dois estados no SQL Server. Implementação, explicação e verificações em
19/10/2026; entendimento confirmado com "entendi" nessa data.

A 5.42 foi confirmada com "entendi" e publicada em aa8e5a4. HEAD, origin/main
e consulta direta à main remota retornaram
aa8e5a4ed0e29cffd879ffa34f232ca271c633c2 após o push.

## Cenário adicionado

Somente este método foi acrescentado a
backend/tests/Feature/CatalogoEloquentTest.php:

```php
public function test_omite_produtos_inativos_do_catalogo(): void
{
    Produto::create([
        'nome' => 'Camiseta',
        'preco_em_centavos' => 4990,
        'status' => 'ativo',
    ]);

    Produto::create([
        'nome' => 'Caneca',
        'preco_em_centavos' => 2990,
        'status' => 'inativo',
    ]);

    $catalogo = new CatalogoEloquent;

    $this->assertSame(['Camiseta'], $catalogo->listarNomes());
}
```

O setUp já existente inicia a preparação Laravel, confere loja_test/loja_testes
e prepara produtos vazia dentro de DatabaseTransactions. As duas chamadas
Produto::create gravam os registros desse cenário na transação: Camiseta ativa
por R$ 49,90 e Caneca inativa por R$ 29,90.

O serviço real listarNomes consulta a tabela usando where('status', 'ativo').
Sua implementação foi preservada. A comparação exata com ['Camiseta'] verifica
que o ativo está incluído e a Caneca está ausente. Se um nome adicional entrar
no resultado, assertSame falhará, mesmo que Camiseta também esteja presente.

O caso anterior tinha somente um ativo. Neste caso há também um registro
que deve ser excluído pelo filtro. Como o resultado esperado contém um único
nome, ainda não verificamos a ordenação entre vários ativos.

No encerramento, rollback desfaz as duas inserções e a preparação do cenário.
Nenhuma mudança no setUp, no trait, nos outros testes ou na aplicação.

## Comandos e resultados

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoEloquentTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Sintaxe passou. Arquivo do catálogo: OK (3 tests, 9 assertions), código 0.
São duas asserções de destino em setUp e uma de comportamento em cada cenário.
Suíte completa: OK (5 tests, 11 assertions), código 0, incluindo os dois exemplos.
Comandos e flags de execução são os já estudados.

SELECT separado depois confirmou loja_test/loja_testes com zero produtos e uma
migration. Ambiente normal loja/loja_app com um produto e uma migration.
As inserções dos testes foram desfeitas, sem gravação no banco normal.

git diff --check passou; arquivos privados continuam ignorados/fora do índice.
Nenhuma alteração no serviço/model/configuração/migrations; sem instalação,
seeder, nova conta ou mudança de credencial.

## Continuidade

Entendimento da 5.43 confirmado com "entendi" em 19/10/2026. Publicar o checkpoint
e iniciar 5.44: cadastrar dois produtos ativos fora da ordem alfabética e exigir
os nomes ordenados em um novo cenário. Não antecipar outros cenários.
