# Aula 4.4 — Dependências Laravel, lockfile e autoload

## Objetivo e conceito

Instalar os pacotes PHP declarados pelo backend e conferir seu carregamento,
antes de inicializar a aplicação. O serviço e o volume preparados na 4.3 agora
são usados pelo Composer.

O composer.json descreve as dependências e as versões permitidas:

```json
"require": {
    "php": "^8.3",
    "laravel/framework": "^13.17",
    "laravel/tinker": "^3.0"
}
```

PHP é um requisito do ambiente; o Composer não instala o runtime. O PHP 8.4.26
do Docker atende à faixa indicada. laravel/framework é a biblioteca Laravel;
laravel/tinker oferece o console interativo declarado pelo modelo. Seu uso será
apresentado quando necessário.

^13.17 permite versões a partir de 13.17.0, abaixo de 14.0.0. A versão resolvida
nesta instalação foi v13.35.0. O esqueleto laravel/laravel v13.11.0, obtido na 4.2,
é outro pacote: ele fornece os arquivos iniciais do projeto.

O lockfile registra as versões exatas escolhidas, inclusive das bibliotecas que
essas dependências precisam. Sem lockfile, install resolve e cria o registro;
com lockfile, install utiliza as versões registradas. update faz uma nova
resolução; não é necessário para reproduzir esta instalação.

## Primeira instalação executada

Comando na raiz do projeto:

```bash
docker compose run --rm --workdir /instalacao \
  --volume ./backend:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-backend:/instalacao/vendor \
  backend composer install --no-dev --no-scripts --no-interaction --no-progress
```

- run --rm usa um container temporário e o remove quando o comando termina.
- --workdir /instalacao faz o Composer ler o JSON e salvar o lockfile nesse caminho.
- ./backend:/instalacao:rw disponibiliza temporariamente a pasta do projeto com
  escrita. O caminho /app do serviço continua somente leitura. O novo lockfile
  aparece no host como backend/composer.lock.
- O volume existente curso-loja-fullstack_vendor-backend é montado também em
  /instalacao/vendor. É o nome real do volume criado pelo Compose, com o prefixo
  do projeto; não criamos outro volume independente.
- backend escolhe o serviço e composer install substitui seu comando padrão.
- --no-dev deixa de instalar os pacotes de require-dev e omite autoload-dev.
- --no-scripts impede os scripts automáticos do composer.json, como os comandos
  Artisan de descoberta de pacotes e publicação de assets.
- --no-interaction evita perguntas do instalador; --no-progress simplifica a saída.

Saída principal: 109 pacotes registrados no lockfile, 76 instalados e autoload
otimizado gerado. As configurações preferred-install: dist e optimize-autoloader:
true do JSON já orientam download de arquivos distribuídos e geração do carregador.
Não foi necessário mudar o Dockerfile, Compose ou composer.json.

Como o container executou como root, o novo lockfile inicialmente ficou com
proprietário 0:0. Ajustamos somente esse arquivo, usando o proprietário do JSON
como referência:

```bash
docker compose run --rm --workdir /instalacao \
  --volume ./backend:/instalacao:rw \
  backend chown --reference=/instalacao/composer.json /instalacao/composer.lock
```

chown altera o proprietário; --reference copia os identificadores do arquivo
existente. A verificação stat no host confirmou 1000:1000 nos dois arquivos.
Não houve alteração recursiva dos arquivos do aluno.

## Arquivos gerados e relações

| Arquivo ou local | Papel nesta etapa |
| --- | --- |
| backend/composer.json | Configuração existente: requisitos, autoload e scripts. Preservado. |
| backend/composer.lock | Novo registro versionável: 76 pacotes de execução e 33 de desenvolvimento, com versões e referências exatas. |
| Volume vendor-backend | Contém somente os 76 pacotes instalados e os arquivos Composer. Fica no Docker, fora do Git. |
| vendor/autoload.php no container | Entrada do carregador gerado, usada por public/index.php e artisan. |
| vendor/composer/autoload_psr4.php e autoload_classmap.php | Mapeamentos gerados a partir da configuração das classes do projeto e dos pacotes. |
| vendor/composer/installed.json | Registro dos pacotes efetivamente instalados, usado na comparação com o lockfile. |

