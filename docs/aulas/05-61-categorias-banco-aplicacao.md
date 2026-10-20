# Aula 5.61 — Categorias criada no banco da aplicação

## Objetivo e estado

Aplicar em loja a mesma migration de categorias já conferida no banco de testes,
preservando o produto cadastrado. Aplicação, explicação e verificações em
20/10/2026; entendimento confirmado com "entendi" na mesma data. Nenhum código da aplicação alterado.

A 5.60 foi confirmada com "entemdi" e publicada em
04ab6bb0f86c833a08e6582ee2634594aa072dab. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Conexão e preparação

A conexão sqlsrv_migracoes já existe em config/database.php desde a 5.14.
Ela aponta ao banco loja com a conta loja_migracoes; a conexão padrão sqlsrv usa
loja_app. A opção --database escolhe uma configuração de conexão Laravel,
sem trocar permanentemente a conta usada pela aplicação.

O diagnóstico temporário /tmp/curso-561-categorias-loja.php foi enviado ao PHP
Docker pela entrada padrão, no ambiente normal:

```bash
docker compose exec -T backend php /dev/stdin < /tmp/curso-561-categorias-loja.php
```

Exec executa no backend iniciado; -T dispensa terminal interativo. O shell lê
o arquivo do host com < e PHP o recebe por /dev/stdin. Não usamos --env=testing.

Antes da aplicação, SELECTs confirmaram loja/loja_migracoes/loja_migracoes,
permissões CREATE TABLE/ALTER dbo e loja/loja_app na conexão normal. Havia
somente migrations/produtos, uma migration e um produto. Guardamos em memória
id, nome, preco_em_centavos, status, created_at e updated_at, além do OBJECT_ID
da tabela produtos, para comparar após a execução.

## Aplicação

O script chamou migrate pelo kernel do Artisan com estas opções:

```php
$kernel->call('migrate', [
    '--database' => 'sqlsrv_migracoes',
    '--path' => 'database/migrations/2026_10_20_113601_create_categorias_table.php',
    '--no-interaction' => true,
    '--no-ansi' => true,
]);
```

Equivale ao comando, no Docker:

```bash
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv_migracoes \
  --path=database/migrations/2026_10_20_113601_create_categorias_table.php \
  --no-interaction --no-ansi
```

Migrate aplica o arquivo pendente indicado por --path, relativo a /app.
--database usa a conta de migrations; --no-interaction dispensa perguntas e
--no-ansi remove códigos de cor. Credenciais existentes foram carregadas do
ambiente local sem exibição ou alteração. Não usamos seeding, recriação ou rollback.

Saída: create_categorias_table DONE, código 0. O histórico passou a ter categorias
no lote 2, mantendo produtos no lote 1. Migrate:status com as mesmas opções mostrou
[2] Ran. Nova chamada a migrate retornou 0 e o diagnóstico conferiu a mensagem
Nothing to migrate antes de consumir essa saída.

## Verificações finais

Metadados de categorias conferidos pela conta de migrations: id BIGINT IDENTITY
e chave primária, nome NVARCHAR(150) não nulo e created_at/updated_at DATETIME2(3)
anuláveis. Somente categorias/migrations/produtos no banco loja.

| Banco | Categorias | Produtos | Migrations |
| --- | --- | --- | --- |
| loja | 0 | 1 | 2 |
| loja_test | 0 | 0 | 2 |

No banco normal, as seis colunas do produto ficaram exatamente iguais à cópia
anterior e OBJECT_ID de produtos foi preservado. Leitura de categorias com
loja_app passou; conexão padrão continua sqlsrv. Nenhum model ou dado de categoria
foi criado. Produtos ainda não possui categoria_id.

O banco de testes foi conferido em processo separado usando o diagnóstico da
5.60, com --env=testing: estrutura e contagens preservadas, código 0. Cada banco
tem seu próprio histórico de migrations, mesmo usando os mesmos arquivos PHP.

Git diff --check passou; segredos continuam ignorados e fora do índice. Suíte
não repetida após esta verificação dirigida de DDL/preservação; último resultado
6 testes/14 asserções pertence à 5.53.

## Continuidade

Entendimento da 5.61 confirmado. Publicar o checkpoint
e iniciar 5.62: criar somente model Categoria com nome permitido para preenchimento,
explicar tabela/timestamps e conferir sem persistir categorias ou definir relações.
