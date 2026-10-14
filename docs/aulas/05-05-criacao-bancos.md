# Aula 5.5 — Bancos da loja e dos testes

## Objetivo e conceito

Criar loja e loja_test dentro do SQL Server local já iniciado.
Servidor é o processo que atende conexões e administra bancos. Banco é um
conjunto organizado de objetos e dados dentro daquele servidor. Um servidor
pode administrar vários bancos, cada um com suas tabelas e arquivos.

| Banco | Uso previsto |
| --- | --- |
| loja | Dados da aplicação durante o desenvolvimento. |
| loja_test | Dados dos testes de integração, separados dos dados da aplicação. |

Os testes poderão preparar/alterar seus dados em loja_test sem usar o banco loja.
Criar esse banco é uma parte do isolamento; a configuração dos testes deverá
selecioná-lo explicitamente antes de qualquer teste de integração.

Etapa 5.4 e esclarecimentos sobre acesso confirmados com "entendi" em 13/10/2026.
Checkpoint d9fba40 publicado: HEAD, origin/main e consulta direta à main remota
retornaram `d9fba40e398512cb63385e970e8578ffe90441d2`.
O aluno pediu aviso quando puder conectar pelo DBeaver. A publicação da porta
e o aviso serão tratados na 5.6, após entendimento desta etapa.

## Arquivo SQL

Criado docker/sqlserver/criar-bancos.sql. A pasta docker/sqlserver agrupa
a preparação do serviço. Esse arquivo descreve os comandos que serão enviados
ao SQL Server pelo cliente sqlcmd; não contém credenciais.

```sql
-- Bancos da aplicação e dos testes de integração, no servidor local do curso.
USE [master];
GO

IF DB_ID(N'loja') IS NULL
    CREATE DATABASE [loja];
GO

IF DB_ID(N'loja_test') IS NULL
    CREATE DATABASE [loja_test];
GO
```

- -- inicia um comentário em SQL.
- USE [master] seleciona o banco de sistema master como contexto da conexão
  usada para preparar os bancos. Não cria tabelas da loja dentro de master.
- GO é um separador de lotes reconhecido pelo sqlcmd, não uma instrução SQL
  executada pelo motor. Cada lote é enviado separadamente ao servidor.
- DB_ID consulta o identificador do banco. Com login administrativo sa, NULL
  neste diagnóstico significa que o banco não foi encontrado.
- N'loja' é uma string Unicode; o N é parte da sintaxe T-SQL.
- IF ... IS NULL condiciona o comando seguinte: executar somente quando o
  banco ainda não existe. A comparação com NULL usa IS NULL.
- CREATE DATABASE [loja] cria o banco e seus arquivos. Colchetes delimitam
  o identificador do banco; ponto e vírgula termina a instrução.
- O segundo bloco aplica a mesma preparação a loja_test.

Não há DROP nem comandos para substituir dados existentes. O arquivo pode
ser executado novamente: se o banco já existe, a criação é pulada.
Defaults de arquivos/opções vêm do SQL Server; opções serão aprofundadas
quando necessárias. A criação foi executada fora de uma transação explícita.

## Execução em Docker

Antes da criação, consultamos sys.databases e confirmamos que nenhum dos dois
bancos existia. Os três serviços estavam ativos. Depois executamos na raiz:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -l 5 -b' < docker/sqlserver/criar-bancos.sql
```

O < é redirecionamento do shell: lê o arquivo local e entrega seu conteúdo
pela entrada padrão do comando. Não é necessário copiar ou montar o SQL no
container. O -T permite esse uso sem terminal interativo.

Dentro do container, SQLCMDPASSWORD recebe a senha já existente no ambiente;
o valor não é colocado no arquivo SQL nem em argumento de linha de comando.
sqlcmd conecta ao mesmo container com localhost, login sa e certificado local
aceito por -C. -l 5 limita a espera de login; -b informa erro pelo código de saída.
O SQL Server precisa aceitar conexões antes da execução da preparação.

O arquivo não é executado automaticamente pelo Compose. Na preparação de
outro ambiente, inicie o serviço e execute esse comando explicitamente.
Ao reutilizar o volume existente, os bancos já presentes são preservados.

## Verificação

Consultas de diagnóstico no SQL Server confirmaram:

| Banco | Identificador nesta sessão | Estado | Tabelas da aplicação |
| --- | --- | --- | --- |
| loja | 5 | ONLINE | 0 |
| loja_test | 6 | ONLINE | 0 |

Os identificadores são atribuídos pelo servidor; não devem ser fixados no
código da aplicação. Identificadores diferentes confirmam bancos distintos.
Conectamos separadamente com sqlcmd -d loja e -d loja_test. DB_NAME() retornou
o banco selecionado; DB_ID() retornou seu identificador; sys.tables confirmou
nenhuma tabela da aplicação em cada banco.

sys.master_files mostrou dados (.mdf) e log (.ldf) de cada banco:

```text
/var/opt/mssql/data/loja.mdf
/var/opt/mssql/data/loja_log.ldf
/var/opt/mssql/data/loja_test.mdf
/var/opt/mssql/data/loja_test_log.ldf
```

Esses arquivos estão sob /var/opt/mssql, montado no volume dados-sqlserver.
O log do banco é parte de seu armazenamento, diferente do log textual da aplicação.

Executamos o arquivo SQL novamente. As conexões seguintes retornaram os mesmos
IDs 5/6 e zero tabelas, verificando que os bancos existentes foram mantidos.
Não foi necessário criar tabelas ou dados para conferir a preparação.
Git diff confirmou código PHP/Laravel, Compose e imagens de construção preservados;
root .env e backend/.env continuam ignorados. Nenhum teste Laravel foi executado.

Explicação apresentada; entendimento da 5.5 confirmado com "entendi" em 13/10/2026.
Checkpoint fc2cdbc publicado conforme autorização. HEAD, origin/main e consulta
direta à main remota retornaram `fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.
Após confirmação: publicar 5.5 e iniciar 5.6, configurar acesso local pelo DBeaver
com publicação de porta em 127.0.0.1, conferir acesso e avisar o aluno.
Conexão Laravel, tabelas e configuração dos testes terão suas próprias etapas.

Fontes consultadas em 13/10/2026:

- [CREATE DATABASE](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-database-transact-sql?view=sql-server-ver16).
- [DB_ID](https://learn.microsoft.com/en-us/sql/t-sql/functions/db-id-transact-sql?view=sql-server-ver16).
- [sqlcmd](https://learn.microsoft.com/en-us/sql/tools/sqlcmd/sqlcmd-utility?view=sql-server-ver16).
