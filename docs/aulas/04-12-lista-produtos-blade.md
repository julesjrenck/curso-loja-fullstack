# Aula 4.12 — Lista de produtos com Blade

## Objetivo

Enviar uma pequena lista de nomes demonstrativos pelo controller e gerar um
item HTML para cada nome usando @foreach. Os dados ficam em memória, para
estudar a apresentação Blade; ainda não há catálogo persistido.

O controller fornece o novo dado e a view o percorre. Esse conjunto de dois
arquivos foi alterado; rota, nome da loja, título e saudação foram preservados.

## Dados no controller

LojaController@index continua retornando View. Seu array passou a incluir produtos:

```php
return view('loja', [
    'nomeLoja' => config('app.name'),
    'produtos' => ['Camiseta', 'Calça', 'Tênis'],
]);
```

O array associativo externo envia dados para o template. A chave produtos
torna-se a variável $produtos na view. Seu valor é outro array, desta vez uma
lista de três strings na ordem informada. Cada string contém apenas um nome;
não introduzimos entidades, preços ou acesso a banco nesta etapa.

## Repetição na view

Depois da saudação, loja.blade.php recebeu:

```blade
<h2>Produtos de demonstração</h2>
<ul>
    @foreach ($produtos as $produto)
        <li>{{ $produto }}</li>
    @endforeach
</ul>
```

- h2 apresenta o título dessa parte da página, abaixo do título principal h1.
- ul envolve uma lista sem numeração; cada li representa um item.
- @foreach inicia a repetição. $produtos é a lista recebida; $produto é o
  elemento atual, escolhido a cada volta. É a mesma ideia do foreach do PHP.
- {{ $produto }} exibe o nome atual com o escape Blade apresentado na 4.11.
- @endforeach encerra o bloco a repetir.

O bloco com li é executado uma vez por elemento:

| Volta | Valor de $produto | Item produzido |
| --- | --- | --- |
| 1 | Camiseta | <li>Camiseta</li> |
| 2 | Calça | <li>Calça</li> |
| 3 | Tênis | <li>Tênis</li> |

As diretivas são processadas no servidor. O navegador recebe os três li já
preenchidos dentro de ul; não precisa executar o laço Blade. Laravel recompila
o template alterado em PHP no storage local, conforme apresentado anteriormente.

## Verificações

```bash
docker compose exec -T backend php -l /app/app/Http/Controllers/LojaController.php
```

A sintaxe do controller passou. Um diagnóstico PHP temporário no Docker consultou
http://127.0.0.1:8002/loja e verificou a renderização real da view:

- HTTP 200, com título e saudação da loja preservados.
- Título Produtos de demonstração presente.
- Exatamente três li, com Camiseta, Calça e Tênis, nessa ordem.
- @foreach, @endforeach e expressões {{ }} ausentes no HTML recebido.
- GET / continuou HTTP 200, com welcome preservada.
- Código atualizado pelo bind mount, sem rebuild ou reinício.
- Rota, src, Compose, imagem, dependências e ambiente preservados. Sem banco,
  migrations, testes Laravel, frontend ou execução do contador.

O diagnóstico conferiu os itens extraídos do HTML sem imprimir cookies ou a
resposta completa. Não adicionamos testes persistentes para este exercício de
renderização; as verificações temporárias foram executadas no Docker.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 37b7485 publicado;
HEAD, origin/main e consulta direta à main remota coincidiram.

Após confirmação, publicar 4.12 e iniciar 4.13: tratar uma lista vazia na view
com @if/@else, mostrando uma mensagem quando não houver produtos demonstrativos.
Conferir renderização com lista preenchida e vazia usando dados temporários,
preservando o controller e seus exemplos. Model e banco continuam conforme o roteiro.

Fonte: [Laços no Blade](https://laravel.com/docs/13.x/blade#loops).
