# Aula 3.7 — Volume gravável para vendor

## Objetivo

Preparar armazenamento para os arquivos que o Composer gerará em `vendor`.
O código local continua montado em `/app` como somente leitura. Nesta etapa
configuramos e verificamos o armazenamento, antes de gerar autoload.

## Preparar a pasta local

Na raiz do repositório:

```bash
mkdir -p src/vendor
```

`mkdir` cria a pasta. `-p` cria os diretórios necessários e aceita uma pasta
já existente, preservando seu conteúdo. Preparamos esse diretório para que
o destino `/app/vendor` exista no bind mount de `src` montado como somente leitura.

`src/vendor` já é ignorado pela regra `vendor/` no `.gitignore`. O Git não
guarda a pasta vazia. Por isso o README inclui o comando na preparação de
um novo clone. Os arquivos gravados no volume não aparecerão nessa pasta do host.

## Alteração no compose.yaml

O bloco do serviço agora tem:

```yaml
    volumes:
      - ./src:/app:ro
      - vendor-php:/app/vendor
      - dados-demo:/dados
```

A declaração na raiz do YAML passa a ser:

```yaml
volumes:
  vendor-php:
  dados-demo:
```

`volumes` dentro do serviço define suas montagens. `volumes` na raiz declara
os volumes nomeados gerenciados pelo Compose.

| Montagem | Origem e uso |
| --- | --- |
| `./src:/app:ro` | Código do host, somente leitura no container. |
| `vendor-php:/app/vendor` | Volume gerenciado pelo Docker, com leitura e gravação. |
| `dados-demo:/dados` | Volume já usado pelo contador, preservado nesta etapa. |

`vendor-php` é o nome lógico escolhido no Compose; `/app/vendor` é o caminho
dentro do container. Sem `:ro`, essa montagem permite escrita. O volume montado
em `/app/vendor` fornece o conteúdo desse caminho específico, enquanto o bind
mount continua fornecendo o restante de `/app` como somente leitura.

O diretório local `src/vendor` serve como ponto de montagem. A gravação dentro
do container nesse caminho usa o volume Docker. A declaração da montagem
também faz containers temporários do serviço compartilharem esse mesmo volume.

O Compose criou o volume `curso-loja-fullstack_vendor-php`, combinando o nome
do projeto com o nome declarado. Seus arquivos podem sobreviver à remoção
dos containers que o utilizam.

## Aplicar a configuração

```bash
docker compose config --quiet
docker compose up -d php
```

- `config --quiet` valida o Compose sem imprimir os valores da configuração.
- `up -d php` aplica a montagem e inicia o serviço em segundo plano.
- O Compose criou o volume e recriou o servidor para aplicar a nova configuração.
- Não foi necessário build, pois a mudança está nas montagens do Compose.

## Verificação acompanhada

Enviamos pequenos trechos PHP para containers via `php -r`. O código foi
executado como comandos de verificação, sem acrescentar um script à aplicação.

1. Inspeção das montagens confirmou `/app` como bind mount somente leitura
   e `/app/vendor` como volume gravável.
2. Um container temporário criou um arquivo com nome único em `/app/vendor`
   e gravou nele um texto conhecido. A criação usou `fopen` no modo `x`, que
   evita sobrescrever um arquivo existente, seguida de `fwrite` e `fclose`.
3. A tentativa de criar outro arquivo diretamente em `/app` foi recusada.
4. O primeiro container terminou e foi removido por `--rm`.
5. Outro container leu o arquivo com `file_get_contents` e confirmou o conteúdo.
6. Removemos somente o arquivo temporário criado pela verificação, com `unlink`.
7. Conferimos que a pasta local `src/vendor` não recebeu o arquivo do volume.
8. Comparamos o hash do contador antes e depois; seu conteúdo permaneceu igual.
9. O servidor respondeu HTTP 200 após a atualização.

As verificações terminaram com código 0. O volume está pronto, mas não geramos
autoload nem instalamos bibliotecas. `exemplo-produto.php` mantém o carregamento
direto de `Produto.php` com `require_once`.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.8, executar
`docker compose run --rm php composer dump-autoload`, apresentar os arquivos
gerados no volume e trocar o carregamento direto de Produto pelo de
`vendor/autoload.php` no exemplo. Verificar a criação da classe e as regras
usando autoload. O estado está em [progresso](../progresso.md).

## Fontes

- [Docker: volumes e persistência](https://docs.docker.com/engine/storage/volumes/).
- [Docker Compose: montagens de volumes](https://docs.docker.com/reference/compose-file/services/#volumes).
- [Composer: autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading).
