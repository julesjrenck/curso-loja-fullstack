# Aula 3.17 — Primeiro teste PHPUnit

## Objetivo

Guardar em um arquivo de teste a regra: um item com três camisetas de 4990
centavos deve ter subtotal de 14970 centavos, como inteiro.

## Arquivo src/tests/ItemCarrinhoTest.php

```php
<?php

declare(strict_types=1);

use Loja\ItemCarrinho;
use Loja\Produto;
use PHPUnit\Framework\TestCase;

class ItemCarrinhoTest extends TestCase
{
    public function testCalculaSubtotalParaTresUnidades(): void
    {
        $produto = new Produto("Camiseta", 4990);
        $item = new ItemCarrinho($produto, 3);

        $subtotal = $item->getSubtotalEmCentavos();

        $this->assertSame(14970, $subtotal);
    }
}
```

`declare(strict_types=1)` mantém o padrão dos arquivos PHP do curso.
As importações com `use` permitem usar os nomes curtos de Produto, ItemCarrinho
e TestCase. Este arquivo não declara namespace; sua classe está no namespace
global e é carregada pelo executor PHPUnit a partir do caminho informado.

A pasta tests separa o código de verificação dos exemplos e das classes da loja.
O arquivo e a classe têm o sufixo Test, convenção de nomes para testes.

`extends TestCase` aplica herança: ItemCarrinhoTest é uma classe filha que usa
a estrutura e os recursos de teste fornecidos por PHPUnit\Framework\TestCase.
Não precisamos implementar o mecanismo de execução ou de asserções.

O método é público e seu nome começa com test, para que PHPUnit o reconheça.
Seu retorno é void: o teste verifica o comportamento por asserções, em vez de
retornar um resultado para impressão. PHPUnit cria a instância de teste e
executa o método; não colocamos `new ItemCarrinhoTest()` no exemplo da loja.

O método tem três momentos:

1. Preparar: criar o Produto com preço 4990 e o ItemCarrinho com quantidade 3.
2. Executar: chamar getSubtotalEmCentavos e guardar seu retorno em $subtotal.
3. Conferir: comparar o resultado ao inteiro esperado 14970 com assertSame.

Dentro do teste, `$this` representa ItemCarrinhoTest. Já dentro dos métodos
de Produto e ItemCarrinho, `$this` continua representando cada um desses objetos.

`assertSame(14970, $subtotal)` é uma asserção. O primeiro argumento é o esperado;
o segundo é o obtido. Ela exige valor e tipo iguais: o texto "14970" ou o float
14970.0 falhariam nessa comparação com o inteiro 14970. Se houver uma diferença,
PHPUnit registra a falha e mostra esperado, obtido e localização no teste.

O valor esperado foi escrito como um resultado conhecido da regra. O teste
exercita as classes da loja, sem repetir sua implementação dentro da asserção.

## Executar

Na raiz do projeto:

```bash
docker compose run --rm php php vendor/bin/phpunit \
  --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php
```

- `run --rm` cria o container temporário e o remove ao terminar.
- O primeiro `php` é o serviço; o segundo é o executável PHP.
- `vendor/bin/phpunit` é a entrada da ferramenta instalada pelo Composer.
- `--bootstrap vendor/autoload.php` carrega explicitamente o autoload antes
  do teste, disponibilizando as classes do projeto e das dependências.
- `tests/ItemCarrinhoTest.php` identifica o arquivo que PHPUnit carregará.
- Os caminhos são relativos a /app, diretório de trabalho normal do serviço.

Saída verificada, com código 0:

```text
PHPUnit 13.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.26

.                                                                   1 / 1 (100%)

Time: 00:00.003, Memory: 20.00 MB

OK (1 test, 1 assertion)
```

O ponto indica um teste aprovado. A última linha informa um método de teste
executado e uma asserção aprovada. O tempo e a memória podem variar.
Esse resultado confirma o cenário de três unidades; outros cenários receberão
testes próprios nas próximas etapas.

## Verificação de sintaxe

```bash
docker compose exec -T php php -l tests/ItemCarrinhoTest.php
```

`exec` usa o container já ativo, `-T` desabilita o terminal virtual e `php -l`
verifica a sintaxe. O arquivo passou. O teste usa a montagem normal do código
somente leitura e o volume vendor existente, sem build ou novas dependências.
Produto, ItemCarrinho, Compose e arquivos do Composer permaneceram iguais.
O contador não foi executado.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.18: acrescentar
um método no mesmo arquivo que verifica a recusa de quantidade zero. Criar o
Produto válido, configurar expectException(InvalidArgumentException::class) e
tentar construir ItemCarrinho com quantidade 0. Explicar expectativa de exceção,
ordem das chamadas e ::class. Não escrever esse teste antes da confirmação.
Estado em [progresso](../progresso.md).

## Fontes

- [PHPUnit: TestCase, métodos de teste e assertSame](https://docs.phpunit.de/en/13.4/writing-tests-for-phpunit.html).
- [PHPUnit: executor pelo terminal](https://docs.phpunit.de/en/13.4/textui.html).
