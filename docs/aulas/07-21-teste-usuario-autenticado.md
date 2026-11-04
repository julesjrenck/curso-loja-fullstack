# Aula 7.21 — Teste da consulta do usuário autenticado

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.20 com "entendi". Checkpoint anterior publicado e conferido em
c17ad9e3030d2c5060689b767136ed321d1e3e99; HEAD/origin/main/main remota iguais.
Entendimento da 7.21 confirmado com "entendi" em 04/11/2026.

## Objetivo e alteração

Ampliamos somente [UsuarioApiTest](../../backend/tests/Feature/UsuarioApiTest.php)
com um cenário autenticado da consulta GET /api/v1/usuario. Ele verifica o
[contrato de sucesso](../api/autenticacao.md) através da rota real da aplicação,
preparando a autenticação pelo helper de teste antes do pedido.
Código de aplicação permanece como estava.

Importamos User, DatabaseTransactions e DB. O trait DatabaseTransactions agora
é usado pela classe inteira: abre uma transação por execução e registra rollback
ao encerrar. Isso também envolve os três cenários de visitante, embora eles não
criem usuários. Não recriamos tabelas nem rodamos migrations.

## Preparação dos dados

O novo método test_usuario_autenticado_recebe_seus_dados_em_json consulta
DB_NAME()/SUSER_SNAME() e exige loja_test/loja_testes antes de DELETE/INSERT,
seguindo UserPersistenciaTest. Se a identidade divergir, o teste falha antes da
escrita. User::query()->delete() limpa usuários somente dentro da transação.

```php
$usuario = User::query()->create([
    'name' => 'Ana Exemplo',
    'email' => 'ana@example.test',
    'password' => 'senha-ficticia-do-teste',
]);

$this->assertIsInt($usuario->getKey());
$this->assertGreaterThan(0, $usuario->getKey());
```

Create persiste o usuário fictício; o cast hashed já estudado trata a senha.
Não é uma senha real ou compartilhada. GetKey fornece o ID gerado pelo banco;
as asserções exigem inteiro positivo. Não fixamos um número: SQL Server IDENTITY
pode avançar mesmo após rollback. Nome/e-mail são entradas conhecidas do cenário.

## Preparação da autenticação e resposta

```php
$resposta = $this->actingAs($usuario, 'web')->getJson('/api/v1/usuario');

$resposta
    ->assertStatus(200)
    ->assertHeader('Content-Type', 'application/json')
    ->assertExactJson([
        'data' => [
            'id' => $usuario->id,
            'name' => 'Ana Exemplo',
            'email' => 'ana@example.test',
        ],
    ]);
```

ActingAs coloca esse User como usuário atual do guard web para o teste, que
também se torna o guard padrão naquele contexto. O guard Sanctum da rota
reconhece o usuário do guard web. Não desativamos middleware nem trocamos a
ação por chamada direta. O fluxo passa por rota, auth:sanctum, controller e Resource.
GetJson monta o pedido com Accept JSON e usa o kernel interno, sem rede.

AssertStatus exige 200, assertHeader exige JSON e assertExactJson exige o corpo
inteiro com somente data/id/name/email. Campos extras, como senha ou timestamps,
fazem a comparação falhar. O ID esperado vem do User criado, sem assumir ID 1.

ActingAs é preparação da identidade em teste: não envia senha a um endpoint de
login, não comprova validação de credenciais, renovação de sessão, cookies do
navegador ou CSRF. Persistir User e preparar identidade são passos distintos.

Referência: [actingAs e escolha do guard nos testes Laravel](https://laravel.com/docs/13.x/http-tests#session-and-authentication).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/UsuarioApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UsuarioApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; o arquivo passou com 4 testes/26 asserções. O cenário novo soma
oito asserções: duas de identidade, duas do ID, status, presença/valor do cabeçalho
e JSON exato. Os três casos de visitante continuam passando, após o caso autenticado
na execução padrão, com isolamento da aplicação entre testes.
Suíte completa: 71 testes/661 asserções, código 0 em todos os comandos.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Rollback preservou ausência dos dados fictícios; não desfaz números de IDENTITY.
Sem alteração de model, controller, Resource, rota, bootstrap, ambiente ou
dependências. OpenAPI preservado; integração desta operação continua pendente.
Auditoria, snapshot normal e quatro contratos não foram repetidos.

## Continuidade

Cenário autenticado criado, explicado e verificado; entendimento confirmado
com "entendi" em 04/11/2026; publicação pendente.
Após publicar: 7.22 — ampliar esse cenário com um segundo usuário
persistido e parâmetros id/email dele na consulta, mantendo actingAs no primeiro,
para comprovar que a resposta continua sendo do próprio usuário autenticado.
Login real será introduzido em etapa posterior.
