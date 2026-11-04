# Aula 7.22 — Identidade autenticada e parâmetros do cliente

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.21 com "entendi". Checkpoint anterior publicado e conferido em
02a4b08278e1ba1ed887d529b05e9d6d9f3381c7; HEAD/origin/main/main remota iguais.
Entendimento da 7.22 confirmado com "entendi" em 04/11/2026.

## Objetivo e alteração

Ampliamos o mesmo cenário autenticado de
[UsuarioApiTest](../../backend/tests/Feature/UsuarioApiTest.php). A pergunta é:
se Ana está autenticada e envia ID/e-mail de Bruno, quem a API devolve?
O [contrato](../api/autenticacao.md) exige a própria identidade autenticada.
Mantivemos a resposta esperada de Ana e acrescentamos dados de outro usuário
à requisição. Nenhum código de aplicação foi alterado.

Renomeamos o método para
test_usuario_autenticado_recebe_seus_dados_mesmo_com_parametros_de_outro_usuario,
descrevendo a condição adicional. Continuam quatro execuções nesse arquivo:
um cenário autenticado ampliado e três entradas de visitante.

## Dois usuários persistidos

Após a conferência loja_test/loja_testes e limpeza transacional existentes,
criamos Bruno antes de Ana:

```php
$outroUsuario = User::query()->create([
    'name' => 'Bruno Exemplo',
    'email' => 'bruno@example.test',
    'password' => 'outra-senha-ficticia-do-teste',
]);
```

Ana permanece em $usuario, como na aula anterior. Ambos os dados são fictícios
e persistidos somente dentro da transação do teste. Bruno vem primeiro para
também distinguir o resultado de uma busca incorreta pelo primeiro usuário.
Acrescentamos uma asserção que exige IDs diferentes:

```php
$this->assertNotSame($outroUsuario->getKey(), $usuario->getKey());
```

GetKey fornece cada ID gerado. Não assumimos valores 1/2 nem números consecutivos.
As verificações de ID inteiro positivo de Ana continuam no cenário.

## Dados da URL versus identidade

```php
$consulta = http_build_query([
    'id' => $outroUsuario->id,
    'email' => $outroUsuario->email,
]);

$resposta = $this->actingAs($usuario, 'web')
    ->getJson('/api/v1/usuario?'.$consulta);
```

Http_build_query é uma função PHP que transforma o array em query string,
codificando os valores para a URL; por exemplo, @ no e-mail vira %40 no padrão
usado aqui. O ponto concatena caminho, ? e consulta. Os números concretos vêm
do banco de testes e não são fixos.

ActingAs continua com Ana. Enviar id/email de Bruno não é autenticar Bruno.
O controller usa $request->user(), que consulta a identidade resolvida pelo
guard, e não seleciona um User com esses parâmetros. Nenhum desses parâmetros
é um seletor suportado por esta operação; sua presença é ignorada para a identidade.

As asserções existentes continuam exigindo 200 e Content-Type JSON; assertExactJson
exige somente data/id/name/email de Ana. Se o corpo viesse com os dados de Bruno,
a comparação falharia. Seguimos usando uma única requisição nesse cenário.

Essa verificação protege o comportamento dessa consulta e dessas entradas;
não é uma autorização genérica para consultar outros usuários nem validação
completa de login, sessão/cookie ou todos os parâmetros possíveis.

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/UsuarioApiTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UsuarioApiTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida. Testdox mostrou o novo nome do cenário: arquivo com 4 testes/
27 asserções, código 0. Suíte completa: 71 testes/662 asserções, código 0.
Acrescentamos uma asserção ao cenário existente; a quantidade de testes não mudou.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Os dois usuários foram desfeitos pelo rollback; IDENTITY pode avançar.
Sem alteração de model/controller/Resource/rotas/bootstrap/ambientes/dependências.
OpenAPI preservado; auditoria/snapshot normal/quatro contratos não repetidos.

## Continuidade

Teste ampliado, explicado e verificado; entendimento confirmado com "entendi"
em 04/11/2026; publicação conferida em
fe91e84fdee4c88aac0f31991f82ffac6b92486e, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade na 7.23 — integrar
GET /api/v1/usuario ao OpenAPI existente, documentando autenticação por cookie
e respostas 200/401. Login real continua para etapa posterior.
