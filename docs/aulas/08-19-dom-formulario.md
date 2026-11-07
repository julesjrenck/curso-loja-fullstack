# Aula 8.19 — DOM e seleção do formulário de busca

Iniciada em 06/11/2026 após confirmação da [8.18](08-18-primeiro-javascript.md)
com "entendi". Checkpoint anterior publicado e conferido em
d29800c2a242fcb5114d7a82549a392269aa2fe8; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Localizar pelo JavaScript o formulário que já existe no HTML. Ao ler o documento,
o navegador constrói uma árvore de objetos: o DOM, Document Object Model.
Cada elemento, como main ou form, tem uma representação nessa árvore.
O objeto document oferece acesso ao documento da página.

Trecho relevante da estrutura existente:

```text
document
└── html
    └── body
        └── main
            └── form.busca
```

O desenho omite os demais elementos para mostrar o caminho até o formulário.
Form.busca representa o elemento form com a classe busca.

## Alteração em src/vitrine.js

Arquivo completo após esta etapa:

```js
console.log('JavaScript da vitrine carregado.');

const formularioBusca = document.querySelector('.busca');

console.log(formularioBusca);
```

A primeira mensagem é da aula anterior. Na instrução nova, document é o objeto
do documento; querySelector é o método que recebe um seletor CSS. A string
'.busca' usa o ponto para indicar uma classe, assim como no CSS existente.
O ponto dentro dessa string faz parte do seletor; o ponto entre document e
querySelector acessa o método do objeto.

O método retorna o primeiro elemento que corresponde ao seletor, ou null se
nenhum elemento corresponder. No HTML atual há um único form com class="busca".
A entrada é o seletor; o resultado esperado é a referência ao objeto desse
formulário no DOM. Não é uma cópia do HTML nem um formulário novo.

Const declara a variável formularioBusca, e = atribui a ela o resultado da
chamada. O nome escolhido descreve o conteúdo. Diferentemente das variáveis PHP,
nomes de variáveis JavaScript não precisam do prefixo $. Const impede reatribuir
essa variável; não congela o objeto referenciado. Trabalhar com as propriedades
do elemento será assunto das próximas etapas.

Console.log recebe agora a variável sem aspas: registra o objeto encontrado.
Com aspas, registraria apenas o texto formularioBusca. A apresentação do objeto
no Console depende das ferramentas do navegador; é comum ver o elemento form
com seus atributos e poder inspecioná-lo. Se a seleção não encontrar nada,
o valor registrado será null.

Referências primárias: [querySelector — DOM Standard](https://dom.spec.whatwg.org/#dom-parentnode-queryselector)
e [const — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-let-and-const-declarations).

## Relação com HTML e CSS

[src/vitrine.html](../../src/vitrine.html) contém o formulário e carrega este
arquivo com script type="module". Nessa inclusão sem async, o módulo executa
depois que o HTML foi analisado; o formulário já pode ser localizado.
[src/vitrine.css](../../src/vitrine.css) usa a mesma classe para aplicar estilos.
Nesta etapa, apenas [src/vitrine.js](../../src/vitrine.js) muda na aplicação.

Selecionar um elemento guarda acesso a ele. A página continua com o envio GET
nativo do formulário e os dois produtos estáticos. Ainda não há tratamento de
eventos, leitura do campo ou filtragem.

## Verificação e atividade acompanhada

Conferir a correspondência do seletor com o HTML, a entrega HTTP do JavaScript
e a igualdade da resposta com o arquivo local. Registrar os resultados no
[progresso](../progresso.md). Essas verificações não executam o DOM no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. A saída esperada é a mensagem
inicial seguida do elemento form da busca. Se aparecer null ou um erro,
o resultado pode ser investigado junto com o aluno. Não há observação direta
nem relato de execução desta etapa no momento de sua implementação.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.19 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no Console. Checkpoint publicado e conferido em
d4b06563b2700fa5fb1b77faa69173828fb56611; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.20](08-20-campo-busca-value.md): campo de busca e leitura de value.
