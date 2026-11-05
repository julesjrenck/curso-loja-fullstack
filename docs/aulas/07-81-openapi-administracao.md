# Aula 7.81 — Administração no OpenAPI

Implementação documental, explicação e verificações em 05/11/2026, após
confirmação da [7.80](07-80-testes-http-administracao.md) com "entendi".
Checkpoint anterior publicado e conferido em
22982d0fd516d2418c9f32c66932422278623fbd; HEAD/origin/main/main remota iguais.
Entendimento da 7.81 confirmado com "entendi" em 05/11/2026; publicação
conferida em d5f1140887ece72392ae57e0e1b8fd7f7f0aed71, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação.

## Objetivo e arquivo

Incluímos GET /api/v1/administracao no [OpenAPI](../api/openapi.json), conforme
o [contrato textual](../api/administracao.md) e a implementação já testada.
Atualizamos também a descrição geral da API. Nenhum código da aplicação foi
alterado. OpenAPI 3.2.1, versão da API, servidores e componentes mantidos.

O caminho contém get, summary e operationId consultarAdministracao. Esse
identificador deve ser único no documento; não é o nome do Gate ou do método
PHP. A descrição registra auth:sanctum, can:acessar-administracao e a exigência
de is_admin do User identificado no servidor.

## Cookie e autorização

```json
"security": [
  {
    "SessaoCookie": []
  }
]
```

Reutilizamos o esquema existente SessaoCookie: apiKey/in cookie, nome
loja-fullstack-session. Essa categoria do OpenAPI descreve o transporte do
cookie; não cria uma chave de API ou token Bearer.

O objeto exige o esquema indicado. A lista interna vazia não enumera escopos
ou papéis. É diferente de security vazio na operação, que dispensa uma
identidade previamente autenticada, como no login já documentado.
Aqui exigimos sessão autenticada e descrevemos a permissão administrativa;
cookie visitante não autentica e cliente autenticado não passa pelo Gate.

O documento descreve o requisito. Auth:sanctum/can no backend continuam
aplicando as verificações. Não acrescentamos security global, mantendo o
catálogo público. Referência: [Security Requirement Object](https://spec.openapis.org/oas/v3.2.1.html#security-requirement-object).

## Respostas e schemas

| Status | Schema/representação |
| --- | --- |
| 200 | Objeto somente data, com objeto somente mensagem; texto fixo. |
| 401 | Objeto somente message string; ausência de autenticação. |
| 403 | Objeto somente message string; recusa do Gate após autenticação. |

Cada resposta tem description, content application/json, schema e example.
Não há corpo de entrada ou parâmetros nessa consulta.

Type descreve o tipo; required exige a propriedade; additionalProperties
false impede campos extras. No sucesso, aplicamos isso ao objeto externo e
ao objeto data. Const em mensagem exige o texto fixo do contrato, mantendo
o mesmo comportamento de assertExactJson no teste HTTP.

Nos erros, message exige string e não possui const: o contrato não fixa idioma
como condição da recusa. Os exemplos são Unauthenticated. para 401 e Acesso
não permitido. para 403. AdditionalProperties false exclui campos como trace
nessas representações. Schemas/exemplos locais da nova operação não alteram
os componentes anteriores.

Referências: [Schema Object](https://spec.openapis.org/oas/v3.2.1.html#schema-object)
e [Response Object](https://spec.openapis.org/oas/v3.2.1.html#response-object).

## Validação no Docker

```sh
docker run --rm --pull=never --network none \
  --volume "$PWD/docs/api:/spec:ro" --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

Usamos a imagem já fixada/disponível. Rm remove o container; pull never evita
download; network none impede rede; a montagem ro permite somente leitura.
Workdir escolhe /spec; lint valida com a configuração existente, que verifica
também exemplos de respostas. Documento completo válido, código 0/sem avisos.

Criamos cinco cópias completas em diretório próprio de /tmp, alterando apenas
um exemplo da nova operação por cópia. Cada uma foi validada pelo mesmo CLI,
com montagem readonly adicional do diretório temporário.

| Alteração deliberada | Rejeição observada |
| --- | --- |
| 200 sem data.mensagem | Propriedade obrigatória ausente. |
| 200 com outra mensagem | Valor diferente de const. |
| 200 com is_admin adicional em data | Propriedade extra proibida. |
| 403 com trace adicional | Propriedade extra proibida. |
| 401 com message numérico | Tipo string exigido. |

Todas rejeitadas, código 1, pela regra no-invalid-media-type-examples, com o
motivo esperado. Não alteramos os exemplos reais para produzir esses erros.
As cinco cópias e seu diretório foram removidos depois da conferência.
Referência: [validação de exemplos no Redocly](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples).

Comparação estruturada com HEAD confirmou: somente nova operação e descrição
geral mudaram; operações anteriores, componentes, servidores e versões iguais;
sem security global; cookie na nova operação; respostas somente 200/401/403;
sem requestBody/parameters e operationIds únicos.

Lint verifica documento/exemplos; não chama a API, executa Gate ou transporta
cookies. Nenhuma chamada HTTP/SQL, comando PHP ou nova suíte Laravel nesta
etapa. Última suíte permanece 7.80: 116 testes/1.653 asserções. Backend,
ambientes, dependências, Compose e configuração Redocly preservados.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.82](07-82-consulta-administracao-laboratorio.md): adicionar Consultar
administração ao laboratório de sessão, com GET/credentials include e
tratamento de 200/401/403, sem criar ou promover contas.
Módulos 8 a 23 não iniciados.