No lockfile, packages registra as dependências de execução; packages-dev registra
as adicionais de desenvolvimento. Cada pacote tem nome, versão, fontes e
requisitos. content-hash vincula o registro às partes relevantes do JSON;
composer validate verifica se os dois arquivos estão coerentes. Não editamos
essas versões manualmente no arquivo gerado.

--no-dev não elimina packages-dev do lockfile: as 33 dependências adicionais
foram resolvidas e registradas, mas não instaladas. PHPUnit e Pint do backend
ainda estão ausentes. O PHPUnit do laboratório permanece no volume vendor-php,
separado. Laravel Boost também não foi adicionado.

O autoload usa o mesmo conceito estudado no módulo 3. O JSON do backend mapeia
App\\ para app/. Depois de incluir vendor/autoload.php, pedir uma classe de App
faz o carregador localizar seu arquivo. O Laravel também fornece mapeamentos
das próprias classes. O mapeamento de Tests\\ fica adiado por --no-dev.

O volume aparece em /instalacao/vendor durante a instalação e em /app/vendor
nos comandos normais do serviço. O diagnóstico pelo caminho normal confirmou
que o carregador funciona nos dois contextos.

## Verificações executadas

```bash
docker compose run --rm backend composer validate --strict
docker compose run --rm backend composer check-platform-reqs --no-dev
```

- validate --strict retornou código 0 e composer.json válido; o lockfile foi
  aceito como coerente. --strict também trata avisos de validação como falha.
- check-platform-reqs --no-dev conferiu a plataforma real para os pacotes
  instalados: PHP 8.4.26, runtime API do Composer e extensões/requisitos listados
  tiveram success. Alguns requisitos são atendidos por polyfills declarados,
  como mostrado na saída; o diagnóstico não instala drivers SQL Server.

Um script temporário PHP pela entrada padrão verificou também:

```php
$loader = require '/app/vendor/autoload.php';
class_exists('Illuminate\Foundation\Application');
class_exists('App\Http\Controllers\Controller');
```

O diagnóstico conferiu que os dois resultados eram true. require registra o
carregador; class_exists consulta a classe e aciona o autoload se necessário.
A primeira classe vem da biblioteca Laravel e a segunda de backend/app.
Não criamos uma aplicação nem iniciamos seu ciclo de execução nesse diagnóstico.

Também foram conferidos:

- Os 76 pares nome/versão de installed.json são iguais aos de packages do lockfile.
- Versões instaladas: laravel/framework v13.35.0 e laravel/tinker v3.0.2.
- Application::VERSION é 13.35.0; App\\ está mapeado e Tests\\ ausente.
- PHPUnit, Pint e Boost ausentes na instalação do backend.
- backend/.env, SQLite, node_modules e manifests packages.php/services.php ausentes.
- backend/vendor local permanece vazio e ignorado pelo Git; o volume guarda os arquivos.
- Código do laboratório, Compose, Dockerfile e JSON do backend sem alterações.

Esses resultados comprovam a instalação e o autoload; ainda não comprovam uma
requisição HTTP, Artisan, acesso a banco ou execução de testes Laravel.

## Reprodução e próximo passo

Com o lockfile presente, novos clones podem instalar usando a montagem normal:

```bash
mkdir -p backend/vendor
docker compose build backend
docker compose run --rm backend composer install --no-dev --no-scripts --no-interaction
```

O lockfile deve ir ao Git junto com a configuração. Os pacotes do volume podem
ser recriados com install usando as versões registradas.

Implementação e verificações concluídas, explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: dc9f4b8, etapa 4.3.

Depois da confirmação, publicar 4.4 e iniciar 4.5: preparar montagens graváveis
para storage e bootstrap/cache, necessárias para arquivos gerados pelo Laravel,
mantendo o restante do código somente leitura. Ambiente Laravel, chave, Artisan
e primeira requisição serão apresentados nas etapas seguintes. Banco continua
adiado; padrões SQLite do modelo devem ser ajustados antes de usar persistência
ou testes de integração, que usarão SQL Server exclusivo conforme o curso.

Fontes oficiais:

- [Composer install e opções](https://getcomposer.org/doc/03-cli.md#install-i).
- [Lockfile e autoload](https://getcomposer.org/doc/01-basic-usage.md).
- [Faixas de versão com ^](https://getcomposer.org/doc/articles/versions.md#caret-version-range-).
- [Requisitos de gravação do Laravel](https://laravel.com/docs/13.x/deployment#directory-permissions).
