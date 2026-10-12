# Aula 3.18 — Testar a recusa de quantidade zero

## Objetivo

Guardar um teste que confirma a regra de ItemCarrinho: quantidade zero deve
ser recusada com InvalidArgumentException.

## Arquivo src/tests/ItemCarrinhoTest.php

Acrescentamos este método à classe de teste existente:

```php
public function testRecusaQuantidadeZero(): void
{
    $produto = new Produto("Camiseta", 4990);

    $this->expectException(InvalidArgumentException::class);

    new ItemCarrinho($produto, 0);
}
```

O método é público, começa com test e retorna void, seguindo o padrão da aula
anterior. PHPUnit encontra e executa os dois métodos da classe pelo mesmo comando.

A sequência é:

1. Criar um Produto válido. Essa preparação fica antes da expectativa para que
   uma falha no Produto não seja confundida com a regra de quantidade do item.
2. Configurar a expectativa com expectException.
3. Executar a ação que deve lançar a exceção: construir ItemCarrinho com zero.

`$this` representa a instância de ItemCarrinhoTest. O recurso expectException
é fornecido pela estrutura de TestCase e registra o tipo esperado.

`InvalidArgumentException::class` fornece o nome da classe como string.
Neste arquivo, que está no namespace global, o resultado é
"InvalidArgumentException". Não precisamos de outra importação para esse nome
global. O operador ::class também permite obter nomes completos de classes
importadas ou dentro de namespaces, evitando escrever esses nomes manualmente.

expectException configura a expectativa. A exceção é lançada pelo construtor
de ItemCarrinho, cuja regra já existente é:

```php
if ($quantidade < 1) {
    throw new InvalidArgumentException("A quantidade do item deve ser maior que zero.");
}
```

Com quantidade 0, a condição é verdadeira e a construção é interrompida.
PHPUnit recebe a exceção e verifica se atende ao tipo esperado. A ausência
da exceção ou um tipo incompatível faz o teste não passar.

A expectativa precisa estar antes da ação: quando a exceção é lançada, a
execução normal do método é interrompida. Por isso também não colocamos outras
verificações depois da tentativa de construção.

O teste de subtotal da aula anterior permanece no arquivo. Produto e
ItemCarrinho não foram alterados nesta etapa.

## Executar e verificar

Na raiz do projeto:

```bash
docker compose exec -T php php -l tests/ItemCarrinhoTest.php
docker compose run --rm php php vendor/bin/phpunit \
  --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php
```

`exec -T` executa no container ativo sem terminal virtual; `php -l` verifica
a sintaxe, que passou. `run --rm` cria e remove o container temporário do teste.
O primeiro php seleciona o serviço e o segundo executa a entrada do PHPUnit.
O bootstrap carrega o autoload, e o último argumento indica o arquivo de teste.
Todos os caminhos são relativos ao diretório de trabalho /app.

Saída verificada, com código 0:

```text
PHPUnit 13.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.26

..                                                                  2 / 2 (100%)

Time: 00:00.002, Memory: 20.00 MB

OK (2 tests, 2 assertions)
```

Cada ponto representa um teste aprovado. As duas verificações são o subtotal
e o tipo da exceção esperada. Tempo e memória podem variar.
O resultado confirma a recusa de zero; quantidade negativa será outro cenário.

Sem build, novas dependências, mudanças no Compose ou nos arquivos do Composer.
O contador não foi executado; configuração local e volumes preservados.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.19: acrescentar
testRecusaQuantidadeNegativa() no mesmo arquivo, usando Produto válido,
expectException e quantidade -1. Explicar por que um teste de zero, sozinho,
não verifica todas as quantidades inválidas. Executar os três testes no Docker.
Não escrever esse método antes da confirmação. Estado em [progresso](../progresso.md).

## Fontes

- [PHPUnit: expectativas de exceções](https://docs.phpunit.de/en/13.4/writing-tests-for-phpunit.html#expecting-exceptions).
- [PHP: nomes de classes com ::class](https://www.php.net/manual/en/language.oop5.basic.php).
