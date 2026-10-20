# Aula 5.60 — Categorias criada no banco de testes

## Objetivo e estado

Aplicar somente a migration de categorias em loja_test e conferir a estrutura
real no SQL Server. Aplicação, explicação e verificações em 20/10/2026;
entendimento confirmado com "entemdi" em 20/10/2026. Nenhum código da aplicação alterado.

A 5.59 foi confirmada com "entendi" e publicada em
9e890107b1a50c90c9df00e717875bb627425317. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Preparação

A mesma migration preparada na 5.59 foi usada, sem modificar seu conteúdo.
O diagnóstico temporário /tmp/curso-560-antes-categorias.php foi enviado pela
entrada padrão ao PHP do container com --env=testing. Confirmou ambiente testing,
conexão sqlsrv, banco loja_test, login/usuário loja_testes e permissões de
CREATE TABLE/ALTER dbo. Tabelas existentes: migrations e produtos; produtos
vazia e uma migration no lote 1. Categorias ainda ausente.

SELECT separado confirmou loja/loja_app com um produto e uma migration.
Credenciais usadas vieram dos arquivos locais ignorados; não foram impressas
nem versionadas. O login de testes já possui permissões para seu banco exclusivo.

## Comando executado

```bash
docker compose exec -T backend php artisan migrate \
  --env=testing --database=sqlsrv \
  --path=database/migrations/2026_10_20_113601_create_categorias_table.php \
  --no-interaction --no-ansi
```

Exec executa no serviço backend iniciado; -T dispensa terminal interativo.
Migrate aplica migrations pendentes. --env=testing seleciona .env.testing.
--database=sqlsrv escolhe o nome da conexão Laravel, configurada nesse ambiente
para loja_test/loja_testes; não é o nome do banco diretamente.

--path restringe a execução ao arquivo, com caminho relativo à raiz Laravel
/app. Migrations geradas de users/cache/jobs não foram aplicadas. --no-interaction
dispensa perguntas e --no-ansi remove códigos de cor. Não usamos --seed,
recriação de tabelas ou rollback. Saída: migration create_categorias_table DONE,
código 0. Laravel executou up e registrou a conclusão em migrations.

## Estrutura e histórico conferidos

O diagnóstico temporário /tmp/curso-560-depois-categorias.php foi enviado pela
entrada padrão ao PHP Docker no ambiente testing. SELECTs consultaram identidade,
tabelas, colunas, chave primária, contagens e histórico; código 0.

| Coluna em dbo.categorias | Tipo SQL Server | Aceita NULL? | Detalhe |
| --- | --- | --- | --- |
| id | BIGINT | Não | IDENTITY e chave primária |
| nome | NVARCHAR(150) | Não | Nome da categoria |
| created_at | DATETIME2(3) | Sim | Data/hora |
| updated_at | DATETIME2(3) | Sim | Data/hora |

São as colunas descritas por id(), string('nome', 150) e timestamps(3).
O tamanho de nome nos metadados é 300 bytes, correspondente às 150 unidades
UTF-16 do NVARCHAR. Datas possuem escala 3, para milissegundos.

O banco de testes agora tem somente categorias, produtos e migrations:

| Tabela | Estado |
| --- | --- |
| categorias | Vazia |
| produtos | Vazia |
| migrations | Duas entradas: produtos lote 1; categorias lote 2 |

Nenhuma categoria foi cadastrada, e produtos ainda não possui categoria_id.
Criar a tabela não cria os registros nem o relacionamento automaticamente.

Migrate:status com o mesmo ambiente/conexão/path mostrou [2] Ran: migration
aplicada no lote 2. Repetimos o mesmo migrate e a saída foi Nothing to migrate,
código 0. O registro em migrations evita executar novamente esse arquivo.

Consulta separada normal confirmou loja/loja_app com um produto e uma migration.
Nenhuma escrita foi feita nesse banco. Cada banco mantém seu próprio histórico;
aplicar em loja_test não aplica automaticamente em loja.

Git diff --check passou; segredos continuam ignorados e fora do índice. Suíte
não repetida após esta verificação dirigida de DDL/histórico; último resultado
6 testes/14 asserções é da 5.53 e não foi apresentado como teste de categorias.

## Continuidade

Entendimento da 5.60 confirmado. Publicar o checkpoint
e iniciar 5.61: aplicar somente a mesma migration em loja com conta
loja_migracoes; conferir esquema/histórico e preservar o produto existente.
