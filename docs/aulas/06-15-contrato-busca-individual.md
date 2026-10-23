# Aula 6.15 — Busca individual no contrato e na demonstração

## Objetivo e estado

Declarar buscarProduto na interface Catalogo e manter CatalogoDemonstracao
compatível. Implementação, explicação e verificações em 23/10/2026; entendimento
confirmado pelo aluno com "entendi" em 23/10/2026. Conjunto inseparável: app/Contracts/Catalogo.php e
app/Services/CatalogoDemonstracao.php. Nenhuma rota individual implementada.

A etapa 6.14 foi confirmada com "entendi" em 23/10/2026 e publicada em
198b07eae20c40698480c645f1eb4b75ae10902e. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após o push.

## Interface Catalogo

Acrescentada a assinatura, usando o import de Produto já existente:

```php
public function buscarProduto(int $id): ?Produto;
```

O ponto e vírgula encerra uma declaração sem corpo. A interface exige o método
nas implementações; não contém consulta SQL nem lógica de busca. int $id é a
entrada, ?Produto permite um Produto ou null como saída. ListarNomes e
listarProdutos permanecem declarados como antes.

CatalogoEloquent já cumpria essa assinatura desde a 6.14. Agora uma função que
recebe Catalogo pode usar buscarProduto como parte do contrato conhecido.
Não é necessário descobrir qual classe concreta foi recebida para chamar a busca.

## Implementação em CatalogoDemonstracao

```php
public function buscarProduto(int $id): ?Produto
{
    foreach ($this->listarProdutos() as $produto) {
        if ($produto->id === $id) {
            return $produto;
        }
    }

    return null;
}
```

$this é a instância atual de CatalogoDemonstracao. ListarProdutos já monta uma
coleção de models Produto em memória, com IDs fictícios e status ativo.
foreach percorre essa coleção. A comparação === exige igualdade de valor e tipo;
os IDs da demonstração e o parâmetro são inteiros.

Ao encontrar o ID, return devolve aquele Produto e encerra o método. Quando um
item não corresponde, o laço segue para o próximo; só retorna null depois de
percorrer todos sem encontrar. Esse posicionamento permite encontrar inclusive
os produtos que não são o primeiro da coleção.

Os dados existentes são: Calça/ID 2/R$ 129,90, Camiseta/ID 1/R$ 49,90 e
Tênis/ID 3/R$ 199,90. A ordem não representa o ID. Como a demonstração já lista
somente ativos, a busca reaproveita essa coleção pública sem criar consulta SQL.
Não há save/create nesse método. Os models continuam com exists false; atribuir
um ID fictício não significa persistir no banco. Atributos extras presentes no
model em memória continuam fora do JSON pelo mapeamento de ProdutoResource.

| Implementação do contrato | Onde busca | Saída |
| --- | --- | --- |
| CatalogoDemonstracao | Coleção em memória, por foreach | Produto ou null |
| CatalogoEloquent | SQL Server, filtros ativo/ID e first | Produto ou null |

O binding em AppServiceProvider continua Catalogo -> CatalogoEloquent. A aplicação
normal mantém a implementação persistida. Alterar o contrato não troca o binding.
Controller, resource, rotas e serviço Eloquent foram preservados nesta etapa.

## Verificações

PHP executado no container backend, comandos:

```sh
docker compose exec -T backend php -l app/Contracts/Catalogo.php
docker compose exec -T backend php -l app/Services/CatalogoDemonstracao.php
docker compose exec -T backend php < /tmp/curso-615-contrato-buscar-produto.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

php -l conferiu a sintaxe dos arquivos. O diagnóstico temporário fora do Git
foi enviado pela entrada padrão com <; -T desativa a alocação de terminal.
Carregou Laravel com .env.testing e definiu uma função que recebe Catalogo,
int $id e retorna ?Produto, delegando a busca ao objeto recebido.

Resultados, código 0:

- Reflection conferiu parâmetro int não nulo e retorno Produto permitindo null.
- Função recebendo Catalogo com a demo: IDs 1/2/3 retornaram os produtos e preços
  esperados; ID 999 retornou null. Valores/tipos/status ativo/exists false
  conferidos; listagens anteriores preservadas. Listener registrou zero SQL.
- Container resolveu CatalogoEloquent. Identidade loja_test/loja_testes conferida
  antes de escrever; fixtures em transação. Pela mesma função que recebe Catalogo,
  ativo retornou ID/campos/valores/tipos corretos, inativo e ausente null.
  Um SELECT por busca com parâmetros ativo/ID; finally executou rollback.
- Suíte existente: 18 testes/78 asserções passaram. As novas chamadas pelo contrato
  foram verificadas no diagnóstico dirigido, não por novos testes dessa suíte.
- Contagens posteriores: loja_test/loja_testes 0 categorias/0 produtos;
  loja/loja_app 0 categorias/1 produto, identidades conferidas separadamente.
- /tmp/curso-612-http.php confirmou API de listagem 200/application/json, objeto
  Camiseta/4990 e ID real; /loja 200/text/html com Camiseta. Não testa uma rota
  individual, que ainda não existe.

Sem nova dependência, migration, seeder ou cadastro permanente. O rollback
desfaz os registros fictícios, sem prometer restaurar o contador de IDs.

## Continuidade

Entendimento confirmado; checkpoint pronto para publicação conforme autorização persistente.
Próximo passo exato: 6.16, adicionar ProdutoController@show e a rota
GET /api/v1/produtos/{id} como conjunto inseparável. Receber o ID, chamar
Catalogo::buscarProduto, retornar ProdutoResource para encontrado ou JSON
404/{"message":"Produto não encontrado."} para ausência. Explicar a restrição
do ID e verificar HTTP, preservando a listagem. Ainda não implementado aqui.
Exercício sugerido no DBeaver continua sem relato do aluno.
