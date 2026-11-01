# Aula 6.59 — Meta.links no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.58
com "entendi" durante o encerramento do registro e publicação em
5b108b2cebbf739bf113710f9ab7d1efd465a552. HEAD, origin/main e main remota
conferidos após push. Entendimento da 6.59 confirmado com "entendi" em
01/11/2026; publicação em preparação.

## Lista de opções

Em [openapi.json](../api/openapi.json), acrescentamos links ao required de
meta e a suas properties. Ele tem type array e items com type object.
Cada item exige:

```json
"required": ["url", "label", "page", "active"]
```

| Campo do item | Tipo | Significado |
| --- | --- | --- |
| url | string ou null | Destino da navegação, quando houver |
| label | string | Rótulo exibido, variável com a tradução |
| page | integer ou null; inteiro mínimo 1 | Página de destino |
| active | boolean | Indica se a opção numérica representa a página atual |

URLs não nulas preservam nome normalizado quando informado. Mesmo quando
url/page são null, as propriedades precisam estar presentes no item.

O schema não fixa quantas opções existem. O teste da 6.49 confere quatro em
um cenário de duas páginas, mas o paginador pode produzir outra quantidade
em outros cenários. Também não fixamos textos traduzidos em label.

## Booleano e significado de active

```json
"active": {
  "type": "boolean",
  "description": "Indica se a opção numérica representa a página atual."
}
```

Boolean aceita os valores JSON true e false. Strings como "true" e números
como 0 não têm esse tipo, conforme a
[referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/boolean).

No teste de duas páginas, a opção numérica da página atual tem active true.
Outra página pode ter URL válida e active false; essa propriedade indica a
seleção atual. As opções anterior/seguinte também ficam false nesse cenário.

Os atalhos do objeto links no corpo continuam first/last/prev/next. Já
meta.links é a lista de opções com rótulos e estado de seleção. Os dois
formatos descrevem dados já devolvidos pela API; nenhum código de produção mudou.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$meta = $documento->paths->{"/api/v1/produtos"}->get->responses->{"200"}->content->{"application/json"}->schema->properties->meta;
$links = $meta->properties->links;
echo "JSON válido\n";
echo "Obrigatórios em meta: ".implode(", ", $meta->required)."\n";
echo "meta.links: ".$links->type."; item: ".$links->items->type."\n";
echo "Obrigatórios no item: ".implode(", ", $links->items->required)."\n";
foreach (get_object_vars($links->items->properties) as $nome => $campo) {
    echo $nome.": ".json_encode($campo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n";
}
' < docs/api/openapi.json
```

-T permite receber o arquivo por entrada padrão, PHP -r executa o código no
container e < envia o arquivo do host. Json_decode com JSON_THROW_ON_ERROR
confere a decodificação. Foreach percorre os schemas dos quatro campos, e
json_encode os exibe com acentos e barras legíveis.

Código 0: JSON válido, oito campos obrigatórios em meta, links array/items
object, quatro campos obrigatórios nos itens e seus tipos/descrições lidos.
Conferido contra contrato em português e teste permanente de navegação filtrada.
Git diff --check e links locais conferidos.

Sem validador OpenAPI ou de instâncias. Nenhuma dependência ou produção
alterada; sem consultas ou nova suíte. Última suíte executada na 6.49:
66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.60: descrever corpo JSON de 422 com message e errors por campo,
sem fixar mensagens traduzidas.
