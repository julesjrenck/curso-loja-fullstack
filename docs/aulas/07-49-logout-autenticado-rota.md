# Aula 7.49 — Logout autenticado pela rota

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.48 com "entendi". Checkpoint anterior publicado e conferido em
1ddeaade0a952e7fded20758e20ffea7fd30929f; HEAD/origin/main/main remota iguais.
Entendimento da 7.49 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Alteramos somente [LogoutApiTest](../../backend/tests/Feature/LogoutApiTest.php)
no código: imports User/DatabaseTransactions, uso do trait e um cenário
autenticado do [contrato de logout](../api/logout.md). SetUp, DataProvider e
cenário visitante continuam iguais; aplicação/rotas não mudaram.

Agora há fixture persistida no teste. DatabaseTransactions abre transação para
cada execução da classe e a desfaz no encerramento. SetUp existente exige
loja_test/loja_testes e sessão/cache array antes de criar o User fictício.
Não usamos DELETE para limpar usuários; a fixture criada é desfeita pelo trait.

## Preparar a sessão autenticada

Criamos Ana Exemplo com email/senha fictícios. O cast do model User gera o hash.
Iniciamos sessão array, exigimos visitante inicialmente e preparamos identidade
com Auth::guard('web')->login($usuario), sem actingAs ou executar POST login.
AssertAuthenticatedAs e o ID na chave do guard confirmam o estado preparado.

Colocamos um marcador, guardamos ID/token anteriores só em memória e exigimos
token string não vazio. Save grava a sessão no handler array; read confirma
registro anterior existente. A identidade e o marcador estão no armazenamento
que o pedido deverá carregar.

## Receber a sessão pelo cookie

```php
$sessao->flush();
Auth::forgetGuards();
```

Flush limpa atributos em memória sem salvar a limpeza. ForgetGuards descarta
instâncias de guard. Conferimos ausência de identidade/marcador em memória e
guard visitante antes do pedido. A sessão salva continua no handler array.

WithCookie guarda o ID anterior no contexto do teste; prepareCookiesForRequest
prepara sua criptografia para o middleware Laravel. Request POST sem corpo usa
esse cookie, Accept JSON, Origin local reconhecido e IP local. O kernel executa
middleware/rota/controller e terminate conclui o ciclo.

Esse controle impede depender apenas da identidade preparada no guard anterior.
Não é uma troca de cookies em navegador ou fluxo completo de login por HTTP.

## Resultado conferido

TestResponse exige 204 vazio/sem Location, cookie de sessão com ID resultante
e cookie XSRF-TOKEN. Não prometemos Content-Type JSON no corpo vazio.

Após o middleware, a Request deve conter o ID anterior decifrado no cookie,
ter sessão/atributo sanctum e usar a mesma instância de Store da aplicação.
O resultado exige guard visitante/ID null, chaves de login/marcador ausentes,
ID diferente, token string não vazio/diferente e registro antigo removido do
handler array. Valores privados só são comparados em memória.

Não chamamos GET usuario após logout nesta etapa. CSRF é ignorado no ambiente
testing; navegador/CORS e proteção ativa continuam pendentes.

## Verificações no Docker

```sh
docker compose exec -T backend php -l tests/Feature/LogoutApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LogoutApiTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l confere sintaxe; primeiro PHPUnit seleciona o arquivo, segundo roda a
suíte inteira. Exec -T usa backend sem terminal interativo; colors never evita
escapes, do-not-cache-result evita gravar cache de resultados.

Sintaxe válida. Focado: 4 testes/91 asserções; suíte: 107 testes/1.555 asserções,
códigos 0. Um teste e 34 asserções, incluindo preparação comum, a mais que na 7.48.
SELECT posterior em loja_test/loja_testes confirmou seis tabelas, quatro
migrations/lotes 1/2/3/4 (int explícito) e zero categorias/produtos/users/
password_reset_tokens/sessions. Rollback conferido; sessões/cache em memória.
Nenhum valor real de senha/hash/cookie/token/ID impresso ou versionado.

Git diff --check passou. Links locais válidos: logout três, login quatro,
consulta cinco, aulas 7.48/7.49 dois cada. Escopo conferido: somente LogoutApiTest
e documentos; índice vazio. Aplicação/rotas/controller/bootstrap/Compose/OpenAPI
sem diff, OpenAPI ainda sem logout.

## Continuidade

Teste implementado, explicado e verificado; entendimento confirmado em 04/11/2026.
Aplicação, rotas, controller, bootstrap, ambientes, dependências, serviços,
migrations, Compose e OpenAPI preservados. Auditoria/snapshot normal não repetidos.
Publicação da 7.49 concluída e conferida em
0eaa7b50e28a4e50449025b07ee02889ee84aaf0; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.50 —
GET usuario após logout com cookie da resposta, exigindo 401 JSON.
CSRF ativo/cookies no navegador, CORS e OpenAPI de logout seguem pendentes.
