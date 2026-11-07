# Aula 8.59 — Leitura de propriedades do produto com ponto

Iniciada em 07/11/2026 após confirmação da 8.58 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
cee5975e669168710d6d5086065e75d9adff87b2; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Obter um valor específico do objeto, em vez de registrar apenas o objeto inteiro.
Em [vitrine.js](../../src/vitrine.js), depois do registro de produtoExemplo,
acrescentamos duas linhas:

```js
console.log('Nome do produto:', produtoExemplo.nome);
console.log('Preço em centavos:', produtoExemplo.preco);
```

O objeto continua o mesmo:

```js
const produtoExemplo = {
    nome: 'Camiseta',
    preco: 4990,
};
```

## Acesso com ponto

Em produtoExemplo.nome, a parte antes do ponto identifica o objeto. A parte
depois do ponto identifica a propriedade que queremos ler. A expressão produz
o valor dessa propriedade, aqui a string 'Camiseta'.

produtoExemplo.preco produz o número 4990. Ele continua representando centavos:
R$ 49,90. Ler a propriedade não muda seu tipo ou formata o número como moeda.
Também não modifica o objeto; as duas linhas fazem somente leitura e registro.

| Expressão | Valor obtido | Tipo neste exemplo |
| --- | --- | --- |
| produtoExemplo.nome | 'Camiseta' | String |
| produtoExemplo.preco | 4990 | Number |

Não colocamos parênteses depois de nome ou preco: estamos lendo dados.
Já console.log(...) é uma chamada de função, que recebe o prefixo e o valor
lido como argumentos. A vírgula dentro dos parênteses separa esses argumentos.

Em PHP, acessar uma propriedade de objeto usaria ->, por exemplo $produto->nome.
Aqui usamos o ponto: produtoExemplo.nome. Para o array associativo PHP da
comparação anterior, o acesso seria $produto['nome']; são sintaxes de estruturas
diferentes.

As propriedades precisam usar o nome declarado: neste objeto escrevemos preco,
sem acento. O texto do prefixo do log pode usar "Preço" normalmente; ele é uma
string de apresentação, não o identificador da propriedade.

Referência primária: [Property Accessors na especificação ECMAScript](https://tc39.es/ecma262/multipage/ecmascript-language-expressions.html#sec-property-accessors).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua carregando vitrine.js como módulo
e contendo os dois cartões. O import de prepararTexto de
[textos.js](../../src/textos.js), o formulário, a busca e as funções async
permanecem iguais. [vitrine.css](../../src/vitrine.css) mantém o layout.
Os valores são lidos do objeto local de demonstração e escritos no Console;
a busca continua lendo os cartões do HTML. Nenhuma API, persistência, dependência
ou container novo.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio e Info visível. Depois do registro do objeto, esperamos:

```text
Nome do produto: Camiseta
Preço em centavos: 4990
```

Os registros posteriores e a exibição async já conhecidos continuam depois.
Compare o objeto inteiro com os dois valores individuais e identifique qual
propriedade cada expressão leu. Não é preciso alterar código para responder.
Informe diferenças ou erros. Saída esperada, sem observação direta ou relato.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2340 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente dois logs com leituras de
propriedades, com HTML/CSS/textos.js preservados. Links locais conferidos.
Isso demonstra entrega; execução das leituras no navegador sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.60 — array de produtos. Não iniciada.
