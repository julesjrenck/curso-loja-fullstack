# Aula 3.2 — Validação no construtor e exceções

## Objetivo

Acrescentar regras à classe de produto e tratar uma entrada inválida no código
que tenta criar o objeto. Tipos verificam formatos; regras verificam os valores.

## Regras no construtor

Antes de atribuir valores às propriedades em `src/Produto.php`, acrescentamos:

```php
if (trim($nome) === "") {
    throw new InvalidArgumentException("O nome do produto não pode ser vazio.");
}

if ($precoEmCentavos < 0) {
    throw new InvalidArgumentException("O preço em centavos não pode ser negativo.");
}
```

- `trim` remove os espaços e caracteres de borda definidos pela função, como
  espaços comuns, tabulações e quebras de linha.
- `=== ""` compara estritamente o resultado com uma string vazia.
- A primeira condição recusa nomes vazios ou compostos apenas desses caracteres.
- `< 0` recusa valores negativos; zero continua permitido.
- `new InvalidArgumentException` cria o objeto que descreve a entrada inválida.
- `throw` lança a exceção e interrompe a execução normal do construtor.

As atribuições `$this->nome = $nome` e `$this->precoEmCentavos = $precoEmCentavos`
ocorrem depois das verificações. Se uma regra falhar, a chamada `new Produto(...)`
não entrega uma instância criada com sucesso para o código que a chamou.

Usamos `trim` somente na comparação; o nome original é preservado para entradas
válidas. Esta etapa não introduz normalização de texto nem uma regra abrangente
de espaços Unicode. Os métodos públicos e a tipagem foram mantidos.

## Tratar a exceção

O script `src/exemplo-produto.php` mantém o produto válido e acrescenta:

```php
try {
    new Produto("Camiseta", -100);
} catch (InvalidArgumentException $erro) {
    echo "Produto recusado: " . $erro->getMessage() . PHP_EOL;
}
```

- `try` delimita a operação que pode lançar uma exceção.
- `catch` trata a exceção do tipo indicado.
- `$erro` recebe a exceção lançada pelo construtor.
- `getMessage()` devolve a mensagem definida no `throw`.
- O fluxo pode continuar depois do tratamento, em vez de terminar por uma
  exceção não capturada.

Capturamos a exceção específica dessa entrada. `TypeError`, como o demonstrado
na aula anterior para preço em texto, pertence a outro tipo de erro e não é
capturado por esse `catch`.

## Executar

```bash
docker compose run --rm php php exemplo-produto.php
```

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Produto recusado: O preço em centavos não pode ser negativo.
```

## Verificações de comportamento

Executamos uma matriz de dados em PHP dentro de um container temporário:

| Entrada | Resultado verificado |
| --- | --- |
| `Camiseta`, 4990 centavos | Aceita. |
| `Brinde`, 0 centavos | Aceita, confirmando o limite da regra. |
| ` Camiseta `, 4990 centavos | Aceita, com os dados originais preservados. |
| Nome vazio | Recusada com `InvalidArgumentException`. |
| Nome apenas com espaços, tabulação e quebra de linha | Recusada. |
| `Camiseta`, -1 centavo | Recusada. |

As seis verificações passaram. O procedimento retornaria falha se uma entrada
inválida fosse aceita ou uma entrada válida fosse recusada ou alterada.
Esses cenários servirão de base para os testes PHPUnit quando introduzirmos
a ferramenta no módulo. Não instalamos dependências nesta etapa.

O código foi lido pelo bind mount, sem build. Servidor, volume e configuração
local foram preservados; a demonstração continua exclusiva do terminal.

## Continuidade

Aguardar entendimento antes de estudar promoção de propriedades no construtor,
um recurso do PHP 8 que simplifica a declaração da classe. O estado está em
[progresso](../progresso.md).

## Fontes

- [trim](https://www.php.net/manual/en/function.trim.php).
- [InvalidArgumentException](https://www.php.net/manual/en/class.invalidargumentexception.php).
- [try e catch](https://www.php.net/manual/en/control-structures.try-catch.php).
