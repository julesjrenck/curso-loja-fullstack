# Aula 8.63 — Verificação de objetos e arrays no navegador

Iniciada em 07/11/2026 após confirmação da 8.62 com "entendi". Atividades
opcionais de objetos/arrays ainda sem relato de execução. Checkpoint anterior
publicado em a3d8a0ec465cb58abb99b9cefc3f29544f9828c4;
HEAD/origin/main/main remota iguais.

## Objetivo e preparação

Conferir os dados do objeto, o array com dois produtos, índices, length e o
percurso de forEach. Conferir também a continuidade da busca e da exibição async.
Somente documentação: nenhum arquivo da aplicação é alterado nesta etapa.

1. Abra http://localhost:8001/vitrine.html no Chrome.
2. Abra o Console com Ctrl+Shift+J. Deixe Filter vazio e Info/Error visíveis.
3. Nas configurações do Console, desative Preserve log e recarregue uma vez,
   para não misturar mensagens anteriores com a execução atual.
4. Confira o estado inicial: Camiseta e Caneca visíveis, mensagem "Nenhum
   produto encontrado." oculta.

Referência primária: [Console do Chrome DevTools](https://developer.chrome.com/docs/devtools/console/reference),
incluindo abertura, filtros, níveis e preservação de registros.

## Objeto e leituras individuais

Depois de "JavaScript da vitrine carregado.", localize "Produto de exemplo:".
Expanda o objeto, se necessário: esperamos nome com a string Camiseta e preco
com o número 4990. A aparência e a ordem visual dos campos no Console podem variar.

Os registros seguintes devem mostrar:

```text
Nome do produto: Camiseta
Preço em centavos: 4990
```

Eles vêm de produtoExemplo.nome e produtoExemplo.preco. O preço é um número
em centavos, não uma string monetária formatada. A unidade é uma convenção
dos dados; 4990 representa R$ 49,90.

## Array, índices e percurso

Localize "Produtos de exemplo:" e expanda o array, se necessário. Esperamos:

| Índice | Objeto | nome | preco em centavos |
| --- | --- | --- | --- |
| 0 | O objeto produtoExemplo já existente | Camiseta | 4990 |
| 1 | Objeto criado dentro do array | Caneca | 2990 |

Depois do registro do array, esperamos estas cinco linhas, nessa ordem:

```text
Primeiro produto: Camiseta
Segundo produto: Caneca
Quantidade de produtos: 2
Produto da lista: Camiseta 4990
Produto da lista: Caneca 2990
```

As duas primeiras leem [0].nome e [1].nome. A terceira lê length, que é 2
neste array contínuo. As últimas vêm das duas chamadas do callback de forEach,
recebendo um objeto por vez e lendo suas propriedades. Os índices são 0/1;
a quantidade é 2. O corpo do callback apenas lê e registra os dados.

## Continuidade do restante da página

Depois dos registros de formulário/DOM, confira a sequência async conhecida:

```text
Antes de chamar exibirMensagem.
Depois de chamar exibirMensagem.
VITRINE PRONTA PARA A BUSCA.
Preparação da mensagem encerrada.
```

Não esperamos mensagens de falha ou alternativa neste caminho. Se houver erro,
informe seu texto. Agora, sem recarregar entre os passos, confira a busca:

| Entrada | Envio | Cartões esperados | Total no Console | Mensagem sem resultados |
| --- | --- | --- | --- | --- |
| `  CAMISETA  ` | Clique em Buscar | Somente Camiseta | 1 | Oculta |
| `sapato` | Enter no campo | Nenhum | 0 | Visível |
| Campo vazio | Clique em Buscar | Camiseta e Caneca | 2 | Oculta |

A primeira entrada tem espaços nas extremidades e letras maiúsculas.
A URL deve permanecer igual e a página não deve recarregar nos envios.
Os registros iniciais de objetos/arrays e as quatro mensagens async não devem
se repetir a cada busca; esses exemplos executam no carregamento do módulo,
fora de tratarBusca.

## Arquivos e evidências

[vitrine.html](../../src/vitrine.html) contém formulário, cartões e mensagem,
e carrega [vitrine.js](../../src/vitrine.js) como módulo. JS importa prepararTexto
de [textos.js](../../src/textos.js), declara os dados de demonstração, os registra,
registra o listener da busca e chama exibirMensagem.
[vitrine.css](../../src/vitrine.css) mantém o layout.

produtosExemplo é um Array de objetos de dados. produtos é a NodeList dos
cartões usada por tratarBusca. O parâmetro produto de cada callback pertence
à sua própria função: um recebe objeto com nome/preco, outro recebe elemento
HTML. A busca continua usando os cartões; os dados de exemplo ainda não
criam elementos ou fazem pedidos à API.

As verificações de arquivos/HTTP demonstram entrega e configuração. Conteúdo
observado no Console, execução e buscas dependem do relato do aluno. Nenhum
resultado foi presumido a partir do código ou de confirmações anteriores.

Verificações realizadas: HTML e JS retornaram HTTP 200, com tipos adequados e
corpos iguais aos arquivos locais (cmp); 1339 e 2795 bytes. git diff --check
passou; diff de src confirmou aplicação preservada. Links locais conferidos.
Sem ferramenta de navegador disponível para observação direta nesta sessão.

## Relato e continuidade

Informe se objeto, array, registros de valores, percurso e buscas coincidiram
com o roteiro, e se houve algum erro. Um relato geral "funcionou" basta se tudo
coincidiu; será registrado como relato geral, sem inventar resultados individuais
ou observação direta do assistente. Se ainda não executou, informe isso. Em caso
de diferença, diga o passo, a saída e o texto do erro.

Confirme também o entendimento: objeto agrupa propriedades, array agrupa produtos,
índice seleciona um objeto e forEach chama uma função por elemento presente.
"Funcionou" confirma execução; "entendi" confirma aprendizagem. Precisamos de
ambos para concluir esta etapa.

Roteiro e explicação apresentados. Entendimento e sucesso geral confirmados com
"funcionou  e entendi" em 07/11/2026, preservando o espaçamento original.
Sem resultados individuais transcritos ou observação direta do assistente.
Nenhuma divergência relatada. Checkpoint concluído, publicação pendente conforme
autorização permanente. Depois da publicação, 8.64 — serialização dos produtos
com JSON.stringify. Não iniciada.
