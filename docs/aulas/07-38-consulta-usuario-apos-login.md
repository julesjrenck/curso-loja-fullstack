# Aula 7.38 — Consulta do usuário com o cookie recebido no login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.37 com "entendi". Checkpoint anterior publicado e conferido em
10c260cf6b61945d06896d2d32da4b154641d5c2; HEAD/origin/main/main remota iguais.
Entendimento da 7.38 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Ampliamos somente o cenário de sucesso de
[LoginApiTest.php](../../backend/tests/Feature/LoginApiTest.php). Renomeado para
test_login_valido_renova_sessao_e_permite_consultar_usuario; mantém as asserções
do POST e acrescenta GET /api/v1/usuario. Não criamos novo método/cenário.

O POST autentica pelo guard web e grava a identidade na sessão. Seu cookie
identifica essa sessão. O GET protegido por auth:sanctum deve recuperá-la,
carregar o usuário e entregar o contrato público do UsuarioResource.
Fixture/transação em loja_test, origem reconhecida, cache/sessão array,
relógio e cenários de falha/limite preservados.

## Obter o cookie da resposta

```php
$cookieAutenticado = $resposta->getCookie(config('session.cookie'));
$this->assertNotNull($cookieAutenticado);
$idAutenticado = $cookieAutenticado->getValue();
```

GetCookie procura pelo nome configurado na resposta do POST. O helper de teste
decifra seu valor por padrão e devolve um objeto Cookie. AssertNotNull exige
que ele exista; getValue fornece o ID recebido, guardado somente em memória.
Com withCookie, esse valor será preparado e criptografado novamente pelo helper
do Laravel para a próxima requisição. Não escrevemos criptografia própria.

## Retirar estado já carregado no processo

As requisições do teste usam a mesma aplicação. O guard web já contém o usuário
carregado pelo POST, e o objeto da sessão tem seus atributos em memória.
Preparamos a nova consulta para que ela precise recuperar esses dados:

```php
$chaveIdentidade = Auth::guard('web')->getName();
$sessao->flush();
$this->assertNull($sessao->get($chaveIdentidade));
Auth::forgetGuards();
```

GetName obtém a chave interna da identidade na sessão. Flush limpa os atributos
do objeto Store em memória; a asserção exige que a identidade tenha saído dessa
cópia. O POST já salvou a sessão no handler array; os dados gravados continuam
disponíveis. Não chamamos save entre esse flush e o GET. ForgetGuards descarta
os guards resolvidos; o fluxo de autenticação criará instâncias novas.
Trechos instalados de Store::flush/AuthManager::forgetGuards foram conferidos.

## Nova requisição protegida

```php
$consulta = $this->withCookie(config('session.cookie'), $idAutenticado)
    ->withCredentials()
    ->getJson('http://127.0.0.1:8002/api/v1/usuario', [
        'Origin' => 'http://127.0.0.1:8002',
    ]);
```

WithCookie usa o ID obtido na resposta. WithCredentials habilita o envio de
cookies pelos helpers JSON deste teste. GetJson executa GET pelo kernel HTTP
e prepara Accept application/json. Origin local reconhecido permite ao Sanctum
preparar cookies/sessão; auth:sanctum exige identidade válida para esta rota.
O cookie escolhe a sessão, e nela o guard encontra o ID do usuário.
Não há actingAs, token Bearer ou nova chamada de login nesse GET.

Exigimos 200/application/json/sem Location e assertExactJson com somente
data/id/name/email da fixture. Isso também impede password/remember_token ou
outros campos extras nesse corpo. Conferimos que cookie de entrada e ID da
sessão correspondem ao recebido do POST, que o marcador foi recuperado e que
o guard web voltou a reconhecer a fixture. O marcador recuperado comprova
que os atributos foram recarregados após flush.

Fontes: [cookies nos testes HTTP](https://laravel.com/docs/13.x/http-tests#cookies)
e [autenticação SPA por sessão no Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication).
Helpers instalados de getCookie/withCredentials também foram consultados.

## Verificações em Docker

```sh
docker compose exec -T backend php -l tests/Feature/LoginApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado: 5 testes/357 asserções, código 0, antes 5/344.
Suíte completa: 101 testes/1.396 asserções, código 0, antes 101/1.383.
Mesmo número de testes, 13 asserções adicionais no cenário ampliado.
SELECT posterior: loja_test/loja_testes, seis tabelas, quatro migrations/lotes
1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Rollback conferido. Sem nova auditoria, snapshot normal ou quatro contratos.

## Continuidade

Cenário ampliado, explicado e verificado; entendimento confirmado com "entendi" em 04/11/2026.
Documentos/contratos atualizados. Nenhum código de aplicação, configuração,
dependência, ambiente, migration, rota ou OpenAPI alterado. Publicação concluída
e conferida em 29e7b03927e4b6aee20193085e792270c7b51fe6;
HEAD/origin/main/main remota iguais após push. Registro posterior à publicação.
O teste integra POST/GET/cookies/sessão pelo kernel dentro do processo;
transporte de rede/navegador e validação CSRF real continuam pendentes.
Continuidade realizada na 7.39 — acrescentar controle sem cookie após o login,
com estado em memória limpo e guards recriados, exigindo 401 JSON na consulta
do usuário. Não implementar logout nessa verificação.
