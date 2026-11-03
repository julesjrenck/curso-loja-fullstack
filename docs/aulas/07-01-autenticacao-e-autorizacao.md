# Aula 7.1 — Autenticação e autorização

Curso retomado em 03/11/2026 por pedido do aluno, após a conclusão da 6.84.
Introdução conceitual apresentada; entendimento confirmado pelo aluno com
"entendi" em 03/11/2026.

## Duas perguntas diferentes

Autenticação identifica o usuário da requisição. Por exemplo: ao conferir
e-mail e senha no login, a loja pode reconhecer a cliente Ana.

Autorização decide se esse usuário pode executar uma ação. Saber que a
requisição é de Ana não concede a ela permissão para alterar preços.
Uma regra da loja precisa permitir ou recusar essa operação.

| Situação ilustrativa | Autenticação | Autorização desejada |
| --- | --- | --- |
| Visitante consulta o catálogo público | Não exigida | Leitura pública permitida |
| Ana entra na própria conta | Identificar Ana | Cada operação terá sua regra |
| Ana, cliente, tenta alterar um preço | Ana identificada | Recusar: administração necessária |
| Administrador tenta alterar um preço | Administrador identificado | Permitir conforme a regra administrativa |

Esses exemplos orientam o módulo. Login, perfis e alteração de preço ainda
serão construídos. Autenticação e autorização são verificações distintas,
mesmo quando acontecem na mesma requisição. A documentação do Laravel
[explica essa distinção](https://laravel.com/docs/13.x/authorization#introduction).

## O ponto de partida da nossa loja

As duas rotas de [api.php](../../backend/routes/api.php) são de leitura:

```text
GET /api/v1/produtos
GET /api/v1/produtos/{id}
```

Nenhuma delas exige login. O prefixo /api/v1 é definido no
[bootstrap](../../backend/bootstrap/app.php); colocar uma rota sob esse
prefixo não aplica autenticação automaticamente.

Na listagem, o [ListarProdutosRequest](../../backend/app/Http/Requests/ListarProdutosRequest.php)
já possui este trecho:

```php
public function authorize(): bool
{
    return true;
}
```

O método é público e retorna um booleano. O true permite que a requisição
prossiga nessa verificação de autorização do Form Request. Ele não confere
senha, não cria login e não transforma um visitante em administrador.
O método rules continua responsável por validar page e nome. Validar o
formato dos dados também é diferente de identificar o usuário e conferir
suas permissões.

O [model User](../../backend/app/Models/User.php) e a
[configuração de autenticação](../../backend/config/auth.php) vieram com o
esqueleto Laravel. Sua existência, sozinha, não implementa nosso fluxo de
login. Vamos examiná-los na próxima etapa, após a confirmação desta aula.

Sanctum será estudado no módulo para autenticação da API; as regras de
permissão serão estudadas com os recursos de autorização do Laravel.
Referências: [autenticação](https://laravel.com/docs/13.x/authentication),
[Sanctum](https://laravel.com/docs/13.x/sanctum) e
[autorização](https://laravel.com/docs/13.x/authorization).

## Verificação realizada

```sh
docker compose exec -T backend php artisan route:list --path=api/v1 -vv --no-ansi
```

exec executa no container backend já ativo; -T dispensa terminal interativo.
Artisan route:list lista as rotas registradas. --path restringe a listagem
ao caminho informado; -vv detalha os middlewares e --no-ansi remove cores.

Resultado: duas rotas GET|HEAD, apontando para ProdutoController@index e show,
ambas com o grupo api, sem middleware de autenticação. A leitura de api.php,
bootstrap/app.php e do Form Request confirma o ponto de partida público.
A listagem de rotas não envia uma requisição HTTP nem testa login ou permissões.

Docker Compose confirmou os serviços php, backend e sqlserver ativos. Na
retomada, Git estava limpo; HEAD, origin/main e main consultada diretamente
no GitHub coincidiam em 167ec4fd2a90ad673814d1c2dd60e062ae4fd822.
As consultas iniciais a Docker/rede foram repetidas com acesso ampliado e
concluíram com sucesso. Nenhuma dependência, rota ou tabela foi alterada.
Não executamos a suíte: a mudança desta aula é documental. O último resultado
completo continua sendo o da 6.84: 66 testes/620 asserções e quatro contratos.

## Pausa para entendimento

Exercício acompanhado: Ana fez login corretamente, mas a loja recusou sua
tentativa de alterar o preço de um produto. Qual verificação funcionou para
identificá-la e qual recusou a operação?

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo:
7.2 — leitura do User, da configuração auth e da migration de usuários
existentes, antes de criar tabelas ou instalar dependências de autenticação.
Checkpoint preparado para commit e push; conferir o Git e o registro seguinte
para o resultado da publicação.
