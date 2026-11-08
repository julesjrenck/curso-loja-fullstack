# Aula 8.64 — Serialização dos produtos com JSON.stringify

Iniciada em 07/11/2026 após a 8.63, com entendimento e sucesso geral relatados
em "funcionou  e entendi", preservando o espaçamento original. Checkpoint anterior
publicado em ccbc0568a9d62d4b27d8b1d4563f7382ab36c34d;
HEAD/origin/main/main remota iguais.

## Objetivo e alteração

Converter o array de produtos em uma representação textual no formato JSON.
Essa conversão é chamada serialização em JSON e prepara o entendimento dos
dados trocados em requisições e respostas de APIs.

Em [vitrine.js](../../src/vitrine.js), depois do forEach dos dados, acrescentamos:

```js
const produtosJson = JSON.stringify(produtosExemplo);

console.log('Produtos em JSON:', produtosJson);
```

## Entrada, chamada e resultado

JSON é um objeto fornecido pelo JavaScript. stringify é um método dele:
os parênteses realizam a chamada, passando produtosExemplo como argumento.
Não precisamos importar JSON ou instalar pacote.

Neste exemplo, a entrada é o array com os objetos Camiseta/4990 e Caneca/2990.
O resultado é uma string contendo o texto JSON desse conjunto de dados.
produtoExemplo e produtosExemplo permanecem iguais; produtosJson recebe
outra representação dos dados, não um novo array.

| Variável | Conteúdo nesta etapa |
| --- | --- |
| produtosExemplo | Array JavaScript com dois objetos |
| produtosJson | String com a representação JSON desse array |

Em PHP, a intenção é semelhante a json_encode($produtos). Aqui, chamamos
JSON.stringify(produtosExemplo) e guardamos a string retornada.

## Como o texto representa os dados

Para os valores atuais, esperamos este texto JSON compacto:

```json
[{"nome":"Camiseta","preco":4990},{"nome":"Caneca","preco":2990}]
```

Os colchetes representam uma lista no texto JSON; as chaves representam cada
objeto. Os nomes das propriedades e os valores string usam aspas duplas.
Os preços aparecem como números, sem aspas, mantendo a convenção em centavos.
As vírgulas separam campos e elementos; os dois-pontos separam nome e valor.

O objeto literal JavaScript anterior permitia nome e preco sem aspas nas
chaves e usava aspas simples nos valores string. JSON.stringify produz a sintaxe
do formato JSON, apropriada para sua representação textual. Não copiamos a
sintaxe da declaração const nem as chamadas de função para dentro desse texto.

Mesmo que o conteúdo pareça uma lista de objetos, produtosJson é uma string.
Para trabalhar novamente com os produtos como array/objetos, precisaremos
interpretar o texto; essa será a próxima etapa, após entendimento desta conversão.

Referência primária: [JSON.stringify na especificação ECMAScript](https://tc39.es/ecma262/multipage/structured-data.html#sec-json.stringify).

## Arquivos e verificação

[vitrine.html](../../src/vitrine.html) continua contendo os cartões e carregando
vitrine.js como módulo. Import de prepararTexto de [textos.js](../../src/textos.js),
dados anteriores, formulário, filtro e funções async preservados.
[vitrine.css](../../src/vitrine.css) mantém o layout. O JSON é criado e registrado
somente no Console; ainda não é enviado à API ou salvo em arquivo/banco.
Nenhuma dependência, container ou alteração no backend.

Atividade opcional: recarregue http://localhost:8001/vitrine.html com o Console
aberto, filtro vazio e Info visível. Depois das duas linhas do forEach, esperamos
um registro "Produtos em JSON:" seguido pelo texto compacto mostrado acima.
Compare com "Produtos de exemplo:", que registra o array JavaScript.
Os registros posteriores e a exibição async continuam depois.

Como exercício acompanhado, identifique qual variável guarda o array e qual
guarda o texto. Não é preciso alterar código para responder. Informe diferenças
ou erros. Resultado esperado, sem observação direta ou relato desta etapa.

Verificação realizada: GET /vitrine.js retornou HTTP 200,
application/javascript e 2899 bytes; cmp confirmou corpo igual ao arquivo local.
git diff --check passou; diff confirmou somente conversão com JSON.stringify
e seu log, com HTML/CSS/textos.js preservados. Links locais conferidos. Isso
demonstra entrega; execução da serialização no navegador sem observação ou relato.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com "entendi"
em 07/11/2026. Atividade opcional no navegador sem relato ou observação direta.
Checkpoint concluído, publicação pendente conforme autorização permanente.
Próximo passo após publicação: 8.65 — leitura do texto JSON com JSON.parse.
8.65 não iniciada.
