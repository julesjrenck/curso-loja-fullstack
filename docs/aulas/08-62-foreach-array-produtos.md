# Aula 8.62 — ForEach no array de produtos

Iniciada em 07/11/2026 após confirmação da 8.61 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
f3a7bc6afc8e88fc31e7456eefcd8ad1827f2965; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Executar uma ação para cada produto do array, usando o mesmo callback.
Em [vitrine.js](../../src/vitrine.js), depois dos registros de índices e length,
acrescentamos:

```js
produtosExemplo.forEach((produto) => {
    console.log('Produto da lista:', produto.nome, produto.preco);
});
```

O array e os registros anteriores continuam como antes. Agora percorremos
seus elementos, além de ler posições específicas.

## Quem chama o callback

produtosExemplo.forEach(...) chama um método do array. Passamos a arrow
(produto) => { ... } como argumento; o método a chama para cada elemento
presente, em ordem crescente dos índices.

Neste array contínuo de dois elementos, o callback é chamado duas vezes:

| Chamada | Valor recebido no parâmetro produto | Leituras dentro do callback |
| --- | --- | --- |
| Primeira, índice 0 | Objeto da Camiseta | nome: 'Camiseta'; preco: 4990 |
| Segunda, índice 1 | Objeto da Caneca | nome: 'Caneca'; preco: 2990 |

produto é um parâmetro local da função. Não é o nome de uma propriedade
do array nem uma variável que precisa ser declarada antes. forEach fornece
o elemento como argumento a cada chamada. O método também fornece índice e
array, mas este callback declara e usa somente o primeiro parâmetro.

Dentro do callback, produto.nome e produto.preco leem os dados do objeto
recebido. console.log recebe três argumentos: prefixo, nome e preço. O preço
continua sendo um número em centavos. O corpo faz somente leitura e registro;
não modifica o array ou seus objetos.

Esse percurso dos dados locais é síncrono. Ele termina antes de o código seguir
para as declarações e registros posteriores. As funções async de mensagem
continuam separadas e são chamadas mais adiante no arquivo.

Em PHP, a intenção lembra foreach ($produtos as $produto). Aqui, a repetição
é feita pelo método forEach, que recebe e chama uma função para cada elemento.

Referência primária: [Array.prototype.forEach na especificação ECMAScript](https://tc39.es/ecma262/multipage/indexed-collections.html#sec-array.prototype.foreach).

## Relação com o forEach da busca

Já usamos produtos.forEach dentro de tratarBusca. A forma do callback é
parecida, mas as entradas são diferentes:

| Percurso | Estrutura percorrida | Parâmetro produto recebe |
| --- | --- | --- |
| produtosExemplo.forEach | Array de dados | Objeto com nome/preco |
| produtos.forEach na busca | NodeList dos cartões HTML | Elemento do DOM |

Por isso, no array lemos produto.nome; na busca existente, procuramos o h2
do cartão com produto.querySelector('h2'). Os dois parâmetros produto têm
escopos diferentes e não interferem um no outro.

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) contém os cartões e carrega vitrine.js como
módulo. Import de prepararTexto de [textos.js](../../src/textos.js), formulário,
filtro, dados anteriores e funções async preservados.
[vitrine.css](../../src/vitrine.css) mantém o layout. O novo percurso fica somente
no Console; a busca continua usando os cartões. Nenhuma API, persistência,
dependência ou container novo.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio e Info visível. Depois dos registros do array/índices/length,
esperamos estas duas linhas, nessa ordem:

```text
Produto da lista: Camiseta 4990
Produto da lista: Caneca 2990
```

Os registros posteriores e a exibição async já conhecidos continuam depois.
Como exercício acompanhado, identifique quantas vezes o callback executa e
qual objeto recebe na segunda chamada. Não é preciso alterar código para responder.
Informe diferenças ou erros. Saída esperada, sem observação direta ou relato.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2795 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente forEach com leitura/log dos
dados, com HTML/CSS/textos.js preservados. Links locais conferidos. Isso
demonstra entrega; execução do percurso no navegador sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em a3d8a0ec465cb58abb99b9cefc3f29544f9828c4;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.63 — verificação de objetos e arrays](08-63-verificacao-objetos-arrays.md).
