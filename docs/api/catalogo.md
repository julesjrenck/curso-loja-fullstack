# Contrato inicial da API de catálogo

Introduzido na etapa 6.2 em 22/10/2026. Implementado e verificado;
entendimento confirmado pelo aluno com "entendi" em 22/10/2026.
Documento evoluirá com as aulas.

## Consultar nomes de produtos

- Método e caminho: GET /api/v1/produtos.
- URL local no host: http://127.0.0.1:8002/api/v1/produtos.
- Cabeçalho recomendado da requisição: Accept: application/json.
- Corpo de requisição: nenhum.
- Acesso público de leitura nesta etapa.
- Nenhum parâmetro de consulta faz parte deste contrato inicial.

Resposta de sucesso: status 200, Content-Type: application/json.

```json
{"data":["Camiseta"]}
```

`data` é uma lista de strings com os nomes dos produtos ativos em ordem
alfabética, usando a ordenação do SQL Server configurado. Não elimina nomes
repetidos. Nesta etapa, todos os nomes ativos são retornados, sem paginação.
Não há IDs, preços ou categorias na resposta inicial.

Quando não há produtos ativos, a resposta de sucesso continua 200:

```json
{"data":[]}
```

O formato de lista vazia foi verificado na etapa 6.3 pelo teste HTTP
CatalogoApiTest, com SQL Server exclusivo de testes e rollback. Implementação,
explicação e verificações da 6.3 apresentadas; entendimento confirmado pelo aluno
com "entendi" em 22/10/2026.
Na etapa 6.4, acrescentado cenário HTTP de uma Camiseta ativa que exige
{"data":["Camiseta"]}, status 200 e Content-Type application/json. Classe
CatalogoApiTest com 2 testes/12 asserções passou; entendimento da 6.4 confirmado
com "entendi" em 22/10/2026. Filtro de inativos e ordenação ainda não têm
cenários HTTP próprios.
Na 6.5, acrescentado cenário com Camiseta ativa e Caneca inativa, exigindo apenas
Camiseta no JSON. Classe 3 testes/18 asserções e suíte 17/72 passaram;
entendimento da 6.5 confirmado com "entendi" em 22/10/2026.
A ordenação com vários ativos continua
sem um cenário HTTP próprio.
Na 6.6, acrescentado cenário que cadastra Caneca e depois Camiseta, ambas ativas,
e exige {"data":["Camiseta","Caneca"]}, incluindo a ordem da lista. Classe
4 testes/24 asserções e suíte 18/78 passaram; entendimento da 6.6 confirmado
com "entendi" em 22/10/2026. O contrato de sucesso agora tem cenários HTTP para catálogo vazio,
produto ativo, omissão de inativo e ordenação desses nomes.
Na 6.7, a ação foi movida para App\Http\Controllers\Api\V1\ProdutoController@index,
mantendo URL e resposta. Os quatro testes HTTP existentes (4/24), a suíte (18/78)
e HTTP real passaram; entendimento da 6.7 confirmado com "entendi" em 22/10/2026. O contrato atual
continua retornando somente nomes.
Este documento descreve o sucesso da primeira consulta. Erros, outros métodos,
filtros, paginação e a descrição em OpenAPI serão estudados gradualmente.

## Próxima representação — desenho da etapa 6.8

Planejado em 22/10/2026, ainda não implementado; entendimento do desenho
confirmado pelo aluno com "entendi" em 22/10/2026. O contrato ativo acima
continua retornando nomes.

Cada item de data passará a ser um objeto com id inteiro, nome string e
preco_em_centavos inteiro, todos obrigatórios e não nulos. Exemplo ilustrativo,
sem vínculo com o ID real do banco:

```json
{"data":[{"id":1,"nome":"Camiseta","preco_em_centavos":4990}]}
```

4990 centavos correspondem a R$ 49,90. Manteremos GET /api/v1/produtos, status
200, Content-Type application/json, ativos e ordenação por nome. Lista vazia
continuará data: []; sem paginação nesta fase. Os campos status, categoria e
timestamps não farão parte dessa representação.

Trocar strings por objetos é uma mudança incompatível no formato dos itens.
Preparar leitura e transformação e coordenar a troca com documentação, testes e
eventuais consumidores. ListarNomes e a página Blade continuarão com strings;
a evolução da API não deve alterar silenciosamente esse método.

O desenho detalhado e o impacto nos testes estão em
docs/aulas/06-08-representacao-produto.md. Próxima etapa:
introduzir ProdutoResource e verificar em memória, sem trocar a rota ainda.
