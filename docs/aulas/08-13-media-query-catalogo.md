# Aula 8.13 — Responsividade do catálogo com media query

Iniciada em 06/11/2026 após confirmação da [8.12](08-12-grid-produtos.md)
com "entendi". Checkpoint anterior publicado e conferido em
95da0d58200099689c4ed438435c5e57d8862e24; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Mudar a quantidade de colunas conforme a largura disponível no navegador.
Uma media query permite aplicar regras CSS sob uma condição. Escolhemos 600px
como limite didático para apresentar uma coluna em janelas menores.

## Pequena alteração

Acrescentado ao final de [src/vitrine.css](../../src/vitrine.css):

```css
@media (max-width: 600px) {
    .produtos {
        grid-template-columns: 1fr;
    }
}
```

O bloco externo declara a condição: largura do viewport de até 600 pixels CSS,
incluindo 600px. Viewport é a área de visualização da página no navegador.
Dentro desse bloco, a regra .produtos define uma única coluna de uma fração.

O max-width da media query consulta a largura do viewport. Já max-width: 960px
na regra .container limita a largura da caixa do elemento. O contexto muda
o papel desse nome.

## Relação com a regra anterior

A regra base da 8.12 continua definindo display grid, duas colunas e gap.
Quando a condição combina, a declaração posterior muda grid-template-columns
para 1fr. As duas regras usam o mesmo seletor .produtos; nessa situação,
a declaração que vem depois define o valor dessa propriedade. Display e gap
continuam vindo da regra base.

| Largura do viewport | Colunas esperadas |
| --- | --- |
| Acima de 600px | Duas: 1fr 1fr |
| Até 600px, inclusive | Uma: 1fr |

Por exemplo, em 599px e 600px a condição combina; em 601px ela não combina.
São exemplos de avaliação da condição, não resultados medidos em navegador.
Ao ampliar a janela acima do limite, volta a valer a definição base de duas
colunas. O navegador reavalia a consulta quando a largura muda.

[vitrine.html](../../src/vitrine.html) continua carregando a mesma folha e
mantém os produtos no mesmo grupo. A meta viewport apresentada na 8.1 participa
da configuração de visualização em dispositivos móveis.

Referência primária: [largura do viewport e condições min/max — Media Queries, W3C](https://www.w3.org/TR/mediaqueries-4/#width).

## Verificação e atividade acompanhada

O assistente consulta o CSS por HTTP e compara o corpo ao arquivo local;
confere o bloco e a ordem das regras. Resultados no [progresso](../progresso.md).
Isso demonstra entrega da folha, sem observar a mudança de colunas no navegador.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html) e alterne entre
uma janela larga e uma estreita. O esperado é a grade passar de duas colunas
para uma ao cruzar o limite. Gap continua separando os cartões, inclusive
quando ficam um abaixo do outro. Nenhum resultado visual foi relatado pelo aluno.

Atividade acompanhada: localizar a regra base e a regra dentro de @media,
identificando qual propriedade muda e quais continuam sendo usadas.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.13 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint em preparação conforme autorização permanente. Próximo passo após
checkpoint: 8.14 — cabeçalho responsivo
com direção em coluna. 8.14 não iniciada.
