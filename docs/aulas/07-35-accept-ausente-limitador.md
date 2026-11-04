# Aula 7.35 — Accept ausente no teste isolado do limitador

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.34 com "entendi". Checkpoint anterior publicado e conferido em
019c99ba9793a14d8adbded0ad910fb4754746b1; HEAD/origin/main/main remota iguais.
Entendimento da 7.35 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e alteração

Alteramos somente o helper pedir de
[LoginRateLimiterTest.php](../../backend/tests/Feature/LoginRateLimiterTest.php).
Na 7.34, corrigimos a preparação da rota em LoginApiTest e identificamos o
mesmo detalhe neste teste isolado: omitir HTTP_ACCEPT na criação da Request
mantinha o valor padrão do construtor. O conjunto rotulado ausente não
comprovava ausência real.

Removemos o if anterior que preenchia HTTP_ACCEPT em servidor. Depois de
Request::create, o helper agora prepara o cabeçalho diretamente:

```php
if ($accept === null) {
    $request->headers->remove('Accept');
} else {
    $request->headers->set('Accept', $accept);
}

$this->assertSame($accept !== null, $request->headers->has('Accept'));
$this->assertSame($accept, $request->headers->get('Accept'));
```

Null significa que a entrada deve estar ausente. Remove elimina a chave já
criada pelo construtor; set define a string solicitada para os outros casos.
Has informa se o cabeçalho existe, get devolve seu valor ou null quando ausente.
A primeira asserção compara presença esperada com presença real; a segunda
compara o valor. Ambas ocorrem antes de chamar ThrottleRequests.

Assim, uma preparação incorreta da requisição faz o teste falhar antes das
asserções da resposta. Accept informa formatos desejados pelo cliente. A regra
de bloqueio já configurada continua devolvendo JSON nos três casos.

Imports, DataProvider, relógio, cache array, regra e cenários preservados.
O middleware real recebe nome login e próxima função ilustrativa com contador.
Este arquivo continua isolando o limitador; não executa kernel HTTP, sessão,
CSRF, autenticação ou fixtures de usuários. LoginApiTest mantém a cobertura
da rota real introduzida na 7.34.

## Verificações em Docker

```sh
docker compose exec -T backend php -l tests/Feature/LoginRateLimiterTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginRateLimiterTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l conferiu sintaxe. O comando focado executou os seis cenários existentes;
testdox mostrou seus nomes. A última chamada executou a suíte completa;
do-not-cache-result evitou gravar cache dos resultados do PHPUnit.

Sintaxe válida; focado 6 testes/236 asserções, código 0. Antes eram 6/156.
O helper é chamado 40 vezes: duas asserções novas por chamada somam 80.
Suíte completa: 99 testes/1.306 asserções, código 0, antes 99/1.226. Nenhum
novo método ou cenário; agora o caso ausente verifica o cabeçalho pretendido.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro
migrations/lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/
categorias. Sem nova auditoria, snapshot normal ou quatro contratos de catálogo.

## Continuidade

Correção implementada, explicada e verificada; entendimento confirmado com "entendi" em 04/11/2026.
Documentos atualizados; nenhum código de aplicação, configuração, dependência,
ambiente, migration ou OpenAPI alterado. Publicação da 7.35 pendente.
Após publicar: 7.36 — adicionar somente cenário de sucesso de
login por HTTP em LoginApiTest, com User fictício em loja_test/transação e
verificação de 204, identidade e renovação da sessão. Fluxo real de CSRF/cookies
continua pendente para etapa própria.
