# Aula 3.21 — Testar um produto com preço zero

## Objetivo

Verificar que o preço zero, permitido pela regra existente de Produto, pode
ser usado no item do carrinho e produz subtotal inteiro zero.

## Arquivo src/tests/ItemCarrinhoTest.php

Acrescentamos este método à classe de teste existente:

```php
public function testCalculaSubtotalParaProdutoGratuito(): void
{
    $produto = new Produto("Brinde", 0);
    $item = new ItemCarrinho($produto, 3);

    $subtotal = $item->getSubtotalEmCentavos();

    $this->assertSame(0, $subtotal);
}
```

O método é público, começa com test e retorna void, seguindo o padrão anterior.
Ele prepara um Produto com nome válido e preço 0 e um item com quantidade 3,
executa getSubtotalEmCentavos e confere o inteiro esperado 0.

`$this` representa a instância de teste, que usa assertSame pela estrutura de
TestCase. O primeiro argumento é o esperado; o segundo é o subtotal obtido.
Uma exceção inesperada na construção do Produto ou do item também impediria
a aprovação do teste.

## Os limites de preço e quantidade

A regra existente de Produto recusa `$precoEmCentavos < 0`. Para preço 0,
essa condição é falsa, e a construção deve terminar normalmente.
O subtotal do item é 0 x 3 = 0, em centavos.

| Campo | Menor valor permitido pela regra atual |
| --- | --- |
| Preço em centavos | 0 |
| Quantidade do item | 1 |

Os dois campos têm tipo int, mas regras próprias para seus valores. No teste,
quantidade 3 é válida e permite verificar o limite zero do preço.

Se uma alteração trocasse a validação do preço para `$precoEmCentavos <= 0`,
o Brinde seria recusado. Os quatro testes anteriores usam preço 4990 e não
detectariam essa recusa indevida. O teste novo protege o limite válido de preço.
Essa comparação é didática: a regra real de Produto permaneceu < 0.

Produto e ItemCarrinho não foram alterados. Os quatro testes anteriores foram
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

.....                                                               5 / 5 (100%)

Time: 00:00.005, Memory: 20.00 MB

OK (5 tests, 5 assertions)
```

Cada ponto representa um teste aprovado. Foram conferidos os subtotais para
uma e três unidades de preço 4990, o subtotal zero de um produto gratuito e
as exceções para quantidades 0 e -1. Tempo e memória podem variar.
Sem build, novas dependências ou mudanças no Compose e nos arquivos do Composer.
O contador não foi executado; configuração local e volumes preservados.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.22: revisão acompanhada do módulo
3, retomando Produto, StatusProduto, Precificavel, ItemCarrinho, autoload e
ItemCarrinhoTest. Explicar o fluxo de criação, validação, consulta, ações e
verificação. Responder dúvidas e solicitar confirmação da revisão antes de
registrar a conclusão do módulo. Não iniciar Laravel ou outras funcionalidades
antecipadamente. Estado em [progresso](../progresso.md).

## Referência

- [PHPUnit: testes e assertSame](https://docs.phpunit.de/en/13.4/writing-tests-for-phpunit.html).
