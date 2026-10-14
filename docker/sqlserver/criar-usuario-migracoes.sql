-- Execute pelo sqlcmd com MSSQL_MIGRATIONS_PASSWORD na configuração local.
USE [master];
GO

IF SUSER_ID(N'loja_migracoes') IS NULL
    CREATE LOGIN [loja_migracoes]
        WITH PASSWORD = N'$(MSSQL_MIGRATIONS_PASSWORD)',
             CHECK_POLICY = ON,
             DEFAULT_DATABASE = [loja];
GO

USE [loja];
GO

IF USER_ID(N'loja_migracoes') IS NULL
    CREATE USER [loja_migracoes] FOR LOGIN [loja_migracoes]
        WITH DEFAULT_SCHEMA = [dbo];
GO

IF IS_ROLEMEMBER(N'db_datareader', N'loja_migracoes') = 0
    ALTER ROLE [db_datareader] ADD MEMBER [loja_migracoes];
GO

IF IS_ROLEMEMBER(N'db_datawriter', N'loja_migracoes') = 0
    ALTER ROLE [db_datawriter] ADD MEMBER [loja_migracoes];
GO

GRANT CREATE TABLE TO [loja_migracoes];
GRANT ALTER ON SCHEMA::[dbo] TO [loja_migracoes];
GO
