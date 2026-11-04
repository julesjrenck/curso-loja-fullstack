# Aula 7.40 — Desenho da verificação CSRF fora de testing

Implementação documental, explicação e verificações em 04/11/2026, após
confirmação da 7.39 com "entendi". Checkpoint anterior publicado e conferido em
9b7c8dd95ff4fc8470d6fe8272b0540c3a5de4eb; HEAD/origin/main/main remota iguais.
Entendimento da 7.40 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos o [protocolo de verificação CSRF](../api/verificacao-csrf.md).
Ele define o cliente, ambiente, cabeçalhos, cookies, sequência, resultados
esperados e limpeza da futura execução. Nenhum pedido HTTP foi feito agora.
Não criamos script executável, usuários, fixtures ou alteração de aplicação.

Os testes anteriores verificaram login/consulta pelo kernel, com CSRF dispensado
em testing. Agora planejamos observar a comparação real de token no servidor
local, sem usar credenciais: corpo {} produz erros de campos quando chega à
validação. Assim separaremos a recusa CSRF do próximo estágio do fluxo.

## Condições conferidas

Lemos PreventRequestForgery::handle/runningUnitTests/hasValidOrigin/
getTokenFromRequest, o middleware stateful do Sanctum e o bootstrap da aplicação.
Também conferimos LoginRequest, LoginController e regra de limite existentes.
Fontes oficiais Laravel de CSRF e autenticação SPA foram consultadas.

Um diagnóstico PHP de leitura foi enviado por stdin ao Docker, carregando
Laravel no ambiente normal. Sem executar handle de pedido, consultou somente
configuração, flags do middleware por reflexão e resolução da rota/origem.
Conferiu local/runningUnitTests false/configuração sem cache, sessão file/json,
cookie loja-fullstack-session/cache file, origem reconhecida, middleware
ValidateCsrfToken/PreventRequestForgery, originOnly false/allowSameSite false/
exceções vazias e ordem Stateful/ThrottleRequests:login/SubstituteBindings.
Classe Guzzle disponível. Código 0. Docker compose port backend 8000 retornou
127.0.0.1:8002. Nenhuma sessão ou contador foi criado pelo diagnóstico.

## Conceito aplicado ao desenho

O Sanctum usa Origin/Referer para preparar o fluxo stateful. A proteção CSRF
instalada também avalia Sec-Fetch-Site: same-origin pode liberar antes do token.
Por isso o protocolo fixa Origin reconhecido e deixa Sec-Fetch-Site ausente.
Não envia _token/X-CSRF-TOKEN; somente X-XSRF-TOKEN varia.

GET /sanctum/csrf-cookie deve preparar os dois cookies. Depois, com JSON {}:
sem cabeçalho CSRF, esperar 419; cabeçalho inválido, esperar 419; valor correto
obtido do cookie XSRF-TOKEN após URL-decodificação, esperar 422 email/password.
O cookie de sessão acompanha os três pedidos. 422 indica que o fluxo chegou
à validação; não indica autenticação. Middleware decifra o cabeçalho recebido,
sem exigir que o cliente conheça a chave da aplicação.

Cliente Guzzle já instalado será executado dentro do backend, endereço interno
8000/Host e Origin públicos 8002, cookies somente em memória, sem proxy ou
redirecionamentos automáticos e timeout de dez segundos. Transporte real no
container não comprova políticas do navegador ou integração futura de CORS.

O protocolo também prevê 429 como interferência do limitador, preservação de
contadores existentes e limpeza apenas da sessão própria, com comparação dos
arquivos anteriores. Saída resumida, sem valores privados ou resposta bruta.

## Verificação e continuidade

Fonte instalada/configuração e coerência do fluxo foram conferidas; resultados
HTTP continuam esperados, não observados. Sem nova suíte, diagnóstico SQL,
auditoria, snapshot de dados ou quatro contratos. Última suíte permanece a
7.39: 101 testes/1.407 asserções. Não houve alteração de backend, dependências,
ambientes, serviços, rotas, migrations ou OpenAPI.

Desenho apresentado; entendimento confirmado com "entendi" em 04/11/2026.
Publicação da 7.40 concluída e conferida em
655a17b6cfa5f76e9c6b6026c47020f8853db84c; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.41 —
executar esse protocolo com Guzzle
no Docker contra o servidor local, conferir 204/419/419/422, registrar somente
evidências permitidas e remover apenas a sessão criada pelo diagnóstico.
