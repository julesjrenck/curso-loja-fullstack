# Aula 7.77 — Contrato da consulta administrativa

Desenho apresentado em 05/11/2026, após entendimento da
[7.76](07-76-testes-gate-administracao.md) confirmado com "entendi".
Checkpoint anterior publicado e conferido em
077cc6270931f3d069611cc1978608865beaf144; HEAD/origin/main/main remota iguais.
Entendimento da 7.77 confirmado com "entendi" em 05/11/2026; publicação
pendente. Somente documentação alterada.

## Objetivo e arquivo

Criamos [docs/api/administracao.md](../api/administracao.md), contrato planejado
de GET /api/v1/administracao. Antes de escrever o controller e registrar a
rota, definimos a entrada, a resposta e as situações de recusa.

A consulta será a entrada da área administrativa. Não terá corpo nem
parâmetros suportados. Depois de passar por autenticação e autorização,
devolverá um objeto data com mensagem fixa de boas-vindas, sem dados de contas.

## Da decisão do Gate para a resposta HTTP

Na 7.76 verificamos allows retornando true/false em memória. Um booleano do
Gate não é uma resposta HTTP. Na futura integração, middleware interromperá
a requisição quando houver uma recusa.

| Situação | Verificação que decide | Status planejado |
| --- | --- | --- |
| Visitante sem identidade válida | auth:sanctum | 401 |
| Cliente autenticado sem permissão | can:acessar-administracao | 403 |
| Administrador autorizado | Ambas passam; controller responde | 200 |

O middleware can consultará o Gate definido no provider. A autenticação
vem antes: um visitante deve receber 401, enquanto um cliente reconhecido
com is_admin false deve receber 403. A regra recebe o User identificado no
servidor; um parâmetro is_admin enviado pelo navegador não concede acesso.

Referência: [autorização por middleware no Laravel](https://laravel.com/docs/13.x/authorization#via-middleware).

## Representação da resposta

```json
{
  "data": {
    "mensagem": "Bem-vindo à administração da loja."
  }
}
```

Data é o envelope do sucesso. Mensagem é a única propriedade interna.
Erros 401/403 terão somente message string e nenhum data; o cliente usará
o status para distinguir ausência de autenticação e falta de permissão.
Os exemplos de message no contrato são ilustrativos; não fixaremos seus
textos como condição para a interface reconhecer o erro.

Todos os três resultados previstos são JSON, sem redirecionamento HTML.
O [bootstrap existente](../../backend/bootstrap/app.php) já configura JSON
para api/*; isso será conferido novamente quando a operação for implementada.
Cookies e identidade seguem o login existente; esta leitura não faz login
ou promove usuários e não acrescenta operações administrativas de escrita.

## Verificação e continuidade

Conferidos routes/api.php, bootstrap/app.php e AppServiceProvider. Gate
acessar-administracao está definido, mas o caminho administrativo não está
registrado nas rotas nem no OpenAPI atual. Nenhuma chamada HTTP ou SQL,
comando PHP, teste novo ou alteração na aplicação nesta etapa. A última
suíte continua sendo a da 7.76: 112 testes/1.618 asserções; não foi repetida.
O desenho não comprova uma resposta HTTP 200/401/403 real.

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.78 — criar somente
AdministracaoController::show com resposta JSON 200 do contrato e verificá-lo
por chamada direta em memória, ainda sem rota. Módulos 8 a 23 não iniciados.
