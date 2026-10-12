# Aula 3.13 — Composição com ItemCarrinho

## Objetivo

Representar um item do carrinho como um objeto que contém um Produto e uma
quantidade inteira positiva. A classe utiliza outro objeto em sua estrutura:
essa relação é o exemplo de composição desta aula.

## Arquivo src/ItemCarrinho.php

```php
<?php

declare(strict_types=1);

namespace Loja;

use InvalidArgumentException;

class ItemCarrinho
{
    public function __construct(
        private Produto $produto,
        private int $quantidade,
    ) {
        if ($quantidade < 1) {
            throw new InvalidArgumentException("A quantidade do item deve ser maior que zero.");
        }
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
}
```

- `declare(strict_types=1)` mantém o padrão de tipagem estrita dos arquivos.
- `namespace Loja` define o nome completo `Loja\ItemCarrinho`; o autoload PSR-4
  existente encontra `/app/ItemCarrinho.php`, montado a partir de `src`.
- `use InvalidArgumentException` importa o nome da exceção global.
- Os parâmetros privados promovidos declaram as propriedades e guardam os
  argumentos. Este recurso já foi estudado na aula 3.3.
- `Produto $produto` exige um objeto Produto. O nome curto resolve no namespace
  Loja, sem precisar de outro `use`.
- `int $quantidade` exige o tipo inteiro; o `if` valida seu valor.
- Quantidades menores que 1 lançam uma exceção, interrompendo a construção.
- `getProduto(): Produto` devolve o objeto guardado em `$this->produto`.
- `getQuantidade(): int` devolve a quantidade guardada nesta instância.

Um produto descreve o artigo do catálogo. O item acrescenta a quantidade
escolhida para o carrinho. Guardar o objeto permite usar suas operações públicas
sem repetir nome, preço ou status como propriedades de ItemCarrinho.

O objeto recebido é compartilhado: o construtor não cria uma cópia nem o getter
clona o produto. Se esse Produto for desativado, consultar seu estado pelo item
mostrará o novo estado. As propriedades de Produto continuam privadas; seus
métodos públicos continuam disponíveis para quem recebe o objeto pelo getter.

Nesta aula usamos composição no sentido de combinar objetos, sem impor que
ItemCarrinho seja o único proprietário do Produto ou controle sua duração.

## Experiência acompanhada

```php
$produto = new Produto("Camiseta", 4990);
$item = new ItemCarrinho($produto, 3);

echo $item->getProduto()->getNome(); // Camiseta
echo $item->getQuantidade();        // 3
```

`getProduto()` retorna Produto; em seguida, `->getNome()` chama seu getter.
A sequência percorre a relação entre os objetos. Já `getQuantidade()` consulta
um dado que pertence ao item.

Executamos a experiência completa abaixo pelo terminal, na raiz do projeto:

```bash
docker compose run --rm -T php php <<'PHP'
<?php

declare(strict_types=1);

use Loja\ItemCarrinho;
use Loja\Produto;
use Loja\StatusProduto;

require_once "/app/vendor/autoload.php";

$produto = new Produto("Camiseta", 4990);
$item = new ItemCarrinho($produto, 3);

if ($item->getProduto() !== $produto || $item->getQuantidade() !== 3) {
    throw new RuntimeException("O item deve guardar o produto e a quantidade recebidos.");
}

echo "Produto do item: " . $item->getProduto()->getNome() . PHP_EOL;
echo "Preço unitário: " . $item->getProduto()->getPrecoEmCentavos() . " centavos" . PHP_EOL;
echo "Quantidade: " . $item->getQuantidade() . PHP_EOL;

$itemUnitario = new ItemCarrinho($produto, 1);
if ($itemUnitario->getQuantidade() !== 1) {
    throw new RuntimeException("Quantidade 1 deve ser aceita.");
}
echo "Quantidade 1 aceita" . PHP_EOL;

foreach ([0, -1] as $quantidade) {
    try {
        new ItemCarrinho($produto, $quantidade);
        throw new RuntimeException("Quantidade inválida foi aceita.");
    } catch (InvalidArgumentException $erro) {
        echo "Quantidade " . $quantidade . " recusada: " . $erro->getMessage() . PHP_EOL;
    }
}

$produto->desativar();
if ($item->getProduto()->getStatus() !== StatusProduto::Inativo) {
    throw new RuntimeException("O item deve manter o mesmo objeto Produto recebido.");
}
echo "Status do produto no item: " . $item->getProduto()->getStatus()->value . PHP_EOL;
PHP
```

`<<'PHP'` envia o bloco pela entrada padrão sem expandir variáveis no shell.
O primeiro `php` seleciona o serviço e o segundo executa o código recebido.
`-T` desabilita o terminal virtual e `--rm` remove o container temporário.
`require_once` registra o autoload que carrega as classes usadas por `new`.

Os `if` com RuntimeException tornam a verificação uma falha se houver resultado
inesperado. `!==` entre objetos verifica que são instâncias diferentes; esperamos
que o objeto guardado seja o mesmo recebido. `||` representa "ou".
O `foreach` percorre as duas quantidades inválidas, e o `catch` trata a exceção
esperada para cada uma. Não adicionamos esse código de verificação à aplicação.

Saída verificada, com código 0:

```text
Produto do item: Camiseta
Preço unitário: 4990 centavos
Quantidade: 3
Quantidade 1 aceita
Quantidade 0 recusada: A quantidade do item deve ser maior que zero.
Quantidade -1 recusada: A quantidade do item deve ser maior que zero.
Status do produto no item: inativo
```

## Verificação de sintaxe

```bash
docker compose exec -T php php -l ItemCarrinho.php
```

`exec` usa o container do serviço já ativo; `php -l` verifica a sintaxe.
Resultado: nenhum erro de sintaxe. Não houve build, alteração no Compose,
regeneração do autoload, dependências novas ou execução do contador.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Na etapa 3.14,
acrescentar `getSubtotalEmCentavos(): int`, multiplicando o preço do produto pela
quantidade do item. Não implementar esse cálculo nesta etapa. O estado fica no
[progresso](../progresso.md).
