# Aula 2.2 — Primeiro container PHP

## Objetivo

Executar PHP 8.4 dentro de um container, interpretar a saída e observar o
término do processo. A aplicação da loja ainda não foi criada.

## Comando executado

```bash
docker run --rm --name curso-loja-php-versao php:8.4.26-cli-bookworm php -v
```

| Parte | Significado |
| --- | --- |
| `docker` | Cliente que envia comandos ao serviço Docker. |
| `run` | Cria um container a partir da imagem e inicia o comando nele. |
| `--rm` | Remove automaticamente este container quando ele termina. |
| `--name curso-loja-php-versao` | Dá um nome para identificar este container. |
| `php:8.4.26-cli-bookworm` | Imagem oficial PHP e sua tag específica. |
| `php -v` | Comando executado dentro do container para mostrar a versão do PHP. |

Na tag da imagem, `8.4.26` é a versão do PHP, `cli` identifica a variante para
terminal e `bookworm` identifica a base Debian 12. Isso ainda não é um servidor
web. Os argumentos anteriores à imagem configuram o container; os argumentos
posteriores à imagem indicam o comando que executaremos dentro dele.

## Resultado observado

A imagem não estava disponível localmente com essa tag, então o Docker fez
o download antes de criar o container. A mensagem `Unable to find image ...
locally` faz parte desse fluxo e não significou falha da execução.

A saída começou com:

```text
PHP 8.4.26 (cli) (built: Oct  6 2026 01:26:57) (NTS)
```

A versão e a variante CLI foram confirmadas; o comando terminou com código 0.
Depois que `php -v` terminou, o container encerrou e foi removido por `--rm`.
A imagem continuou armazenada no Docker para criar outros containers.

## Verificações realizadas

- Antes de executar, não existia container com o nome `curso-loja-php-versao`.
- Depois de executar, `docker ps -a --filter name=curso-loja-php-versao` não
  encontrou esse container, confirmando sua remoção.
- `docker image inspect php:8.4.26-cli-bookworm` confirmou a imagem disponível
  para Linux `amd64`.
- Digest observado:
  `php@sha256:836ac6c672d1372a47c8fd61b625015bd07760f493fb2eaab2087636498a2b4b`.

O digest identifica o conteúdo obtido; será aprofundado quando estudarmos
imagens e builds. A tag registra a versão e variante utilizadas nesta aula.

As operações Docker foram executadas pelo fluxo ampliado autorizado, pois o
modo restrito deste ambiente não permite acessar o socket. Não compartilhamos
pastas ou portas do host nesta execução.

## Continuidade

Confirmar o entendimento de imagem, comando dentro do container e `--rm` antes
de avançar para o primeiro Dockerfile. O estado atualizado da confirmação está
em [progresso](../progresso.md).

## Fontes

- [Tags oficiais da imagem PHP](https://github.com/docker-library/official-images/blob/master/library/php).
- [Comando docker run e opção --rm](https://docs.docker.com/reference/cli/docker/container/run/).
