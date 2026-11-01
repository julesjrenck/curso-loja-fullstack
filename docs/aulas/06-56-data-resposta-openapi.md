# Aula 6.56 — Data da resposta 200 no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.55
com "entendi" e publicação em 9930c338f2ed1764608ff5139587882ba1b26c6c.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.56
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Corpo JSON e lista de produtos

Em [openapi.json](../api/openapi.json), a resposta 200 recebeu content, cuja
chave application/json descreve o corpo nesse tipo de mídia. Seu schema é
um object com required ["data"]. Dentro de properties, acrescentamos:

```json
"data": {
  "type": "array",
  "maxItems": 10,
  "items": {
    "$ref": "#/components/schemas/Produto"
  }
}
```

Type array descreve uma lista. MaxItems 10 corresponde à capacidade de
paginate(10) no serviço. Cada elemento deve seguir o schema indicado por
items. A lista vazia continua permitida; não definimos mínimo positivo de itens.
Esse uso de items segue a
[referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/array#items).

Content organiza o corpo por tipo de mídia conforme o
[objeto de resposta OpenAPI](https://spec.openapis.org/oas/v3.2.1.html#response-object).
Data obrigatório significa que a chave precisa existir, inclusive como []
quando não há itens na página. O objeto externo e os objetos dentro da lista
são níveis diferentes: o primeiro contém data; os internos representam produtos.

## Referência ao componente

O valor de $ref aponta para uma definição existente. Aqui, # indica o próprio
documento, e /components/schemas/Produto conduz ao componente criado na 6.55.
Assim, os campos id/nome/preco_em_centavos e seus tipos não precisam ser
duplicados dentro de items.

A descrição do corpo ainda é parcial: links/meta continuam presentes na API
e serão detalhados depois. Não fechamos o objeto contra propriedades adicionais.
A resposta 422 continua apenas com descrição. Nenhuma regra do Laravel mudou.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$corpo = $documento->paths->{"/api/v1/produtos"}->get->responses->{"200"}->content->{"application/json"}->schema;
$lista = $corpo->properties->data;
$referencia = $lista->items->{"\$ref"};
$alvo = $documento;
foreach (explode("/", substr($referencia, 2)) as $parte) {
    $alvo = $alvo->{$parte};
}
echo "JSON válido\n";
echo "200 application/json; corpo: ".$corpo->type."; obrigatório: ".implode(", ", $corpo->required)."\n";
echo "data: ".$lista->type."; máximo: ".$lista->maxItems."\n";
echo "Referência: ".$referencia."\n";
echo "Alvo: ".$alvo->type."; campos obrigatórios: ".implode(", ", $alvo->required)."\n";
' < docs/api/openapi.json
```

Como nas aulas anteriores, PHP -r roda no container com -T e recebe o arquivo
pela entrada padrão; < lê o arquivo no host. Json_decode com
JSON_THROW_ON_ERROR confere a decodificação. Em "\$ref", a barra invertida
impede a interpolação de uma variável PHP: queremos o nome literal da propriedade.

Para esta referência local simples, substr remove #/, explode separa os
segmentos e foreach percorre as propriedades até Produto. Esse trecho não é
um resolvedor universal de referências.

Saída, código 0:

```text
JSON válido
200 application/json; corpo: object; obrigatório: data
data: array; máximo: 10
Referência: #/components/schemas/Produto
Alvo: object; campos obrigatórios: id, nome, preco_em_centavos
```

Sintaxe, leitura e destino dessa referência conferidos. Também comparamos
com controller/resource, paginate(10) do serviço e contrato em português.
Git diff --check e links locais conferidos. Não executamos validador OpenAPI
ou validação de instâncias. Nenhuma dependência ou produção alterada; sem
consultas ou nova suíte. Última suíte na 6.49: 66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.57: descrever links na resposta 200, com first/last/prev/next,
obrigatoriedade e possibilidade de null.
