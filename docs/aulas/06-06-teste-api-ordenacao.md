# Aula 6.6 — Ordem dos nomes na resposta JSON

## Objetivo e estado

Verificar por HTTP que GET /api/v1/produtos entrega os nomes em ordem alfabética.
Implementação, explicação e verificações em 22/10/2026; entendimento confirmado
pelo aluno com "entendi" em 22/10/2026.
Único código alterado: quarto cenário de CatalogoApiTest.

Etapa 6.5 confirmada com "entendi" em 22/10/2026 e publicada em
bc86f52caf0e054fa32c74abaf834a374738f44e. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O cenário novo

Em backend/tests/Feature/CatalogoApiTest.php:

```php
public function test_retorna_nomes_em_ordem_alfabetica_no_json(): void
{
    Produto::factory()->create([
        'nome' => 'Caneca',
        'status' => 'ativo',
    ]);

    Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
    ]);

    $resposta = $this->getJson('/api/v1/produtos');

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson(['data' => ['Camiseta', 'Caneca']]);
}
```

Primeiro cadastramos Caneca e depois Camiseta, ambos ativos. O nome e o status
são explícitos; os preços continuam vindo da factory. A preparação compartilhada
garante banco/login loja_test/loja_testes e tabela produtos vazia para o cenário.

A ordem de cadastro é inversa à ordem esperada. Isso permite observar a regra
de ordenação aplicada pelo serviço. Cadastrar já na ordem desejada poderia
deixar passar um retorno que apenas coincidisse com a sequência de inserção.
Uma consulta SQL precisa de ORDER BY para exigir uma ordem; não devemos depender
da ordem aparente de armazenamento ou dos IDs.

GetJson processa a requisição dentro do Laravel com SQL Server real. O serviço
CatalogoEloquent já contém orderBy('nome'), que usa ordem crescente por padrão.
Esse trecho não foi alterado. A consulta ordena os nomes; a serialização da
resposta preserva a sequência da lista resultante:

```json
{"data":["Camiseta","Caneca"]}
```

AssertStatus e assertHeader verificam sucesso e formato. AssertExactJson exige
os dados esperados, incluindo a posição dos nomes no array. Uma resposta com
data: ['Caneca', 'Camiseta'] falharia. A comparação não depende dos espaços do
texto JSON. Conferidos os métodos assertExact/reorderAssocKeys da implementação
instalada de AssertableJsonString: normalizam chaves associativas, mantendo a
relação entre os índices da lista e seus valores. Não foi necessário adicionar
outro método de asserção ou alterar os testes anteriores.

DatabaseTransactions desfaz os dois cadastros ao terminar. O cenário não depende
dos produtos criados por outro teste, nem altera os dados permanentes da loja.

## Verificações executadas

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l confere sintaxe. --filter seleciona os quatro cenários da API; sem filtro
executa toda a suíte. Exec -T roda no container backend existente sem terminal
interativo. --do-not-cache-result evita gravar cache na montagem somente leitura.

Resultados, todos com código 0:

- Sintaxe válida.
- Classe CatalogoApiTest: 4 testes/24 asserções passaram.
- Suíte completa: 18 testes/78 asserções passaram.
- SELECTs separados via /tmp/curso-62-contagens.php após a suíte:
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

Requisições internas ao Laravel, sem nova chamada pela rede nesta etapa;
SQL Server real, transação e rollback. Rota, serviço, factory e esquema
preservados; nenhuma dependência adicionada.

## Continuidade

Entendimento da 6.6 confirmado. Publicar o checkpoint e iniciar somente a 6.7,
extraindo a função da rota para
ProdutoController@index sob App\Http\Controllers\Api\V1 e ajustar routes/api.php,
preservando o contrato JSON e verificando os cenários existentes.
Exercício manual sugerido no DBeaver continua sem relato.
