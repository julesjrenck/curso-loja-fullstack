# Aula 8.26 — Leitura do nome de cada produto com textContent

Iniciada em 07/11/2026 após confirmação da [8.25](08-25-percorrer-produtos.md)
com "entendi". Checkpoint anterior publicado e conferido em
d64dfa9204f72052aae2193057924e01ab2a3c1b; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Obter o nome como string a partir do título de cada cartão. Já temos a referência
ao article atual no parâmetro produto; agora selecionaremos seu h2 e leremos a
propriedade textContent. Ela fornece o conteúdo textual do elemento e de seus
descendentes, sem incluir as marcações das tags.

## Alteração em src/vitrine.js

O trecho interno do tratamento de submit passa a ser:

```js
produtos.forEach(function (produto) {
    const nomeProduto = produto.querySelector('h2').textContent;

    console.log(nomeProduto);
});
```

Produto é o article recebido nessa chamada do forEach. Produto.querySelector('h2')
procura o primeiro h2 dentro desse cartão. A string 'h2' é um seletor pelo nome
da tag, sem ponto de classe ou # de ID. Como a busca começa no produto atual,
cada passagem acessa seu próprio título, em vez de buscar o primeiro h2 da página.

Depois da chamada querySelector, .textContent lê a propriedade do elemento
encontrado. Não há parênteses após textContent: estamos lendo uma propriedade,
assim como fizemos com value no input. O resultado é atribuído a nomeProduto,
uma constante local criada em cada chamada da função interna.

Os cartões em [src/vitrine.html](../../src/vitrine.html) contêm:

```html
<h2>Camiseta</h2>
```

e, no segundo cartão:

```html
<h2>Caneca</h2>
```

Assim, os registros esperados agora são as strings Camiseta e Caneca, nessa
ordem. Antes registrávamos os objetos article. O nome vem do h2; o preço está
em outro elemento, um p, e não entra nessa leitura. Ler textContent do article
inteiro incluiria também o texto do preço e os espaços/quebras entre elementos.

TextContent não remove espaços nem converte letras para minúsculas. Também
não depende do elemento estar visível por CSS. Aqui apenas lemos a propriedade;
não atribuímos valor a ela, então os títulos da página permanecem iguais.
Cada cartão atual possui um h2. Se esse título for removido, querySelector
retornará null e acessar textContent desse resultado causará erro; a estrutura
do HTML e a seleção precisam permanecer compatíveis.

Referência primária: [textContent — DOM Standard](https://dom.spec.whatwg.org/#dom-node-textcontent).

## Relação com as etapas anteriores e verificação

A cada submit, a função externa continua cancelando o envio GET, preparando
termoBusca com trim().toLowerCase() e registrando esse termo. Depois, forEach
percorre os dois cartões, lê seus nomes e registra cada string. Os nomes ainda
mantêm as maiúsculas do HTML; ainda não há comparação ou filtragem.

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. HTML fornece
os títulos e carrega o módulo; [src/vitrine.css](../../src/vitrine.css) mantém
a apresentação. Conferir h2 de cada cartão, seleção local, leitura da propriedade,
uso do resultado no log, entrega HTTP e igualdade com o arquivo local.
Resultados no [progresso](../progresso.md). Essas verificações não executam DOM.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Enviar CAMISETA: esperamos
Busca enviada: camiseta, seguido de Camiseta e Caneca como textos. Enviar Caneca
repete os dois nomes, porque o filtro ainda não existe. Resultados esperados;
nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.26 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.27 — comparação do nome com
termoBusca usando includes. Não iniciada.
