# Aula 6.14 — Buscar um produto pelo ID no serviço

## Objetivo e estado

Preparar a consulta de um produto ativo por ID em CatalogoEloquent. Implementação,
explicação e verificações em 23/10/2026; entendimento confirmado pelo aluno
com "entendi" em 23/10/2026.
Somente app/Services/CatalogoEloquent.php alterado na aplicação. O novo método
foi chamado diretamente no diagnóstico PHP; ainda não participa de uma rota.

A etapa 6.13 foi confirmada com "entendi" em 23/10/2026 e publicada em
1690d722a93e0b75bc2ddb887d9229f7bf661ca3. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após o push.

## Código e conceito

Acrescentado ao serviço, mantendo listarNomes e listarProdutos:

```php
public function buscarProduto(int $id): ?Produto
{
    return Produto::query()
        ->where('status', 'ativo')
        ->whereKey($id)
        ->first(['id', 'nome', 'preco_em_centavos']);
}
```

- public permite chamar o método externamente ao objeto.
- int $id é a entrada: identificador do produto solicitado.
- ?Produto significa Produto ou null, equivalente a Produto|null.
- Produto já estava importado no arquivo; é App\Models\Produto.
- Produto::query() cria o construtor da consulta de produtos.
- where('status', 'ativo') aplica a regra do catálogo público.
- whereKey($id) acrescenta o filtro pela chave primária do model, aqui produtos.id.
  Os dois filtros precisam ser satisfeitos, como condições ligadas por AND.
- first([...]) executa o SELECT e retorna um model Produto ou null. O array
  seleciona somente id, nome e preco_em_centavos, os três atributos públicos.

whereKey acrescenta o filtro; first é o ponto que executa a consulta. Na listagem,
get retorna uma coleção. Aqui, como o ID é único, queremos um único produto;
não precisamos ordenar por nome para escolher entre vários registros.

O produto retornado carrega somente os três atributos selecionados. Isso não
remove as demais colunas da tabela. O cast já definido no model mantém o preço
como inteiro; o resource continuará responsável por montar a representação JSON.

Saída para ativo: Produto. Saída para inexistente ou inativo: null. O serviço
não monta JSON, não escolhe status HTTP e não apaga o produto inativo.
O futuro controller converterá a ausência no 404 planejado na 6.13.

Contrato Catalogo, CatalogoDemonstracao, controller, resource, binding e rotas
preservados. A interface ainda não declara buscarProduto; sua ampliação é a
próxima etapa. Nenhuma URL individual passou a funcionar nesta preparação.

## Verificação dirigida no Docker e SQL Server

Diagnóstico temporário /tmp/curso-614-buscar-produto.php, fora do Git. Executado:

```sh
docker compose exec -T backend php -l app/Services/CatalogoEloquent.php
docker compose exec -T backend php < /tmp/curso-614-buscar-produto.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

exec executa no container backend em funcionamento; -T permite fornecer o script
pela entrada padrão. O redirecionamento < lê o arquivo temporário do host.
php -l verifica sintaxe sem executar a lógica. O diagnóstico carrega Laravel
com .env.testing e exige loja_test/loja_testes antes de escrever dados.

Dentro de transação, limpou produtos, criou Camiseta/4990 e Caneca/2990 ativas e
Tênis/9990 inativo. Consultou os dois IDs ativos, um ID comprovadamente ausente
após os cadastros e o ID inativo. IDs reais obtidos das factories, sem assumir 1.
Conferiu classe/exists, campos exatos, valores/tipos e um SELECT por busca, com
parâmetros ativo e ID. SQL observado:

```sql
select top 1 [id], [nome], [preco_em_centavos]
from [produtos]
where [status] = ? and [produtos].[id] = ?
```

Os pontos de interrogação representam parâmetros enviados ao banco. TOP 1 é a
forma gerada para SQL Server limitar a um resultado. Inexistente e inativo
retornaram null. Conferido que o inativo continuava cadastrado. finally executou
rollback, inclusive se a verificação lançasse erro. O rollback desfaz os registros
fictícios; não promete restaurar o contador de IDs do SQL Server.

Resultados, código 0:

- Sintaxe válida; quatro buscas dirigidas passaram, cada uma com um SELECT.
- Suíte existente: 18 testes/78 asserções passaram. Essa suíte verifica regressões;
  o comportamento novo foi verificado pelo diagnóstico dirigido acima.
- SELECTs de contagem: loja_test/loja_testes com 0 categorias/0 produtos;
  loja/loja_app com 0 categorias/1 produto, identidades conferidas separadamente.
- /tmp/curso-612-http.php confirmou listagem 200/application/json com o objeto
  Camiseta/4990 e ID real; /loja 200/text/html com item Camiseta. Isso verifica os
  caminhos existentes, não o HTTP da consulta individual, ainda não implementado.

Sem migration, seeder, dependência nova ou cadastro permanente. O exercício
manual sugerido no DBeaver continua sem relato do aluno.

Referência: [API Laravel 13 — Builder, whereKey e first](https://api.laravel.com/docs/13.x/Illuminate/Database/Eloquent/Builder.html).

## Continuidade

Entendimento confirmado; checkpoint pronto para publicação conforme autorização persistente.
Próximo passo exato: 6.15, declarar buscarProduto(int $id): ?Produto no contrato
Catalogo e implementar a busca compatível em CatalogoDemonstracao, usando seus
IDs fictícios e null para ausente; verificar em memória e pelo binding Eloquent.
Preservar controller e rotas nessa preparação. Só depois ligar a consulta ao HTTP.
