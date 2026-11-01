# API de catálogo — contrato atual

Contrato executável da listagem com paginação e filtro por nome, integrado na
etapa 6.39 em 01/11/2026. Explicação e verificações apresentadas; entendimento da
6.39 confirmado com "entendi" em 01/11/2026. Consulta individual mantém seu contrato anterior.
Desenhos históricos: [paginação](../aulas/06-23-contrato-paginacao-catalogo.md) e
[filtro por nome](../aulas/06-34-contrato-filtro-nome.md).

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
- Nome opcional na query: ?nome=camiseta&page=2. Omitido não filtra por nome.
  Quando presente, texto não vazio de até 100 caracteres após normalização do
  Laravel. Espaços externos removidos, internos preservados; '0' é texto válido.
  Vazio, somente espaços, array ou acima de 100 recebe 422/errors.nome.
- Nome seleciona produtos cujo nome contenha o trecho literal, em qualquer
  posição. Ignora maiúsculas/minúsculas e distingue acentos conforme a collation
  SQL_Latin1_General_CP1_CI_AS da coluna no projeto. Camiseta corresponde a camiseta;
  Tênis corresponde a tênis, mas não a tenis. Não faz busca aproximada ou por
  palavras separadas; %, _ e [ são caracteres literais, sem curingas.
- Na URL, codificar valores reservados: + como %2B, % como %25 e & como %26.
  Texto validado é passado como parâmetro SQL.
- Links de navegação preservam somente nome normalizado, quando informado,
  além do page gerenciado pelo paginador. Ordem dos parâmetros não é relevante.
  Parâmetros desconhecidos são ignorados e não são repassados aos links.
- Outros filtros e parâmetros não fazem parte deste contrato.

Somente produtos ativos, em ordem de nome segundo a ordenação SQL Server do
projeto e ID crescente como desempate. Nome é aplicado antes de contar e paginar.
O total conta somente os ativos correspondentes ao filtro; sem nome, todos os
ativos. A sequência
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
não há página anterior ou seguinte. URLs não nulas preservam nome normalizado,
assim como as de meta.links. Exemplo real com nome=Camiseta no catálogo local:

```json
{
  "first": "http://127.0.0.1:8002/api/v1/produtos?nome=Camiseta&page=1",
  "last": "http://127.0.0.1:8002/api/v1/produtos?nome=Camiseta&page=1",
  "prev": null,
  "next": null
}
```

Em um catálogo com doze correspondentes, next na primeira página aponta para
nome=Camiseta&page=2 e a segunda mantém total 12. Meta contém:

| Campo | Tipo JSON | Significado |
| --- | --- | --- |
| current_page | inteiro | Página solicitada; padrão 1. |
| per_page | inteiro | Capacidade fixa 10, mesmo com menos itens na página. |
| total | inteiro | Total de ativos correspondentes em todas as páginas; sem nome, todos os ativos. |
| last_page | inteiro | Última página calculada; pelo menos 1. |
| from e to | inteiro ou null | Posições inicial/final na lista; null para página vazia. |
| path | string | URL base da listagem. |
| links | lista | Opções de navegação geradas pelo Laravel. |

Cada item de meta.links contém url (string/null), label (string), page
(inteiro/null) e active (booleano) na versão instalada. Labels podem variar
com a tradução; não são identificadores de negócio. O consumidor pode usar
links.next/prev para navegação sem interpretar esses rótulos.

Sem ativos correspondentes, continua 200: data [], total 0, current_page 1 se omitido, last_page 1,
from/to null, first/last para page=1 e prev/next null. O envelope mantém links/meta.

Com onze ativos correspondentes, page=1 retorna dez e page=2 retorna um; ambas têm total 11 e
last_page 2. Page=3 é válida e retorna 200/data [], current_page 3, total 11,
last_page 2, from/to null, prev para page=2 e next null. Page inválida ou fora do
intervalo permitido recebe 422, mesmo que a coleção esteja vazia.

No erro de validação, o corpo contém message e errors.page e/ou errors.nome,
conforme os campos inválidos; cada campo contém uma lista de mensagens. Seus textos não são fixados pelo contrato. Esse 422 pertence à
validação da query da listagem; produto individual indisponível continua 404.

O consumidor precisa navegar pelas páginas para obter todos os ativos correspondentes.
A partir da 6.28, uma única resposta da listagem contém apenas a página solicitada.

## Consultar produto por ID

Implementado na 6.16, preservado na 6.39.

- Método e caminho: GET /api/v1/produtos/{id}.
- URL local ilustrativa: http://127.0.0.1:8002/api/v1/produtos/1.
- ID obrigatório: inteiro positivo em decimal sem zeros à esquerda, até
  PHP_INT_MAX (9223372036854775807 na imagem PHP 64 bits atual).
- Sem corpo de requisição; Accept: application/json recomendado.
- Acesso público de leitura; não recebe os parâmetros page/nome da listagem.
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

## Histórico de implementação e verificações

Os registros abaixo descrevem o estado em cada etapa. Referências a partes
pendentes nesses registros são históricas; o comportamento atual está nas
seções de listagem e consulta individual acima.

### Implementação e verificações da 6.28

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

### Cobertura acrescentada na 6.29

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

### Cobertura acrescentada na 6.30

Novo teste solicita GET /api/v1/produtos?page=0 sem criar produtos. Exige 422,
Content-Type application/json, chave message e campo page em errors usando
assertJsonValidationErrors(['page']). Não fixa o texto traduzível nem restringe
a existência de outros campos de erro. A regra min:1 já existia no Form Request;
o teste protege sua integração HTTP. Não mede SQL. Na 6.30, outras entradas
inválidas e limites ainda foram conferidos somente por diagnóstico.
Classe 15 testes/128 asserções e suíte 29 testes/182 asserções passaram, contagens
preservadas. Entendimento da 6.30 confirmado com "entendi" em 30/10/2026. Explicação na
[aula 06-30](../aulas/06-30-teste-pagina-zero.md).

### Cobertura acrescentada na 6.31

O teste de page=0 foi generalizado com DataProvider de onze queries: zero,
vazio, negativo, decimal, zero inicial, letras, array (page[]=1), sinal positivo
(page=%2B1), notação científica, acima do limite (1000001) e acima da faixa de
int (PHP_INT_MAX concatenado com '0'). Cada execução exige 422/application/json,
message e campo page em errors, sem fixar tradução. O sinal + é codificado para
que a query não o transforme em espaço; vazio presente é diferente de omissão.
Classe 25 testes/208 asserções e suíte 39 testes/262 asserções passaram;
contagens preservadas. Código da aplicação preservado. Na 6.31, página após a
última e limite superior válido ainda tinham apenas diagnóstico específico.
Entendimento da 6.31 confirmado com "entendi" em 30/10/2026. Explicação na
[aula 06-31](../aulas/06-31-paginas-invalidas-provider.md).

### Cobertura acrescentada na 6.32

Novo teste cria um ativo e solicita page=2. Exige 200/application/json/data [],
meta com current_page 2, per_page 10, total 1, last_page 1 e from/to null.
Links first/last/prev apontam para 1 e next é null. Assim a página pedida fica
vazia sem perder a contagem de ativos do catálogo. Aplicação preservada.
Classe 26 testes/221 asserções e suíte 40 testes/275 asserções passaram;
contagens antes/depois preservadas. Na 6.32, o limite superior válido ainda tinha
apenas diagnóstico específico anterior. Entendimento da 6.32 confirmado com "entendi" em 30/10/2026. Explicação na
[aula 06-32](../aulas/06-32-pagina-apos-ultima.md).

### Cobertura acrescentada na 6.33

O teste após a última recebe pagina/paginaAnterior pelo provider paginasAposUltima:
[2, 1] e [1000000, 999999]. Cada caso cria um ativo, exige 200/JSON/data [], total 1,
última 1, from/to null e página atual solicitada. Links first/last apontam para 1,
prev para a página anterior indicada e next é null. O limite válido 1000000 fica
coberto permanentemente, assim como o inválido 1000001/422 já coberto na 6.31.
Classe da API passou; suíte completa 41 testes/288 asserções passou, contagens
preservadas. Código da aplicação preservado. Entendimento da 6.33 confirmado com "entendi" em 30/10/2026. Explicação na [aula 06-33](../aulas/06-33-limite-paginacao.md).

### Desenho do filtro — etapa 6.34

O filtro por nome está desenhado na [aula 06-34](../aulas/06-34-contrato-filtro-nome.md),
com implementação gradual. Planejado: nome opcional como trecho literal de 1 a 100
caracteres após normalização, filtrar ativos antes de contar/paginar e preservar
nome nos links. Comparação seguirá a collation atual, ignorando caixa e distinguindo
acentos. A validação de nome entrou na 6.35 e o filtro está preparado no serviço
concreto desde a 6.37; busca HTTP por nome e preservação nos links ainda pendentes. As seções de listagem e consulta individual
acima descrevem o comportamento executável atual.
Entendimento da 6.34 confirmado com "entendi" em 01/11/2026. As verificações de collation não
constituem teste do filtro HTTP futuro.

### Implementação parcial na 6.35 — validação de nome

ListarProdutosRequest valida nome com bail/sometimes/required/string/max:100.
Index já usa esse Form Request, portanto entradas inválidas agora recebem 422
antes de executar o controller. Nome válido ainda não é passado ao serviço.
Diagnóstico HTTP temporário conferiu 12 válidos/7 inválidos, normalização/tipos,
limites de caracteres ASCII/Unicode e ausência de SQL nas rejeições. Dois ativos
em transação continuaram na resposta com nome=zzzinexistente: filtro não aplicado.
Consulta individual preservada, rollback e contagens conferidos. Suíte existente
41 testes/288 asserções passou; ainda sem teste permanente novo para nome.
Explicação na [aula 06-35](../aulas/06-35-validacao-nome.md). Entendimento da 6.35 confirmado com "entendi" em 01/11/2026.

### Preparação interna na 6.36 — nome validado

ListarProdutosRequest recebeu nome(): ?string com validated('nome'). Depois da
validação, retorna texto normalizado ou null quando omitido, preservando '0'.
Controller ainda não chama esse método; nome válido continua sem filtrar a busca
ou ser preservado nos links. Nenhuma alteração no formato HTTP nesta etapa.
Diagnóstico conferiu valores/tipos de 12 válidos, sete rejeições e rollback;
suíte existente 41 testes/288 asserções passou, contagens preservadas.
Explicação na [aula 06-36](../aulas/06-36-nome-validado.md). Entendimento da 6.36 confirmado com "entendu" em 01/11/2026.

### Preparação interna na 6.37 — filtro no serviço Eloquent

CatalogoEloquent::paginarProdutos recebe segundo argumento opcional nome=null.
Se não for null, acrescenta CHARINDEX(?, [nome]) > 0 com binding antes de paginar.
Filtro ativo, nome/ID, dez por página e campos preservados. Contagem e busca usam
o mesmo filtro literal; null/omitido mantém a consulta anterior. Dezoito cenários
SQL transacionais conferidos, incluindo páginas/totais/empate, literais, caixa/
acentos e '0'. Suíte existente 41 testes/288 asserções passou, rollback e contagens
conferidos. Na 6.37, contrato/demo ainda não declaravam o argumento. O HTTP
continua validando nome, sem filtrar a busca nem manter nome nos links.
Explicação na [aula 06-37](../aulas/06-37-filtro-nome-eloquent.md). Entendimento da 6.37 confirmado com "entendi" em 01/11/2026.

### Preparação interna na 6.38 — contrato e demonstração

Catalogo declara nome opcional ?string=null em paginarProdutos, e demonstração
atende à assinatura com Collection::filter e mb_stripos em UTF-8 !== false.
Filtro antes da contagem e recorte; values renumera a lista. Quinze cenários da
demo/JSON/links/tipos passaram sem SQL, incluindo caixa/acentos, '0' e páginas
vazias com total filtrado. Assinaturas compatíveis, binding Eloquent preservado
e chamadas pelo contrato com/sem nome conferidas. Suíte existente 41/288 passou;
contagens preservadas. Controller ainda não envia nome: busca HTTP e preservação
nos links permanecem pendentes. Explicação na
[aula 06-38](../aulas/06-38-contrato-demo-filtro-nome.md). Entendimento da 6.38 confirmado com "entendi" em 01/11/2026.

## Implementação e verificações da 6.39

Index chama paginarProdutos(pagina(), nome()) pelo contrato. Appends recebe
safe()->only(['nome']), selecionando apenas o nome validado/normalizado para os
links. Resource preserva data/links/meta e o paginator gera as URLs com codificação.
Omitido não acrescenta nome; page é gerenciado pelo paginator. Binding Eloquent
preservado, sem alterações nas rotas, Form Request, serviços ou resource.

Diagnóstico HTTP em loja_test/transação conferiu 19 sucessos, produtos completos,
ordem/empate, totais/páginas, SQL com bindings ativo/nome, literais/reservados/
Unicode e todos os links, inclusive meta.links, com query decodificada. Doze
correspondentes entre vinte ativos, além de um inativo, produzem 10/2/0/0 itens
nas páginas 1/2/3/1000000, total 12 e última 2. Seguir next manteve o filtro.
Parâmetros desconhecidos excluídos dos links. Seis inválidos mantiveram 422/JSON
sem SQL; consultas individuais 200/404 preservadas. Rollback confirmado.

HTTP real local conferiu Camiseta/4990 com nome normalizado nos links, página 2
vazia total 1, termo inexistente total 0, erros de nome/page, individual e Blade.
Diagnósticos: /tmp/curso-639-http-filtro-nome.php e /tmp/curso-639-http-real.php;
snapshot /tmp/curso-639-http-real.json. Suíte existente 41 testes/288 asserções
passou; ainda sem teste permanente novo do filtro HTTP nesta etapa. Contagens
antes/depois: teste 0 categorias/0 produtos; normal 0 categorias/1 produto.
Explicação na [aula 06-39](../aulas/06-39-filtro-nome-http.md). Entendimento da 6.39
confirmado com "entendi" em 01/11/2026.

## Cobertura acrescentada na 6.40

Novo teste permanente cria dois ativos correspondentes (Camiseta azul e Kit de
camiseta), Caneca ativa e Camiseta antiga inativa. Nome=camiseta exige somente
os dois correspondentes em ordem, com IDs gerados e campos/preços completos.
Links first/last mantêm nome=camiseta&page=1, prev/next null. Metadados exigem
página 1, tamanho 10, total 2, última 1 e posições 1/2. Classe 28 testes/247
asserções e suíte 42 testes/301 asserções passaram; contagens preservadas.
Aplicação preservada, sem alteração do contrato HTTP. Na 6.40, outros cenários do
filtro permaneceram nos diagnósticos; normalização e desconhecidos nos links
receberam testes permanentes na 6.41. Entendimento da 6.40 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-40](../aulas/06-40-teste-busca-nome.md).

