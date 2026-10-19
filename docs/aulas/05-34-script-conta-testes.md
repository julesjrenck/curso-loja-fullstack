# Aula 5.34 — Script da conta exclusiva de testes

## Objetivo e estado

Preparar o acesso próprio dos testes de integração ao banco loja_test.
Arquivo: docker/sqlserver/criar-usuario-testes.sql. Somente escrito, revisado
e analisado sintaticamente; nenhuma conta ou permissão criada nesta etapa.

A 5.33 foi confirmada com "entendi" em 16/10/2026 e publicada em f14a335.
HEAD, origin/main e consulta direta à main remota retornaram
f14a335a35b2400324020fedc08aeb4c454a8386.

## Por que uma identidade própria

loja_app lê/escreve os dados da aplicação em loja. loja_migracoes prepara a
estrutura desse banco. Nenhuma dessas contas recebe acesso adicional nesta aula.
Os testes usarão outra identidade, loja_testes, mapeada somente em loja_test.
Nesse banco poderão preparar tabelas e dados para verificar os comportamentos.
O acesso real só será conferido depois da criação da conta na próxima etapa.

## Leitura do arquivo

:ON ERROR EXIT é uma instrução do cliente sqlcmd: encerra ao encontrar erro.
Isso evita continuar os lotes seguintes caso, por exemplo, USE loja_test falhe.
GO também é processado pelo cliente e separa os lotes enviados ao servidor.
Por isso esse arquivo é destinado ao sqlcmd, não a uma chamada PDO única.

USE master seleciona o contexto de administração para CREATE LOGIN. O login
loja_testes será a identidade de autenticação no servidor. SUSER_ID verifica
se ele existe antes de criá-lo. PASSWORD recebe o marcador sqlcmd
$(MSSQL_TESTS_PASSWORD), sem senha real versionada. CHECK_POLICY fica ON,
como nas contas anteriores; DEFAULT_DATABASE indica loja_test como destino
padrão quando o cliente não informa banco. Banco padrão não é uma restrição
de acesso: o escopo de dados depende do usuário e das permissões concedidas.

USE loja_test seleciona o banco onde CREATE USER FOR LOGIN associa o usuário
loja_testes à identidade do servidor. USER_ID consulta o banco atual.
DEFAULT_SCHEMA dbo indica onde procurar/criar objetos sem esquema explícito.

ALTER ROLE ADD MEMBER coloca o usuário nos papéis indicados, somente se
IS_ROLEMEMBER retornar 0. As permissões previstas são:

| Permissão em loja_test | Finalidade |
| --- | --- |
| db_datareader | Ler dados das tabelas de usuário e views |
| db_datawriter | Inserir, atualizar e excluir dados das tabelas de usuário |
| CREATE TABLE | Criar tabelas nesse banco |
| ALTER no esquema dbo | Alterar e remover objetos de dbo; também necessário para criar tabelas ali |

As concessões explícitas são:

```sql
GRANT CREATE TABLE TO [loja_testes];
GRANT ALTER ON SCHEMA::[dbo] TO [loja_testes];
```

GRANT atua no banco selecionado por USE loja_test. O alcance de ALTER é o
esquema dbo inteiro desse banco, incluindo modificar/remover seus objetos.
Não se limita à futura tabela produtos. O script não cria usuário nem concede
permissões em loja, não atribui sysadmin/db_owner e não permite criar bancos.
Também não cria tabelas: conceder CREATE TABLE é diferente de executar CREATE TABLE.

As condições de existência evitam recriar login/usuário ou repetir inclusão nos
papéis. Os GRANT podem ser reaplicados. O script não redefine senha existente
nem corrige privilégios anteriores; reexecução e permissões efetivas ainda
precisam de verificação na etapa de aplicação.

## Verificações realizadas

- SELECT administrativo anterior: loja_test existe; login loja_testes ausente,
  zero usuários loja_testes nesse banco e em loja; zero tabelas em loja_test.
- Entrada temporária fora do repositório colocou SET PARSEONLY ON em lote
  anterior ao conteúdo integral do script. sqlcmd substituiu o marcador por
  texto fictício público, usado somente para analisar a sintaxe.
- Análise em SQL Server Docker com sqlcmd -b: código 0, sem erros de sintaxe.
  PARSEONLY não compila nem executa as instruções; não demonstra que a criação,
  política de senha ou as permissões funcionarão na aplicação real.
- Após SET PARSEONLY OFF em lote separado, SELECT confirmou login ainda NULL,
  zero usuários da conta e zero tabelas em loja_test. Nenhum CREATE/ALTER/GRANT
  do arquivo foi aplicado. Consultas autenticadas como administrador; a senha
  existente foi passada internamente via SQLCMDPASSWORD, sem exibição.
- Revisão: somente master/loja_test como contextos, identidade própria, senha
  como marcador e mesmo conjunto de permissões de estrutura já estudado na 5.13.
- git diff --check passou. Nenhuma suíte, migration ou seeder executado.
  .env/.env.example, configuração Laravel, dependências e serviços preservados.

## Continuidade

Script e explicação apresentados; entendimento da 5.34 confirmado com "entendi"
em 19/10/2026, após a revisão. Em 16/10/2026 o aluno pediu para salvar o progresso e continuar outro
dia. Registro de encerramento preparado para commit/push; isso não confirma
entendimento. Último checkpoint confirmado/publicado: f14a335, descoberta 5.33.
Consultar Git para o SHA do salvamento desta pausa.

Revisão e confirmação realizadas em 19/10/2026. Próximo passo: iniciar 5.35, preparar
o campo público vazio e a senha somente no ambiente local ignorado, aplicar
este script e verificar autenticação, permissões em loja_test, ausência de
acesso a loja e reexecução. A conta é persistente e as permissões previstas
são as da tabela acima. Configuração Laravel e tabelas de testes ficarão
para etapas posteriores. A autorização anterior de loja_migracoes refere-se
àquela conta em loja, não constitui autorização específica de loja_testes.

Fontes primárias consultadas em 16/10/2026:

- [CREATE LOGIN](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-login-transact-sql?view=sql-server-ver16).
- [Papéis de banco](https://learn.microsoft.com/en-us/sql/relational-databases/security/authentication-access/database-level-roles?view=sql-server-ver16).
- [Permissões para CREATE TABLE](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-table-transact-sql?view=sql-server-ver16#permissions).
- [Permissões e alcance de ALTER no esquema](https://learn.microsoft.com/en-us/sql/relational-databases/security/permissions-database-engine?view=sql-server-ver16).
- [SET PARSEONLY](https://learn.microsoft.com/en-us/sql/t-sql/statements/set-parseonly-transact-sql?view=sql-server-ver16).
- [Comandos do sqlcmd](https://github.com/MicrosoftDocs/sql-docs/blob/live/docs/tools/sqlcmd/sqlcmd-commands.md).
