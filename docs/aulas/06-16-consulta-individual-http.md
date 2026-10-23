# Aula 6.16 — Consulta individual pelo HTTP

## Objetivo e estado

Ligar a busca preparada nas etapas anteriores a GET /api/v1/produtos/{id}.
Implementação, explicação e verificações em 23/10/2026; entendimento confirmado
pelo aluno com "entendi" em 23/10/2026. Conjunto inseparável: routes/api.php e
app/Http/Controllers/Api/V1/ProdutoController.php. A consulta individual funciona
agora, com sucesso e erro definidos na 6.13.

Etapa 6.15 confirmada com "entendi" e publicada em 23/10/2026 no commit
8961d02c515cf7f4ed82f4dc56be54ab1fb1e628. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após o push.

## Rota e parâmetro do caminho

Acrescentada em routes/api.php, mantendo a rota de listagem:

```php
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])
    ->where('id', '[1-9][0-9]*');
```

Route::get registra leitura; Laravel também oferece HEAD. O prefixo api/v1 já
configurado em bootstrap/app.php forma /api/v1/produtos/{id}. {id} é obrigatório
e representa parte do caminho, por exemplo /produtos/1. Não é corpo nem query string.
ProdutoController::class e show identificam a classe e o método a executar.

where restringe o formato textual do parâmetro: [1-9] exige o primeiro dígito
entre 1 e 9, [0-9]* permite zero ou mais dígitos depois. Aceita 1, 23 e 100;
rejeita abc, 0, -1, 1.5, 01, 1e3 e +1. A restrição precisa corresponder ao
parâmetro inteiro, não apenas a um trecho. Sem correspondência, o roteamento
retorna 404 sem executar show ou buscar o produto.

Não confundir este where, que restringe uma rota, com o where da consulta SQL.
O roteamento valida a forma do caminho; o serviço continua filtrando status e ID.

## Ação show e decisões HTTP

Acrescentado o import de Illuminate\Http\JsonResponse e o método:

```php
public function show(Catalogo $catalogo, string $id): ProdutoResource|JsonResponse
{
    $idValidado = filter_var($id, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    $produto = $idValidado === false
        ? null
        : $catalogo->buscarProduto($idValidado);

    if ($produto === null) {
        return response()->json(['message' => 'Produto não encontrado.'], 404);
    }

    return new ProdutoResource($produto);
}
```

Catalogo é injetado pelo container, que resolve CatalogoEloquent pelo binding
existente. As dependências vêm antes dos parâmetros da rota. string $id recebe
o texto do caminho; sua origem é a URL, mesmo quando contém somente dígitos.
O retorno ProdutoResource|JsonResponse usa união de tipos: uma dessas duas classes.

filter_var é função PHP. FILTER_VALIDATE_INT valida e converte para int;
min_range 1 exige positivo. Se falhar, retorna false. A checagem de faixa evita
converter silenciosamente um número além de PHP_INT_MAX para outro identificador.
Nesta imagem PHP de 64 bits, PHP_INT_MAX é 9223372036854775807.

A expressão condicional ? : equivale a um if/else: se o ID falhou, produto será
null, sem chamar o catálogo. Se foi validado, chamar buscarProduto com o inteiro.
O método do serviço aplica ativo + ID e executa o SELECT pelo first.

Quando produto é null, response()->json monta explicitamente o corpo com message
e o status 404. Não há data nesse erro. Isso atende tanto inexistente/inativo
quanto ID numérico acima da faixa de int, sem depender do formato de exceções.

Quando encontrou, new ProdutoResource($produto) entrega um único model ao resource.
Laravel aplica toArray, gera Content-Type application/json, status 200 e envelope
data contendo objeto. Diferente de ProdutoResource::collection no index, que
recebe uma coleção e gera data em lista.

Exemplo real observado nesta etapa:

```json
{"data":{"id":1,"nome":"Camiseta","preco_em_centavos":4990}}
```

O ID 1 foi obtido da listagem atual, não fixado nos diagnósticos. Inexistente ou
inativo retornam 404 com {"message":"Produto não encontrado."}; o inativo
continua no banco. Caminhos que não passam pelo padrão da rota recebem 404 JSON
do roteamento; seu corpo não faz parte da promessa de mensagem exata de show.

O resource transforma atributos, sem buscar no banco. Interface, implementações,
binding e resource preservados. Index/listagem e página Blade /loja preservados.

## Verificações

Executado em PHP Docker, código 0:

- php -l nos dois arquivos: sintaxes válidas.
- php artisan route:list --path=api/v1/produtos: index e show registrados, GET|HEAD.
- /tmp/curso-616-http-individual.php pelo kernel HTTP Laravel, ambiente
  loja_test/loja_testes conferido antes de escrever, fixtures em transação:
  dois ativos pelos respectivos IDs retornaram 200/JSON exato, data em objeto,
  campos/valores/tipos corretos; inativo/ausente/PHP_INT_MAX sem cadastro retornaram
  404/message exata. Cada busca válida executou um SELECT com parâmetros ativo/ID.
  Formatos inválidos retornaram 404 JSON sem SQL; acima da faixa PHP, 404/message
  exata sem SQL. Inativo ainda cadastrado, finally com rollback dos registros.
- php artisan test --do-not-cache-result: suíte existente 18 testes/78 asserções
  passou. Novos cenários HTTP cobertos pelo diagnóstico dirigido; ainda não há
  teste permanente de consulta individual em CatalogoApiTest.
- /tmp/curso-616-http-real.php: processo separado fez requisição ao servidor,
  obteve ID da listagem, consultou o mesmo produto: 200/application/json com
  objeto Camiseta/4990; ID acima da faixa retornou 404/message exata.
- /tmp/curso-612-http.php: listagem segue 200/JSON com data em lista;
  /loja segue 200/text/html com Camiseta.
- Contagens separadas: loja_test/loja_testes 0 categorias/0 produtos;
  loja/loja_app 0 categorias/1 produto. Sem cadastro permanente ou migration.

Os diagnósticos são temporários, fora do Git. Para executá-los, usar
docker compose exec -T backend php < /tmp/nome-do-script.php: < lê o arquivo do
host e -T permite entrada padrão sem terminal. O kernel percorre roteamento,
middleware, injeção, controller e serialização dentro do processo de teste;
HTTP real foi verificado separadamente, sem criar dados no banco normal.

Referências oficiais consultadas:

- [Laravel 13 — parâmetros e restrições de rotas](https://laravel.com/docs/13.x/routing#parameters-regular-expression-constraints).
- [PHP — FILTER_VALIDATE_INT](https://www.php.net/manual/en/filter.constants.validation.php#constant.filter-validate-int).

## Continuidade

Entendimento confirmado; checkpoint pronto para publicação conforme autorização persistente.
Próximo passo exato: 6.17, acrescentar um teste permanente em CatalogoApiTest
para produto ativo consultado por ID, com factory e preço explícito, exigindo
200, Content-Type application/json e JSON exato com data em objeto. Reutilizar
DatabaseTransactions/identidade de testes existentes. Ausente/inativo e restrições
serão incorporados em etapas seguintes, sem antecipar tudo nesta aula.
Exercício manual sugerido no DBeaver continua sem relato do aluno.
