# Aula 7.83 — Autorização no navegador

Roteiro apresentado em 05/11/2026, após entendimento da
[7.82](07-82-consulta-administracao-laboratorio.md) confirmado com "entendi".
Checkpoint anterior publicado e conferido em
d45a16a1d8c86a377ec185f33eea53c16cbc51c8; HEAD/origin/main/main remota iguais.
Aluno relatou sucesso geral em 05/11/2026; entendimento confirmado com "entendi".
Somente documentação alterada nesta etapa.

## Objetivo

Observar a consulta administrativa com a sessão visitante, com o cliente
autenticado e depois do logout. A consulta do próprio usuário entre as ações
permite distinguir autenticação aceita de permissão administrativa recusada.

O assistente acompanha pelo roteiro e pelo relato; não controla nem observa
o navegador nesta sessão. Não preencheremos resultados individuais que não
tenham sido informados.

## Preparação no Chrome ou Edge

Use a sessão privativa do laboratório sem login ativo e recarregue
http://127.0.0.1:8001/laboratorio-sessao.html. Abra F12 → Rede → Todos/All,
retire filtros de texto anteriores e deixe o painel gravando antes dos cliques.
O novo botão Consultar administração deve estar visível.

Use aluno@example.test e a senha escolhida no terminal na 7.66. Digite-a
somente no formulário; o placeholder não preenche o e-mail. O indicador dessa
conta foi conferido como false na 7.73 e nenhuma promoção foi feita nas
etapas seguintes. O 403 depois do login é o resultado esperado nesta atividade.

Envie somente mensagens/status e observações públicas de CORS/nomes de cookies.
Não copie senha, Payload do login, valores de cookies/tokens, cabeçalhos
completos, HAR ou capturas que incluam esses dados.

## Sete ações, uma de cada vez

Espere a mensagem de cada ação e anote seu resultado antes de continuar.
As três consultas administrativas usam o mesmo parágrafo, que será sobrescrito.

| Ação | Requisição | Status esperado |
| --- | --- | --- |
| Solicitar cookie CSRF | GET /sanctum/csrf-cookie | 204 |
| Consultar administração, antes de entrar | GET /api/v1/administracao | 401 |
| Preencher a conta de laboratório e Entrar uma vez | POST /api/v1/login | 204 |
| Consultar usuário | GET /api/v1/usuario | 200 |
| Consultar administração, depois de entrar | GET /api/v1/administracao | 403 |
| Encerrar sessão | POST /api/v1/logout | 204 |
| Consultar administração novamente | GET /api/v1/administracao | 401 |

Ignore OPTIONS ao transcrever essa sequência: preflight não é o POST de login
ou logout. Use método/caminho na Rede para identificar a requisição da ação.
As mensagens locais HTTP 401 e 403 são os resultados esperados, mesmo quando
as linhas correspondentes aparecem em vermelho no painel.

Se o primeiro acesso já indicar autenticação ou houver outra divergência,
pare nessa ação e informe a mensagem/status. Não é necessário repetir login,
recriar a conta ou compartilhar a senha para iniciar o diagnóstico.

## O que o fluxo demonstra

Antes de entrar, auth:sanctum deve recusar a consulta administrativa com 401.
Após o login 204, a consulta do usuário 200 demonstra que a sessão autenticada
foi reconhecida. Com essa mesma identidade de cliente, o Gate administrativo
deve recusar com 403. Fazer login não modifica is_admin. Após sair, a nova
consulta administrativa deve voltar a 401.

Os valores da tabela são expectativas. O aluno relatou sucesso geral, sem
transcrever os resultados individuais; os testes internos e a simulação da
aula anterior não substituem a observação no navegador.
O 200 administrativo já teve verificação interna, mas não será o resultado
esperado com esta conta de cliente. Não promoveremos contas nesta etapa.

## CORS e cookies

Nas requisições administracao, confira nas respostas os cabeçalhos públicos
Access-Control-Allow-Origin (http://127.0.0.1:8001) e
Access-Control-Allow-Credentials (true). Informe se conferem com esses valores.
Na aba Cookies de cada requisição, observe os nomes enviados, como
loja-fullstack-session e XSRF-TOKEN, e eventual indicação de bloqueio.
Registre somente nomes/presença/bloqueios, sem seus valores.

Cookies armazenados e cookies enviados são observações diferentes. Uma
mensagem de erro HTTP legível também é diferente de falha genérica de
rede/leitura: nesta última, não atribua um status que a página não conseguiu
ler. Referência do painel: [Chrome DevTools](https://developer.chrome.com/docs/devtools/network/reference#cookies).

## Verificação e continuidade

Docker Compose confirmou backend/php/sqlserver ativos, sem executar pedido
da API ou SQL pelo assistente. Página e aplicação mantidas conforme a 7.82.
Sem nova suíte: última 7.80, 116 testes/1.653 asserções.
Os contratos de [administração](../api/administracao.md),
[login](../api/login.md) e [logout](../api/logout.md) permanecem.

Relato recebido: "deu tudo certo, avante". Sucesso registrado de forma geral;
status individuais e observações de CORS/cookies não foram transcritos.
O assistente não observou diretamente o navegador.

Entendimento confirmado com "entendi" em 05/11/2026 sobre a diferença entre
usuário autenticado sem permissão administrativa (403) e ausência de
autenticação após logout (401).
Próximo passo exato: publicar a 7.83 e iniciar a 7.84, preparando uma conta
administrativa separada da conta de cliente do laboratório.
Publicação da 7.83 pendente; módulos 8 a 23 não iniciados.
