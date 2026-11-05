# Aula 7.68 — Ciclo de autenticação no navegador

Roteiro apresentado em 05/11/2026. Execução bem-sucedida por relato geral;
entendimento confirmado com "sim" em 05/11/2026; publicação conferida em
b0c0930b1a0e3e6924a6c9370e2f12080bc71220, HEAD/origin/main/main remota iguais.
Registro atualizado após a publicação.
Iniciada após confirmação da [7.67](07-67-formulario-login-laboratorio.md)
com "entendi" e publicação conferida em
9d61d39a573de7551b658e3baf5a1e86ecb6a8fb: HEAD/origin/main/main remota iguais.

## Objetivo

Usar o formulário existente para acompanhar uma sessão: preparar CSRF, entrar,
consultar o usuário autenticado, sair e consultar novamente. Nenhuma alteração
na aplicação nesta etapa. O laboratório é
[src/laboratorio-sessao.html](../../src/laboratorio-sessao.html).

O assistente não controla nem observa seu navegador nesta sessão. O resultado
será registrado conforme seu relato, sem preencher observações não informadas.

## Preparação

No Chrome ou Edge, use a janela privativa do laboratório e recarregue
http://127.0.0.1:8001/laboratorio-sessao.html. Mantenha esse endereço com
127.0.0.1, conforme a origem permitida. Abra F12 → Rede → Todos/All e retire
filtros de texto anteriores, como logout. Deixe o painel gravando antes das ações.

Use aluno@example.test e a senha exclusiva escolhida no terminal na 7.66.
Digite a senha somente no formulário. O placeholder do e-mail não preenche
o campo: digite o endereço. Não abra nem copie o Payload do login; não envie
senha, valores de cookies/tokens, cabeçalhos completos, HAR ou capturas com
esses dados. Para o acompanhamento bastam mensagens, status e nomes/presença.

## Cinco ações, uma de cada vez

Espere a mensagem de cada ação antes de continuar. Anote o primeiro resultado
da consulta antes de fazer a segunda: ambas usam o mesmo parágrafo na tela.

| Ação | Requisição da aplicação | Resultado esperado na página |
| --- | --- | --- |
| Solicitar cookie CSRF | GET /sanctum/csrf-cookie | HTTP 204 (sem corpo). |
| Preencher e-mail/senha e clicar Entrar uma vez | POST /api/v1/login | HTTP 204 (login aceito). |
| Consultar usuário | GET /api/v1/usuario | HTTP 200 (usuário autenticado). |
| Encerrar sessão | POST /api/v1/logout | HTTP 204 (sessão encerrada). |
| Consultar usuário novamente | GET /api/v1/usuario | HTTP 401 (sem autenticação). |

A preparação libera os três botões. Após o envio de login, o código limpa o
campo de senha. O logout lê o cookie CSRF atual; não é necessário preparar
novamente no meio deste fluxo esperado.

Na Rede podem aparecer OPTIONS antes dos POSTs. São preflights CORS:
seus 204 não contam como o resultado do login ou logout. Confira o método
e o caminho da linha selecionada.

## O que observar na Rede

Nas respostas das requisições da aplicação, confira os cabeçalhos CORS:
Access-Control-Allow-Origin deve ser http://127.0.0.1:8001 e
Access-Control-Allow-Credentials deve ser true. Nomes podem aparecer em
minúsculas. Observe os preflights separadamente, caso apareçam.

Nas consultas de usuário, abra a aba Cookies da requisição e observe os nomes
dos cookies enviados: loja-fullstack-session e XSRF-TOKEN. Informe se houver
indicação de bloqueio, sem copiar valores. Armazenamento em Aplicativo e envio
na requisição são observações distintas. Nos POSTs, confira apenas a presença
do cabeçalho X-XSRF-TOKEN; não copie seu valor. O OPTIONS não envia os cookies
da sessão; ele anuncia método e nomes de cabeçalhos do pedido seguinte.

Referência para o painel: [documentação do Chrome DevTools](https://developer.chrome.com/docs/devtools/network/reference#cookies).

## Como interpretar

O primeiro 204 prepara CSRF e cookies. O 204 do POST de login significa que
a API aceitou as credenciais. A consulta protegida 200 seguinte demonstra
que aquela requisição foi reconhecida como autenticada. Depois do logout,
o 401 da nova consulta demonstra ausência de autenticação nessa requisição.
Os cookies podem continuar existindo como sessão visitante.

Esse acompanhamento verifica comportamento observável; não mede valores de
IDs de sessão ou tokens nem exige leitura do corpo com dados do usuário.
Os contratos existentes de [login](../api/login.md),
[autenticação](../api/autenticacao.md) e [logout](../api/logout.md) permanecem.
Referência: [autenticação SPA com Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication).

Se houver divergência, pare nessa ação e informe a mensagem e o status.
422 indica dados inválidos ou credenciais recusadas; 419 indica recusa de
CSRF; 429 indica limite de tentativas. Não repita cliques para forçar sucesso.
Falha genérica de leitura/rede exige observar a Rede; não atribua a ela um
status que a página não conseguiu ler. Não é necessário compartilhar a senha
ou recriar a conta para iniciar o diagnóstico.

## Verificação e continuidade

Docker Compose confirmou php, backend e sqlserver ativos. O assistente não
executou pedidos da API, login, SQL ou nova suíte nesta etapa. Última suíte
Laravel permanece a da 7.58: 107 testes/1.586 asserções. Os controles simulados
da 7.67 não substituem esta execução no navegador.

Relato parcial recebido em 05/11/2026: HTTP 204 (login aceito), HTTP 200
(usuário autenticado) e HTTP 204 (sessão encerrada). Ainda não informados:
status da preparação, consulta após logout e observações individuais de
CORS/cookies/token. Os três resultados informados permanecem distintos dessas
observações pendentes.

Também recebida referência "(anonymous) @ laboratorio-sessao.html:62", sem
mensagem de erro. A linha é o fetch de preparação CSRF; a referência isolada
não demonstra falha, causa ou status HTTP. Solicitar o texto de eventual erro,
sem dados privados.

Retorno posterior: "deu tudo certo, pdoe seguir". Registrado sucesso geral
do exercício, sem novos campos individuais ou mensagem de erro adicional.
Os valores não informados continuam sem confirmação individual.

Reforçada a interpretação: consulta 200 demonstra autenticação daquela
requisição; a consulta após logout deve retornar 401 por ausência de
autenticação. Entendimento confirmado com "sim" em 05/11/2026, após pergunta
explícita sobre essa diferença. Confirmação de entendimento não acrescenta
campos individuais ao relato de execução.
Continuidade iniciada na [7.69](07-69-autorizacao-apos-login.md):
autorização, 401/403 e Gate/Policy; login não concede permissão administrativa.
Introdução sem implementar papel, migration, política ou rota.
Módulos 8 a 23 não iniciados.
