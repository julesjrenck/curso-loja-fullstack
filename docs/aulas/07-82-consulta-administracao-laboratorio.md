# Aula 7.82 — Consulta administrativa no laboratório

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.81](07-81-openapi-administracao.md) com "entendi".
Checkpoint anterior publicado e conferido em
d5f1140887ece72392ae57e0e1b8fd7f7f0aed71; HEAD/origin/main/main remota iguais.
Entendimento da 7.82 confirmado com "entendi" em 05/11/2026; publicação
pendente. Execução real no navegador ainda pendente.

## Objetivo e arquivo

Alteramos somente
[src/laboratorio-sessao.html](../../src/laboratorio-sessao.html)
na aplicação. Acrescentamos Consultar administração e um parágrafo próprio
de resultado, para consultar a [rota existente](../api/administracao.md).

O botão tem type button e começa disabled. O resultado tem role status.
Novos querySelector guardam as referências aos dois elementos. O sucesso
204 da preparação libera o novo botão e mostra Pronto para consultar a
administração, seguindo a organização dos controles anteriores do laboratório.
Esse bloqueio organiza o exercício; a permissão é decidida pelos middlewares
no servidor, não pelo estado disabled na página.

## Requisição e sessão

O listener click é async. Desabilita o botão, mostra Consultando a
administração e aguarda:

```javascript
fetch('http://127.0.0.1:8002/api/v1/administracao', {
    method: 'GET',
    credentials: 'include',
    headers: { Accept: 'application/json' },
});
```

A URL absoluta aponta à API em 8002, enquanto a página é servida em 8001.
Credentials include permite o envio dos cookies conforme as regras do
navegador. Não faz login ou concede permissão. Accept pede JSON; o código
observa somente resposta.status, sem ler o corpo. Esta consulta GET não envia
corpo nem lê o token CSRF para montar um POST. A preparação continua fazendo
parte da sequência didática do laboratório.

Referência: [credentials no Fetch](https://developer.mozilla.org/en-US/docs/Web/API/Request/credentials).

## Mensagens e finalização

| Status | Mensagem local |
| --- | --- |
| 200 | Acesso administrativo permitido. |
| 401 | Sem autenticação. |
| 403 | Sem permissão administrativa. |
| Outro | Status recebido como inesperado. |

As mensagens mostram o número HTTP. O 403 é uma resposta legível de recusa,
não uma falha de rede. Catch mostra mensagem genérica quando não é possível
concluir a leitura; não atribui um status HTTP que não foi recebido. Finally
reabilita o botão tanto após resposta quanto após erro.

Não exibimos perfis, is_admin, cookies, tokens ou payload de login. Os controles
de preparação, login, usuário e logout anteriores permanecem funcionando com
seu código original. Nenhuma conta foi criada ou promovida nesta aula.

## Verificações no Docker

O script real e atributos dos elementos foram extraídos como texto para
diretório próprio de /tmp. Node da imagem Redocly 2.65.0/digest já fixado,
com pull never/network none/montagem readonly, executou --check: sintaxe
válida, código 0. Sem instalar ferramenta ou dependência.

Depois, vm.Script executou o código real com DOM mínimo e Fetch simulados.
Seis cenários passaram: 200, 401, 403, 500 inesperado, falha de rede e
preparação 500. Conferiram botão inicialmente desabilitado, liberação após
204, mensagem pronta, bloqueio enquanto a Promise está pendente, URL/método/
credentials/Accept exatos e nenhuma leitura do corpo. Ao final, mensagens
corretas e botão reabilitado; preparação sem 204 manteve o botão bloqueado.
Código 0; saída somente nomes de cenários e booleanos. Sem rede ou credenciais.

PHP no serviço php fez um GET apenas do HTML estático em sua porta interna
8000. Quatro controles passaram, código 0: HTTP 200, corpo igual ao arquivo,
botão administrativo inicialmente disabled e resultado com role status.
Não foi pedido à API nem consulta de administração real.

Comparação com HEAD, retirando apenas os novos trechos, confirmou preservação
do código anterior. Treze IDs únicos, labels associados e um script próprio.
Os três auxiliares e seu diretório foram removidos.

Esses controles verificam código e entrega do arquivo. Não reproduzem o DOM
completo do navegador, cookies reais, CORS ou autorização da sessão do aluno.
Nenhum SQL, login ou pedido real da API nesta etapa. Não repetimos a suíte
Laravel: última 7.80, 116 testes/1.653 asserções. Backend/OpenAPI preservados.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.83 — no Chrome/Edge,
preparar CSRF e consultar administração como visitante (401 esperado), entrar
com a conta de laboratório, consultar usuário (200) e administração (403),
sair e consultar administração novamente (401). Registrar somente mensagens/
status e observações CORS/cookies sem valores privados; sem promover contas.
Módulos 8 a 23 não iniciados.
