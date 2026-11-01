# Aula 6.52 — Primeira operação no OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.51
com "entendi" e publicação em 5bcb4307f03cbf89ba1a52e75e6ca0eebfeaa43f.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.52
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Trecho acrescentado

Em [openapi.json](../api/openapi.json), substituímos paths vazio por:

```json
"paths": {
  "/api/v1/produtos": {
    "get": {
      "summary": "Listar produtos ativos",
      "operationId": "listarProdutos",
      "responses": {
        "200": {
          "description": "Página de produtos ativos correspondentes à busca, incluindo paginação. A lista pode estar vazia."
        },
        "422": {
          "description": "Parâmetros de consulta inválidos."
        }
      }
    }
  }
}
```

Esse é o trecho dentro do objeto principal; openapi, info e servers permanecem
como estavam. O documento continua em construção, ainda sem parâmetros ou
schemas/content de resposta.

## Caminho, método e identificador

A chave /api/v1/produtos identifica o caminho. Dentro dela, get descreve a
operação GET. Com o servidor da 6.51, forma a URL local completa
http://127.0.0.1:8002/api/v1/produtos.

Summary é o resumo legível. OperationId identifica a operação para ferramentas
e deve ser único entre as operações descritas. Escolhemos listarProdutos.
Ele é independente do nome index usado no controller PHP: é um identificador
da descrição, sem criar função ou rota. Esses campos foram conferidos na
[especificação OpenAPI](https://spec.openapis.org/oas/v3.2.1.html#operation-object).

## Respostas

Responses organiza as respostas pelos códigos HTTP. As chaves "200" e "422"
são strings no JSON. Cada uma contém, nesta etapa, somente uma descrição.

200 descreve uma página de ativos correspondentes à busca, inclusive quando
data fica vazia. 422 descreve rejeição de parâmetros de consulta inválidos.
Esses comportamentos já existem e foram testados no Laravel.

Content-Type e estrutura dos corpos serão detalhados em etapas próprias.
Não acrescentamos o 404 da consulta individual à listagem: a operação por ID
será descrita separadamente. O contrato em [catalogo.md](../api/catalogo.md)
continua explicando os detalhes atuais da API.

## Verificação executada

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
$caminho = "/api/v1/produtos";
$operacao = $documento->paths->{$caminho}->get;
echo "JSON válido\n";
echo "URL: ".$documento->servers[0]->url.$caminho."\n";
echo "Operação: GET ".$caminho."\n";
echo "Resumo: ".$operacao->summary."\n";
echo "Identificador: ".$operacao->operationId."\n";
echo "Respostas: ".implode(", ", array_keys(get_object_vars($operacao->responses)))."\n";
' < docs/api/openapi.json
```

Como na 6.51, -T permite receber o arquivo por entrada padrão, PHP -r executa
o código no container, e < envia o conteúdo lido no host. Json_decode com
JSON_THROW_ON_ERROR confere a decodificação. Acesso ->{$caminho} usa uma
propriedade cujo nome vem da variável, necessário para o caminho com barras.
Get_object_vars/array_keys obtêm os códigos e implode os une para exibição.

Saída, código 0:

```text
JSON válido
URL: http://127.0.0.1:8002/api/v1/produtos
Operação: GET /api/v1/produtos
Resumo: Listar produtos ativos
Identificador: listarProdutos
Respostas: 200, 422
```

Isso confirma sintaxe e leitura da operação; não é validação OpenAPI
automatizada. Método/prefixo/status também foram confrontados com routes/api.php,
bootstrap/app.php, controller e contrato. Git diff --check e links conferidos.

Não executamos consultas SQL ou nova suíte; a última suíte é a da 6.49,
com 66 testes/620 asserções. Nenhuma dependência ou código de produção alterado.

## Continuidade

Contrato, roteiro e progresso atualizados. Entendimento confirmado com "entendi"
em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.53: descrever apenas page na query, com opcionalidade, padrão e limites;
registrar representação decimal canônica na descrição. Nome e schemas de
resposta serão acrescentados depois.
