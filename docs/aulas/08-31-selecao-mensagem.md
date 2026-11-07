# Aula 8.31 — Seleção da mensagem de busca sem resultados no JavaScript

Iniciada em 07/11/2026 após confirmação da
[8.30](08-30-mensagem-sem-resultados-html.md) com "entendi". Checkpoint anterior
publicado e conferido em 8416e7fe96db136302e83b74d0fbdd9290cb9ee8;
HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Guardar uma referência ao parágrafo da mensagem. Reutilizamos querySelector,
agora com o ID acrescentado na aula anterior. O atributo hidden controla sua
exibição; o elemento continua presente no DOM e disponível para seleção.

## Alteração em src/vitrine.js

Acrescentado junto às seleções existentes:

```js
const mensagemSemResultados = document.querySelector('#sem-resultados');
```

Document permite procurar no documento. QuerySelector recebe o seletor CSS
'#sem-resultados': # indica um ID, como já usamos em '#busca-nome'. O método
retorna a referência ao elemento encontrado, atribuída à constante
mensagemSemResultados. Não há cópia ou criação de um novo parágrafo.

A busca parte do documento porque a mensagem está em main, fora do formulário
e da div produtos. Procurar apenas dentro de formularioBusca não encontraria
esse parágrafo. O HTML atual tem uma ocorrência desse ID. Se não houver elemento
correspondente, querySelector retornará null, como estudado na 8.19.

Acrescentado junto aos logs iniciais:

```js
console.log(mensagemSemResultados);
```

Sem aspas, o argumento é a referência guardada. A saída esperada é o elemento
p com id sem-resultados e hidden, cuja apresentação depende do Console.
Não estamos registrando somente seu texto. Seleção e log acontecem ao carregar
o módulo; o script type module sem async executa após a análise do HTML.

O trecho correspondente em [src/vitrine.html](../../src/vitrine.html) é:

```html
<p id="sem-resultados" hidden>Nenhum produto encontrado.</p>
```

A constante pode ser acessada pela função de submit declarada no mesmo módulo,
assim como formularioBusca, campoNome e produtos. Seu uso para controlar a
exibição será estudado depois da contagem dos resultados. Nesta etapa, a
mensagem permanece oculta porque nenhuma atribuição modifica seu hidden.

Referências primárias: [querySelector — DOM Standard](https://dom.spec.whatwg.org/#dom-parentnode-queryselector)
e [hidden — HTML Standard](https://html.spec.whatwg.org/multipage/interaction.html#the-hidden-attribute).

## Relação entre arquivos e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. O HTML fornece
o parágrafo; [src/vitrine.css](../../src/vitrine.css) mantém os estilos. O
tratamento do submit continua filtrando os cartões, com as seleções e os logs
anteriores preservados. O novo log facilita inspecionar a referência à mensagem.

Conferir seletor/ID e sua posição no documento, inclusão do módulo, entrega
HTTP do JS e igualdade com o arquivo local. Resultados no
[progresso](../progresso.md). Essas verificações não executam a seleção no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Espera-se o parágrafo no
novo registro, mantendo hidden e sem aparecer no catálogo. Se aparecer null,
há uma diferença entre a seleção esperada e a estrutura carregada que deve
ser investigada. Nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.31 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.32 — contagem dos produtos
correspondentes com let. Não iniciada.
