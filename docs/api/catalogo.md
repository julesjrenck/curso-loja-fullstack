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
Na 6.42, a aceitação dos limites válidos de comprimento permanecia em diagnóstico;
a cobertura permanente de 100 caracteres foi acrescentada na 6.47.
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

## Cobertura acrescentada na 6.47

Provider nomesLiterais recebeu duas entradas: str_repeat('a', 100) e
str_repeat('á', 100). Agora são nove casos do mesmo método HTTP. Os novos
casos exigem 200, único ativo correspondente, data completa, total 1,
metadados e links com texto preservado. Complementam as rejeições de 101
caracteres já cobertas na 6.42. Classe 48 testes/488 asserções e suíte 62
testes/542 asserções passaram; contagens preservadas. Aplicação preservada;
sem medição SQL ou novas asserções meta.links. O caso acentuado usa a letra á.
Entendimento da 6.47 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-47](../aulas/06-47-testes-limite-nome.md).

## Cobertura acrescentada na 6.48

Novo método HTTP com provider buscasComAcentos cria Kit de tenis e Kit de tênis
ativos. As buscas tenis/TENIS selecionam somente o primeiro;
tênis/TÊNIS selecionam somente o segundo. Quatro casos exigem objeto completo,
total 1, metadados e links preservando texto, caixa e acento do parâmetro.
Confere o comportamento CI/AS documentado; aplicação e collation preservadas.
Classe 52 testes/540 asserções e suíte 66 testes/594 asserções passaram;
contagens preservadas. Sem medição SQL ou novas asserções meta.links.
Entendimento da 6.48 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-48](../aulas/06-48-testes-acentos-nome.md).

## Cobertura acrescentada na 6.49

Teste de navegação filtrada da 6.43 ampliado nas duas respostas. Exige quatro
entradas em meta.links e confere url/page/active para anterior, páginas 1/2 e
seguinte. URLs não nulas preservam nome; somente a opção numérica da página
atual fica ativa. Não fixa labels traduzidos. Mesmas fixtures e navegação via
links.next recebido; aplicação preservada. Classe 52 testes/566 asserções e
suíte 66 testes/620 asserções passaram; contagens preservadas. São 26 asserções
novas, sem medição SQL; cobertura do cenário de duas páginas.
Entendimento da 6.49 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-49](../aulas/06-49-teste-meta-links.md).

## Desenho OpenAPI na 6.50

A [aula 06-50](../aulas/06-50-desenho-openapi-catalogo.md) introduz a descrição
estruturada e planeja o primeiro documento somente para a listagem GET.
Planejados JSON, OpenAPI 3.2.1, arquivo docs/api/openapi.json, servidor local
http://127.0.0.1:8002 e caminho /api/v1/produtos. Entradas page/nome e respostas
200/data/links/meta e 422/message/errors serão descritas gradualmente.
Na 6.50, documento formal ainda não criado; comportamento HTTP preservado. Etapa
verificada por inspeção de código/contrato e fontes oficiais, sem nova suíte.
Entendimento da 6.50 confirmado com "entendi" em 01/11/2026. Consulta individual
será documentada em etapa posterior.

## Esqueleto OpenAPI na 6.51

Criado [openapi.json](openapi.json) com versão 3.2.1, identificação/revisão 0.1.0,
servidor local e paths objeto vazio. Na 6.51, nenhuma operação estava descrita ainda. PHP no Docker confirmou sintaxe JSON e leitura dos
metadados/paths; não foi executado validador OpenAPI automatizado. Comportamento
HTTP preservado, sem novas dependências, consultas ou suíte de aplicação.
Entendimento da 6.51 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-51](../aulas/06-51-esqueleto-openapi.md).

## Operação OpenAPI na 6.52

