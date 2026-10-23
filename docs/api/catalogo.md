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

O sucesso da listagem está descrito acima. Consulta individual é descrita abaixo;
outras operações, erros gerais, filtros, paginação e OpenAPI entrarão gradualmente.

## Consultar produto por ID

Implementado na 6.16 em 23/10/2026; explicação e verificações apresentadas,
entendimento da 6.16 confirmado com "entendi" em 23/10/2026. Desenho da 6.13 confirmado anteriormente.

- Método e caminho: GET /api/v1/produtos/{id}.
- URL local ilustrativa: http://127.0.0.1:8002/api/v1/produtos/1.
- ID obrigatório: inteiro positivo em decimal sem zeros à esquerda, até
  PHP_INT_MAX (9223372036854775807 na imagem PHP 64 bits atual).
- Sem corpo de requisição; Accept: application/json recomendado.
- Acesso público de leitura; não há parâmetro de consulta neste contrato inicial.
- Produto ativo encontrado: 200 e Content-Type application/json.
- ID válido inexistente ou de produto inativo: 404 e Content-Type application/json.

Sucesso com um objeto em data, usando os mesmos campos/tipos da listagem:

```json
{"data":{"id":1,"nome":"Camiseta","preco_em_centavos":4990}}
```

ID e preço ilustrativos; o ID real corresponde ao solicitado. Inexistente e
inativo recebem o mesmo corpo:

```json
{"message":"Produto não encontrado."}
```

Essa é a regra do catálogo público, sem excluir o produto inativo. Coleção vazia
continua 200/data: []; produto individual indisponível retorna 404.
ID numérico positivo acima da faixa de int também retorna 404 com essa message,
sem consultar o banco. Formatos fora do padrão, como abc, 0, -1, 1.5 ou 01,
recebem 404 JSON do roteamento, sem executar show. O corpo desses erros de rota
não está padronizado por este contrato; a message exata é produzida por show.

ProdutoController@show recebe Catalogo e o ID textual, valida/converte o inteiro,
chama buscarProduto e retorna ProdutoResource ou JsonResponse. O binding continua
CatalogoEloquent; a consulta filtra ativo/ID e seleciona os três campos.
CatalogoDemonstracao implementa a mesma assinatura, em memória.

Na 6.16, diagnóstico pelo kernel HTTP em banco exclusivo/transação conferiu dois
ativos, ausente, inativo e formatos/faixa do ID; dados fictícios desfeitos.
HTTP real confirmou produto com ID obtido da listagem e erro para número acima
da faixa. Suíte existente 18/78 passou; testes permanentes da consulta individual
serão introduzidos a partir da 6.17. Aula docs/aulas/06-16-consulta-individual-http.md.
O desenho histórico está em docs/aulas/06-13-consulta-individual-contrato.md.

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

O histórico detalhado está em docs/progresso.md e nas aulas 06-02 a 06-16.
As descrições atuais de listagem e consulta individual correspondem ao código executável.
