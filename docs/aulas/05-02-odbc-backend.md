# Aula 5.2 — ODBC na imagem do backend

## Objetivo e conceito

Instalar Microsoft ODBC Driver 18 no ambiente do PHP que executa Laravel.
ODBC é uma biblioteca usada pelos drivers PHP para conversar com SQL Server.
Nesta etapa preparamos essa biblioteca; as extensões PHP terão a etapa 5.3.

A imagem é a receita executada durante o build. Um container já ativo continua
usando a imagem com que foi criado até ser recriado. Por isso construímos a nova
imagem e depois aplicamos essa imagem ao serviço backend.

Entendimento da preparação 5.1 confirmado com "entendi" em 13/10/2026.
Checkpoint 41d0660 publicado: HEAD, origin/main e consulta direta à main remota
retornaram `41d0660945bd3b91dc3a036017986e1adc6c2ff5`.

## Arquivos que trabalham juntos

### Dockerfile.backend

Nova receita do backend, separada do Dockerfile usado pelo laboratório PHP.

- FROM php:8.4.26-cli-bookworm usa PHP 8.4.26 com Debian 12.
- COPY --from=composer/composer:2.10.3-bin copia o executável Composer 2.10.3,
  como estudado na imagem do laboratório.
- curl -fsSL baixa packages-microsoft-prod.deb do endereço oficial para Debian 12.
  -f faz falhar em erros HTTP; -sS reduz saída e mantém erros; -L segue redirecionamentos;
  -o escolhe o arquivo temporário de destino.
- echo fornece SHA-256 esperado e caminho para sha256sum -c -, que lê pela
  entrada padrão e compara o arquivo. O hash foi obtido no diagnóstico desta aula.
  Se o conteúdo do instalador mudar, o build para e exige revisão.
- dpkg -i instala packages-microsoft-prod 1.1-debian12: configuração do
  repositório Microsoft e chave usada pelo APT na verificação dos pacotes.
  rm apaga o instalador temporário, mantendo a configuração instalada.
- apt-get update atualiza índices; install instala os pacotes solicitados
  e suas dependências. -y evita confirmação interativa e --no-install-recommends
  limita a instalação aos requisitos dos pacotes.
- ACCEPT_EULA=Y aceita os termos do pacote Microsoft nesse comando de instalação;
  não é credencial nem uma variável ENV permanente da imagem.
- unzip=6.0-28+deb12u1 preserva a ferramenta usada pelo Composer.
- libgssapi-krb5-2=1.20.1-2+deb12u5 fornece uma biblioteca exigida pelo ODBC;
  já estava presente na base e foi mantida na versão conferida.
- msodbcsql18=18.7.1.1-1 fixa a versão do driver Microsoft disponível no
  repositório Debian 12, conferida antes da alteração.
- rm -rf /var/lib/apt/lists/* remove os índices usados na instalação.
- WORKDIR /app define o diretório dos comandos. CMD executa php artisan --version
  se a imagem for usada com o código montado e sem outro comando.

As barras invertidas continuam a instrução em outras linhas. Os && fazem
o comando seguinte executar apenas se o anterior tiver sucesso.
Não copiamos o backend para a imagem nesta receita de desenvolvimento:
o Compose já monta os arquivos da aplicação em /app.

### compose.yaml

```yaml
backend:
  build:
    context: .
    dockerfile: Dockerfile.backend
```

context indica a raiz como contexto de construção. dockerfile escolhe a nova
receita. O serviço php mantém build: . e usa o Dockerfile original.
command do backend continua iniciando Artisan serve e substitui CMD da imagem.
Os bind mounts, volume vendor-backend, init e porta 8002 foram preservados.

### .dockerignore

Acrescentado !Dockerfile.backend à lista de arquivos permitidos do build.
O ! reabre uma exceção à regra **. Arquivos locais de ambiente continuam excluídos.
Esse ajuste acompanha a nova receita e a referência feita pelo Compose.

## Comandos executados

```bash
docker compose config --quiet
docker compose build backend
docker compose up -d --no-deps backend
docker compose exec -T backend dpkg-query -W msodbcsql18 unixodbc libgssapi-krb5-2
docker compose exec -T backend odbcinst -q -d -n "ODBC Driver 18 for SQL Server"
docker compose exec -T backend composer check-platform-reqs --no-dev
docker compose ps
```

config --quiet valida sem imprimir variáveis do ambiente. build constrói somente
backend. up -d aplica a imagem em segundo plano; --no-deps limita a operação ao
serviço escolhido. exec -T executa no container ativo sem terminal interativo.
dpkg-query informa os pacotes; odbcinst -q -d -n consulta o driver registrado pelo
nome. Composer confere requisitos dos pacotes de execução instalados no volume.

O build passou; o checksum retornou OK. Bases resolvidas:

- PHP: sha256:836ac6c672d1372a47c8fd61b625015bd07760f493fb2eaab2087636498a2b4b.
- Composer: sha256:206a6dc365fd66aac01e2744d8a6bc898108e802b1bcdde1cd782da788bf1db9.

## O que as verificações demonstram

- Backend recriado com a nova imagem; laboratório manteve o mesmo container
  e imagem, conferidos antes/depois por docker inspect.
- msodbcsql18 18.7.1.1-1 e unixODBC 2.3.11-2+deb12u1 instalados.
- odbcinst encontrou ODBC Driver 18 for SQL Server e sua biblioteca
  /opt/microsoft/msodbcsql18/lib64/libmsodbcsql-18.7.so.1.1.
- ldd encontrou todas as bibliotecas dinâmicas exigidas pelo driver; um
  diagnóstico PHP também verificou o arquivo registrado e legível.
- PHP 8.4.26 e Composer 2.10.3 mantidos; Composer check-platform-reqs passou.
  Autoload do volume continuou informando Laravel 13.35.0.
- Diagnóstico PHP em Docker na rede do host: /loja HTTP 200, título e três
  produtos corretos, X-Curso: Laravel; welcome e laboratório HTTP 200 sem X-Curso.
- sqlsrv e pdo_sqlsrv continuam ausentes, conforme verificação explícita.
  Instalar ODBC prepara uma dependência; ainda não demonstra conexão ao banco.
- Código backend/src, Dockerfile do laboratório e configuração local preservados;
  backend/.env ignorado. Sem SQL Server, migrations, contador ou testes Laravel.

README, roteiro e progresso atualizados para esta etapa. Explicação apresentada;
entendimento da 5.2 confirmado com "entendi" em 13/10/2026.
Checkpoint preparado para publicação conforme autorização existente.
Último checkpoint publicado: 41d0660.

Próximo passo exato, após confirmação: publicar 5.2 e iniciar 5.3, instalar e
habilitar sqlsrv/pdo_sqlsrv 5.13.3 na imagem do backend, conferindo o método
oficial e dependências de compilação. Serviço SQL Server terá sua própria etapa.

Fontes:

- [Instalação ODBC 18 no Debian](https://learn.microsoft.com/en-us/sql/connect/odbc/linux-mac/installing-the-microsoft-odbc-driver-for-sql-server?view=sql-server-ver17#debian).
- [Escolha de Dockerfile pelo Compose](https://docs.docker.com/reference/compose-file/build/#dockerfile).

Referências e disponibilidade dos pacotes conferidas em 13/10/2026.
