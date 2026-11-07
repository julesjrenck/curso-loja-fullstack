# Aula 8.23 — Conversão do termo para minúsculas com toLowerCase

Iniciada em 06/11/2026 após confirmação da [8.22](08-22-termo-busca-trim.md)
com "entendi". Checkpoint anterior publicado e conferido em
55b36cfb54425dee8b88bd636e6d0372193311fb; HEAD/origin/main/main remota iguais.

## Objetivo e conceito

Preparar o termo em minúsculas para as futuras comparações com os nomes dos
produtos. ToLowerCase é um método da string que retorna sua versão em minúsculas,
usando as regras padrão de conversão de caixa do Unicode. Vamos aplicá-lo ao
resultado de trim, dentro da função de submit.

## Alteração em src/vitrine.js

Somente a declaração de termoBusca muda:

```js
const termoBusca = campoNome.value.trim().toLowerCase();
```

Lemos a expressão da esquerda para a direita: campoNome.value fornece o texto
atual; trim() retorna o texto sem espaços nas extremidades; toLowerCase() recebe
como base essa string resultante e retorna sua versão em minúsculas. Atribuímos
o resultado final à constante termoBusca.

Esse uso de chamadas em sequência é um encadeamento de métodos. Cada chamada
opera sobre o resultado anterior. Os parênteses vazios indicam que nenhum
argumento é passado aos métodos. Trim retorna uma string, que também oferece
o método toLowerCase. O log existente continua usando termoBusca.

| Conteúdo do campo | Resultado em termoBusca |
| --- | --- |
| `"  CAMISETA  "` | `"camiseta"` |
| `"Camiseta"` | `"camiseta"` |
| `"  Camiseta AZUL  "` | `"camiseta azul"` |
| `"AÇÃO"` | `"ação"` |
| `"   "` | `""` |

As aspas apenas delimitam os exemplos. O método converte maiúsculas para
minúsculas; não remove acentos. No exemplo AÇÃO, o resultado é ação, e não acao.
O espaço entre palavras continua presente. Termo vazio continua vazio.

As strings são imutáveis. Nenhuma atribuição é feita a campoNome.value, então
o campo continua mostrando o conteúdo digitado. A transformação afeta o termo
guardado para uso no código. A leitura e as duas chamadas acontecem a cada submit.

Referência primária: [String.prototype.toLowerCase — ECMAScript](https://tc39.es/ecma262/multipage/text-processing.html#sec-string.prototype.tolowercase).

## Arquivos relacionados e verificação

Somente [src/vitrine.js](../../src/vitrine.js) muda na aplicação.
[src/vitrine.html](../../src/vitrine.html) fornece formulário e produtos;
[src/vitrine.css](../../src/vitrine.css) fornece a apresentação. Seleções, logs
iniciais e cancelamento do envio nativo permanecem. Os dois produtos continuam
estáticos. Quando compararmos nomes, também prepararemos o texto dos produtos
de forma compatível; essa comparação ainda não foi implementada.

Conferir encadeamento, uso do resultado no log, entrega HTTP do JS e igualdade
com o arquivo local. Resultados no [progresso](../progresso.md). Essas verificações
não executam o JavaScript nem o evento no navegador.

Atividade opcional: abrir a [vitrine](http://127.0.0.1:8001/vitrine.html), abrir
o Console do Chrome com Ctrl+Shift+J e recarregar. Enviar primeiro dois espaços,
CAMISETA e dois espaços; depois enviar Camiseta. Ambos devem registrar
Busca enviada: camiseta. O campo preserva a grafia digitada. Experimentar
Camiseta AZUL para observar minúsculas e preservação do espaço interno.
Resultados esperados; nenhuma execução observada ou relatada nesta etapa.

## Continuidade

Implementação e explicação apresentadas; entendimento da 8.23 confirmado com
"entendi" em 07/11/2026. Nenhuma dúvida nova ou relato separado da atividade
opcional no navegador. Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.24 — seleção dos produtos com
querySelectorAll. Não iniciada.
