# Aula 7.54 — Logout no OpenAPI

Implementação documental, explicação e verificações em 05/11/2026, após
confirmação da 7.53 com "entendi" nessa data. Execução HTTP da 7.53 ocorreu em
04/11/2026. Checkpoint anterior publicado e conferido em
5e89f0afead3d2df806e7b16f10cd8ef3ee9698f; HEAD/origin/main/main remota iguais.
Entendimento da 7.54 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Incluímos POST /api/v1/logout no [OpenAPI](../api/openapi.json), seguindo o
[contrato de logout](../api/logout.md). Nova operação encerrarSessao e descrição
geral atualizada. Operações anteriores, componentes, versões e servidores
permanecem iguais. Nenhuma regra de aplicação foi alterada.

## Entrada opcional e visitante

```json
"requestBody": {
  "required": false,
  "content": {
    "application/json": {
      "schema": {
        "type": "object",
        "additionalProperties": true
      },
      "example": {}
    }
  }
}
```

Required false deixa o corpo opcional. Se houver JSON, o contrato descreve um
objeto; o exemplo vazio não exige campos. AdditionalProperties true permite
campos adicionais, que o controller ignora. Enviar id/email não seleciona quem
sai e não cria opções de logout. Login continua exigindo email/password no seu
próprio requestBody/schema, sem mudança nesta etapa.

Security [] permite visitante sem identidade previamente autenticada. As
descrições mantêm cookies/sessão e Origin/Referer reconhecido pelo Sanctum.
X-XSRF-TOKEN é parâmetro de cabeçalho string, required false, com a condição
da comparação por token e valor URL-decodificado do cookie correspondente.
Sec-Fetch-Site same-origin pode permitir antes dessa comparação no Laravel 13.
Não alteramos SessaoCookie ou a exigência da consulta protegida GET usuario.

## Respostas

| Status | Representação |
| --- | --- |
| 204 | Apenas descrição, sem content; corpo vazio e cookies da sessão visitante. |
| 419 | JSON com $ref para ErroCsrf; message string obrigatório, extras permitidos. |

204 atende autenticado e visitante; explica invalidação/renovação de ID/token
e a consulta posterior com cookie, que retorna 401 sem outra autenticação.
Não colocamos 401 como resposta de visitante do logout. Não há redirecionamento
ou JSON a decodificar no sucesso.

419 é recusa antes do controller. Descrição registra o controle com visitante
fora de testing, Sec-Fetch-Site ausente e token ausente/inválido, preservando
ID/token nos dois casos. Reutilizamos ErroCsrf sem criar ou alterar schemas.
Exemplo message ilustrativo, sem prometer idioma fixo ou fechar diagnósticos.

Referências: [requestBody](https://spec.openapis.org/oas/v3.2.1.html#request-body-object),
[security por operação](https://spec.openapis.org/oas/v3.2.1.html#operation-object)
e [respostas](https://spec.openapis.org/oas/v3.2.1.html#response-object).

## Verificação no Docker

```sh
docker run --rm --pull=never --network none \
  --volume "$PWD/docs/api:/spec:ro" --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

Imagem/configuração já fixadas; pull never evita download, network none impede
rede e montagem ro deixa arquivos somente para leitura. Documento completo
passou, código 0/sem avisos. Nenhuma dependência instalada ou atualizada.

Quatro cópias completas alteraram somente exemplos da nova operação:

| Alteração na cópia | Resultado |
| --- | --- |
| 419 sem message | Rejeitada, código 1, campo obrigatório. |
| 419 com message numérico | Rejeitada, código 1, tipo string exigido. |
| 419 com campo fictício de diagnóstico adicional | Aceita, código 0. |
| Corpo JSON com id/email fictícios adicionais | Aceita, código 0. |

Rejeições vieram de no-invalid-media-type-examples pelos motivos esperados.
Cópias/configuração temporárias removidas. Comparação estruturada com HEAD
confirmou todos os caminhos anteriores e componentes iguais, versões/servidores
preservados, sem security global. Nova operação com security vazio, corpo
opcional, somente 204/419, 204 sem content e referência a ErroCsrf conferidos.

Lint de exemplos verifica o documento; não executa a API nem simula um pedido
sem corpo. A ausência de corpo fica descrita por required false e já teve
verificação funcional em etapas anteriores. Sem SQL, HTTP ou nova suíte Laravel.
Última suíte permanece 7.51: 107 testes/1.586 asserções.

Git diff --check passou. Links locais válidos: logout quatro, login cinco,
consulta seis, protocolo de logout três, aulas 7.53/7.54 dois cada. Escopo
conferido: somente documentação/OpenAPI; índice vazio. Backend/Compose preservados.

## Continuidade

OpenAPI atualizado, explicado e verificado; entendimento confirmado em 05/11/2026.
Aplicação, ambientes, dependências, serviços, rotas, migrations, testes,
bootstrap e Compose preservados. Publicação da 7.54 pendente.
Próxima após confirmar/publicar: 7.55 — diagnosticar a configuração efetiva de
CORS do Laravel e explicar Origin, credenciais e preflight, sem alterar
configuração. Tema previsto no módulo 7; navegador/CORS continuam pendentes.
