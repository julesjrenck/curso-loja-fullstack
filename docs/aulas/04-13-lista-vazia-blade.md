# Aula 4.13 — Condição para lista vazia

## Objetivo

Definir o que a página deve mostrar quando produtos estiver vazio. Alteramos
somente loja.blade.php: os três exemplos do controller foram preservados.
A condição escolhe entre gerar a lista ou apresentar uma mensagem.

## Alteração na view

O trecho abaixo continua depois do título Produtos de demonstração:

```blade
@if (count($produtos) > 0)
    <ul>
        @foreach ($produtos as $produto)
            <li>{{ $produto }}</li>
        @endforeach
    </ul>
@else
    <p>Nenhum produto de demonstração disponível.</p>
@endif
```

- count($produtos) devolve a quantidade de elementos do array: 3 nos exemplos
  atuais do controller e 0 em um array vazio.
- > 0 compara essa quantidade com zero. A expressão produz verdadeiro ou falso.
- @if inicia a condição Blade. Quando ela é verdadeira, gera ul e executa o
  @foreach já estudado para produzir os itens.
- @else define o trecho usado quando a condição é falsa. Nesse caso, p apresenta
  um parágrafo com a mensagem e a view não gera ul ou li.
- @endif encerra a condição; @endforeach continua encerrando apenas o laço interno.

É a mesma ideia de if/else do PHP. Os blocos estão aninhados: a repetição pertence
ao ramo verdadeiro da condição. A indentação ajuda a enxergar essa relação.
Os dois ramos são alternativas para cada renderização.

## Entrada e saída

O dado produtos continua vindo do array entregue pelo controller. A condição
usa esse dado para escolher a apresentação:

| Entrada | Resultado |
| --- | --- |
| ['Camiseta', 'Calça', 'Tênis'] | Lista com três itens; mensagem de ausência não aparece. |
| [] | Parágrafo de ausência; lista e itens não aparecem. |

Título da página, saudação, nome da loja e rota foram preservados. Blade processa
a condição no servidor; o navegador recebe apenas o HTML do ramo escolhido.

## Verificação dos dois casos

Executamos PHP temporário no container backend com:

```bash
docker compose exec -T backend php
```

exec utiliza o container ativo; -T desabilita o terminal. O código foi enviado
pela entrada padrão, incluiu o autoload e inicializou o kernel de console Laravel.
Depois renderizou a mesma view duas vezes, com dados temporários. O caso vazio
usou este trecho no contexto inicializado:

```php
$html = view('loja', [
    'nomeLoja' => 'Loja Fullstack',
    'produtos' => [],
])->render();
```

render devolve o HTML gerado para a conferência. Esses dados pertencem à chamada
temporária; não substituem os exemplos gravados no controller ou o ambiente local.

Resultados:

- Com três nomes, itens e ordem preservados; mensagem de ausência ausente.
- Com array vazio, parágrafo de ausência presente; nenhum ul ou li.
- Título e saudação preservados em ambas as renderizações.
- GET /loja real continuou HTTP 200 com os três exemplos e sem a mensagem de vazio.
- Controller, rota, src, Compose, imagem, JSON, lockfile e ambiente preservados.
- Sem rebuild, reinício, dependências, banco, migrations, testes Laravel ou contador.

A sintaxe Blade foi verificada pela renderização real dos dois ramos. O caso
vazio foi uma renderização de teste, enquanto a página HTTP mantém a lista padrão.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint b944f4e publicado;
HEAD, origin/main e consulta direta à main remota coincidiram.

Após confirmação, publicar 4.13 e iniciar 4.14: apresentar middleware, criar
MarcarRespostaCurso para acrescentar o cabeçalho X-Curso: Laravel à resposta e
aplicá-lo somente à rota /loja. Explicar request, próximo atendimento e response;
verificar o cabeçalho preservando o conteúdo da página. Model e banco continuam
conforme o roteiro, sem antecipar persistência.

Fonte: [Condições no Blade](https://laravel.com/docs/13.x/blade#if-statements).
