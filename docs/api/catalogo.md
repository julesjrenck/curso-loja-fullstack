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
Este documento descreve o sucesso da primeira consulta. Erros, outros métodos,
filtros, paginação e a descrição em OpenAPI serão estudados gradualmente.
