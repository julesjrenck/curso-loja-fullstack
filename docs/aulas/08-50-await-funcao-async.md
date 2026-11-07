# Aula 8.50 — Await dentro de uma função async

Iniciada em 07/11/2026 após confirmação da 8.49 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
c691262bff4338881f532911203ab336389f5164; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Obter o valor de sucesso de uma Promise com await dentro da função async.
Alteramos somente o corpo de prepararMensagem em [vitrine.js](../../src/vitrine.js):

```js
async function prepararMensagem() {
    const mensagem = await Promise.resolve('Vitrine pronta para a busca.');

    return mensagem;
}
```

A chamada existente permanece:

```js
const mensagemPronta = prepararMensagem();
```

Promise.resolve cria a Promise já fulfilled com a string de demonstração.
await aguarda esse resultado e, quando a função continua, sua expressão produz
a string. A variável local mensagem recebe o texto. O return devolve esse texto
do corpo da função, resolvendo a Promise que a chamada de prepararMensagem devolveu.

## Pausa da função e continuação

Ao chegar a await, a continuação desta função é suspensa. Quem chamou
prepararMensagem recebe sua Promise e pode continuar: os logs diretos e o registro
da cadeia acontecem durante essa execução. Mesmo com a Promise interna já
fulfilled, a continuação após await fica agendada.

Depois, prepararMensagem continua, atribui o texto a mensagem e executa o return.
A Promise externa fica fulfilled com esse texto, permitindo executar o primeiro
callback de then da cadeia existente. Há duas funções envolvidas: a função async
que produz o resultado e os callbacks que o consomem.

await não bloqueia a página inteira, não cria uma thread e não acrescenta um tempo
fixo de espera. O valor já disponível permite estudar a sintaxe sem rede. Para
esta string, o return direto da 8.49 era suficiente; a mudança é didática e
prepara o uso de operações que realmente entregam seus resultados depois.

| Nome neste exemplo | O que guarda |
| --- | --- |
| mensagem, dentro de prepararMensagem | A string obtida por await |
| mensagemPronta, fora da função | A Promise devolvida pela chamada async |

O parâmetro mensagem do primeiro callback de then é uma variável local de outra
função. Ele recebe o valor de sucesso da Promise externa; não compartilha o escopo
da variável de mesmo nome dentro de prepararMensagem.

Referência primária: [Await na especificação ECMAScript](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#await)
e [retorno da função async](https://tc39.es/ecma262/multipage/ecmascript-language-functions-and-classes.html#sec-runtime-semantics-evaluateasyncfunctionbody).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua carregando vitrine.js como módulo;
o import de prepararTexto de [textos.js](../../src/textos.js), o formulário e a
busca são preservados. [vitrine.css](../../src/vitrine.css) mantém o layout.
A cadeia externa de dois then, catch e finally e os logs diretos continuam iguais.
O exemplo usa somente Console, sem API, dependência ou alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos a mesma saída da etapa anterior:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

Compare as variáveis da tabela e pense em qual delas guarda uma Promise.
Não é necessário alterar código para responder. Informe qualquer divergência
ou erro no Console. Saída acima esperada, sem observação direta ou relato.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1871 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente corpo de prepararMensagem com
await e retorno da variável, com HTML/CSS/textos.js preservados. Links locais
conferidos. Isso demonstra entrega; execução de await no navegador sem
observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em d95f2c39bac4b115d6c837b86c9bcdd4d5481faa;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.51 — rejeição em await e propagação para catch](08-51-rejeicao-await-catch.md).
