# Aula 5.38 — Configuração PHPUnit para SQL Server

## Objetivo e estado

Alinhar phpunit.xml ao ambiente de testes preparado nas etapas anteriores.
Implementação e explicação em 19/10/2026; entendimento confirmado com "entendi"
após esclarecer a seleção do arquivo .env.testing.
Configuração verificada sem executar casos de teste ou criar tabelas.

A 5.37 foi confirmada com "entendi" e publicada em d80d241. HEAD, origin/main
e consulta direta à main remota retornaram
d80d24172b92045f93f0e9fd3fe1a2fd32bfdf91 após o push.

## Alteração no arquivo

backend/phpunit.xml recebeu somente estas duas mudanças:

```xml
<env name="DB_CONNECTION" value="sqlsrv"/>
<env name="DB_DATABASE" value="loja_test"/>
```

Antes os valores eram sqlite e :memory:, configuração de um banco SQLite
temporário em memória. Agora DB_CONNECTION seleciona a conexão sqlsrv de
config/database.php e DB_DATABASE aponta para o banco exclusivo loja_test.

env representa uma variável de ambiente; name informa seu nome e value,
seu valor. O arquivo XML é configuração do PHPUnit, e não um script PHP.
O trecho fica dentro de php, que reúne as configurações aplicadas ao processo
PHP dos testes. As entradas não têm force, portanto não sobrescrevem variáveis
já exportadas; o diagnóstico conferiu os valores efetivos no Docker atual.

APP_ENV já estava definido como testing. Quando PHPUnit prepara o processo
e o teste inicializa Laravel, esse ambiente permite selecionar .env.testing.
O arquivo local fornece host, porta, usuário, senha e chave. Senha e chave não
foram colocadas no XML nem no Git. DB_URL vazio e demais opções foram preservados.

A relação entre os arquivos fica:

1. phpunit.xml prepara as variáveis para a execução dos testes.
2. APP_ENV testing permite ao Laravel selecionar .env.testing.
3. config/database.php usa essas variáveis para montar a conexão sqlsrv.
4. A conexão autentica como loja_testes no banco loja_test.

O restante do XML continua como veio do modelo: bootstrap aponta para
vendor/autoload.php; testsuites indica as pastas tests/Unit e tests/Feature;
source delimita app como código da aplicação para análise de cobertura.
Nesta aula conferimos a configuração; os testes existentes serão apresentados
e executados na próxima etapa.

## Verificações realizadas

PHP 8.4.26 e Composer 2.10.3 conferidos no backend Docker. O XML foi validado
por DOMDocument::schemaValidate usando o XSD da versão PHPUnit instalada.
Isso verifica a estrutura permitida, e não o funcionamento da aplicação.

Um diagnóstico temporário usou o Loader real de XML e o PhpHandler real do
PHPUnit instalado para aplicar as variáveis, sem iniciar o executor de testes.
Essas classes internas foram usadas apenas no diagnóstico, não adicionadas
como dependência do código da aplicação.

APP_ENV/DB_CONNECTION/DB_DATABASE/DB_URL efetivos foram testing/sqlsrv/loja_test/
vazio. Em seguida o diagnóstico inicializou Laravel sem passar --env=testing,
confirmando que o ambiente veio das variáveis do XML. Sem cache de configuração,
o arquivo selecionado foi .env.testing; chave e senha corresponderam ao arquivo
local, sem imprimir valores privados.

O SELECT retornou:

```text
Ambiente: testing | Arquivo: .env.testing | Conexão: sqlsrv
Banco: loja_test | Login/usuário: loja_testes | Acesso a loja: 0 | Tabelas: 0
```

Diagnóstico terminou com código 0. Não foram executados casos de teste,
migrations, seeders ou comandos de escrita. git diff --check passou e os
arquivos privados continuam ignorados e ausentes do índice. Nenhuma alteração
de credencial, serviço ou dependência.

## Continuidade

Esclarecimento de 19/10/2026: o aluno perguntou como o Laravel sabe que deve
ler .env.testing. PHPUnit primeiro define APP_ENV=testing no processo, a partir
do XML, antes de Laravel iniciar. No código instalado, LoadEnvironmentVariables
lê Env::get('APP_ENV') e monta environmentFile().'.'.$environment, resultando
em .env.testing. Se o arquivo existir, loadEnvironmentFrom o seleciona.
O APP_ENV dentro da cópia não seleciona o próprio arquivo. --env=testing é
outro caminho, explícito no console. Sem arquivo específico, o carregador
mantém o nome anterior, normalmente .env; não cria o arquivo ausente. Esse
fluxo foi conferido sem cache de configuração. Aluno confirmou entendimento
com "entendi" em 19/10/2026 após esse esclarecimento.

Entendimento confirmado; publicar o checkpoint
e iniciar 5.39: apresentar os dois testes de exemplo existentes, executar a
suíte inicial e interpretar o que seus resultados demonstram. A estrutura do
banco de testes e os testes de catálogo serão preparados depois.