## Cobertura acrescentada na 6.41

Teste de busca usa DataProvider de três pares query/nomeNosLinks: simples,
espaços externos com CAMISETA, e nome acompanhado de ignorado=valor. As mesmas
fixtures e expectativas de produtos/total/ordem/metadados são executadas para
cada par. Http_build_query monta first/last esperados apenas com nome explícito
do provider e page=1. Isso exige normalização do texto nos links e exclusão de
parâmetros desconhecidos. Classe 30 testes/273 asserções e suíte 44 testes/327
asserções passaram; contagens preservadas. Aplicação preservada. Outros casos
seguem em diagnósticos anteriores, sem novos testes permanentes deles nesta etapa.
Entendimento da 6.41 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-41](../aulas/06-41-teste-nome-normalizado.md).

## Cobertura acrescentada na 6.42

Novo método HTTP com DataProvider nomesInvalidos confere seis rejeições: vazio,
somente espaços, arrays simples/associativo e textos de 101 caracteres ASCII/
Unicode. Exige 422/application/json, chave message e erro associado a nome, sem
fixar tradução. Str_repeat constrói os textos e rawurlencode prepara a query
Unicode. Sem novas fixtures ou alteração na aplicação. Classe 36 testes/321
asserções e suíte 50 testes/375 asserções passaram; contagens preservadas.
Aceitação dos limites válidos de comprimento permanece em diagnóstico anterior.
Entendimento da 6.42 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-42](../aulas/06-42-testes-nomes-invalidos.md).

