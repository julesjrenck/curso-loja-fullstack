# Aula 6.10 — Leitura dos produtos para a API

## Objetivo e estado

Preparar uma leitura que forneça modelos Produto com ID, nome e preço.
Implementação, explicação e verificações em 23/10/2026; entendimento confirmado
pelo aluno com "entendi" em 23/10/2026.
Único código alterado: backend/app/Services/CatalogoEloquent.php.
ListarNomes, interface Catalogo, controller e resposta HTTP atuais preservados.

Etapa anterior 6.9 confirmada com "entendi" em 23/10/2026, após esclarecer que o
resource ainda não estava integrado à API. Publicada em
13d9256f17017b869ec5f8bd82f6b7df40f02208. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O método novo

Import acrescentado:

```php
use Illuminate\Database\Eloquent\Collection;
```

Ele permite usar o nome curto Collection para a coleção de modelos do Eloquent.
Esse é o tipo retornado por get() nesta consulta, inclusive quando não há linhas.

```php
/**
 * @return Collection<int, Produto>
 */
public function listarProdutos(): Collection
{
    return Produto::query()
        ->where('status', 'ativo')
        ->orderBy('nome')
        ->get(['id', 'nome', 'preco_em_centavos']);
}
```

O método público não recebe parâmetros e devolve uma Collection. O PHP verifica
esse tipo de retorno. O comentário Collection<int, Produto> documenta índices
inteiros e elementos Produto; o comentário sozinho não executa verificações.

Produto::query inicia a construção da consulta. Where mantém apenas os ativos;
orderBy aplica ordem crescente por nome. Get executa a consulta e recebe a lista
de colunas que devem ser buscadas. O filtro status participa do SQL mesmo sem
fazer parte das colunas retornadas. Cada model desta leitura possui somente
id, nome e preco_em_centavos carregados.

Uma Collection permite percorrer os modelos com foreach. Cada elemento é um
Produto, com atributos acessíveis por $produto->id, $produto->nome e
$produto->preco_em_centavos, incluindo os casts do model. O método não devolve
JSON nem monta uma resposta HTTP.

ListarNomes continua com pluck('nome')->all(), retornando um array de strings.
ListarProdutos usa get e mantém os modelos numa coleção, preparando os dados
que serão entregues ao ProdutoResource. Nesta etapa o método existe somente
na implementação concreta CatalogoEloquent; a interface ainda declara somente
listarNomes. O controller continua usando o contrato atual e não chama a nova
leitura. Nenhuma ligação nova com a rota ou com o resource foi feita nesta aula.

## Diagnóstico com SQL Server

/tmp/curso-610-listar-produtos.php carregou .env.testing e confirmou banco/login
loja_test/loja_testes antes de preparar dados. Dentro de uma transação:

1. Preparou produtos vazia e chamou listarProdutos: Collection vazia, um SELECT.
2. Cadastrou Caneca ativa/2990, depois Camiseta ativa/4990 e Tênis inativo/9990
   usando as factories existentes.
3. Chamou listarProdutos e exigiu dois models Produto persistidos, campos exatos
   id/nome/preço e resultado Camiseta/4990 antes de Caneca/2990. IDs comparados
   com os retornados pelos cadastros, sem supor números fixos.
4. Conferiu um SELECT com binding ativo e nenhuma consulta adicional ao percorrer
   os models e ler os três atributos.
5. Executou rollback em finally, inclusive se alguma conferência falhasse.

DB::enableQueryLog/flushQueryLog/getQueryLog permitiram observar separadamente as
chamadas do método, excluindo a preparação dos dados de cada contagem.
Comparação estrita dos arrays de diagnóstico verificou também tipos dos valores.
O mapeamento dos atributos para impressão pertence ao diagnóstico temporário;
não foi acrescentado ao serviço ou conectado à API.

Saída, código 0:

```text
Banco/login: loja_test/loja_testes
Vazio: Illuminate\Database\Eloquent\Collection | 0 produtos | 1 SELECT
Com dados: Illuminate\Database\Eloquent\Collection | 2 models Produto | 1 SELECT
Nomes/preços: Camiseta/4990, Caneca/2990 | IDs conferidos com os cadastros
Campos: id, nome, preco_em_centavos | tipos: int/string/int
SQL: select [id], [nome], [preco_em_centavos] from [produtos] where [status] = ? order by [nome] asc | parâmetro: ativo
Rollback executado.
```

## Comandos e regressões

```bash
docker compose exec -T backend php -l app/Services/CatalogoEloquent.php
docker compose exec -T backend php < /tmp/curso-610-listar-produtos.php
docker compose exec -T backend php artisan test --do-not-cache-result
docker compose exec -T backend php < /tmp/curso-62-http.php
```

Exec -T executa no container backend existente, sem terminal interativo. Php -l
confere sintaxe; redirecionamento envia o diagnóstico local ao PHP. Test executa
a suíte existente; --do-not-cache-result evita gravar cache na montagem somente
leitura. O último diagnóstico consulta por HTTP real a API e /loja.

Resultados adicionais, todos com código 0:

- Sintaxe válida e suíte existente com 18 testes/78 asserções passou.
- API real: 200/application/json/{"data":["Camiseta"]}; /loja:
  200/text/html; charset=utf-8 com item Camiseta.
- SELECTs separados por /tmp/curso-62-contagens.php após diagnóstico/suíte/HTTP:
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

O método novo foi conferido pelo diagnóstico de integração temporário. Os testes
automatizados existentes continuam cobrindo os comportamentos anteriores;
nenhum teste novo foi escrito nesta etapa. Sem migration, seeder, nova dependência
ou cadastro permanente.

Referência oficial consultada:
[Consultas e coleções do Eloquent](https://laravel.com/framework/docs/13.x/eloquent).

## Continuidade

Entendimento da 6.10 confirmado. Publicar o checkpoint e iniciar somente a 6.11,
declarando listarProdutos() no
contrato Catalogo com retorno Collection de Produto e preparar a implementação
compatível em CatalogoDemonstracao. O método da implementação Eloquent já existe;
manter listarNomes e ainda não trocar a resposta HTTP nessa etapa do contrato.
Exercício manual sugerido no DBeaver continua sem relato.
