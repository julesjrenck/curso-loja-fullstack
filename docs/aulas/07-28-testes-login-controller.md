# Aula 7.28 — Testes da autenticação no controller

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.27 com "entendi". Checkpoint anterior publicado e conferido em
10416ad5d8fa44cec71e353551cfae30187e3521; HEAD/origin/main/main remota iguais.
Entendimento da 7.28 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginControllerTest](../../backend/tests/Feature/LoginControllerTest.php)
para preservar sucesso, falhas genéricas e renovação da sessão do
[contrato de login](../api/login.md). Não alteramos o controller nem registramos rota.
São dois métodos de teste cobrindo três tentativas: sucesso e duas falhas.

Imports trazem controller, LoginRequest, User, handler, DatabaseTransactions,
facades Auth/DB, TestResponse, ValidationException e TestCase da aplicação.
O trait abre transação e desfaz cada execução. A constante privada SENHA é
fictícia, e a propriedade tipada User $usuario guarda a conta criada pelo setUp.

## Preparação comum

SetUp chama parent::setUp para inicializar Laravel/transação e exige identidade
loja_test/loja_testes e session.driver array antes de DELETE/INSERT. Limpa users
dentro da transação e cria Ana com senha fictícia, tratada pelo cast do model.
Inicia a sessão array e usa assertGuest('web') para exigir visitante inicialmente.
Cada método recebe sua própria aplicação/conta/sessão de teste.

O helper privado criarRequest recebe email/senha e monta LoginRequest POST JSON
para caminho ilustrativo /api/v1/login. Inclui remember=true/id=999 extras para
preservar o uso de validated pelo controller. Configura container/redirector,
anexa a mesma sessão usada pelo guard e registra a Request atual no container.
Chama validateResolved antes de devolver a requisição.

Essa preparação não executa endpoint ou normalizadores HTTP: os valores já
estão no formato válido e a normalização tem seus testes próprios da 7.26.
Não usamos actingAs ou mock de autenticação; o controller chama o guard real
para consultar o User persistido e conferir a senha.

## Sucesso

O teste guarda ID e token CSRF anteriores somente em memória e chama store:

```php
$resposta = TestResponse::fromBaseResponse(
    (new LoginController())->store($request),
);

$resposta->assertNoContent()->assertHeaderMissing('Location');
```

AssertNoContent exige status 204 e corpo vazio; Location ausente exclui destino
de redirecionamento nessa resposta. AssertAuthenticatedAs exige Ana no guard web.
Conferimos também o ID de usuário na sessão, ID/token CSRF diferentes dos
anteriores e remember_token ainda null na consulta fresh. O remember enviado
como extra não ativou autenticação persistente. Não fixamos IDs de banco/sessão.

## Duas falhas com corpo igual

O segundo método usa foreach com senha incorreta e e-mail inexistente. Para
cada entrada, cria Request validada, guarda ID/token, chama store e exige
ValidationException em try/catch. Confere somente email nos campos de erro,
renderiza a exceção pelo handler e usa TestResponse para 422/application/json,
sem Location e com erros em email. Se store aceitar, fail acusa o caso.

AssertGuest exige que continue visitante. AssertSame compara ID/token antes e
depois para impedir renovação indevida nas falhas. O corpo deve ter apenas
message/errors, mensagem string e uma string em errors.email. Guardamos os
dois corpos e comparamos:

```php
$this->assertSame($corpos[0], $corpos[1]);
```

Não fixamos a tradução; exigimos que senha incorreta e conta ausente produzam
o mesmo corpo. Continue passa ao próximo caso após as asserções. As duas
tentativas diretas ficam no mesmo método para essa comparação; não são duas
requisições HTTP pelo kernel. Isso não prova igualdade de tempo de processamento.

Referência: [asserções HTTP e de autenticação do Laravel](https://laravel.com/docs/13.x/http-tests).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/LoginControllerTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginControllerTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; focado 2 testes/47 asserções, código 0. Suíte completa:
90 testes/803 asserções, código 0, soma dos 2/47 aos 88/756 anteriores.
SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Rollback conferido; sessões somente em memória. Sem valores privados impressos
nas execuções. A autenticação real pelo guard é testada; pipeline HTTP, CSRF e
transporte de cookies no navegador permanecem para a integração futura.

Aplicação, dependências, ambientes, rotas, bootstrap e OpenAPI preservados.
Não há POST /api/v1/login registrado. Auditoria, snapshot normal e quatro
contratos não foram repetidos.

## Continuidade

Testes criados, explicados e verificados; entendimento confirmado com "entendi"
em 04/11/2026; publicação conferida em
e6ac54f1e3b4a9b69815d641c6a340991f43eeb6, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade na 7.29 —
desenhar a limitação de tentativas do login, com chave de contagem, janela e
resposta 429, antes de implementar o limitador ou registrar a rota.
