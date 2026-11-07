# Aula 8.18 — Primeiro arquivo JavaScript da vitrine

Iniciada em 06/11/2026 após confirmação da [8.17](08-17-estilos-formulario-busca.md)
com "entendi". Checkpoint anterior publicado e conferido em
eeee2a43ee195877e680059d630be39ab2910205; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Criar um arquivo JavaScript separado e relacioná-lo ao HTML. O navegador
carregará o arquivo como módulo e registrará uma mensagem no Console.
Essa primeira instrução nos permite apresentar a execução de código na vitrine.

O laboratório de sessão do módulo 7 já continha JavaScript dentro do HTML.
Aqui começamos o arquivo próprio da vitrine, que será aprofundado em pequenas
etapas. O comportamento do formulário será estudado depois da introdução ao DOM.

## Arquivo criado

[src/vitrine.js](../../src/vitrine.js):

```js
console.log('JavaScript da vitrine carregado.');
```

Console é disponibilizado pelo ambiente do navegador. Log é o método que
registra os dados recebidos no Console. O ponto acessa esse método; os
parênteses contêm o argumento. As aspas simples delimitam a string, ou texto,
e usamos ponto e vírgula para encerrar a instrução.

O texto passado é a entrada da chamada. A saída esperada é uma mensagem no
Console com o mesmo conteúdo:

```text
JavaScript da vitrine carregado.
```

Essa saída é de diagnóstico. O conteúdo visível do catálogo continua vindo
do HTML e sua apresentação continua definida pelo CSS.

## Referência no HTML

Acrescentado no head de [src/vitrine.html](../../src/vitrine.html), depois do
link da folha de estilos:

```html
<script type="module" src="vitrine.js"></script>
```

Script associa o documento ao código. Src é o endereço relativo do arquivo,
que nesta página corresponde a /vitrine.js. Type module indica que o navegador
deve interpretar o JavaScript como módulo. Na inclusão usada aqui, sem async,
a execução aguarda a leitura do documento HTML.

O elemento script exige fechamento explícito, mesmo quando o código está
em outro arquivo. HTML, CSS e JS ficam juntos na pasta src já disponibilizada
pelo laboratório; cada arquivo é solicitado por seu endereço.

```text
GET /vitrine.html → documento com script src
GET /vitrine.js   → código JavaScript
execução esperada → mensagem no Console
```

Referências primárias: [script e módulos — HTML Standard](https://html.spec.whatwg.org/multipage/scripting.html#the-script-element)
e [console.log — Console Standard](https://console.spec.whatwg.org/#log).

## Verificação e atividade acompanhada

O assistente confere a referência ao arquivo, a instrução e a entrega HTTP
do HTML e do JS, incluindo tipo de conteúdo JavaScript e igualdade dos corpos
com os arquivos locais. Resultados no [progresso](../progresso.md). Entrega
HTTP não comprova execução de código pelo navegador do aluno.

A imagem Redocly usada nas verificações antigas não está disponível no cache
deste ambiente, e não há imagem Node em cache. Nenhuma ferramenta foi baixada
para esta instrução simples; não registrar teste de execução ou sintaxe no Node.

Atividade acompanhada opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html),
abrir o Console no Chrome com Ctrl+Shift+J e recarregar a página. Deve aparecer
a mensagem acima. O atalho está na [referência do Chrome DevTools](https://developer.chrome.com/docs/devtools/shortcuts).
Se não aparecer, informe o que foi observado para investigarmos. Nenhuma
execução em navegador foi observada ou relatada nesta etapa até esse relato.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.18 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no Console. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.19 — DOM e seleção do
formulário de busca. Não iniciada.
