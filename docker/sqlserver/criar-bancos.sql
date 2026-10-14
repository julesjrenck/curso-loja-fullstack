-- Bancos da aplicação e dos testes de integração, no servidor local do curso.
USE [master];
GO

IF DB_ID(N'loja') IS NULL
    CREATE DATABASE [loja];
GO

IF DB_ID(N'loja_test') IS NULL
    CREATE DATABASE [loja_test];
GO
