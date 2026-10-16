# Aula 5.31 — Preparação dos testes do backend

## Objetivo

Conferir o que falta para testar o catálogo com dados isolados no SQL Server.
A 5.30 foi confirmada com "entendi" em 16/10/2026 e publicada em 8a61f8d,
SHA completo 8a61f8da568429203aeb75cdecd3576ca682cbc6, conferido na main remota.
Nesta etapa fizemos somente diagnóstico e documentação.

## Por que preparar testes de integração

As verificações anteriores consultaram a Camiseta que existe em loja. Para
testar o catálogo de forma repetível, precisaremos criar dados conhecidos
e conferir o resultado esperado, incluindo:

- produtos ativos aparecendo e inativos ficando fora;
- vários nomes inseridos fora de ordem retornando ordenados;
- ausência de produtos ativos retornando array vazio.

Esse teste envolve serviço CatalogoEloquent, model Produto e SQL Server
trabalhando juntos: é um teste de integração. O banco exclusivo será loja_test.
Os testes poderão preparar e limpar seus dados ali, mantendo o catálogo de
loja separado. Não executamos esses cenários nesta preparação.

## Ferramentas existentes e ausentes

backend/composer.json já declara phpunit/phpunit em require-dev, com faixa
^12.5.12. backend/composer.lock fixa PHPUnit 12.5.39 e outros pacotes de
desenvolvimento. A instalação da 4.4 usou --no-dev, por isso esses pacotes
ainda não estão no volume vendor-backend.

Diagnóstico em PHP Docker leu JSON/lock, consultou Composer\InstalledVersions
e existência do executável. Resultado:

| Item | Resultado |
| --- | --- |
| PHP do backend | 8.4.26 |
| Pacotes de desenvolvimento no lock | 33 |
| PHPUnit | 12.5.39 no lock, ausente da instalação |
| vendor/bin/phpunit | Ausente |
| PHPUnit\Framework\TestCase | Classe ausente do autoload atual |
| Faker | v1.24.1 no lock, não instalado |
| Collision | v8.9.5 no lock, não instalado |

O PHPUnit 13.4.1 do laboratório PHP pertence a outro Composer/volume.
O backend tem seu próprio lock e seguirá a versão dele; não precisamos
atualizá-lo para a versão do laboratório.

## Plataforma e simulação

Na raiz, executamos:

```bash
docker compose exec -T backend composer check-platform-reqs --lock --format=json
docker compose exec -T backend composer install --dry-run --no-scripts --no-plugins --no-interaction
```

exec usa o container backend; -T dispensa terminal interativo. O primeiro
comando verifica PHP/extensões exigidos pelos pacotes do lock, incluindo
desenvolvimento; --format=json organiza a saída. Todos os requisitos passaram.
PHPUnit exige PHP >=8.3, atendido pelo 8.4.26. DOM, filter, JSON, libxml,
mbstring e XMLWriter também conferidos; drivers SQL Server disponíveis.

O segundo comando simula a instalação do lock com require-dev incluído.
--dry-run mostra o plano sem instalar; --no-scripts dispensa scripts do
projeto; --no-plugins desativa plugins; --no-interaction dispensa perguntas.
Plano observado: 33 instalações, zero atualizações, zero remoções, código 0.
Uma conferência depois confirmou PHPUnit e executável ainda ausentes.
Nenhum install efetivo ou update foi executado.

## Configuração de testes do esqueleto

backend/phpunit.xml foi lido e sua estrutura XML validada. Ele define as
suítes Unit e Feature, bootstrap vendor/autoload.php e APP_ENV=testing.
Por enquanto, as variáveis de banco nele são:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Esses valores são do arquivo de testes, não da conexão atual da página.
SQLite :memory: é um banco temporário em memória. Nosso projeto usa SQL
Server exclusivo para integração, então essa configuração será adaptada
em uma etapa própria antes dos testes de banco. APP_ENV=testing sozinho
não seleciona automaticamente loja_test.

O XML também escolhe sessão/cache em array. A futura configuração local
poderá usar .env.testing, conforme o Laravel. Esse arquivo está ausente,
assim como bootstrap/cache/config.php: não há cache de configuração ativo.
As credenciais de teste ainda precisam ser preparadas localmente e ignoradas
pelo Git; não as colocaremos no XML público.

Os arquivos gerados também foram apresentados:

- tests/Unit/ExampleTest.php usa PHPUnit\Framework\TestCase e verifica true;
- tests/TestCase.php estende a base de testes Laravel;
- tests/Feature/ExampleTest.php usa essa base e verifica HTTP 200 em /.

São exemplos existentes, sem teste do catálogo. Não foram executados nesta
etapa. O mapeamento autoload-dev Tests aponta para tests/ no Composer.

## Banco exclusivo e acesso

Leituras de metadados conferiram:

| Item | Resultado |
| --- | --- |
| loja_test | ONLINE |
| Tabelas de usuário em loja_test | 0 |
| Usuários SQL adicionais em loja_test | 0 |
| Acesso de loja_app a loja_test | 0, sem acesso |
| Acesso de loja_migracoes a loja_test | 0, sem acesso |

O PHP Docker consultou DB_NAME, SUSER_SNAME e HAS_DBACCESS pelas duas conexões
existentes; ambas continuam em loja. Um sqlcmd no container SQL Server leu
sys.tables e sys.database_principals em loja_test com a conta administrativa
já existente. A senha foi passada por SQLCMDPASSWORD dentro do container,
sem impressão. Nenhuma conta, permissão, tabela ou dado foi criado/alterado.

O banco existir não significa que os testes já conseguem usá-lo. Precisaremos
de acesso próprio, ambiente apontando para loja_test e estrutura de produtos
nesse banco. Esses itens continuam pendentes.

## Continuidade

Diagnóstico e explicação apresentados. Plataforma, simulação, XML e metadados
conferidos; nenhum teste executado ou dependência instalada. Sem mudanças de
código/configuração, migrations, credenciais ou serviços. git diff --check passou.
Entendimento da 5.31 confirmado com "entendi" em 16/10/2026. Checkpoint
4233936 publicado; HEAD, origin/main e main remota conferidos no SHA
423393609a1e7323c6a2a8240542e80e85f4f266.

Próximo passo realizado na 5.32: instalar as dependências de desenvolvimento já fixadas no lock do backend
com composer install --no-scripts --no-plugins --no-interaction, sem update.
Verificar versão do PHPUnit, plataforma e autoload de testes; não executar
suíte, criar contas ou configurar/aplicar banco de testes nessa instalação.

Fontes consultadas em 16/10/2026:

- [Ambiente de testes Laravel 13](https://laravel.com/docs/13.x/testing#environment).
- [Requisitos PHPUnit 12.5](https://docs.phpunit.de/en/12.5/installation.html#requirements).
- [Composer install e simulação](https://getcomposer.org/doc/03-cli.md#install-i).
