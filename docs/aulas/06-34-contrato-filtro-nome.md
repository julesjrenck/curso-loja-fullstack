# Aula 6.34 — Contrato planejado do filtro por nome

## Objetivo e estado

Desenho, explicação e verificações em 30/10/2026 após confirmação da 6.33 com
"entendi" e publicação em d86aa98520fdf6a728c629ce6e3a028deaa431eb. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.34 confirmado
com "entendi" em 01/11/2026; checkpoint publicado em
4bb129121f344e1b4c59a1166346b0315cde3a3a, com remoto conferido.

Esta etapa define o comportamento para a implementação gradual. O filtro ainda
não está implementado: o [contrato atual](../api/catalogo.md) continua aceitando
somente page como parâmetro suportado. Nenhuma classe da aplicação foi alterada.

## Entrada planejada

```http
GET /api/v1/produtos?nome=camiseta&page=2
Accept: application/json
```

Nome será um parâmetro opcional na query string. Ele selecionará produtos cujo
nome contenha o trecho informado, em qualquer posição. Assim, camiseta poderá
encontrar Camiseta azul e Kit de camiseta. Não será busca por palavras separadas,
expressão regular ou aproximação de grafia.

| Entrada após normalização do Laravel | Comportamento planejado |
| --- | --- |
| nome omitido | Listagem atual, sem filtro por nome. |
| Texto de 1 a 100 caracteres | Buscar esse trecho no nome. |
| Espaços nas extremidades | Removidos pelo middleware existente antes de validar. |
| Espaços no meio do texto | Preservados; não separar em palavras. |
| nome vazio ou só espaços | 422 JSON com message e errors.nome. |
| nome como array | 422 JSON com message e errors.nome. |
| Mais de 100 caracteres | 422 JSON com message e errors.nome. |

O limite de 100 é uma decisão para o termo de busca, sem alterar o tamanho da
coluna do produto. Texto numérico como nome=0 é uma busca válida. A conversão
de strings vazias em null pelo middleware não transforma o parâmetro presente
em omitido: valor vazio continuará sendo rejeitado pelo contrato planejado.

O trecho será literal: %, _ e [ serão tratados como caracteres, sem oferecer
curingas de SQL ao consumidor. A implementação precisará respeitar isso ao montar
a consulta, usando parâmetros para os valores. Na URL, caracteres reservados
devem ser codificados: % vira %25, + vira %2B e & vira %26. Exemplos acima usam
somente texto simples.

## Comparação de texto

Preservaremos as regras atuais de comparação da coluna nome no SQL Server.
Nos dois bancos, a collation observada é SQL_Latin1_General_CP1_CI_AS: ignora
diferenças de maiúsculas/minúsculas e distingue acentos. Portanto, camiseta
deverá encontrar Camiseta; tenis não deverá encontrar Tênis, enquanto tênis sim.

Collation é o conjunto de regras de comparação e ordenação do banco. A
[documentação da Microsoft](https://learn.microsoft.com/en-us/sql/relational-databases/collations/collation-and-unicode-support/)
explica os indicadores CI e AS. Não alteramos a collation nesta etapa.
Outros ambientes deverão manter essa semântica para cumprir o contrato.

## Filtro e paginação

O conjunto consultado deverá satisfazer as duas condições: produto ativo E nome
contendo o trecho. Inativos continuarão fora, mesmo quando seus nomes coincidirem.
A ordem será: selecionar os ativos que combinam com o nome, ordenar por nome/ID,
contar os correspondentes e recortar a página solicitada. A contagem e a busca
deverão usar os mesmos filtros. Não se deve filtrar somente os dez itens de uma
página já obtida, pois isso poderia esconder produtos e produzir totais incorretos.

Exemplo hipotético, não cadastrado: vinte ativos, sendo doze camisetas e oito
canecas, além de uma camiseta inativa. Para nome=camiseta:

| Página | Itens recebidos | meta.total | meta.last_page |
| --- | --- | --- | --- |
| 1 | 10 camisetas ativas | 12 | 2 |
| 2 | 2 camisetas ativas | 12 | 2 |
| 3 | Lista vazia | 12 | 2 |

Se não houver correspondências, manter 200/data [], total 0, última 1 e from/to
nulos. Page omitido continuará significando 1; as regras atuais de page e seus
erros 422/errors.page continuarão valendo. Produtos manterão os mesmos três
campos, e o envelope continuará data/links/meta.

## Links de navegação

Os links gerados deverão manter o nome validado, mudando somente a página.
No exemplo hipotético, a navegação da página 1 para a 2 deverá levar a uma URL
equivalente a /api/v1/produtos?nome=camiseta&page=2, com codificação apropriada.
A ordem dos parâmetros na URL não será relevante. Essa regra valerá também para
os links dentro de meta.links; URLs nulas continuarão nulas.

Sem preservar nome no link, a próxima requisição perderia o filtro e voltaria
ao catálogo inteiro. Não será necessário repassar parâmetros desconhecidos.
A consulta individual por ID e a página Blade /loja manterão seus contratos.

## Verificação e limites desta etapa

Leitura do Form Request, controller/serviço atuais e contrato confirmou que nome
ainda não é aplicado. Diagnóstico temporário /tmp/curso-634-colacao.php executado
no PHP Docker, somente com SELECTs e verificação de identidade:

- loja_test/loja_testes: collation da coluna nome SQL_Latin1_General_CP1_CI_AS;
  comparação Camiseta/camiseta igual e Tênis/Tenis diferente; 0 categorias/0 produtos.
- loja/loja_app: mesma collation e comparações; 0 categorias/1 produto.

O diagnóstico consultou sys.columns e comparou literais Unicode na collation
observada. Isso fundamenta as regras de comparação, mas não testa o filtro HTTP,
que ainda será implementado. Sem inserções ou alterações no banco.
Git diff --check e conferência dos links locais da documentação passaram.
Não foi necessário repetir a suíte, pois somente documentação mudou; último
resultado da 6.33: 41 testes/288 asserções passaram.

## Continuidade

Entendimento confirmado com "entendi" em 01/11/2026; checkpoint publicado em
4bb129121f344e1b4c59a1166346b0315cde3a3a, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.35](06-35-validacao-nome.md), com validação de
nome no Form Request, ainda sem aplicar o filtro à consulta. As seções acima
registram o desenho da 6.34; o contrato atual acompanha cada parte implementada.
