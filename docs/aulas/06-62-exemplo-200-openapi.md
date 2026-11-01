# Aula 6.62 — Exemplo completo da resposta 200 no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.61 com "entendi" e publicação em a7e7d42bbf9ddd10ec6dcabdaab21c3a944c5623.
Entendimento da 6.62 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Schema e exemplo

O schema descreve o formato permitido. O exemplo mostra valores concretos de
um corpo possível. Em [openapi.json](../api/openapi.json), acrescentamos example
em responses/200/content/application~1json, ao lado de schema. Não é propriedade
do corpo retornado pela API e não é um valor default.

Exemplo completo, sem filtro por nome, com um único produto:

```json
{
  "data": [
    {
      "id": 1,
      "nome": "Camiseta",
      "preco_em_centavos": 4990
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "last": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "per_page": 10,
    "total": 1,
    "last_page": 1,
    "from": 1,
    "to": 1,
    "path": "http://127.0.0.1:8002/api/v1/produtos",
    "links": [
      {"url": null, "label": "Anterior", "page": null, "active": false},
      {"url": "http://127.0.0.1:8002/api/v1/produtos?page=1", "label": "1", "page": 1, "active": true},
      {"url": null, "label": "Próximo", "page": null, "active": false}
    ]
  }
}
```

Data contém uma representação de Produto. Id e preço são inteiros; 4990
centavos representam R$ 49,90. Como só há uma página, first e last apontam
para ela, enquanto prev e next são null. Os campos continuam presentes.

Meta informa página atual 1, capacidade 10, total 1 e última página 1.
From/to indicam a posição 1. Per_page é capacidade, não quantidade de itens
recebidos. Path não inclui query. Meta.links reúne opções de navegação:
apenas a opção numérica atual está ativa; anterior/próxima não têm destino.
Os rótulos são ilustrativos, sem fixar a tradução da API.

Esses dados não foram capturados de uma requisição nem inseridos no banco.
A relação entre itens, totais, posições e URLs foi conferida por leitura;
os schemas atuais não impõem automaticamente toda essa coerência.

## Validar os valores do exemplo

Mantivemos a ferramenta da aula anterior e ampliamos
[redocly.yaml](../api/redocly.yaml):

```yaml
extends:
  - spec
rules:
  no-invalid-media-type-examples:
    severity: error
    allowAdditionalProperties: true
```

Spec continua verificando a conformidade do documento. Em rules, a regra
[no-invalid-media-type-examples](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples)
compara exemplos de corpos com seus schemas, com suporte a OpenAPI 3.2.
Severity error faz a execução falhar se encontrar um exemplo incompatível.

AllowAdditionalProperties true permite propriedades extras conforme a abertura
dos nossos schemas: não declaramos additionalProperties false. A opção não
dispensa campos obrigatórios nem permite tipos inválidos nos campos declarados.

Executado na raiz do repositório, com a mesma imagem fixada na 6.61:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

Run cria o container; --rm o remove ao terminar. --network none desativa sua
rede. O volume disponibiliza docs/api em /spec somente para leitura; workdir
define a pasta de execução. Lint recebe o documento e a configuração.
Resultado: código 0, sem erros ou avisos.

## Conferência das rejeições

Três cópias temporárias em /tmp/curso-662 foram montadas em /casos somente
para leitura e verificadas pela mesma imagem/configuração. Alteramos apenas
um valor ou campo do exemplo em cada cópia:

| Alteração temporária | Motivo da rejeição | Resultado |
| --- | --- | --- |
| Preço como string "4990" | Schema exige integer | Código 1 |
| Produto sem nome | Required do Produto alcançado por $ref | Código 1 |
| Per_page igual a 11 | Schema exige const 10 | Código 1 |

Cada execução apontou um erro da regra no-invalid-media-type-examples. As
falhas eram esperadas; nenhuma regra foi ignorada. O documento do projeto
permaneceu preservado após os diagnósticos e as cópias não foram versionadas.

Diff e links locais conferidos. Nenhuma dependência nova ou código de produção
alterado; sem consultas SQL ou nova suíte Laravel. A última suíte executada
segue sendo a da 6.49: 66 testes e 620 asserções. A validação deste exemplo
não executa o endpoint nem comprova conformidade das respostas reais.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026. Publicar o checkpoint. Próxima etapa, 6.63:
acrescentar um exemplo de resposta 422 ao OpenAPI e validar seus valores com
a mesma regra em Docker.
