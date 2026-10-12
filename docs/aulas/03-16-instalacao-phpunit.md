# Aula 3.16 — Instalação de PHPUnit pelo Composer

## Objetivo

Instalar PHPUnit como dependência de desenvolvimento, registrar as versões
resolvidas e verificar a execução da ferramenta no Docker.

## Arquivo Dockerfile

Acrescentamos a ferramenta que o Composer usa para extrair os downloads ZIP:

```dockerfile
RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip=6.0-28+deb12u1 \
    && rm -rf /var/lib/apt/lists/*
```

`RUN` executa esses comandos durante o build da imagem. A barra invertida
continua a instrução na próxima linha; `&&` executa o próximo comando somente
se o anterior terminar com sucesso.

`apt-get update` consulta os índices de pacotes do Debian Bookworm da imagem.
`apt-get install` instala unzip na versão indicada; `-y` responde à confirmação
da instalação, e `--no-install-recommends` evita pacotes recomendados opcionais.
`rm -rf /var/lib/apt/lists/*` remove os índices baixados dentro da imagem,
reduzindo seu tamanho. Esse comando não atua nos arquivos do projeto no host.

O requisito apareceu na primeira tentativa real de instalação: o Composer
gerou o lockfile, mas informou que faltava a extensão zip ou um executável
unzip/7z. Acrescentamos unzip, versão consultada no catálogo Debian e confirmada
no build. Os requisitos de PHP verificados na 3.15 continuaram atendidos.

```bash
docker compose build php
```

O build preservou PHP 8.4.26 e Composer 2.10.3 e acrescentou unzip.

## Arquivo src/composer.json

O Composer acrescentou:

```json
"require-dev": {
    "phpunit/phpunit": "^13.4"
}
```

`require-dev` declara ferramentas de desenvolvimento, como o executor de testes.
`phpunit/phpunit` é o nome do pacote, publicado no Packagist.
`^13.4` permite versões >=13.4.0 e <14.0.0; a instalação resolveu 13.4.1.
As regras de PHP e o autoload de Loja foram preservados.

Para acrescentar essa dependência, executamos:

```bash
docker compose run --rm --workdir /instalacao \
  --volume ./src:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-php:/instalacao/vendor \
  php composer require --dev 'phpunit/phpunit:^13.4' \
  --no-interaction --no-progress
```

- `run --rm` cria um container temporário e o remove ao terminar.
- `--workdir /instalacao` define o diretório em que o Composer trabalha.
- A montagem `./src:/instalacao:rw` permite escrever os arquivos do projeto nesse
  caminho durante a instalação.
- A segunda montagem usa o volume vendor já existente dentro desse diretório.
- `php` seleciona o serviço; `composer` é o executável incluído na imagem.
- `require` acrescenta a dependência, resolve versões e inicia a instalação.
- `--dev` seleciona a seção require-dev.
- As aspas preservam o argumento do pacote e da faixa de versões.
- `--no-interaction` evita perguntas interativas; `--no-progress` omite a barra
  de progresso sem ocultar erros ou resultados.

Neste ambiente, tentar substituir a montagem de /app por uma montagem gravável
nas opções de run deixou /app somente leitura, mesmo com :rw explícito.
O diagnóstico de /proc/mounts confirmou ro em /app e rw em /instalacao.
Por isso usamos o caminho adicional, sem alterar compose.yaml. Antes da
instalação, conferimos escrita em /instalacao e acesso ao mesmo autoload pelas
duas montagens do volume vendor.

## Arquivo src/composer.lock

Esse arquivo foi gerado pelo Composer e contém as versões exatas resolvidas.
Na entrada de phpunit/phpunit, o campo version registra 13.4.1.

Seus campos principais nesta instalação:

- `content-hash`: permite conferir a relação com os requisitos do composer.json.
- `packages`: vazio; ainda não declaramos pacotes de execução da aplicação.
- `packages-dev`: 27 pacotes, PHPUnit e seus 26 auxiliares, com versões,
  referências de download, requisitos e dados de autoload.
- `platform`: requisito de PHP do nosso projeto, ^8.4.
- `platform-dev`: vazio; nenhuma exigência adicional declarada pelo projeto ali.
- `plugin-api-version`: versão da API de plugins do Composer registrada no lock.

Os arquivos composer.json e composer.lock serão versionados juntos quando a
etapa for concluída. O Composer deve atualizar o lockfile quando alterarmos
dependências; ele permite repetir as versões instaladas em outro ambiente.

