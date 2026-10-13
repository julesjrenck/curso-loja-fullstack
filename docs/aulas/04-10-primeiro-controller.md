# Aula 4.10 — Primeiro controller da loja

## Objetivo

Mover o atendimento de GET /loja para um método público de controller, mantendo
a resposta. A rota associa o endereço ao atendimento; o controller organiza
o código que produz a resposta. Esta etapa introduz o C de MVC.

O conjunto de dois arquivos é inseparável: LojaController fornece o método e
routes/web.php liga a rota a ele. Ainda não criamos uma view própria ou model.

## Geração com Artisan

LojaController.php estava ausente antes do comando. Conferimos help make:controller
e geramos a classe no Docker:

```bash
docker compose run --rm \
  --volume ./backend/app/Http/Controllers:/app/app/Http/Controllers:rw \
  backend php artisan make:controller LojaController --no-interaction
```

make:controller recebe o nome da classe e cria o arquivo na pasta convencional
app/Http/Controllers, com namespace e classe inicial. --no-interaction evita
perguntas. Não usamos --force; arquivos existentes não seriam sobrescritos.

A montagem temporária torna somente a pasta dos controllers gravável para o
comando de geração. As montagens normais do serviço continuam como antes.
No mesmo container de geração, após sucesso, executamos:

```bash
chown --reference=/app/app/Http/Controllers/Controller.php \
  /app/app/Http/Controllers/LojaController.php
```

chown alinhou o proprietário do arquivo novo ao da classe base existente.
stat no host confirmou 1000:1000. O comando de geração e esse ajuste terminaram
com código 0.

O arquivo gerado tinha classe vazia e import Illuminate\Http\Request. Retiramos
o import sem uso nesta etapa e acrescentamos index, com o atendimento da 4.9.

## LojaController.php

```php
<?php

namespace App\Http\Controllers;

class LojaController extends Controller
{
    public function index(): string
    {
        return 'Bem-vindo à '.config('app.name').'!';
    }
}
```

- namespace posiciona a classe em App\Http\Controllers. O autoload App\\ -> app/
  existente permite encontrar o arquivo; não alteramos o Composer.
- class LojaController define a classe com o mesmo nome do arquivo.
- extends Controller usa a classe base do mesmo namespace. Controller.php já
  existia, é abstract e está vazio; não acrescentamos comportamento a ele.
- public permite que o Laravel chame index no objeto do controller.
- index é o nome escolhido para esse atendimento; a rota deve indicar esse nome.
- : string declara o retorno, preservando o tipo da função anônima anterior.
- O return mantém a mesma concatenação com config('app.name').

index é um método de instância. A rota fornece a classe e o nome do método;
o Laravel obtém uma instância e chama esse método. Construção e injeção de
dependências serão aprofundadas posteriormente.

## Ligação em routes/web.php

Acrescentamos o import da classe e substituímos a função anônima de /loja:

```php
use App\Http\Controllers\LojaController;

Route::get('/loja', [LojaController::class, 'index']);
```

use permite escrever o nome curto LojaController. O segundo argumento da rota
agora é um array com dois elementos:

- LojaController::class fornece a string App\Http\Controllers\LojaController;
  essa expressão identifica a classe.
- 'index' informa o método público a chamar no objeto.

O array registra o destino do atendimento. Quando chega GET /loja, o Laravel
resolve esse destino, chama index e transforma a string retornada em resposta HTTP.
O fluxo agora é GET /loja -> rota -> LojaController -> index() -> saudação.
A rota / continua usando a função anônima que retorna a view welcome.

## Verificações

```bash
docker compose exec -T backend php -l /app/app/Http/Controllers/LojaController.php
docker compose exec -T backend php -l /app/routes/web.php
docker compose exec -T backend php artisan route:list --path=loja --except-vendor
```

Os dois php -l passaram. route:list mostrou GET|HEAD loja com destino
LojaController@index, confirmando a ligação da rota ao método.

O diagnóstico HTTP executado em PHP no Docker conferiu:

| Requisição | Resultado |
| --- | --- |
| GET /loja | HTTP 200 e corpo exato Bem-vindo à Loja Fullstack! |
| POST /loja | HTTP 405, método recusado como antes. |
| GET / | HTTP 200, com título Loja Fullstack e welcome preservada. |

A resposta igual à anterior comprova que o atendimento mudou de lugar e continua
funcionando pelo HTTP. Isso também verifica o carregamento da nova classe pelo
autoload existente. Não foi necessário regenerar autoload, instalar pacotes,
reiniciar o servidor ou reconstruir a imagem.

Não adicionamos banco, frontend, migrations ou testes Laravel. Configuração,
chave e laboratório foram preservados; nenhum comando do contador executado.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: 1671a0b, etapa 4.9.

Após confirmação, publicar 4.10 e iniciar 4.11: criar resources/views/loja.blade.php
e adaptar index para retornar view('loja') com o nome da loja como dado. Explicar
tipo View, passagem de dados, HTML mínimo e expressão Blade {{ }}. Model e banco
continuam conforme as etapas previstas do curso.

Fonte: [Controllers e ligação às rotas](https://laravel.com/docs/13.x/controllers#basic-controllers).
