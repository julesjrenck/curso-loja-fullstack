# Aula 6.55 — Schema reutilizável Produto no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.54
com "entendi" e publicação em 2210731acb5d1aac4e5379cd0de6dbcf74fdd501.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.55
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Componente criado

Em [openapi.json](../api/openapi.json), acrescentamos components na raiz,
ao lado de paths. Dentro de schemas, Produto descreve um objeto reutilizável:

```json
"Produto": {
  "type": "object",
  "description": "Representação pública de um produto do catálogo.",
  "required": [
    "id",
    "nome",
    "preco_em_centavos"
  ],
  "properties": {
    "id": {
      "type": "integer"
    },
    "nome": {
      "type": "string"
    },
    "preco_em_centavos": {
      "type": "integer",
      "description": "Preço em centavos; 4990 representa R$ 49,90."
    }
  }
}
```

Components.schemas guarda definições que poderão ser referenciadas pelas
operações. O componente desta etapa ainda não está ligado às respostas.
Esse papel de reutilização consta na
[especificação OpenAPI](https://spec.openapis.org/oas/v3.2.1.html#components-object).

## Properties, required e tipos

Type object indica um objeto JSON. Properties descreve cada campo e seu tipo.
Required lista quais campos precisam estar presentes. Declarar um campo em
properties, sozinho, não exige sua presença, conforme a
[referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/object#required).

No parâmetro de query, required era um booleano sobre enviar aquele parâmetro.
Aqui, required é uma lista de propriedades obrigatórias de um objeto. Os tipos
integer/string declarados também não incluem null. Presença e tipo são
verificações distintas descritas pelo schema.

O preço permanece um inteiro em centavos; 4990 corresponde a R$ 49,90.
O schema de nome do produto não herda o limite de cem caracteres do filtro:
são dados com responsabilidades diferentes. Nesta etapa descrevemos tipos e
presença, sem declarar proibição de propriedades adicionais.

## Relação com o código

ProdutoResource já devolve id, nome e preco_em_centavos. A migration define
as colunas e o model converte o preço para integer. Esses arquivos e o
comportamento HTTP continuam como estavam. O componente descreve a representação
pública, que poderá ser usada pela listagem e pela consulta individual.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$produto = $documento->components->schemas->Produto;
echo "JSON válido\n";
echo "Schema Produto; tipo: ".$produto->type."\n";
echo "Obrigatórios: ".implode(", ", $produto->required)."\n";
foreach (get_object_vars($produto->properties) as $nome => $campo) {
    echo $nome.": ".$campo->type."\n";
}
echo "Preço: ".$produto->properties->preco_em_centavos->description."\n";
echo "Content em 200: ".json_encode(property_exists($documento->paths->{"/api/v1/produtos"}->get->responses->{"200"}, "content"))."\n";
' < docs/api/openapi.json
```

-T permite entrada padrão; PHP -r executa o código no container; < envia o
arquivo do host. Json_decode com JSON_THROW_ON_ERROR confere a decodificação.
Get_object_vars permite percorrer os campos com foreach; implode exibe a lista
required. Property_exists retorna false porque o content da resposta 200
ainda não foi descrito.

Código 0, JSON válido, schema object, três obrigatórios e tipos
integer/string/integer confirmados. A descrição do preço foi lida e o componente
permanece sem referência nas respostas. Campos conferidos contra resource,
model, migration e contrato. Git diff --check e links locais conferidos.

O comando verifica leitura do JSON; não executa validador OpenAPI ou validação
de um objeto de produto contra o schema. Nenhuma dependência ou código de
produção alterado. Sem consultas ou nova suíte; última suíte executada na
6.49: 66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.56: ligar Produto à resposta 200 por content/application/json, data
como lista e items com $ref, deixando links/meta para as etapas seguintes.
