# Aula 3.11 — Ações e encapsulamento de Produto

## Objetivo

Alterar o estado de um produto por métodos públicos da classe, mantendo sua
propriedade privada. O objeto reúne dados e ações sobre esses dados.

## Arquivo src/Produto.php

Acrescentamos dois métodos:

```php
public function ativar(): void
{
    $this->status = StatusProduto::Ativo;
}

public function desativar(): void
{
    $this->status = StatusProduto::Inativo;
}
```

- `public` permite chamar a ação por código externo.
- `function` declara o método da classe.
- `ativar` e `desativar` nomeiam as ações.
- `()` indica que esses métodos não recebem argumentos declarados.
- `: void` indica uma ação sem valor de retorno declarado para fornecer.
- `$this` refere-se ao produto em que o método foi chamado.
- `->status` acessa sua propriedade privada dentro da classe.
- `=` atribui o caso do enum correspondente ao estado escolhido.

O método pode acessar a propriedade privada porque faz parte da classe Produto.
Código externo continua consultando o estado por `getStatus()` e agora pode
solicitar essas ações pelos métodos públicos.

O efeito da chamada é a mudança do estado. Em seguida, podemos usar
`getStatus()` para consultar o resultado. Não precisamos atribuir o retorno
de `ativar()` ou `desativar()` a uma variável.

Essa organização aplica encapsulamento: Produto mantém seus dados privados
e define as operações disponíveis para quem o utiliza. Os nomes das ações
também expressam a intenção do código que as chama.

Nesta regra simples, ativar um produto ativo mantém Ativo; desativar um produto
inativo mantém Inativo. Não há erro por repetir a ação. Os métodos atribuem
casos à propriedade do produto, sem modificar os objetos dos casos do enum.

Construtor, validações, tipos e getters permanecem iguais à aula anterior.

## Arquivo src/exemplo-produto.php

Depois de criar e mostrar a camiseta ativa e a calça inativa, acrescentamos:

```php
$produto->desativar();
echo "Camiseta após desativar: " . $produto->getStatus()->value . PHP_EOL;

$produto->ativar();
echo "Camiseta após ativar: " . $produto->getStatus()->value . PHP_EOL;
echo "Calça continua: " . $produtoInativo->getStatus()->value . PHP_EOL;
```

`$produto->desativar()` chama a ação na camiseta. Dentro desse método, `$this`
é esse produto. A consulta seguinte mostra inativo. A chamada de `ativar()`
atribui Ativo à mesma propriedade e a consulta mostra ativo.

`$produtoInativo` contém outra instância, criada por outro `new Produto(...)`.
Ela mantém seu próprio estado. Chamar uma ação na camiseta não chama a ação
na calça; a última linha confirma que a calça continua inativa.

O autoload, a restrição CLI e o exemplo de entrada inválida permanecem iguais.

## Executar

```bash
docker compose run --rm php php exemplo-produto.php
```

O primeiro `php` é o serviço Compose; o segundo é o executável que roda o script.
`--rm` remove o container temporário. Como o código vem pelo bind mount,
não foi necessário build ou regeneração do autoload.

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Status: ativo
Produto: Calça
Status: inativo
Camiseta após desativar: inativo
Camiseta após ativar: ativo
Calça continua: inativo
Produto recusado: O preço em centavos não pode ser negativo.
```

## Verificações de comportamento

A sintaxe dos dois arquivos foi verificada por `php -l` no Docker.
Uma verificação em PHP enviada pela entrada padrão de um container cobriu:

| Cenário | Resultado |
| --- | --- |
| Desativar camiseta ativa | Inativo. |
| Desativar novamente | Continua Inativo. |
| Ativar camiseta inativa | Ativo. |
| Ativar novamente | Continua Ativo. |
| Ações na camiseta | Calça continua Inativo. |
| Ativar calça após desativar camiseta | Calça fica Ativo; camiseta continua Inativo. |
| Consultar nomes e preços após ações | Valores originais preservados. |
| Tentar alterar status diretamente por código externo | Error; estado anterior preservado. |

As oito verificações passaram, com código 0. Não acrescentamos um arquivo
de teste à aplicação; PHPUnit será introduzido depois. Docker, configuração
local e volumes não foram alterados nesta etapa.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.12, definir a interface
`Loja\Precificavel` com `getPrecoEmCentavos(): int` e fazer Produto implementá-la.
Explicar contrato, `implements` e um parâmetro tipado com a interface em uma
pequena experiência acompanhada. O estado está em [progresso](../progresso.md).

## Fontes

- [PHP: visibilidade de propriedades e métodos](https://www.php.net/manual/en/language.oop5.visibility.php).
- [PHP: retorno void](https://www.php.net/manual/en/language.types.void.php).
