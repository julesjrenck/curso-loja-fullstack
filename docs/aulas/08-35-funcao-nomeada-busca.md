# Aula 8.35 — Função nomeada para tratar o envio da busca

Iniciada em 07/11/2026 após confirmação da
[8.34](08-34-verificacao-contagem-mensagem.md) com "funcionou  entendi",
incluindo relato geral de sucesso no navegador. Checkpoint anterior publicado
e conferido em 423f3e680b219d4031389fcc4c993afd94ccefdb;
HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Dar um nome à função que trata o envio. Até agora, a função era criada diretamente
como segundo argumento de addEventListener. Vamos declará-la com um nome e usar
esse nome no registro do evento. Essa reorganização facilita identificar o papel
da função no código, mantendo o mesmo fluxo de busca.

## Alteração em src/vitrine.js

A abertura do tratamento passa de:

```js
formularioBusca.addEventListener('submit', function (evento) {
```

para uma declaração de função:

```js
function tratarBusca(evento) {
```

Function declara a função; tratarBusca é o nome escolhido; evento continua sendo
o parâmetro que receberá o objeto do navegador. As chaves continuam delimitando
o corpo. A função ainda chama preventDefault, prepara o termo, filtra os cartões,
conta resultados, controla a mensagem e registra o total. Nenhuma instrução desse
corpo foi alterada.

No fim, o fechamento da declaração passa a ser apenas }. Antes, }); fechava
também a chamada addEventListener que envolvia a função. Agora o registro do
evento fica em uma instrução própria, depois da declaração:

```js
formularioBusca.addEventListener('submit', tratarBusca);
```

O primeiro argumento continua sendo a string 'submit'. O segundo é a referência
à função tratarBusca. Uma função também pode ser usada como valor no JavaScript:
podemos passá-la como argumento para outro código chamar. O navegador guardará
essa referência e chamará a função a cada envio, fornecendo o objeto evento.

TratarBusca está sem aspas porque é o nome da função declarada, não um texto.
Também está sem parênteses. Escrever tratarBusca() ali faria uma chamada imediata
e passaria seu retorno ao método. Além de não registrar a função desejada, essa
chamada sem argumento deixaria evento como undefined e falharia em preventDefault.

O papel de callback permanece: a função é chamada pelo tratamento do evento.
Ter nome não significa executar ao declarar. A sintaxe de declaração é semelhante
à de funções nomeadas em PHP; parâmetros JS continuam sem o prefixo $.

Referências primárias: [funções — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-functions-and-classes.html#sec-function-definitions)
e [addEventListener — DOM Standard](https://dom.spec.whatwg.org/#dom-eventtarget-addeventlistener).

## Escopo e relação entre arquivos

A declaração está no mesmo módulo que as seleções do formulário, do campo,
dos produtos e da mensagem. TratarBusca acessa essas referências como a função
anônima acessava. O parâmetro evento e o contador continuam locais a cada chamada;
forEach mantém sua função interna e o contador começa em zero a cada envio.

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. O
[HTML](../../src/vitrine.html) continua carregando o mesmo arquivo como módulo;
o [CSS](../../src/vitrine.css) mantém a apresentação. Não há chamada inicial de
tratarBusca: o primeiro processamento da busca continua ocorrendo no submit.

## Verificação e atividade acompanhada

Conferir no diff que o corpo da função permanece igual, que seu nome corresponde
ao argumento do único registro de submit e que a declaração fecha com }.
Conferir entrega HTTP e igualdade com o arquivo local. Resultados no
[progresso](../progresso.md). Esses resultados não demonstram execução no navegador.

Atividade opcional: recarregar a [vitrine](http://127.0.0.1:8001/vitrine.html),
enviar sapato e depois campo vazio, sem recarregar entre buscas. Esperam-se
totais 0/2, mensagem aparecendo/sumindo e restauração dos cartões, como na 8.34.
O relato da 8.34 pertence ao código anterior; nenhum novo resultado de execução
desta reorganização foi observado ou relatado.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.35 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.36 — função prepararTexto
com parâmetro e return. Não iniciada.
