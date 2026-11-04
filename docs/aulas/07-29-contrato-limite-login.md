# Aula 7.29 — Desenho do limite de tentativas de login

Desenho, explicação e verificações em 04/11/2026, após confirmação da 7.28
com "entendi". Checkpoint anterior publicado e conferido em
e6ac54f1e3b4a9b69815d641c6a340991f43eeb6; HEAD/origin/main/main remota iguais.
Entendimento da 7.29 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos o [contrato planejado de limitação](../api/limite-login.md), complemento
do [login](../api/login.md). Uma consulta de credenciais consome recursos; a
regra controla a frequência de pedidos antes de chegar ao controller.
Nenhum limitador ou rota foi registrado nesta etapa.

Escolhemos cinco pedidos por IP numa janela de 60 segundos iniciada no primeiro
pedido contado. O sexto recebe 429 enquanto a janela durar. Contam sucesso,
credenciais incorretas e formato inválido que alcancem o limitador. Sucesso não
limpa o contador. Uma rejeição anterior ao limitador não chega a ser contada.

Compartilhar IP significa compartilhar o limite, independentemente do e-mail.
Outro IP tem contador próprio. A regra é local e não bloqueia permanentemente
uma conta. A escolha de capacidade/chave/janela é nossa; Laravel oferece o mecanismo.

## Resposta e tempo de espera

429 expressa excesso de pedidos. Planejamos JSON com somente message string,
sem redirect e sem dados de credenciais. Retry-After informa segundos restantes,
variando conforme o tempo transcorrido. Cache-Control no-store se refere ao
armazenamento da resposta HTTP; o contador do servidor continua existindo.
O documento contém exemplo e linha do tempo completos.

Em t=0, cinco pedidos podem seguir; o sexto espera 60 segundos. Em t=30, outro
pedido bloqueado espera 30 segundos, sem prolongar a janela. Em t=60, pode
seguir e abrir nova janela. Permissão do limitador não autentica ninguém.

## Inspeção da implementação instalada

Fontes oficiais Laravel e RFC 6585 consultadas e citadas no contrato. Reflexão
PHP Docker leu ThrottleRequests::handleRequest/buildException e
RateLimiter::tooManyAttempts/availableIn. O middleware verifica o limite antes
de incrementar e antes de chamar a próxima etapa; resposta personalizada pode
receber os cabeçalhos calculados, incluindo Retry-After. Pedidos bloqueados
não passam por hit. Configuração normal carregada: cache.default file e
cache.limiter null. Não escrevemos contadores nesse cache nem executamos SQL.

## Diagnóstico isolado do contador

PHP Docker apenas com autoload, sem inicializar aplicação: instanciamos
RateLimiter com Repository/ArrayStore próprios. Usamos relógio Carbon controlado,
restaurado em finally; não esperamos 60 segundos reais.
Para cada pedido ilustrativo, consultamos tooManyAttempts e, somente quando
permitido, chamamos hit com 60 segundos. AvailableIn fornece a espera no bloqueio.

Nove casos passaram: cinco permitidos para IP A, sexto bloqueado/60 segundos,
bloqueio após 30 segundos/espera 30, IP B independente permitido e IP A permitido
após 60 segundos. Código 0; sem arquivo, sessão, usuário, HTTP, SQL ou guard.
O diagnóstico segue o fluxo observado do middleware e verifica o mecanismo de
contagem em memória. Não prova uma rota protegida nem resposta 429 real.

O exemplo JSON do novo contrato foi decodificado com JSON_THROW_ON_ERROR no
PHP Docker e formato message string conferido. Sem nova suíte Laravel ou
alteração de aplicação/OpenAPI. Última suíte completa: 7.28, 90/803.

## Continuidade

Contrato apresentado e verificado; entendimento confirmado com "entendi" em
04/11/2026; publicação pendente. Após publicar: 7.30 — registrar
somente o limitador nomeado login em AppServiceProvider::boot, com cinco pedidos
por minuto/IP e resposta 429 JSON/cabeçalhos, verificando sua configuração antes
de registrar ou proteger a rota de login.
