# Aula 6.31 — Páginas inválidas com DataProvider

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação da 6.30
com "entendi" e publicação em d834624f2196cd6980e41747f568c970b2af1c6e.
HEAD, origin/main e main remota coincidiram após push. Entendimento da 6.31
confirmado com "entendi" em 30/10/2026; checkpoint publicado em
3a782ca8ba8055b5de5f0e4db31ab3db63df24ed, com remoto conferido.

Um conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: generalizar
o teste de page=0 e fornecer onze entradas inválidas por DataProvider. A classe
já importava esse atributo para os IDs malformados; reutilizamos o mecanismo.

## Método de teste

```php
#[DataProvider('paginasInvalidas')]
public function test_retorna_422_em_json_para_pagina_invalida(string $query): void
{
    $resposta = $this->getJson('/api/v1/produtos?'.$query);

    $resposta
        ->assertStatus(422)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonStructure(['message'])
        ->assertJsonValidationErrors(['page']);
}
```

O atributo #[...] informa ao PHPUnit qual método fornece os argumentos. A
assinatura agora recebe uma string query. O ponto concatena a URL com essa
string, formando, por exemplo, /api/v1/produtos?page=-1. As quatro asserções da
6.30 são preservadas: status, tipo de conteúdo, message e erro associado a page.

## Provider e execuções

```php
public static function paginasInvalidas(): array
{
    return [
        'zero' => ['page=0'],
        'vazia' => ['page='],
        'negativa' => ['page=-1'],
        'decimal' => ['page=1.5'],
        'zero inicial' => ['page=01'],
        'letras' => ['page=abc'],
        'array' => ['page[]=1'],
        'sinal positivo' => ['page=%2B1'],
        'notação científica' => ['page=1e3'],
        'acima do limite' => ['page=1000001'],
        'acima da faixa de int' => ['page='.PHP_INT_MAX.'0'],
    ];
}
```

Cada linha é um conjunto de argumentos para uma execução. Em 'zero' => ['page=0'],
zero identifica o caso no relatório e a lista interna fornece o único argumento
query. Onze linhas produzem onze execuções do mesmo método. Se uma falha, o nome
ajuda a localizar a entrada correspondente. Cada execução tem seu próprio setUp
e sua transação de banco, como os demais testes da classe.

Public static permite que o PHPUnit obtenha os dados sem uma instância de teste.
O provider retorna apenas strings; não acessa aplicação, container ou banco.

Page= está presente com valor vazio; não equivale a omitir o parâmetro. Page[]=1
é interpretado como array, rejeitado pela validação de inteiro. %2B representa
o sinal + literal: na query, um + sem codificação seria convertido em espaço.
Assim o caso testa +1, que o contrato rejeita. PHP_INT_MAX.'0' concatena texto
para gerar um número fora da faixa de int, sem fazer uma soma com overflow.

O teste atravessa o fluxo HTTP existente e confere os erros do Form Request.
Não foram alteradas as regras nem criadas fixtures. As mensagens podem ser
traduzidas; comparamos a presença das chaves, sem fixar seu texto.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Sintaxe válida; classe da API com 25 testes/208 asserções e suíte completa com
39 testes/262 asserções passaram. Onze execuções substituem a execução única
de page=0, acrescentando dez execuções e oitenta asserções. --filter seleciona
a classe; --do-not-cache-result evita escrita do cache na montagem de código.

SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram loja_test/loja_testes
com 0 categorias/0 produtos e loja/loja_app com 0 categorias/1 produto.
Git diff --check passou. Este teste não mede consultas SQL.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026; checkpoint publicado em
3a782ca8ba8055b5de5f0e4db31ab3db63df24ed, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.32](06-32-pagina-apos-ultima.md), com um teste
permanente de página válida após a última, preservando o total do catálogo.
