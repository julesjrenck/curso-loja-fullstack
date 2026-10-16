# Aula 5.32 — Ferramentas de testes instaladas

## Objetivo

Instalar no backend as ferramentas de desenvolvimento fixadas no lock.
A 5.31 foi confirmada com "entendi" em 16/10/2026 e publicada em 4233936,
SHA completo 423393609a1e7323c6a2a8240542e80e85f4f266, conferido na main remota.

## Comando executado

Na raiz, com backend ativo:

```bash
docker compose exec -T backend composer install --no-scripts --no-plugins --no-interaction
```

exec executa no container backend existente, com /app como diretório do projeto;
-T dispensa terminal interativo. composer install usa composer.json e as
versões exatas de composer.lock. A instalação inclui require-dev por padrão:
agora não usamos --no-dev, que adiou esses pacotes na 4.4.

--no-scripts dispensa os scripts de composer.json, incluindo post-autoload-dump
que chamaria o Laravel para descobrir pacotes. --no-plugins desativa plugins
do Composer; --no-interaction dispensa perguntas. Não executamos o script
setup, migrations ou comandos de Node/npm.

A instalação terminou código 0, com 33 pacotes adicionados, zero atualizações
e zero remoções. O resultado contém os 76 pacotes de execução anteriores e
33 de desenvolvimento: 109 pacotes correspondentes ao lock.

Entre os pacotes de desenvolvimento estão PHPUnit e suas dependências,
Mockery, Faker e Collision. O Composer também instalou as ferramentas já
declaradas pelo esqueleto, como Pint, Pail e Pao. Não adicionamos novas
declarações ou mudamos versões. Cada ferramenta será aprofundada conforme
seu uso no curso; não executamos seus comandos nesta instalação.

## Onde ficaram os arquivos

Os pacotes ficam em /app/vendor dentro do volume vendor-backend. Composer
gerou o autoload otimizado incluindo o mapeamento de desenvolvimento:

```text
Tests\ → /app/tests
```

Essa regra já existia em autoload-dev de backend/composer.json. Os arquivos
vendor/composer/autoload_psr4.php e demais mapas agora permitem carregar
as classes de testes, além das classes instaladas do PHPUnit. Não precisamos
escrever require para cada classe de teste.

vendor/bin/phpunit é o executável gerado pelo Composer. No host,
backend/vendor é somente o ponto de montagem; os pacotes persistem no volume
Docker e ficam fora do Git. Um novo clone instala as versões pelo lock.

## Verificações

```bash
docker compose exec -T backend php vendor/bin/phpunit --version
docker compose exec -T backend composer check-platform-reqs
```

O primeiro comando carrega o executável em PHP Docker e consulta sua versão:

```text
PHPUnit 12.5.39 by Sebastian Bergmann and contributors.
```

O segundo verifica PHP/extensões exigidos pelos pacotes realmente instalados,
incluindo desenvolvimento. Todos passaram no PHP 8.4.26.

Diagnóstico temporário em PHP Docker comparou cada um dos 109 pacotes de
composer.lock com Composer\InstalledVersions: nomes e versões correspondem.
Conferiu regra Tests em /app/tests, carregamento de PHPUnit\Framework\TestCase
e Tests\TestCase e sua herança. Código 0; carregar as classes não executou
seus métodos de teste, não inicializou a aplicação nem criou conexão SQL.

Hashes de backend/composer.json e composer.lock permaneceram iguais aos de
antes da instalação. Também permaneceram iguais packages.php e services.php
em bootstrap/cache. Como os scripts foram dispensados, não executamos
package:discover nesta etapa; a atualização dos manifests será a próxima aula.

Nenhuma suíte executada. phpunit.xml ainda tem SQLite em memória e não há
.env.testing, acesso próprio ou estrutura preparados em loja_test. Instalar
a ferramenta não conclui a configuração dos testes SQL Server.

## Continuidade

Instalação e explicação apresentadas; versão, plataforma, pacotes e autoload
conferidos. Sem mudanças em código, JSON/lock, configuração SQL, credenciais
ou serviços. git diff --check passou; dependências e autoload ficam no volume.
Entendimento da 5.32 confirmado com "entendi" em 16/10/2026. Documentação local,
sem commit/push desta etapa; último publicado 4233936.

Próximo passo exato após confirmação: publicar 5.32 e iniciar 5.33,
executar package:discover explicitamente, apresentar os manifests gerados e
conferir a ajuda de artisan test. Não executar suíte, criar contas ou configurar
o banco de testes nessa etapa de registro dos pacotes.

Fonte consultada em 16/10/2026:

- [Composer install e opções](https://getcomposer.org/doc/03-cli.md#install-i).
