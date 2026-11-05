# Aula 7.72 — Teste real da migration de administrador

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.71](07-71-migration-indicador-administrador.md) com "entendi".
Checkpoint anterior publicado e conferido em
2cccf866096d041defd47f98fcc664277a4df954; HEAD/origin/main/main remota iguais.
Entendimento da 7.72 confirmado com "entendu" em 05/11/2026; publicação
conferida em 5061427387d61506a462c5a4e18715cc80405054, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação. Banco normal loja não usado pelo
assistente na 7.72.

## Objetivo e arquivo

Criamos somente
[UsuarioAdministradorMigrationTest.php](../../backend/tests/Feature/UsuarioAdministradorMigrationTest.php)
na aplicação. É um teste de integração: executa a
[migration real](../../backend/database/migrations/2026_11_05_120000_add_is_admin_to_users_table.php)
no SQL Server exclusivo de testes. A migration permaneceu igual à 7.71.

Na etapa anterior verificamos compilação sem conexão PDO. Agora verificamos
que o servidor aceita a alteração e atribui o padrão a registros de verdade.

## Isolamento e preparação

A classe estende Tests\TestCase, que inicializa o Laravel, e usa
DatabaseTransactions para iniciar uma transação e desfazê-la ao final.
Não usamos RefreshDatabase, migrate:fresh ou remoção geral de tabelas.

Antes de alterar dados ou estrutura, o teste exige ambiente testing, driver
sqlsrv, banco configurado loja_test e identidade real banco loja_test/login
e usuário loja_testes. Confere também que users começa vazia e guarda a
contagem inicial de migrations. Esses requisitos impedem que o cenário
avance no banco normal ou sobre usuários já persistidos no banco de teste.

O arquivo da migration é carregado por require database_path(...). Se a
coluna já existir em um banco de testes preparado futuramente, o teste chama
down dentro da transação para começar com a estrutura anterior. Esse ramo
não foi exercitado hoje: a conferência inicial confirmou a coluna ausente.

## Conta anterior, conta nova e padrão do banco

Primeiro, User::query()->create cria a conta fictícia anterior à alteração,
com nome/e-mail de exemplo e senha exclusiva do cenário. O cast hashed já
existente gera seu hash. Nenhuma senha real de laboratório é utilizada.

Depois, migration->up executa a adição de is_admin de verdade. Conferimos a
presença da coluna e seus metadados em sys.columns/sys.types e
sys.default_constraints: tipo bit, NOT NULL e padrão zero.

Uma consulta exige que o usuário anterior tenha is_admin false. Em seguida,
criamos outro usuário omitindo is_admin e exigimos false também para ele.
Assim cobrimos preenchimento da linha existente e padrão da nova inserção.
Lemos o banco diretamente para verificar o valor persistido; não dependemos
de um atributo em memória do model, que ainda não ganhou cast boolean.

## Reversão real e limpeza

Migration->down executa a remoção da restrição do padrão e da coluna no SQL
Server. O teste exige ausência da coluna, dois usuários presentes e os nomes/
e-mails fictícios preservados nos mesmos IDs. A contagem de migrations deve
continuar igual: chamar up/down diretamente não registra uma execução pelo
migrator Artisan.

Ao final, DatabaseTransactions desfaz os usuários fictícios. O down faz parte
do comportamento testado; a transação cuida do isolamento do cenário.
Nenhum usuário foi promovido e nenhum login foi executado.

## Comandos e resultados

```sh
docker compose exec -T backend php -l /app/tests/Feature/UsuarioAdministradorMigrationTest.php
docker compose exec -T backend php artisan test --compact tests/Feature/UsuarioAdministradorMigrationTest.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec usa o container backend; -T dispensa terminal interativo; php -l confere
sintaxe. Artisan test executa o PHPUnit com o ambiente de testes já configurado
em phpunit.xml/.env.testing. O caminho restringe ao novo arquivo; sem caminho,
executa a suíte. Compact reduz a saída. Do-not-cache-result evita gravar o
cache de resultado e colors=never remove cores.

Sintaxe passou. Teste focado: 1 teste/20 asserções, código 0. Essa primeira
execução exibiu aviso de cache em /app/.phpunit.result.cache, pois o código
está montado como leitura. Na suíte, o cache foi desativado pelo argumento:
108 testes/1.606 asserções passaram, código 0, sem esse aviso.

Diagnósticos pela entrada padrão do PHP/Docker, com APP_ENV testing e guardas
de configuração/identidade, fizeram apenas leituras antes e depois. Antes:
loja_test/loja_testes, zero users, coluna ausente e quatro migrations. Depois
da suíte: mesma identidade, zero users, coluna ausente e quatro migrations.
Saída somente booleanos/contagens, sem senhas/hashes/IDs ou dados privados.
Os diagnósticos não foram persistidos como arquivos.

Isso comprova padrão e reversão reais no banco de testes e limpeza dos dados
fictícios. Não aplica a migration persistentemente nem a registra no histórico.
Não verifica permissões da conexão de migrations do banco normal, cast futuro,
Gate/Policy ou acesso administrativo da API. Referência de contexto:
[testes de banco no Laravel](https://laravel.com/docs/13.x/database-testing).

## Continuidade

Entendimento confirmado com "entendu" em 05/11/2026. Continuidade iniciada na
[7.73](07-73-aplicar-migration-administrador-loja.md): aplicar somente a
migration is_admin em loja pela conexão sqlsrv_migracoes, com conferências
antes/depois de estrutura e valores sem expor contas ou promover usuários.
Model/cast/Fillable, rotas, contratos e dependências mantidos nesta etapa.
Módulos 8 a 23 não iniciados.
