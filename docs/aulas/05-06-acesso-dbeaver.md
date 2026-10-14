# Aula 5.6 — Acesso local pelo DBeaver

## Objetivo

Publicar a porta do SQL Server no computador e informar a configuração de
conexão do DBeaver, conforme o pedido do aluno para avisar quando fosse possível.

Etapa 5.5 confirmada com "entendi" em 13/10/2026. Checkpoint fc2cdbc publicado;
HEAD, origin/main e consulta direta à main remota retornaram
`fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.

## Alteração no Compose

Acrescentado somente ao serviço sqlserver:

```yaml
ports:
  - "127.0.0.1:1433:1433"
```

É o mesmo formato já estudado nas portas HTTP. 127.0.0.1 indica o endereço
local do computador. O primeiro 1433 é a porta publicada no host; o segundo
1433 é a porta do serviço dentro do container. O cliente se conecta à porta
publicada e o Docker encaminha a conexão ao servidor.

| Local do cliente | Endereço usado |
| --- | --- |
| Backend na rede Compose | sqlserver:1433 |
| DBeaver no computador | 127.0.0.1:1433 |

O endereço depende de onde o cliente executa. O DBeaver é um cliente gráfico
que envia consultas e apresenta resultados do SQL Server; os arquivos dos bancos
continuam no volume dados-sqlserver. Publicar a porta não cria bancos ou tabelas.

Foi identificada execução Linux em WSL2. A documentação Microsoft descreve
acesso por localhost do Windows aos serviços Linux no WSL. O endpoint local
foi testado no host Docker; depois o aluno confirmou execução da consulta
na interface do DBeaver ao relatar "apareceu loja".

## Aplicação e verificação

Antes da alteração, ss -ltn confirmou porta 1433 livre. Executados:

```bash
docker compose config --quiet
docker compose up -d --no-deps sqlserver
docker compose port sqlserver 1433
docker compose ps
```

config validou; up recriou somente sqlserver para aplicar a publicação;
port retornou 127.0.0.1:1433; ps mostrou o mapeamento
127.0.0.1:1433->1433/tcp. A recriação manteve o mesmo volume.

Usamos um container temporário somente como cliente, com rede do host e
sqlcmd da imagem SQL Server já disponível. A configuração local foi fornecida
por --env-file .env; o comando do cliente utilizou SQLCMDPASSWORD sem imprimir
valor ou colocar a senha em argumento. O entrypoint foi substituído por sh
para executar apenas o cliente, sem iniciar outro servidor.

Conexão autenticada com -S 127.0.0.1,1433 e -d loja passou. DB_NAME() retornou
loja e a consulta constante retornou 1. Consulta sys.databases confirmou:
loja ID 5 ONLINE e loja_test ID 6 ONLINE, preservados após a recriação.
Inspect confirmou HostIp=127.0.0.1, HostPort=1433 e o mesmo volume montado;
ss confirmou escuta em 127.0.0.1:1433. Código/SQL/receitas PHP preservados,
root .env e backend/.env continuam ignorados.

Isso verifica publicação da porta e acesso SQL autenticado pelo endpoint.
A conexão DBeaver foi confirmada posteriormente por relato do aluno:
"apareceu loja", após SELECT DB_NAME(). Integração Laravel ainda pendente.

## Configuração do DBeaver

Abra uma nova conexão e escolha Microsoft SQL Server. Preencha:

| Campo | Valor |
| --- | --- |
| Host/servidor | 127.0.0.1 |
| Porta | 1433 |
| Banco/database | loja |
| Autenticação | SQL Server, com usuário e senha |
| Usuário | sa |
| Senha | Valor de MSSQL_SA_PASSWORD no .env local da raiz |

Copie somente o valor da senha para o campo do cliente. O valor não deve ser
copiado para o material do curso ou para o repositório.

Para a conexão local com certificado do próprio servidor, marque Trust Server
Certificate/Confiar no certificado do servidor. Se a versão do cliente expuser
as opções como propriedades do driver, utilize:

```text
encrypt=true
trustServerCertificate=true
```

encrypt mantém a conexão criptografada. trustServerCertificate aceita o
certificado local sem validar sua cadeia; corresponde ao uso de -C nos
diagnósticos sqlcmd. A documentação Microsoft descreve esse uso em ambientes
de teste com certificado autoassinado. Nomes das opções podem variar por versão.

Clique em Testar conexão/Test Connection. Se o DBeaver solicitar o download
do driver JDBC Microsoft, faça a instalação oferecida pelo cliente.
Depois da conexão, pode executar como experiência de leitura:

```sql
SELECT DB_NAME() AS BancoAtual;
```

Resultado esperado: loja. As tabelas da aplicação ainda serão introduzidas
nas etapas de modelagem/migrations; banco criado pode estar sem essas tabelas.

## Situação e próximo passo

Aviso solicitado cumprido: endpoint local disponível e dados de conexão apresentados.
Explicação apresentada; resultado DBeaver confirmado pelo aluno com "apareceu loja".
Entendimento da 5.6 confirmado depois com "entendi" em 13/10/2026.
Resultado de acesso e entendimento registrados separadamente.
Checkpoint preparado para publicação autorizada.
Último checkpoint publicado: fc2cdbc.

Após confirmação: publicar 5.6 e iniciar 5.7, preparar login/usuário próprios
da aplicação no banco loja e credencial local ignorada, antes da conexão Laravel.
Banco de testes e configuração de integração terão preparação própria.

Fontes consultadas em 13/10/2026:

- [Portas publicadas no Docker](https://docs.docker.com/engine/network/port-publishing/).
- [SQL Server no DBeaver](https://dbeaver.com/docs/dbeaver/Database-driver-Microsoft-SQL-Server/).
- [Certificado e criptografia no JDBC Microsoft](https://learn.microsoft.com/en-us/sql/connect/jdbc/connecting-with-ssl-encryption?view=sql-server-ver16).
- [Rede local Windows/WSL](https://learn.microsoft.com/en-us/windows/wsl/networking).
