# Aula 7.32 — Migration de usuários no banco local da aplicação

Aplicação, explicação e verificações em 04/11/2026, após confirmação da 7.31
com "entendi". Checkpoint anterior publicado e conferido em
7c55de44e3900817a95ca0bbc351c7dcc24dbe3e; HEAD/origin/main/main remota iguais.
Entendimento da 7.32 confirmado com "entendi" em 04/11/2026.

## Objetivo e conexão

Aplicamos somente a [migration de usuários existente](../../backend/database/migrations/0001_01_01_000000_create_users_table.php)
no banco local normal loja. O arquivo não foi alterado. Sua aplicação em
loja_test na 7.4 não preparou loja: cada banco possui seu próprio histórico.
O estado criado fica no volume do SQL Server; o Git registra o arquivo e esta aula.

Usamos a conexão sqlsrv_migracoes de
[config/database.php](../../backend/config/database.php), estudada na 5.14.
Ela aponta a loja com o login loja_migracoes. A conexão padrão sqlsrv continua
usando loja_app; escolher a conexão de um comando não troca permanentemente
as credenciais da aplicação.

A primeira conferência selecionou sqlsrv/loja_app e foi interrompida pela
exigência de CREATE TABLE/ALTER dbo, ambos 0. Não tentou executar a migration.
Corrigida a seleção para a conexão dedicada já existente, conferimos loja/
loja_migracoes e permissões 1/1. Nenhuma permissão ou configuração foi alterada.

## Conferência antes da aplicação

Diagnóstico temporário PHP executado em Docker, pela entrada padrão, confirmou:

- Ambiente local, configuração sem cache, padrão sqlsrv e sessões file.
- Identidade loja/loja_migracoes na conexão de DDL e loja/loja_app na aplicação.
- Somente categorias/migrations/produtos, com três migrations nos lotes 1/2/3.
- Ausência das três tabelas novas e da entrada desta migration no histórico.
- Um produto e nenhuma categoria; migrate:status restrito retornou Pending.

Guardamos um resumo temporário em /tmp do container. Comparamos SHA-256 do
conteúdo integral das linhas do catálogo, ordenadas por id, e dos metadados
de colunas/índices/FKs das três tabelas anteriores. Também comparamos os três
registros anteriores de migrations. Não imprimimos conteúdo das linhas nem
credenciais; o arquivo temporário não pertence ao repositório.

## Comando aplicado

```sh
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv_migracoes \
  --path=database/migrations/0001_01_01_000000_create_users_table.php \
  --no-interaction --no-ansi
```

Exec -T executa no backend ativo sem terminal interativo. PHP executa o Artisan.
Migrate aplica o arquivo pendente; --database seleciona a configuração Laravel,
e --path limita a busca a esse arquivo relativo a /app. As opções finais
dispensam interação e códigos de cor. Não usamos --env=testing nesta aplicação.

Resultado create_users_table DONE, código 0. O método up executou três
Schema::create e a tabela migrations recebeu uma única entrada no lote 4.
Lote não é quantidade de usuários. Cache/jobs continuam Pending; catálogo
continua aplicado nos lotes 1/2/3. Não executamos seeders ou reversões.

## Estrutura conferida e relação com o login

| Tabela em loja | Colunas | Conteúdo principal | Linhas |
| --- | --- | --- | --- |
| users | 8 | id, name, email, email_verified_at, password, remember_token e timestamps | 0 |
| password_reset_tokens | 3 | email, token e created_at | 0 |
| sessions | 6 | id, user_id, ip_address, user_agent, payload e last_activity | 0 |

Users tem id BIGINT IDENTITY/chave primária e email único. Name/email/password
são NVARCHAR(255); remember_token NVARCHAR(100) anulável; datas DATETIME
anuláveis. Password recebe hash quando o modelo User for usado para gravá-la;
a migration apenas define a coluna, sem produzir hash ou cadastrar conta.

Password_reset_tokens tem email como chave primária. Sessions tem chave
primária textual id, user_id BIGINT anulável e índices comuns em user_id/
last_activity. ForeignId sozinho não cria FK: não há FK em sessions.user_id.
Os 17 campos, tipos/tamanhos/null/identity, ausência de defaults e índices
foram conferidos nos metadados. Não inserimos dados para testar restrições.

O diagnóstico posterior inicial saiu 1 porque Schema::getColumns apresentou
tamanhos de NVARCHAR em bytes, comparados incorretamente com a declaração
esperada. A leitura direta de sys.columns, normalizando max_length/2 para os
limites finitos de NVARCHAR, confirmou 255/100/45; -1 corresponde a max.
Corrigimos somente o diagnóstico temporário; migration e banco estavam corretos.
Referência: [sys.columns e max_length em bytes](https://learn.microsoft.com/en-us/sql/relational-databases/system-catalog-views/sys-columns-transact-sql?view=sql-server-ver17).

Criar sessions não muda SESSION_DRIVER=file. Criar tabelas de recuperação não
implementa recuperação de senha. O LoginController já estudado poderá consultar
users pela conexão padrão quando sua rota for registrada.

## Histórico, reexecução e preservação

Migrate:status --database=sqlsrv_migracoes mostrou [4] Ran. Repetimos o mesmo
comando restrito de migrate: Nothing to migrate, código 0. Permanece uma única
entrada dessa migration. A aplicação é controlada pelo histórico de cada banco.
Referência: [execução e status de migrations](https://laravel.com/docs/13.x/migrations#running-migrations).

Comparações posteriores, inclusive após a suíte, passaram: conteúdo integral
das linhas do catálogo, metadados anteriores e registros anteriores de migrations
preservados. Produto continua um/categorias zero; novas tabelas zero. O resumo
da estrutura anterior permaneceu
8ded6e0e43dd85b1d8eb830949b818fd332fcaf4c5b9fb5b8dce02c01d7e5104.

SELECT pela própria loja_app conseguiu ler as três tabelas vazias. Consultas
de permissões confirmaram SELECT/INSERT/UPDATE/DELETE em users e ausência de
CREATE TABLE/ALTER dbo. Não testamos escrita de usuários no banco normal.

```sh
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Suíte existente passou: 96 testes/959 asserções, código 0. Continua usando
loja_test. SELECT posterior confirmou loja_test/loja_testes, seis tabelas,
quatro migrations/lotes 1/2/3/4 e zero users/tokens/sessions/produtos/categorias.
Não criamos testes permanentes nesta etapa. Auditoria/quatro contratos não repetidos.

## Continuidade

Aplicação, explicação e verificações concluídas; entendimento confirmado com
"entendi" em 04/11/2026. Documentação atualizada; nenhum código, ambiente,
dependência, permissão, rota ou OpenAPI alterado. Publicação da 7.32 concluída
e conferida em a79946a23fcd964e7f41c8a3d79ecfca99c54214;
HEAD/origin/main/main remota iguais após push. Registro posterior à publicação.
Continuidade realizada na 7.33 — registrar somente POST /api/v1/login para
LoginController::store com throttle:login e conferir sua integração inicial
ao pipeline HTTP, sem avançar recuperação de senha ou logout.
