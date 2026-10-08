# Aula 2.5 — Primeiro Docker Compose

## Objetivo

Descrever o serviço PHP em um arquivo Compose e executar a demonstração da
aula anterior a partir dessa configuração. Ainda temos apenas um serviço.

## compose.yaml

```yaml
name: curso-loja-fullstack

services:
  php:
    build: .
```

- `name` define o nome do projeto Compose, que agrupa seus recursos.
- `services` agrupa as definições dos componentes que queremos executar.
- `php` é o nome escolhido para este serviço; será usado nos comandos Compose.
- `build: .` usa a pasta do arquivo Compose como contexto e procura o Dockerfile
  nessa pasta. O contexto continua filtrado pelo `.dockerignore`.
- O arquivo usa YAML: dois-pontos separam chave e valor, e a indentação com
  espaços define os níveis. `build` pertence a `php`, que pertence a `services`.
- Como não definimos outro comando no Compose, o serviço usa o `CMD` da imagem:
  `php index.php`, com `/app` como diretório de trabalho.

O Dockerfile descreve como construir a imagem, incluindo PHP, a cópia do código
e seu comando padrão. O Compose descreve os serviços e sua configuração de
construção/execução. Usaremos esse mesmo arquivo para introduzir gradualmente
outros componentes quando as aulas precisarem deles.

O Compose é lido pelo cliente no computador. Não precisamos incluir
`compose.yaml` no contexto nem copiá-lo para a imagem para usá-lo.

## Validar a configuração

```bash
docker compose config --quiet
```

`config` interpreta e valida o arquivo; `--quiet` evita imprimir a configuração
completa. A execução concluiu com código 0 e sem mensagem de erro.

## Construir e executar

Na raiz do projeto:

```bash
docker compose build
docker compose run --rm php
```

- `docker compose` lê a configuração do projeto.
- `build` constrói as imagens dos serviços que possuem configuração de build.
- `run` cria um container para uma execução do serviço indicado.
- `--rm` remove esse container ao terminar.
- `php` seleciona o serviço declarado no YAML.

O build gerou a imagem local `curso-loja-fullstack-php:latest`, nome escolhido
automaticamente pelo Compose. A versão do PHP continua definida pelo `FROM`
do Dockerfile: 8.4.26.

## Resultado verificado

```text
Olá, Docker!
Versão do PHP: 8.4.26
```

- Não havia recursos Docker desse projeto Compose antes da primeira execução.
- A validação, o build e a execução concluíram com sucesso.
- O build reaproveitou as etapas `WORKDIR` e `COPY` pelo cache disponível.
- A imagem manteve `/app` e o comando `["php", "index.php"]`.
- `docker compose ps -a` não mostrou containers restantes após `run --rm`.
- O Compose criou a rede padrão `curso-loja-fullstack_default`, que permaneceu
  disponível. `--rm` remove o container temporário; não remove essa rede ou imagem.
- ID observado da imagem:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.

As operações que acessaram o daemon utilizaram a execução ampliada autorizada.
A demonstração continua sendo um script de terminal, sem servidor web, portas
publicadas ou pastas do host compartilhadas.

## Continuidade

Se editar o script local, reconstrua a imagem para incluir a mudança. Depois
da confirmação de entendimento, estudaremos como disponibilizar o código local
no container durante o desenvolvimento com bind mount.

O estado da confirmação fica em [progresso](../progresso.md).

## Fontes

- [Nome do projeto Compose](https://docs.docker.com/reference/compose-file/version-and-name/).
- [Build no Compose](https://docs.docker.com/reference/compose-file/build/).
- [docker compose run](https://docs.docker.com/reference/cli/docker/compose/run/).
