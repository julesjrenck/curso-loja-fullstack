# API de autenticação — consulta do próprio usuário

Desenho da etapa 7.16; rota protegida implementada na 7.19, em 04/11/2026.
Respostas 401 e 200 verificadas por testes HTTP internos do Laravel. Sucesso
200 verificado na 7.21 com User persistido em loja_test e actingAs/guard web;
login por HTTP e transporte de sessão/cookie pelo navegador ainda não verificados.
O [contrato executável do catálogo](catalogo.md) continua separado. O
[OpenAPI compartilhado](openapi.json) inclui esta operação desde a 7.23, com
respostas 200/401, schema Usuario e exigência de cookie somente nesta operação.

## Consultar o próprio usuário autenticado

- Método e caminho: GET /api/v1/usuario.
- URL local no host: http://127.0.0.1:8002/api/v1/usuario.
- Cabeçalho recomendado: Accept: application/json.
- Sem corpo, parâmetros de caminho ou query string suportados.
- Acesso autenticado; rota protegida com auth:sanctum.
- Para a interface própria, a identidade virá da sessão autenticada, enviada
  pelo cookie. Esta consulta não faz login.
- Um ID enviado pelo cliente não selecionará outro usuário. A operação consulta
  exclusivamente o usuário identificado pela autenticação da requisição.

Na 7.22, o cenário autenticado foi ampliado com dois Users persistidos:
autenticação de Ana por actingAs/web e query id/email de Bruno. Resposta exata
continuou de Ana. Parâmetros extras não são seletores de identidade suportados.
Arquivo focado: 4 testes/27 asserções; suíte: 71 testes/662 asserções.

## Sucesso verificado com autenticação preparada no teste

Status 200, Content-Type application/json, objeto com somente a chave data.
Data é um objeto individual com exatamente os três campos obrigatórios abaixo,
todos não nulos; não é uma lista paginada.
Exemplo fictício; o teste usa o ID real gerado para o User daquele cenário.

```json
{
  "data": {
    "id": 1,
    "name": "Ana Exemplo",
    "email": "ana@example.test"
  }
}
```

| Campo em data | Tipo JSON | Significado |
| --- | --- | --- |
| id | inteiro positivo | Identificador persistido do próprio usuário. |
| name | string | Nome armazenado. |
| email | string | E-mail armazenado. |

ID 1 é ilustrativo; não é um valor fixo. Mantemos name/email do model User,
mesmo com caminho usuario em português. Este contrato de leitura não define
validação de cadastro nem comprova verificação de e-mail.

A UsuarioResource criada na 7.17 seleciona esses três campos explicitamente.
Password, remember_token, email_verified_at, created_at e updated_at não
integram a resposta. O atributo Hidden do model já oculta senha/token na sua
serialização, mas a seleção do Resource também controla os demais campos.
O envelope data segue o padrão de JsonResource usado no catálogo.

## Visitante: resposta verificada

Sem autenticação válida, incluindo sessão ausente ou expirada sem outra
autenticação válida: status 401, Content-Type application/json. Não haverá
objeto data nem redirecionamento para página HTML de login.

```json
{
  "message": "Unauthenticated."
}
```

Message é uma string obrigatória. O texto acima é o padrão do Laravel instalado;
o cliente deve decidir pelo status 401, sem depender desse texto ou idioma.
Criar uma sessão de visitante em /sanctum/csrf-cookie não satisfaz a autenticação.
Na 7.19, diagnóstico pelo kernel HTTP/testing confirmou 401 JSON com Accept
application/json, text/html e ausente, sem redirecionamento, cookie, Authorization
ou SQL. Não foi uma requisição de rede nem teste de sessão autenticada.
Na 7.20, UsuarioApiTest automatizou esses três casos: 401, Content-Type JSON,
sem Location e objeto com somente message string, sem fixar seu texto.
Resultado focado daquela etapa: 3 testes/18 asserções; suíte completa: 70/653.
Na 7.21, adicionada transação por execução na classe e cenário autenticado:
arquivo com 4 testes/26 asserções, suíte completa com 71 testes/661 asserções.
O cenário prepara guard web por actingAs e exige 200/JSON exato; não executa login.

## Relação com a implementação futura

