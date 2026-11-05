# Curso prático: loja com Laravel, React, Next.js e microsserviços

## Objetivo

Construir juntos uma loja com catálogo, carrinho, pedidos, estoque e notificações,
do primeiro container até uma aplicação distribuída na AWS. O curso aproveita o
conhecimento de PHP do aluno e aprofunda Laravel, integração com frontend,
arquitetura, testes e operação. Cada tecnologia entra para resolver um problema
concreto. Não há prazo fixo: cada módulo pode ocupar vários chats.

## Como serão as aulas

Não avançaremos sem confirmação de entendimento da etapa atual.

1. Explicar o objetivo e o problema a resolver.
2. Apresentar o conceito necessário, usando referências de PHP quando útil.
3. Criar ou modificar um arquivo ou um pequeno conjunto inseparável.
4. Explicar cada arquivo, seus trechos e suas relações com o projeto.
5. Executar a verificação e interpretar o resultado.
6. Responder às dúvidas e propor uma pequena experiência quando ajudar.
7. Registrar o progresso e publicar checkpoints concluídos no GitHub.

O professor escreve o código com o aluno acompanhando. Exercícios consolidam
o entendimento sem exigir implementação solitária. Arquivos gerados serão
apresentados e aprofundados conforme usados; dependências externas não serão
estudadas arquivo por arquivo. Testes e boas práticas entram desde as primeiras
funcionalidades e recebem aprofundamento em módulos específicos.

## Módulos

