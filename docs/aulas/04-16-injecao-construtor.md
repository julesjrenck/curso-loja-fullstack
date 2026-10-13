# Aula 4.16 — Injeção pelo construtor

## Objetivo

Receber CatalogoDemonstracao ao criar LojaController e guardar o objeto em uma
propriedade. Alteramos somente o controller, preservando a página. Aplicamos
a promoção de propriedades estudada no módulo 3 à injeção pelo Laravel.

## Alteração em LojaController.php

O import CatalogoDemonstracao permanece. O corpo da classe passou a conter:

```php
public function __construct(private CatalogoDemonstracao $catalogo)
{
}

public function index(): View
{
    return view('loja', [
        'nomeLoja' => config('app.name'),
        'produtos' => $this->catalogo->listarNomes(),
    ]);
}
```

__construct é o construtor, chamado na criação da instância. O Laravel utiliza
seu container para resolver o controller e suas dependências tipadas. Nesta
etapa, ele fornece CatalogoDemonstracao ao construtor, que é público.

private CatalogoDemonstracao $catalogo usa promoção de propriedade:

- O construtor recebe um objeto do tipo CatalogoDemonstracao.
- A classe ganha uma propriedade privada tipada, chamada catalogo.
- PHP atribui automaticamente o objeto recebido a essa propriedade.

O corpo vazio é suficiente porque a promoção já faz a atribuição. A forma
expandida equivalente, apenas para comparação, seria:

```php
private CatalogoDemonstracao $catalogo;

public function __construct(CatalogoDemonstracao $catalogo)
{
    $this->catalogo = $catalogo;
}
```

Não acrescentamos essa forma expandida ao arquivo. O código usa a versão promovida.

## Uso da propriedade em index

index deixou de receber o parâmetro local $catalogo. Agora consulta:

```php
$this->catalogo->listarNomes()
```

$this é o objeto atual de LojaController. ->catalogo acessa sua propriedade;
->listarNomes() chama o método no catálogo guardado nela. A propriedade privada
pode ser utilizada pelos métodos dessa classe.

O objeto recebido no construtor fica disponível na instância do controller.
Essa propriedade pertence à instância; a alteração não registra um singleton
global no Laravel. A classe CatalogoDemonstracao e seus três nomes permanecem iguais.

## Comparação dos pontos de injeção

| Etapa | Onde a dependência chega | Como index acessa |
| --- | --- | --- |
| 4.15 | Parâmetro do método index | $catalogo->listarNomes() |
| 4.16 | Parâmetro do construtor, guardado na instância | $this->catalogo->listarNomes() |

A injeção no método entrega o objeto à chamada daquele método. A injeção no
construtor disponibiliza a dependência ao objeto e aos seus métodos. Os dois
mecanismos são oferecidos pelo container Laravel; esta etapa compara seu uso.

CatalogoDemonstracao continua concreta e sem dependências de construção, então
sua resolução automática permanece suficiente. Não alteramos AppServiceProvider
ou configuração de bindings nesta etapa.

## Verificações

```bash
docker compose exec -T backend php -l /app/app/Http/Controllers/LojaController.php
```

A sintaxe passou. Um diagnóstico PHP temporário no container backend consultou
o servidor pela porta interna 8000 e verificou:

- GET /loja HTTP 200, com título, saudação e três nomes na ordem esperada.
- Cabeçalho X-Curso: Laravel preservado.
- GET / HTTP 200, welcome preservada e sem o cabeçalho do middleware.
- Catálogo, rota, view, middleware, provider, src, Compose, imagem, JSON e lockfile
  sem alterações. Sem rebuild, reinício ou regeneração de autoload.
- Sem banco, migrations, testes Laravel, frontend, dependências, mudança de chave
  ou execução do contador.

O atendimento bem-sucedido confirma a criação do controller com o parâmetro
obrigatório e o uso da propriedade inicializada. Os dados continuam em memória.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 5da3709 publicado;
HEAD, origin/main e consulta direta à main remota coincidiram.

Após confirmação, publicar 4.16 e iniciar 4.17: definir a interface
App\Contracts\Catalogo com listarNomes(): array, implementá-la em CatalogoDemonstracao,
receber o contrato no construtor e registrar sua ligação à implementação em
AppServiceProvider::register. Esse conjunto permite estudar interface, binding
e papel do provider, preservando a mesma página e os dados demonstrativos.

Fontes oficiais:

- [Injeção pelo construtor nos controllers](https://laravel.com/docs/13.x/controllers#constructor-injection).
- [Promoção de propriedades no PHP](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion).
