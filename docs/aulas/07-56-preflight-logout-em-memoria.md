# Aula 7.56 — Preflight do logout em memória

Execução e explicação em 05/11/2026, após confirmação da 7.55 com "entendi".
Checkpoint 7.55 publicado e conferido em
7a0712226d12b9e553f4937755cc33e6589ac4b1: HEAD/origin/main/main remota iguais.
Entendimento da 7.56 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo

Observar a resposta de HandleCors ao preflight de um POST logout. Na
[7.55](07-55-diagnostico-cors.md), lemos a configuração; agora executamos esse
middleware isoladamente. Nenhuma configuração foi alterada. Este arquivo
registra a experiência; roteiro/progresso e publicação anterior foram atualizados.

## Entrada e execução

O navegador usa preflight para consultar métodos e cabeçalhos antes de certos
pedidos entre origens. Representamos a consulta com este objeto em memória:

```http
OPTIONS /api/v1/logout
Host: 127.0.0.1:8002
Origin: http://127.0.0.1:8001
Access-Control-Request-Method: POST
Access-Control-Request-Headers: content-type,x-xsrf-token
```

OPTIONS é a consulta; POST é o método pretendido depois dela. Os dois nomes
em Request-Headers anunciam cabeçalhos do futuro POST. Não enviamos JSON,
token real ou cookie no OPTIONS. A origem 8001 continua sendo exemplo de
laboratório, sem escolher a origem final da interface.
Fonte: [preflight na MDN](https://developer.mozilla.org/en-US/docs/Glossary/Preflight_request).

Executamos PHP pela entrada padrão de docker compose exec -T backend php:
exec usa o container existente e -T dispensa terminal. O diagnóstico carregou
/app/vendor/autoload.php, /app/bootstrap/app.php e o bootstrap do kernel de
console. Não chamou o kernel HTTP ou um servidor pela rede.

Este é o trecho central executado após o bootstrap:

```php
$request = Illuminate\Http\Request::create(
    'http://127.0.0.1:8002/api/v1/logout', 'OPTIONS', [], [], [],
    [
        'HTTP_ORIGIN' => 'http://127.0.0.1:8001',
        'HTTP_ACCESS_CONTROL_REQUEST_METHOD' => 'POST',
        'HTTP_ACCESS_CONTROL_REQUEST_HEADERS' => 'content-type,x-xsrf-token',
    ]
);
$nextCalled = false;
$response = $app->make(Illuminate\Http\Middleware\HandleCors::class)->handle(
    $request,
    function () use (&$nextCalled) {
        $nextCalled = true;
        throw new RuntimeException('fluxo_inesperado_apos_cors');
    }
);
```

Request::create monta um objeto, sem enviar HTTP. Os arrays vazios representam
parâmetros, cookies e arquivos; o último array fornece os cabeçalhos pelo
formato de variáveis de servidor. make resolve HandleCors e suas dependências.
handle executa o middleware com a configuração efetiva da aplicação.

A função recebida como segundo argumento representa a continuação da cadeia.
Se fosse chamada, marcaria nextCalled e interromperia o diagnóstico. Assim,
nenhuma rota, controller, autenticação ou sessão seria executada depois dela.
O resultado observado foi nextCalled false: HandleCors respondeu diretamente.

## Saída observada

Ambiente local. Resposta 204, corpo vazio e estes valores:

| Cabeçalho | Resultado |
| --- | --- |
| Access-Control-Allow-Origin | * |
| Access-Control-Allow-Methods | POST |
| Access-Control-Allow-Headers | content-type,x-xsrf-token |
| Access-Control-Allow-Credentials | Ausente; leitura retornou null. |
| Access-Control-Max-Age | 0 |
| Vary | Access-Control-Request-Method, Access-Control-Request-Headers |

Os padrões allowed_methods e allowed_headers com * fizeram o serviço CORS
instalado refletir o método e os nomes solicitados. Isso não verifica se existe
uma rota POST: o middleware respondeu antes do roteamento. Max-Age 0 anuncia
zero segundos para cache do preflight. Vary indica que os campos de consulta
listados participam da seleção da resposta por caches.

O 204 é o resultado do OPTIONS, não a execução do logout. Para um futuro pedido
com credenciais, o navegador exige Allow-Credentials true e origem explícita
em Allow-Origin. A resposta atual não atende esse fluxo. Essa conclusão usa
os cabeçalhos observados e as regras do protocolo; nenhum navegador foi executado.
Fontes: [Allow-Credentials](https://developer.mozilla.org/en-US/docs/Web/HTTP/Reference/Headers/Access-Control-Allow-Credentials)
e [origem com credenciais](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS#credentialed_requests_and_wildcards).

## Verificação e limites

O diagnóstico exigiu configuração inicial igual aos padrões do framework e
comparou-a novamente ao final, sem mudanças. Conferiu explicitamente status,
corpo, cinco cabeçalhos, dois valores de Vary e continuação não chamada.
Também exigiu pedido sem cookies/corpo/sessão anexada, resposta sem Set-Cookie
ou cookies e zero eventos QueryExecuted. Todos os 14 controles retornaram true,
código de saída 0. Só valores públicos e booleanos foram impressos.

HandleCors e Fruitcake CorsService instalados foram lidos para explicar o
retorno antecipado e a formação dos cabeçalhos. Não houve alteração em vendor,
bootstrap, rotas, controller, testes, ambientes, dependências, serviços, Compose
ou OpenAPI. Não houve HTTP pela rede, sessão iniciada, logout efetivo ou SQL.
Sem nova suíte; última continua 7.51: 107 testes/1.586 asserções.

Esta execução confirma o middleware isolado com a configuração carregada.
A cadeia completa, a aplicação das regras pelo navegador e o fluxo de cookies
entre origens ainda precisam de suas próprias verificações.

Git diff --check passou. Os três links locais dos quatro documentos alterados
foram conferidos; somente documentação modificada e índice vazio.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.57: definir uma origem de
laboratório, criar backend/config/cors.php para permitir essa origem com
credenciais e repetir o preflight. O reconhecimento stateful do Sanctum e a
integração no navegador ficam para etapas seguintes do módulo 7.
