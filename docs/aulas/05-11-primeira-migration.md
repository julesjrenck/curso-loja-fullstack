# Aula 5.11 — Primeiro arquivo de migration

## Objetivo

Apresentar migrations e gerar apenas o arquivo inicial de produtos. A modelagem
5.10 foi confirmada com "entendi" e publicada em b160a68, conferido na main
remota: b160a6827c99cd30f6edbea3e1f19556fc06b147.

Uma migration descreve uma mudança na estrutura do banco em um arquivo PHP
versionado. Assim podemos compartilhar e aplicar o mesmo desenho nos ambientes
do projeto. Gerar o arquivo e aplicar a mudança são ações diferentes:
make:migration gera; migrate aplica as migrations pendentes quando o executarmos
na etapa própria, com o conjunto de arquivos e credenciais preparados.

## Comando executado

Na raiz do repositório:

```bash
docker compose run --rm -T --no-deps \
  --user "$(id -u):$(id -g)" \
  --volume "$PWD/backend/database/migrations:/app/database/migrations:rw" \
  backend php artisan make:migration create_produtos_table \
  --create=produtos --no-interaction
```

run cria um container temporário do backend; --rm o remove depois; -T desliga
terminal interativo; --no-deps evita iniciar outros serviços. O código da
aplicação está montado somente para leitura por padrão. A montagem adicional
permite escrever especificamente na pasta migrations. --user usa o usuário e
grupo do host, obtidos por id, para o arquivo ficar editável pelo aluno.

php artisan roda o Artisan em /app. make:migration é o gerador; o nome
create_produtos_table descreve a mudança. --create=produtos informa a tabela
ao gerador; --no-interaction evita perguntas. Não fornecemos senha ou dados de
produtos; a saída informa o caminho do arquivo criado.

Arquivo gerado:

```text
backend/database/migrations/2026_10_14_123220_create_produtos_table.php
```

O prefixo com data e hora ordena as migrations; o horário foi gerado em UTC,
fuso configurado no Laravel. O restante descreve a criação de produtos.
As três migrations padrão da estrutura Laravel continuam preservadas.

## Código gerado

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
```

O arquivo real inclui <?php e comentários gerados. Os imports permitem usar
os três nomes curtos. return new class extends Migration cria uma instância
de classe anônima que herda de Migration e devolve esse objeto ao carregador.
Carregar a classe não chama automaticamente seus métodos.

up() contém a mudança a aplicar. Schema é uma fachada do serviço de esquema,
como DB dá acesso ao serviço de banco. Schema::create recebe o nome da tabela
e uma função; Blueprint $table representa o desenho das colunas dentro dessa
função. $table->id() descreve o identificador/chave primária, e timestamps()
descreve created_at/updated_at. A geração de SQL correspondente ao SQL Server
será aprofundada quando completarmos a definição.

down() descreve a reversão: dropIfExists removeria a tabela produtos caso ela
existisse. A remoção de uma tabela também remove seus registros. O método não
é chamado por gerar ou carregar este arquivo. Não executamos up(), down(),
migrate ou rollback nesta etapa.

Este é o conteúdo inicial do gerador, ainda incompleto para a modelagem 5.10.
Na 5.12 acrescentaremos nome, preco_em_centavos e status, e ajustaremos a
precisão das datas para a definição DATETIME2(3) planejada.

## Verificações

```bash
docker compose exec -T backend php -l \
  /app/database/migrations/2026_10_14_123220_create_produtos_table.php
```

O gerador terminou com código 0; o arquivo tem dono 1000:1000 e permissão 644.
php -l passou. Um diagnóstico temporário PHP em Docker carregou o autoload,
inicializou Laravel, fez require do arquivo e confirmou instanceof Migration,
sem chamar up/down. Consulta somente de leitura a sys.tables no banco loja
confirmou que dbo.produtos e dbo.migrations ainda estão ausentes.

git diff --check passou; nenhum arquivo PHP existente foi alterado. Nenhuma
credencial, dependência, serviço ou dado do contador mudou. A conta loja_app
continua com leitura/escrita de dados, sem permissão de criar tabelas. O acesso
para executar migrations será preparado na etapa própria.

## Continuidade

Arquivo gerado, explicação apresentada e verificações concluídas. Entendimento
da 5.11 confirmado com "entendi" em 14/10/2026. Checkpoint preparado para
publicação autorizada; último publicado b160a68. Publicar 5.11 e iniciar 5.12:
preencher a migration com as colunas da modelagem, sem executá-la no banco.

Fonte consultada em 14/10/2026:

- [Geração e estrutura de migrations Laravel 13](https://laravel.com/docs/13.x/migrations#generating-migrations).
