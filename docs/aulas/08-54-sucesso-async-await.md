# Aula 8.54 — Restauração do sucesso com async/await

Iniciada em 07/11/2026 após a 8.53: entendimento "entendi" e sucesso geral
"deu tudo certo", recebidos separadamente. Checkpoint anterior publicado em
47f5f6aa4079320a5c977ee3161ca79bf71639cd; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Comparar o caminho de sucesso com a recuperação local verificada na 8.53.
Em [vitrine.js](../../src/vitrine.js), mudamos apenas a Promise interna:

```js
async function prepararMensagem() {
    try {
        const mensagem = await Promise.resolve('Vitrine pronta para a busca.');

        return mensagem;
    } catch (motivo) {
        console.error('Falha tratada dentro da função:', motivo);

        return 'Mensagem alternativa da vitrine.';
    }
}
```

Promise.resolve cria uma Promise já fulfilled com a string original. await
suspende a continuação da função e, ao retomar com sucesso, produz o texto,
atribuído à variável mensagem. Agora return mensagem dentro do try é alcançado.
Esse retorno resolve a Promise externa da chamada async com a mensagem original.

## Comparação dos caminhos

| Etapa | Rejeição interna da 8.53 | Sucesso interno da 8.54 |
| --- | --- | --- |
| Continuação do await | Lança motivo, entra no catch local | Produz string, segue dentro do try |
| Return que fornece o resultado | Alternativa no catch local | Mensagem original no try |
| Promise devolvida pela função | Fulfilled com alternativa | Fulfilled com original |
| Then externos | Exibem alternativa em maiúsculas | Exibem original em maiúsculas |
| Callback do .catch externo | Pulado neste caminho recuperado | Pulado neste caminho de sucesso |
| Callback de .finally | Registra encerramento | Registra encerramento |

O catch local continua na função, mas não executa neste caminho sem exceção.
O callback do .catch externo também é pulado neste exemplo. finally continua
executando após os passos anteriores. Mantemos os tratamentos que já estudamos;
restauramos somente a origem de sucesso, sem simular uma falha a cada recarga.

A tabela considera os callbacks existentes terminando normalmente. Não significa
que uma função async sempre terá sucesso: a 8.51 mostrou a propagação de rejeição
sem tratamento local. A 8.52/8.53 mostrou o sucesso produzido pelo return alternativo.

Referências primárias: [Await](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#await)
e [try/catch](https://tc39.es/ecma262/multipage/ecmascript-language-statements-and-declarations.html#sec-try-statement-runtime-semantics-evaluation)
na especificação ECMAScript, já consultadas nas aulas anteriores.

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua carregando vitrine.js como módulo.
O import de prepararTexto de [textos.js](../../src/textos.js), o formulário e a
busca permanecem iguais. [vitrine.css](../../src/vitrine.css) mantém o layout.
Chamada prepararMensagem(), dois then, .catch, .finally e logs diretos preservados.
O exemplo continua local e somente no Console, sem API, dependência ou mudança
no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio, Info/Error visíveis e Preserve log desativado. Depois dos
registros iniciais, esperamos:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

As mensagens de falha e a alternativa não devem aparecer nesta recarga.
Compare com a 8.53 e identifique qual return forneceu o texto aos then agora.
Informe qualquer diferença ou erro. Resultados esperados, sem observação direta
ou relato desta alteração.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2038 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente troca da Promise aguardada por
resolve, com HTML/CSS/textos.js preservados. Links locais conferidos. Isso
demonstra entrega; execução deste caminho no navegador sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em 470a4d826c03836d75208adbff979f564991501d;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.55 — consumo de uma função async com await](08-55-consumo-funcao-async-await.md).