[Openapi.json](openapi.json) agora declara /api/v1/produtos/get, summary Listar
produtos ativos, operationId listarProdutos e descrições de respostas 200/422.
A descrição de sucesso admite página vazia; a de 422 trata query inválida.
Na 6.52, parâmetros e formatos de corpo ainda não estavam descritos.
PHP Docker confirmou sintaxe JSON, URL completa e leitura da operação/status;
sem validador OpenAPI automatizado. Código HTTP preservado, sem dependências,
consultas ou nova suíte. Entendimento da 6.52 confirmado com "entendi" em
01/11/2026. Explicação na [aula 06-52](../aulas/06-52-operacao-listagem-openapi.md).

## Page no OpenAPI na 6.53

[Openapi.json](openapi.json) recebeu page na lista parameters da operação:
in query, required false, schema integer com minimum 1, maximum 1000000 e
default 1. Descrição registra normalização/decimal sem sinal ou zeros iniciais,
vazio inválido 422 e página após a última 200 vazia. O schema numérico não
codifica sozinho a representação lexical; descrição e testes preservam essa regra.
PHP Docker confirmou sintaxe/leitura dos campos, comparados com Form Request e
este contrato. Sem validador OpenAPI, dependências novas, produção alterada,
consultas ou nova suíte. Na 6.53, nome e schemas de resposta ainda não estavam descritos.
Entendimento da 6.53 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-53](../aulas/06-53-page-openapi.md).

## Nome no OpenAPI na 6.54

[Openapi.json](openapi.json) recebeu nome como segundo parâmetro da query:
required false, schema string/minLength 1/maxLength 100, sem default.
Description registra omissão sem filtro, trim externo/espaços internos, '0',
inválidos 422, busca literal/caixa/acentos, filtro antes do total e nome nos links.
Schema não executa normalização ou consulta. PHP Docker confirmou sintaxe e
leitura dos dois parâmetros/campos, comparados com Form Request, serviço,
controller e contrato. Sem validador OpenAPI, dependências novas, produção
alterada, consultas ou nova suíte. Schemas de resposta ainda serão descritos.
Entendimento da 6.54 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-54](../aulas/06-54-nome-openapi.md).

## Schema Produto no OpenAPI na 6.55

[Openapi.json](openapi.json) recebeu components.schemas.Produto, type object,
required com id/nome/preco_em_centavos e properties integer/string/integer.
Preço descrito em centavos. Na 6.55, componente ainda não referenciado nas respostas;
escopo de tipos/presença, sem proibição de campos adicionais. PHP Docker
confirmou sintaxe e leitura; comparado com resource/model/migration/contrato.
Sem validador OpenAPI, dependências novas, produção alterada, consultas ou nova
suíte. Entendimento da 6.55 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-55](../aulas/06-55-schema-produto-openapi.md).

## Data da resposta 200 no OpenAPI na 6.56

[Openapi.json](openapi.json) recebeu content/application/json em 200: schema
object, data obrigatório, array com maxItems 10 e items.$ref para
#/components/schemas/Produto. Lista vazia permitida. Descrição parcial do
corpo; links/meta continuam na API e serão detalhados nas próximas etapas.
PHP Docker confirmou sintaxe, leitura e destino dessa referência local.
Conferido contra código e contrato. Sem validador OpenAPI ou de instâncias,
dependências novas, produção alterada, consultas ou nova suíte.
Entendimento da 6.56 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-56](../aulas/06-56-data-resposta-openapi.md).

## Links da resposta 200 no OpenAPI na 6.57

[Openapi.json](openapi.json) agora exige links no corpo 200 e o descreve como
object com first/last/prev/next obrigatórios. First/last são string; prev/next
aceitam string ou null, preservando presença mesmo sem destino. Descrições
registram significado dos destinos e nome normalizado nas URLs. Meta será
detalhado depois. PHP Docker confirmou JSON/campos; comparado com contrato e
teste existente. Sem validador OpenAPI ou de instâncias, dependências novas,
produção alterada, consultas ou nova suíte. Entendimento da 6.57 confirmado
com "entendi" em 01/11/2026. Explicação na [aula 06-57](../aulas/06-57-links-resposta-openapi.md).

## Meta básico no OpenAPI na 6.58

