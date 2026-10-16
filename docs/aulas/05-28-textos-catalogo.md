# Aula 5.28 — Textos da página do catálogo

## Objetivo

Ajustar a apresentação da lista que agora recebe nomes do banco.
A 5.27 foi confirmada com "entrendi" em 16/10/2026 e publicada em 0eb7973,
SHA completo 0eb79735c54353519f2d3be5d7237cdde415d64e, conferido na main remota.

## Alteração em backend/resources/views/loja.blade.php

O título da lista passou a ser:

```html
<h2>Catálogo de produtos</h2>
```

No @else, a mensagem passou a ser:

```html
<p>Nenhum produto disponível.</p>
```

São textos fixos de apresentação definidos na view. Os nomes dos produtos
continuam dinâmicos: CatalogoEloquent consulta o banco, o controller passa
o array como produtos e o @foreach imprime cada nome com {{ $produto }}.

O @if (count($produtos) > 0) continua escolhendo entre lista e mensagem.
Quando o array estiver vazio, o @else mostra o novo texto. O escape do Blade
continua no mesmo lugar; o nome da loja no title e h1 também permanece.
Mudamos somente dois textos, com a mesma estrutura de renderização.

## Verificação

Uma requisição HTTP real em PHP Docker acessou o servidor ativo em
http://127.0.0.1:8000/loja com file_get_contents. O diagnóstico conferiu status
200, h2 Catálogo de produtos, exatamente um li com Camiseta, title Loja
Fullstack e header X-Curso: Laravel. Código de saída 0.

A mensagem de ausência foi revisada no arquivo e no diff. Não exercitamos
o @else nesta verificação, pois o banco contém a Camiseta. Não apagamos
registros para exibir uma mensagem. Não foi criada uma suíte de testes para
essa alteração de textos.

No host, a página está em [http://127.0.0.1:8002/loja](http://127.0.0.1:8002/loja).
O resultado do aluno no navegador ainda não foi informado.

git diff --check passou. Única mudança de código na view; controller,
serviço, binding, model, rotas, seeders, migrations, configuração/credenciais,
dependências e serviços preservados. Sem gravação SQL ou execução de seeder.

## Continuidade

Alteração e explicação apresentadas; HTTP conferido. Entendimento da 5.28
confirmado com "entendi" em 16/10/2026. Checkpoint preparado para publicação
autorizada e publicado em 1cd8038; HEAD, origin/main e main remota conferidos
no SHA 1cd8038f21b6f40bfea94d1c5cb1f6f41c4a537d.

Próximo passo realizado na 5.29: acrescentar o filtro status = ativo em CatalogoEloquent antes de pluck,
explicando where, parâmetros e SQL gerado; verificar a leitura e HTTP com
a Camiseta existente, sem cadastrar dados descartáveis na loja.
