# Verificação de CSRF no logout — protocolo planejado

Desenho da etapa 7.52, em 04/11/2026. Protocolo ainda não executado; os status
abaixo são expectativas. Complementa o [contrato de logout](logout.md) e usa
a experiência do [protocolo de login](verificacao-csrf.md), executado na 7.41.

## Objetivo e alcance

Verificar POST /api/v1/logout por HTTP no Docker, com proteção CSRF ativa,
fora de testing. Visitante com sessão preparada é suficiente para esse
controle: logout também atende visitante, conforme contrato. Não criar User,
autenticar, consultar banco ou enviar credenciais. Os testes de autenticado e
de consulta após logout permanecem em LogoutApiTest.

Guzzle já instalado fará pedidos com CookieJar em memória, sem proxy ou
redirecionamentos, http_errors false e timeout de dez segundos. A chamada
HTTP passa pelo servidor/kernel/rotas reais. Ela não exercita políticas de
cookies, CORS ou Fetch Metadata de navegador.

## Conferido em leitura na 7.52

Bootstrap de console carregou ambiente local, console true/testing false,
configuração sem cache, sessão file/serialização json, cache file e cookie
loja-fullstack-session. Guzzle disponível. Origem 127.0.0.1:8002 reconhecida.
ValidateCsrfToken deriva de PreventRequestForgery; originOnly/allowSameSite
false e exceções vazias. Rota aponta para LoginController::destroy, com
EnsureFrontendRequestsAreStateful e SubstituteBindings, sem auth:sanctum ou
throttle:login. Nenhuma sessão foi iniciada nessa leitura, nem kernel HTTP chamado.

Contagem atual: 54 arquivos de sessão; loteria habitual [2,100]. Recontar antes
da execução. Esses números descrevem a leitura, não uma execução do protocolo.

## Servidor temporário e preservação

Preparar servidor PHP temporário no mesmo container, em porta dinâmica no
loopback, carregando bootstrap/kernel/rotas com ambiente local. Somente nesse
processo, usar session.lottery [0,100] para preservar as sessões anteriores.
Não alterar .env, configuração persistente, servidor habitual ou proteção CSRF.

Antes do primeiro pedido, registrar internamente nomes/hashes de todos os
arquivos anteriores. Aguardar o servidor pronto sem criar sessões extras.
Em cada pedido, conferir metadados do processo HTTP: console false/testing
false, sessão file, CSRF ativo/sem exceções, origem reconhecida e cabeçalhos
controlados. A leitura em console da 7.52 não substitui essa conferência HTTP.

Cliente conecta na porta dinâmica, mantendo Host 127.0.0.1:8002 e Origin
http://127.0.0.1:8002. Accept application/json em todos os pedidos; POST com
Content-Type application/json e objeto vazio {}. Sem Authorization, Referer
conflitante ou credenciais. Não usar a porta habitual para esses controles.

## Selecionar a comparação por token

Nos três POSTs, manter Sec-Fetch-Site, X-CSRF-TOKEN e _token ausentes. Variar
somente X-XSRF-TOKEN. Laravel 13 instalado pode aceitar same-origin antes da
comparação de tokens; deixar Sec-Fetch-Site ausente seleciona o ramo pretendido.
Origin permanece reconhecido para que Sanctum prepare sessão/CSRF.

GET /sanctum/csrf-cookie prepara os cookies. No controle correto, enviar em
X-XSRF-TOKEN o valor URL-decodificado do cookie XSRF-TOKEN, junto ao cookie da
mesma sessão. O middleware decifra o cabeçalho e compara com o token guardado
na sessão; o cliente não precisa conhecer a chave da aplicação.

## Sequência e resultados esperados

| Passo | Pedido | Condição | Esperado |
| --- | --- | --- | --- |
| Preparação | GET /sanctum/csrf-cookie | Sem cookies prévios do diagnóstico | 204 vazio; cookies XSRF-TOKEN e sessão. |
| A | POST /api/v1/logout com {} | Cookies preparados; sem X-XSRF-TOKEN | 419 JSON/message string, sem Location. |
| B | POST /api/v1/logout com {} | Mesma sessão; X-XSRF-TOKEN inválido | 419 JSON/message string, sem Location. |
| C | POST /api/v1/logout com {} | Mesma sessão; X-XSRF-TOKEN correto | 204 vazio/sem Location; sessão invalidada e renovada. |

Os controles A/B devem ser recusados antes de executar logout. Conferir ID e
token preservados entre a preparação e esses controles, por comparação interna.
Não fechar o objeto 419 em apenas message: detalhes de diagnóstico podem existir.
Registrar somente status, tipos e condições booleanas, sem respostas brutas.

No C, o 204 deve vir acompanhado de cookies atualizados, ID e token diferentes,
remoção do registro antigo e sessão resultante sem identidade. Diferentemente
do protocolo de login com {}, aqui o sucesso esperado é 204: logout não exige
email/password e visitante pode concluir a ação. Nenhuma autenticação é criada.

Se um resultado divergir, verificar origem, ramo CSRF e metadados antes de tirar
conclusões. Não alterar middleware para fazer o protocolo passar. A rota não
usa o limitador login; nenhum contador preexistente deve ser zerado.

## Identificar sessões próprias e limpar

Guardar internamente o ID da preparação e os IDs resultantes dos pedidos,
derivados dos cookies/Store da própria execução, sem imprimi-los. Validar
formato e ausência na lista inicial antes de atribuir qualquer arquivo ao
diagnóstico. O conjunto precisa acompanhar a troca de ID após o controle C.

O logout deve destruir o arquivo original e pode deixar outro arquivo visitante.
Em finally, encerrar o servidor e remover apenas arquivos próprios ainda
existentes e auxiliares temporários. Se a execução parar antes de C, limpar a
sessão original própria. Não remover arquivo de origem desconhecida nem usar
limpeza global de sessões/cache. Conferir nomes/hashes anteriores preservados
e configuração habitual [2,100] em novo processo após encerrar o servidor.

Nenhum cookie, token, ID, chave, hash privado ou resposta bruta será impresso
ou versionado. Comparações internas podem usar esses valores em memória.
Não adicionar dependências, containers, usuários ou alterações no banco.

## Estado e próximo passo

Protocolo escrito/explicado; fontes oficiais, código instalado e configuração
conferidos em leitura. Nenhum servidor iniciado, pedido HTTP, sessão nova ou
consulta SQL nesta etapa. Sem nova suíte; última 7.51: 107 testes/1.586 asserções.
Entendimento da 7.52 confirmado com "entendi" em 04/11/2026; publicação pendente.
Após confirmar/publicar, 7.53 executará somente este protocolo e registrará
observações, limpeza e limites. Navegador/CORS e OpenAPI de logout pendentes.

Referências: [CSRF e verificação de origem](https://laravel.com/docs/13.x/csrf#origin-verification),
[cookies e cabeçalho CSRF no Sanctum](https://laravel.com/docs/13.x/sanctum#authenticating)
e [logout/invalidação/token](https://laravel.com/docs/13.x/authentication#logging-out).
