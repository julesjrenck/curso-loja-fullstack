# Aula 6.23 — Desenho do contrato de paginação da listagem

## Objetivo e estado

Desenho, explicação e verificação em memória em 30/10/2026 após confirmação e
publicação da 6.22 em 6f49a067ba84f64ede316593b5f40c8164fd461c. HEAD, origin/main
e main remota conferidos após push. Entendimento da 6.23 confirmado pelo aluno
com "entendi" em 30/10/2026. Somente documentos alterados; paginação ainda não implementada na API.
O contrato executável atual permanece em docs/api/catalogo.md.

## Problema e decisões do desenho

Hoje GET /api/v1/produtos devolve todos os ativos de uma vez. Paginar é dividir
esse resultado ordenado em partes: com 11 ativos e 10 por página, a primeira
contém 10 produtos e a segunda contém o último. O banco entregará somente a
parte solicitada quando implementarmos a consulta paginada.

Decisões para a próxima versão da listagem dentro deste curso:

- GET /api/v1/produtos?page=2 solicita a página 2; sem page, usar página 1.
- Até 10 produtos por página, valor fixo do projeto; per_page será um campo da
  resposta, sem parâmetro de requisição para configurá-lo nesta versão.
- Page será texto decimal de inteiro positivo, sem zeros à esquerda, entre
  1 e 1000000 inclusive. Limite escolhido pelo projeto para limitar o deslocamento
  da consulta a 9999990 linhas com 10 por página; não é um limite do Laravel.
- Page vazio, abc, 0, -1, 1.5, 01, array ou acima do limite: planejar 422 JSON
  com message e errors.page, uma lista de mensagens; sem fixar seus textos.
  A validação será preparada antes de ligar a paginação à rota.
- Somente ativos; ordem por nome segundo a ordenação SQL Server existente,
  com ID crescente como desempate para nomes iguais. Total conta somente ativos.
- Cada produto mantém id, nome e preco_em_centavos, com os tipos atuais.
- Página válida, inclusive vazia ou após a última: 200/application/json.
  A ausência de itens da coleção continua sendo sucesso.
- A resposta terá data, links e meta, seguindo a serialização de resources
  paginados do Laravel instalado. Consulta individual por ID mantém seu contrato.

O máximo de page protege o cálculo de deslocamento e define um limite de navegação
para esta versão didática; limites poderão ser revistos se o catálogo crescer.
Ordenação com desempate torna a sequência determinística para dados inalterados.
Inserções, exclusões ou mudanças entre requisições podem deslocar itens entre
páginas; a paginação por número não representa um retrato congelado do catálogo.

## Exemplo completo: segunda página de 11 produtos ativos

Requisição planejada: GET /api/v1/produtos?page=2. Status 200 e Content-Type
application/json. Os dez primeiros ativos já estariam na página 1. O Tênis
abaixo ocupa a posição 11 na lista ordenada; ID 37 é ilustrativo e não indica
posição ou número de página. O cenário foi montado em memória, sem cadastros.

```json
{
  "data": [
    {
      "id": 37,
      "nome": "Tênis",
      "preco_em_centavos": 12990
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "last": "http://127.0.0.1:8002/api/v1/produtos?page=2",
    "prev": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "next": null
  },
  "meta": {
    "current_page": 2,
    "from": 11,
    "last_page": 2,
    "links": [
      {
        "url": "http://127.0.0.1:8002/api/v1/produtos?page=1",
        "label": "&laquo; Previous",
        "page": 1,
        "active": false
      },
      {
        "url": "http://127.0.0.1:8002/api/v1/produtos?page=1",
        "label": "1",
        "page": 1,
        "active": false
      },
      {
        "url": "http://127.0.0.1:8002/api/v1/produtos?page=2",
        "label": "2",
        "page": 2,
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "page": null,
        "active": false
      }
    ],
    "path": "http://127.0.0.1:8002/api/v1/produtos",
    "per_page": 10,
    "to": 11,
    "total": 11
  }
}
```

Data contém só os produtos da página atual. Links contém URLs para primeira,
última, anterior e próxima; null significa ausência daquela navegação. Endereço
local é ilustrativo; em outro ambiente a base da URL muda.

| Campo em meta | Significado |
| --- | --- |
| current_page | Número da página solicitada. |
| per_page | Capacidade da página: 10, mesmo que ela contenha menos itens. |
| total | Total de produtos ativos, considerando todas as páginas. |
| last_page | Última página calculada; pelo menos 1, inclusive no catálogo vazio. |
| from e to | Posições inicial/final dos itens na lista ordenada; null se vazia. |
| path | Endereço base da listagem. |
| links | Lista de opções de navegação gerada pelo Laravel. |

