# Aula 5.33 — Descoberta dos pacotes de desenvolvimento

## Objetivo

Registrar no Laravel os pacotes instalados na 5.32 e abrir a ajuda do comando
de testes. Nenhuma suíte executada nesta etapa.

O Composer já sabe carregar as classes pelo autoload. O Laravel também precisa
saber quais service providers dos pacotes deve carregar. Esses providers
registram serviços e comandos, como nosso AppServiceProvider registra o binding
entre Catalogo e CatalogoEloquent. Pacotes podem declarar seus providers em
extra.laravel.providers no próprio composer.json para descoberta automática.

Na 5.32 usamos --no-scripts: isso dispensou tanto a limpeza de manifests do
ComposerScripts::postAutoloadDump quanto a chamada automática de package:discover.
Nesta aula executamos explicitamente somente a descoberta.

## Comandos e resultados

Com o backend ativo, na raiz do repositório:

```bash
docker compose exec -T backend php artisan package:discover --no-interaction --no-ansi
docker compose exec -T backend php artisan help test --no-ansi
```

exec executa no container backend existente; -T dispensa terminal interativo.
PHP e Artisan executam em /app. package:discover lê os metadados dos pacotes
instalados em vendor/composer/installed.json e reconstrói o manifest de pacotes.
--no-interaction dispensa perguntas; --no-ansi dispensa sequências de cor.

O primeiro comando terminou com código 0. Sua saída listou somente os três
pacotes do manifest anteriormente carregado em memória. A leitura posterior
do arquivo confirmou os seis pacotes gravados: laravel/pail, laravel/pao,
laravel/tinker, nesbot/carbon, nunomaduro/collision e nunomaduro/termwind.
Na versão instalada, build() escreve o arquivo, mas não substitui o array
manifest já carregado no objeto; a listagem do comando usa esse array anterior.
Por isso conferimos o arquivo e usamos outro processo para abrir a ajuda.

O segundo comando terminou com código 0 e mostrou:

```text
Description:
  Run the application tests

Usage:
  test [options]
```

Entre as opções mostradas estão --compact, --coverage, --parallel e --profile.
Exibir a ajuda não executa testes. Também não instalamos suporte adicional
para essas opções nem as executamos nesta aula. O comando test é registrado
pelo CollisionServiceProvider do pacote nunomaduro/collision.

## Arquivos gerados

backend/bootstrap/cache/packages.php associa os seis pacotes descobertos aos
seus providers. Trecho real, com formatação simplificada:

```php
'nunomaduro/collision' => [
    'providers' => [
        'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ],
],
```

backend/bootstrap/cache/services.php organiza o carregamento dos providers,
com as chaves providers, eager, deferred e when. Depois da inicialização em
outro processo, inclui os novos providers de Pail, Pao e Collision.

São arquivos PHP gerados de cache, não configurações para editar manualmente.
Ambos continuam ignorados pelo Git. bootstrap/providers.php permanece com
AppServiceProvider; não precisamos acrescentar os providers descobertos nele.
composer.json e composer.lock permaneceram iguais: nenhum pacote novo instalado.

## Verificações

- Descoberta e ajuda com código 0; seis entradas no manifest de pacotes.
- Pail, Pao e Collision presentes no manifest de serviços.
- php -l passou nos dois manifests.
- SHA256 de composer.json e composer.lock iguais aos anteriores à descoberta.
- GET real de /loja no Docker: HTTP 200, X-Curso: Laravel, título do catálogo
  e um item Camiseta preservados. Essa conferência HTTP não é execução de suíte.
- git check-ignore confirmou exclusão dos manifests, vendor e .env.
- .env.testing continua ausente; phpunit.xml ainda contém SQLite em memória.
- Nenhuma suíte, migration ou seeder executado; nenhuma conta, permissão ou
  configuração SQL alterada. git diff --check passou.

## Continuidade

Implementação e explicação apresentadas; entendimento da 5.33 confirmado
com "entendi" em 16/10/2026. Checkpoint f14a335 publicado; HEAD, origin/main
e main remota conferidos em f14a335a35b2400324020fedc08aeb4c454a8386.

Próximo passo realizado na 5.34: preparar e
explicar o script SQL de uma conta exclusiva de testes, limitada a loja_test.
Somente escrever/revisar o script nessa próxima etapa; criação da conta,
senha local, configuração e estrutura do banco de testes ficam para depois.

Fontes primárias consultadas em 16/10/2026:

- [Laravel: descoberta de pacotes](https://laravel.com/framework/docs/13.x/packages#package-discovery).
- [Laravel: testes](https://laravel.com/framework/docs/13.x/testing).
- Código instalado: Illuminate\Foundation\PackageManifest,
  PackageDiscoverCommand e CollisionServiceProvider, nas versões do lock.
