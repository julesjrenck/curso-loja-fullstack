# Aula 5.22 — Primeiro produto persistido

## Objetivo

Executar o cadastro estudado na 5.21 e conferir os dados salvos no SQL Server.
A 5.21 foi confirmada com "entendi" em 15/10/2026 e publicada em 9da189c,
SHA completo 9da189c24c523373501eb30a181087350d3713d5, conferido na main remota.

Nenhum arquivo de código alterado nesta etapa. Utilizamos ProdutoSeeder,
model Produto, conexão sqlsrv e comando loja:consultar-produtos existentes.

## Conferência anterior

A ajuda de db:seed confirmou --class e --database. Uma leitura em PHP Docker
conferiu conexão padrão sqlsrv, banco loja, login loja_app e zero produtos.
Não havia cadastro anterior a preservar ou substituir na tabela.

## Comando executado uma vez

Na raiz do projeto, com backend e sqlserver ativos:

```bash
docker compose exec -T backend php artisan db:seed --class=ProdutoSeeder --database=sqlsrv --no-interaction --no-ansi
```

exec executa no container backend existente e -T dispensa terminal interativo.
php artisan carrega Laravel e db:seed inicia o preenchimento por seeders.
--class=ProdutoSeeder seleciona Database\Seeders\ProdutoSeeder, sem executar
o DatabaseSeeder padrão e seu exemplo de User. --database=sqlsrv seleciona
o nome da conexão configurada no Laravel, que aponta para loja como loja_app.
sqlsrv aqui é a conexão; loja é o nome do banco. Não usamos sqlsrv_migracoes.
--no-interaction dispensa perguntas do comando; --no-ansi dispensa cores.

Saída real, com código de saída 0:

```text
INFO  Seeding database.
Database\Seeders\ProdutoSeeder ... RUNNING
Database\Seeders\ProdutoSeeder ... 91 ms DONE
```

O Laravel instanciou o seeder e chamou run. Dentro dele, Produto::create
gravou a Camiseta na tabela produtos. O SQL Server gerou id 1; o Eloquent
preencheu created_at e updated_at. O processo terminou, mas o registro
permaneceu no banco: é a persistência que queríamos observar.

O comando foi executado somente uma vez. Como o código atual usa create,
executá-lo de novo tentará inserir outra Camiseta. Para conferir os dados,
usamos somente consultas, que podem ser repetidas sem cadastrar produtos.

## Consultar depois do cadastro

```bash
docker compose exec -T backend php artisan loja:consultar-produtos --no-ansi
```

Saída real, código 0:

```text
Produtos encontrados: 1
```

O comando da 5.19 continua usando Produto::query()->get(). Antes recebia uma
coleção vazia; agora recebe uma coleção com um model Produto. count vale 1
e isEmpty vale false, portanto a mensagem Nenhum produto cadastrado não aparece.
Esse comando ainda mostra somente a quantidade; não imprime os campos.

Um diagnóstico temporário de leitura, em outro processo PHP Docker, conferiu:

| Campo | Resultado observado |
| --- | --- |
| Banco e login | loja / loja_app |
| Coleção | Illuminate\Database\Eloquent\Collection, um item |
| Model | App\Models\Produto, exists=true |
| id | 1, inteiro |
| nome | Camiseta |
| preco_em_centavos | 4990, inteiro, equivalente a R$ 49,90 |
| status | ativo |
| created_at | 2026-10-15 22:43:40.239 |
| updated_at | 2026-10-15 22:43:40.239 |

As datas acima são os valores brutos armazenados. Não aplicamos conversão
para o fuso local nessa leitura. Não foi necessário manter o objeto do
processo que cadastrou o produto: o novo processo o carregou do banco.

## Conferência acompanhada no DBeaver

Na conexão local já preparada, selecionando o banco loja, sugerimos:

```sql
SELECT id, nome, preco_em_centavos, status, created_at, updated_at
FROM dbo.produtos;
```

SELECT escolhe as colunas que queremos ver. FROM indica a tabela produtos
no esquema dbo. É uma leitura, sem modificar os dados. O registro conferido
pelo professor é a Camiseta descrita acima. Resultado observado pelo aluno
no DBeaver ainda não informado; não presumir execução ou compreensão.

## Verificação e continuidade

Cadastro real de demonstração no banco da aplicação, sem suíte de testes
de integração nesse banco. Testes SQL de integração terão loja_test próprio.
Nenhuma segunda execução do seeder, limpeza, rollback ou alteração de esquema.
git diff --check passou; código, configuração, credenciais, dependências,
serviços e contador preservados. A página /loja continua usando o catálogo
demonstrativo em memória; ainda não foi ligada ao banco.

Execução e explicação da 5.22 concluídas, verificação de persistência passou.
Entendimento da 5.22 confirmado com "entendi" em 15/10/2026. Checkpoint
9d03edc publicado; HEAD, origin/main e main remota conferidos no SHA
9d03edc59b912352e2b6fe707637716694689503.

Próximo passo realizado na 5.23: acrescentar ao comando loja:consultar-produtos a apresentação dos campos de
cada Produto, com foreach da coleção e leitura de atributos. Não repetir
o seeder nem trocar o catálogo HTTP nessa etapa.

Fonte consultada em 15/10/2026:

- [Execução de seeders no Laravel 13](https://laravel.com/docs/13.x/seeding#running-seeders).
