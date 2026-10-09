# Aula 3.3 — Promoção de propriedades do construtor

Esta aula registra o checkpoint `83f190b`. A aula 3.4 acrescenta um namespace
à classe e importações com `use`; consulte o README para o estado atual.

## Objetivo

Simplificar a declaração das propriedades de `Produto` usando um recurso
disponível desde o PHP 8.0, preservando os tipos, a visibilidade e as regras.

## Antes da alteração

Na aula anterior, cada dado aparecia na declaração da propriedade, no parâmetro
do construtor e na atribuição. A estrutura era:

```php
private string $nome;
private int $precoEmCentavos;

public function __construct(string $nome, int $precoEmCentavos)
{
    // As validações vinham aqui.
    $this->nome = $nome;
    $this->precoEmCentavos = $precoEmCentavos;
}
```

O comentário acima resume as validações para destacar as atribuições.

## Depois da alteração

Em `src/Produto.php`, os parâmetros passam a declarar as propriedades:

```php
public function __construct(
    private string $nome,
    private int $precoEmCentavos,
) {
    if (trim($nome) === "") {
        throw new InvalidArgumentException("O nome do produto não pode ser vazio.");
    }

    if ($precoEmCentavos < 0) {
        throw new InvalidArgumentException("O preço em centavos não pode ser negativo.");
    }
}
```

- `private` no parâmetro do construtor ativa a promoção: declara uma propriedade
  privada e faz o PHP atribuir a ela o argumento recebido.
- `string` e `int` tipam tanto os parâmetros quanto as propriedades promovidas.
- `$nome` e `$precoEmCentavos` continuam disponíveis como parâmetros no corpo.
- `$this->nome` e `$this->precoEmCentavos` continuam acessíveis nos métodos.
- A vírgula depois do último parâmetro é permitida nesta versão do PHP.

As declarações separadas e as duas atribuições explícitas foram removidas.
Os métodos `getNome()` e `getPrecoEmCentavos()` continuam iguais.

## Ordem de execução e validações

Na versão anterior, as atribuições explícitas vinham depois das validações.
Com promoção, o PHP atribui os argumentos às propriedades **antes de executar
o corpo do construtor**. Então as nossas validações são executadas.

Se uma validação lançar uma exceção, `new Produto(...)` continua sem entregar
uma instância criada com sucesso ao chamador. Neste exemplo, as verificações
usam apenas os parâmetros e o construtor não publica a instância para outro
código. Os comportamentos observados na demonstração permanecem os mesmos.

Promoção reduz repetição; não substitui a validação dos valores.
`trim` continua sendo usado apenas na comparação, preservando o nome recebido
quando a entrada é aceita.

## Relação com o exemplo e execução

`src/exemplo-produto.php` continua carregando a classe com `require_once` e
criando o produto com `new Produto("Camiseta", 4990)`. Não foi alterado.

```bash
docker compose run --rm php php exemplo-produto.php
```

O serviço `php` usa o bind mount para ler o código atualizado. O segundo `php`
é o executável que recebe o arquivo; `--rm` remove o container temporário.
Não foi necessário reconstruir a imagem.

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Produto recusado: O preço em centavos não pode ser negativo.
```

Uma verificação em PHP, enviada pela entrada padrão de um container temporário,
também confirmou oito comportamentos:

| Cenário | Resultado |
| --- | --- |
| Nome válido e 4990 centavos | Aceito, dados preservados. |
| Nome válido e zero centavos | Aceito. |
| Nome válido com espaços nas bordas | Aceito, espaços preservados. |
| Nome vazio | `InvalidArgumentException`. |
| Nome apenas com espaços, tabulação e quebra de linha | `InvalidArgumentException`. |
| Preço negativo | `InvalidArgumentException`. |
| Preço como texto em chamada estrita | `TypeError`. |
| Acesso externo direto à propriedade privada | `Error`. |

Todas passaram. Não houve instalação de dependências nem mudança na configuração
Docker, no servidor ou nos dados persistidos. PHPUnit será introduzido depois.

## Continuidade

Aguardar confirmação de entendimento. Depois, introduzir namespace na classe
e `use` no exemplo, mantendo `require_once` até a aula de autoload.
O estado está em [progresso](../progresso.md).

## Fonte

[Manual PHP: construtores e promoção de propriedades](https://www.php.net/manual/en/language.oop5.decon.php).
