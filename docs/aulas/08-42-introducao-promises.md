# Aula 8.42 — Introdução a promises com Promise.resolve e then

Iniciada em 07/11/2026 após a 8.41: entendimento e sucesso geral relatados com
"funcinou e entendi". Checkpoint publicado e conferido em
6c23f5bd5e3c31e3e0fb1ee520cbdd8ff5eef327; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Conhecer uma Promise e consumir seu valor com um callback. Na loja, operações
como pedir produtos à API terão resultados que chegam depois. Começamos com
uma mensagem local já disponível para conhecer a sintaxe em uma pequena etapa.

Uma Promise representa o resultado de uma operação. Pode estar pendente
(pending), concluída com sucesso (fulfilled) ou rejeitada (rejected).
Neste exemplo usamos somente sucesso; uma Promise não precisa continuar
pendente por algum tempo para ser útil.

## Alteração em src/vitrine.js

Depois de registrar o listener do formulário, acrescentamos:

```js
const mensagemPronta = Promise.resolve('Vitrine pronta para a busca.');

mensagemPronta.then((mensagem) => {
    console.log(mensagem);
});
```

Promise é fornecida pelo JavaScript, sem import adicional. Para esta string,
Promise.resolve cria uma Promise já fulfilled com o texto como valor.
mensagemPronta guarda o objeto Promise. O nome não indica uma string comum.
Esse exemplo registra uma mensagem didática; não faz uma preparação demorada.

then recebe uma função: a arrow já conhecida, agora com parâmetro mensagem.
O JavaScript chama esse callback com o valor de sucesso da Promise, a string
"Vitrine pronta para a busca.". console.log escreve a string no Console.
Passamos a função ao método, assim como registramos funções em addEventListener;
quem determina quando chamá-la é a API que a recebeu.

Mesmo com a Promise já fulfilled, o callback é agendado para depois da execução
síncrona atual. then não pausa o programa nem cria uma nova thread para esse
corpo. O próprio then devolve outra Promise; estudaremos seu uso em uma etapa
posterior. Agora usamos apenas o callback da mensagem.

Referência primária: [Promise.resolve](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.resolve)
e [then/PerformPromiseThen](https://tc39.es/ecma262/multipage/control-abstraction-objects.html#sec-promise.prototype.then)
na especificação ECMAScript.

## Relação entre arquivos

[vitrine.html](../../src/vitrine.html) continua carregando
[vitrine.js](../../src/vitrine.js) como módulo. O import de
[textos.js](../../src/textos.js), a função tratarBusca e seu listener continuam
como antes. A mensagem usa somente o Console, sem alterar cartões ou HTML.
[vitrine.css](../../src/vitrine.css) continua responsável pela apresentação.
Nenhuma chamada à API ou dependência nova foi introduzida.

## Verificação e atividade curta

Abra http://localhost:8001/vitrine.html, abra o Console e recarregue a página.
Depois dos registros iniciais já conhecidos, esperamos uma linha:

```text
Vitrine pronta para a busca.
```

O registro acontece ao carregar o módulo, sem precisar enviar o formulário.
Como conferência opcional, busque caneca e depois envie a busca vazia:
esperamos um cartão e depois os dois cartões, como antes.
Se houver erro ou faltar a mensagem, informe o texto exibido no Console.

Inspeção do diff e entrega por HTTP verificam o arquivo e o recurso servido;
a execução do callback no navegador depende de observação ou relato separado.
Nenhum resultado desta atividade foi presumido.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 1377 bytes; cmp confirmou conteúdo igual ao arquivo
local. git diff --check passou; HTML/CSS/textos.js sem alterações conferidos
por diff. Links locais conferidos. JavaScript não executado pelo assistente.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.43 — ordem de execução e callbacks de Promise.
8.43 não iniciada.
