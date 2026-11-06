# Aula 7.89 — Revisão de autenticação e autorização

Revisão apresentada em 05/11/2026, após a
[7.88](07-88-testes-policy-produto.md) confirmada com "entendi".
Checkpoint anterior publicado e conferido em
b1b19211816fa63ff41d37c0baeb0697ebbc960b; HEAD/origin/main/main remota iguais.
Somente documentação. Revisão aceita e módulo 7 concluído em 05/11/2026;
publicação pendente. Curso pausado a pedido do aluno para retomar o módulo 8
em outro chat.

## O fluxo que construímos

1. Preparar CSRF com GET /sanctum/csrf-cookie. A resposta 204 prepara a
   proteção necessária aos POSTs do laboratório; isso não realiza login.
2. Enviar email/password ao POST /api/v1/login com cookies e cabeçalho CSRF.
   LoginRequest valida a entrada; Auth verifica as credenciais; o controller
   regenera a sessão e responde 204 quando o login é aceito.
3. Consultar GET /api/v1/usuario. Auth:sanctum exige uma identidade autenticada.
   UsuarioResource apresenta somente id/name/email.
4. Consultar GET /api/v1/administracao. Primeiro auth:sanctum identifica o
   usuário, depois can:acessar-administracao consulta o Gate no backend.
5. Enviar POST /api/v1/logout com sessão/CSRF. O controller encerra a
   autenticação, invalida a sessão e regenera o token CSRF; responde 204.
   Uma nova consulta protegida deve voltar a 401.

O [LoginController](../../backend/app/Http/Controllers/Api/V1/LoginController.php)
contém login/logout; [routes/api.php](../../backend/routes/api.php) relaciona
rotas, controllers e middlewares. O fluxo usa o laboratório em
127.0.0.1:8001 e a API em 127.0.0.1:8002.

## Cada proteção responde a uma pergunta

| Conceito | Papel no projeto |
| --- | --- |
| Hashing | O cast hashed de User prepara a senha para armazenamento como hash; a autenticação verifica as credenciais |
| Sessão/cookie | O navegador transporta o identificador da sessão que o backend reconhece; possuir cookie não demonstra usuário autenticado |
| CSRF | Token da sessão acompanha as requisições que exigem essa proteção; obter o token não autentica o usuário |
| CORS | A configuração permite o consumo com credenciais pela origem local 8001; não atribui perfil administrativo |
| Validação | LoginRequest confere o formato das entradas; dados válidos ainda podem ser credenciais recusadas |
| Limite de tentativas | Throttle de login limita requisições por IP; recusa prevista com 429 |
| Autenticação | Auth:sanctum exige a identidade de uma sessão autenticada nas rotas protegidas |
| Autorização | Gate e Policy decidem se a identidade pode executar a ação |

Configurações e regras foram revistas em
[User](../../backend/app/Models/User.php),
[LoginRequest](../../backend/app/Http/Requests/LoginRequest.php),
[cors.php](../../backend/config/cors.php) e
[AppServiceProvider](../../backend/app/Providers/AppServiceProvider.php).
Nenhuma senha, cookie ou configuração privada foi lida ou alterada nesta revisão.

## Autenticação e permissão na administração

| Situação | GET /api/v1/administracao |
| --- | --- |
| Visitante, mesmo com cookie de sessão/CSRF | 401, sem autenticação |
| Cliente autenticado | 403, sem permissão administrativa |
| Administrador autenticado | 200, acesso permitido |
| Administrador depois do logout | 401, sessão sem autenticação |

O logout não remove is_admin da conta. Ele encerra a autenticação daquela
sessão. Login não promove cliente: is_admin é definido no backend, fora do
Fillable de User e sem fazer parte dos campos de credenciais.

Os seeders locais prepararam identidades separadas, com criação relatada pelo
aluno: aluno@example.test e admin@example.test. As senhas foram escolhidas em
campos ocultos no terminal e não enviadas ao assistente.

## Gate e Policy

O Gate acessar-administracao verifica is_admin estritamente true. A rota
administrativa já o consulta por middleware can, após auth:sanctum.

A [ProdutoPolicy](../../backend/app/Policies/ProdutoPolicy.php) organiza a
permissão update para um Produto. Recebe User/Produto e permite o administrador.
É descoberta automaticamente. Consultamos essa regra pelo Gate nos testes:

```php
Gate::forUser($usuario)->allows('update', $produto);
```

Essa consulta devolve uma decisão e preserva o produto. A permissão foi
definida/testada; ainda não há rota de atualização de produto. Não confundir
essa entrega com um CRUD de produtos protegido e completo.

## O que as verificações demonstram

- As aulas 7.83 e 7.86 tiveram relatos gerais de sucesso no navegador, sem
  mensagens/status individuais transcritos. O assistente não observou nem
  controlou o navegador; não preencher resultados que não foram relatados.
- Testes HTTP da administração atravessam rota, middlewares, Gate e controller,
  usando identidades em memória; verificam 401/403/200 e respostas JSON.
- Os [testes da Policy](../../backend/tests/Feature/ProdutoPolicyTest.php)
  verificam descoberta real pelo Gate, decisões, produtos intactos e zero SQL.
- A última suíte completa, executada na 7.88, passou com 121 testes e
  1.693 asserções. Ela inclui integrações no banco exclusivo loja_test;
  não dizer que a suíte inteira é sem SQL. Não foi repetida nesta revisão.
- O contrato HTTP permanece no [OpenAPI](../api/openapi.json).

Nesta etapa, apenas leitura de código/roteiro/progresso e verificação dos
documentos/Git. Nenhuma requisição API, SQL, nova conta, login, dependência ou
mudança na aplicação. A atividade sugerida de acompanhamento no DBeaver segue
sem relato; não foi registrada como concluída.

## Continuidade

Revisão aceita e encerramento do módulo 7 confirmado em 05/11/2026 com
"podemos concluir, iniciaremos o modulo 8 amanhã em outro chat". Módulos
1 a 7 concluídos. Não há dúvida nova relatada. Publicar o checkpoint 7.89
e manter o curso pausado conforme pedido do aluno.

Próximo ponto exato: 8.1 — estrutura HTML da vitrine, no módulo de
HTML5/CSS3/JavaScript moderno, reaproveitando a API de catálogo. Retomada
prevista para 06/11/2026 em outro chat, quando solicitada. Ler AGENTS.md,
docs/curso.md e docs/progresso.md e conferir o Git ao retomar.
Nenhum arquivo ou conteúdo de implementação do módulo 8 foi iniciado
nesta etapa. Módulos 8 a 23 não iniciados.
