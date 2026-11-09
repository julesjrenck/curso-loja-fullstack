# 8.67 — Primeiro fetch do arquivo JSON

## Objetivo

Fazer uma requisição ao arquivo da 8.66 e conhecer a resposta HTTP recebida.
Iniciada após entendimento da 8.66 confirmado com "entendi" em 07/11/2026 e
publicação conferida em a1225c3f2f554a9e8ebf554dc143a52a43530db9.

## Alteração e execução

Acrescentamos ao final de src/vitrine.js:

```js
async function carregarProdutos() {
    try {
        const resposta = await fetch('./produtos.json');

        console.log('Resposta dos produtos:', resposta);
        console.log('Status HTTP dos produtos:', resposta.status);
    } catch (motivo) {
        console.error('Falha ao buscar produtos:', motivo);
    }
}

carregarProdutos();
```

fetch é uma função disponível no navegador; não exige import ou pacote aqui.
A entrada './produtos.json' informa a URL relativa do recurso. Sem opções,
a requisição usa GET. A URL é resolvida pela base do documento: abrindo
http://localhost:8001/vitrine.html, buscamos http://localhost:8001/produtos.json.
O caminho relativo usado por fetch é resolvido em relação ao documento,
mesmo que essa chamada esteja dentro de um módulo JavaScript.

vitrine.html já carrega vitrine.js como módulo. O módulo declara a função e a
chamada carregarProdutos() inicia a requisição. src/produtos.json é o arquivo
servido nessa URL pelo servidor local existente. Não há rota de API nesta etapa.

fetch devolve uma Promise. await espera sua resolução e permite continuar com
um objeto Response, guardado na constante resposta. Esse objeto representa a
resposta HTTP e oferece status, cabeçalhos e acesso ao corpo. Ainda não lemos
nem interpretamos o corpo como JSON; resposta não é o array de produtos.

O primeiro console.log mostra Response para inspeção. O segundo acessa status,
uma propriedade numérica: com a entrega atual, esperamos 200. A função só faz
registros; não retorna uma lista. Sua Promise se resolve com undefined ao terminar
normalmente. A busca do formulário continua trabalhando nos cartões do HTML.

try/catch usa o tratamento já estudado: uma rejeição da requisição, por exemplo
por falha de rede, faz await lançar o motivo e o catch registrá-lo. Respostas
HTTP 404/500 não rejeitam automaticamente a Promise de fetch; chegam como
Response. Vamos verificar a propriedade ok na próxima etapa.

Referência consultada: [Window.fetch — MDN](https://developer.mozilla.org/en-US/docs/Web/API/Window/fetch).

## Verificação

curl realizou GET dos dois recursos no servidor local existente; cmp comparou
cada corpo com src. JavaScript: HTTP 200, application/javascript, 3407 bytes.
JSON: HTTP 200, application/json, 127 bytes. Ambos idênticos aos arquivos locais.
Esses comandos verificam a entrega HTTP, sem executar JavaScript no navegador.
Temporários próprios removidos ao terminar. Não iniciamos serviços adicionais.

git diff --check passou. O diff de vitrine.js contém apenas a função e sua chamada;
HTML/CSS/textos.js/produtos.json preservados. Links locais conferidos.
Sem execução de PHP/Node no host; não foi instalada ferramenta para simular DOM.
A validação PHP do JSON da 8.66 continua registrada naquela etapa; dados iguais.

Atividade opcional: abra http://localhost:8001/vitrine.html, abra o Console e
recarregue. Procure "Resposta dos produtos:" e "Status HTTP dos produtos: 200".
Expanda Response e localize status. Na aba Network/Rede, a requisição de
produtos.json deve mostrar GET e status 200. Os registros anteriores continuam;
não usamos a ordem entre mensagens assíncronas distintas como critério.
Resultados esperados, ainda sem relato ou observação direta do navegador.

## Estado e continuidade

Implementação e explicação apresentadas; entendimento confirmado com
"entendi, vamos continuar outro dia" em 09/11/2026. Curso pausado a pedido do
aluno. Verificação da entrega HTTP concluída na implementação; execução de fetch
no navegador sem relato ou observação direta. Publicação do checkpoint pendente
conforme autorização permanente. Na próxima retomada, iniciar a 8.68 — verificação
do status HTTP com resposta.ok. Não iniciada; aguardar pedido do aluno.
