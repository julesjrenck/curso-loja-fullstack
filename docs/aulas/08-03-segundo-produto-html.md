# Aula 8.3 — Segundo produto e títulos no mesmo nível

Iniciada em 06/11/2026 após confirmação da [8.2](08-02-primeiro-produto-html.md)
com "entendi". Checkpoint anterior publicado e conferido em
1875f32d912779990cdd425d9fca5df7870699f5, com HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Acrescentar um segundo produto demonstrativo para consolidar a relação entre
os artigos e a hierarquia dos títulos. Cada produto ocupa um article dentro
de main; os dois títulos de produto usam h2 porque estão no mesmo nível.

## Pequena alteração

Somente [src/vitrine.html](../../src/vitrine.html) foi alterado na aplicação.
Depois do fechamento do artigo da Camiseta, acrescentamos:

```html
<article>
    <h2>Caneca</h2>
    <p>Preço: R$ 29,90</p>
</article>
```

`<article>` inicia outro agrupamento de informações de produto. O `h2` contém
seu nome; o parágrafo apresenta o preço como texto. `</article>` encerra esse
agrupamento. Nome e preço são dados fictícios escritos diretamente no HTML.

O segundo article está depois de `</article>` da Camiseta e antes de `</main>`.
Assim, os artigos são irmãos: compartilham o mesmo elemento pai, main. A Caneca
não faz parte do artigo da Camiseta. A indentação ajuda a ler, mas as tags
de abertura e fechamento determinam essa estrutura.

```text
main
├── h1: Catálogo de produtos
├── p: Conheça os produtos da nossa loja.
├── article
│   ├── h2: Camiseta
│   └── p: Preço: R$ 49,90
└── article
    ├── h2: Caneca
    └── p: Preço: R$ 29,90
```

Mantemos um h1 para o assunto principal da página e um h2 para cada produto.
Usar h3 para a Caneca introduziria um nível mais profundo, embora ela
seja outro produto no mesmo nível. Não incrementamos o número do título a cada
item. Também não escolhemos h2 ou h3 por tamanho de fonte: a apresentação será
trabalhada em CSS.

Referência primária: [níveis de títulos no HTML Standard](https://html.spec.whatwg.org/multipage/sections.html#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements).

## Verificação e atividade acompanhada

O laboratório continua atendendo a
[vitrine local](http://127.0.0.1:8001/vitrine.html). A entrada é um GET para
/vitrine.html; a saída esperada é HTTP 200 com os dois artigos no corpo HTML.
Resultados da consulta do assistente ficam no [progresso](../progresso.md).

Recarregue a página. Devem aparecer Camiseta/R$ 49,90 e Caneca/R$ 29,90 abaixo
do título do catálogo, usando os estilos padrão do navegador. Essa é uma
expectativa para o navegador do aluno; nenhum resultado visual foi relatado.

Atividade acompanhada: localizar no arquivo o fechamento do primeiro article
e observar que o segundo começa fora dele, mas ainda dentro de main.
Os produtos continuam estáticos; não houve consulta à API ou conversão de preço.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.3 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
8c148c78de6aca56c1d4cfba4f7421f04dc88df1; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.4](08-04-primeira-folha-estilos.md): primeira folha de estilos e vínculo
entre CSS e HTML.
