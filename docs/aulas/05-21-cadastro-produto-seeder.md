# Aula 5.21 — Cadastro escrito no seeder

## Objetivo

Escrever em ProdutoSeeder as instruções para cadastrar um produto de demonstração.
A 5.20 foi confirmada com "entendi" em 15/10/2026 e publicada em e811031,
SHA completo e81103197aece04c52b979b3999eebd0ba9fe1db, conferido na main remota.

Nesta etapa escrevemos o código, sem executar run ou db:seed.

## Arquivo alterado

Em backend/database/seeders/ProdutoSeeder.php, substituímos o import sem uso
WithoutModelEvents por App\Models\Produto e preenchemos run:

```php
<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::create([
            'nome' => 'Camiseta',
            'preco_em_centavos' => 4990,
            'status' => 'ativo',
        ]);
    }
}
```

use App\Models\Produto indica que Produto é o model Eloquent de backend/app/Models,
ligado à tabela produtos. O Produto do laboratório src é uma classe diferente.
O namespace, a herança de Seeder e a assinatura public run(): void permanecem.

## A instrução de cadastro

Produto::create recebe um array associativo: as chaves são atributos do model,
correspondentes às colunas, e os valores são os dados deste cadastro. Quando
chamado, create preenche um novo model e salva no banco; devolve a instância
persistida. Aqui não precisamos guardar esse retorno em uma variável.

O operador :: permite escrever a chamada a partir da classe; o Eloquent a
encaminha ao construtor de consultas do model. Não precisamos escrever um
INSERT manual ou chamar save novamente depois de create.

Entradas deste exemplo:

- nome: texto Camiseta;
- preco_em_centavos: inteiro 4990, equivalente a R$ 49,90;
- status: texto ativo, explícito mesmo com o default da coluna SQL.

O banco gera id pela coluna identity. O Eloquent fornece created_at e
updated_at, pois o model usa timestamps. Não enviamos esses três campos no
array. A conexão padrão segue sqlsrv, com loja_app no banco loja; a conta
de migrations não é necessária para inserir dados em uma tabela existente.

Os três atributos estão no Fillable configurado na 5.17, e o cast inteiro do
preço continua no model. No uso normal, Fillable controla atribuição por arrays.
Durante db:seed, o Laravel desativa automaticamente essa proteção; portanto
o seeder não serve para testar bloqueio de campos. O array é escrito por nós.
Fillable e cast não substituem validação de conteúdo.

Nas etapas anteriores, new Produto([...]) somente preenchia um objeto em
memória. create acrescenta a persistência quando a chamada é executada.
Escrever a chamada dentro do método não chama o método automaticamente.

create não pesquisa um produto igual antes de inserir. Cada execução deste
seeder tentará cadastrar outra Camiseta; o nome não tem restrição unique.
Na demonstração seguinte, executaremos uma vez. Reexecução sem duplicar terá
uma explicação própria, sem limpar dados ou alterar a tabela nesta etapa.

## Verificação e alcance

Na raiz do repositório:

```bash
docker compose exec -T backend php -l /app/database/seeders/ProdutoSeeder.php
```

exec usa o container backend existente, -T dispensa terminal interativo e
php -l verifica a sintaxe do arquivo sem executar seu código. Resultado:
No syntax errors detected, código de saída 0.

Revisão conferiu import, array e correspondência com model e migration.
git diff --check passou. A alteração de código ficou somente em ProdutoSeeder.
Não chamamos run, db:seed, create ou qualquer gravação SQL. A sintaxe válida
não demonstra ainda que a inserção funciona: isso será observado na execução.
DatabaseSeeder, model, migrations, rotas, dependências e serviços preservados.

## Continuidade

Cadastro escrito e explicação apresentada; sintaxe verificada.
Entendimento da 5.21 confirmado com "entendi" em 15/10/2026. Checkpoint
preparado para publicação autorizada; último publicado e811031.

Próximo passo exato: publicar 5.21 e iniciar 5.22,
executando somente ProdutoSeeder uma vez pela conexão da aplicação,
conferindo o registro persistido e a consulta Eloquent. Apresentar também
uma consulta no DBeaver, sem presumir resultado observado pelo aluno.

Fontes consultadas em 15/10/2026:

- [Inserção de models no Laravel 13](https://laravel.com/docs/13.x/eloquent#inserts).
- [Seeders e atribuição por arrays](https://laravel.com/docs/13.x/seeding#introduction).
