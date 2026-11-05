# API de logout — rota registrada

Desenho da etapa 7.43, em 04/11/2026. LoginController::destroy implementado na
7.44; rota POST /api/v1/logout registrada na 7.47. Diagnósticos diretos e testes
permanentes verificaram autenticado/visitante com sessão array. Na 7.47, kernel
HTTP/testing verificou visitante 204 nos três casos de Accept. Na 7.49,
logout autenticado pela rota verificado com fixture/transação e cookie de sessão;
CSRF ativo e navegador ainda não verificados.
O [login](login.md) estabelece a identidade; esta operação encerrará a
autenticação da sessão atual. A [consulta do usuário](autenticacao.md)
permitirá verificar o estado após sair.

## Requisição planejada

- Método e caminho: POST /api/v1/logout.
- URL local: http://127.0.0.1:8002/api/v1/logout.
- Cabeçalho recomendado: Accept: application/json.
- Sem corpo obrigatório, parâmetros de caminho ou query string suportados.
  Um objeto JSON vazio é permitido; nesse caso, usar Content-Type: application/json.
- Não recebe email/password, ID de usuário ou ID de sessão como seletores.
- Interface própria com sessão e guard web; não é uma operação de tokens Bearer.

POST expressa uma alteração no estado da sessão. Abrir um link com GET não
deverá encerrar a autenticação. O servidor identifica a sessão pelo cookie,
sem confiar em um ID de usuário enviado no corpo ou na query.

## Sessão e proteção CSRF

O fluxo segue as condições já usadas pelo login: origem reconhecida pelo
Sanctum via Origin/Referer e envio dos cookies da sessão. A preparação por
GET /sanctum/csrf-cookie permite obter sessão/CSRF também como visitante.
Não é necessário preparar tudo novamente antes de cada POST: o cliente deve
usar os cookies e o token atuais.

No ramo de comparação por token, enviar X-XSRF-TOKEN com o valor
URL-decodificado do cookie XSRF-TOKEN correspondente à sessão atual.
O Laravel 13 instalado também permite seguir com Sec-Fetch-Site same-origin
antes dessa comparação. Portanto, ausência isolada de X-XSRF-TOKEN não basta
para afirmar que qualquer requisição resultará em 419.
O [protocolo CSRF existente](verificacao-csrf.md) verificou o login, não logout.

## Sucesso planejado: 204 sem corpo

Para uma requisição válida da interface própria que passe pela proteção CSRF:

1. Encerrar a autenticação no guard web.
2. Invalidar a sessão atual: apagar seus atributos, destruir o registro antigo
   no armazenamento e gerar outro identificador.
3. Gerar outro token CSRF para a sessão de visitante resultante.
4. Retornar 204 No Content, corpo vazio e sem redirecionamento.

Sequência implementada em LoginController::destroy na 7.44:

```php
Auth::guard('web')->logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
```

Logout remove a identidade do guard; invalidate descarta também os demais
atributos da sessão. Ao contrário da renovação após login, um marcador
anterior da sessão não deverá ser preservado. Invalidate não cria sozinho
outro token CSRF, por isso regenerateToken será chamado depois.

A resposta 204 não contém JSON, message ou data; o cliente não deve tentar
decodificar JSON nesse corpo. Não prometemos Content-Type JSON para 204.
O middleware de sessão/CSRF deverá emitir os cookies atualizados. Sair não
significa ficar sem qualquer cookie: pode existir uma nova sessão visitante.
Nenhum valor de cookie, token ou identificador integra este documento.

O escopo é a sessão atual. Não oferecemos logout de todos os dispositivos ou
revogação de tokens de API. No fluxo atual, não há opção de lembrar de mim;
o logout padrão do framework poderá atualizar remember_token quando aplicável.

## Visitante: mesma resposta planejada

Decisão do projeto: não exigir auth:sanctum nesta operação. Visitantes também
receberão 204 se a requisição de sessão/CSRF for válida. Isso permite concluir
"sair" mesmo quando a autenticação já tiver expirado. Ter sessão preparada
não significa estar autenticado.

Essa decisão não transforma o endpoint em uma operação sem sessão ou sem
proteção CSRF. Repetir logout como visitante com os cookies/token atualizados
continuará resultando em 204. Reenviar um token antigo após invalidar a sessão
poderá falhar em 419 no ramo de comparação por token.

## Rejeição CSRF planejada: 419 JSON

Se a proteção CSRF rejeitar a requisição, o controller não deverá executar a
sequência de logout. Resposta esperada: 419, Content-Type application/json,
sem Location e com message string obrigatório. Campos adicionais de diagnóstico
podem existir; o contrato não fecha esse objeto.

```json
{
  "message": "CSRF token mismatch."
}
```

O texto é ilustrativo; o cliente decide pelo status. Essa rejeição não confirma
que o logout foi realizado. Um 401 não será a resposta de visitante desta
operação; 401 continuará pertencendo à consulta protegida GET /api/v1/usuario.
Não aplicaremos throttle:login ao logout: sair não é uma tentativa de login.

## Relação com a consulta do usuário e verificações futuras

Após logout bem-sucedido, uma nova requisição GET /api/v1/usuario, somente com
os cookies resultantes e sem outra autenticação válida, deverá retornar 401
JSON/sem Location. Limpar apenas o usuário exibido na interface não cumpre o
contrato de encerrar a autenticação no servidor.

