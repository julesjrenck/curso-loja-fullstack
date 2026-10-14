# Aula 5.7 — Login e usuário da aplicação

## Objetivo e conceito

Preparar a identidade que Laravel usará para acessar o banco loja.
Login autentica a conexão no servidor. Usuário representa esse login dentro
de um banco. Papéis agrupam permissões concedidas ao usuário daquele banco.

| Elemento | Preparação nesta aula |
| --- | --- |
| Login no servidor | loja_app, com senha própria e banco padrão loja. |
| Usuário em loja | loja_app, associado ao login. |
| Papéis em loja | db_datareader e db_datawriter. |

Esses papéis permitem ler e alterar dados nas tabelas da aplicação no banco.
Não concedemos db_owner ou sysadmin; a conta não cria tabelas. A preparação
de migrations e do banco de integração terá permissões/credenciais próprias
quando utilizada. A conexão Laravel será configurada na próxima etapa.

Etapa 5.6 confirmada com "entendi" em 13/10/2026, depois do relato "apareceu loja"
no DBeaver. Checkpoint c7f58ee publicado; HEAD, origin/main e consulta direta
à main remota retornaram `c7f58ee64ab62b1b053cd27b96b644772ecac98f`.

## Arquivo de preparação SQL

Criado docker/sqlserver/criar-usuario-loja.sql. São comandos públicos sem
valor de senha; o cliente sqlcmd recebe esse valor da configuração local.

```sql
USE [master];
GO

IF SUSER_ID(N'loja_app') IS NULL
    CREATE LOGIN [loja_app]
        WITH PASSWORD = N'$(MSSQL_LOJA_PASSWORD)',
             CHECK_POLICY = ON,
             DEFAULT_DATABASE = [loja];
GO

USE [loja];
GO

IF USER_ID(N'loja_app') IS NULL
    CREATE USER [loja_app] FOR LOGIN [loja_app];
GO

IF IS_ROLEMEMBER(N'db_datareader', N'loja_app') = 0
    ALTER ROLE [db_datareader] ADD MEMBER [loja_app];
GO

IF IS_ROLEMEMBER(N'db_datawriter', N'loja_app') = 0
    ALTER ROLE [db_datawriter] ADD MEMBER [loja_app];
GO
```

SUSER_ID consulta a existência do login; CREATE LOGIN prepara sua autenticação.
CHECK_POLICY=ON aplica a política de senha; DEFAULT_DATABASE define o banco
selecionado quando o cliente não informa outro banco.

Depois de USE loja, USER_ID consulta o usuário naquele banco. CREATE USER
FOR LOGIN liga o usuário ao login. Usamos o mesmo nome nos dois níveis,
mas eles representam elementos diferentes.

IS_ROLEMEMBER consulta participação no papel; ALTER ROLE ... ADD MEMBER
acrescenta o usuário somente quando ainda não participa. db_datareader permite
leitura e db_datawriter permite inserir, alterar e excluir dados em tabelas.
Nenhuma tabela da aplicação foi criada ou alterada para essa preparação.

As condições preservam login, senha, usuário e participação existentes ao
reexecutar o arquivo. Consultamos previamente e não havia loja_app no servidor
nem no banco. Não fazemos reset de senha de um login já existente.

$(MSSQL_LOJA_PASSWORD) é uma variável de script do sqlcmd. O cliente substitui
o texto a partir de uma variável de ambiente antes de enviar o SQL ao servidor.
O arquivo deve ser executado por esse fluxo de preparação; o conteúdo público
não contém a senha real.

## Configuração local

Acrescentado ao .env.example da raiz o campo vazio MSSQL_LOJA_PASSWORD.
MSSQL_SA_PASSWORD continua sendo a credencial administrativa.
PHP em Docker gerou uma senha própria da aplicação no root .env ignorado,
preservando configurações existentes. Modo 600 aplicado e valor não exibido.

Para outro clone, após preparar a senha administrativa e os bancos, use:

```bash
docker run --rm -i --volume "$PWD/.env:/config/.env:rw" php:8.4.26-cli-bookworm php <<'PHP'
<?php
$caminho = '/config/.env';
$conteudo = file_get_contents($caminho);
$existe = preg_match('/^MSSQL_LOJA_PASSWORD=(.*)$/m', $conteudo, $campo);
$vazio = !$existe || in_array(trim($campo[1]), ['', '""', "''"], true);
if ($vazio) {
    $linha = 'MSSQL_LOJA_PASSWORD=Aa1!'.bin2hex(random_bytes(24));
    $novo = $existe
        ? preg_replace('/^MSSQL_LOJA_PASSWORD=.*$/m', $linha, $conteudo, 1)
        : rtrim($conteudo, "\r\n")."\n".$linha."\n";
    if (file_put_contents($caminho, $novo) === false) {throw new RuntimeException('Falha ao salvar configuração local.');}
    echo "Senha da aplicação criada somente no .env local.\n";
} else {
    echo "Senha da aplicação existente preservada.\n";
}
if (!chmod($caminho, 0600)) {throw new RuntimeException('Falha nas permissões locais.');}
PHP
```

