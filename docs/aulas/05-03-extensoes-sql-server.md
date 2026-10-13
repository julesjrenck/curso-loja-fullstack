# Aula 5.3 — Extensões PHP para SQL Server

## Objetivo e conceito

Instalar e habilitar sqlsrv e pdo_sqlsrv 5.13.3 no PHP do backend.
O ODBC foi instalado na 5.2, cujo entendimento o aluno confirmou com "entendi"
em 13/10/2026. Checkpoint 5709dfe publicado e verificado: HEAD, origin/main e
consulta direta à main remota retornaram
`5709dfefd739105efeff07691e6c127faa54dac6`.

sqlsrv fornece funções PHP próprias, como sqlsrv_connect. pdo_sqlsrv permite
acesso ao SQL Server pela interface PDO usada pelo Laravel. São extensões PHP:
ficam carregadas no processo PHP e usam a biblioteca ODBC já instalada.

Composer instala as classes da aplicação em vendor. PIE instala extensões
no ambiente PHP; neste Linux, são bibliotecas compiladas com sufixo .so.
Compilar transforma os arquivos de código da extensão em uma biblioteca
compatível com a versão e a arquitetura do PHP que vai carregá-la.

Esclarecimento solicitado pelo aluno: "o que é eese pie?".
PIE significa PHP Installer for Extensions: instalador de extensões para PHP.
É a ferramenta que automatiza a obtenção, compilação, instalação e habilitação
da extensão neste ambiente. Usamos PIE durante a construção da imagem;
durante uma requisição, o PHP usa a extensão que ficou instalada e carregada.
Composer prepara bibliotecas/classes em vendor; PIE prepara recursos do próprio PHP.
Esclarecimento apresentado e entendimento confirmado com "entendi" em 13/10/2026.

## Alteração em Dockerfile.backend

Um único arquivo de implementação foi alterado. Compose já aponta para essa
receita desde a 5.2. PHP, Composer, ODBC e montagens existentes continuam sendo
usados, com a instalação das extensões acrescentada à imagem de desenvolvimento.

Primeiro bloco novo:

```dockerfile
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git=1:2.39.5-0+deb12u3 \
        libtool=2.4.7-7~deb12u1 \
        unixodbc-dev=2.3.11-2+deb12u1 \
    && rm -rf /var/lib/apt/lists/*
```

- git é uma ferramenta usada pelo instalador para obter código de pacotes.
- libtool fornece ferramentas para preparar bibliotecas compartilhadas.
- unixodbc-dev fornece cabeçalhos e arquivos necessários para compilar com ODBC;
  diferencia-se das bibliotecas de execução já instaladas.
- As versões foram consultadas em container temporário antes da alteração.
  A base PHP já fornece gcc/g++, make, autoconf, pkg-config, phpize e php-config.

Não instalamos outro PHP da distribuição: phpize/php-config pertencem ao
PHP 8.4.26 da imagem oficial. O destino confirmado pelo PIE foi PHP 8.4.26,
64 bits x86_64, sem thread safety.

Segundo bloco novo baixa PIE 1.5.2 de uma URL com versão identificável, verifica
seu SHA-256 e permite executar o arquivo com chmod +x. O hash foi conferido nos
metadados públicos da release oficial:
`fe70c59738cf56ec00a818cf9cb9593da171aac86f5f1f859995b8839dfd2cc7`.

PIE é distribuído como PHAR, um arquivo executável pelo PHP, semelhante à forma
de distribuição do Composer. A documentação atual Microsoft recomenda PIE;
os drivers suportam esse método desde a linha 5.13.2.

As duas instalações são separadas:

```dockerfile
    && pie install --no-interaction --no-cache --make-parallel-jobs=2 microsoft/sqlsrv:5.13.3 \
    && pie install --no-interaction --no-cache --make-parallel-jobs=2 microsoft/pdo_sqlsrv:5.13.3
```

microsoft/sqlsrv e microsoft/pdo_sqlsrv identificam os pacotes para o PIE.
:5.13.3 seleciona a versão exata; --no-interaction evita perguntas no build;
--no-cache evita usar o cache do instalador; --make-parallel-jobs=2 limita
a compilação a dois trabalhos simultâneos. Os && interrompem a sequência
se uma instalação falhar. O build terminou com as duas extensões habilitadas.

