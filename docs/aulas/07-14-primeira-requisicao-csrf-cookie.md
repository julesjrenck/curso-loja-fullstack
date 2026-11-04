# Aula 7.14 — Primeira requisição ao endpoint CSRF

Execução, explicação e verificações em 04/11/2026, após confirmação da 7.13
com "entendi". Checkpoint anterior publicado e conferido em
cc016c46c1e8057e7db67e4b2cceb06e4a529f1b; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.14 confirmado com "entendi" em 04/11/2026.

## Objetivo e preparação

Observar uma resposta HTTP real a GET /sanctum/csrf-cookie. A rota foi
registrada na 7.13; agora verificamos sua resposta, cookies e criação de uma
sessão de visitante. Nenhuma credencial foi enviada ou rota de login criada.

O controller instalado CsrfCookieController@show devolve uma resposta vazia
com status 204, inclusive quando o cliente pede JSON. Os middlewares web
tratam a sessão e acrescentam os cookies à resposta. O comportamento útil
desse endpoint está nos cabeçalhos, não em um corpo JSON com dados.

Antes da requisição, o bootstrap de console confirmou driver file, serialização
json, nome loja-fullstack-session, HttpOnly true, Secure null e SameSite lax em
[config/session.php](../../backend/config/session.php) e na configuração carregada.

## Requisição executada

Um diagnóstico PHP por stdin a docker compose exec -T backend php carregou
vendor/autoload.php e a configuração Laravel. Usou Guzzle já instalado, sem
adicionar dependência, para chamar o servidor HTTP ativo:

```php
$client = new GuzzleHttp\Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'timeout' => 10,
    'http_errors' => false,
    'allow_redirects' => false,
    'cookies' => false,
    'proxy' => '',
    'headers' => [
        'Host' => '127.0.0.1:8002',
        'Accept' => 'application/json',
    ],
]);

$response = $client->get('/sanctum/csrf-cookie');
```

Dentro do container, o servidor atende em 8000. O Host representa o endereço
publicado em 8002 pelo [Compose](../../compose.yaml). Não foi uma requisição
feita pelo host à porta publicada: o transporte foi interno ao container,
com atendimento real pelo servidor. O timeout é de dez segundos; dispensamos
redirecionamentos, proxy e armazenamento automático de cookies. Accept pede JSON.
http_errors false permite examinar o status sem transformar erros HTTP em exceção.

O diagnóstico leu Set-Cookie somente em memória e imprimiu nomes e atributos
permitidos, sem valores dos cookies. Não criamos arquivo com a resposta bruta.

## Resultado observado

Status 204, corpo com zero bytes, dois cabeçalhos Set-Cookie:

| Cookie | Função | HttpOnly |
| --- | --- | --- |
| XSRF-TOKEN | Suporte ao envio do cabeçalho X-XSRF-TOKEN pelo cliente HTTP | Ausente |
| loja-fullstack-session | Referência da sessão | Presente |

O cliente da futura interface poderá ler o cookie de apoio CSRF para preparar
o cabeçalho correspondente. O cookie de sessão permanece inacessível ao
JavaScript do navegador por HttpOnly, mas pode ser enviado nas requisições.
Isso é diferente de tornar o cookie invisível a um cliente HTTP do servidor.

Os dois cookies também vieram com:

| Atributo | Valor observado | Significado |
| --- | --- | --- |
| Path | / | Caminhos sob a raiz entram no escopo do cookie |
| Domain | Ausente | Escopo do host que o enviou |
| SameSite | Lax | Regra do navegador para envio em contextos entre sites |
| Secure | Ausente | Configuração observada nesta resposta HTTP local |
| Max-Age | 7200 | Prazo de 7200 segundos, ou 120 minutos, informado na resposta |

Essa resposta não autentica o visitante. Também não prova, sozinha, como um
navegador aplicará regras de origem, CORS ou envio de cookies entre os futuros
frontend/backend. A duração do cookie não representa uma promessa de login ativo.

Fontes: [preparação CSRF no Sanctum](https://laravel.com/docs/13.x/sanctum#authenticating)
e [atributos de cookies HTTP](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/Cookies).

## Sessão e limpeza da demonstração

O middleware criou um arquivo de sessão, coerente com o driver file. O
diagnóstico decodificou internamente o cookie de sessão com o encrypter da
aplicação para localizar somente seu próprio arquivo, sem imprimir identificador,
chave, token ou conteúdo. Exigiu um identificador válido e ausente da lista de
arquivos anteriores antes de permitir a limpeza.

Leitura desse arquivo confirmou token CSRF presente e ausência de chaves de
login. O arquivo foi removido no finally do diagnóstico. A comparação dos
nomes/hashes de arquivos preexistentes confirmou preservação. Processo código 0.
Os dados privados ficaram apenas em memória e no arquivo temporário removido.

Nenhum arquivo de aplicação, dependência, configuração ou migration foi alterado.
Não executamos comandos SQL, nova suíte, auditoria ou quatro contratos; a última
suíte completa continua a 7.13, 67 testes/635 asserções. A verificação apropriada
desta etapa foi a resposta HTTP e a sessão de preparação, sem implementar login.

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Próximo passo após publicar:
7.15 — habilitar statefulApi no bootstrap e conferir o reconhecimento das
requisições da interface própria na API, antes de implementar login.
Checkpoint preparado para commit e push; consultar o Git ou registro posterior
para conferir a publicação.
