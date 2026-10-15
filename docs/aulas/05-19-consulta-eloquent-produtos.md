# Aula 5.19 — Primeira consulta Eloquent

## Objetivo

Consultar a tabela produtos pelo model e apresentar a coleção de resultados.
A 5.18 foi confirmada com "entendi" em 15/10/2026 e publicada em adb466c,
SHA completo adb466c3fab6e5fcfe0e16f3edef970e49609fd2, conferido na main remota.

## Comando Artisan acrescentado

Em backend/routes/console.php, importamos App\Models\Produto e acrescentamos:

```php
Artisan::command('loja:consultar-produtos', function () {
    $produtos = Produto::query()->get();

    $this->line('Produtos encontrados: '.$produtos->count());

    if ($produtos->isEmpty()) {
        $this->line('Nenhum produto cadastrado.');
    }
})->purpose('Consulta produtos pelo Eloquent');
```

Artisan::command registra a entrada de terminal, como na 5.9. O nome é
loja:consultar-produtos, sem argumentos obrigatórios. A closure contém a ação;
$this é a instância do comando, line imprime e purpose define a ajuda.
Os comandos inspire e loja:verificar-banco continuam preservados.

## Preparar e executar a consulta

```php
$produtos = Produto::query()->get();
```

Produto::query() obtém um construtor de consultas Eloquent ligado ao model.
Ele conhece a tabela produtos e usa a conexão padrão sqlsrv. Nesse ponto
estamos preparando a consulta. ->get() executa o SELECT e entrega o resultado.
Não precisamos escrever a instrução SQL manualmente no comando.

O SQL capturado durante a verificação foi:

```sql
select * from [produtos]
```

O asterisco pede todas as colunas; FROM informa a tabela. Os colchetes são
a delimitação de identificador usada pelo compilador de consultas SQL Server
instalado. O comando não contém entrada de usuário nem parâmetros SQL.

O model usa sqlsrv/loja_app para essa leitura, no banco loja. A conexão
sqlsrv_migracoes continua destinada à execução de migrations.

## Coleção de resultados

get() devolve uma Illuminate\Database\Eloquent\Collection. É um objeto que
reúne os resultados e oferece métodos para trabalhar com eles. Quando houver
linhas, os itens dessa coleção serão instâncias de App\Models\Produto.

Nesta consulta a tabela está vazia. Mesmo assim, o resultado é uma coleção:

- count() informa quantos itens foram carregados, aqui 0;
- isEmpty() retorna true quando não há itens;
- o if usa esse booleano para imprimir a mensagem de ausência de cadastro.

Esse count é da coleção já carregada. Não executa uma segunda consulta COUNT
ao banco. Não recebemos null ou false por não haver linhas; a consulta foi
executada com sucesso e seu resultado contém zero itens.

## Executar

Na raiz do repositório, com backend e sqlserver ativos:

```bash
docker compose exec -T backend php artisan loja:consultar-produtos
```

exec roda dentro do backend existente; -T desliga terminal interativo; php
executa artisan em /app, que carrega Laravel e chama o comando registrado.
Saída conferida:

```text
Produtos encontrados: 0
Nenhum produto cadastrado.
```

## Verificações

```bash
docker compose exec -T backend php -l /app/routes/console.php
docker compose exec -T backend php artisan help loja:consultar-produtos
docker compose exec -T backend php artisan loja:consultar-produtos --no-ansi
```

Sintaxe passou; ajuda mostrou nome/descrição; execução real terminou código 0
com a saída acima. Diagnóstico temporário em PHP Docker conferiu a classe da
coleção, count 0, isEmpty true, SQL compilado e uma única consulta SELECT sem
parâmetros capturada. Confirmou banco loja e login loja_app.

A primeira comparação adicional presumiu SQL com aspas duplas e falhou; o
compilador de consultas usa [produtos]. Inspecionado o SQL real, a comparação
foi corrigida e o diagnóstico passou, sem alterar o código da aplicação.

HTTP /loja permaneceu 200, com título, três nomes e X-Curso preservados.
A página ainda usa CatalogoDemonstracao em memória. git diff --check passou;
nenhuma inserção, alteração ou exclusão de dados. Model, migrations, configuração,
credenciais, dependências e serviços preservados.

## Continuidade

Consulta implementada, explicação apresentada e verificações concluídas.
Entendimento da 5.19 confirmado com "entendi" em 15/10/2026. Checkpoint
133591a publicado; HEAD, origin/main e main remota conferidos no SHA
133591af4ae4b7f63d982a3241bae67df3a07deb.
Próximo passo realizado na 5.20: apresentar seeders e gerar somente
ProdutoSeeder, explicando sua estrutura inicial, sem preencher ou executar
cadastros nessa etapa.

Fonte consultada em 15/10/2026:

- [Consultas e coleções Eloquent Laravel 13](https://laravel.com/docs/13.x/eloquent#retrieving-models).
