# Aula 8.48 — Restauração do caminho de sucesso com Promise.resolve

Iniciada em 07/11/2026 após a 8.47, com relato geral "funcionou" e confirmação
separada "entendi". Checkpoint anterior publicado e conferido em
633e7de3be32ec525be05b2a9d7137b4d1cddeb1; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Comparar os caminhos de sucesso e rejeição mantendo a mesma cadeia de callbacks.
Em [vitrine.js](../../src/vitrine.js), mudamos uma linha:

```js
const mensagemPronta = Promise.resolve('Vitrine pronta para a busca.');
```

Sai a rejeição simulada; volta a Promise já fulfilled com uma string. Não há
requisição à API ou espera artificial. Os dois then, catch, finally e logs
diretos permanecem iguais.

## Caminho dos valores

O primeiro callback de then recebe "Vitrine pronta para a busca." em mensagem
e retorna mensagem.toUpperCase(). A string em maiúsculas é o valor de sucesso
da Promise devolvida por esse then. A Promise original mantém o texto inicial.

O segundo callback recebe o texto transformado em mensagemFormatada e o registra
com console.log. Como ele termina normalmente sem return explícito, a Promise
devolvida por esse segundo then fica fulfilled com undefined.

O callback de catch não executa neste caminho: não há rejeição anterior a tratar.
Isso não retira sua utilidade; ele continua registrado para uma rejeição que
chegue à sua posição na cadeia. finally executa quando a Promise anterior termina,
registrando o encerramento, como fazia no caminho de falha.

| Resultado inicial no exemplo | Callbacks de sucesso dos then | Callback de catch | Callback de finally |
| --- | --- | --- | --- |
| Rejeição simulada da 8.47 | Pulados | Registra o motivo | Registra o encerramento |
| Sucesso restaurado da 8.48 | Transformam e registram o texto | Pulado | Registra o encerramento |

A tabela descreve estes callbacks, que terminam normalmente. Não significa
que um callback não possa gerar uma rejeição. O objetivo desta etapa é comparar
os dois valores iniciais conhecidos, com o restante do código preservado.

Referências primárias: [Promise.resolve](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.resolve),
[then](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.then),
[catch](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.catch)
e [finally](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.finally).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) carrega vitrine.js como módulo; JS importa
prepararTexto de [textos.js](../../src/textos.js). O filtro e seu listener continuam
como antes. [vitrine.css](../../src/vitrine.css) mantém o layout. Somente a linha
de criação da Promise foi alterada; mensagem apenas no Console. Nenhuma dependência,
container, API ou alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio e níveis Info/Error visíveis. Depois dos registros iniciais,
esperamos esta ordem:

```text
Antes de registrar o then.
Depois de registrar o then.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

A mensagem de falha simulada não deve aparecer após uma nova recarga com Preserve
log desativado. Compare com o resultado da 8.47. Os logs diretos continuam antes
dos callbacks agendados. Se algo divergir, informe a saída ou eventual erro.
Resultados esperados; execução desta alteração ainda sem relato ou observação direta.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1763 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente troca da linha de criação da
Promise, com HTML/CSS/textos.js preservados. Links locais conferidos. Isso
demonstra entrega; execução dos callbacks sem observação ou relato nesta etapa.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.49 — função async e seu retorno como Promise.
8.49 não iniciada.
