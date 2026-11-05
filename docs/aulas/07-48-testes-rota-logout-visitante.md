# Aula 7.48 — Testes da rota de logout para visitante

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.47 com "entendi". Checkpoint anterior publicado e conferido em
e6c30c69e682eed035e1a64e2633151d4d4d9f94; HEAD/origin/main/main remota iguais.
Entendimento da 7.48 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Criamos somente [LogoutApiTest](../../backend/tests/Feature/LogoutApiTest.php)
no código, para preservar a resposta visitante da rota do
[contrato de logout](../api/logout.md). PHPUnit descobre a classe no diretório
Feature já configurado; aplicação, rotas e configurações continuam iguais.

Imports trazem contrato Kernel HTTP, Request, facades Auth/DB, TestResponse,
atributo DataProvider e TestCase da aplicação. SetUp chama parent, consulta
DB_NAME/SUSER_SNAME e exige loja_test/loja_testes, sessão/cache array.
Não criamos User, autenticamos ou escrevemos no banco nesse cenário; não há
fixture que exija DatabaseTransactions nesta etapa. Cada execução recebe
sua própria aplicação/estado de teste.

## Um cenário, três entradas

```php
#[DataProvider('formatosAccept')]
public function test_visitante_recebe_204_sem_corpo_independentemente_do_accept(?string $accept): void
```

DataProvider seleciona o método público estático formatosAccept. Ele devolve
três conjuntos nomeados: JSON/application/json, HTML/text/html e ausente/null.
?string admite string ou null; PHPUnit executa o cenário uma vez por conjunto.

Começamos exigindo guard web visitante. Request::create prepara POST para
127.0.0.1:8002/api/v1/logout, Origin reconhecido igual, IP local e corpo/cookies
vazios. Não usamos helper que acrescente Accept JSON automaticamente.

```php
if ($accept === null) {
    $request->headers->remove('Accept');
} else {
    $request->headers->set('Accept', $accept);
}
```

Remoção explícita evita herdar o padrão do construtor. Duas asserções exigem
presença compatível com null e valor exato, antes de executar a requisição.
Também conferimos cookies vazios e corpo vazio na entrada.

## Kernel, resposta e sessão

Make resolve o Kernel HTTP pelo container; handle executa middleware/rota/
controller e terminate conclui o ciclo. TestResponse::fromBaseResponse recebe
resposta e requisição para usar as asserções Laravel. Não chamamos destroy
diretamente neste teste.

AssertNoContent exige 204 e corpo vazio; assertHeaderMissing Location exige
ausência de redirecionamento. AssertCookie confere emissão dos cookies de
sessão e XSRF-TOKEN. Não comparamos valores privados nem prometemos Content-Type
JSON em uma resposta sem corpo.

Exigimos sessão anexada à Request, atributo sanctum true, guard visitante,
ID null e chave de login ausente nos atributos da sessão. Isso confirma o
fluxo de sessão da interface própria, com ausência de identidade no resultado.
A emissão dos cookies não prova armazenamento/reenvio pelo navegador.

Ambiente testing mantém CSRF ignorado neste fluxo pelo kernel. Não confere
419, navegador/CORS, logout autenticado ou GET usuario após logout. O diagnóstico
temporário da 7.47 não foi repetido; os casos agora estão na suíte permanente.

## Verificações no Docker

```sh
docker compose exec -T backend php -l tests/Feature/LogoutApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LogoutApiTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l confere sintaxe; primeiro PHPUnit seleciona o novo arquivo, segundo roda
a suíte inteira. Exec -T usa backend sem terminal interativo; colors never
evita escapes, do-not-cache-result evita gravar cache de resultados.

Sintaxe válida. Focado: 3 testes/57 asserções. Suíte completa: 106 testes/1.521
asserções. Códigos 0; três testes/57 asserções adicionados à 7.47.
SELECT posterior em loja_test/loja_testes confirmou seis tabelas, quatro
migrations/lotes 1/2/3/4 (int explícito) e zero categorias/produtos/users/
password_reset_tokens/sessions. Nenhum dado de teste permaneceu. Sem valores
reais de senha/hash/cookie/token/ID impressos ou versionados.

Git diff --check passou. Links locais válidos: logout três, login quatro,
consulta cinco, aulas 7.47/7.48 três e dois respectivamente. Escopo conferido:
somente LogoutApiTest novo e documentos; índice vazio. Aplicação/rotas/
controller/bootstrap/Compose/OpenAPI sem diff, OpenAPI ainda sem logout.

## Continuidade

Testes criados, explicados e verificados; entendimento confirmado em 04/11/2026.
Aplicação, rotas, controller, bootstrap, ambientes, dependências, serviços,
migrations, Compose e OpenAPI preservados. Sem auditoria/snapshot normal.
Publicação da 7.48 pendente. Próxima após confirmar/publicar: 7.49 — adicionar
um cenário autenticado pela rota em LogoutApiTest, com User fictício/transação
em loja_test, guard web real e sessão/cookie de entrada; conferir 204 e limpeza
da sessão. GET usuario após logout, CSRF ativo/cookies no navegador, CORS e
OpenAPI de logout seguem pendentes.
