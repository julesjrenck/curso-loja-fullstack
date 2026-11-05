# Aula 7.69 — Autorização após o login

Introdução apresentada em 05/11/2026, após entendimento da
[7.68](07-68-ciclo-autenticacao-no-navegador.md) confirmado com "sim".
Checkpoint anterior publicado e conferido em
b0c0930b1a0e3e6924a6c9370e2f12080bc71220; HEAD/origin/main/main remota iguais.
Entendimento da 7.69 confirmado com "entendi" em 05/11/2026; publicação
conferida em 82b13cf6c6e196d7e873fed5ba2c338b957bd0c8, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação. Somente documentação alterada nesta etapa.

## Da identidade à permissão

Na aula anterior, o aluno relatou login 204, consulta autenticada 200, logout
204 e depois sucesso geral do exercício. Isso acompanha a autenticação da
sessão. Agora retomamos a distinção da [7.1](07-01-autenticacao-e-autorizacao.md)
para começar a parte de permissões do módulo.

Imagine uma cliente, Ana, que entrou na loja. A sessão permite reconhecer Ana.
Para alterar um preço, o servidor ainda precisa decidir se ela pode executar
essa ação. A regra administrativa será uma verificação adicional.

O 200 de GET /api/v1/usuario confirma que a consulta reconheceu o usuário.
Ele não comprova permissão para administrar produtos. A conta de laboratório
atual não ganhou um papel administrativo ao fazer login.

## 401 e 403 no fluxo que vamos construir

Considere uma futura operação administrativa, com autenticação verificada
antes da regra de permissão. Suponha também que CSRF e os demais requisitos
do pedido já foram atendidos.

| Situação ilustrativa | Decisão esperada |
| --- | --- |
| Visitante tenta executar a operação protegida | 401: falta autenticação válida. |
| Cliente autenticado tenta executar a operação administrativa | 403: a regra recusa a permissão. |
| Administrador autenticado passa pela regra | Prossegue; os dados e a operação ainda precisam ser válidos. |

Passar pela autorização não define sozinho o status de sucesso: ele depende
da operação implementada. Essas situações são um desenho para as próximas
etapas. Ainda não existe endpoint de alteração de preço para testar.

## Onde a regra será verificada

O servidor decide a permissão antes de executar a ação. Ocultar um botão na
interface ajuda a orientar o usuário, mas não aplica essa regra à API: alguém
pode enviar uma requisição por outro cliente HTTP.

No Laravel, um Gate permite definir uma decisão de acesso, como acesso ao
painel administrativo. Uma Policy agrupa decisões relacionadas a um recurso,
como criar ou atualizar produtos. Vamos usá-los conforme a ação estudada,
sem acrescentar um pacote de permissões nesta introdução.

Por padrão, uma recusa feita por Gate::authorize gera uma resposta 403 no
Laravel. Nesta aula o método é apenas mencionado; nenhuma chamada foi
acrescentada à aplicação. Fonte: [autorização no Laravel 13](https://laravel.com/docs/13.x/authorization#introduction)
e [recusa por exceção](https://laravel.com/docs/13.x/authorization#authorizing-or-throwing-exceptions).

## Relação com os arquivos atuais

- [routes/api.php](../../backend/routes/api.php): GET /usuario usa
  auth:sanctum; os dois GETs de produtos continuam públicos. Login e logout
  mantêm seus contratos. Ainda não há rota administrativa nem middleware can.
- [UsuarioController](../../backend/app/Http/Controllers/Api/V1/UsuarioController.php):
  entrega o usuário da requisição ao Resource. Não decide acesso administrativo.
- [User](../../backend/app/Models/User.php) e
  [migration inicial](../../backend/database/migrations/0001_01_01_000000_create_users_table.php):
  não definem atributo de administrador/papel. Não houve consulta ao banco
  para inferir permissões de contas existentes.
- [ListarProdutosRequest](../../backend/app/Http/Requests/ListarProdutosRequest.php):
  authorize retorna true para a leitura pública. Isso permite essa requisição;
  não concede permissão administrativa nem cria autenticação.

## Verificação e próximo passo

Leitura das rotas, controller, User, migration e Form Request existentes;
busca em app/routes/migrations/tests não encontrou Gate, Policy ou atributo
administrativo implementados. Isso confere o código atual; não executa uma
operação administrativa nem demonstra 403 real. Sem API, SQL, comandos PHP,
alteração de banco ou nova suíte. Última suíte permanece 7.58: 107 testes e
1.586 asserções.

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.70](07-70-planejamento-indicador-administrador.md): desenhar a representação
mínima de cliente/administrador no User, com padrão
sem privilégio e atribuição controlada pelo servidor, antes de criar migration
ou aplicar mudanças ao banco. Módulos 8 a 23 não iniciados.

Exercício acompanhado: Ana entrou corretamente, consegue consultar seu
usuário, mas recebe 403 numa futura ação administrativa protegida. A sessão
deixou de funcionar ou a regra de autorização recusou a ação?
