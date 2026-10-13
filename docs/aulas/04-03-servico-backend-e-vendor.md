# Aula 4.3 — Serviço Docker e volume do backend

## Objetivo

Preparar comandos PHP e Composer para o projeto Laravel em backend, com
dependências separadas das do laboratório em src. Nesta aula criamos o lugar
onde as dependências ficarão; a instalação será uma etapa própria.

## Alteração no Compose

O trecho abaixo foi acrescentado em services de compose.yaml:

```yaml
  backend:
    build: .
    command: ["php", "--version"]
    volumes:
      - ./backend:/app:ro
      - vendor-backend:/app/vendor
```

Na declaração volumes da raiz foi acrescentado vendor-backend, mantendo os
volumes existentes:

```yaml
volumes:
  vendor-php:
  dados-demo:
  vendor-backend:
```

- backend é o nome do serviço usado nos comandos Docker Compose.
- build: . usa o contexto e o Dockerfile da raiz. Reutilizamos PHP 8.4.26,
  Composer 2.10.3 e unzip já apresentados; o Dockerfile não foi alterado.
- command define php --version como comando padrão: imprime a versão e termina.
  Esse serviço ainda serve para comandos de terminal.
- ./backend:/app:ro liga a pasta local ao caminho /app no container. O sufixo
  ro significa somente leitura: o container pode ler o código, mas não gravá-lo.
- vendor-backend:/app/vendor monta um volume nomeado dentro de /app. Sem ro,
  essa montagem aceita gravação, mesmo estando dentro do caminho somente leitura.
- volumes dentro de backend indica onde montar; volumes na raiz declara os
  volumes nomeados que o Compose administra.

O diretório de trabalho continua /app, definido pelo WORKDIR do Dockerfile.
Assim, Composer lê /app/composer.json, que corresponde a backend/composer.json.
O pacote visto no diagnóstico foi laravel/laravel; o laboratório usa outro JSON.

O Dockerfile ainda contém COPY src/ ./, conforme a aula do laboratório. A montagem
de backend sobre /app cobre essa cópia durante a execução do serviço backend.
Editar os arquivos locais de backend fica visível pelo bind mount; eles não são
copiados para a imagem nesta aula. A .dockerignore continua a do laboratório.

Os serviços podem usar o mesmo caminho /app/vendor porque cada container tem
suas próprias montagens: php monta vendor-php; backend monta vendor-backend.
Isso permite dependências diferentes sem misturá-las.

## Preparação e comandos

No host, na raiz do projeto:

```bash
mkdir -p backend/vendor
docker compose config --quiet
docker compose build backend
docker compose run --rm backend
docker compose run --rm backend composer --version
```

- mkdir -p prepara o ponto de montagem antes de montar backend como somente
  leitura. A pasta vazia é ignorada pelo Git; os arquivos do volume ficam no Docker.
- config --quiet valida a configuração sem imprimir variáveis locais. Retorno 0
  comprova validade da configuração, não execução do Laravel.
- build backend constrói a imagem para esse serviço, aproveitando camadas em cache.
- run cria um container temporário. Sem comando adicional, executa o command do
  serviço: PHP mostra 8.4.26 e termina. --rm remove esse container ao terminar.
- composer --version substitui o comando padrão nessa execução: mostra Composer
  2.10.3, executado com PHP 8.4.26 dentro do Docker.

O Compose criou curso-loja-fullstack_vendor-backend: o prefixo vem do name do
projeto e o restante é o nome declarado. Remover os containers temporários com
--rm preserva esse volume nomeado para as próximas execuções.

## Verificações executadas

| Verificação | Resultado e significado |
| --- | --- |
| docker compose config --quiet | Código 0; configuração válida. |
| Build e comando padrão de backend | Imagem construída; PHP 8.4.26 executou e terminou normalmente. |
| Composer no serviço backend | Versão 2.10.3 disponível, sem instalar pacotes. |
| getcwd e composer.json no container | /app e laravel/laravel; montagem aponta para o backend correto. |
| /proc/mounts e is_writable | /app com ro e sem escrita; /app/vendor com rw e escrita permitida. |
| Marcador entre dois containers removidos | Conteúdo preservado no volume e lido corretamente. |
| Limpeza | Somente o marcador criado foi removido; volume voltou a ficar vazio. |
| Estado do laboratório | Serviço php permaneceu ativo em 127.0.0.1:8001; nenhum comando do contador executado. |
| Arquivos locais | backend/vendor vazio e ignorado; sem backend/.env ou composer.lock. |

O diagnóstico foi PHP temporário enviado pela entrada padrão, com
docker compose run --rm -T backend php. -T desabilita a alocação de terminal;
o PHP lê o código enviado, sem criar um script no projeto.

A parte de gravação usou:

```php
$marcador = fopen('/app/vendor/verificacao-aula-4-3.txt', 'x');
fwrite($marcador, "Volume exclusivo do backend.");
fclose($marcador);
```

fopen com x cria somente se o arquivo ainda não existir, preservando arquivos
desconhecidos. fwrite grava o texto e fclose fecha o arquivo. O diagnóstico
também verificou que o volume estava vazio e que todos os bytes foram gravados.
Após esse container terminar e ser removido, outro container leu com
file_get_contents, comparou o conteúdo e removeu somente esse marcador com unlink.

Isso comprova escrita e persistência do armazenamento preparado. O Laravel
ainda depende da instalação dos pacotes para executar; estes diagnósticos
verificaram o ambiente Docker, sem chamar Artisan ou executar migrations.

## Situação da aprendizagem

Implementação e verificações concluídas. Explicação apresentada; entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint dc9f4b8 publicado;
HEAD, origin/main e consulta direta à branch main remota coincidiram.

A etapa 4.2 foi confirmada e publicada em cfa2e69. Após entendimento da 4.3,
publicar seu checkpoint e iniciar 4.4: instalar dependências de execução pelo
Composer em Docker, explicar o lockfile e conferir autoload e requisitos.
Será necessária uma montagem temporária gravável para gerar composer.lock no
backend local, usando o volume vendor-backend já preparado.

Fontes oficiais:

- [Montagens dos serviços Compose](https://docs.docker.com/reference/compose-file/services/#volumes).
- [Volumes nomeados no Compose](https://docs.docker.com/reference/compose-file/volumes/).
- [docker compose run](https://docs.docker.com/reference/cli/docker/compose/run/).
