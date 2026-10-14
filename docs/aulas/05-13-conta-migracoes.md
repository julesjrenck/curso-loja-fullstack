# Aula 5.13 — Conta exclusiva de migrations

## Objetivo e estado

Preparar loja_migracoes como login no servidor e usuário no banco loja,
com senha própria e permissões para migrations. A 5.12 foi confirmada com
"entendi" em 14/10/2026 e publicada em bbec195, SHA completo
bbec195570dc903909bc0a629ce78c57e9ed5d6a, conferido na main remota.

SQL público e campo do modelo preparados; senha gerada somente no .env ignorado.
A rejeição automática inicial foi resolvida pela autorização explícita do aluno
em 14/10/2026: "Sim, autorizo criar essa conta com essas permissões", em resposta
à pergunta com login/usuário, banco loja, papéis de dados, CREATE TABLE e ALTER
em dbo, incluindo modificar/remover objetos. SQL executado com sucesso após
essa autorização. Conta criada, autenticada e permissões/reexecução conferidas.

## Dados e estrutura

loja_app é a conta configurada no Laravel: lê e altera dados. Migrations
precisam também criar tabelas e alterar sua estrutura. A conta preparada para
isso tem este escopo no banco loja:

| Configuração aplicada | Finalidade |
| --- | --- |
| Login/usuário loja_migracoes | Identidade exclusiva para executar migrations |
| Banco padrão loja | Destino quando a conexão não informa banco |
| Esquema padrão dbo | Local dos objetos criados sem esquema explícito |
| db_datareader e db_datawriter | Ler e modificar dados, incluindo o registro de migrations |
| CREATE TABLE no banco loja | Permitir criação de tabelas |
| ALTER no esquema dbo de loja | Permitir alterar e remover objetos desse esquema |

sysadmin e db_owner não foram concedidos; não há usuário dessa conta em loja_test.
CREATE TABLE exige também ALTER no esquema onde a tabela será criada.
O esquema dbo organiza objetos dentro de loja, assim como sys organiza as
views de catálogo já estudadas. Aqui o escopo é o dbo inteiro, não somente
a futura tabela produtos. Essa conta tem capacidade de modificar e remover
objetos desse esquema; por isso a autorização solicitada descreve esse alcance.

## Arquivos preparados

docker/sqlserver/criar-usuario-migracoes.sql reutiliza a preparação da 5.7:
USE master e CREATE LOGIN quando ausente, com senha fornecida por variável
sqlcmd, CHECK_POLICY=ON e banco padrão loja. Depois, USE loja e CREATE USER
FOR LOGIN quando ausente, com DEFAULT_SCHEMA=dbo. ALTER ROLE acrescenta o
usuário aos papéis de leitura/escrita somente se ainda não participa.

As duas novas permissões explícitas são:

```sql
GRANT CREATE TABLE TO [loja_migracoes];
GRANT ALTER ON SCHEMA::[dbo] TO [loja_migracoes];
```

GRANT concede uma permissão. O primeiro comando vale no banco escolhido por
USE loja. O segundo informa o tipo do objeto de segurança, SCHEMA, e seu
nome, dbo. Aplicar esses GRANT novamente mantém as concessões. As condições
de existência preservam login e senha existentes; o arquivo não redefine senhas.

.env.example da raiz ganhou MSSQL_MIGRATIONS_PASSWORD vazio. O .env local
recebeu uma senha gerada em PHP Docker com Aa1! e bin2hex(random_bytes(24)).
O prefixo atende aos grupos de caracteres da política de senha. O programa
preenche apenas campo ausente/vazio e compara as demais linhas antes de gravar,
sem imprimir o valor. Permissão 600, dono 1000:1000. Credenciais anteriores
e backend/.env preservados. Nenhuma configuração Laravel da nova conta ainda.

## Comando executado após autorização

A preparação usou a imagem SQL Server já fixada como cliente temporário:

