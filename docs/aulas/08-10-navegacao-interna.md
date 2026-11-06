# Aula 8.10 — Navegação interna para o catálogo

Iniciada em 06/11/2026 após confirmação da [8.9](08-09-classe-container.md)
com "entendi". Checkpoint anterior publicado e conferido em
17bd4eefe4767f72bca279fad936a1c91940b4f6; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Criar um link no cabeçalho para chegar ao catálogo na própria página. Um
fragmento de URL, escrito depois de #, identifica o destino dentro do documento.
Usaremos o id catalogo como esse destino.

## Pequena alteração

Somente [src/vitrine.html](../../src/vitrine.html) foi alterado na aplicação.
Dentro do header, depois do nome da loja:

```html
<nav>
    <a href="#catalogo">Catálogo</a>
</nav>
```

Nav identifica uma região de navegação. O elemento a com href cria um link;
o texto Catálogo informa seu destino. Em href, #catalogo aponta para o
elemento com id catalogo no documento atual.

O início de main passou a ser:

```html
<main id="catalogo" class="container">
```

O atributo id identifica esse elemento. Seu valor deve ser único no documento.
A classe container continua compartilhando o estilo com header e footer.

| Atributo/trecho | Papel nesta página |
| --- | --- |
| `class="container"` | Classe reutilizável nas três regiões |
| `id="catalogo"` | Identificador único do conteúdo principal |
| `href="#catalogo"` | Link para o elemento identificado |

O # pertence à sintaxe do fragmento no href. No valor do atributo id,
escrevemos somente catalogo. O navegador usa essa relação para navegar até
o destino. A URL deve terminar em /vitrine.html#catalogo após ativar o link.

O fragmento é tratado no navegador e não integra o caminho enviado ao servidor
HTTP. Nesta navegação dentro do documento já carregado, não criamos rota no
backend nem usamos JavaScript. O CSS continua sendo carregado pelo mesmo link
no head; sua folha não foi alterada nesta etapa.

Referências primárias: [atributo id — HTML Standard](https://html.spec.whatwg.org/multipage/dom.html#the-id-attribute),
[nav — HTML Standard](https://html.spec.whatwg.org/multipage/sections.html#the-nav-element)
e [fragmentos de URI — RFC 3986, seção 3.5](https://www.rfc-editor.org/rfc/rfc3986#section-3.5).

## Verificação e atividade acompanhada

O assistente confere um único id catalogo e seu link, consulta o HTML por HTTP
e compara o corpo ao arquivo local. Resultados no [progresso](../progresso.md).
Isso demonstra a entrega da marcação; a ativação por clique/teclado e a navegação
no navegador do aluno ainda não foram observadas ou relatadas.

Abra a [vitrine local](http://127.0.0.1:8001/vitrine.html), encontre o link
Catálogo e ative-o. Confira #catalogo na URL. Pode haver pouca ou nenhuma
rolagem visível se o destino já estiver na tela ou a página for curta.

Como alternativa, use Tab até selecionar o link e Enter para ativá-lo. Links
nativos com href participam da navegação por teclado. Nenhum resultado dessas
ações foi atribuído ao aluno antes de seu relato.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.10 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do navegador.
Checkpoint publicado e conferido em
f0dda5dd299b336e420e483cb7d62c2b520ba1e5; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.11](08-11-flexbox-cabecalho.md): primeiro Flexbox no cabeçalho.
