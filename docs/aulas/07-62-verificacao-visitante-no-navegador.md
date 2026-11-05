# Aula 7.62 — Visitante com cookies no navegador

Roteiro preparado e explicado em 05/11/2026, após confirmação da 7.61 com
"entendi". Aluno relatou "deu certo, podemos continuar" e confirmou entendimento
com "Sim, entendi" em 05/11/2026. Sucesso geral por relato, sem resultados
individuais fornecidos ou observação independente. Publicação pendente. Checkpoint anterior publicado e
conferido em 23c6c07884ce932ac7533aa1522de3f9c31d0b1c,
HEAD/origin/main/main remota iguais; registro posterior à publicação.

## Objetivo

Observar a consulta protegida feita pela [página de laboratório](../../src/laboratorio-sessao.html)
depois da preparação de CSRF. A [7.61](07-61-consulta-visitante-no-laboratorio.md)
acrescentou o botão; nesta etapa acompanharemos sua execução no navegador.
Nenhum arquivo de aplicação foi alterado.

Precisamos distinguir três evidências: o status lido pelo JavaScript, os
cabeçalhos de resposta e a presença dos cookies enviados. Um 401 sozinho pode
ocorrer também sem cookies. O armazenamento observado no exercício anterior
não comprova, por si só, o envio nesta requisição.

Não há ferramenta de controle do navegador do aluno nesta sessão. O exercício
depende de seu relato; não registramos resultados esperados como observados.

## Exercício no Chrome/Edge

1. Na sessão privativa do exercício, sem fazer login, abra ou recarregue
   http://127.0.0.1:8001/laboratorio-sessao.html. Devem aparecer os dois botões.
   Se a janela anterior foi fechada, use uma nova sessão privativa sem login.
2. Abra F12 e selecione Rede/Network antes dos cliques. Clique uma vez em
   Solicitar cookie CSRF e aguarde sua mensagem. Esperamos 204 e liberação de
   Consultar usuário. Se a preparação falhar, relate essa mensagem antes de
   continuar.
3. Clique uma vez em Consultar usuário. Anote o texto exibido e selecione a
   requisição mais recente usuario, destinada a 127.0.0.1:8002/api/v1/usuario.
4. Em Cabeçalhos/Headers, observe método/status e, na resposta,
   Access-Control-Allow-Origin e Access-Control-Allow-Credentials.
5. Na aba Cookies dessa mesma requisição, observe Cookies da requisição/
   Request Cookies. Informe apenas se loja-fullstack-session e XSRF-TOKEN
   aparecem entre os cookies enviados. Se houver aviso de bloqueio, relate
   isso; cookies bloqueados não confirmam envio. Não copie seus valores.

Referência oficial: [cookies de uma requisição na Rede](https://developer.chrome.com/docs/devtools/network/reference#cookies)
e [cabeçalhos](https://developer.chrome.com/docs/devtools/network/reference#headers).
A tabela de Aplicativo/Cookies mostra armazenamento; aqui usamos a requisição
selecionada em Rede para observar transporte.

## Expectativas ainda sem resultado observado

| Observação | Esperado para o visitante |
| --- | --- |
| Preparação | Resposta recebida: HTTP 204 (sem corpo). |
| Consulta mostrada pela página | Resposta recebida: HTTP 401 (sem autenticação). |
| Método/status da consulta em Rede | GET / 401 |
| Allow-Origin da resposta | http://127.0.0.1:8001 |
| Allow-Credentials da resposta | true |
| Cookies enviados na consulta | loja-fullstack-session e XSRF-TOKEN |

O [contrato da consulta](../api/autenticacao.md) exige identidade autenticada.
A preparação cria condições para usar sessão e CSRF; não faz login. Portanto,
o 401 é esperado nesse controle visitante. O código lê resposta.status e trata
401 explicitamente; Fetch não rejeita a Promise apenas por um status HTTP de
erro. A página continua sem ler ou exibir o corpo.

Se a página exibir seu texto de 401, o JavaScript conseguiu ler o status da
resposta. Se Rede mostrar 401 mas a página exibir falha de leitura, ainda
precisaremos analisar CORS/rede; o status isolado em Rede não comprova leitura
pelo script. A presença dos nomes dos cookies enviados comprova esse aspecto
do transporte, sem provar identidade autenticada ou recuperação da sessão no
servidor. Não pedimos seus valores para fazer essa distinção.

Um 200 inesperado precisa ser analisado, inclusive quanto à existência de
sessão autenticada anterior. Não apagar cookies desconhecidos, repetir os
botões ou alterar configurações para forçar o esperado antes de relatar.

## Relato para continuar

Enviar somente os campos observados:

```text
Preparação — mensagem:
Consulta — mensagem:
Consulta — método/status:
Consulta — Allow-Origin:
Consulta — Allow-Credentials:
loja-fullstack-session enviado? Houve bloqueio?
XSRF-TOKEN enviado? Houve bloqueio?
```

Sem valores de cookies, tokens, IDs, cabeçalhos completos, HAR ou capturas com
valores. Se houver divergência, começar pelas mensagens da página e status.

## Preparação e limites

Serviços php/backend/sqlserver ativos, conferidos com docker compose ps
--status running --services. Comando de controle lista disponibilidade, sem
enviar pedido à API. Página/rota/contrato existentes conferidos. Nenhuma nova
dependência, serviço ou alteração da aplicação nesta etapa.

Não executamos navegador, cliques, preparação ou consulta de usuário pelo
assistente. Sem nova suíte ou repetição de testes de sintaxe/entrega já aprovados
na 7.61. Última suíte Laravel permanece 7.58: 107 testes/1.586 asserções.
Depois, o aluno relatou sucesso geral, sem fornecer status/cabeçalhos/cookies
individualmente. As tabelas acima continuam sendo expectativas; não as
transformamos em medições individuais.

Git diff --check passou; sete links locais válidos, somente os quatro
documentos previstos alterados, índice vazio. Aplicação/página/configurações
preservadas. Isso verifica o registro, sem substituir o exercício no navegador.

## Continuidade

Sucesso geral relatado em 05/11/2026; campos individuais não fornecidos.
Entendimento confirmado com "Sim, entendi" em resposta à pergunta explícita
sobre cookies de visitante e ausência de autenticação.
Próxima após publicar: 7.63 — acrescentar logout ao laboratório, ler e
decodificar o cookie XSRF-TOKEN, enviar X-XSRF-TOKEN no POST com cookies/JSON.
Módulos 8 a 23 não iniciados.
