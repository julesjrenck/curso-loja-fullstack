# Aula 6.18 — Teste da consulta individual com ID inexistente

## Objetivo e estado

Retomada solicitada em 30/10/2026 após a 6.17 concluída. Acrescentar um único
cenário permanente em backend/tests/Feature/CatalogoApiTest.php para conferir o
contrato quando o ID é válido, mas o produto não existe. Implementação, explicação
e verificações realizadas; entendimento confirmado pelo aluno com "entendi"
em 30/10/2026.

## Código e fluxo

```php
public function test_retorna_404_em_json_para_id_inexistente(): void
{
    $resposta = $this->getJson('/api/v1/produtos/1');

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson([
            'message' => 'Produto não encontrado.',
        ]);
}
```

O prefixo test_ identifica um teste para o PHPUnit; void indica que o método
não devolve valor. Antes dele, o setUp existente inicializa o Laravel, confere
banco/login loja_test/loja_testes e esvazia produtos dentro da transação.
Como este cenário não cria produtos, qualquer ID válido está ausente, incluindo
1. Não assumimos que o próximo cadastro receberia esse ID. Não precisamos
de factory para preparar ausência.

getJson recebe o caminho e devolve a resposta para as asserções. Executa o kernel
HTTP do Laravel no processo de teste, com o catálogo real e SQL Server de testes;
não envia uma requisição pela porta do servidor. A rota aceita 1; show valida
o inteiro, chama Catalogo::buscarProduto, resolvido para CatalogoEloquent pelo
binding. O SELECT não encontra produto e first retorna null. Show então usa
response()->json para produzir a mensagem e o status 404.

assertStatus exige 404; assertHeader exige o formato application/json;
assertExactJson compara todo o corpo, incluindo a mensagem e a ausência de
campos extras. O array associativo PHP vira o objeto JSON
{"message":"Produto não encontrado."}, sem envelope data. Uma resposta 200,
HTML de erro ou mensagem diferente fará o teste falhar.

Na listagem, catálogo vazio é sucesso 200 com data: []; aqui pedimos um produto
específico, então ausência resulta em 404. Isso também difere de um ID malformado,
que pode ser rejeitado pelo roteamento antes de show. Este cenário verifica
somente um ID válido inexistente.

DatabaseTransactions desfaz as alterações ao final de cada teste. Os outros
cinco cenários e o código de aplicação foram preservados.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

php -l verifica a sintaxe. --filter seleciona a classe da API; sem filtro,
executamos a suíte completa. --do-not-cache-result evita gravar cache de
resultados no código montado somente para leitura no container.

- Sintaxe válida.
- Classe da API: 6 testes/36 asserções passaram.
- Suíte completa: 20 testes/90 asserções passaram.
- SELECTs separados antes/depois por /tmp/curso-618-contagens.php confirmaram
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Script temporário usa o bootstrap Laravel, confere
  identidade e executa somente consultas de contagem; não contém credenciais.

HTTP real por socket não repetido; último resultado pertence à 6.16.
Teste individual de inativo e restrições de ID ainda dependem do diagnóstico
histórico da 6.16, sem cobertura permanente desses cenários nesta aula.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
d6fac241a0c9d32315e6403a5cea51040bb7a0c8, `test: verifica consulta de produto inexistente`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem tentar incluir o SHA no próprio commit.
Continuidade realizada na 6.19, teste individual de produto inativo com o mesmo
404/message e registro/status preservados após a requisição.
