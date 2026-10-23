# API de catálogo — contrato atual

Formato de produtos implementado na etapa 6.12 em 23/10/2026. Implementação,
explicação e verificações apresentadas; entendimento da 6.12 confirmado pelo aluno
com "entendi" em 23/10/2026, após esclarecer onde a consulta é executada.

## Listar produtos

- Método e caminho: GET /api/v1/produtos.
- URL local no host: http://127.0.0.1:8002/api/v1/produtos.
- Cabeçalho recomendado da requisição: Accept: application/json.
- Corpo de requisição: nenhum.
- Acesso público de leitura nesta etapa.
- Nenhum parâmetro de consulta faz parte deste contrato inicial.

Resposta de sucesso: status 200 e Content-Type: application/json. O objeto
externo contém data, uma lista de objetos de produto. Exemplo:

```json
{
  "data": [
    {
      "id": 1,
      "nome": "Camiseta",
      "preco_em_centavos": 4990
    }
  ]
}
```

O ID do exemplo é ilustrativo; o valor real identifica o produto daquele banco.

| Campo de cada produto | Tipo JSON | Significado |
| --- | --- | --- |
| id | inteiro | Identificador do produto persistido. |
| nome | string | Nome do produto. |
| preco_em_centavos | inteiro | Preço em centavos; 4990 corresponde a R$ 49,90. |

Os três campos são obrigatórios e não nulos nessa representação. ProdutoResource
seleciona somente esses campos. Status, categoria e timestamps não são enviados.
O cliente pode formatar o preço para exibição; a API fornece o valor numérico.

A consulta inclui apenas produtos ativos e os ordena por nome, segundo a
ordenação do SQL Server configurado. Produtos com nomes iguais continuam sendo
itens distintos, identificados por seus IDs. Sem paginação nesta etapa: todos
os ativos são retornados.

Sem produtos ativos, o sucesso continua 200 e o corpo é:

```json
{"data":[]}
```

Este documento descreve o sucesso da listagem. Consulta individual, outras
operações, erros, filtros, paginação e OpenAPI serão introduzidos gradualmente.

## Consulta individual — desenho da etapa 6.13

Planejada em 23/10/2026, ainda não implementada; entendimento da 6.13 confirmado
pelo aluno com "entendi" em 23/10/2026. A seção de listagem acima continua descrevendo o contrato ativo.

- Método e caminho planejados: GET /api/v1/produtos/{id}.
- ID de caminho: identificador inteiro positivo, por exemplo /api/v1/produtos/1.
- Sem corpo de requisição; Accept: application/json.
- Produto ativo encontrado: 200 e Content-Type application/json.
- ID inexistente ou produto inativo: 404 e Content-Type application/json.

Sucesso com um objeto em data, usando os campos/tipos da listagem:

```json
{"data":{"id":1,"nome":"Camiseta","preco_em_centavos":4990}}
```

O ID do exemplo é ilustrativo. Na resposta real deverá corresponder ao solicitado.
Para inexistente ou inativo, o corpo planejado será o mesmo:

```json
{"message":"Produto não encontrado."}
```

Essa é a regra do catálogo público, sem excluir o produto inativo do banco.
Coleção vazia continua 200/data: []; consulta individual indisponível será 404.
O formato de erro acima é específico dessa operação planejada; não documenta
um tratamento geral de todos os erros do framework. Restrições sintáticas do ID
serão detalhadas ao implementar. Desenho em docs/aulas/06-13-consulta-individual-contrato.md.

Preparação interna: na 6.14, CatalogoEloquent recebeu buscarProduto(int $id):
?Produto, ativo/ID e três atributos; entendimento confirmado e checkpoint publicado.
Na 6.15, método declarado em Catalogo e implementado por CatalogoDemonstracao,
com busca em memória e null para ausente. Diagnóstico dirigido conferiu ambas as
implementações pelo contrato. Ainda sem chamada por controller/rota; não torna
esse endpoint executável. Entendimento da 6.15 confirmado com "entendi" em 23/10/2026. Aula
docs/aulas/06-15-contrato-busca-individual.md.

## Implementação e verificação

ProdutoController@index chama Catalogo::listarProdutos e retorna
ProdutoResource::collection. O binding resolve CatalogoEloquent, que seleciona
id/nome/preço dos ativos em ordem. Laravel transforma os resources e envolve a
lista em data. ListarNomes continua atendendo ao fluxo da página Blade /loja.

Os quatro cenários HTTP de CatalogoApiTest cobrem vazio, produto ativo, omissão
de inativo e ordenação, exigindo o JSON exato com IDs gerados e preços explícitos.
Na 6.12: classe 4 testes/24 asserções e suíte 18 testes/78 asserções passaram.
HTTP real confirmou o objeto com três campos; /loja manteve HTML e Camiseta.
Contagens dos bancos preservadas após os testes; dados fictícios desfeitos.

## Evolução da representação

Da 6.2 à 6.11, data continha strings, por exemplo {"data":["Camiseta"]}.
O desenho com objetos foi explicado e confirmado na 6.8; resource, leitura e
contrato interno foram preparados nas 6.9–6.11. Na 6.12, resposta e testes foram
trocados juntos para objetos. Consumidores do formato anterior precisam ler
nome dentro de cada item. Não há endpoint separado de nomes nesta API.

O histórico detalhado está em docs/progresso.md e nas aulas 06-02 a 06-12.
A descrição atual acima corresponde ao código executável.
