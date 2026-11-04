# Aula 7.24 — Contrato do login por sessão

Desenho, explicação e verificações em 04/11/2026, após confirmação da 7.23
com "entendi". Checkpoint anterior publicado e conferido em
a4cd9bcbe358a6093cf289e9d5a590b541f0d52b; HEAD/origin/main/main remota iguais.
Entendimento da 7.24 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos [o contrato planejado de login](../api/login.md), separado da
[consulta do próprio usuário](../api/autenticacao.md). Consultar a identidade
já autenticada e estabelecer identidade por e-mail/senha são operações distintas.
Não implementamos a rota ou autenticação por credenciais nesta etapa.

POST /api/v1/login receberá JSON com email/password, Accept JSON e Content-Type
JSON. Receber visitantes é necessário para tentar login; não terá auth:sanctum
como pré-condição. Sessão/CSRF da interface própria continuam necessários.

## Entrada, saídas e decisões

Email será obrigatório/string/email/máximo 255 caracteres. Password será
obrigatório/string, preservando espaços externos quando houver outros caracteres.
Não reutilizamos regras mínimas de cadastro para conferir uma senha existente.
O contrato detalha normalização, dados não suportados e exemplos fictícios.

| Condição | Resposta planejada |
| --- | --- |
| Credenciais aceitas | 204, corpo vazio; identidade no guard web e ID da sessão renovado. |
| Dados de entrada inválidos | 422 JSON com message/errors por campo. |
| E-mail inexistente ou senha incorreta | 422 JSON com o mesmo erro genérico em errors.email. |
| Proteção CSRF rejeita a requisição | 419 JSON com message, antes da tentativa de autenticação. |

204 confirma a operação sem devolver dados do usuário. Após o login, a interface
poderá consultar GET /api/v1/usuario, que já possui representação definida.
Não há JSON a decodificar no corpo 204 nem Content-Type JSON prometido nele.

422 representa tanto formato inválido quanto credenciais recusadas; errors
orienta a exibição por campo. A mesma mensagem genérica atende e-mail não
cadastrado e senha incorreta. Textos são ilustrativos; o cliente deve observar
status e campos. O 401 já estudado continua na consulta de identidade sem login.
O uso de 422 para falha de credenciais é uma escolha deste projeto.

## Ligação com sessão, CSRF e guard

Mantemos o fluxo csrf-cookie → POST login → GET usuario. A interface deve enviar
cookies e o header X-XSRF-TOKEN conforme a integração e ser reconhecida pelo
Sanctum para preparar sessão na API. Não retiramos a proteção CSRF para permitir
o login. A condição de mesma origem do Laravel 13, já vista na 7.9, continua válida.

O login futuro usará guard web e autenticação padrão do Laravel. Renovar o ID
da sessão após credenciais aceitas será parte da implementação. ActingAs dos
testes anteriores apenas prepara a identidade, não exercita esses passos.
Limitação de tentativas terá regra própria antes de concluir o fluxo de login.

## Inspeção e verificação documental

Fontes oficiais Sanctum, autenticação e validação consultadas e citadas no contrato.
Leitura por reflexão em PHP Docker: SessionGuard::attempt recebe credenciais,
retorna true após login quando válidas e false ao recusar. Nenhuma chamada a
attempt foi executada. Uma busca inicial usou namespace incorreto dos middlewares;
corrigida para Illuminate\Foundation\Http\Middleware, leitura final código 0.
TrimStrings preserva password/current_password/password_confirmation por padrão;
ConvertEmptyStringsToNull transforma exatamente '' em null. Não inicializamos
aplicação nessa inspeção nem criamos sessão/usuário ou executamos SQL.

Três exemplos JSON do contrato (entrada e dois erros) extraídos e decodificados
com JSON_THROW_ON_ERROR em PHP Docker, conferindo campos e tipos em memória.
Isso verifica os exemplos escritos, não regras de validação ou autenticação de
um endpoint. As regras serão implementadas e verificadas na 7.25.
Sem nova suíte Laravel; última completa permanece 7.22, 71 testes/662 asserções.
OpenAPI e aplicação preservados; não houve POST de login ou teste de cookies.

## Continuidade

Contrato apresentado e verificado; entendimento confirmado com "entendi" em
04/11/2026; publicação pendente. Após publicar: 7.25 — criar somente
LoginRequest com authorize permitindo visitantes e regras email/password,
verificando validação antes de criar controller ou registrar rota de login.
