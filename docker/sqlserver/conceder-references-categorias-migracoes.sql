-- Usar com sqlcmd, após a criação de categorias no banco da aplicação.
-- Concede somente REFERENCES na tabela de categorias à conta de migrations.
:ON ERROR EXIT

USE [loja];
GO

GRANT REFERENCES ON OBJECT::[dbo].[categorias] TO [loja_migracoes];
GO
