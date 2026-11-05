# Aula 7.51 — Consulta com cookie anterior ao logout

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.50 com "entendi". Checkpoint anterior publicado e conferido em
592581d627d43f5f88923b4f12e16a17ddb685a0; HEAD/origin/main/main remota iguais.
Entendimento da 7.51 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Ampliamos somente o mesmo cenário de
[LogoutApiTest](../../backend/tests/Feature/LogoutApiTest.php), conforme o
[contrato de logout](../api/logout.md). Renomeamos o método para mencionar
consultas com cookies novo e antigo. Preparação, visitante/DataProvider e
asserções anteriores continuam iguais; aplicação e rotas não mudaram.

| Pedido após logout | Resultado exigido |
| --- | --- |
| GET usuario com cookie recebido na resposta | 401 JSON, controle preservado da 7.50. |
| GET usuario com ID anterior ao logout | 401 JSON, controle novo da 7.51. |

O cookie identifica a sessão. O controle exige que os dados de autenticação
removidos não reapareçam quando o cliente reenviar o identificador antigo.

## Confirmar remoção e reenviar o identificador

Antes da nova consulta, exigimos novamente read vazio para idAnterior no handler
array. Isso mostra que a consulta anterior com cookie novo não restaurou o
registro antigo. Flush limpa atributos só em memória e forgetGuards descarta
os guards. A sessão será carregada pelo próximo pedido.

```php
$consultaCookieAnterior = $this->withCookie(config('session.cookie'), $idAnterior)
    ->withCredentials()
    ->getJson('http://127.0.0.1:8002/api/v1/usuario', [
        'Origin' => 'http://127.0.0.1:8002',
    ]);
```

WithCookie substitui o ID usado na consulta anterior. O helper prepara a
criptografia do cookie para Laravel; reenviamos o identificador antigo, sem
comparar bytes de cookies cifrados. WithCredentials inclui cookies no helper
JSON, com a mesma origem reconhecida. Não é uma requisição de navegador.

## Resposta e identidade

Exigimos 401, Content-Type application/json, sem Location e corpo com somente
message string. A mensagem não fica presa a um idioma ou texto específico.
Conferimos que a Request recebeu efetivamente o ID anterior, não possui
Authorization e tem sessão anexada. Guard web visitante/ID null e ausência
das chaves de identidade/marcador confirmam o estado após a consulta.

O teste não exige que o cookie seja recusado pela criptografia, nem fixa qual
ID/token uma sessão visitante terá ao carregar um identificador sem dados.
O resultado exigido é ausência de autenticação recuperada, com acesso negado
pela rota protegida. Read vazio foi conferido antes do reenvio; não prometemos
que nunca possa existir novamente um registro visitante sob aquele ID.

## Verificações no Docker

```sh
docker compose exec -T backend php -l tests/Feature/LogoutApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LogoutApiTest.php --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

PHP -l confere sintaxe; primeiro PHPUnit seleciona o arquivo, segundo roda a
suíte completa. Exec -T usa backend sem terminal interativo; colors never evita
escapes e do-not-cache-result evita gravar cache de resultados.

Sintaxe válida; focado 4 testes/122 asserções e suíte 107 testes/1.586 asserções,
códigos 0. Mesmo número de testes, 14 asserções adicionadas à 7.50.
SELECT posterior exigiu loja_test/loja_testes e confirmou seis tabelas, quatro
migrations/lotes 1/2/3/4 (int explícito) e zero categorias/produtos/users/
password_reset_tokens/sessions. DatabaseTransactions preservado e rollback
conferido; sessão/cache em memória. Sem valores reais de senha/hash/cookie/
token/ID impressos ou versionados.

Git diff --check passou. Links locais válidos: logout três, login quatro,
consulta cinco, aulas 7.50/7.51 dois cada. Escopo conferido: somente LogoutApiTest
e documentos; índice vazio. Aplicação/rotas/controller/bootstrap/Compose/OpenAPI
sem diff, OpenAPI ainda sem logout.

## Continuidade

Cenário ampliado, explicado e verificado; entendimento confirmado em 04/11/2026.
Aplicação, rotas, controller, bootstrap, ambientes, dependências, serviços,
migrations, Compose e OpenAPI preservados. Sem auditoria/snapshot normal ou
diagnóstico temporário repetidos. CSRF ativo/navegador/CORS pendentes.
Publicação da 7.51 pendente. Próxima após confirmar/publicar: 7.52 — desenhar
protocolo HTTP de CSRF do logout fora de testing: visitante, origem reconhecida,
cookies em memória, controles sem header/inválido/correto esperados 419/419/204,
com preservação e limpeza das sessões. Não executar esse protocolo antes de
apresentá-lo e aguardar entendimento. OpenAPI de logout permanece pendente.
