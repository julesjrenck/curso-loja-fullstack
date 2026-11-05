# Aula 7.64 — Logout visitante e preflight no navegador

Roteiro preparado e explicado em 05/11/2026, após confirmação da 7.63 com
"entendi". Aluno relatou "deu certo, pode avançar" e confirmou entendimento
com "Sim, entendi" em 05/11/2026. Sucesso geral por relato, sem campos
individuais fornecidos ou observação independente. Publicação conferida em
8e8de99ac636c48d624d08fed3838cc94e6bf002, HEAD/origin/main/main remota iguais.
Checkpoint anterior publicado e
conferido em d2feb0ffb144d5513c543ee0e958fe49cc18e194,
HEAD/origin/main/main remota iguais; registro posterior à publicação.

## Objetivo

Executar uma vez Encerrar sessão na [página de laboratório](../../src/laboratorio-sessao.html),
após preparar CSRF, sem login. A [7.63](07-63-logout-no-laboratorio.md) verificou
sintaxe e extração de cookie com dados fictícios; agora acompanharemos o fluxo
real no navegador. Nenhuma alteração de aplicação foi feita nesta etapa.

O código envia POST com JSON e X-XSRF-TOKEN. O navegador negocia CORS com
OPTIONS quando necessário e depois envia o POST. São duas respostas distintas:
o 204 do preflight não executa logout. O [contrato de logout](../api/logout.md)
permite visitante com sessão e CSRF válidos.

Não há ferramenta de controle do navegador do aluno nesta sessão. O roteiro
depende de seu relato; expectativas não são resultados observados.

## Exercício no Chrome/Edge

1. Na sessão privativa, sem fazer login, abra ou recarregue exatamente
   http://127.0.0.1:8001/laboratorio-sessao.html. Devem aparecer os três botões.
2. Abra F12 → Rede/Network. Use Todos/All para poder ver os diferentes tipos
   de requisição. Clique uma vez em Solicitar cookie CSRF e aguarde o 204 e
   a liberação de Encerrar sessão. Se a preparação falhar, relate antes de seguir.
3. Filtre a lista pelo texto logout e clique uma vez em Encerrar sessão.
   Anote o texto exibido. Não repita o clique para investigar uma divergência.
4. Selecione OPTIONS, se visível, e confira método/status e cabeçalhos CORS
   da resposta. Na requisição, Access-Control-Request-Method anuncia POST e
   Access-Control-Request-Headers anuncia os nomes content-type e x-xsrf-token.
5. Selecione POST destinado a 127.0.0.1:8002/api/v1/logout. Confira status e
   CORS da resposta. Nos cabeçalhos da requisição, veja apenas se X-XSRF-TOKEN
   está presente; não copie seu valor. O corpo esperado é o objeto JSON vazio.
6. Na aba Cookies desse POST, confira os nomes enviados em Request Cookies:
   loja-fullstack-session e XSRF-TOKEN. Informe possíveis bloqueios; cookies
   bloqueados não comprovam envio. Não copie valores ou cabeçalhos completos.

Se OPTIONS não aparecer, relate isso e os pedidos visíveis. Cache de preflight
e filtros podem afetar a observação; ausência na lista não permite concluir
sozinha que o POST foi recusado. A configuração atual tem max_age 0. Não mudar
configurações de segurança, editar cookies ou repetir a operação para forçar
o esperado antes de analisarmos o relato.

Referência: [Rede, cabeçalhos e cookies no Chrome DevTools](https://developer.chrome.com/docs/devtools/network/reference).

## Expectativas, ainda sem execução observada

| Observação | OPTIONS/preflight | POST/logout |
| --- | --- | --- |
| Status esperado | 204 | 204 |
| Allow-Origin da resposta | http://127.0.0.1:8001 | http://127.0.0.1:8001 |
| Allow-Credentials da resposta | true | true |
| Cookies de sessão na requisição | Ausentes. | loja-fullstack-session e XSRF-TOKEN enviados. |
| Token CSRF na requisição | Anuncia o nome em Request-Headers. | X-XSRF-TOKEN presente com valor, sem expô-lo no relato. |
| Efeito | Negociação CORS. | Executa logout se aceito pelo servidor. |

Na resposta OPTIONS, Allow-Methods deve permitir POST e Allow-Headers deve
permitir content-type e x-xsrf-token, sem depender de ordem ou capitalização.
O preflight não envia cookies de sessão; isso faz parte do protocolo.
Fonte: [preflight e credenciais](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/CORS#preflight_requests_and_credentials).

Mensagem esperada na página: Resposta recebida: HTTP 204 (sessão encerrada).
Ela demonstra leitura do status do POST pelo JavaScript. Um 204 visto somente
na linha OPTIONS não comprova essa execução ou leitura. A resposta de sucesso
não contém JSON a decodificar.

419 legível significa recusa de CSRF, não falha de leitura CORS. Se houver
mensagem de cookie ausente, o próprio código pode ter interrompido antes de
fetch. Uma falha genérica pode vir de preparação, codificação ou rede/leitura;
relatar a mensagem e os pedidos visíveis antes de diagnosticar a causa.

Conforme o contrato/testes anteriores, logout invalida a sessão e renova seu
token, emitindo cookies de visitante. Status, presença de cabeçalhos e nomes de
cookies não medem, por si só, os valores internos de ID/token. Não compararemos
ou copiaremos valores para afirmar renovação criptográfica nesta verificação.
Não fazemos login, consulta adicional ou segundo logout neste exercício.

## Relato para continuar

Informar apenas:

```text
Preparação — mensagem:
Logout — mensagem:
OPTIONS apareceu? Status / Allow-Origin / Allow-Credentials:
POST — status / Allow-Origin / Allow-Credentials:
POST — X-XSRF-TOKEN presente? (sem valor)
POST — nomes dos cookies enviados e eventuais bloqueios:
```

Sem valores de cookies/tokens/IDs, HAR, cabeçalhos completos ou capturas com
valores. Se falhar, começar pelas mensagens e métodos/status visíveis.

## Preparação e limites

Docker Compose confirmou php/backend/sqlserver ativos. Configuração CORS
existente conferida: origem 8001, credenciais true, métodos/headers permitidos
e max_age 0. Leitura de arquivos e comando de controle; nenhuma chamada à API.
Página mantida conforme 7.63. Nenhum novo serviço, dependência ou alteração da
aplicação. Sem navegador/clique/logout pelo assistente nesta etapa.

Não repetimos sintaxe, controles fictícios ou entrega do HTML já aprovados.
Sem nova suíte Laravel; última 7.58, 107 testes/1.586 asserções.
Depois, o aluno relatou sucesso geral, sem fornecer campos individuais do
preflight/POST. As tabelas acima continuam sendo expectativas, sem medições
individuais atribuídas pelo assistente.

Git diff --check passou; sete links locais válidos, somente os quatro
documentos previstos alterados e índice vazio. Aplicação/página/configurações
preservadas. Isso verifica os registros, sem substituir o navegador.

## Continuidade

Sucesso geral relatado e entendimento confirmado com "Sim, entendi" em
05/11/2026 sobre preflight e POST. Campos individuais não fornecidos.
Publicação da 7.64 concluída. Continuidade na
[7.65 — seeder da conta fictícia](07-65-seeder-usuario-laboratorio.md), sem
cadastro executado ainda. Módulos 8 a 23 não iniciados.
