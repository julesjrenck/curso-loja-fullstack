# Aula 8.2 — Primeiro produto no HTML

Iniciada em 06/11/2026 após confirmação da [8.1](08-01-estrutura-html-vitrine.md)
com "entendi". Checkpoint anterior registrado localmente em
cdb03955b421c4dbc56ccd8e7d416e9adda87d53. Publicação inicialmente pendente de
autorização explícita após rejeição da revisão automática. Em 06/11/2026 o aluno
autorizou publicar os checkpoints concluídos do curso; 8.1 publicada e conferida
no SHA acima, com HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Representar um produto demonstrativo dentro do catálogo e aprofundar a
hierarquia de títulos. `article` pode representar um conteúdo com sentido
próprio; nesta página, usamos um para reunir as informações de um produto.
`h2` identifica o título desse produto dentro do catálogo apresentado por `h1`.

Escolhemos o nível do título pela organização do conteúdo. O tamanho visual
da fonte poderá ser ajustado com CSS quando esse assunto for introduzido.

## Pequena alteração

Somente [src/vitrine.html](../../src/vitrine.html) foi alterado na aplicação.
Dentro de `main`, depois do título e do parágrafo de apresentação:

```html
<article>
    <h2>Camiseta</h2>
    <p>Preço: R$ 49,90</p>
</article>
```

`<article>` abre o agrupamento do produto e `</article>` o encerra.
`<h2>Camiseta</h2>` dá um título ao produto; `<p>` apresenta seu preço como texto.
O artigo está dentro de `main`, pois integra o conteúdo principal da vitrine.

A organização fica assim:

```text
main
├── h1: Catálogo de produtos
├── p: Conheça os produtos da nossa loja.
└── article
    ├── h2: Camiseta
    └── p: Preço: R$ 49,90
```

O título `h1` descreve o assunto principal da página. O `h2` descreve um item
desse catálogo. Outro produto no mesmo nível também poderá ter `h2`; não
incrementamos o número do título a cada produto.

Nome e preço foram escritos diretamente no HTML como demonstração. O texto
`R$ 49,90` não é uma variável nem um cálculo. No backend trabalhamos com valores
inteiros em centavos; aqui só temos a apresentação escrita de um valor. Nenhuma
conversão ou busca pela API foi introduzida.

Referência primária: [article e níveis de títulos no HTML Standard](https://html.spec.whatwg.org/multipage/sections.html).
A escolha de usar article para cada produto é uma decisão de estrutura deste
protótipo, baseada no significado de conteúdo que pode ser reutilizado por si.

## Verificação e atividade acompanhada

O laboratório continua expondo a pasta `src` na URL
[http://127.0.0.1:8001/vitrine.html](http://127.0.0.1:8001/vitrine.html).
A entrada é um GET; a saída esperada é HTTP 200 com o HTML atualizado.
O resultado da consulta pelo assistente é registrado no [progresso](../progresso.md).

Recarregue a página: além do conteúdo anterior, devem aparecer “Camiseta” e
“Preço: R$ 49,90”. Isso é uma expectativa para o navegador do aluno, não um
resultado já relatado. A aparência permanece a padrão do navegador.

Atividade acompanhada: pensar em um segundo produto e identificar o nível
do título que ele receberia, sem precisar alterar o arquivo sozinho.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.2 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado de execução no
navegador. Checkpoint publicado e conferido em
1875f32d912779990cdd425d9fca5df7870699f5, com HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.3](08-03-segundo-produto-html.md): segundo produto demonstrativo,
repetição de article e títulos no mesmo nível.
