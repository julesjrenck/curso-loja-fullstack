# Aula 8.39 — Verificação das funções e da busca no navegador

Iniciada em 07/11/2026 após confirmação da [8.38](08-38-arrow-retorno-implicito.md)
com "entendi". Checkpoint anterior publicado e conferido em
96d851d5e8fe3b42aeb574103643734b30f11d6d; HEAD/origin/main/main remota iguais.
Esta etapa altera somente documentação; HTML, CSS e JS permanecem como na 8.38.

## Objetivo e conceito

Verificar a busca após reorganizar suas funções. O fluxo usa tratarBusca como
callback nomeada do submit, uma arrow no forEach e prepararTexto com retorno
implícito. Queremos conferir que a organização do código preservou o comportamento
estudado. Relato de execução e confirmação de entendimento serão registrados
separadamente; entrega HTTP não demonstra o código executando no navegador.

## Preparação

1. Abra a [vitrine](http://127.0.0.1:8001/vitrine.html), sem query ou fragmento
   no endereço inicial.
2. Abra o Console do Chrome com Ctrl+Shift+J e recarregue com Ctrl+Shift+R.
   Atalhos de Windows/Linux, conforme a
   [referência do Chrome DevTools](https://developer.chrome.com/docs/devtools/shortcuts).
3. Confira o estado inicial: Camiseta e Caneca visíveis e mensagem oculta.
   Deixe o Console aberto para acompanhar registros ou erros.

Depois desse preparo, mantenha a mesma página sem reload entre as buscas.
Substitua todo o conteúdo do campo a cada linha. Para usar Enter, mantenha o
foco no campo, não no Console.

## Sequência de verificação

| Passo | Campo | Ação | Total no Console | Cartões visíveis | Mensagem |
| --- | --- | --- | --- | --- | --- |
| 1 | Dois espaços, CAMISETA, dois espaços | Buscar | 1 | Camiseta | Oculta |
| 2 | CAN | Enter no campo | 1 | Caneca | Oculta |
| 3 | ca | Buscar | 2 | Camiseta e Caneca | Oculta |
| 4 | sapato | Enter no campo | 0 | Nenhum | Visível |
| 5 | Campo vazio | Buscar | 2 | Camiseta e Caneca | Oculta |
| 6 | Somente espaços | Enter no campo | 2 | Camiseta e Caneca | Oculta |

A mensagem visível deve ser Nenhum produto encontrado. O log final de cada
envio deve mostrar Produtos encontrados: com os totais 1, 1, 2, 0, 2 e 2,
nessa ordem, sem acumular. O endereço deve permanecer igual, sem navegação ou
?nome=. Cada envio deve registrar um total final uma vez.

No passo 1, o log Busca enviada deve mostrar camiseta, e os nomes registrados
devem ser camiseta/caneca em minúsculas. Isso permite observar o uso de
prepararTexto nos dois pontos: texto do campo e título do produto. O conteúdo
visível do campo conserva o que foi digitado.

Antes de enviar o passo 5, apenas limpar o campo deve manter o estado do passo
4, com nenhum cartão e mensagem visível. Após Buscar, os dois cartões devem
reaparecer e a mensagem sumir, sem recarregar. Esse caso confere nova contagem
e atualização do aviso com o retorno preparado para a string vazia.

## Relação com as funções

Em [src/vitrine.js](../../src/vitrine.js), o registro passa tratarBusca sem
parênteses. O navegador fornece evento quando o submit acontece. TratarBusca
chama prepararTexto com parênteses para obter imediatamente o termo preparado.
A arrow do forEach recebe cada produto e chama o mesmo preparo para seu nome.

O retorno implícito de prepararTexto deve fornecer strings para includes.
A contagem começa em zero a cada envio e a mensagem é atualizada depois do
forEach, usando o total final. O roteiro verifica os resultados observáveis
desse conjunto, sem chamar funções internas pelo Console.

[src/vitrine.html](../../src/vitrine.html) fornece campo, cartões e mensagem;
[src/vitrine.css](../../src/vitrine.css) mantém o layout. Um único cartão pode
ocupar apenas uma das colunas em tela larga. A busca continua local, sem API
ou banco. Nenhum arquivo da aplicação muda nesta aula.

## Relato e continuidade

Informe se os passos coincidiram com a tabela e se os registros/termos preparados
apareceram como esperado. Se houver diferença, diga o passo, o resultado visível,
o total e eventual mensagem de erro do Console. Se tudo coincidir, um relato
geral como "funcionou" basta e será registrado como sucesso geral do aluno,
sem inventar resultados individuais ou execução direta pelo assistente.

Confirme também o entendimento do fluxo. "Entendi" sozinho confirma aprendizagem,
não informa execução. Se ainda não executou, a verificação ficará pendente.
Investigar divergências antes de continuar.

Roteiro e explicação apresentados; entendimento confirmado com "funcionou e
entendi" em 07/11/2026. A mesma resposta informa sucesso geral no navegador,
sem resultados individuais transcritos ou observação direta do assistente.
Nenhuma divergência ou dúvida nova relatada. Checkpoint publicado e conferido em
476a283dc156665363a6d29fa6f2d838f04f6402; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.40](08-40-modulos-export-import.md): módulos com export/import de prepararTexto.