[Openapi.json](openapi.json) exige meta no corpo 200, object com sete campos
obrigatórios. Current_page integer 1–1000000, per_page integer/const 10, total
integer >=0, last_page integer >=1, from/to integer >=1 ou null e path string.
Descrições registram capacidade fixa, total global filtrado e posições null
em página vazia. Meta.links será descrito depois. PHP Docker confirmou JSON/
campos, comparados com contrato/testes/serviço. Sem validador OpenAPI ou de
instâncias, dependências novas, produção alterada, consultas ou nova suíte.
Entendimento da 6.58 confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-58](../aulas/06-58-meta-basico-openapi.md).

## Meta.links no OpenAPI na 6.59

[Openapi.json](openapi.json) exige meta.links como array, com items object e
required url/label/page/active. Url string ou null, label string, page integer
mínimo 1 ou null e active boolean. Descrições registram destinos, rótulos
variáveis com tradução e indicação da página numérica atual. Lista sem
quantidade fixa. PHP Docker confirmou sintaxe/campos; comparado com contrato
e teste existente. Sem validador OpenAPI ou de instâncias, dependências novas,
produção alterada, consultas ou nova suíte. Entendimento da 6.59 confirmado
com "entendi" em 01/11/2026. Explicação na [aula 06-59](../aulas/06-59-meta-links-openapi.md).

## Corpo 422 no OpenAPI na 6.60

[Openapi.json](openapi.json) recebeu content/application/json em 422: object
com message/errors obrigatórios, message string e errors object/minProperties 1.
AdditionalProperties descreve os valores como array/minItems 1/items string:
dicionário de campo para lista de mensagens. Descrição informa page e/ou nome
na operação atual; schema não restringe nomes das chaves nem fixa traduções.
PHP Docker confirmou JSON/campos, comparados com Form Request/contrato/testes.
Sem validador OpenAPI ou de instâncias, dependências novas, produção alterada,
consultas ou nova suíte. Entendimento da 6.60 confirmado com "entendi" em
01/11/2026. Explicação na [aula 06-60](../aulas/06-60-resposta-422-openapi.md).

## Validação OpenAPI na 6.61

Criado [redocly.yaml](redocly.yaml) com extends spec. Documento OpenAPI 3.2.1
validado em Docker com Redocly CLI 2.65.0, imagem fixada por digest: código 0.
Container descartável sem rede, docs/api somente leitura. Duas cópias em /tmp
foram rejeitadas com código 1 esperado: título ausente (struct) e referência
inexistente (no-unresolved-refs). Documento do projeto preservado. Isso verifica
estrutura/referências; respostas reais ainda não foram confrontadas com schemas.
Sem dependências Composer/npm, serviço permanente novo, produção alterada, SQL
ou nova suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026. Comandos, digest
e explicação na [aula 06-61](../aulas/06-61-validacao-openapi.md).

## Exemplo 200 e validação de valores na 6.62

[Openapi.json](openapi.json) recebeu example ao lado do schema de
200/application/json: uma Camiseta/id 1/preço 4990 e paginação completa,
sem filtro, com uma página. Os valores e rótulos são ilustrativos; não são
uma captura HTTP, nem definem defaults ou alteram o banco.

[Redocly.yaml](redocly.yaml) acrescenta no-invalid-media-type-examples com
severity error e allowAdditionalProperties true, coerente com os schemas
abertos. Mesma imagem 2.65.0/digest e comando Docker: documento código 0;
três cópias temporárias rejeitadas com código 1 esperado (preço string, nome
ausente no Produto referenciado e per_page 11 contra const 10).
Relações entre totais/itens/URLs conferidas por leitura; o schema não garante
essa coerência automaticamente. Sem captura/validação de respostas reais,
SQL ou nova suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026. Explicação
na [aula 06-62](../aulas/06-62-exemplo-200-openapi.md).

## Exemplo 422 e validação de valores na 6.63

