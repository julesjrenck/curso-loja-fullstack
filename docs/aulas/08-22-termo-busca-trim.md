# Aula 8.22 — Remoção de espaços nas extremidades do termo com trim

Iniciada em 06/11/2026 após confirmação da [8.21](08-21-evento-submit.md)
com "entendi". Checkpoint anterior publicado e conferido em
d85e2e957cf8d6e1e150e880ed47a10850f62579; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Preparar o termo antes de utilizá-lo na busca. Espaços digitados antes ou depois
do nome não devem fazer parte do termo. O método trim da string retorna o texto
sem os caracteres de espaço em branco das extremidades, preservando o interior.
Em JavaScript, essa definição inclui espaços, tabulações e quebras de linha
definidos pela linguagem; o input de busca usado aqui é de uma única linha.

## Alteração em src/vitrine.js

O corpo do tratamento do submit passa a ser:

```js
formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    const termoBusca = campoNome.value.trim();

    console.log('Busca enviada:', termoBusca);
});
```

CampoNome continua sendo o input selecionado. CampoNome.value lê uma string
com seu conteúdo atual. Em seguida, .trim() chama o método dessa string, sem
argumentos. Os parênteses indicam a chamada. Const termoBusca recebe a string
resultante; o log agora usa essa variável. Essa declaração é executada novamente
a cada chamada da função, com o valor atual do campo. Const não impede que uma
nova chamada tenha sua própria variável com outro resultado.

O termo fica disponível dentro do corpo da função; não é uma variável global.
O fluxo é ler value, chamar trim, guardar o retorno e registrar esse retorno.

| Conteúdo do campo | Resultado em termoBusca |
| --- | --- |
| `"  Camiseta  "` | `"Camiseta"` |
| `"  Camiseta azul  "` | `"Camiseta azul"` |
| `"   "` | `""` |

As aspas na tabela delimitam os exemplos; não fazem parte do texto digitado.
Trim não altera a string original: strings JavaScript são imutáveis. O código
também não atribui nada a campoNome.value. Portanto, o conteúdo visível do input
permanece como foi digitado; apenas termoBusca contém o resultado preparado.

Se o aluno digitar somente espaços, o resultado será uma string vazia. Ainda
não damos tratamento especial a ela. Letras maiúsculas, minúsculas e acentos
continuam iguais. Em PHP, a operação equivalente para os espaços desses exemplos
seria trim($texto); em JavaScript, chamamos texto.trim(). Os conjuntos de
caracteres removidos por padrão nas duas linguagens não são idênticos.

Referência primária: [String.prototype.trim — ECMAScript](https://tc39.es/ecma262/multipage/text-processing.html#sec-string.prototype.trim).

## Arquivos relacionados e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. As seleções e
os logs iniciais permanecem; [src/vitrine.html](../../src/vitrine.html) fornece
o formulário e carrega o módulo, e [src/vitrine.css](../../src/vitrine.css)
mantém a apresentação. O submit continua cancelando o envio GET e registra
agora o termo preparado. Os produtos continuam estáticos; sem filtragem ou API.

Conferir entrega HTTP e igualdade com o arquivo local, além do encadeamento
value.trim() e uso de termoBusca no log. Resultados no [progresso](../progresso.md).
Essas verificações não executam o código no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Digitar dois espaços, Camiseta
e mais dois espaços; clicar Buscar. Espera-se Busca enviada: Camiseta, com os
espaços ainda presentes no campo. Experimentar Camiseta azul com espaços nas
extremidades para observar que o espaço interno permanece. Somente espaços
produzem registro com termo vazio. Resultados esperados, sem execução observada
ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.22 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint publicado e conferido em
55b36cfb54425dee8b88bd636e6d0372193311fb; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.23](08-23-termo-busca-minusculas.md): conversão do termo para minúsculas.
