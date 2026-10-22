# Aula 6.5 — Omitir produto inativo da resposta JSON

## Objetivo e estado

Adicionar um cenário HTTP com produto ativo e inativo, exigindo somente o nome
do ativo na resposta de GET /api/v1/produtos. Implementação, explicação e
verificações em 22/10/2026; entendimento confirmado pelo aluno com "entendi"
em 22/10/2026. Único código
alterado: terceiro cenário em backend/tests/Feature/CatalogoApiTest.php.

Etapa anterior 6.4 confirmada com "entendi" em 22/10/2026 e publicada em
7defc2c2f695e73d2be27f8167acdb74f28ea746. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O cenário novo

```php
public function test_omite_produtos_inativos_da_resposta_json(): void
{
    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    Produto::factory()->inativo()->create([
        'nome' => 'Caneca',
    ]);

    $resposta = $this->getJson('/api/v1/produtos');

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson(['data' => ['Camiseta']]);
}
```

O setUp existente prepara cada cenário de forma independente: inicializa a
aplicação e a transação, confirma loja_test/loja_testes e deixa produtos vazia.
O primeiro cadastro cria a Camiseta ativa, com nome/status explícitos.

O segundo cadastro usa o método inativo() já definido em ProdutoFactory:

```php
public function inativo(): static
{
    return $this->state([
        'status' => 'inativo',
    ]);
}
```

Factory()->inativo() prepara uma factory com o estado status inativo; create
grava o produto usando esse estado e o nome Caneca informado. Não passamos status
novamente no array de create. Os preços continuam vindo da definição padrão da
factory e não participam da resposta atual, que contém somente nomes.

GetJson processa GET /api/v1/produtos pela aplicação Laravel, com o catálogo e
SQL Server reais. A rota usa o contrato Catalogo, cujo binding resolve
CatalogoEloquent. O filtro existente where('status', 'ativo') desse serviço deve
deixar a Caneca fora da resposta, mantendo a Camiseta.

AssertStatus exige 200; assertHeader confere Content-Type application/json;
assertExactJson compara o JSON decodificado com ['data' => ['Camiseta']]. Uma
resposta que também contivesse Caneca falharia nessa comparação. A asserção
também falha se a Camiseta desaparecer. Resultado esperado:

```json
{"data":["Camiseta"]}
```

Omitir o produto da resposta não o exclui do banco. A Caneca é criada como dado
do cenário e o catálogo apenas a filtra na consulta. Ao encerrar o teste,
DatabaseTransactions desfaz os dois cadastros junto à preparação inicial.

O teste verifica a regra já implementada pelo serviço através da resposta HTTP;
nenhuma alteração na rota, serviço ou factory foi necessária. A ordenação com
vários produtos ativos ainda não tem um cenário HTTP próprio.

## Verificações executadas

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l confere sintaxe. --filter seleciona a classe da API, agora com três
cenários; sem filtro roda toda a suíte. Exec -T executa no container backend
existente, sem terminal interativo. --do-not-cache-result evita gravar cache de
resultados na montagem de código somente leitura.

Resultados, todos com código 0:

- Sintaxe válida.
- Classe CatalogoApiTest: 3 testes/18 asserções passaram.
- Suíte completa: 17 testes/72 asserções passaram.
- SELECTs separados via /tmp/curso-62-contagens.php após a suíte confirmaram
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

Requisições de teste internas ao Laravel, sem chamada pela rede nesta etapa;
SQL Server real e rollback. Sem migration, seeder ou nova dependência.

## Continuidade

Entendimento da 6.5 confirmado. Publicar o checkpoint e iniciar somente a 6.6,
adicionando um cenário HTTP
de ordenação em CatalogoApiTest, cadastrando dois ativos em ordem inversa à
alfabética e exigindo a ordem dos nomes na lista data da resposta.
Exercício DBeaver continua sem relato do aluno.
