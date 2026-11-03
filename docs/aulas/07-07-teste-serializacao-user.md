# Aula 7.7 — Ocultação de senha e token na serialização

Implementação, explicação e verificações em 03/11/2026, após confirmação da
7.6 com "entendi". Checkpoint anterior publicado e conferido em
718f0e3a865ee0d444079afb43a1482c2cda38f8; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.7 confirmado com "entendi" em 03/11/2026.

## Objetivo

Ampliamos o mesmo cenário em
[UserPersistenciaTest.php](../../backend/tests/Feature/UserPersistenciaTest.php)
para conferir a representação padrão do usuário em array e JSON. O
[model User](../../backend/app/Models/User.php) já possui:

```php
#[Hidden(['password', 'remember_token'])]
```

O atributo Hidden exclui esses campos da representação padrão serializada.
Os valores continuam armazenados e acessíveis no objeto. O cast hashed,
estudado na 7.6, trata a senha atribuída; Hidden controla sua inclusão na saída.
Nenhum model, configuração, dependência ou rota foi alterado.

## Token presente antes da conversão

Depois de create, acrescentamos:

```php
$usuario->remember_token = 'token-ficticio-do-teste';
$usuario->save();
```

O token é exclusivamente fictício. A atribuição direta configura o atributo
do model; save grava essa alteração na linha existente. remember_token não
está em Fillable, por isso não o incluímos no array de preenchimento em massa
de create. Essa atribuição explícita é código controlado do cenário.

Depois de findOrFail e das verificações de hash já existentes, exigimos:

```php
$this->assertSame('token-ficticio-do-teste', $consultado->remember_token);
```

Assim o teste comprova que o token realmente chegou ao banco e voltou na nova
consulta. A senha já foi conferida como hash na 7.6. Não estamos verificando
a ocultação apenas de atributos vazios ou ausentes do objeto.

## Array e JSON

```php
$dados = $consultado->toArray();

$this->assertSame('Ana Exemplo', $dados['name']);
$this->assertSame('ana@example.test', $dados['email']);
$this->assertArrayNotHasKey('password', $dados);
$this->assertArrayNotHasKey('remember_token', $dados);
```

toArray produz um array PHP com a representação do model. As duas primeiras
asserções conferem dados visíveis, evitando aceitar uma saída vazia. As duas
seguintes exigem ausência das chaves, não apenas valores null.

```php
$dadosJson = json_decode($consultado->toJson(), true, 512, JSON_THROW_ON_ERROR);

$this->assertSame($dados, $dadosJson);
```

toJson produz uma string JSON. json_decode converte essa string para uma
estrutura PHP: true pede arrays associativos; 512 é o limite de profundidade;
JSON_THROW_ON_ERROR exige uma exceção se o JSON for inválido. A comparação
estrita exige a mesma representação já conferida em $dados, incluindo nome/
e-mail e a ausência de senha/token. Não imprimimos os valores protegidos.

Referência: [serialização e atributos ocultos no Laravel](https://laravel.com/docs/13.x/eloquent-serialization#hiding-attributes-from-json).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/UserPersistenciaTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UserPersistenciaTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; cenário focado 1 teste/15 asserções; suíte completa na ordem
padrão 67 testes/635 asserções, todos com código 0. O caminho seleciona o arquivo
no teste focado; --testdox mostra sua descrição; --colors=never remove cores;
--do-not-cache-result evita atualizar o cache de resultados.

São seis asserções novas: uma de token persistido, duas de dados visíveis,
duas de chaves omitidas e uma de igualdade entre array e JSON decodificado.
As nove anteriores e o isolamento por DatabaseTransactions permanecem.

SELECT posterior confirmou loja_test/loja_testes com zero users/tokens/sessions/
produtos/categorias e os quatro registros de migrations nos lotes 1/2/3/4
preservados. O rollback desfez o cadastro e a alteração de token do cenário.
Snapshot normal e quatro contratos não foram repetidos.

## Alcance e continuidade

O teste verifica a representação padrão desse model. Isso não é um contrato
HTTP ou teste de login: nenhuma requisição foi enviada. A seleção de campos
de futuros endpoints será tratada quando esses endpoints forem criados.

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo após publicar:
7.8 — entender sessão no servidor e cookie no navegador no fluxo de
login/requisição seguinte/logout, antes de instalar Sanctum. Checkpoint preparado
para commit e push; consultar o Git ou registro posterior para conferir a publicação.
