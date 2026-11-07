# Aula 8.61 — Índices e length do array de produtos

Iniciada em 07/11/2026 após confirmação da 8.60 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
ea9d7d96b20a100d1bb77fdebea872c9866fd55d; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Ler elementos pela posição e consultar o tamanho do array. Em
[vitrine.js](../../src/vitrine.js), depois do registro de produtosExemplo,
acrescentamos:

```js
console.log('Primeiro produto:', produtosExemplo[0].nome);
console.log('Segundo produto:', produtosExemplo[1].nome);
console.log('Quantidade de produtos:', produtosExemplo.length);
```

## Índice primeiro, propriedade depois

produtosExemplo[0] lê o elemento no índice zero, o objeto da Camiseta.
A seguir, .nome lê a propriedade desse objeto. A expressão completa
produtosExemplo[0].nome produz a string 'Camiseta'.

produtosExemplo[1] lê o segundo elemento, o objeto da Caneca. Sua propriedade
nome produz a string 'Caneca'. Os índices deste array começam em zero;
a posição ordinal "primeiro" corresponde ao índice 0, não ao índice 1.

| Expressão | Resultado neste exemplo |
| --- | --- |
| produtosExemplo[0] | Objeto da Camiseta |
| produtosExemplo[0].nome | String 'Camiseta' |
| produtosExemplo[1] | Objeto da Caneca |
| produtosExemplo[1].nome | String 'Caneca' |
| produtosExemplo.length | Número 2 |

Na criação da 8.60, os colchetes delimitavam a expressão do array literal.
Agora, depois do nome produtosExemplo, [0] ou [1] indica um acesso a uma posição.
O contexto da expressão determina esse papel da sintaxe.

## Length é uma propriedade

Neste array com dois elementos e sem posições vazias, length vale 2 e corresponde
à quantidade de produtos. O último índice utilizado é 1. Não confunda quantidade
com último índice.

Escrevemos .length sem parênteses porque lemos uma propriedade, como já fizemos
com .nome e .preco. Para comparar com uma lista PHP, consultaríamos sua quantidade
com count($produtos); aqui consultamos uma propriedade do array.

Arrays JavaScript também podem ter posições vazias; nesses casos, length não
conta apenas os elementos presentes. Nosso exemplo é uma lista contínua de dois
produtos. Não criamos posições vazias ou modificamos length nesta etapa.

As três linhas apenas leem valores e os registram com console.log. Objeto e
array permanecem iguais. A vírgula separa prefixo e valor nos argumentos do log.

Referências primárias: [Property Accessors](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-property-accessors)
e [length dos arrays na especificação ECMAScript](https://tc39.es/ecma262/multipage/indexed-collections.html#sec-properties-of-array-instances-length).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua com cartões estáticos e carregando
vitrine.js como módulo. Import de prepararTexto de [textos.js](../../src/textos.js),
formulário, filtro, dados anteriores e funções async preservados.
[vitrine.css](../../src/vitrine.css) mantém o layout. produtosExemplo é o array de
dados; produtos continua sendo a NodeList dos cartões usada pela busca. Nenhuma
API, persistência, dependência ou container novo.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio e Info visível. Depois do registro do array, esperamos:

```text
Primeiro produto: Camiseta
Segundo produto: Caneca
Quantidade de produtos: 2
```

Os registros posteriores e a exibição async já conhecidos continuam depois.
Como exercício acompanhado, pense no valor de produtosExemplo[1].preco: primeiro
escolha o objeto pelo índice e depois sua propriedade. Não é preciso alterar
código para responder. Informe diferenças ou erros. Resultados esperados, sem
observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2684 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente três logs com índices e length,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega; execução dessas leituras no navegador sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.62 — forEach no array de produtos. Não iniciada.