## Cobertura acrescentada na 6.43

Novo teste HTTP segue links.next recebido da primeira página filtrada. Cria
12 ativos correspondentes entre 20 ativos e um inativo correspondente, exige
dez/dois objetos completos e confere desempate por ID para dois nomes iguais
na divisão das páginas. Nas duas respostas: total 12, última página 2, posições
e links first/last/prev/next com nome preservado. Classe 37 testes/345 asserções
e suíte 51 testes/399 asserções passaram; contagens preservadas. Aplicação
preservada. Não acrescenta medições SQL ou asserções de meta.links.
Entendimento da 6.43 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-43](../aulas/06-43-teste-navegacao-filtrada.md).

## Cobertura acrescentada na 6.44

Novo método HTTP com DataProvider nomesLiterais executa sete buscas: %, _, [,
apóstrofo, +, & e string '0'. Cada caso cria um correspondente ativo, um ativo
sem correspondência e um correspondente inativo. Http_build_query codifica o
nome na entrada e nos links first/last esperados. Exige único objeto completo,
total 1, posições, demais metadados e links com nome preservado. Classe 44
testes/436 asserções e suíte 58 testes/490 asserções passaram; contagens
preservadas. Aplicação preservada; sem medição SQL ou novas asserções meta.links.
Entendimento da 6.44 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-44](../aulas/06-44-testes-nomes-literais.md).

