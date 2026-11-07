# Aula 8.32 — Contagem dos produtos correspondentes com let

Iniciada em 07/11/2026 após confirmação da [8.31](08-31-selecao-mensagem.md)
com "entendi". Checkpoint anterior publicado e conferido em
081d392b52b57246eb00ac3d919bbdc340c75c24; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Contar quantos produtos correspondem ao termo de cada envio. Usaremos uma
variável numérica que começa em zero e aumenta apenas para correspondências.
A contagem permitirá decidir quando a mensagem de nenhum resultado será exibida
em uma próxima etapa.

## Alterações em src/vitrine.js

Depois da declaração de termoBusca, dentro da função do submit:

```js
let quantidadeResultados = 0;
```

Let declara uma variável que pode receber novos valores. Usamos let porque
o número será atualizado durante a repetição. Const impediria reatribuir essa
variável numérica. O zero é um número, sem aspas, e representa que ainda não
contamos correspondências nesse envio.

A declaração fica antes do forEach e fora de sua função interna: as passagens
pelos cartões compartilham o contador da busca atual. Como a declaração está
dentro da função de submit, cada novo envio começa com zero novamente.
Se o contador fosse reiniciado dentro do forEach, ele perderia o total anterior
a cada produto. Fora do submit, acumularia entre buscas.

Dentro do forEach, depois da atribuição de hidden e antes do log do produto:

```js
if (corresponde) {
    quantidadeResultados += 1;
}
```

If verifica a condição entre parênteses. Corresponde já é um booleano calculado
por includes; se for true, executa o bloco entre chaves. Se for false, pula esse
bloco e continua nas próximas instruções da função. Essa estrutura é semelhante
ao if do PHP.

QuantidadeResultados += 1 soma um ao valor atual e guarda o resultado na mesma
variável. Para esse contador numérico, equivale a:

```js
quantidadeResultados = quantidadeResultados + 1;
```

O operador += também existe no PHP. O número inicial 0 e o incremento 1 mantêm
o contador numérico. A função interna acessa e atualiza a variável declarada na
função externa; ela não declara outro contador local.

Depois do fechamento do forEach, ainda dentro da função de submit:

```js
console.log('Produtos encontrados:', quantidadeResultados);
```

O log fica depois da repetição para mostrar o total final uma vez por envio.
ForEach executa as chamadas deste código uma após a outra antes de retornar;
quando chegamos a esse log, todos os cartões já foram avaliados.

Referências primárias: [let e const — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-let-and-const-declarations),
[if — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-if-statement)
e [atribuição composta — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-assignment-operators).

## Exemplo acompanhado

Ao enviar CAN, o termo preparado é can e o contador começa em 0.
Na Camiseta, corresponde é false, então o contador permanece 0.
Na Caneca, corresponde é true, então o contador passa a 1.
Depois do forEach, a saída esperada é Produtos encontrados: 1.

| Busca enviada | Total esperado |
| --- | --- |
| CAMISETA | 1 |
| CAN | 1 |
| ca | 2 |
| sapato | 0 |
| Campo vazio ou somente espaços | 2 |

Uma busca seguinte começa em zero, sem somar seu resultado ao da anterior.
A coleção produtos.length continua sendo 2, mesmo quando só um cartão
corresponde: ela conta elementos selecionados, enquanto quantidadeResultados
conta correspondências da busca atual.

## Arquivos relacionados e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação.
[src/vitrine.html](../../src/vitrine.html) fornece os cartões e a mensagem ainda
oculta; [src/vitrine.css](../../src/vitrine.css) mantém os estilos. O filtro e
os logs anteriores permanecem; a mensagem continua aguardando seu controle.

Conferir posição e reinício do contador, incremento condicionado, log após
forEach, entrega HTTP e igualdade com o arquivo local. Resultados no
[progresso](../progresso.md). A tabela é uma previsão pelo código; essas
verificações não executam a contagem no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Enviar ca, sapato e campo
vazio, sem recarregar entre buscas. Esperam-se totais 2, 0 e 2, nessa ordem.
Nenhum resultado desta atividade foi observado ou relatado nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.32 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint publicado e conferido em
5b5b9536deeec6cef218bf520b3bd1b034c9dd50; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.33](08-33-exibicao-mensagem.md): exibição da mensagem conforme a contagem.
