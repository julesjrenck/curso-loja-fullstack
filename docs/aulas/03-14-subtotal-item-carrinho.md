# Aula 3.14 — Subtotal do item do carrinho

## Objetivo

Calcular o subtotal de um item usando o preço unitário do Produto e a quantidade
guardada em ItemCarrinho. Exemplo: 4990 centavos por camiseta, quantidade 3,
subtotal de 14970 centavos, equivalente a R$ 149,70.

## Arquivo src/ItemCarrinho.php

Acrescentamos um método:

```php
public function getSubtotalEmCentavos(): int
{
    return $this->produto->getPrecoEmCentavos() * $this->quantidade;
}
```

- `public` permite chamar o método pelo objeto ItemCarrinho.
- `()` indica que não recebe argumentos declarados. Os dados já estão no item.
- `: int` declara o retorno como inteiro em centavos.
- `$this` representa o item que recebeu a chamada.
- `$this->produto` acessa o objeto Produto guardado na propriedade do item.
- `->getPrecoEmCentavos()` chama o getter público desse Produto.
- `*` multiplica o preço pela quantidade do item.
- `return` entrega o subtotal ao código que chamou o método.

A propriedade privada do Produto é consultada pelo método público de Produto.
ItemCarrinho usa seu próprio dado de quantidade e o preço do objeto composto.
Essa é uma aplicação da relação estudada na etapa 3.13.

O subtotal é calculado em cada chamada; não acrescentamos uma propriedade
separada para armazená-lo. O cálculo não altera o preço ou a quantidade.
Continuamos usando centavos inteiros como nas aulas anteriores.

## Arquivo src/exemplo-item-carrinho.php

Este exemplo foi salvo em src para que a chamada de ItemCarrinho possa ser
aberta no editor e executada pelo aluno. As experiências da aula 3.13 haviam
sido enviadas temporariamente pela entrada padrão.

```php
<?php

declare(strict_types=1);

use Loja\ItemCarrinho;
use Loja\Produto;

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

require_once __DIR__ . "/vendor/autoload.php";

$produto = new Produto("Camiseta", 4990);
$item = new ItemCarrinho($produto, 3);

echo "Produto do item: " . $item->getProduto()->getNome() . PHP_EOL;
echo "Preço unitário em centavos: " . $item->getProduto()->getPrecoEmCentavos() . PHP_EOL;
echo "Quantidade: " . $item->getQuantidade() . PHP_EOL;
echo "Subtotal em centavos: " . $item->getSubtotalEmCentavos() . PHP_EOL;
```

`use` permite usar os nomes curtos das classes. `require_once` registra o
autoload gerado pelo Composer; `__DIR__` é a pasta do script, `/app` no container.
Assim o caminho carregado é `/app/vendor/autoload.php`, disponível no volume.
O mapeamento existente de Loja encontra Produto.php e ItemCarrinho.php.

O bloco de PHP_SAPI restringe o exemplo ao terminal, seguindo o padrão dos
exemplos existentes. Pelo navegador, define status 403 e encerra antes de criar
os objetos. No terminal, `new Produto` cria a camiseta e `new ItemCarrinho`
chama o construtor com esse produto e quantidade 3.

Os `echo` consultam os dados pelos getters e imprimem o resultado. `.` concatena
os textos com os valores; `PHP_EOL` termina cada linha. A última chamada calcula
o subtotal e fornece o inteiro 14970 para a impressão.

## Executar

Na raiz do projeto:

```bash
docker compose run --rm php php exemplo-item-carrinho.php
```

O primeiro `php` seleciona o serviço definido em compose.yaml. O segundo é o
executável PHP, que recebe o nome do script no diretório `/app`. `--rm` remove
o container temporário quando o programa termina. O bind mount fornece o código
local atualizado, sem necessidade de build ou regeneração do autoload.

Saída verificada, com código 0:

```text
Produto do item: Camiseta
Preço unitário em centavos: 4990
Quantidade: 3
Subtotal em centavos: 14970
```

## Verificações

```bash
docker compose exec -T php php -l ItemCarrinho.php
docker compose exec -T php php -l exemplo-item-carrinho.php
```

`exec` usa o container já ativo, `-T` desabilita o terminal virtual, e `php -l`
verifica sintaxe. Ambos os arquivos passaram.

Uma verificação temporária em PHP pela entrada padrão do Docker comparou o
resultado aos valores esperados e conferiu que preço e quantidade permaneceram
iguais aos recebidos:

| Preço em centavos | Quantidade | Subtotal esperado e obtido |
| --- | --- | --- |
| 4990 | 1 | 4990 |
| 4990 | 3 | 14970 |
| 0 | 3 | 0 |

Os três cenários passaram com código 0. O novo exemplo retornou HTTP 403 ao
ser acessado pelo navegador. Não foram instaladas dependências, alterados
Compose ou Dockerfile, ou executado o contador. Não criamos testes PHPUnit
nesta etapa; a verificação foi temporária.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa: 3.15, conferir os requisitos
de PHPUnit compatível com PHP 8.4 e as extensões disponíveis no container,
explicando testes automatizados e preparando apenas o que for necessário.
Não instalar a ferramenta antecipadamente. O estado fica no
[progresso](../progresso.md).
