-- Preparado na etapa 5.34; criação da conta será uma etapa posterior.
-- Usar sqlcmd com MSSQL_TESTS_PASSWORD na configuração local, sem senha neste arquivo.
:ON ERROR EXIT

USE [master];
GO

IF SUSER_ID(N'loja_testes') IS NULL
    CREATE LOGIN [loja_testes]
        WITH PASSWORD = N'$(MSSQL_TESTS_PASSWORD)',
             CHECK_POLICY = ON,
             DEFAULT_DATABASE = [loja_test];
GO

USE [loja_test];
GO

IF USER_ID(N'loja_testes') IS NULL
    CREATE USER [loja_testes] FOR LOGIN [loja_testes]
        WITH DEFAULT_SCHEMA = [dbo];
GO

IF IS_ROLEMEMBER(N'db_datareader', N'loja_testes') = 0
    ALTER ROLE [db_datareader] ADD MEMBER [loja_testes];
GO

IF IS_ROLEMEMBER(N'db_datawriter', N'loja_testes') = 0
    ALTER ROLE [db_datawriter] ADD MEMBER [loja_testes];
GO

GRANT CREATE TABLE TO [loja_testes];
GRANT ALTER ON SCHEMA::[dbo] TO [loja_testes];
GO
