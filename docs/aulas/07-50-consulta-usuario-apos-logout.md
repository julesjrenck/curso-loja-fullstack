# Aula 7.50 — Consulta do usuário após logout

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.49 com "entendi". Checkpoint anterior publicado e conferido em
0eaa7b50e28a4e50449025b07ee02889ee84aaf0; HEAD/origin/main/main remota iguais.
Entendimento da 7.50 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Ampliamos somente o cenário autenticado de
[LogoutApiTest](../../backend/tests/Feature/LogoutApiTest.php), conforme o
[contrato de logout](../api/logout.md). O método foi renomeado para incluir
a consulta seguinte/401. Preparação, testes de visitante, DataProvider e
asserções anteriores de logout preservados. Aplicação/rotas não mudaram.

| Pedido no cenário | Resultado exigido |
| --- | --- |
| POST logout com sessão autenticada preparada | 204 vazio, sessão invalidada/renovada. |
| GET usuario com cookie recebido após logout | 401 JSON, sem redirecionamento, somente message string. |

O segundo pedido confirma a perda de acesso pela interface HTTP depois do
logout. Uma sessão visitante pode continuar existindo com cookies e token CSRF.

## Obter o cookie da resposta

Agora guardamos TestResponse em respostaLogout, mantendo as mesmas asserções
de 204/cookies/limpeza. GetCookie busca o cookie de sessão emitido e entrega
seu valor decifrado pelos helpers de teste. Exigimos cookie existente e ID igual
ao Store após logout; não escolhemos o ID anterior para esta consulta.
Guardamos também o token CSRF resultante, somente em memória.

Flush limpa atributos em memória sem salvar; forgetGuards descarta instâncias.
Assim, o pedido seguinte precisa recarregar a sessão salva pelo fluxo anterior.

## Consultar pelo kernel com o cookie recebido

```php
$consulta = $this->withCookie(config('session.cookie'), $idVisitante)
    ->withCredentials()
    ->getJson('http://127.0.0.1:8002/api/v1/usuario', [
        'Origin' => 'http://127.0.0.1:8002',
    ]);
```

WithCookie substitui o valor anterior no contexto do teste. WithCredentials
inclui cookies na requisição feita pelo helper JSON. GetJson usa GET/Accept JSON;
a origem reconhecida mantém o fluxo de sessão do Sanctum. Os helpers preparam
criptografia para o middleware, sem envio de rede ou uso de navegador.

```php
$consulta
    ->assertStatus(401)
    ->assertHeader('Content-Type', 'application/json')
    ->assertHeaderMissing('Location');
```

O corpo precisa ter exatamente a chave message e valor string. Não fixamos a
tradução da mensagem; o cliente pode decidir pelo status. Não há data ou HTML.

Conferimos cookie recebido na Request com o ID visitante esperado, ausência
de Authorization, sessão anexada e ID/token preservados depois de recarregar.
Guard web continua visitante/ID null, sem as chaves de identidade e marcador.
Esses controles ligam o 401 à consulta com o cookie de saída do logout.

## Verificações no Docker

```sh
docker compose exec -T backend php -l tests/Feature/LogoutApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LogoutApiTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l confere sintaxe; primeiro PHPUnit seleciona o arquivo, segundo roda a
suíte completa. Exec -T usa backend sem terminal interativo; colors never evita
escapes e do-not-cache-result evita gravar cache de resultados.

Sintaxe válida; focado 4 testes/108 asserções e suíte 107 testes/1.572 asserções,
códigos 0. Mesmo número de testes, 17 asserções adicionadas à 7.49.
DatabaseTransactions preservado; SELECT posterior exigiu loja_test/loja_testes
e confirmou seis tabelas, quatro migrations/lotes 1/2/3/4 (int explícito) e zero
categorias/produtos/users/password_reset_tokens/sessions. Rollback conferido,
sessão/cache em memória. Sem valores reais de senha/hash/cookie/token/ID impressos.

Git diff --check passou. Links locais válidos: logout três, login quatro,
consulta cinco, aulas 7.49/7.50 dois cada. Escopo conferido: somente LogoutApiTest
e documentos; índice vazio. Aplicação/rotas/controller/bootstrap/Compose/OpenAPI
sem diff, OpenAPI ainda sem logout.

## Continuidade

Cenário ampliado, explicado e verificado; entendimento confirmado em 04/11/2026.
Aplicação, rotas, controller, bootstrap, ambientes, dependências, serviços,
migrations, Compose e OpenAPI preservados. CSRF ativo/navegador/CORS pendentes;
auditoria/snapshot normal não repetidos.
Publicação da 7.50 concluída e conferida em
592581d627d43f5f88923b4f12e16a17ddb685a0; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.51 —
controle com cookie anterior ao logout. CSRF ativo/cookies no navegador, CORS
e OpenAPI de logout seguem pendentes.
