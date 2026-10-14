# Aula 5.9 — Primeira consulta Laravel

## Objetivo

Usar a configuração da 5.8 para executar uma consulta pelo Laravel. A conta
loja_app já existe; precisamos conferir que a aplicação chega ao banco loja
com essa conta. Checkpoint 5.8 publicado e conferido em e0e06ef, SHA completo
e0e06ef063ec245739e18f684336d218751687e9.

## Um comando da aplicação

Alteramos apenas backend/routes/console.php. O arquivo define entradas de
terminal, diferente de routes/web.php, que define entradas HTTP. O arquivo
bootstrap/app.php já registra console.php por withRouting(commands: ...).
O comando inspire gerado pelo Laravel foi preservado.

```php
use Illuminate\Support\Facades\DB;

Artisan::command('loja:verificar-banco', function () {
    $resultado = DB::selectOne(
        'SELECT DB_NAME() AS banco, SUSER_SNAME() AS login, USER_NAME() AS usuario'
    );

    $this->line('Banco: '.$resultado->banco);
    $this->line('Login: '.$resultado->login);
    $this->line('Usuário: '.$resultado->usuario);
})->purpose('Verifica a conexão Laravel com o banco da loja');
```

use importa o nome DB para podermos usá-lo sem escrever o namespace completo.
Artisan::command recebe o nome do comando e a função anônima que será executada
quando o chamarmos. O corpo não roda só por registrar o comando.

Artisan e DB são fachadas Laravel. A chamada com :: fornece acesso a um serviço
resolvido pelo container Laravel, que estudamos no módulo 4. DB encaminha a
operação ao serviço de banco; este usa a conexão padrão sqlsrv, definida na 5.8.
Não é necessário criar manualmente new PDO ou repetir a senha no comando.

## SQL e resultado em PHP

O texto entregue a selectOne é SQL, executado no servidor SQL Server:

```sql
SELECT DB_NAME() AS banco,
       SUSER_SNAME() AS login,
       USER_NAME() AS usuario;
```

SELECT pede um resultado. Neste caso não há FROM porque consultamos funções
do contexto atual, sem ler uma tabela de produtos:

- DB_NAME() retorna o banco atual, loja.
- SUSER_SNAME() retorna o login do contexto de segurança, loja_app nesta sessão.
- USER_NAME() retorna o usuário atual dentro do banco, loja_app.
- AS escolhe o nome de cada coluna do resultado: banco, login e usuario.

Login no servidor e usuário no banco são conceitos diferentes, embora tenham
o mesmo nome no nosso projeto. Isso retoma a preparação da 5.7.

selectOne devolve a primeira linha. Na configuração padrão usada aqui, essa
linha é um objeto com propriedades; $resultado->banco acessa a coluna banco.
select devolveria um array de linhas; nossa consulta retorna uma única linha.
O SQL é fixo, sem entrada do usuário ou interpolação de valores.

O ponto em 'Banco: '.$resultado->banco concatena texto em PHP. $this dentro
da closure é a instância do comando à qual o Laravel liga essa função;
line imprime uma linha no terminal. purpose define a descrição exibida na ajuda.

## Executar e verificar

Na raiz do projeto, com backend e sqlserver ativos:

```bash
docker compose exec -T backend php artisan loja:verificar-banco
```

exec roda dentro do container backend existente; -T desliga terminal interativo.
php executa o arquivo artisan em /app, inicializando Laravel e chamando o nome
registrado em console.php. Não há argumentos obrigatórios. O ambiente local
da aplicação é carregado, a conexão é solicitada e a resposta vira saída:

```text
Banco: loja
Login: loja_app
Usuário: loja_app
```

Verificações executadas:

```bash
docker compose exec -T backend php -l /app/routes/console.php
docker compose exec -T backend php artisan help loja:verificar-banco
docker compose exec -T backend php artisan loja:verificar-banco --no-ansi
```

Sintaxe sem erro; ajuda exibiu nome/descrição; comando SQL retornou os três
valores esperados e código 0. --no-ansi remove formatação ANSI da saída.
Isso comprova conexão e execução de SQL pelo Laravel com rede, conta e drivers
preparados. Ainda não há persistência de produtos ou prova de escrita em tabelas.

GET /loja continuou com 200, título, três produtos e X-Curso preservados.
git diff --check passou; .env da raiz e backend/.env continuam ignorados.
Não foram executadas migrations ou escritas de dados, nem instaladas dependências.

## Continuidade

Implementação, explicação e verificações concluídas; entendimento da 5.9
confirmado com "entendi" em 14/10/2026. Checkpoint publicado e conferido em
173ed00: HEAD, origin/main e main remota retornaram
173ed0089496181ec510cd521d7995a62045ca54. Registro no checkpoint seguinte.
Próximo passo realizado na 5.10: modelagem inicial de produtos,
explicando colunas, tipos e chave primária antes de criar uma migration.

Fontes consultadas em 14/10/2026:

- [Comandos com closures](https://laravel.com/docs/13.x/artisan#closure-commands).
- [Fachadas Laravel](https://laravel.com/docs/13.x/facades).
- [selectOne na API Laravel 13](https://api.laravel.com/docs/13.x/Illuminate/Database/Connection.html#method_selectOne).
- [DB_NAME](https://learn.microsoft.com/en-us/sql/t-sql/functions/db-name-transact-sql?view=sql-server-ver16).
- [SUSER_SNAME](https://learn.microsoft.com/en-us/sql/t-sql/functions/suser-sname-transact-sql).
- [USER_NAME](https://learn.microsoft.com/en-us/sql/t-sql/functions/user-name-transact-sql?view=sql-server-ver16).
