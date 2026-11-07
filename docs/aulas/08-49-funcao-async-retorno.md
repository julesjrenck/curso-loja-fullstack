# Aula 8.49 — Função async e seu retorno como Promise

Iniciada em 07/11/2026 após confirmação da 8.48 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
6396b026977f472bc7469407f321dd73f48c62c0; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Conhecer a declaração de uma função async e o resultado de sua chamada.
Em [vitrine.js](../../src/vitrine.js), a criação direta com Promise.resolve
é substituída por uma função e sua chamada:

```js
async function prepararMensagem() {
    return 'Vitrine pronta para a busca.';
}

const mensagemPronta = prepararMensagem();
```

function, nome, parênteses, corpo e return são a estrutura já conhecida.
A novidade é async antes de function. A função não recebe argumentos:
os parênteses estão vazios. Seu corpo devolve a string constante de demonstração.

Declarar a função não executa seu corpo. prepararMensagem() chama a função;
os parênteses são importantes. Sem eles, guardaríamos a própria função.

## Return dentro de async

Uma chamada de função async devolve uma Promise. Aqui, o return da string
resolve essa Promise com o texto. Portanto, mensagemPronta guarda a Promise,
e o primeiro callback de then recebe a string de sucesso, como antes.
Não precisamos escrever Promise.resolve dentro desta função para obter esse efeito.

| Tipo de função com este return | Resultado recebido por quem chama |
| --- | --- |
| Função comum que retorna a string | A própria string |
| Função async que retorna a string | Uma Promise fulfilled com a string |

Usamos uma string já disponível, sem await nesta etapa. O corpo executa
sincronamente até seu return; escrever async não cria uma thread, uma espera
artificial ou uma requisição à API. Os callbacks de then continuam agendados,
como estudamos antes. O uso de await será a próxima etapa, após entendimento.

Referência primária: [EvaluateAsyncFunctionBody na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-functions-and-classes.html#sec-runtime-semantics-evaluateasyncfunctionbody).

## Relação com a cadeia e os arquivos

A cadeia mensagemPronta.then(...).then(...).catch(...).finally(...) permanece
igual: primeiro transforma com toUpperCase/return, segundo registra a versão
em maiúsculas, catch trata uma rejeição que chegue até ele e finally registra
o encerramento. O caminho atual é de sucesso.

[vitrine.html](../../src/vitrine.html) continua carregando vitrine.js como módulo.
O import de prepararTexto de [textos.js](../../src/textos.js), a função tratarBusca
e o listener continuam como antes. [vitrine.css](../../src/vitrine.css) mantém
o layout. prepararMensagem fica neste módulo e é usada apenas no exemplo do
Console; não foi exportada nem ligada ao formulário. Nenhuma API, dependência,
container ou alteração no backend.

## Verificação e atividade curta

Recarregue http://localhost:8001/vitrine.html com o Console aberto, filtro vazio
e mensagens Info/Error visíveis. Depois dos registros iniciais, esperamos:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

Atividade opcional e acompanhada: compare a saída com a 8.48 e pense no que
mensagemPronta passaria a guardar se retirássemos somente async da função.
Nesse caso, guardaríamos uma string, e a cadeia não teria um método then
para chamar. Não é preciso alterar o arquivo para responder. Informe qualquer
diferença ou erro na versão atual. Resultados esperados, sem observação direta.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1816 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente criação da função async e
chamada substituindo Promise.resolve, com HTML/CSS/textos.js preservados.
Links locais conferidos. Isso demonstra entrega; execução no navegador sem
observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em c691262bff4338881f532911203ab336389f5164;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.50 — await dentro de uma função async](08-50-await-funcao-async.md).
