# Aula 7.31 — Testes do middleware de limitação

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.30 com "entendi". Checkpoint anterior publicado e conferido em
4c5388deb7ee7fcd803cf7aa1ff7ad8337655016; HEAD/origin/main/main remota iguais.
Entendimento da 7.31 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginRateLimiterTest](../../backend/tests/Feature/LoginRateLimiterTest.php)
para verificar a regra registrada e o middleware ThrottleRequests, conforme o
[contrato](../api/limite-login.md). Não registramos rota, trocamos limitador ou
criamos controller temporário. O middleware real recebe uma próxima função
ilustrativa; um contador registra quantas vezes ele permite alcançá-la.

Imports trazem handler/duas exceções, Request, ThrottleRequests, Carbon,
TestResponse, DataProvider e TestCase. A propriedade chamadas começa em zero.
Não há fixtures de usuários ou trait de banco nesse arquivo.

## Cache e relógio

SetUp chama parent, exige cache.default array e fixa o horário com travelTo.
Cada execução tem sua aplicação/cache em memória. TearDown usa travelBack
e depois parent para restaurar o relógio e encerrar a aplicação, inclusive
quando alguma asserção falha. Não esperamos um minuto real.

```php
$this->travel(30)->seconds();
```

Esse helper avança o horário observado pelo contador/expiração. Depois de dois
avanços de 30 segundos, chegamos a 60 segundos desde o início do cenário.
Referência: [controle de tempo nos testes Laravel](https://laravel.com/docs/13.x/mocking#interacting-with-time).

## Helper que passa pelo middleware

Pedir recebe IP, e-mail, Accept e flag de falha posterior, com valores padrão.
Os testes usam argumentos nomeados do PHP para alterar somente a entrada desejada.
O helper monta Request POST JSON ilustrativo, configura REMOTE_ADDR e omite
HTTP_ACCEPT quando o argumento for null.

```php
$this->app->make(ThrottleRequests::class)->handle(
    $request,
    function (Request $request) use ($falharDepois) {
        $this->chamadas++;

        if ($falharDepois) {
            throw ValidationException::withMessages(['email' => ['Erro fictício do teste.']]);
        }

        return response()->noContent();
    },
    'login',
);
```

Make resolve o middleware; handle recebe pedido, próxima função e nome login.
Assim usa o limitador real registrado pelo AppServiceProvider. Quando libera,
a próxima função soma uma chamada e devolve 204 ou lança erro fictício.
Não é o LoginController e não tenta autenticar; isolamos a limitação de frequência.

No bloqueio, o callback configurado produz HttpResponseException; capturamos
sua resposta. Na falha ilustrativa posterior, capturamos ValidationException
e renderizamos pelo handler existente. TestResponse envolve o resultado para
as asserções. Não passamos pelo kernel HTTP, CSRF, sessão ou transporte de rede.

## Cenários

| Cenário | O que as asserções exigem |
| --- | --- |
| Sexto pedido, Accept JSON/HTML/ausente | Cinco 204 com restante decrescente; sexto 429 JSON/message, Retry-After 60, limite 5/restante 0/no-store/sem Location; só cinco chamadas posteriores. |
| Tempo e expiração | 429/espera 60 no início, espera 30 após avanço; em 60 segundos libera com restante 4 e sexta chamada posterior. |
| Outro IP | IP A esgotado continua bloqueado; IP B pode seguir com restante 4. |
| Falha posterior | Cinco erros 422 consomem limite; sexto pedido é 429 e não alcança a função que falharia. |

O primeiro método usa DataProvider com três conjuntos. No sexto pedido, troca
o e-mail mantendo IP, para preservar contador compartilhado. Apenas message
string no 429; não fixamos sua tradução. Diretiva no-store é verificada sem
depender da ordenação textual de Cache-Control.
Quatro métodos, um deles com três entradas, produzem seis execuções PHPUnit.
Referência: [middleware throttle e limitadores nomeados](https://laravel.com/docs/13.x/routing#rate-limiting).

## Verificações e preparação do próximo passo

```sh
docker compose exec -T backend php -l tests/Feature/LoginRateLimiterTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginRateLimiterTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; focado 6 testes/156 asserções, código 0. Suíte completa:
96 testes/959 asserções, código 0, somando 6/156 aos 90/803 anteriores.
SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Nenhuma alteração de aplicação, dependências, ambientes, rotas ou OpenAPI.

Antes de integrar login por HTTP, consultamos somente o status da migration
de usuários no ambiente normal, sem aplicar SQL de criação:

```sh
docker compose exec -T backend php artisan migrate:status --path=database/migrations/0001_01_01_000000_create_users_table.php --no-ansi
```

Resultado Pending, código 0. Essa migration foi aplicada somente em loja_test
na 7.4; a preparação do banco local normal continua necessária para o endpoint.
Não fizemos snapshot completo do banco normal nem repetimos auditoria/quatro contratos.

## Continuidade

Testes criados, explicados e verificados; entendimento da 7.31 confirmado.
Publicação pendente. Após publicar: 7.32 —
preparar tabelas de usuários no banco local normal loja, conferindo identidade/
pendência e aplicando somente a migration de usuários, com verificação do estado
antes/depois e preservação do catálogo, antes de registrar a rota de login.
