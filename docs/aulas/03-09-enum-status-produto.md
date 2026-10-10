# Aula 3.9 — Enum de estados de produto

## Objetivo

Representar um conjunto fechado de estados com um tipo PHP. O enum do exemplo
oferece as opções Ativo e Inativo, cada uma associada a um texto.
Um parâmetro tipado com esse enum exige um de seus casos.

## Arquivo src/StatusProduto.php

```php
<?php

declare(strict_types=1);

namespace Loja;

enum StatusProduto: string
{
    case Ativo = "ativo";
    case Inativo = "inativo";
}
```

- `declare(strict_types=1)` mantém a configuração de tipagem dos nossos arquivos.
- `namespace Loja` organiza o nome completo como `Loja\StatusProduto`.
- `enum` define um tipo com um conjunto de casos declarados.
- `: string` define o tipo do valor associado aos casos. É um enum com valor
  escalar associado, chamado de backed enum.
- Cada `case` declara uma opção: Ativo associa-se a `"ativo"`, Inativo a `"inativo"`.

`StatusProduto::Ativo` é um caso do tipo StatusProduto, não a string `"ativo"`.
Os casos são objetos fornecidos pelo enum. Para selecionar um deles usamos
`::`, como no exemplo; não escrevemos `new StatusProduto(...)`.

Isso ajuda a evitar estados representados por textos inconsistentes, quando
parâmetros ou propriedades exigem o tipo StatusProduto. Uma variável comum
continua podendo receber strings; criar um enum não tipa todas as variáveis
do programa automaticamente.

## Arquivo src/exemplo-status-produto.php

O início segue o padrão dos exemplos anteriores:

```php
declare(strict_types=1);

use Loja\StatusProduto;

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

require_once __DIR__ . "/vendor/autoload.php";
```

`use` permite o nome curto StatusProduto. A condição recusa HTTP e mantém a
demonstração exclusiva do terminal. `require_once` inicializa o autoload.

O trecho novo é:

```php
$status = StatusProduto::Ativo;

echo "Caso: " . $status->name . PHP_EOL;
echo "Valor: " . $status->value . PHP_EOL;
```

- `StatusProduto::Ativo` seleciona o caso Ativo.
- `$status` recebe esse caso.
- `->name` fornece o nome do caso: `Ativo`.
- `->value` fornece o valor textual associado: `ativo`.
- O ponto concatena os textos; `PHP_EOL` termina cada linha.

O nome do caso identifica a opção no código; o valor associado fornece sua
representação textual. Essa representação será útil mais tarde para persistir
ou enviar estados em uma API.

O arquivo se chama StatusProduto.php e declara Loja\StatusProduto. Isso
corresponde ao mapeamento PSR-4 existente. O autoload já gerado encontrou o
novo enum; não foi necessário executar novamente `composer dump-autoload`.

## Execução e resultado

```bash
docker compose run --rm php php exemplo-status-produto.php
```

O primeiro `php` é o serviço Compose, o segundo é o executável PHP no container.
O arquivo indicado é executado, e `--rm` remove o container temporário.

Saída verificada, com código 0:

```text
Caso: Ativo
Valor: ativo
```

## Verificação acompanhada de tipos

Uma função temporária de verificação, executada em PHP pelo Docker, recebeu
o tipo do enum como parâmetro:

```php
function receberStatus(StatusProduto $status): string
{
    return $status->value;
}
```

`receberStatus(StatusProduto::Ativo)` retornou `"ativo"`.
`receberStatus(StatusProduto::Inativo)` retornou `"inativo"`.
Já `receberStatus("ativo")` produziu TypeError, capturado pela verificação.
O texto associado não é convertido automaticamente em um caso de enum.
Essa função foi usada apenas na verificação, sem ser adicionada à aplicação.

Resultados adicionais:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- O enum estava ausente antes do autoload e foi carregado quando acessamos
  o caso; a lista de arquivos incluídos confirmou `/app/StatusProduto.php`.
- A comparação estrita entre o caso e seu texto confirmou valores diferentes.
- Seis verificações de comportamento passaram, com código 0.
- O novo exemplo recusou HTTP com 403.

Não alteramos Produto, o exemplo anterior ou o Composer. O bind mount forneceu
os novos arquivos, sem build, regeneração do autoload ou novas dependências.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.10, acrescentar uma propriedade
StatusProduto ao construtor de Produto, com Ativo como padrão, e um getter
que retorna o enum. Demonstrar estado padrão e estado Inativo no exemplo,
verificando que o parâmetro exige o enum. Não criar transições de estado ainda.
O estado está em [progresso](../progresso.md).

## Fontes

- [PHP: fundamentos de enums](https://www.php.net/manual/en/language.enumerations.basics.php).
- [PHP: enums com valores associados](https://www.php.net/manual/en/language.enumerations.backed.php).
