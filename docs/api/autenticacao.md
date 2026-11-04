# API de autenticação — contrato planejado

Desenho da etapa 7.16, em 04/11/2026. Este endpoint ainda não foi implementado.
Os exemplos abaixo são fictícios; não representam respostas HTTP já observadas.
O [contrato executável do catálogo](catalogo.md) continua separado. O OpenAPI
atual descreve o catálogo e ainda não inclui esta operação planejada.

## Consultar o próprio usuário autenticado

- Método e caminho planejados: GET /api/v1/usuario.
- URL local planejada: http://127.0.0.1:8002/api/v1/usuario.
- Cabeçalho recomendado: Accept: application/json.
- Sem corpo, parâmetros de caminho ou query string suportados.
- Acesso autenticado; proteção futura com auth:sanctum nessa rota.
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

## Visitante: resposta planejada

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

## Relação com a implementação futura

StatefulApi prepara sessão para origens reconhecidas. Auth:sanctum exigirá
autenticação na rota; o Resource definirá a representação pública do User.
A UsuarioResource já existe e foi verificada em memória na 7.17. A rota,
o controller e o login ainda serão introduzidos nas suas próprias etapas.
A próxima, 7.18, criará somente UsuarioController::show; o endpoint continua
planejado, sem rota implementada.

Referências: [proteção de rotas com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [envelope data de Resources](https://laravel.com/docs/13.x/eloquent-resources#data-wrapping).
