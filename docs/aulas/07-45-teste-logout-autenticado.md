# Aula 7.45 — Teste permanente de logout autenticado

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.44 com "entendi". Checkpoint anterior publicado e conferido em
b206ca50fe0de7433a4ad5d2bfb8173517900ad2; HEAD/origin/main/main remota iguais.
Entendimento da 7.45 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Alteramos somente [LoginControllerTest](../../backend/tests/Feature/LoginControllerTest.php)
no código: import Illuminate\Http\Request e um método público de teste para
preservar o logout autenticado do [contrato](../api/logout.md).
Os testes de store, helper e setUp continuam iguais. Controller e rotas não mudaram.

SetUp já inicializa Laravel, exige loja_test/loja_testes e sessão array antes
de escrever, cria User fictício e inicia sessão visitante. DatabaseTransactions
desfaz a execução ao final. O novo método usa essa preparação existente.

## Preparar um estado autenticado conhecido

Request::create monta POST sem corpo para o caminho ilustrativo /api/v1/logout,
com Accept JSON. Isso não registra rota nem executa endpoint. SetLaravelSession
anexa a sessão usada pelo guard e app->instance registra a requisição atual.

```php
$guard = Auth::guard('web');
$guard->login($this->usuario);
$this->assertAuthenticatedAs($this->usuario, 'web');
```

Login prepara autenticação pelo guard real; o cenário não confere credenciais
ou chama store. Exigimos também a identidade na sessão. Colocamos um marcador
para comprovar a remoção dos demais atributos, guardamos ID/token anteriores
apenas em memória e exigimos token string não vazio.

Save grava no handler array. Read com ID anterior precisa ser não vazio antes
de destroy: a verificação posterior de remoção não pode passar por um registro
que nunca existiu. Não há sessão em arquivo ou cookie transportado nesta chamada.

## Executar e conferir o resultado

```php
$resposta = TestResponse::fromBaseResponse(
    (new LoginController())->destroy($request),
);

$resposta->assertNoContent()->assertHeaderMissing('Location');
```

TestResponse oferece asserções sobre a resposta Laravel: 204 e corpo vazio,
sem destino de redirecionamento. As demais asserções exigem guard visitante/ID
null, ausência da chave de login e do marcador, ID diferente, token string não
vazio/diferente e read vazio para o registro antigo. ArrayNotHasKey confere que
o atributo saiu do conjunto, não somente que seu valor virou null.

## Recarregar a sessão salva

```php
$sessao->save();
$sessao->flush();
Auth::forgetGuards();
$sessao->start();
```

Guardamos ID/token novos antes dessa sequência. Save grava o estado após logout;
flush limpa apenas atributos em memória, sem salvar a limpeza; forgetGuards
descarta os guards já resolvidos. Start carrega novamente do mesmo handler array.
Exigimos visitante/ID null, chaves de login/marcador ausentes e ID/token novos
preservados. Isso impede que o teste dependa apenas do estado em memória do
guard anterior. Não é nova requisição HTTP nem consulta GET usuario.

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/LoginControllerTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginControllerTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l confere sintaxe. O primeiro PHPUnit seleciona o arquivo do controller;
o segundo executa a suíte inteira. Exec -T usa o serviço backend sem terminal
interativo; colors never evita escapes de cor e do-not-cache-result preserva
o cache de resultados. Configuração de teste existente, sessão/cache array.

Sintaxe válida. Arquivo focado: 3 testes/76 asserções, código 0. Suíte completa:
102 testes/1.436 asserções, código 0. O cenário novo acrescenta um teste e 29
asserções, incluindo a preparação comum, aos resultados anteriores.

SELECT posterior em loja_test/loja_testes confirmou seis tabelas, quatro
migrations com lotes 1/2/3/4 e zero categorias/produtos/users/password_reset_tokens/
sessions. Lotes convertidos para int antes da comparação; rollback conferido.
Nenhum valor real de senha/hash/cookie/ID de sessão/token impresso ou versionado.

Git diff --check passou. Links locais válidos: contrato de logout três,
login quatro, consulta cinco, aulas 7.44/7.45 dois cada. Escopo conferido:
somente LoginControllerTest e documentos; índice vazio. Aplicação/rotas/
bootstrap/Compose/OpenAPI sem diff, rota de logout ainda ausente.

## Continuidade

Teste implementado, explicado e verificado; entendimento confirmado em 04/11/2026.
Aplicação, ambientes, dependências, serviços, migrations, rotas, bootstrap,
Compose e OpenAPI preservados. Sem logout HTTP/CSRF/cookies, GET usuario após
logout ou navegador/CORS. Auditoria e snapshot normal não foram repetidos.
Publicação da 7.45 concluída e conferida em
3014af2851446444a32df051d3d130aad1755b81; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.46 —
um cenário permanente de logout visitante, sem registrar rota.
