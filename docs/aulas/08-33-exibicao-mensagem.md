# Aula 8.33 — Exibição da mensagem conforme a contagem de resultados

Iniciada em 07/11/2026 após confirmação da [8.32](08-32-contagem-resultados.md)
com "entendi". Checkpoint anterior publicado e conferido em
5b5b9536deeec6cef218bf520b3bd1b034c9dd50; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Exibir a mensagem quando a busca não encontrar produtos e ocultá-la quando
houver correspondências. Agora relacionamos a referência ao parágrafo com a
contagem calculada. O operador > compara dois números e retorna um booleano.
Esse resultado será atribuído diretamente à propriedade hidden da mensagem.

## Alteração em src/vitrine.js

Depois de fechar o forEach e antes do log do total, dentro da função do submit:

```js
mensagemSemResultados.hidden = quantidadeResultados > 0;
```

MensagemSemResultados é a referência ao p selecionado na 8.31. Hidden é a
propriedade de ocultação já usada nos cartões. O sinal = atribui o resultado
da expressão à direita: quantidadeResultados > 0 pergunta se a quantidade é
maior que zero. O operador > tem esse mesmo papel na comparação numérica do PHP.

| quantidadeResultados | quantidadeResultados > 0 | hidden da mensagem | Resultado esperado |
| --- | --- | --- | --- |
| 0 | false | false | Mensagem exibida |
| 1 | true | true | Mensagem oculta |
| 2 | true | true | Mensagem oculta |

Não estamos atribuindo o número à propriedade: primeiro a comparação produz
true ou false. O resultado combina com a intenção de hidden: ocultar a mensagem
quando há algum produto encontrado. Não é necessário um bloco if adicional para
essa atribuição, porque já temos o booleano desejado.

Referências primárias: [comparações relacionais — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-relational-operators)
e [hidden — HTML Standard](https://html.spec.whatwg.org/multipage/interaction.html#dom-hidden).

## Momento da atualização e nova busca

O final da função fica assim:

```js
    });

    mensagemSemResultados.hidden = quantidadeResultados > 0;

    console.log('Produtos encontrados:', quantidadeResultados);
});
```

O primeiro }); encerra forEach. A atribuição seguinte usa o total final depois
de avaliar todos os produtos, uma vez por envio. O último }); encerra o registro
da função de submit. Dentro da repetição, a contagem ainda poderia estar parcial;
por isso o controle da mensagem fica depois dela.

Cada novo submit reinicia o contador, filtra os cartões e atualiza a mensagem
novamente. Uma busca sem resultados mostra o aviso. Uma busca posterior com
resultados oculta o aviso, sem precisar recarregar. Campo vazio ou somente espaços
corresponde aos dois nomes; o total será 2 e a mensagem ficará oculta.

Na abertura da página, o hidden definido no HTML mantém a mensagem oculta.
A nova atribuição só executa no submit, assim como o filtro. Apenas digitar
outro termo mantém o resultado anterior até o próximo envio.

## Arquivos relacionados e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. O parágrafo
de [src/vitrine.html](../../src/vitrine.html) fornece o texto Nenhum produto
encontrado., fora do Grid dos cartões. [src/vitrine.css](../../src/vitrine.css)
mantém o layout. Seleções, filtro, contador e logs anteriores permanecem.
A busca continua local sobre os dois cartões, sem API ou banco.

Conferir atribuição após forEach/dentro do submit, uso do total final,
correspondência do seletor com o parágrafo, entrega HTTP e igualdade com o
arquivo local. Resultados no [progresso](../progresso.md). A tabela e o roteiro
descrevem resultados esperados; essas verificações não executam o navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html),
recarregar e enviar sapato. Esperamos zero cartões e a mensagem visível.
Depois enviar CAN: esperamos Caneca e mensagem oculta. Enviar sapato novamente
e depois campo vazio deve restaurar os dois cartões e ocultar a mensagem.
Não recarregar entre buscas. Nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.33 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.34 — verificação da contagem
e da mensagem no navegador. Não iniciada.
