# Aula 5.35 — Aplicação da conta exclusiva de testes

## Objetivo e estado

Aplicar docker/sqlserver/criar-usuario-testes.sql, compreendido na 5.34, e
verificar a autenticação e as permissões de loja_testes no banco loja_test.
Realizada em 19/10/2026. Implementação e verificações concluídas; explicação
apresentada e entendimento confirmado com "entendi" em 19/10/2026.

A 5.34 foi confirmada com "entendi" e publicada em 49a22c5.
HEAD, origin/main e consulta direta à main remota retornaram
49a22c5e54064d0e7acd340c9814cb521fafc7fa após o push.

## Arquivos e preparação

.env.example da raiz recebeu um campo público vazio:

```dotenv
# Senha do login loja_testes em loja_test; preencha apenas no .env local ignorado.
MSSQL_TESTS_PASSWORD=
```

O .env da raiz recebeu o valor real, gerado em PHP 8.4 Docker por:

```php
$senha = 'Aa1!' . bin2hex(random_bytes(24));
```

random_bytes gera 24 bytes aleatórios e bin2hex os representa em 48 caracteres
hexadecimais. O prefixo fornece letras maiúscula/minúscula, número e símbolo
para a política de senha. A rotina temporária preencheu apenas o campo
ausente/vazio, verificou a preservação das demais linhas e manteve permissão
600, dono 1000:1000. Nenhum valor foi impresso ou incluído nos arquivos públicos.
A rotina permanece fora do repositório; backend/.env foi preservado.

O script SQL da 5.34 foi reutilizado sem alterações. Ele recebe a senha por
variável sqlcmd, cria o login no servidor e o usuário em loja_test, adiciona
os papéis de leitura/escrita e concede CREATE TABLE e ALTER no esquema dbo.
ALTER inclui modificar/remover objetos desse esquema inteiro em loja_test.

## Execução

Foi solicitado início apenas do serviço SQL Server:

```bash
docker compose up -d --no-build --pull never sqlserver
```

-d mantém o serviço em segundo plano. --no-build e --pull never usam a imagem
local já fixada. A conferência final encontrou também backend e php ativos;
esta etapa não executou comando de início desses servidores. Os clientes
temporários foram removidos. O volume existente preservou os bancos. Consultas anteriores
à aplicação confirmaram loja/loja_test ONLINE, ausência do login/usuário,
zero tabelas em loja_test e um produto em loja.

A aplicação usou a mesma imagem SQL Server como cliente temporário:

```bash
docker run --rm -i --network host --env-file .env --entrypoint sh \
  mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04@sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718 \
  -c 'case "${MSSQL_TESTS_PASSWORD:-}" in ""|*[!A-Za-z0-9!]* ) echo "Formato da senha local inválido; execução interrompida." >&2; exit 1;; esac; export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S 127.0.0.1,1433 -U sa -C -l 5 -b' \
  < docker/sqlserver/criar-usuario-testes.sql
```

--rm remove o cliente ao terminar; -i permite receber o arquivo pela entrada
padrão; --network host permite alcançar a porta local do servidor neste Linux.
--entrypoint sh executa o cliente no lugar do processo padrão da imagem.
--env-file fornece as variáveis locais sem colocar senhas no texto do comando.
O case aceita apenas o formato usado na geração antes de substituir o marcador
dentro do literal SQL. Não é um sanitizador geral de SQL.

SQLCMDPASSWORD recebe a senha administrativa para autenticar sa; a variável
MSSQL_TESTS_PASSWORD fornece a senha a definir no novo login. São funções
diferentes. -S indica servidor/porta, -U indica login, -C confia no certificado
local, -l 5 limita o tempo de login e -b retorna falha se houver erro SQL.
O redirecionamento < envia o arquivo ao sqlcmd, que processa GO e
:ON ERROR EXIT. O comando terminou com código 0.

## Verificações e interpretação

Consultas administrativas confirmaram login habilitado, política ativa,
banco padrão loja_test e usuário SQL associado, com esquema padrão dbo.

Um novo cliente recebeu a senha de testes em SQLCMDPASSWORD e conectou como
loja_testes, solicitando loja_test. Retornou:

| Verificação | Resultado |
| --- | --- |
| DB_NAME / SUSER_SNAME / USER_NAME | loja_test / loja_testes / loja_testes |
| db_datareader / db_datawriter | 1 / 1 |
| CREATE TABLE / ALTER dbo | 1 / 1 |
| db_owner / sysadmin | 0 / 0 |
| HAS_DBACCESS loja / CREATE ANY DATABASE | 0 / 0 |
| Tabelas de usuário em loja_test | 0 |

As consultas de permissões usaram IS_ROLEMEMBER, IS_SRVROLEMEMBER e
HAS_PERMS_BY_NAME. Esses resultados conferem permissões efetivas; não são uma
execução de migrations ou prova de uma suíte de integração.

A tentativa de conexão dessa conta solicitando loja falhou com
Cannot open database "loja" requested by the login, resultado esperado.
Consulta administrativa confirmou zero usuários loja_testes em loja e o
produto existente preservado. Nenhuma operação de escrita de dados foi feita.

O mesmo script foi reaplicado com código 0. Nova autenticação com a mesma senha
repetiu todos os resultados, ainda com zero tabelas. As condições evitam recriar
login/usuário/papéis e os GRANT reaplicam as mesmas concessões. O script não
redefine senha existente nem remove eventuais privilégios concedidos por outros meios.

git check-ignore confirmou .env e backend/.env ignorados. Modelo público
contém campo vazio; git diff --check passou. Configuração Laravel, phpunit.xml,
dependências, Compose, migrations e seeders preservados. Nenhuma suíte executada.

## Continuidade

Entendimento da 5.35 confirmado com "entendi" em 19/10/2026. Publicar seu
checkpoint e iniciar a 5.36, pelo modelo de ambiente de testes
do Laravel. Conta já disponível; configuração Laravel e estrutura de testes
continuam pendentes. Não executar testes com a configuração SQLite atual.
