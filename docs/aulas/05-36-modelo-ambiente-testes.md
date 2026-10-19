# Aula 5.36 — Modelo do ambiente Laravel de testes

## Objetivo e estado

Preparar backend/.env.testing.example para documentar as variáveis do ambiente
de testes do Laravel. Implementação e explicação em 19/10/2026; entendimento
confirmado com "entendi" nessa data. A cópia local e a execução da suíte ficam
para próximas etapas.

A 5.35 foi confirmada com "entendi" e publicada em 04a9a7c. HEAD, origin/main
e consulta direta à main remota retornaram
04a9a7cd16a9d07091b4cbaf50c3adc90e6402fc após o push.

## Arquivos e relações

backend/.env.testing.example é um modelo público, sem senha ou chave real.
Ele não é carregado automaticamente pelo Laravel. Na próxima etapa servirá
de base para backend/.env.testing, cópia local ignorada pelo Git.

O código instalado de LoadEnvironmentVariables foi consultado em Docker:
sem configuração em cache, Laravel procura .env.testing quando APP_ENV=testing
é informado externamente ou --env=testing é passado pelo console. O APP_ENV
dentro do modelo, sozinho, não o seleciona. Não há fusão automática da cópia
de testes com todas as variáveis do .env normal; o arquivo selecionado é lido.
Variáveis externas também participam e podem prevalecer sobre o arquivo.

phpunit.xml já define APP_ENV testing e várias opções de testes. Ainda define
DB_CONNECTION sqlite e DB_DATABASE :memory:, portanto o modelo preparado
nesta aula não torna a suíte pronta para SQL Server. Isso será ajustado em
outra etapa, após preparar e verificar a configuração local.

O .gitignore da raiz já ignora .env e .env.*. A nova exceção específica é:

```gitignore
!/backend/.env.testing.example
```

O ! permite incluir somente esse modelo no Git. backend/.env.testing continua
ignorado, assim como os arquivos que já contêm credenciais.

## Leitura do modelo

- APP_NAME identifica a aplicação de testes; APP_ENV=testing identifica o
  ambiente Laravel. APP_KEY vazio será preenchido apenas na cópia local com
  uma chave própria. APP_DEBUG=true permite detalhes de erros nesse ambiente
  local; APP_URL mantém a URL local já estudada.
- DB_URL vazio não define uma URL de conexão alternativa. DB_CONNECTION=sqlsrv
  seleciona a conexão com esse nome em config/database.php.
- DB_HOST=sqlserver é o nome do serviço dentro da rede Docker. DB_PORT=1433 é
  sua porta interna. Não usamos o endereço do DBeaver executado no host.
- DB_DATABASE=loja_test e DB_USERNAME=loja_testes apontam para o banco e a
  identidade preparados na 5.35. DB_PASSWORD fica vazio no modelo; a próxima
  etapa copiará a senha existente do .env da raiz para a configuração local
  Laravel, sem criar outra conta nem alterar a senha do login.
- DB_ENCRYPT=yes e DB_TRUST_SERVER_CERTIFICATE=true repetem a conexão local
  estudada, com criptografia e confiança no certificado do SQL Server local.
- BCRYPT_ROUNDS=4 reduz o custo de gerar hashes durante os testes. É uma opção
  para testes, já presente no phpunit.xml, e não altera o ambiente normal.
- CACHE_STORE=array e SESSION_DRIVER=array guardam dados somente em memória
  durante o processo. MAIL_MAILER=array mantém mensagens em memória sem enviá-las.
- QUEUE_CONNECTION=sync executa os jobs no próprio processo, sem worker ou
  novo serviço. BROADCAST_CONNECTION=null desativa o envio de broadcasts.

Essas opções repetem a preparação existente no XML para que a futura execução
de comandos --env=testing tenha uma configuração local coerente. Criar o modelo
não aplica nenhuma dessas opções ao processo atual.

## Verificações realizadas

PHP 8.4.26 e Composer 2.10.3 conferidos no backend Docker. Um diagnóstico
temporário usou somente o autoload e o parser já instalado:

```php
require '/app/vendor/autoload.php';

$values = Dotenv\Dotenv::parse(
    file_get_contents('/app/.env.testing.example')
);
```

parse retorna os valores em um array, sem carregar as variáveis no ambiente.
O diagnóstico comparou os valores esperados, conferiu chave/senha vazias e
verificou que APP_ENV/DB_CONNECTION/DB_DATABASE do processo permaneceram iguais.
Também confirmou ausência de .env.testing e leu o XML para conferir que
sqlite/:memory: continuam presentes. Código de saída 0.

git check-ignore -v --no-index mostrou a exceção do modelo e as regras que
excluem backend/.env.testing, backend/.env e .env. git status mostrou o novo
modelo como não rastreado, pronto para um checkpoint posterior. git diff --check
passou. Não houve inicialização Laravel, conexão SQL, migration, seeder, suíte,
alteração de credenciais ou instalação de dependências.

## Continuidade

Entendimento da 5.36 confirmado com "entendi" em 19/10/2026. Publicar o checkpoint
e iniciar 5.37: preparar backend/.env.testing local com chave própria e a senha
existente de loja_testes, verificar seleção do arquivo e conexão por leitura.
phpunit.xml, migrations e execução de testes serão tratados depois.