Os módulos 1 a 6 estão concluídos. O módulo 6 foi encerrado após confirmação
da consolidação 6.84 com "entendi" em 01/11/2026. Curso retomado por pedido do
aluno em 03/11/2026; módulo 7 iniciado na 7.1 — Autenticação e autorização.
A introdução distingue identificação, permissão e validação, usando o catálogo
público existente. Entendimento da 7.1 confirmado com "entendi" em 03/11/2026.
7.1 publicada em 074fcf9, com remoto conferido. Na 7.2, leitura do User,
config/auth.php e migration de usuários apresentada: configuração carregada,
dez verificações do model em memória/zero SQL e status das migrations nos dois
ambientes conferidos. Sem alteração de aplicação ou criação de tabelas.
Entendimento da 7.2 confirmado com "entendi" em 03/11/2026; publicada em
801016c, remoto conferido. Na 7.3, SQL da migration de usuários inspecionado
com --pretend/--path na conexão sqlsrv: oito instruções, sem aplicação.
Estado consultado antes/depois preservado; users permanece Pending.
Entendimento da 7.3 confirmado com "entendi" em 03/11/2026; publicada em
cab244e, remoto conferido. Na 7.4, somente essa migration aplicada em loja_test:
três tabelas vazias, 17 colunas, índices/PKs e registro único no lote 4 conferidos.
Reexecução Nothing to migrate; suíte existente 66/620 passou; estado consultado
de loja preservado. Entendimento da 7.4 confirmado com "entendi" em 03/11/2026;
publicação conferida em 65880d0. Na 7.5, primeiro teste de persistência de User
com DatabaseTransactions criado: identidade antes da escrita, create/findOrFail,
ID inteiro positivo e nome/e-mail. Focado 1/6 e suíte em ordem inversa 67/626
passaram; zero usuários após rollback. Contador identity pode avançar.
Entendimento da 7.5 confirmado com "entendi" em 03/11/2026; publicada em
5f0b13b, remoto conferido. Na 7.6, mesmo cenário ampliado com três asserções de
hash persistido/senha correta/diferente. Focado 1/9 e suíte 67/629 passaram;
rollback e quatro registros de migrations conferidos em loja_test.
Entendimento da 7.6 confirmado com "entendi" em 03/11/2026; publicada em
718f0e3, remoto conferido. Na 7.7, mesmo cenário ampliado com token persistido,
campos visíveis e ocultos em array/JSON. Focado 1/15 e suíte 67/635 passaram;
rollback e quatro migrations conferidos. Entendimento da 7.7 confirmado com
"entendi" em 03/11/2026; publicada em e21e732, remoto conferido. Na 7.8, fluxo
planejado de sessão/cookie apresentado; configuração normal e grupos web/api
conferidos no Docker, sem login ou sessão iniciada. Entendimento da 7.8 confirmado
com "entendi" em 03/11/2026; publicada em c5008fd, remoto conferido. Na 7.9,
proteção CSRF apresentada com origem/token no middleware instalado. Diagnóstico
fora do modo de testes: seis casos em memória, status/continuação conferidos,
zero SQL. Sem alteração de aplicação. Entendimento da 7.9 confirmado com
"entendi" em 03/11/2026; publicada em f082f80, remoto conferido. Na 7.10, papel
do Sanctum apresentado: sessão/cookie para a interface própria, preparação
stateful versus exigência auth:sanctum e fluxo CSRF/login/API. Diagnóstico
confirmou pacote ausente de composer.json/lock/vendor e configuração atual.
Entendimento da 7.10 confirmado com "entendi" em 04/11/2026; publicada em
63c0f1e, remoto conferido. Na 7.11, Sanctum v4.3.3 instalado via Composer/Docker,
faixa ^4.3.3 e lock; somente um pacote adicionado, 109 anteriores preservados.
Validação/plataforma/autoload e suíte 67/635 passaram. Descoberta não executada.
Auditoria identificou aviso preexistente em symfony/mime v8.1.7 (CVE-2026-45070),
pendente naquela etapa. Entendimento da 7.11 confirmado com "entendi" em 04/11/2026;
publicada em 0cf2c82, remoto conferido. Na 7.12, somente symfony/mime atualizado
8.1.7 → 8.1.10; JSON e outros pacotes preservados. Auditoria 0/sem avisos,
validação/plataforma e suíte 67/635 passaram. Entendimento da 7.12 confirmado com
"entendi" em 04/11/2026; publicada em 99a131d, remoto conferido. Na 7.13,
package:discover executado: sete entradas, provider Sanctum carregado e rota
GET|HEAD /sanctum/csrf-cookie registrada com web. Manifests válidos, JSON/lock
preservados e suíte 67/635 passou. Entendimento da 7.13 confirmado com "entendi"
em 04/11/2026; publicada em cc016c4, remoto conferido. Na 7.14, primeira chamada
HTTP real a csrf-cookie: 204/corpo vazio e dois cookies com atributos conferidos,
sem valores expostos. Sessão de visitante com CSRF, sem login; arquivo da demo
removido e preexistentes preservados. Entendimento da 7.14 confirmado com "entendi"
em 04/11/2026; publicada em 601c103, remoto conferido. Na 7.15, statefulApi
habilitado no bootstrap; origem/Referer locais reconhecidos em diagnóstico com
sessão array, sem origem/desconhecida sem preparação; todos sem login, zero SQL.
Rotas com middleware esperado e suíte 67/635 passaram. Entendimento da 7.15
confirmado com "entendi" em 04/11/2026; publicada em 4674279, remoto conferido.
Na 7.16, contrato planejado GET /api/v1/usuario documentado: 200/data com
id/name/email e 401/message para visitante. Exemplos JSON/tipos conferidos em
PHP Docker; nenhuma rota criada. Entendimento confirmado com "entendi" em
04/11/2026; publicada em 833c010, remoto conferido. Na 7.17, UsuarioResource
criada com id/name/email; sete verificações em memória passaram, com envelope
data e zero SQL. Sintaxe válida e suíte existente 67/635 passou. Entendimento
confirmado com "entendi" em 04/11/2026; publicada em 8cceb30, remoto conferido.
Na 7.18, UsuarioController::show criado: Request::user entregue ao Resource.
Dois usuários fictícios/resolver em memória, oito condições por caso, zero SQL;
rota ausente conferida, sintaxe válida e suíte 67/635 passou. Entendimento
confirmado com "entendi" em 04/11/2026; publicada em 6523c31, remoto conferido.
Na 7.19, rota GET /api/v1/usuario com auth:sanctum registrada e bootstrap
ajustado para evitar busca de login em api/*. Kernel confirmou 401 JSON para
visitante com Accept JSON/HTML/ausente, sem redirect/SQL. Catálogo público,
sintaxe válida e suíte 67/635 passou. Entendimento confirmado com "entendi" em
04/11/2026; publicada em 5d6a4d8, remoto conferido. Na 7.20, UsuarioApiTest criado
com DataProvider para Accept JSON/HTML/ausente: 401, Content-Type, sem Location,
somente message string. Focado 3/18 e suíte completa 70/653 passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicada em c17ad9e,
remoto conferido. Na 7.21, UsuarioApiTest ampliado com DatabaseTransactions e
User persistido após conferir loja_test/loja_testes; actingAs/web e 200/JSON
exato com id/name/email. Focado 4/26 e suíte 71/661 passaram; dados zero após
rollback. Entendimento confirmado com "entendi" em 04/11/2026; publicada em
02a4b08, remoto conferido. Na 7.22, mesmo cenário ampliado com Bruno persistido
antes de Ana, IDs diferentes e query id/email de Bruno, mantendo actingAs/Ana.
Resposta exata de Ana conferida; focado 4/27 e suíte 71/662 passaram, rollback
conferido. Entendimento confirmado com "entendi" em 04/11/2026; publicada em
fe91e84, remoto conferido. Na 7.23, OpenAPI inclui consulta do usuário com
schema Usuario, respostas 200/401 e SessaoCookie apenas nessa operação.
Nome do cookie conferido; catálogo preservado. Redocly fixado: documento válido
código 0 e cópias sem email/com password extra rejeitadas código 1. Sem nova
suíte Laravel. Entendimento confirmado com "entendi" em 04/11/2026; publicada
em a4cd9bc, remoto conferido. Na 7.24, contrato planejado do login apresentado:
email/password, 204 sem corpo/renovação de sessão e 422 por validação ou erro
genérico de credenciais; CSRF preservado/419 quando rejeitado. Três exemplos
JSON conferidos em PHP Docker; nenhuma rota/login implementados. Entendimento
confirmado com "entendi" em 04/11/2026; publicada em 7ee449a, remoto conferido.
Na 7.25, LoginRequest criada com authorize true e regras bail/required/string/
email/max:255 e bail/required/string. Diagnóstico 17 casos em memória, três
válidos/14 inválidos com 422 e zero SQL; normalização/validated conferidos.
Sintaxe válida e suíte existente 71/662 passou. Entendimento confirmado com
"entendi" em 04/11/2026; publicada em ad9f45b, remoto conferido. Na 7.26,
LoginRequestTest criado com helper de normalização/FormRequest e provedores
de três válidos/14 inválidos. Validated exato e 422 JSON renderizado em memória;
focado 17/94 e suíte 88/756 passaram. Entendimento confirmado com "entendi"
em 04/11/2026; publicada em 7f3e8ed, remoto conferido. Na 7.27, LoginController
criado: validated/attempt web, erro genérico ou sessão renovada/204. Diagnóstico
de três casos com loja_test/transação/sessão array passou, duas falhas 422 iguais,
rollback e suíte 88/756 conferidos. Sem rota. Entendimento confirmado com
"entendi" em 04/11/2026; publicada em 10416ad, remoto conferido. Na 7.28,
LoginControllerTest criado com transação/User/sessão array/guard real. Sucesso
204/identidade/renovação e falhas com mesmo corpo 422/visitante/sessão preservada.
Focado 2/47 e suíte 90/803 passaram; dados zero após rollback. Entendimento
confirmado com "entendi" em 04/11/2026; publicada em e6ac54f, remoto conferido.
Na 7.29, limite planejado de cinco pedidos/IP/60 segundos desde primeiro hit,
incluindo sucesso/falhas, sem reset no sucesso ou extensão no bloqueio. 429 JSON
com Retry-After/no-store; cache file normal conferido. Nove casos com contador
Laravel/cache array/relógio controlado e exemplo JSON passaram. Sem aplicação
de limitador ou nova suíte. Entendimento confirmado com "entendi" em 04/11/2026;
publicada em d702086, remoto conferido. Na 7.30, AppServiceProvider::boot registra
login com Limit 5/minuto/IP e callback 429 JSON/headers/no-store. Diagnóstico
conferiu seis condições de configuração e três respostas com oito condições
cada, Retry-After ilustrativo 60/37/11 preservado e nenhuma rota usando o limite.
Sintaxe válida, zero SQL no diagnóstico e suíte 90/803 passou. Entendimento
confirmado com "entendi" em 04/11/2026; publicada em 4c5388d, remoto conferido.
Na 7.31, LoginRateLimiterTest passa pelo middleware real com cache array/relógio
controlado: seis execuções, bloqueio/IP/expiração/headers e consumo por falhas.
Focado 6/156 e suíte 96/959 passaram. Migration de usuários no ambiente normal
consultada: Pending, sem aplicação. Entendimento confirmado com "entendi" em
04/11/2026; publicada em 7c55de4, remoto conferido. Na 7.32, somente essa migration
aplicada em loja com sqlsrv_migracoes, lote 4/Ran, três tabelas vazias e reexecução
Nothing to migrate. Conteúdo/metadados do catálogo preservados; padrão loja_app/
sessões file. Suíte existente 96/959 passou em loja_test, vazio após rollback.
Entendimento da 7.32 confirmado com "entendi" em 04/11/2026; publicada em a79946a,
remoto conferido. Na 7.33, POST /api/v1/login registrado para LoginController::store
com throttle:login; somente routes/api.php alterado. Sintaxe/lista de rotas
conferidas; diagnóstico kernel/testing/origem reconhecida/cache e sessão array:
cinco 422 e sexto 429 para Accept JSON/HTML/padrão do construtor, JSON/sem Location/zero SQL.
Suíte existente 96/959 passou. Sucesso por HTTP/CSRF real continuam pendentes.
Entendimento da 7.33 confirmado com "entendi" em 04/11/2026; publicada em 54cea24,
remoto conferido. Na 7.34, LoginApiTest criado: kernel HTTP real/cache e sessão
array/relógio controlado, cinco 422 e sexto 429 por Accept JSON/HTML/ausência
real, conferindo entrada/sessão/visitante/corpos/headers. Focado 3/267 e suíte
99/1.226 passaram. Corrigido registro da 7.33: suposta ausência era o Accept
padrão de Request::create; novo teste remove/confere o cabeçalho. O mesmo
preparo incorreto no teste isolado da 7.31 foi corrigido na 7.35.
Entendimento da 7.34 confirmado com "entendi" em 04/11/2026; publicada em 019c99b,
remoto conferido. Na 7.35, somente helper de LoginRateLimiterTest alterado:
remove/define Accept após Request::create e confere presença/valor antes do
middleware. Ausência real coberta; focado 6/236 e suíte 99/1.306 passaram.
Mesmos cenários, 80 asserções adicionais em 40 chamadas. Aplicação preservada.
Entendimento da 7.35 confirmado com "entendi" em 04/11/2026; publicada em 1f0f255,
remoto conferido. Na 7.36, sucesso por HTTP adicionado em LoginApiTest: classe
com DatabaseTransactions/identidade loja_test/loja_testes antes de DML, fixture
somente no sucesso, sessão visitante/cookie de teste. Rota/guard reais: 204,
identidade/sessão, marcador preservado, ID/token renovados e cookie anterior/
novo conferidos. Helper aceita dados e cookies preparados pelo Laravel.
Focado 4/294 e suíte 100/1.333 passaram; SQL posterior sem dados.
Entendimento da 7.36 confirmado com "entendi" em 04/11/2026; publicada em be62fdf,
remoto conferido. Na 7.37, adicionado um método em LoginApiTest para senha
incorreta/e-mail inexistente: duas tentativas com formato válido, mesmo 422
genérico em email, visitante/identidade null e ID/token/marcador preservados,
mesmo ID nos cookies. Fixture em loja_test/transação e corpos comparados sem fixar
tradução. Focado 5/344 e suíte 101/1.383 passaram; SQL posterior sem dados.
Entendimento da 7.37 confirmado com "entendi" em 04/11/2026; publicada em 10c260c,
remoto conferido. Na 7.38, sucesso ampliado em LoginApiTest: cookie da resposta
obtido/decifrado pelo helper, atributos da sessão limpos só em memória e guards
descartados. GET usuario com cookie/withCredentials/Origin reconhecido retorna
200/JSON exato data/id/name/email; marcador recarregado, mesmo ID no cookie/
sessão e identidade no guard conferidos. Focado 5/357 e suíte 101/1.396 passaram;
SQL posterior sem dados. Entendimento da 7.38 confirmado com "entendi" em
04/11/2026; publicada em 29e7b03, remoto conferido. Na 7.39, mesmo cenário
recebe controle sem cookie: atributos em memória limpos/guards descartados,
call GET com cookies explicitamente vazios, mesma origem/IP. Retorna 401 JSON
somente message/sem Location; Request sem cookies/com sessão, visitante e
identidade/marcador null conferidos. Focado 5/368 e suíte 101/1.407 passaram;
SQL posterior sem dados. Entendimento da 7.39 confirmado com "entendi" em
04/11/2026; publicada em 9b7c8dd, remoto conferido. Na 7.40, criado protocolo
documental de CSRF fora de testing: Guzzle no Docker/servidor local, origem
reconhecida, Sec-Fetch-Site ausente, cookies de visitante e JSON {}. Preparação
204 e controles 419/419/422 são expectativas, não resultados observados.
Fontes oficiais/código instalado/configuração carregada conferidos; nenhuma
requisição HTTP executada. Sem nova suíte; última 7.39, 101/1.407.
Entendimento da 7.40 confirmado com "entendi" em 04/11/2026; publicada em 655a17b,
remoto conferido. Na 7.41, HTTP confirmou 204/419/419/422 com Guzzle no Docker,
ambiente local/CSRF ativo/console e testing false. Para preservar 54 sessões
antigas, servidor PHP temporário em porta dinâmica com coleta [0,100] só nele;
Host/Origin 8002 mantidos. Uma sessão própria e auxiliares removidos/servidor
encerrado; nomes/hashes anteriores preservados, configuração habitual [2,100].
Sem credenciais, SQL, nova suíte ou alteração persistente de backend.
Entendimento da 7.41 confirmado com "entendi" em 04/11/2026; publicada em 091ba33,
remoto conferido. Na 7.42, POST login integrado ao OpenAPI com corpo JSON
email/password, security vazio para visitante e respostas 204/419/422/429.
Schemas estruturais, exemplos e cabeçalhos do limitador documentados; regras
completas de normalização/validação explicadas nas descrições. Redocly passou;
quatro exemplos inválidos rejeitados e dois casos adicionais permitidos aceitos.
Contratos anteriores preservados; GET usuario mudou somente a descrição.
Entendimento da 7.42 confirmado com "entendi" em 04/11/2026; publicada em 5f2b770,
remoto conferido. Na 7.43, contrato de POST logout desenhado: sem corpo
obrigatório, sessão/CSRF da interface própria, logout web/invalidação/novo token,
204 vazio também para visitante válido e 419 se a proteção rejeitar. Consulta
posterior somente com cookies/sem outra autenticação deverá responder 401.
Fontes oficiais/código instalado conferidos; nenhum logout executado.
Entendimento da 7.43 confirmado com "entendi" em 04/11/2026; publicada em 86ab952,
remoto conferido. Na 7.44, somente LoginController ganhou import Request e
método destroy: logout web, invalidate, regenerateToken e 204 vazio. Diagnóstico
direto autenticado/visitante em loja_test/transações/sessão array passou:
13 condições por caso, inclusive registro antigo destruído e recarga visitante.
Suíte existente 101 testes/1.407 asserções passou; SELECT posterior sem dados.
Entendimento da 7.44 confirmado com "entendi" em 04/11/2026; publicada em b206ca5,
remoto conferido. Na 7.45, um teste permanente de logout autenticado adicionado
a LoginControllerTest: guard real, sessão array salva com marcador, destroy
direto, 204 vazio, limpeza/renovação e registro antigo removido. Recarga por
save/flush/forgetGuards/start mantém visitante e ID/token novos. Focado 3/76,
suíte 102/1.436 e SELECT posterior sem dados passaram.
Entendimento da 7.45 confirmado com "entendi" em 04/11/2026; publicada em 3014af2,
remoto conferido. Na 7.46, um teste permanente de logout visitante adicionado:
sem login, exige ausência inicial de identidade, salva marcador/sessão array,
chama destroy e confere 204 vazio, limpeza/renovação/registro antigo removido e
recarga visitante com ID/token novos. Focado 4/104, suíte 103/1.464 e SELECT
posterior sem dados passaram.
Entendimento da 7.46 confirmado com "entendi" em 04/11/2026; publicada em fc3c8e9,
remoto conferido. Na 7.47, POST logout ligado a destroy em routes/api.php,
sem auth:sanctum/throttle:login. Sintaxe/route:list conferidos; kernel/testing
com origem reconhecida e sessão/cache array: visitante 204 vazio/sem Location
nos Accept JSON, HTML e realmente ausente. Cookies de sessão/CSRF emitidos,
guard visitante; zero SQL após identidade. Treze condições/caso passaram.
Suíte existente 103/1.464 passou; SELECT posterior sem dados. CSRF não exercitado.
Entendimento da 7.47 confirmado com "entendi" em 04/11/2026; publicada em e6c30c6,
remoto conferido. Na 7.48, criado LogoutApiTest: DataProvider executa visitante
nos três Accept, com cabeçalho ausente removido e presença/valor conferidos.
Request sem corpo/cookies, Origin reconhecido; kernel/rota/controller retornam
204 vazio/sem Location, cookies emitidos e visitante sem identidade. Sessão/cache
array e identidade de banco de testes exigidos. Focado 3/57, suíte 106/1.521 e
SELECT posterior sem dados passaram. Não exerce CSRF ativo ou navegador.
Entendimento da 7.48 confirmado com "entendi" em 04/11/2026; publicada em 1ddeaad,
remoto conferido. Na 7.49, LogoutApiTest ganhou transações e cenário autenticado:
fixture em loja_test/guard web/sessão array salva com marcador, flush/forgetGuards
antes de POST logout com cookie. 204 vazio/sem Location, cookie de entrada com
ID anterior, guard visitante/chaves removidas/ID/token novos/registro destruído.
Focado 4/91, suíte 107/1.555 e SELECT posterior sem dados/rollback passaram.
Entendimento da 7.49 confirmado com "entendi" em 04/11/2026; publicada em 0eaa7b5,
remoto conferido. Na 7.50, cenário ampliado com GET usuario após logout usando
cookie da resposta, flush/forgetGuards e withCredentials/getJson. Exige 401
JSON/sem Location, somente message string, cookie recebido com ID visitante,
sem Authorization, ID/token preservados/visitante/chaves ausentes. Focado 4/108,
suíte 107/1.572 e SQL posterior sem dados/rollback passaram.
Entendimento da 7.50 confirmado com "entendi" em 04/11/2026; publicação pendente.
Próximo após confirmar/publicar: 7.51 — controle GET usuario com cookie anterior
ao logout, memória limpa/guards descartados, exigindo 401 JSON e ausência de
identidade/marcador. CSRF ativo/cookies no navegador, CORS e OpenAPI pendentes.
Módulos 8 a 23 ainda não iniciados.
A tabela inclui entregas futuras.
Os módulos 1 a 5 foram concluídos, com entendimento da revisão 5.92 confirmado
em 21/10/2026. Os registros abaixo descrevem o percurso do módulo 5.
O módulo 5 confirmou e publicou a descoberta de pacotes da 5.33.
Na 5.34, script de loja_testes em loja_test preparado e analisado com PARSEONLY,
sem executar as instruções de criação/concessão. Ausência da conta e de tabelas
conferida depois. Revisão retomada e entendimento da 5.34 confirmado com
"entendi" em 19/10/2026; confirmação publicada em 49a22c5.
Na 5.35, senha local preparada e conta loja_testes criada em loja_test;
autenticação, permissões, ausência de acesso a loja e reexecução verificadas.
Banco de testes continua sem tabelas. Explicação apresentada; entendimento da
5.35 confirmado com "entendi" em 19/10/2026 e publicado em 04a9a7c.
Na 5.36, backend/.env.testing.example preparado e analisado com phpdotenv;
modelo público versionável, arquivos locais com segredos continuam ignorados.
Explicação apresentada; entendimento da 5.36 confirmado com "entendi" em
19/10/2026 e publicado em 1c8c380. Na 5.37, .env.testing local criado com chave
própria e senha existente de loja_testes; carregamento, criptografia e SELECT
Laravel em loja_test conferidos. Ambiente normal segue loja/loja_app.
Entendimento da 5.37 confirmado com "entendi" em 19/10/2026 e publicado em d80d241.
Na 5.38, phpunit.xml passou a sqlsrv/loja_test; XSD, variáveis pelo carregador
real PHPUnit e SELECT Laravel conferidos, sem executar a suíte. Entendimento
da 5.38 confirmado com "entendi" em 19/10/2026 após esclarecer APP_ENV,
publicado em 734fc5f. Na 5.39, dois testes de exemplo apresentados e executados:
2 testes/2 asserções passaram, sem código alterado. Não consultam SQL nem
verificam catálogo; SELECT separado confirmou zero tabelas em loja_test.
Entendimento da 5.39 confirmado com "entendi" em 19/10/2026 e publicado em bdfb1a3.
Na 5.40, migration existente de produtos aplicada somente em loja_test:
produtos vazia e migrations com lote 1. Esquema/status/reexecução conferidos;
banco normal segue loja/loja_app com um produto. Entendimento da 5.40 confirmado
com "entendi" em 19/10/2026 e publicado em b70f6f0. Na 5.41, primeiro teste
de integração para catálogo vazio criado com DatabaseTransactions. Focado:
1 teste/3 asserções; suíte: 3 testes/5 asserções, passaram. SELECT posterior
confirmou zero produtos em loja_test e um em loja. Entendimento da 5.41
confirmado com "entendi" em 19/10/2026 e publicado em 94e4e3d. Na 5.42, setUp
compartilhado e cenário de produto ativo preparados. Focado: 2 testes/6 asserções;
suíte em ordem inversa: 4 testes/8 asserções, passaram. Zero produtos em loja_test
após rollback. Entendimento da 5.42 confirmado com "entendi" em 19/10/2026 e
publicado em aa8e5a4. Na 5.43, cenário com ativo/inativo exige somente o ativo:
focado 3 testes/9 asserções e suíte 5 testes/11 asserções, passaram. Zero produtos
em loja_test após rollback. Entendimento da 5.43 confirmado com "entendi" em
19/10/2026 e publicado em 62f465e. Na 5.44, cenário de ordenação de dois ativos
adicionado; focado 4 testes/12 asserções e suíte 6 testes/14 asserções, passaram.
Entendimento da 5.44 confirmado com "entendi" em 19/10/2026 e publicado em 5810b26.
Na 5.45, estrutura de ProdutoFactory gerada; sintaxe/autoload/herança/modelName
conferidos, definition vazio e nenhum dado criado. Entendimento da 5.45
confirmado com "entendi" em 19/10/2026 e publicado em 3e094e5. Na 5.46,
definição preenchida com nome/preço fictícios e status ativo; dez arrays
conferidos em memória, sem SQL ou models. Entendimento da 5.46 confirmado com
"entendi" após esclarecer os métodos e publicado em 77dc3f9. Na 5.47,
new()->make() montou Produto em memória, com exists false, ID/datas null,
atributos previstos e zero SQL. Entendimento da 5.47 confirmado com "entendi"
em 19/10/2026 e publicado em d90a8a4. Na 5.48, HasFactory adicionado a Produto;
atalho factory()->make conferido em memória, zero SQL. Suíte existente:
6 testes/14 asserções, passou. Entendimento da 5.48 confirmado com "entendi"
em 19/10/2026, após esclarecer o local da demonstração, publicado em d465778.
Na 5.49, factory()->create aplicada somente ao cadastro do teste de ativo:
nome/status sobrescritos, preço padrão. Teste 1/3 e suíte 6/14 passaram;
rollback conferido. Entendimento da 5.49 confirmado com "entendi" em 19/10/2026,
publicado em 9a08b80. Na 5.50, dois cadastros do cenário ativo/inativo usam
factory com nome/status explícitos e preço padrão. Teste 1/3 e suíte 6/14
passaram; rollback conferido. Entendimento da 5.50 confirmado com "entendi" em
19/10/2026, publicado em 10e723b. Na 5.51, factory nos dois cadastros do cenário
de ordenação, preservando nomes, status e ordem de inserção; teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.51 confirmado com "entendi"
em 19/10/2026, publicado em 5152ba4. Na 5.52, inativo(): static na factory usa
state com array; diagnóstico com make conferiu inativo em memória, padrão ativo
preservado e zero SQL. Suíte existente 6/14 passou. Entendimento da 5.52
confirmado com "entendi" em 19/10/2026, publicado em edd3411. Na 5.53, cadastro
da Caneca no teste usa inativo()->create com nome explícito. Teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.53 confirmado com "entendi"
em 19/10/2026, publicado em 6ac5518. Na 5.54, DatabaseSeeder existente apresentado
sem execução; sintaxe/reflexão e SELECTs passaram. Rotina padrão cria usuário,
depende de users, tabela ainda ausente nos dois bancos. Explicadas diferenças
entre migration/factory/seeder. Entendimento da 5.54 confirmado com "entendi"
em 19/10/2026, após nova explicação com exemplo da loja, publicado em def2f14.
Na 5.55, corrigida previsão de gerar ProdutoSeeder: já existe desde a 5.20,
com firstOrCreate desde a 5.24. Arquivo preservado/revisado em relação ao
DatabaseSeeder; sintaxe passou, sem execução. Entendimento da 5.55 confirmado
com "entendi" em 19/10/2026, publicado em 0f754ae. Na 5.56, DatabaseSeeder chama
ProdutoSeeder por call; exemplo de User removido. Sintaxe/autoload passaram,
sem executar seeders. Entendimento da 5.56 confirmado com "entendi" em 19/10/2026,
publicado em 07af123. Na 5.57, db:seed padrão executado em loja_test dentro de
transação: chamou ProdutoSeeder, criou Camiseta e catálogo retornou seu nome.
Rollback/contagens conferidos: teste com zero produtos, normal com um.
Entendimento da 5.57 confirmado com "entendi" em 19/10/2026, publicado em 5c65e6d.
Na 5.58, modelagem inicial categorias/produtos: um para muitos, chave primária
e estrangeira explicados com exemplos ilustrativos, sem alterar código/esquema.
Entendimento da 5.58 confirmado com "entendi" em 20/10/2026, publicado em f680b99.
Na 5.59, migration de categorias gerada com id, nome string(150) e timestamps(3);
sintaxe passou, sem aplicar. Entendimento da 5.59 confirmado com "entendi" em
20/10/2026, publicado em 9e89010. Na 5.60, migration aplicada somente em loja_test;
esquema/status [2] Ran/reexecução conferidos, categorias e produtos vazios.
Banco normal mantém um produto e uma migration. Entendimento da 5.60 confirmado
em 20/10/2026, publicado em 04ab6bb. Na 5.61, mesma migration aplicada em loja com
loja_migracoes; esquema/status/reexecução e produto preservado conferidos.
Categorias vazia nos dois bancos, duas migrations em cada. Entendimento da 5.61
confirmado com "entendi" em 20/10/2026, publicado em 4d3358d. Na 5.62, model
Categoria criado com Fillable de nome; tabela/chave/timestamps e objeto em memória
conferidos, zero SQL. Entendimento da 5.62 confirmado com "entendi" em 20/10/2026,
publicado em e57dbbe. Na 5.63, create/findOrFail de categoria em loja_test
conferidos com ID/datas, transação desfeita e contagens finais preservadas.
Entendimento da 5.63 confirmado com "entendi" em 20/10/2026, publicado em ce67886.
Na 5.64, migration de categoria_id anulável/FK em produtos preparada, com
noActionOnDelete e reversão da FK/coluna. Sintaxe passou, sem aplicar.
Entendimento da 5.64 confirmado com "entendi" em 20/10/2026, publicado em e5e6156.
Na 5.65, tentativa de aplicação em loja_test falhou por REFERENCES negado em
categorias; coluna/FK ausentes e Pending confirmados após falha. Suíte planejada
não executada. Entendimento da descoberta confirmado com "entendi" em 20/10/2026,
publicado em 91ed884. Na 5.66, script de GRANT REFERENCES restrito a categorias
em loja_test preparado; PARSEONLY passou, permissão continua 0 e migration Pending.
Entendimento da 5.66 confirmado com "entendi" em 20/10/2026, publicado em 3924613.
Na 5.67, concessão aplicada no teste, REFERENCES 1 e FK criada: categoria_id
BIGINT NULL, referência a categorias.id/NO_ACTION, histórico lote 3 conferidos.
Suíte 6/14 passou; teste vazio após testes. Normal segue sem coluna/permissão.
Entendimento da 5.67 confirmado com "entendi" em 20/10/2026, publicado em e384ae1.
Na 5.68, concessão/migration aplicadas em loja com loja_migracoes; FK/histórico e
produto preservado com categoria_id NULL conferidos. Ambos os bancos têm coluna/FK
e três migrations. Entendimento da 5.68 confirmado com "entendi" em 20/10/2026,
publicado em 55f7ea8. Na 5.69, Produto recebeu Fillable de categoria_id e método
categoria com belongsTo; configuração em memória/zero SQL e suíte 6/14 passaram.
Entendimento da 5.69 confirmado com "entendi" em 20/10/2026, publicado em 6292b4b.
Na 5.70, primeiro ProdutoCategoriaTest verifica categoria lida pela propriedade
de produto recarregado; duas categorias e uma Camiseta preparadas no SQL Server.
Focado 1/5 e suíte 7/19 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026 e publicado em 68b586f. Na 5.71, segundo cenário
verifica categoria_id e relação null após recarregar produto sem categoria.
Focado 2/9 e suíte 8/23 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026 e publicado em e41a1d4. Na 5.72, relação inversa
hasMany definida em Categoria; sintaxe e configuração em memória com zero SQL
conferidas. Suíte existente 8/23 passou; ainda não lê produtos por hasMany.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em 593cb81.
Na 5.73, primeiro CategoriaProdutosTest cadastra duas categorias/três produtos,
recarrega Roupas e verifica coleção somente com Camiseta/Calça pelos IDs, sem
exigir ordem. Focado 1/5 e suíte 9/28 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 6ad0d19. Na 5.74, segundo
cenário confere coleção vazia para categoria sem produtos. Focado 2/9 e suíte
10/32 passaram, rollback conferido. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 5b9d800. Na 5.75, terceiro cenário usa
produtos()->where('status', 'ativo')->get(), retornando somente ativo da categoria.
Focado 3/13 e suíte 11/36 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026, publicado em 617408b. Na 5.76, cenário em
ProdutoCategoriaTest confere associate em memória e persistência após save/recarga.
Falha inicial por FK string/ID inteiro corrigida com conversão local na asserção;
focado final 3/15 e suíte 12/42 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 0730204. Na 5.77,
dissociate/save conferidos antes/depois da gravação, com categoria preservada.
Focado 4/22 e suíte 13/49 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026, publicado em 7d94759. Na 5.78, diagnóstico temporário
em loja_test conferiu carregamento sob demanda: 1 SELECT de três produtos e 3
SELECTs de categorias, total 4 (N+1). Nomes/rollback/contagens conferidos, sem mudar
aplicação. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
55d0045. Na 5.79, diagnóstico comparativo com with('categoria') retornou os mesmos
nomes com 2 SELECTs em vez de 4, sem consultas adicionais no foreach. Rollback e
contagens posteriores conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 70d44b5. Na 5.80, cenário permanente em
ProdutoCategoriaTest exige resultados corretos e duas consultas antes/depois
do foreach. Focado 5/27 e suíte 14/54 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 3627952. Na 5.81, INNER JOIN
parametrizado retornou Camiseta/Roupas em 1 SELECT; Caneca sem categoria ficou
fora do resultado e seguiu no banco. Rollback/contagens conferidos, sem mudar
aplicação. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
dca90ec. Na 5.82, comparação com LEFT JOIN retornou também Caneca/null em
1 SELECT/2 linhas, enquanto INNER retornou 1 linha. Nomes/NULL/rollback/contagens
conferidos. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
c700173. Na 5.83, mesmo LEFT JOIN por Query Builder comparado ao SQL: mesmos
nomes/null, 1 SELECT por caso, zero antes de get, Collection de linhas simples.
Rollback/contagens conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 829236f. Na 5.84, count() no Query Builder retornou
inteiros 2/0 com um SELECT COUNT(*) por categoria, sem carregar lista. SQL/rollback/
contagens conferidos. Entendimento confirmado com "entendi" em 20/10/2026,
publicado em fd95bdd. Na 5.85, GROUP BY categoria_id e COUNT(*) retornaram
dois grupos com totais 2/1 em um SELECT. IDs/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em d797c48.
Na 5.86, agrupamento via selectRaw/groupBy/get comparado ao SQL: mesmos grupos/
totais 2/1, um SELECT por caso, zero antes de get e Collection de linhas simples.
Rollback/contagens conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em a764ac5. Na 5.87, HAVING COUNT(*) >= 2 filtrou
os grupos e retornou só Roupas/2 em um SELECT. IDs/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em 9416c4f.
Na 5.88, havingRaw('COUNT(*) >= ?', [2]) comparado ao SQL: mesmo grupo Roupas/2,
um SELECT por caso, parâmetros e zero antes de get conferidos. Rollback/contagens
passaram. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
0aa0ebc. Na 5.89, LEFT JOIN a partir de categorias e COUNT(produtos.id) retornaram
Roupas/2 e Acessórios/0 em um SELECT. IDs/nomes/zero/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 21/10/2026, publicado em d7a9051.
Na 5.90, mesmo LEFT JOIN/COUNT no Builder retornou IDs/nomes/totais 2/0 iguais ao
SQL, um SELECT por caso, zero antes de get. Retorno/parâmetros/rollback conferidos.
Entendimento confirmado com "entendi" em 21/10/2026, publicado em 1d801ae.
Na 5.91, withCount('produtos') retornou models Categoria com produtos_count 2/0,
um SELECT e coleção produtos sem carregar. Tipos/IDs/nomes/rollback/contagens
conferidos. Entendimento confirmado com "entendi" em 21/10/2026, publicado em
a5e94b5. Na 5.92, entrega persistida revisada pelo fluxo GET /loja até SQL Server
e Blade; binding/consulta CLI e HTTP 200 com Camiseta conferidos, sem mudar aplicação.
Entendimento da revisão confirmado com "entendi" em 21/10/2026; módulo 5 concluído.
Publicação registrada em docs/progresso.md. Em 21/10/2026, o aluno confirmou o
encerramento do módulo 5 e decidiu iniciar o módulo 6 em outro momento.
Retomada solicitada em 22/10/2026: módulo 6 iniciado na etapa 6.1, HTTP, HTML e
JSON, usando a resposta existente de /loja. Explicação e verificação apresentadas;
entendimento confirmado com "entendi" em 22/10/2026. Nenhuma rota de API criada
nesta etapa. Checkpoint 6.1 publicado e verificado em 7ce865a. Na 6.2, registro
de routes/api.php com prefixo api/v1 e GET /api/v1/produtos com nomes ativos
ordenados em JSON implementados; contrato inicial em docs/api/catalogo.md.
Sintaxes/registro e HTTP real da API e /loja conferidos; suíte existente 14/54
passou, contagens preservadas. Explicação apresentada, entendimento da 6.2
confirmado com "entendi" em 22/10/2026; checkpoint publicado e verificado em
28450ae. Na 6.3, primeiro CatalogoApiTest verifica status, Content-Type e JSON
do catálogo vazio com transação em loja_test. Focado 1/6 e suíte 15/60 passaram;
contagens preservadas. Explicação apresentada, entendimento da 6.3 confirmado
com "entendi" em 22/10/2026; checkpoint publicado e verificado em d9d0911.
Na 6.4, cenário HTTP de produto ativo via factory exige Camiseta no JSON:
classe 2/12 e suíte 16/66 passaram, contagens preservadas. Explicação apresentada,
entendimento da 6.4 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 7defc2c. Na 6.5, cenário HTTP com ativo/inativo usa inativo() e
exige apenas Camiseta no JSON; classe 3/18 e suíte 17/72 passaram, contagens
preservadas. Explicação apresentada, entendimento da 6.5 confirmado com "entendi"
em 22/10/2026; checkpoint publicado e verificado em bc86f52. Na 6.6, cenário HTTP
de dois ativos inseridos em ordem inversa exige Camiseta/Caneca no JSON:
classe 4/24 e suíte 18/78 passaram, contagens preservadas. Explicação apresentada,
entendimento da 6.6 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em daffb95. Na 6.7, função da rota extraída para
Api\V1\ProdutoController@index; rota/DI/sintaxes conferidos, classe 4/24 e suíte
18/78 passaram. HTTP real JSON/HTML e contagens preservados. Explicação apresentada,
entendimento da 6.7 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 0c2a14e. Na 6.8, desenhada representação de produto com
id/nome/preco_em_centavos, campos/tipos e impacto na leitura, consumidores e testes.
Somente documentação; API continua retornando nomes. Explicação apresentada,
entendimento da 6.8 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 3a92c90. Na 6.9, ProdutoResource mapeia os três campos e foi
conferido em memória: tipos/valores, model não salvo e zero SQL observado.
HTTP real confirmou formato anterior de nomes e HTML preservados. Explicação
apresentada, entendimento da 6.9 confirmado com "entendi" em 23/10/2026 após
esclarecer que ainda não participa da resposta da API; checkpoint publicado e
verificado em 13d9256. Na 6.10, listarProdutos() retorna coleção de Produto ativos
ordenados com id/nome/preço. Diagnóstico de integração conferiu vazio/dados/
filtro/ordem/campos/tipos/um SELECT e rollback; suíte existente 18/78 passou.
HTTP real e contagens preservados. Explicação apresentada, entendimento da 6.10
confirmado com "entendi" em 23/10/2026; checkpoint publicado e verificado em
9e8e6b6. Na 6.11, contrato declara listarProdutos e demonstração retorna coleção
compatível em memória; binding Eloquent/leitura pelo contrato/zero SQL da demo
conferidos, suíte 18/78 passou e HTTP/contagens preservados. Explicação apresentada,
entendimento da 6.11 confirmado com "entendi" em 23/10/2026; checkpoint publicado
e verificado em 11ccc75. Na 6.12, controller retorna ProdutoResource::collection
de listarProdutos e os quatro testes HTTP exigem objetos id/nome/preço. Contrato
ativo atualizado junto à resposta; classe 4/24 e suíte 18/78 passaram. HTTP real
confirmou objeto/Camiseta/4990 e HTML preservado; contagens mantidas. Explicação
apresentada, entendimento da 6.12 confirmado com "entendi" em 23/10/2026 após
esclarecer a busca no banco; checkpoint publicado e verificado em 1b1d288.
Na 6.13, desenhada consulta individual GET /api/v1/produtos/{id}, sucesso 200
com objeto em data e 404 com message para inexistente/inativo. Somente documentação;
nenhuma rota individual implementada. Entendimento da 6.13 confirmado pelo aluno
com "entendi" em 23/10/2026; checkpoint publicado e verificado em 1690d72.
Na 6.14, CatalogoEloquent recebeu buscarProduto(int $id): ?Produto, filtrando
ativo/ID e selecionando os três atributos. Diagnóstico no banco exclusivo conferiu
dois ativos por IDs diferentes, ausente/inativo null, um SELECT e rollback;
suíte 18/78 e HTTP/contagens preservados. Ainda sem ligação com contrato/demo/rota.
Entendimento da 6.14 confirmado com "entendi" em 23/10/2026; checkpoint publicado
e verificado em 198b07e. Na 6.15, Catalogo declara buscarProduto e a demonstração
busca por foreach da coleção em memória, retornando Produto ou null. Diagnóstico
conferiu contrato/assinatura/demo/zero SQL/binding/Eloquent/rollback; suíte 18/78,
HTTP e contagens preservados. Entendimento da 6.15 confirmado com "entendi" em
23/10/2026; checkpoint publicado e verificado em 8961d02. Na 6.16, show e rota
individual ligados: parâmetro positivo sem zero inicial, conversão validada para
int, busca pelo contrato, ProdutoResource no sucesso e JSON 404/message na ausência.
Diagnóstico HTTP em banco exclusivo/transação conferiu ativo/ausente/inativo e
formato/faixa do ID; suíte 18/78, HTTP real e contagens preservados. Contrato ativo
atualizado. Entendimento da 6.16 confirmado com "entendi" em 23/10/2026; publicado
e verificado em 10c7293. Na 6.17, um teste permanente pede o ID real da Camiseta,
com Caneca também cadastrada, e exige 200/tipo/JSON exato em objeto. Classe 5/30 e
suíte 19/84 passaram, contagens preservadas. Aplicação preservada, HTTP real não
repetido. Entendimento da 6.17 confirmado com "entendi" em 23/10/2026; checkpoint
publicado e verificado em c474f24. Pausa encerrada pelo pedido de retomada em
30/10/2026. Na 6.18, acrescentado teste de ID válido inexistente com catálogo
vazio pelo setUp, exigindo 404/application/json e message exata. Classe 6/36 e
suíte 20/90 passaram; contagens antes/depois preservadas. Explicação apresentada;
entendimento da 6.18 confirmado pelo aluno com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em d6fac24. Na 6.19, teste de produto inativo
por ID exige 404/message e registro ainda inativo após a requisição. Classe 7/43
e suíte 21/97 passaram; contagens preservadas. Explicação apresentada, entendimento
da 6.19 confirmado com "entendi" em 30/10/2026; checkpoint publicado em a137a9a.
Na 6.20, teste de ID malformado abc exige 404/application/json e estrutura com
message, sem fixar texto. Classe 8/49 e suíte 22/103 passaram; contagens
preservadas. Explicação apresentada, entendimento da 6.20 confirmado pelo aluno
com "entendi" em 30/10/2026; checkpoint publicado e verificado em a23d688.
Na 6.21, teste de ID numérico acima da faixa de int usa PHP_INT_MAX.'0' e exige
404/application/json e message exata de show. Classe 9/55 e suíte 23/109 passaram;
contagens preservadas. Explicação apresentada, entendimento da 6.21 confirmado
com "entendi" em 30/10/2026; checkpoint publicado e verificado em a79fc87.
Na 6.22, teste de ID malformado parametrizado com DataProvider/idsMalformados:
abc, 0, -1, 1.5 e 01 em conjuntos nomeados. Cada um exige 404/JSON/estrutura com
message. Classe 13/79 e suíte 27/133 passaram; contagens preservadas. Explicação
apresentada, entendimento da 6.22 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 6f49a06. Na 6.23, desenhada paginação da
listagem: page opcional/padrão 1, fixo 10 por página, page de 1 a 1000000 sem zeros
iniciais, inválidos 422, ativos ordenados por nome/ID e data/links/meta. Três
exemplos conferidos em memória, zero SQL e nenhum cadastro; aplicação permanece
sem paginação. Explicação apresentada, entendimento da 6.23 confirmado com "entendi"
em 30/10/2026; checkpoint publicado e verificado em 92ce498. Na 6.24, criado
ListarProdutosRequest com authorize true e regras de page opcional/inteiro decimal
sem zeros iniciais entre 1 e 1000000. Diagnóstico direto: 4 entradas aceitas,
12 rejeitadas com 422 JSON e zero SQL; suíte existente 27/133 passou, contagens
preservadas. Classe ainda sem ligação à rota, API segue sem paginação/validação
de page. Explicação apresentada; entendimento da 6.24 confirmado com "entendi"
em 30/10/2026; checkpoint publicado e verificado em 3d89485. Na 6.25,
ListarProdutosRequest recebeu pagina(): int, cast de validated('page', 1) para
obter inteiro ou padrão 1 após validação. Diagnóstico de 16 entradas/tipos/erros
passou, zero SQL; suíte existente 27/133 passou e contagens preservadas. API segue
sem paginação/validação de page. Explicação apresentada, entendimento da 6.25
confirmado com "entendi" em 30/10/2026; checkpoint publicado em 509ed43. Na 6.26,
CatalogoEloquent recebeu paginarProdutos com dez ativos por página, ordem nome/ID,
três campos e LengthAwarePaginator. Diagnóstico SQL transacional conferiu vazio,
onze ativos/inativo, empate por ID entre páginas, totais e páginas 1/2/3 com
10/1/0 itens; rollback e contagens conferidos. Suíte existente 27/133 passou.
Ainda sem contrato/demo/rota, API segue sem paginação/validação de page. Explicação
apresentada, entendimento da 6.26 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 407e9a5. Na 6.27, contrato declara
paginarProdutos e demo implementa recorte em memória com paginator. Assinatura,
páginas 1/2 com 3/0 itens, JSON/links/zero SQL da demo, binding Eloquent e leitura
pelo contrato conferidos. Suíte existente 27/133 passou; contagens preservadas.
Ainda sem ligação à rota, API segue sem paginação/validação de page. Explicação
apresentada, entendimento da 6.27 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 431fced. Na 6.28, index recebe Form Request
e retorna paginação pelo contrato: page validado/default 1, data/links/meta,
inválidos 422. Quatro testes de listagem adaptados e contrato ativo atualizado;
classe 13/107 e suíte 27/161 passaram. Diagnósticos HTTP pelo kernel/transação
conferiram onze ativos/inativo, páginas/limites/erros sem SQL/rollback; socket
confirmou listagem, page=2 vazia, individual, 422 e Blade. Contagens preservadas.
Explicação apresentada; entendimento da 6.28 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em ed21a33. Na 6.29, acrescentado um teste
permanente de página 2 com onze ativos, um inativo e empate por ID nas posições
10/11. Exige produto completo, links e metadados; classe 14/120 e suíte 28/174
passaram, contagens preservadas. Explicação apresentada; entendimento da 6.29
confirmado com "entendi" em 30/10/2026. Checkpoint publicado e verificado em
6f0af42. Na 6.30, acrescentado teste de page=0 exigindo 422/JSON, message e erro
associado a page, sem fixar tradução. Classe 15/128 e suíte 29/182 passaram,
contagens preservadas. Explicação apresentada; entendimento da 6.30 confirmado
com "entendi" em 30/10/2026. Checkpoint publicado e verificado em d834624.
Na 6.31, teste de page=0 generalizado com DataProvider de onze queries inválidas,
exigindo 422/JSON/message/errors.page. Classe 25/208 e suíte 39/262 passaram;
contagens preservadas. Explicação apresentada; entendimento da 6.31 confirmado
com "entendi" em 30/10/2026. Checkpoint publicado e verificado em 3a782ca.
Na 6.32, teste de um ativo/page=2 exige 200/data [], total 1, página atual 2,
última 1, from/to null e links. Classe 26/221 e suíte 40/275 passaram; contagens
preservadas. Explicação apresentada; entendimento da 6.32 confirmado com "entendi"
em 30/10/2026. Checkpoint publicado e verificado em db652dd. Na 6.33, teste
após a última generalizado com provider de páginas 2/1000000 e anteriores 1/999999.
Ambas retornam 200/data [], total 1, última 1 e links corretos. Classe da API
passou; suíte completa 41/288 passou, contagens preservadas. Explicação apresentada;
entendimento da 6.33 confirmado com "entendi" em 30/10/2026. Publicação verificada
em d86aa98. Na 6.34, contrato do filtro nome desenhado: trecho literal opcional
1..100, vazio/array/excesso com 422, somente ativos, filtrar antes de contar/paginar,
links preservam nome e comparação segue collation atual. SELECTs confirmaram
caixa ignorada/acentos distintos e contagens preservadas. Filtro ainda não
implementado; somente documentação. Explicação apresentada; entendimento da
6.34 confirmado com "entendi" em 01/11/2026 e publicada em 4bb1291. Na 6.35,
ListarProdutosRequest recebeu nome com bail/sometimes/required/string/max:100.
Validação já ativa no HTTP; nome válido ainda não filtra. Diagnóstico conferiu
12 válidos/7 inválidos, normalização/tipos/Unicode/422 sem SQL e rollback; suíte
existente 41/288 passou, contagens preservadas. Explicação apresentada; entendimento
da 6.35 confirmado com "entendi" em 01/11/2026 e publicada em 618eb1a. Na 6.36,
nome(): ?string retorna validated('nome'), texto normalizado ou null quando omitido.
Diagnóstico de valores/tipos e rejeições passou; suíte existente 41/288 e contagens
preservadas. Controller ainda não usa nome; filtro não aplicado. Explicação
apresentada; entendimento da 6.36 confirmado com "entendu" em 01/11/2026 e
publicada em 0b9afb8. Na 6.37, Eloquent recebe nome opcional e usa CHARINDEX
parametrizado antes de paginar. Diagnóstico de 18 cenários SQL conferiu filtro,
total/páginas/empate, literais, caixa/acentos, null/'0', bindings e rollback;
suíte existente 41/288 passou, contagens preservadas. Contrato/demo/controller
preservados, HTTP ainda sem filtro. Explicação apresentada; entendimento da
6.37 confirmado com "entendi" em 01/11/2026 e publicada em 4d34564. Na 6.38,
Catalogo declara nome opcional e demonstração filtra via mb_stripos/UTF-8 antes
de contar/recortar, usando !== false para aceitar posição zero. Quinze cenários
da demo/JSON sem SQL, assinaturas/binding e passagem pelo contrato conferidos;
suíte existente 41/288 passou, contagens preservadas. HTTP ainda sem filtro.
Explicação apresentada; entendimento da 6.38 confirmado com "entendi" em 01/11/2026
e publicada em 90cdc35. Na 6.39, controller integra pagina/nome e appends apenas
nome validado nos links. Busca HTTP agora filtra e mantém total/links coerentes.
Diagnóstico kernel: 19 sucessos/6 inválidos, navegação next e rollback; HTTP real
confirmou filtro/Camiseta/links/422/individual/Blade. Suíte existente 41/288 passou,
contagens preservadas. Explicação apresentada; entendimento da 6.39 confirmado com "entendi"
em 01/11/2026 e publicada em a1ded6b. Na 6.40, novo teste HTTP permanente
exige só os dois ativos correspondentes ao trecho, data completa/ordem, total 2
e links com nome. Classe 28/247 e suíte 42/301 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.40 confirmado com "entendi" em 01/11/2026
e publicada em 851adef. Na 6.41, teste usa DataProvider com três buscas: simples,
espaços/caixa e desconhecido. Links esperados com nome explícito, normalizado e
sem ignorado; produtos/total/metadados anteriores preservados. Classe 30/273 e
suíte 44/327 passaram, contagens preservadas. Explicação apresentada; entendimento
da 6.41 confirmado com "entendi" em 01/11/2026 e publicada em 2128dbb. Na 6.42,
novo teste permanente com seis nomes inválidos exige 422/JSON/message/errors.nome:
vazio, espaços, arrays e 101 caracteres ASCII/Unicode. Classe 36/321 e suíte
50/375 passaram, contagens preservadas. Explicação apresentada; entendimento da
6.42 confirmado com "entendi" em 01/11/2026 e publicada em 8eab468. Na 6.43,
novo teste percorre duas páginas seguindo links.next recebido; exige 12 ativos
correspondentes entre 20 ativos, desempate por ID na divisão, dados completos,
total e nome preservados. Classe 37/345 e suíte 51/399 passaram; contagens
preservadas. Explicação apresentada; entendimento da 6.43 confirmado com
"entendi" em 01/11/2026 e publicada em d56c185. Na 6.44, teste com provider
confere busca literal por %, _, [, apóstrofo, +, & e string '0', com query
codificada por http_build_query, único ativo correspondente e texto nos links.
Classe 44/436 e suíte 58/490 passaram; contagens preservadas. Explicação
apresentada; entendimento da 6.44 confirmado com "entendi" em 01/11/2026 e
publicada em 2adfac2. Na 6.45, teste com Caneca ativa e Camiseta inativa exige
busca por camiseta com 200, data [], total 0, last_page 1, posições null e links
filtrados. Classe 45/449 e suíte 59/503 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.45 confirmado com "entendi" em
01/11/2026 e publicada em be303c9. Na 6.46, teste cria onze Camisetas ativas,
uma Caneca ativa e uma Camiseta inativa. Busca filtrada na página 3 exige data
vazia, total 11, última página 2, posições null e links com nome. Classe 46/462
e suíte 60/516 passaram; contagens preservadas. Explicação apresentada;
entendimento da 6.46 confirmado com "entendi" em 01/11/2026 e publicada em
466053a. Na 6.47, provider nomesLiterais recebe 100 letras a e 100 letras á;
mesmo teste exige único ativo correspondente, total 1 e links com texto.
Classe 48/488 e suíte 62/542 passaram; contagens preservadas. Explicação
apresentada; entendimento da 6.47 confirmado com "entendi" em 01/11/2026 e
publicada em 716032b. Na 6.48, provider de quatro buscas confere distinção de
acentos e comparação sem diferença de caixa: tenis/TENIS e tênis/TÊNIS.
Exige objeto exclusivo, total e links com texto preservado. Classe 52/540 e
suíte 66/594 passaram; contagens preservadas. Explicação apresentada;
entendimento da 6.48 confirmado com "entendi" em 01/11/2026 e publicada em
35c4bac. Na 6.49, teste de navegação filtrada ampliado: quatro opções em
meta.links nas duas páginas, com url/page/active e filtro preservado, sem
labels fixos. Classe 52/566 e suíte 66/620 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.49 confirmado com "entendi" em
01/11/2026 e publicada em ddfbada. Na 6.50, introdução e desenho do OpenAPI:
JSON, versão planejada 3.2.1, identificação/revisão e escopo da listagem com
page/nome, 200 e 422. Somente documentação; código/contrato/fontes oficiais,
diff e links conferidos. Documento formal ainda não criado; última suíte é
66/620 da 6.49. Explicação apresentada; entendimento da 6.50 confirmado com
"entendi" em 01/11/2026 e publicada em 697f841. Na 6.51, criado esqueleto de
docs/api/openapi.json com identificação, servidor local e paths objeto vazio.
PHP no Docker confirmou sintaxe e leitura dos metadados; nenhum validador
OpenAPI automatizado ou nova suíte executado. Última suíte é 66/620 da 6.49.
Explicação apresentada; entendimento da 6.51 confirmado com "entendi" em
01/11/2026 e publicada em 5bcb430. Na 6.52, OpenAPI recebeu a operação
GET /api/v1/produtos com summary, operationId listarProdutos e descrições de
respostas 200/422. PHP Docker conferiu sintaxe e leitura; método/caminho/status
confrontados com contrato/código. Ainda sem parâmetros/schemas ou validador
OpenAPI; última suíte 66/620 da 6.49. Explicação apresentada; entendimento da
6.52 confirmado com "entendi" em 01/11/2026 e publicada em 104f8d6. Na 6.53,
page descrito na query: opcional, inteiro de 1 a 1000000, padrão 1; descrição
registra normalização, regra lexical, vazio inválido e página após a última.
PHP Docker leu sintaxe/campos; conferido contra Form Request/contrato. Sem
validador OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação
apresentada; entendimento da 6.53 confirmado com "entendi" em 01/11/2026 e
publicada em b4aa821. Na 6.54, nome como segundo parâmetro: query opcional,
string de 1–100 caracteres, sem default e descrição de normalização/busca
literal/caixa/acentos/links. PHP Docker leu JSON/campos, comparados com código
e contrato. Sem validador OpenAPI ou nova suíte; última suíte 66/620 da 6.49.
Explicação apresentada; entendimento da 6.54 confirmado com "entendi" em
01/11/2026 e publicada em 2210731. Na 6.55, criado components.schemas.Produto:
object, required dos três campos e properties com integer/string/integer;
preço em centavos. PHP Docker leu JSON/campos; conferido contra resource/model/
migration/contrato. Ainda sem referência nas respostas ou validador OpenAPI;
última suíte 66/620 da 6.49. Explicação apresentada; entendimento da 6.55
confirmado com "entendi" em 01/11/2026 e publicada em 9930c33. Na 6.56,
resposta 200 recebeu corpo application/json/object/data obrigatório, array
até dez itens com $ref para Produto. PHP Docker leu campos e percorreu a
referência local. Descrição parcial; links/meta virão depois. Sem validador
OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação apresentada;
entendimento da 6.56 confirmado com "entendi" em 01/11/2026 e publicada em
d1a7b18. Na 6.57, links obrigatório no corpo 200: object com quatro campos
obrigatórios, first/last string e prev/next string ou null. PHP Docker leu
JSON/campos, comparados com contrato/teste existente. Meta será descrito depois;
sem validador OpenAPI ou nova suíte, última suíte 66/620 da 6.49. Explicação
apresentada; entendimento da 6.57 confirmado com "entendi" em 01/11/2026 e
publicada em 12acc7e. Na 6.58, meta obrigatório com sete campos básicos:
página/tamanho/total/última/posições/path, tipos e limites; per_page const 10,
from/to inteiro ou null. PHP Docker leu JSON/campos; conferido contra contrato/
testes/serviço. Meta.links será posterior. Sem validador OpenAPI ou nova suíte;
última suíte 66/620 da 6.49. Explicação apresentada; entendimento da 6.58
confirmado com "entendi" em 01/11/2026 e publicada em 5b108b2. Na 6.59,
meta.links obrigatório, lista de objetos com url/label/page/active obrigatórios,
tipos e descrições; label e quantidade da lista livres, active boolean.
PHP Docker leu JSON/campos, conferidos contra contrato/teste. Sem validador
OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação apresentada;
entendimento da 6.59 confirmado com "entendi" em 01/11/2026 e publicada em
4e8f8ed. Na 6.60, corpo 422 application/json/object com message/errors
obrigatórios; errors é dicionário de campo para listas de textos, com ao menos
um campo e uma mensagem por campo, sem traduções fixas. PHP Docker leu JSON/
campos, conferidos contra código/contrato/testes. Sem validador OpenAPI ou nova
suíte; última suíte 66/620 da 6.49. Explicação apresentada; entendimento
da 6.60 confirmado com "entendi" em 01/11/2026 e publicada em 6ace636.
Na 6.61, Redocly CLI 2.65.0/imagem por digest e redocly.yaml/extends spec.
Documento passou em Docker com código 0; duas cópias inválidas rejeitadas com
código 1 (struct/título e no-unresolved-refs). OpenAPI preservado, sem nova
suíte Laravel; última suíte 66/620 da 6.49. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em a7e7d42. Na 6.62, exemplo 200 completo
com Camiseta e paginação; regra no-invalid-media-type-examples como erro,
allowAdditionalProperties true acompanha schemas abertos. Mesma imagem Docker:
original código 0; cópias com preço texto/nome ausente/per_page 11 rejeitadas
com código 1. Dados ilustrativos, coerência de totais/URLs lida separadamente;
sem captura HTTP, SQL ou nova suíte Laravel. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em 57e7f4a. Na 6.63, exemplo 422 com
message e errors.nome/lista de mensagens ilustrativas; mesma imagem/regra,
documento código 0. Três cópias inválidas rejeitadas com código 1: mensagem
sem lista, lista vazia e objeto errors vazio. Schemas/exemplo 200 preservados;
sem captura HTTP, SQL ou nova suíte Laravel. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em f8aaa6b. Na 6.64, GET /api/v1/produtos/{id}
com summary/operationId, id in path/required true/schema integer mínimo 1 e
limites textuais descritos; respostas 200/404 com descrições, corpos pendentes.
Conferido contra código/testes por leitura. Lint Docker código 0; cópia sem
id declarado rejeitada/código 1. Cópia com required false aceita/código 0:
limitação observada, original true conferido pela especificação. Sem novas
dependências, produção alterada, SQL ou nova suíte Laravel. Entendimento
confirmado com "entendi" em 01/11/2026 e publicada em e1b025b. Na 6.65,
200 individual recebeu content/application/json/schema object, data obrigatório
referenciado a Produto. Sem exemplo permanente na operação. Lint Docker código 0;
exemplos em cópias temporárias: objeto aceito/código 0, lista e sem data
rejeitados/código 1. Limitação da 6.64 continua registrada; original required
true preservado. Sem novas dependências, produção alterada, SQL ou nova suíte
Laravel. Entendimento confirmado com "entendi" em 01/11/2026 e publicada em
087430c. Na 6.66, 404 individual recebeu content/application/json/schema object,
message obrigatório/string; descrição distingue controller e variação em erros
de roteamento, sem frase única no schema. Lint código 0; cópias temporárias
com duas frases aceitas/código 0, message número/ausente rejeitados/código 1.
Sem exemplo permanente, dependências novas, produção alterada, SQL ou nova
suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026 e publicada
em a9e7c41. Na 6.67, example permanente de 200 individual: data objeto com
Camiseta/id 1/preço inteiro 4990, ao lado do schema. Valores ilustrativos,
sem captura HTTP ou inserção no banco. Lint Docker código 0, incluindo regra
de exemplos; schemas/outros contratos preservados. Sem novas dependências,
produção alterada, SQL ou nova suíte Laravel. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em f92bad8. Na 6.68, example permanente
em 404 individual com message Produto não encontrado.; caso do controller,
schema string sem const/enum preserva variação de texto no roteamento.
Lint Docker código 0, incluindo valores do exemplo contra o schema; demais
contratos preservados. Sem captura HTTP, novas dependências, produção alterada,
SQL ou nova suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026
e publicada em cde6351. Na 6.69, plano documentado para respostas produzidas
em testes HTTP Laravel: status/cabeçalho no teste, captura local ignorada,
cópia temporária do OpenAPI com corpo em example e Redocly existente. Conferidos
isolamento de testes, volumes, ignore e quatro schemas por leitura; nenhuma
captura/pipeline implementados ou Docker/SQL/suíte executados. Explicação
apresentada; entendimento confirmado com "entendi" em 01/11/2026 e publicada
em 7cf816f. Na 6.70, teste de inexistente ganhou captura optativa via flag de
processo: limpa arquivo anterior, confere resposta e grava corpo bruto JSON
em storage privado ignorado, validando bytes. Focado sem flag 1/6 sem arquivo;
com marcador/flag 1/8; suíte comum 66/620 passou e preservou captura. SELECTs
antes/depois: loja 0 categorias/1 produto; loja_test 0/0. Sem produção/OpenAPI/
dependências novos. Captura ainda não comparada ao schema. Explicação apresentada;
entendimento confirmado com "entendi" em 01/11/2026 e publicada em a2055b6.
Na 6.71, script Bash controla Docker: remove captura antiga, exige teste atual,
substitui example do 404 em cópia integral temporária e valida com Redocly fixado.
Fluxo passou com teste 1/7/lint 0; cópias sem teste e sem message saíram 1.
Originais/hash/temporários/SELECTs conferidos. Sem novas dependências ou backend
alterado; última suíte completa 6.70, 66/620. Explicação apresentada;
entendimento confirmado com "entendi" em 01/11/2026 e publicada em 6dd65eb.
Na 6.72, teste individual de produto ativo ganhou captura optativa 200, com
flag/arquivo próprios e ID da factory. Sem flag 1/6 e sem arquivo; primeira
opt-in 1/7, segunda 1/8 com captura substituída. Suíte comum 66/620 passou,
hashes 200/404 e contagens dos bancos preservados. Produção/OpenAPI/script 404
inalterados. Captura 200 ainda não comparada ao schema. Explicação apresentada;
entendimento confirmado com "entendi" em 01/11/2026 e publicada em bd05ce0.
Na 6.73, lógica comum em validar-contrato-produto.sh com argumento 200/404;
atalho 404 anterior preservado. Status escolhe teste/flag/arquivo/schema via
case e argv. Fluxo 200 e atalho 404: 1/7/lint 0; argumento inválido 2 e cópia
com preço texto 1 esperados. Preço inteiro na captura original/temporários/SELECTs
conferidos; backend e contrato inalterados, última suíte completa 6.72, 66/620.
Explicação apresentada; entendimento confirmado com "entendi" em 01/11/2026.
Publicação verificada em 371ec88. Na 6.74, teste de produto ativo na listagem
recebeu captura optativa CAPTURAR_CONTRATO_LISTAGEM_200=1, arquivo próprio,
limpeza anterior e corpo bruto completo após assertPaginaUnica. Focado sem flag
1/13 sem arquivo; primeira opt-in 1/14 e segunda 1/15; IDs da factory observados.
Suíte 66/620; hashes das três capturas/SELECTs/ignore conferidos. Produção,
OpenAPI e scripts intactos. Explicação apresentada; entendimento confirmado
com "entendi" em 01/11/2026 e publicada em 8e19c0c. Na 6.75, script recebe
segundo argumento operação (consulta padrão); 200 listagem escolhe teste/flag/
arquivo/caminho próprios. PHP seleciona schema com status/caminho recebidos em
argv; cópia integral troca só example. Listagem 1/14/lint 0, individuais 200/404
1/7/lint 0; combinação inválida 2 e cópias data objeto/sem meta1 esperados.
Originais/temporários/SELECTs/ignore conferidos; backend/OpenAPI intactos,
última suíte 6.74, 66/620. Explicação apresentada; entendimento confirmado
com "entendi" em 01/11/2026 e publicada em d3c76b2. Na 6.76, teste de páginas
inválidas ganhou captura optativa CAPTURAR_CONTRATO_LISTAGEM_422=1 restrita a
page=0, com limpeza anterior e gravação bruta após asserções. Filtro @zero
conferido. Sem flag 1/8 sem arquivo, primeira captura 1/9; conjunto com flag
11/90, negativa 1/8; suíte 66/620. Quatro hashes/SELECTs/ignore conferidos.
Corpo message/errors.page observado; produção/OpenAPI/scripts intactos.
Explicação apresentada; entendimento confirmado com "entendi" em 01/11/2026.
Publicação verificada em c6bca3b. Na 6.77, case listagem:422 escolhe teste@zero,
flag e caminho da listagem, reutilizando captura/cópia integral/Redocly anteriores.
422 listagem 1/9/lint 0; regressões individuais 200/404 1/7/lint 0 e listagem 200 1/14/lint 0.
Combinações inválidas 2; cópias sem errors/page texto 1 esperados. Original,
temporários e SELECTs conferidos; última suíte 6.76, 66/620. Explicação apresentada;
entendimento confirmado com "entendi" em 01/11/2026 e publicada em 1be7f19.
Na 6.78, criado validar-contratos-catalogo.sh com quatro chamadas sequenciais ao
fluxo compartilhado e conclusão somente após sucesso. Desde /tmp, quatro casos
1/7, 1/7, 1/14, 1/9 e lints 0/processo 0. Simulador falhou no segundo caso 23:
sem listagens ou conclusão; originais/capturas/temporários/SELECTs conferidos.
Última suíte 6.76, 66/620. Explicação apresentada; entendimento confirmado com "entendi" em 01/11/2026.
Publicação verificada em 592a00a. Na 6.79, README recebeu pré-requisitos e comandos
da suíte Laravel, preparação da imagem Redocly e execução conjunta dos contratos,
com alcance complementar e links às aulas. Três comandos/imagem/pares/configuração
e 108 links locais conferidos, demais links/diff passaram. Etapa documental sem
nova execução runtime/SQL; última suíte 6.76, 66/620, comando conjunto real 6.78.
Explicação apresentada; entendimento confirmado com "entendi" em 01/11/2026.
Publicação verificada em cbe8ae9. Na 6.80, revisão guiada liga rota, FormRequest
antes de index, min:1/bail, ValidationException/JSON 422, teste e contrato.
Default para page ausente não corrige entrada inválida. Fonte oficial consultada;
focado 1/9/lint 0, corpo/hash/temporários/SELECTs após/ignore conferidos, sem
alteração de backend/scripts/README/OpenAPI. Explicação apresentada; entendimento
confirmado com "entendi" em 01/11/2026 e publicada em 93f05de. Na 6.81, revisão
da listagem válida liga FormRequest/controller/binding/consulta/paginador/Resource,
com fontes oficiais. HTTP real explícito page=1: 200/JSON, 1 item/data-links-meta.
Contrato 200 listagem 1/14/lint 0; teste mantém page omitido/padrão 1 e factory.
Captura/hash/temporários/SELECTs após/ignore conferidos; sem alteração funcional.
Entendimento confirmado com "entendi" em 01/11/2026 e publicada em 37b194d.
Na 6.82, revisão por ID liga rota/filter_var/busca ativa/retorno ?Produto e
Resource 200/JSON 404. Fontes PHP consultadas. Contratos 200/404 1/7/lint 0 cada,
inativo 1/7 com permanência no banco durante cenário. Capturas/hashes/temporários/
SELECTs após/ignore conferidos; sem alteração funcional ou suíte completa nova.
Entendimento confirmado com "entendi" em 01/11/2026 e publicada em 50af388.
Na 6.83, revisão liga normalização/regras/consulta parametrizada com CHARINDEX
antes de contar/paginar e appends com nome validado. 4 testes/89 asserções:
nomes simples/espaços/caixa/parâmetro desconhecido e navegação links.next 10+2,
total filtrado 12 preservado. Quatro hashes/SELECTs após/diff/links conferidos;
sem captura/Redocly novos ou alteração funcional. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em af5cfbd. Na 6.84, consolidação apresentada:
API pública de leitura, responsabilidades, quatro respostas, revisão confirmada
até 6.83, limites e pendências. Route:list 2, suíte completa 66/620 e quatro
contratos 1/7,1/7,1/14,1/9/lints 0/processo 0 passaram; capturas/temporários/SELECTs
antes-depois/ignore/diff/links conferidos. Entendimento da consolidação confirmado
com "entendi" em 01/11/2026; módulo 6 concluído.
Publicação da 6.84 verificada em a1f7e4010b611a4f8884e02e6bcf700b85b0bbda.
Pausa solicitada pelo aluno em 01/11/2026, encerrada pelo pedido de retomada em
03/11/2026. Na 7.1, introdução à autenticação/autorização documentada e apresentada;
route:list detalhado conferiu duas rotas públicas em Docker. Sem nova implementação
de aplicação ou suíte. Entendimento confirmado com "entendi" em 03/11/2026;
publicação conferida em 074fcf9. Na 7.2, estrutura existente de autenticação
apresentada e verificada por diagnóstico em memória e migrate:status;
entendimento confirmado com "entendi" em 03/11/2026 e publicação em 801016c.
Na 7.3, SQL inspecionado sem aplicar a migration; entendimento confirmado com
"entendi" em 03/11/2026 e publicada em cab244e. Na 7.4, migration aplicada
somente em loja_test e verificada; entendimento confirmado com "entendi" em
03/11/2026 e publicada em 65880d0. Na 7.5, teste de persistência de User criado
e verificado; entendimento confirmado com "entendi" em 03/11/2026.
Publicação conferida em 5f0b13b. Na 7.6, teste de hash persistido apresentado
e verificado; entendimento confirmado com "entendi" em 03/11/2026.
Publicação conferida em 718f0e3. Na 7.7, teste da serialização do User apresentado
e verificado; entendimento confirmado com "entendi" em 03/11/2026.
Publicação conferida em e21e732. Na 7.8, sessão/cookie explicados e configuração/
middlewares conferidos; entendimento confirmado com "entendi" em 03/11/2026.
Publicação conferida em c5008fd. Na 7.9, CSRF e comparação origem/token apresentados
e verificados em memória; entendimento confirmado com "entendi" em 03/11/2026.
Publicação conferida em f082f80. Na 7.10, papel do Sanctum explicado e ausência
do pacote/configuração atual conferidos; entendimento confirmado com "entendi"
em 04/11/2026 e publicação em 63c0f1e. Na 7.11, pacote instalado/verificado;
entendimento confirmado com "entendi" em 04/11/2026 e publicação em 0cf2c82.
Na 7.12, symfony/mime corrigido e verificado; entendimento confirmado com
"entendi" em 04/11/2026 e publicação em 99a131d. Na 7.13, Sanctum descoberto,
provider/rota conferidos, entendimento confirmado com "entendi" em 04/11/2026.
Publicação conferida em cc016c4. Na 7.14, resposta HTTP/cookies/sessão de visitante
conferidos; entendimento confirmado com "entendi" em 04/11/2026.
Publicação conferida em 601c103. Na 7.15, statefulApi habilitado/verificado;
entendimento confirmado com "entendi" em 04/11/2026 e publicação em 4674279.
Na 7.16, contrato da consulta do próprio usuário desenhado e exemplos verificados;
entendimento confirmado com "entendi" em 04/11/2026 e publicação em 833c010.
Na 7.17, UsuarioResource criada, explicada e verificada em memória; suíte 67/635.
Entendimento confirmado com "entendi" em 04/11/2026 e publicação em 8cceb30.
Na 7.18, UsuarioController::show criado/explicado/verificado em memória e suíte
67/635 passou. Entendimento confirmado com "entendi" em 04/11/2026; publicada
em 6523c31. Na 7.19, rota protegida e bootstrap ajustados; visitante/401 JSON
conferido nos três casos de Accept, suíte 67/635. Entendimento confirmado com
"entendi" em 04/11/2026 e publicação em 5d6a4d8. Na 7.20, teste de visitante
com três entradas criado/explicado: focado 3/18 e suíte 70/653 passaram.
Entendimento confirmado com "entendi" em 04/11/2026 e publicação em c17ad9e.
Na 7.21, cenário autenticado com User em loja_test/actingAs web apresentado:
focado 4/26, suíte 71/661 e rollback conferidos. Entendimento confirmado com
"entendi" em 04/11/2026 e publicação em 02a4b08. Na 7.22, cenário ampliado com
segundo usuário/query de terceiro; focado 4/27, suíte 71/662 e rollback conferidos.
Entendimento confirmado com "entendi" em 04/11/2026 e publicação em fe91e84.
Na 7.23, consulta integrada no OpenAPI com cookie/200/401, lint válido e duas
cópias inválidas rejeitadas. Entendimento confirmado com "entendi" em 04/11/2026
e publicação em a4cd9bc. Na 7.24, contrato do login/204/422 apresentado e exemplos
JSON conferidos; entendimento confirmado com "entendi" em 04/11/2026.
Publicação conferida em 7ee449a. Na 7.25, LoginRequest criada e explicada,
17 casos em memória/zero SQL e suíte 71/662 passaram. Entendimento confirmado
com "entendi" em 04/11/2026 e publicação em ad9f45b. Na 7.26, testes de validação
criados/explicados, focado 17/94 e suíte 88/756 passaram. Entendimento confirmado
com "entendi" em 04/11/2026 e publicação em 7f3e8ed. Na 7.27, LoginController
criado/explicado, três casos guard web/loja_test/sessão array e suíte 88/756 passaram.
Entendimento confirmado com "entendi" em 04/11/2026 e publicação em 10416ad.
Na 7.28, testes do controller criados/explicados: focado 2/47, suíte 90/803 e
rollback conferidos. Entendimento confirmado com "entendi" em 04/11/2026 e
publicação em e6ac54f. Na 7.29, desenho 5/IP/60s/429 apresentado e contador em
memória verificado. Entendimento confirmado com "entendi" em 04/11/2026 e
publicação em d702086. Na 7.30, limitador registrado/explicado/configuração e
callback conferidos; suíte 90/803 passou. Entendimento confirmado com "entendi"
em 04/11/2026 e publicação em 4c5388d. Na 7.31, testes do middleware criados e
explicados, focado 6/156 e suíte 96/959 passaram. Status normal users Pending;
entendimento confirmado com "entendi" em 04/11/2026; publicação em 7c55de4.
Na 7.32, migration de usuários aplicada/explicada em loja via sqlsrv_migracoes,
lote 4, tabelas vazias, reexecução/preservação do catálogo e suíte 96/959 conferidas.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em a79946a.
Na 7.33, rota POST login registrada com throttle:login e explicada; diagnóstico
kernel/testing confirma cinco 422/sexto 429 nos três Accepts; suíte 96/959 passou.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 54cea24.
Na 7.34, LoginApiTest criado/explicado, focado 3/267 e suíte 99/1.226 passaram.
Remove/confere Accept ausente; diagnóstico anterior tinha padrão do construtor.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 019c99b.
Na 7.35, helper do teste isolado corrigido para ausência real de Accept e
presença/valor conferidos; focado 6/236 e suíte 99/1.306 passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 1f0f255.
Na 7.36, sucesso por HTTP adicionado/explicado em LoginApiTest, fixture em
loja_test/transação e sessão/cookie em memória; focado 4/294 e suíte 100/1.333.
Rollback confirmado. Entendimento confirmado com "entendi" em 04/11/2026;
publicação em be62fdf. Na 7.37, credenciais recusadas por HTTP adicionadas/
explicadas em LoginApiTest: mesmo 422/sessão visitante preservada; focado 5/344
e suíte 101/1.383 passaram, rollback conferido. Entendimento confirmado com
"entendi" em 04/11/2026; publicação em 10c260c. Na 7.38, sucesso ampliado para
GET usuario com cookie recebido/memória limpa/guards recriados; 200 exato,
focado 5/357, suíte 101/1.396 e rollback conferidos. Entendimento confirmado
com "entendi" em 04/11/2026; publicação em 29e7b03. Na 7.39, controle sem cookie
adicionado/explicado: 401 JSON/sessão visitante, focado 5/368 e suíte 101/1.407,
rollback conferido. Entendimento confirmado com "entendi" em 04/11/2026;
publicação em 9b7c8dd. Na 7.40, protocolo CSRF fora de testing desenhado e
explicado, fontes/código/configuração conferidos; sem pedidos HTTP ou nova
suíte. Entendimento confirmado com "entendi" em 04/11/2026; publicação em 655a17b.
Na 7.41, protocolo HTTP 204/419/419/422 executado/explicado, CSRF ativo em servidor
temporário com coleta desativada só nele; uma sessão própria removida/54
anteriores preservadas. Entendimento confirmado com "entendi" em 04/11/2026;
publicação em 091ba33. Na 7.42, POST login/corpo JSON/quatro respostas integrados
ao OpenAPI, explicados e validados no Docker; quatro exemplos inválidos
rejeitados/dois permitidos aceitos. Catálogo/schemas anteriores/segurança da
consulta preservados; descrição da consulta atualizada. Entendimento confirmado
com "entendi" em 04/11/2026; publicação em 5f2b770. Na 7.43, contrato de logout
por sessão desenhado/explicado: POST, 204 também para visitante com sessão/CSRF
válidos, 419 na rejeição e 401 na consulta posterior. Fontes oficiais/código
instalado conferidos; sem executar logout. Entendimento confirmado com "entendi"
em 04/11/2026; publicação em 86ab952. Na 7.44, destroy criado/explicado e verificado
diretamente nos casos autenticado/visitante com sessão array e transações em
loja_test; 13 condições por caso passaram. Suíte existente 101/1.407 e SQL final
sem dados. Entendimento confirmado com "entendi" em 04/11/2026; publicação em
b206ca5. Na 7.45, teste permanente de logout autenticado adicionado/explicado,
com limpeza/renovação/remoção do registro antigo e recarga visitante na sessão
array. Focado 3/76, suíte 102/1.436 e SELECT final sem dados passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 3014af2.
Na 7.46, teste permanente de logout visitante adicionado/explicado: visitante
inicial, 204 vazio/limpeza/renovação e recarga da sessão array. Focado 4/104,
suíte 103/1.464 e SQL final sem dados passaram. Entendimento confirmado com
"entendi" em 04/11/2026; publicação em fc3c8e9. Na 7.47, rota de logout ligada
a destroy e middleware conferido, sem auth:sanctum/throttle:login. Visitante
204 vazio/sem Location nos três Accept pelo kernel/testing, sessão/cache array,
sem exercer CSRF. Suíte existente 103/1.464 e SQL posterior sem dados passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em e6c30c6.
Na 7.48, LogoutApiTest criado/explicado: visitante 204 vazio/sem Location nos
três Accept, presença/valor conferidos, sessão/cookies emitidos e ausência de
identidade. Focado 3/57, suíte 106/1.521 e SQL posterior sem dados passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 1ddeaad.
Na 7.49, cenário autenticado pela rota em LogoutApiTest com fixture/transação,
sessão salva/cookie e memória limpa antes do pedido: 204 vazio/invalidação/
novo ID/token. Focado 4/91, suíte 107/1.555 e SQL final sem dados passaram.
Entendimento confirmado com "entendi" em 04/11/2026; publicação em 0eaa7b5.
Na 7.50, consulta GET usuario após logout com cookie da resposta, memória
limpa/guards descartados: 401 JSON/sem Location/somente message string, visitante,
ID/token preservados e chaves ausentes. Focado 4/108, suíte 107/1.572 e SQL final
sem dados passaram. Entendimento confirmado com "entendi" em 04/11/2026;
publicação pendente antes da 7.51 — controle com cookie anterior ao logout.
Exercício sugerido no DBeaver segue sem relato. Módulos 8 a 23 não iniciados.
O estado detalhado e as confirmações ficam em `docs/progresso.md`.

| Módulo | Conteúdo | Entrega verificável |
| --- | --- | --- |
| 1. Preparação, Git e GitHub | Terminal, repositório, `.gitignore`, alterações, commits, branches, push e documentação. | Repositório público com roteiro e controle de progresso. |
| 2. Docker desde o começo | Imagens, containers, Dockerfile, Compose, portas, redes, volumes, variáveis, logs e comandos. | Ambiente PHP mínimo funcionando e compreendido. |
| 3. PHP moderno e OOP | Tipos, interfaces, encapsulamento, composição, herança, exceções, enums, namespaces, Composer e autoload. | Pequenas regras da loja em PHP com primeiros testes PHPUnit. |
| 4. Laravel e MVC | Estrutura, Artisan, ciclo da requisição, rotas, controllers, models, views, middleware, container e injeção de dependências. | Primeiras rotas e uma pequena página Blade para entender MVC. |
| 5. SQL Server e persistência | Modelagem, chaves, relacionamentos, SQL, joins, migrations, seeders, factories, Eloquent e Query Builder. | Catálogo persistido em SQL Server no Docker. |
| 6. APIs REST | HTTP, recursos, métodos, status, validação, serialização, paginação, filtros, erros e OpenAPI. | API de catálogo documentada e testada. |
| 7. Autenticação e autorização | Sanctum, cookies, sessões, CSRF, CORS, hashing, policies e permissões. | Acesso de clientes e administradores com operações protegidas. |
| 8. HTML5, CSS3 e JavaScript moderno | Semântica, acessibilidade, formulários, Flexbox, Grid, responsividade, módulos, promises, `async/await` e `fetch`. | Protótipo da vitrine consumindo a API. |
| 9. React na prática | JSX, componentes, props, estado, eventos, hooks, efeitos, formulários, carregamento e erros. | Vitrine e carrinho em laboratório React com Vite. |
| 10. TypeScript e Next.js | Tipagem, interfaces, App Router, layouts, navegação, componentes de servidor e cliente, renderização e cache. | Interface principal em Next.js, reaproveitando o aprendizado de React. |
| 11. Integração Laravel + Next.js | URLs internas e públicas dos containers, autenticação, consumo da API, erros e configuração por ambiente. | Login, catálogo e administração funcionando pela interface. |
| 12. Pedidos e regras de negócio | Checkout, cálculo de valores, estados, transações, concorrência e controle de estoque. | Compra completa com pagamento simulado e proteção contra venda sem estoque. |
| 13. PHPUnit em profundidade | Testes unitários, de integração e HTTP, doubles, factories, isolamento e regressões. | Testes dos comportamentos críticos de catálogo, acesso e pedidos. |
| 14. Clean Code, SOLID e Design Patterns | Responsabilidades, dependências, legibilidade, Strategy, Factory e Adapter. | Refatorações motivadas por problemas reais e protegidas por testes. |
| 15. Domain Driven Design | Linguagem do domínio, entidades, objetos de valor, agregados, casos de uso e bounded contexts. | Laravel organizado em módulos de catálogo, pedidos e estoque. |
| 16. Filas no Laravel | Jobs, workers, Redis, processamento após commit, retries, backoff, timeouts e jobs com falha. | Tarefas demoradas executadas fora da requisição HTTP. |
| 17. EDA e RabbitMQ | Eventos, produtores, consumidores, exchanges, filas, routing keys, confirmação, duplicidade e mensagens com falha. | Eventos de pedidos distribuídos pelo RabbitMQ. |
| 18. Node.js como backend | Runtime, npm, assincronismo, Express, configuração, consumo de eventos, logs e testes. | Serviço independente de notificações em Node.js/TypeScript. |
| 19. Microsserviços na prática | Extração gradual, propriedade dos dados, REST, comunicação assíncrona, contratos e implantação independente. | Estoque em Laravel separado do serviço de pedidos. |
| 20. Confiabilidade distribuída | Idempotência, consistência eventual, outbox, compensações, indisponibilidade e correlação de logs. | Pedidos tratados corretamente com falhas e eventos repetidos. |
| 21. AWS: S3, SNS e SQS | SDK, imagens, tópicos, assinaturas, filas, políticas de acesso, retries e dead-letter queues. | Integrações preparadas e testadas localmente; validação real na etapa de nuvem. |
| 22. AWS: ECS, Fargate e RDS | ECR, imagens de produção, tarefas, serviços, rede, secrets, logs, RDS SQL Server e persistência. | Aplicação implantada no ECS usando Fargate. |
| 23. CI/CD e portfólio | GitHub Actions, verificações, build, publicação de imagens, deploy, rollback e documentação. | Projeto reproduzível e demonstrável, com explicação da arquitetura. |

RabbitMQ será o broker implementado. Kafka será estudado por comparação de logs,
partições, offsets e grupos de consumidores com RabbitMQ e SNS/SQS.

## Arquitetura e versões acordadas

Começaremos com um backend Laravel e o dividiremos gradualmente em módulos.
Depois extrairemos estoque e notificações, preservando checkpoints funcionais.

- Next.js/React: vitrine e painel administrativo.
- Laravel: catálogo, clientes e pedidos.
- Laravel independente: estoque.
- Node.js/TypeScript: notificações.
- SQL Server: persistência, com bancos separados por serviço após a extração.
- Redis: filas Laravel iniciais; RabbitMQ: eventos entre serviços localmente.
- AWS: S3 para arquivos, SNS/SQS para mensageria, RDS para SQL Server,
  ECR para imagens e ECS/Fargate para execução.

As APIs de negócio começarão sob `/api/v1`. Contratos REST e de eventos serão
documentados quando introduzidos. Cada serviço acessará seus próprios dados;
a comunicação entre serviços ocorrerá por contratos.

Versões iniciais: Laravel 13, PHP 8.4, Node.js 24 LTS e Next.js 16 com App Router.
A imagem PHP terá ODBC e as extensões `sqlsrv` e `pdo_sqlsrv`. Versões de imagens
e dependências serão fixadas na introdução de cada ferramenta e sua
compatibilidade será verificada na instalação.

Fontes oficiais consultadas no planejamento:

- [Laravel 13 e requisitos de PHP](https://laravel.com/docs/13.x/releases).
- [Laravel e SQL Server](https://laravel.com/docs/13.x/database#microsoft-sql-server-configuration).
- [Requisitos dos drivers PHP para SQL Server](https://learn.microsoft.com/en-us/sql/connect/php/system-requirements-for-the-php-sql-driver).
- [Versões Node.js](https://nodejs.org/en/about/previous-releases).
- [Next.js 16](https://nextjs.org/blog/next-16).

## Ambiente e verificações

PHP, Composer, Node, npm, testes e serviços do projeto rodarão em Docker.
Editor, Git e comandos de controle do Docker podem ficar no host. Containers
serão adicionados conforme as aulas precisarem deles.

Verificaremos progressivamente acesso ao Docker, volumes, respostas e permissões
da API, interface, transações, concorrência, retries, eventos duplicados e deploy.
Testes de integração usarão banco SQL Server exclusivo para testes.

Pagamentos serão simulados. A prática será local primeiro. Ao chegar à AWS,
definiremos conta, região e limite de gastos antes de criar recursos pagos;
testes locais com doubles não comprovarão a integração real com AWS.

## Continuidade e publicação

`AGENTS.md` orienta as próximas sessões. `docs/progresso.md` registra a aula atual,
explicações, confirmações, dúvidas, verificações, publicação e próximo passo.
Código funcionando não significa conteúdo aprendido. É possível encerrar uma
sessão com uma etapa implementada e aguardando entendimento.

O repositório novo será público, com nome sugerido `curso-loja-fullstack`.
Cada checkpoint concluído terá commit e push; falhas de publicação serão
registradas. Credenciais e dados privados não entrarão no repositório.

A primeira aula começa pelos registros e pela pasta de trabalho. Depois
iniciaremos Git/GitHub, diagnosticaremos o acesso ao Docker e construiremos
o primeiro container PHP, explicando cada instrução antes de adicionar serviços.
