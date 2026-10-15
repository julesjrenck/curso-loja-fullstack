# Aula 5.15 — Aplicar a migration de produtos

## Objetivo

Criar a tabela produtos no banco loja pela migration que estudamos. A conexão
5.14 foi confirmada com "entendi" e publicada em 26e7b5b, SHA completo
26e7b5b8a674e775b2e882ea4c78f62aeed9d945, conferido na main remota.

Nesta etapa aplicamos um único arquivo existente. Não alteramos seu código.
Antes da execução, consulta pela conexão sqlsrv_migracoes confirmou banco
loja, login loja_migracoes e zero tabelas. A ajuda Artisan confirmou as opções.

## Comando executado

Na raiz do repositório:

```bash
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv_migracoes \
  --path=database/migrations/2026_10_14_123220_create_produtos_table.php \
  --no-interaction
```

exec executa no backend existente; -T desliga terminal interativo; php artisan
inicializa Laravel em /app. migrate aplica as migrations pendentes selecionadas.
--database recebe o nome da configuração Laravel, sqlsrv_migracoes. Essa
configuração aponta ao banco loja com a conta loja_migracoes; não estamos
informando o nome de um banco diretamente nessa opção.

--path informa o arquivo relativo à raiz da aplicação Laravel. Assim a execução
inclui apenas a migration de produtos. As migrations geradas de users, cache
e jobs continuam sem aplicação. --no-interaction evita perguntas do terminal;
o ambiente é local e não usamos --force, --seed ou rollback.

## O que aconteceu

O Laravel criou dbo.migrations porque o registro de migrations ainda não
existia. Depois executou up() do arquivo de produtos pela conexão selecionada.
Schema::create transformou o Blueprint em SQL e o servidor criou dbo.produtos.
Ao terminar, o Laravel registrou a migration aplicada.

Saída do comando, concluído com código 0:

```text
Creating migration table ... DONE
2026_10_14_123220_create_produtos_table ... DONE
```

## A tabela migrations

migrations é uma tabela real criada pelo Laravel para acompanhar o histórico
de aplicações, com os campos id, migration e batch. O banco passou a ter:

| Tabela | Conteúdo atual |
| --- | --- |
| dbo.produtos | Estrutura de produtos; zero registros |
| dbo.migrations | Uma migration aplicada, no lote 1 |

Registro conferido:

| migration | batch |
| --- | --- |
| 2026_10_14_123220_create_produtos_table | 1 |

migration guarda o nome do arquivo sem .php; batch identifica o lote de
aplicação. Um lote pode conter várias migrations quando aplicadas juntas.
O Laravel consulta esse registro para distinguir arquivos já aplicados dos
pendentes. Em uma nova execução com o mesmo caminho, retornou Nothing to migrate.

Esse registro não faz parte do Git. Git versiona o arquivo PHP; o volume SQL
Server contém o banco, suas tabelas e dados. Em outro ambiente, aplicamos o
mesmo arquivo para criar seu esquema local. Alterações futuras de estrutura
deverão ser descritas em novas migrations, preservando este histórico aplicado.

## Esquema verificado no servidor

| Coluna | Tipo | Aceita NULL? | Regra estrutural |
| --- | --- | --- | --- |
| id | BIGINT | Não | IDENTITY e chave primária |
| nome | NVARCHAR(150) | Não | Texto com tamanho definido |
| preco_em_centavos | INT | Não | Inteiro em centavos |
| status | NVARCHAR(20) | Não | Default ativo |
| created_at | DATETIME2(3) | Sim | Data/hora |
| updated_at | DATETIME2(3) | Sim | Data/hora |

Diagnóstico PHP em Docker usou a conexão de migrations para conferir sys.tables,
sys.columns, sys.types, sys.default_constraints e a chave primária. Tipos,
tamanhos, precisão, NULL, IDENTITY, chave id e definição ('ativo') conferidos.
Conferiu também a linha de migrations e zero produtos.

O primeiro diagnóstico tentou ler a definição de default pela conta loja_app
e recebeu NULL, por visibilidade de metadados. Essa comparação falhou; a
definição foi conferida com loja_migracoes e o diagnóstico repetido passou.
Nenhuma correção de schema ou ampliação de permissões foi necessária.
Isso retoma a diferença entre poder consultar dados e inspecionar definições.

A conexão padrão sqlsrv continua loja_app. Ela conseguiu ler produtos, ainda
vazia. Não inserimos dados para testar defaults ou validações nesta etapa.
Regras de conteúdo, como preço não negativo e status permitido, ainda terão
implementação própria; não estão garantidas pelos tipos escolhidos sozinhos.

## Status e reexecução

```bash
docker compose exec -T backend php artisan migrate:status \
  --database=sqlsrv_migracoes \
  --path=database/migrations/2026_10_14_123220_create_produtos_table.php
```

migrate:status consulta o registro sem aplicar migrations. Retornou [1] Ran.
O diagnóstico também chamou Artisan::call('migrate', ...) com a mesma conexão
e caminho, verificou Nothing to migrate, código 0, mesmos OBJECT_ID das tabelas,
uma única linha em migrations e configuração padrão sqlsrv preservada.

HTTP /loja continuou com 200, título, três produtos e X-Curso preservados.
A página ainda usa CatalogoDemonstracao; não está lendo a nova tabela.
git diff --check passou e nenhum arquivo PHP existente foi alterado na 5.15.
Sem nova dependência, credencial, serviço ou alteração do contador didático.

## Conferir no DBeaver

Atualize a lista de tabelas do banco loja: agora dbo.produtos e dbo.migrations
estão presentes. Para conferir somente por leitura:

```sql
SELECT * FROM dbo.produtos;
SELECT migration, batch FROM dbo.migrations;
```

A primeira retorna as colunas com zero linhas; a segunda retorna o registro
acima. Os resultados do aluno ainda não foram recebidos; não registrar como
experiência executada pelo aluno até ele relatar o resultado.

## Continuidade

Migration aplicada, explicação apresentada e verificações concluídas. Entendimento
da 5.15 confirmado com "entendi" em 14/10/2026. Checkpoint publicado e conferido
em 36db8e8: HEAD, origin/main e main remota retornaram
36db8e85393e59404ba55f3556d2fc9d356746c9. Registro no checkpoint seguinte.
Próximo passo realizado na 5.16: gerar apenas
o model Eloquent Produto e explicar sua ligação à tabela produtos, sem inserir
registros ou trocar o catálogo demonstrativo nesta primeira etapa do model.

Fontes consultadas em 14/10/2026:

- [Aplicação de migrations Laravel 13](https://laravel.com/docs/13.x/migrations#running-migrations).
- [Visibilidade de metadados SQL Server](https://learn.microsoft.com/en-us/sql/relational-databases/security/metadata-visibility-configuration?view=sql-server-ver16).
