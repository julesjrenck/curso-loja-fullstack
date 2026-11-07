# Aula 8.20 — Campo de busca e leitura de value

Iniciada em 06/11/2026 após confirmação da [8.19](08-19-dom-formulario.md)
com "entendi". Checkpoint anterior publicado e conferido em
d4b06563b2700fa5fb1b77faa69173828fb56611; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Localizar o campo dentro do formulário e ler o texto atual pela propriedade
value. A referência ao elemento e o texto contido nele são valores diferentes.
O elemento permite acessar propriedades, como seu conteúdo atual.

## Alteração em src/vitrine.js

Arquivo completo após esta etapa:

```js
console.log('JavaScript da vitrine carregado.');

const formularioBusca = document.querySelector('.busca');
const campoNome = formularioBusca.querySelector('#busca-nome');

console.log(formularioBusca);
console.log('Valor inicial da busca:', campoNome.value);
```

As linhas de seleção e registro do formulário vieram da aula anterior. Agora,
formularioBusca.querySelector procura entre os descendentes desse formulário.
A entrada '#busca-nome' é um seletor CSS de ID: # indica o atributo id.
O elemento correspondente em [src/vitrine.html](../../src/vitrine.html) é:

```html
<input type="search" id="busca-nome" name="nome">
```

Const campoNome guarda a referência ao input encontrado. O formulário e o campo
existem no HTML atual; se um seletor deixar de corresponder, querySelector retorna
null, e acessar métodos/propriedades desse resultado causará erro. A estrutura
é fixa nesta etapa; mudanças nesses atributos precisam manter o JS correspondente.

CampoNome.value acessa a propriedade value do input e lê uma string. Para esse
campo de busca, ela contém o texto atual. O ponto acessa a propriedade; não há
parênteses, pois estamos lendo um valor, não chamando um método.

Na chamada console.log, a vírgula separa dois argumentos: o texto de identificação
e o valor lido. Ao abrir a página com o campo vazio, a saída esperada é o rótulo
Valor inicial da busca: seguido de uma string vazia, de comprimento zero.
String vazia não é null. Um valor restaurado ou preenchido pelo navegador pode
alterar o conteúdo inicial; o código lê o que estiver no campo naquele momento.

Referências primárias: [querySelector — DOM Standard](https://dom.spec.whatwg.org/#dom-parentnode-queryselector)
e [value do input — HTML Standard](https://html.spec.whatwg.org/multipage/input.html#dom-input-value).

## Momento da leitura

O arquivo executa ao carregar a página. Digitar depois disso muda o conteúdo
do campo, mas não executa novamente o console.log. Uma nova leitura de value
retorna o texto atualizado; o registro anterior no Console permanece com o
valor que foi lido naquela chamada.

O ID identifica o elemento para a seleção. O name="nome" define o nome usado
no envio GET nativo, como ?nome=Camiseta. Uma consulta presente na URL não
preenche automaticamente o input deste HTML estático. A propriedade value
permite ao JavaScript ler o conteúdo atual do controle.

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação. O HTML fornece
os elementos; [src/vitrine.css](../../src/vitrine.css) cuida dos estilos. O envio
GET permanece como antes, e os dois produtos continuam estáticos.

## Verificação e atividade acompanhada

Conferir seletores e estrutura HTML, entrega HTTP e igualdade da resposta com
o arquivo local. Resultados no [progresso](../progresso.md). Essas verificações
não demonstram execução em um navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e observar o registro inicial. Depois,
digitar Camiseta no campo sem enviar o formulário. No Console, executar:

```js
document.querySelector('#busca-nome').value
```

O resultado esperado é a string Camiseta. Essa expressão faz uma nova leitura
após a digitação. Ela repete a seleção pelo document porque as constantes
declaradas no módulo não ficam disponíveis como variáveis globais do Console.
Não recarregar ou clicar Buscar entre digitar e executar essa expressão.
Nenhuma execução desta atividade foi observada ou relatada na implementação.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.20 confirmado com
"entendi" em 06/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no Console. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.21 — evento submit e
preventDefault no formulário de busca. Não iniciada.
