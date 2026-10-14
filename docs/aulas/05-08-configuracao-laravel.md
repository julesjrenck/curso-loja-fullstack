# Aula 5.8 — Configuração Laravel

## Objetivo

Preparar os valores que o Laravel usará para acessar SQL Server. A primeira
consulta será na 5.9, após entendimento desta configuração. A conta loja_app
da 5.7 foi confirmada e publicada em 063e4eb, conferido na main remota.

## Modelo público e ambiente privado

backend/.env.example é um modelo versionado, sem senha. O ambiente executado
pelo Laravel é backend/.env, ignorado pelo Git. O trecho de banco ficou:

```dotenv
DB_CONNECTION=sqlsrv
DB_HOST=sqlserver
DB_PORT=1433
DB_DATABASE=loja
DB_USERNAME=loja_app
DB_PASSWORD=
DB_ENCRYPT=yes
DB_TRUST_SERVER_CERTIFICATE=true
```

- DB_CONNECTION seleciona a configuração sqlsrv do Laravel.
- DB_HOST é o nome do serviço Docker: o backend encontra sqlserver na rede
  interna. No DBeaver do computador, o endereço é 127.0.0.1.
- DB_PORT é a porta SQL Server, 1433.
- DB_DATABASE escolhe loja, já criado na 5.5.
- DB_USERNAME autentica com loja_app, preparado na 5.7.
- DB_PASSWORD fica vazio no modelo. No .env privado, recebe a mesma senha
  que está em MSSQL_LOJA_PASSWORD no .env da raiz.
- DB_ENCRYPT=yes solicita criptografia da conexão.
- DB_TRUST_SERVER_CERTIFICATE=true aceita o certificado do servidor local.
  É a opção de laboratório explicada no acesso DBeaver; a configuração de
  certificado para produção terá sua própria etapa.

O .env da raiz e backend/.env têm funções diferentes: o primeiro atende à
preparação Docker/SQL; o segundo fornece a configuração da aplicação Laravel.
O nome DB_PASSWORD é o esperado pela configuração Laravel. As senhas não vão
no modelo, no código PHP ou no GitHub.

## Array PHP da conexão

backend/config/database.php retorna um array PHP. A conexão padrão agora usa:

```php
'default' => env('DB_CONNECTION', 'sqlsrv'),
```

env('nome', 'fallback') lê o valor de ambiente e usa o segundo argumento
quando a variável não está definida. DB_CONNECTION seleciona o grupo sqlsrv
dentro de connections. Nesse grupo, host, port, database, username e password
já leem as respectivas variáveis. Ativamos as opções que estavam comentadas:

```php
'encrypt' => env('DB_ENCRYPT', 'yes'),
'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
```

Assim o caminho é backend/.env → config/database.php → configuração da
conexão sqlsrv → driver PHP/ODBC. O Laravel interpreta true do ambiente como
booleano. Seu conector traduz essas opções para Encrypt e TrustServerCertificate.
Definir os valores ainda não executa uma consulta. Os outros grupos de conexão
foram preservados; testes de integração terão banco SQL Server exclusivo.

## Preparação local executada

A cópia foi feita por um processo PHP temporário em Docker, com este formato:

```bash
docker compose run --rm -T --no-deps \
  --volume "$PWD/.env:/config/curso.env:ro" \
  --volume "$PWD/backend/.env:/app/.env:rw" \
  backend php <<'PHP'
<?php
// Processo descrito abaixo: leitura, comparação, cópia e preservação.
PHP
```

Este bloco mostra a estrutura do comando, não reproduz sozinho a cópia.
run cria container temporário; --rm o remove; -T desliga terminal interativo;
--no-deps evita iniciar dependências. A primeira montagem dá acesso somente
de leitura ao .env da raiz. A segunda permite gravar apenas o .env do backend
dentro do código normalmente montado como somente leitura. php lê o programa
da entrada padrão; o heredoc com delimitador entre aspas impede expansão do shell.

O programa executado carregou o autoload e usou Dotenv::parse nos dois arquivos.
Conferiu a presença/formato de MSSQL_LOJA_PASSWORD e a ausência de DB_URL ou
valores DB conflitantes; substituiu/acrescentou apenas as oito variáveis acima,
copiando a senha em memória. Antes de gravar, comparou todas as variáveis fora
desse conjunto e APP_KEY, preservando-as. Aplicou permissão 600. Não imprimiu
senhas. Nenhuma credencial SQL ou chave nova foi gerada nesta etapa.

Em outro ambiente, após preparar Laravel e conta da 5.7, preencha somente essas
oito variáveis no backend/.env local e copie MSSQL_LOJA_PASSWORD para DB_PASSWORD.
Preserve APP_KEY e as demais configurações; nunca coloque a senha no modelo.

## Verificações e alcance

```bash
docker compose exec -T backend php -l /app/config/database.php
```

php -l verifica a sintaxe sem executar a configuração; passou. Um diagnóstico
temporário PHP em Docker inicializou Laravel e leu config('database.default')
e config('database.connections.sqlsrv'). Retornou os valores esperados e
comparou a senha em memória sem exibi-la. Configuração sem cache, APP_KEY e
demais variáveis preservadas; .env local com permissão 600, dono 1000:1000.

getConnections() retornou lista vazia: o diagnóstico não solicitou conexão
SQL. Portanto esta verificação demonstra carregamento da configuração; a
consulta real com o driver será na 5.9. GET /loja continuou com HTTP 200,
três produtos demonstrativos, título e cabeçalho X-Curso preservados.
git diff --check passou e ambos os .env continuam ignorados.

## Continuidade

Implementação e explicação apresentadas. Entendimento da 5.8 confirmado com
"entendi" em 14/10/2026. Checkpoint publicado e conferido em e0e06ef:
HEAD, origin/main e main remota retornaram e0e06ef063ec245739e18f684336d218751687e9.
Registro no checkpoint seguinte. Próximo passo realizado na 5.9: primeira
consulta diagnóstica pelo Laravel e introdução à DB facade.
Tabelas, migrations e catálogo persistido serão introduzidos depois.

Fontes consultadas em 13/10/2026:

- [Configuração de banco Laravel 13](https://laravel.com/docs/13.x/database#configuration).
- [Opções de conexão do driver PHP Microsoft](https://learn.microsoft.com/en-us/sql/connect/php/connection-options?view=sql-server-ver16).
