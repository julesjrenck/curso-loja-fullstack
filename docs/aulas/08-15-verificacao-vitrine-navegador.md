# Aula 8.15 — Verificação acompanhada da vitrine no navegador

Iniciada em 06/11/2026 após confirmação da [8.14](08-14-cabecalho-responsivo.md)
com "entendi". Checkpoint anterior publicado e conferido em
0ea7b1802b0bb4e05cce149895fc1737ade98122; HEAD/origin/main/main remota iguais.
Esta etapa altera somente documentação; HTML e CSS permanecem como na 8.14.

## Objetivo e conceito

Relacionar as regras estudadas ao resultado no navegador: Flexbox no cabeçalho,
Grid nos produtos, media query inclusiva até 600px e navegação por fragmento.
Entrega HTTP dos arquivos e observação da interface são evidências diferentes.
O assistente prepara o roteiro e verifica os recursos; o aluno relata a execução
em seu navegador. Nenhum resultado visual será presumido antes desse relato.

## Preparação no Chrome

1. Abra [http://127.0.0.1:8001/vitrine.html](http://127.0.0.1:8001/vitrine.html),
   inicialmente sem #catalogo no endereço.
2. Recarregue com Ctrl+Shift+R para obter a versão atual.
3. Abra DevTools com F12 ou Ctrl+Shift+I. Com DevTools aberto, use Ctrl+Shift+M
   para alternar a barra de dispositivos, ou clique no ícone de dispositivos.
4. Em Dimensions/Dimensões, escolha Responsive/Responsivo. Digite a largura
   no campo próprio e mantenha a altura em 700px durante as comparações.

Atalhos descritos para Windows/Linux. O modo responsivo permite definir a
largura do viewport em pixels CSS; mudar apenas o tamanho externo da janela
é menos preciso para conferir o limite de 600px. Essa emulação de viewport
é uma verificação no navegador de desktop, sem representar teste em aparelho real.

Fontes primárias: [modo de dispositivos do Chrome DevTools](https://developer.chrome.com/docs/devtools/device-mode)
e [atalhos de teclado do DevTools](https://developer.chrome.com/docs/devtools/shortcuts).

## Três larguras e retorno

Altere somente o campo de largura, nesta ordem:

| Largura | Cabeçalho esperado | Catálogo esperado |
| --- | --- | --- |
| 800px | Nome da loja e navegação na mesma linha | Dois cartões lado a lado |
| 600px | Nome acima da navegação, ambos à esquerda | Uma coluna |
| 360px | Nome acima da navegação, ambos à esquerda | Uma coluna |

Depois, volte a 800px e confira o retorno ao layout em linha e duas colunas.
Em todos os tamanhos, os textos e preços devem permanecer legíveis e os cartões
devem conservar padding, borda e fundo branco.

800px usa as regras base. Em 600px e 360px, a condição max-width: 600px combina;
ela muda a direção/alinhamento do cabeçalho e a quantidade de colunas do catálogo.
Esses são resultados esperados a partir do
[CSS](../../src/vitrine.css), não observações já recebidas do aluno.

## Link por mouse e teclado

1. Encerre a emulação e feche DevTools. Abra novamente a URL inicial sem
   #catalogo e clique no link Catálogo. O endereço deve terminar em #catalogo.
2. Abra outra vez a URL inicial, digitando o endereço sem fragmento. Use Tab
   até o link Catálogo ficar destacado e pressione Enter. O endereço deve
   voltar a terminar em #catalogo. Se o foco estiver na barra do navegador,
   clique antes em uma área vazia do cabeçalho e continue com Tab.

Recomeçar sem o fragmento permite observar a ativação em cada caso. A rolagem
pode ser pequena ou inexistente se a página for curta ou o destino já estiver
visível. O vínculo é href #catalogo → id catalogo em
[vitrine.html](../../src/vitrine.html). O layout mantém a ordem dos elementos
no documento.

## Relato e interpretação

Informe o que observou nas três larguras, no retorno a 800px e nas ativações
por clique e teclado. Pode responder de forma curta, por exemplo:

```text
800px:
600px:
360px:
Retorno a 800px:
Clique:
Teclado:
```

Se tudo coincidir, basta confirmar que todas essas ações funcionaram como
esperado. Se algo divergir, informe em qual ação e descreva o que apareceu;
investigaremos essa diferença antes de continuar.

Um relato geral de sucesso será registrado como tal, sem inventar medidas ou
observação direta pelo assistente. Entendimento do roteiro confirmado com
"entendi" em 06/11/2026; a confirmação não informa o resultado da execução.
Relato recebido depois: "funcionou", em 06/11/2026. Sucesso geral informado,
sem medidas/resultados individuais ou observação direta pelo assistente.
Nenhuma divergência relatada. Resultado e entendimento continuam separados
no [progresso](../progresso.md).

## Continuidade

Roteiro e explicação entendidos; verificação com relato geral de sucesso.
Checkpoint publicado e conferido em
44b3a867dbce18b51d5609f158b61c588764c44e; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.16](08-16-formulario-busca.md): primeiro formulário de busca da vitrine.
