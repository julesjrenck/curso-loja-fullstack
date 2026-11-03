# Aula 7.4 — Migration de usuários no banco de testes

Aplicação, explicação e verificações em 03/11/2026, após confirmação da 7.3
com "entendi". Checkpoint anterior publicado e conferido em
cab244eb8221004bf63937750fa81951986d62ca; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.4 confirmado com "entendi" em 03/11/2026.

## Objetivo

Aplicar somente a [migration já estudada](../../backend/database/migrations/0001_01_01_000000_create_users_table.php)
em loja_test, preparando as tabelas para os futuros testes de usuários.
Não alteramos o arquivo PHP nem cadastramos usuários. O estado criado fica
no banco/volume Docker; os arquivos de documentação registram a aplicação.

Cada banco mantém seu próprio histórico de migrations. Aplicar um arquivo
em loja_test não o aplica em loja. Como já vimos no catálogo, o mesmo arquivo
pode ser usado em ambientes diferentes, cada um com seu histórico.

## Conferência anterior

Diagnóstico Laravel no Docker, usando --env=testing, confirmou:

- Arquivo .env.testing, ambiente testing, conexão sqlsrv, banco loja_test.
- Login e usuário loja_testes; CREATE TABLE e ALTER dbo permitidos.
- Ausência de cache de configuração e das três tabelas dessa migration.
- Histórico existente com três migrations do catálogo, lotes 1/2/3.
- Zero produtos e categorias no banco de testes.

A [configuração de banco](../../backend/config/database.php) lê os valores do
ambiente. O [modelo público do ambiente de testes](../../backend/.env.testing.example)
documenta essa separação; os valores privados permanecem na cópia local ignorada.

## Comando aplicado

```sh
docker compose exec -T backend php artisan migrate \
  --env=testing \
  --database=sqlsrv \
  --path=database/migrations/0001_01_01_000000_create_users_table.php \
  --no-interaction --no-ansi
```

exec -T executa no backend ativo sem terminal interativo. --env=testing
seleciona o ambiente de testes; --database=sqlsrv escolhe o nome da conexão
Laravel, que nesse ambiente aponta para loja_test/loja_testes. --path restringe
a aplicação a esse arquivo, relativo à raiz /app do Laravel no container.
As opções finais dispensam perguntas interativas e cores na saída.

Agora não usamos --pretend: o Laravel executou up e registrou a aplicação.
Resultado: migration create_users_table DONE, código 0, lote 4. Como o arquivo
contém três Schema::create, essa única migration criou três tabelas.
Não executamos seeders, migrations de cache/jobs nem comandos de reversão.

## Estrutura real conferida

Consultas aos metadados do SQL Server conferiram tipos, tamanhos, possibilidade
de null, identity, chaves primárias e índices.

| Tabela criada em loja_test | Colunas | Chave primária | Linhas após a aula |
| --- | --- | --- | --- |
| dbo.users | 8 | id, BIGINT IDENTITY | 0 |
| dbo.password_reset_tokens | 3 | email | 0 |
| dbo.sessions | 6 | id textual | 0 |

São 17 colunas no total. users.email tem índice único; sessions.user_id e
sessions.last_activity têm índices comuns. Não há FK em sessions.user_id.
Os tipos correspondem ao SQL observado na 7.3: textos NVARCHAR, datas DATETIME,
user_id BIGINT e last_activity INT. Os campos opcionais e limites também foram
conferidos. O diagnóstico consulta metadados; não insere linhas para testar
as restrições de conteúdo nesta etapa.

O primeiro diagnóstico terminou 1 por um erro na contagem esperada: esperava
18, embora a própria definição somasse 8+3+6=17. Tipos/campos estavam corretos;
as outras verificações passaram. Corrigida a expectativa somente no diagnóstico,
a conferência completa de colunas/tipos/tamanhos/null/identity terminou 0.
Nenhuma correção de migration ou banco foi necessária.

## Histórico, reexecução e suíte

```sh
docker compose exec -T backend php artisan migrate:status \
  --env=testing --database=sqlsrv --no-ansi
```

O status passou a [4] Ran para a migration de usuários. Cache/jobs continuam
Pending; catálogo continua Ran nos lotes 1/2/3. O registro usa o nome do arquivo
sem .php; batch 4 agrupa a execução atual. Não é o número de usuários criados.

Repetimos o comando de aplicação com as mesmas opções: Nothing to migrate,
código 0. O histórico indica que esse arquivo já foi aplicado nesse banco.
Depois, permaneceu uma única entrada da migration no lote 4.

```sh
docker compose exec -T backend php artisan test --do-not-cache-result
```

A suíte existente passou: 66 testes/620 asserções, código 0. Ela verifica os
comportamentos já cobertos, principalmente catálogo e relacionamentos; ainda
não testa persistência de usuários ou login. Não criamos testes nesta etapa.
O fluxo separado dos quatro contratos não foi executado novamente.

Após a suíte, loja_test/loja_testes manteve zero users/tokens/sessions/produtos/
categorias e quatro registros em migrations. As fixtures do catálogo foram
desfeitas pelas transações dos testes. A estrutura aplicada pela migration
permanece no banco, fora dessas transações.

## Banco normal e continuidade

Consultas de leitura antes/depois em loja/loja_app mantiveram somente
categorias/migrations/produtos, três migrations nos lotes 1/2/3 e um produto/
zero categorias. O resumo SHA-256 desses metadados e contagens permaneceu
8c61be048457250963c87f8c8c40dd595d57a3c2349070c9cdd0994c1151fa7a.
Não compara o conteúdo integral das linhas. As tabelas de usuários continuam
ausentes no banco normal, consultado apenas para conferência.

Nenhum código de aplicação, configuração, dependência ou rota foi alterado.
Criar tabelas não implementa login. Entendimento confirmado com "entendi" em
03/11/2026; checkpoint publicado e conferido em
65880d06e1c96c1b0273480d59792bd11d384c2a, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.

Próximo passo, após publicar este checkpoint:
7.5 — criar o primeiro teste de persistência de User em loja_test usando
DatabaseTransactions, sem criar uma rota de login.
