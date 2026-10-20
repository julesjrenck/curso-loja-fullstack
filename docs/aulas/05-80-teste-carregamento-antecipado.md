# Aula 5.80 — Teste de carregamento antecipado

## Objetivo e estado

Transformar a demonstração de with('categoria') em teste permanente de resultado
e quantidade de consultas. Implementação, explicação e verificações em 20/10/2026;
entendimento confirmado com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.79 confirmada com "entendi" e publicada em
70d44b574d876724c9ef326c517abe09cd15f535. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Alteração e preparação

Somente backend/tests/Feature/ProdutoCategoriaTest.php alterado no código.
Quinto cenário test_lista_produtos_com_categorias_em_duas_consultas adicionado.
Imports, setUp, DatabaseTransactions e quatro cenários anteriores preservados.

O cenário cria Roupas/Acessórios e prepara três produtos usando um foreach:

```php
foreach ([
    ['Camiseta', $roupas->id],
    ['Calça', $roupas->id],
    ['Caneca', $acessorios->id],
] as [$nome, $categoriaId]) {
    $ids[] = Produto::factory()->create([
        'nome' => $nome,
        'status' => 'ativo',
        'categoria_id' => $categoriaId,
    ])->id;
}
```

Cada array contém nome e ID de categoria. A desestruturação após as extrai os dois
valores em $nome/$categoriaId. Cada create grava um produto e devolve seu model;
o ID gerado é acrescentado a $ids. Factory fornece o preço fictício padrão.

## Registro das consultas e verificações

DB::connection() devolve a conexão utilizada. FlushQueryLog limpa registros
anteriores; enableQueryLog ativa o registro de consultas em memória somente após
os cadastros. GetQueryLog devolve o array de consultas registradas.

Trecho central após a preparação dos dados:

```php
$conexao = DB::connection();
$conexao->flushQueryLog();
$conexao->enableQueryLog();

try {
    $produtos = Produto::query()
        ->whereIn('id', $ids)
        ->orderBy('id')
        ->with('categoria')
        ->get();

    $this->assertCount(2, $conexao->getQueryLog());

    $linhas = [];
    foreach ($produtos as $produto) {
        $linhas[] = $produto->nome.' -> '.$produto->categoria->nome;
    }

    $this->assertSame([
        'Camiseta -> Roupas',
        'Calça -> Roupas',
        'Caneca -> Acessórios',
    ], $linhas);
    $this->assertCount(2, $conexao->getQueryLog());
} finally {
    $conexao->disableQueryLog();
    $conexao->flushQueryLog();
}
```

WhereIn limita aos produtos do teste e orderBy torna a ordem previsível.
With/get carregam produtos e categorias em duas consultas. A primeira asserção
confere essa quantidade. Foreach acessa cada categoria e monta as três linhas.
AssertSame exige os nomes corretos na ordem dos IDs de inserção; a última
asserção exige que o contador continue em dois, comprovando ausência de SQL extra
durante o acesso às categorias.

Finally desativa e limpa o registro mesmo se houver falha no teste. O registro
fica em memória, sem arquivo de log. Não inclui cadastros, consulta de identidade
ou rollback. O setUp continua exigindo loja_test/loja_testes antes das gravações;
DatabaseTransactions desfaz os dados ao terminar.

## Comandos e resultados

```bash
docker compose exec -T backend php vendor/bin/phpunit tests/Feature/ProdutoCategoriaTest.php --testdox --colors=never --do-not-cache-result
```

Exec usa o backend iniciado; -T dispensa terminal interativo. PHP executa PHPUnit
instalado e o caminho seleciona esse arquivo. Testdox mostra cenários,
colors=never remove cores e do-not-cache-result evita cache de resultados no
código montado somente para leitura.

Resultado: OK (5 tests, 27 assertions), código 0. Novo cenário soma cinco:
duas asserções de identidade e três de resultados/quantidade de consultas.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Resultado: OK (14 tests, 54 assertions), código 0. Suíte completa executada após
ajuste somente de formatação do array de dados do foreach.

Consultas posteriores pelo diagnóstico da 5.69, em processos PHP Docker separados:
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Rollback conferido. Git diff --check passou; arquivos privados de
ambiente fora do índice. Models, migrations, factory, seeders e serviços preservados.

## Continuidade

5.80 confirmada com "entendi". Publicar e iniciar somente 5.81: demonstrar INNER JOIN entre produtos/categorias em SQL
parametrizado, com produto associado e sem categoria, diagnóstico temporário em
loja_test, identidade conferida e rollback. Sem alterar aplicação ou introduzir
outro tipo de JOIN ainda.