```bash
docker run --rm -i --network host --env-file .env --entrypoint sh \
  mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04@sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718 \
  -c 'case "${MSSQL_MIGRATIONS_PASSWORD:-}" in ""|*[!A-Za-z0-9!]* ) echo "Use a senha no formato gerado para esta preparação." >&2; exit 1;; esac; export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S 127.0.0.1,1433 -U sa -C -l 5 -b' \
  < docker/sqlserver/criar-usuario-migracoes.sql
```

--env-file lê valores privados sem colocá-los no texto do comando. O case
confere o formato da senha antes da substituição textual no literal SQL.
SQLCMDPASSWORD autentica sa para essa preparação; MSSQL_MIGRATIONS_PASSWORD
fornece a senha do novo login. -C confia no certificado local; -l 5 limita
o tempo de login e -b faz erros SQL resultarem em código de falha. O arquivo
SQL entra por redirecionamento <, com GO separando os lotes do sqlcmd.
O comando foi executado após a autorização explícita que resolveu a rejeição
automática e terminou com código 0.

## Verificações realizadas

Realizadas: serviços ativos; ausência prévia do login/usuário e zero tabelas
conferidos por SELECT administrativo; senha gerada sem exibição e demais linhas
preservadas; modelo sem senha real; .env ignorados; git diff --check passou;
backend, laboratório PHP, migrations, Compose e imagens sem alterações.

A tentativa inicial foi rejeitada antes de criar o processo; naquele momento,
consulta confirmou ausência da conta. Após a autorização explícita:

- Execução do SQL passou; metadados confirmaram login, CHECK_POLICY ativo,
  banco padrão loja, usuário SQL e esquema padrão dbo.
- Cliente autenticado com senha própria retornou DB_NAME loja, SUSER_SNAME
  e USER_NAME loja_migracoes; db_datareader/db_datawriter = 1/1,
  CREATE TABLE/ALTER dbo = 1/1, db_owner/sysadmin = 0/0 e HAS_DBACCESS loja_test = 0.
- Login solicitando loja_test foi recusado com erro de banco inacessível,
  conforme escopo esperado; consulta administrativa confirmou zero usuários
  loja_migracoes naquele banco.
- Script reaplicado com código 0; diagnóstico repetido autenticou com mesma
  senha e manteve todas as permissões esperadas.
- Laravel continua loja_app: leitura/escrita = 1/1, CREATE TABLE/ALTER dbo = 0/0.
- Banco loja permanece com zero tabelas da aplicação; não executamos migrations
  ou comandos de criação/alteração de tabela. Permissões verificadas por metadados;
  aplicação real do DDL será apresentada na etapa própria.

## Continuidade e autorização registrada

SQL aplicado, configuração local preparada, verificações concluídas e explicação
do objetivo, arquivos, permissões e resultados apresentada. Autorização explícita
de execução recebida; entendimento da 5.13 confirmado com "entendi" em 14/10/2026.
Checkpoint publicado e conferido em 94e3322: HEAD, origin/main e main remota
retornaram 94e3322369b13dcf3bf6201c90899e2f99b5893a. Registro no checkpoint seguinte.

Rejeição automática: "A ação cria uma conta persistente no SQL Server e concede
permissões de leitura, escrita, CREATE TABLE e ALTER no esquema dbo; embora
coerente com a etapa do curso, não há autorização explícita do usuário para
esse alvo e esse escopo de privilégios."

Essa rejeição foi resolvida pela autorização explícita registrada no início
da aula; a preparação autorizada foi executada sem ampliar o escopo.
Próximo passo realizado na 5.14: configurar uma conexão Laravel exclusiva de migrations,
preservando a conexão padrão da aplicação e copiando a senha somente ao .env local.
A autorização persistente para publicar checkpoints na main permanece válida.

Fontes consultadas em 14/10/2026:

- [Permissões necessárias para CREATE TABLE](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-table-transact-sql?view=sql-server-ver16#permissions).
- [GRANT no esquema](https://learn.microsoft.com/en-us/sql/t-sql/statements/grant-schema-permissions-transact-sql?view=sql-server-ver16).
- [GRANT no banco](https://learn.microsoft.com/en-us/sql/t-sql/statements/grant-database-permissions-transact-sql).
