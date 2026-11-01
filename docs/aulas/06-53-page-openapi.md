# Aula 6.53 — Parâmetro page no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.52
com "entendi" e publicação em 104f8d6718be4d5a57c9f46344ff77bae51b441a.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.53
confirmado com "entendi" em 01/11/2026; publicação verificada em
b4aa8214b8be02b542cfc68d3ab96a2e044dc800, com referências local e remotas coincidentes.

## Alteração e relação com a requisição

Em [openapi.json](../api/openapi.json), dentro de get, acrescentamos parameters
como uma lista. Seu único objeto descreve page. Trecho dos campos desse objeto:

```json
{
  "name": "page",
  "in": "query",
  "required": false,
  "schema": {
    "type": "integer",
    "minimum": 1,
    "maximum": 1000000,
    "default": 1
  }
}
```

O arquivo também contém description, explicado abaixo. Name é o nome do
parâmetro; in query o coloca depois do ? na URL, como ?page=2. Required false
permite omitir o parâmetro. Schema descreve o valor: inteiro, de 1 a 1000000,
inclusive. Minimum/maximum/default são números, e required é booleano no JSON.
Os campos de parâmetro seguem a
[especificação OpenAPI](https://spec.openapis.org/oas/v3.2.1.html#parameter-object).

Default 1 documenta o comportamento que ListarProdutosRequest::pagina() já
implementa com validated('page', 1). Editar esse campo do documento não muda
o PHP que atende a requisição.

## Opcionalidade e representação textual

Description registra o comportamento existente após a normalização do Laravel:
omitido usa 1; presente precisa ser decimal positivo sem sinal ou zeros
iniciais, no intervalo permitido. Vazio ou inválido recebe 422. Página após
a última continua válida e retorna 200 com lista vazia.

Por exemplo, /api/v1/produtos usa página 1; ?page=2 pede página 2.
?page= e ?page=01 são inválidos. Required false permite ausência, sem tornar
válido qualquer texto enviado.

Schema integer/limites descreve o valor numérico. Ele não expressa sozinho
as restrições textuais de 01, +1 ou 1e3 na URL. Por isso mantemos a explicação
em description e os testes existentes do backend. Não usamos pattern em um
schema integer: esse tipo de restrição textual deve ser tratado de outra forma.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$operacao = $documento->paths->{"/api/v1/produtos"}->get;
$parametro = $operacao->parameters[0];
echo "JSON válido\n";
echo "Parâmetros: ".count($operacao->parameters)."\n";
echo "Nome: ".$parametro->name."; localização: ".$parametro->in."\n";
echo "Obrigatório: ".json_encode($parametro->required)."\n";
echo "Tipo: ".$parametro->schema->type."\n";
echo "Limites: ".$parametro->schema->minimum." a ".$parametro->schema->maximum."; padrão: ".$parametro->schema->default."\n";
echo "Descrição: ".$parametro->description."\n";
' < docs/api/openapi.json
```

-T permite receber a entrada padrão; PHP -r executa o código no container.
O redirecionamento < envia o arquivo lido no host. Json_decode com
JSON_THROW_ON_ERROR confere a decodificação. Parameters[0] acessa o primeiro
objeto da lista. Json_encode imprime o booleano false de forma explícita.

O comando terminou com código 0, imprimindo JSON válido, um parâmetro,
page/query, obrigatório false, tipo integer, limites 1 a 1000000, padrão 1
e a descrição esperada. Também conferimos esses valores contra o Form Request
e o contrato em português. Git diff --check e links locais conferidos.

Essa leitura não executa um validador OpenAPI nem valida requisições HTTP.
Nenhuma dependência ou código de produção alterado. Sem consultas ou nova
suíte; última suíte executada na 6.49: 66 testes/620 asserções.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação verificada em b4aa8214b8be02b542cfc68d3ab96a2e044dc800.
Continuidade na [aula 06-54](06-54-nome-openapi.md).
