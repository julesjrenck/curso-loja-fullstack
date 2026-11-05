# Aula 7.53 — Verificação de CSRF do logout por HTTP

Execução, explicação e verificações em 04/11/2026, após confirmação da 7.52
com "entendi". Checkpoint anterior publicado e conferido em
2d67af17863a580cb3686cffd0f580d002a722f0; HEAD/origin/main/main remota iguais.
Entendimento da 7.53 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivos

Executamos o [protocolo de CSRF do logout](../api/verificacao-csrf-logout.md),
complementando o [contrato](../api/logout.md). Diagnóstico temporário
/tmp/curso-7-53-csrf-logout.php no host, não versionado, adaptado da 7.41.
Nenhuma alteração persistente em aplicação, configuração, ambiente, dependência,
serviço, rota, migration, teste ou OpenAPI.

## Servidor e condições do pedido

PHP no Docker carregou configuração local, sessão file/json e cache file;
coleta habitual [2,100] exigida antes de iniciar. Guardamos nomes/hashes dos
arquivos anteriores em memória; 54 arquivos de sessão identificados.
Servidor PHP temporário no loopback/porta dinâmica, com bootstrap/kernel/rotas
normais. Somente nesse processo, session.lottery [0,100] preservou os arquivos.

ProcOpen iniciou PHP -S; prontidão conferida por TCP, sem pedido HTTP extra.
Guzzle com CookieJar em memória, sem proxy/redirecionamentos, http_errors false
e timeout de dez segundos. Host/Origin 127.0.0.1:8002 e Accept JSON mantidos.
POSTs com JSON {}, sem Sec-Fetch-Site, _token, X-CSRF-TOKEN ou credenciais.
Somente X-XSRF-TOKEN variou entre os controles.

Metadados a cada pedido confirmaram ambiente local/console false/testing false,
sessão file/coleta [0,100], classe CSRF ativa/exceções vazias/originOnly false/
allowSameSite false, origem reconhecida e cabeçalhos/cookies/corpo esperados.
Listener de consultas contou zero instruções SQL durante cada pedido.
Metadados privados e respostas brutas não foram impressos.

## Resultados observados

| Pedido | Resultado verificado |
| --- | --- |
| GET csrf-cookie | 204 vazio; cookies de sessão e XSRF-TOKEN recebidos. |
| POST logout sem X-XSRF-TOKEN | 419 JSON/message string/sem Location; ID/token preservados. |
| POST logout com valor inválido | Mesmo 419 e preservação de ID/token. |
| POST logout com valor correto | 204 vazio/sem Location; ID/token renovados e registro antigo destruído. |

O valor correto foi o XSRF-TOKEN URL-decodificado, acompanhado do cookie da
mesma sessão. Nos erros, conferimos message como string sem fechar possíveis
campos de diagnóstico. Nenhuma credencial foi fornecida.

Nos quatro estados de sessão examinados, não havia chave de login. O sucesso
mantém visitante, conforme contrato. A resposta final emitiu ambos os cookies
atualizados; o token do cookie CSRF decifrado internamente correspondeu ao token
novo do arquivo de sessão. IDs/tokens foram comparados somente em memória.

## Limpeza e preservação

Dois IDs próprios foram identificados a partir dos cookies, com formato válido
e ausência na lista anterior. O logout já destruiu o arquivo do ID inicial.
Finally encerrou o servidor e removeu a sessão própria restante e os auxiliares
router/metadados. Nenhum arquivo anterior foi removido.

Comparação de nomes/hashes depois da limpeza foi exatamente igual à inicial.
Diagnóstico retornou sucesso true/código 0. Em novo processo, leitura confirmou
local/file, coleta habitual [2,100], 54 sessões e nenhum auxiliar curso-753-*.
Nenhuma configuração persistente ou contador foi alterado.

## Comandos e alcance

```sh
docker compose exec -T backend php -l < /tmp/curso-7-53-csrf-logout.php
docker compose exec -T backend php < /tmp/curso-7-53-csrf-logout.php
```

Exec -T executa no serviço backend sem terminal interativo. Redirecionamento
envia o script do host ao PHP do container; -l confere sintaxe sem executá-lo.
Sintaxe válida, código 0; execução também código 0. O próprio script cria e
encerra o servidor temporário e confere suas condições/limpeza.

Foi HTTP com CSRF ativo fora de testing e sessão visitante. Não verifica
políticas de cookies, CORS ou Fetch Metadata de navegador. Os testes anteriores
cobrem logout autenticado e consultas posteriores pelo kernel/testing.
Não executamos nova suíte Laravel, consulta SQL, auditoria ou snapshot do banco.
Última suíte permanece 7.51: 107 testes/1.586 asserções.

Git diff --check passou. Links locais válidos: logout quatro, login cinco,
consulta seis, protocolo de login quatro, protocolo de logout três, aulas
7.52/7.53 três e dois respectivamente. Somente documentos alterados, índice
vazio; backend/Compose/OpenAPI preservados.

## Continuidade

Protocolo executado, explicado e verificado; entendimento confirmado em 05/11/2026.
Registros e contratos atualizados; backend/Compose/OpenAPI preservados.
Publicação da 7.53 pendente. Próxima após confirmar/publicar: 7.54 — integrar
POST /api/v1/logout ao OpenAPI, entrada sem corpo obrigatório, sessão/CSRF,
respostas 204 sem content e 419 JSON, validando documento/esquemas/exemplos.
Navegador/CORS seguem pendentes.
