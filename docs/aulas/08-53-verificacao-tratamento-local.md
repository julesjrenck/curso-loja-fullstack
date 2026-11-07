# Aula 8.53 — Verificação do tratamento local no navegador

Iniciada em 07/11/2026 após confirmação da 8.52 com "entendi". Atividades
opcionais de async/await ainda sem relato de execução. Checkpoint anterior
publicado em b1f2692c35d548aa1cf8d5d9220aa6e7b595b2f9;
HEAD/origin/main/main remota iguais.

## Objetivo e preparação

Conferir rejeição em await, tratamento local e mensagem alternativa consumida
pela cadeia externa. Conferir também a busca após esse fluxo. Somente
documentação: nenhum arquivo da aplicação é alterado nesta etapa.

1. Abra http://localhost:8001/vitrine.html no Chrome.
2. Abra o Console com Ctrl+Shift+J. Deixe o campo Filter vazio e os níveis Info
   e Error visíveis, para acompanhar console.log e console.error.
3. Nas configurações do Console, desative Preserve log. Recarregue uma vez,
   para não misturar a saída atual com mensagens de etapas anteriores.
4. Confira o estado inicial: cartões Camiseta e Caneca visíveis e mensagem
   "Nenhum produto encontrado." oculta.

Referência primária: [Console do Chrome DevTools](https://developer.chrome.com/docs/devtools/console/reference),
incluindo abertura, níveis de mensagem e preservação de registros.

## Ordem e conteúdo no Console

Depois dos registros iniciais conhecidos, esperamos cinco mensagens:

```text
Antes de registrar o then.
Depois de registrar o then.
Falha tratada dentro da função: Falha simulada ao preparar a mensagem.
MENSAGEM ALTERNATIVA DA VITRINE.
Preparação da mensagem encerrada.
```

Os dois logs diretos executam primeiro. A função prepararMensagem foi chamada
antes deles, mas sua continuação está suspensa em await. Ao retomar com a
rejeição, o catch dentro da função registra o motivo e retorna a alternativa.
A Promise devolvida pela função fica fulfilled com essa string. Os dois then
externos a transformam em maiúsculas e a exibem. finally registra o encerramento.

A terceira linha vem do console.error local e pode aparecer em vermelho,
com referência à linha do arquivo. Ela é intencional. Não esperamos:

- O prefixo externo "Não foi possível preparar a mensagem:", pois o callback
  de .catch externo é pulado neste caminho recuperado.
- "Uncaught (in promise)", que indicaria uma rejeição sem tratamento.
- "VITRINE PRONTA PARA A BUSCA.", pois usamos a alternativa do catch local.

Se houver outro erro, informe seu texto; não o considere automaticamente
parte da simulação. O return do try não é alcançado neste caminho; quem
fornece o texto consumido pelos then é o return do catch local.

## Busca depois da recuperação

Sem recarregar entre os passos, faça:

| Entrada | Envio | Cartões esperados | Total no Console | Mensagem sem resultados |
| --- | --- | --- | --- | --- |
| `  CAMISETA  ` | Clique em Buscar | Somente Camiseta | 1 | Oculta |
| `sapato` | Enter no campo | Nenhum | 0 | Visível |
| Campo vazio | Clique em Buscar | Camiseta e Caneca | 2 | Oculta |

Na primeira entrada, há espaços nas extremidades e letras maiúsculas.
prepararTexto normaliza termo e nomes. Confira também os registros de busca,
os totais e a restauração da mensagem/cartões.

A URL deve permanecer igual e a página não deve recarregar nos envios.
As cinco mensagens do exemplo de Promise não devem se repetir a cada busca:
ele está fora de tratarBusca e executa no carregamento do módulo.

## Arquivos e evidências

[vitrine.html](../../src/vitrine.html) contém formulário, cartões e mensagem,
e carrega [vitrine.js](../../src/vitrine.js) como módulo. JS importa prepararTexto
de [textos.js](../../src/textos.js), registra o listener e chama prepararMensagem.
[vitrine.css](../../src/vitrine.css) mantém a apresentação. A função async e
a cadeia de Console são um exemplo separado do filtro de produtos. A falha
é local e simulada; não há API ou consulta de produtos pela rede.

As verificações de arquivos/HTTP demonstram entrega e configuração. A execução
da sequência precisa ser observada no navegador e relatada pelo aluno.
Não presumimos execução de await, recuperação ou buscas a partir de confirmações
anteriores ou da inspeção do código.

Verificações realizadas: HTML e JS retornaram HTTP 200, com tipos adequados e
corpos iguais aos arquivos locais (cmp); 1339 e 2047 bytes. git diff --check
passou; diff de src confirmou aplicação preservada. Links locais conferidos.
Sem ferramenta de navegador disponível para observação direta nesta sessão.

## Relato e continuidade

Informe se as cinco mensagens apareceram na ordem, se houve somente o erro
intencional e se as buscas seguiram a tabela. Um relato geral "funcionou" basta
se tudo coincidiu; será registrado como relato geral, sem inventar resultados
individuais ou observação direta do assistente. Se ainda não executou, informe
isso. Se algo divergiu, diga o passo, a saída e o texto de eventual erro.

Confirme também o entendimento: await rejeitado → catch local → return da
alternativa → then externos → finally. "Funcionou" confirma execução;
"entendi" confirma aprendizagem. Precisamos de ambos para concluir esta etapa.

Roteiro e explicação apresentados; entendimento confirmado com "entendi" em
07/11/2026. Sucesso geral relatado depois com "deu tudo certo" na mesma data.
Sem resultados individuais transcritos ou observação direta do assistente.
Nenhuma divergência relatada. Checkpoint publicado e conferido em
47f5f6aa4079320a5c977ee3161ca79bf71639cd; HEAD/origin/main/main remota iguais.
Registro posterior à publicação. Continuidade na
[8.54 — restauração do sucesso com async/await](08-54-sucesso-async-await.md).
