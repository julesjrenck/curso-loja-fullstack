# Aula 7.80 — Testes HTTP da administração

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.79](07-79-rota-administracao-protegida.md) com "entendi".
Checkpoint anterior publicado e conferido em
fb951855677cd07bdf8c49fb3f5862355929788b; HEAD/origin/main/main remota iguais.
Entendimento da 7.80 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Criamos somente
[AdministracaoApiTest.php](../../backend/tests/Feature/AdministracaoApiTest.php)
na aplicação. Diferentemente dos testes de allows da 7.76, estes chamam a
rota real com getJson e verificam respostas HTTP, atravessando autenticação,
autorização, controller e tratamento de exceções.

O arquivo estende Tests\TestCase para inicializar o Laravel e usa TestResponse
para as verificações comuns. Não redefine a rota ou o Gate. Referência:
[testes HTTP no Laravel](https://laravel.com/docs/13.x/http-tests).

## Preparação e isolamento

SetUp chama parent::setUp e exige ambiente testing. Configura app.debug true
na aplicação de teste; nenhuma alteração é feita em .env ou no servidor normal.
O caso com debug false altera apenas essa configuração do cenário.

O contador tentativasSql começa em zero. BeforeExecuting na conexão padrão
incrementa esse contador e lança LogicException se houver tentativa de SQL.
Cada cenário precisa somente de objetos em memória, sem create/save/seeders
ou DatabaseTransactions. As demais classes da suíte mantêm seus próprios
testes SQL em loja_test, pois cada teste recebe sua aplicação.

## Visitante, cliente e administrador

O visitante usa getJson('/api/v1/administracao') sem preparar usuário.
GetJson fornece Accept application/json e executa o pedido internamente pelo
kernel, sem rede ou navegador. Exigimos status 401, corpo somente message
string e ausência de redirecionamento.

Cliente e administrador são User em memória, com ID fictício e indicador
bruto zero/um. O cast real converte o indicador. ActingAs prepara o guard web
para a requisição, sem testar senha, persistir User ou transportar cookies:

```php
$resposta = $this->actingAs($cliente, 'web')
    ->getJson('/api/v1/administracao');
```

O cliente deve receber 403; o administrador, 200 com objeto data/mensagem
exato do [contrato](../api/administracao.md). O teste de sucesso não serializa
o User nem devolve seus atributos. Fonte: [autenticação nos testes HTTP](https://laravel.com/docs/13.x/http-tests#session-and-authentication).

## DataProvider e depuração

O método público estático modosDepuracao retorna dois conjuntos nomeados,
cada um contendo um booleano. O atributo DataProvider liga esses conjuntos
ao parâmetro bool debug do teste de cliente. Assim, esse método executa duas
vezes, cada uma com sua preparação independente.

| Execução | Resultado exigido |
| --- | --- |
| Visitante, debug ligado | 401 JSON |
| Cliente, debug ligado | 403 JSON somente message |
| Cliente, debug desligado | O mesmo formato 403 |
| Administrador, debug ligado | 200 JSON exato do contrato |

São três métodos de cenário e quatro execuções de teste. O caso com debug
ligado detecta a regressão encontrada na 7.79: exception/file/line/trace
voltariam a fazer a comparação de chaves falhar.

Nos erros verificamos array_keys igual a somente message e que seu valor é
string. Não fixamos a frase ou idioma como condição da recusa. No sucesso,
assertExactJson exige o texto fixo definido no contrato.

## Helper de resposta

ConferirResposta recebe TestResponse e o status esperado. Verifica status,
Content-Type application/json e ausência de Location. Confere também contador
SQL zero e getRawPdo ainda como Closure: a conexão não foi aberta. Closure
é importada apenas para essa verificação da conexão preparada pelo Laravel.

As verificações específicas do corpo ficam em cada cenário. Isso mantém
visíveis as diferenças entre os erros e o sucesso, compartilhando as condições
de formato e isolamento.

## Comandos e resultados

```sh
docker compose exec -T backend php -l /app/tests/Feature/AdministracaoApiTest.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never tests/Feature/AdministracaoApiTest.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec -T usa o backend sem terminal interativo; php -l verifica sintaxe.
Artisan test com caminho executa o arquivo focado; sem caminho executa a
suíte. Compact reduz saída, do-not-cache-result evita cache no código readonly
e colors=never remove cores. Nenhuma dependência ou configuração modificada.

Sintaxe passou. Focado: quatro testes/35 asserções, código 0.
Suíte completa atual: 116 testes/1.653 asserções passaram, código 0.

Esses testes automatizam o contrato pelo kernel com identidades em memória.
Não executam login por credenciais, transporte de sessão no navegador ou
promoção da conta de laboratório. Nenhuma senha/hash de conta real utilizado.
Rota, Gate, User/controller e tratamento do 403 permanecem como na 7.79.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.81 — incluir
GET /api/v1/administracao no OpenAPI, com segurança por cookie, respostas
200/401/403 e exemplos, e validar com o Redocly fixado. Módulos 8 a 23 não iniciados.
