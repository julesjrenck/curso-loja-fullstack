# Aula 6.26 — Consulta paginada de produtos ativos no serviço Eloquent

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.25 em 509ed431eada39804a81c4b04b670fb5cdcd8534. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.26 confirmado
pelo aluno com "entendi" em 30/10/2026. Somente backend/app/Services/CatalogoEloquent.php alterado
no código. Consulta ainda sem contrato/demo/controller/rota.

## Código e conceito

Acrescentado o import:

```php
use Illuminate\Pagination\LengthAwarePaginator;
```

E o novo método:

```php
/**
 * @return LengthAwarePaginator<int, Produto>
 */
public function paginarProdutos(int $pagina): LengthAwarePaginator
{
    return Produto::query()
        ->where('status', 'ativo')
        ->orderBy('nome')
        ->orderBy('id')
        ->paginate(10, ['id', 'nome', 'preco_em_centavos'], 'page', $pagina);
}
```

O import permite usar o nome curto do paginador. Public expõe o método; int
declara o tipo do parâmetro, e LengthAwarePaginator declara o tipo de retorno.
O PHPDoc detalha que os itens são models Produto com chaves inteiras. Ele
documenta os tipos internos; o PHP verifica a classe do retorno em execução.

Produto::query inicia a consulta Eloquent. Where inclui somente ativos, inclusive
na contagem total. OrderBy nome mantém a ordem alfabética existente; orderBy id
desempata nomes iguais, importante quando o empate atravessa duas páginas.

| Argumento de paginate | Papel |
| --- | --- |
| 10 | Quantidade máxima de produtos por página. |
| ['id', 'nome', 'preco_em_centavos'] | Colunas selecionadas para cada model. |
| 'page' | Nome do parâmetro usado nos links de navegação. |
| $pagina | Página informada explicitamente pelo chamador. |

O método recebe uma página já validada, na faixa planejada. Na integração futura,
ela virá de ListarProdutosRequest::pagina(). Não buscamos a requisição HTTP aqui.

Paginate executa a consulta e devolve o paginador com os itens daquela página,
total, tamanho e página atual. Métodos como items(), total(), perPage(),
currentPage() e lastPage() permitem consultar essas informações. Ainda são
models em um paginador; a transformação em JSON por resource será ligada depois.

Para obter total e itens, o Laravel conta os registros antes de buscar a página.
Na versão instalada, se o total for zero, dispensa a busca de itens. Se o total
for positivo, executa a busca mesmo quando a página pedida estiver vazia.
Assinatura e implementação de Eloquent::paginate conferidas na fonte instalada;
referência: [paginação no Laravel 13](https://laravel.com/framework/docs/13.x/pagination#paginating-eloquent-results).

O deslocamento é (pagina - 1) * 10: página 1 começa no início, página 2 pula dez
linhas e página 3 pula vinte. Esse recorte acontece no SQL Server.

## SQL observado na página 2

```sql
select count(*) as [aggregate]
from [produtos]
where [status] = ?
```

```sql
select [id], [nome], [preco_em_centavos]
from [produtos]
where [status] = ?
order by [nome] asc, [id] asc
offset 10 rows fetch next 10 rows only
```

Ambas usam 'ativo' como parâmetro separado do SQL. Offset pula os primeiros dez
resultados ordenados; fetch limita a busca aos dez seguintes. Assim, a aplicação
recebe somente os itens daquela página, além do total retornado pela contagem.

Os métodos listarNomes, listarProdutos e buscarProduto foram preservados.
Catalogo ainda não declara paginarProdutos, e CatalogoDemonstracao ainda não o
implementa. O controller segue chamando listarProdutos; API permanece sem
paginação e sem validar page. Binding Eloquent e Form Request preservados.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Services/CatalogoEloquent.php
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-626-paginar-produtos.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l verifica sintaxe. APP_ENV=testing seleciona o ambiente exclusivo de testes
para o diagnóstico. O redirecionamento envia o script temporário ao PHP do
container. O script carrega Laravel, exige banco/login loja_test/loja_testes,
abre transação e somente então limpa produtos e cria fixtures. Usa try/finally
para desativar o log e executar rollback inclusive em caso de falha.

Primeiro confere catálogo vazio. Depois cadastra dois ativos de nome Produto 10,
seguidos dos Produtos 09 a 01 em ordem invertida e um inativo Produto 00. São
onze ativos; os dois empatados ficam nas posições 10/11, cruzando as páginas.
IDs reais gerados pelo banco determinam o desempate, sem assumir valores fixos.

| Cenário | Itens | Total | Última página | Consultas |
| --- | ---: | ---: | ---: | ---: |
| Catálogo vazio, página 1 | 0 | 0 | 1 | 1 |
| Onze ativos, página 1 | 10 | 11 | 2 | 2 |
| Onze ativos, página 2 | 1 | 11 | 2 | 2 |
| Onze ativos, página 3 | 0 | 11 | 2 | 2 |

O diagnóstico também conferiu classe do retorno, página atual, tamanho 10,
nomes/preços/IDs em ordem esperada, somente três atributos nos models, IDs/preços
inteiros e nenhuma consulta extra ao iterar os resultados. As consultas usaram
status parametrizado. O inativo ficou fora dos itens e do total, permanecendo
cadastrado antes do rollback. Ao fim, transação encerrada e zero produtos no teste.

Suíte existente: 27 testes/133 asserções passaram. Não há teste permanente novo
de paginação nesta etapa; os cenários novos estão no diagnóstico temporário.
SELECTs separados antes/depois por /tmp/curso-618-contagens.php confirmaram
loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
0 categorias/1 produto. Git diff --check passou.

O resultado verifica a consulta real no banco de testes, sem ligação ao kernel
HTTP, controller ou resource. A integração futura terá sua própria verificação.
Sem cadastro permanente, migration ou dependência nova.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint concluído,
publicação em preparação; resultado será registrado após conferir o remoto.
Próximo passo: publicar checkpoint e iniciar somente 6.27, declarar
paginarProdutos(int $pagina):
LengthAwarePaginator no contrato Catalogo e implementar assinatura compatível
em CatalogoDemonstracao em memória, preservando binding Eloquent e sem rota.
