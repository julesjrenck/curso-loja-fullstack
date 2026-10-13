# Aula 4.7 — Artisan e chave da aplicação

## Objetivo e conceito

Executar os primeiros comandos Artisan e gerar APP_KEY local. Artisan é a
interface de comandos do Laravel, disponível pelo arquivo backend/artisan.
A chave permite que o Laravel criptografe dados, como cookies. Ela permanece
na configuração local, enquanto o modelo versionado mantém APP_KEY vazia.

## Entrada de um comando

O arquivo artisan, apresentado na estrutura inicial, faz estas operações:

```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$status = $app->handleCommand(new ArgvInput);
exit($status);
```

O autoload disponibiliza as classes; bootstrap/app.php cria e configura a
aplicação. ArgvInput, do Symfony Console, representa os argumentos recebidos
pelo terminal. handleCommand encaminha o comando ao Laravel; exit devolve seu
código de resultado ao processo. O arquivo também registra LARAVEL_START com
microtime(true) para marcar o início da execução.

Os imports use permitem os nomes curtos Application e ArgvInput. O comentário
de tipo Application identifica o objeto em $app para ferramentas de edição.
A primeira linha #!/usr/bin/env php permite executar o arquivo diretamente em
ambientes apropriados; aqui chamamos explicitamente php dentro do Docker.

## Comandos executados

```bash
docker compose run --rm backend php artisan --version
docker compose run --rm backend php artisan help key:generate
```

backend seleciona o serviço; php executa /app/artisan no diretório de trabalho.
O comando substitui php --version, padrão do serviço. --rm remove o container
temporário ao terminar. O primeiro retornou Laravel Framework 13.35.0; o segundo
apresentou as opções de key:generate, sem gerar ou exibir uma chave.

Esta é a primeira execução do Laravel pelo console no curso. O ambiente e as
pastas graváveis das aulas anteriores permitiram a inicialização.

## Geração protegendo uma chave existente

O fluxo incluiu uma guarda PHP antes de chamar Artisan. A parte essencial foi:

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

- A montagem adicional torna somente /app/.env gravável nesse container.
  /app e o código permanecem somente leitura. O arquivo local já existe desde a 4.6.
- -T desabilita o terminal; PHP recebe o código pela entrada padrão.
- Dotenv::parse lê as opções sem imprimir seu conteúdo. A condição confere APP_KEY
  vazia; uma chave existente é preservada. Na execução desta aula, ela estava vazia.
- passthru executa php artisan key:generate --no-interaction dentro do container.
  O status do comando é devolvido pelo exit. --no-interaction evita perguntas.
- key:generate usa bytes aleatórios e salva a chave no arquivo de ambiente.
  O comando retornou Application key set successfully, com código 0.

O diagnóstico real também comparou o arquivo antes e depois, desconsiderando
somente a linha APP_KEY: todas as demais opções foram preservadas. Não utilizamos
--show, que imprime a chave, nem --force, cuja finalidade é execução em produção.

O valor gerado possui representação base64 e corresponde a 32 bytes, compatíveis
com AES-256-CBC, cifra declarada em config/app.php. O prefixo e o comprimento foram
conferidos sem mostrar o valor. O formato será aprofundado se necessário; nesta
aula basta compreender que o comando gera o segredo usado pelo serviço de criptografia.

## Arquivos gerados e alterados

| Arquivo | Resultado |
| --- | --- |
| backend/.env | APP_KEY preenchida localmente; outras opções preservadas. Modo 600 e proprietário 1000:1000 mantidos. |
| backend/.env.example | APP_KEY permanece vazia; modelo sem chave real. |
| backend/bootstrap/cache/packages.php | Manifest gerado da descoberta de pacotes Laravel instalados. |
| backend/bootstrap/cache/services.php | Manifest gerado com registros de provedores e serviços usados na inicialização. |

packages.php contém informações dos três pacotes descobertos: laravel/tinker,
nesbot/carbon e nunomaduro/termwind. São dependências já instaladas, não pacotes
novos introduzidos nesta aula.

services.php contém grupos providers, eager, deferred e when. Eles organizam os
provedores registrados, os carregados na inicialização e os associados a serviços
ou eventos para carregamento posterior. Provedores e injeção de dependências serão
aprofundados nas aulas próprias; não é preciso estudar cada classe dessa lista agora.

Os dois manifests são arrays PHP gerados, usados pelo framework na inicialização.
Estão sob o bind mount gravável da 4.5 e podem ser recriados pelo Laravel.
Git confirmou que ambos e backend/.env estão ignorados e fora dos arquivos versionados.

## Verificações

- Artisan --version e help terminaram com código 0.
- Geração da chave terminou com código 0; chave válida para AES-256-CBC.
- Um texto fixo de teste foi criptografado e recuperado pela classe Encrypter:
  resultado igual ao original, sem exibir chave ou conteúdo criptografado.
- Outro container inicializou o kernel de console e confirmou que config/app.key
  e o serviço encrypter utilizam a chave persistida no arquivo local.
- Manifests de pacotes e serviços lidos como arrays; três pacotes descobertos.
- Modelo sem chave; .env, packages.php e services.php ignorados pelo Git.
- Código, Compose, imagem, JSON e lockfile sem alterações.
- Sem cache config.php, SQLite, migrations, testes Laravel, banco ou contador.
  Apenas o servidor php do laboratório permaneceu ativo; sem servidor Laravel.

Os resultados comprovam inicialização pelo console e uso da chave de criptografia.
Ainda não verificamos uma requisição HTTP Laravel ou acesso a banco.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada, entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 590f98a publicado;
HEAD, origin/main e consulta direta à main remota coincidiram. Chave e manifests locais.

Após confirmação, publicar a documentação da 4.7 e iniciar 4.8: configurar o
servidor de desenvolvimento do Laravel no serviço backend, publicar somente
127.0.0.1:8002 e conferir a página inicial da rota /, mantendo o laboratório ativo.
Banco, frontend e testes de integração continuam nas etapas previstas do curso.

Fontes oficiais:

- [Artisan e ajuda dos comandos](https://laravel.com/docs/13.x/artisan#introduction).
- [APP_KEY e geração pelo Artisan](https://laravel.com/docs/13.x/encryption#configuration).
