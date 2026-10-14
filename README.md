# Curso Loja Fullstack

Projeto de estudo acompanhado: uma loja com catálogo, carrinho, pedidos,
estoque e notificações, construída por etapas explicadas e confirmadas pelo aluno.

## Estado atual

Módulo 1 — Preparação, Git e GitHub: concluído.
Módulo 2 — Docker: concluído.
Módulo 3 — PHP moderno e OOP: concluído após a revisão 3.22.
Módulo 4 — Laravel e MVC: concluído após a revisão 4.19.
Módulo 5 — SQL Server e persistência: etapa 5.6, acesso local pelo DBeaver.
O roteiro, os registros de continuidade, as regras de exclusão e a apresentação
do projeto estão criados. O repositório Git local foi inicializado com a branch
`main`. O checkpoint inicial reúne os cinco arquivos de documentação e regras
de exclusão. O histórico local pode ser consultado com `git log --oneline`.
O [repositório público no GitHub](https://github.com/julesjrenck/curso-loja-fullstack)
está configurado como `origin`. A autenticação SSH funcionou, os commits iniciais
foram publicados e a branch local `main` acompanha `origin/main`.

O backend Laravel está executável em `backend/`, com dependências e configuração
local. A página `/loja` apresenta produtos de demonstração em memória;
a persistência em SQL Server será introduzida no módulo 5.
Docker e Compose estão instalados. O serviço `php` constrói a imagem pelo
Dockerfile, inclui Composer 2.10.3 e unzip 6.0-28+deb12u1 e inicia o servidor
PHP 8.4.26 de desenvolvimento.
O Compose monta `./src` em `/app` como somente leitura, permitindo executar
alterações do código local sem reconstruir a imagem. A demonstração responde
em [http://127.0.0.1:8001/](http://127.0.0.1:8001/). Produto implementa a interface
Precificavel, que exige `getPrecoEmCentavos(): int`. ItemCarrinho guarda um Produto
e uma quantidade positiva e calcula o subtotal em centavos. PHPUnit 13.4.1 foi
instalado como dependência de desenvolvimento e verificado no Docker. A etapa
4.2 obteve o esqueleto oficial laravel/laravel v13.11.0 em `backend/`, usando
--no-install e --no-scripts. A estrutura foi apresentada, verificada e confirmada.
Na 4.3, o serviço `backend` foi preparado para comandos PHP/Composer, com código
somente leitura e volume `vendor-backend` exclusivo. Verificações concluídas;
entendimento confirmado. O laboratório permanece em `src/`, com
seu Composer independente.
Na 4.4, as dependências de execução foram instaladas: Laravel 13.35.0 e Tinker
3.0.2, com 76 pacotes no volume vendor-backend. O lockfile foi gerado, validado
e comparado com a instalação; autoload e requisitos conferidos. Entendimento
da 4.4 confirmado. Ambiente local e execução Laravel ainda adiados.
Na 4.5, storage e bootstrap/cache receberam bind mounts graváveis, com código
somente leitura preservado. Escrita, leitura no host e entre containers e limpeza
verificadas. Explicação apresentada; entendimento confirmado.
Na 4.6, backend/.env.example foi adaptado para a loja, sessões/cache em arquivo,
fila síncrona e indicação SQL Server. A cópia backend/.env foi criada localmente
e sua leitura conferida no Docker. Chave e execução Laravel ainda adiadas;
entendimento da 4.6 confirmado.
Na 4.7, Artisan executou no Docker e a APP_KEY local foi gerada, validada e lida
em outro container. Manifests de pacotes e serviços foram gerados em bootstrap/cache.
Chave e manifests ficam fora do Git. Explicação apresentada; entendimento da 4.7
confirmado. Servidor Laravel ainda não iniciado.
Na 4.8, o backend passou a executar Artisan serve, com publicação local em
http://127.0.0.1:8002/. A página welcome respondeu HTTP 200 com título Loja Fullstack;
parada e reinício verificados com init:true. Laboratório continua na porta 8001.
Explicação apresentada; entendimento da 4.8 confirmado.
Na 4.9, GET /loja foi acrescentada em backend/routes/web.php e retorna
"Bem-vindo à Loja Fullstack!", usando config('app.name'). Sintaxe, registro,
resposta HTTP 200 e recusa de POST com 405 conferidos. Página welcome preservada;
explicação apresentada, entendimento da 4.9 confirmado.
Na 4.10, /loja passou a chamar LojaController@index. O controller foi gerado
pelo Artisan e recebeu o método público index(): string com a mesma saudação.
Sintaxe, registro e respostas HTTP conferidos; explicação apresentada,
entendimento da 4.10 confirmado.
Na 4.11, LojaController@index passou a retornar a view loja com nomeLoja como
dado. O template Blade apresenta HTML mínimo com título e saudação. HTTP 200,
dados renderizados e escape de caracteres especiais conferidos; explicação
apresentada, entendimento da 4.11 confirmado.
Na 4.12, o controller passou uma lista demonstrativa com Camiseta, Calça e Tênis;
a view exibe um item HTML por nome usando @foreach. Sintaxe e lista renderizada
conferidas; explicação apresentada, entendimento da 4.12 confirmado.
Os nomes são dados de demonstração em memória.
Na 4.13, a view usa @if/@else para escolher entre a lista e uma mensagem de
ausência de produtos. Renderizações com três itens e sem itens conferidas;
controller preservado, página HTTP 200. Explicação apresentada, entendimento
da 4.13 confirmado.
Na 4.14, MarcarRespostaCurso foi gerado pelo Artisan e aplicado à rota /loja.
Ele acrescenta X-Curso: Laravel após continuar o atendimento. Cabeçalho, escopo
e conteúdo HTTP conferidos; explicação apresentada, entendimento da 4.14 confirmado.
A rota / permanece sem esse cabeçalho.
Na 4.15, os nomes foram movidos para CatalogoDemonstracao::listarNomes(). O método
index recebe essa classe pelo container Laravel e entrega a lista à view.
Sintaxes e resposta HTTP com produtos e middleware conferidas; explicação
apresentada, entendimento da 4.15 confirmado.
Na 4.16, CatalogoDemonstracao passou a ser recebido no construtor e guardado em
uma propriedade privada promovida de LojaController. index consulta $this->catalogo.
Sintaxe e comportamento HTTP preservado conferidos; explicação apresentada,
entendimento da 4.16 confirmado.
Na 4.17, Catalogo declara listarNomes(), CatalogoDemonstracao implementa o contrato
e LojaController recebe a interface no construtor. AppServiceProvider registra o
binding; resolução e HTTP conferidos. Explicação apresentada, entendimento da 4.17
confirmado; dados continuam em memória.
Na 4.18, User.php já gerado foi apresentado como model Eloquent. Uma instância
com nome/e-mail fictícios foi criada e alterada em memória, sem banco ou gravação;
atributos e metadados conferidos. Código da aplicação preservado; explicação
apresentada, entendimento da 4.18 confirmado.
Na 4.19, o fluxo do módulo foi revisado, sem alteração de código. Loja, welcome
e laboratório responderam HTTP 200; dados e middleware conferidos. Revisão
apresentada, entendimento confirmado com "entendi"; módulo 4 concluído.
Na 5.1, arquitetura/recursos Docker, PHP e requisitos Microsoft foram conferidos.
Base definida para o laboratório: SQL Server 2022 Developer, ODBC 18 e drivers
PHP 5.13 (release estável consultada 5.13.3). Diagnóstico favorável; PDO carregada,
sqlsrv/pdo_sqlsrv e ODBC ainda ausentes. Nenhuma dependência ou banco instalado.
Explicação apresentada; entendimento da 5.1 confirmado com "entendi".
Na 5.2, Dockerfile.backend foi criado e ligado ao serviço backend no Compose.
ODBC Driver 18.7.1.1-1 instalado; imagem construída e backend recriado.
Driver registrado, bibliotecas, requisitos Composer e HTTP conferidos.
Laboratório PHP preservado. Extensões PHP e SQL Server seguem pendentes;
explicação apresentada, entendimento da 5.2 confirmado com "entendi".
Na 5.3, Dockerfile.backend acrescenta PIE 1.5.2 e os drivers sqlsrv/pdo_sqlsrv
5.13.3, com dependências de compilação em versões fixas. Imagem construída e
backend recriado; extensões carregadas, PDO com sqlsrv, .ini gerados, plataforma
e HTTP conferidos. SQL Server ainda não introduzido; explicação apresentada,
entendimento da 5.3 confirmado com "entendi", após esclarecimento sobre PIE.
Na 5.4, SQL Server 2022 CU27-GDR1 foi introduzido como serviço sqlserver,
edição Developer, imagem fixada por digest e volume dados-sqlserver.
Senha somente no .env local; modelo público vazio. Inicialização, edição/versão,
consulta SELECT 1, volume e rede conferidos. Servidor 16.0.4305.5 disponível;
bancos da loja/testes e conexão Laravel ainda pendentes. Explicação apresentada,
entendimento da 5.4 confirmado com "entendi", após esclarecimentos sobre acesso.
Na 5.5, docker/sqlserver/criar-bancos.sql preparou loja e loja_test somente
quando ausentes. Ambos ONLINE, com arquivos no volume SQL Server e sem tabelas
da aplicação. Conexão individual e reexecução preservando IDs conferidas;
explicação apresentada, entendimento da 5.5 confirmado com "entendi".
Na 5.6, porta SQL publicada em 127.0.0.1:1433, serviço recriado com bancos
preservados e conexão autenticada pelo endpoint conferida. Dados e instruções
DBeaver apresentados; aluno avisado conforme pedido e relatou "apareceu loja"
na consulta DB_NAME pelo DBeaver. Acesso confirmado; entendimento da 5.6
confirmado depois com "entendi".
Na rede do projeto, outros containers acessam `http://php:8000/`.
O volume `dados-demo`, montado em `/dados`, mantém um contador didático
entre execuções de containers temporários.
O volume `vendor-php`, montado em `/app/vendor`, permite gravar os arquivos
gerados pelo Composer enquanto `/app` mantém o código como somente leitura.
O estado detalhado e atualizado das aulas fica no registro de progresso.

## Documentação

- [Roteiro dos 23 módulos](docs/curso.md)
- [Progresso e ponto de retomada](docs/progresso.md)
- [Instruções para acompanhar o curso](AGENTS.md)
- [Aula 2.2 — Comando do primeiro container PHP](docs/aulas/02-02-primeiro-container.md)
- [Aula 2.3 — Primeiro Dockerfile](docs/aulas/02-03-dockerfile.md)
- [Aula 2.4 — Código PHP dentro da imagem](docs/aulas/02-04-codigo-na-imagem.md)
- [Aula 2.5 — Primeiro Docker Compose](docs/aulas/02-05-compose.md)
- [Aula 2.6 — Código local com bind mount](docs/aulas/02-06-bind-mount.md)
- [Aula 2.7 — Servidor PHP e portas](docs/aulas/02-07-servidor-e-portas.md)
- [Aula 2.8 — Variáveis de ambiente](docs/aulas/02-08-variaveis-de-ambiente.md)
- [Aula 2.9 — .env local e modelo](docs/aulas/02-09-env-e-modelo.md)
- [Aula 2.10 — Volume de dados](docs/aulas/02-10-volume-de-dados.md)
- [Aula 2.11 — Rede entre containers](docs/aulas/02-11-rede-entre-containers.md)
- [Aula 3.1 — Primeira classe de produto](docs/aulas/03-01-produto-tipado.md)
- [Aula 3.2 — Validações e exceções](docs/aulas/03-02-validacao-e-excecoes.md)
- [Aula 3.3 — Promoção de propriedades](docs/aulas/03-03-promocao-de-propriedades.md)
- [Aula 3.4 — Namespace e use](docs/aulas/03-04-namespace-e-use.md)
- [Aula 3.5 — Composer no Docker](docs/aulas/03-05-composer-no-docker.md)
- [Aula 3.6 — Configuração do composer.json](docs/aulas/03-06-composer-json.md)
- [Aula 3.7 — Volume para vendor](docs/aulas/03-07-volume-vendor.md)
- [Aula 3.8 — Autoload do Composer](docs/aulas/03-08-autoload-do-composer.md)
- [Aula 3.9 — Enum de estados de produto](docs/aulas/03-09-enum-status-produto.md)
- [Aula 3.10 — Estado inicial de Produto](docs/aulas/03-10-status-no-produto.md)
- [Aula 3.11 — Ações e encapsulamento](docs/aulas/03-11-acoes-e-encapsulamento.md)
- [Aula 3.12 — Interface Precificavel](docs/aulas/03-12-interface-precificavel.md)
- [Aula 3.13 — Composição com ItemCarrinho](docs/aulas/03-13-composicao-item-carrinho.md)
- [Aula 3.14 — Subtotal do item do carrinho](docs/aulas/03-14-subtotal-item-carrinho.md)
- [Aula 3.15 — Requisitos de PHPUnit](docs/aulas/03-15-requisitos-phpunit.md)
- [Aula 3.16 — Instalação de PHPUnit pelo Composer](docs/aulas/03-16-instalacao-phpunit.md)
- [Aula 3.17 — Primeiro teste PHPUnit](docs/aulas/03-17-primeiro-teste-phpunit.md)
- [Aula 3.18 — Testar a recusa de quantidade zero](docs/aulas/03-18-teste-quantidade-zero.md)
- [Aula 3.19 — Testar a recusa de quantidade negativa](docs/aulas/03-19-teste-quantidade-negativa.md)
- [Aula 3.20 — Testar a menor quantidade válida](docs/aulas/03-20-teste-quantidade-minima.md)
- [Aula 3.21 — Testar um produto com preço zero](docs/aulas/03-21-teste-preco-zero.md)
- [Aula 3.22 — Revisão acompanhada do módulo 3](docs/aulas/03-22-revisao-modulo-3.md)
- [Aula 4.1 — Papel do Laravel e preparação](docs/aulas/04-01-preparacao-laravel.md)
- [Aula 4.2 — Esqueleto Laravel e estrutura](docs/aulas/04-02-esqueleto-laravel.md)
- [Aula 4.3 — Serviço Docker e volume do backend](docs/aulas/04-03-servico-backend-e-vendor.md)
- [Aula 4.4 — Dependências Laravel, lockfile e autoload](docs/aulas/04-04-dependencias-laravel.md)
- [Aula 4.5 — Pastas graváveis do Laravel](docs/aulas/04-05-pastas-gravaveis-laravel.md)
- [Aula 4.6 — Ambiente local do Laravel](docs/aulas/04-06-ambiente-local-laravel.md)
- [Aula 4.7 — Artisan e chave da aplicação](docs/aulas/04-07-artisan-e-chave.md)
- [Aula 4.8 — Servidor Laravel e primeira página](docs/aulas/04-08-servidor-laravel.md)
- [Aula 4.9 — Primeira rota da loja](docs/aulas/04-09-primeira-rota-loja.md)
- [Aula 4.10 — Primeiro controller da loja](docs/aulas/04-10-primeiro-controller.md)
- [Aula 4.11 — Primeira view Blade da loja](docs/aulas/04-11-primeira-view-blade.md)
- [Aula 4.12 — Lista de produtos com Blade](docs/aulas/04-12-lista-produtos-blade.md)
- [Aula 4.13 — Condição para lista vazia](docs/aulas/04-13-lista-vazia-blade.md)
- [Aula 4.14 — Primeiro middleware da loja](docs/aulas/04-14-primeiro-middleware.md)
- [Aula 4.15 — Injeção de dependência no controller](docs/aulas/04-15-injecao-dependencia.md)
- [Aula 4.16 — Injeção pelo construtor](docs/aulas/04-16-injecao-construtor.md)
- [Aula 4.17 — Contrato e binding do catálogo](docs/aulas/04-17-contrato-e-binding.md)
- [Aula 4.18 — Papel do Model em MVC](docs/aulas/04-18-papel-model.md)
- [Aula 4.19 — Revisão do módulo 4](docs/aulas/04-19-revisao-modulo-4.md)
- [Aula 5.1 — Preparação para SQL Server](docs/aulas/05-01-preparacao-sql-server.md)
- [Aula 5.2 — ODBC na imagem do backend](docs/aulas/05-02-odbc-backend.md)
- [Aula 5.3 — Extensões PHP para SQL Server](docs/aulas/05-03-extensoes-sql-server.md)
- [Aula 5.4 — Serviço SQL Server no Docker](docs/aulas/05-04-servico-sql-server.md)
- [Aula 5.5 — Bancos da loja e dos testes](docs/aulas/05-05-criacao-bancos.md)
- [Aula 5.6 — Acesso local pelo DBeaver](docs/aulas/05-06-acesso-dbeaver.md)

## Backend Laravel

Os arquivos iniciais estão em `backend/`. A versão do esqueleto foi fixada em
v13.11.0; `backend/composer.json` declara `laravel/framework` ^13.17. A resolução
gerou backend/composer.lock com Laravel 13.35.0 e Tinker 3.0.2. O autoload App
aponta para app/. O ambiente backend/.env foi preparado localmente, ignorado
pelo Git. APP_KEY local gerada e validada; servidor Laravel ativo na porta 8002.

A aula 4.2 apresenta os arquivos gerados. O serviço `backend` agora usa
Dockerfile.backend e monta `./backend:/app:ro`, com `vendor-backend:/app/vendor`
gravável. A pasta local backend/vendor é somente um ponto de montagem vazio,
ignorado pelo Git. O volume guarda os 76 pacotes de execução e o autoload.
As pastas locais backend/storage e backend/bootstrap/cache estão montadas
separadamente nos mesmos caminhos sob /app, com escrita. Os arquivos gerados
ficam no host; os .gitignore do modelo preservam somente a estrutura versionada.

Para preparar o serviço e instalar as versões registradas no lockfile, na raiz:

Prepare primeiro o .env da raiz e sua senha SQL Server conforme a
[aula 5.4](docs/aulas/05-04-servico-sql-server.md#modelo-público-e-configuração-local).
O Compose exige esse campo mesmo quando o comando executa somente o backend.

```bash
mkdir -p backend/vendor
cp --update=none -- backend/.env.example backend/.env
chmod 600 backend/.env
docker compose config --quiet
docker compose build backend
docker compose run --rm backend php --version
docker compose run --rm backend composer --version
docker compose run --rm backend composer install --no-dev --no-scripts --no-interaction
docker compose run --rm backend composer validate --strict
docker compose run --rm backend composer check-platform-reqs --no-dev
```

O comando padrão agora inicia o servidor Laravel. Nos diagnósticos acima,
php --version e composer --version substituem esse padrão para consultar
PHP 8.4.26 e Composer 2.10.3 e terminar o container temporário.
A aula 4.3 explica as montagens e a verificação da persistência. A 4.4 explica
a primeira resolução com montagem temporária gravável para criar o lockfile.
Agora install usa as versões registradas; --no-dev adia ferramentas de
desenvolvimento e --no-scripts adia comandos automáticos do Laravel.
O lock registra também 33 pacotes de desenvolvimento, ainda não instalados.
Storage e bootstrap/cache já estão graváveis, mantendo o código somente leitura,
conforme a aula 4.5. Na 4.6, o ambiente foi preparado para sessões/cache em arquivo
e tarefas síncronas; DB_CONNECTION=sqlsrv indica o banco futuro, ainda sem conexão.
APP_URL=http://127.0.0.1:8002 corresponde à publicação local preparada na 4.8.
Artisan já foi verificado com Laravel Framework 13.35.0 na aula 4.7.
A aula 5.2 acrescenta ODBC Driver 18.7.1.1-1 à imagem própria do backend;
a aula 5.3 instala e habilita sqlsrv/pdo_sqlsrv 5.13.3 com PIE 1.5.2.

Na raiz, .env serve ao Compose; em backend, .env é lido pelo Laravel. O comando
cp acima usa GNU cp e preserva um backend/.env já existente. chmod 600 restringe
a leitura e escrita ao proprietário no host. A cópia local não vai ao Git;
o modelo .env.example pode ser versionado sem credenciais.

Para consultar o Artisan:

```bash
docker compose run --rm backend php artisan --version
docker compose run --rm backend php artisan help key:generate
```

Para gerar a chave somente se estiver vazia, preservando um ambiente existente:

```bash
docker compose run --rm -T --volume ./backend/.env:/app/.env:rw backend php <<'PHP'
<?php
require '/app/vendor/autoload.php';
$ambiente = Dotenv\Dotenv::parse(file_get_contents('/app/.env'));
if (($ambiente['APP_KEY'] ?? '') === '') {
    passthru('php artisan key:generate --no-interaction', $status);
    exit($status);
}
echo "APP_KEY existente preservada." . PHP_EOL;
PHP
```

A montagem temporária permite gravar somente o arquivo de ambiente. A aula 4.7
explica a guarda, o comando e as verificações de criptografia sem exibir a chave.
O modelo continua com APP_KEY vazia; cada ambiente prepara sua própria chave.

Depois de preparar a chave, para iniciar o backend e acompanhar o servidor:

```bash
docker compose up -d backend
docker compose ps
docker compose logs --tail 10 backend
```

Acesse [http://127.0.0.1:8002/](http://127.0.0.1:8002/): página inicial welcome
do modelo Laravel, com título Loja Fullstack. O serviço usa php artisan serve
em 0.0.0.0:8000 dentro do container e publica 127.0.0.1:8002 no host.
init:true encaminha sinais aos processos; stop_signal:SIGINT permite interromper
o servidor. --tries=1 mantém a porta definida e --no-reload desativa reinício
automático por mudanças no .env. Ao mudar o ambiente, reinicie o backend.

Para parar e iniciar novamente:

```bash
docker compose stop backend
docker compose up -d backend
```

Views compiladas e sessões são geradas no storage local, ignoradas pelo Git.
A aula 4.8 explica o caminho da requisição. A primeira rota própria está em
[http://127.0.0.1:8002/loja](http://127.0.0.1:8002/loja): página HTML com título
Loja Fullstack e saudação. A aula 4.9 apresentou sua resposta inicial em string;
a 4.10 moveu o atendimento para LojaController@index. A rota continua apontando
para esse método; na 4.11 ele passou a retornar view('loja', ['nomeLoja' => ...]).
O template está em backend/resources/views/loja.blade.php e usa {{ $nomeLoja }}.
Na 4.12, o controller também envia produtos como array de nomes demonstrativos;
@foreach na view gera um li para cada nome. Na 4.13, @if/@else passou a mostrar
uma mensagem quando produtos for vazio. O controller mantém os três exemplos;
o caso vazio foi conferido com dados temporários de renderização. Na 4.14, a rota
/loja recebeu MarcarRespostaCurso, que adiciona X-Curso: Laravel à resposta HTTP.
O conteúdo da página permanece igual. Na 4.15, CatalogoDemonstracao
passou a fornecer os nomes por listarNomes(); index recebe o objeto por parâmetro
tipado, resolvido pelo container Laravel. Na 4.16, essa entrega foi movida para
o construtor, com private CatalogoDemonstracao $catalogo promovido; index usa
$this->catalogo. Na 4.17, o tipo recebido passou a ser App\Contracts\Catalogo;
AppServiceProvider::register liga esse contrato a CatalogoDemonstracao com bind.
A aula 4.18 apresenta o papel do Model pelo User já gerado, com atributos em
memória e sem consultas/gravação. Ele não foi ligado à página /loja; os nomes
continuam no catálogo demonstrativo. A revisão 4.19 foi confirmada e o módulo 4
concluído. O diagnóstico 5.1 para SQL Server foi confirmado; o próximo passo
foi realizado na 5.2: imagem própria do backend com ODBC Driver 18 construída
e aplicada. Na 5.3, sqlsrv/pdo_sqlsrv foram instaladas e carregadas no backend.
Na 5.4, o serviço SQL Server 2022 Developer foi iniciado e conferido.
Na 5.5, loja/loja_test foram criados e conferidos, ainda sem tabelas da aplicação.
Na 5.6, endpoint local 127.0.0.1:1433 publicado e conferido; conexão pelo
DBeaver pode ser configurada conforme a aula. Após confirmação, preparar
login/usuário próprios da aplicação na 5.7.
Conexão Laravel e catálogo persistido seguem pendentes.

## Executar o SQL Server local

O serviço SQL Server pode ser iniciado pela imagem fixada, depois de preparar
a configuração local descrita na aula 5.4:

```bash
docker compose pull sqlserver
docker compose up -d --no-deps sqlserver
docker compose ps
```

Os containers do projeto acessam sqlserver:1433 na rede interna. O volume
dados-sqlserver guarda os arquivos de /var/opt/mssql. Para criar os bancos
loja/loja_test em outro ambiente, após o servidor aceitar conexões:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -l 5 -b' < docker/sqlserver/criar-bancos.sql
```

A aula 5.5 explica os comandos e a preservação de bancos existentes. A conexão
Laravel será preparada depois. Para DBeaver no computador, use 127.0.0.1:1433,
banco loja, usuário sa e valor de MSSQL_SA_PASSWORD do .env local. Marque Trust
Server Certificate para o certificado local; a aula 5.6 explica as opções
encrypt=true/trustServerCertificate=true e o teste de conexão.

## Executar a demonstração do laboratório PHP

Na raiz do projeto, crie a configuração local a partir do modelo. No Linux com
GNU cp, o comando abaixo preserva um `.env` já existente:

```bash
cp --update=none .env.example .env
```

Antes de executar Compose em outro clone, prepare MSSQL_SA_PASSWORD no .env
local usando o [comando PHP em Docker da aula 5.4](docs/aulas/05-04-servico-sql-server.md#modelo-público-e-configuração-local).
Ele gera senha aleatória se o campo estiver vazio e preserva um valor existente.
Nesta sessão a senha já foi preparada e o arquivo está ignorado pelo Git.

Edite o nome da aplicação no `.env`, se desejar. Depois:

```bash
mkdir -p src/vendor
docker compose config --quiet
docker compose up -d --build php
docker compose run --rm php composer install --no-interaction
```

`src/vendor` é a pasta local vazia que prepara o ponto de montagem do volume
gravável dentro do bind mount somente leitura. Ela é ignorada pelo Git;
os arquivos desse volume são armazenados pelo Docker.
`install` lê composer.lock, instala as versões registradas, incluindo ferramentas
de desenvolvimento, e gera o autoload. As dependências e o carregador ficam no
volume vendor-php; composer.json e composer.lock ficam no código versionado.
Ao alterar somente o mapeamento do autoload, use `composer dump-autoload`.

Acesse [http://127.0.0.1:8001/](http://127.0.0.1:8001/). A resposta é texto simples
com o nome da aplicação, uma mensagem e a versão do PHP. O serviço recebe
APP_NAME por interpolação da configuração local e o script lê seu valor com
`getenv`. O modelo usa `Loja Fullstack`; seu `.env` pode definir outro nome.
Ao editar apenas o script, atualize a página. Mudanças na configuração Compose
precisam ser aplicadas com `docker compose up -d php`; mudanças na imagem exigem
build. Mudanças no `.env` também precisam de `up`. Consulte as aulas 2.7 a 2.9
para a explicação das portas e da configuração.

Para acompanhar e parar o serviço:

```bash
docker compose ps
docker compose logs --tail 10 php
docker compose stop php
```

## Demonstração de persistência

Para executar a demonstração de persistência pelo terminal:

```bash
docker compose run --rm php php contador.php
```

Cada execução incrementa `/dados/contador.txt` no volume nomeado. O contador
recusa acesso HTTP; o servidor principal permanece disponível. Os dados ficam
no armazenamento Docker local, fora do Git. Consulte a aula 2.10 para detalhes.

## Demonstração de rede

Para verificar a comunicação a partir de outro container do projeto:

```bash
docker compose run --rm php php rede.php
```

O diagnóstico resolve `php` pelo DNS da rede e consulta `http://php:8000/`.
O navegador do computador continua usando `http://127.0.0.1:8001/`.

## Demonstração de OOP

Para criar um objeto de produto e consultar seus dados:

```bash
docker compose run --rm php php exemplo-produto.php
```

O exemplo cria uma camiseta válida de 4990 centavos, ativa por padrão, e uma
calça com estado Inativo explícito. Desativa e ativa a camiseta por métodos
públicos, exibindo os estados e mostrando que a calça continua inativa.
Também trata uma tentativa de preço negativo.
A classe recusa nome vazio ou composto apenas
pelos espaços de `trim`, e preço negativo; preço zero é permitido. Consulte as
aulas 3.1 a 3.4 para a estrutura, as regras e a organização da classe, e a
aula 3.8 para seu carregamento automático.
A aula 3.10 apresenta a propriedade StatusProduto, o argumento opcional do
construtor e o getter que retorna um caso do enum.
A aula 3.11 apresenta `ativar(): void` e `desativar(): void`, que alteram
a propriedade privada do objeto em que são chamados.
A classe tem o nome completo `Loja\Produto`; `use` permite o nome curto no
exemplo, e `require_once` carrega `vendor/autoload.php`. O Composer localiza
`Produto.php` quando o PHP precisa da classe.

## Demonstração de item do carrinho

Para criar um item com três camisetas e consultar seu subtotal:

```bash
docker compose run --rm php php exemplo-item-carrinho.php
```

O script salvo em `src/exemplo-item-carrinho.php` cria Produto e ItemCarrinho.
O método `getSubtotalEmCentavos()` calcula 4990 x 3 e devolve 14970 centavos.
O exemplo é exclusivo do terminal. Consulte as aulas 3.13 e 3.14.

## Demonstração de enum

Para consultar o caso e o texto associado a um estado de produto:

```bash
docker compose run --rm php php exemplo-status-produto.php
```

O exemplo usa `StatusProduto::Ativo` e mostra `Caso: Ativo` e `Valor: ativo`.
O enum oferece os casos Ativo e Inativo; cada um tem um valor textual associado.
Ele é carregado pelo mesmo autoload, sem regeneração quando o mapeamento PSR-4
permanece igual. Produto agora usa esse enum como propriedade privada,
com Ativo como padrão do construtor e consulta por `getStatus()`.
Consulte a aula 3.9 para a diferença entre caso e string.

## Composer no Docker

Para construir a imagem atual e consultar a versão do Composer:

```bash
mkdir -p src/vendor
docker compose build php
docker compose run --rm php composer --version
```

A imagem inclui Composer 2.10.3, executado com PHP 8.4.26. A aula 3.5 explica
a cópia do executável de uma imagem externa. Para aplicar uma nova imagem ao
servidor existente, use `docker compose up -d php`.

O arquivo `src/composer.json` aparece como `/app/composer.json` no container.
Ele declara PHP `^8.4` e o mapeamento PSR-4 de `Loja` para a pasta atual.
Para validar essa configuração:

```bash
docker compose run --rm php composer validate
```

A validação retorna código 0, com aviso de licença não declarada. Na etapa 3.6,
ainda não havia bibliotecas externas instaladas ou `composer.lock`. Consulte a aula 3.6
para a explicação dos campos e dos caminhos. Para gerar o autoload:

```bash
docker compose run --rm php composer dump-autoload
```

O Compose monta o volume nomeado `vendor-php` em `/app/vendor`. Sua gravação
e persistência entre containers foram verificadas na aula 3.7; `/app` permanece
somente leitura. O autoload está nesse volume e é usado pelo exemplo de produto.
Os arquivos gerados não vão ao GitHub; a configuração e o comando permitem
recriá-los. A aula 3.8 apresenta sua estrutura.

## Verificar PHPUnit

```bash
docker compose run --rm php php vendor/bin/phpunit --version
```

A saída verificada é PHPUnit 13.4.1. A instalação e os arquivos gerados são
explicados na aula 3.16. Para executar os testes atuais:

```bash
docker compose run --rm php php vendor/bin/phpunit \
  --bootstrap vendor/autoload.php tests/ItemCarrinhoTest.php
```

Os testes conferem os subtotais para uma e três camisetas de 4990 centavos,
esperados 4990 e 14970, o subtotal zero de um produto gratuito e a recusa das
quantidades 0 e -1 com InvalidArgumentException.
Resultado verificado: `OK (5 tests, 5 assertions)`. A aula 3.17 explica herança,
asserção e bootstrap; a 3.18 apresenta expectException e ::class; a 3.19 mostra
por que testar também um valor negativo; a 3.20 verifica a menor quantidade válida
e a 3.21 verifica o menor preço permitido.

## Tecnologias planejadas


- PHP 8.4 e Laravel 13.
- JavaScript, React, TypeScript e Next.js 16.
- Node.js 24 LTS para o serviço de notificações.
- SQL Server, Redis e RabbitMQ.
- Docker para desenvolvimento e testes.
- AWS: S3, SNS, SQS, ECR, ECS, Fargate e RDS.

As tecnologias serão adicionadas conforme as aulas, começando por um ambiente
PHP mínimo e evoluindo gradualmente até microsserviços.

## Como acompanhar

Cada etapa apresenta um objetivo, uma pequena alteração, a explicação dos
arquivos e uma verificação. A próxima etapa começa após a confirmação de
entendimento do aluno. Dúvidas e checkpoints são registrados para retomada
em outros chats.

O `.env` contém configurações locais e fica fora do Git e do contexto de build.
O `.env.example` é o modelo versionado e usa apenas valores de exemplo, sem
credenciais reais. Arquivos de lock serão versionados com as ferramentas
correspondentes para permitir instalações reproduzíveis.
