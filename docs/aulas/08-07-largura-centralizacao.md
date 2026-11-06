# Aula 8.7 — Largura máxima e centralização do conteúdo principal

Iniciada em 06/11/2026 após confirmação da [8.6](08-06-classes-css-produtos.md)
com "entendi". Checkpoint anterior publicado e conferido em
ce3730b4e44627a9e0d78a2363c99bbbc6cc3841; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Organizar o catálogo em uma área central com limite de largura. Max-width
estabelece um teto para a largura; margens laterais automáticas distribuem
a sobra horizontal quando a caixa cabe e existe espaço disponível.

## Pequena alteração

Acrescentada uma regra em [src/vitrine.css](../../src/vitrine.css), entre body
e .produto:

```css
main {
    max-width: 960px;
    margin: 0 auto;
    padding: 16px;
}
```

O seletor main corresponde ao elemento que contém o título, a apresentação e
os dois produtos em [vitrine.html](../../src/vitrine.html). O link do HTML já
carrega a folha; o arquivo HTML não precisou ser alterado nesta etapa.

| Declaração | Função |
| --- | --- |
| `max-width: 960px;` | Limita a largura da área de conteúdo de main a 960 pixels CSS |
| `margin: 0 auto;` | Define margens superior/inferior zero e laterais automáticas |
| `padding: 16px;` | Define espaço interno nos quatro lados |

Em margin com dois valores, o primeiro vale para cima/baixo e o segundo para
direita/esquerda. Quando há sobra horizontal, as duas margens auto recebem
valores iguais e centralizam a caixa. O texto mantém seu alinhamento dentro
dela; estamos posicionando a caixa principal.

Como a largura continua automática, main pode ficar menor que 960px em uma
janela estreita. Ao ampliar a janela, a área de conteúdo cresce até esse limite
e a sobra fica nas laterais.

Nesta etapa, max-width limita a área de conteúdo. No modelo atual, com o limite
atingido, o padding acrescenta 16px de cada lado:

```text
16px + 960px + 16px = 992px de largura da caixa, sem contar margens
```

Main não tem borda definida. O padding dos cartões pertence a cada produto,
que continua dentro da área de conteúdo de main. Na próxima etapa estudaremos
box-sizing para aprofundar como os componentes da caixa entram nessa medida.

Referências primárias: [largura máxima — W3C](https://www.w3.org/TR/CSS22/visudet.html#min-max-widths)
e [cálculo de larguras e margens automáticas — W3C](https://www.w3.org/TR/CSS22/visudet.html#blockwidth).

## Verificação e atividade acompanhada

O assistente consulta o CSS por HTTP e compara o corpo ao arquivo local.
Resultados no [progresso](../progresso.md). Isso demonstra a entrega da regra;
não mede a largura renderizada nem observa a centralização no navegador.

Abra a [vitrine local](http://127.0.0.1:8001/vitrine.html) em uma janela larga
e depois reduza a largura. O esperado é o catálogo limitado e centralizado na
janela larga, passando a uma largura menor conforme o espaço disponível diminui.
Os produtos continuam um abaixo do outro. Esses são resultados esperados,
sem relato visual do aluno nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.7 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint em preparação conforme autorização permanente. Próximo passo após
checkpoint: 8.8 — box-sizing e cálculo
da largura total. 8.8 não iniciada.
