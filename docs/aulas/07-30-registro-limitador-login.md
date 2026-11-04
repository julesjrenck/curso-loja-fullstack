# Aula 7.30 — Registro do limitador nomeado de login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.29 com "entendi". Checkpoint anterior publicado e conferido em
d70208691d2aba1ebfce471374bebcc5a603cef1; HEAD/origin/main/main remota iguais.
Entendimento da 7.30 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Em [AppServiceProvider](../../backend/app/Providers/AppServiceProvider.php),
substituímos somente o comentário de boot pelo registro do limitador login,
conforme o [contrato](../api/limite-login.md). O método register e seu binding
Catalogo/CatalogoEloquent permanecem iguais. Nenhuma rota adicionada.

Importamos Limit, JsonResponse, Request e a facade RateLimiter. Boot é chamado
na inicialização da aplicação após o registro dos serviços. For associa o nome
login a uma função que produzirá a configuração conforme a requisição:

```php
RateLimiter::for('login', function (Request $request): Limit {
    return Limit::perMinute(5)
        ->by($request->ip())
        ->response(function (Request $request, array $headers): JsonResponse {
            return response()->json([
                'message' => 'Muitas tentativas. Tente novamente em instantes.',
            ], 429, $headers)->header('Cache-Control', 'no-store');
        });
});
```

## Configuração e resposta

PerMinute(5) cria Limit com capacidade cinco/janela 60 segundos. By recebe a
chave daquele limite, aqui o IP obtido pela Request. A função externa retorna
Limit; ela configura a regra, não confere senha ou executa contagem por si só.
Outro e-mail do mesmo IP produz a mesma chave. Não usamos ID ou senha na chave.

Response configura outra função, chamada pelo middleware quando bloquear.
Ela recebe Request e os cabeçalhos calculados; o parâmetro Request está
disponível, embora esse corpo não precise consultá-lo. JsonResponse declara
o retorno JSON. Response()->json recebe corpo, status 429 e headers; preservamos
Retry-After e os cabeçalhos de limite, sem escrever 60 fixo como espera.
Header acrescenta Cache-Control/no-store. A resposta observada inclui também
private, acrescentado pelo framework: no-store, private.

Registrar o nome em boot ainda não protege uma rota. Throttle:login será a
ligação entre rota e regra em etapa posterior. Nenhuma rota atual o utiliza,
e POST /api/v1/login continua ausente. A consulta de usuário e o catálogo
mantêm seus middlewares anteriores.

Referência: [registro, resposta personalizada e associação a rotas](https://laravel.com/docs/13.x/routing#rate-limiting).

## Diagnóstico da configuração registrada

PHP Docker/testing com CACHE_STORE=array no ambiente apenas daquele processo,
sem editar arquivos .env ou usar o cache file normal. Após bootstrap, obtivemos
RateLimiter::limiter('login'), conferido chamável. Criamos Requests em memória
com REMOTE_ADDR para dois IPs locais fictícios e e-mails ilustrativos.

Seis condições passaram: objeto Limit, máximo 5, duração 60, mesma chave para
mesmo IP/e-mails diferentes, chave diferente para outro IP e callback configurado.
Não chamamos hit ou o middleware nesse diagnóstico.

Chamamos a resposta configurada com cabeçalhos ilustrativos para três casos:
Accept JSON/Retry-After 60; HTML/37; ausente/11. Oito condições por caso passaram:
429, Content-Type JSON, somente message string, Retry-After preservado, limite 5,
restante 0, diretiva no-store e ausência de Location. Código 0. Valores de espera
foram fornecidos ao callback, não calculados por uma rota nesta verificação.

A lista real de rotas confirmou api/v1/login ausente e nenhuma com throttle:login.
Listener registrou zero SQL nesse diagnóstico; sem contadores, sessões ou cookies
gravados. Ainda não é prova do bloqueio do sexto pedido pelo middleware.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Providers/AppServiceProvider.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; suíte existente 90 testes/803 asserções passou, código 0.
Registro/callback exercitados pelo diagnóstico; nenhum teste permanente novo.
SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Sem nova dependência, ambiente, rota, bootstrap, migration ou OpenAPI alterado.
Auditoria/snapshot normal/quatro contratos não foram repetidos.

## Continuidade

Limitador registrado, explicado e verificado; entendimento confirmado com
"entendi" em 04/11/2026; publicação pendente. Após publicar: 7.31 —
testes automatizados do limitador pelo middleware ThrottleRequests com relógio
controlado/cache array, cobrindo limite/IP/expiração/429/cabeçalhos, sem registrar rota.
