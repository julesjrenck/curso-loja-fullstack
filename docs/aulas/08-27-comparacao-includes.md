# Aula 8.27 — Comparação do nome com termoBusca usando includes

Iniciada em 07/11/2026 após confirmação da [8.26](08-26-nome-produto-textcontent.md)
com "entendi". Checkpoint anterior publicado e conferido em
7fe544c83195f276ddf3868ba235f2740e92537a; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Verificar se o nome de cada produto contém o termo buscado. Includes é um
método da string que procura um trecho e retorna um booleano: true, verdadeiro,
ou false, falso. Esse resultado será usado para controlar a visibilidade em
outra etapa; por enquanto será registrado no Console.

## Alteração em src/vitrine.js

O corpo do forEach passa a ser:

```js
produtos.forEach(function (produto) {
    const nomeProduto = produto.querySelector('h2').textContent.trim().toLowerCase();
    const corresponde = nomeProduto.includes(termoBusca);

    console.log(nomeProduto, corresponde);
});
```

A leitura de textContent foi apresentada na aula anterior. Agora reaplicamos
trim().toLowerCase() ao nome. Includes diferencia maiúsculas de minúsculas;
preparar os dois textos da mesma forma permite que CAMISETA na busca corresponda
ao título Camiseta. Isso não remove acentos nem espaços entre palavras.
O título exibido permanece igual, pois apenas transformamos o texto lido.

NomeProduto.includes(termoBusca) procura o conteúdo da variável termoBusca
dentro da string nomeProduto. As aspas não aparecem ao redor de termoBusca
porque usamos seu valor. A direção importa: o nome completo contém o trecho
buscado. A operação não exige igualdade entre as strings nem palavras completas.

Const corresponde guarda o booleano retornado. True/false são valores lógicos,
sem aspas; não são os textos 'true'/'false'. Console.log recebe nomeProduto e
corresponde como dois argumentos, para identificar cada resultado.

Com os nomes atuais, esperamos:

| Entrada no campo | termoBusca | camiseta | caneca |
| --- | --- | --- | --- |
| `CAMISETA` | `camiseta` | true | false |
| `  CAN  ` | `can` | false | true |
| `ca` | `ca` | true | true |
| `sapato` | `sapato` | false | false |
| somente espaços | string vazia | true | true |

Ca está no início de camiseta e caneca. Includes também encontra trechos no
meio ou no fim. A string vazia é considerada contida em qualquer string; por
isso uma busca vazia gera true para os dois produtos. Não precisamos adicionar
uma condição especial para esse caso nesta comparação.

Na intenção, esta verificação é semelhante a str_contains($nome, $termo) em PHP:
perguntar se um texto contém outro. Aqui chamamos um método sobre a string.
Os produtos ainda aparecem todos na página, independentemente do booleano.

Referência primária: [String.prototype.includes — ECMAScript](https://tc39.es/ecma262/multipage/text-processing.html#sec-string.prototype.includes).

## Relação entre as funções e verificação

A função de submit prepara termoBusca e chama forEach. A função interna acessa
esse termo da função externa e, a cada produto, prepara nomeProduto e calcula
corresponde. As constantes nomeProduto/corresponde pertencem à chamada atual
da função interna. Uma nova busca repete o cálculo com o novo termo.

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação.
[src/vitrine.html](../../src/vitrine.html) mantém nomes e produtos;
[src/vitrine.css](../../src/vitrine.css) mantém estilos. Seleções, logs iniciais
e preventDefault permanecem; nenhuma alteração de visibilidade ou API.

Conferir preparo dos dois textos, ordem de includes, uso do booleano no log,
entrega HTTP e igualdade com o arquivo local. Resultados no
[progresso](../progresso.md). Essas verificações não executam o JavaScript.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J, recarregar e enviar as entradas da tabela.
Em cada envio, observar os dois registros nome/booleano. Todos os cartões
continuam visíveis. Resultados esperados, sem execução observada ou relatada
nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.27 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint publicado e conferido em
8adebc866764c1bfd361b3c92f50d92e6ebf004d; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.28](08-28-visibilidade-hidden.md): visibilidade dos produtos com hidden e negação lógica.
