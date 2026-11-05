# Aula 7.46 — Teste permanente de logout visitante

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.45 com "entendi". Checkpoint anterior publicado e conferido em
3014af2851446444a32df051d3d130aad1755b81; HEAD/origin/main/main remota iguais.
Entendimento da 7.46 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Acrescentamos somente um método público a
[LoginControllerTest](../../backend/tests/Feature/LoginControllerTest.php), para
preservar a decisão do [contrato de logout](../api/logout.md): visitante com
sessão preparada também pode concluir a ação e receber 204 vazio.
Imports, setUp, helpers, testes anteriores e controller continuam iguais.

O setUp exige loja_test/loja_testes e sessão array, prepara User dentro de
DatabaseTransactions e inicia a sessão visitante. A conta existe no banco,
mas o novo cenário não a autentica. Não há chamada a login, store ou actingAs.

## Estado inicial explícito

Request::create monta POST sem corpo/Accept JSON para caminho ilustrativo
/api/v1/logout; setLaravelSession anexa a sessão e app->instance registra
a requisição atual. Isso não registra rota nem executa pipeline HTTP.

```php
$guard = Auth::guard('web');
$this->assertGuest('web');
$this->assertNull($guard->id());
$this->assertArrayNotHasKey($guard->getName(), $sessao->all());
```

Exigimos ausência de identidade no guard e de chave de login na sessão antes
da ação. Um marcador representa dados guardados por um visitante. ID/token
anteriores ficam só em memória; o token precisa ser string não vazia. Save/read
confere que o registro antigo existe no handler array antes de testar sua remoção.

## Chamada direta e resultado

TestResponse envolve a resposta de (new LoginController())->destroy($request).
AssertNoContent exige 204 e corpo vazio; assertHeaderMissing Location exige
ausência de destino de redirecionamento. O método não exige usuário autenticado.

Asserções seguintes exigem visitante/ID null, chaves de login/marcador ausentes,
ID diferente, token string não vazio/diferente e registro antigo removido.
Mesmo sem identidade para retirar, a sessão anterior precisa ser invalidada.

Guardamos ID/token novos e repetimos o controle da 7.45: save grava o estado,
flush limpa só atributos em memória, forgetGuards descarta instâncias de guards
e start recarrega do mesmo handler array. Exigimos visitante/ID null, chaves
ausentes e ID/token novos preservados após recarga. Não é outra requisição HTTP.

Esse teste cobre uma chamada iniciada como visitante. A preparação comum cria
seu próprio estado por execução; não depende de um teste de logout anterior.
Proteção CSRF e transporte de cookies continuam fora dessa chamada direta.

## Verificações no Docker

```sh
docker compose exec -T backend php -l tests/Feature/LoginControllerTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginControllerTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l verifica sintaxe; primeiro PHPUnit seleciona o arquivo e o segundo roda
a suíte inteira. Exec -T executa no serviço backend sem terminal interativo;
colors never evita escapes e do-not-cache-result evita gravar cache de resultados.
Sessão/cache array e banco exclusivo de testes pela configuração existente.

Sintaxe válida; focado 4 testes/104 asserções e suíte 103 testes/1.464 asserções,
códigos 0. Um teste e 28 asserções, incluindo setUp, a mais que na 7.45.
SELECT posterior exigiu loja_test/loja_testes e confirmou seis tabelas, quatro
migrations/lotes 1/2/3/4 e zero categorias/produtos/users/password_reset_tokens/
sessions. Lotes convertidos para int; rollback conferido. Nenhum valor real
de senha/hash/cookie/token/ID impresso ou versionado.

Git diff --check passou. Links locais válidos: contrato de logout três,
login quatro, consulta cinco, aulas 7.45/7.46 dois cada. Escopo conferido:
somente LoginControllerTest e documentos; índice vazio. Aplicação/rotas/
bootstrap/Compose/OpenAPI sem diff, rota de logout ainda ausente.

## Continuidade

Teste implementado, explicado e verificado; entendimento confirmado em 04/11/2026.
Aplicação, ambientes, dependências, serviços, migrations, rotas, bootstrap,
Compose e OpenAPI preservados. Sem logout HTTP/CSRF/cookies ou GET usuario após
logout. Navegador/CORS pendentes; auditoria/snapshot normal não repetidos.
Publicação da 7.46 pendente. Próxima após confirmar/publicar: 7.47 — registrar
somente POST /api/v1/logout ligado a LoginController::destroy, sem auth:sanctum
ou throttle:login, e conferir rota/resposta de visitante pelo kernel HTTP.
Não implementamos a rota nesta etapa.
