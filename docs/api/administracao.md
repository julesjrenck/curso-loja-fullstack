# API de administração — rota protegida registrada

Desenho da etapa 7.77, em 05/11/2026. Na 7.78,
[AdministracaoController::show](../../backend/app/Http/Controllers/Api/V1/AdministracaoController.php)
foi criado e sua resposta verificada diretamente. Na 7.79, rota registrada
com auth:sanctum/can:acessar-administracao; kernel HTTP confirmou 401/403/200
com identidades preparadas em memória, sem login por credenciais ou SQL.
Na 7.80, [AdministracaoApiTest](../../backend/tests/Feature/AdministracaoApiTest.php)
automatizou os resultados com getJson/actingAs e cliente com debug true/false:
quatro testes/35 asserções passaram; suíte atual 116 testes/1.653 asserções.
OpenAPI ainda sem esta operação. Transporte de sessão pelo navegador e
login administrativo com conta persistida não foram verificados.

## Consultar a entrada da administração

- Método e caminho: GET /api/v1/administracao.
- URL local: http://127.0.0.1:8002/api/v1/administracao.
- Cabeçalho recomendado: Accept: application/json.
- Sem corpo ou parâmetros suportados no caminho/query string.
- Interface própria usa sessão autenticada e cookies, conforme o
  [fluxo de login](login.md); no Fetch entre portas, credentials include.
- Consulta de leitura: não altera usuários, produtos ou permissões.

Esta operação é a entrada da área administrativa da loja. Retorna
uma mensagem fixa após as verificações de acesso. Não lista contas,
altera preços ou promove usuários. A conta de laboratório existente não
passará a ser administradora por consultar esse caminho.

## Ordem das verificações

1. Auth:sanctum exige uma identidade autenticada; sem ela, encerra com 401.
2. Can:acessar-administracao exige a decisão do Gate já registrado;
   usuário autenticado sem permissão recebe 403.
3. Se as duas verificações passarem, o controller devolve a resposta 200.

O Gate usa is_admin do User identificado no servidor, convertido pelo cast
boolean. Não lê um privilégio escolhido no corpo/query string do pedido.
O Gate isolado recusa visitante; na rota integrada, a autenticação
interrompe esse visitante antes com 401, conforme observado pelo kernel.
Cliente reconhecido sem permissão recebe 403 do fluxo de autorização.

Fontes: [proteção de rotas com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [autorização por middleware](https://laravel.com/docs/13.x/authorization#via-middleware).

## Administrador: sucesso verificado pelo kernel HTTP

Status 200, Content-Type application/json. Objeto com somente data, cujo
objeto contém somente mensagem, uma string obrigatória com o texto abaixo:

```json
{
  "data": {
    "mensagem": "Bem-vindo à administração da loja."
  }
}
```

É uma resposta individual, sem paginação, identificação pessoal ou atributo
is_admin. O envelope data mantém a convenção da API; para uma mensagem fixa
não precisamos serializar um User inteiro. O sucesso autoriza esta consulta,
sem conceder automaticamente acesso a todas as futuras operações de produtos
ou outros recursos. Cada operação terá sua verificação.

## Visitante: 401 verificado pelo kernel HTTP

Sem autenticação válida: status 401, Content-Type application/json, sem
redirecionamento HTML. Objeto com somente message, uma string obrigatória.
Sem data. Exemplo do formato já usado na consulta do próprio usuário:

```json
{
  "message": "Unauthenticated."
}
```

Criar sessão visitante/obter cookie CSRF não satisfaz a autenticação.
O fluxo de identidade permanece o documentado em [autenticacao.md](autenticacao.md).

## Cliente autenticado: 403 verificado pelo kernel HTTP

Com autenticação válida, mas recusa do Gate: status 403,
Content-Type application/json, sem redirecionamento HTML. Objeto com somente
message, uma string obrigatória, sem data. A renderização de
AccessDeniedHttpException em api/* foi configurada para retornar mensagem
genérica mesmo com depuração ligada. Resposta verificada:

```json
{
  "message": "Acesso não permitido."
}
```

O cliente deve decidir pelo status, sem depender do texto/idioma de message.
Usamos mensagem em português no sucesso e message nos erros para preservar
o padrão de erro existente do framework. O bootstrap atual configura JSON
para api/*; a rota registrada mantém esse comportamento.

## Escopo desta etapa

Na 7.79, kernel HTTP com usuários em memória confirmou visitante 401,
cliente 403 e administrador 200; cliente com debug desligado manteve o
mesmo 403. Todos JSON, sem Location, sem SQL ou conexão PDO aberta. A recusa
403 inicialmente trazia detalhes de depuração; o callback de renderização
em bootstrap/app.php passou a entregar somente message para essa exceção
em api/*. Fora da API, dois controles confirmaram o tratamento padrão.
Na 7.80, os testes HTTP permanentes exigem 401/403/200, Content-Type JSON,
ausência de Location, zero SQL/PDO não aberto e corpos do contrato. Erros
com somente message string; sucesso exato. Cliente é executado com debug
ligado/desligado por DataProvider. Focado: 4 testes/35 asserções; suíte atual:
116 testes/1.653 asserções passaram, códigos 0.

Não houve login administrativo real, promoção ou uso de conta persistida.
OpenAPI segue sem esta operação. Próxima etapa: incluir operação, segurança,
respostas e exemplos no documento OpenAPI e validar.
