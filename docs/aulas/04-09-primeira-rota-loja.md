# Aula 4.9 — Primeira rota da loja

## Objetivo

Criar GET /loja em backend/routes/web.php e apresentar como o Laravel associa
um método e um caminho a uma função que produz a resposta. O servidor já está
ativo na porta 8002; a rota / e sua página welcome foram preservadas.

## Alteração no arquivo

Acrescentamos somente esta rota:

```php
Route::get('/loja', function (): string {
    return 'Bem-vindo à '.config('app.name').'!';
});
```

O import existente use Illuminate\Support\Facades\Route permite usar o nome
curto Route. Os arquivos de rotas web são ligados à aplicação pela configuração
web de bootstrap/app.php, apresentada anteriormente.

- Route::get registra o atendimento para o método HTTP GET. Abrir esse endereço
  no navegador normalmente faz uma requisição GET.
- '/loja' é o caminho dentro do backend. A URL completa é
  http://127.0.0.1:8002/loja. Não é necessário criar uma pasta loja no servidor.
- function () define uma função anônima, também chamada closure, passada como
  segundo argumento. Não recebe parâmetros nesta etapa.
- : string declara o tipo do valor devolvido, como os retornos tipados do módulo 3.
- O Laravel chama essa função quando uma requisição corresponde à rota. Registrar
  a função no arquivo não é executar a saudação imediatamente.
- return devolve o texto ao Laravel. O ponto . concatena os três trechos:
  'Bem-vindo à ', o nome configurado e '!'.
- }); fecha a função, a chamada de Route::get e a instrução PHP.

O resultado da função é uma string. O Laravel a transforma em uma resposta HTTP:
status 200 e o texto no corpo. A resposta observada usa Content-Type:
text/html; charset=utf-8, embora o corpo desta rota seja apenas a saudação.

## Nome vindo da configuração

config('app.name') consulta a chave name do grupo app, definido por
backend/config/app.php:

```php
'name' => env('APP_NAME', 'Laravel'),
```

O ambiente local define APP_NAME="Loja Fullstack". Durante a inicialização,
o Laravel carrega essa opção; a rota consulta a configuração pronta. O caminho
da informação é .env -> config/app.php -> config('app.name') -> saudação.

Esse uso mantém a resposta relacionada à configuração da aplicação. A função
anônima contém o atendimento nesta etapa; um controller organizará esse código
no próximo passo.

## Verificações executadas

```bash
docker compose exec -T backend php -l /app/routes/web.php
docker compose exec -T backend php artisan route:list --path=loja --except-vendor
```

exec executa no container backend já ativo; -T desabilita o terminal. php -l
confere sintaxe sem executar o arquivo. Retornou ausência de erros e código 0.

route:list lista rotas registradas. --path=loja filtra por caminho; --except-vendor
exclui rotas dos pacotes da listagem. Foi exibida uma rota GET|HEAD loja em
routes/web.php:9. HEAD acompanha GET e permite consultar cabeçalhos sem corpo.

Um diagnóstico PHP em container temporário, com --network host, consultou a porta
publicada do computador, conforme a regra de executar verificações no Docker.

| Requisição | Resultado e significado |
| --- | --- |
| GET /loja | HTTP 200, corpo exato Bem-vindo à Loja Fullstack!; atendimento e configuração funcionam. |
| POST /loja | HTTP 405; o caminho existe, mas esse método não está registrado. |
| GET / | HTTP 200 e título Loja Fullstack; página welcome preservada. |

O teste comparou o texto, os status e o Content-Type sem imprimir cookies ou
conteúdo de erros. Usou Accept: application/json nas consultas de /loja; o retorno
string da rota permaneceu com o Content-Type HTML observado.

A alteração foi lida pelo bind mount, sem rebuild ou reinício. Não mudamos
Compose, imagem, dependências, chave, banco ou frontend. Não executamos migrations,
testes Laravel ou o contador. Estes diagnósticos verificam a rota HTTP, não regras
de catálogo ou persistência.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 1671a0b publicado;
HEAD, origin/main e consulta direta à main remota coincidiram.

Após confirmação, publicar 4.9 e iniciar 4.10: criar LojaController com método
index e fazer GET /loja apontar para esse método, preservando a saudação. Explicar
a relação entre rota, classe, método público e resposta. A view própria da loja
entrará em etapa posterior; banco continua conforme o módulo previsto.

Fontes oficiais:

- [Rotas básicas e listagem](https://laravel.com/docs/13.x/routing#basic-routing).
- [Resposta a partir de uma string](https://laravel.com/docs/13.x/responses#strings-and-arrays).
- [Consulta de configuração](https://laravel.com/docs/13.x/configuration#accessing-configuration-values).
