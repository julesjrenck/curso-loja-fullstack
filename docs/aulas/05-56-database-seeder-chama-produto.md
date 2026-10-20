# Aula 5.56 — DatabaseSeeder chama ProdutoSeeder

## Objetivo e estado

Fazer a entrada padrão de seeders usar a rotina de produtos da loja.
Implementação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" na mesma data.

A 5.55 foi confirmada com "entendi" e publicada em
0f754aec08f491a658aac7d24f5150bbfefcf774. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Arquivo alterado

Somente backend/database/seeders/DatabaseSeeder.php foi alterado no código.
Import de User e exemplo de cadastro removidos; código agora é:

```php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ProdutoSeeder::class,
        ]);
    }
}
```

O comentário gerado sobre run permanece no arquivo. $this é o DatabaseSeeder
atual; call é herdado de Seeder. Recebe uma lista de classes de seeders, resolve
cada classe e a invoca pelo mecanismo de execução do Laravel.

ProdutoSeeder::class produz a string Database\Seeders\ProdutoSeeder; não é
chamada ao método run nem criação de instância por si só. Como as duas classes
estão em Database\Seeders, não precisamos importar ProdutoSeeder com use.
WithoutModelEvents foi preservado e desativa eventos de model no fluxo normal
de execução, incluindo seeders chamados por ele.

## Fluxo preparado

Ao executar db:seed padrão, Laravel usará DatabaseSeeder. Seu run chamará
ProdutoSeeder, cujo run contém o firstOrCreate existente da Camiseta:

```php
Produto::firstOrCreate(
    ['nome' => 'Camiseta'],
    ['preco_em_centavos' => 4990, 'status' => 'ativo']
);
```

ProdutoSeeder não foi alterado. Se encontrar a Camiseta pelo nome, reutiliza
o registro; se ausente, cadastra com esses atributos. Continua usando Eloquent
diretamente, sem factory. O exemplo de User deixou de ser a rotina padrão.

## Verificações e limites

```bash
docker compose exec -T backend php -l database/seeders/DatabaseSeeder.php
```

Exec executa no serviço backend, -T dispensa terminal interativo e php -l
confere sintaxe sem executar run. Resultado: No syntax errors detected, código 0.

Um diagnóstico enviado diretamente à entrada padrão do PHP no Docker carregou
somente vendor/autoload.php e usou reflexão para conferir DatabaseSeeder e
ProdutoSeeder: ambas carregaram, herdam Seeder e têm run público com retorno
void. Também imprimiu ProdutoSeeder::class como Database\Seeders\ProdutoSeeder.
Não inicializou Laravel nem chamou run; código 0.

A implementação de Seeder::call foi consultada no framework instalado. Não
executamos db:seed ou SQL. Sintaxe e carregamento conferem a estrutura; execução
e persistência serão verificadas na próxima etapa após confirmação.

Git diff --check passou; credenciais locais continuam ignoradas e fora do índice.
Nenhuma migration, dependência ou serviço novo. Suíte não repetida para esta
ligação simples; último resultado 6 testes/14 asserções pertence à etapa 5.53.

## Continuidade

Entendimento da 5.56 confirmado. Publicar o checkpoint
e iniciar 5.57: executar db:seed padrão em loja_test dentro de transação
acompanhada de rollback, conferindo encadeamento e contagens sem deixar produtos.
