# Aula 8.4 — Primeira folha de estilos da vitrine

Iniciada em 06/11/2026 após confirmação da [8.3](08-03-segundo-produto-html.md)
com "entendi". Checkpoint anterior publicado e conferido em
8c148c78de6aca56c1d4cfba4f7421f04dc88df1; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Introduzir CSS, linguagem que descreve a apresentação do documento. O HTML
continua identificando cabeçalho, conteúdo principal, produtos e rodapé.
O CSS passa a definir fonte, cor do texto e cor de fundo.

Criamos uma folha de estilos separada e a vinculamos no head do HTML. Os dois
arquivos formam um conjunto inseparável nesta etapa: a regra fica no CSS, e o
HTML indica ao navegador onde encontrá-la.

## Arquivo CSS

Criado [src/vitrine.css](../../src/vitrine.css):

```css
body {
    font-family: Arial, sans-serif;
    color: #1f2937;
    background-color: #f3f4f6;
}
```

`body` é o seletor: identifica o elemento body da página. Não escrevemos
`<body>` no CSS. As chaves delimitam o bloco de declarações da regra.
Cada declaração contém uma propriedade, dois-pontos, um valor e ponto e vírgula.
Por exemplo, `color: #1f2937;` define a propriedade color com esse valor.

| Declaração | Efeito pretendido |
| --- | --- |
| `font-family: Arial, sans-serif;` | Usa Arial quando disponível, com uma fonte da família genérica sem serifa como alternativa; não baixa fontes |
| `color: #1f2937;` | Define a cor do texto em um tom escuro |
| `background-color: #f3f4f6;` | Define um fundo cinza claro |

Os códigos que começam por `#` representam cores em hexadecimal. Cada um
dos valores usados tem seis dígitos, organizados em pares de vermelho, verde
e azul. Não é necessário memorizar esses valores para compreender a regra.

Nesta página, os títulos e parágrafos recebem a fonte e a cor do texto por
herança dos elementos que os contêm, partindo de body. Nem toda propriedade
é herdada: background-color não é herdada por padrão. O fundo claro permanece
visível através dos fundos transparentes dos elementos internos.

Não definimos tamanhos de fonte nem espaçamentos nesta etapa. Os títulos
continuam com seus níveis HTML e a aparência não especificada segue as regras
padrão do navegador.

## Vínculo no HTML

Acrescentado no head de [src/vitrine.html](../../src/vitrine.html):

```html
<link rel="stylesheet" href="vitrine.css">
```

`link` relaciona o documento a um recurso externo. `rel="stylesheet"` informa
que esse recurso é uma folha de estilos. `href` informa o endereço do arquivo.
Aqui, o caminho é relativo à URL do HTML: /vitrine.html leva a /vitrine.css
no mesmo servidor. Link é um elemento vazio, sem tag de fechamento `</link>`.

O navegador recebe o HTML, encontra link e solicita o CSS. Os dois arquivos
estão em src, que já é montada em /app pelo serviço do laboratório. Nenhuma
alteração de Docker ou instalação de ferramenta é necessária.

```text
GET /vitrine.html → HTML com link
GET /vitrine.css  → regra CSS
```

Referências primárias: [introdução a CSS e folhas externas — W3C](https://www.w3.org/TR/CSS22/intro.html)
e [herança de propriedades — W3C](https://www.w3.org/TR/CSS22/cascade.html#inheritance).

## Verificação e atividade acompanhada

O assistente verifica HTTP e igualdade do corpo para o HTML e o CSS. Resultados
no [progresso](../progresso.md). Isso demonstra que os recursos estão disponíveis;
não substitui a observação da renderização no navegador do aluno.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html). O esperado é
um fundo cinza claro, texto escuro e fonte sem serifa. Os dois produtos continuam
um abaixo do outro. Nenhum resultado visual foi relatado pelo aluno nesta etapa.

Atividade acompanhada: localizar o href no HTML e o seletor body no CSS,
relacionando o arquivo solicitado com a regra que controla a apresentação.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.4 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
4794ac7c69a64be7646e91cc7ea706754c3f2ef5; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.5](08-05-modelo-caixa-espacamentos.md): modelo de caixa e primeiros
espaçamentos com margin e padding.