Meta.links contém objetos com url, label, page e active na versão instalada.
Url e page podem ser null; active identifica a página atual quando presente.
Label é texto de exibição e pode variar conforme tradução; não deve ser usado
como regra de negócio. Os exemplos usam a tradução inglesa apenas na simulação.
O consumidor pode navegar por links.next/prev sem depender desses rótulos.

A página 2 deste exemplo tem um produto, enquanto per_page continua 10 e total
continua 11. From/to valem 11: são posições, não IDs. Last_page vale 2 porque
11 produtos distribuídos em grupos de até 10 precisam de duas páginas.

## Catálogo vazio

Requisição planejada: GET /api/v1/produtos, equivalente à página 1. Status 200,
com data vazia e as informações de navegação:

```json
{
  "data": [],
  "links": {
    "first": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "last": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": null,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "page": null,
        "active": false
      },
      {
        "url": "http://127.0.0.1:8002/api/v1/produtos?page=1",
        "label": "1",
        "page": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "page": null,
        "active": false
      }
    ],
    "path": "http://127.0.0.1:8002/api/v1/produtos",
    "per_page": 10,
    "to": null,
    "total": 0
  }
}
```

Last_page permanece 1 por convenção do paginador. From/to são null porque não
existem posições de itens. First e last apontam para a página 1; prev/next são null.

Se houver 11 ativos e o cliente pedir page=3, a resposta planejada também será
200: data [], current_page 3, last_page 2, total 11, from/to null, prev aponta
para page=2 e next é null. A página pedida é válida, embora não contenha itens.
Esse terceiro cenário também foi conferido na simulação.

## Relação com os arquivos e impacto futuro

Docs/api/catalogo.md continua descrevendo a implementação atual, sem paginação.
Esta aula guarda o desenho futuro e não altera o comportamento da aplicação.
Na integração, consumidores precisarão navegar pelas páginas; ler apenas data
da primeira resposta deixará de representar o catálogo inteiro. Os testes de
listagem com assertExactJson precisarão acompanhar links/meta quando a resposta
for efetivamente alterada.

A consulta paginada entrará em CatalogoEloquent e no contrato Catalogo, com
adaptação compatível de CatalogoDemonstracao. ProdutoController@index ligará
essa leitura à coleção de ProdutoResource. O resource continua selecionando os
três campos de cada produto; o paginador fornece totais/links/meta da coleção.
ListarNomes continuará atendendo à página Blade. Não implementamos essas mudanças
nesta etapa nem mudamos os retornos das interfaces antecipadamente.

## Verificação e seus limites

Referências oficiais consultadas: [paginação no Laravel 13](https://laravel.com/framework/docs/13.x/pagination)
e [resources paginados](https://laravel.com/framework/docs/13.x/eloquent-resources#pagination).
Conferida também a classe instalada PaginatedResourceResponse para distinguir
os campos de links/meta do JSON de um paginator devolvido diretamente.

Executado no PHP Docker, código 0:

```sh
docker compose exec -T backend php < /tmp/curso-623-paginacao.php
```

O redirecionamento envia o script temporário ao PHP dentro do container. O
script carrega o Laravel, monta um Produto somente em memória por forceFill e
constrói um LengthAwarePaginator com itens já recortados, total, tamanho 10,
página e path explícitos. Por exemplo, segunda página recebe um item e total 11.
ProdutoResource::collection(...)->toResponse(...) gera o corpo JSON. Não houve
requisição à rota ou execução do método paginate sobre o banco.

O diagnóstico decodifica JSON com JSON_THROW_ON_ERROR e confere os três cenários:
status/cabeçalho, campos de produto, data, current_page/per_page/total/last_page,
from/to e links de navegação. Um observador DB::listen confirmou zero consultas
nesse processo; o model continuou com exists false. O JSON completo foi salvo
somente em /tmp/curso-623-exemplos.json e usado para preparar os dois exemplos
completos desta aula. A terceira página vazia foi conferida no mesmo diagnóstico.

Isso verifica o formato gerado pelo Laravel com dados em memória. Não comprova
consulta SQL paginada, validação de page, ordenação ou integração HTTP futura.
A regra de erro 422 está somente desenhada. Arquivos de aplicação, configuração
e dependências preservados. Suíte não repetida: último resultado pertence à
6.22, 27 testes/133 asserções. Git diff --check passou.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
92ce498e85ae0352a2eb5c94103bc6b9f1aad281, `docs: desenha contrato de paginação do catálogo`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem incluir o SHA no próprio commit.
Continuidade realizada na 6.24: criar Form Request para validar page opcional
entre 1 e 1000000, ainda sem ligar a paginação à rota. Ausência de page
representará página 1 na integração.
