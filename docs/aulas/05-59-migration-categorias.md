# Aula 5.59 — Migration de categorias preparada

## Objetivo e estado

Descrever a criação de categorias com identificador, nome e datas. Implementação,
explicação e verificação em 20/10/2026; entendimento confirmado com "entendi" na mesma data.
A migration foi escrita, mas ainda não aplicada ao banco.

A 5.58 foi confirmada com "entendi" e publicada em
f680b996432bcb9b8f549d793a79673e90ce847b. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push em 20/10/2026.

## Geração no Docker

Ajuda consultada: docker compose exec -T backend php artisan help make:migration.
Depois, na raiz do repositório, executamos:

```bash
docker compose run --rm --no-deps -T --user 1000:1000 \
  --volume "$PWD/backend/database/migrations:/app/database/migrations:rw" \
  --entrypoint php backend artisan make:migration create_categorias_table \
  --create=categorias --no-interaction --no-ansi
```

Run cria um container temporário do serviço backend; --rm o remove ao terminar.
--no-deps evita iniciar outros serviços; -T dispensa terminal interativo.
--user usa o UID/GID local, conferidos como 1000:1000. --volume libera escrita
somente em database/migrations, mantendo o restante do código somente para
leitura. $PWD é a raiz atual. Compose não foi alterado.

--entrypoint php inicia PHP, recebendo artisan e seus argumentos. Make:migration
gera o arquivo; create_categorias_table é o nome da migration, e --create indica
a tabela para preparar o esqueleto com Schema::create. --no-interaction dispensa
perguntas e --no-ansi remove códigos de cor. Resultado código 0.

Arquivo gerado:
backend/database/migrations/2026_10_20_113601_create_categorias_table.php.
O prefixo com data/hora participa da ordenação das migrations. Dono local
1000:1000, modo 644. Acrescentamos nome e ajustamos timestamps para precisão 3.

## Código preparado

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->timestamps(3);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
```

Os comentários gerados de up/down permanecem no arquivo. Os imports permitem
usar Migration, Blueprint e Schema pelos nomes curtos. A classe anônima estende
Migration; o arquivo retorna essa instância para o mecanismo de migrations.

Up descreve a criação. Schema::create recebe nome da tabela e uma função que
configura suas colunas pelo Blueprint $table:

- id: identificador numérico gerado pelo banco e chave primária.
- string('nome', 150): coluna textual com limite 150; não aceita NULL. Não
  acrescentamos unique nem validação de texto vazio nesta etapa.
- timestamps(3): created_at e updated_at, anuláveis, com precisão de milissegundos,
  como em produtos. Eloquent preencherá as datas ao persistir models; a migration
  define as colunas, não cadastra categorias ou preenche datas de registros.

Down descreve a remoção da tabela, se ela existir, para reversão da migration.
Aplicar down futuramente removeria também seus dados; não executamos reversão
nesta etapa. Nenhum categoria_id foi acrescentado a produtos ainda.

## Verificação e limite

```bash
docker compose exec -T backend php -l database/migrations/2026_10_20_113601_create_categorias_table.php
```

Exec usa o backend iniciado; php -l confere a sintaxe sem aplicar a migration.
Resultado: No syntax errors detected, código 0. Git diff --check passou.
Não executamos migrate, rollback, SELECT ou INSERT. A sintaxe válida não prova
a criação no SQL Server; estrutura/status serão conferidos na próxima etapa.

Produtos, model, factory, seeders, dependências e serviços foram preservados.
Credenciais locais seguem ignoradas/fora do índice. Suíte não repetida para
arquivo ainda não aplicado; o último 6 testes/14 asserções pertence à 5.53.

## Continuidade

Entendimento da 5.59 confirmado. Publicar o checkpoint
e iniciar 5.60: aplicar somente esta migration em loja_test e conferir estrutura
e status, sem alterar produtos ou aplicar migrations geradas de users/cache/jobs.
