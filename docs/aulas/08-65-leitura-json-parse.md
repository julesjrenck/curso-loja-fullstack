# Aula 8.65 — Leitura do texto JSON com JSON.parse

Iniciada em 07/11/2026 após confirmação da 8.64 com "entendi". Atividade
opcional anterior no navegador sem relato. Checkpoint anterior publicado em
136ef17a3f2c2032765bce9af4808505da701209; HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Interpretar o texto JSON para voltar a trabalhar com os dados como valores
JavaScript. Em [vitrine.js](../../src/vitrine.js), depois do registro do texto,
acrescentamos:

```js
const produtosLidos = JSON.parse(produtosJson);

console.log('Produtos lidos do JSON:', produtosLidos);
console.log('Primeiro produto lido:', produtosLidos[0].nome);
```

## Entrada e resultado

JSON.parse(...) chama o método parse do objeto JSON fornecido pelo JavaScript.
O argumento produtosJson contém a string criada por JSON.stringify na 8.64:

```json
[{"nome":"Camiseta","preco":4990},{"nome":"Caneca","preco":2990}]
```

parse interpreta esse texto JSON. Como ele representa uma lista com objetos,
o resultado neste exemplo é um Array JavaScript com dois objetos. Os nomes
voltam a ser valores string e os preços voltam a ser valores Number nas
propriedades dos objetos. A convenção de centavos continua a mesma.

O valor devolvido depende do conteúdo do JSON: aqui usamos uma lista de produtos.
O método recebe texto em sintaxe JSON válida; o nosso foi produzido pelo próprio
stringify a partir dos dados conhecidos. Não precisamos importar JSON ou instalar
pacote. Em PHP, interpretar JSON lembra a intenção de json_decode($texto).

## As três representações no arquivo

| Variável | Conteúdo nesta etapa |
| --- | --- |
| produtosExemplo | Array original com os objetos de demonstração |
| produtosJson | String JSON produzida por stringify |
| produtosLidos | Novo array de objetos construído por parse a partir do texto |

Para estes dados, produtosLidos contém os mesmos nomes/preços representados
no texto. Ele tem novos objetos; não recupera as referências dos objetos
originais. A string e o array original permanecem em suas variáveis.
O texto representa dados, não as referências que existiam antes da serialização.

Isso completa este percurso de demonstração: array de objetos → texto JSON
com stringify → array de objetos lidos com parse. Nas próximas aulas usaremos
JSON vindo de um recurso servido por HTTP.

## Leitura do produto reconstruído

O primeiro console.log registra o array completo. No segundo,
produtosLidos[0] seleciona seu primeiro objeto e .nome obtém a propriedade.
Esperamos a string 'Camiseta'. Usamos o mesmo acesso por índice/ponto da 8.61,
agora sobre o resultado da leitura do JSON.

Referência primária: [JSON.parse na especificação ECMAScript](https://tc39.es/ecma262/multipage/structured-data.html#sec-json.parse),
já consultada junto ao formato JSON na 8.64.

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua com cartões estáticos e carregando
vitrine.js como módulo. Import de prepararTexto de [textos.js](../../src/textos.js),
dados anteriores, formulário, filtro e funções async preservados.
[vitrine.css](../../src/vitrine.css) mantém o layout. A conversão usa uma string
local e registra o resultado no Console; ainda não buscamos ou enviamos JSON
pela rede, nem usamos produtosLidos na busca dos cartões. Nenhuma dependência,
container ou alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com Console
aberto, filtro vazio e Info visível. Depois do texto "Produtos em JSON:",
esperamos "Produtos lidos do JSON:" com array expansível e os objetos
Camiseta/4990 e Caneca/2990 nessa ordem. Depois, esperamos:

```text
Primeiro produto lido: Camiseta
```

Os registros posteriores e a exibição async continuam depois. Compare a string
e o array lido e identifique qual permite trabalhar com objetos de produtos.
Não é preciso alterar código para responder. Informe diferenças ou erros.
Resultados esperados, sem observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 3066 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente JSON.parse e dois registros,
com HTML/CSS/textos.js preservados. Links locais conferidos. Isso demonstra
entrega; execução da leitura do JSON no navegador sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint publicado e conferido em 018905e57e3129e89e030facd21e5072eb0017fe;
HEAD/origin/main/main remota iguais. Registro posterior à publicação.
Continuidade na [8.66 — arquivo JSON local de produtos](08-66-arquivo-json-produtos.md).
