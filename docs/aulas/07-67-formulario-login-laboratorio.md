# Aula 7.67 — Formulário de login no laboratório

Implementação, explicação e verificações em 05/11/2026, após confirmação da
7.66 com "entendi". Conta fictícia persistida e formato do hash conferidos
anteriormente, sem senha compartilhada. Checkpoint 7.66 publicado e conferido
em 35669327d3cef8b7dc56136d4d78e2267329b3c2,
HEAD/origin/main/main remota iguais. Entendimento da 7.67 confirmado com
"entendi" em 05/11/2026; publicação conferida em
9d61d39a573de7551b658e3baf5a1e86ecb6a8fb, HEAD/origin/main/main remota iguais.
Registro atualizado após a publicação.

## Objetivo e arquivo

Alteramos somente [src/laboratorio-sessao.html](../../src/laboratorio-sessao.html)
na aplicação. Acrescentamos formulário que envia as credenciais ao
[login existente](../api/login.md), reutilizando lerTokenCsrf. A preparação
204 libera Entrar, assim como os botões de consulta/logout já existentes.
Consulta agora reconhece 200 como usuário autenticado e mantém 401 para
visitante. Essa alteração acompanha o novo caminho de login.

Não executamos um login real nesta etapa. Os controles abaixo usam respostas
simuladas; a conta criada na [7.66](07-66-execucao-seeder-usuario-laboratorio.md)
será utilizada no exercício de navegador posterior.

## HTML do formulário

Form tem id formulario-login, method post e action apontando ao endpoint da
API. Os dois campos têm labels associados por for/id, name email/password e
required. E-mail usa type email, maxlength 255 e autocomplete username; a senha
usa type password e autocomplete current-password. Type password mascara a
digitação. O placeholder do e-mail fictício não preenche seu valor; não há
senha padrão ou atributo value com credenciais.

Entrar tem type submit e começa disabled. Seu parágrafo de resultado usa role
status. A validação HTML auxilia o preenchimento; LoginRequest continua
validando a requisição no servidor.

## Submit e leitura dos campos

```javascript
formularioLogin.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    // Leitura de CSRF e envio por Fetch dentro do try.
});
```

Submit é o evento de envio do formulário. PreventDefault cancela a submissão
nativa para que o código faça Fetch sem navegar. Method post também mantém
os campos no corpo em uma submissão nativa, conforme o action declarado.
Fonte: [evento submit](https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit_event).

Novos querySelector guardam formulário, campos, botão e resultado. Value lê o
conteúdo atual dos inputs; a senha não recebe trim. O contrato preserva seus
espaços, enquanto a normalização do e-mail permanece no backend.

## POST com sessão, CSRF e credenciais

O listener desabilita Entrar, mostra Enviando login e lê o token atual pelo
helper existente. Sem token, pede nova preparação e termina antes de fetch.
Com token disponível, envia POST /api/v1/login com credentials include, Accept
JSON, Content-Type JSON e X-XSRF-TOKEN. O corpo é:

```javascript
body: JSON.stringify({
    email: campoEmail.value,
    password: campoSenha.value,
}),
```

Os nomes das propriedades são os exigidos pela API. JSON.stringify transforma
o objeto em texto JSON; as credenciais ficam no corpo do POST. Não são parâmetros
de URL, token Bearer ou opções de identidade. Cookies são administrados pelo
navegador; o helper lê o XSRF-TOKEN URL-decodificado a cada tentativa.
Fonte: [fluxo de login/CSRF no Sanctum](https://laravel.com/docs/13.x/sanctum#csrf-protection).

## Status e limpeza do campo

| Status | Mensagem local |
| --- | --- |
| 204 | Login aceito, sem ler corpo. |
| 422 | Dados inválidos ou credenciais recusadas, sem distinguir qual credencial. |
| 419 | Recusa de CSRF. |
| 429 | Limite de tentativas. |
| Outro | Número do status como inesperado. |

Fetch não rejeita a Promise somente por um status HTTP de erro; tratamos
resposta.status. Catch apresenta falha genérica de preparação/rede/leitura.
Em finally, campoSenha.value recebe string vazia e o botão é reabilitado,
inclusive após falha HTTP, cookie ausente, codificação inválida ou erro de rede.
Isso limpa o campo; não é uma medição de eliminação de todos os dados da memória
ou das ferramentas do navegador.

A tela apresenta apenas status e mensagens locais. O corpo da resposta não é
lido e a senha não é registrada.
Nenhum armazenamento próprio em localStorage/sessionStorage foi acrescentado.
O campo de e-mail permanece preenchido; a senha precisa ser fornecida novamente
na tentativa seguinte. Não há repetição automática de pedidos.

No botão Consultar usuário, 200 agora mostra HTTP 200 (usuário autenticado).
401 continua mostrando ausência de autenticação. A página observa somente o
status, sem exibir os campos da resposta. Preparação e logout foram preservados.

## Verificações no Docker

Script e atributos iniciais dos elementos extraídos como texto para diretório
temporário próprio. Node --check na imagem Redocly 2.65.0/digest já fixado passou.
Em seguida, vm.Script executou o script real com elementos/eventos mínimos e
Fetch simulado, sem usar rede ou senha real.

Oito cenários passaram: login 204, dados 422, CSRF 419, limite 429, inesperado
500, falha de rede, cookie ausente e cookie com codificação inválida. Conferiram
liberação após preparação, cancelamento do envio nativo, limpeza da senha,
botão reabilitado, quantidade de pedidos e mensagens. Com cookie inválido ou
ausente não houve pedido de login simulado.

Nas tentativas enviadas, conferiu URL/método/cookies/headers/token e JSON com
somente email/password. Senha fictícia com espaços externos foi preservada no
corpo e limpa do campo ao final. No cenário 204, a consulta com resposta
simulada 200 foi reconhecida. Saída só com booleanos; código 0. Esses controles
não validam comportamento nativo de forms, autocomplete, CORS, cookies reais,
aceitação da senha, sessão de servidor ou autenticação do navegador.

Docker --pull=never/--network none/montagem ro; nenhum download ou dependência
nova. Arquivos temporários de script/atributos/diagnóstico removidos.

PHP no serviço php fez GET estático à página: 200/corpo igual. Sete controles
passaram, código 0: status, igualdade, method/action, campo email, campo senha
sem valor padrão, botão desabilitado e botões anteriores preservados.
Não executamos pedido da API, login real, SQL ou nova suíte Laravel. Última
suíte permanece 7.58: 107 testes/1.586 asserções. Backend/rotas/controllers/
config/ambientes/testes/seeder/dependências/serviços/Compose/OpenAPI preservados.

Git diff --check passou; seis links locais válidos, 11 IDs únicos, labels
associados, um script próprio e senha sem valor padrão. Somente os cinco arquivos
previstos alterados e índice vazio; backend/seeder/Compose/OpenAPI preservados.

## Continuidade

Continuidade iniciada na [7.68](07-68-ciclo-autenticacao-no-navegador.md):
no Chrome/Edge, preparar
CSRF, preencher e-mail fictício e senha escolhida no terminal, enviar login uma
vez, consultar usuário, sair e consultar novamente. Acompanhar a sequência
204/204/200/204/401, CORS e cookies sem copiar senha/payload/valores de cookies
ou dados privados. Resultados reais ainda pendentes; módulos 8 a 23 não iniciados.