[Openapi.json](openapi.json) recebeu example ao lado do schema de
422/application/json: message string e errors.nome com uma lista contendo
uma mensagem. Textos ilustrativos para nome inválido; tradução livre e sem
exigir erros simultâneos de page/nome. Conferido com Form Request/testes por
leitura; não é captura HTTP nem alteração da resposta real.

Mesma configuração [redocly.yaml](redocly.yaml) e imagem 2.65.0/digest:
validação Docker código 0. Três cópias temporárias rejeitadas com código 1
pela regra de exemplos: errors.nome string, lista vazia e errors vazio.
Detectados tipo array, minItems 1 e minProperties 1. Schemas e exemplo 200
preservados. Sem dependências novas, SQL ou nova suíte Laravel. Entendimento
confirmado com "entendi" em 01/11/2026. Explicação na [aula 06-63](../aulas/06-63-exemplo-422-openapi.md).

## Consulta individual no OpenAPI na 6.64

[Openapi.json](openapi.json) recebeu GET /api/v1/produtos/{id}, summary e
operationId consultarProduto. Parâmetro id in path/required true/schema
integer minimum 1; descrição registra formato decimal positivo sem sinal ou
zeros iniciais e faixa PHP_INT_MAX. O schema numérico não codifica sozinho
a forma textual nem o máximo do backend. Respostas 200/404 descritas; corpos
desta operação ainda serão documentados. Conferido contra rota/controller/
Eloquent/testes existentes por leitura.

Mesma imagem/configuração Redocly: lint Docker código 0. Cópia sem declaração
de id rejeitada/código 1/path-parameters-defined; cópia com required false
aceita/código 0, limitação observada da ferramenta/configuração. Original
conferido manualmente com true conforme a especificação. Listagem e schemas
preservados. Sem produção alterada, SQL ou nova suíte Laravel. Entendimento
confirmado com "entendi" em 01/11/2026. Explicação na [aula 06-64](../aulas/06-64-consulta-id-openapi.md).

## Corpo 200 individual no OpenAPI na 6.65

[Openapi.json](openapi.json) recebeu content/application/json/schema object
na resposta 200 de GET /api/v1/produtos/{id}. Required exige data; properties.data
aponta por $ref para #/components/schemas/Produto. Reutiliza a representação
pública da listagem, agora com data objeto. Sem exemplo permanente nessa
operação. Comparado por leitura com controller/resource/teste de produto ativo.

Mesma imagem/configuração Redocly: lint código 0. Cópias temporárias com
exemplo: objeto válido código 0, data lista e sem data código 1 pela regra de
exemplos. Documento preservado após diagnósticos; demais operações/status/
componentes/configuração intactos. Limite de required false da 6.64 continua
registrado, original true. Sem produção alterada, SQL ou nova suíte Laravel.
Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-65](../aulas/06-65-corpo-200-consulta-openapi.md).

## Corpo 404 individual no OpenAPI na 6.66

[Openapi.json](openapi.json) recebeu content/application/json/schema object
na resposta 404 de GET /api/v1/produtos/{id}, com message obrigatório/string.
Descrição informa frase do controller para inexistente/inativo/ID fora da faixa
e texto variável nos erros de roteamento. Sem enum/const para message ou
exemplo permanente. Conferido com controller/bootstrap/testes por leitura.

Mesma imagem/configuração Redocly: lint código 0. Cópias temporárias com a frase
do controller e outro texto ilustrativo passaram/código 0; message número e
ausente foram rejeitados/código 1. Documento preservado após diagnósticos;
demais contratos/configuração intactos. Limite de required false da 6.64 segue
registrado, original true. Sem produção alterada, SQL ou nova suíte Laravel.
Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-66](../aulas/06-66-corpo-404-consulta-openapi.md).

## Exemplo 200 individual no OpenAPI na 6.67

[Openapi.json](openapi.json) recebeu example ao lado de schema na resposta
200/application/json de GET /api/v1/produtos/{id}: data objeto com id 1,
nome Camiseta e preco_em_centavos 4990. Ilustra consulta bem-sucedida do ID 1;
valores ilustrativos, sem captura HTTP, default ou inserção no banco.
Conferido com schema Produto e teste existente por leitura.

