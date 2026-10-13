# Aula 4.11 — Primeira view Blade da loja

## Objetivo

Criar a apresentação de /loja em uma view Blade e passar o nome da aplicação
pelo controller. O controller fornece o dado; a view define o HTML mostrado.
Esta etapa introduz uma view própria, o V de MVC, sem model ou persistência.

O conjunto é inseparável: o controller referencia o template e fornece nomeLoja;
loja.blade.php usa esse dado. A rota existente permaneceu apontando para index.

## Controller e retorno View

LojaController.php recebeu o import e o novo retorno:

```php
use Illuminate\View\View;

public function index(): View
{
    return view('loja', [
        'nomeLoja' => config('app.name'),
    ]);
}
```

- use importa a classe Illuminate\View\View, permitindo o nome curto View.
- index(): View declara que o método devolve um objeto dessa classe. Na etapa
  anterior o retorno declarado era string; agora devolvemos a view com seus dados.
- view é um helper do Laravel. 'loja' identifica resources/views/loja.blade.php.
  O nome é informado sem pasta base ou extensão.
- O segundo argumento é um array associativo de dados. A chave nomeLoja fica
  disponível no template como a variável PHP $nomeLoja.
- config('app.name') continua consultando o nome da aplicação configurado.
- O Laravel renderiza a view e envia o HTML na resposta HTTP.

Não alteramos namespace, herança, rota ou configuração. O controller agora
seleciona o template e entrega o dado, enquanto o template apresenta a saudação.

## Template loja.blade.php

O arquivo estava ausente antes da criação. Seu conteúdo é:

```html
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $nomeLoja }}</title>
    </head>
    <body>
        <h1>Bem-vindo à {{ $nomeLoja }}!</h1>
    </body>
</html>
```

- <!DOCTYPE html> identifica o documento HTML.
- html envolve o documento; lang="pt-BR" identifica o idioma do conteúdo.
- head contém informações da página. charset="utf-8" permite representar
  caracteres como o à da saudação; viewport orienta a área de exibição no navegador.
- title define o título da aba, usando o nome recebido.
- body contém o conteúdo da página. h1 marca seu título principal.
- {{ $nomeLoja }} é a expressão Blade que exibe o valor da variável com escape
  HTML. O nome usado deve corresponder à chave passada pelo controller.

HTML e CSS serão aprofundados no módulo próprio; aqui usamos apenas os elementos
necessários à primeira página Blade. Não introduzimos estilos ou build frontend.

## Renderização e caracteres especiais

O caminho de uma requisição continua GET /loja -> rota -> LojaController@index.
O método entrega um objeto View; o Laravel processa loja.blade.php com os dados
e produz HTML. O navegador recebe, por exemplo:

```html
<h1>Bem-vindo à Loja Fullstack!</h1>
```

As chaves Blade já foram substituídas antes de o navegador receber a resposta.
Laravel gera PHP compilado em storage/framework/views para executar o template;
esse arquivo gerado fica local, ignorado pelo Git, como apresentado na 4.8.

As duplas chaves fazem escape de caracteres especiais. No teste com o dado
<b>Loja & teste</b>, o trecho gerado foi:

```html
<h1>Bem-vindo à &lt;b&gt;Loja &amp; teste&lt;/b&gt;!</h1>
```

Assim, o nome fornecido é exibido como texto. O teste entregou esse valor somente
à view; não mudou APP_NAME, arquivos de configuração ou o ambiente local.

## Verificações

```bash
docker compose exec -T backend php -l /app/app/Http/Controllers/LojaController.php
```

A sintaxe do controller passou. A sintaxe Blade e a ligação dos dados foram
verificadas pela renderização real, em vez de tratar o template como PHP comum.

Resultados dos diagnósticos PHP executados no Docker:

- GET /loja retornou HTTP 200 e Content-Type text/html; charset=utf-8.
- Doctype, idioma, charset, título Loja Fullstack e h1 com saudação conferidos.
- Expressões {{ }} ausentes no HTML recebido: processamento Blade concluído.
- GET / permaneceu HTTP 200, com a página welcome preservada.
- Renderização isolada com nome de teste confirmou escape no título e na saudação.
- Arquivos PHP compilados em storage/framework/views ignorados pelo Git.
- Alterações visíveis pelo bind mount, sem rebuild ou reinício.
- Rota, src, Compose, Dockerfile, JSON e lockfile preservados. Sem banco, migrations,
  testes Laravel, dependências, frontend, mudança de chave ou contador.

Os resultados verificam apresentação HTML e passagem de dados. Ainda não são
uma implementação de catálogo persistido ou compra da loja.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: f31b38e, etapa 4.10.

Após confirmação, publicar 4.11 e iniciar 4.12: enviar uma pequena lista de nomes
demonstrativos de produtos do controller para a view e exibi-la com @foreach.
Os dados serão mantidos em memória para estudar Blade; model e banco continuam
conforme as etapas previstas do curso.

Fontes oficiais:

- [Views e passagem de dados](https://laravel.com/docs/13.x/views#passing-data-to-views).
- [Blade e exibição de dados](https://laravel.com/docs/13.x/blade#displaying-data).
