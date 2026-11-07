# Aula 8.30 — Estrutura HTML da mensagem de busca sem resultados

Iniciada em 07/11/2026 após confirmação da [8.29](08-29-verificacao-filtro.md)
com "funcinou e entendi", incluindo relato geral de sucesso no navegador.
Checkpoint anterior publicado e conferido em
2480b5b0c36fa2e7de98f425a086beda9575292d; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Preparar o elemento que informará quando uma busca não encontrar produtos.
Primeiro acrescentamos a estrutura HTML; o controle pelo JavaScript será
estudado em etapas seguintes. A mensagem começa oculta porque, ao carregar
a página, os dois produtos estão disponíveis.

## Alteração em src/vitrine.html

Acrescentado depois do fechamento da div produtos e antes do fechamento de main:

```html
<p id="sem-resultados" hidden>Nenhum produto encontrado.</p>
```

P representa um parágrafo. O texto entre a abertura e o fechamento é a mensagem
que o aluno verá quando esse elemento for exibido. Id="sem-resultados" identifica
esse elemento de forma única na página. Já usamos IDs nas aulas anteriores;
esse poderá ser selecionado por '#sem-resultados' quando introduzirmos sua
referência no JavaScript.

Hidden sem valor coloca o elemento no estado oculto já na leitura do HTML,
antes da execução do módulo. Na 8.28, atribuímos a propriedade hidden pelo JS
nos cartões; aqui definimos o estado inicial pelo atributo HTML. O parágrafo
continua presente no documento, mas não é exibido enquanto estiver oculto.

Referência primária: [atributo hidden — HTML Standard](https://html.spec.whatwg.org/multipage/interaction.html#the-hidden-attribute).

## Posição na estrutura e relação entre arquivos

```text
main
├── formulário de busca
├── div.produtos
│   ├── article.produto: Camiseta
│   └── article.produto: Caneca
└── p#sem-resultados: mensagem inicialmente oculta
```

O desenho omite os títulos e o texto de introdução para destacar a posição.
A mensagem fica dentro do catálogo, mas fora da div produtos. Assim, ela não
ocupa uma célula do Grid dos cartões quando for exibida. Não recebe a classe
produto, então também não faz parte da NodeList selecionada por '.produto'.

Somente [src/vitrine.html](../../src/vitrine.html) muda na aplicação.
[src/vitrine.css](../../src/vitrine.css) mantém os estilos;
[src/vitrine.js](../../src/vitrine.js) continua filtrando os cartões como antes.
Ainda não existe código para selecionar ou exibir a mensagem. Uma busca sem
resultados continua deixando a área de produtos vazia nesta etapa, enquanto
o parágrafo permanece oculto. O vínculo entre o resultado da busca e a mensagem
será construído depois da compreensão desta estrutura.

## Verificação

Conferir posição do parágrafo, ID único, atributo hidden e texto; verificar
entrega HTTP do HTML e igualdade com o arquivo local. Conferir que CSS/JS não
mudaram. Resultados no [progresso](../progresso.md). Esses resultados comprovam
a estrutura entregue, sem observação direta do parágrafo no navegador.

Atividade opcional: recarregar a [vitrine](http://127.0.0.1:8001/vitrine.html)
e observar que a mensagem não aparece inicialmente. No painel Elements do
DevTools, o parágrafo pode ser inspecionado dentro de main após a div produtos,
com id e hidden. Nenhum resultado dessa atividade foi observado ou relatado
nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.30 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.31 — seleção da mensagem de
busca sem resultados no JavaScript. Não iniciada.
