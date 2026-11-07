# Aula 8.44 — Encadeamento de promises com then e return

Iniciada em 07/11/2026 após confirmação da 8.43 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
dc8dac05b7aae590331f6c43569e1b7eade4590a; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Dividir uma sequência em dois passos: transformar uma mensagem e registrar o
resultado. Cada then devolve uma nova Promise. Quando seu callback retorna
normalmente uma string, essa string se torna o valor de sucesso da Promise
devolvida. O próximo then da cadeia pode receber esse valor.

## Alteração em src/vitrine.js

O bloco ao final do arquivo passa a ser:

```js
const mensagemPronta = Promise.resolve('Vitrine pronta para a busca.');

console.log('Antes de registrar o then.');

mensagemPronta
    .then((mensagem) => {
        return mensagem.toUpperCase();
    })
    .then((mensagemFormatada) => {
        console.log(mensagemFormatada);
    });

console.log('Depois de registrar o then.');
```

mensagemPronta continua contendo a Promise original, com a string inicial.
O primeiro callback recebe essa string no parâmetro mensagem. toUpperCase()
é um método de string que devolve uma versão em maiúsculas. Não muda a string
original. O return explícito devolve a versão transformada do callback.

O primeiro then devolve outra Promise, resolvida com esse retorno. O segundo
then está ligado a essa nova Promise e recebe a string em mensagemFormatada.
Os nomes dos parâmetros são locais a cada função: o vínculo vem do retorno
e da cadeia, não de usar nomes iguais.

Os pontos no início das linhas continuam a expressão mensagemPronta.then(...).
O ponto e vírgula fica no final da cadeia. Escrevemos o segundo then sobre o
resultado do primeiro, em vez de fazer duas chamadas independentes sobre a
Promise original. Isso é o encadeamento.

Como o primeiro callback tem chaves, o return é necessário para devolver o
texto. Se apenas chamássemos mensagem.toUpperCase() sem retornar, o callback
terminaria com undefined, que chegaria ao próximo passo. console.log exibe
um valor, mas também retorna undefined; por isso reservamos a exibição para
o segundo callback e retornamos o texto no primeiro.

Referência primária: [then/PerformPromiseThen](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.then)
e [NewPromiseReactionJob](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-newpromisereactionjob)
na especificação ECMAScript. Para o método da string,
[String.prototype.toUpperCase](https://tc39.es/ecma262/multipage/text-processing.html#sec-string.prototype.touppercase).

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega [vitrine.js](../../src/vitrine.js)
como módulo. O import de [textos.js](../../src/textos.js), o formulário e o
filtro continuam iguais. [vitrine.css](../../src/vitrine.css) cuida do layout.
A mudança está somente no exemplo de Promise do JS. Não há API ou pacote novo.

Depois dos registros iniciais, esperamos no Console:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
```

Os logs diretos ainda executam antes dos callbacks da cadeia. O primeiro
callback transforma a string; o segundo a exibe. Só há uma linha de saída da
mensagem: o primeiro callback agora retorna em vez de registrar.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto e compare essa saída. Como exercício acompanhado, pense no valor que
chegaria ao segundo callback se retirássemos o return do primeiro. Não é
preciso alterar o arquivo para responder. Informe eventuais diferenças ou erros.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1569 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou mudança somente na cadeia do exemplo,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega do código, sem execução dos callbacks pelo assistente. Saída acima
esperada, sem observação direta ou relato do navegador.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em e563a8052d26a748dd43c12e5cdcd05204fda9d1;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.45 — tratamento de rejeições com catch](08-45-rejeicoes-catch.md).
