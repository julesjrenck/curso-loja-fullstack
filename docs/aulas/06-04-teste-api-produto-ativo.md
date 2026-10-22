# Aula 6.4 — Produto ativo na resposta JSON

## Objetivo e estado

Adicionar um cenário HTTP que exige o nome de um produto ativo na resposta de
GET /api/v1/produtos. Implementação, explicação e verificações em 22/10/2026;
entendimento confirmado pelo aluno com "entendi" em 22/10/2026.
Único arquivo de código alterado:
backend/tests/Feature/CatalogoApiTest.php.

Etapa anterior 6.3 confirmada com "entendi" em 22/10/2026 e publicada em
d9d091144402ef5d700a1126eabfabd3855c9e4f. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O cenário novo

```php
public function test_retorna_nome_do_produto_ativo_em_json(): void
{
    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    $resposta = $this->getJson('/api/v1/produtos');

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson(['data' => ['Camiseta']]);
}
```

O método público test_ é um segundo cenário independente. Antes dele, o setUp
existente inicializa Laravel/transação, confirma loja_test/loja_testes e prepara
produtos vazia. Não usamos o estado deixado pelo teste anterior.

Produto::factory() usa a ProdutoFactory existente. Create monta os atributos e
grava o produto no SQL Server, tornando-o disponível à consulta da API. Make
montaria apenas um objeto em memória e não prepararia esse cadastro no banco.

O array passado a create sobrescreve nome e status da definição padrão.
Nome explícito torna o resultado esperado previsível. Status explícito documenta
o comportamento que estamos testando. Preco_em_centavos continua vindo da
factory: o preço é necessário ao cadastro, mas não é retornado pela API atual
e não participa desta asserção.

GetJson processa a requisição dentro da aplicação de testes. A rota recebe
Catalogo pelo container; o binding entrega CatalogoEloquent, que consulta os
produtos ativos e retorna nomes. A resposta JSON precisa conter exatamente
data com a lista ['Camiseta'], além de status 200 e Content-Type application/json.
AssertExactJson compara os dados JSON decodificados, sem depender de espaços
do texto. O resultado esperado é:

```json
{"data":["Camiseta"]}
```

Este cenário detecta a ausência de um produto ativo na resposta. A ausência de
inativos e a ordenação com vários produtos ainda não são verificadas pelos
cenários HTTP atuais. O contrato está em docs/api/catalogo.md.

DatabaseTransactions desfaz tanto a preparação quanto o cadastro ao terminar.
A Camiseta deste cenário pertence ao banco loja_test; a Camiseta já existente
no banco normal loja é um registro separado.

## Verificações executadas

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l verifica sintaxe; --filter seleciona os dois cenários da classe da API;
sem filtro executamos toda a suíte. Exec -T roda no container backend existente,
sem terminal interativo. --do-not-cache-result evita gravar o cache de resultados
na montagem de código somente leitura.

Resultados, todos com código 0:

- Sintaxe válida.
- Classe CatalogoApiTest: 2 testes/12 asserções passaram.
- Suíte completa: 16 testes/66 asserções passaram, sem aviso de cache.
- Diagnóstico separado /tmp/curso-62-contagens.php após a suíte conferiu por
  SELECT: loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

Sem nova chamada pela rede; os testes passam pela aplicação Laravel e pelo
SQL Server real. Nenhuma rota, serviço, factory, migration, credencial ou
dependência alterada nesta etapa. Documentação de aula/contrato/progresso atualizada.

## Continuidade

Entendimento da 6.4 confirmado. Publicar o checkpoint e iniciar somente a 6.5,
adicionando um cenário HTTP com
produto ativo e inativo em CatalogoApiTest, usando o estado inativo() da factory
e exigindo apenas o nome do ativo na lista data. Exercício DBeaver segue sem relato.
