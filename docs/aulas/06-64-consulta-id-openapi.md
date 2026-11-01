# Aula 6.64 — Consulta individual no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.63 com "entendi" e publicação em f8aaa6bfa0110dcf6565cf960dc2c3f8a3e8454f.
Entendimento da 6.64 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Caminho e operação

Em [openapi.json](../api/openapi.json), acrescentamos a chave
/api/v1/produtos/{id} dentro de paths, ao lado da listagem. Dentro dela, get
descreve a consulta individual. Summary apresenta a operação como Consultar
produto ativo pelo ID; operationId consultarProduto a identifica no documento.

As chaves em {id} indicam um valor variável no caminho. Por exemplo,
GET /api/v1/produtos/7 solicita o produto 7. A URL completa usa o servidor
local já declarado: http://127.0.0.1:8002/api/v1/produtos/7.

Essa operação corresponde à rota /produtos/{id} em routes/api.php, somada ao
prefixo api/v1 de bootstrap/app.php. A rota chama ProdutoController::show,
que valida o ID e consulta o catálogo. CatalogoEloquent::buscarProduto busca
pelo ID entre os produtos ativos. Esses arquivos foram apenas consultados.

## Parâmetro no caminho

Na lista parameters da nova operação:

```json
{
  "name": "id",
  "in": "path",
  "required": true,
  "description": "Identificador do produto, em decimal positivo sem sinal ou zeros iniciais. Deve caber na faixa de inteiros do PHP do backend (PHP_INT_MAX); formato inválido ou valor fora da faixa recebe 404.",
  "schema": {
    "type": "integer",
    "minimum": 1
  }
}
```

Name corresponde ao nome entre chaves no caminho. In path informa onde o
valor é enviado. Required true informa que ele é obrigatório: esse parâmetro
identifica o produto da consulta. A
[especificação OpenAPI](https://spec.openapis.org/oas/v3.2.1.html#parameter-object)
exige required true para parâmetros path.

Integer/minimum 1 descreve o valor lógico como inteiro positivo. Na URL, o
backend também exige decimal sem sinal nem zeros iniciais e valor até
PHP_INT_MAX. Essas regras estão na descrição; o schema numérico atual não
codifica sozinho a forma textual nem o máximo do backend.

## Resultados descritos

| Status | Descrição acrescentada |
| --- | --- |
| 200 | Produto ativo encontrado. |
| 404 | Produto não encontrado, inativo ou identificador inválido. |

Conferimos por leitura rota, controller, Eloquent e testes existentes. Um
produto ativo encontrado recebe 200. Inexistente e inativo recebem 404.
Formatos de ID fora do padrão são rejeitados pelo roteamento; valores acima
da faixa de int são rejeitados no controller. Ambos recebem 404.

Responses contém somente as descrições nesta etapa. Os corpos dessa operação
serão acrescentados gradualmente; o texto de erro do roteamento não é fixado
pelo contrato atual. A listagem e seus schemas/exemplos foram preservados.

## Validação e limite observado

Mesma configuração [redocly.yaml](../api/redocly.yaml) e imagem da 6.62.
Executado na raiz do repositório:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

O container é descartável (--rm), sem rede (--network none), com docs/api
montado somente para leitura em /spec. Workdir define a pasta de execução;
lint recebe documento/configuração. Resultado: código 0, sem erros ou avisos.

Duas cópias temporárias em /tmp/curso-664 foram montadas em /casos somente
para leitura e verificadas com a mesma ferramenta/configuração:

| Alteração temporária | Resultado observado |
| --- | --- |
| Remover a declaração do parâmetro id | Código 1, regra path-parameters-defined |
| Trocar required true por false | Código 0, aceito pela ferramenta |

A segunda aceitação contraria a exigência da especificação. Conferimos que a
cópia continha false e que o arquivo do projeto contém true. Isso registra
uma limitação observada do validador/configuração: passar no lint não comprova
conformidade completa. A conferência com a especificação complementa a ferramenta.
Não adicionamos dependência ou regra customizada para esse diagnóstico.

As cópias ficaram fora do Git; o documento original permaneceu preservado após
os diagnósticos. Diff e links locais conferidos. Nenhum código de produção
alterado, captura HTTP, SQL ou nova suíte Laravel. A última suíte executada
segue sendo a da 6.49: 66 testes e 620 asserções.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026. Publicar o checkpoint. Próxima etapa, 6.65:
descrever o corpo 200 da consulta individual, com data objeto referenciado
a Produto.
