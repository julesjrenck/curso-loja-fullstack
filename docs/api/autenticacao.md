# API de autenticação — consulta do próprio usuário

Desenho da etapa 7.16; rota protegida implementada na 7.19, em 04/11/2026.
Resposta 401 verificada pelo kernel HTTP Laravel; sucesso 200 ainda planejado
para o fluxo autenticado, com controller/Resource verificados em memória.
O [contrato executável do catálogo](catalogo.md) continua separado. O OpenAPI
atual descreve o catálogo e ainda não inclui esta operação.

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

## Sucesso planejado

Status 200, Content-Type application/json, objeto com somente a chave data.
Data é um objeto individual com exatamente os três campos obrigatórios abaixo,
todos não nulos; não é uma lista paginada.

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
Resultado focado: 3 testes/18 asserções; suíte completa: 70 testes/653 asserções.

## Relação com a implementação futura

StatefulApi prepara sessão para origens reconhecidas. Auth:sanctum exige
autenticação na rota; o Resource definirá a representação pública do User.
A UsuarioResource foi criada na 7.17; UsuarioController::show foi criado na
7.18 e entrega $request->user() ao Resource. Ambos verificados em memória.
A rota foi registrada na 7.19 com auth:sanctum; bootstrap evita destino de
redirecionamento em api/* e mantém renderização JSON. Na 7.20, teste automatizado
de visitante passou nos três casos de Accept. A próxima, 7.21, adicionará cenário
de sucesso autenticado, com actingAs/guard web e User persistido em loja_test.
Login, fluxo autenticado completo e integração no OpenAPI continuam pendentes.

Referências: [proteção de rotas com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [envelope data de Resources](https://laravel.com/docs/13.x/eloquent-resources#data-wrapping).
