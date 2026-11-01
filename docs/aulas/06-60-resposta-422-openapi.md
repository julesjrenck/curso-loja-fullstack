# Aula 6.60 — Corpo da resposta 422 no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.59
com "entendi" e publicação em 4e8f8ed9c29df265ec03e814b2de32ce0a1cdb30.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.60
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Corpo e associação ao campo

Em [openapi.json](../api/openapi.json), a resposta 422 recebeu content com
application/json e schema type object. Required exige message e errors.
Message é string e resume a falha de validação. Errors é um objeto associativo:
cada chave é o nome de um campo inválido e cada valor é uma lista de mensagens.
Em PHP, pense num array associativo cujos valores também são arrays.

Exemplo de formato, com mensagens apenas ilustrativas:

```json
{
  "message": "Os dados enviados são inválidos.",
  "errors": {
    "nome": ["Informe um nome válido."]
  }
}
```

Nesta operação, os campos de validação são page e nome. Não exigimos que ambos
tenham erro ao mesmo tempo; aparecem os campos inválidos. Os textos podem mudar
com a tradução, como já consideramos nos testes anteriores.

## Schema do dicionário

Dentro de properties, errors foi descrito assim:

```json
"errors": {
  "type": "object",
  "minProperties": 1,
  "description": "Mensagens agrupadas pelo nome do campo inválido; nesta operação, page e/ou nome.",
  "additionalProperties": {
    "type": "array",
    "minItems": 1,
    "items": {
      "type": "string"
    }
  }
}
```

MinProperties 1 exige ao menos um campo com erro. AdditionalProperties aplica
um schema aos valores das propriedades não declaradas em properties ou
patternProperties. Como não declaramos chaves específicas dentro de errors,
esse schema se aplica a cada entrada do dicionário. O uso segue a
[referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/object#additionalproperties).

Cada valor é array, minItems 1 exige ao menos uma mensagem e items string
descreve cada texto. MinProperties conta campos; minItems conta mensagens
por campo. O schema descreve o formato dos valores sem restringir os nomes
das chaves. A descrição informa os campos usados pela operação atual.

A resposta 200 e os demais trechos foram preservados. O Form Request continua
executando a validação; esta alteração descreve sua resposta.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$corpo = $documento->paths->{"/api/v1/produtos"}->get->responses->{"422"}->content->{"application/json"}->schema;
$erros = $corpo->properties->errors;
$mensagens = $erros->additionalProperties;
echo "JSON válido\n";
echo "422 application/json; corpo: ".$corpo->type."; obrigatórios: ".implode(", ", $corpo->required)."\n";
echo "message: ".$corpo->properties->message->type."\n";
echo "errors: ".$erros->type."; mínimo de campos: ".$erros->minProperties."\n";
echo "Mensagens por campo: ".$mensagens->type."; mínimo de itens: ".$mensagens->minItems."; item: ".$mensagens->items->type."\n";
echo "Descrição: ".$erros->description."\n";
' < docs/api/openapi.json
```

-T permite receber o arquivo por entrada padrão, PHP -r executa o código no
container e < envia o arquivo do host. Json_decode com JSON_THROW_ON_ERROR
confere a decodificação. A leitura percorre o schema de 422, separando corpo,
dicionário e lista de mensagens para exibir os níveis da estrutura.

Código 0: JSON válido; corpo object/message/errors obrigatórios; message
string; errors object/mínimo um campo; valores array/mínimo um item/string.
Descrição também lida. Conferido contra Form Request, contrato em português
e testes de page/nome inválidos. Git diff --check e links conferidos.

Sem validador OpenAPI ou de instâncias. Nenhuma dependência ou produção
alterada; sem consultas ou nova suíte. Última suíte executada na 6.49:
66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.61: validar o documento OpenAPI em Docker com ferramenta compatível
e versão fixada, conferindo estrutura e referências.
