# Aula 6.67 — Exemplo 200 da consulta individual no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.66 com "entendi" e publicação em a9e7c41fb4fc0a24c8b461e5f891c8773058c2b5.
Entendimento da 6.67 confirmado com "entendi" em 01/11/2026; publicação
verificada em f92bad8709a5a31d64ac42cd1d0384544b521666, referências local e remotas coincidentes.

## Valores ao lado das regras

Em [openapi.json](../api/openapi.json), acrescentamos example ao lado de schema
em 200/content/application~1json de GET /api/v1/produtos/{id}:

```json
{
  "data": {
    "id": 1,
    "nome": "Camiseta",
    "preco_em_centavos": 4990
  }
}
```

O schema continua definindo as regras. Example oferece valores concretos para
mostrar um corpo possível. Ele pertence à documentação: a resposta JSON tem
data como objeto e os três campos do produto dentro dele.

Esse corpo ilustra uma consulta bem-sucedida a /api/v1/produtos/1, caso exista
um produto ativo com esses dados. Id e preco_em_centavos são inteiros; nome
é texto. O preço 4990 centavos representa R$ 49,90.

O schema de data referencia Produto, que exige os três campos e seus tipos.
Conferimos o exemplo com essa definição e com o teste existente de consulta
por ID. O ID fixo é ilustrativo, não um default. O arquivo não cadastra
produtos nem garante que o ID 1 esteja disponível no banco atual.

O exemplo agora permanece no documento OpenAPI; na 6.65, os exemplos dessa
operação estavam somente nas cópias temporárias e na explicação da aula.
Schemas, listagem, parâmetro id e resposta 404 foram preservados.

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
O volume monta docs/api somente para leitura em /spec; workdir define essa
pasta como local de execução. Lint recebe o documento e a configuração.

Resultado: código 0, sem erros ou avisos, incluindo validação dos valores do
novo exemplo contra o schema de 200 e a referência a Produto. Os controles
negativos anteriores estão registrados nas aulas 6.65 e 6.66; não foram
repetidos nesta etapa. A limitação de required false da 6.64 permanece nos
registros; id path continua required true no documento do projeto.

Git diff --check e links locais conferidos. Só example de 200 individual foi
acrescentado. Sem novas dependências, código de produção alterado, captura
HTTP, SQL ou nova suíte Laravel; última suíte na 6.49: 66 testes/620 asserções.
Validar o exemplo escrito não comprova conformidade de respostas reais.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em f92bad8709a5a31d64ac42cd1d0384544b521666.
Continuidade na [aula 06-68](06-68-exemplo-404-consulta-openapi.md).
