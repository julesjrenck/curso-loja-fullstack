# Aula 6.54 — Parâmetro nome no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.53
com "entendi" e publicação em b4aa8214b8be02b542cfc68d3ab96a2e044dc800.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.54
confirmado com "entendi" em 01/11/2026; publicação verificada em
2210731acb5d1aac4e5379cd0de6dbcf74fdd501, com referências local e remotas coincidentes.

## Alteração

Em [openapi.json](../api/openapi.json), acrescentamos o segundo objeto da lista
parameters de get. Trecho dos campos desse objeto:

```json
{
  "name": "nome",
  "in": "query",
  "required": false,
  "schema": {
    "type": "string",
    "minLength": 1,
    "maxLength": 100
  }
}
```

O arquivo também contém description, explicado abaixo. Name identifica o
parâmetro e in query o localiza na URL, como ?nome=camiseta. Required false
permite omissão. Type string descreve texto; minLength/maxLength limitam seu
comprimento. Esses limites de texto são explicados na
[referência oficial JSON Schema](https://json-schema.org/understanding-json-schema/reference/string#length).

Não definimos default: omitir nome deixa de aplicar esse filtro. Enviar vazio
é outra situação, rejeitada pelo backend. O parâmetro page permanece como estava.

## Normalização e busca na descrição

Description registra o comportamento já existente no Laravel:

- Remove espaços externos antes de validar e preserva os internos.
- Aceita texto não vazio de até cem caracteres após normalização, inclusive '0'.
- Rejeita vazio, somente espaços, arrays e excesso de comprimento com 422.
- Busca o trecho literal em ativos, ignorando caixa e distinguindo acentos;
  %, _ e [ continuam sendo caracteres literais.
- Aplica o filtro antes de contar/paginar e mantém nome normalizado nos links.

Por exemplo, ?nome=%20camiseta%20 é normalizado para camiseta; ?nome= e uma
entrada composta apenas de espaços são inválidos. O texto '0' continua válido.

O schema declara tipo e comprimento; a descrição explica a normalização e a
semântica da busca. MinLength 1, sozinho, não remove espaços. A validação e a
consulta continuam implementadas no Form Request e no serviço; os testes
existentes verificam seu comportamento pelo HTTP.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$parametros = $documento->paths->{"/api/v1/produtos"}->get->parameters;
$nome = $parametros[1];
echo "JSON válido\n";
echo "Parâmetros: ".count($parametros)."; nomes: ".implode(", ", array_map(fn ($parametro) => $parametro->name, $parametros))."\n";
echo "Nome: ".$nome->name."; localização: ".$nome->in."\n";
echo "Obrigatório: ".json_encode($nome->required)."\n";
echo "Tipo: ".$nome->schema->type."; comprimento: ".$nome->schema->minLength." a ".$nome->schema->maxLength."\n";
echo "Default declarado: ".json_encode(property_exists($nome->schema, "default"))."\n";
echo "Descrição: ".$nome->description."\n";
' < docs/api/openapi.json
```

Como nas etapas anteriores, -T permite receber o arquivo por entrada padrão;
PHP -r executa o código no container e < envia o arquivo do host. Json_decode
com JSON_THROW_ON_ERROR confere a decodificação. O índice 1 acessa o segundo
parâmetro. Array_map extrai os nomes, e implode os une para exibir page, nome.
Property_exists confere se há default; false na saída significa propriedade
ausente, não um default booleano no documento.

Código de saída 0, JSON válido, dois parâmetros page/nome; nome/query,
required false, string, comprimento 1 a 100 e ausência de default confirmados.
Description também foi lido. Campos confrontados com Form Request, serviço,
controller e contrato. Git diff --check e links locais conferidos.

O comando verifica leitura JSON, sem validar OpenAPI ou requisições HTTP.
Nenhuma dependência ou código de produção alterado. Sem consultas ou nova
suíte; última suíte executada na 6.49: 66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação verificada em 2210731acb5d1aac4e5379cd0de6dbcf74fdd501.
Continuidade na [aula 06-55](06-55-schema-produto-openapi.md).
