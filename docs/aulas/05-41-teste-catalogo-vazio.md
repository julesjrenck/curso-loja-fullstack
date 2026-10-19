# Aula 5.41 — Primeiro teste de integração do catálogo vazio

## Objetivo e estado

Verificar que CatalogoEloquent::listarNomes retorna [] quando não há produtos
na tabela real de testes. Implementação, explicação e verificações em
19/10/2026; entendimento confirmado com "entendi" nessa data.

A 5.40 foi confirmada com "entendi" e publicada em b70f6f0. HEAD, origin/main
e consulta direta à main remota retornaram
b70f6f081d99b4009681764ee090a94f0c8ac27d após o push.

## Arquivo criado

backend/tests/Feature/CatalogoEloquentTest.php contém somente este cenário:

```php
<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Services\CatalogoEloquent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CatalogoEloquentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_retorna_lista_vazia_quando_nao_ha_produtos(): void
    {
        $identidade = DB::selectOne(
            'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
        );

        $this->assertSame('loja_test', $identidade->banco);
        $this->assertSame('loja_testes', $identidade->login);

        Produto::query()->delete();

        $catalogo = new CatalogoEloquent;

        $this->assertSame([], $catalogo->listarNomes());
    }
}
```

O namespace organiza a classe em Tests\Feature. Os use fora da classe importam
os nomes do model, serviço, trait, fachada DB e base Tests\TestCase. Essa base
inicializa Laravel, como no exemplo HTTP anterior. Aqui a integração é entre
serviço, Eloquent e SQL Server, sem requisição HTTP.

O use dentro da classe incorpora o trait DatabaseTransactions. Um trait reúne
métodos que uma classe pode reutilizar; esse use tem função diferente dos
imports fora da classe.

## Transação e preparação

O código instalado de DatabaseTransactions e seu acionamento no TestCase
foram consultados em Docker. Laravel inicia uma transação na conexão padrão
antes do método de teste e registra rollback e desconexão para seu encerramento.
O ciclo normal de encerramento também acontece quando uma asserção falha.
O trait usa as tabelas já preparadas; ele não aplica migrations.

Primeiro SELECT lê banco e login reais da conexão. As duas asserções exigem
loja_test e loja_testes antes de qualquer DELETE. Se uma delas falhar, o método
é interrompido sem executar sua preparação de dados.

Produto::query()->delete() envia DELETE para as linhas de produtos, sem filtro.
Isso prepara uma tabela vazia dentro da transação. A tabela e suas colunas
permanecem. Ao terminar, rollback desfaz as alterações de dados dessa transação,
preservando as linhas que existiam antes. Assim o caso não depende de encontrar
o banco vazio por acaso.

## Comportamento esperado

new CatalogoEloquent cria diretamente o serviço já existente. Como não há
argumentos de construtor, PHP permite omitir os parênteses. listarNomes executa
a consulta Eloquent na tabela produtos do SQL Server e devolve um array.

assertSame recebe primeiro o valor esperado, [], e depois o resultado real.
Compara valor e tipo: queremos exatamente um array vazio. As duas asserções
anteriores conferem o destino; esta terceira verifica o comportamento do catálogo.

O caminho é: iniciar transação, conferir destino, preparar cenário vazio,
chamar serviço, conferir [], executar rollback.

## Comandos e resultados

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoEloquentTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/CatalogoEloquentTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

php -l conferiu sintaxe. O caminho passado ao PHPUnit selecionou somente o novo
arquivo: OK (1 test, 3 assertions), código 0. Sem esse caminho, a suíte completa
executou o cenário e os dois exemplos anteriores: OK (3 tests, 5 assertions),
código 0. Flags de apresentação e cache são as já estudadas na 5.39.

SELECT separado após a suíte confirmou loja_test/loja_testes, somente tabelas
migrations/produtos, zero produtos e uma migration no lote 1. Consulta normal
confirmou loja/loja_app, um produto e uma migration. Esquema preservado.

git diff --check passou; arquivos privados seguem ignorados/fora do índice.
Nenhuma alteração no serviço, model, contrato, configuração ou migrations;
nenhuma nova dependência, conta, credencial ou seeder.

## Continuidade

Cobertura atual: catálogo sem produtos. Retorno de produto ativo, filtro de
inativos e ordenação ainda terão cenários próprios. Entendimento da 5.41
confirmado com "entendi" em 19/10/2026. Publicar o checkpoint e iniciar 5.42,
acrescentando o cenário de produto ativo ao mesmo arquivo e compartilhando
a preparação isolada, sem antecipar outros cenários.
