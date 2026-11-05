# Aula 7.61 — Consulta do usuário no laboratório

Implementação, explicação e verificações em 05/11/2026, após confirmação da
7.60 com "Sim, entendi". O aluno relatou sucesso geral do exercício anterior;
status/cabeçalhos/atributos individuais não foram fornecidos. Checkpoint 7.60
publicado e conferido em aa6a2ad9009f421452d7c8050efcf51a724eff83,
HEAD/origin/main/main remota iguais; registro posterior à publicação.
Entendimento da 7.61 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Alteramos somente [src/laboratorio-sessao.html](../../src/laboratorio-sessao.html)
na aplicação. Acrescentamos Consultar usuário para observar a autenticação da
sessão depois da preparação de CSRF. A [rota existente](../api/autenticacao.md)
GET /api/v1/usuario exige auth:sanctum: visitante deve receber 401 mesmo tendo
cookies de sessão. Nenhum login foi acrescentado.

A [7.60](07-60-verificacao-navegador-csrf.md) foi encerrada por relato geral de
sucesso e confirmação explícita de entendimento. Não transformamos as tabelas
de expectativas daquela aula em medições individuais.

## HTML e ordem dos botões

O novo botão tem id consultar-usuario, type button e atributo disabled.
O parágrafo resultado-usuario começa com Aguardando a preparação e usa role
status. Dois novos querySelector guardam as referências em botaoUsuario e
resultadoUsuario. Os elementos ficam antes do script, como os anteriores.

No ramo de 204 da preparação, acrescentamos:

```javascript
botaoUsuario.disabled = false;
resultadoUsuario.textContent = 'Pronto para consultar.';
```

Isso organiza o exercício em duas ações: preparar, depois consultar. O estado
do botão é uma regra da página; a proteção real da rota continua no backend.
O botão anterior e seu Fetch de preparação foram preservados.

## Consulta com cookies

```javascript
const resposta = await fetch('http://127.0.0.1:8002/api/v1/usuario', {
    method: 'GET',
    credentials: 'include',
    headers: { Accept: 'application/json' },
});
```

O novo listener de clique também é async. A URL aponta à consulta protegida;
credentials include permite o transporte dos cookies sob suas regras normais.
Accept JSON pede a representação da API. Não enviamos corpo, ID, email, senha,
Authorization ou token CSRF nessa consulta GET. Ela não autentica o visitante.

Enquanto aguarda, desabilita seu botão e mostra Consultando a API. Se receber
401 legível, mostra Resposta recebida: HTTP 401 (sem autenticação). Qualquer
outro status aparece como inesperado, para analisar antes de continuar.

Um 401 HTTP não faz fetch rejeitar a Promise por si só: o código examina
resposta.status. Catch trata falhas de rede/leitura da resposta, incluindo
CORS; finally reabilita o botão. Não lemos nem exibimos o corpo da resposta,
mensagens do servidor ou dados de usuário nesta etapa.
Fonte: [status das respostas no Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch#checking_response_status).

## Significado esperado

| Ação futura no navegador, sem login | Esperado |
| --- | --- |
| Solicitar cookie CSRF | 204, preparação da sessão visitante. |
| Consultar usuário depois | 401, ausência de autenticação válida. |

Receber um 401 que o JavaScript consegue ler é o resultado esperado desse
controle visitante. Cookies preparados não satisfazem auth:sanctum.
Se houver 200 ou falha de leitura, registrar e analisar; não apagar cookies
desconhecidos ou alterar a aplicação para forçar um 401.

Esses resultados ainda não foram observados com o novo botão. Verificar a
presença dos cookies enviados será parte da execução acompanhada; 401 sozinho
também pode ocorrer sem cookie, por isso não comprova transporte de sessão.

## Verificações desta alteração

PHP no serviço php fez GET estático à página pela porta interna 8000: 200 e
corpo igual ao arquivo. Seis controles passaram: status, igualdade, botão de
CSRF preservado, novo botão presente/desabilitado, novo resultado e URL da
consulta presentes. Código 0; sem JavaScript executado ou pedido à API.

Único script extraído como texto para diretório temporário próprio. Node
--check na imagem Redocly 2.65.0/digest já fixado passou, código 0, com
--pull=never/--network none/montagem ro/entrypoint node. Esse comando verifica
sintaxe sem executar DOM ou Fetch. Auxiliares próprios removidos.

Não houve navegador, consulta real de usuário, login, nova dependência ou
suíte Laravel nesta etapa. Última suíte continua 7.58: 107 testes/1.586 asserções.
Backend/rotas/controller/bootstrap/configurações/ambientes/testes/serviços/
Compose/OpenAPI preservados. Documentação e continuidade atualizadas.

Git diff --check passou. Seis links locais válidos, quatro IDs HTML únicos e
um script próprio. Somente os cinco arquivos previstos alterados, índice vazio.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.62: recarregar o laboratório
na sessão privativa, preparar CSRF e executar Consultar usuário uma vez.
Acompanhar mensagem, GET/401, CORS e presença dos cookies enviados, sem copiar
valores, para distinguir transporte de cookies e identidade autenticada.
Verificação acompanhada no navegador pendente; módulos 8 a 23 não iniciados.
