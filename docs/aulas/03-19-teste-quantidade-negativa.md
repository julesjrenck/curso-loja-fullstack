# Aula 3.19 — Testar a recusa de quantidade negativa

## Objetivo

Acrescentar um cenário de quantidade negativa aos testes do item do carrinho,
conferindo a recusa de -1 com InvalidArgumentException.

## Arquivo src/tests/ItemCarrinhoTest.php

Acrescentamos um método à classe de teste existente:

```php
public function testRecusaQuantidadeNegativa(): void
{
    $produto = new Produto("Camiseta", 4990);

    $this->expectException(InvalidArgumentException::class);

    new ItemCarrinho($produto, -1);
}
```

O método é público, começa com test e retorna void, como os anteriores.
O nome descreve o comportamento que queremos verificar. Cada método cria
seus próprios objetos para preparar seu cenário.

Primeiro criamos um Produto válido. Depois configuramos a expectativa de
InvalidArgumentException e tentamos construir ItemCarrinho com -1.
expectException registra o tipo esperado; ::class fornece seu nome como string,
conforme estudado na etapa 3.18. A expectativa fica antes da ação que deve lançar.

O número -1 tem o tipo int exigido pelo construtor, mas viola a regra de
quantidade positiva. O construtor existente verifica `$quantidade < 1`, por
isso lança a exceção quando recebe esse valor. PHPUnit recebe a exceção e
confere a expectativa. Produto e ItemCarrinho não foram alterados.

## Por que acrescentar esse cenário

O teste de zero verifica uma entrada específica. Para visualizar a diferença
entre duas condições possíveis:

| Quantidade | `$quantidade === 0` | `$quantidade < 1` |
| --- | --- | --- |
| 0 | Verdadeiro | Verdadeiro |
| -1 | Falso | Verdadeiro |
| 1 | Falso | Falso |

Se uma alteração trocasse a regra por uma verificação de igualdade com zero,
o teste de zero continuaria passando. O novo teste detectaria a aceitação
indevida de -1. Isso demonstra por que escolhemos entradas diferentes para
proteger partes distintas de uma regra.

A condição de igualdade é apenas uma comparação didática; o código da classe
continua usando < 1. O teste novo usa -1 como exemplo de quantidade negativa.

## Executar e verificar

Na raiz do projeto:

```bash
docker compose exec -T php php -l tests/ItemCarrinhoTest.php
docker compose run --rm php php vendor/bin/phpunit \
  --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php
```

`exec -T` usa o container ativo sem terminal virtual; `php -l` verifica a sintaxe,
que passou. `run --rm` cria e remove o container temporário da execução.
O primeiro php é o serviço; o segundo executa a entrada do PHPUnit.
O bootstrap carrega o autoload antes do arquivo de teste indicado.

Saída verificada, com código 0:

```text
PHPUnit 13.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.26

...                                                                 3 / 3 (100%)

Time: 00:00.002, Memory: 20.00 MB

OK (3 tests, 3 assertions)
```

Cada ponto representa um teste aprovado. Foram conferidos o subtotal inteiro
14970 para três unidades e as exceções esperadas para 0 e -1.
Tempo e memória podem variar. Não houve build, novas dependências ou mudanças
no Compose e nos arquivos do Composer. O contador não foi executado;
configuração local e volumes preservados.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.20: acrescentar
testCalculaSubtotalParaUmaUnidade() no mesmo arquivo, criando o produto de
4990 centavos e item com quantidade 1 e conferindo subtotal inteiro 4990.
Explicar que 1 é a menor quantidade válida e que a regra deve aceitar essa borda.
Executar os quatro testes no Docker. Não implementar o método antecipadamente.
Estado em [progresso](../progresso.md).

## Fonte

- [PHPUnit: expectativas de exceção](https://docs.phpunit.de/en/13.4/writing-tests-for-phpunit.html#expecting-exceptions).
