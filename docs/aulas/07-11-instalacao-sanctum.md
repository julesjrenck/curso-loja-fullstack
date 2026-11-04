# Aula 7.11 — Instalação do pacote Sanctum

Instalação, explicação e verificações em 04/11/2026, após confirmação da 7.10
com "entendi". Checkpoint anterior publicado e conferido em
63c0f1eafb1b33a9e5591aae2d8617aa1890a4c6; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.11 confirmado com "entendi" em 04/11/2026.

## Objetivo e compatibilidade

Adicionar somente laravel/sanctum às dependências do backend. Conferimos PHP
8.4.26, Composer 2.10.3 e os metadados da versão estável v4.3.3. Ela exige PHP
^8.2/ext-json e aceita componentes Illuminate ^11|^12|^13 e Symfony Console
^7|^8, compatíveis com a resolução atual e Laravel 13.35.0.

Consultas feitas no Docker:

```sh
docker compose exec -T backend composer show laravel/sanctum --all --no-interaction --no-plugins
docker compose exec -T backend composer show laravel/sanctum 4.3.3 --all --no-interaction --no-plugins
```

show consulta informações; a segunda consulta seleciona a versão exata.
Antes de instalar, repetimos o require abaixo com --dry-run: resolveu somente
Sanctum v4.3.3, sem atualizar/remover pacotes. Hashes e Git confirmaram que a
simulação preservou composer.json e lock.

## Comando aplicado

```sh
docker compose run --rm --no-deps --workdir /instalacao \
  --volume ./backend:/instalacao:rw \
  --volume curso-loja-fullstack_vendor-backend:/instalacao/vendor \
  backend composer require 'laravel/sanctum:^4.3.3' \
  --no-scripts --no-plugins --no-interaction --no-progress
```

run cria um container temporário do serviço backend; --rm o remove ao terminar;
--no-deps evita iniciar outros serviços. --workdir seleciona /instalacao como
diretório de trabalho. A primeira montagem permite escrita nos arquivos do
backend nesse caminho, como já fizemos na 4.4. A segunda compartilha o volume
vendor-backend existente; o serviço normal continua vendo esses pacotes em
/app/vendor. Não mudamos o [Compose](../../compose.yaml).

require adiciona a dependência e resolve/instala seu pacote. ^4.3.3 permite
versões a partir de 4.3.3 e abaixo de 5.0.0. --no-scripts dispensa os scripts
do projeto, incluindo post-autoload-dump/package:discover e a publicação de
assets. --no-plugins desativa plugins do Composer. --no-interaction dispensa
perguntas, e --no-progress simplifica a saída.

A instalação terminou código 0: uma adição, zero atualizações e zero remoções.
A instalação ficou no pacote e no autoload, sem executar install:api,
publicar configuração, habilitar statefulApi ou aplicar migrations.
A instalação do pacote e sua descoberta pelo Laravel permanecem checkpoints distintos.

## Arquivos e locais envolvidos

| Arquivo/local | Resultado |
| --- | --- |
| [composer.json](../../backend/composer.json) | Uma linha nova em require: laravel/sanctum com faixa ^4.3.3 |
| [composer.lock](../../backend/composer.lock) | v4.3.3 fixada, metadados/requisitos/referência e content-hash atualizado |
| Volume vendor-backend | Pacote em laravel/sanctum e mapas de autoload gerados pelo Composer |
| vendor/autoload.php | Continua sendo a entrada do carregador PHP; agora encontra Laravel\Sanctum\Sanctum |
| bootstrap/cache/packages.php e services.php | Mesmos hashes de antes; descoberta do novo provider ainda pendente |

O lock registra a referência fee27a573d1a013af3721d86153a65e0b11927e6.
Comparação estruturada com o checkpoint anterior confirmou que todos os 109
pacotes anteriores mantiveram seus registros, inclusive versões e referências.
Agora são 110 pacotes reais no lock e em vendor/composer/installed.json.
composer.json/lock mantiveram proprietário 1000:1000; não foi necessário chown.

O pacote declara Laravel\Sanctum\SanctumServiceProvider para descoberta.
Seu código pode ser carregado pelo autoload, mas laravel/sanctum ainda não está
no manifest de pacotes existente. Não executamos package:discover: instalamos
arquivos e preparamos autoload, sem concluir o registro do pacote na aplicação.
Os arquivos de vendor e manifests continuam fora do Git.

## Validação e suíte

```sh
docker compose exec -T backend composer validate --strict
docker compose exec -T backend composer check-platform-reqs
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

validate verificou a coerência de JSON/lock; check-platform-reqs verificou PHP
e extensões efetivos. Ambos passaram. Diagnóstico PHP no caminho normal /app
conferiu InstalledVersions, versão/referência do Sanctum e carregamento de sua
classe. Comparação de todos os 110 pacotes instalados com o lock não encontrou
divergências de nomes, versões ou referências.

A suíte existente passou: 67 testes/635 asserções, código 0. Não criamos novos
testes nesta instalação. Isso verifica os comportamentos já cobertos, sem
comprovar um fluxo de autenticação Sanctum ainda não configurado.

Depois da suíte, consultas em loja_test/loja_testes confirmaram as seis tabelas
existentes, quatro migrations/lotes 1/2/3/4 e zero users/tokens/sessions/produtos/
categorias. Nenhuma tabela de tokens pessoais foi criada. Snapshot do banco
normal e quatro contratos não foram repetidos.

## Aviso existente identificado pelo Composer

A simulação informou um aviso de segurança. Antes da instalação real, com os
arquivos ainda idênticos ao checkpoint anterior, executamos:

```sh
docker compose exec -T backend composer audit --locked --format=json --no-interaction --no-plugins
```

Retornou código 1: symfony/mime v8.1.7, CVE-2026-45070, severidade medium.
O componente já estava nessa versão; não foi introduzido pelo Sanctum.
A instalação também informou um aviso. Não afirmar que a auditoria passou.
A [publicação oficial do Symfony](https://symfony.com/cve-2026-45070) informa
correção na linha 8.1 a partir de 8.1.10 para a falha de validação de nomes de
parâmetros em cabeçalhos MIME. A correção fica como próximo checkpoint próprio,
preservando a pequena alteração de instalação combinada nesta aula.

Atualização posterior: o aviso foi corrigido na
[aula 7.12](07-12-atualizacao-seguranca-mime.md), com auditoria código 0.

Fontes: [Composer require e opções](https://getcomposer.org/doc/03-cli.md#require-r)
e [Sanctum](https://laravel.com/docs/13.x/sanctum).

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.12 — verificar e aplicar a atualização mínima compatível de symfony/mime
para corrigir o aviso existente, repetindo auditoria e verificações pertinentes.
A descoberta do Sanctum fica após essa manutenção; não foi iniciada nesta aula.
Instalação explicada/verificada e entendimento confirmado. Checkpoint
publicado em 0cf2c8278c19db2711cebc7e40830bbde61c965a;
HEAD/origin/main/main remota conferidos iguais após push. Registro posterior.
