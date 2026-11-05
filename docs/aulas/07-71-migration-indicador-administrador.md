# Aula 7.71 — Migration do indicador de administrador

Implementação e explicação em 05/11/2026, após confirmação da
[7.70](07-70-planejamento-indicador-administrador.md) com "entendi".
Checkpoint anterior publicado e conferido em
dd9c3911fd9d8965c90541d651e80a0a3b920a22; HEAD/origin/main/main remota iguais.
Entendimento da 7.71 confirmado com "entendi" em 05/11/2026; publicação
pendente. Migration criada, sem aplicação ao banco.

## Objetivo e arquivo

Criamos somente
[2026_11_05_120000_add_is_admin_to_users_table.php](../../backend/database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php)
na aplicação. O prefixo de data/hora ordena a migration depois das existentes.
O nome descreve a adição de is_admin à tabela users.

O arquivo foi escrito com a estrutura das migrations existentes: imports de
Migration, Blueprint e Schema; classe anônima que estende Migration; métodos
up/down com retorno void. O backend está montado como leitura no container;
editamos o arquivo no workspace e executamos o PHP pelo Docker. Não foi
necessário executar make:migration nem instalar dependências.

## Adição em up

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('is_admin')->default(false);
    });
}
```

Schema::table altera a estrutura de uma tabela existente. Não recria users
nem modifica a migration inicial já aplicada. O callback recebe um Blueprint,
que descreve a alteração. Boolean pede uma coluna booleana; default false
define o padrão do banco para inserções que omitirem o atributo. Sem nullable,
a coluna é obrigatória. NULL explícito não significa usar o padrão.

O compilador SQL Server instalado produziu:

```sql
alter table "users" add "is_admin" bit not null default '0'
```

BIT é o tipo usado nesse banco; zero representa false. As aspas e a forma do
literal são geradas pelo compilador. O objetivo é manter contas sem privilégio
administrativo por padrão. Efeitos sobre usuários existentes e novas inserções
serão verificados em loja_test antes da aplicação em loja.

Referência: [colunas e modificadores no Laravel](https://laravel.com/docs/13.x/migrations#column-modifiers).

## Remoção em down

```php
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('is_admin');
    });
}
```

Down descreve como desfazer essa alteração: remover apenas is_admin. No SQL
Server, o compilador gera um lote que localiza e remove a restrição de valor
padrão dessa coluna e então executa:

```sql
alter table "users" drop column "is_admin"
```

O lote usa sys.columns para encontrar a restrição associada; o nome dela não
é fixado manualmente. Ele foi apenas gerado como texto, sem consultar esse
catálogo no servidor. Remover a coluna também removeria os valores que ela
guardasse. Reversão de estrutura não é restauração desses dados. Nenhum
rollback foi executado.

## Verificação no Docker

```sh
docker compose exec -T backend php -l /app/database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php
```

Exec usa o serviço backend; -T dispensa terminal interativo; php -l confere
sintaxe sem executar a migration. Resultado: sem erros, código 0.

Depois, um programa PHP enviado pela entrada padrão carregou somente o
autoload e o arquivo da migration. Criou SqlServerConnection isolada, sem
credenciais/configuração da aplicação, com abertura de PDO bloqueada por
exceção. Ligou o Schema ao builder dessa conexão e chamou up/down dentro de
Connection::pretend. Não executou Artisan migrate, rollback ou migrate --pretend.

Sete controles passaram, código 0: uma instrução/lote por direção; SQL exato
de up com bit/not null/default zero; down com remoção da restrição do padrão;
remoção somente da coluna, sem drop table; bindings vazios; zero aberturas
PDO; modo de simulação encerrado. Sem arquivo auxiliar persistido.

Isso verifica sintaxe e compilação pelo Laravel instalado. Não comprova
aceitação do DDL pelo SQL Server, preenchimento de registros existentes,
permissões de migration ou reversão real. Nenhum SQL enviado, schema ou conta
consultado, usuário promovido ou banco alterado. Serviços php/backend/sqlserver
ativos; PHP 8.4.26 e Composer 2.10.3 conferidos no Docker. Última suíte Laravel
permanece a da 7.58: 107 testes/1.586 asserções; não houve nova suíte.

## Relações e continuidade

User/casts/Fillable, seeder/factory, login, Resource, rotas e contratos foram
preservados. A migration descreve a coluna persistida; o cast boolean e a
autorização ainda terão suas etapas. Criar esse arquivo não promove contas
nem altera as respostas atuais da API.

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.72 — verificar a migration
em loja_test com usuários fictícios, padrão em contas existentes/novas e
reversão, antes de planejar a aplicação em loja. Não usar o banco normal nesses
testes. Módulos 8 a 23 não iniciados.
