# Aula 5.27 — Página com catálogo do banco

## Objetivo

Fazer o container entregar CatalogoEloquent ao controller que atende /loja.
A 5.26 foi confirmada com "entendi" em 16/10/2026 e publicada em f14564c,
SHA completo f14564c29d64fdd07a709c48da7db1a978db445c, conferido na main remota.

## Alteração em backend/app/Providers/AppServiceProvider.php

Trocamos o import da implementação por:

```php
use App\Services\CatalogoEloquent;
```

No método register, o binding passou a ser:

```php
$this->app->bind(Catalogo::class, CatalogoEloquent::class);
```

$this é o provider; app é o container Laravel ao qual ele tem acesso. bind
registra qual implementação será fornecida quando alguém pedir a interface.
O primeiro argumento identifica o contrato Catalogo. O segundo identifica a
classe concreta CatalogoEloquent. ::class produz o nome completo da classe
como string; não cria um objeto naquele instante. O import da interface e
a classe base ServiceProvider permanecem. boot continua vazio.

O provider registra essa associação durante a inicialização da aplicação.
Criar ou resolver o serviço não executa a consulta por si só: a consulta
está em listarNomes, chamado pelo controller.

## Como o controller recebe a implementação

O construtor existente em backend/app/Http/Controllers/LojaController.php é:

```php
public function __construct(private Catalogo $catalogo)
{
}
```

Quando a rota pede LojaController, o container cria o controller e resolve
seu parâmetro Catalogo conforme o binding. Agora entrega um CatalogoEloquent.
A promoção de propriedade guarda esse objeto em $this->catalogo.

No index existente, $this->catalogo->listarNomes() entrega o array de strings
que segue como produtos para view('loja', ...). CatalogoEloquent consulta
produtos pelo model Produto, usando sqlsrv/loja_app. A view percorre os nomes
com @foreach e os imprime com escape do Blade. Controller e view receberam
o mesmo formato já definido pelo contrato, sem alteração de código neles.

O caminho passa por rota /loja, controller com serviço injetado, consulta de
CatalogoEloquent ao SQL Server e renderização da view com o array retornado.
A implementação em memória permanece no projeto como parte do aprendizado;
o binding agora seleciona a implementação do banco.

## Verificações em Docker

```bash
docker compose exec -T backend php -l /app/app/Providers/AppServiceProvider.php
```

exec usa o backend existente, -T dispensa terminal interativo e php -l
verifica a sintaxe sem executar o arquivo. Sintaxe passou com código 0.

Diagnóstico temporário em PHP Docker inicializou o kernel HTTP, resolveu
Catalogo como App\Services\CatalogoEloquent e conferiu banco loja/login loja_app.
Depois passou uma requisição GET /loja ao kernel, com observador SQL ativo.
Conferiu HTTP 200, título Loja Fullstack, X-Curso: Laravel e exatamente um
li com Camiseta. Capturada uma única consulta da requisição, sem parâmetros:

```sql
select [nome] from [produtos]
```

Uma segunda verificação fez uma requisição HTTP real ao servidor ativo em
http://127.0.0.1:8000/loja dentro do container, usando file_get_contents em
PHP Docker. Conferiu novamente status 200, título, header e único item Camiseta.
Os diagnósticos terminaram com código 0; nenhum header de sessão foi exposto.

Pelo navegador no host, a página está em:

[http://127.0.0.1:8002/loja](http://127.0.0.1:8002/loja).

O Compose publica a porta 8000 do backend na 8002 do host. A lista conferida
pelo professor contém somente Camiseta, o produto que foi persistido. Não
presumir que o aluno abriu a página ou relatou resultado no navegador.

git diff --check passou. Mudança de código restrita ao provider, em import
e binding. Sem nova execução de seeder ou escrita SQL; serviço, interface,
model, controller, view, rotas, migrations, configuração/credenciais,
dependências e serviços Docker preservados.

## Continuidade

Integração implementada e explicada; sintaxe, resolução e HTTP conferidos.
Entendimento da 5.27 confirmado com "entrendi" em 16/10/2026. Checkpoint
preparado para publicação autorizada; último publicado f14564c.

Próximo passo exato: publicar 5.27 e iniciar 5.28,
ajustar somente os textos de título da lista e mensagem de ausência em
backend/resources/views/loja.blade.php para o catálogo persistido, preservando
@if/@foreach/escape e conferindo a resposta HTTP.

Fonte consultada em 16/10/2026:

- [Binding de interfaces no Laravel 13](https://laravel.com/docs/13.x/container#binding-interfaces-to-implementations).
