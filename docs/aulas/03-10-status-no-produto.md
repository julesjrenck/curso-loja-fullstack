# Aula 3.10 — Estado inicial tipado de Produto

## Objetivo

Usar o enum da aula anterior como um dado do produto, exigindo um estado válido
e oferecendo Ativo como padrão quando esse argumento for omitido.

## Arquivo src/Produto.php

O início do construtor agora é:

```php
public function __construct(
    private string $nome,
    private int $precoEmCentavos,
    private StatusProduto $status = StatusProduto::Ativo,
) {
    // Validações de nome e preço continuam aqui.
}
```

A nova linha combina conceitos já estudados:

- `private` declara uma propriedade privada por promoção do construtor.
- `StatusProduto` exige um caso desse enum como argumento e valor da propriedade.
- `$status` é o nome do parâmetro e da propriedade promovida.
- `= StatusProduto::Ativo` define o valor padrão quando omitimos o terceiro
  argumento. O PHP permite usar um caso de enum como padrão de parâmetro.

Produto e StatusProduto estão no namespace Loja, então a classe pode usar esse
nome curto sem adicionar um `use`. O autoload carrega os arquivos quando
necessário. `StatusProduto.php` não foi alterado.

Assim como as outras propriedades promovidas, o status é atribuído antes do
corpo do construtor. As validações existentes de nome e preço permanecem iguais.
Um argumento de tipo incorreto produz TypeError e impede a criação com sucesso.

## Consultar o estado

Acrescentamos este método:

```php
public function getStatus(): StatusProduto
{
    return $this->status;
}
```

`public` permite a consulta por código externo. `: StatusProduto` define o tipo
do retorno. `$this->status` acessa a propriedade do objeto atual.

O getter retorna o caso, não o texto associado. Para imprimir o texto, usamos
`$produto->getStatus()->value`: primeiro chamamos o método, depois consultamos
`value` no caso retornado.

A propriedade privada continua protegida contra leitura ou alteração direta
externa. Nesta etapa oferecemos apenas consulta, sem métodos para mudar estado.

## Arquivo src/exemplo-produto.php

Adicionamos `use Loja\StatusProduto` para indicar o enum usado no exemplo.
A camiseta continua sendo criada com dois argumentos:

```php
$produto = new Produto("Camiseta", 4990);

echo "Status: " . $produto->getStatus()->value . PHP_EOL;
```

Como o terceiro argumento foi omitido, seu estado inicial é Ativo.

Depois acrescentamos um produto com estado explícito:

```php
$produtoInativo = new Produto("Calça", 8990, StatusProduto::Inativo);

echo "Produto: " . $produtoInativo->getNome() . PHP_EOL;
echo "Status: " . $produtoInativo->getStatus()->value . PHP_EOL;
```

Os argumentos representam nome, preço em centavos e estado, nessa ordem.
O `try/catch` da tentativa de preço negativo permanece no exemplo, assim como
o autoload e a restrição de execução ao terminal.

Uma string com o texto correspondente não substitui o enum:

```php
new Produto("Camiseta", 4990, "ativo"); // Produz TypeError.
```

O padrão só é usado quando omitimos o argumento. Passar `null` explicitamente
também é inválido, pois o parâmetro não aceita esse tipo.

## Execução

```bash
docker compose run --rm php php exemplo-produto.php
```

O serviço PHP executa o script no container temporário, removido por `--rm`.
O bind mount fornece as alterações sem build ou regeneração do autoload.

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Status: ativo
Produto: Calça
Status: inativo
Produto recusado: O preço em centavos não pode ser negativo.
```

## Verificações

`php -l` pelo Docker confirmou a sintaxe dos dois arquivos alterados.
Uma verificação em PHP pela entrada padrão de outro container cobriu:

| Cenário | Resultado |
| --- | --- |
| Dois argumentos | Produto criado com Ativo. |
| Terceiro argumento Inativo | Estado Inativo preservado. |
| Ativo explícito e preço zero | Aceitos. |
| Nome com bordas, preço válido e Inativo | Nome e preço preservados. |
| String "ativo" como estado | TypeError. |
| String "inativo" como estado | TypeError. |
| null como estado | TypeError. |
| Nome vazio com enum válido | InvalidArgumentException. |
| Nome só com espaços com enum válido | InvalidArgumentException. |
| Preço negativo com enum válido | InvalidArgumentException. |
| Alteração externa direta de status | Error, estado anterior preservado. |

As onze verificações passaram, com código 0. A ferramenta PHPUnit ainda será
introduzida; não acrescentamos um arquivo de teste nesta etapa.
Docker, configuração local e volumes não foram alterados.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.11, adicionar métodos públicos
`ativar(): void` e `desativar(): void`, demonstrando alterações na propriedade
privada por ações do objeto. Verificar a sequência e o isolamento entre produtos.
O estado está em [progresso](../progresso.md).

## Fontes

- [PHP: casos de enum como valores padrão](https://www.php.net/manual/en/language.enumerations.expressions.php).
- [PHP: declarações de tipos](https://www.php.net/manual/en/language.types.declarations.php).
