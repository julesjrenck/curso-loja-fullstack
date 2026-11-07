# Aula 8.28 — Visibilidade dos produtos com hidden e negação lógica

Iniciada em 07/11/2026 após confirmação da [8.27](08-27-comparacao-includes.md)
com "entendi". Checkpoint anterior publicado e conferido em
8adebc866764c1bfd361b3c92f50d92e6ebf004d; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Usar o booleano da comparação para controlar a exibição de cada cartão.
A propriedade hidden de um elemento HTML permite marcá-lo como oculto.
Nesta etapa, atribuímos true para ocultar e false para retirar essa marcação.
Como corresponde significa que o cartão deve aparecer, usaremos a negação
lógica ! para obter o valor de hidden.

## Alteração em src/vitrine.js

Acrescentada uma instrução após o cálculo de corresponde. O forEach fica assim:

```js
produtos.forEach(function (produto) {
    const nomeProduto = produto.querySelector('h2').textContent.trim().toLowerCase();
    const corresponde = nomeProduto.includes(termoBusca);

    produto.hidden = !corresponde;

    console.log(nomeProduto, corresponde);
});
```

Produto é o article atual. O ponto acessa sua propriedade hidden. O sinal =
atribui um valor, como nas atribuições já usadas. À direita, !corresponde
nega o booleano: !true resulta em false, e !false resulta em true. O operador
! tem o mesmo papel de negação lógica conhecido no PHP.

| corresponde | !corresponde | produto.hidden | Resultado esperado |
| --- | --- | --- | --- |
| true | false | false | Cartão exibido |
| false | true | true | Cartão oculto |

Lemos a instrução como: ocultar o produto quando ele não corresponde.
Hidden não é uma função, então não usamos parênteses. A atribuição booleana
atualiza o atributo hidden do elemento no DOM; false remove o atributo.
Não estamos escrevendo a string 'false' como atributo HTML.

Referências primárias: [hidden — HTML Standard](https://html.spec.whatwg.org/multipage/interaction.html#dom-hidden)
e [negação lógica — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-logical-not-operator).

## Nova busca e restauração

O elemento oculto permanece no DOM e na coleção produtos. Sua propriedade
textContent ainda pode ser lida. A cada submit, o forEach percorre os dois
cartões, calcula novamente corresponde e atribui novamente hidden. Portanto,
uma nova busca pode revelar um cartão que estava oculto.

Com campo vazio ou somente espaços, termoBusca será string vazia. Includes
retorna true nos dois nomes; !true é false e ambos recebem hidden = false.
Isso restaura os cartões sem precisar recarregar a página.

Não alteramos a variável produtos nem nomeProduto/corresponde após declará-las.
Mudamos uma propriedade do objeto referenciado por produto. Guardar referências
em const não impede essa atualização dos elementos.

## Relação entre arquivos e comportamento esperado

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação.
[src/vitrine.html](../../src/vitrine.html) fornece os cartões e carrega o módulo.
[src/vitrine.css](../../src/vitrine.css) mantém a apresentação; a regra .produto
atual não define display para contrariar a ocultação padrão de hidden.
O agrupador continua com seu Grid; um único cartão mantém a coluna definida
pelo layout, sem uma regra nova para ocupar toda a largura.

Essa é uma busca local sobre os dois cartões já carregados. O submit continua
cancelando o GET nativo; nenhuma consulta à API ou ao banco é enviada.
A página só atualiza o filtro ao enviar: digitar ou limpar o campo sem enviar
não executa novamente o tratamento.

| Busca enviada | Cartões que devem aparecer |
| --- | --- |
| CAMISETA | Camiseta |
| CAN | Caneca |
| ca | Camiseta e Caneca |
| sapato | Nenhum |
| Campo vazio ou somente espaços | Camiseta e Caneca |

Quando nenhum nome corresponde, a área de produtos fica vazia. Ainda não
há mensagem de nenhum resultado; essa interface poderá ser estudada depois.

## Verificação e atividade acompanhada

Conferir posição da atribuição dentro do forEach, inversão dos booleanos,
compatibilidade do CSS, entrega HTTP e igualdade com o arquivo local.
Resultados no [progresso](../progresso.md). Essas verificações não demonstram
o filtro executando em um navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html),
recarregar e enviar as buscas da tabela em sequência, usando Buscar e Enter
no campo. Em especial, depois de sapato, enviar o campo vazio para observar
a restauração dos dois cartões sem recarregar. Resultados esperados;
nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.28 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.29 — verificação do filtro
no navegador, incluindo nova busca e restauração. Não iniciada.
