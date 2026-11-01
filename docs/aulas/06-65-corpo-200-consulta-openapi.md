# Aula 6.65 — Corpo 200 da consulta individual no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.64 com "entendi" e publicação em e1b025b318d6dc34f55e0d2d5b271ce1fa25e6b7.
Entendimento da 6.65 confirmado com "entendi" em 01/11/2026; publicação
verificada em 087430c1f2c1c8fe943a95f6fd0239fa527d16cf, referências local e remotas coincidentes.

## Objeto externo e produto

Em [openapi.json](../api/openapi.json), a resposta 200 de
GET /api/v1/produtos/{id} recebeu content com application/json. Dentro dele,
o schema do corpo ficou assim:

```json
{
  "type": "object",
  "required": [
    "data"
  ],
  "properties": {
    "data": {
      "$ref": "#/components/schemas/Produto"
    }
  }
}
```

Type object descreve o corpo externo. Required exige que data esteja presente.
Properties descreve essa propriedade; seu $ref aponta diretamente para o
schema Produto já existente em components.schemas.

Produto é object e exige id/nome/preco_em_centavos, com tipos integer/string/
integer. Essas regras são reutilizadas, sem copiar a definição dos três campos.
O preço continua em centavos.

| Operação | Como reutiliza Produto |
| --- | --- |
| Listagem | Data é array; cada item aponta para Produto |
| Consulta individual | Data aponta diretamente para Produto, que é object |

Um corpo ilustrativo compatível seria:

```json
{
  "data": {
    "id": 1,
    "nome": "Camiseta",
    "preco_em_centavos": 4990
  }
}
```

Esse exemplo serve à explicação e aos diagnósticos temporários. Não foi
acrescentado como example permanente da operação nesta etapa.

Conferimos por leitura ProdutoController::show, que retorna new ProdutoResource,
ProdutoResource::toArray, que seleciona os três campos, e o teste existente de
produto ativo pelo ID, que verifica o corpo com data objeto. A resposta 404,
a listagem e seus schemas/exemplos foram preservados.

## Validação executada

Mesma imagem e [redocly.yaml](../api/redocly.yaml) das etapas anteriores.
Executado na raiz do repositório:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

O container é removido ao terminar (--rm) e executa sem rede (--network none).
O volume monta docs/api somente para leitura em /spec, que é a pasta de
execução. Lint recebe documento e configuração. Resultado: código 0, sem
erros ou avisos; a referência a Produto foi resolvida.

Três cópias em /tmp/curso-665 receberam example somente temporário na resposta
200 individual. A pasta foi montada em /casos somente para leitura, usando
a mesma imagem/configuração e cada cópia como entrada:

| Corpo na cópia | Resultado observado |
| --- | --- |
| Data objeto com produto completo | Código 0 |
| Data array com o mesmo produto | Código 1: tipo object exigido |
| Objeto externo sem data | Código 1: propriedade data obrigatória |

As duas rejeições vieram de no-invalid-media-type-examples, com um erro por
execução. Nenhuma regra foi ignorada. Cópias fora do Git; documento do projeto
preservado após os diagnósticos.

O limite observado na 6.64 continua registrado: a ferramenta aceitou required
false para id path numa cópia. O arquivo do projeto mantém required true.

Diff e links locais conferidos. Nenhuma nova dependência ou código de produção
alterado; sem captura HTTP, SQL ou nova suíte Laravel. A última suíte executada
segue sendo a da 6.49: 66 testes e 620 asserções. Validar o documento e exemplos
temporários não comprova conformidade das respostas reais com o contrato.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em 087430c1f2c1c8fe943a95f6fd0239fa527d16cf.
Continuidade na [aula 06-66](06-66-corpo-404-consulta-openapi.md).
