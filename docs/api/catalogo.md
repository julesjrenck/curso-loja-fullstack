# API de catálogo — contrato atual

Paginação e validação de page implementadas na etapa 6.28 em 30/10/2026.
Explicação e verificações apresentadas; entendimento da 6.28 confirmado pelo aluno
com "entendi" em 30/10/2026. A listagem agora retorna data/links/meta. Consulta individual mantém
seu contrato anterior. Desenho histórico em ../aulas/06-23-contrato-paginacao-catalogo.md.

## Listar produtos

- Método e caminho: GET /api/v1/produtos.
- URL local no host: http://127.0.0.1:8002/api/v1/produtos.
- Accept: application/json recomendado; sem corpo de requisição.
- Acesso público de leitura.
- Page opcional na query string: ?page=2. Ausente significa página 1.
- Após a normalização de entrada do Laravel, page precisa ser inteiro decimal
  positivo sem sinal ou zeros iniciais, entre 1 e 1000000 inclusive.
- Valores vazios, arrays, abc, 0, -1, 1.5, 01, +1, 1e3 ou acima do limite
  recebem 422/application/json. O sinal + como valor precisa ser codificado
  na URL, por exemplo page=%2B1; um + literal é decodificado como espaço.
- Tamanho fixo: até 10 produtos por página. Per_page não é parâmetro de
  requisição suportado; per_page na resposta informa essa capacidade fixa.
- Outros filtros e parâmetros não fazem parte deste contrato.

Somente produtos ativos, em ordem de nome segundo a ordenação SQL Server do
projeto e ID crescente como desempate. O total conta apenas ativos. A sequência
é determinística com dados inalterados; mudanças entre requisições podem mover
itens entre páginas da paginação por número.

Resposta de sucesso: 200 e Content-Type application/json. Exemplo completo
observado no servidor local normal, com um ativo na página 1:

```json
{
  "data": [
    {
      "id": 1,
      "nome": "Camiseta",
      "preco_em_centavos": 4990
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "last": "http://127.0.0.1:8002/api/v1/produtos?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
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
    "to": 1,
    "total": 1
  }
}
```

ID 1 foi observado no estado local, não é fixo pelo contrato. Valores do produto
são ilustrativos para outros bancos. Endereços usam a base da requisição;
produção ou outro host/porta produzirão outra base.

| Campo de cada produto em data | Tipo JSON | Significado |
| --- | --- | --- |
| id | inteiro | Identificador do produto persistido. |
| nome | string | Nome do produto. |
| preco_em_centavos | inteiro | Preço em centavos; 4990 corresponde a R$ 49,90. |

Esses três campos são obrigatórios e não nulos. ProdutoResource os seleciona;
status, categoria e timestamps não são enviados. Data é sempre uma lista com
somente os produtos da página solicitada.

Links contém first/last/prev/next, URLs de navegação. Prev e next são null quando
não há página anterior ou seguinte. Meta contém:

| Campo | Tipo JSON | Significado |
| --- | --- | --- |
| current_page | inteiro | Página solicitada; padrão 1. |
| per_page | inteiro | Capacidade fixa 10, mesmo com menos itens na página. |
| total | inteiro | Total de produtos ativos em todas as páginas. |
| last_page | inteiro | Última página calculada; pelo menos 1. |
| from e to | inteiro ou null | Posições inicial/final na lista; null para página vazia. |
| path | string | URL base da listagem. |
| links | lista | Opções de navegação geradas pelo Laravel. |

Cada item de meta.links contém url (string/null), label (string), page
(inteiro/null) e active (booleano) na versão instalada. Labels podem variar
com a tradução; não são identificadores de negócio. O consumidor pode usar
links.next/prev para navegação sem interpretar esses rótulos.

Sem ativos, continua 200: data [], total 0, current_page 1 se omitido, last_page 1,
from/to null, first/last para page=1 e prev/next null. O envelope mantém links/meta.

Com onze ativos, page=1 retorna dez e page=2 retorna um; ambas têm total 11 e
last_page 2. Page=3 é válida e retorna 200/data [], current_page 3, total 11,
last_page 2, from/to null, prev para page=2 e next null. Page inválida ou fora do
intervalo permitido recebe 422, mesmo que a coleção esteja vazia.

No erro de validação, o corpo contém message e errors.page, uma lista de
mensagens. Seus textos não são fixados pelo contrato. Esse 422 pertence à
validação da query da listagem; produto individual indisponível continua 404.

O consumidor precisa navegar pelas páginas para obter todos os ativos.
A partir da 6.28, uma única resposta da listagem contém apenas a página solicitada.

## Consultar produto por ID

Implementado na 6.16, preservado na 6.28.

- Método e caminho: GET /api/v1/produtos/{id}.
- URL local ilustrativa: http://127.0.0.1:8002/api/v1/produtos/1.
- ID obrigatório: inteiro positivo em decimal sem zeros à esquerda, até
  PHP_INT_MAX (9223372036854775807 na imagem PHP 64 bits atual).
