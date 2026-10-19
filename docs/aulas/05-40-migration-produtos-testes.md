# Aula 5.40 — Tabela produtos no banco de testes

## Objetivo e estado

Preparar a tabela produtos em loja_test usando a migration já estudada.
Aplicação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" nessa data. Nenhum código novo de aplicação ou teste nesta etapa.

A 5.39 foi confirmada com "entendi" e publicada em bdfb1a3. HEAD, origin/main
e consulta direta à main remota retornaram
bdfb1a3ded8be0ef265d6d6bd745e7385fb34354 após o push.

## Mesmo arquivo, outro banco

Reutilizamos backend/database/migrations/2026_10_14_123220_create_produtos_table.php
sem alterar seu conteúdo. O método up descreve a criação de produtos; down
descreve sua remoção para uma reversão. Nesta etapa somente up foi aplicado.

O arquivo PHP versionado descreve a estrutura. Cada banco mantém seu próprio
registro das migrations aplicadas. A aplicação anterior em loja não cria
automaticamente a mesma tabela em loja_test nem preenche o histórico desse banco.

Antes da aplicação, diagnóstico Laravel em Docker confirmou .env.testing,
ambiente testing, conexão sqlsrv, banco loja_test, login/usuário loja_testes,
zero tabelas, CREATE TABLE/ALTER dbo = 1/1 e ausência de acesso ao banco loja.
Não havia cache de configuração. A ajuda Artisan confirmou as opções usadas.

## Comando aplicado

Na raiz do repositório:

```bash
docker compose exec -T backend php artisan migrate \
  --env=testing \
  --database=sqlsrv \
  --path=database/migrations/2026_10_14_123220_create_produtos_table.php \
  --no-interaction --no-ansi
```

exec executa dentro do backend ativo e -T dispensa terminal interativo.
migrate aplica migrations pendentes. --env=testing solicita .env.testing;
--database=sqlsrv seleciona o nome de conexão Laravel em config/database.php,
não o nome de um banco diretamente. Nesse ambiente ela aponta para loja_test
com loja_testes.

--path limita a execução ao arquivo indicado, relativo à raiz Laravel /app.
Assim as migrations geradas de users, cache e jobs continuam sem aplicação.
--no-interaction evita perguntas de terminal; --no-ansi remove códigos de cor.
Não usamos --seed, --force, rollback ou recriação de tabelas existentes.

O comando terminou com código 0: Creating migration table DONE e migration
2026_10_14_123220_create_produtos_table DONE. O Laravel primeiro criou a tabela
de controle migrations e então aplicou up de produtos e registrou a conclusão.

## Estrutura conferida

| Tabela em loja_test | Estado |
| --- | --- |
| dbo.produtos | Vazia, sem produtos cadastrados |
| dbo.migrations | Uma entrada da migration de produtos no lote 1 |

Os nomes são iguais aos usados em loja, mas as tabelas pertencem a bancos
diferentes. Nenhum produto foi copiado entre bancos e nenhum seeder foi executado.

Metadados SQL conferidos por SELECT:

| Coluna | Tipo | Aceita NULL? | Detalhe |
| --- | --- | --- | --- |
| id | BIGINT | Não | IDENTITY e chave primária |
| nome | NVARCHAR(150) | Não | Nome do produto |
| preco_em_centavos | INT | Não | Preço inteiro |
| status | NVARCHAR(20) | Não | Default ('ativo') |
| created_at | DATETIME2(3) | Sim | Data/hora |
| updated_at | DATETIME2(3) | Sim | Data/hora |

Essa é a estrutura definida pela migration já explicada na 5.12 e aplicada
ao banco normal na 5.15. Aqui foi conferida a aplicação no banco exclusivo
de testes. Regras de conteúdo além desses tipos não foram acrescentadas.

## Histórico e reexecução

migrate:status com os mesmos --env, --database e --path retornou [1] Ran.
O registro em migrations contém nome do arquivo sem .php e batch = 1.
Ao repetir exatamente o migrate acima, a saída foi Nothing to migrate,
código 0. O histórico evita aplicar novamente esse arquivo; continuou uma
única entrada e zero produtos.

Consulta separada no ambiente normal confirmou loja/loja_app, um produto e
uma migration. Nenhuma escrita foi feita nesse banco. git diff --check passou;
arquivos privados seguem ignorados/fora do índice. Código, dependências,
configurações e credenciais preservados. Apenas novos registros da aula.

A última suíte é a da 5.39, com 2 testes/2 asserções. Não foi repetida nesta
etapa porque aqueles exemplos não utilizam a estrutura criada aqui. Os futuros
testes de integração consultarão a tabela real preparada em loja_test.

## Continuidade

Entendimento da 5.40 confirmado com "entendi" em 19/10/2026. Publicar os registros
e iniciar 5.41, criando somente o primeiro teste de integração de catálogo
vazio e explicando a preparação e o isolamento dos dados de teste.

Em novo clone, os arquivos de migration vêm do Git; as tabelas e os registros
de migrations dependem do banco/volume. Preparar o ambiente local e conferir a
identidade da conexão antes de aplicar a migration ao banco exclusivo de testes.
