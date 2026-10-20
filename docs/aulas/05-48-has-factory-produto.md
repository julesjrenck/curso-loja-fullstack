# Aula 5.48 — Atalho de factory no model Produto

## Objetivo e estado

Adicionar HasFactory ao Produto e conferir Produto::factory()->make() em
memória. Implementação, explicação e verificações em 19/10/2026; entendimento
confirmado com "entendi" em 19/10/2026, após esclarecer o local da demonstração.

A 5.47 foi confirmada com "entendi" e publicada em d90a8a4. HEAD, origin/main
e consulta direta à main remota retornaram
d90a8a407413b93ec597019428abe28b23a2c45f após o push.

## Alteração no model

Somente backend/app/Models/Produto.php foi alterado. Imports acrescentados:

```php
use Database\Factories\ProdutoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
```

Dentro da classe Produto:

```php
/** @use HasFactory<ProdutoFactory> */
use HasFactory;
```

HasFactory é um trait do Laravel que fornece o método estático factory().
O use fora da classe resolve o nome do trait; o use dentro da classe incorpora
seus métodos. Produto continua estendendo Model, com Fillable e casts preservados.
Esse padrão de uso e anotação já está presente no model User do projeto.

O comentário @use HasFactory<ProdutoFactory> informa ao editor/ferramentas
o tipo da factory. Por isso ProdutoFactory também foi importado no arquivo.
O comentário não executa código nem determina sozinho a associação em execução.

O código instalado de HasFactory e factoryForModel foi consultado em Docker.
Nesse caso Laravel resolve Database\Factories\ProdutoFactory pela convenção
do nome App\Models\Produto. Não foi necessário definir outra configuração.

## Chamada pelo model

Depois de inicializar Laravel em PHP Docker com --env=testing:

```php
use App\Models\Produto;

$produto = Produto::factory()->make();
```

Produto::factory() devolve uma instância de ProdutoFactory. O make seguinte
monta o model com os atributos da definição, como na chamada direta da etapa
anterior. O atalho começa pelo model e usa a mesma receita; a geração continua
em ProdutoFactory::definition().

O diagnóstico separou as chamadas para conferir os dois objetos:

```php
$factory = Produto::factory();
$produto = $factory->make();
```

Essa execução ocorreu somente no script temporário
`/tmp/curso-548-atalho-factory.php`, enviado ao PHP do container pela entrada
padrão. A chamada ainda não está nos testes nem nos controllers do projeto.
A linha encadeada acima apresenta a mesma sequência em uma expressão.

factory() prepara a receita; make monta o Produto em memória nesta factory.
Nenhuma chamada create/save foi feita nessa demonstração.

## Verificações realizadas

php -l de Produto.php passou. Diagnóstico confirmou HasFactory presente,
factory instanceof ProdutoFactory e produto instanceof Produto. Atributos
previstos, preço int no intervalo, status ativo, exists false, ID/datas null.
Listener durante make observou zero consultas SQL. Código 0.

Amostra fictícia: nome "sequi et odit", preco_em_centavos 15187, status ativo.
Valores variáveis; o diagnóstico confere formato/tipos, não exige essa amostra.

Como o model usado pelos testes recebeu o trait, executamos a suíte existente:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (6 tests, 14 assertions), código 0. Nenhum arquivo de teste foi
alterado. Suas inserções continuaram isoladas pelas transações. SELECT separado
após a suíte confirmou zero produtos em loja_test/loja_testes e um produto em
loja/loja_app; uma migration em cada banco.

git diff --check passou; segredos continuam ignorados/fora do índice. Factory,
serviço, configuração e migrations preservados. Nenhuma nova dependência,
seeder, conta ou credencial.

## Continuidade

Entendimento da 5.48 confirmado. Publicar o checkpoint
e iniciar 5.49: usar Produto::factory()->create somente no cenário de produto
ativo, sobrescrevendo nome/status e deixando o preço padrão. Conferir o
comportamento e o rollback, sem converter os demais cenários nessa etapa.
