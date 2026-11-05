# Aula 7.52 — Desenho da verificação CSRF do logout

Desenho, explicação e verificações em 04/11/2026, após confirmação da 7.51
com "entendi". Checkpoint anterior publicado e conferido em
d0e2be7d9a1010f86f2975cae1d0e7589cc4bf07; HEAD/origin/main/main remota iguais.
Entendimento da 7.52 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Criamos o [protocolo planejado de CSRF no logout](../api/verificacao-csrf-logout.md),
complementando o [contrato](../api/logout.md). A preparação usa a experiência
do [protocolo de login](../api/verificacao-csrf.md). Nenhum pedido HTTP de logout
com CSRF ativo foi executado nesta etapa.

Os testes pelo kernel em testing ignoram a checagem CSRF. O novo protocolo
prevê Guzzle já instalado, CookieJar em memória e servidor PHP temporário no
Docker, com ambiente local/CSRF ativo. Visitante com sessão basta para este
controle, sem User, credenciais ou SQL. Navegador/CORS continuam separados.

## Conceito e sequência planejada

Origin reconhecido mantém preparação de sessão/CSRF pelo Sanctum. Sec-Fetch-Site
fica ausente, assim como _token e X-CSRF-TOKEN, para selecionar comparação por
X-XSRF-TOKEN. No ramo correto, o cabeçalho recebe XSRF-TOKEN URL-decodificado.

| Pedido | Esperado, ainda não observado |
| --- | --- |
| GET csrf-cookie | 204 vazio e cookies. |
| POST logout sem cabeçalho | 419 JSON/message, sem Location. |
| POST logout com valor inválido | 419 JSON/message, sem Location. |
| POST logout com valor correto | 204 vazio, sessão invalidada/renovada. |

A/B devem preservar a sessão original; C deve trocar ID/token e remover o
registro anterior, continuando visitante. O contrato permite logout visitante,
por isso o controle correto espera 204. O login com {} da 7.41 chegou a 422.

## Preservação e limpeza planejadas

A leitura encontrou 54 arquivos e loteria habitual [2,100]. Para preservar
esses arquivos, o protocolo usará servidor temporário/porta dinâmica, com
coleta [0,100] só nesse processo. Host/Origin 8002 mantidos, middleware normal
e sem exceção CSRF. Metadados HTTP deverão confirmar console false/testing false.

Registrar nomes/hashes anteriores sem expor IDs. Acompanhar sessões próprias
antes/depois do logout, validar que não existiam inicialmente e, em finally,
encerrar servidor/remover somente arquivos próprios remanescentes e auxiliares.
O logout pode apagar um arquivo e criar outro visitante; limpar apenas o ID
inicial seria insuficiente. Conferir preservação e configuração habitual depois.

## Verificações desta etapa

Fontes oficiais Laravel 13 de CSRF, Sanctum e logout conferidas. Código instalado
PreventRequestForgery, Store invalidate/migrate e reconhecimento de frontend
Sanctum lidos no Docker. Diagnóstico PHP de leitura carregou bootstrap de console:
local/console true/testing false, configuração sem cache, file/json/cache file,
cookie loja-fullstack-session, origem reconhecida e Guzzle disponível. Classe
ValidateCsrfToken, originOnly/allowSameSite false e exceções vazias conferidos.
Rota destroy com EnsureFrontendRequestsAreStateful/SubstituteBindings, sem auth
ou limitador login. Código 0/sucesso true; só metadados permitidos impressos.

Criar Request para reconhecer origem e localizar rota nessa leitura não chama
kernel handle, inicia sessão ou envia HTTP. A inspeção de console não substitui
os metadados do processo HTTP previstos para a execução.

Git diff --check passou. Links locais válidos: logout quatro, login cinco,
consulta seis, protocolo de login quatro, protocolo de logout dois, aulas
7.51/7.52 dois e três respectivamente. Somente documentos alterados, índice
vazio; backend/Compose/OpenAPI preservados.

## Continuidade

Protocolo escrito, explicado e conferido; entendimento confirmado em 04/11/2026.
Aplicação, configuração, ambientes, dependências, serviços, rotas, migrations,
testes, bootstrap, Compose e OpenAPI preservados. Sem servidor novo, HTTP, sessão
nova, SQL, nova suíte, auditoria ou snapshot. Última suíte 7.51: 107/1.586.
Publicação da 7.52 pendente. Próxima após confirmar/publicar: 7.53 — executar
somente o protocolo e registrar respostas, metadados, preservação e limpeza.
Navegador/CORS e OpenAPI de logout seguem pendentes.
