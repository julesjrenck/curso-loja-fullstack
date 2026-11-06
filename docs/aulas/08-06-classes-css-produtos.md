# Aula 8.6 — Classes CSS para os produtos

Iniciada em 06/11/2026 após confirmação da [8.5](08-05-modelo-caixa-espacamentos.md)
com "entendi". Checkpoint anterior publicado e conferido em
25e8a781565bfd1cdcee93fad9fb2589216cfb0b; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Identificar os produtos por uma classe HTML e selecionar essa classe no CSS.
Uma classe funciona como um rótulo reutilizável; o nome produto foi escolhido
por nós para os artigos do catálogo. A regra CSS associada define sua aparência.

A palavra classe tem outro uso no PHP, em que definimos tipos de objetos.
Aqui, o atributo class do HTML permite identificar elementos para seleção,
incluindo a seleção por CSS que estamos estudando.

## HTML e CSS juntos

Em [src/vitrine.html](../../src/vitrine.html), os dois produtos receberam a
mesma classe. Exemplo da Camiseta:

```html
<article class="produto">
    <h2>Camiseta</h2>
    <p>Preço: R$ 49,90</p>
</article>
```

O artigo da Caneca também recebeu `class="produto"`. A classe pode ser
compartilhada por vários elementos. Article continua identificando o conteúdo
do produto; o atributo acrescenta um rótulo a esse elemento.

Em [src/vitrine.css](../../src/vitrine.css), o seletor foi trocado:

```css
.produto {
    margin-bottom: 16px;
    padding: 16px;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
}
```

O ponto indica um seletor de classe. No HTML escrevemos `class="produto"`;
no CSS escrevemos `.produto`. O ponto faz parte da sintaxe do seletor.
As quatro declarações são as mesmas estudadas na 8.5.

| Seletor | Como encontra elementos |
| --- | --- |
| `article` | Pelo nome da tag |
| `.produto` | Pela classe produto, seja qual for a tag |

Os dois artigos continuam correspondendo à regra. A aparência esperada é a
mesma da 8.5; o conceito novo é como selecionamos os elementos. Outros artigos
que venham a existir receberão esse conjunto de estilos quando tiverem a
classe produto. A regra body da 8.4 continua definindo fonte e cores da página.

Referência primária: [seletores de classe — W3C](https://www.w3.org/TR/selectors-4/#class-html).

## Verificação e atividade acompanhada

O assistente confere as duas ocorrências de class produto, o seletor .produto
e o diff das declarações. Consulta HTML e CSS por HTTP e compara os corpos aos
arquivos locais; resultados no [progresso](../progresso.md). Isso não constitui
observação direta da renderização ou cálculo dos estilos em navegador.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html). A aparência
deve continuar com os dois cartões brancos, borda e espaçamento. Atividade
acompanhada: localizar produto no atributo class e o ponto antes do nome no CSS.
O aluno ainda não relatou resultado visual desta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.6 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
ce3730b4e44627a9e0d78a2363c99bbbc6cc3841; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.7](08-07-largura-centralizacao.md): largura máxima e centralização do
conteúdo principal.
