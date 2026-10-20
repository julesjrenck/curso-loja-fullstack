# Aula 5.66 — Script de REFERENCES preparado

## Objetivo e estado

Preparar a permissão que falta para criar a FK no banco de testes, limitada
à tabela referenciada. Implementação, explicação e verificações em 20/10/2026;
entendimento confirmado com "entendi" em 20/10/2026. Concessão ainda não executada.

A descoberta da 5.65 foi confirmada com "entendi" e publicada em
91ed88437740d62dcfdc824631848195425267de. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Arquivo preparado

docker/sqlserver/conceder-references-categorias-testes.sql:

```sql
:ON ERROR EXIT

USE [loja_test];
GO

GRANT REFERENCES ON OBJECT::[dbo].[categorias] TO [loja_testes];
GO
```

O arquivo também contém comentários explicativos e não contém senhas.
:ON ERROR EXIT é uma instrução do cliente sqlcmd para encerrar em caso de erro.
GO separa lotes e também é processado pelo cliente; por isso o arquivo é
destinado ao sqlcmd, como os scripts de criação de usuários já estudados.

USE escolhe loja_test. GRANT concede a permissão REFERENCES; ON OBJECT limita
ao objeto dbo.categorias, identificando esquema e tabela. TO indica o usuário
loja_testes dentro desse banco, já existente e associado ao login da conta.

Essa concessão permitirá usar categorias como alvo de chave estrangeira.
Não cria a FK, não adiciona categoria_id e não concede privilégios administrativos.
Não concede permissão ao usuário loja_migracoes em loja. A conta que executar
o GRANT precisará de autoridade para conceder essa permissão; a aplicação será
uma etapa posterior usando a conta administrativa já preparada no ambiente local.

## Análise sem concessão

O arquivo integral foi colocado entre SET PARSEONLY ON e OFF, em lotes separados,
na entrada temporária /tmp/curso-566-parse-references.sql. Executamos:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -b -l 5' < /tmp/curso-566-parse-references.sql
```

Exec usa o serviço SQL Server iniciado; -T dispensa terminal interativo. O shell
interno disponibiliza a senha já existente em SQLCMDPASSWORD para autenticar
sqlcmd; o valor não foi impresso nem colocado no arquivo público. -S localhost
usa o servidor dentro do container, -U sa escolhe a conta administrativa, -C
confia no certificado local, -b retorna falha em erro SQL e -l 5 limita o login.
O shell do host envia a entrada temporária com <.

PARSEONLY analisa sintaxe sem compilar ou executar as instruções. Código 0,
sem erros. Isso não comprova uma concessão real, pois o GRANT não foi executado.

## Conferências posteriores

O diagnóstico temporário /tmp/curso-566-conferir-permissao.php foi enviado ao PHP
Docker com e sem --env=testing. Consulta HAS_PERMS_BY_NAME autenticou com as
contas correspondentes e confirmou:

| Banco/conta | REFERENCES em dbo.categorias | Categorias | Produtos | Migrations |
| --- | --- | --- | --- | --- |
| loja_test/loja_testes | 0 | 0 | 0 | 2 |
| loja/loja_migracoes | 0 | 0 | 1 | 2 |

Categoria_id continua ausente nos dois bancos. Migrate:status no teste continua
Pending. Todas essas consultas terminaram com código 0. Nenhum GRANT, migration,
seeder ou teste da suíte executado nesta etapa. Último resultado 6 testes/14
asserções permanece identificado como histórico da 5.53.

Git diff --check passou; credenciais locais continuam ignoradas e fora do índice.

## Continuidade

Entendimento da 5.66 confirmado. Publicar o checkpoint
e iniciar 5.67: aplicar este script somente em loja_test, conferir REFERENCES
efetivo e repetir apenas migration de categoria_id e suíte existente, verificando
FK/histórico/contagens. Permissão e FK do banco normal ficam para outra etapa.
