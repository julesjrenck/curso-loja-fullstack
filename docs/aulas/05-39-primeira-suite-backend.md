# Aula 5.39 — Primeira execução dos testes de exemplo do backend

## Objetivo e estado

Apresentar e executar os dois testes que vieram com o projeto Laravel.
Explicação e verificação em 19/10/2026, sem alterar código. Entendimento
confirmado com "entendi" em 19/10/2026.

A 5.38 foi confirmada com "entendi", após esclarecer APP_ENV, e publicada
em 734fc5f. HEAD, origin/main e consulta direta à main remota retornaram
734fc5f622c2c2030508e89d62050fbb5f00ec4b após o push.

## O exemplo unitário

backend/tests/Unit/ExampleTest.php usa namespace Tests\Unit e importa
PHPUnit\Framework\TestCase. A classe ExampleTest herda diretamente dessa base.

```php
public function test_that_true_is_true(): void
{
    $this->assertTrue(true);
}
```

O método público com nome iniciado em test é reconhecido pelo PHPUnit.
void indica que ele não retorna valor. assertTrue exige que o valor seja
exatamente true. Se a expectativa não for satisfeita, PHPUnit registra falha.
Neste exemplo o valor é literal: é uma demonstração mínima do executor e de
uma asserção, sem regra da loja ou inicialização da aplicação Laravel.

## A base dos testes Laravel

backend/tests/TestCase.php está no namespace Tests e importa
Illuminate\Foundation\Testing\TestCase com o apelido BaseTestCase:

```php
abstract class TestCase extends BaseTestCase
{
    //
}
```

abstract indica uma classe base, não um teste concreto instanciado diretamente.
Ela ainda não acrescenta métodos próprios, mas herda do framework a preparação
da aplicação e os recursos de teste HTTP. Servirá também aos nossos próximos
testes Laravel.

## O exemplo HTTP

backend/tests/Feature/ExampleTest.php está no namespace Tests\Feature e importa
Tests\TestCase. As duas classes se chamam ExampleTest, mas seus namespaces
diferentes evitam conflito.

```php
public function test_the_application_returns_a_successful_response(): void
{
    $response = $this->get('/');

    $response->assertStatus(200);
}
```

$this->get('/') simula uma requisição GET que passa pelo kernel Laravel
dentro do processo de teste, sem acessar servidor HTTP externo ou navegador.
Retorna uma resposta de teste, guardada em $response. assertStatus(200) exige
o status HTTP 200.

A rota / de routes/web.php retorna a view welcome. A rota do catálogo é
/loja; ela não foi solicitada nesse exemplo. O teste verifica o status da
resposta, sem verificar seu conteúdo.

RefreshDatabase aparece apenas em comentário no arquivo; nenhum trait de
preparação do banco é usado. Esses dois exemplos não consultam o banco nem
executam migrations ou seeders.

## Comando e resultado

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

docker compose exec executa dentro do backend ativo; -T dispensa terminal
interativo. php vendor/bin/phpunit executa o PHPUnit instalado pelo Composer.
No diretório /app ele lê phpunit.xml, que aponta para tests/Unit e tests/Feature.
--testdox apresenta nomes legíveis; --colors=never evita códigos de cor;
--do-not-cache-result evita gravar o cache de resultados no código montado
como somente leitura. O autoload é carregado conforme o bootstrap do XML.

Resultado: PHPUnit 12.5.39, PHP 8.4.26, configuração /app/phpunit.xml,
OK (2 tests, 2 assertions), código 0. Exemplo unitário e exemplo HTTP passaram.

Isso comprova execução do PHPUnit e resposta 200 da raiz no ambiente Laravel.
Asserções de persistência, filtro, ordenação e conteúdo do catálogo ainda não
foram escritas. Mesmo configurada para SQL Server, uma suíte sem operações
de banco não comprova a integração SQL por seus dois testes.

Um diagnóstico separado após a suíte leu a configuração e executou SELECT:
loja_test, login/usuário loja_testes, HAS_DBACCESS loja = 0 e zero tabelas.
Isso conferiu o estado do banco após a suíte; não é uma terceira asserção ou
um terceiro caso executado pelo PHPUnit.

git status confirmou código/configuração preservados antes dos novos registros;
segredos continuam ignorados e ausentes do índice. git diff --check passou.
Nenhuma dependência instalada ou credencial alterada.

## Continuidade

Entendimento da 5.39 confirmado com "entendi" em 19/10/2026. Publicar os registros
e iniciar 5.40: preparar a tabela produtos em loja_test a partir da migration
existente, conferindo identidade da conexão e esquema. Os testes de catálogo
serão preparados após essa estrutura estar disponível.
