-- Preparado na etapa 5.66 para uso com sqlcmd, após a criação de categorias.
-- Concede somente REFERENCES na tabela de categorias do banco de testes.
:ON ERROR EXIT

USE [loja_test];
GO

GRANT REFERENCES ON OBJECT::[dbo].[categorias] TO [loja_testes];
GO
