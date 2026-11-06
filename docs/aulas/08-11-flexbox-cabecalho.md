# Aula 8.11 — Primeiro Flexbox no cabeçalho

Iniciada em 06/11/2026 após confirmação da [8.10](08-10-navegacao-interna.md)
com "entendi". Checkpoint anterior publicado e conferido em
f0dda5dd299b336e420e483cb7d62c2b520ba1e5; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Organizar o nome da loja e a navegação na mesma linha do cabeçalho. Flexbox
distribui e alinha os itens ao longo de um eixo principal. Na configuração
atual, a direção padrão row coloca esse eixo na horizontal e o transversal
na vertical.

## Duas classes no HTML

A abertura do header em [src/vitrine.html](../../src/vitrine.html) passou a ser:

```html
<header class="container cabecalho">
```

O espaço separa dois nomes de classe. Header recebe tanto as declarações de
.container quanto as de .cabecalho. A primeira regra continua limitando a
largura, centralizando a caixa e definindo o padding; a segunda organiza seus
filhos. O id catalogo e o link para esse destino permanecem como na 8.10.

## Regra de layout

Acrescentada em [src/vitrine.css](../../src/vitrine.css), depois de .container:

```css
.cabecalho {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
```

| Declaração | Efeito nesta configuração |
| --- | --- |
| `display: flex;` | Faz o cabeçalho organizar seus filhos diretos com Flexbox |
| `justify-content: space-between;` | Distribui a sobra horizontal entre os itens |
| `align-items: center;` | Centraliza os itens no eixo transversal, aqui vertical |
| `gap: 16px;` | Define um espaçamento base entre os itens |

Os dois filhos diretos são o parágrafo com Loja Fullstack e o bloco nav.
Eles são os itens flexíveis. O link está dentro de nav; seu pai direto é nav.

```text
header: container + cabecalho
├── p: Loja Fullstack
└── nav
    └── a: Catálogo
```

Havendo sobra horizontal, o parágrafo fica no início e nav no final da área
de conteúdo. Gap reserva espaçamento; space-between pode aumentar a distância
visível ao distribuir a sobra. Por isso a distância final pode superar 16px.
As margens padrão do parágrafo também continuam fazendo parte de sua caixa.

Referências primárias: [Flexbox e seus eixos — W3C](https://www.w3.org/TR/css-flexbox-1/)
e [gap — CSS Box Alignment](https://www.w3.org/TR/css-align-3/#gap-shorthand).

## Verificação e atividade acompanhada

O assistente inspeciona a classe adicional e as quatro declarações, consulta
HTML/CSS por HTTP e compara os corpos aos arquivos locais. Resultados no
[progresso](../progresso.md). Isso demonstra a entrega da alteração, sem
observação de alinhamento ou medição de posições em navegador.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html). O esperado
é o nome da loja à esquerda e a navegação à direita, na mesma linha, quando
houver espaço. O catálogo mantém os dois produtos um abaixo do outro.
Nenhum resultado visual dessa etapa foi relatado pelo aluno.

Atividade acompanhada: localizar os dois filhos diretos de header no HTML e
relacionar justify-content ao eixo horizontal e align-items ao vertical nesta
configuração. Esses eixos dependem da direção do Flexbox.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.11 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
2c3ee6369998abe54ebd45a4dce8bb0c4114564a; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.12](08-12-grid-produtos.md): primeiro CSS Grid nos produtos.
