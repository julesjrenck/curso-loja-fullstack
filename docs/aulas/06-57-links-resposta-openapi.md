# Aula 6.57 — Links da resposta 200 no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.56
com "entendi" e publicação em d1a7b18d3963c857ec0f9617a683a41bc5539abb.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.57
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Objeto obrigatório

Em [openapi.json](../api/openapi.json), acrescentamos links ao required do
corpo 200 e a schema.properties. O corpo exige agora data e links.
Links tem type object e sua própria lista:

```json
"required": ["first", "last", "prev", "next"]
```

Esse required interno exige os quatro campos dentro de links. Seus tipos e
descrições representam o comportamento já documentado e testado:

| Campo | Tipo | Significado |
| --- | --- | --- |
| first | string | URL da primeira página |
| last | string | URL da última página |
| prev | string ou null | Página anterior, quando houver |
| next | string ou null | Página seguinte, quando houver |

A descrição do objeto registra que as URLs preservam nome normalizado quando
informado. Nesta etapa descrevemos tipos e significado; não acrescentamos
format ou validação da composição das URLs.

## Presença e null

Prev e next usam uma lista de tipos permitidos:

```json
"type": ["string", "null"]
```

Essa lista significa que o valor pode ter qualquer um dos dois tipos,
conforme a [referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/type).
Required continua exigindo que a propriedade exista. Por exemplo, na primeira
página o corpo contém prev com valor null; a chave permanece presente.

Presença e valor são verificações distintas. A referência oficial também
esclarece que [null é diferente de ausência](https://json-schema.org/understanding-json-schema/reference/null).
No schema, "null" entre aspas é o nome de um tipo; no corpo, null é um valor JSON.

Data, sua referência a Produto e os demais trechos foram preservados. Meta
continua presente na API e será descrito depois; a descrição do envelope ainda
é parcial. Nenhum código de produção foi alterado.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$corpo = $documento->paths->{"/api/v1/produtos"}->get->responses->{"200"}->content->{"application/json"}->schema;
$links = $corpo->properties->links;
echo "JSON válido\n";
echo "Obrigatórios no corpo: ".implode(", ", $corpo->required)."\n";
echo "links: ".$links->type."; obrigatórios: ".implode(", ", $links->required)."\n";
foreach (get_object_vars($links->properties) as $nome => $campo) {
    echo $nome.": ".(is_array($campo->type) ? implode(" | ", $campo->type) : $campo->type)."\n";
}
echo "Descrição: ".$links->description."\n";
' < docs/api/openapi.json
```

-T permite receber o arquivo por entrada padrão, PHP -r executa o código no
container e < lê o arquivo no host. Json_decode com JSON_THROW_ON_ERROR
confere a decodificação. Foreach percorre as propriedades; is_array distingue
o type simples da lista de alternativas e implode formata essa lista para leitura.

O comando terminou com código 0: JSON válido; required data/links, links object,
quatro campos obrigatórios, first/last string e prev/next string | null.
A descrição também foi lida. Conferido contra contrato em português e teste
permanente de navegação filtrada. Git diff --check e links locais conferidos.

O comando lê o JSON; não executa validador OpenAPI ou de instâncias. Sem
dependências novas, consultas ou nova suíte; última suíte executada na 6.49:
66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.58: campos básicos de meta (página, tamanho, total, posições e path),
incluindo from/to com possibilidade de null; meta.links será descrito depois.
