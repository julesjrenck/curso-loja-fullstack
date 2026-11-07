# Aula 8.55 — Consumo de uma função async com await

Iniciada em 07/11/2026 após confirmação da 8.54 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
470a4d826c03836d75208adbff979f564991501d; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Consumir uma função async dentro de outra função async, usando await para obter
seu texto antes de formatá-lo. Em [vitrine.js](../../src/vitrine.js), depois
de prepararMensagem, acrescentamos:

```js
async function formatarMensagem() {
    const mensagem = await prepararMensagem();

    return mensagem.toUpperCase();
}

const mensagemPronta = formatarMensagem();
```

Também retiramos o primeiro then, que fazia toUpperCase. A cadeia passa a começar
diretamente pelo callback de exibição:

```js
mensagemPronta
    .then((mensagemFormatada) => {
        console.log(mensagemFormatada);
    })
    .catch((motivo) => {
        console.error('Não foi possível preparar a mensagem:', motivo);
    })
    .finally(() => {
        console.log('Preparação da mensagem encerrada.');
    });
```

Essas mudanças formam uma alteração inseparável: a nova função assume a
transformação que antes ficava no callback. A transformação ocorre uma vez.

## Relação entre as funções

prepararMensagem continua com seu try/catch, await da Promise de sucesso e
return da mensagem original. Sua chamada devolve uma Promise.

Dentro de formatarMensagem, await prepararMensagem() chama a função e suspende
a continuação até obter seu resultado. Quando continua com sucesso, mensagem
guarda a string. toUpperCase é chamado sobre esse texto, e o return fornece a
versão em maiúsculas como sucesso da Promise devolvida por formatarMensagem.

Cada chamada async tem sua própria Promise. mensagemPronta agora guarda a
Promise de formatarMensagem, cujo valor de sucesso já é o texto em maiúsculas.
Por isso o then restante precisa apenas exibir mensagemFormatada.

| Parte | Valor produzido ou recebido |
| --- | --- |
| prepararMensagem | Promise com texto original |
| mensagem dentro de formatarMensagem | Texto original obtido por await |
| return de formatarMensagem | Texto em maiúsculas, usado no sucesso de sua Promise |
| mensagemPronta | Promise devolvida por formatarMensagem |
| Callback de then | Texto já formatado |

As variáveis mensagem dentro das duas funções pertencem a escopos diferentes.
O valor passa pelo return e pela Promise, não pelo nome igual das variáveis.
Se uma rejeição chegar ao await de formatarMensagem sem ser recuperada, a Promise
dessa função será rejeitada e poderá chegar ao catch externo, como na 8.51.
O caminho implementado nesta etapa continua sendo de sucesso.

Referências primárias: [Await](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#await)
e [retorno da função async](https://tc39.es/ecma262/multipage/ecmascript-language-functions-and-classes.html#sec-runtime-semantics-evaluateasyncfunctionbody),
já consultadas nas etapas anteriores.

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua carregando vitrine.js como módulo.
Import de prepararTexto de [textos.js](../../src/textos.js), formulário, filtro
e função prepararMensagem preservados. [vitrine.css](../../src/vitrine.css)
mantém o layout. formatarMensagem fica neste módulo, sem export ou vínculo com
a busca. Nenhuma API, dependência, container ou mudança no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos a mesma saída da 8.54:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

Os logs diretos continuam antes dos callbacks agendados. Compare a organização
das funções e identifique onde o texto é transformado agora. Não é preciso
alterar código para responder. Informe diferenças ou erros. Saída esperada,
sem observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2088 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou função consumidora, chamada atualizada
e transformação movida do then, com HTML/CSS/textos.js preservados. Links locais
conferidos. Isso demonstra entrega; execução das funções/cadeia no navegador
sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em 1244367a7043e0821d55afca89ec8a5880eefb98;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.56 — exibição da mensagem com async/await](08-56-exibicao-async-await.md).
