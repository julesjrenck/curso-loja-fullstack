# Aula 4.15 — Injeção de dependência no controller

## Objetivo

Extrair os nomes demonstrativos para uma classe PHP e receber seu objeto no
controller por injeção de dependência. O container de serviços do Laravel
resolve objetos necessários ao atendimento. Docker fornece o ambiente de execução;
o mecanismo do Laravel trabalha com as dependências dos objetos PHP.

O conjunto de dois arquivos é inseparável: CatalogoDemonstracao fornece a lista
e LojaController recebe esse objeto para consultar os nomes. Rota, view e
middleware continuam iguais; os dados permanecem demonstrativos em memória.

## CatalogoDemonstracao.php

O arquivo estava ausente e foi criado pelo editor em app/Services:

```php
<?php

namespace App\Services;

class CatalogoDemonstracao
{
    public function listarNomes(): array
    {
        return ['Camiseta', 'Calça', 'Tênis'];
    }
}
```

- namespace posiciona a classe em App\Services; o autoload App\\ -> app/ já
  existente localiza o arquivo.
- A classe é PHP comum. Ela fornece o método usado pelo controller.
- public permite chamar listarNomes fora da classe; : array declara seu retorno.
- O array mantém os mesmos nomes e ordem, agora definidos nesse arquivo.

Não houve comando de geração ou dependência nova. Não criamos um model Eloquent
ou persistência; a classe serve para praticar resolução de objetos com dados conhecidos.

## Dependência recebida no método

LojaController recebeu o import da classe e passou a ter:

```php
use App\Services\CatalogoDemonstracao;

public function index(CatalogoDemonstracao $catalogo): View
{
    return view('loja', [
        'nomeLoja' => config('app.name'),
        'produtos' => $catalogo->listarNomes(),
    ]);
}
```

CatalogoDemonstracao antes de $catalogo é o tipo esperado do parâmetro. O método
depende desse objeto para obter os nomes, e quem faz a chamada fornece o objeto:
essa é a ideia da injeção de dependência.

Em uma chamada PHP direta, seria preciso entregar uma instância ao chamar index.
Na rota Laravel, o framework examina o tipo do parâmetro, usa seu container de
serviços para resolver CatalogoDemonstracao e passa o objeto ao método.

Essa classe é concreta e não possui dependências de construção, então o container
consegue criá-la automaticamente. Não foi necessário registrar bindings ou alterar
AppServiceProvider. Esses registros serão apresentados quando necessários.

$catalogo->listarNomes() chama o método público e retorna o array para a chave
produtos. A view continua recebendo $produtos e exibindo os mesmos nomes. O tipo
de retorno de index permanece View.

O autoload carrega a definição da classe; o container entrega uma instância;
o atendimento Laravel chama index com esse objeto. Criar a classe e importar
seu nome fornece as informações usadas nesse processo.

## Caminho dos dados

```text
GET /loja
  -> Laravel resolve CatalogoDemonstracao
  -> LojaController::index recebe $catalogo
  -> $catalogo->listarNomes() fornece o array
  -> view loja recebe produtos
  -> Blade gera HTML
```

A associação da rota a LojaController@index e o middleware MarcarRespostaCurso
foram preservados. O cabeçalho X-Curso continua sendo acrescentado à resposta.

## Verificações

```bash
docker compose exec -T backend php -l /app/app/Services/CatalogoDemonstracao.php
docker compose exec -T backend php -l /app/app/Http/Controllers/LojaController.php
```

As duas sintaxes passaram. Um diagnóstico HTTP em PHP no Docker conferiu:

- GET /loja HTTP 200, com título, saudação e três itens na ordem esperada.
- Cabeçalho X-Curso: Laravel preservado.
- GET / HTTP 200, welcome preservada e sem o cabeçalho do middleware.
- Rota, view, middleware, provider, bootstrap, src, Compose, imagem, JSON e lockfile
  sem alterações. Sem rebuild, reinício ou regeneração de autoload.
- Sem banco, migrations, testes Laravel, frontend, dependências, mudança de chave
  ou execução do contador.

A requisição bem-sucedida também verifica que o parâmetro obrigatório tipado foi
fornecido pelo Laravel e que os dados da classe chegaram à view. O teste não
imprimiu cookies ou respostas completas.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: 354626c, etapa 4.14.

Após confirmação, publicar 4.15 e iniciar 4.16: receber CatalogoDemonstracao pelo
construtor de LojaController, usando propriedade promovida, e consultar
$this->catalogo em index. Comparar os pontos de entrega da dependência, preservando
o resultado da página e aproveitando o construtor estudado no módulo 3.

Fontes oficiais:

- [Resolução automática pelo container](https://laravel.com/docs/13.x/container#zero-configuration-resolution).
- [Injeção em métodos de controllers](https://laravel.com/docs/13.x/controllers#method-injection).
