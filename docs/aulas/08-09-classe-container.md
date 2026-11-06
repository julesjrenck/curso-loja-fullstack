# Aula 8.9 — Alinhamento com uma classe compartilhada

Iniciada em 06/11/2026 após confirmação da [8.8](08-08-box-sizing.md)
com "entendi". Checkpoint anterior publicado e conferido em
dad2a2a74fcb890a5b59b1c14a0248e751478b3e; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Alinhar cabeçalho, catálogo e rodapé reutilizando a regra de largura e
espaçamento estudada antes. Uma classe CSS pode ser compartilhada por elementos
com tags diferentes. O nome container foi escolhido pelo projeto para essa
área com largura limitada e centralizada.

## HTML e CSS juntos

Em [src/vitrine.html](../../src/vitrine.html), acrescentamos a mesma classe
às três regiões:

```html
<header class="container">
```

```html
<main class="container">
```

```html
<footer class="container">
```

Os elementos continuam sendo irmãos dentro de body. Header apresenta a loja,
main contém o catálogo e footer representa o rodapé. A classe compartilhada
define sua apresentação; o significado das tags permanece.

Em [src/vitrine.css](../../src/vitrine.css), o seletor main passou a .container:

```css
.container {
    box-sizing: border-box;
    max-width: 960px;
    margin: 0 auto;
    padding: 16px;
}
```

As quatro declarações são as mesmas da 8.8. Agora cada uma das três regiões
corresponde à regra por sua classe. Cada caixa tem seu próprio limite de
largura, margens automáticas e padding, alinhando lateralmente o nome da loja,
o título do catálogo e o texto do rodapé.

Quando o limite é atingido, cada caixa mede 960px com o padding incluído, e
sua área de conteúdo mede 928px. O catálogo mantém a medida da etapa anterior;
o cabeçalho e o rodapé passam a usar essa mesma configuração. Trata-se de um
alinhamento esperado a partir do CSS, não de uma medição no navegador.

Os dois produtos continuam com class produto e a regra .produto. Container
cuida da área das regiões; produto cuida da caixa de cada item do catálogo.
Nenhuma biblioteca foi instalada: esses nomes correspondem às regras que
escrevemos no próprio vitrine.css.

Referência primária: [classes compartilhadas por elementos — W3C](https://www.w3.org/TR/selectors-4/#class-html).

## Verificação e atividade acompanhada

O assistente confere as três classes container, o seletor .container e as
declarações no diff; consulta HTML/CSS por HTTP e compara os corpos aos arquivos
locais. Resultados no [progresso](../progresso.md). Isso não observa o alinhamento
renderizado nem constitui um relato visual do aluno.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html) em uma janela
larga. O esperado é o nome da loja no cabeçalho, o título do catálogo e o texto
do rodapé alinhados à mesma esquerda da área de conteúdo. Os cartões mantêm
seu padding próprio, que afasta seus textos da borda dos produtos.

Atividade acompanhada: localizar as três ocorrências de container no HTML
e relacioná-las com uma única regra .container no CSS.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.9 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint em preparação conforme autorização permanente. Próximo passo após
checkpoint: 8.10 — navegação interna para
o catálogo. 8.10 não iniciada.
