# Aula 7.57 — CORS com origem explícita e credenciais

Implementação, explicação e verificações em 05/11/2026, após confirmação da
7.56 com "entendi". Checkpoint anterior publicado e conferido em
c49fa8349f0a830ee4e1bf7feaa56862bfd2701c: HEAD/origin/main/main remota iguais.
Entendimento da 7.57 confirmado com "entendi" em 05/11/2026; publicação conferida
em 1425d8a482a87c9020d01c627110134c75a8d2f3, HEAD/origin/main/main remota iguais.

## Objetivo e arquivo alterado

Criamos [backend/config/cors.php](../../backend/config/cors.php), único arquivo
de aplicação alterado, para permitir a origem local de laboratório
http://127.0.0.1:8001 com credenciais. A API continua em http://127.0.0.1:8002.
Não escolhemos a origem final de produção ou criamos uma interface nesta etapa.

O arquivo PHP retorna um array de configuração, que o Laravel carrega com os
demais arquivos de config. Seus valores ficam acessíveis por config('cors').
Antes, na [7.56](07-56-preflight-logout-em-memoria.md), usávamos só os padrões
do framework. Agora declaramos as opções no projeto:

```php
<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://127.0.0.1:8001'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
```

As duas diferenças em relação ao framework são:

| Opção | Antes | Agora |
| --- | --- | --- |
| allowed_origins | ['*'] | ['http://127.0.0.1:8001'] |
| supports_credentials | false | true |

A origem inclui protocolo, host e porta, sem caminho ou barra final. Credenciais
incluem cookies. supports_credentials permite ao middleware anunciar
Access-Control-Allow-Credentials: true. Para esse fluxo, o navegador exige
uma origem explícita em Access-Control-Allow-Origin, em vez de *.
Fontes: [CORS e cookies no Sanctum](https://laravel.com/docs/13.x/sanctum#cors-and-cookies)
e [CORS com credenciais na MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS#credentialed_requests_and_wildcards).

As demais sete opções mantêm os valores anteriores: paths abrange /api/* e
/sanctum/csrf-cookie; métodos e cabeçalhos aceitam os solicitados; não há
padrões adicionais de origem nem cabeçalhos extras expostos; max_age é zero.
Permitir métodos pelo CORS não cria rotas ou concede permissões de negócio.

A restrição de origem também alcança as respostas do catálogo público sob
/api/v1: outra origem não recebe autorização de CORS para lê-las. Autenticação
e acesso direto por clientes HTTP continuam regidos pelas rotas e middlewares
próprios. CORS não transforma um endpoint público em um endpoint autenticado.

## Preflight repetido e origem de controle

Com o bootstrap do console, executamos HandleCors isolado no Docker. Repetimos
OPTIONS /api/v1/logout para host 8002, método pretendido POST e cabeçalhos
content-type,x-xsrf-token, sem cookies, corpo ou token real. A continuação
lançaria uma exceção se chamada, impedindo a execução de rotas ou sessão.

| Origin do pedido | Status | Allow-Origin da resposta | Allow-Credentials |
| --- | --- | --- | --- |
| http://127.0.0.1:8001 | 204 | http://127.0.0.1:8001 | true |
| http://127.0.0.1:8003 | 204 | http://127.0.0.1:8001 | true |

Nos dois casos: corpo vazio, Allow-Methods POST, Allow-Headers
content-type,x-xsrf-token, Max-Age 0 e Vary Request-Method/Request-Headers.

Há uma origem configurada. A biblioteca instalada otimiza esse caso devolvendo
sempre a origem fixa 8001. No controle 8003, Allow-Origin não corresponde à
origem solicitante: pelas regras do protocolo, o navegador recusa a autorização
de CORS, mesmo com status 204 e Allow-Credentials true. Essa comparação é uma
conclusão dos cabeçalhos observados; ainda não executamos um navegador.
O 204 continua sendo a resposta ao OPTIONS, sem executar logout.

## Comandos e verificações

```sh
docker compose exec -T backend php -l config/cors.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

exec usa o serviço existente, -T dispensa terminal e php -l verifica a sintaxe:
sem erros, código 0. PHPUnit executa a suíte existente; colors never evita
códigos de cor e do-not-cache-result evita atualizar o cache de resultados.
A configuração phpunit.xml seleciona SQL Server loja_test, sessão/cache array
e ambiente testing. Resultado: 107 testes/1.586 asserções, código 0. Nenhum
teste foi criado ou alterado.

O diagnóstico temporário de preflight também foi PHP pela entrada padrão de
docker compose exec -T backend php. Ambiente local, sem cache de configuração.
Exigiu config('cors') igual aos padrões do framework com somente as duas opções
acima substituídas. Cada pedido passou por 15 controles: status/corpo, origem,
credenciais, método/headers, max_age/Vary, continuação não chamada, ausência de
cookies/corpo/sessão, zero SQL, configuração preservada e comparação da origem.
Todos passaram, código 0; 30 controles nos dois pedidos. Sem Set-Cookie ou
cookies de resposta. Listener QueryExecuted contou zero durante esse diagnóstico;
a suíte de integração usou seu banco exclusivo normalmente.

Uma leitura adicional de Sanctum fromFrontend ainda retornou false para Origin
8001 com destino 8002. Isso confirma que mudar CORS não configura o
reconhecimento stateful. Não alteramos Sanctum, bootstrap, rotas, controller,
testes, ambientes, dependências, serviços, Compose ou OpenAPI. Nenhum logout,
sessão ou HTTP de rede ocorreu no diagnóstico isolado.

Esta verificação confirma o middleware com a configuração carregada e a suíte
existente. O fluxo completo de cookies/CSRF e a aplicação das regras pelo
navegador continuam pendentes. Credenciais true não autentica um usuário nem
faz cookies serem enviados automaticamente pelo cliente.

Git diff --check passou. Quatro links locais válidos; trecho PHP da aula igual
ao arquivo criado. Somente os cinco arquivos previstos alterados, índice vazio.

## Continuidade

Publicação da 7.57 concluída. Continuidade na
[7.58 — origem do laboratório no Sanctum](07-58-origem-stateful-sanctum.md).
Integração no navegador nas etapas seguintes do módulo 7; módulos 8 a 23 não
iniciados.
