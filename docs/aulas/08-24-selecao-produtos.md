# Aula 8.24 — Seleção dos produtos com querySelectorAll

Iniciada em 07/11/2026 após confirmação da [8.23](08-23-termo-busca-minusculas.md)
com "entendi". Checkpoint anterior publicado e conferido em
efe5e3a3d18ec7b461b137728769cce5101bce97; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Selecionar todos os cartões de produto para trabalhar com cada um nas próximas
etapas. Uma seleção pode retornar um elemento ou uma coleção. QuerySelectorAll
recebe um seletor CSS e retorna uma NodeList com todos os elementos correspondentes.

## Alteração em src/vitrine.js

Acrescentado junto às seleções existentes:

```js
const produtos = document.querySelectorAll('.produto');
```

Document é o documento da página; querySelectorAll é o método chamado com
a string '.produto'. O ponto dentro da string indica classe CSS. Const produtos
guarda a coleção retornada. O nome no plural descreve que esperamos vários itens.

Acrescentado junto aos registros iniciais:

```js
console.log(produtos);
```

Esse log recebe a coleção, sem aspas, para permitir sua inspeção no Console.
A seleção e o registro acontecem no carregamento do módulo, antes dos envios.
O tratamento do submit e o preparo de termoBusca permanecem como na aula anterior.

## Relação com o HTML

Em [src/vitrine.html](../../src/vitrine.html), os dois cartões são article com
class="produto": primeiro Camiseta, depois Caneca. Portanto, a coleção esperada
contém esses dois elementos nessa ordem. A classe produtos, no plural, pertence
à div que agrupa os cartões; selecionar '.produtos' retornaria esse agrupador.
Nesta etapa usamos '.produto', no singular, para selecionar os cartões.

| Chamada | Retorno |
| --- | --- |
| document.querySelector('.produto') | Primeiro cartão, ou null se não houver correspondência |
| document.querySelectorAll('.produto') | NodeList com todos os cartões correspondentes; vazia se nenhum corresponder |

NodeList é uma coleção do DOM, não um Array JavaScript. A propriedade length
informa a quantidade de itens: produtos.length deve ser 2 no HTML atual.
Os índices começam em zero: produtos[0] referencia o article da Camiseta e
produtos[1] o article da Caneca. Não são os nomes como strings, e sim os elementos
com título e preço dentro deles. A apresentação no Console depende do navegador.

A NodeList retornada por querySelectorAll é estática: seus membros refletem
o momento da seleção. Um cartão adicionado depois não entra automaticamente
nessa coleção. Os elementos selecionados continuam sendo referências aos objetos
do DOM; estática não significa que seu conteúdo fique congelado. Nesta vitrine,
os cartões ainda são fixos no HTML.

Referências primárias: [querySelectorAll — DOM Standard](https://dom.spec.whatwg.org/#dom-parentnode-queryselectorall)
e [NodeList — DOM Standard](https://dom.spec.whatwg.org/#interface-nodelist).

## Verificação e atividade acompanhada

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. O HTML define
os dois produtos; [src/vitrine.css](../../src/vitrine.css) usa .produto para
estilizá-los. Ainda não percorremos a coleção nem filtramos os cartões.

Conferir correspondência com as duas classes no HTML, entrega HTTP do JS e
igualdade com o arquivo local. Resultados no [progresso](../progresso.md).
Essas verificações não executam a seleção no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Espera-se uma NodeList com
dois article no novo registro. Para conferir a quantidade, executar no Console:

```js
document.querySelectorAll('.produto').length
```

O resultado esperado é 2. A expressão faz uma nova seleção e não depende da
constante produtos, que está no escopo do módulo. Nenhuma execução observada
ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.24 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.25 — percorrer os produtos
com forEach. Não iniciada.
