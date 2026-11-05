# Aula 7.55 — Diagnóstico da configuração de CORS

Leitura e explicação em 05/11/2026, após confirmação da 7.54 com "entendi".
Checkpoint 7.54 publicado e conferido em
750d6baa826daa0280e6c3b877b99debac3abbeb: HEAD, origin/main e main remota iguais.
Entendimento da 7.55 confirmado com "entendi" em 05/11/2026; publicação conferida
em 7a0712226d12b9e553f4937755cc33e6589ac4b1, HEAD/origin/main/main remota iguais.

## Objetivo

Entender a configuração atual antes de ajustá-la. Acrescentamos este registro
e atualizamos roteiro/progresso; nenhuma configuração da aplicação foi alterada.
O [bootstrap](../../backend/bootstrap/app.php) já contém statefulApi(), estudado
anteriormente. Nesta etapa não criamos interface nem escolhemos sua origem final.

## Origem e leitura da resposta

Origem combina protocolo, host e porta. Uma página em http://127.0.0.1:8001
e uma API em http://127.0.0.1:8002 têm origens diferentes. Mudar só o caminho,
como /api/v1/login para /api/v1/logout, mantém a origem.
Fonte: [definição de origem na MDN](https://developer.mozilla.org/en-US/docs/Glossary/Origin).

CORS permite ao servidor indicar quais origens podem compartilhar sua resposta
com JavaScript no navegador. Na loja, isso afeta a leitura da resposta da API
pela interface. Uma resposta bloqueada para leitura pode vir de um pedido que
já foi processado; quando há preflight, sua recusa pode impedir o pedido efetivo.
Fonte: [protocolo CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS).

## Configuração efetiva observada

Não existe backend/config/cors.php. O carregador LoadConfiguration do Laravel
completa a configuração com os padrões do framework. Dentro do container,
vendor/laravel/framework/config/cors.php forneceu exatamente os valores carregados:

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => ['*'],
'allowed_origins_patterns' => [],
'allowed_headers' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => false,
```

| Opção | Papel |
| --- | --- |
| paths | Caminhos atendidos pelo middleware CORS. api/* inclui api/v1/*. |
| allowed_methods | Métodos permitidos pelo CORS; * abrange todos, sem criar rotas. |
| allowed_origins | Origens aceitas; * é curinga para compartilhamento sem credenciais. |
| allowed_origins_patterns | Expressões regulares alternativas; nenhuma configurada. |
| allowed_headers | Cabeçalhos de requisição aceitos na negociação do preflight. |
| exposed_headers | Cabeçalhos extras de resposta expostos ao JavaScript; nenhum. |
| max_age | Prazo configurado para cache do preflight, em segundos; zero. |
| supports_credentials | Habilita o compartilhamento CORS com credenciais; false. |

Credenciais incluem cookies. No Fetch, credentials: 'include' permite enviá-los
entre origens, sujeito às regras de cookies. Nesse modo, o navegador exige
origem explícita em Access-Control-Allow-Origin e Access-Control-Allow-Credentials:
true. A configuração atual não basta para uma interface em outra origem usar
sessão por cookies. Essa é uma conclusão da configuração e das regras do
protocolo; não observamos erro no navegador nesta aula.
Fontes: [CORS com credenciais](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS#credentialed_requests_and_wildcards)
e [cookies/CORS no Sanctum](https://laravel.com/docs/13.x/sanctum#cors-and-cookies).

## Decisões separadas

| Mecanismo | Responsabilidade |
| --- | --- |
| CORS | Autorizar o compartilhamento de respostas entre origens no navegador. |
| Reconhecimento stateful do Sanctum | Selecionar a preparação de sessão e CSRF da interface própria. |
| CSRF | Verificar as condições de proteção de uma operação que altera estado. |
| auth:sanctum | Exigir identidade autenticada nas rotas protegidas. |

Com pedidos apenas construídos em memória para o host 127.0.0.1:8002,
EnsureFrontendRequestsAreStateful::fromFrontend reconheceu Origin 8002 como
true e Origin 8001 como false. A porta 8001 é exemplo para comparação, sem
definir uma futura interface. Permitir uma origem no CORS e reconhecê-la no
Sanctum são configurações distintas. statefulApi() não autentica um visitante.

## Preflight

Antes de certos pedidos entre origens, o navegador consulta o servidor com
OPTIONS, Origin e Access-Control-Request-Method; pode incluir
Access-Control-Request-Headers. Exemplo futuro: POST JSON com X-XSRF-TOKEN.
O preflight não envia cookies de sessão. Incluir credenciais, por si só, não
exige preflight. Fonte: [preflight na MDN](https://developer.mozilla.org/en-US/docs/Glossary/Preflight_request)
e [credenciais no preflight](https://developer.mozilla.org/en-US/docs/Web/HTTP/Reference/Headers/Access-Control-Allow-Credentials).

No código instalado, HandleCors verifica o caminho e responde a um preflight
antes de continuar para a rota. Não criamos uma rota OPTIONS ou executamos
esse fluxo nesta etapa.

## Como verificamos e o que isso demonstra

Executamos PHP pela entrada padrão de docker compose exec -T backend php.
exec usa o serviço existente; -T evita um terminal interativo. O PHP carregou
vendor/autoload.php, bootstrap/app.php e o bootstrap do kernel de console.
Assim lemos a configuração efetiva, sem chamar handle() do kernel HTTP.

Trechos centrais do diagnóstico temporário:

```php
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$global = $kernel->getGlobalMiddleware();
$config = config('cors');
$defaults = require '/app/vendor/laravel/framework/config/cors.php';
$same = $config === $defaults;
```

make resolve o kernel; getGlobalMiddleware lê a lista global. Encontramos
Illuminate\Http\Middleware\HandleCors. config('cors') retornou o array acima;
a comparação estrita com os padrões retornou true. Ambiente local, configuração
sem cache e arquivo local cors.php ausente foram conferidos separadamente.

ReflectionMethod chamou somente hasMatchingPath, método protegido de HandleCors,
com Request::create. Essa técnica serviu à inspeção, sem alterar visibilidade
no código ou enviar os objetos pela cadeia de middleware. Caminhos produtos,
login, logout e usuario sob /api/v1 e /sanctum/csrf-cookie retornaram true;
/loja retornou false. fromFrontend foi chamado diretamente para as duas origens.

Saída JSON continha apenas opções públicas e resultados booleanos; código 0.
Nenhuma sessão iniciada, conta criada ou consulta SQL executada pelo diagnóstico.
Não houve HTTP, navegador, dependência nova, alteração em vendor/configuração ou
nova suíte. Última suíte continua a da 7.51: 107 testes/1.586 asserções.
Isso comprova os valores e a seleção em memória; cabeçalhos de resposta e
comportamento real do navegador ainda precisam de verificações próprias.

Git diff --check passou. Os 26 links locais dos oito documentos alterados
foram conferidos; índice vazio e somente documentação modificada.

## Continuidade

Publicação da 7.55 concluída. Continuidade na
[7.56 — preflight do logout em memória](07-56-preflight-logout-em-memoria.md),
sem cookies/SQL e sem alterar configuração. Integração completa no navegador
permanece pendente, dentro do módulo 7.