- Sem corpo de requisição; Accept: application/json recomendado.
- Acesso público de leitura; não recebe os parâmetros de paginação da listagem.
- Produto ativo encontrado: 200 e Content-Type application/json.
- ID válido inexistente ou de produto inativo: 404 e Content-Type application/json.

Sucesso com um objeto em data, usando os mesmos campos/tipos de produto:

```json
{"data":{"id":1,"nome":"Camiseta","preco_em_centavos":4990}}
```

ID e preço ilustrativos; o ID real corresponde ao solicitado. Inexistente e
inativo recebem o mesmo corpo:

```json
{"message":"Produto não encontrado."}
```

Produto inativo permanece cadastrado. ID numérico positivo acima da faixa de int
recebe esse mesmo 404/message, sem consultar o banco. Formatos fora do padrão,
como abc, 0, -1, 1.5 ou 01, recebem 404 JSON do roteamento antes de show. O texto
desses erros de rota não é padronizado por este contrato.

## Implementação e verificações da 6.28

ProdutoController@index recebe ListarProdutosRequest e Catalogo. Laravel resolve
e valida o Form Request antes de executar index; pagina() fornece o inteiro
validado ou padrão 1. Index chama paginarProdutos pelo contrato e devolve
ProdutoResource::collection do paginator. O Laravel produz data/links/meta.
Binding continua CatalogoEloquent, que executa contagem e busca paginada com
filtro ativo, ordem nome/ID e somente id/nome/preço. No vazio, somente a contagem.
CatalogoDemonstracao atende à mesma assinatura em memória.

Show e sua validação de ID continuam como antes. ListarNomes continua atendendo
à página Blade /loja. Rotas e middleware não foram alterados nesta etapa.

Os quatro cenários permanentes de listagem (vazio, ativo, omissão de inativo e
ordem) usam assertPaginaUnica no teste: conferem data completa, status/cabeçalho,
links e metadados, com fixtures que cabem na primeira página. Os nove casos de
consulta individual permanecem. Classe 13 testes/107 asserções e suíte completa
27 testes/161 asserções passaram; contagens posteriores teste 0 categorias/0
produtos e normal 0 categorias/1 produto.

Diagnóstico adicional pelo kernel HTTP em loja_test/transação conferiu vazio,
onze ativos/inativo, empate por ID entre páginas, padrão/page=1/2/3/1000000,
links/metadados, onze entradas inválidas com 422/zero SQL e individual preservado.
Rollback desfez fixtures. Na 6.28, páginas seguintes/limites/422 foram conferidos
por diagnóstico; a cobertura permanente da página 2 foi acrescentada na 6.29.

HTTP real conferiu listagem paginada, page=2 vazia no banco normal com um ativo,
individual pelo ID obtido da listagem, page=0 com 422 e /loja com HTML/produto.
Diagnósticos: /tmp/curso-628-http-paginacao.php e /tmp/curso-628-http-real.php.
Explicação e comandos na [aula 06-28](../aulas/06-28-paginacao-http.md).

## Cobertura acrescentada na 6.29

Um teste permanente solicita page=2 com onze ativos e um inativo. Dois ativos
chamados Produto 10 ocupam as posições 10/11 na ordem nome/ID. A resposta deve
conter apenas o segundo, com ID gerado e preço 2000; links first/prev para 1,
last para 2 e next null. Confere página 2, per_page 10, total 11, última 2 e
from/to 11. Assim cobre seleção, filtro, desempate, total e navegação nessa página.
Classe 14 testes/120 asserções e suíte 28 testes/174 asserções passaram;
contagens dos bancos preservadas. Nenhuma alteração no contrato HTTP executável.
Na 6.29, limites e respostas 422 foram conferidos apenas nos diagnósticos
anteriores; o primeiro teste permanente de 422 foi acrescentado na 6.30. Entendimento da 6.29 confirmado com "entendi" em 30/10/2026.
Explicação na [aula 06-29](../aulas/06-29-teste-segunda-pagina.md).

## Cobertura acrescentada na 6.30

Novo teste solicita GET /api/v1/produtos?page=0 sem criar produtos. Exige 422,
Content-Type application/json, chave message e campo page em errors usando
assertJsonValidationErrors(['page']). Não fixa o texto traduzível nem restringe
a existência de outros campos de erro. A regra min:1 já existia no Form Request;
o teste protege sua integração HTTP. Não mede SQL. Outras entradas inválidas e
limites continuam nos diagnósticos anteriores.
Classe 15 testes/128 asserções e suíte 29 testes/182 asserções passaram, contagens
preservadas. Entendimento da 6.30 confirmado com "entendi" em 30/10/2026. Explicação na
[aula 06-30](../aulas/06-30-teste-pagina-zero.md).

## Evolução

Da 6.2 à 6.11, data continha nomes em strings. Na 6.12, passou a objetos com
id/nome/preço. Da 6.23 à 6.27, paginação foi desenhada e preparada sem mudar o
HTTP. Na 6.28, listagem e testes foram adaptados para data/links/meta, page opcional
e 422 para entradas inválidas. O histórico detalhado está em docs/progresso.md
e nas aulas; as seções de listagem e consulta individual acima descrevem o código
executável atual. Filtros adicionais, outras operações e OpenAPI entrarão gradualmente.
