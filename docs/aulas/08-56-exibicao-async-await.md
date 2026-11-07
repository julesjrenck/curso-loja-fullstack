# Aula 8.56 — Exibição da mensagem com async/await

Iniciada em 07/11/2026 após confirmação da 8.55 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
1244367a7043e0821d55afca89ec8a5880eefb98; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Expressar exibição, tratamento e encerramento dentro de uma função async.
Em [vitrine.js](../../src/vitrine.js), substituímos a variável mensagemPronta
e a cadeia externa then/catch/finally por:

```js
async function exibirMensagem() {
    try {
        const mensagemFormatada = await formatarMensagem();

        console.log(mensagemFormatada);
    } catch (motivo) {
        console.error('Não foi possível preparar a mensagem:', motivo);
    } finally {
        console.log('Preparação da mensagem encerrada.');
    }
}

console.log('Antes de chamar exibirMensagem.');

exibirMensagem();

console.log('Depois de chamar exibirMensagem.');
```

A mudança é um conjunto inseparável no mesmo arquivo: a nova função assume
o trabalho da cadeia, e sua chamada substitui a antiga chamada de formatação.
Os rótulos dos logs diretos descrevem agora essa chamada.

## Exibição e tratamento

await formatarMensagem() chama a função que já conhecemos e suspende a
continuação de exibirMensagem. Quando há sucesso, mensagemFormatada recebe
a string em maiúsculas, e console.log a exibe. Esse trecho assume o papel
do callback de then anterior.

Se uma rejeição chegar a esse await, o fluxo entra no catch local de
exibirMensagem. O parâmetro motivo recebe a falha e console.error registra
o mesmo prefixo da cadeia anterior. Esse tratamento fica na função que
consome a mensagem formatada.

O catch de prepararMensagem continua com a recuperação alternativa já estudada.
Ele e o catch de exibirMensagem são blocos de funções diferentes. O caminho
atual tem sucesso e pula ambos. prepararMensagem e formatarMensagem não mudaram.

## Finally como estrutura da linguagem

finally aqui é um bloco da estrutura try/catch/finally, como a forma conhecida
em PHP. Não há ponto nem arrow: escrevemos finally { ... }. Ele executa depois
do try ou do catch, quando esse fluxo termina, e registra o encerramento.

| Antes, na cadeia | Agora, em exibirMensagem |
| --- | --- |
| then com callback de exibição | await seguido de console.log dentro do try |
| .catch com callback | catch (motivo) com bloco |
| .finally com callback | finally com bloco |

Neste finally usamos só console.log. Ele não altera o resultado normal da
função nem produz outro valor de retorno. Se lançasse um erro ou executasse
um return, isso poderia mudar a conclusão; esses casos não foram implementados.

exibirMensagem também devolve uma Promise por ser async. Neste exemplo, ela
conclui com undefined ao terminar normalmente, tanto no sucesso quanto após
o catch registrar uma falha. A chamada inicia a exibição; não guardamos essa
Promise em uma variável nem usamos seu valor nesta etapa.

Referências primárias: [Await](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#await)
e [try/catch/finally na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-try-statement-runtime-semantics-evaluation),
já consultadas nas aulas anteriores.

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega vitrine.js como módulo. O import
de prepararTexto de [textos.js](../../src/textos.js), formulário, filtro,
prepararMensagem e formatarMensagem são preservados.
[vitrine.css](../../src/vitrine.css) mantém o layout. As três funções da mensagem
continuam somente no exemplo de Console, fora do formulário. Nenhuma API,
dependência, container ou alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos:

```text
Antes de chamar exibirMensagem.
Depois de chamar exibirMensagem.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

A chamada de exibirMensagem chega a await, suspende sua continuação e devolve
a Promise ao chamador. O log direto "Depois" executa antes da continuação
que exibirá o texto. O finally executa depois dessa exibição neste caminho.

Compare a organização com a 8.55 e localize o que substituiu cada callback.
Não é preciso alterar código para responder. Informe diferenças ou erros.
Saída esperada, sem observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2107 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou substituição da cadeia pela função de
exibição, chamada e logs, com HTML/CSS/textos.js preservados. Links locais
conferidos. Isso demonstra entrega; execução das funções no navegador sem
observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.57 — verificação da exibição com async/await
no navegador. 8.57 não iniciada.
