# Aula 5.10 — Modelagem inicial de produtos

## Objetivo

Definir quais dados um produto terá no banco e como identificaremos cada registro.
O checkpoint 5.9 foi confirmado e publicado em 173ed00, SHA completo
173ed0089496181ec510cd521d7995a62045ca54, conferido na main remota.

Nesta etapa a entrega é este desenho documentado. Ainda não criamos a tabela
ou uma migration. A conexão Laravel já funciona; a página /loja continua
usando CatalogoDemonstracao com nomes em memória.

## Tabela, linhas e colunas

O banco loja conterá uma tabela chamada produtos. Cada linha representará um
produto; as colunas serão seus atributos. Uma tabela define uma estrutura
compartilhada pelos registros, com nomes de colunas, tipos e regras.

No laboratório PHP, Loja\Produto tem nome, precoEmCentavos e status. Vamos
manter esses conceitos, usando nomes de colunas com sublinhado no banco.
Não estamos transformando aquela classe em um model Laravel nesta etapa.

## Desenho inicial

| Coluna | Tipo SQL Server planejado | Aceita NULL? | Papel |
| --- | --- | --- | --- |
| id | BIGINT, com IDENTITY(1,1) | Não | Chave primária; identificador gerado pelo banco |
| nome | NVARCHAR(150) | Não | Nome do produto |
| preco_em_centavos | INT | Não | Preço inteiro em centavos |
| status | NVARCHAR(20) | Não | Estado ativo/inativo, inicialmente ativo |
| created_at | DATETIME2(3) | Sim | Data e hora da criação do registro |
| updated_at | DATETIME2(3) | Sim | Data e hora da última atualização |

BIGINT é um inteiro de 64 bits; INT é um inteiro de 32 bits. O intervalo de
preco_em_centavos é limitado pelo tipo INT, com máximo positivo 2147483647.
NVARCHAR guarda texto Unicode, adequado aos acentos em Calça e Tênis. O tamanho
é medido em unidades UTF-16; nos caracteres usuais desses nomes, 150 corresponde
a 150 caracteres. O tipo limita tamanho, não impede texto vazio.

DATETIME2 guarda data e hora; (3) permite três casas de fração de segundo,
ou milissegundos. Esses campos não representam o estado comercial do produto:
registram quando ele foi criado/alterado. Usaremos horário UTC na aplicação;
o tipo DATETIME2 não guarda fuso. Os nomes created_at/updated_at serão usados
pelo Eloquent quando introduzirmos o model. Planejamos campos de data anuláveis,
compatíveis com a convenção de timestamps do Laravel; o preenchimento será
apresentado junto da persistência.

NULL significa ausência de valor; é diferente de 0 ou de texto vazio.
id, nome, preço e status serão obrigatórios. As regras de conteúdo serão
tratadas na implementação: nome com conteúdo, preço não negativo e status
pertencente ao conjunto ativo/inativo. O tipo INT sozinho permite negativos,
e NVARCHAR sozinho permite textos além desses dois estados; o desenho não
equivale a restrições já aplicadas no banco.

## Chave primária e geração do id

Uma chave primária identifica cada linha e exige valor único e não nulo.
Escolhemos id porque nomes de produtos podem se repetir e podem mudar.
Renomear um produto não deve mudar sua identidade.

IDENTITY(1,1) pede ao SQL Server que gere o número começando em 1 e
incrementando em 1. Geração automática e unicidade são conceitos distintos:
IDENTITY gera; a chave primária garante a unicidade. Podem existir lacunas
na sequência; o id não é um contador de quantos produtos existem.

Exemplo ilustrativo, ainda não inserido no banco:

| id | nome | preco_em_centavos | status |
| --- | --- | --- | --- |
| 1 | Camiseta | 4990 | ativo |
| 2 | Camiseta | 5990 | inativo |
| 3 | Calça | 12990 | ativo |

Os produtos 1 e 2 têm o mesmo nome, mas são registros distintos. Se quisermos
consultar ou atualizar especificamente o primeiro, usaremos seu id.

## Preço e status retomam o laboratório

4990 centavos representam R$ 49,90. Guardar um inteiro em centavos mantém a
unidade usada por Produto e ItemCarrinho no módulo 3. A exibição formatada
será responsabilidade da aplicação. Este catálogo inicial trabalha com reais.

status usará os textos ativo/inativo, correspondentes ao enum StatusProduto
já estudado. Não armazenamos o objeto enum no banco: guardamos um valor,
e a conversão para enum no model será apresentada em uma etapa própria.
O valor inicial planejado é ativo.

## Verificação e continuidade

Desenho revisado contra src/Produto.php e src/StatusProduto.php: nome,
preço inteiro em centavos e valores de status preservam os conceitos do módulo 3.
Tipos, chave primária e geração de identidade conferidos na documentação Microsoft.
git diff --check passou; alterações desta etapa restritas à documentação.
Sem comando SQL, execução PHP, teste de aplicação ou alteração de banco nesta
etapa, pois ainda não há implementação de esquema a verificar.

Modelagem e explicação apresentadas; entendimento da 5.10 confirmado com
"entendi" em 14/10/2026. Checkpoint publicado e conferido em b160a68:
HEAD, origin/main e main remota retornaram b160a6827c99cd30f6edbea3e1f19556fc06b147.
Registro no checkpoint seguinte. Próximo passo realizado na 5.11: explicar migrations e gerar
somente o esqueleto da migration de produtos, sem executá-la no banco.
A credencial da aplicação não possui permissão de criar tabelas; o acesso
para executar migrations será preparado em sua própria etapa.

Fontes consultadas em 14/10/2026:

- [Chaves primárias](https://learn.microsoft.com/en-us/sql/relational-databases/tables/primary-and-foreign-key-constraints?view=sql-server-ver16).
- [IDENTITY](https://learn.microsoft.com/en-us/sql/t-sql/statements/create-table-transact-sql-identity-property?view=sql-server-ver16).
- [INT e BIGINT](https://learn.microsoft.com/en-us/sql/t-sql/data-types/int-bigint-smallint-and-tinyint-transact-sql?view=sql-server-ver16).
- [NVARCHAR](https://learn.microsoft.com/en-us/sql/t-sql/data-types/nchar-and-nvarchar-transact-sql?view=sql-server-ver16).
- [DATETIME2](https://learn.microsoft.com/en-us/sql/t-sql/data-types/datetime2-transact-sql?view=sql-server-ver16).
