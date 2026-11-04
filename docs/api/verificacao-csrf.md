# Verificação de CSRF no servidor local — protocolo executado

Desenho da 7.40 e execução na 7.41, em 04/11/2026. Os quatro resultados
204/419/419/422 foram observados por HTTP no Docker, conforme registrado abaixo.
Complementa o [contrato de login](login.md) e a
[consulta do usuário](autenticacao.md).

## Objetivo e alcance

Verificar a proteção de POST /api/v1/login fora de testing. Os testes anteriores
passam pelo kernel, mas nesse ambiente a comparação CSRF é dispensada.
Usamos um servidor PHP temporário no mesmo container e Guzzle já instalado,
com sessão de visitante. O corpo dos três POSTs foi o objeto JSON vazio {}.
Sem email/password, a validação interrompe antes da tentativa de autenticação.

Foram pedidos HTTP com transporte real dentro do container, como na 7.14.
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

O desenho previa usar a porta interna 8000 do servidor habitual. A conferência
anterior à execução encontrou 54 sessões antigas e coleta probabilística [2,100].
Para preservar esses arquivos, executamos um servidor PHP temporário em porta
local dinâmica, carregando a aplicação com ambiente local/rotas/middlewares.
Somente nesse processo, session.lottery ficou [0,100]. CSRF continuou ativo;
metadados de cada pedido confirmaram console false/testing false/sem exceções,
originOnly false/allowSameSite false. Nenhum arquivo de configuração foi alterado.

Host: 127.0.0.1:8002 e Origin: http://127.0.0.1:8002 permaneceram fixos, como no
desenho. Accept: application/json em todos os pedidos; POSTs com Content-Type:
application/json. Sem Referer conflitante, Authorization ou credenciais.
O servidor temporário foi encerrado ao final; o habitual manteve [2,100].

O cliente manteve cookies em memória entre os pedidos, sem proxy ou seguir
redirecionamentos, com timeout de dez segundos e http_errors false para
inspecionar respostas 4xx. Não foi usado navegador.

## Selecionar o caminho de comparação de tokens

Nos três POSTs, Sec-Fetch-Site ficou ausente. Também não enviamos _token no
corpo ou X-CSRF-TOKEN, para que somente X-XSRF-TOKEN varie entre os casos.
O middleware instalado pode aceitar same-origin por Sec-Fetch-Site antes de
comparar tokens; por isso a simples ausência do token não define todo resultado
possível no Laravel 13. A configuração de proteção CSRF foi mantida.
Referência: [proteção CSRF e verificação de origem](https://laravel.com/docs/13.x/csrf#origin-verification).

Origin reconhecido prepara sessão/CSRF pelo Sanctum. Aqui ele permanece igual
em todos os pedidos, enquanto a informação de token varia. Omitir Origin não
seria um controle equivalente: poderia retirar a preparação stateful da API.

## Sequência e resultados observados na 7.41

| Passo | Pedido | Cookies e cabeçalho CSRF | Resultado |
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

Na 7.41, foram conferidos os metadados de entrada no servidor em cada pedido,
a presença/ausência do cabeçalho e o mesmo ID de sessão nos três POSTs. Todos
os erros vieram em JSON, com message string e sem Location; C contém errors
com email/password. Não houve 429. Leitura interna do arquivo próprio confirmou
token presente e nenhuma chave de login. Diagnóstico terminou 0.

O finally encerrou o processo HTTP, removeu sua única sessão e os arquivos
auxiliares temporários. Comparação de nomes/hashes confirmou todos os arquivos
anteriores preservados. Conferência posterior: 54 sessões e configuração
habitual [2,100]. Nenhum valor de cookie/token/ID ou resposta bruta foi impresso
ou versionado. Sem nova suíte, consulta SQL ou alteração de aplicação.
Detalhes e comandos no [registro da 7.41](../aulas/07-41-verificacao-csrf-http.md).
Próxima 7.42: integrar POST /api/v1/login ao OpenAPI com respostas 204/419/422/429.
Navegador e CORS continuam pendentes.
