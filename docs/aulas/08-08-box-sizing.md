# Aula 8.8 — Box-sizing e cálculo da largura total

Iniciada em 06/11/2026 após confirmação da [8.7](08-07-largura-centralizacao.md)
com "entendi". Checkpoint anterior publicado e conferido em
f31aadc0543bae48a3d827c442016c980fa7f5a3; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Incluir padding e borda na medida usada por max-width. Box-sizing define como
interpretar as dimensões declaradas. Content-box, o padrão usado antes em main,
mede a área de conteúdo; border-box mede conteúdo, padding e borda juntos.
As margens ficam fora dessa medida nos dois casos.

## Pequena alteração

Acrescentada uma linha em [src/vitrine.css](../../src/vitrine.css). A regra
completa de main agora é:

```css
main {
    box-sizing: border-box;
    max-width: 960px;
    margin: 0 auto;
    padding: 16px;
}
```

A nova declaração é `box-sizing: border-box;`. Ela muda o que os 960px de
max-width incluem. O padding continua com 16px em cada lado e main continua
sem borda definida. O navegador reserva a área interna que resta para o conteúdo.

Quando há espaço suficiente para atingir o limite:

```text
16px de padding + 928px de conteúdo + 16px de padding = 960px
```

| Medida no limite de largura | 8.7: content-box | 8.8: border-box |
| --- | --- | --- |
| Área de conteúdo | 960px | 928px |
| Padding horizontal somado | 32px | 32px |
| Caixa até a borda, que aqui tem espessura zero | 992px | 960px |

Esses valores são calculados a partir do CSS, não medidos no navegador.
Em janela mais estreita, a caixa pode ficar abaixo do limite. Margin 0 auto
continua distribuindo a sobra horizontal para centralizar a caixa.

Border-box não remove o padding: muda como ele participa da largura declarada.
Se main ganhar uma borda depois, sua espessura também entrará nessa conta.
A margem continua do lado de fora. Box-sizing não é herdada por padrão;
a declaração acrescentada aplica-se a main. Os cartões continuam com a regra
.produto da etapa anterior.

Referência primária: [box-sizing: content-box e border-box — W3C](https://www.w3.org/TR/css-sizing-3/#box-sizing).

## Relação entre os arquivos e verificação

[vitrine.html](../../src/vitrine.html) já contém o elemento main e o link para
vitrine.css. Não foi necessário alterar o HTML. O navegador recebe a folha
atualizada e encontra a nova declaração na regra desse elemento.

O assistente verifica HTTP e compara o corpo CSS ao arquivo local; resultados
no [progresso](../progresso.md). Isso confirma a entrega da folha e não mede
a largura renderizada. Nenhuma medição ou resultado visual foi relatado pelo aluno.

Atividade acompanhada: recarregar a [vitrine local](http://127.0.0.1:8001/vitrine.html)
em uma janela larga e relacionar o padding que continua visível com a conta
960 - 16 - 16 = 928. O limite da caixa principal passa a incluir o padding.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.8 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint em preparação conforme autorização permanente. Próximo passo após
checkpoint: 8.9 — alinhar cabeçalho,
catálogo e rodapé com uma classe compartilhada. 8.9 não iniciada.
