# Aula 5.68 — REFERENCES e FK aplicadas no banco da aplicação

## Objetivo e estado

Aplicar em loja o preparo já conferido no banco de testes, preservando o produto
existente. Implementação, aplicação, explicação e verificações em 20/10/2026;
entendimento confirmado com "entendi" em 20/10/2026.

A 5.67 foi confirmada com "entendi" e publicada em
e384ae163143380a1bd17764cdeb92786ed8c38c. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Arquivo e concessão

Criado docker/sqlserver/conceder-references-categorias-migracoes.sql, mantendo
o formato de sqlcmd já apresentado:

```sql
:ON ERROR EXIT

USE [loja];
GO

GRANT REFERENCES ON OBJECT::[dbo].[categorias] TO [loja_migracoes];
GO
```

Use seleciona loja; GRANT concede REFERENCES somente no objeto dbo.categorias
ao usuário loja_migracoes. GO separa lotes e :ON ERROR EXIT encerra o cliente
ao encontrar erro. Não há senha no arquivo, mudança de conta da aplicação ou
atribuição de privilégios administrativos.

Antes, diagnóstico autenticado como loja_migracoes confirmou REFERENCES 0,
categoria_id ausente e contagens zero categorias/um produto/duas migrations.
Executamos pelo serviço SQL Server:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -b -l 5' < docker/sqlserver/conceder-references-categorias-migracoes.sql
```

Exec usa o container iniciado; -T dispensa terminal interativo. O shell interno
fornece a senha existente por SQLCMDPASSWORD, sem imprimi-la. Sqlcmd usa localhost,
login sa, certificado local confiado, falha em erro SQL e limite de login de cinco
segundos. O shell do host envia o arquivo com <. Código 0; contexto loja confirmado.

## Aplicação e comparação

O diagnóstico temporário /tmp/curso-568-aplicar-fk-loja.php foi enviado ao PHP
Docker pela entrada padrão, sem --env=testing. Conferiu loja/loja_migracoes,
REFERENCES efetivo 1 e GRANT explícito no objeto, loja/loja_app e default sqlsrv.
Guardou em memória as seis colunas existentes do produto e OBJECT_ID de produtos.

Depois, chamou migrate pelo kernel do Artisan com as opções equivalentes a:

```bash
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv_migracoes \
  --path=database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php \
  --no-interaction --no-ansi
```

Database escolhe a conexão de migrations para loja; path restringe ao arquivo,
relativo a /app; opções finais dispensam perguntas/cores. Não houve recriação,
seeder ou execução de outros arquivos. Código 0, DONE; status [3] Ran.

## Resultados

- Categoria_id BIGINT, anulável e sem IDENTITY.
- FK produtos_categoria_id_foreign aponta a dbo.categorias.id, habilitada e
  validada, ações DELETE/UPDATE NO_ACTION.
- Id/nome/preço/status/created_at/updated_at do produto ficaram exatamente iguais
  à cópia anterior. A nova coluna categoria_id foi lida como NULL por loja_app.
- OBJECT_ID da tabela produtos e conexão padrão sqlsrv preservados.
- Loja com zero categorias, um produto e três migrations nos lotes 1/2/3.

Consulta separada em loja_test conferiu a estrutura da FK e contagens zero
categorias/zero produtos/três migrations, código 0. Não repetimos a suíte após
alteração apenas em loja e verificação dirigida de preservação; último resultado
6 testes/14 asserções é da 5.67.

Migration e models não foram alterados. Git diff --check passou; segredos locais
continuam ignorados e fora do índice. A coluna/FK no banco não cria os métodos
de relacionamento do Eloquent automaticamente.

## Continuidade

Entendimento da 5.68 confirmado. Publicar o checkpoint
e iniciar 5.69: adicionar categoria_id ao Fillable de Produto e método categoria()
com belongsTo, conferindo configuração sem gravar dados nem criar relação inversa ainda.
