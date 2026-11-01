# Aula 6.33 — Limite superior válido da paginação

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação da 6.32
com "entendi" e publicação em db652dd14c6470319f15375328f6d10903c863e7.
HEAD, origin/main e main remota coincidiram após push. Entendimento da 6.33
confirmado com "entendi" em 30/10/2026; checkpoint publicado em
d86aa98520fdf6a728c629ce6e3a028deaa431eb, com remoto conferido.

Um conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: generalizar
o teste após a última página e acrescentar o caso do limite superior válido.

## Provider com dois argumentos

```php
public static function paginasAposUltima(): array
{
    return [
        'logo após a última' => [2, 1],
        'limite superior válido' => [1000000, 999999],
    ];
}
```

As chaves externas nomeiam as execuções. Cada lista interna contém dois inteiros:
página solicitada e página anterior esperada. O teste recebe os valores nessa ordem:

```php
#[DataProvider('paginasAposUltima')]
public function test_retorna_pagina_vazia_apos_a_ultima_sem_perder_total(int $pagina, int $paginaAnterior): void
```

O primeiro caso mantém a verificação da 6.32. O segundo acrescenta o maior valor
permitido pela regra max:1000000. O provider entrega expectativas explícitas para
os dois argumentos; não precisa acessar banco nem aplicação.

## Requisição, metadados e links

Cada execução continua criando uma Camiseta ativa/4990 pela factory, dentro da
transação do teste. Há somente um ativo e a última página é 1. Não precisamos
criar um milhão de registros para pedir uma página alta.

Os três trechos que antes fixavam a página agora usam os argumentos:

```php
$resposta = $this->getJson('/api/v1/produtos?page='.$pagina);
```

```php
'prev' => $url.'?page='.$paginaAnterior,
```

```php
->assertJsonPath('meta.current_page', $pagina)
```

O ponto concatena o inteiro à URL como texto. Depois, Form Request valida a
query e pagina() fornece int ao serviço. AssertJsonPath compara current_page
com o inteiro esperado, preservando a exigência de tipo no JSON.

Todas as outras expectativas continuam: 200/application/json/data [], total 1,
per_page 10, last_page 1, from/to null, first/last para 1 e next null.

Para a página 1000000, prev aponta para 999999. Esse link representa a página
numericamente anterior à solicitada; last aponta para a última que contém itens.
Neste catálogo, a página 999999 também estaria vazia. A API mantém o comportamento
do paginador em vez de substituir a página solicitada pela última disponível.

O limite é inclusivo: 1000000 é permitido e retorna 200, mesmo sem itens.
1000001 continua sendo rejeitado com 422 pelo teste de entradas inválidas da 6.31.
Assim protegemos os dois lados da fronteira de validação.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Sintaxe válida; classe da API passou, incluindo os dois casos deste provider e
os onze casos de páginas inválidas. Suíte completa: 41 testes/288 asserções passaram,
um caso e treze asserções a mais que na 6.32. --filter seleciona a classe;
--do-not-cache-result evita escrita do cache de resultados na montagem de código.

SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram loja_test/loja_testes
com 0 categorias/0 produtos e loja/loja_app com 0 categorias/1 produto. As transações
desfizeram as fixtures. Git diff --check passou. Código da aplicação preservado.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026; checkpoint publicado em
d86aa98520fdf6a728c629ce6e3a028deaa431eb, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.34](06-34-contrato-filtro-nome.md), definindo o
contrato planejado do filtro por nome e sua interação com a paginação.