## Cobertura acrescentada na 6.45

Novo teste HTTP cria Caneca ativa e Camiseta inativa; GET nome=camiseta exige
200/application/json, data [], total 0, current_page 1, per_page 10, last_page 1
e from/to null. First/last mantêm nome e page=1; prev/next são null. Verifica
busca sem ativos correspondentes em um banco que contém produtos. Classe 45
testes/449 asserções e suíte 59 testes/503 asserções passaram; contagens
preservadas. Aplicação preservada; sem medição SQL ou novas asserções meta.links.
Entendimento da 6.45 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-45](../aulas/06-45-teste-busca-sem-correspondencia.md).

## Cobertura acrescentada na 6.46

Novo teste cria onze Camisetas ativas com factory()->count(11), Caneca ativa e
Camiseta inativa. GET nome=camiseta&page=3 exige 200/JSON, data [], total 11,
current_page 3, per_page 10, last_page 2 e from/to null. First aponta para 1,
last/prev para 2 e next é null; nome preservado nos links. Confere que a página
vazia não perde o total filtrado. Classe 46 testes/462 asserções e suíte 60
testes/516 asserções passaram; contagens preservadas. Aplicação preservada;
sem medição SQL ou novas asserções meta.links. Entendimento da 6.46 confirmado
com "entendi" em 01/11/2026. Explicação na [aula 06-46](../aulas/06-46-teste-pagina-apos-ultima-filtrada.md).

## Evolução

Da 6.2 à 6.11, data continha nomes em strings. Na 6.12, passou a objetos com
id/nome/preço. Da 6.23 à 6.27, paginação foi desenhada e preparada sem mudar o
HTTP. Na 6.28, listagem e testes foram adaptados para data/links/meta, page opcional
e 422 para entradas inválidas. O histórico detalhado está em docs/progresso.md
e nas aulas; as seções de listagem e consulta individual acima descrevem o código
executável atual. Na 6.39, nome passou a filtrar a busca HTTP e a ser preservado
nos links. Filtros adicionais, outras operações e OpenAPI entrarão gradualmente.
