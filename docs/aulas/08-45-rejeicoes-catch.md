# Aula 8.45 — Tratamento de rejeições com catch

Iniciada em 07/11/2026 após confirmação da 8.44 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
e563a8052d26a748dd43c12e5cdcd05204fda9d1; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Conhecer o caminho de falha de uma cadeia de promises. Substituímos o valor
de sucesso por uma rejeição simulada e acrescentamos catch ao final.
O motivo é uma string definida no próprio arquivo. Não é uma falha de rede
ou uma indisponibilidade real do catálogo.

## Alteração em src/vitrine.js

O exemplo ao final fica assim:

```js
const mensagemPronta = Promise.reject('Falha simulada ao preparar a mensagem.');

console.log('Antes de registrar o then.');

mensagemPronta
    .then((mensagem) => {
        return mensagem.toUpperCase();
    })
    .then((mensagemFormatada) => {
        console.log(mensagemFormatada);
    })
    .catch((motivo) => {
        console.error('Não foi possível preparar a mensagem:', motivo);
    });

console.log('Depois de registrar o then.');
```

Promise.reject devolve uma Promise já rejected com o motivo informado.
O nome mensagemPronta continua sendo a variável da Promise; seu nome não
garante sucesso. Neste exemplo didático, ela está rejeitada.

Os dois then recebem apenas callbacks de sucesso. Como a Promise inicial está
rejeitada, seus corpos não executam. A rejeição é propagada pelas promises
derivadas até chegar a catch. Por isso não tentamos transformar o motivo em
maiúsculas e não aparece a mensagem de sucesso da 8.44.

catch recebe uma arrow com parâmetro motivo, que recebe a string usada em
Promise.reject. console.error registra o prefixo e o motivo como erro no Console;
essa chamada é intencional e não lança uma exceção por si só. É diferente de
uma rejeição sem tratamento, normalmente identificada por "Uncaught (in promise)".
O motivo de uma rejeição pode ser de outros tipos; aqui usamos somente string.

catch também devolve uma Promise. Neste callback, como terminamos normalmente
sem return explícito, a Promise devolvida por catch fica fulfilled com undefined.
Isso não transforma a Promise original em sucesso. Não acrescentamos outro
passo à cadeia nesta aula.

O callback de catch também é agendado. Os dois console.log diretos continuam
aparecendo antes do tratamento da rejeição.

Referências primárias: [Promise.reject](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.reject),
[catch](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.catch)
e [NewPromiseReactionJob](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-newpromisereactionjob).
Para o registro, [console.error no Console Standard](https://console.spec.whatwg.org/#error).

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega [vitrine.js](../../src/vitrine.js)
como módulo. O import de [textos.js](../../src/textos.js), o listener e o filtro
continuam iguais. [vitrine.css](../../src/vitrine.css) continua com o layout.
Somente a criação da Promise do exemplo e seu tratamento final mudaram.
Não há API, pacote, container ou alteração no backend.

Depois dos registros iniciais, esperamos estas mensagens, nesta ordem:

```text
Antes de registrar o then.
Depois de registrar o then.
Não foi possível preparar a mensagem: Falha simulada ao preparar a mensagem.
```

A última é produzida por console.error e pode aparecer destacada em vermelho,
com indicação da linha. Não esperamos a mensagem de sucesso em maiúsculas.

Atividade opcional: abra http://localhost:8001/vitrine.html com o Console aberto
e recarregue. Confira a mensagem de falha simulada e a ausência de "Uncaught
(in promise)". Busque caneca e depois envie vazio, se quiser conferir que a
busca continua local, com um cartão e depois dois. Relate qualquer divergência.
Resultados acima são esperados; não foram observados pelo assistente.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1684 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou troca de resolve por reject e catch
acrescentado, com HTML/CSS/textos.js preservados. Links locais conferidos.
Isso demonstra entrega do código; execução da cadeia sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.46 — finalização de uma cadeia com finally.
8.46 não iniciada.
