# Aula 8.21 — Evento submit e preventDefault no formulário de busca

Iniciada em 06/11/2026 após confirmação da [8.20](08-20-campo-busca-value.md)
com "entendi". Checkpoint anterior publicado e conferido em
9418b719b9d7e61811ff596ab7a942cf3557d0ba; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Ler o campo no momento em que o aluno aciona a busca. Um evento informa que
algo aconteceu; submit é disparado no formulário quando ocorre seu envio.
Vamos registrar uma função que o navegador chamará nesse evento. Ela cancela
o envio nativo e registra o texto atual no Console.

## Alteração em src/vitrine.js

Mantidas as instruções anteriores e acrescentado ao final do arquivo:

```js
formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    console.log('Busca enviada:', campoNome.value);
});
```

Formulário e campo foram selecionados nas aulas anteriores. AddEventListener é
o método que registra o tratamento: o primeiro argumento é a string 'submit',
nome do evento; o segundo é uma função. A vírgula separa esses argumentos.
O registro acontece no carregamento do arquivo, mas o corpo da função será
executado a cada submit posterior.

Function (evento) { ... } cria uma função sem nome, chamada função anônima.
As chaves delimitam seu corpo. Assim como funções anônimas em PHP, ela pode
ser passada como argumento. Em JavaScript, esse corpo acessa as referências
campoNome e formularioBusca do módulo sem a cláusula use do PHP.

Evento é o parâmetro que recebe o objeto fornecido pelo navegador quando ele
chama a função. Esse nome foi escolhido por nós. Não é uma palavra reservada
nem uma variável global usada implicitamente. Passamos a função ao método;
não executamos seu corpo durante esse registro. Esse papel de função passada
para ser chamada pelo ambiente é conhecido como callback.

Evento.preventDefault() cancela a ação padrão do submit. No formulário atual,
essa ação seria enviar GET para vitrine.html, adicionando nome à URL e
carregando o documento. O método não interrompe as próximas instruções da
função: o console.log é executado em seguida.

O log lê campoNome.value dentro do corpo, portanto recebe o texto atual em
cada envio. A referência ao input continua a mesma; seu conteúdo pode mudar
entre os envios. O rótulo Busca enviada identifica o evento tratado localmente;
não significa que uma requisição foi enviada ao backend.

No fechamento });, a chave termina o corpo da função, o parêntese fecha a
chamada addEventListener e o ponto e vírgula termina a instrução.

Referências primárias: [addEventListener — DOM Standard](https://dom.spec.whatwg.org/#dom-eventtarget-addeventlistener),
[preventDefault — DOM Standard](https://dom.spec.whatwg.org/#dom-event-preventdefault),
[envio de formulário — HTML Standard](https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#form-submission-algorithm)
e [funções — ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-functions-and-classes.html#sec-function-definitions).

## Relação entre arquivos e comportamento esperado

[src/vitrine.html](../../src/vitrine.html) mantém form/action/method e botão
submit. O tratamento está no formulário, abrangendo o botão Buscar e o envio
com Enter no campo. [src/vitrine.js](../../src/vitrine.js) carrega como módulo
e registra a função. [src/vitrine.css](../../src/vitrine.css) mantém os estilos.
Somente JS muda na aplicação nesta etapa.

Com o módulo carregado e o tratamento registrado, o envio fica na página atual,
sem alterar a URL ou navegar pelo GET nativo. Os logs iniciais continuam sendo
executados no carregamento; o novo log ocorre a cada submit. Sem execução do
módulo, o formulário preserva o comportamento HTML anterior.

```text
carregar a página → selecionar elementos e registrar função
digitar Camiseta → conteúdo do campo muda
acionar Buscar → submit → função recebe evento
                       → cancela envio nativo
                       → lê value e registra Camiseta
```

Ainda exibimos os dois produtos estáticos. Não foi implementada filtragem nem
chamada à API. Esta etapa apresenta o momento em que a busca será tratada.

## Verificação e atividade acompanhada

Conferir entrega HTTP do JS, igualdade da resposta com o arquivo local,
seletores, função e ordem das instruções. Registrar resultados no
[progresso](../progresso.md). HTTP não demonstra execução de eventos no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Digitar Camiseta e clicar
Buscar. Espera-se Busca enviada: Camiseta no Console, sem navegação ou mudança
da URL. Trocar por Caneca e pressionar Enter com foco no campo. Espera-se novo
registro com Caneca. Os produtos continuam iguais. Esses são resultados
esperados; nenhuma execução desta atividade foi observada ou relatada.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.21 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.22 — remoção de espaços nas
extremidades do termo com trim. Não iniciada.
