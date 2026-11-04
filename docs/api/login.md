# API de login — contrato planejado

Desenho da etapa 7.24, em 04/11/2026. POST /api/v1/login ainda não existe.
Exemplos fictícios, sem requisições de login executadas ou usuários criados.
LoginRequest criada na 7.25: validação conferida em memória, sem rota/controller.
O [contrato da consulta do usuário](autenticacao.md) já está implementado;
este documento planeja como estabelecer a identidade por credenciais.

## Requisição planejada

- Método e caminho: POST /api/v1/login.
- URL local planejada: http://127.0.0.1:8002/api/v1/login.
- Accept: application/json; Content-Type: application/json.
- Recebe visitantes; não exigirá auth:sanctum para tentar autenticar.
- Voltado à interface própria, usando sessão e guard web; não emitirá token Bearer.
- Sem parâmetros suportados no caminho ou query string.

```json
{
  "email": "ana@example.test",
  "password": "senha-ficticia-do-exemplo"
}
```

| Campo | Regra de entrada planejada |
| --- | --- |
| email | Obrigatório, string, formato de e-mail e até 255 caracteres após normalização. |
| password | Obrigatório, string não vazia nem composta somente por espaços. |

Ausência, null, array ou número não atendem às regras. Email inválido ou acima
do limite também falha. As regras Laravel planejadas são required/string/email/
max:255 para email e required/string para password, com bail por campo na
implementação. Não exigimos senha mínima
de cadastro para tentar login: a operação confere a senha de uma conta existente.

TrimStrings removerá espaços externos de email. Password está nas exceções
padrão desse middleware: espaços externos de uma senha com outros caracteres
serão preservados. ConvertEmptyStringsToNull transforma string vazia em null.
Não faremos conversão adicional de maiúsculas/minúsculas nem trim manual da senha.
Campos extras não farão parte das credenciais usadas; remember, id e name não
serão opções de login. Não implementaremos "lembrar de mim" nesta versão.

## Sessão e preparação CSRF

A interface própria deve usar uma origem reconhecida pelo Sanctum, com Origin
ou Referer apropriado, para que statefulApi prepare sessão/CSRF nas rotas API.
Antes do login, o fluxo prevê GET /sanctum/csrf-cookie e envio dos cookies na
requisição POST. O cliente JavaScript deve repassar XSRF-TOKEN decodificado no
cabeçalho X-XSRF-TOKEN, conforme a integração de navegador a ser introduzida.
Não copiamos valores reais de cookies/tokens para documentação ou Git.

A proteção CSRF permanece ativa. A rejeição por CSRF terá status 419/JSON,
com message string, antes da verificação de credenciais; não significa senha
incorreta. O ramo de mesma origem via Sec-Fetch-Site do Laravel 13 já estudado
continua válido: a ausência isolada do header de token não define todo o resultado.
Este contrato não oferece login stateless para qualquer cliente sem sessão.

## Sucesso planejado

Credenciais aceitas: 204 No Content, sem corpo, sem objeto data e sem
redirecionamento HTML. O login estabelecerá a identidade no guard web e renovará
o identificador da sessão. Os cookies correspondentes serão gerenciados pelo
fluxo de sessão; não prometemos Content-Type JSON para uma resposta sem corpo.

A interface poderá então chamar GET /api/v1/usuario e receber o contrato 200
já documentado. O POST não devolverá senha, hash ou token de API no corpo.
Regenerar a sessão após login é parte da implementação futura, não uma ação
realizada pelo desenho deste contrato.

## Entrada inválida: resposta planejada

Status 422, Content-Type application/json, objeto com message string e errors,
um dicionário de nomes de campos para listas não vazias de strings.
O exemplo representa email inválido; outros casos podem apontar password ou ambos.

```json
{
  "message": "Os dados enviados são inválidos.",
  "errors": {
    "email": ["Informe um e-mail válido."]
  }
}
```

A validação ocorre antes de tentar autenticar. Os valores das credenciais não
devem ser incluídos no corpo de erro. Textos e idioma das mensagens podem variar.

## Credenciais recusadas: resposta planejada

Entrada com formato válido, mas e-mail não cadastrado ou senha incorreta:
status 422/application/json, no mesmo formato de validação. Ambos os casos
produzirão o mesmo erro genérico associado a email, sem informar qual credencial
falhou nem revelar se a conta existe. Exemplo:

```json
{
  "message": "As credenciais informadas são inválidas.",
  "errors": {
    "email": ["As credenciais informadas são inválidas."]
  }
}
```

O cliente observa status/errors; o texto acima é ilustrativo, não uma tradução
fixa. Essa falha não estabelece uma nova identidade. O 401 da consulta protegida
continua significando que aquela requisição não possui autenticação válida.
Usar 422 para credenciais recusadas neste login é uma decisão do nosso contrato.

## Limites e continuidade

LoginRequest já implementa authorize true e as regras de entrada. Diagnóstico
da 7.25: 17 casos em memória (três válidos/14 inválidos), normalização, seleção
de campos via validated e erros 422 renderizados pelo handler; zero SQL.
Isso não executa login nem verifica credenciais ou CSRF. Sem rota, controller,
tentativa de autenticação, alteração de sessão ou entrada no OpenAPI de login.
Limitação de tentativas ainda terá
regra e verificação próprias antes de disponibilizar o fluxo de login completo.
Próximo passo 7.26: testes automatizados da LoginRequest em memória para
entradas válidas/inválidas, normalização e seleção de campos antes de controller/rota.

Referências: [fluxo de login SPA do Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication),
[autenticação manual e renovação da sessão](https://laravel.com/docs/13.x/authentication#manually-authenticating-users)
e [erros JSON de validação](https://laravel.com/docs/13.x/validation#validation-error-response-format).