Como na preparação anterior, random_bytes gera os bytes aleatórios e bin2hex
produz texto. O prefixo garante grupos de caracteres da política de senha.
O código preenche apenas campo vazio/ausente e preserva o restante do arquivo.

Execute a preparação como cliente temporário, usando a imagem já fixada:

```bash
docker run --rm -i --network host --env-file .env --entrypoint sh mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04@sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718 -c 'case "${MSSQL_LOJA_PASSWORD:-}" in ""|*[!A-Za-z0-9!]* ) echo "Use uma senha gerada no formato documentado para esta preparação." >&2; exit 1;; esac; export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S 127.0.0.1,1433 -U sa -C -l 5 -b' < docker/sqlserver/criar-usuario-loja.sql
```

--env-file fornece variáveis locais sem mostrar os valores no comando.
O case valida o formato documentado, letras/dígitos/!, antes da substituição
textual no SQL, evitando introduzir aspas ou outros delimitadores no literal.
SQLCMDPASSWORD recebe a senha de sa para a preparação administrativa;
MSSQL_LOJA_PASSWORD fornece a senha do novo login. As duas têm funções distintas.
--entrypoint sh executa somente o cliente, com a rede do host e o endpoint
publicado. O < envia o arquivo SQL pela entrada padrão.

## Verificações

- Script passou. Consulta administrativa confirmou loja_app, política de senha
  ativa e banco padrão loja. Usuário tem os dois papéis no banco loja.
- Cliente SQL autenticou como loja_app com sua própria senha. SUSER_SNAME()
  retornou loja_app, USER_NAME() retornou loja_app e DB_NAME() retornou loja.
- Diagnóstico de permissões: leitura/escrita = 1; db_owner/sysadmin = 0;
  HAS_DBACCESS(loja_test) = 0; permissão CREATE TABLE = 0.
- Conexão solicitando loja_test foi recusada, com erro de banco inacessível:
  falha esperada que confirma o limite entre aplicação e integração.
- Reexecução do arquivo passou; depois, autenticação em loja e papéis 1/1
  continuaram funcionando com a mesma credencial local.
- Um diagnóstico temporário teve erro de aspas; corrigido para entrada SQL por
  heredoc e repetido com sucesso. O arquivo de preparação estava correto.
- backend/.env ainda não alterado; conexão Laravel continua pendente.
  Código PHP, Compose, bancos, imagens e .dockerignore preservados;
  root .env/backend .env ignorados. Sem tabelas, migrations, testes Laravel ou contador.

Explicação apresentada; entendimento da 5.7 confirmado com "entendi" em 13/10/2026.
Aluno perguntou se já deveria estar criado no banco loja. Esclarecido:
usuário loja_app já criado em loja, login correspondente no servidor;
consulta sys.database_principals em loja conferida novamente e apresentada
para verificação pelo DBeaver. Entendimento confirmado com "entendi".
Aluno perguntou se sys.database_principals é tabela. Esclarecido: view de
catálogo do sistema, que apresenta metadados de identidades de segurança
(usuários e papéis) como linhas/colunas consultáveis com SELECT. sys é o
esquema; database_principals é o nome da view. CREATE USER altera o catálogo
e a view passa a apresentar esse usuário. Entendimento confirmado com "entendi".
Checkpoint publicado com autorização persistente e conferido em 063e4eb:
HEAD, origin/main e consulta direta à main remota retornaram
063e4ebc0c1ec733b183005c922ffd967f4ac35b. Registro no checkpoint seguinte.
Próximo passo realizado na 5.8: preparar o modelo e a configuração
local Laravel para sqlserver:1433, banco loja e login loja_app, copiando a senha
local sem exibir/versionar o valor e preservando APP_KEY/configurações existentes.

Fontes consultadas em 13/10/2026:

- [CREATE LOGIN](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-login-transact-sql?view=sql-server-ver16).
- [CREATE USER](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-user-transact-sql?view=sql-server-ver16).
- [Papéis de banco](https://learn.microsoft.com/en-us/sql/relational-databases/security/authentication-access/database-level-roles?view=sql-server-ver17).
- [ALTER ROLE](https://learn.microsoft.com/en-us/sql/t-sql/statements/alter-role-transact-sql?view=sql-server-ver16).
- [Variáveis do sqlcmd](https://learn.microsoft.com/en-us/sql/tools/sqlcmd/sqlcmd-use-scripting-variables?view=sql-server-ver16).
- [View sys.database_principals](https://learn.microsoft.com/en-us/sql/relational-databases/system-catalog-views/sys-database-principals-transact-sql?view=sql-server-ver15).
- [Views e views do sistema](https://learn.microsoft.com/en-us/sql/relational-databases/views/views?view=sql-server-ver16).