Mesma imagem/configuração Redocly: lint Docker código 0, incluindo valores do
novo exemplo contra o schema. Só exemplo de 200 individual acrescentado;
schemas/outros contratos/configuração preservados. Limite de required false
da 6.64 segue registrado, original true. Sem produção alterada, SQL ou nova
suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-67](../aulas/06-67-exemplo-200-consulta-openapi.md).

## Exemplo 404 individual no OpenAPI na 6.68

[Openapi.json](openapi.json) recebeu example ao lado de schema na resposta
404/application/json de GET /api/v1/produtos/{id}: message Produto não encontrado.
Representa caso tratado pelo controller (inexistente/inativo/ID fora da faixa).
Schema continua exigindo texto sem const/enum, permitindo variação nos erros
de roteamento. Conferido com controller/testes por leitura, sem captura HTTP.

Mesma imagem/configuração Redocly: lint Docker código 0, incluindo valores do
novo exemplo contra o schema. Só exemplo de 404 individual acrescentado;
schemas/outros contratos/configuração preservados. Limite de required false
da 6.64 segue registrado, original true. Sem produção alterada, SQL ou nova
suíte Laravel. Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-68](../aulas/06-68-exemplo-404-consulta-openapi.md).

## Plano de validação de respostas na 6.69

A [aula 06-69](../aulas/06-69-plano-validacao-respostas.md) planeja obter corpos
produzidos por testes HTTP Laravel, conferir status/Content-Type e validar
uma cópia temporária do OpenAPI com o corpo em example usando o Redocly atual.
Requisições desses testes são simuladas internamente, sem acesso pela rede.
Capturas optativas em pasta local ignorada, ambiente loja_test/loja_testes e
transações existentes; matriz individual 404/200 e listagem 200/422.

Configuração, isolamento, volumes, ignore e schemas conferidos por leitura.
Plano documentado e explicado; captura e pipeline ainda não implementados.
Sem mudanças no OpenAPI/produção, Docker, SQL ou suíte executados nesta etapa.
Entendimento confirmado com "entendi" em 01/11/2026. Próximo passo: captura optativa de 404
no teste HTTP de produto inexistente, mantendo o banco isolado.

## Captura optativa de resposta na 6.70

O teste HTTP de produto inexistente em CatalogoApiTest recebeu captura ativada
por CAPTURAR_CONTRATO_404=1 no processo. Remove arquivo anterior no início do
caso; após asserções de status/cabeçalho/JSON, grava getContent em
backend/storage/app/private/contratos/consulta-404.json, conferindo sintaxe e
bytes. Captura é local e ignorada, com corpo produzido pela aplicação no teste.

Sem flag: 1/6, nenhum arquivo criado. Com marcador anterior/flag: 1/8 e JSON
capturado de 42 bytes. Suíte comum 66/620 passou e deixou hash intacto. SELECTs
antes/depois preservados: loja 0 categorias/1 produto; loja_test 0/0. Captura
ainda não comparada ao schema; integração será posterior e deverá exigir
processo atual de teste bem-sucedido. Sem produção/OpenAPI/dependências alterados.
Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-70](../aulas/06-70-captura-404-teste-http.md).

## Validação da captura 404 na 6.71

O [script validar-contrato-404.sh](../../scripts/validar-contrato-404.sh) remove
captura anterior, executa o teste opt-in e exige sucesso antes de preparar uma
cópia temporária integral do OpenAPI. PHP em Docker substitui só example do
404 individual pelo corpo capturado, mantendo schemas/components/tipos JSON.
Redocly fixado valida cópia/config montadas RO, sem rede; trap limpa temporários.

