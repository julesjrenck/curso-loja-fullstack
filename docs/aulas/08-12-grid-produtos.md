# Aula 8.12 — Primeiro CSS Grid nos produtos

Iniciada em 06/11/2026 após confirmação da [8.11](08-11-flexbox-cabecalho.md)
com "entendi". Checkpoint anterior publicado e conferido em
2c3ee6369998abe54ebd45a4dce8bb0c4114564a; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Organizar os dois produtos em colunas. CSS Grid permite definir linhas e
colunas em uma caixa e posicionar seus itens nessa grade. O grupo de produtos
será o container da grade; cada artigo será um item.

## Agrupamento no HTML

Em [src/vitrine.html](../../src/vitrine.html), os artigos passaram a ficar
dentro de uma div com class produtos:

```html
<div class="produtos">
    <article class="produto">
        <h2>Camiseta</h2>
        <p>Preço: R$ 49,90</p>
    </article>

    <article class="produto">
        <h2>Caneca</h2>
        <p>Preço: R$ 29,90</p>
    </article>
</div>
```

Div é um agrupamento genérico, usado aqui para aplicar o layout ao conjunto.
Os artigos continuam identificando os produtos. O título h1 e a apresentação
ficam fora da div e mantêm sua posição acima dos cartões.

## Regra da grade

Acrescentada em [src/vitrine.css](../../src/vitrine.css):

```css
.produtos {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
```

| Declaração | Função |
| --- | --- |
| `display: grid;` | Faz o grupo organizar seus filhos diretos em uma grade |
| `grid-template-columns: 1fr 1fr;` | Define duas colunas, cada uma com uma fração do espaço disponível |
| `gap: 16px;` | Define o intervalo entre as colunas e entre eventuais linhas |

Fr representa uma fração do espaço disponível na grade. Com espaço suficiente
para o conteúdo dos cartões, as duas colunas recebem partes iguais depois de
descontar o gap. No limite de largura já estudado, a área de conteúdo de main
é 928px. Neste exemplo:

```text
(928px - 16px de gap) / 2 = 456px por coluna
```

Essa conta vem das declarações, sem medição de navegador. Nesta etapa a grade
tem duas colunas; na próxima estudaremos uma regra para mudar essa quantidade
conforme a largura da janela.

Removemos margin-bottom da regra .produto, pois o espaçamento entre os itens
passa a ser definido por gap no grupo. Padding, borda e fundo de cada cartão
continuam na regra individual.

| Classe | Responsabilidade |
| --- | --- |
| `.produtos` | Layout e espaçamento do conjunto |
| `.produto` | Aparência de cada cartão |

Referências primárias: [CSS Grid e a unidade fr — W3C](https://www.w3.org/TR/css-grid-1/#fr-unit)
e [elemento div — HTML Standard](https://html.spec.whatwg.org/multipage/grouping-content.html#the-div-element).

## Verificação e atividade acompanhada

O assistente inspeciona o grupo, os dois artigos e as regras; consulta HTML/CSS
por HTTP e compara os corpos aos arquivos locais. Resultados no
[progresso](../progresso.md). Não houve observação da renderização no navegador.

Recarregue a [vitrine local](http://127.0.0.1:8001/vitrine.html) em janela larga.
O esperado é Camiseta e Caneca lado a lado, com intervalo entre os cartões.
Nenhum resultado visual dessa etapa foi relatado pelo aluno.

Atividade acompanhada: localizar a div pai no HTML e distinguir a regra plural
.produtos da regra singular .produto.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.12 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
95da0d58200099689c4ed438435c5e57d8862e24; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.13](08-13-media-query-catalogo.md): responsividade do catálogo com media query.
