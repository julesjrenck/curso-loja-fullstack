# Aula 3.5 — Composer no Docker

## Objetivo

Disponibilizar Composer na imagem PHP. Ele gerencia bibliotecas de projetos PHP
e oferece autoload, que estudaremos depois para carregar nossas classes.
Um exemplo futuro de biblioteca será PHPUnit, usado para executar testes.

Nesta etapa verificamos o executável. Não instalamos bibliotecas do projeto
nem alteramos o carregamento atual de `Produto`.

## Dockerfile

O arquivo completo agora é:

```dockerfile
FROM php:8.4.26-cli-bookworm

COPY --from=composer/composer:2.10.3-bin /composer /usr/local/bin/composer

WORKDIR /app

COPY src/ ./

CMD ["php", "index.php"]
```

A nova instrução tem três partes:

| Trecho | Significado |
| --- | --- |
| `--from=composer/composer:2.10.3-bin` | Usa essa imagem externa como origem da cópia. |
| `/composer` | Arquivo que contém o executável na imagem de origem. |
| `/usr/local/bin/composer` | Caminho de destino na nossa imagem PHP. |

A tag `2.10.3-bin` identifica a versão escolhida e a imagem que contém somente
o executável. A documentação do Composer recomenda esse tipo de cópia para
adicionar a ferramenta a uma imagem existente. O build confirmou a disponibilidade
da tag. Não usamos uma tag de versão móvel como `latest` para essa origem.

Composer é distribuído como um arquivo PHAR, um pacote de código PHP executável.
O arquivo copiado usa o PHP da nossa imagem. `/usr/local/bin` está no `PATH`, a
lista de diretórios onde comandos são procurados; por isso podemos chamar
`composer` sem escrever seu caminho inteiro.

`FROM` continua escolhendo PHP como base. Copiamos um arquivo da outra imagem;
não substituímos nosso ambiente pelo ambiente dela. `WORKDIR` continua definindo
`/app`, `COPY src/ ./` continua copiando o código e `CMD` continua definindo a
execução padrão. O Compose usa seu próprio `command` para iniciar o servidor.

O Composer fica fora de `/app`, então o bind mount do código não esconde seu
executável. A ferramenta passa a fazer parte da imagem e não precisa ser
instalada novamente a cada container. Nenhuma instalação foi feita no host.

## Construir e executar

Na raiz do projeto, executamos:

```bash
docker compose build php
docker compose run --rm php composer --version
```

- `build php` constrói a imagem do serviço, incorporando a mudança no Dockerfile.
- `run --rm php` cria um container temporário desse serviço e o remove ao terminar.
- `composer --version` substitui o comando padrão dessa execução e mostra a
  versão da ferramenta. Não instala dependências nem escreve código em `/app`.

O Composer informou versão `2.10.3`, usando PHP `8.4.26`, com código de saída 0.
Isso confirma que o executável copiado funciona com o PHP atual.
Não verifica ainda a instalação de bibliotecas externas.

## Aplicar ao servidor

Um build não altera um container que já está em execução. Executamos:

```bash
docker compose up -d php
```

O Compose recriou o serviço usando a nova imagem e o iniciou em segundo plano.
Os volumes existentes continuam configurados; não removemos os dados persistidos.

Verificações concluídas:

- Imagem construída com sucesso, mantendo PHP 8.4.26 e copiando Composer 2.10.3.
- Comando de versão retornou código 0.
- Exemplo `exemplo-produto.php` manteve suas três linhas e retornou código 0.
- Inspeção confirmou que o servidor usa a imagem recém-construída.
- `http://127.0.0.1:8001/` respondeu HTTP 200 com PHP 8.4.26 após a recriação.
- Arquivos PHP, configuração local e volume de dados preservados.

## Continuidade

Aguardar confirmação de entendimento. Depois, criar `src/composer.json` para
declarar o requisito de PHP e mapear `Loja` para os arquivos de classes usando
PSR-4, explicando e validando a configuração. A geração do autoload e a mudança
do `require_once` serão feitas em outra etapa, com armazenamento gravável para
os arquivos gerados. O bind mount atual de `/app` permanece somente leitura.

O estado está em [progresso](../progresso.md).

## Fontes

- [Composer: introdução, PHAR, PATH e instalação no Docker](https://getcomposer.org/doc/00-intro.md).
- [Composer: versão publicada](https://getcomposer.org/download/).
