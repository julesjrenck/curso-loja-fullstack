# Aula 8.34 — Verificação da contagem e da mensagem no navegador

Iniciada em 07/11/2026 após confirmação da [8.33](08-33-exibicao-mensagem.md)
com "entendi". Checkpoint anterior publicado e conferido em
90adc7e3ec3e1d0dbc6c49c4bb33db5b49beab92; HEAD/origin/main/main remota iguais.
Esta etapa altera somente documentação; HTML, CSS e JS permanecem como na 8.33.

## Objetivo e conceito

Relacionar três resultados da mesma busca: total calculado, cartões visíveis
e mensagem. Verificar também as transições entre buscas para conferir o reinício
do contador e a atualização de hidden. Entrega HTTP e leitura do código são
evidências diferentes da execução no navegador. O aluno relata essa execução;
o assistente não presume resultados a partir do entendimento confirmado.

## Preparação

1. Abra a [vitrine](http://127.0.0.1:8001/vitrine.html), sem query ou fragmento
   no endereço inicial.
2. Abra o Console do Chrome com Ctrl+Shift+J e recarregue com Ctrl+Shift+R.
   Atalhos para Windows/Linux, conforme a
   [referência do Chrome DevTools](https://developer.chrome.com/docs/devtools/shortcuts).
3. Observe o estado inicial: Camiseta e Caneca visíveis, mensagem oculta.
   O log Produtos encontrados só ocorre depois de enviar uma busca.

Mantenha a mesma página entre os passos, sem recarregar. A cada linha, substitua
todo o conteúdo do campo. Para Enter, clique primeiro no campo, mantendo seu
foco nele em vez do Console.

## Sequência e resultados esperados

| Passo | Campo | Ação | Total no Console | Cartões visíveis | Mensagem |
| --- | --- | --- | --- | --- | --- |
| 1 | sapato | Buscar | 0 | Nenhum | Visível |
| 2 | CAN | Enter no campo | 1 | Caneca | Oculta |
| 3 | ca | Buscar | 2 | Camiseta e Caneca | Oculta |
| 4 | Dois espaços, SAPATO, dois espaços | Enter no campo | 0 | Nenhum | Visível |
| 5 | Campo vazio | Buscar | 2 | Camiseta e Caneca | Oculta |
| 6 | Somente espaços | Enter no campo | 2 | Camiseta e Caneca | Oculta |

A mensagem visível deve ser Nenhum produto encontrado. Cada envio deve
registrar uma linha final Produtos encontrados: seguida do total. O código
também mantém o log do termo preparado e os dois pares nome/booleano.
Os totais finais esperados na ordem são 0, 1, 2, 0, 2 e 2, sem acumular entre
buscas. No passo 4, o termo preparado deve ser sapato.

Antes de enviar CAN no passo 2, apenas digitar esse texto mantém o estado do
passo 1: nenhum cartão e mensagem visível. Após Enter, deve aparecer Caneca
e a mensagem deve sumir. Isso confere que o filtro e o aviso mudam no submit.

O passo 4 volta a exibir o aviso depois de um resultado com produtos; o passo
5 restaura os dois cartões e oculta o aviso sem reload. O passo 6 confirma
que somente espaços são tratados como busca vazia. O endereço deve permanecer
igual, sem navegar ou acrescentar ?nome=.

## Como o código explica o resultado

Em [src/vitrine.js](../../src/vitrine.js), a função do submit começa com
quantidadeResultados igual a zero. O forEach prepara cada nome, compara com
includes, atualiza hidden do cartão e soma um apenas se corresponde for true.
Depois do loop, quantidadeResultados > 0 define hidden da mensagem; por último,
o Console recebe o total final.

[src/vitrine.html](../../src/vitrine.html) define os dois cartões e o parágrafo
da mensagem inicialmente oculto. [src/vitrine.css](../../src/vitrine.css)
mantém o layout. Um único cartão não precisa ocupar toda a largura: o Grid
continua com suas colunas. Nenhum desses arquivos muda nesta aula;
a busca continua local, sem API ou banco.

## Relato e continuidade

Informe se contagens, cartões, mensagem e transições coincidiram com a tabela,
incluindo clique e Enter. Se houver diferença, diga o passo, o total mostrado,
o que apareceu na página e eventual erro no Console. Se tudo coincidir, um
relato geral como "funcionou" basta; será registrado como sucesso geral do aluno,
sem inventar resultados individuais ou observação direta do assistente.

Confirme também se o fluxo ficou entendido. "Entendi" sozinho registra
aprendizagem, não execução. Caso ainda não tenha executado, a verificação
permanece pendente. Divergências serão investigadas antes de continuar.

Roteiro e explicação apresentados; entendimento confirmado com "funcionou
entendi" em 07/11/2026 (resposta original: "funcionou  entendi"). A mesma resposta
informa sucesso geral no navegador, sem resultados individuais transcritos ou
observação direta do assistente. Nenhuma divergência ou dúvida nova relatada.
Checkpoint em preparação conforme autorização permanente.
Próximo passo após publicação: 8.35 — função nomeada para tratar
o envio da busca. Não iniciada.
