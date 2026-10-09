# Aula 3.4 — Namespace e use

## Objetivo

Organizar a identificação da classe de produto. Um namespace permite distinguir
classes que tenham o mesmo nome curto em diferentes partes de um projeto ou
em bibliotecas. Nesta etapa usamos o grupo `Loja`.

## Arquivo src/Produto.php

O início do arquivo agora é:

```php
<?php

declare(strict_types=1);

namespace Loja;

use InvalidArgumentException;

class Produto
{
    // Construtor e métodos permanecem aqui.
}
```

- `declare(strict_types=1)` permanece no início.
- `namespace Loja` declara o namespace das classes definidas neste arquivo.
  A declaração vem antes do restante do código, depois de `declare`.
- `Produto` passa a ter o nome completo `Loja\Produto`.
- `use InvalidArgumentException` permite usar a classe de exceção do namespace
  global nos nossos `throw`. Sem essa importação, o nome curto seria resolvido
  como `Loja\InvalidArgumentException`, classe que não existe no projeto.

O namespace é parte do nome da classe. Declarar `namespace Loja` não cria uma
pasta nem move o arquivo, que continua sendo `src/Produto.php`.
Posteriormente usaremos uma convenção de autoload para relacionar nomes e
caminhos. Construtor, regras e getters permanecem como na aula anterior.

## Arquivo src/exemplo-produto.php

Acrescentamos depois de `declare`:

```php
use Loja\Produto;
```

O trecho que carrega e cria o produto continua:

```php
require_once __DIR__ . "/Produto.php";

$produto = new Produto("Camiseta", 4990);
```

`use Loja\Produto` faz o nome curto `Produto` referir-se a `Loja\Produto` neste
arquivo. Importações são locais a cada arquivo; não são herdadas por um arquivo
carregado com `require_once`. O exemplo continua no namespace global e seu
`catch (InvalidArgumentException $erro)` continua apontando à exceção global.

Sem a importação, poderíamos escrever o nome completo:

```php
$produto = new \Loja\Produto("Camiseta", 4990);
```

A barra inicial indica um nome absoluto, a partir do namespace global.

## Nome e carregamento

| Instrução | Papel nesta etapa |
| --- | --- |
| `namespace Loja` | Define o grupo da classe declarada em Produto.php. |
| `use Loja\Produto` | Permite escrever Produto no exemplo referindo-se a Loja\Produto. |
| `require_once __DIR__ . "/Produto.php"` | Carrega e executa o arquivo uma vez. |

`use` sozinho não carrega o arquivo da classe. Nesta etapa precisamos do
`require_once` antes da criação do objeto. Em outra aula introduziremos autoload.

## Execução e verificação

```bash
docker compose run --rm php php exemplo-produto.php
```

O primeiro `php` é o serviço Compose. O segundo é o executável dentro do
container, que executa o arquivo indicado. `--rm` remove o container temporário.
O bind mount permite ler a alteração sem reconstruir a imagem.

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Produto recusado: O preço em centavos não pode ser negativo.
```

A sintaxe dos dois arquivos foi verificada com `php -l` pelo Docker.
Uma experiência em PHP pela entrada padrão do container também confirmou:

- Antes do `require_once`, `class_exists(Produto::class, false)` retorna falso,
  mesmo tendo `use`. O segundo argumento impede tentativa de autoload.
- Depois do carregamento, retorna verdadeiro.
- A declaração não criou uma classe chamada `Produto` no namespace global.
- `get_class` mostra `Loja\Produto` para o objeto criado pelo nome curto.
- A criação pelo nome absoluto também funciona e preserva seus dados.
- Nome vazio, nome só com espaços e preço negativo são recusados e capturados
  pelo `catch` da exceção global.

As oito verificações passaram. A experiência não acrescentou arquivos nem
dependências. Servidor, configuração Docker e dados persistidos preservados.

## Continuidade

Aguardar confirmação de entendimento. A próxima etapa será disponibilizar
Composer na imagem PHP, com versão fixada, e verificar `composer --version`.
A configuração de autoload será ensinada em etapa posterior.
O estado está em [progresso](../progresso.md).

## Fontes

- [PHP: declaração de namespaces](https://www.php.net/manual/en/language.namespaces.definition.php).
- [PHP: importação com use](https://www.php.net/manual/en/language.namespaces.importing.php).
