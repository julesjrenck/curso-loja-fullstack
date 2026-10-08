# Aula 2.6 — Código local com bind mount

Esta aula registra o estado do checkpoint `79c432c`. O comando do serviço
evolui depois; consulte o README para a demonstração atual.

## Objetivo

Usar o código local no container durante o desenvolvimento e verificar uma
alteração do script sem reconstruir a imagem existente.

## compose.yaml

```yaml
name: curso-loja-fullstack

services:
  php:
    build: .
    volumes:
      - ./src:/app:ro
```

- `volumes` é a lista de montagens do serviço.
- O hífen `-` inicia um item dessa lista YAML.
- `./src` é a pasta local, relativa à pasta do arquivo Compose.
- `/app` é o destino dentro do container.
- `ro` significa somente leitura para o container; podemos continuar editando
  os arquivos pelo editor no computador.
- Os dois-pontos separam origem, destino e opção de acesso.

Nesta configuração, a montagem é um bind mount: disponibiliza uma pasta
existente do computador no container. O campo `volumes` também aceita outros
tipos de montagem, que serão estudados quando precisarmos deles.

## Relação com COPY

`COPY src/ ./` continua no Dockerfile e inclui o código no momento do build.
Quando iniciamos um container com o bind mount em `/app`, ele enxerga os arquivos
locais montados nesse caminho. A cópia presente na imagem fica encoberta pela
montagem, mas não é apagada nem atualizada por ela.

O container criado sem essa montagem continua enxergando o código da imagem.
Assim, podemos desenvolver com arquivos locais e manter o código incluído na
imagem para execuções sem bind mount.

## Alteração demonstrada

A primeira mensagem em `src/index.php` foi alterada para:

```php
echo "Olá, Docker! Código local atualizado." . PHP_EOL;
```

A segunda linha, que informa a versão do PHP, foi preservada.

Com a imagem da aula 2.5 já construída, executamos sem fazer novo build:

```bash
docker compose config --quiet
docker compose run --rm php
```

Saída observada:

```text
Olá, Docker! Código local atualizado.
Versão do PHP: 8.4.26
```

Para a comparação, executamos diretamente a mesma imagem, sem montar a pasta:

```bash
docker run --rm curso-loja-fullstack-php:latest
```

Saída observada:

```text
Olá, Docker!
Versão do PHP: 8.4.26
```

## Verificações

- A configuração validou com código 0.
- A configuração normalizada confirmou montagem `bind`, origem na pasta `src`
  deste projeto, destino `/app` e `read_only: true`.
- Ambas as execuções concluíram com código 0.
- O identificador da imagem foi igual antes e depois da demonstração:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.
- O script local atualizado foi lido pelo Compose; a versão antiga permaneceu
  na imagem, comprovando a diferença entre montagem e cópia no build.
- Os containers temporários foram removidos; a imagem e a rede do projeto
  continuaram disponíveis.

As operações do daemon usaram execução ampliada autorizada. A demonstração
compartilhou somente a pasta de código `src`, em modo somente leitura.

## Fluxo de desenvolvimento

Depois de construir a imagem pela primeira vez, alterações apenas no script
podem ser verificadas com `docker compose run --rm php`. É necessário executar
o script novamente: o bind mount disponibiliza os arquivos, mas não inicia
automaticamente um processo quando editamos o código.

Alterações na imagem, como sua base ou dependências, ainda exigem um novo build.
Se reconstruirmos a imagem agora, a nova mensagem também fará parte de sua cópia.

Após confirmação de entendimento, iniciaremos o servidor PHP de desenvolvimento
e estudaremos publicação de portas. O estado está em [progresso](../progresso.md).

## Fontes

- [Bind mounts e modo somente leitura](https://docs.docker.com/engine/storage/bind-mounts/).
- [Montagens no Compose](https://docs.docker.com/reference/compose-file/services/#volumes).
