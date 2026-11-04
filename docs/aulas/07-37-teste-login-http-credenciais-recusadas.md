# Aula 7.37 — Credenciais recusadas pelo kernel HTTP

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.36 com "entendi". Checkpoint anterior publicado e conferido em
be62fdf65851bc52d2f2b7c042c9e22a6856882a; HEAD/origin/main/main remota iguais.
Entendimento da 7.37 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Adicionamos somente test_credenciais_recusadas_retornam_mesmo_422_e_preservam_visitante
em [LoginApiTest.php](../../backend/tests/Feature/LoginApiTest.php). O teste usa
a rota POST /api/v1/login, passando pelo kernel, middlewares, LoginRequest,
LoginController e guard web reais. Não houve alteração de imports, helpers
ou dos cenários anteriores.

Os dois pedidos têm formato válido, portanto a LoginRequest permite tentar
autenticar. Um usa conta existente com senha incorreta; outro usa e-mail
inexistente. O guard recusa ambos, e o controller gera o erro genérico 422
em email conforme o contrato. O corpo não distingue as duas causas.

## Fixture e sessão

O método limpa users e cria Ana Exemplo dentro da transação já configurada
na classe. SetUp exige loja_test/loja_testes antes de DML, cache/sessão array
e relógio fixado. O cast hashed do modelo processa a senha fictícia da fixture.
DatabaseTransactions desfaz essas operações ao encerrar a execução.

Reutilizamos a preparação já estudada: withSession com marcador fictício,
captura do ID/token anteriores, save no handler array, assertGuest e withCookie
com o ID anterior. Não há identidade autenticada nessa sessão inicial.
O helper pedir mantém origem reconhecida e prepara o cookie com criptografia
esperada pelo middleware. IDs, cookies e tokens permanecem somente em memória.

## Duas tentativas no mesmo método

```php
foreach ([
    [$usuario->email, 'outra-senha-ficticia'],
    ['ausente@example.test', self::SENHA],
] as [$email, $senha]) {
    $resposta = $this->pedir('application/json', [
        'email' => $email,
        'password' => $senha,
    ]);
}
```

O foreach percorre dois pares; a desestruturação coloca cada valor em email
e senha. São duas requisições dentro de um teste PHPUnit. Mesmo IP, somente
duas tentativas: ambas ficam dentro do limite de cinco. Nenhuma identidade
é configurada com actingAs.

## Resposta e preservação do visitante

Em cada resposta, exigimos 422/application/json, sem Location e cookie de saída
com o ID anterior. AssertJsonValidationErrors exige erro em email; conferências
de chaves/tipos exigem somente message string e errors com apenas email,
contendo uma única mensagem string. Não fixamos tradução ou texto literal.

AssertGuest confirma visitante, e a chave usada pelo guard web na sessão deve
continuar null. Também conferimos cookie de entrada com ID anterior, ID/token
da sessão iguais aos anteriores e marcador preservado. Falha de credenciais
não estabelece uma identidade nem renova essa sessão de visitante.

Guardamos cada corpo decodificado em corpos e comparamos ao final:

```php
$this->assertSame($corpos[0], $corpos[1]);
```

Isso exige a mesma resposta pública para senha incorreta e e-mail inexistente,
sem depender de uma mensagem traduzida específica. O kernel já renderiza a
exceção como resposta: não capturamos ValidationException manualmente.

## Verificações em Docker

```sh
docker compose exec -T backend php -l tests/Feature/LoginApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado: 5 testes/344 asserções, código 0, antes 4/294.
Um novo método executa os dois casos de credenciais recusadas. Sucesso e três
execuções de entrada inválida/limite permanecem passando. Suíte completa:
101 testes/1.383 asserções, código 0, antes 100/1.333.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Rollback conferido. Sem criar contas no banco normal ou repetir auditoria,
snapshot normal e quatro contratos de catálogo.

## Continuidade

Cenário implementado, explicado e verificado; entendimento confirmado com "entendi" em 04/11/2026.
Documentos/contratos atualizados; nenhum código de aplicação, configuração,
dependência, ambiente, migration, rota ou OpenAPI alterado. Publicação pendente.
Testes sem rede/navegador; testing dispensa validação CSRF da requisição.
Após publicar: 7.38 — ampliar o cenário de sucesso para consultar
GET /api/v1/usuario usando o novo cookie de sessão e guard recriado, conferindo
somente id/name/email. Fluxo real de CSRF/cookies continua para etapa própria.
