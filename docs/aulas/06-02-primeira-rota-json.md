# Aula 6.2 — Primeira rota do catálogo em JSON

## Objetivo e estado

Criar GET /api/v1/produtos reutilizando o catálogo persistido, que já fornece
nomes ativos ordenados. Implementação, explicação e verificações em 22/10/2026;
entendimento confirmado pelo aluno com "entendi" em 22/10/2026.
Alterações da aplicação limitadas ao conjunto
inseparável bootstrap/app.php e routes/api.php.

Etapa anterior 6.1 confirmada com "entendi" em 22/10/2026 e publicada no commit
7ce865ade29038292a064649f5b509f9205d3d51. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após o push. Autorização persistente respeitada.

## Registro do arquivo de rotas

Em backend/bootstrap/app.php, withRouting recebeu duas entradas:

```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
    apiPrefix: 'api/v1',
)
```

Os argumentos nomeados `api` e `apiPrefix` dizem ao Laravel onde encontrar as
rotas da API e qual prefixo acrescentar aos caminhos delas. `__DIR__` é a pasta
do arquivo atual, bootstrap; `../routes/api.php` chega ao arquivo de rotas.
Essa expressão é um caminho de arquivo, diferente da URL pública da API.

As rotas desse arquivo recebem o grupo de middleware api. O prefixo api/v1
somado ao caminho /produtos forma /api/v1/produtos. Não repetimos o prefixo no
arquivo api.php. A assinatura instalada de withRouting foi conferida por reflexão.

## A primeira rota

Arquivo novo backend/routes/api.php:

```php
<?php

use App\Contracts\Catalogo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', function (Catalogo $catalogo): JsonResponse {
    return response()->json([
        'data' => $catalogo->listarNomes(),
    ]);
});
```

Os três `use` permitem referenciar o contrato Catalogo, o tipo de resposta
JsonResponse e a facade Route pelos nomes curtos.

Route::get registra a consulta. A função anônima é executada quando a rota é
chamada. O parâmetro Catalogo $catalogo pede uma dependência ao container,
assim como já vimos no controller. O binding existente em AppServiceProvider
entrega CatalogoEloquent. Não usamos `new CatalogoEloquent` na rota.

ListarNomes faz a consulta existente: ativos, ordenação por nome, pluck e all.
O array associativo PHP tem uma chave data cujo valor é esse array de nomes.
Response()->json converte o array para texto JSON, define Content-Type como
application/json e usa status 200 por padrão. O tipo de retorno JsonResponse
expressa que a função devolve um objeto de resposta, e não o array ou uma view.

Não é necessário chamar json_encode manualmente, imprimir cabeçalhos ou passar
por Blade. O fluxo desta rota é:

```text
GET /api/v1/produtos -> função da rota -> Catalogo/CatalogoEloquent
                    -> Produto/SQL Server -> array PHP -> resposta JSON
```

O contrato inicial está em docs/api/catalogo.md: sucesso 200 com objeto data,
lista de strings com nomes ativos ordenados; lista vazia é data: []. São somente
os nomes disponíveis no contrato atual do serviço. Dados completos de produtos,
filtros e paginação serão introduzidos nas etapas correspondentes.

## Verificações executadas

PHP e Composer foram conferidos no container backend: PHP 8.4.26 e Composer
2.10.3. Não houve instalação de dependências. Mantida a decisão do curso de usar
Docker e não instalar Boost automaticamente, conforme registro da 4.2.

```bash
docker compose exec -T backend php -l bootstrap/app.php
docker compose exec -T backend php -l routes/api.php
docker compose exec -T backend php artisan route:list --path=api -vv
docker compose exec -T backend php < /tmp/curso-62-http.php
docker compose exec -T backend php artisan test
```

`exec -T backend` executa no container existente, sem terminal interativo.
`php -l` verifica sintaxe sem executar as rotas. Route:list lista os registros;
--path=api limita a saída e -vv mostra os grupos de middleware. Foi encontrado
GET|HEAD api/v1/produtos, grupo api. HEAD é registrado pelo Laravel junto a GET;
seu comportamento não foi o tema nem uma verificação HTTP desta etapa.

O diagnóstico temporário enviado pela entrada padrão usou file_get_contents
para fazer duas requisições reais no servidor interno, porta 8000. Exigiu status
200 e o tipo de conteúdo esperado nas duas. Na API, json_decode com
JSON_THROW_ON_ERROR e comparação estrita exigiram ['data' => ['Camiseta'].
Na página, conferiu <li>Camiseta</li>. Não exibiu cookies/cabeçalhos de sessão.

```text
GET /api/v1/produtos | HTTP/1.1 200 OK | Content-Type: application/json
Corpo JSON: {"data":["Camiseta"]}
GET /loja | HTTP/1.1 200 OK | Content-Type: text/html; charset=utf-8
Corpo HTML contém <li>Camiseta</li>: sim
```

As sintaxes e os dois diagnósticos retornaram código 0. A suíte existente passou:
14 testes/54 asserções, código 0. Houve aviso de escrita de .phpunit.result.cache
no código montado somente leitura; o cache de resultados não foi salvo, sem
falha dos testes. Em próximas execuções, usar --do-not-cache-result para evitar
esse aviso, sem mudar a montagem ou a configuração nesta aula.
Essa suíte cobre os comportamentos anteriores; os testes específicos da rota
JSON ainda não foram escritos. A resposta atual foi verificada por HTTP real.

Após a suíte, diagnóstico separado /tmp/curso-62-contagens.php conferiu por
SELECT a identidade e as contagens: loja_test/loja_testes com 0 categorias e
0 produtos; loja/loja_app com 0 categorias e 1 produto. Código 0 nos dois.
Não houve migration, seeder ou cadastro permanente nesta etapa.

Para experimentar no navegador do host, abrir:
http://127.0.0.1:8002/api/v1/produtos. O navegador pode formatar a visualização;
o corpo recebido é JSON. A resposta atual contém {"data":["Camiseta"]}.

Referências oficiais consultadas:

- [Registro e prefixo das rotas de API](https://laravel.com/framework/docs/13.x/routing).
- [Respostas JSON](https://laravel.com/framework/docs/13.x/responses#json-responses).

## Continuidade

Entendimento da 6.2 confirmado. Publicar o checkpoint e iniciar somente a 6.3,
primeiro teste HTTP automatizado
para catálogo vazio em GET /api/v1/produtos, com DatabaseTransactions e banco
exclusivo loja_test; conferir status, tipo de conteúdo e estrutura JSON.
