# Aula 6.68 — Exemplo 404 da consulta individual no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.67 com "entendi" e publicação em f92bad8709a5a31d64ac42cd1d0384544b521666.
Entendimento da 6.68 confirmado com "entendi" em 01/11/2026; publicação
verificada em cde635101da1d72a2b76f9e12796a6d98cf0d07f, referências local e remotas coincidentes.

## Um caso concreto de erro

Em [openapi.json](../api/openapi.json), acrescentamos example ao lado de schema
em 404/content/application~1json de GET /api/v1/produtos/{id}:

```json
{
  "message": "Produto não encontrado."
}
```

Esse corpo representa o 404 tratado por ProdutoController::show: produto
inexistente, inativo ou ID fora da faixa de inteiros. Conferimos a frase no
controller e nos testes existentes de inexistente/inativo.

O schema continua exigindo um objeto com message obrigatório e do tipo string.
Example mostra valores de um caso possível; const fixaria um valor permitido
e enum restringiria os valores a uma lista. Esses dois limites não foram
acrescentados: a descrição mantém a variação de texto nos erros de roteamento.

O exemplo fica na documentação, ao lado das regras, e não muda a resposta
real do Laravel. O status 404 é informado pela resposta HTTP; o corpo contém
a mensagem de erro. Os schemas e o exemplo 200 individual foram preservados.

## Validação executada

Mesma imagem e [redocly.yaml](../api/redocly.yaml), com a regra
no-invalid-media-type-examples configurada como erro. Executado na raiz:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

O container é removido ao terminar (--rm) e executa sem rede (--network none).
O volume monta docs/api somente para leitura em /spec; workdir define a pasta
de execução. Lint recebe o documento e a configuração.

Resultado: código 0, sem erros ou avisos, incluindo a comparação do novo
exemplo com o schema 404. Os controles negativos da 6.66 não foram repetidos.
A limitação observada na 6.64 continua registrada; id path mantém required true
no arquivo do projeto.

Git diff --check e links locais conferidos. Só example de 404 individual foi
acrescentado. Sem novas dependências, código de produção alterado, captura
HTTP, SQL ou nova suíte Laravel; última suíte na 6.49: 66 testes/620 asserções.
Validar o exemplo escrito não comprova conformidade das respostas reais.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em cde635101da1d72a2b76f9e12796a6d98cf0d07f.
Continuidade na [aula 06-69](06-69-plano-validacao-respostas.md).
