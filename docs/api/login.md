# API de login — rota registrada

Desenho da etapa 7.24; rota registrada na 7.33, em 04/11/2026.
Exemplos fictícios. LoginRequest criada na 7.25 e LoginController::store na 7.27.
Controller verificado por chamada direta com guard web, User fictício em
loja_test/transação/rollback e sessão array. POST /api/v1/login agora conecta
esse controller ao middleware throttle:login. Diagnóstico inicial pelo kernel
confirma entrada inválida 422 e limite 429; sucesso por HTTP ainda pendente.
O [contrato da consulta do usuário](autenticacao.md) já está implementado;
este documento define como estabelecer a identidade por credenciais.

## Requisição

- Método e caminho: POST /api/v1/login.
- URL local: http://127.0.0.1:8002/api/v1/login.
- Accept: application/json; Content-Type: application/json.
- Recebe visitantes; não exige auth:sanctum para tentar autenticar.
- Voltado à interface própria, usando sessão e guard web; não emitirá token Bearer.
- Sem parâmetros suportados no caminho ou query string.

```json
{
  "email": "ana@example.test",
  "password": "senha-ficticia-do-exemplo"
}
```

| Campo | Regra de entrada implementada |
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
Na 7.27, diagnóstico do controller confirmou 204 vazio, identidade no guard/
sessão e ID/token CSRF renovados após credenciais corretas. Não exerceu rota,
CSRF de requisição ou transporte de cookie no navegador.

## Entrada inválida: resposta verificada pelo kernel

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
Na 7.27, senha incorreta e e-mail inexistente produziram corpos 422 iguais na
chamada direta ao controller, com guard visitante e ID/token de sessão preservados.

## Limitação de frequência aplicada

Na 7.29, [regra de limite de login](limite-login.md) definida: cinco pedidos
por IP em janela de 60 segundos iniciada no primeiro pedido contado. Conta
sucesso e falhas que alcancem o limitador; e-mails do mesmo IP compartilham
contador. Sexto pedido bloqueado antes do controller com 429 JSON/message,
Retry-After em segundos restantes e Cache-Control no-store. Bloqueio não
prorroga a janela e sucesso não zera a contagem. Na 7.30, regra registrada pelo
nome login, com resposta 429 JSON configurada; na 7.33, aplicada à rota
por throttle:login antes da validação/controller.

## Limites e continuidade

LoginRequest já implementa authorize true e as regras de entrada. Diagnóstico
da 7.25: 17 casos em memória (três válidos/14 inválidos), normalização, seleção
de campos via validated e erros 422 renderizados pelo handler; zero SQL.
Esse diagnóstico da 7.25 não executou login ou CSRF. Na 7.27, LoginController
passou a executar a tentativa pelo guard web com validated, erro genérico ou
renovação de sessão e 204. Diagnóstico com três casos em loja_test e sessão
array passou, sem manter usuários ou sessões persistidos. Na 7.33, endpoint
registrado com o limitador escolhido na 7.29, registrado na 7.30 e testado
isoladamente na 7.31. Entrada no OpenAPI e fluxo completo continuam pendentes.
Na 7.26, LoginRequestTest automatizou três entradas válidas e 14 inválidas,
normalização/validated e 422 JSON renderizado em memória: focado 17 testes/94
asserções, suíte completa 88 testes/756 asserções. Não executa login ou CSRF.
Na 7.28, LoginControllerTest automatizou sucesso e duas falhas por chamada direta,
com guard real/loja_test/transação e sessão array: focado 2 testes/47 asserções,
suíte completa 90 testes/803 asserções. Sucesso exige 204 vazio, identidade e
renovação de ID/token; falhas exigem visitante, ID/token preservados e corpos
422 iguais, sem fixar tradução. Ainda não testa pipeline HTTP/CSRF/cookies.
Na 7.29, diagnóstico do contador Laravel com ArrayStore/relógio controlado
passou em nove casos, sem HTTP ou aplicação do middleware à rota.
Na 7.30, configuração e callback do limitador registrado conferidos em memória;
suíte existente 90/803 passou. Nenhuma rota utiliza throttle:login ainda.
Na 7.31, testes do middleware passaram com relógio controlado/cache array:
focado 6/156, suíte 96/959. Não exercitam o endpoint completo ou CSRF.
Consulta de status na 7.31 mostrou a migration de usuários Pending em loja.
Na 7.32, aplicada somente essa migration pela conexão sqlsrv_migracoes:
três tabelas vazias, lote 4/Ran e reexecução Nothing to migrate. Catálogo
preservado por comparação de conteúdo/metadados; aplicação continua loja_app
e sessões file. Suíte existente 96/959 passou em loja_test, vazio após rollback.
Na 7.33, rota registrada com throttle:login. Diagnóstico kernel/testing, origem
reconhecida/cache e sessão array/JSON vazio: cinco 422 email/password e sexto
429 para Accept JSON/HTML/ausente; 429 preserva Retry-After 60/limite 5/restante
0/no-store. Todos JSON/sem Location/visitante, zero SQL após identidade; 18 pedidos.
Suíte existente 96/959 passou. Sem rede/navegador; testing dispensa validação
CSRF. Ainda não exercemos sucesso ou credenciais recusadas pelo endpoint.
Próxima 7.34: automatizar entrada inválida e limite em LoginApiTest.

Referências: [fluxo de login SPA do Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication),
[autenticação manual e renovação da sessão](https://laravel.com/docs/13.x/authentication#manually-authenticating-users)
e [erros JSON de validação](https://laravel.com/docs/13.x/validation#validation-error-response-format).
