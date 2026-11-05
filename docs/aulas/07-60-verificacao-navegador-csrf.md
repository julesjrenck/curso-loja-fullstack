# Aula 7.60 — Verificação acompanhada do CSRF no navegador

Roteiro preparado e explicado em 05/11/2026, após confirmação da 7.59 com
"entendi". O aluno informou que usará Chrome ou Edge. Em retorno posterior,
relatou "deu certo, vamos adiante": execução bem-sucedida por relato, sem
campos individuais informados. Entendimento confirmado com "Sim, entendi"
em 05/11/2026, em resposta à confirmação solicitada.
Publicação da 7.60 pendente; checkpoint 7.59 publicado e conferido em
8232454a83047165c8e9746cdbc56de207548cd4, HEAD/origin/main/main remota iguais.

## Objetivo

Executar uma vez o botão da [página de laboratório](../../src/laboratorio-sessao.html)
e observar duas coisas: a resposta acessível ao JavaScript e os cookies
armazenados pelo navegador. A [7.59](07-59-pagina-laboratorio-sessao.md) verificou
entrega do HTML e sintaxe do JS; ainda não comprovou esses resultados.

Nesta sessão não há ferramenta de controle do navegador do aluno. O acompanhamento
será pelo roteiro e por seu relato dos campos indicados abaixo. Não tratamos
expectativas como execução ou resultado confirmado. Só documentação foi alterada.

## Exercício no Chrome/Edge

1. Use uma janela privativa sem sessão anterior da loja e abra exatamente
   http://127.0.0.1:8001/laboratorio-sessao.html. Não faça login.
2. Abra F12, painel Rede/Network. Mantenha a gravação ativa e a lista visível.
   Em Aplicativo/Application, Armazenamento/Storage, Cookies, confira se já há
   cookies da loja para 127.0.0.1; se houver, relate antes de executar o botão,
   sem apagar cookies de uma sessão desconhecida.
3. Volte a Rede e clique uma vez em Solicitar cookie CSRF. Anote somente o texto
   mostrado na página. Na lista, selecione csrf-cookie, destinado à porta 8002.
4. Em Cabeçalhos/Headers, confira método e status. Nos cabeçalhos da requisição,
   veja Origin; nos da resposta, veja Access-Control-Allow-Origin e
   Access-Control-Allow-Credentials. Não copie Cookie ou Set-Cookie completos.
5. Em Aplicativo → Armazenamento → Cookies, selecione a entrada de 127.0.0.1 e
   observe os nomes, HttpOnly, SameSite e Path. Se necessário, atualize somente
   a tabela de cookies. Não copie valores e não repita o botão para investigar
   uma divergência antes de relatá-la.

Referências oficiais: [cabeçalhos na Rede](https://developer.chrome.com/docs/devtools/network/reference#headers)
e [painel de cookies](https://developer.chrome.com/docs/devtools/application/cookies).
Nomes dos painéis podem aparecer em português ou inglês.

## Expectativas, ainda sem resultado observado

| Observação | Esperado |
| --- | --- |
| Mensagem na página | Resposta recebida: HTTP 204 (sem corpo). |
| Método/status em Rede | GET / 204 |
| Origin da requisição | http://127.0.0.1:8001 |
| Access-Control-Allow-Origin da resposta | http://127.0.0.1:8001 |
| Access-Control-Allow-Credentials da resposta | true |
| Corpo da resposta | Vazio; não há JSON a interpretar. |
| Cookies armazenados | loja-fullstack-session e XSRF-TOKEN |

O GET com Accept, sem cabeçalhos adicionais, não exige preflight por si só.
O pedido relevante neste exercício é GET csrf-cookie; um OPTIONS extra precisa
ser explicado pelos dados observados, sem presumir falha ou sucesso.

| Cookie esperado | HttpOnly | SameSite | Path |
| --- | --- | --- | --- |
| loja-fullstack-session | Sim | Lax | / |
| XSRF-TOKEN | Não | Lax | / |

HttpOnly impede acesso pelo JavaScript da página; o navegador ainda pode
administrar e enviar esse cookie. O cookie de sessão usa essa proteção. O
XSRF-TOKEN fica disponível ao cliente para o fluxo de token já estudado; nesta
página não lemos seu valor. SameSite e Path são atributos de envio, distintos
da autorização de leitura de respostas pelo CORS.
Fonte: [atributos de cookies na MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/Cookies#security).

Um 204 mostrado pela página indica que seu JS conseguiu ler o status. A lista
de cookies armazenados fornece a observação separada de aceitação pelo navegador.
Set-Cookie na resposta, sozinho, indica emissão pelo servidor. Preparar cookies
de visitante não comprova login nem testa uma operação protegida por CSRF.

## Relato para continuar

Informar somente:

```text
Mensagem na página:
Método/status:
Origin:
Allow-Origin:
Allow-Credentials:
loja-fullstack-session: presente? HttpOnly? SameSite? Path?
XSRF-TOKEN: presente? HttpOnly? SameSite? Path?
```

Se houver falha, começar pelo texto da página e por método/status visíveis em
Rede. Não enviar cookies, tokens, IDs, HAR, cabeçalhos completos ou capturas
com valores. Não alterar configurações do navegador ou aplicação para tentar
obter o esperado antes de analisarmos o resultado.

## Preparação conferida pelo assistente

Leitura PHP no Docker, bootstrap de console/ambiente local/sem cache: cookie de
sessão nome loja-fullstack-session, HttpOnly true, SameSite lax, Path /, domínio
sem sobrescrita. CORS permite origem 8001 com credenciais. Somente metadados
públicos, sem valores de cookies, sessão iniciada ou pedido à API. Código 0.

StartSession e PreventRequestForgery instalados foram lidos: o cookie de sessão
usa os atributos configurados; XSRF-TOKEN usa HttpOnly false e SameSite/Path da
configuração. Serviços php/backend/sqlserver ativos. Nenhum serviço ou
dependência instalado, nenhuma chamada da API ou suíte repetida. Última suíte:
7.58, 107 testes/1.586 asserções. Aplicação e página mantidas.

Essas leituras sustentam expectativas. Depois, o aluno relatou sucesso geral
com "deu certo, vamos adiante". Não forneceu status/cabeçalhos/atributos
individualmente; as tabelas acima continuam descrevendo expectativas.
A execução foi relatada pelo aluno, sem observação independente do assistente.

Git diff --check passou; quatro links locais válidos, somente os quatro
documentos previstos alterados e índice vazio. Aplicação/página/configurações
preservadas. Esses controles verificam os registros, sem substituir o navegador.

## Continuidade

Relato geral de sucesso recebido em 05/11/2026. Reforçada a distinção entre
leitura do status, armazenamento dos cookies e autenticação. Solicitada
confirmação explícita de entendimento, conforme o ritmo do AGENTS.md; pedido
de continuar não foi registrado como confirmação de entendimento.
Aluno confirmou entendimento com "Sim, entendi" em 05/11/2026. Publicação ainda
pendente. Próxima após publicar: 7.61 — acrescentar consulta GET /api/v1/usuario
ao laboratório para observar 401 de visitante, sem login.
