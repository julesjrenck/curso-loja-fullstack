# Aula 5.52 — Estado inativo na factory

## Objetivo e estado

Dar um nome ao preparo de produtos inativos, reutilizando a definição existente.
Implementação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" na mesma data.

A 5.51 foi confirmada com "entendi" e publicada em
5152ba47349add5d6cbfa150dc18e66b3c441c0b. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Alteração na factory

Somente backend/database/factories/ProdutoFactory.php foi alterado no código,
acrescentando após definition:

```php
public function inativo(): static
{
    return $this->state([
        'status' => 'inativo',
    ]);
}
```

public permite chamar o método fora da classe. O tipo de retorno static indica
um objeto da classe chamada, aqui ProdutoFactory. Não transforma o método em
estático: ele é chamado com -> e usa $this, a factory atual.

state é herdado de Illuminate\Database\Eloquent\Factories\Factory. Sua
implementação instalada foi consultada no container: cria outra instância de
factory com a transformação de atributos registrada. Ao gerar o produto,
Laravel combina a definição com os estados; status inativo substitui ativo.
Nome e preço continuam vindo de definition.

O return devolve essa factory configurada, permitindo encadear make/create.
Chamar inativo não altera um produto existente nem salva um novo registro.
O padrão de definition permanece ativo.

## Demonstração e local da execução

Este código foi executado somente no script temporário
/tmp/curso-552-estado-inativo.php, enviado ao PHP do container pela entrada
padrão, após inicializar Laravel:

```php
$factory = Produto::factory();
$factoryInativo = $factory->inativo();
$produto = $factoryInativo->make();
$produtoPadrao = $factory->make();
```

As três primeiras linhas equivalem à sequência:

```php
$produto = Produto::factory()->inativo()->make();
```

make monta Produto em memória. O script verificou que o produto é inativo e
o produto da factory original continua ativo. Nenhum teste ou controller chama
inativo ainda; aplicar o estado ao teste será a próxima etapa.

## Comandos e resultados

```bash
docker compose exec -T backend php -l database/factories/ProdutoFactory.php
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-552-estado-inativo.php
```

O primeiro comando confere a sintaxe. No segundo, o shell do host lê o arquivo
temporário com < e o envia ao PHP do serviço backend por /dev/stdin. -T dispensa
terminal interativo; --env=testing é o argumento lido ao inicializar Laravel.
O arquivo em /tmp é do host, não precisa estar montado no container.

Sintaxe passou; diagnóstico código 0:

- state retornou outra instância de ProdutoFactory;
- produto inativo e padrão ativo, ambos Produto;
- exists false, ID e datas null;
- nome textual e preço inteiro no intervalo da definição;
- listener registrou zero consultas SQL durante a demonstração.

Como os testes usam a factory alterada, a suíte existente foi executada:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

PHP executa o PHPUnit instalado; --testdox mostra os cenários, --colors=never
remove cores e --do-not-cache-result evita cache no código somente para leitura.
Resultado: OK (6 tests, 14 assertions), código 0. A suíte verifica os cenários
anteriores; o novo método foi verificado pelo diagnóstico em memória.

SELECT posterior pelo diagnóstico de contagens confirmou:

```text
loja_test/loja_testes | Produtos: 0 | Migrations: 1
loja/loja_app | Produtos: 1 | Migrations: 1
```

git diff --check passou; credenciais locais continuam ignoradas e fora do
índice. Nenhuma nova migration, dependência ou serviço.

## Continuidade

Entendimento da 5.52 confirmado. Publicar o checkpoint
e iniciar 5.53: aplicar inativo()->create ao cadastro da Caneca no cenário de
ativo/inativo, mantendo nome explícito e conferindo resultado/rollback.
