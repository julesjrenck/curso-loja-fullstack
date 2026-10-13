# Aula 4.6 — Ambiente local do Laravel

## Objetivo

Preparar as opções locais do Laravel antes de usar Artisan e iniciar as primeiras
rotas. As dependências e pastas graváveis já estão prontas. Nesta aula ajustamos
backend/.env.example e criamos sua cópia local, backend/.env.

## Modelo e configuração local

backend/.env.example é um modelo versionado, com opções e valores de exemplo.
backend/.env é a configuração desse ambiente: fica local e ignorada pelo Git.
Laravel carrega esse arquivo com a biblioteca Dotenv e os arquivos de config
consultam as variáveis usando env().

O .env da raiz é o arquivo já estudado no módulo Docker: o Compose o usa para
interpolar sua configuração. O backend possui seu próprio .env, disponível no
container como /app/.env pela montagem da pasta backend. O serviço backend não
injeta APP_NAME da raiz; seu nome vem do ambiente Laravel.

O modelo agora inclui estas opções principais:

```dotenv
APP_NAME="Loja Fullstack"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8002

DB_CONNECTION=sqlsrv
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

| Opção | Significado nesta etapa |
| --- | --- |
| APP_NAME | Nome da aplicação; aspas permitem o espaço em Loja Fullstack. |
| APP_ENV=local | Identifica o ambiente de desenvolvimento local. |
| APP_KEY | Chave usada pela criptografia Laravel; vazia até a aula de geração. |
| APP_DEBUG=true | Habilita detalhes de erros no ambiente local de estudo. |
| APP_URL | URL base planejada para o backend local; seu valor não publica uma porta. |
| DB_CONNECTION=sqlsrv | Seleciona a configuração SQL Server para quando o banco for introduzido. |
| SESSION_DRIVER=file | Define sessões em arquivos sob storage/framework/sessions. |
| CACHE_STORE=file | Define cache em arquivos sob storage/framework/cache/data. |
| QUEUE_CONNECTION=sync | Define execução imediata das tarefas no mesmo processo quando forem utilizadas. |

Sessão guarda dados entre requisições, como uma futura identificação do cliente.
Cache guarda resultados que podem ser reutilizados para evitar trabalho repetido.
As configurações em arquivo permitem estudar as primeiras páginas com o storage
preparado na 4.5. Tarefas, filas e armazenamento terão suas aulas próprias.

O modelo original usava banco para sessão, cache e fila. Ajustamos esses seletores
para a fase inicial do curso. DB_CONNECTION mudou de sqlite para sqlsrv; host,
porta, banco, usuário e senha ficaram como comentários de preparação, sem
credenciais reais. O comentário DB_PORT=1433 registra o valor típico do SQL Server;
esses campos serão preenchidos ao preparar o banco no módulo 5.

As demais opções do modelo foram preservadas. Campos de Redis, e-mail, AWS e Vite
não instalam ferramentas nem criam serviços; serão aprofundados quando utilizados.
Comentários começam com # e não definem variáveis de ambiente.

## Relação com config

Não alteramos arquivos PHP de configuração. Eles já consultam as variáveis:

```php
// backend/config/session.php
'driver' => env('SESSION_DRIVER', 'database'),
```

O primeiro argumento é o nome da variável. O segundo é o valor padrão usado
quando ela não existe. Com SESSION_DRIVER=file carregada, o resultado é file.

- config/app.php consulta nome, ambiente, debug, URL e chave.
- config/database.php consulta DB_CONNECTION para escolher a conexão padrão.
- config/session.php consulta SESSION_DRIVER e define o caminho das sessões.
- config/cache.php consulta CACHE_STORE e define os diretórios do cache em arquivo.
- config/queue.php consulta QUEUE_CONNECTION.

Valores como true, false e null recebem tratamento próprio pelo helper env();
no diagnóstico, APP_DEBUG foi lido como booleano true.

## Cópia local

Conferimos primeiro que backend/.env ainda não existia. Depois, no host:

```bash
cp --update=none -- backend/.env.example backend/.env
chmod 600 backend/.env
```

cp copia o modelo; --update=none, do GNU cp, preserva um arquivo de destino que
já exista. -- encerra a lista de opções. chmod 600 permite leitura e escrita ao
proprietário no host. stat confirmou modo 600 e proprietário/grupo 1000:1000.
O PHP continua executando no Docker, cujo processo consegue ler esse arquivo.

Não houve mudança no .env da raiz, Compose, imagem ou pacotes. A cópia local
contém as mesmas opções do modelo nesta preparação; APP_KEY continua vazia.

## Verificações executadas

Executamos PHP temporário no Docker pela entrada padrão:

```bash
docker compose run --rm -T backend php
```

O código incluiu vendor/autoload.php e carregou somente as variáveis:

```php
require '/app/vendor/autoload.php';
Dotenv\Dotenv::createImmutable('/app')->load();
env('SESSION_DRIVER');
```

createImmutable define a origem e preserva variáveis já definidas externamente;
load lê e valida a sintaxe. O diagnóstico comparou os seletores com os valores
esperados usando env(), sem imprimir o conteúdo completo do ambiente e sem
inicializar a aplicação Laravel ou conectar ao banco.

Resultados:

- Oito opções principais lidas corretamente; APP_DEBUG booleano true.
- APP_KEY ainda vazia; geração não executada.
- Hashes do modelo e da cópia iguais, sem imprimir seus valores.
- Campos de banco comentados não foram carregados como variáveis.
- Pastas de sessões, cache e locks existentes e graváveis.
- Git confirmou backend/.env ignorado e ausente da lista de arquivos versionados.
- Compose válido; código, lockfile e configuração Docker preservados.
- Sem SQLite, manifests packages.php/services.php/config.php, Artisan, servidor,
  migrations, testes Laravel ou execução do contador.

Esses resultados demonstram leitura e coerência do ambiente preparado. A URL
http://127.0.0.1:8002 ainda não possui servidor publicado; APP_URL configura o
endereço usado pelo Laravel, enquanto o Compose controlará a publicação da porta.
SQL Server ainda não foi provisionado e seus drivers serão preparados no módulo 5.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada, entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: 7c0fcea, etapa 4.5.

Após confirmação, publicar 4.6 e iniciar 4.7: apresentar Artisan, verificar sua
versão e gerar APP_KEY local sem exibir a chave. Para permitir a gravação, montar
temporariamente apenas backend/.env com escrita sobre /app/.env. Antes da geração,
conferir se existe uma chave para preservar configurações já feitas pelo aluno.
Caches de inicialização gerados pelo Artisan serão apresentados quando surgirem.

Os padrões SQLite ainda existentes como fallback em config/database.php e no
phpunit.xml serão ajustados antes de usar persistência ou testes de integração.
O curso permanece com SQL Server e banco exclusivo para testes.

Fontes oficiais:

- [Ambiente e configuração Laravel](https://laravel.com/docs/13.x/configuration#environment-configuration).
- [Configuração das sessões](https://laravel.com/docs/13.x/session#configuration).
- [Configuração do cache](https://laravel.com/docs/13.x/cache#configuration).
- [Execução síncrona de tarefas](https://laravel.com/docs/13.x/queues#connections-vs-queues).
