# Aula 7.76 — Testes permanentes do Gate de administração

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.75](07-75-gate-acesso-administracao.md) com "entendi".
Checkpoint anterior publicado e conferido em
3f2c4fa7c6f69ae1b79e500f29b2da57f368e919; HEAD/origin/main/main remota iguais.
Entendimento da 7.76 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Criamos somente
[AdministracaoGateTest.php](../../backend/tests/Feature/AdministracaoGateTest.php)
na aplicação. O arquivo automatiza as decisões que conferimos no diagnóstico
da 7.75. Não redefine o Gate nem copia sua comparação para calcular o resultado.
Consulta a regra real registrada no
[AppServiceProvider](../../backend/app/Providers/AppServiceProvider.php).

A classe estende [Tests\TestCase](../../backend/tests/TestCase.php), que
inicializa o Laravel. Está em Feature porque precisa dos serviços e do
provider da aplicação, mesmo sem fazer requisição HTTP ou consultar banco.
Referência: [testes no Laravel](https://laravel.com/docs/13.x/testing#creating-tests).

## Preparação comum em setUp

Parent::setUp inicializa a aplicação antes de cada teste. Em seguida, duas
asserções exigem ambiente testing e presença de acessar-administracao no Gate.
Isso evita confundir a recusa de uma regra existente com o resultado de
consultar um nome que deixou de ser registrado.

Na conexão padrão, beforeExecuting recebe um callback que lança LogicException
se houver tentativa de SQL durante a avaliação. Os cenários precisam apenas
de objetos User em memória. Não usamos create, save, seeder, migration ou
DatabaseTransactions neste arquivo; nenhuma conta precisa ser persistida.

O bloqueio pertence à aplicação criada para cada teste. A suíte completa
continua podendo executar os outros testes de integração em loja_test.

## Quatro comportamentos

Cada método test_* é um cenário independente. Nos dois primeiros, new User
e setRawAttributes preparam o indicador bruto zero ou um. O cast real do
[User](../../backend/app/Models/User.php) fornece false/true para a regra.
SetRawAttributes é preparação do cenário em memória; não foi acrescentado
ao fluxo de entrada de dados nem promove uma conta persistida.

```php
$this->assertFalse(
    Gate::forUser($cliente)->allows('acessar-administracao')
);
```

ForUser fornece explicitamente o contexto da decisão, sem executar login.
Allows consulta o Gate. AssertFalse exige o booleano false; assertTrue exige
true. Nenhum desses resultados representa um status HTTP.

| Cenário | Preparação | Asserção |
| --- | --- | --- |
| Cliente | User com is_admin bruto 0 | false |
| Administrador | User com is_admin bruto 1 | true |
| Visitante | forUser(null), sem criar User | false |
| Indicador ausente | new User sem is_admin | false |

O administrador permitido impede que uma regra que recuse todos pareça
correta. Os casos recusados protegem o comportamento de não conceder acesso
a cliente, visitante ou indicador ausente. A preparação comum também exige
que a regra exista. São três asserções por cenário, totalizando doze.

## Comandos e verificação

```sh
docker compose exec -T backend php -l /app/tests/Feature/AdministracaoGateTest.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never tests/Feature/AdministracaoGateTest.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec -T usa o backend sem terminal interativo. Php -l confere sintaxe.
Artisan test com caminho executa somente o novo arquivo; sem caminho executa
a suíte configurada. Compact reduz saída, do-not-cache-result evita escrita
de cache no código readonly e colors=never remove cores. Não alteramos
phpunit.xml ou arquivos de ambiente.

Sintaxe passou. Focado: quatro testes/doze asserções, código 0.
Suíte completa atual: 112 testes/1.618 asserções passaram, código 0.

O arquivo novo avalia a regra em memória com SQL bloqueado na conexão padrão.
A suíte contém também os testes SQL já existentes, configurados para loja_test.
Nenhum login, promoção, senha/hash de conta real ou chamada de API foi usado
nos novos cenários. Provider/Gate, User, migration, rotas e contratos mantidos.

## Continuidade

As decisões do Gate estão automatizadas. Isso não demonstra proteção de uma
rota, resposta HTTP 401/403 ou sessão administrativa. Essas integrações ainda
serão estudadas, depois da confirmação de entendimento.

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.77 — desenhar o contrato
de GET /api/v1/administracao, com auth:sanctum e Gate acessar-administracao,
respostas 200/401/403, antes de criar controller ou rota. Módulos 8 a 23
não iniciados.
