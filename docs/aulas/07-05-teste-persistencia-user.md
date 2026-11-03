# Aula 7.5 — Primeiro teste de persistência de User

Implementação, explicação e verificações em 03/11/2026, após confirmação da
7.4 com "entendi". Checkpoint anterior publicado e conferido em
65880d06e1c96c1b0273480d59792bd11d384c2a; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.5 confirmado com "entendi" em 03/11/2026.

## Objetivo e arquivo

Criamos somente [UserPersistenciaTest.php](../../backend/tests/Feature/UserPersistenciaTest.php)
como novo código. É um teste de integração entre o
[model User](../../backend/app/Models/User.php), Eloquent e SQL Server:
grava um usuário fictício, faz uma nova consulta pelo ID e confere os dados.
Não envia requisição HTTP, não faz login nem cria rotas.

Os imports trazem o model, o trait DatabaseTransactions, a fachada DB e a base
[Tests\TestCase](../../backend/tests/TestCase.php), que inicializa Laravel.
O namespace Tests\Feature e o nome terminado em Test seguem a descoberta da
suíte configurada em [phpunit.xml](../../backend/phpunit.xml).

## Destino e preparação

```php
use DatabaseTransactions;
```

Dentro da classe, esse use incorpora o trait, como nos testes do catálogo.
Laravel abre uma transação antes do método e desfaz suas alterações ao terminar.
Ele usa as tabelas existentes, preparadas na 7.4; não aplica migrations.

```php
$identidade = DB::selectOne(
    'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login'
);

$this->assertSame('loja_test', $identidade->banco);
$this->assertSame('loja_testes', $identidade->login);

User::query()->delete();
```

O SELECT lê a identidade real da conexão. As duas asserções precisam passar
antes de qualquer DELETE ou INSERT. assertSame compara valor e tipo; o primeiro
argumento é o esperado e o segundo é o resultado observado.

delete remove as linhas de users dentro da transação para preparar uma tabela
vazia e evitar conflitos com o e-mail do cenário. O rollback desfaz também essa
preparação. Nenhuma tabela é removida ou recriada.

## Escrita e leitura reais

```php
$usuario = User::query()->create([
    'name' => 'Ana Exemplo',
    'email' => 'ana@example.test',
    'password' => 'senha-ficticia-do-teste',
]);
```

query inicia uma consulta Eloquent; create preenche o model, grava no banco e
devolve a instância com o ID gerado. Os campos estão permitidos em Fillable,
e o cast hashed existente trata a senha. São dados exclusivamente fictícios
de teste; a senha não é uma credencial de conta real nem é impressa.

```php
$this->assertIsInt($usuario->getKey());
$this->assertGreaterThan(0, $usuario->getKey());

$consultado = User::query()->findOrFail($usuario->getKey());

$this->assertSame('Ana Exemplo', $consultado->name);
$this->assertSame('ana@example.test', $consultado->email);
```

getKey devolve a chave primária do model. Exigimos um inteiro positivo, sem
fixar o número. findOrFail consulta o banco por essa chave e devolve outra
instância; se não encontrar a linha, lança uma exceção e o teste falha.
Conferimos nome/e-mail lidos novamente do SQL Server, não apenas os atributos
do objeto que acabamos de preencher. São seis asserções: duas de identidade,
duas de ID e duas de conteúdo.

## Comandos e verificações

Antes da alteração, PHP 8.4.26 e Composer 2.10.3 foram conferidos no Docker.
Diagnóstico sem cache de configuração confirmou testing/.env.testing,
loja_test/loja_testes e zero users/tokens/sessions/produtos/categorias.
Nenhuma dependência ou configuração foi alterada.

```sh
docker compose exec -T backend php -l tests/Feature/UserPersistenciaTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UserPersistenciaTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --order-by=reverse --colors=never --do-not-cache-result
```

php -l verificou a sintaxe, sem executar o teste. O caminho no primeiro comando
PHPUnit selecionou somente o novo arquivo; --testdox apresentou seu cenário.
--colors=never removeu cores e --do-not-cache-result evitou atualizar o cache
de resultados. O último comando executou a suíte em ordem inversa.

Resultados: sintaxe válida; focado 1 teste/6 asserções; suíte completa
67 testes/626 asserções, todos com código 0. A ordem inversa complementa a
verificação de integração com a suíte, sem provar toda ordem possível.

SELECT posterior em loja_test/loja_testes confirmou zero usuários, tokens,
sessões, produtos e categorias, com os quatro registros de migrations
preservados. O cadastro do teste foi desfeito. O contador identity de users
chegou a 2 após as duas execuções; rollback não recupera os valores consumidos.
Por isso o cenário usa a chave retornada e não depende de ID 1.
Referência: [IDENTITY no SQL Server](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-table-transact-sql-identity-property?view=sql-server-ver17#remarks).

Consulta separada a loja/loja_app manteve somente categorias/migrations/produtos,
três migrations nos lotes 1/2/3 e um produto/zero categorias. O resumo SHA-256
dos metadados e contagens coincidiu com o estado anterior registrado:
8c61be048457250963c87f8c8c40dd595d57a3c2349070c9cdd0994c1151fa7a.
Não compara o conteúdo integral das linhas. Nenhuma escrita no banco normal.
Os quatro contratos não foram executados novamente.

## Alcance e continuidade

Este teste cobre a persistência e leitura de nome/e-mail com chave gerada.
Ainda não exige que a senha armazenada confira com Hash::check nem verifica
sua ocultação na serialização; também não cobre login ou autorização.

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo após publicar:
7.6 — verificar em teste o hash da senha persistida e a comparação com
Hash::check. Checkpoint preparado para commit e push; consultar o Git ou
registro posterior para conferir o resultado da publicação.
