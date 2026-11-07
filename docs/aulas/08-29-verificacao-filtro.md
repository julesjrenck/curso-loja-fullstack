# Aula 8.29 — Verificação do filtro no navegador

Iniciada em 07/11/2026 após confirmação da [8.28](08-28-visibilidade-hidden.md)
com "entendi". Checkpoint anterior publicado e conferido em
b2ed9ffd62106247e5ea7abe1b8898caa9807b7d; HEAD/origin/main/main remota iguais.
Esta etapa altera somente documentação; HTML, CSS e JS permanecem como na 8.28.

## Objetivo e conceito

Verificar no navegador o fluxo estudado: submit, leitura do campo, preparo dos
textos, includes, forEach e atribuição de hidden. Entrega HTTP comprova que os
arquivos chegam; observar o filtro comprova seu comportamento nesse navegador.
O assistente prepara o roteiro e confere os recursos. O aluno relata a execução;
nenhum resultado será presumido a partir da confirmação de entendimento.

## Preparação

1. Abra a [vitrine](http://127.0.0.1:8001/vitrine.html), sem query ou fragmento
   no endereço inicial.
2. Abra o Console do Chrome com Ctrl+Shift+J e recarregue com Ctrl+Shift+R para
   obter os arquivos atuais. Os atalhos são de Windows/Linux.
3. Confira o estado inicial: Camiseta e Caneca visíveis. Deixe o Console aberto
   para acompanhar os registros ou eventuais erros.

Referência: [atalhos do Chrome DevTools](https://developer.chrome.com/docs/devtools/shortcuts).
Depois desse preparo, não recarregue entre as buscas: queremos verificar as
transições de estado da mesma página. Clique no campo antes de usar Enter,
para que o foco não fique no Console.

## Sequência de buscas

Substitua todo o conteúdo do campo a cada linha e execute na ordem:

| Passo | Conteúdo do campo | Ação | Resultado esperado |
| --- | --- | --- | --- |
| 1 | Dois espaços, CAMISETA, dois espaços | Clicar Buscar | Somente Camiseta |
| 2 | CAN | Enter no campo | Somente Caneca |
| 3 | ca | Clicar Buscar | Camiseta e Caneca |
| 4 | sapato | Enter no campo | Nenhum cartão |
| 5 | Campo vazio | Clicar Buscar | Os dois cartões reaparecem |
| 6 | Somente espaços | Enter no campo | Os dois continuam visíveis |

Observe também o endereço: ele deve permanecer igual, sem incluir ?nome= e
sem navegar para outra página. O campo deve conservar o texto digitado; o
preparo com trim/minúsculas ocorre nas strings usadas pelo código.

No Console, cada envio deve produzir Busca enviada com o termo preparado e
dois registros nome/booleano, mesmo quando um cartão estiver oculto.
No passo 1, esperamos camiseta true e caneca false; no passo 2, camiseta false
e caneca true. Os dois true no passo 3 correspondem a dois cartões visíveis;
os dois false no passo 4 correspondem a nenhum cartão. Nos passos 5/6, termo
vazio gera os dois true e restaura/preserva ambos.

Antes de enviar o passo 2, apenas digitar CAN deve manter o resultado do passo
1. O filtro só atualiza no submit. Depois do Enter, Camiseta deve sumir e Caneca
reaparecer. Isso verifica que todos os elementos são reavaliados, incluindo os
que estavam ocultos. O retorno do passo 4 para o 5 verifica restauração sem reload.

Um único cartão pode ocupar apenas a primeira coluna em telas largas; o Grid
continua com duas colunas. Nenhum resultado deixa a área vazia, sem mensagem
por enquanto. Esses comportamentos são os previstos para o código atual.

## Relação com os arquivos

[src/vitrine.html](../../src/vitrine.html) define formulário e cartões e carrega
o módulo. [src/vitrine.js](../../src/vitrine.js) registra o submit, cancela o GET,
prepara termo e nomes, calcula correspondência e atualiza hidden para cada cartão.
[src/vitrine.css](../../src/vitrine.css) define o layout. Nesta aula, nenhum desses
arquivos é alterado. A busca permanece local, sem API ou banco.

## Relato e continuidade

Informe se a sequência funcionou, incluindo clique, Enter, troca de produto e
restauração após nenhum resultado. Se houver diferença, indique o passo, o que
apareceu e eventual mensagem de erro no Console. Se tudo coincidir, um relato
geral como "funcionou" basta; será registrado como relato geral do aluno, sem
inventar observações individuais ou execução direta pelo assistente.

Informe também se o fluxo ficou entendido. "Entendi" confirma aprendizagem;
não informa, sozinho, que os testes foram executados. Se ainda não executou,
isso será registrado e a verificação continuará pendente.

Roteiro e explicação apresentados; entendimento confirmado com "funcinou e
entendi" em 07/11/2026. A mesma resposta informa sucesso geral no navegador,
interpretando "funcinou" como "funcionou"; sem resultados individuais transcritos
ou observação direta do assistente. Nenhuma divergência ou dúvida nova relatada.
Checkpoint publicado e conferido em
2480b5b0c36fa2e7de98f425a086beda9575292d; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.30](08-30-mensagem-sem-resultados-html.md): estrutura HTML da mensagem de busca sem resultados.
