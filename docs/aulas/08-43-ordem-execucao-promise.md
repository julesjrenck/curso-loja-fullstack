# Aula 8.43 — Ordem de execução e callbacks de Promise

Iniciada em 07/11/2026 após confirmação da 8.42 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
bc6b79644d31a71969ff30e3053f1d9da1e62943; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Observar a diferença entre registrar o callback de then e executar seu corpo.
Acrescentamos dois registros ao mesmo exemplo, no final de vitrine.js.
Código síncrono executa em sequência durante a execução atual. O callback
de then é agendado, mesmo quando a Promise já tem um valor de sucesso.

## Alteração em src/vitrine.js

```js
const mensagemPronta = Promise.resolve('Vitrine pronta para a busca.');

console.log('Antes de registrar o then.');

mensagemPronta.then((mensagem) => {
    console.log(mensagem);
});

console.log('Depois de registrar o then.');
```

A primeira linha continua criando uma Promise já fulfilled com a string.
O primeiro console.log é chamado diretamente: escreve "Antes de registrar o
then.". Depois, then recebe a arrow e agenda sua execução. O programa segue
até o console.log seguinte, que escreve "Depois de registrar o then.".
Quando a execução síncrona atual termina, o callback pode executar e recebe
o texto de sucesso em mensagem, escrevendo "Vitrine pronta para a busca.".

No navegador, callbacks de Promise são processados como microtarefas.
Não há tempo fixo em milissegundos neste exemplo. A ordem decorre do agendamento,
sem uma espera artificial, nova thread ou pedido à API. O callback aparece
antes do último console.log no arquivo, mas só seu registro acontece ali.

Referências primárias: [PerformPromiseThen](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-performpromisethen)
e [HostEnqueuePromiseJob no HTML Standard](https://html.spec.whatwg.org/multipage/webappapis.html#hostenqueuepromisejob).

## Arquivos e resultados

[vitrine.html](../../src/vitrine.html) carrega [vitrine.js](../../src/vitrine.js)
como módulo. O import de [textos.js](../../src/textos.js) e o filtro de produtos
continuam funcionando da mesma forma. [vitrine.css](../../src/vitrine.css)
cuida da apresentação. Somente vitrine.js recebeu duas chamadas de console.log;
não há entrada nova no formulário ou mudança de tela.

Depois dos registros iniciais já conhecidos, a ordem esperada no Console é:

```text
Antes de registrar o then.
Depois de registrar o then.
Vitrine pronta para a busca.
```

Para conferir, abra http://localhost:8001/vitrine.html com o Console aberto e
recarregue. Não é preciso enviar o formulário. Compare a ordem com a posição
das linhas no arquivo e explique por que "Depois" aparece antes de "Vitrine
pronta". Atividade opcional e acompanhada; se algo divergir, informe a saída
ou o erro. Resultados acima são esperados, não observados pelo assistente.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1466 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou duas chamadas acrescentadas ao JS e
HTML/CSS/textos.js preservados. Links locais conferidos. Isso confere o código
servido; a execução no navegador permanece sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em dc8dac05b7aae590331f6c43569e1b7eade4590a;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.44 — encadeamento de promises](08-44-encadeamento-promises.md).
