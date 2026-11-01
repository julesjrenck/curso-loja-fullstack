# Aula 6.58 — Campos básicos de meta no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.57
com "entendi" e publicação em 12acc7e80669c400f7635df1a0437f01e8939100.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.58
confirmado com "entendi" em 01/11/2026; publicação verificada em
5b108b2cebbf739bf113710f9ab7d1efd465a552, com referências local e remotas coincidentes.

## Objeto e campos básicos

Em [openapi.json](../api/openapi.json), meta foi acrescentado ao required do
corpo 200 e a properties. Agora o corpo exige data, links e meta.
Meta é object e exige estes sete campos:

| Campo | Tipo/restrição | Significado |
| --- | --- | --- |
| current_page | integer, 1–1000000 | Página solicitada |
| per_page | integer, const 10 | Capacidade fixa por página |
| total | integer, mínimo 0 | Total de ativos correspondentes em todas as páginas |
| last_page | integer, mínimo 1 | Última página calculada |
| from | integer ou null; inteiro mínimo 1 | Posição inicial dos itens na lista completa |
| to | integer ou null; inteiro mínimo 1 | Posição final dos itens na lista completa |
| path | string | URL base da listagem, sem query |

As descrições do arquivo explicam essas responsabilidades. Current_page
respeita o intervalo permitido pelo Form Request. Total pode ser zero, mas
last_page permanece pelo menos 1 conforme o paginador usado no projeto.
Path contém a base da listagem; os links de navegação incluem os parâmetros.

## Valor fixo e posições vazias

Para per_page, acrescentamos:

```json
{
  "type": "integer",
  "const": 10
}
```

Const restringe o valor a dez no schema, conforme a
[referência JSON Schema](https://json-schema.org/understanding-json-schema/reference/const).
Esse número informa a capacidade; uma página com dois itens continua tendo
per_page 10. A quantidade efetiva de objetos está em data.

From e to usam type ["integer", "null"] e minimum 1. Quando há posição
numérica, ela começa em 1; quando a página está vazia, o valor pode ser null.
O campo continua obrigatório nos dois casos. Os limites numéricos seguem a
[referência de intervalos](https://json-schema.org/understanding-json-schema/reference/numeric#range).

O total é independente de a página atual estar vazia. No cenário da 6.46,
onze correspondentes ocupam duas páginas. Pedir a terceira retorna data [],
current_page 3, total 11, last_page 2 e from/to null. Nenhum desses campos
deve ser deduzido apenas pelo tamanho de data.

Meta.links será descrito na próxima etapa. Ele continua na resposta da API;
o schema de meta ainda está parcial. Data, links e Produto foram preservados.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$corpo = $documento->paths->{"/api/v1/produtos"}->get->responses->{"200"}->content->{"application/json"}->schema;
$meta = $corpo->properties->meta;
echo "JSON válido\n";
echo "Obrigatórios no corpo: ".implode(", ", $corpo->required)."\n";
echo "meta: ".$meta->type."; obrigatórios: ".implode(", ", $meta->required)."\n";
foreach (get_object_vars($meta->properties) as $nome => $campo) {
    echo $nome.": ".json_encode($campo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n";
}
echo "meta.links descrito: ".json_encode(property_exists($meta->properties, "links"))."\n";
' < docs/api/openapi.json
```

-T permite receber o arquivo por entrada padrão; PHP -r executa o código no
container; < envia o arquivo do host. Json_decode com JSON_THROW_ON_ERROR
confere a decodificação. Foreach exibe cada schema; as opções de json_encode
mantêm acentos e barras legíveis. Property_exists confere a descrição de
meta.links neste arquivo, não a presença do campo numa resposta HTTP real.

Código 0: JSON válido, required data/links/meta, sete campos obrigatórios
de meta e seus tipos/limites/const/descrições lidos. Meta.links descrito false,
pois ainda não foi acrescentado ao schema. Comparado com contrato, testes
permanentes e paginate(10) do serviço. Git diff --check e links conferidos.

Sem validador OpenAPI ou de instâncias. Nenhuma dependência ou produção
alterada; sem consultas ou nova suíte. Última suíte executada na 6.49:
66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026, durante o encerramento do registro. Publicação verificada em
5b108b2cebbf739bf113710f9ab7d1efd465a552. Continuidade na
[aula 06-59](06-59-meta-links-openapi.md).
