-- Execute pelo sqlcmd com MSSQL_LOJA_PASSWORD na configuração local.
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
