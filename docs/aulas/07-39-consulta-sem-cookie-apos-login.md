# Aula 7.39 — Consulta sem cookie depois do login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.38 com "entendi". Checkpoint anterior publicado e conferido em
29e7b03927e4b6aee20193085e792270c7b51fe6; HEAD/origin/main/main remota iguais.
Entendimento da 7.39 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Ampliamos somente o cenário test_login_valido_renova_sessao_e_permite_consultar_usuario
em [LoginApiTest.php](../../backend/tests/Feature/LoginApiTest.php).
Após POST login/204 e GET usuario com cookie/200, fazemos outro GET sem cookie.
Ele deve receber 401 JSON e continuar visitante. Mesma origem/IP, com nova
resolução dos guards e atributos da sessão retirados da memória.

Não adicionamos métodos, imports ou helpers; preparação do banco, transação,
cache/sessão array, relógio e demais cenários permanecem. Não criamos logout.

## Requisição sem cookie

Primeiro, sessao->flush retira os atributos carregados e Auth::forgetGuards
descarta as instâncias de autenticação, como já estudamos. Não gravamos essa
limpeza no armazenamento antes do GET.

```php
$semCookie = $this->call('GET', 'http://127.0.0.1:8002/api/v1/usuario', [], [], [], [
    'HTTP_ACCEPT' => 'application/json',
    'HTTP_ORIGIN' => 'http://127.0.0.1:8002',
    'REMOTE_ADDR' => '127.0.0.1',
]);
```

Call é helper herdado que cria a Request e executa handle/terminate do kernel.
Depois do método/URL, os três arrays vazios representam parâmetros, cookies e
arquivos. O array final configura cabeçalhos/IP. Usamos explicitamente cookies
vazios: call recebe essa lista diretamente, conforme o código instalado lido.
O withCookie/withCredentials usado no GET anterior não fornece cookies a esta
chamada direta. Não basta omitir withCookie de um novo getJson, pois os valores
preparados antes continuam disponíveis no objeto de teste.

Accept solicita JSON, Origin mantém o fluxo stateful da origem reconhecida e
REMOTE_ADDR mantém o mesmo IP. O cookie que identificava a sessão autenticada
não está neste pedido. O GET não depende da senha enviada no POST anterior.

## Resposta e estado exigidos

Conferimos 401/application/json/sem Location, objeto com somente message string,
sem fixar texto/tradução. A Request deve ter cookies->all exatamente vazio;
essa asserção confirma a preparação do controle.

HasSession deve ser true: o middleware preparou uma sessão para a origem
reconhecida. AssertGuest exige visitante no guard web; a chave interna de
identidade e o marcador da sessão anterior devem estar null. Assim, ter uma
sessão preparada não significa possuir identidade autenticada.

Este controle não chama logout, invalidação ou revogação. Ele representa uma
requisição sem apresentar o cookie necessário para recuperar a identidade.
Não verificamos reutilização posterior do cookie original nesta etapa.

## Verificações em Docker

```sh
docker compose exec -T backend php -l tests/Feature/LoginApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/LoginApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Focado: 5 testes/368 asserções, código 0, antes 5/357.
Suíte completa: 101 testes/1.407 asserções, código 0, antes 101/1.396.
Mesmo número de testes, 11 asserções adicionais no cenário ampliado.
SELECT posterior: loja_test/loja_testes, seis tabelas, quatro migrations/lotes
1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Rollback conferido. Sem nova auditoria, snapshot normal ou quatro contratos.

## Continuidade

Controle implementado, explicado e verificado; entendimento confirmado com "entendi" em 04/11/2026.
Contratos/registros atualizados. Nenhum código de aplicação, configuração,
ambiente, dependência, migration, rota ou OpenAPI alterado. Publicação concluída
e conferida em 9b7c8dd95ff4fc8470d6fe8272b0540c3a5de4eb;
HEAD/origin/main/main remota iguais após push. Registro posterior à publicação.
Kernel HTTP sem rede/navegador; validação CSRF real permanece pendente.
Continuidade realizada na 7.40 — desenhar a verificação de CSRF fora de testing,
definindo origem, cookies, cabeçalhos e casos 419/422 antes de executar pedidos
reais. Não criar usuários no banco normal nessa preparação.
