# Aula 8.60 — Array de produtos

Iniciada em 07/11/2026 após confirmação da 8.59 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
a253be84f7ca71fe41dda4379ae92e1175dd0799; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Reunir vários produtos em uma lista ordenada. Em [vitrine.js](../../src/vitrine.js),
depois dos registros de produtoExemplo, acrescentamos:

```js
const produtosExemplo = [
    produtoExemplo,
    {
        nome: 'Caneca',
        preco: 2990,
    },
];

console.log('Produtos de exemplo:', produtosExemplo);
```

O primeiro elemento é o objeto já guardado em produtoExemplo, a Camiseta com
preco 4990. O segundo é um objeto criado diretamente dentro da lista, a Caneca
com preco 2990. Os dois preços continuam sendo números inteiros em centavos:
R$ 49,90 e R$ 29,90.

## Array e objetos

Os colchetes [ e ] criam o array literal. Cada expressão dentro deles fornece
um elemento; a vírgula separa os elementos. As chaves { e } internas criam
o objeto da Caneca. Nele, dois-pontos separam propriedade e valor, como antes.

| Estrutura neste exemplo | Papel |
| --- | --- |
| Array produtosExemplo | Agrupa os dois produtos em ordem |
| Objeto produtoExemplo | Guarda nome/preco da Camiseta |
| Objeto criado dentro do array | Guarda nome/preco da Caneca |

O array não guarda apenas os nomes: cada elemento é um objeto com as duas
propriedades. Colocamos produtoExemplo diretamente como primeiro elemento;
usamos o mesmo objeto, sem criar uma cópia dele. As propriedades continuam
agrupadas por produto.

Nesse array sem posições vazias, os índices são 0 para o primeiro elemento
e 1 para o segundo. A quantidade é dois. A leitura de uma posição e a
propriedade length serão a próxima etapa, após entendimento desta criação.

Em PHP, isso lembra uma lista indexada com um registro de produto em cada
posição. Aqui, criamos um Array JavaScript cujos elementos são objetos.
Não declaramos uma classe ou um tipo obrigatório para os elementos.

console.log recebe o prefixo e o array. No navegador, ele pode ser mostrado
de forma expansível com dois elementos. A aparência exata pode variar; confira
o conteúdo e a ordem Camiseta/Caneca, com nome/preco de cada objeto.

Referência primária: [Array Initializer na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-array-initializer).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua contendo os dois cartões e
carregando vitrine.js como módulo. O import de prepararTexto de
[textos.js](../../src/textos.js), o formulário, o filtro e as funções async
permanecem iguais. [vitrine.css](../../src/vitrine.css) mantém o layout.

produtosExemplo é o array de dados locais que criamos nesta aula. A variável
produtos já existente vem de document.querySelectorAll e contém uma NodeList
dos cartões do HTML. São variáveis e estruturas diferentes. A busca continua
usando essa NodeList; ainda não usamos o array para criar ou filtrar cartões.
Nenhuma API, persistência, dependência ou container novo.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio e Info visível. Depois dos registros do produto e de suas
propriedades, esperamos "Produtos de exemplo:" com dois objetos. Expanda o
array, se necessário, e confira Camiseta/4990 e Caneca/2990, nessa ordem.
Os registros posteriores e a exibição async já conhecidos continuam depois.

Como exercício acompanhado, identifique o que os colchetes agrupam e o que as
chaves internas agrupam. Não é preciso alterar código para responder. Informe
diferenças ou erros. Resultados esperados, sem observação direta ou relato.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2503 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente array de dois objetos e seu
log acrescentados, com HTML/CSS/textos.js preservados. Links locais conferidos.
Isso demonstra entrega; execução da criação/registro no navegador sem observação
ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.61 — índices e length do array de produtos.
8.61 não iniciada.
