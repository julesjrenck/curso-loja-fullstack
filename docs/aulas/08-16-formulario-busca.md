# Aula 8.16 — Primeiro formulário de busca da vitrine

Iniciada em 06/11/2026 após entendimento confirmado e relato geral "funcionou"
na [8.15](08-15-verificacao-vitrine-navegador.md). Checkpoint anterior publicado
e conferido em 44b3a867dbce18b51d5609f158b61c588764c44e;
HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Introduzir a estrutura de um formulário e seu envio nativo por GET. Teremos
um rótulo, um campo de busca e um botão. O navegador monta a query com o nome
do campo e o valor digitado e navega para o endereço indicado por action.

Esta etapa ensina a estrutura e o envio. Os cartões continuam escritos no
HTML; a filtragem será implementada quando estudarmos o consumo da API.

## Pequena alteração

Acrescentado em [src/vitrine.html](../../src/vitrine.html), depois da apresentação
e antes do grupo de produtos:

```html
<form action="vitrine.html" method="get">
    <label for="busca-nome">Nome do produto</label>
    <input type="search" id="busca-nome" name="nome">
    <button type="submit">Buscar</button>
</form>
```

Form agrupa os controles e configura o envio. Action é um endereço relativo:
vitrine.html, a própria página do laboratório. Method get envia os dados na
query da URL usando HTTP GET.

| Trecho | Papel |
| --- | --- |
| `label` | Texto que identifica o campo para o usuário |
| `for="busca-nome"` | Associa o rótulo ao input com esse id |
| `type="search"` | Define um campo de texto destinado à busca |
| `id="busca-nome"` | Identificador único do campo na página |
| `name="nome"` | Chave usada no envio do valor digitado |
| `type="submit"` | Faz o botão solicitar o envio do formulário |

O input é um elemento vazio, sem tag de fechamento. Form, label e button têm
fechamento explícito. Associar label ao campo dá a ele uma identificação
acessível e permite ativar o controle por seu rótulo.

Id conecta o campo ao rótulo. Name define a chave do dado enviado. O papel
de name lembra a chave que você lê em `$_GET['nome']` no PHP; nesta etapa o
destino é um arquivo HTML estático, sem processamento dessa query.

## Entrada e saída esperadas

Ao digitar Camiseta e acionar Buscar, o navegador deve solicitar:

```text
GET /vitrine.html?nome=Camiseta
```

O valor digitado é o valor enviado; nome é a chave. O servidor do laboratório
entrega novamente o HTML da vitrine, que contém os dois cartões de demonstração.
Assim, a URL passa a transportar o dado, enquanto os produtos ainda são os
textos do arquivo. Não atribuir filtragem à presença do formulário.

A folha [vitrine.css](../../src/vitrine.css) continua sendo carregada pelo link
no head. O formulário usa a apresentação padrão dos controles do navegador;
a próxima etapa cuidará de seus estilos e espaçamento.

Referências primárias: [formulários e rótulos — HTML Standard](https://html.spec.whatwg.org/multipage/forms.html)
e [atributos e envio de formulários — HTML Standard](https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#attr-fs-method).

## Verificação e atividade acompanhada

O assistente confere markup, associação for/id e nomes dos campos; consulta
por HTTP a página com e sem nome=Camiseta, comparando os corpos ao arquivo
local. Resultados no [progresso](../progresso.md). Essa consulta manual não
aciona o formulário em um navegador nem observa interação com o label.

Atividade acompanhada opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html),
clicar no rótulo, digitar Camiseta e acionar Buscar. Observar nome=Camiseta na
URL e a permanência dos dois cartões estáticos. Essas são expectativas;
nenhum resultado do navegador foi relatado para esta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.16 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado do exercício
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após checkpoint: 8.17 — estilização do formulário
de busca. Não iniciada.
