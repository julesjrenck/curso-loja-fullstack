# Aula 2.7 — Servidor PHP e portas

Esta aula registra o checkpoint `1b7739d`. Configuração e saída do script
evoluem nas aulas seguintes; consulte o README para o estado atual.

## Objetivo

Executar o script por HTTP usando o servidor PHP de desenvolvimento, publicar
uma porta local e acompanhar a execução pelo Compose.

## compose.yaml

```yaml
name: curso-loja-fullstack

services:
  php:
    build: .
    command: ["php", "-S", "0.0.0.0:8000", "-t", "/app"]
    stop_signal: SIGINT
    ports:
      - "127.0.0.1:8001:8000"
    volumes:
      - ./src:/app:ro
```

- `command` define o comando deste serviço, substituindo o `CMD` da imagem.
- `php -S` inicia o servidor de desenvolvimento do PHP.
- `0.0.0.0:8000` faz o servidor escutar na porta 8000 das interfaces do container.
- `-t /app` define a pasta dos arquivos atendidos; `index.php` responde à raiz.
- `stop_signal: SIGINT` escolhe o sinal de interrupção, equivalente a Ctrl+C,
  para encerrar normalmente esse servidor ao parar o serviço.
- `ports` publica uma porta para acesso pelo computador.
- Em `127.0.0.1:8001:8000`, os campos são IP do host, porta do host e porta do
  container. A publicação fica restrita ao endereço local do computador.
- O bind mount da aula anterior continua disponibilizando o código local.

O caminho da requisição fica assim:

```text
Navegador → http://127.0.0.1:8001/ → container:8000 → /app/index.php
```

`0.0.0.0` no comando é um endereço de escuta dentro do container. Para acessar
pelo navegador usamos o endereço publicado no host, `127.0.0.1:8001`.
Este é um servidor de desenvolvimento; a configuração de produção será estudada
nos módulos de implantação.

## Resposta do script

Antes dos comandos `echo`, acrescentamos em `src/index.php`:

```php
header("Content-Type: text/plain; charset=UTF-8");
```

`header` define um cabeçalho HTTP. `text/plain` informa que a resposta é texto
simples e `charset=UTF-8` informa sua codificação, preservando acentos. A linha
vem antes da saída para que o cabeçalho seja enviado corretamente.

## Iniciar e acessar

Na raiz do projeto:

```bash
docker compose config --quiet
docker compose up -d --build php
```

- `up`: cria/inicia o serviço e aplica sua configuração.
- `-d`: mantém o serviço em segundo plano, liberando o terminal.
- `--build`: constrói a imagem antes de iniciar.
- `php`: seleciona o serviço da demonstração.

Acesse [a demonstração local](http://127.0.0.1:8001/). O resultado verificado foi:

```text
Olá, Docker! Código local atualizado.
Versão do PHP: 8.4.26
```

## Estado, logs e parada

```bash
docker compose ps
docker compose logs --tail 10 php
docker compose stop php
docker compose ps -a
```

- `ps` mostra o estado dos containers do projeto.
- `logs --tail 10 php` mostra as últimas dez linhas dos logs do serviço PHP.
- `stop php` para o serviço, preservando seu container para reinício.
- `ps -a` inclui containers parados na consulta.

Para iniciar novamente usando a imagem existente:

```bash
docker compose up -d php
```

Ao editar apenas o script montado, atualize a página para executar a nova versão.
Ao alterar a configuração Compose, aplique-a com `up`; alterações na imagem
ou suas dependências precisam de build.

## Verificações e ajustes do ambiente

- A porta local 8000 não tinha listener visível na inspeção, mas sua publicação
  retornou erro 500 em `/forwards/expose` do Docker Desktop.
- A alternativa `127.0.0.1:8001:8000` foi publicada com sucesso. Não concluímos
  qual foi a causa específica do erro na porta 8000.
- A configuração final foi validada sem erros.
- A resposta HTTP retornou `200 OK`, `Content-Type: text/plain; charset=UTF-8`
  e o corpo esperado.
- O serviço mostrou estado `Up` e publicação `127.0.0.1:8001->8000/tcp`.
- Logs confirmaram a inicialização e a requisição `GET /` com status 200.
- Na primeira parada com o sinal padrão, o processo terminou com código 137.
  Após configurar SIGINT, a parada terminou normalmente com código 0.
- O serviço foi reiniciado, e outra requisição HTTP confirmou sua disponibilidade.
- Ao encerrar a aula, o servidor foi deixado em execução para acesso do aluno.

As operações de daemon e rede utilizaram a execução ampliada autorizada.
Foram preservados os demais projetos e a configuração global do Docker.

## Continuidade

Aguardar entendimento antes de introduzir variáveis de ambiente no serviço.
O estado atualizado da confirmação está em [progresso](../progresso.md).

## Fontes

- [Servidor PHP de desenvolvimento](https://www.php.net/manual/en/features.commandline.webserver.php).
- [Comando, portas e sinal de parada no Compose](https://docs.docker.com/reference/compose-file/services/).
- [Iniciar serviços](https://docs.docker.com/reference/cli/docker/compose/up/).
- [Parar serviços](https://docs.docker.com/reference/cli/docker/compose/stop/).
