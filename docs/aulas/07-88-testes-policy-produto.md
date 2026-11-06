# Aula 7.88 — Testes da Policy de produto

Implementação, explicação e verificações em 05/11/2026, após a
[7.87](07-87-primeira-policy-produto.md) confirmada com "entendi".
Checkpoint anterior publicado e conferido em
a24cdafcbeeecfa1f4d311f37958c6f7736da655; HEAD/origin/main/main remota iguais.
Entendimento confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Registrar testes permanentes da descoberta automática e das decisões da
ProdutoPolicy. Criado somente
[ProdutoPolicyTest.php](../../backend/tests/Feature/ProdutoPolicyTest.php)
na aplicação. A Policy da aula anterior foi mantida.

O teste estende Tests\TestCase para iniciar o Laravel e usar a facade Gate
real. Fica em Feature por testar essa integração com o framework; não há
requisição HTTP ou necessidade de persistir os modelos nesses cinco casos.

## Preparação e cinco comportamentos

`setUp()` chama `parent::setUp()`, confirma o ambiente testing e registra
`DB::connection()->beforeExecuting(...)`. Esse callback incrementa um contador
e lança LogicException se algum SQL for tentado durante o teste. O objeto
de conexão pode existir sem abrir uma conexão PDO com o banco.

Os cinco métodos de teste conferem:

| Comportamento | Verificação |
| --- | --- |
| Descoberta da Policy | Gate::getPolicyFor(Produto::class) retorna ProdutoPolicy |
| Cliente com indicador bruto 0 | update recusado |
| Administrador com indicador bruto 1 | update permitido |
| Usuário sem indicador | update recusado |
| Visitante null | update recusado |

Não registramos uma Policy manualmente no teste. Assim, o caso de descoberta
verifica a associação usada pela aplicação, e o caso permitido impede que
uma recusa geral indevida passe como comportamento correto.

`setRawAttributes(['is_admin' => 0 ou 1], true)` prepara o User em memória com
o valor bruto que o SQL Server pode devolver. O cast boolean real continua
atuando. Nenhuma conta existente ou senha real é carregada.

## Helpers e relação com a Policy

`conferirPermissao(?User $usuario, bool $permitido)` aceita uma identidade ou
null e o resultado esperado. Para cada identidade, prepara dois produtos
fictícios em memória com IDs distintos. O segundo argumento true de
setRawAttributes sincroniza os atributos originais, mantendo o modelo limpo.
Não chama save nem consulta um registro existente por esses IDs.

A consulta usa o Gate real:

```php
$this->assertSame(
    $permitido,
    Gate::forUser($usuario)->allows('update', $produto)
);
```

`assertSame` exige o booleano esperado. A facade deve descobrir a Policy e
consultar a ação update com aquele usuário/produto. O teste não chama o
método da Policy diretamente nem substitui seu resultado por um mock.

Depois da decisão, compara os atributos com os anteriores e exige isDirty
false: consultar autorização deve preservar os produtos. A regra atual é
baseada no perfil do usuário e deve valer para ambos os produtos.

`conferirAusenciaDeSql()` exige zero tentativas SQL e getRawPdo ainda como
Closure, indicando conexão não aberta. Esse helper também é usado no teste
isolado de descoberta.

## Comandos e resultados

Executados dentro do container, após conferir PHP 8.4.26/Composer 2.10.3:

```sh
docker compose exec -T backend php -l tests/Feature/ProdutoPolicyTest.php
docker compose exec -T backend vendor/bin/phpunit --colors=never tests/Feature/ProdutoPolicyTest.php
docker compose exec -T backend vendor/bin/phpunit --colors=never --do-not-cache-result
```

- Sintaxe: sem erros, código 0.
- Arquivo novo: cinco testes/40 asserções passaram, código 0.
- Suíte completa: 121 testes/1.693 asserções passaram, código 0.

O caminho no segundo comando seleciona só o novo arquivo; sem caminho, o
último comando executa toda a suíte definida em phpunit.xml. `--colors=never`
retira cores. A primeira execução avisou que não podia gravar o cache de
resultados em /app, montado somente para leitura; os testes passaram.
`--do-not-cache-result` evitou essa gravação na suíte completa, que terminou
sem o aviso. Não foi necessário mudar permissões ou arquivos do projeto.

O arquivo novo bloqueia SQL. A suíte completa contém os testes de integração
anteriores, configurados para loja_test; não dizer que toda a suíte é sem SQL.
Não houve acesso de negócio ao banco loja, login real, promoção de contas,
pedido ao navegador ou atualização persistida de produto nesta etapa.
Policy, rotas, controllers, models, página e OpenAPI mantidos.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026 sobre consultar Gate/Policy
reais com objetos em memória, sem gravar usuários/produtos. Próximo passo:
publicar o checkpoint e iniciar a 7.89, revisão do módulo 7, consolidando autenticação,
sessão/CSRF/CORS, perfis, Gate, Policy e o que cada verificação demonstra.
Existe permissão de update definida/testada; ainda não existe uma rota de
atualização de produto. Módulo 7 em andamento; módulos 8 a 23 não iniciados.
