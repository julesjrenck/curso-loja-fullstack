# Limite de pedidos de login — regra aplicada à rota

Desenho da etapa 7.29, em 04/11/2026, para POST /api/v1/login.
Regra registrada em AppServiceProvider::boot na 7.30 e aplicada à rota na
7.33 por throttle:login. Complementa o
[contrato de login](login.md); o controller e seus testes continuam como estavam.

## Regra escolhida para o ambiente local

| Item | Decisão |
| --- | --- |
| Nome do limitador | login. |
| Capacidade | Cinco pedidos que alcancem o limitador. |
| Chave de contagem | IP reconhecido pelo Laravel para a requisição. |
| Janela | 60 segundos a partir do primeiro pedido contado daquele IP. |
| Excesso | Sexto pedido na janela recebe 429 antes do controller. |

Contaremos pedidos de login bem-sucedidos, credenciais recusadas e entradas
que falhem na validação posterior. Sucesso não zerará o contador. Pedidos
interrompidos antes de alcançar o limitador, por exemplo por CSRF, não entram
nessa contagem. A limitação ficará antes da LoginRequest/controller no fluxo.

E-mail, ID de usuário, senha e cookie não compõem a chave. Mudar o e-mail
usado pelo mesmo IP não abre outro contador. Pessoas que compartilhem um IP
também compartilham esse limite; outro IP possui contador independente.
Esta é a primeira regra local de controle de frequência, não uma trava permanente
na conta. IPs e janela são decisões do projeto, não valores impostos pelo Laravel.

A janela não se alinha ao minuto do relógio. Depois de 60 segundos, um novo
pedido permitido inicia outra janela. Pedidos bloqueados não incrementam nem
prorrogam a janela atual. Não há liberação automática por troca de e-mail ou
por enviar credenciais corretas enquanto o limite estiver esgotado.

## Exemplo de linha do tempo

| Momento | Pedidos do IP A | Resultado planejado |
| --- | --- | --- |
| t = 0 | Cinco pedidos chegam ao limitador | Todos podem seguir; o login decide 204 ou 422 depois. |
| t = 0 | Sexto pedido | 429, Retry-After: 60. |
| t = 30 | Novo pedido bloqueado | 429, Retry-After: 30; expiração original preservada. |
| t = 60 | Pedido após expiração | Pode seguir; começa nova janela. |

"Pode seguir" significa somente que o limitador permitiu prosseguir, não que
as credenciais foram aceitas. O IP B continua com seu próprio contador.

## Resposta 429 configurada

Status 429 Too Many Requests, Content-Type application/json, sem Location,
com somente message string. Texto/idioma podem variar; exemplo fictício:

```json
{
  "message": "Muitas tentativas. Tente novamente em instantes."
}
```

Retry-After será obrigatório neste contrato, com quantidade inteira não negativa
de segundos restantes, calculada pelo limitador. Não será sempre 60.
Cache-Control: no-store orientará clientes/caches a não armazenar a resposta.
A mensagem não ecoará e-mail, senha, IP ou detalhes de existência de conta.

Responderemos JSON também com Accept HTML ou ausente, usando a resposta
personalizada do limitador e preservando os cabeçalhos de limitação fornecidos
pelo Laravel. O 429 não comprova senha correta ou incorreta: o controller não
terá sido executado. Dentro do limite continuam os contratos 204/422 e a
proteção CSRF existente, sem alteração na consulta GET usuario ou no catálogo.

## Armazenamento e implementação

Conferimos a configuração carregada normal: cache.default file e cache.limiter
null, que usa o store padrão. O contador precisará durar entre requisições;
o cache file atual atende ao laboratório com uma instância. Testes usarão
cache array isolado. O contador de frequência e o cache de respostas HTTP são
usos diferentes: no-store não desativa o contador do servidor.

Sem Redis/container/dependência nova nesta etapa. Na 7.30, registrado somente
o limitador nomeado login em AppServiceProvider::boot, com cinco por minuto/IP
e callback JSON/429/cabeçalhos. Diagnóstico em memória confirmou configuração,
chaves por IP e callback para Accept JSON/HTML/ausente, preservando Retry-After
fornecido (60/37/11), X-RateLimit-Limit/Remaining e no-store. Sem contagem ou
middleware executado nessa verificação. Cache-Control observado: no-store, private.
Criar o limitador nomeado sozinho não protege rota alguma.
Na 7.31, LoginRateLimiterTest passou pelo middleware real/nome login, com cache
array e relógio controlado: focado 6 testes/156 asserções, suíte 96/959.
Conferidos bloqueio do sexto/IP compartilhado entre e-mails, Accept JSON/HTML/
ausente, cabeçalhos, espera/expiração, outro IP e consumo de limite por falhas
posteriores. Próxima função ilustrativa, sem controller, SQL de autenticação,
CSRF ou kernel HTTP. Naquela etapa, a regra ainda não estava aplicada à rota.
Na 7.32, migration de usuários aplicada em loja pela conexão sqlsrv_migracoes,
lote 4/Ran, três tabelas vazias e catálogo preservado. Reexecução sem nova
aplicação; suíte existente 96/959 passou no banco exclusivo de testes.
Na 7.33, aplicada à rota POST /api/v1/login. Diagnóstico kernel/testing com
origem reconhecida, cache/sessão array e relógio fixado: cinco entradas vazias
resultam em 422; sexta em 429/Retry-After 60/limite 5/restante 0/no-store, para
Accept JSON/HTML/padrão do construtor, sem redirecionamento. Zero SQL após identidade.
Não comprova fluxo CSRF no navegador ou sucesso por HTTP. Suíte existente 96/959.
Correção registrada na 7.34: o terceiro caso anterior tinha Accept padrão,
apesar de apresentado como ausente. Novo LoginApiTest remove o cabeçalho e
confere presença/valor: JSON/HTML/ausência real, cinco 422 e sexto 429 por caso,
com contrato/headers/visitante/sessão conferidos. Focado 3/267; suíte 99/1.226.
Próxima 7.35: corrigir essa preparação de Accept ausente em LoginRateLimiterTest.

Referências: [limitadores e respostas personalizadas no Laravel](https://laravel.com/docs/13.x/routing#rate-limiting)
e [HTTP 429/Retry-After, RFC 6585](https://www.rfc-editor.org/rfc/rfc6585.html#section-4).