StatefulApi prepara sessão para origens reconhecidas. Auth:sanctum exige
autenticação na rota; o Resource definirá a representação pública do User.
A UsuarioResource foi criada na 7.17; UsuarioController::show foi criado na
7.18 e entrega $request->user() ao Resource. Ambos verificados em memória.
A rota foi registrada na 7.19 com auth:sanctum; bootstrap evita destino de
redirecionamento em api/* e mantém renderização JSON. Na 7.20, teste automatizado
de visitante passou nos três casos de Accept. Na 7.21, sucesso autenticado
verificado com actingAs/guard web e User persistido em loja_test, com rollback.
Na 7.22, id/email de outro usuário na query não mudaram a identidade retornada.
Na 7.23, esta operação foi integrada ao OpenAPI com autenticação por cookie e
respostas 200/401. Redocly fixado validou documento/exemplos; cópias com email
ausente e password extra rejeitadas. Nome local loja-fullstack-session conferido
pela configuração; nenhum valor de cookie documentado. Essa descrição não cria login.
Na 7.24, [contrato planejado de POST /api/v1/login](login.md) apresentado:
email/password, sucesso 204 sem corpo e falhas 422, com CSRF/sessão preservados.
Na 7.25, LoginRequest criada e verificada em memória, sem autenticar. Rota de
login ainda não criada ou incluída no OpenAPI. Na 7.26, testes da validação
passaram: focado 17/94, suíte 88/756. Na 7.27, LoginController::store criado e
verificado diretamente com guard web/loja_test/sessão array: 204 no sucesso,
422 genérico nas duas falhas e rollback. Na 7.28, testes desse controller passaram:
focado 2/47 e suíte 90/803. Na 7.29, regra local de cinco pedidos/minuto/IP
planejada, com 429/Retry-After. Na 7.30, limitador login registrado, configuração/
callback conferidos em memória e suíte 90/803 passou; sem rota usando-o.
Na 7.31, testes do middleware passaram: focado 6/156, suíte 96/959. Na 7.32,
migration de usuários aplicada em loja com sqlsrv_migracoes, lote 4, três tabelas
vazias e catálogo preservado. Aplicação continua loja_app/sessões file; suíte
existente 96/959 passou em loja_test. Na 7.33, POST /api/v1/login registrado
com throttle:login. Diagnóstico kernel/testing confirma cinco entradas vazias
422 e sexto pedido 429 com Accept JSON/HTML/padrão, sem SQL após identidade, sessão/cache
array e origem reconhecida. Suíte existente 96/959 passou. Sucesso do login por
HTTP e fluxo real de sessão/cookie/CSRF continuam pendentes. Na 7.34, registrado
que o caso antes apresentado como Accept ausente tinha o padrão do construtor.
LoginApiTest remove o cabeçalho e confere presença/valor; automatiza cinco 422
e sexto 429 para JSON/HTML/ausência real. Focado 3/267, suíte 99/1.226 passou.
Na 7.35, corrigido o mesmo preparo no teste isolado LoginRateLimiterTest,
com remoção/definição e asserções de presença/valor de Accept antes do middleware.
Focado 6/236, suíte 99/1.306 passaram. Na 7.36, sucesso pela rota adicionado em
LoginApiTest: fixture/transação em loja_test, guard real/204, identidade na
sessão, ID/token renovados e cookie de entrada/saída conferidos. Focado 4/294;
suíte 100/1.333 passou, dados desfeitos. Não consulta GET usuario após login
neste cenário nem comprova CSRF/rede/navegador. Na 7.37, credenciais recusadas
por HTTP verificadas: senha incorreta/e-mail inexistente com mesmo 422
genérico/visitante, identidade null, ID/token/marcador preservados e mesmo ID
nos cookies de entrada/saída após decodificação.
Focado 5/344; suíte 101/1.383 passou e dados desfeitos. Na 7.38, GET usuario após login passou com cookie obtido da resposta e enviado
pelos helpers JSON. Atributos da sessão limpos só em memória e guards
descartados antes do GET: 200/JSON exato data/id/name/email da fixture,
marcador recarregado, mesmo ID no cookie/sessão e identidade no guard conferidos.
Focado 5/357; suíte 101/1.396. Próxima 7.39: controle sem cookie após login exige
401 JSON com memória limpa/guards recriados. Sem transporte ou CSRF real verificados.

Referências: [proteção de rotas com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [envelope data de Resources](https://laravel.com/docs/13.x/eloquent-resources#data-wrapping).
