# Aula 5.58 — Modelagem de categorias e produtos

## Objetivo e estado

Agrupar produtos por categoria e entender a ligação entre tabelas. Explicação e
revisão em 19/10/2026; entendimento confirmado com "entendi" em 20/10/2026. Somente
documentação alterada; exemplos abaixo não são dados cadastrados no banco.

A 5.57 foi confirmada com "entendi" e publicada em
5c65e6d26394b8ac231addbecf80a10eb54257a0. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Exemplo da loja

No modelo inicial, cada produto categorizado pertence a uma categoria. Uma
categoria pode reunir vários produtos e pode existir antes de receber produtos.

Tabela categorias, ilustrativa:

| id | nome |
| --- | --- |
| 1 | Roupas |
| 2 | Acessórios |

Tabela produtos, ilustrativa, mostrando apenas as colunas da explicação:

| id | nome | categoria_id |
| --- | --- | --- |
| 10 | Camiseta | 1 |
| 11 | Calça | 1 |
| 12 | Caneca | 2 |

Camiseta e Calça apontam para a categoria de ID 1, Roupas. Caneca aponta para
a categoria de ID 2, Acessórios. É uma relação um para muitos: uma categoria,
vários produtos. Nesta primeira modelagem não associamos várias categorias ao
mesmo produto.

## Chaves e integridade

Categorias.id é a chave primária: identifica cada categoria de forma única.
Produtos.id identifica o produto. Produtos.categoria_id é outra coluna, que
guarda o ID da categoria à qual o produto pertence. Ela não guarda o ID do
próprio produto nem o nome da categoria.

Quando implementarmos a restrição de chave estrangeira, o banco verificará que
o categoria_id informado referencia uma categoria existente. No exemplo, usar
99 para um produto categorizado seria inválido se a categoria 99 não existisse.
Apenas criar uma coluna numérica não acrescenta essa verificação automaticamente.

Guardar o nome da categoria na tabela de categorias permite renomear Roupas
em uma única linha. Os produtos continuam ligados pelo ID e não precisam ter
seus nomes de categoria reescritos individualmente.

Obrigatoriedade de categoria, tratamento dos produtos existentes e comportamento
ao excluir categorias serão explicados nas etapas de alteração do esquema.
Nenhuma dessas regras foi aplicada ao banco nesta aula.

## Relação com o código e verificação

A migration existente de produtos foi inspecionada: contém id, nome, preço,
status e timestamps, ainda sem categoria_id. O model Produto também não possui
relacionamento com Categoria. Models/migrations foram listados: não há arquivo
de categoria existente nessas pastas. Antes de acrescentar uma migration,
conferimos o estado real para não repetir arquivos já presentes.

Nenhum SQL, comando Artisan de geração ou teste foi executado nesta etapa
conceitual. A revisão verificou coerência dos IDs nos exemplos; git diff --check
passou. Segredos locais continuam ignorados e fora do índice. Último resultado
de suíte 6 testes/14 asserções é da 5.53; verificação de seeding/rollback é da 5.57.

## Continuidade

Entendimento da 5.58 confirmado. Publicar o checkpoint
e iniciar 5.59: preparar migration create_categorias_table com id, nome e
timestamps, explicar up/down e conferir sintaxe. Ainda não aplicar a migration
nem alterar produtos/model nessa etapa.
