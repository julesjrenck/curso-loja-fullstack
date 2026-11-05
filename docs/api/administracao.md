# API de administração — controller criado, rota pendente

Desenho da etapa 7.77, em 05/11/2026. Na 7.78,
[AdministracaoController::show](../../backend/app/Http/Controllers/Api/V1/AdministracaoController.php)
foi criado e sua resposta 200 verificada por chamada direta em memória.
Rota e inclusão no OpenAPI continuam pendentes. Não houve requisição HTTP
ou verificação de autenticação/autorização dessa operação; 401/403 continuam
planejados. A verificação do controller não demonstra proteção de acesso.

## Consultar a entrada da administração

- Método e caminho: GET /api/v1/administracao.
- URL local planejada: http://127.0.0.1:8002/api/v1/administracao.
- Cabeçalho recomendado: Accept: application/json.
- Sem corpo ou parâmetros suportados no caminho/query string.
- Interface própria usa sessão autenticada e cookies, conforme o
  [fluxo de login](login.md); no Fetch entre portas, credentials include.
- Consulta de leitura: não altera usuários, produtos ou permissões.

Esta operação será a entrada da área administrativa da loja. Inicialmente
retornará uma mensagem fixa após as verificações de acesso. Não lista contas,
altera preços ou promove usuários. A conta de laboratório existente não
passará a ser administradora por consultar esse caminho.

## Ordem das verificações

1. Auth:sanctum exige uma identidade autenticada; sem ela, encerra com 401.
2. Can:acessar-administracao exige a decisão do Gate já registrado;
   usuário autenticado sem permissão recebe 403.
3. Se as duas verificações passarem, o controller devolve a resposta 200.

O Gate usa is_admin do User identificado no servidor, convertido pelo cast
boolean. Não lê um privilégio escolhido no corpo/query string do pedido.
Seu teste em memória recusa visitante; na futura rota, o middleware de
autenticação deverá interromper esse visitante antes, com 401. Essa integração
ainda precisa ser implementada e verificada por HTTP.

Fontes: [proteção de rotas com Sanctum](https://laravel.com/docs/13.x/sanctum#protecting-routes)
e [autorização por middleware](https://laravel.com/docs/13.x/authorization#via-middleware).

## Sucesso do controller: verificado por chamada direta

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

## Visitante: 401 planejado

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

## Cliente autenticado: 403 planejado

Com autenticação válida, mas recusa do Gate: status 403,
Content-Type application/json, sem redirecionamento HTML. Objeto com somente
message, uma string obrigatória, sem data. Exemplo ilustrativo da mensagem
padrão de autorização do Laravel:

```json
{
  "message": "This action is unauthorized."
}
```

O cliente deve decidir pelo status, sem depender do texto/idioma de message.
Usamos mensagem em português no sucesso e message nos erros para preservar
o padrão de erro existente do framework. O bootstrap atual configura JSON
para api/*; a futura rota deverá manter esse comportamento.

## Escopo desta etapa

Na 7.77 foi definido o contrato textual. Na 7.78 foi criado somente o
controller; sintaxe e sete controles da resposta direta passaram, sem SQL
ou conexão PDO aberta. Ainda sem rota, resposta HTTP observada, alteração
de Gate, teste novo ou conta administrativa. O OpenAPI permanece sem esta
operação. Próxima etapa: registrar a rota com auth:sanctum/can e conferir
401/403/200 pelo kernel HTTP com usuários em memória.
