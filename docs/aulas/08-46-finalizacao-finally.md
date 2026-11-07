# Aula 8.46 — Finalização de uma cadeia com finally

Iniciada em 07/11/2026 após confirmação da 8.45 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
848c8efc18bfa237dc9a0d106ff5ca5a7fcfff22; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Acrescentar uma ação de encerramento à cadeia. finally registra um callback
para quando a Promise à qual foi ligado terminar, com sucesso ou rejeição.
Na loja, esse lugar poderá servir para retirar um indicador de carregamento.
Agora usamos somente uma mensagem no Console, mantendo a etapa pequena.

## Alteração em src/vitrine.js

Depois do catch, a cadeia termina assim:

```js
    .catch((motivo) => {
        console.error('Não foi possível preparar a mensagem:', motivo);
    })
    .finally(() => {
        console.log('Preparação da mensagem encerrada.');
    });
```

A sequência anterior continua: Promise.reject com motivo em string, dois then
de sucesso e catch. A única mudança é acrescentar finally à mesma expressão;
o ponto e vírgula passa a fechar a cadeia depois dele.

O callback usa () porque finally não passa o valor de sucesso nem o motivo
de rejeição como argumentos. Ele registra apenas o encerramento. Diferente
de um console.log direto após a cadeia, seu corpo fica agendado e aguarda
a Promise anterior terminar.

Neste caminho, a Promise inicial está rejected; os callbacks dos then são
pulados e catch registra o motivo. Como esse catch termina normalmente sem
return, sua Promise devolvida fica fulfilled com undefined. É a essa Promise
que finally está ligado; ele executa depois do tratamento. A Promise original
continua rejeitada. Encerramento não significa que a operação inicial teve sucesso.

Se a Promise inicial tivesse sucesso, os callbacks dos then executariam e o
catch seria pulado; finally também executaria. Isso é uma previsão para o outro
caminho, não uma execução observada nesta etapa.

finally também devolve uma Promise. Seu callback, terminando normalmente como
aqui, mantém o resultado anterior na Promise devolvida. Um retorno comum do
callback não substitui esse resultado. Se o callback lançar erro ou devolver
uma Promise rejeitada, a Promise devolvida por finally poderá ficar rejeitada.
Não acrescentamos esses casos ao exemplo.

Referência primária: [Promise.prototype.finally na especificação ECMAScript](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.finally).

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega [vitrine.js](../../src/vitrine.js)
como módulo. Import de [textos.js](../../src/textos.js), formulário e filtro
continuam iguais. [vitrine.css](../../src/vitrine.css) continua com o layout.
A mensagem fica somente no Console, sem adicionar indicador ou pedido à API.
Nenhuma dependência, container ou alteração no backend.

Depois dos registros iniciais, esperamos:

```text
Antes de registrar o then.
Depois de registrar o then.
Não foi possível preparar a mensagem: Falha simulada ao preparar a mensagem.
Preparação da mensagem encerrada.
```

A linha de falha vem do console.error do catch e pode aparecer em vermelho.
A última vem do console.log do finally. O log direto "Depois" continua antes
dos callbacks agendados.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto e confira a linha de encerramento depois da falha simulada. Pense por
que essa linha também seria útil se a operação tivesse sucesso. Relate qualquer
diferença ou erro. Resultados acima esperados, sem observação direta.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1772 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente acréscimo do finally à cadeia,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega do código; execução da cadeia sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.47 — verificação da cadeia de rejeição no navegador.
8.47 não iniciada.
