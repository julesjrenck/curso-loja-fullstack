# Aula 5.4 — Serviço SQL Server no Docker

## Objetivo

Introduzir SQL Server 2022 Developer como serviço separado do backend,
com imagem identificável, configuração local e volume de dados.
As extensões PHP e o esclarecimento PIE da 5.3 foram confirmados com "entendi"
em 13/10/2026. Checkpoint 5ba53e2 publicado: HEAD, origin/main e consulta direta
à main remota retornaram `5ba53e2f6d6fda3b962909b2d3e2eb9c919eb6b8`.

SQL Server é o servidor que mantém e consulta os bancos. Dentro dele podemos
ter mais de um banco: a loja e os testes terão bancos exclusivos nas etapas
próprias. O backend executa PHP/Laravel e conversa com esse outro serviço pela
rede Docker. O endereço interno será sqlserver:1433.

## Compose e configuração

Acrescentado a compose.yaml o serviço sqlserver:

```yaml
sqlserver:
  image: mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04@sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718
  environment:
    ACCEPT_EULA: "Y"
    MSSQL_PID: "Developer"
    MSSQL_SA_PASSWORD: "${MSSQL_SA_PASSWORD:?Preencha MSSQL_SA_PASSWORD no .env local}"
    MSSQL_MEMORY_LIMIT_MB: "2048"
  mem_limit: 3g
  volumes:
    - dados-sqlserver:/var/opt/mssql
```

image utiliza a imagem pronta Microsoft, em vez de construir outro Dockerfile.
A tag informa SQL Server 2022, atualização CU27/GDR1 e Ubuntu 22.04.
CU é uma atualização cumulativa; GDR identifica uma atualização de manutenção.
O digest SHA-256 fixa o conteúdo escolhido mesmo se uma tag for alterada.
Tag e digest foram conferidos no registro oficial antes de baixar a imagem.

ACCEPT_EULA aceita a licença da imagem. MSSQL_PID escolhe a edição Developer
para desenvolvimento e testes. MSSQL_SA_PASSWORD define a senha do login
administrativo sa durante a primeira preparação do servidor.

${MSSQL_SA_PASSWORD:?...} é interpolado pelo Compose a partir da configuração
local. O :? faz falhar a configuração se o campo estiver ausente ou vazio,
exibindo a mensagem indicada. Por isso a configuração local deve ser preparada
antes de qualquer comando Compose em um novo clone.

MSSQL_MEMORY_LIMIT_MB configura 2048 MB para os componentes SQL Server;
mem_limit limita o container a 3 GiB, deixando margem para outros processos.
Os limites foram escolhidos para o laboratório com cerca de 7,63 GiB de RAM
total e 5,07 GiB disponíveis no diagnóstico desta etapa. Disponibilidade varia.

O volume nomeado dados-sqlserver está declarado também no bloco volumes
da raiz. Ele é montado em /var/opt/mssql, onde ficam arquivos do servidor.
O volume guarda dados além da duração de um container. Usaremos o mesmo
volume ao recriar o serviço. Volume persistente e backup têm funções distintas.

O servidor fica na rede interna do Compose, porta 1433. O backend usará
o nome do serviço sqlserver como endereço. Dentro do backend, localhost
continua apontando para o próprio backend.

## Modelo público e configuração local

Acrescentado ao .env.example da raiz somente o nome do campo, vazio:

```dotenv
MSSQL_SA_PASSWORD=
```

Na sessão, PHP em Docker gerou uma senha aleatória, com random_bytes,
e a salvou no .env local. Configurações já existentes foram preservadas.
Senha não exibida; formato e permissões 600 conferidos. O arquivo continua
ignorado pelo Git. backend/.env mantém a configuração Laravel separada;
a conexão da aplicação será preparada depois.

Para preparar outro clone, copie o modelo preservando um arquivo existente:

```bash
cp --update=none .env.example .env
```

Depois execute o comando abaixo. Ele usa PHP em Docker e independe da
interpolação do Compose, que já exige a senha:

```bash
docker run --rm -i --volume "$PWD/.env:/config/.env:rw" php:8.4.26-cli-bookworm php <<'PHP'
<?php
$caminho = '/config/.env';
$conteudo = file_get_contents($caminho);
$existe = preg_match('/^MSSQL_SA_PASSWORD=(.*)$/m', $conteudo, $campo);
$vazio = !$existe || in_array(trim($campo[1]), ['', '""', "''"], true);
if ($vazio) {
    $linha = 'MSSQL_SA_PASSWORD=Aa1!'.bin2hex(random_bytes(24));
    $novo = $existe
        ? preg_replace('/^MSSQL_SA_PASSWORD=.*$/m', $linha, $conteudo, 1)
        : rtrim($conteudo, "\r\n")."\n".$linha."\n";
    if (file_put_contents($caminho, $novo) === false) {throw new RuntimeException('Falha ao salvar configuração local.');}
    echo "Senha SQL Server criada somente no .env local.\n";
} else {
    echo "Senha SQL Server existente preservada.\n";
}
if (!chmod($caminho, 0600)) {throw new RuntimeException('Falha ao restringir permissões.');}
PHP
```

random_bytes gera 24 bytes aleatórios; bin2hex transforma-os em texto.
Aa1! garante os quatro grupos de caracteres da política SQL Server.
O código preenche somente um campo vazio ou ausente e preserva o restante
do arquivo. Esse comando foi conferido na configuração desta sessão: senha
existente preservada. Uma senha preenchida deve atender à política Microsoft.

