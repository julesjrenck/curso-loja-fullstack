# Aula 3.12 — Interface Precificavel

## Objetivo

Definir um contrato para consultar preço em centavos e fazer Produto cumpri-lo.
Uma função pode receber um objeto pelo contrato e usar o método exigido.

## Arquivo src/Precificavel.php

```php
<?php

declare(strict_types=1);

namespace Loja;

interface Precificavel
{
    public function getPrecoEmCentavos(): int;
}
```

`declare(strict_types=1)` mantém o padrão dos arquivos PHP do curso.
`namespace Loja` define o nome completo `Loja\Precificavel`. O autoload PSR-4
existente associa esse nome a `/app/Precificavel.php`, montado de `src`.

`interface` declara o contrato. A assinatura do método informa o nome,
os parâmetros e o retorno: `public`, sem argumentos declarados e retorno `int`.
A declaração termina com `;`. O código que obtém o preço fica na classe
que implementa o contrato. Não criamos uma instância com `new Precificavel()`.

## Arquivo src/Produto.php

Alteramos somente a declaração da classe:

```php
class Produto implements Precificavel
```

`implements` declara que Produto cumpre o contrato. O PHP verifica se a classe
oferece os métodos exigidos com assinaturas compatíveis. Produto já tem:

```php
public function getPrecoEmCentavos(): int
{
    return $this->precoEmCentavos;
}
```

O método continua lendo a propriedade privada. A interface exige o acesso pelo
método público; não expõe o armazenamento interno do preço. Como Produto e
Precificavel estão no mesmo namespace, usamos o nome curto sem novo `use`.

## Experiência acompanhada

Executamos uma função temporária, sem acrescentá-la ao código da aplicação:

```php
use Loja\Precificavel;
use Loja\Produto;

function consultarPreco(Precificavel $item): int
{
    return $item->getPrecoEmCentavos();
}

$produto = new Produto("Camiseta", 4990);
echo consultarPreco($produto); // 4990
```

O tipo `Precificavel` do parâmetro exige um objeto que implemente a interface.
Produto atende a essa exigência. `$item` recebe o objeto passado pela chamada;
o método executado é o de Produto. A função utiliza apenas a operação de preço.
Outra classe poderá ser aceita se implementar o mesmo contrato.

Também passamos `new stdClass()`, um objeto vazio padrão do PHP que não
implementa Precificavel. A chamada foi recusada com `TypeError`, capturado em
`try/catch`. Ter uma propriedade de preço, por si só, não cumpre esse contrato.

A experiência foi enviada pela entrada padrão com:

```bash
docker compose run --rm -T php php <<'PHP'
<?php

declare(strict_types=1);

use Loja\Precificavel;
use Loja\Produto;

require_once "/app/vendor/autoload.php";

function consultarPreco(Precificavel $item): int
{
    return $item->getPrecoEmCentavos();
}

$produto = new Produto("Camiseta", 4990);
$preco = consultarPreco($produto);

if ($preco !== 4990) {
    throw new RuntimeException("O contrato deve preservar o preço do produto.");
}

echo "Produto aceito: " . $preco . " centavos" . PHP_EOL;

try {
    consultarPreco(new stdClass());
    throw new RuntimeException("Objeto sem contrato foi aceito indevidamente.");
} catch (TypeError $erro) {
    echo "Objeto sem contrato recusado: TypeError" . PHP_EOL;
}
PHP
```

O bloco enviado começa com `<?php`, `declare(strict_types=1)`, as importações
e `require_once "/app/vendor/autoload.php"`. Termina com uma linha `PHP`.
`<<'PHP'` envia o bloco ao comando sem expandir suas variáveis no shell;
`-T` desabilita o terminal virtual. O primeiro `php` é o serviço e o segundo
é o executável, que lê o código pela entrada padrão. `--rm` remove o container.

Na verificação, conferimos também que o resultado era exatamente 4990 e que
aceitar indevidamente stdClass causaria falha, em vez de sucesso silencioso.

Saída verificada, com código 0:

```text
Produto aceito: 4990 centavos
Objeto sem contrato recusado: TypeError
```

## Verificações

```bash
docker compose exec -T php php -l Precificavel.php
docker compose exec -T php php -l Produto.php
docker compose run --rm php php exemplo-produto.php
```

`exec` executa no serviço já ativo. `php -l` verifica a sintaxe sem executar
a demonstração. Ambos os arquivos passaram. O exemplo existente apresentou
as mesmas nove linhas da aula 3.11 e terminou com código 0.

Não foi necessário build, regenerar autoload, instalar dependências ou alterar
Compose. A experiência ficou na entrada padrão; não criamos testes PHPUnit
nesta etapa. A verificação demonstra funcionamento, não confirma entendimento.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. O próximo passo é estudar
composição com uma classe ItemCarrinho que guarda um Produto e uma quantidade
positiva. O estado atualizado fica no
[progresso](../progresso.md).

## Fonte

- [PHP: interfaces e implements](https://www.php.net/manual/en/language.oop5.interfaces.php).
