# Aula 6.37 — Filtro literal por nome no serviço Eloquent

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.36
com "entendu" e publicação em 0b9afb840eb276b10bbeca3031f68cc393d4d14a.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.37
confirmado com "entendi" em 01/11/2026; checkpoint publicado em
4d345643f0652d85fb172c9cf76af11c62aea569, com remoto conferido.

Uma alteração de código em backend/app/Services/CatalogoEloquent.php: preparar
o filtro literal no método de paginação. O controller ainda não envia nome.

## Método alterado

```php
public function paginarProdutos(int $pagina, ?string $nome = null): LengthAwarePaginator
{
    $consulta = Produto::query()
        ->where('status', 'ativo');

    if ($nome !== null) {
        $consulta->whereRaw('CHARINDEX(?, [nome]) > 0', [$nome]);
    }

    return $consulta
        ->orderBy('nome')
        ->orderBy('id')
        ->paginate(10, ['id', 'nome', 'preco_em_centavos'], 'page', $pagina);
}
```

O segundo argumento é opcional, com padrão null. Chamadas existentes com somente
a página continuam válidas e sem filtro por nome. Se o chamador fornecer nome,
ele deve representar o texto validado; o serviço não repete a validação HTTP.

Produto::query cria o construtor da consulta, e where mantém o filtro de ativos.
Guardamos o builder em $consulta para acrescentar a condição opcional. Esses
passos montam a consulta; paginate é que executa contagem e recorte no banco.

Usamos !== null para distinguir ausência de texto fornecido. O nome '0' também
deve filtrar; uma condição simples if ($nome) deixaria esse caso de fora no PHP.

## Busca literal e parâmetros

CHARINDEX procura o trecho dentro do nome. Retorna uma posição a partir de 1
quando encontra, ou 0 quando não encontra; >0 seleciona os correspondentes.
A comparação segue a collation de entrada. Referência:
[CHARINDEX — Microsoft](https://learn.microsoft.com/en-us/sql/t-sql/functions/charindex-transact-sql?view=sql-server-ver16).
No banco atual, isso ignora caixa e distingue acentos, conforme conferido na 6.34.

O trecho SQL de whereRaw é fixo. O ? marca o parâmetro, e [$nome] fornece seu
valor separadamente. O conteúdo do nome não é concatenado ao SQL. Os colchetes
em [nome] delimitam o identificador da coluna no SQL Server; não são o parâmetro.

A função procura caracteres literais: %, _ e [ não representam curingas nessa
busca. Apóstrofos também são enviados como parte do valor. A expressão pertence
ao SQL Server, que é o banco definido para o projeto.

## Contagem e paginação

Acrescentamos a condição antes de paginate. Assim a contagem e a seleção dos
itens usam status ativo E nome contendo o trecho. A ordenação continua nome/ID,
com dez itens por página e os mesmos três campos selecionados.

No cenário de diagnóstico, há vinte ativos, doze correspondentes e um inativo
correspondente. Para nome=camiseta, páginas 1/2/3 devolvem 10/2/0 itens, todas
com total 12 e última 2. O desempate entre dois Camiseta 10 cruza páginas.
Nome omitido ou null devolve total 20. A função não modifica produtos.

## Relação com contrato e HTTP

A interface Catalogo ainda declara paginação com um argumento. Acrescentar um
argumento opcional no concreto preserva as chamadas existentes; a assinatura
comum e a demonstração serão adaptadas na próxima etapa. Não devemos depender
do argumento extra como parte do contrato antes dessa adaptação.

ProdutoController continua enviando somente pagina(). Logo, nome é validado
na requisição, mas ainda não filtra no HTTP nem é preservado nos links.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Services/CatalogoEloquent.php
docker compose exec -T backend php artisan test --do-not-cache-result --compact
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-637-filtro-nome.php
```

Sintaxe válida; suíte existente passou com 41 testes/288 asserções. Sem novo teste
permanente do filtro nesta etapa. O diagnóstico exige loja_test/loja_testes vazio
e cria fixtures em transação, desfeitas em finally.

- Dezoito cenários: catálogo vazio, '0', páginas 1/2/3/1000000 com doze ativos
  correspondentes, caixa ignorada, trecho no meio, sem correspondência, omitido/
  null, %, _, [, apóstrofo, acento/sem acento e texto com sintaxe SQL como literal.
- Produtos exatos por ID gerado, somente três campos, tipos, ordem/desempate,
  total/última e posições conferidos. Inativo continua cadastrado antes do rollback.
- Zero correspondências faz um COUNT. Total positivo faz COUNT + SELECT, mesmo
  para página vazia. Bindings ativo/nome e predicado parametrizado conferidos
  em ambas as consultas; sem nome há somente binding ativo.
- Após seis fixtures especiais, GET com nome inexistente continua 200 com dez
  itens e total 26: confirmação separada de que o HTTP ainda não usa o filtro.
- Rollback e transação encerrada confirmados. SELECTs antes/depois: teste
  0 categorias/0 produtos; normal 0 categorias/1 produto.
- Git diff --check e links locais da documentação conferidos.

## Continuidade

Entendimento confirmado com "entendi" em 01/11/2026; checkpoint publicado em
4d345643f0652d85fb172c9cf76af11c62aea569, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.38](06-38-contrato-demo-filtro-nome.md), com
nome opcional no contrato e filtro na demonstração, ainda sem mudar controller.
