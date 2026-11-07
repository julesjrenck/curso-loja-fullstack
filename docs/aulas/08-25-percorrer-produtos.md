# Aula 8.25 — Percorrer os produtos com forEach

Iniciada em 07/11/2026 após confirmação da [8.24](08-24-selecao-produtos.md)
com "entendi". Checkpoint anterior publicado e conferido em
ab68117e4754a109a87983371f8bef6e3f1e44e0; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Executar uma operação para cada elemento da coleção de produtos. A NodeList
obtida na aula anterior oferece o método forEach. Ele recebe uma função e
a chama para cada item, passando o item atual como primeiro argumento.
Vamos percorrer a coleção quando o formulário for enviado.

## Alteração em src/vitrine.js

Acrescentado depois do log de termoBusca, dentro do tratamento do submit:

```js
produtos.forEach(function (produto) {
    console.log(produto);
});
```

Produtos é a NodeList criada por document.querySelectorAll('.produto').
ForEach é um método dessa coleção. Function (produto) { ... } cria a função
passada ao método. O parâmetro produto recebe a referência ao article atual.
O nome do parâmetro é escolhido por nós; o método fornece o valor a cada chamada.

No HTML atual, a função será chamada primeiro com o article da Camiseta e depois
com o article da Caneca, na ordem da coleção. Não precisamos escrever duas
chamadas de console.log para tratar esses dois elementos. Com uma coleção
vazia, o corpo não seria executado para nenhum item.

Como comparação com PHP, a intenção de percorrer os elementos é semelhante a:

```php
foreach ($produtos as $produto) {
    // Trabalhar com o item atual.
}
```

O trecho PHP é apenas uma comparação de fluxo, não código executado no projeto.
No JavaScript usado aqui, forEach é um método que recebe uma função; não é a
mesma sintaxe da estrutura foreach do PHP.

## Duas funções e seus momentos de execução

O trecho completo do tratamento agora é:

```js
formularioBusca.addEventListener('submit', function (evento) {
    evento.preventDefault();

    const termoBusca = campoNome.value.trim().toLowerCase();

    console.log('Busca enviada:', termoBusca);

    produtos.forEach(function (produto) {
        console.log(produto);
    });
});
```

A função externa é registrada no carregamento e chamada a cada submit. Dentro
dela, preparamos o termo, registramos esse termo e chamamos forEach. A função
interna é chamada pelo forEach imediatamente para cada item; ela não espera
outro evento. As chamadas ocorrem uma após a outra neste código.

O parâmetro evento pertence à função externa; produto pertence à interna.
Produtos, no plural, é a coleção; produto, no singular, é um elemento por vez.
Cada console.log(produto) recebe o objeto article, não seu nome como string.
Ainda não lemos o texto do h2 nem comparamos com termoBusca.

As chaves e os fechamentos }); seguem a indentação: o fechamento mais interno
encerra a função/chamada de forEach; o último encerra a função/chamada de
addEventListener. A indentação ajuda a visualizar qual bloco contém cada linha.

Referências primárias: [NodeList — DOM Standard](https://dom.spec.whatwg.org/#interface-nodelist)
e [métodos de coleções iteráveis — Web IDL](https://webidl.spec.whatwg.org/#es-iterable).
O padrão Web IDL define forEach da coleção com o comportamento de chamada
usado por Array.prototype.forEach; isso não converte a NodeList em um Array.

## Arquivos relacionados e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação.
[src/vitrine.html](../../src/vitrine.html) fornece os dois article selecionados;
[src/vitrine.css](../../src/vitrine.css) mantém os estilos. Seleção, logs iniciais,
preparo do termo e cancelamento do envio GET permanecem. Os produtos continuam
visíveis; nenhuma filtragem ou chamada à API foi introduzida.

Conferir posicionamento do forEach dentro do submit, parâmetro e log, entrega
HTTP e igualdade com o arquivo local. Resultados no [progresso](../progresso.md).
Essas verificações não executam callbacks ou DOM no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Enviar CAMISETA: esperamos
Busca enviada: camiseta seguido de dois registros de article, Camiseta e Caneca.
Enviar Caneca: esperamos novo grupo com termo caneca e os mesmos dois cartões.
Ambos aparecem porque ainda não há comparação ou filtro. Resultados esperados;
nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.25 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.26 — leitura do nome de cada
produto com textContent. Não iniciada.