## Arquivos gerados na imagem

As bibliotecas foram instaladas em:

```text
/usr/local/lib/php/extensions/no-debug-non-zts-20240924/sqlsrv.so
/usr/local/lib/php/extensions/no-debug-non-zts-20240924/pdo_sqlsrv.so
```

O diretório é escolhido para o PHP alvo. Seu nome identifica características
de compilação e a API de extensões; o sufixo numérico não é a data desta aula.

O PIE usou a habilitação da imagem oficial PHP e gerou:

| Arquivo | Conteúdo |
| --- | --- |
| /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini | extension=sqlsrv |
| /usr/local/etc/php/conf.d/docker-php-ext-pdo_sqlsrv.ini | extension=pdo_sqlsrv |

O PHP lê esse diretório de configuração ao iniciar e carrega as bibliotecas.
Instalar um .so e habilitar seu carregamento são partes distintas da preparação.
Esses arquivos pertencem à imagem e foram conferidos no container ativo;
Dockerfile reproduz sua geração. Não há alteração de php.ini no computador do aluno.

## Aplicação e verificação

Executados config --quiet, build backend e up -d --no-deps backend.
O primeiro valida o Compose; build constrói a imagem; up recria o serviço
para usar a imagem nova. Os diagnósticos PHP executaram somente em Docker.

Um script no backend verificou extension_loaded e phpversion para cada extensão,
function_exists('sqlsrv_connect'), PDO::getAvailableDrivers, os .ini efetivamente
lidos e a versão Laravel obtida pelo autoload. São consultas de preparação:
nenhuma função de conexão ou query foi executada.

Resultados em 13/10/2026:

- PIE 1.5.2; checksum da distribuição OK. Os dois drivers foram compilados,
  instalados e carregados na versão 5.13.3.
- PDO passou a listar sqlite e sqlsrv. SQLite é uma extensão da base;
  o banco escolhido para a aplicação e integração continua sendo SQL Server.
- Dois .ini encontrados no diretório de configuração e conteúdo conferido.
- dpkg-query confirmou git, libtool e unixodbc-dev nas versões fixadas;
  ODBC 18.7.1.1-1 permanece registrado.
- Composer check-platform-reqs --no-dev passou; autoload do volume preservado,
  Laravel Framework 13.35.0. Laboratório manteve o mesmo container e imagem.
- PHP em Docker na rede do host: /loja HTTP 200 com título, três nomes na ordem
  e X-Curso: Laravel. Página welcome e laboratório HTTP 200 sem X-Curso.
- Código backend/src, Compose, Dockerfile original e .dockerignore sem alteração;
  backend/.env ignorado. Sem SQL Server, banco, migration ou contador executado.

Os drivers estão prontos para serem usados. A existência do driver ainda não
demonstra uma conexão real, que exige servidor e configuração de acesso.

Explicação apresentada; entendimento da 5.3 confirmado com "entendi" em 13/10/2026,
após esclarecimento sobre PIE. Checkpoint preparado para publicação autorizada.
Último checkpoint publicado: 5709dfe.
Após confirmação, publicar 5.3 e iniciar 5.4: introduzir o serviço SQL Server
2022 Developer no Compose, conferindo imagem/tag/digest, volume persistente e
credenciais locais ignoradas. Conexão Laravel e bancos da loja/testes terão
suas etapas; manter banco de integração SQL Server exclusivo.

Fontes consultadas em 13/10/2026:

- [Instalação oficial Microsoft com PIE](https://learn.microsoft.com/en-us/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-ver17#install-the-drivers-with-pie).
- [Drivers Microsoft 5.13.3](https://github.com/microsoft/msphpsql/releases/tag/v5.13.3).
- [PIE 1.5.2](https://github.com/php/pie/releases/tag/1.5.2).
- [Uso de PIE](https://github.com/php/pie/blob/1.5.2/docs/usage.md).
- [Extensões na imagem oficial PHP](https://hub.docker.com/_/php).
