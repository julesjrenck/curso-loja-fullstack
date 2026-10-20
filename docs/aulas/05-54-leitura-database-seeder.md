# Aula 5.54 — Leitura do DatabaseSeeder existente

## Objetivo e estado

Conhecer a rotina de população de dados gerada pelo Laravel e distinguir sua
função das migrations e factories. Explicação e verificações em 19/10/2026;
entendimento confirmado com "entendi" em 19/10/2026, após nova explicação.
Somente documentação alterada.

A 5.53 foi confirmada com "entendi" e publicada em
6ac5518805ab2706980570b94375e82ba495c2ee. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Arquivo apresentado

backend/database/seeders/DatabaseSeeder.php já veio com o projeto:

```php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
```

Namespace organiza a classe. Os imports permitem usar nomes curtos para o model,
trait e classe base. Extends Seeder fornece a estrutura de execução e chamadas
de outros seeders. Use dentro da classe incorpora WithoutModelEvents: na
execução normal pelo mecanismo de seeders, desativa o despacho de eventos de
models durante a rotina. Isso não impede INSERTs; eventos serão aprofundados
quando precisarmos deles.

Run é o método que contém a rotina, com retorno void. A linha com dez usuários
tem // e está comentada; não é executada. A chamada ativa criaria um usuário
com nome/email fixos e demais atributos fornecidos por UserFactory.

User usa HasFactory para resolver Database\Factories\UserFactory. Essa factory
gerada fornece também senha em hash, data de verificação e token fictício.
Não estamos usando esse exemplo para implementar autenticação nesta etapa.

## Estrutura, atributos e população

| Recurso | Papel | Exemplo da loja |
| --- | --- | --- |
| Migration | Define ou altera estrutura do banco | Criar produtos com nome, preço e status |
| Factory | Fornece atributos e pode montar/salvar models | Preparar um Produto ativo ou inativo |
| Seeder | Organiza uma rotina para popular dados | Cadastrar exemplos para uma demonstração |

Um seeder pode usar uma factory, Eloquent ou outras operações adequadas à rotina.
Ele não é executado só porque o arquivo existe. Artisan db:seed é o comando
de execução e usa DatabaseSeeder por padrão. Comandos de migração também podem
solicitar seeding explicitamente, mas não fizemos isso nas etapas anteriores.

Nossos testes recebem rollback por usarem DatabaseTransactions. Seeders não
recebem esse isolamento automaticamente: os cadastros da rotina ficam no banco
se executados fora de uma transação que seja desfeita.

## Dependências e verificações

A migration gerada 0001_01_01_000000_create_users_table.php contém a criação de
users, password_reset_tokens e sessions. Somente a migration de produtos foi
aplicada nas aulas; a existência do arquivo da migration de users não significa
que ela foi aplicada.

Comando executado para conferir sintaxe:

```bash
docker compose exec -T backend php -l database/seeders/DatabaseSeeder.php
```

Exec executa no serviço backend iniciado, -T dispensa terminal interativo e
php -l verifica a sintaxe sem executar run. Passou, código 0.

O script temporário /tmp/curso-554-inspecionar-seeder.php foi enviado ao PHP do
container pela entrada padrão:

```bash
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-554-inspecionar-seeder.php
docker compose exec -T backend php /dev/stdin < /tmp/curso-554-inspecionar-seeder.php
```

O shell do host lê o arquivo com <; PHP o recebe por /dev/stdin. A primeira
execução seleciona testing ao inicializar Laravel; a segunda usa o ambiente
normal. O diagnóstico usa reflexão para conferir classe base/método run, sem
invocá-lo, e SELECTs de identidade e sys.tables para listar apenas tabelas.

Resultados, código 0 nas duas execuções:

```text
loja_test/loja_testes | Tabelas: migrations, produtos
loja/loja_app | Tabelas: migrations, produtos
```

Users está ausente nos dois bancos. O cadastro do DatabaseSeeder atual depende
dessa tabela; executar essa rotina agora não preencheria nosso catálogo e
falharia ao tentar inserir o usuário. Não executamos run nem db:seed.

WithoutModelEvents, Seeder::__invoke e resolução da classe em SeedCommand foram
consultados no framework instalado em Docker. Não houve INSERT ou migration.
Suíte não repetida para leitura/documentação: último resultado 6 testes/14
asserções é da 5.53. Git diff --check passou; segredos continuam ignorados.

## Continuidade

O aluno informou "não entendi, seja mais claro". Explicação reapresentada com
exemplo da loja: ProdutoFactory fornece os valores padrão; um seeder pode
reunir chamadas Produto::factory()->create para cadastrar Camiseta e Caneca.
Esse exemplo é hipotético, não foi escrito no código nem executado. Create
salva o model tanto em testes quanto em seeders; o rollback dos nossos testes
vem de DatabaseTransactions. Migration prepara a estrutura das tabelas.
O aluno confirmou entendimento com "entendi" após a nova explicação.

Entendimento da 5.54 confirmado. Publicar o checkpoint
e iniciar 5.55: gerar somente a estrutura ProdutoSeeder com Artisan e explicar
run vazio, sem preencher ou executar o seeder ainda.
