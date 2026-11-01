# Aula 6.38 — Nome opcional no contrato e na demonstração

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.37
com "entendi" e publicação em 4d345643f0652d85fb172c9cf76af11c62aea569.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.38
confirmado com "entendi" em 01/11/2026; publicação em preparação.

Conjunto inseparável: adaptar backend/app/Contracts/Catalogo.php e
backend/app/Services/CatalogoDemonstracao.php ao argumento opcional de nome.
Eloquent já recebeu esse argumento na etapa anterior.

## Contrato comum

Em Catalogo, a assinatura agora é:

```php
public function paginarProdutos(int $pagina, ?string $nome = null): LengthAwarePaginator;
```

A interface declara quais argumentos todas as implementações devem aceitar.
Quem depende de Catalogo agora pode fornecer nome sem depender da classe concreta.
O padrão null mantém chamadas anteriores com somente a página. O retorno continua
LengthAwarePaginator; o comentário de tipo genérico de produtos foi preservado.

A demonstração precisa atender à mesma assinatura no mesmo checkpoint para
continuar sendo uma implementação válida. Eloquent já atende, sem nova alteração.

## Filtro em memória

Na demonstração, o início do método passou a ser:

```php
public function paginarProdutos(int $pagina, ?string $nome = null): LengthAwarePaginator
{
    $produtos = $this->listarProdutos();

    if ($nome !== null) {
        $produtos = $produtos->filter(
            fn (Produto $produto): bool => mb_stripos($produto->nome, $nome, 0, 'UTF-8') !== false,
        );
    }
```

ListarProdutos continua criando três models em memória: Calça, Camiseta e Tênis,
todos ativos, com IDs demonstrativos 2/1/3 e sem persistência. Filter percorre
a coleção e conserva os produtos cuja função devolve true. A arrow function
recebe Produto e captura nome do escopo externo automaticamente.

Mb_stripos procura o trecho sem diferenciar maiúsculas/minúsculas. O terceiro
argumento 0 inicia a busca no começo; UTF-8 explicita a codificação do texto.
Quando encontra, retorna uma posição; quando não encontra, false. A posição 0
é válida, por isso usamos !== false. Referência:
[Manual PHP — mb_stripos](https://www.php.net/manual/pt_BR/function.mb-stripos.php).

Assim, CAM encontra Camiseta desde o início, mis encontra no meio e TÊNIS encontra
Tênis; tenis não encontra Tênis. Símbolos são texto literal. Nome '0' também
entra no filtro e não encontra os três nomes atuais. Omitido/null não filtra.

A demonstração usa comparações PHP sobre seus três nomes fixos. Não pretende
reproduzir todas as regras de uma collation SQL Server para qualquer texto.

## Contagem, recorte e JSON

O restante do método continua criando LengthAwarePaginator com:

```php
$produtos->forPage($pagina, 10)->values(),
$produtos->count(),
```

Agora produtos já está filtrada. Por isso count representa todos os correspondentes
e forPage recorta a página desse conjunto. Filter preserva a ordem e as chaves
dos elementos restantes; values renumera o recorte a partir de zero para o JSON
continuar sendo uma lista.

Para nome=camiseta, a página 1 contém um produto e a página 2 fica vazia; ambas
têm total 1 e última 1. Nome=c produz Calça e Camiseta, total 2. Sem filtro,
continuam três produtos na ordem anterior. Tamanho, path e pageName preservados.

## Integração atual

AppServiceProvider continua vinculando Catalogo a CatalogoEloquent. A demonstração
não foi ativada como implementação principal. ProdutoController ainda chama
paginarProdutos somente com pagina(); o HTTP continua validando nome sem filtrar
produtos ou preservar nome nos links.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Contracts/Catalogo.php
docker compose exec -T backend php -l app/Services/CatalogoDemonstracao.php
docker compose exec -T backend php artisan test --do-not-cache-result --compact
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-638-contrato-demo-nome.php
```

Sintaxes válidas; suíte existente passou com 41 testes/288 asserções. Sem novo
teste permanente do filtro nesta etapa. Diagnóstico exige loja_test/loja_testes:

- Reflection conferiu assinatura da interface e das duas classes: nome opcional,
  anulável, padrão null e retorno LengthAwarePaginator.
- Quinze cenários da demo: omitido/null, dois correspondentes, início/caixa,
  meio, acento/caixa, sem acento, %, _, [, apóstrofo, '0', sem correspondência,
  páginas 2/1000000 filtradas. IDs, ordem, totais, posições, lista renumerada e
  models ativos/exists false conferidos. Zero SQL na demonstração.
- Resource produziu JSON com os três campos/tipos e links coerentes. Página
  explícita respeitada mesmo com page=99 na requisição sintética.
- Container resolve Catalogo para Eloquent. Pelo contrato, chamada antiga e
  chamada com nome retornam vazio no banco de testes, um COUNT cada, com bindings
  ativo ou ativo/nome. Nenhuma escrita no diagnóstico.
- SELECTs antes/depois: teste 0 categorias/0 produtos; normal 0 categorias/1
  produto. Git diff --check e links locais conferidos.

## Continuidade

Roteiro, progresso e [contrato atual](../api/catalogo.md) atualizados. Entendimento
confirmado com "entendi" em 01/11/2026; publicação em preparação. Publicar e iniciar
somente 6.39: integrar nome no controller e preservar o parâmetro validado nos
links, verificando o fluxo HTTP.
