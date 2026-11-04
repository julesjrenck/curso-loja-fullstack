# Aula 7.41 — Verificação de CSRF por HTTP fora de testing

Execução, explicação e verificações em 04/11/2026, após confirmação da 7.40
com "entendi". Checkpoint anterior publicado e conferido em
655a17b6cfa5f76e9c6b6026c47020f8853db84c; HEAD/origin/main/main remota iguais.
Entendimento da 7.41 confirmado com "entendi" em 04/11/2026.

## Objetivo e adaptação necessária

Executamos o [protocolo CSRF](../api/verificacao-csrf.md) com visitante e JSON {},
sem credenciais ou criação de contas. O diagnóstico temporário não foi
versionado; os documentos registram sua execução e os resultados.

A conferência encontrou 54 arquivos de sessão antigos e session.lottery [2,100].
StartSession::collectGarbage sorteia a coleta; FileSessionHandler pode remover
sessões expiradas. Usar o servidor habitual poderia alterar esses arquivos.

Por isso abrimos um servidor PHP temporário no mesmo container, em porta
dinâmica local, carregando o bootstrap e kernel HTTP da aplicação. Apenas
nesse processo, configuramos session.lottery [0,100]. CSRF, rotas, guard,
cache file e demais configurações da aplicação permaneceram ativos.
Não adicionamos container, dependência, serviço Compose ou configuração persistente.

É uma adaptação ao endereço de transporte planejado na 7.40: a porta interna
habitual 8000 não foi usada. Host/Origin continuaram 127.0.0.1:8002, para o
mesmo reconhecimento stateful. O diagnóstico não comprova comportamento de
navegador/CORS nem configuração de um servidor HTTPS de produção.

## Comandos e inicialização

```sh
docker compose exec -T backend php -l /dev/stdin < /tmp/curso-7-41-csrf.php
docker compose exec -T backend php /dev/stdin < /tmp/curso-7-41-csrf.php
```

O shell lê o script temporário do host; PHP no backend o recebe por stdin.
PHP -l conferiu sintaxe antes da execução. O script carrega Laravel em local,
exige configuração sem cache, sessão file/json e cache file, e guarda em
memória os nomes/hashes das sessões preexistentes. Não imprime identificadores.

ProcOpen inicia PHP -S numa porta livre do loopback usando um router temporário.
O router carrega a aplicação/kernel e ajusta somente a loteria de coleta. Um
arquivo auxiliar recebe exclusivamente metadados públicos de cada pedido,
sem cookies/tokens/IDs: local, console false, testing false, CSRF ativo,
exceções vazias, originOnly/allowSameSite false, origem reconhecida,
presença dos cabeçalhos/cookies e confirmação do corpo {}.

O cliente Guzzle usa CookieJar somente em memória, timeout 10s, sem proxy,
redirecionamentos ou exceção automática por status 4xx. A verificação de
metadados após cada resposta assegura o caminho pretendido do protocolo.

## Pedidos e resultados

| Pedido real | Resultado observado |
| --- | --- |
| GET /sanctum/csrf-cookie | 204, corpo vazio, dois cookies necessários recebidos. |
| POST /api/v1/login, corpo {}, cookies, sem X-XSRF-TOKEN | 419 JSON/message string, sem Location. |
| POST /api/v1/login, corpo {}, mesmos cookies, cabeçalho inválido | 419 JSON/message string, sem Location. |
| POST /api/v1/login, corpo {}, mesmos cookies, cabeçalho correto | 422 JSON/message string/errors email/password, sem Location. |

As três chamadas usam POST /api/v1/login, Accept JSON, Origin reconhecido e
Sec-Fetch-Site ausente. Também ausentes _token/X-CSRF-TOKEN. No caso correto:

```php
$headers['X-XSRF-TOKEN'] = rawurldecode(
    $jar->getCookieByName('XSRF-TOKEN')->getValue(),
);
```

O cliente usa o valor do cookie após decodificação de URL. O middleware
decifra e compara o token com a sessão. No último pedido, a proteção permitiu
seguir até LoginRequest, que recusou os campos ausentes. 422 não autentica
o visitante. Não houve 429 ou necessidade de esperar a janela do limitador;
nenhum contador preexistente foi zerado.

## Sessão própria, limpeza e conferência final

Internamente, o diagnóstico decifra/valida o prefixo do cookie de sessão
usando o encrypter da aplicação, somente para identificar seu arquivo. Exige
ID válido e ausente da lista anterior antes de permitir limpeza. O ID
permaneceu o mesmo nos três POSTs. Leitura do arquivo próprio confirmou
token presente e nenhuma chave de login; só condições booleanas foram impressas.

Finally encerrou o processo HTTP, removeu a única sessão própria e os arquivos
router/metadados. Nomes/hashes dos arquivos anteriores ficaram exatamente
iguais. Saída resumida informou sucesso true, código 0 e 54 sessões preservadas.
Não houve resposta bruta ou valor de cookie/token/ID na saída ou no Git.

Nova conferência de leitura no Docker confirmou ambiente local, sessão file,
54 sessões restantes e loteria habitual [2,100]. Backend/Compose/OpenAPI sem
diff. Não executamos nova suíte, consulta SQL, auditoria ou quatro contratos;
última suíte completa permanece a 7.39: 101 testes/1.407 asserções.

## Continuidade

Execução explicada e verificada; entendimento confirmado com "entendi" em 04/11/2026.
Documentos/contratos atualizados, sem alteração persistente da aplicação.
Publicação da 7.41 concluída e conferida em
091ba33ce6f69f93a9c1cb0b1b4b182d89a14597; HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade realizada na 7.42 — adicionar
POST /api/v1/login ao OpenAPI com email/password e respostas 204/419/422/429,
validando esquemas e exemplos. Navegador/CORS e logout seguem pendentes.
