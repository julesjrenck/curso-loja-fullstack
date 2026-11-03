# Aula 7.3 — SQL da migration de usuários

Apresentada e verificada em 03/11/2026, após confirmação da 7.2 com "entendi".
7.2 publicada em 801016c369bcf248069e3ed3542419fa817f3977; HEAD, origin/main
e main remota conferidos iguais após o push. Entendimento da 7.3 confirmado
com "entendi" em 03/11/2026. Nenhuma migration aplicada nesta aula.

## Objetivo e comando

Relacionar a [migration existente](../../backend/database/migrations/0001_01_01_000000_create_users_table.php)
com o SQL que o Laravel gera para SQL Server. A aula altera documentação;
o arquivo PHP da migration permanece como estava.

```sh
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv \
  --path=database/migrations/0001_01_01_000000_create_users_table.php \
  --pretend \
  --no-interaction \
  --no-ansi
```

exec -T executa no container backend, sem terminal interativo. As barras no
fim das linhas continuam o mesmo comando no shell. --database recebe o nome
da conexão Laravel, sqlsrv, configurada em
[database.php](../../backend/config/database.php); conferimos loja/loja_app.
--path seleciona somente esse arquivo, relativo à raiz backend dentro do
container. Não inclui as migrations pendentes de cache/jobs.

--pretend exibe as instruções da migration sem executá-las. --no-interaction
dispensa perguntas interativas; --no-ansi remove cores. O comando ainda
consulta o banco para ler o histórico. Antes dele, conferimos que a tabela
migrations já existia, a migration selecionada estava pendente e as três
tabelas de usuários estavam ausentes.

Essa execução usa a conexão normal para inspecionar SQL. Não valida as
permissões de uma conta para executar DDL nem substitui a conexão adequada
quando formos aplicar uma migration.

## Como as definições viraram SQL

O comando terminou com código 0 e exibiu oito instruções. A mensagem genérica
Running migrations aparece mesmo com --pretend; ela não comprova aplicação.

| Definição na migration | SQL exibido ou efeito descrito |
| --- | --- |
| id() em users | "id" bigint not null identity primary key |
| string('name') / string('email') / string('password') | nvarchar(255) not null |
| timestamp('email_verified_at')->nullable() | datetime null |
| rememberToken() | "remember_token" nvarchar(100) null |
| timestamps() | created_at e updated_at como datetime null |
| string('email')->unique() em users | create unique index separado |
| string('email')->primary() em password_reset_tokens | coluna nvarchar(255), depois alter table adicionando primary key |
| string('id')->primary() em sessions | coluna nvarchar(255), depois alter table adicionando primary key |
| foreignId('user_id')->nullable()->index() | bigint null e create index separado |
| text('user_agent')->nullable() | nvarchar(max) null |
| longText('payload') | nvarchar(max) not null |
| integer('last_activity')->index() | int not null e create index separado |

Por exemplo, o início da criação de users, formatado para leitura, foi:

```sql
create table "users" (
    "id" bigint not null identity primary key,
    "name" nvarchar(255) not null,
    "email" nvarchar(255) not null,
    "email_verified_at" datetime null,
    "password" nvarchar(255) not null,
    "remember_token" nvarchar(100) null,
    "created_at" datetime null,
    "updated_at" datetime null
)
```

identity define geração automática do identificador; primary key define a
chave primária. null permite ausência de valor; not null a proíbe. Os tipos
SQL são escolhidos pela tradução do Laravel para o driver SQL Server.
O método Laravel timestamp gerou datetime neste driver.

```sql
create unique index "users_email_unique" on "users" ("email")
```

O índice único impõe a unicidade do e-mail no banco quando aplicado. Os índices
de sessions.user_id e sessions.last_activity também aparecem em instruções
separadas. Não apareceu foreign key: ter um índice em user_id não obriga que
seu valor corresponda a uma linha existente de users.

Ao todo: três create table, um create unique index, dois alter table para
chaves primárias e dois create index. Nenhuma instrução veio de cache/jobs.

## Verificação e limites

Antes/depois, consultas de leitura pela conexão sqlsrv conferiram identidade,
lista ordenada de tabelas e migrations/lotes, além das contagens do catálogo.
O resumo SHA-256 desse mesmo conjunto foi idêntico:
8c61be048457250963c87f8c8c40dd595d57a3c2349070c9cdd0994c1151fa7a.

loja/loja_app manteve somente dbo.categorias, dbo.migrations e dbo.produtos;
três migrations do catálogo nos lotes 1/2/3, um produto e zero categorias.
users, password_reset_tokens e sessions continuaram ausentes. O hash resume
esses metadados/contagens; não compara o conteúdo completo de todas as linhas.

migrate:status --database=sqlsrv --no-ansi, executado no Docker após a inspeção,
terminou 0 e manteve users/cache/jobs Pending, catálogo Ran. Nenhum comando
foi direcionado ao banco de testes nesta aula. Não criamos usuários, tabelas,
rotas ou dependências. Sem nova suíte; último resultado completo permanece
6.84: 66 testes/620 asserções e quatro contratos aprovados.

O resultado demonstra a geração do SQL e a preservação do estado consultado.
Não demonstra sua execução real, permissões DDL ou autenticação funcionando.
A [documentação oficial](https://laravel.com/docs/13.x/migrations#running-migrations)
descreve o uso de --pretend para inspecionar as instruções.

## Continuidade

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo, após publicar:
7.4 — aplicar somente a migration de usuários em loja_test e verificar as
três tabelas e o histórico, sem cadastrar usuários. Aplicação no banco normal
fica para etapa posterior. Checkpoint preparado para commit e push; consultar
o Git ou registro posterior para conferir o resultado da publicação.
