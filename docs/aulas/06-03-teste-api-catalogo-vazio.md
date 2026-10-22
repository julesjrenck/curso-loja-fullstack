# Aula 6.3 — Teste HTTP do catálogo vazio

## Objetivo e estado

Verificar automaticamente o contrato de GET /api/v1/produtos quando não há
produtos: sucesso 200, Content-Type application/json e corpo {"data":[]}.
Implementação, explicação e verificações em 22/10/2026; entendimento confirmado
pelo aluno com "entendi" em 22/10/2026.
Único arquivo de código novo: backend/tests/Feature/CatalogoApiTest.php.

Etapa 6.2 confirmada com "entendi" em 22/10/2026 e publicada em
28450ae4ed0ba7562dc07ea92f9f402cbdc18229. Após git push origin main, HEAD,
origin/main e main consultada diretamente no remoto coincidiram.

## Preparação do teste

O arquivo usa namespace Tests\Feature, compatível com sua pasta e o autoload
de desenvolvimento. A classe CatalogoApiTest estende Tests\TestCase, que
inicializa a aplicação Laravel e fornece os métodos de requisição e asserção.

```php
use App\Models\Produto;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
```

Os imports permitem preparar a tabela pelo model, controlar a transação,
consultar a identidade do banco e usar a classe base dos testes Laravel.
`use DatabaseTransactions;` dentro da classe incorpora a trait já estudada.
Ela inicia a transação e a desfaz ao encerrar o teste, incluindo seu DELETE.

```php
protected function setUp(): void
{
    parent::setUp();

    $identidade = DB::selectOne(
        'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
    );

    $this->assertSame('loja_test', $identidade->banco);
    $this->assertSame('loja_testes', $identidade->login);

    Produto::query()->delete();
}
```

SetUp é executado antes de cada teste. Parent::setUp inicializa a preparação
herdada, incluindo a aplicação e a transação. O SELECT consulta o banco e o login
efetivamente usados; as duas asserções interrompem o teste antes do DELETE se
não forem loja_test/loja_testes. A configuração vem de phpunit.xml e .env.testing,
já preparados no módulo 5. Credenciais locais não são exibidas nem versionadas.

O DELETE prepara o cenário sem produtos, mesmo se o banco de testes tiver dados
anteriores. O rollback restaura o estado anterior ao final; não há TRUNCATE,
migration ou seeder nesta etapa.

## A requisição e a resposta esperada

```php
public function test_retorna_json_com_lista_vazia_quando_nao_ha_produtos(): void
{
    $resposta = $this->getJson('/api/v1/produtos');

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson(['data' => []]);
}
```

O método público com prefixo test_ é reconhecido pelo PHPUnit. Seu nome descreve
o comportamento esperado. GetJson envia uma requisição GET interna à aplicação
com Accept: application/json. O fluxo usa a rota, o grupo de middleware, o
container, o catálogo e o banco reais; não substituímos o serviço ou a conexão
por doubles. Não há uma chamada pela rede ao servidor da porta 8002 neste teste;
a aplicação processa a requisição dentro do processo de testes.

O retorno é um TestResponse. AssertStatus exige 200; assertHeader exige o
cabeçalho e seu valor; assertExactJson compara o JSON decodificado com os dados
esperados, sem aceitar campos extras. Esta comparação não depende de espaços
ou formatação do texto JSON.

O código ['data' => []] é um array associativo PHP com uma lista vazia em data;
a resposta correspondente é {"data":[]}. Catálogo vazio continua sendo uma
consulta bem-sucedida a uma coleção existente, por isso mantém status 200.

O cenário complementa CatalogoEloquentTest: agora verificamos a resposta da
rota e sua serialização, além do resultado do serviço. Ele cobre somente o caso
vazio; a resposta com produto ativo será uma próxima pequena etapa.

## Verificações executadas

```bash
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

Exec -T executa no container backend existente sem terminal interativo. Php -l
confere sintaxe; --filter seleciona a classe nova; a execução sem filtro roda
toda a suíte. --do-not-cache-result impede gravar o cache de resultados no código
montado somente leitura; não desabilita testes, banco ou verificações.

Resultados, todos com código 0:

- Sintaxe válida.
- Teste focado: 1 teste/6 asserções, passou. A contagem inclui a identidade do
  banco e as asserções internas dos auxiliares de resposta.
- Suíte completa: 15 testes/60 asserções, passou; sem o aviso anterior de cache.
- SELECTs em processos separados, reutilizando /tmp/curso-62-contagens.php após
  a suíte: loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. O ambiente de testes foi selecionado apenas no processo
  correspondente, com CURSO_AMBIENTE=testing; o diagnóstico carrega .env.testing.

Não houve alteração da rota, do serviço, das credenciais ou do esquema.
Não foi repetida a consulta HTTP de rede da 6.2, pois esta etapa trata do teste
automatizado interno. O teste consulta SQL Server real e usa rollback.

Referência oficial consultada:
[Testes HTTP e verificações JSON no Laravel](https://laravel.com/framework/docs/13.x/http-tests).

## Continuidade

Entendimento da 6.3 confirmado. Publicar o checkpoint e iniciar somente a 6.4,
adicionando o cenário HTTP
de um produto ativo em CatalogoApiTest, usando factory e exigindo sua presença
na lista data da resposta JSON. Exercício DBeaver continua sem relato.
