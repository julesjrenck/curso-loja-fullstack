# Aula 7.6 — Hash da senha persistida

Implementação, explicação e verificações em 03/11/2026, após confirmação da
7.5 com "entendi". Checkpoint anterior publicado e conferido em
5f0b13b9c426c5c4cb3af9d9868d3c6f60f1b1da; HEAD/origin/main/main remota iguais
após push. Entendimento da 7.6 confirmado com "entendi" em 03/11/2026.

## Objetivo e mudança

Ampliamos somente o cenário existente em
[UserPersistenciaTest.php](../../backend/tests/Feature/UserPersistenciaTest.php)
para verificar a senha depois da gravação e da nova consulta pelo ID.
Continuam as verificações de identidade, ID, nome/e-mail e DatabaseTransactions.

O [model User](../../backend/app/Models/User.php) já possui o cast
'password' => 'hashed'. Quando recebe a senha em texto, esse cast faz sua
transformação em hash antes de armazenar. Não alteramos o model nem adicionamos
Hash::make no teste: queremos conferir o tratamento que o próprio User fornece.

Adicionamos o import da fachada:

```php
use Illuminate\Support\Facades\Hash;
```

A fachada permite acessar o serviço de hashing configurado no Laravel.
Guardamos o texto fictício numa variável para usá-lo na criação e na conferência:

```php
$senha = 'senha-ficticia-do-teste';
```

O array passado a create agora usa 'password' => $senha. A variável contém
somente o dado fictício do cenário; não é uma credencial de conta real.

## Três novas asserções

Depois de findOrFail, $consultado representa a linha lida novamente do SQL Server:

```php
$this->assertNotSame($senha, $consultado->password);
$this->assertTrue(Hash::check($senha, $consultado->password));
$this->assertFalse(Hash::check('outra-senha-ficticia', $consultado->password));
```

assertNotSame exige que o valor armazenado seja diferente do texto informado.
Sozinha, essa asserção seria insuficiente: qualquer texto diferente passaria.

Hash::check recebe primeiro a senha em texto e depois o hash armazenado.
Ele verifica se correspondem; não recupera a senha original do hash.
assertTrue exige true para a senha correta; assertFalse exige false para a
senha diferente. Isso não compara o hash a uma string fixa nem fixa um prefixo
de algoritmo como expectativa do cenário.

São agora nove asserções: as seis da 7.5 e essas três. O cenário continua
criando um único usuário por execução e desfazendo suas alterações ao terminar.
Não imprimimos a senha ou o hash nos diagnósticos.

Referência: [verificação de senha e hash no Laravel](https://laravel.com/docs/13.x/hashing#verifying-that-a-password-matches-a-hash).

## Verificações

```sh
docker compose exec -T backend php -l tests/Feature/UserPersistenciaTest.php
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/UserPersistenciaTest.php --testdox --colors=never --do-not-cache-result
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

php -l verificou sintaxe. O caminho passado ao PHPUnit selecionou o cenário
ampliado; --testdox apresentou sua descrição. --colors=never removeu cores,
e --do-not-cache-result evitou atualizar o cache de resultados. O último comando
executou toda a suíte, na ordem padrão.

Resultados: sintaxe válida; focado 1 teste/9 asserções; suíte completa
67 testes/629 asserções, todos com código 0. A quantidade de testes se manteve,
porque ampliamos um cenário existente; acrescentamos três asserções.

SELECT posterior confirmou loja_test/loja_testes com zero users/tokens/sessions/
produtos/categorias e os quatro registros de migrations nos lotes 1/2/3/4
preservados. O rollback desfez os cadastros fictícios. O snapshot do banco normal
e os quatro contratos não foram executados novamente nesta etapa.

## Alcance e continuidade

O teste cobre persistência e conferência da senha no model com SQL Server.
Ainda não testa ocultação na serialização, login HTTP ou permissões.
Nenhuma rota, dependência, configuração, migration ou model foi alterado.

Entendimento confirmado com "entendi" em 03/11/2026. Próximo passo após publicar:
7.7 — verificar em teste a ocultação de password e remember_token na conversão
do User para array/JSON. Checkpoint preparado para commit e push; consultar o Git
ou registro posterior para conferir o resultado da publicação.
