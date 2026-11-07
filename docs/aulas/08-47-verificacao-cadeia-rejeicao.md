# Aula 8.47 — Verificação da cadeia de rejeição no navegador

Iniciada em 07/11/2026 após confirmação da 8.46 com "entendi". Atividades
opcionais de promises ainda sem relato de execução. Checkpoint anterior
publicado em dcaa4b4920281f70c4943a7b5a032bfd455653b7;
HEAD/origin/main/main remota iguais.

## Objetivo e preparação

Conferir a execução da cadeia com rejeição simulada, catch e finally, além
da continuidade da busca. Somente documentação; nenhum arquivo da aplicação
é alterado nesta aula.

1. Abra http://localhost:8001/vitrine.html no Chrome.
2. Abra o Console com Ctrl+Shift+J. Deixe o campo Filter vazio e os níveis Info
   e Error habilitados, para ver console.log e console.error.
3. Nas configurações do Console, desative Preserve log para não misturar
   mensagens de carregamentos anteriores. Recarregue a página uma vez.
4. Aguarde as mensagens e confira os dois cartões e a ausência da mensagem
   "Nenhum produto encontrado." no estado inicial.

Referência primária: [Console do Chrome DevTools](https://developer.chrome.com/docs/devtools/console/reference),
incluindo abertura, níveis de mensagem e preservação de registros.

## Ordem das mensagens

Depois dos registros iniciais conhecidos (carregamento do JavaScript, formulário,
valor do campo, produtos e elemento de mensagem), esperamos estas quatro linhas:

```text
Antes de registrar o then.
Depois de registrar o then.
Não foi possível preparar a mensagem: Falha simulada ao preparar a mensagem.
Preparação da mensagem encerrada.
```

Os dois logs diretos executam primeiro. Promise.reject cria a rejeição simulada;
os callbacks de sucesso dos dois then são pulados. catch recebe o motivo e o
registra. Depois, finally registra o encerramento da cadeia.

A terceira linha pode aparecer em vermelho e com referência ao arquivo/linha:
ela vem do console.error que escrevemos no catch. Não esperamos "Uncaught
(in promise)" nem "VITRINE PRONTA PARA A BUSCA." neste caminho. Se aparecer
outro erro, informe seu texto; não o trate automaticamente como parte da simulação.

O catch termina normalmente e devolve uma Promise fulfilled com undefined;
finally está ligado a ela. A Promise inicial permanece rejected. Ver a mensagem
de encerramento não significa que a preparação inicial teve sucesso.

## Busca depois do tratamento

Sem recarregar entre os passos, faça a sequência:

| Entrada | Envio | Resultado esperado | Total no Console | Mensagem sem resultados |
| --- | --- | --- | --- | --- |
| `  CANECA  ` | Clique em Buscar | Somente Caneca | 1 | Oculta |
| `sapato` | Enter no campo | Nenhum cartão | 0 | Visível |
| Campo vazio | Clique em Buscar | Camiseta e Caneca | 2 | Oculta |

A primeira entrada tem espaços nas extremidades e letras maiúsculas. A função
importada prepararTexto normaliza o termo e os nomes. Confira os registros de
busca/totais, a mensagem e a restauração dos cartões.

A URL deve permanecer a mesma durante os envios, sem recarregar a página.
As quatro mensagens da cadeia não devem se repetir a cada busca: esse exemplo
executa no carregamento do módulo, fora de tratarBusca.

## Relação entre arquivos e evidências

[vitrine.html](../../src/vitrine.html) carrega [vitrine.js](../../src/vitrine.js)
como módulo e contém formulário, cartões e mensagem. JS importa prepararTexto
de [textos.js](../../src/textos.js), registra o listener e executa o exemplo
de Promise. [vitrine.css](../../src/vitrine.css) apresenta os elementos.
O formulário e a cadeia são fluxos separados neste arquivo; a rejeição
didática não representa uma falha de API. Não há busca de produtos pela rede.

As verificações de arquivos/HTTP do assistente demonstram entrega e configuração.
A sequência acima depende de execução no navegador e do relato do aluno.
Nenhum resultado individual foi presumido do código ou das confirmações anteriores.

Verificações realizadas: HTML e JS retornaram HTTP 200, com tipos adequados e
corpos iguais aos arquivos locais (cmp); 1339 e 1772 bytes. git diff --check
passou e diff de src confirmou aplicação sem alterações. Links locais conferidos.
Sem ferramenta de navegador disponível para observação direta nesta sessão.

## Relato e continuidade

Informe se a ordem coincidiu, se houve apenas o erro intencional e se as buscas
seguiram a tabela. Um relato geral "funcionou" basta se tudo coincidiu; será
registrado como relato geral, sem inventar resultados individuais ou observação
direta pelo assistente. Se ainda não executou, informe isso. Em caso de diferença,
diga o passo, o resultado observado e o texto de eventual erro.

Confirme também o entendimento da sequência Promise.reject → then pulados →
catch → finally. "Entendi" sozinho confirma aprendizagem; não confirma execução.

Roteiro e explicação apresentados. Sucesso geral relatado com "funcionou" em
07/11/2026; sem resultados individuais transcritos ou observação direta do
assistente. Nenhuma divergência relatada. Entendimento confirmado com "entendi"
em 07/11/2026, recebido após o relato de execução. Checkpoint publicado e conferido
em 633e7de3be32ec525be05b2a9d7137b4d1cddeb1; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.48 — restauração do caminho de sucesso](08-48-restauracao-sucesso-promise.md).
