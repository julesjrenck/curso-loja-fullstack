# Aula 6.63 — Exemplo da resposta 422 no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.62 com "entendi" e publicação em 57e7f4aca3ff845a62ba7542138571964f6d4bb1.
Entendimento da 6.63 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Corpo de erro com valores concretos

Em [openapi.json](../api/openapi.json), acrescentamos example ao lado de
schema em responses/422/content/application~1json:

```json
{
  "message": "Os dados enviados são inválidos.",
  "errors": {
    "nome": [
      "Informe um nome válido."
    ]
  }
}
```

Message resume a falha. Errors é um objeto associativo: a chave nome identifica
o campo inválido, e seu valor é uma lista de mensagens. Em PHP, pense em um
array associativo cujo valor de cada entrada também é um array.

O exemplo representa o formato de uma falha de validação de nome, como numa
requisição com nome vazio. Os textos são ilustrativos; não fixam a tradução
da API. Só nome aparece porque não é necessário que page e nome falhem juntos.
O status 422 pertence à resposta HTTP; não é uma propriedade desse corpo.

O schema existente exige message e errors. Dentro de errors, minProperties 1
exige ao menos um campo com erro. AdditionalProperties descreve cada valor
como array, minItems 1 exige ao menos uma mensagem por campo e items string
define o tipo de cada mensagem. O schema descreve o dicionário sem restringir
os nomes das chaves; a descrição da operação informa page e/ou nome.

Conferimos por leitura as regras de ListarProdutosRequest e os testes existentes
para nome/page inválidos. Não capturamos uma resposta HTTP nesta etapa. O
exemplo documenta um corpo possível; não muda a validação nem o retorno real.
Schemas, exemplo 200 e configuração Redocly foram preservados.

## Validação executada

Usamos a mesma imagem e [redocly.yaml](../api/redocly.yaml) da 6.62, que mantém
a regra no-invalid-media-type-examples com severity error. A regra compara
os exemplos de corpos com seus schemas, conforme sua
[referência oficial](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples).

Executado na raiz do repositório:

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
Resultado: código 0, sem erros ou avisos, incluindo os exemplos 200 e 422.

## Conferência dos mínimos e do tipo

Criamos três cópias temporárias em /tmp/curso-663, montadas em /casos somente
para leitura. Cada execução usou a mesma imagem/configuração, mudando apenas
o arquivo de entrada. As alterações ficaram no exemplo 422:

| Alteração temporária | Restrição detectada | Resultado |
| --- | --- | --- |
| Errors.nome como string | Valor deve ser array | Código 1 |
| Errors.nome como array vazio | MinItems 1 | Código 1 |
| Errors como objeto vazio | MinProperties 1 | Código 1 |

Cada execução apontou um erro da regra de exemplos. As falhas eram esperadas;
nenhuma regra foi ignorada. As cópias não foram versionadas e o documento do
projeto permaneceu preservado após os diagnósticos.

Git diff --check e links locais conferidos. Nenhuma nova dependência ou código
de produção alterado; sem SQL ou nova suíte Laravel. A última suíte executada
segue sendo a da 6.49: 66 testes e 620 asserções. A validação do exemplo escrito
não comprova conformidade de respostas reais com o schema.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026. Publicar o checkpoint. Próxima etapa, 6.64:
acrescentar a operação GET /api/v1/produtos/{id} ao OpenAPI, com parâmetro id
e descrições das respostas 200/404.
