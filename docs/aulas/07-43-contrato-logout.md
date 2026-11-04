# Aula 7.43 — Contrato de logout por sessão

Desenho, explicação e verificações em 04/11/2026, após confirmação da 7.42
com "entendi". Checkpoint anterior publicado e conferido em
5f2b770ed8fb25ac2f612553d64c730644a0f18e; HEAD/origin/main/main remota iguais.
Entendimento da 7.43 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos o [contrato planejado de logout](../api/logout.md). Ele se relaciona ao
[login](../api/login.md), que estabelece identidade, e à
[consulta do usuário](../api/autenticacao.md), que verifica a identidade atual.
Nenhum endpoint de logout foi implementado nesta etapa.

POST /api/v1/logout terá Accept JSON, sem corpo obrigatório. Um JSON vazio é
permitido. Sessão/cookies e proteção CSRF seguem o fluxo da interface própria.
O cliente não escolhe quem sai enviando ID, email ou senha; a sessão atual
determina o escopo. GET não será usado para alterar autenticação.

## Comportamento definido

| Condição | Resposta planejada |
| --- | --- |
| Autenticado, sessão/CSRF válidos | 204 vazio; logout web, invalidação e novo token CSRF. |
| Visitante, sessão/CSRF válidos | Mesmo 204 vazio; nova sessão visitante. |
| Proteção CSRF rejeita | 419 JSON/message; controller não executa logout. |
| GET usuario após sucesso, cookies resultantes e sem outra autenticação | 401 JSON pela rota protegida existente. |

Aceitar visitante é uma decisão do projeto para concluir a ação sair mesmo
quando a autenticação já expirou. Não exigiremos auth:sanctum no logout;
as condições de sessão/CSRF permanecem. Repetir com os cookies/token atualizados
é permitido. Token antigo pode falhar após a invalidação, conforme o ramo CSRF.

A sequência planejada tem três responsabilidades: logout remove identidade do
guard web; invalidate limpa atributos e destrói o registro antigo/gera novo ID;
regenerateToken cria outro token CSRF. Invalidate sozinho não faz a terceira
parte. O marcador preservado após login será descartado ao sair.

204 não tem JSON a decodificar nem redirecionamento. Cookies atualizados podem
manter uma sessão visitante, sem identidade. Apagar o usuário apenas da tela
não invalida a autenticação no servidor. Escopo de sessão atual, sem recurso
de sair em todos os dispositivos ou revogar tokens de API.

## Verificações desta etapa

Referências oficiais Laravel 13 sobre logout, Sanctum e CSRF conferidas.
Fonte efetivamente instalada consultada no Docker, por leitura: SessionGuard
logout, Store invalidate/migrate/regenerateToken,
EnsureFrontendRequestsAreStateful e PreventRequestForgery. As dependências
estão no volume vendor-backend, não em backend/vendor no host.

O código confirma as responsabilidades dos métodos, o suporte a guard visitante,
a necessidade de regenerar o token após invalidate, sessão/CSRF aplicados às
origens reconhecidas e o ramo Sec-Fetch-Site same-origin. Rotas/bootstrap e
LoginController atuais conferidos: há login/consulta/catálogo, sem logout.
Git diff --check passou. Links locais válidos: contrato de logout três,
aula 7.43 três, consulta cinco, login quatro, limite um, protocolo CSRF três,
aula 7.42 dois. Comparação de escopo confirmou aplicação/Compose/OpenAPI sem
diff e índice vazio; somente documentos alterados.
Consultas não executaram logout ou iniciaram sessão. Não há resposta real de
logout observada nesta etapa; verificações futuras estão listadas no contrato.

## Continuidade

Contrato apresentado; entendimento confirmado com "entendi" em 04/11/2026.
Aplicação/Compose/OpenAPI preservados. Sem PHP, SQL, HTTP ou nova suíte Laravel.
Última suíte permanece 7.39: 101 testes/1.407 asserções.
Publicação da 7.43 concluída e conferida em
86ab952bfd858f2fed5a2d2f47a2bf44b8c93171; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.44 —
somente LoginController::destroy. Navegador/CORS e OpenAPI ficam pendentes.