Fluxo normal: teste 1/7 e lint 0. Cópias de diagnóstico: filtro sem teste saiu 1
e parou antes da cópia; example temporário sem message saiu 1 pela regra de
exemplos. Captura original válida/hash preservado, temporários removidos,
SELECTs posteriores loja 0 categorias/1 produto e loja_test 0/0. Última suíte
completa 6.70, 66/620. Sem mudanças no backend/OpenAPI/configuração/dependências.
Cobertura atual: um 404 gerado por teste HTTP interno. Entendimento confirmado
com "entendi" em 01/11/2026. Explicação na [aula 06-71](../aulas/06-71-validacao-captura-404.md).

## Captura optativa de sucesso na 6.72

CatalogoApiTest ampliou o caso de produto ativo pelo ID com
CAPTURAR_CONTRATO_200=1 e arquivo privado consulta-200.json, ambos independentes
do 404. Mantém as factories e GET com $camiseta->id; só grava getContent após
asserções, conferindo JSON e bytes. Remove captura anterior ao iniciar o caso.

Sem flag 1/6 sem arquivo; primeira opt-in 1/7, segunda 1/8 com substituição.
IDs capturados 22654/22656 são valores observados, não constantes do contrato.
Corpo data objeto/Camiseta/preço inteiro 4990. Suíte comum 66/620 passou e
preservou hashes de ambas as capturas; SELECTs antes/depois loja 0 categorias/
1 produto e loja_test 0/0. Arquivos ignorados; contrato e script 404 inalterados.
Captura 200 ainda sem validação contra schema. Entendimento confirmado com
"entendi" em 01/11/2026. Explicação na [aula 06-72](../aulas/06-72-captura-200-teste-http.md).

## Validação da captura 200 na 6.73

O [fluxo compartilhado](../../scripts/validar-contrato-produto.sh) recebe 200
ou 404, seleciona teste, flag, arquivo e schema da consulta individual. Mantém
captura atual obrigatória e valida cópia temporária integral com Redocly fixado.
O [atalho 404 anterior](../../scripts/validar-contrato-404.sh) delega ao fluxo
comum, preservando seu comando. Backend/OpenAPI/configuração intactos.

Fluxo 200 e atalho 404 passaram com teste 1/7/lint 0. Status não suportado saiu
2 antes de Docker. Cópia temporária com preço string foi rejeitada/código 1
pelo schema Produto, mantendo preço inteiro na captura original. Temporários
removidos e SELECTs posteriores conferidos: loja 0 categorias/1 produto,
loja_test 0/0. Última suíte completa 6.72, 66/620. Cobertura capturada atual:
casos individuais 200/404. Entendimento confirmado com "entendi" em 01/11/2026. Explicação na
[aula 06-73](../aulas/06-73-validacao-captura-200.md).

## Captura da listagem 200 na 6.74

O teste test_retorna_produto_ativo_em_json aceita agora a flag
CAPTURAR_CONTRATO_LISTAGEM_200=1. Remove captura anterior no início e, após
assertPaginaUnica, grava o corpo bruto em
storage/app/private/contratos/listagem-200.json, validando sintaxe JSON e bytes.
Arquivo privado ignorado pelo Git, independente dos casos individuais 200/404.
Captura inclui data em lista, links e meta/meta.links, ID da factory e URLs/rótulos
reais. Asserções existentes preservadas; produção/OpenAPI/scripts intactos.

Sem flag: 1/13 e arquivo ausente; primeira opt-in 1/14; segunda 1/15 com
substituição do arquivo. Suíte comum: 66/620; hashes das três capturas preservados.
SELECTs antes/depois: loja 0 categorias/1 produto; loja_test 0/0.
A captura da listagem ainda não foi comparada ao schema. Entendimento confirmado
com "entendi" em 01/11/2026. Explicação na [aula 06-74](../aulas/06-74-captura-listagem-200.md).
A etapa 6.73 foi publicada em 371ec88, com remoto conferido.

## Validação da captura da listagem na 6.75

O comando bash scripts/validar-contrato-produto.sh 200 listagem gera captura
atual e a compara ao schema de GET /api/v1/produtos em cópia temporária do
OpenAPI. O segundo argumento escolhe operação; consulta é o padrão e mantém
comandos individuais anteriores. PHP recebe status/caminho/arquivo e substitui
somente example, mantendo schemas e referências. Redocly/config/digest/RO/sem
rede e limpeza temporária anteriores. Backend e contrato versionado intactos.

