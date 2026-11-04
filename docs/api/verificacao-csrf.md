# Verificação de CSRF no servidor local — protocolo planejado

Desenho da 7.40, em 04/11/2026. Nenhum pedido deste protocolo foi executado
nesta etapa. Os resultados abaixo são expectativas, a verificar na 7.41.
Complementa o [contrato de login](login.md) e a
[consulta do usuário](autenticacao.md).

## Objetivo e alcance

Verificar a proteção de POST /api/v1/login fora de testing. Os testes anteriores
passam pelo kernel, mas nesse ambiente a comparação CSRF é dispensada.
Usaremos o servidor HTTP local ativo e um cliente Guzzle já instalado, no
Docker, com sessão de visitante. O corpo será sempre o objeto JSON vazio {}.
Sem email/password, a validação interrompe antes da tentativa de autenticação.

Serão pedidos HTTP com transporte real dentro do container, como na 7.14.
Isso não verifica as políticas de cookies, CORS ou Fetch Metadata de um
navegador. O cliente de diagnóstico controla seus próprios cabeçalhos.

## Configuração conferida em leitura

Bootstrap de console no ambiente normal confirmou local, runningUnitTests false,
configuração sem cache, sessão file/serialização json e cookie loja-fullstack-session.
Cache padrão file. Origem http://127.0.0.1:8002 reconhecida pelo Sanctum.
Middleware configurado ValidateCsrfToken herda PreventRequestForgery;
originOnly false, allowSameSite false e nenhuma exceção de caminho.
Rota usa EnsureFrontendRequestsAreStateful, ThrottleRequests:login e
SubstituteBindings, nessa ordem. Não alteramos configuração ou middleware.

## Endereço e cabeçalhos constantes

Cliente executado no backend Docker, base URI http://127.0.0.1:8000.
Host: 127.0.0.1:8002 representa a porta publicada pelo Compose. Todos os pedidos
usarão Origin: http://127.0.0.1:8002 e Accept: application/json. Os POSTs terão
Content-Type: application/json. Sem Referer conflitante, Authorization ou credenciais.

O cliente manterá os cookies em memória entre os pedidos. Não seguir
redirecionamentos, não usar proxy e limitar cada pedido a dez segundos,
permitindo inspecionar respostas 4xx sem transformá-las em exceções do cliente.

## Selecionar o caminho de comparação de tokens

Nos três POSTs, Sec-Fetch-Site ficará ausente. Também não enviaremos _token no
corpo ou X-CSRF-TOKEN, para que somente X-XSRF-TOKEN varie entre os casos.
O middleware instalado pode aceitar same-origin por Sec-Fetch-Site antes de
comparar tokens; por isso a simples ausência do token não define todo resultado
possível no Laravel 13. Não mudaremos essa configuração para o diagnóstico.
Referência: [proteção CSRF e verificação de origem](https://laravel.com/docs/13.x/csrf#origin-verification).

Origin reconhecido prepara sessão/CSRF pelo Sanctum. Aqui ele permanece igual
em todos os pedidos, enquanto a informação de token varia. Omitir Origin não
seria um controle equivalente: poderia retirar a preparação stateful da API.

## Sequência e resultados esperados

| Passo | Pedido | Cookies e cabeçalho CSRF | Expectativa |
| --- | --- | --- | --- |
| Preparação | GET /sanctum/csrf-cookie | Sem cookies anteriores do diagnóstico | 204 vazio; recebe XSRF-TOKEN e loja-fullstack-session. |
| A | POST /api/v1/login com {} | Cookies da preparação; sem X-XSRF-TOKEN | 419 JSON, message string, sem Location. |
| B | POST /api/v1/login com {} | Mesmos cookies; X-XSRF-TOKEN deliberadamente inválido | 419 JSON, message string, sem Location. |
| C | POST /api/v1/login com {} | Mesmos cookies; X-XSRF-TOKEN com valor correto | 422 JSON/message/errors com email/password, sem Location. |

No C, o cliente usa no cabeçalho o valor URL-decodificado do cookie XSRF-TOKEN.
O middleware faz a decifragem e compara com o token guardado na sessão.
O cliente não precisa conhecer APP_KEY ou obter token do arquivo de sessão.
O cookie de sessão deve acompanhar o pedido para identificar essa mesma sessão.
Referência: [preparação CSRF e cabeçalho no Sanctum](https://laravel.com/docs/13.x/sanctum#authenticating).

419 significa que a requisição foi recusada pela proteção CSRF. No C, 422 com
erros em email/password mostra que ela pôde seguir e chegou à validação de
entrada. Não é login bem-sucedido: nenhuma credencial foi fornecida e o guard
deve continuar visitante. Não exigimos corpo 419 com apenas message, pois a
configuração de diagnóstico pode acrescentar detalhes; conferiremos somente
os campos do contrato e não armazenaremos a resposta bruta.

## Limite, evidências e limpeza

Pedidos recusados antes de ThrottleRequests não entram na contagem de login.
O C alcança o limitador e consome uma tentativa. Se houver 429, esse bloqueio
não comprova aceitação/rejeição CSRF do C: conferir a janela e repetir somente
o necessário após a expiração natural. Não zerar contadores preexistentes.

Registrar apenas status, tipos, nomes de campos/cookies e condições booleanas.
Valores de cookies, tokens, IDs de sessão, chaves e respostas brutas ficarão
fora de arquivos públicos e saídas do diagnóstico. Não criar contas nem
enviar credenciais reais; o corpo {} impede alcançar o controller de login.

Antes do GET inicial, registrar nomes/hashes das sessões preexistentes sem
imprimir seus identificadores. Identificar internamente somente a sessão
criada pelo diagnóstico a partir de seu cookie, com validação do identificador
e confirmação de que o arquivo não existia antes. Em finally, remover somente
esse arquivo e conferir preservação dos arquivos anteriores, como na 7.14.
Não limpar o diretório de sessões ou cache inteiro.

Na 7.41, verificar novamente configuração, disponibilidade do servidor, cookies
recebidos e condições do protocolo antes de interpretar os resultados. A
comparação de tokens e os status 419/419/422 continuam pendentes de execução.
