# Aula 7.59 — Página de laboratório para preparar o CSRF

Implementação, explicação e verificações em 05/11/2026, após confirmação da
7.58 com "entendi". Entendimento da 7.59 confirmado com "entendi" em 05/11/2026; publicação
pendente. Checkpoint anterior publicado em
35633036f506078470e9d2e4ca5c804f5d99cf26; HEAD/origin/main/main remota iguais.

## Objetivo e arquivo

Criamos [src/laboratorio-sessao.html](../../src/laboratorio-sessao.html), único
arquivo de aplicação alterado. Ele prepara um exercício de navegador: um botão
para GET /sanctum/csrf-cookie, sem login. Não criamos interface da loja ou React.

A página usa o serviço php já existente: src é montado em /app e o servidor
entrega arquivos pela porta interna 8000, publicada no host em 8001. A API usa
8002. Nenhum serviço, imagem ou dependência nova foi instalado.

URL do exercício: http://127.0.0.1:8001/laboratorio-sessao.html.
Essa origem corresponde às configurações de CORS e Sanctum das etapas anteriores.
Abrir como arquivo local ou trocar o host altera a origem do exercício.

## HTML e evento

Lang pt-BR indica o idioma; charset utf-8 mantém a acentuação. Viewport ajusta
a apresentação em telas menores. O botão tem id preparar e type button, e o
parágrafo resultado tem role status para anunciar atualizações de texto.

O script fica depois desses elementos. document.querySelector encontra cada
um pelo seletor de id, e const mantém sua referência. addEventListener registra
a função que será executada no clique. Abrir a página não dispara fetch.

A função é async para usar await. Enquanto espera pela resposta, o navegador
continua podendo trabalhar; a continuação dessa função aguarda o resultado.
botao.disabled bloqueia cliques repetidos durante a tentativa, e textContent
atualiza a mensagem visível sem interpretar HTML.

## Pedido à API

```javascript
const resposta = await fetch('http://127.0.0.1:8002/sanctum/csrf-cookie', {
    method: 'GET',
    credentials: 'include',
    headers: { Accept: 'application/json' },
});
```

Fetch devolve uma Promise; await permite trabalhar com o objeto Response quando
ela resolve. GET é o método, e a URL absoluta aponta à outra origem. Accept
declara preferência por JSON em respostas que tenham representação.

Credentials include permite ao navegador enviar cookies entre origens e
considerar Set-Cookie da resposta, respeitando as regras dos cookies. O padrão
do Fetch é same-origin, que não atende essa troca entre as portas 8001/8002.
O servidor também precisa autorizar CORS com credenciais, já configurado.
Fonte: [Fetch e credenciais](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch#including_credentials).

Esse GET com Accept não exige preflight por si só. Não definimos Content-Type,
corpo ou X-XSRF-TOKEN; o navegador administra Origin e Referer. A preparação usa
o endpoint do Sanctum estudado anteriormente, sem enviar email ou senha.

## Respostas previstas no código

| Situação futura no navegador | Comportamento da página |
| --- | --- |
| Resposta legível com status 204 | Mostra HTTP 204, sem tentar ler corpo. |
| Outro status HTTP legível | Mostra o número como resposta inesperada. |
| Falha de rede ou recusa de leitura por CORS | Catch mostra uma mensagem genérica. |

O código verifica resposta.status porque fetch não rejeita a Promise apenas
por receber 4xx/5xx. Não usamos resposta.json(): 204 não tem JSON a decodificar.
Finally reabilita o botão tanto após sucesso quanto após falha.

Nenhum cookie, token, senha, identificador de sessão ou erro bruto é mostrado
ou registrado pela página. Ela informa o status lido; a presença e os atributos
dos cookies precisam de observação própria nas ferramentas do navegador.

## O que verificamos nesta etapa

Um GET HTTP feito com PHP dentro do serviço php recebeu 200,
Content-Type text/html; charset=UTF-8 e corpo exatamente igual ao arquivo em
/app/laboratorio-sessao.html. Também conferiu botão e URL da API presentes.
Os cinco controles passaram, código 0. O pedido foi ao arquivo estático na porta
interna 8000; a publicação 8001 foi conferida no Compose/serviço existente.

Extraímos o único script para um arquivo temporário fora do repositório e
verificamos sua sintaxe com Node da imagem Redocly já fixada:

```sh
docker run --rm --pull=never --network none --entrypoint node \
  --volume "$CURSO_JS_TEMP:/lab.js:ro" \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  --check /lab.js
```

CURSO_JS_TEMP representa o caminho da cópia temporária. Entrypoint node usa o
runtime da ferramenta de validação, sem criar um ambiente Node da aplicação.
Pull never evita download; network none impede rede; montagem ro permite apenas
leitura. Check só analisa sintaxe, sem executar DOM ou fetch: passou, código 0.
Cópia temporária removida depois da verificação.

Não executamos clique, JavaScript de navegador ou requisição à API. Logo,
204, aceitação de cookies e aplicação de CORS pelo navegador ainda são
expectativas, não resultados observados nesta etapa. Sem nova suíte Laravel;
última 7.58, 107 testes/1.586 asserções. Backend, ambientes, configurações,
testes, dependências, Compose e OpenAPI preservados.

Git diff --check passou. Cinco links locais válidos; HTML com os dois IDs
esperados, únicos, e um script próprio. Somente os cinco arquivos previstos
alterados, índice vazio.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.60: abrir o laboratório em
uma janela privativa na origem 8001, executar o botão uma vez e acompanhar
status, cabeçalhos CORS e presença/atributos dos cookies, sem copiar valores.
Sem login; navegador e cookies ainda aguardam essa verificação acompanhada.
Módulos 8 a 23 não iniciados.
