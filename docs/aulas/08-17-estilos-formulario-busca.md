# Aula 8.17 — Estilização do formulário de busca

Iniciada em 06/11/2026 após confirmação da [8.16](08-16-formulario-busca.md)
com "entendi". Checkpoint anterior publicado e conferido em
1896c60ec221d56235c5e9742286dd4d1ea3e684; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Organizar os controles do formulário, separar seu grupo do catálogo e usar a
fonte da página nos campos e botões. Retomaremos Grid, gap, margin e padding,
introduzindo seleção de descendentes e agrupamento de seletores.

## Classe no HTML

Em [src/vitrine.html](../../src/vitrine.html), a abertura do formulário recebeu
class busca:

```html
<form class="busca" action="vitrine.html" method="get">
```

A classe conecta o formulário às regras CSS. Os atributos de envio continuam
apontando para a própria página por GET; for/id/name e o botão submit são os
mesmos apresentados na 8.16.

## Layout do grupo

Acrescentado em [src/vitrine.css](../../src/vitrine.css), antes de .produtos:

```css
.busca {
    display: grid;
    gap: 8px;
    margin-bottom: 24px;
}
```

Grid organiza os três filhos diretos: label, input e button. Sem uma definição
de colunas, o posicionamento automático desta grade os dispõe em uma coluna,
um por linha. Gap separa as caixas internas com 8px; margin-bottom reserva
24px fora do formulário, abaixo dele, antes da grade de produtos.

Esse é o mesmo modelo de espaçamento já estudado: gap organiza o conjunto e
margin separa a caixa de seu próximo conteúdo.

## Seleção dos controles

```css
.busca input,
.busca button {
    font: inherit;
    padding: 8px;
}
```

O espaço em .busca input significa selecionar inputs que estejam dentro de
um elemento com classe busca, em qualquer nível de descendência. A mesma
relação vale para .busca button. No HTML atual, ambos são filhos diretos do form.

A vírgula separa os dois seletores e compartilha o bloco de declarações.
O bloco vale para os inputs dentro de busca e também para os botões dentro
de busca. A quebra de linha depois da vírgula facilita a leitura.

| Declaração | Efeito |
| --- | --- |
| `font: inherit;` | Faz cada controle usar a configuração de fonte de seu elemento pai |
| `padding: 8px;` | Define espaço interno nos quatro lados do controle |

O formulário recebe a fonte pela árvore da página, a partir de body.
Font inherit aplica essa configuração explicitamente aos controles, que podem
ter fonte própria na apresentação padrão do navegador.

Referências primárias: [descendentes e agrupamento de seletores — W3C](https://www.w3.org/TR/CSS22/selector.html)
e [propriedade font — W3C](https://www.w3.org/TR/CSS22/fonts.html#font-shorthand).

## Verificação e atividade acompanhada

O assistente inspeciona o atributo e as regras, consulta HTML/CSS por HTTP e
compara os corpos aos arquivos locais. Resultados no [progresso](../progresso.md).
Isso demonstra entrega da alteração, sem observar renderização no navegador.

Recarregue a [vitrine](http://127.0.0.1:8001/vitrine.html). O esperado é ver
rótulo, campo e botão em linhas separadas, controles com fonte da página e
espaço interno, além de uma separação antes dos produtos. O envio continua
levando o nome à URL da própria página; os cartões continuam estáticos.

Atividade acompanhada opcional: localizar input e button no HTML e relacionar
cada um ao seu seletor no CSS, distinguindo o espaço da relação de descendência
da vírgula que agrupa os seletores. Não há resultado visual relatado pelo aluno
nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.17 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do exercício
opcional no navegador. Checkpoint publicado e conferido em
eeee2a43ee195877e680059d630be39ab2910205; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.18](08-18-primeiro-javascript.md): primeiro arquivo JavaScript da vitrine.
