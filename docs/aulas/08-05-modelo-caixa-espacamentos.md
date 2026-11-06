# Aula 8.5 — Modelo de caixa e primeiros espaçamentos

Iniciada em 06/11/2026 após confirmação da [8.4](08-04-primeira-folha-estilos.md)
com "entendi". Checkpoint anterior publicado e conferido em
4794ac7c69a64be7646e91cc7ea706754c3f2ef5; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Visualizar a caixa de cada produto e distinguir espaço interno de espaço externo.
No modelo de caixa CSS, o conteúdo é cercado por padding, borda e margin.
O padding afasta a área de conteúdo da borda; a margin fica fora da borda.

## Pequena alteração

Acrescentada uma regra em [src/vitrine.css](../../src/vitrine.css):

```css
article {
    margin-bottom: 16px;
    padding: 16px;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
}
```

O seletor article corresponde aos dois elementos article de
[vitrine.html](../../src/vitrine.html). Uma única regra apresenta os dois
produtos com a mesma aparência. O HTML já carrega essa folha pelo link da 8.4.

| Declaração | Papel na caixa de cada produto |
| --- | --- |
| `margin-bottom: 16px;` | Define uma margem externa inferior |
| `padding: 16px;` | Define espaço interno de 16 pixels CSS nos quatro lados |
| `border: 1px solid #d1d5db;` | Define a borda: espessura de 1 pixel CSS, traço contínuo e cor cinza |
| `background-color: #ffffff;` | Pinta o fundo do artigo de branco |

`px` é uma unidade de comprimento em CSS. Um único valor em padding vale
para cima, direita, baixo e esquerda. Margin-bottom pertence à família margin
e afeta somente o lado de baixo. Border reúne espessura, estilo e cor em uma
declaração.

De dentro para fora:

```text
conteúdo → padding → borda → margin
```

O fundo branco aparece também na área do padding. A margem é transparente:
na separação entre os artigos, vemos o fundo cinza da página. Por isso mudar
padding altera o espaço dentro do cartão, enquanto mudar margin-bottom altera
seu espaço externo inferior. Títulos e parágrafos ainda têm margens padrão do
navegador, que também contribuem para os espaços internos visíveis.

Referência primária: [modelo de caixa, margens, padding e bordas — W3C](https://www.w3.org/TR/CSS22/box.html).

## Verificação e atividade acompanhada

O assistente consulta o CSS por HTTP e compara o corpo ao arquivo local.
O HTML é conferido para preservar a relação com a folha de estilos. Resultados
no [progresso](../progresso.md). A entrega HTTP dos arquivos não substitui a
observação do resultado visual pelo aluno.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html). O esperado é
ver os dois produtos em áreas brancas com borda cinza, espaço interno e uma
separação externa. Essa aparência ainda não foi relatada pelo aluno.

Atividade acompanhada: identificar qual declaração alteraria para aumentar o
espaço entre os artigos e qual alteraria para aumentar o espaço dentro deles.
Não é necessário editar sozinho para continuarmos.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.5 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
25e8a781565bfd1cdcee93fad9fb2589216cfb0b; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.6](08-06-classes-css-produtos.md): classes CSS para os produtos.
