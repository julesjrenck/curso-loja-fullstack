# Aula 3.20 — Testar a menor quantidade válida

## Objetivo

Verificar que ItemCarrinho aceita quantidade 1 e calcula o subtotal como o preço
de uma unidade. Esse valor é o início do intervalo permitido pelo construtor.

## Arquivo src/tests/ItemCarrinhoTest.php

Acrescentamos este método à classe de teste existente:

```php
public function testCalculaSubtotalParaUmaUnidade(): void
{
    $produto = new Produto("Camiseta", 4990);
    $item = new ItemCarrinho($produto, 1);

    $subtotal = $item->getSubtotalEmCentavos();

    $this->assertSame(4990, $subtotal);
}
```

O método é público, começa com test e retorna void, como os anteriores.
Ele prepara um Produto de 4990 centavos e um item de quantidade 1,
executa getSubtotalEmCentavos e confere o inteiro esperado 4990.

`$this` representa a instância de teste, que usa assertSame pela estrutura de
TestCase. O primeiro argumento é o esperado; o segundo é o retorno obtido.
Se a construção do item lançar uma exceção inesperada, o teste também não passa.

## Por que testar a quantidade mínima

A regra existente recusa `$quantidade < 1`. Para 1, essa condição é falsa,
e a construção deve terminar normalmente. O subtotal é 4990 x 1 = 4990.

| Quantidade | Comportamento esperado para o produto de 4990 centavos |
| --- | --- |
| -1 | Recusar com InvalidArgumentException. |
| 0 | Recusar com InvalidArgumentException. |
| 1 | Aceitar; subtotal inteiro 4990. |
| 3 | Aceitar; subtotal inteiro 14970. |

Se uma alteração trocasse a condição para `$quantidade <= 1`, o item de
quantidade 1 seria recusado. Os testes de zero, negativo e três unidades
continuariam passando; o teste novo detectaria a recusa indevida do valor mínimo.
Essa comparação é didática: a regra da classe permaneceu < 1.

Produto e ItemCarrinho não foram alterados. Os três testes anteriores foram
preservados; cada método prepara seus próprios objetos.

## Executar e verificar

Na raiz do projeto:

```bash
docker compose exec -T php php -l tests/ItemCarrinhoTest.php
docker compose run --rm php php vendor/bin/phpunit \
  --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php
```

`exec -T` usa o container ativo sem terminal virtual; `php -l` verifica a
sintaxe, que passou. `run --rm` cria e remove o container temporário da execução.
O primeiro php é o serviço; o segundo executa a entrada do PHPUnit.
O bootstrap carrega o autoload antes do arquivo de teste indicado.

Saída verificada, com código 0:

```text
PHPUnit 13.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.26

....                                                                4 / 4 (100%)

Time: 00:00.004, Memory: 20.00 MB

OK (4 tests, 4 assertions)
```

Cada ponto representa um teste aprovado. Foram conferidos os subtotais de uma
e três unidades e as exceções para 0 e -1. Tempo e memória podem variar.
Sem build, novas dependências ou mudanças no Compose e nos arquivos do Composer.
O contador não foi executado; configuração local e volumes preservados.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.21: acrescentar
testCalculaSubtotalParaProdutoGratuito() no mesmo arquivo. Criar Produto de
nome Brinde e preço 0, item com quantidade 3 e conferir subtotal inteiro 0.
Explicar que a regra existente de Produto permite preço zero e testar esse
limite válido. Executar os cinco testes no Docker. Não implementar esse método
antes da confirmação. Estado em [progresso](../progresso.md).

## Referência

- [PHPUnit: testes e assertSame](https://docs.phpunit.de/en/13.4/writing-tests-for-phpunit.html).
