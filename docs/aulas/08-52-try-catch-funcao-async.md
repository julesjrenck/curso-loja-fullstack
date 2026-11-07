# Aula 8.52 — Try/catch dentro de uma função async

Iniciada em 07/11/2026 após confirmação da 8.51 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
2b4a3eb8cf5993cacb885d3eac514639eee26574; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Tratar a rejeição de await dentro da própria função e produzir uma mensagem
alternativa. Em [vitrine.js](../../src/vitrine.js), mudamos somente o corpo
de prepararMensagem:

```js
async function prepararMensagem() {
    try {
        const mensagem = await Promise.reject('Falha simulada ao preparar a mensagem.');

        return mensagem;
    } catch (motivo) {
        console.error('Falha tratada dentro da função:', motivo);

        return 'Mensagem alternativa da vitrine.';
    }
}
```

try envolve o código cuja exceção queremos tratar. Quando await retoma com
a rejeição, o fluxo vai para o catch desse try. O parâmetro motivo recebe a
string de falha. return mensagem, dentro do try, continua sem ser alcançado
neste caminho.

## Recuperação com return

O catch local registra o motivo com console.error e devolve outra string:
"Mensagem alternativa da vitrine.". Esse return termina a função normalmente
com um valor. Como a função é async, sua Promise externa fica fulfilled com a
mensagem alternativa. A Promise interna criada por Promise.reject permanece
rejeitada; tratamos seu resultado e produzimos outro resultado para o chamador.

A cadeia externa continua igual. Seu primeiro then recebe o texto alternativo
e retorna a versão em maiúsculas; o segundo then a registra. O callback do
.catch externo é pulado neste caminho, pois a rejeição foi tratada dentro da
função e seu retorno forneceu um resultado de sucesso. .finally registra o
encerramento como antes.

Não basta a existência de catch para prometer qualquer recuperação: aqui ela
ocorre porque o bloco termina normalmente com return de uma string adequada
ao próximo passo. Esse é o caso específico que estamos estudando.

## Dois usos de catch

| Trecho | Papel |
| --- | --- |
| `try { ... } catch (motivo) { ... }` | Estrutura da linguagem que trata a exceção dentro da função |
| `.catch((motivo) => { ... })` | Método da Promise que registra um callback de rejeição na cadeia externa |

O catch local não tem ponto e não recebe uma arrow. A sintaxe lembra try/catch
em PHP, mas neste exemplo JavaScript o motivo é uma string, sem declaração
de tipo no parâmetro. Os dois nomes motivo pertencem a escopos diferentes.
O tratamento local não retoma o try na linha que falhou; executa seu próprio bloco.

Referências primárias: [try/catch na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-try-statement-runtime-semantics-evaluation)
e [conclusão da função async em AsyncBlockStart](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-asyncblockstart).

## Arquivos e saída esperada

[vitrine.html](../../src/vitrine.html) carrega vitrine.js como módulo. Import de
prepararTexto de [textos.js](../../src/textos.js), formulário e busca permanecem
iguais. [vitrine.css](../../src/vitrine.css) mantém o layout. A recuperação é
somente para a mensagem didática no Console, sem API ou alteração no backend.
Nenhuma dependência ou container novo.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos:

```text
Antes de registrar o then.
Depois de registrar o then.
Falha tratada dentro da função: Falha simulada ao preparar a mensagem.
MENSAGEM ALTERNATIVA DA VITRINE.
Preparação da mensagem encerrada.
```

A linha da falha vem do console.error local e pode aparecer em vermelho.
O prefixo externo "Não foi possível preparar a mensagem:" não deve aparecer
neste caminho. Confira por que vemos uma falha registrada e, depois, uma
mensagem alternativa em maiúsculas. Informe qualquer diferença ou erro.
Resultados esperados, sem observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2047 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente try/catch dentro da função,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega; execução da recuperação no navegador sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em b1f2692c35d548aa1cf8d5d9220aa6e7b595b2f9;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.53 — verificação do tratamento local](08-53-verificacao-tratamento-local.md).
