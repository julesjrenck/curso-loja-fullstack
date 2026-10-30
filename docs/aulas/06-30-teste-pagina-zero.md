# Aula 6.30 — Teste permanente da rejeição de page=0

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação da 6.29
com "entendi" e publicação em 6f0af4292ce354b2395fd553490cfc6325b4d233.
HEAD, origin/main e main remota coincidiram após push. Entendimento da 6.30
confirmado com "entendi" em 30/10/2026; publicação em preparação.

O objetivo é manter na suíte uma verificação HTTP da validação de entrada.
Até aqui, page=0 tinha sido conferido por diagnóstico temporário na 6.28.

## Alteração e fluxo

Em backend/tests/Feature/CatalogoApiTest.php, acrescentado somente este método:

```php
public function test_retorna_422_em_json_para_pagina_zero(): void
{
    $resposta = $this->getJson('/api/v1/produtos?page=0');

    $resposta
        ->assertStatus(422)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonStructure(['message'])
        ->assertJsonValidationErrors(['page']);
}
```

GetJson envia GET pela aplicação de teste pedindo JSON. O parâmetro da query é
recebido como texto. ListarProdutosRequest é resolvido antes de index: zero
passa pela regra integer, mas falha em min:1. Bail interrompe as regras seguintes
desse campo após a primeira falha. O Laravel lança a exceção de validação e o
tratamento existente devolve JSON com status 422, message e errors.page.

O padrão 1 vale quando page é omitido. Enviar page=0 explicitamente representa
uma entrada inválida; não deve ser silenciosamente convertido em página 1.

Cada asserção retorna a própria resposta, permitindo encadear as chamadas:

- AssertStatus(422) exige o status de erro de validação.
- AssertHeader exige Content-Type application/json.
- AssertJsonStructure(['message']) exige a chave message no JSON.
- AssertJsonValidationErrors(['page']) exige a chave page dentro de errors.
  A implementação instalada de TestResponse foi consultada para conferir isso.

Não fixamos o texto das mensagens, que pode mudar com a tradução. O helper de
validação usado verifica o campo informado; não exige que ele seja o único erro.

O teste não precisa criar produtos: a entrada deve ser rejeitada antes de index.
O setUp da classe continua conferindo a identidade loja_test/loja_testes e
limpando os produtos dentro da transação. Este teste verifica a resposta HTTP;
o diagnóstico anterior permanece como evidência separada da ausência de SQL
de catálogo nas requisições inválidas.

Uma página válida vazia retorna 200. Uma página inválida, como zero, retorna 422.
Uma consulta individual por ID indisponível retorna 404. São situações distintas
do contrato atual, documentadas em [catalogo.md](../api/catalogo.md).

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l conferiu a sintaxe. --filter selecionou a classe da API: 15 testes e 128
asserções passaram. Sem filtro, a suíte completa passou com 29 testes e 182
asserções. Foi acrescentado um cenário e oito asserções em relação à 6.29.
--do-not-cache-result evita escrita do cache de resultados na montagem de código.

SELECTs separados antes/depois por /tmp/curso-618-contagens.php conferiram
loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com 0 categorias/1
produto. Git diff --check passou. A aplicação mantém seu código anterior.

## Continuidade

Roteiro, progresso e registro de cobertura atualizados. Entendimento da 6.30
confirmado com "entendi" em 30/10/2026; publicação em preparação. Publicar e
iniciar somente 6.31: expandir o cenário de páginas inválidas com DataProvider,
reaproveitando as asserções para outras entradas. Demais entradas inválidas e
limites continuam conferidos pelos diagnósticos anteriores.
