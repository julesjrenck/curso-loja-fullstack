# Aula 3.1 — Primeira classe de produto

## Objetivo

Começar a representar o catálogo da loja com uma classe PHP, usando tipos,
construtor e acesso controlado aos dados. Os módulos de Git e Docker foram
concluídos após confirmação de entendimento do aluno.

## src/Produto.php

```php
<?php

declare(strict_types=1);

class Produto
{
    private string $nome;
    private int $precoEmCentavos;

    public function __construct(string $nome, int $precoEmCentavos)
    {
        $this->nome = $nome;
        $this->precoEmCentavos = $precoEmCentavos;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPrecoEmCentavos(): int
    {
        return $this->precoEmCentavos;
    }
}
```

- `class Produto` define o modelo de objetos que representam produtos.
- As propriedades guardam os dados de cada instância.
- `private` permite acesso às propriedades dentro da própria classe.
- `string` define nome como texto; `int` define preço como inteiro em centavos.
  No exemplo, `4990` representa 49,90 reais, sem usar uma fração em ponto flutuante.
- `__construct` é chamado ao criar o objeto com `new` e recebe seus dados iniciais.
- `$this` representa o objeto atual. `$this->nome` é sua propriedade; `$nome`
  é o parâmetro recebido pelo construtor.
- Métodos `public` podem ser chamados pelo código externo.
- `: string` e `: int` declaram os tipos de retorno dos métodos.
- `return` devolve o dado para quem chamou o método.

`declare(strict_types=1)` ativa a verificação estrita de tipos escalares nas
chamadas feitas pelo arquivo. Usamos também no script que chama o construtor;
a tipagem dos argumentos depende do arquivo que faz a chamada. No exemplo,
`4990` é um inteiro aceito e `"4990"` é texto recusado nessa chamada estrita.

Tipos e visibilidade controlam a estrutura e o acesso. Nesta etapa, o construtor
ainda não valida nome vazio ou preço negativo; essas regras serão adicionadas
depois de confirmar o entendimento da estrutura.

## src/exemplo-produto.php

O script de terminal carrega a definição da classe:

```php
require_once __DIR__ . "/Produto.php";
```

`__DIR__` identifica a pasta deste script; a concatenação monta o caminho da
classe. `require_once` carrega o arquivo uma vez. Introduziremos autoload quando
estudarmos Composer; nesta etapa, a relação entre os dois arquivos é explícita.

Depois cria e utiliza o objeto:

```php
$produto = new Produto("Camiseta", 4990);

echo "Produto: " . $produto->getNome() . PHP_EOL;
echo "Preço em centavos: " . $produto->getPrecoEmCentavos() . PHP_EOL;
```

- `new` cria uma instância da classe e chama seu construtor.
- `$produto` referencia essa instância.
- `->` acessa os métodos do objeto.
- Os métodos permitem consultar os dados privados.
- `echo`, concatenação e `PHP_EOL` continuam produzindo a saída do terminal.

O script também usa `declare(strict_types=1)` e a proteção `PHP_SAPI !== "cli"`
já estudada, recusando HTTP com status 403. Ele não altera dados no volume.

## Executar e verificar

```bash
docker compose run --rm php php exemplo-produto.php
```

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
```

Também fizemos duas verificações de comportamento em uma execução temporária:
passar preço como texto em chamada estrita gerou `TypeError`, e acessar
`$produto->nome` externamente gerou `Error` por ser uma propriedade privada.
As exceções foram capturadas para confirmar o resultado esperado.

Não criamos testes de getters nem instalamos ferramentas nesta etapa. PHPUnit
será introduzido no módulo para verificar as regras de negócio quando necessário.
O servidor permaneceu respondendo HTTP 200; o exemplo OOP retornou 403 por HTTP.
Os containers temporários foram removidos, sem build ou alteração dos dados.

## Continuidade

Aguardar entendimento antes de validar os dados no construtor e estudar
exceções de entrada. O estado está em [progresso](../progresso.md).

## Fontes

- [Classes e objetos no PHP](https://www.php.net/manual/en/language.oop5.basic.php).
- [Tipos e modo estrito](https://www.php.net/manual/en/language.types.declarations.php).
- [Visibilidade](https://www.php.net/manual/en/language.oop5.visibility.php).
