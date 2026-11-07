# Aula 8.14 — Cabeçalho responsivo com direção em coluna

Iniciada em 06/11/2026 após confirmação da [8.13](08-13-media-query-catalogo.md)
com "entendi". Checkpoint anterior publicado e conferido em
c2f8025424dbf5d4e2dc47c73d186c0c332dc19e; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Colocar o nome da loja e a navegação um abaixo do outro em janelas menores.
Retomaremos os eixos do Flexbox: mudar flex-direction altera a direção do
eixo principal e, consequentemente, do transversal.

## Pequena alteração

Dentro da media query existente em [src/vitrine.css](../../src/vitrine.css),
acrescentamos a regra .cabecalho. O bloco completo fica:

```css
@media (max-width: 600px) {
    .cabecalho {
        flex-direction: column;
        align-items: flex-start;
    }

    .produtos {
        grid-template-columns: 1fr;
    }
}
```

Flex-direction column organiza os filhos diretos do cabeçalho em coluna.
Eles continuam sendo p e nav, nessa ordem, conforme o
[HTML](../../src/vitrine.html). Align-items flex-start os alinha ao início do
eixo transversal, à esquerda nesta página.

A regra base .cabecalho continua fornecendo display flex, justify-content
space-between e gap 16px. A regra dentro de @media muda apenas a direção e
o alinhamento quando o viewport tem até 600px, inclusive.

## O que muda nos eixos

Nesta página, com o modo de escrita e a direção atuais:

| Condição | Flex-direction | Eixo principal | Eixo transversal |
| --- | --- | --- | --- |
| Acima de 600px | row, padrão | Horizontal | Vertical |
| Até 600px | column | Vertical | Horizontal |

Justify-content atua no eixo principal e align-items no transversal. Assim,
align-items não significa sempre alinhamento vertical. Em column, flex-start
alinha os itens no início horizontal. Justify-content continua no principal,
agora vertical; o espaço livre depende da altura da caixa. No cabeçalho atual,
gap e as margens próprias do parágrafo contribuem para o espaçamento visível.

Ao ampliar a janela acima de 600px, a regra condicional deixa de participar.
Flex-direction volta ao padrão row e align-items center vem da regra base.
A mesma condição também mantém o catálogo em uma coluna nas janelas menores,
como estudado na 8.13.

Referência primária: [direção e alinhamento dos eixos do Flexbox — W3C](https://www.w3.org/TR/css-flexbox-1/).

## Verificação e atividade acompanhada

O assistente consulta o CSS por HTTP e compara o corpo ao arquivo local;
inspeciona a regra dentro da condição. Resultados no [progresso](../progresso.md).
Isso demonstra entrega da folha, sem observar posições ou medir caixas no navegador.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html) e reduza a
janela. Até o limite, o esperado é o nome da loja acima do link Catálogo,
ambos alinhados à esquerda, e produtos em uma coluna. Em janela larga,
cabeçalho em linha e produtos em duas colunas. Nenhum resultado visual foi
relatado pelo aluno nesta etapa.

Atividade acompanhada: identificar qual eixo align-items controla quando a
direção passa a column, usando a tabela e os dois filhos do header.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.14 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
0ea7b1802b0bb4e05cce149895fc1737ade98122; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.15](08-15-verificacao-vitrine-navegador.md): verificação acompanhada da vitrine.
