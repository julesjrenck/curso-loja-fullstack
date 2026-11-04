# Aula 7.36 — Login bem-sucedido pelo kernel HTTP

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.35 com "entendi". Checkpoint anterior publicado e conferido em
1f0f2554b00d3f3a39696ff26475bc4c2dbb132d; HEAD/origin/main/main remota iguais.
Entendimento da 7.36 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Alteramos somente [LoginApiTest.php](../../backend/tests/Feature/LoginApiTest.php),
adicionando um cenário de sucesso pela rota POST /api/v1/login. O kernel executa
os middlewares, a LoginRequest e o LoginController reais; o guard web confere
as credenciais no SQL Server. Nenhum actingAs ou substituto do guard.

## Transação e conferência de identidade

Novos imports: User, DatabaseTransactions, Auth e DB. A classe passou a usar
DatabaseTransactions; portanto cada execução, inclusive os três casos de
entrada inválida existentes, começa uma transação e termina com rollback.
Não executamos migrations automaticamente ou recriamos tabelas.

SetUp chama parent, consulta DB_NAME/SUSER_SNAME e exige loja_test/loja_testes
antes de qualquer escrita da fixture. O trait já abriu a transação ao chamar
parent; não houve escrita de usuário antes dessa conferência. Cache/sessão
array e relógio controlado/restaurado continuam exigidos.

O novo método limpa users dentro da transação e cria Ana Exemplo com e-mail
ana@example.test e senha fictícia definida na constante privada SENHA.
O cast hashed já existente no modelo grava o hash. O POST recebe a senha
original para o guard conferir; não enviamos hash como credencial.

## Sessão de visitante e cookie de entrada

```php
$this->withSession(['marcador_visitante' => 'sessao-do-teste']);
$sessao = $this->app['session']->driver();
$idAnterior = $sessao->getId();
$tokenAnterior = $sessao->token();
$sessao->save();

$this->assertGuest('web');
$this->withCookie(config('session.cookie'), $idAnterior);
```

WithSession inicia a sessão de teste e coloca um marcador fictício nela.
Guardamos ID e token CSRF anteriores somente em memória; save grava o estado
no handler array. AssertGuest confirma que ainda não existe autenticação.
WithCookie prepara o cookie de sessão para o pedido, usando o nome configurado.
Esses helpers preparam sessão/cookie; não autenticam o visitante.

O marcador permite conferir que dados da sessão anterior continuam disponíveis
após o login, apesar da renovação do identificador. Não representa um campo
de negócio da aplicação e não foi adicionado ao controller.

## Helper compartilhado

Pedir agora recebe ?string accept e array dados com padrão vazio. No sucesso,
passamos email/password; os testes anteriores continuam passando apenas Accept.

```php
$request = Request::create(
    'http://127.0.0.1:8002/api/v1/login', 'POST', [], $this->prepareCookiesForRequest(), [], $servidor,
    json_encode((object) $dados, JSON_THROW_ON_ERROR),
);
```

O cast para object mantém {} quando dados está vazio e produz objeto JSON
com email/password no sucesso. JSON_THROW_ON_ERROR torna falhas de codificação
visíveis. Parâmetros de formulário e arquivos continuam vazios.

PrepareCookiesForRequest é helper herdado do Laravel: prepara os cookies
definidos por withCookie e aplica a criptografia esperada pelo middleware.
Nos casos antigos, não há cookie configurado e a lista continua vazia.
Não escrevemos criptografia própria nem removemos o middleware de cookies.

Origem local reconhecida, preparação explícita de Accept, asserções de
presença/valor, kernel handle/terminate, hasSession e TestResponse permanecem.
Fontes: [sessão/autenticação nos testes](https://laravel.com/docs/13.x/http-tests#session-and-authentication)
e [cookies nos testes](https://laravel.com/docs/13.x/http-tests#cookies).

## Resultado exigido do sucesso

O POST passa pela rota com dados válidos. Exigimos:

- 204 sem corpo e sem Location, por assertNoContent/assertHeaderMissing.
- Cookie de saída contendo o ID atual da sessão, conferido por assertCookie.
- Cookie de entrada, após middleware, contendo o ID anterior preparado.
- Guard web autenticado como a fixture e ID dela armazenado na sessão.
- Marcador de visitante preservado e ID/token CSRF diferentes dos anteriores.

AssertAuthenticatedAs verifica o resultado da autenticação; não configura a
identidade. Auth::guard('web')->getName fornece a chave interna usada pelo guard
na sessão. BaseRequest permite conferir o cookie que o middleware leu.
Os testes não imprimem nem versionam valores de IDs, tokens ou cookies.

O teste comprova a integração da rota ao guard/sessão e aos middlewares de
cookie no processo de teste. Não há rede/navegador, e testing dispensa a
validação CSRF da requisição. Renovar o token foi verificado; o transporte e
a rejeição real de CSRF continuam pendentes. Não exigimos Content-Type JSON
para uma resposta 204 vazia.

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/LoginApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado 4 testes/294 asserções, código 0: um sucesso e três
execuções de entrada inválida/limite. Antes eram 3/267. Suíte completa passou:
100 testes/1.333 asserções, código 0, antes 99/1.306.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Fixture desfeita pelo rollback. Nenhuma conta criada no banco normal; sem nova
auditoria, snapshot normal ou execução dos quatro contratos de catálogo.

## Continuidade

Cenário implementado, explicado e verificado; entendimento confirmado com "entendi" em 04/11/2026.
Documentos/contratos atualizados. Nenhum código de aplicação, configuração,
dependência, ambiente, migration, rota ou OpenAPI alterado. Publicação pendente.
Após publicar: 7.37 — adicionar somente cenário de credenciais
recusadas por HTTP em LoginApiTest, com senha incorreta/e-mail inexistente,
422 genérico igual e visitante preservado. Fluxo real de CSRF/cookies continua
para etapa própria.