Verificações futuras: sucesso autenticado e visitante; guard sem identidade;
atributos antigos removidos/ID e token renovados; resposta 204 vazia; transporte
dos cookies e consulta seguinte 401. O ramo 419 exigirá verificação com CSRF
ativo, fora dos testes que o ignoram. Na 7.43, nenhum cenário foi executado.
Na 7.44, destroy verificado diretamente nos casos autenticado/visitante: 204
vazio/sem Location, guard visitante, identidade/marcador removidos, ID/token
renovados e registro antigo destruído. Recarga da sessão array manteve visitante;
não foi uma requisição HTTP. Treze condições por caso passaram, código 0,
transações desfeitas/contagens preservadas. Suíte existente 101 testes/1.407
asserções passou; SELECT posterior confirmou banco de testes sem dados.

Na 7.50, GET usuario após logout com cookie recebido retornou 401 pelo kernel.
CSRF ativo/cookies no navegador, CORS e OpenAPI do logout continuam pendentes.
Na 7.45, adicionado um teste permanente de logout autenticado em LoginControllerTest:
prepara identidade pelo guard web real, salva marcador e sessão array, chama
destroy diretamente e exige 204/sem Location, limpeza/renovação e remoção do
registro antigo. Após save/flush/forgetGuards/start, continua visitante com
ID/token novos. Focado 3 testes/76 asserções; suíte 102/1.436, códigos 0.
SELECT posterior sem dados em loja_test. Não é requisição HTTP.
Na 7.46, teste permanente de visitante adicionado, sem login: exige visitante/
ID null/chave de login ausente antes da ação; marcador e sessão array salvos.
Destroy direto retorna 204 vazio/sem Location, limpa e renova a sessão; registro
antigo removido, recarga visitante com ID/token novos. Focado 4/104 e suíte
103/1.464 passaram, SQL posterior sem dados em loja_test. Não executa CSRF.
Na 7.47, rota ligada a destroy, sem auth:sanctum/throttle:login. Route:list
confere POST, EnsureFrontendRequestsAreStateful e SubstituteBindings. Kernel
HTTP/testing com origem reconhecida/cookies de entrada ausentes/corpo vazio:
204 vazio/sem Location para Accept JSON, HTML e realmente ausente. Guard
visitante/ID null/chave de login ausente, token presente e cookies de sessão/
CSRF emitidos. Treze condições/caso passaram; nenhuma SQL após a consulta de
identidade em loja_test. Sessão/cache array. CSRF ignorado nesse ambiente.
Suíte existente 103/1.464 passou; SELECT posterior sem dados de teste.
Na 7.48, LogoutApiTest preserva visitante com Accept JSON/HTML/realmente ausente,
removido explicitamente no último e conferido por presença/valor. Request sem
corpo/cookies, origem reconhecida; kernel HTTP retorna 204 vazio/sem Location,
emite cookies de sessão/CSRF e mantém visitante/ID null/chave de login ausente.
Sessão/cache array, sem User ou escrita no banco. Focado 3/57 e suíte 106/1.521
passaram; SQL posterior sem dados. CSRF ativo e navegador não exercitados.
Na 7.49, User fictício em transação, login pelo guard web e sessão array salva
com identidade/marcador. Flush/forgetGuards retiram o estado em memória antes
de POST logout; cookie preparado pela criptografia dos testes carrega o ID salvo.
Kernel/rota/controller retornam 204 vazio/sem Location/cookies atualizados.
Cookie de entrada decifrado tem ID anterior; guard visitante/ID null, chaves
removidas, ID/token novos e registro antigo destruído. Focado 4/91 e suíte
107/1.555 passaram; SQL posterior sem dados/rollback confirmado. Não executa
POST login, GET usuario após logout, CSRF ativo ou navegador.
Na 7.50, cenário ampliado: extrai cookie da resposta de logout, confere ID
visitante/guarda token em memória, faz flush/forgetGuards e GET usuario com
withCookie/withCredentials/getJson e origem reconhecida. Exige 401 JSON/sem
Location e somente message string. Request recebe ID visitante, sem Authorization;
sessão recarregada preserva ID/token, guard visitante/ID null/chaves ausentes.
Focado 4/108 e suíte 107/1.572 passaram; SQL posterior sem dados/rollback confirmado.
Na 7.51, controle com ID anterior: exige registro antigo ausente antes de
reenviar, faz flush/forgetGuards e GET usuario via cookie preparado pelos helpers.
Exige 401 JSON/sem Location/somente message string, ID anterior recebido na
Request, sem Authorization/com sessão e guard visitante/ID null/chaves ausentes.
Não fixa ID/token de sessão visitante nem rejeição criptográfica do cookie.
Focado 4/122 e suíte 107/1.586 passaram; SQL posterior sem dados/rollback confirmado.
Na 7.52, [protocolo de CSRF do logout](verificacao-csrf-logout.md) desenhado:
visitante/origem reconhecida/cookies em memória, Sec-Fetch-Site ausente e somente
X-XSRF-TOKEN variando. Preparação 204 e controles 419/419/204 são expectativas,
ainda não observadas. Servidor temporário/coleta desativada só nele e limpeza
que acompanha os IDs próprios antes/depois do logout. Fonte/configuração lidas:
local/file/json, origem reconhecida/CSRF sem exceções, 54 arquivos/coleta [2,100].
Sem HTTP, SQL, sessão nova ou nova suíte; última 7.51, 107/1.586.
Próxima 7.53: executar somente o protocolo após confirmação/publicação da 7.52.

Referências: [logout e invalidação de sessão no Laravel](https://laravel.com/docs/13.x/authentication#logging-out),
[sessão da interface própria com Sanctum](https://laravel.com/docs/13.x/sanctum#spa-authentication)
e [proteção CSRF](https://laravel.com/docs/13.x/csrf).