## Comandos de preparação

```bash
docker compose config --quiet
docker compose pull sqlserver
docker compose up -d --no-deps sqlserver
docker compose ps
```

config --quiet valida sem imprimir a configuração resolvida e a senha.
pull baixa a imagem; up cria/inicia o serviço e monta o volume; -d mantém
em segundo plano; --no-deps limita a operação ao serviço solicitado.

## Verificação e continuidade

Dados de acesso esclarecidos a pedido do aluno: servidor sqlserver, porta 1433
na rede Docker, login sa, senha em MSSQL_SA_PASSWORD no .env local da raiz.
master está disponível como banco inicial; loja e loja_test ainda serão criados.
O Compose atual não publica porta SQL no host. Um cliente no computador
precisará dessa configuração antes de usar localhost; nenhuma porta foi
publicada automaticamente neste esclarecimento. Entendimento confirmado com "entendi"
em 13/10/2026. Aluno pediu aviso quando puder conectar pelo DBeaver e autorizou
seguir o curso; o aviso permanece pendente para a etapa de acesso host.

Imagem baixada e serviço iniciado. docker inspect confirmou Linux/amd64,
digest escolhido, limite de 3.221.225.472 bytes e volume
curso-loja-fullstack_dados-sqlserver montado gravável em /var/opt/mssql.

Para consultar o servidor, executamos sqlcmd, ferramenta incluída na imagem:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -l 5 -b -W' <<'SQL'
SET NOCOUNT ON;
SELECT 1 AS ServidorRespondeu;
SELECT CONVERT(varchar(30), SERVERPROPERTY('ProductVersion')) AS Versao,
       CONVERT(varchar(50), SERVERPROPERTY('Edition')) AS Edicao;
SELECT COUNT(*) AS BancosDaAplicacao FROM sys.databases WHERE database_id > 4;
GO
SQL
```

exec -T executa no serviço ativo. sh -c prepara SQLCMDPASSWORD a partir da
variável já existente dentro do container; a senha não é passada como argumento
de linha de comando nem impressa. -S localhost indica esse mesmo container;
-U sa seleciona o login administrativo; -C aceita o certificado do servidor
local, sem validar sua cadeia; -l 5 limita a espera de login; -b retorna falha
se houver erro SQL; -W remove espaços finais da saída. O heredoc fornece SQL
pela entrada padrão, sem expandir variáveis do host.

SELECT 1 é uma consulta constante para verificar resposta. AS dá nome à coluna.
SERVERPROPERTY informa metadados do servidor; CONVERT formata-os como texto.
sys.databases é uma visão de metadados; database_id > 4 seleciona bancos além
dos quatro bancos de sistema. COUNT(*) conta-os; SET NOCOUNT ON reduz mensagens
de contagem de linhas. GO finaliza o lote para o sqlcmd.

| Verificação | Resultado |
| --- | --- |
| Consulta constante | ServidorRespondeu = 1. |
| Versão | 16.0.4305.5. |
| Edição | Developer Edition (64-bit). |
| Bancos da aplicação | 0; somente bancos de sistema inicializados pelo servidor. |
| Rede pelo backend | Nome sqlserver resolvido e porta 1433 acessível. |
| HTTP existente | /loja e laboratório responderam 200. |

Essas consultas são de diagnóstico e somente leitura. A inicialização do motor
preparou seus bancos de sistema; não criamos bancos da loja ou de integração.
Inspeção confirmou a montagem persistente; não fizemos teste novo de remoção/
recriação de dados nesta etapa. Os conceitos de volume já foram verificados no módulo 2.

Root .env e backend/.env continuam ignorados. O modelo público vazio foi usado
em uma validação isolada e o Compose recusou a configuração com a mensagem
prevista. A configuração real passou. Código Laravel/laboratório e imagens
PHP preservados; os serviços continuaram ativos.

Explicação apresentada; entendimento da 5.4 e esclarecimentos de acesso confirmados
com "entendi" em 13/10/2026. Checkpoint d9fba40 publicado conforme autorização.
HEAD, origin/main e consulta direta à main remota retornaram
`d9fba40e398512cb63385e970e8578ffe90441d2`.
Após confirmação: publicar 5.4 e iniciar 5.5, criar explicitamente os bancos
loja e loja_test via SQL em Docker, estudar servidor/banco e CREATE DATABASE.
Conexão Laravel terá sua etapa própria; integração usará exclusivamente loja_test.

Fontes consultadas em 13/10/2026:

- [Imagem SQL Server no Docker](https://learn.microsoft.com/en-us/sql/linux/install-upgrade/quickstart-install-docker?view=sql-server-ver16).
- [Registro Microsoft e tags da imagem](https://mcr.microsoft.com/v2/mssql/server/tags/list).
- [Volume SQL Server](https://learn.microsoft.com/en-us/sql/linux/containers/configure?view=sql-server-ver16#use-a-named-data-volume).
- [Memória SQL Server e container](https://learn.microsoft.com/en-us/sql/linux/configure/performance-best-practices-sql-server-memory?view=sql-server-ver17).
- [sqlcmd e opções](https://learn.microsoft.com/en-us/sql/tools/sqlcmd/sqlcmd-utility?view=sql-server-ver16).
