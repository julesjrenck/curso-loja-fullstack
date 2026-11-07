# Aula 8.58 — Objeto JavaScript para representar um produto

Iniciada em 07/11/2026 após a 8.57, com entendimento e sucesso geral relatados
em "funcinou e entendi", interpretado como "funcionou e entendi". Checkpoint
anterior publicado em 6acc1ba85ebe42fd4412d230eb37b7add7d2e2e1;
HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Agrupar dados de um produto em um objeto JavaScript. Isso prepara o trabalho
com produtos recebidos em respostas da API. Nesta etapa, os valores são locais
de demonstração e o objeto é apenas registrado no Console.

Em [vitrine.js](../../src/vitrine.js), depois do registro de carregamento,
acrescentamos:

```js
const produtoExemplo = {
    nome: 'Camiseta',
    preco: 4990,
};

console.log('Produto de exemplo:', produtoExemplo);
```

## Chaves, propriedades e valores

O trecho entre { e } é uma expressão que cria um objeto. Essa forma é chamada
literal de objeto; não precisamos declarar uma classe para criá-lo.
As chaves aqui delimitam dados do objeto, com contexto diferente das chaves
que delimitam o corpo de uma função ou um bloco try.

Cada propriedade associa uma chave a um valor. Os dois-pontos separam os dois;
as vírgulas separam as propriedades. A vírgula depois de 4990 é permitida e
facilita acrescentar outra propriedade mais tarde. O ponto e vírgula depois
de } encerra a declaração de const.

| Propriedade | Valor | Tipo e significado neste exemplo |
| --- | --- | --- |
| nome | 'Camiseta' | String com o nome do produto |
| preco | 4990 | Number inteiro, preço em centavos: R$ 49,90 |

O número não tem aspas. O Console mostrará 4990; a unidade em centavos é uma
convenção dos dados, não algo que JavaScript descobre pelo nome da propriedade.
A apresentação monetária será feita quando utilizarmos o preço na tela.

Em PHP, um array associativo como ['nome' => 'Camiseta', 'preco' => 4990]
também pode agrupar esses dados. Em JavaScript, esta sintaxe com chaves e
dois-pontos cria um objeto. Mais adiante estudaremos arrays de produtos.

produtoExemplo é o nome da variável que guarda a referência ao objeto.
const impede reatribuir essa variável; não congela automaticamente suas
propriedades. Nesta etapa apenas criamos e registramos os dados.

console.log recebe um prefixo e o objeto. O navegador pode mostrá-lo de forma
expansível. Os campos esperados são nome com Camiseta e preco com 4990; a ordem
ou aparência da apresentação pode variar. O registro não altera os cartões.

Referência primária: [Object Initializer na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-object-initializer).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua com dois cartões estáticos e
carregando vitrine.js como módulo. O import de prepararTexto de
[textos.js](../../src/textos.js), formulário, filtro e funções async são
preservados. [vitrine.css](../../src/vitrine.css) mantém o layout. produtoExemplo
é apenas um dado JavaScript no módulo; a busca continua lendo os nomes dos
cartões do HTML. Não há API, persistência ou dependência nova nesta etapa.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio e Info visível. Depois de "JavaScript da vitrine carregado.",
esperamos um registro "Produto de exemplo:" com o objeto. Expanda-o, se necessário,
e confira os dois campos. Os registros iniciais e as quatro mensagens de exibição
async já conhecidas continuam depois. Nenhum resultado foi observado pelo
assistente ou relatado nesta etapa.

Como exercício acompanhado, identifique qual valor é string, qual é número
e qual unidade representa o preço. Não é preciso alterar código para responder.
Informe diferenças ou erros no Console.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2228 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente objeto e seu log acrescentados,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega; execução do registro no navegador sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.59 — leitura de propriedades do produto com ponto.
8.59 não iniciada.
