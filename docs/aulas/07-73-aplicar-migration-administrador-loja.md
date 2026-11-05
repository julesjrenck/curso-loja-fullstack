# Aula 7.73 — Aplicar o indicador de administrador em loja

Aplicação, explicação e verificações em 05/11/2026, após confirmação da
[7.72](07-72-teste-migration-administrador.md) com "entendu".
Checkpoint anterior publicado e conferido em
5061427387d61506a462c5a4e18715cc80405054; HEAD/origin/main/main remota iguais.
Entendimento da 7.73 confirmado com "entendi" em 05/11/2026; publicação
conferida em 8a5356ad4e5041fa1594e451fc6d078f420c682f, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação. Migration aplicada persistentemente em loja.

## Objetivo e conexão

Aplicamos somente a
[migration de is_admin](../../backend/database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php)
no banco local normal loja. Seu arquivo permaneceu igual. A verificação em
loja_test na 7.72 usou up/down e transação; não alterou o banco normal nem
registrou a migration no histórico dele.

Usamos a conexão sqlsrv_migracoes existente em
[config/database.php](../../backend/config/database.php). Ela usa loja_migracoes,
com permissão de alteração de estrutura. A aplicação mantém sqlsrv/loja_app;
a opção do comando não muda permanentemente sua configuração ou credenciais.

## Antes de aplicar

Diagnóstico PHP no Docker, sem arquivo auxiliar persistido, conferiu ambiente
local/configuração sem cache/default sqlsrv e conexões sqlsrv para loja.
Identidade real por DB_NAME/SUSER_SNAME/USER_NAME e permissão ALTER de users:
loja_migracoes com permissão e loja_app sem permissão. Consultas protegidas
para aceitar somente SELECT; nenhuma senha, hash ou dado de conta exposto.

Resultado anterior: um usuário, quatro migrations registradas, último lote 4,
coluna is_admin ausente e arquivo ainda não registrado no histórico.

```sh
docker compose exec -T backend php artisan migrate:status --database=sqlsrv_migracoes --path=database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php --no-ansi
```

Migrate:status consulta o estado. Database escolhe a conexão dedicada; path
restringe a listagem ao arquivo. Resultado: Pending, código 0.

## Aplicação restrita

```sh
docker compose exec -T backend php artisan migrate \
  --database=sqlsrv_migracoes \
  --path=database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php \
  --no-interaction --no-ansi
```

Exec -T usa o backend ativo sem terminal interativo. PHP executa o Artisan;
migrate aplica migrations pendentes. Database escolhe sqlsrv_migracoes;
path limita a busca ao arquivo relativo à raiz /app. No-interaction dispensa
perguntas e no-ansi remove cores. Não usamos env testing, rollback ou seeders.

Resultado: add_is_admin_to_users_table DONE, código 0. O migrator executou
up e registrou a migration uma vez, no lote 5. A alteração ficou persistida
no SQL Server; não foi uma simulação ou transação de teste desfeita depois.
Referência: [execução de migrations](https://laravel.com/docs/13.x/migrations#running-migrations).

## Conferência posterior

Outro diagnóstico, somente SELECT, repetiu guardas de ambiente/destino/
identidade e conferiu os metadados em sys.columns/sys.types/default_constraints.
Oito controles passaram, código 0:

- Identidade e permissão corretas em sqlsrv_migracoes.
- Identidade e ausência de ALTER em sqlsrv/loja_app.
- Coluna bit, NOT NULL e padrão zero.
- Quantidade de usuários preservada: um.
- Todos os usuários existentes com is_admin false.
- Histórico passou de quatro para cinco entradas, com uma única entrada nova.
- Migration registrada no lote 5.
- Loja_app consegue ler a nova coluna e encontra o mesmo usuário sem privilégio.

As observações de usuários foram somente contagens e condição false; não
copiamos IDs, nomes, e-mails, senhas ou hashes. Não fizemos comparação integral
do conteúdo das demais colunas. Não houve cadastro, promoção de usuário ou login.

O mesmo migrate:status restrito retornou [5] Ran, código 0. O número 5 é o
lote da aplicação da migration; não é quantidade de usuários ou administradores.
Criar a coluna não concede permissão para ações da API: Gate/Policy continua
pendente e o cast boolean do User será tratado na próxima etapa.

## Arquivos, Git e continuidade

Nesta aula alteramos somente documentação: este roteiro, a continuidade da
7.72, docs/curso.md e docs/progresso.md. O Git registra o arquivo da migration
e os documentos. O estado aplicado reside no banco do volume Docker; fazer
git pull em outro ambiente não executa a migration automaticamente.

Model/casts/Fillable, teste, rotas, Resource, contratos, Compose e dependências
não foram alterados. Não repetimos a suíte que usa loja_test: a última é a da
7.72, 108 testes/1.606 asserções, não uma nova execução desta etapa. As
verificações atuais foram a aplicação restrita e as leituras reais em loja.
Nenhum pedido da API ou alteração em loja_test pelo assistente nesta aula.

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.74](07-74-cast-boolean-administrador.md): acrescentar somente
o cast boolean de is_admin ao User e verificar leitura em PHP, mantendo
Fillable e UsuarioResource. Módulos 8 a 23 não iniciados.
