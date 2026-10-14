# Aula 5.14 — Conexão Laravel para migrations

## Objetivo

Configurar o Laravel para selecionar a conta loja_migracoes quando precisarmos
executar migrations. A 5.13 foi confirmada com "entendi" e publicada em
94e3322, SHA completo 94e3322369b13dcf3bf6201c90899e2f99b5893a,
conferido na main remota. Nenhuma migration será aplicada nesta etapa.

## Duas configurações de conexão

backend/config/database.php ganhou um grupo dentro de connections:

```php
'sqlsrv_migracoes' => [
    'driver' => 'sqlsrv',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '1433'),
    'database' => env('DB_DATABASE', 'loja'),
    'username' => env('DB_MIGRATIONS_USERNAME', 'loja_migracoes'),
    'password' => env('DB_MIGRATIONS_PASSWORD', ''),
    'charset' => env('DB_CHARSET', 'utf8'),
    'prefix' => '',
    'prefix_indexes' => true,
    'encrypt' => env('DB_ENCRYPT', 'yes'),
    'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
],
```

sqlsrv_migracoes é o nome que escolhemos para essa configuração. driver sqlsrv
seleciona o driver SQL Server. Os nomes têm funções distintas; configurar uma
nova conexão não cria outro servidor, banco ou login.

Host, porta, banco, charset, prefixos e opções de certificado usam a mesma
configuração local já estudada. Username e password têm variáveis próprias.
A nova conexão não lê DB_URL, para que uma URL da conexão da aplicação não
substitua suas credenciais. A conexão sqlsrv original e o default foram preservados.

| Configuração Laravel | Banco | Login | Seleção |
| --- | --- | --- | --- |
| sqlsrv | loja | loja_app | Padrão da aplicação |
| sqlsrv_migracoes | loja | loja_migracoes | Explicitamente pelo nome |

## Modelo público e senha local

backend/.env.example ganhou:

```dotenv
DB_MIGRATIONS_USERNAME=loja_migracoes
DB_MIGRATIONS_PASSWORD=
```

DB_CONNECTION continua sqlsrv. No backend/.env privado, DB_MIGRATIONS_PASSWORD
recebeu a senha de MSSQL_MIGRATIONS_PASSWORD do .env da raiz, gerada na 5.13.
O modelo público continua com senha vazia. Não houve geração de nova senha.

PHP em Docker fez a cópia com Dotenv::parse e comparação em memória, sem
imprimir credenciais. O container temporário tinha root .env montado apenas
para leitura em /config/curso.env e backend/.env para escrita em /app/.env.
O processo conferiu campos preexistentes para não sobrescrever valores divergentes,
comparou todas as variáveis fora desses dois campos e APP_KEY antes de gravar,
e aplicou modo 600. Demais credenciais e configurações foram preservadas.

Em outro clone, após preparar a conta SQL, preencha esses dois campos no
backend/.env e copie a senha do campo local da raiz. Preserve DB_CONNECTION,
DB_USERNAME, DB_PASSWORD e APP_KEY existentes. Ambos os .env são ignorados.

## Escolher a conexão

Este exemplo foi usado no diagnóstico temporário:

```php
$resultado = DB::connection('sqlsrv_migracoes')->selectOne(
    'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login, USER_NAME() AS usuario'
);
```

connection('nome') procura a configuração com esse nome. Devolve o objeto
de conexão; ->selectOne executa a consulta nessa conexão. DB::selectOne(...)
usa a configuração padrão sqlsrv. Os dois consultam loja, mas autenticam com
contas de permissões diferentes. O servidor SQL valida as permissões do login.

O comando loja:verificar-banco da 5.9 continua usando a conexão padrão.
A opção --database do comando de aplicação de migrations será apresentada
na etapa 5.15 para escolher sqlsrv_migracoes explicitamente.

## Verificações em Docker

```bash
docker compose exec -T backend php -l /app/config/database.php
```

Sintaxe passou. Um diagnóstico temporário PHP inicializou Laravel, conferiu
default sqlsrv e ausência de cache de configuração, e comparou as senhas das
duas conexões com os respectivos campos do .env da raiz sem imprimir valores.
Depois executou SELECT real em cada conexão:

```text
sqlsrv: banco loja; login/usuário loja_app; CREATE TABLE/ALTER dbo 0/0.
sqlsrv_migracoes: banco loja; login/usuário loja_migracoes; CREATE TABLE/ALTER dbo 1/1.
```

Metadados confirmaram banco loja ainda com zero tabelas da aplicação. GET /loja
retornou 200 com título, três produtos e X-Curso preservados. git diff --check
passou; APP_KEY e variáveis anteriores preservadas; .env ignorados. Sem
alteração de migrations, dependências, permissões SQL, imagens ou serviços.

Configuração, explicação e verificações concluídas. Entendimento da 5.14
confirmado com "entendi" em 14/10/2026. Checkpoint publicado e conferido em
26e7b5b; HEAD, origin/main e main remota
retornaram 26e7b5b8a674e775b2e882ea4c78f62aeed9d945. Registro no checkpoint seguinte.
Próximo passo realizado na 5.15: aplicar
somente a migration de produtos usando a conexão de migrations e o caminho
específico do arquivo, explicar o registro migrations e conferir o esquema.
As migrations padrão de users/cache/jobs não serão aplicadas antecipadamente.

Fonte consultada em 14/10/2026:

- [Múltiplas conexões Laravel 13](https://laravel.com/docs/13.x/database#using-multiple-database-connections).
