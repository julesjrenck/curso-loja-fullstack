# Aula 2.9 — .env local e .env.example

## Objetivo

Separar valores locais da configuração compartilhada e manter um modelo
versionado para quem preparar o projeto em outro computador.

## Modelo e configuração local

Criamos `.env.example`, com o valor didático:

```dotenv
APP_NAME="Loja Fullstack"
```

Cada linha usa `NOME=VALOR`; as aspas delimitam o texto. O modelo documenta a
configuração necessária e é versionado no GitHub.

Criamos `.env` a partir do modelo e, para demonstrar a configuração local,
alteramos seu valor para:

```dotenv
APP_NAME="Loja Fullstack Local"
```

O `.env` fica no computador, fora do Git e do contexto de build. Os valores
desta aula são públicos e fictícios; não há credenciais nesses exemplos.
O `.env.example` não é carregado automaticamente no lugar do `.env`.

Para criar a configuração em uma nova cópia do projeto, no Linux com GNU cp:

```bash
cp --update=none .env.example .env
```

`cp` copia o arquivo; `--update=none` preserva o destino se ele já existir.
Depois, edite o `.env` local conforme necessário.
Nesta aula a primeira cópia usou `cp -n`, que funcionou, mas exibiu um aviso de
portabilidade. Verificamos a opção acima, que preservou nosso valor local.

## Interpolação no Compose

No serviço PHP, substituímos o valor literal por:

```yaml
environment:
  APP_NAME: "${APP_NAME}"
```

`${APP_NAME}` pede ao Compose para substituir a expressão pelo valor da
configuração. Nesta execução, ele leu `.env` na raiz do projeto e resolveu
o valor como `Loja Fullstack Local`.

O fluxo é:

```text
.env → interpolação do Compose → environment do container → getenv no PHP
```

O `environment` continua passando APP_NAME explicitamente ao container.
O PHP mantém o mesmo `getenv("APP_NAME")`; ele consulta o ambiente recebido,
sem ler diretamente o arquivo `.env` nesta implementação.

Variáveis do shell têm precedência na interpolação. Conferimos que APP_NAME
não estava definida no shell desta aula. Em uma nova sessão, se houver um
valor inesperado, verifique a origem antes de alterar arquivos locais.

## Aplicar e conferir

```bash
docker compose config --quiet
docker compose up -d php
docker compose exec -T php printenv APP_NAME
```

A configuração validou sem erros; o Compose recriou o container com o novo
valor, sem reconstruir a imagem da aplicação. `printenv` retornou
`Loja Fullstack Local`.

Em [http://127.0.0.1:8001/](http://127.0.0.1:8001/), HTTP retornou status 200 e:

```text
Aplicação: Loja Fullstack Local
Olá, Docker! Código local atualizado.
Versão do PHP: 8.4.26
```

## Verificações de exclusão

- Nenhum `.env` ou modelo anterior existia antes desta etapa.
- O `.gitignore` já ignorava `.env` e permitia `.env.example` por exceção.
- `git check-ignore` confirmou somente `.env` como ignorado.
- `git ls-files .env` confirmou que o arquivo local não estava rastreado.
- O `.dockerignore` permite apenas os arquivos de build e o código em `src`.
  Um build temporário tentou copiar `.env` e foi recusado porque o arquivo
  não estava no contexto. O Dockerfile do projeto foi preservado, e nenhuma
  imagem de teste foi concluída.
- O servidor permaneceu em execução, publicado somente em `127.0.0.1:8001`.

O modelo, a interpolação e a documentação são publicados; o arquivo local
não entra no checkpoint. Mudanças no `.env` devem ser aplicadas com `up`.

## Continuidade

Aguardar entendimento antes de introduzir um volume gerenciado pelo Docker
para demonstrar persistência de dados. O estado está em [progresso](../progresso.md).

## Fonte

- [Interpolação, .env e precedência no Compose](https://docs.docker.com/compose/how-tos/environment-variables/variable-interpolation/).
