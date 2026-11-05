# Aula 7.63 — Logout com token CSRF no laboratório

Implementação, explicação e verificações em 05/11/2026, após relato geral de
sucesso da 7.62 e confirmação explícita com "Sim, entendi". Campos individuais
da execução anterior não fornecidos; não foram inventados. Checkpoint anterior
publicado e conferido em b05cd9fb40b0fa4ea06ac854496476f4ffadeabd,
HEAD/origin/main/main remota iguais. Entendimento da 7.63 confirmado com
"entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Alteramos somente [src/laboratorio-sessao.html](../../src/laboratorio-sessao.html)
na aplicação. Acrescentamos Encerrar sessão, usando o [logout existente](../api/logout.md).
Visitante também pode sair, desde que a requisição passe pela proteção CSRF.
O novo botão começa disabled e é liberado no ramo 204 da preparação, como
Consultar usuário. Novos seletores ligam encerrar-sessao e resultado-logout
às referências botaoLogout e resultadoLogout.

A [7.62](07-62-verificacao-visitante-no-navegador.md) verificou o controle
visitante por relato geral do aluno. Agora preparamos a operação POST;
nenhum login ou logout no navegador foi executado nesta etapa.

## Ler o cookie certo

```javascript
function lerTokenCsrf() {
    const prefixo = 'XSRF-TOKEN=';
    const cookie = document.cookie.split(';')
        .map((item) => item.trim())
        .find((item) => item.startsWith(prefixo));

    return cookie ? decodeURIComponent(cookie.slice(prefixo.length)) : null;
}
```

Document.cookie fornece os cookies acessíveis ao JavaScript como texto.
Split separa por ponto e vírgula, como explode separa texto em PHP. Map aplica
trim a cada item; find procura o primeiro com o prefixo exato XSRF-TOKEN=.
StartsWith evita confundir nomes parecidos. Slice retira somente esse prefixo,
preservando sinais de igual que façam parte do valor.

O operador ternário retorna null se o cookie não existir. Quando existe,
decodeURIComponent desfaz a codificação de URL; não decifra a criptografia do
Laravel nem confirma validade. A comparação e validação ficam no servidor.
Não exibimos o retorno dessa função.
Fontes: [document.cookie](https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie)
e [token URL-decodificado no Sanctum](https://laravel.com/docs/13.x/sanctum#csrf-protection).

O cookie de sessão é HttpOnly; o navegador o administra sem expor seu valor
ao script. XSRF-TOKEN é acessível ao script no fluxo estudado. No laboratório,
as duas portas usam o mesmo host 127.0.0.1 e Path /. Cookies não são isolados
por porta; as demais condições de acesso e envio continuam valendo.
Fonte: [RFC 6265, seção 8.5](https://httpwg.org/specs/rfc6265.html).

## Montar o POST

No clique, o listener desabilita seu botão e chama lerTokenCsrf dentro de try.
Se o retorno for null ou vazio, mostra Cookie CSRF ausente e retorna antes de
fetch. Finally ainda reabilita o botão. Codificação inválida pode lançar
URIError, também capturada, sem enviar o pedido.

Com token disponível, monta:

```javascript
const resposta = await fetch('http://127.0.0.1:8002/api/v1/logout', {
    method: 'POST',
    credentials: 'include',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'X-XSRF-TOKEN': token,
    },
    body: JSON.stringify({}),
});
```

Post representa a alteração da sessão. Credentials include permite ao
navegador enviar os cookies; o código não lê o cookie HttpOnly de sessão.
Content-Type descreve o corpo; JSON.stringify transforma o objeto vazio em
texto JSON. Nenhum campo escolhe usuário ou sessão. Accept pede JSON quando
houver representação; sucesso 204 continua sem corpo.

X-XSRF-TOKEN é o cabeçalho, XSRF-TOKEN é o cookie. O token é lido a cada clique,
para usar o cookie atual. O navegador administra Cookie/Origin/Referer.
Esse POST JSON com cabeçalho adicional exige negociação CORS de preflight,
sujeita ao cache do navegador. Nosso código envia apenas POST; o navegador
providencia OPTIONS quando necessário. Não criamos rota OPTIONS.

## Respostas e limites

| Status futuro | Mensagem da página |
| --- | --- |
| 204 | HTTP 204, sessão encerrada; corpo não lido. |
| 419 | HTTP 419, recusa de CSRF. |
| Outro | Número do status como inesperado. |

Catch mostra falha genérica de preparação/rede/leitura, sem erro bruto ou token.
Finally reabilita o botão. Os botões anteriores foram preservados.
Visitante não precisa receber 401 no logout: a rota permite essa operação
com sessão/CSRF válidos. Conforme o contrato, o backend invalida a sessão,
renova seu token e emite cookies de visitante. Nesta etapa ainda não observamos
preflight, POST ou atualização de cookies no navegador.

## Verificações no Docker

Extraímos o script como texto para diretório temporário próprio. Node da imagem
Redocly 2.65.0/digest já fixado executou --check antes do diagnóstico da função:
sem erro de sintaxe, código 0. Docker --pull=never/--network none/montagem ro;
nenhum download, serviço novo ou execução do restante da página.

O diagnóstico isolou a função real lerTokenCsrf em vm.Script e forneceu
document.cookie fictício. Sete controles passaram: cookie ausente, nomes
parecidos recusados, valor URL-decodificado, ausência de espaço após separador,
sinais de igual preservados, valor vazio e codificação inválida lançando
URIError. Só booleanos foram impressos, sem cookies ou tokens reais.
Isso verifica a extração/decodificação; não executa listener, DOM, fetch ou CSRF
do servidor. Auxiliares próprios removidos.

PHP no serviço php fez GET estático à página na porta interna 8000. Resposta
200/corpo igual ao arquivo; seis controles passaram, código 0, incluindo botões
anteriores mantidos, novo botão desabilitado, resultado e endpoint presentes.
Nenhuma chamada da API, sessão iniciada ou SQL nesta etapa.

Sem nova suíte Laravel; última 7.58, 107 testes/1.586 asserções. Backend/rotas/
controllers/bootstrap/configurações/ambientes/testes/dependências/serviços/
Compose/OpenAPI preservados. Somente página e documentação alteradas.

Git diff --check passou; sete links locais válidos, seis IDs HTML únicos e
um script próprio. Somente os cinco arquivos previstos alterados, índice vazio.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.64: executar logout visitante
no Chrome/Edge, após preparação, e acompanhar preflight OPTIONS e POST,
status/CORS e presença de cookies/cabeçalho CSRF sem copiar valores.
Não houve observação desses pedidos nesta etapa; módulos 8 a 23 não iniciados.
