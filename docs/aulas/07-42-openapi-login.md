# Aula 7.42 — Login no OpenAPI

Implementação documental, explicação e verificações em 04/11/2026, após
confirmação da 7.41 com "entendi". Checkpoint anterior publicado e conferido em
091ba33ce6f69f93a9c1cb0b1b4b182d89a14597; HEAD/origin/main/main remota iguais.
Entendimento da 7.42 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Integramos POST /api/v1/login ao [OpenAPI](../api/openapi.json), seguindo o
[contrato em português](../api/login.md) e os comportamentos já verificados.
O arquivo ganhou a operação autenticarUsuario e quatro schemas. A descrição
geral passou a incluir login; a descrição de GET usuario foi atualizada para
referenciá-lo. Nenhuma rota ou regra da aplicação foi alterada.

Versão OpenAPI 3.2.1, info.version 0.1.0, servidores, catálogo, esquemas
Usuario/Produto e segurança da consulta protegida permanecem iguais.

## Corpo JSON e schema

```json
"requestBody": {
  "required": true,
  "content": {
    "application/json": {
      "schema": {
        "$ref": "#/components/schemas/CredenciaisLogin"
      }
    }
  }
}
```

RequestBody descreve o corpo; required exige sua presença. Content seleciona
JSON e $ref aponta ao schema compartilhado. CredenciaisLogin exige email e
password, ambos strings não vazias pelo tipo/minLength. Exemplo fictício com
ana@example.test/senha-ficticia-do-exemplo; não é uma conta fornecida pela API.

As descrições registram as regras de LoginRequest: email normalizado antes
do formato/limite 255, senha preservada e recusa de senha composta só por
espaços. O schema estrutural não reproduz integralmente essas regras. Não
aplicamos format/maxLength sobre o email bruto como se já tivesse passado
por TrimStrings. O validador OpenAPI não executa a normalização do Laravel.

AdditionalProperties true admite campos extras na entrada, que validated
descarta das credenciais. Isso não transforma remember/id em opções suportadas.

## Visitante, sessão e cabeçalho CSRF

Security [] deixa explícito que a operação não exige identidade autenticada
previamente. O fluxo continua exigindo preparação de sessão/CSRF da interface
própria, descrita na operação: Origin/Referer reconhecido, cookies e endpoint
csrf-cookie. Não alteramos SessaoCookie ou a exigência da consulta GET usuario.

X-XSRF-TOKEN é parâmetro de header string, com required false e explicação da
condição: na comparação por token, recebe o valor URL-decodificado do cookie;
Sec-Fetch-Site same-origin pode permitir antes dessa comparação no Laravel 13.
Nenhum valor de cookie/token aparece como exemplo. Não documentamos Bearer.

## Respostas e demais schemas

| Status | Representação |
| --- | --- |
| 204 | Apenas descrição, sem content; sucesso vazio e renovação de sessão/CSRF. |
| 419 | ErroCsrf: message string obrigatório; campos adicionais permitidos. |
| 422 | ErroValidacaoLogin: somente message/errors; errors tem email e/ou password, listas não vazias de strings. |
| 429 | ErroLimiteLogin: somente message string; cabeçalhos de limitação documentados. |

No 419, descrevemos o mínimo verificado sem fechar possíveis campos de
diagnóstico. No 422 e no 429, additionalProperties false preserva os corpos
definidos no contrato/testes. Errors do 422 também é fechado, com minProperties 1.
Dois exemplos 422 representam entrada inválida e credenciais recusadas; texto
ilustrativo, sem prometer tradução fixa ou distinguir existência de conta.

Headers do 429: Retry-After inteiro mínimo 0/variável, X-RateLimit-Limit igual
a 5, X-RateLimit-Remaining igual a 0 e Cache-Control string com diretiva no-store.
Required true marca cada cabeçalho obrigatório no contrato. Exemplos 60/5/0/
no-store, private são ilustrativos; não fixamos a ordem de diretivas ou a espera
sempre em 60. Header Object usa o nome da chave do mapa, sem repetir name/in.

Referências: [operação e security](https://spec.openapis.org/oas/v3.2.1.html#operation-object),
[requestBody](https://spec.openapis.org/oas/v3.2.1.html#request-body-object) e
[headers de resposta](https://spec.openapis.org/oas/v3.2.1.html#header-object).

## Validação no Docker

```sh
docker run --rm --pull=never --network none \
  --volume "$PWD/docs/api:/spec:ro" --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

Usamos imagem/configuração já fixadas. Pull never evita buscar outra imagem;
network none impede rede; montagem ro deixa o documento só para leitura. Lint
confere estrutura e exemplos pela configuração existente. Documento passou,
código 0, sem avisos. Nenhuma dependência instalada ou atualizada.

Seis cópias temporárias do documento completo alteraram somente exemplos:

| Alteração na cópia | Resultado |
| --- | --- |
| Request sem password | Rejeitada, código 1, campo obrigatório. |
| Email numérico | Rejeitada, código 1, tipo string exigido. |
| Errors 422 com campo desconhecido | Rejeitada, código 1, propriedade extra. |
| Corpo 429 com errors adicional | Rejeitada, código 1, propriedade extra. |
| Request com id/remember extras | Aceita, código 0, estrutura permite extras. |
| Corpo 419 com campo fictício adicional | Aceita, código 0, contrato mínimo aberto. |

As rejeições vieram de no-invalid-media-type-examples pelos motivos esperados.
Todas as cópias foram removidas. Comparação estruturada com HEAD confirmou
preservação dos contratos anteriores; em GET usuario só a descrição mudou.
204 não contém content, login tem security vazio e não há security global.
Validação de exemplos não executa a API ou prova todas as regras de LoginRequest.

Git diff --check passou. Links locais conferidos: consulta quatro, limite um,
login três, protocolo CSRF três, aulas 7.41/7.42 um e dois respectivamente.
Backend/Compose sem diff; índice vazio. Alterações locais apenas na documentação.

## Continuidade

OpenAPI atualizado, explicado e verificado; entendimento confirmado em 04/11/2026.
Contratos/registros atualizados; aplicação/Compose/ambientes/dependências
preservados. Sem SQL, HTTP, nova suíte Laravel, auditoria ou recaptura de corpos.
Última suíte permanece 7.39: 101 testes/1.407 asserções.
Publicação da 7.42 pendente. Após confirmar/publicar: 7.43 — desenhar o contrato
de POST /api/v1/logout, com sessão/CSRF, resposta e comportamento para visitante,
antes de implementar logout. Navegador/CORS seguem pendentes.