Listagem200: teste 1/14 e lint/processo 0. Individuais200/404:1/7/lint 0 cada.
404 listagem saiu 2 antes do Docker. Diagnósticos com data objeto e sem meta só
no example temporário saíram 1 por array/meta obrigatório; capturas originais
íntegras e temporários removidos. SELECTs antes/depois: loja 0 categorias/1 produto,
loja_test 0/0. Última suíte completa 6.74, 66/620. Entendimento confirmado com "entendi" em 01/11/2026.
A etapa 6.74 foi publicada em 8e19c0c, remoto conferido. Explicação na
[aula 06-75](../aulas/06-75-validacao-captura-listagem.md).

## Captura da resposta 422 da listagem na 6.76

O teste de página inválida em CatalogoApiTest aceita
CAPTURAR_CONTRATO_LISTAGEM_422=1 e captura somente a query page=0. Remove
arquivo anterior nesse caso e, após as asserções existentes, grava o corpo
bruto em storage/app/private/contratos/listagem-422.json com sintaxe JSON e
bytes conferidos. Demais entradas do DataProvider não removem nem sobrescrevem.
Arquivo privado ignorado; flags/capturas anteriores independentes.

Corpo observado com message texto e errors.page lista de mensagens; frase
não fixada no teste. Filtro @zero seleciona uma entrada. Sem flag 1/8 e sem
arquivo; primeira opt-in 1/9; onze entradas com flag 11/90; negativa 1/8.
Suíte comum 66/620; hashes das quatro capturas e contagens dos bancos preservados.
Produção/OpenAPI/scripts intactos. A captura 422 ainda não foi comparada ao
schema; script ainda não aceita 422 listagem. Entendimento confirmado com "entendi" em 01/11/2026.
A etapa 6.75 foi publicada em d3c76b2, remoto conferido. Explicação na
[aula 06-76](../aulas/06-76-captura-listagem-422.md).

## Validação da captura 422 na 6.77

O comando bash scripts/validar-contrato-produto.sh 422 listagem escolhe o caso
zero do teste de página inválida, flag CAPTURAR_CONTRATO_LISTAGEM_422 e caminho
/api/v1/produtos. Reutiliza limpeza prévia, captura atual obrigatória, cópia
integral com só example substituído e Redocly/config/digest/RO/sem rede/trap.
Schema 422 e referências preservados. Contrato versionado e backend intactos.

Teste 1/9 e lint/processo 0; regressões individuais 200/404 1/7/lint 0 e listagem 200
1/14/lint 0 passaram. Combinações 422 consulta/404 listagem saíram 2 antes de Docker.
Cópias sem errors e com errors.page texto saíram 1, com erros de campo obrigatório
e lista exigida. Original íntegro 105 bytes; temporários removidos; SELECTs antes/
depois preservados. Última suíte 6.76, 66/620. Um caso de cada resposta capturado
e validado: individual 200/404 e listagem 200/422. Entendimento confirmado com "entendi" em 01/11/2026.
A etapa 6.76 foi publicada em c6bca3b, remoto conferido. Explicação na
[aula 06-77](../aulas/06-77-validacao-captura-422.md).

## Evolução

Da 6.2 à 6.11, data continha nomes em strings. Na 6.12, passou a objetos com
id/nome/preço. Da 6.23 à 6.27, paginação foi desenhada e preparada sem mudar o
HTTP. Na 6.28, listagem e testes foram adaptados para data/links/meta, page opcional
e 422 para entradas inválidas. O histórico detalhado está em docs/progresso.md
e nas aulas; as seções de listagem e consulta individual acima descrevem o código
executável atual. Na 6.39, nome passou a filtrar a busca HTTP e a ser preservado
nos links. Filtros adicionais, outras operações e OpenAPI entrarão gradualmente.
