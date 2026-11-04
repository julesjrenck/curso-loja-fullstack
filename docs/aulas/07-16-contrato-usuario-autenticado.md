# Aula 7.16 — Contrato da consulta do usuário autenticado

Desenho e explicação em 04/11/2026, após confirmação da 7.15 com "entendi".
Checkpoint anterior publicado e conferido em
46742792a5ec9f4015f54a2eb55afe6fae53445f; HEAD/origin/main/main remota iguais.
Entendimento da 7.16 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos [o contrato planejado de autenticação](../api/autenticacao.md) para
combinar entrada, saída e acesso de GET /api/v1/usuario antes de escrever a rota.
Contrato é o acordo que orientará implementação, testes e interface.
Não há mudança de código de aplicação nesta etapa.

A pergunta dessa consulta é "quem está autenticado nesta requisição?".
Ela não recebe ID de usuário, senha ou e-mail de login. A autenticação fornecerá
a identidade. Por exemplo, a interface poderá usar name para exibir uma saudação.

## Entrada e saídas

GET, sem corpo ou parâmetros suportados, com Accept: application/json recomendado.
Na futura interface própria, o navegador enviará o cookie da sessão autenticada.
Esta operação apenas consulta a identidade; não cria autenticação.

| Situação | Status planejado | Corpo planejado |
| --- | --- | --- |
| Usuário autenticado | 200 | Objeto data com id, name e email. |
| Visitante, sem autenticação válida | 401 | Objeto com message string; sem data. |

O contrato contém os exemplos JSON completos e os tipos de cada campo.
Data será um objeto de um usuário, seguindo o envelope de JsonResource já
usado no catálogo. Name/email seguem os nomes do User gerado; usuario é o
caminho público em português. O ID de exemplo não fixa nenhum ID no banco.

Selecionaremos explicitamente id/name/email em UsuarioResource. Hidden no User
oculta password/remember_token ao serializar o model, mas não define sozinho
essa representação: datas e email_verified_at também ficarão fora do contrato.
Nunca é necessário devolver a senha, mesmo em hash, para a interface se identificar.

## Ligação com a 7.15

StatefulApi prepara a sessão das origens reconhecidas; auth:sanctum exigirá
autenticação quando aplicarmos esse middleware à futura rota. Uma sessão de
visitante com token CSRF continua sem usuário autenticado.

Consultamos a documentação oficial de Sanctum e Resources, citada no contrato.
Por reflexão no PHP Docker, lemos somente AuthenticationException::__construct
e Handler::unauthenticated do Laravel instalado: mensagem padrão Unauthenticated.;
ramo JSON produz message e status 401. O bootstrap existente escolhe JSON para
api/*. Essa inspeção não executou autenticação nem uma requisição HTTP.

## Verificação e limites

Os dois blocos JSON do contrato foram extraídos e decodificados com
JSON_THROW_ON_ERROR no PHP Docker. Conferimos formato externo, campos exatos,
ID inteiro positivo, name/email strings e erro com message string sem data.
Código 0. É uma verificação dos exemplos escritos, não do endpoint ainda ausente.

Sem criação de rota, Resource, controller, teste permanente, sessão ou dados;
sem SQL. A suíte completa não foi repetida nesta etapa documental. Último
resultado continua 7.15: 67 testes/635 asserções. OpenAPI do catálogo preservado.

## Continuidade

Entendimento confirmado com "entendi" em 04/11/2026. Depois de publicar,
7.17 — criar somente UsuarioResource com id, name e email, verificando a
representação em memória antes de adicionar controller/rota/login.
Contrato e explicação apresentados; entendimento confirmado. Checkpoint
publicado e conferido em
833c010506b8c0b45edd2cb8d959d4aba5d99744; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.
