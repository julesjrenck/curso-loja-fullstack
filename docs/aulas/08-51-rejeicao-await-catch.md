# Aula 8.51 — Rejeição em await e propagação para catch

Iniciada em 07/11/2026 após confirmação da 8.50 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
d95f2c39bac4b115d6c837b86c9bcdd4d5481faa; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Observar o caminho de falha de uma Promise aguardada dentro de uma função async.
Em [vitrine.js](../../src/vitrine.js), mudamos somente a Promise interna:

```js
async function prepararMensagem() {
    const mensagem = await Promise.reject('Falha simulada ao preparar a mensagem.');

    return mensagem;
}
```

Promise.reject cria uma Promise já rejected com o motivo em string. A falha
continua sendo uma simulação local, sem requisição à API. A chamada externa e
a cadeia de dois then, catch e finally permanecem iguais.

## O que acontece em await

Na 8.50, await produzia a string de sucesso. Agora a continuação da função
retoma com o motivo lançado como uma exceção naquele await. O motivo não é
atribuído à variável mensagem como um valor de sucesso.

Como não há tratamento dentro de prepararMensagem, a execução normal da função
é interrompida e return mensagem não é alcançado neste caminho. A função async
devolve uma Promise que fica rejeitada com o mesmo motivo.

Por isso, mensagemPronta guarda a Promise que será rejeitada quando a função
retomar com a falha. A rejeição chega pela chamada async à cadeia externa,
pula os dois callbacks de sucesso e alcança catch. O parâmetro motivo recebe a string
"Falha simulada ao preparar a mensagem." e console.error a registra.

O catch termina normalmente; a Promise que ele devolve fica fulfilled com
undefined. finally está ligado a essa Promise e registra o encerramento.
Isso é o mesmo tratamento externo já estudado, agora para uma rejeição que
passou por await dentro da função.

| Etapa | Resultado neste exemplo |
| --- | --- |
| Promise interna | Rejeitada com a string de falha |
| await | Retoma a função lançando esse motivo |
| return mensagem | Não alcançado |
| Promise da chamada async | Rejeitada com o mesmo motivo |
| Callbacks de sucesso dos then | Pulados |
| catch externo | Registra o motivo |
| finally | Registra o encerramento |

async continua fazendo a chamada devolver uma Promise. Uma exceção não tratada
em seu corpo rejeita essa Promise. O ponto de tratamento usado nesta aula é o
catch da cadeia externa; tratamento dentro da função será a etapa seguinte.

Referências primárias: [Await](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#await)
e [AsyncBlockStart](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-asyncblockstart)
na especificação ECMAScript.

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega vitrine.js como módulo; o import
de prepararTexto de [textos.js](../../src/textos.js), o formulário e o filtro
continuam iguais. [vitrine.css](../../src/vitrine.css) mantém o layout.
A função prepararMensagem e seus consumidores são apenas o exemplo de Console;
não estão ligados à busca de produtos. Nenhuma dependência, container ou
alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos:

```text
Antes de registrar o then.
Depois de registrar o then.
Não foi possível preparar a mensagem: Falha simulada ao preparar a mensagem.
Preparação da mensagem encerrada.
```

O erro destacado vem do console.error do catch. Não esperamos "Uncaught
(in promise)" nem a mensagem em maiúsculas. Os logs diretos continuam antes
dos callbacks. A busca pode ser conferida com caneca e depois vazio, sem recarga,
para ver um cartão e depois os dois, como antes.

Pense em qual trecho recebe o motivo da rejeição: a variável mensagem dentro
da função ou o parâmetro motivo no catch externo. Não é preciso alterar código
para responder. Relate qualquer divergência ou erro. Saída esperada, sem
observação direta ou relato nesta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1880 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente troca da Promise interna por
rejeição simulada, com HTML/CSS/textos.js preservados. Links locais conferidos.
Isso demonstra entrega; execução no navegador sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.52 — try/catch dentro de uma função async.
8.52 não iniciada.
