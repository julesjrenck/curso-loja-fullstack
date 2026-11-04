# Aula 7.23 — Consulta do usuário no OpenAPI

Implementação documental, explicação e verificações em 04/11/2026, após
confirmação da 7.22 com "entendi". Checkpoint anterior publicado e conferido em
fe91e84fdee4c88aac0f31991f82ffac6b92486e; HEAD/origin/main/main remota iguais.
Entendimento da 7.23 aguardando confirmação explícita.

## Objetivo e arquivo

Integramos GET /api/v1/usuario ao [OpenAPI](../api/openapi.json), acompanhando o
[contrato em português](../api/autenticacao.md), a rota e os testes existentes.
Alteramos o título para API da loja e a descrição para abranger catálogo e
consulta autenticada. Versão OpenAPI 3.2.1, info.version e servidores preservados.
Nenhuma alteração de aplicação ou nova dependência.

## Operação e respostas

Paths agora contém /api/v1/usuario/get, com summary e operationId
consultarUsuarioAutenticado. Description explica a identidade da autenticação,
ausência de parâmetros seletores e limites da verificação com actingAs.
Não declaramos ID/e-mail como parâmetros suportados nem acrescentamos corpo GET.

| Resposta | Representação documentada |
| --- | --- |
| 200 application/json | Objeto com somente data; data referencia Usuario. |
| 401 application/json | Objeto com somente message string, sem texto fixo. |

Os exemplos são fictícios e seguem os corpos exigidos nos testes. ID 1 é
ilustrativo. O exemplo 401 usa Unauthenticated., mas o schema aceita outra string.
Ausência de redirecionamento e comportamento com Accept HTML/ausente ficam
descritos na resposta 401; foram verificados nas etapas anteriores.

Components.schemas.Usuario contém id inteiro mínimo 1, name/email strings e
required com os três campos. Não adicionamos format email ou limites de texto
que não foram estabelecidos no contrato. O tipo string não aceita null.
AdditionalProperties false fecha o objeto Usuario, o envelope 200 e o corpo 401:
campos extras não integram essas representações. Os schemas do catálogo continuam
como estavam, com suas regras anteriores.

```json
"data": {
  "$ref": "#/components/schemas/Usuario"
}
```

$ref reaproveita a definição do usuário, em vez de repetir seus campos no corpo
200. Schemas descrevem o formato; não alteram a serialização do Laravel.

## Cookie e exigência na operação

Conferimos pelo PHP Docker o nome público session.cookie da configuração normal:
loja-fullstack-session. Não lemos nem imprimimos o valor de nenhum cookie.
Em components.securitySchemes, acrescentamos SessaoCookie:

```json
{
  "type": "apiKey",
  "in": "cookie",
  "name": "loja-fullstack-session"
}
```

ApiKey é a categoria usada pelo OpenAPI para representar esse transporte em
cookie; não estamos criando chaves de API. Name é o nome do cookie, cujo valor
será gerenciado pelo navegador. A descrição registra HttpOnly, nome local
configurável e diferença entre sessão autenticada e cookie de visitante/CSRF.

Somente na operação de consulta do usuário, declaramos:

```json
"security": [
  {
    "SessaoCookie": []
  }
]
```

A chave conecta a exigência ao esquema de mesmo nome. O array vazio associado
não dispensa o cookie; não acrescenta requisitos de papéis a esse esquema.
Não há security global, e não alteramos as operações públicas do catálogo.
O documento descreve a autenticação; auth:sanctum continua exigindo-a no Laravel.
Não documentamos Bearer como um modo implementado pelo projeto.

Referências: [Security Scheme Object](https://spec.openapis.org/oas/v3.2.1.html#security-scheme-object)
e [Security Requirement Object](https://spec.openapis.org/oas/v3.2.1.html#security-requirement-object).

## Verificações

Usamos o Redocly já fixado na 6.61, sem instalar ou atualizar ferramentas:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

Container temporário, sem rede, documentação montada para leitura. A configuração
redocly.yaml mantém extends spec e no-invalid-media-type-examples como erro.
Documento completo válido, código 0, sem avisos.

Criamos duas cópias temporárias do documento completo, modificando somente o
exemplo 200 da consulta do usuário. Sem email: rejeitada por campo obrigatório;
com password fictício adicional: rejeitada por additionalProperties. Cada
cópia retornou código 1 pela regra de exemplos. Cópias removidas após a verificação.

Comparação estruturada com HEAD confirmou operações do catálogo, schema Produto,
servidores e versão OpenAPI preservados, e segurança restrita à nova operação.
O lint verifica o documento e seus exemplos, não executa a API nem autentica.
Não capturamos novos corpos HTTP para comparação automática com os schemas.
Sem SQL ou nova suíte Laravel nesta etapa documental; último resultado completo
continua 7.22: 71 testes/662 asserções. Login/cookie real ainda não exercitados.

## Continuidade

OpenAPI atualizado, explicado e verificado; entendimento e publicação da 7.23
pendentes. Aguardar confirmação explícita. Após confirmar e publicar:
7.24 — desenhar o contrato de POST /api/v1/login, com entrada, sucesso e falha,
antes de implementar validação ou autenticação por credenciais.