Após acrescentar unzip à imagem, continuamos a instalação com o lockfile já
gerado pela primeira tentativa:

```bash
docker compose run --rm --workdir /instalacao \
  --volume ./src:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-php:/instalacao/vendor \
  php composer install --no-interaction --no-progress
```

Com o lockfile válido, `install` instala as versões registradas e inclui os
pacotes de desenvolvimento por padrão. A operação instalou os 27 pacotes
e regenerou o autoload, com código 0.

O arquivo novo recebeu inicialmente o proprietário do processo do container.
Alinhamos somente seu proprietário ao de composer.json para preservar a
possibilidade de edição no host:

```bash
docker compose run --rm --workdir /instalacao \
  --volume ./src:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-php:/instalacao/vendor \
  php chown --reference=composer.json composer.lock
```

`chown --reference` usa o proprietário e o grupo do arquivo de referência.
Verificação no host: ambos os arquivos ficaram com UID/GID 1000:1000 e modo 644.

## Arquivos gerados no volume vendor

No container normal, os pacotes ficam em /app/vendor:

- `vendor/bin/phpunit`: entrada de comando gerada pelo Composer para executar
  a ferramenta instalada em vendor/phpunit/phpunit.
- `vendor/autoload.php`: entrada do autoload, regenerada com as dependências.
- `vendor/composer/installed.json` e `installed.php`: dados dos pacotes instalados.
- `vendor/composer/InstalledVersions.php`: consulta desses dados pelo Composer.
- `vendor/composer/autoload_files.php`: arquivos carregados ao iniciar o autoload.
- `autoload_classmap.php`, `autoload_namespaces.php`, `autoload_psr4.php`,
  `autoload_real.php` e `autoload_static.php`: mapas e inicialização do carregador.
- `ClassLoader.php`: implementação do carregador já apresentada na aula 3.8.
- `platform_check.php`: verificação de plataforma gerada pelo Composer.
- `LICENSE`: licença do código do Composer presente nesse diretório.

Os pacotes externos contêm seus próprios arquivos. Serão aprofundados conforme
precisarmos de sua API, sem percorrer o código inteiro das dependências.
vendor continua no volume Docker e ignorado pelo Git; a pasta src/vendor no
host é o ponto de montagem. composer.lock é permitido para versionamento.

## Aplicar e verificar

```bash
docker compose up -d php
docker compose run --rm php php vendor/bin/phpunit --version
docker compose run --rm php composer check-platform-reqs
docker compose run --rm php composer validate
docker compose run --rm php composer audit --locked --no-interaction
docker compose run --rm php php exemplo-item-carrinho.php
```

`up -d` aplicou a imagem nova ao serviço em segundo plano. A execução normal
voltou a usar /app somente leitura, com /app/vendor gravável. Não precisa
de /instalacao para consultar a versão ou executar futuros testes.

Resultados:

- `--version`: PHPUnit 13.4.1, código 0. Verifica a ferramenta, sem executar testes.
- `check-platform-reqs`: requisitos reais de PHP e extensões dos pacotes passaram.
- `validate`: configuração e lockfile válidos, código 0. Permanece o aviso
  já conhecido de licença não declarada; nenhuma licença escolhida nesta aula.
- `audit --locked`: nenhuma vulnerabilidade conhecida reportada, código 0.
- Exemplo do item: quatro linhas anteriores, subtotal de 14970 centavos, código 0.
- HTTP principal 200; exemplo exclusivo do terminal retornou 403.
- Apenas o servidor ficou ativo; containers temporários removidos. Dados do
  contador e configuração local preservados.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa, 3.17: primeiro
teste PHPUnit em src/tests/ItemCarrinhoTest.php, criando uma camiseta de
4990 centavos e quantidade 3 e conferindo subtotal 14970. Explicar TestCase,
extends, método de teste, assertSame e bootstrap do autoload. Executar com
`php vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php`
no Docker. Não criar testes antecipadamente. Estado em [progresso](../progresso.md).

## Fontes

- [PHPUnit 13.4.1: requisitos oficiais](https://github.com/sebastianbergmann/phpunit/blob/13.4.1/composer.json).
- [Composer: comando require e opção dev](https://getcomposer.org/doc/03-cli.md#require-r).
- [Composer: lockfile e install](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies).
- [Composer: ferramentas auxiliares de descompactação](https://getcomposer.org/doc/00-intro.md#system-requirements).
- [Debian Bookworm: versão de unzip](https://packages.debian.org/bookworm/unzip).
