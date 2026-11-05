# Aula 7.86 — Acesso administrativo no navegador

Roteiro apresentado em 05/11/2026 após a
[7.85](07-85-criacao-administrador-laboratorio.md) confirmada com "entendi".
Checkpoint anterior publicado e conferido em
a8bf8d8fb14fe47865736f6af7aa448ee34ebb17; HEAD/origin/main/main remota iguais.
Aluno relatou sucesso geral em 05/11/2026; entendimento confirmado com "entendi".

## Objetivo e preparação

Verificar o acesso administrativo com a conta admin@example.test, cuja criação
foi relatada pelo aluno na 7.85. Na 7.83, o cliente aluno@example.test teve
relato geral de sucesso no roteiro de recusa; agora a consulta administrativa
deve ser permitida após autenticação da conta administrativa.

Use Chrome/Edge, na sessão privativa do laboratório sem login ativo. Recarregue
http://127.0.0.1:8001/laboratorio-sessao.html. Abra F12 → Rede → Todos/All,
sem filtros de texto, antes de executar as ações.

Preencha admin@example.test no campo E-mail; o placeholder aluno@example.test
é só um exemplo visual. Digite a senha escolhida no terminal na 7.85 somente
no formulário. Não enviar senha, payload, valores de cookies, tokens ou
cabeçalhos completos. Não recriar a conta nem alterar permissões nesta aula.

## Sequência de verificação

Execute cada ação uma vez, aguarde sua resposta e anote antes de continuar.
As consultas administrativas sobrescrevem o mesmo parágrafo de resultado.

| Ação | Requisição | Status esperado |
| --- | --- | --- |
| Solicitar cookie CSRF | GET /sanctum/csrf-cookie | 204 |
| Consultar administração antes de entrar | GET /api/v1/administracao | 401 |
| Entrar com admin@example.test e a senha da 7.85 | POST /api/v1/login | 204 |
| Consultar usuário | GET /api/v1/usuario | 200 |
| Consultar administração | GET /api/v1/administracao | 200 |
| Encerrar sessão | POST /api/v1/logout | 204 |
| Consultar administração novamente | GET /api/v1/administracao | 401 |

OPTIONS, quando aparecer, é a negociação anterior à requisição; não contar
como resposta do POST. Se houver divergência, parar e enviar somente a ação
e a mensagem/status observado. Não repetir tentativas de login automaticamente.
Uma falha genérica de rede não informa um status HTTP que possamos atribuir.

## O que esperamos demonstrar

Antes do login, auth:sanctum recusa com 401. O login 204 seguido de usuário
200 demonstra a sessão reconhecida. Na consulta administrativa, auth:sanctum
identifica o usuário e can:acessar-administracao consulta o Gate, que compara
is_admin com true. O 200 administrativo esperado demonstra permissão aceita.
Depois do logout 204, a nova consulta administrativa deve retornar 401.

O formulário envia email/password no login. A permissão vem do User carregado
pelo backend; não é enviada como is_admin pelo navegador.
Os valores da tabela são expectativas. O aluno relatou sucesso geral, sem
transcrever resultados individuais. Logout encerra a autenticação da sessão,
sem remover is_admin da conta no banco.

## Verificação e continuidade

O assistente conferiu página, rota e Gate e verificou backend/php/sqlserver
ativos por Docker Compose. Somente documentação alterada; nenhum pedido de
API, SQL, login ou alteração de conta pelo assistente nesta etapa. Não há
ferramenta de controle ou observação do navegador nesta sessão; acompanhamento
por roteiro e relato do aluno. Nenhuma suíte repetida: última completa na
7.80, 116 testes/1.653 asserções; diagnóstico do seeder na 7.84, 11 cenários/
28 verificações simuladas. Os contratos HTTP permanecem.

Relato recebido: "deu tudo certo, pode avançar". Sucesso registrado de forma
geral, sem mensagens/status individuais transcritos. O assistente não
observou diretamente o navegador.

Entendimento confirmado com "entendi" em 05/11/2026: o 200 administrativo
após login reúne autenticação e permissão aceita; o 401 após logout indica
ausência de autenticação, sem perda do perfil administrativo.
Próximo passo exato: publicar a 7.86 e iniciar a 7.87, primeira Policy de produto.
Policies ainda pendentes no módulo 7; módulos 8 a 23 não iniciados.
