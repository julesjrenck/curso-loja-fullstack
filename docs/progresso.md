# Progresso do curso

## Estado atual

- Última atualização: 14/10/2026, referência de data America/Sao_Paulo.
- Módulo atual: 5 — SQL Server e persistência.
- Etapa atual: 5.13 — Preparação da conta de migrations.
- Situação: loja_migracoes criado como login e usuário em loja após autorização
  explícita "Sim, autorizo criar essa conta com essas permissões" em 14/10/2026.
  Senha própria somente no .env local. Autenticação, papéis de dados,
  CREATE TABLE/ALTER dbo e reexecução conferidos; acesso a loja_test recusado.
  Laravel permanece loja_app sem DDL. Banco ainda sem tabelas da aplicação.
  Rejeição automática inicial resolvida pela autorização; execução concluída.
  Explicação dos arquivos/permissões/resultados apresentada; entendimento da 5.13
  confirmado com "entendi" em 14/10/2026. Checkpoint preparado para publicação.
  Colunas 5.12 confirmadas com "entendi" em 14/10/2026 e publicadas.
  DBeaver: acesso confirmado pelo aluno; aviso cumprido na 5.6.
  Último checkpoint publicado: bbec195, colunas de produtos 5.12.
  Nenhuma dependência ou serviço novo.
- Entendimento confirmado: módulos 1, 2 e 3 completos, cada avanço confirmado
  pelo aluno com "entendi". As etapas 3.1 a 3.10 foram confirmadas em 09/10/2026;
  etapas 3.11 a 3.22 confirmadas com "entendi" em 12/10/2026.
- Módulo 4 iniciado em 12/10/2026 e concluído em 13/10/2026.
- Módulo 5 iniciado em 13/10/2026; módulos 6 a 23 não iniciados.
- Etapas 4.1 a 4.19 confirmadas em 13/10/2026; módulo 4 concluído.
- Etapa 5.1 confirmada com "entendi" em 13/10/2026.
- Etapa 5.2 confirmada com "entendi" em 13/10/2026.
- Etapa 5.3 confirmada com "entendi", após esclarecimento PIE, em 13/10/2026.
- Etapa 5.4 confirmada com "entendi", após esclarecimentos de acesso, em 13/10/2026.
- Etapa 5.5 confirmada com "entendi" em 13/10/2026.
- Etapa 5.6 confirmada com "entendi" em 13/10/2026, após resultado "apareceu loja" no DBeaver.
- Etapa 5.7 confirmada com "entendi" em 13/10/2026, após dúvidas de usuário/view.
- Etapa 5.8 confirmada com "entendi" em 14/10/2026.
- Etapa 5.9 confirmada com "entendi" em 14/10/2026.
- Etapa 5.10 confirmada com "entendi" em 14/10/2026.
- Etapa 5.11 confirmada com "entendi" em 14/10/2026.
- Etapa 5.12 confirmada com "entendi" em 14/10/2026.
- Etapa 5.13 confirmada com "entendi" em 14/10/2026.

## Retomada em outro chat

Em 09/10/2026, o aluno informou que continuará o curso amanhã em outro chat.
A sessão de 09/10 terminou após a explicação da etapa 3.11, sem confirmação
de entendimento dessa etapa naquele momento.

O ponto de retomada deixado naquela sessão era a aula 3.11: ativar/desativar,
encapsulamento, `$this`, void e estado de cada instância. Essa retomada foi
realizada em 12/10, conforme o registro abaixo.

Código e aula 3.11 publicados e sincronizados no checkpoint `8d54d1a`.
Este registro de encerramento é uma atualização de documentação; não altera
o código ou o ambiente Docker.

Retomada realizada em 12/10/2026: instruções, roteiro, progresso, código da
etapa e estado do Git conferidos. Não havia alterações locais. A consulta
`git ls-remote origin refs/heads/main` confirmou `aa9642e` no GitHub, igual
a HEAD e origin/main; esse commit contém o registro de encerramento anterior.
A explicação da etapa 3.11 foi retomada e a demonstração executada novamente.
Após a reapresentação, o aluno confirmou entendimento com "entendi" em
12/10/2026. Etapa 3.11 concluída; próximo passo: interface da etapa 3.12.
Registro de confirmação salvo no commit local `0c2106b`. O push ficou pendente:
a revisão automática rejeitou a publicação por exigir aprovação explícita da
branch pública `main`. Depois, o aluno autorizou explicitamente os checkpoints
concluídos nesse destino: "Sim, autorizo os checkpoints concluídos".
Etapa 3.12 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint `846ada2` criado e publicado junto com o registro da 3.11.
HEAD, origin/main e `git ls-remote origin refs/heads/main` retornaram
`846ada28c4dfd4ad4db61fd631ac7a3d39dbac6f`; publicação confirmada.
Etapa 3.13 implementada, explicada e verificada. Após o esclarecimento sobre
onde ItemCarrinho é instanciado, o aluno confirmou entendimento com "entendi".
Checkpoint da composição `197470b` publicado conforme autorização existente.
HEAD, origin/main e a consulta direta à branch main remota retornaram
`197470b1570cbfa02d736166566e5f796deb8cb4`; publicação confirmada.
Etapa 3.14 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do subtotal `b45dc75` publicado conforme autorização existente.
HEAD, origin/main e a consulta direta à main remota retornaram
`b45dc7509c945d5974d6768876c464534f6d4878`; publicação confirmada.
Etapa 3.15 apresentada, verificada e confirmada com "entendi": requisitos de
PHPUnit atendidos pelo PHP do container existente. Checkpoint de documentação
`3dba56d` publicado; HEAD, origin/main e consulta direta à main remota retornaram
`3dba56d1d161f9de05e98273950fc785dc1089b8`.
Etapa 3.16 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint da instalação `9a9c43a` publicado conforme autorização existente.
HEAD, origin/main e consulta direta à main remota retornaram
`9a9c43a5dce5696ab5230ba8626a761763fdb940`; publicação confirmada.
Etapa 3.17 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do primeiro teste `071aacd` publicado; HEAD, origin/main e consulta
direta à main remota retornaram `071aacd00da4180bd8ec1a210708b91577c79ecf`.
Etapa 3.18 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de quantidade zero `9d6ceb0` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`9d6ceb0fbb7f669203ed6bad2d91789201b11c13`.
Etapa 3.19 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de quantidade negativa `188ff33` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`188ff3341e1b0abdf63a008f066810cc28852562`.
Etapa 3.20 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint da menor quantidade válida `95630cd` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`95630cdea45c1885a277b833ae26a0cca32cafac`.
Etapa 3.21 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de preço zero `a5caa53` publicado; HEAD, origin/main e consulta
direta à main remota retornaram `a5caa5380ea88a83de3f48655c7e8aed926929ff`.
Etapa 3.22 apresentada e documentada, sem mudança no código, e confirmada com
"entendi". Módulo 3 concluído em 12/10/2026. Checkpoint de revisão `7a4dc00`
publicado; HEAD, origin/main e consulta direta à main remota retornaram
`7a4dc008fc4418059d7057d913cea9a9336ee612`.
Etapa 4.1 apresentada e documentada, com diagnóstico do ambiente concluído,
e confirmada com "entendi" em 13/10/2026. Checkpoint da preparação `9807e53`
publicado; HEAD, origin/main e consulta direta à main remota retornaram
`9807e53416d5b45e3f903edf36aa2f3ff8381111`.
Etapa 4.2 gerou e apresentou o esqueleto em backend, sem dependências ou scripts,
e foi confirmada com "entendi" em 13/10/2026. Checkpoint cfa2e69 publicado;
HEAD, origin/main e consulta direta à main remota retornaram
`cfa2e69a9f24d6c0417406f340f02a3a079d827b`.
Etapa 4.3 preparou serviço backend e volume exclusivo, verificou montagens e
persistência. Implementação e explicação concluídas; entendimento confirmado com
"entendi" em 13/10/2026. Checkpoint dc9f4b8 publicado; HEAD, origin/main e
consulta direta à main remota retornaram
`dc9f4b88786196896d229fd5785c698d2e8253f8`.
Etapa 4.4 instalou dependências de execução e gerou lockfile/autoload; validação,
plataforma e carregamento de classes conferidos. Explicação apresentada;
entendimento confirmado com "entendi" em 13/10/2026. Sem execução de Artisan ou
HTTP Laravel. Checkpoint 4c6df27 publicado; HEAD, origin/main e consulta direta
à main remota retornaram `4c6df27b1e6ec4f04c64c55bc6fa10df2f5c8e84`.
Etapa 4.5 preparou storage e bootstrap/cache graváveis, mantendo código somente
leitura. Marcadores conferidos no host e entre containers, depois removidos.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 7c0fcea publicado; HEAD, origin/main e consulta direta à main remota
retornaram `7c0fcea3b613cb55a29923237281a4b0fd57b91c`.
Etapa 4.6 adaptou o modelo e criou ambiente local Laravel; leitura das variáveis
conferida no Docker e exclusão do .env verificada. APP_KEY ainda vazia.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint ae521c9 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `ae521c9ea4344cc408201875b454eae9b5a03f19`.
Etapa 4.7 apresentou Artisan, gerou APP_KEY local e verificou criptografia e
carregamento em outro container. Manifests gerados apresentados e ignorados.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 590f98a publicado; HEAD, origin/main e consulta direta à main remota
retornaram `590f98a7141f8223659711c659b2d857c05afc67`.
Etapa 4.8 iniciou o servidor Laravel e verificou welcome em HTTP 200, montagens,
artefatos gerados e parada/reinício com init. Laboratório preservado.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 6ccf825 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `6ccf825fbb834fdba7db7fb5785bbdb2721089f1`.
Etapa 4.9 acrescentou GET /loja com saudação pelo nome configurado. Sintaxe,
registro e respostas HTTP verificados; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 1671a0b publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`1671a0b15f6bba6f8d8daafa41548d31f76f5614`.
Etapa 4.10 criou LojaController e ligou /loja a index. Sintaxes, registro e
comportamento HTTP preservado conferidos; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint f31b38e publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`f31b38eb8d3732cf6e158d8fd9eff82687d4a7fc`.
Etapa 4.11 criou view loja e retorno View no controller, com dado nomeLoja.
HTTP, renderização e escape verificados; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 1d93ab8 publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`1d93ab8913540a1d27bcdd0c789622dd37e54567`.
Etapa 4.12 enviou nomes demonstrativos para a view e exibiu com @foreach.
Sintaxe e lista renderizada conferidas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 37b7485 publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`37b74854c1b1d5b0a3b72c9b3c65514676bf2a62`.
Etapa 4.13 acrescentou condição de lista vazia na view e verificou os dois
ramos por renderização. Explicação apresentada; entendimento confirmado com
"entendi" em 13/10/2026. Checkpoint b944f4e publicado; HEAD, origin/main e
consulta direta à main remota retornaram `b944f4e30ae1bce7dc1e6914bdc479cac35ee245`.
Etapa 4.14 criou middleware de resposta e associou-o a /loja. Sintaxes, registro
e atuação/escopo HTTP verificados; explicação apresentada e entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint 354626c publicado; HEAD, origin/main e
consulta direta à main remota retornaram `354626c0dbd7d89b6c51455d88b124e0d5cb06e2`.
Etapa 4.15 extraiu nomes para CatalogoDemonstracao e recebeu a classe no método
index por injeção. Sintaxes e HTTP conferidos; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint dca8ccd publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`dca8ccd583c338c7ce8581a7f639144495fbdc7a`.
Etapa 4.16 moveu a injeção para o construtor com propriedade promovida; sintaxe
e HTTP conferidos. Explicação apresentada; entendimento confirmado com "entendi"
em 13/10/2026. Checkpoint 5da3709 publicado; HEAD, origin/main e consulta direta
à main remota retornaram `5da37098c407a616d3a521b04864a583b7c947e2`.
Etapa 4.17 definiu contrato, implementação e binding no provider; controller
recebe a interface. Sintaxes, resolução e HTTP conferidos; entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint 92d6e5f publicado; HEAD, origin/main e
consulta direta à main remota retornaram `92d6e5f925abb704b9ae57e366a0d7ac024e959b`.
Etapa 4.18 apresentou User como model Eloquent e demonstrou atributos em memória,
sem aplicação inicializada ou banco. Explicação apresentada; entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint aa372c6 publicado; HEAD, origin/main e
consulta direta à main remota retornaram `aa372c66ef54086f72d9aea2160a67fcdc9aaa86`.
Etapa 4.19 apresentou revisão do módulo 4 e conferiu entrega HTTP e pendências.
Entendimento da revisão confirmado com "entendi" em 13/10/2026; módulo 4 concluído.
Checkpoint 2346772 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `23467729d7d3d5ebf6587084cab007ad1afa4df7`. Módulo 5 iniciado na 5.1,
com diagnóstico de preparação apresentado; entendimento confirmado com "entendi".
Checkpoint 5.1 publicado: 41d0660; HEAD, origin/main e consulta direta à main
remota retornaram `41d0660945bd3b91dc3a036017986e1adc6c2ff5`.
Etapa 5.2 implementou imagem própria do backend com ODBC 18, validada e aplicada;
explicação apresentada, entendimento da 5.2 confirmado com "entendi" em 13/10/2026.
Checkpoint 5709dfe publicado; HEAD, origin/main e consulta direta à main remota
retornaram `5709dfefd739105efeff07691e6c127faa54dac6`.
Etapa 5.3 instalou/habilitou drivers PHP 5.13.3 com PIE 1.5.2 na imagem backend;
explicação apresentada e verificações passaram; entendimento confirmado com "entendi"
em 13/10/2026, após esclarecimento sobre PIE.
Checkpoint 5ba53e2 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `5ba53e2f6d6fda3b962909b2d3e2eb9c919eb6b8`.
Etapa 5.4 introduziu SQL Server 2022 Developer com imagem fixada, volume e
configuração local; servidor/rede conferidos, entendimento confirmado com "entendi"
em 13/10/2026, após esclarecimentos sobre acesso. Aluno pediu aviso quando puder
conectar pelo DBeaver e autorizou seguir o curso; acesso host ainda não configurado.
Checkpoint d9fba40 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `d9fba40e398512cb63385e970e8578ffe90441d2`.
Etapa 5.5 criou loja/loja_test e conferiu estado, arquivos, conexões e reexecução;
entendimento confirmado com "entendi" em 13/10/2026. Acesso local pelo DBeaver
será preparado na 5.6.
Checkpoint fc2cdbc publicado; HEAD, origin/main e consulta direta à main remota
retornaram `fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.
Etapa 5.6 publicou porta SQL local, conferiu conexão autenticada e apresentou
dados DBeaver; aviso ao aluno cumprido. Aluno relatou "apareceu loja" no DBeaver,
confirmando execução da consulta no banco loja; entendimento da 5.6 confirmado
com "entendi" em 13/10/2026.
Checkpoint 5.6 publicado: c7f58ee; HEAD, origin/main e consulta direta à main remota
retornaram `c7f58ee64ab62b1b053cd27b96b644772ecac98f`.
Etapa 5.7 preparou login/usuário da aplicação no banco loja, com credencial local
e papéis de dados; verificações passaram, entendimento confirmado com "entendi"
em 13/10/2026, após esclarecer usuário criado e view sys.database_principals.
Checkpoint 5.7 publicado: 063e4eb; HEAD, origin/main e consulta direta à main
remota retornaram `063e4ebc0c1ec733b183005c922ffd967f4ac35b`.
Etapa 5.8 preparou ambiente Laravel e conferiu configuração sem consulta SQL;
explicação apresentada, entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.8 publicado: e0e06ef; HEAD, origin/main e consulta direta à main
remota retornaram `e0e06ef063ec245739e18f684336d218751687e9`.
Etapa 5.9 realizou primeira consulta pelo Laravel com comando diagnóstico;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.9 publicado: 173ed00; HEAD, origin/main e consulta direta à main
remota retornaram `173ed0089496181ec510cd521d7995a62045ca54`.
Etapa 5.10 documentou desenho de produtos; explicação apresentada e entendimento
confirmado com "entendi" em 14/10/2026. Nenhuma tabela ou migration criada.
Checkpoint 5.10 publicado: b160a68; HEAD, origin/main e consulta direta à main
remota retornaram `b160a6827c99cd30f6edbea3e1f19556fc06b147`.
Etapa 5.11 gerou primeiro arquivo de migration, verificado sem aplicar ao banco;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.11 publicado: 3e5cb93; HEAD, origin/main e consulta direta à main
remota retornaram `3e5cb9370b37ddc666d4ccd84441589644a0256f`.
Etapa 5.12 preencheu colunas e conferiu SQL em simulação, sem aplicar ao banco;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.12 publicado: bbec195; HEAD, origin/main e consulta direta à main
remota retornaram `bbec195570dc903909bc0a629ce78c57e9ed5d6a`.
Etapa 5.13 preparou SQL e senha local; rejeição inicial resolvida pela autorização
explícita do aluno. Conta criada, autenticada e permissões/reexecução conferidas;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.

## Perfil e escolhas confirmadas no planejamento

- Já programa em PHP; pouca experiência com Laravel.
- JavaScript básico e React inicial.
- Projeto: loja e gestão de pedidos.
- Repositório novo e público, nome sugerido `curso-loja-fullstack`.
- JavaScript antes de TypeScript.
- Node.js também como backend de notificações.
- Desenvolvimento e testes em Docker.
- Prática local antes da AWS; orçamento a definir no módulo de deploy.
- O professor escreve e explica; o aluno acompanha, pergunta e confirma
  entendimento antes de cada avanço.

Aceitar o plano confirmou estas escolhas, não o entendimento das futuras aulas.

## Etapa 1.1

Objetivo: guardar o roteiro e um ponto de retomada que não dependa do histórico
de um chat, além de orientar o professor em novas sessões.

Arquivos criados:

- `docs/curso.md`: roteiro completo, entregas, método, arquitetura e decisões.
- `docs/progresso.md`: estado real da aprendizagem e da publicação.
- `AGENTS.md`: instruções para continuar respeitando o ritmo combinado.

Explicação preparada nesta etapa: Markdown é texto de documentação; `#` define
um título e `-` inicia um item. O roteiro descreve o caminho completo; o registro
de progresso guarda onde paramos; as instruções orientam a retomada do professor.
As próximas sessões devem ler esses arquivos e conferir o estado do código.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.1 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.2

Objetivo: definir o que deve ficar fora do Git e apresentar o projeto a quem
abrir a pasta ou o futuro repositório no GitHub.

Arquivos criados:

- `.gitignore`: configurações `.env`, dependências, resultados gerados, logs e
  configurações locais do ambiente; preserva os modelos `.env.example`.
- `README.md`: apresentação, estado atual, links para documentação, tecnologias
  planejadas e método das aulas. Não anuncia uma aplicação já executável.

Explicação desta etapa: comentários com `#`, padrões de nomes, curinga `*`,
exceção `!`, barra final para pastas e barra inicial para a raiz do projeto.
As regras se aplicam também aos futuros subprojetos; arquivos de lock serão
versionados. O `.gitignore` não retira arquivos já rastreados do histórico.
O README usa títulos, listas e links Markdown relativos à sua localização.

Verificação concluída com `git check-ignore`, usando um repositório temporário
em `/tmp`, removido ao terminar, sem inicializar o Git do projeto: 15 caminhos
de exemplo corretamente ignorados e 11 candidatos a versionamento preservados,
incluindo modelos `.env.example` na raiz e em subpastas, código e lockfiles.
Todos os links relativos do README apontam para arquivos existentes.
Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.2 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.3

Objetivo: transformar a pasta em um repositório local, sem adicionar arquivos,
criar commits ou publicar no GitHub nesta etapa.

Comando explicado e executado: `git init -b main`.

- `git`: programa de controle de versões.
- `init`: inicializa os metadados do repositório na pasta `.git`.
- `-b main`: define `main` como nome da branch inicial.
- Branch: uma linha de desenvolvimento do projeto.
- `.git/HEAD` contém `ref: refs/heads/main`, apontando para essa branch.
- `.git/config` guarda configuração local; `.git/objects` guardará objetos do
  histórico e `.git/refs` guardará referências. São arquivos gerenciados pelo Git.

A pasta `.git` estava montada como somente leitura no modo restrito. A execução
ampliada de `git init -b main` foi aprovada e concluiu a inicialização. Nenhuma
permissão da pasta foi alterada manualmente.

Verificações concluídas: `git rev-parse --git-dir` retornou `.git`;
`git symbolic-ref --short HEAD` retornou `main`; `git status --short`, executado
sem atualizações opcionais de metadados, mostrou `.gitignore`, `AGENTS.md`,
`README.md` e `docs/` como `??` (arquivos ainda não rastreados).
`git remote -v` não retornou remotos. Não houve `git add`, commit ou push.
O README foi atualizado para refletir a inicialização do repositório.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.3 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.4

Objetivo: consultar o estado do repositório e selecionar os cinco arquivos
do checkpoint inicial sem criar o commit nesta etapa.

Conceitos explicados:

- `git status` mostra o estado dos arquivos; `--short` resume a saída.
- `??` identifica arquivos ainda não rastreados.
- Staging, ou área de preparação, guarda o conteúdo selecionado para o próximo
  commit. O índice do Git representa essa seleção.
- `git add .gitignore AGENTS.md README.md docs/curso.md docs/progresso.md`
  seleciona explicitamente os cinco arquivos do curso.
- `A ` na saída curta indica um arquivo novo preparado para o commit. A primeira
  coluna representa a área de preparação; a segunda, alterações locais ainda
  não preparadas. `AM` significa adicionado ao staging e modificado depois.
- Se um arquivo mudar depois do `git add`, é necessário adicioná-lo novamente
  para que o commit inclua a versão atualizada.
- `git diff --cached --stat` resume o conteúdo selecionado, comparado ao último
  commit; como não existe commit, mostra as adições ao repositório vazio.

Seleção executada com execução ampliada devido à proteção de escrita em `.git`.
Verificação concluída: os cinco arquivos apareceram como `A ` em
`git status --short`; `git diff --cached --stat` mostrou apenas os cinco arquivos;
`git diff --cached --check` não apontou problemas de espaços e
`git diff --exit-code` não encontrou mudanças fora da área de preparação.
README e progresso foram atualizados para refletir a seleção e adicionados
novamente para incluir esses registros no checkpoint. Nenhum commit ou push
foi executado nesta etapa.
Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.4 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.5

Objetivo: registrar os cinco arquivos iniciais em um commit local e distinguir
esse registro da publicação no GitHub.

Autoria: identidade já configurada no Git conferida com `git var GIT_AUTHOR_IDENT`
e `git var GIT_COMMITTER_IDENT`; nenhuma configuração global de autoria alterada.

Comando da etapa: `git commit -m "docs: inicia curso e registra progresso"`.

- `commit` registra o conteúdo da área de preparação no histórico local.
- `-m` define a mensagem sem abrir um editor; as aspas agrupam a mensagem.
- `docs:` é uma convenção para identificar mudanças de documentação.
- O commit tem identificador (SHA), autoria, data, mensagem e referência ao
  conteúdo dos arquivos. O primeiro commit não tem um commit anterior.
- `git log -1 --oneline` exibe o último commit com identificador abreviado.
- `git status --short` sem saída significa que não há alterações pendentes
  nos arquivos visíveis ao Git; arquivos ignorados podem continuar no disco.
- Um commit local só será publicado quando enviarmos o histórico ao remoto.

README e progresso atualizados antes de finalizar a seleção com `git add`.
Resultado verificado: commit `afb0d2c` criado na branch `main`, com a mensagem
acima e exatamente os cinco arquivos iniciais. A verificação ao encerrar a
etapa encontrou um commit no histórico, nenhum remoto e nenhuma alteração
pendente no staging ou na pasta de trabalho.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.5 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.6

Objetivo: preparar o repositório público GitHub e configurar seu endereço no
Git local, sem executar o push antes da confirmação de entendimento.

Verificações de acesso:

- A conexão GitHub identificou a conta autenticada como `julesjrenck`.
- A consulta a `julesjrenck/curso-loja-fullstack` retornou 404. A existência ou
  acessibilidade do repositório não foi confirmada; não afirmar que foi criado.
- As ferramentas GitHub disponíveis não oferecem criação de repositórios.
- GitHub CLI (`gh`), credencial de API nas variáveis usuais e helper de
  credenciais Git não estão disponíveis neste ambiente.
- O acesso pelo conector GitHub não comprova a autenticação do Git no terminal.
  O envio será verificado na etapa 1.7, inclusive pelo transporte SSH existente.

Comando explicado e executado:
`git remote add origin https://github.com/julesjrenck/curso-loja-fullstack.git`.

- Remote: endereço de outro repositório, neste caso hospedado no GitHub.
- `remote add`: adiciona o endereço à configuração local do Git.
- `origin`: apelido convencional para esse endereço.
- Adicionar o remoto não cria o repositório no GitHub nem envia os arquivos.
- `git remote -v`: mostra os endereços usados para buscar (`fetch`) e enviar
  (`push`) o histórico. Mostrar essas linhas não significa que houve envio.

Configuração verificada: a URL HTTPS acima foi gravada em `remote.origin.url`.
Uma regra de URL já existente no ambiente converte HTTPS GitHub para SSH;
por isso `git remote -v` e `git remote get-url origin` exibem
`git@github.com:julesjrenck/curso-loja-fullstack.git`. A regra foi preservada.
Nenhuma tentativa de push foi feita nesta etapa.

Ação necessária do aluno: abrir
[o formulário de criação](https://github.com/new?owner=julesjrenck&name=curso-loja-fullstack&visibility=public)
na conta `julesjrenck`, confirmar nome `curso-loja-fullstack` e visibilidade
pública, e criar o repositório vazio. Não adicionar README, `.gitignore`, licença
ou conteúdo gerado, pois o histórico inicial já existe localmente. Se o GitHub
informar que o nome está em uso, enviar o endereço do repositório para inspeção.

Fonte da orientação: [Adicionar código local ao GitHub](https://docs.github.com/en/migrations/importing-source-code/using-the-command-line-to-import-source-code/adding-locally-hosted-code-to-github).

O registro desta aula será incluído em um checkpoint local usando os comandos
`git add docs/progresso.md` e
`git commit -m "docs: registra preparacao do remoto GitHub"`, já ensinados.

Confirmação do aluno: recebida em 08/10/2026, com "criei e entendi".
A etapa 1.7 confirmou pela API que o repositório existe, é público, pertence a
`julesjrenck` e não tem branches. A etapa 1.6 está concluída.

## Etapa 1.7

Objetivo: enviar os commits locais para o GitHub e verificar a correspondência
entre o histórico local e a branch remota. Execução concluída; entendimento
da explicação do push ainda não confirmado.

Comando explicado e executado: `git push -u origin main`.

- `push`: envia os commits e atualiza a branch no destino remoto.
- `origin`: apelido do repositório GitHub já configurado.
- `main`: branch local que queremos publicar.
- `-u`: configura a branch remota `origin/main` como referência de acompanhamento
  da `main` local; nas próximas publicações, poderemos usar apenas `git push`.

Diagnóstico anterior à publicação:

- A API GitHub confirmou `julesjrenck/curso-loja-fullstack` público e acessível.
  O endpoint de branches retornou `[]`, indicando repositório vazio.
- O modo restrito não resolveu `github.com`; as verificações de rede exigiram
  execução ampliada, conforme autorização já existente para GitHub.
- O primeiro acesso SSH retornou `Host key verification failed`.
- A chave pública Ed25519 do servidor foi obtida da documentação oficial e
  verificada com o fingerprint
  `SHA256:+DiY3wvvV6TuJJhbpZisF/zLDA0zPMSvHdkr4UvCOqU`.
- A entrada oficial foi adicionada a `~/.ssh/known_hosts` com execução ampliada,
  preservando as entradas existentes. Esse arquivo reconhece o servidor;
  não cadastra a identidade do usuário no GitHub.
- O acesso posterior pelo Git retornou `Permission denied (publickey)`.
- O par existente `~/.ssh/id_ed25519` e `~/.ssh/id_ed25519.pub` foi validado:
  as chaves correspondem e a chave privada é utilizável sem senha interativa.
  Nenhuma chave privada foi exibida, copiada para o projeto ou versionada.
- O conector GitHub não oferece cadastro de chaves SSH e sua autenticação não
  autentica automaticamente o Git no terminal.
- Nessa sessão de diagnóstico, nenhum `git push` foi executado: o acesso ainda
  não tinha sido liberado. O resultado após o cadastro está registrado abaixo.

Fontes: [Chaves do servidor GitHub](https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/githubs-ssh-key-fingerprints)
e [Cadastrar chave SSH na conta](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account).

Orientação apresentada ao aluno: abrir [SSH and GPG keys](https://github.com/settings/keys)
na conta `julesjrenck`, escolher `New SSH key`, título `curso-loja-fullstack`,
tipo `Authentication Key`, colar a chave pública apresentada na conversa e
confirmar com `Add SSH key`. A chave pública pode ser obtida novamente no arquivo
`~/.ssh/id_ed25519.pub`; não pedir chave privada ou senha ao aluno.

Resultado após o cadastro, informado pelo aluno com "adicionei":

- `git ls-remote origin` concluiu com sucesso e sem referências; a API de
  branches também retornou `[]`, confirmando que o destino estava vazio.
- `git push -u origin main` concluiu com sucesso e criou `main` no GitHub.
- A saída informou `main -> main` e o acompanhamento de `origin/main`.
- `git rev-parse HEAD` e `git rev-parse origin/main` retornaram o mesmo SHA:
  `a43617042726cda586c24b630eab8734b53f7a3c`.
- A API GitHub para `commits/main` confirmou esse mesmo SHA. Os três commits
  iniciais foram publicados preservando o histórico local.
- `git rev-parse --abbrev-ref --symbolic-full-name '@{upstream}'` retornou
  `origin/main`; `git status --short --branch` mostrou `main...origin/main`
  sem alterações pendentes.
- O cadastro da chave resolve a autenticação. A mensagem "adicionei" não é
  uma confirmação de entendimento da explicação do push.

Explicação da saída: `[new branch] main -> main` informa a criação da branch
remota a partir da local. O vínculo de acompanhamento permite ao Git comparar
as duas branches e usar o destino em futuros comandos `git push`.

README e progresso atualizados para registrar o sucesso, com novo checkpoint
local `docs: registra primeiro push e sincronizacao`. Após o commit, enviar
essa atualização com `git push` e conferir novamente os SHAs local/remoto.
O SHA acima identifica o primeiro envio verificado, não o commit posterior que
contém este registro. Para consultar o último publicado, usar `origin/main`
ou a página do GitHub, evitando inserir o SHA do commit em seu próprio conteúdo.

Registro desta sessão em checkpoint local com os comandos já ensinados:
`git add AGENTS.md README.md docs/progresso.md` e
`git commit -m "docs: registra criacao do repositorio e pendencia SSH"`.

Entendimento da etapa 1.7: confirmado pelo aluno com "entendi", após os
esclarecimentos sobre SSH. Módulo 1 concluído em 08/10/2026.

## Etapa 2.1

Objetivo: entender a diferença entre imagem e container e confirmar que
conseguimos consultar o serviço Docker antes da primeira execução de PHP.

Conceitos apresentados:

- Imagem: pacote de arquivos, executáveis, bibliotecas e configurações que
  serve de base para criar containers; por exemplo, uma imagem com PHP 8.4.
- Container: instância criada a partir da imagem, com ambiente próprio para
  executar um processo. Pode estar em execução ou parada.
- Uma mesma imagem pode originar vários containers, cada um com seu estado.
- Analogia com OOP: imagem se aproxima de uma classe/modelo; container, de uma
  instância. É uma analogia didática, não uma implementação de classes PHP.
- Cliente Docker: programa `docker`, que recebe nossos comandos.
- Serviço Docker, ou daemon: processo que atende esses comandos e gerencia
  imagens, containers, redes e volumes.
- `docker --version` verifica o cliente; `docker compose version`, o Compose;
  `docker info` consulta o serviço. A versão do cliente, sozinha, não comprova
  que o serviço esteja acessível.

Verificações executadas:

- Cliente Docker: 29.8.2; Compose: v5.5.1; contexto ativo: `default`.
- A consulta `docker info` no modo restrito retornou permissão negada no socket
  `/var/run/docker.sock`.
- Com execução ampliada, o comando
  `docker info --format '{{json .ServerVersion}} {{json .OSType}} {{json .Architecture}}'`
  retornou `"29.8.1" "linux" "x86_64"`. `--format` foi usado apenas para
  selecionar os campos relevantes, sem alterar a configuração do Docker.
- O daemon está disponível pela execução ampliada. O acesso no modo restrito
  permanece limitado; não confundir a restrição com serviço desligado.
- Nenhuma instalação, mudança de grupos ou permissões do socket foi feita.
- Nenhum container, imagem PHP, Dockerfile ou arquivo Compose foi criado nesta
  etapa. A execução do primeiro container pertence à etapa seguinte.

Fontes: [Imagem](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-an-image/),
[Container](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-a-container/)
e [Cliente e daemon Docker](https://docs.docker.com/get-started/docker-overview/).

Arquivos atualizados: README (estado do projeto), roteiro (situação dos módulos)
e este registro (confirmação do módulo 1 e ponto de retomada do módulo 2).
Checkpoint da etapa: `docs: inicia modulo Docker e registra conceitos`.

Confirmação de entendimento da etapa 2.1: recebida em 08/10/2026 com "entendi".

## Etapa 2.2

Objetivo: executar um primeiro comando PHP dentro de um container e observar
o ciclo de criação, execução, término e remoção.

Aula salva em `docs/aulas/02-02-primeiro-container.md`, com comando, explicação
dos argumentos, resultados e fontes. O README aponta para essa página.

Comando explicado e executado:
`docker run --rm --name curso-loja-php-versao php:8.4.26-cli-bookworm php -v`.

- A tag foi conferida na lista oficial da imagem PHP; fixa a versão 8.4.26,
  variante CLI e base Debian 12 (Bookworm).
- A consulta inicial não encontrou container com esse nome. Outros containers
  e imagens do ambiente foram preservados.
- O Docker baixou a imagem oficial e executou PHP 8.4.26 (CLI) com código 0.
- Após o término, a consulta de containers não encontrou o container da aula:
  ele foi removido por `--rm`. A imagem permaneceu disponível.
- Imagem inspecionada: Linux `amd64`, digest
  `php@sha256:836ac6c672d1372a47c8fd61b625015bd07760f493fb2eaab2087636498a2b4b`.
- Não foram compartilhadas pastas ou portas; nenhum servidor web foi iniciado.
- Ainda não há Dockerfile, Compose ou aplicação da loja.

Arquivos atualizados: página da aula, README, resumo do roteiro e progresso.
Checkpoint local:
`docs: registra primeira execucao PHP em Docker`.

Confirmação de entendimento da etapa 2.2: recebida em 08/10/2026 com "entendi".

## Etapa 2.3

Objetivo: construir a primeira imagem própria do curso com um Dockerfile mínimo
e um contexto limitado por `.dockerignore`, e verificar seu comando padrão.

Arquivos de implementação criados e explicados:

- `Dockerfile`: `FROM php:8.4.26-cli-bookworm` e `CMD ["php", "-v"]`.
- `.dockerignore`: exclui tudo com `**` e permite apenas `Dockerfile` e
  `.dockerignore` por exceções com `!`, nesta etapa sem código a copiar.

Explicação e comandos salvos em `docs/aulas/02-03-dockerfile.md`.
O README apresenta o estado atual, aponta para a aula e inclui os comandos.

Comandos explicados e executados, com execução ampliada:

```bash
docker build -t curso-loja-php:aula-2.3 .
docker run --rm --name curso-loja-php-dockerfile curso-loja-php:aula-2.3
```

Resultados verificados:

- Não havia imagem do curso ou container com esses nomes antes da execução.
- Build concluído com sucesso usando a base da etapa 2.2.
- Imagem local criada: `curso-loja-php:aula-2.3`.
- ID observado:
  `sha256:8ccd0f1725de2e7e887784ea9c3ee881c987cef31b2a2d086ca293c4882d815a`.
- Execução sem comando adicional mostrou PHP 8.4.26 CLI, com código 0.
- Inspeção confirmou o `CMD` e a consulta de containers não encontrou o
  container após o término, conforme `--rm`.
- Não foram copiadas pastas do projeto nem compartilhadas portas ou volumes.
  A aplicação da loja e o Compose ainda não foram criados.

Checkpoint da etapa: `feat: adiciona primeiro Dockerfile do curso`.
Confirmação de entendimento da etapa 2.3: recebida em 08/10/2026 com "entendi".

## Etapa 2.4

Objetivo: incluir um script PHP na imagem e executá-lo pelo comando padrão.

Implementação criada e explicada:

- `src/index.php`: imprime "Olá, Docker!" e a versão do PHP, usando `echo`,
  concatenação, `PHP_EOL` e `PHP_VERSION`.
- `Dockerfile`: mantém a base, acrescenta `WORKDIR /app` e `COPY src/ ./`,
  e muda o comando padrão para `["php", "index.php"]`.
- `.dockerignore`: acrescenta `!src/` e `!src/**` para permitir a pasta e seu
  conteúdo no contexto; os demais arquivos continuam excluídos.

Aula salva em `docs/aulas/02-04-codigo-na-imagem.md`. README atualizado com os
comandos atuais. A aula 2.3 recebeu uma nota sobre seu checkpoint histórico,
para diferenciar o Dockerfile daquela etapa da versão atual.

Comandos executados com execução ampliada:

```bash
docker build -t curso-loja-php:aula-2.4 .
docker run --rm --name curso-loja-php-script curso-loja-php:aula-2.4
```

Resultados verificados:

- A imagem da etapa 2.3 foi preservada e os novos nomes estavam disponíveis.
- Build concluído com sucesso; a cópia do script integrou a nova imagem.
- Saída do script: "Olá, Docker!" e "Versão do PHP: 8.4.26", com código 0.
- Inspeção confirmou `/app` como diretório de trabalho e o comando do script.
- Imagem local: `curso-loja-php:aula-2.4`, ID
  `sha256:c5eee4b45f731c0163e84ac817ea98aad2bad3b74600417dced77f5a09bc885e`.
- Container descartável removido ao terminar; sem portas ou volumes publicados.

Conceito a confirmar: `COPY` inclui a versão do arquivo existente no momento
do build. Editar o arquivo local depois exige reconstruir a imagem para usar
a mudança; não há sincronização automática nesta etapa.

Checkpoint: `feat: executa primeiro script PHP na imagem Docker`.
Entendimento da etapa 2.4: confirmado em 08/10/2026 com "entendi".

## Etapa 2.5

Objetivo: criar o primeiro arquivo Compose e executar o script pelo serviço PHP.

Implementação: `compose.yaml`, com nome de projeto `curso-loja-fullstack` e
serviço `php` usando `build: .`. Sem alterações no script, no Dockerfile ou
nas regras de contexto. A explicação cobre YAML, indentação, projeto, serviço
e a relação entre Dockerfile e Compose.

Aula salva em `docs/aulas/02-05-compose.md`; README atualizado com os comandos
Compose e o estado atual.

Comandos explicados e executados:

```bash
docker compose config --quiet
docker compose build
docker compose run --rm php
```

Resultados verificados:

- Configuração validada com código 0 e sem erros.
- Antes de executar, não havia containers, rede ou imagem com o nome do projeto.
- Build concluído, com reutilização de cache de `WORKDIR` e `COPY`.
- Imagem local gerada: `curso-loja-fullstack-php:latest`.
- ID observado:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.
- Execução retornou "Olá, Docker!" e "Versão do PHP: 8.4.26", com código 0.
- Inspeção confirmou diretório `/app` e comando `["php", "index.php"]`.
- `docker compose ps -a` mostrou apenas o cabeçalho após a execução: o
  container temporário foi removido.
- A rede padrão `curso-loja-fullstack_default` foi criada e permanece disponível,
  assim como a imagem. Não houve publicação de portas ou compartilhamento de pastas.
- As operações do daemon usaram execução ampliada; a validação do YAML foi
  realizada no modo restrito.

Checkpoint: `feat: adiciona primeiro servico PHP com Compose`.
Entendimento da etapa 2.5: confirmado em 08/10/2026 com "entendi".

## Etapa 2.6

Objetivo: disponibilizar o código local no container e observar uma alteração
do script sem reconstruir a imagem da aula anterior.

Implementação:

- `compose.yaml`: acrescenta `volumes` ao serviço PHP, com `./src:/app:ro`.
- `src/index.php`: muda a primeira mensagem para "Olá, Docker! Código local
  atualizado." para demonstrar qual versão do script está sendo executada.
- Dockerfile e regras do contexto preservados: `COPY` continua guardando a
  versão existente no momento do build.

Aula salva em `docs/aulas/02-06-bind-mount.md`, com explicação de origem,
destino, modo de leitura, montagem sobre arquivos existentes e comparação.
README atualizado; aulas 2.4 e 2.5 identificam seus checkpoints históricos.

Verificações realizadas sem executar build nesta etapa:

- `docker compose config --quiet` concluiu com sucesso.
- A configuração normalizada mostrou `type: bind`, origem na pasta `src`
  deste projeto, destino `/app` e `read_only: true`.
- `docker compose run --rm php` executou o código local atualizado, mostrando
  "Olá, Docker! Código local atualizado." e PHP 8.4.26, com código 0.
- `docker run --rm curso-loja-fullstack-php:latest`, sem montar a pasta, mostrou
  a mensagem antiga "Olá, Docker!" e PHP 8.4.26, com código 0.
- O identificador da imagem permaneceu igual antes e depois:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.
- Os containers temporários foram removidos. O daemon foi acessado pela execução
  ampliada autorizada; nenhuma porta foi publicada nesta etapa.

Conceitos a confirmar: montagem disponibiliza arquivos locais e encobre a cópia
em `/app` sem alterar a imagem; `ro` limita escrita pelo container, não a edição
pelo usuário no host. Reexecutar o script lê as alterações; não há execução
automática ao salvar. Mudanças na imagem ainda precisam de novo build.

Checkpoint: `feat: monta codigo PHP local para desenvolvimento`.
Entendimento da etapa 2.6: confirmado em 08/10/2026 com "entendi".

## Etapa 2.7

Objetivo: iniciar o servidor PHP de desenvolvimento, acessá-lo por HTTP e
apresentar estado, logs, parada e reinício do serviço.

Implementação:

- `compose.yaml`: comando `php -S 0.0.0.0:8000 -t /app`, publicação
  `127.0.0.1:8001:8000` e `stop_signal: SIGINT`. Mantém o bind mount somente leitura.
- `src/index.php`: acrescenta `Content-Type: text/plain; charset=UTF-8` antes
  da saída. Dockerfile e regras de contexto preservados.
- Aula salva em `docs/aulas/02-07-servidor-e-portas.md`; README atualizado e
  aula 2.6 identifica seu checkpoint histórico.

Comandos apresentados:

```bash
docker compose config --quiet
docker compose up -d --build php
docker compose ps
docker compose logs --tail 10 php
docker compose stop php
docker compose ps -a
docker compose up -d php
```

Resultados verificados:

- Porta 8000 sem listener visível na inspeção, mas publicação recusada pelo
  Docker Desktop com erro 500 em `/forwards/expose`.
- Porta local alternativa 8001 publicada com sucesso para a porta 8000 do container;
  a causa específica da falha da porta 8000 não foi estabelecida.
- Configuração final validada e serviço em estado `Up`.
- HTTP retornou `200 OK`, tipo `text/plain; charset=UTF-8`, mensagem do script
  e PHP 8.4.26. Logs confirmaram inicialização e `GET /` com status 200.
- Primeira parada com sinal padrão resultou em código 137 após encerramento
  forçado. Com `stop_signal: SIGINT`, a parada concluiu com código 0.
- Após reinício, nova requisição confirmou HTTP 200 e a publicação
  `127.0.0.1:8001->8000/tcp`.
- Servidor deixado em execução para o aluno acessar. As operações de daemon
  e rede usaram execução ampliada; outros projetos foram preservados.

Conceitos a confirmar: endereço de escuta no container e endereço publicado
no host são distintos; `command` altera o comando do serviço; `-d` mantém o
servidor em segundo plano; o sinal SIGINT permite parar normalmente o PHP;
`header` define metadados HTTP antes do corpo da resposta.

Checkpoint: `feat: inicia servidor PHP com porta local`.
Entendimento da etapa 2.7: confirmado em 08/10/2026 com "entendi".

## Etapa 2.8

Objetivo: definir uma variável de ambiente do serviço e ler seu valor no PHP.

Implementação:

- `compose.yaml`: acrescenta `environment`, com `APP_NAME: "Loja Fullstack"`.
- `src/index.php`: lê `getenv("APP_NAME")` em `$appName` e imprime o nome
  da aplicação antes das mensagens anteriores.
- Aula salva em `docs/aulas/02-08-variaveis-de-ambiente.md`; README atualizado
  e aula 2.7 identifica seu checkpoint histórico.

Comandos apresentados e executados:

```bash
docker compose config --quiet
docker compose up -d php
docker compose exec -T php printenv APP_NAME
```

Resultados verificados:

- YAML validado sem erros.
- `up` recriou e iniciou somente o container PHP para aplicar a configuração.
- `printenv APP_NAME` retornou `Loja Fullstack`, com código 0.
- HTTP retornou status 200 e `text/plain; charset=UTF-8`, com três linhas:
  "Aplicação: Loja Fullstack", a mensagem do script e PHP 8.4.26.
- Servidor permaneceu `Up`, publicado em `127.0.0.1:8001->8000/tcp`.
- Não houve build nesta etapa; o código local continua disponível pelo bind mount.
- Nenhum `.env`, `.env.example` ou novo serviço foi criado.

Conceitos a confirmar: APP_NAME é uma variável de ambiente do container;
`$appName` é uma variável PHP que recebe seu valor. Configuração alterada no
Compose precisa ser aplicada com `up`; código montado pode ser relido ao
atualizar a página; alterações na imagem precisam de build. `exec` executa
um comando no container já em execução.

Checkpoint: `feat: configura nome da aplicacao por ambiente`.
Entendimento da etapa 2.8: confirmado em 08/10/2026 com "entendi".

## Etapa 2.9

Objetivo: criar um modelo versionado e uma configuração local e usar seu valor
pela interpolação do Compose.

Implementação:

- `.env.example`: `APP_NAME="Loja Fullstack"`, valor fictício de exemplo.
- `.env`: criado localmente a partir do modelo; o valor didático foi alterado
  para `Loja Fullstack Local`. O arquivo não deve ser versionado.
- `compose.yaml`: usa `APP_NAME: "${APP_NAME}"` dentro de `environment`.
- PHP, Dockerfile e regras de exclusão preservados.
- Aula salva em `docs/aulas/02-09-env-e-modelo.md`; README atualizado e aula 2.8
  identifica seu checkpoint histórico.

Verificações:

- Antes da etapa, `.env` e `.env.example` não existiam, e APP_NAME não estava
  definida no shell.
- A primeira cópia com `cp -n` funcionou e exibiu aviso de portabilidade;
  `cp --update=none .env.example .env` foi conferido como alternativa que
  preserva o destino existente. O valor local foi mantido.
- Configuração normalizada resolveu APP_NAME como `Loja Fullstack Local`.
- `docker compose config --quiet` validou a configuração.
- `git check-ignore` confirmou `.env` ignorado e `.env.example` permitido.
  O arquivo local não consta em `git ls-files`.
- Um build temporário com `COPY .env` foi recusado por ausência do arquivo no
  contexto; confirmou a exclusão pelo `.dockerignore`, sem alterar o Dockerfile
  do projeto ou concluir uma imagem de teste.
- `docker compose up -d php` aplicou a configuração e recriou o container.
- `docker compose exec -T php printenv APP_NAME` retornou `Loja Fullstack Local`.
- HTTP retornou status 200 e o nome local, com tipo `text/plain; charset=UTF-8`.
- Servidor permaneceu ativo em `http://127.0.0.1:8001/`. Não houve reconstrução
  da imagem da aplicação nem criação de novos serviços.

Conceitos a confirmar: o modelo documenta as variáveis, a cópia local define
seus valores; o Compose lê `.env` para interpolar `${APP_NAME}` e `environment`
passa o resultado ao container. O PHP mantém `getenv` e não lê o arquivo local
diretamente. Variáveis do shell podem prevalecer sobre valores do arquivo.

Checkpoint: `feat: separa configuracao local em arquivo env`.
Entendimento da etapa 2.9: confirmado em 09/10/2026 com "entendi".

## Etapa 2.10

Objetivo: demonstrar persistência de dados em um volume nomeado entre execuções
de containers temporários, mantendo o código local somente leitura.

Implementação:

- `compose.yaml`: monta `dados-demo:/dados` no serviço PHP e declara o volume
  `dados-demo` na raiz do arquivo. O bind mount de código foi preservado.
- `src/contador.php`: exemplo de terminal que lê, incrementa e grava
  `/dados/contador.txt`, com erros explícitos de leitura/escrita.
- O contador recusa execução HTTP com status 403, evitando alterações por GET.
- Aula salva em `docs/aulas/02-10-volume-de-dados.md`; README atualizado.

Comandos executados:

```bash
docker compose config --quiet
docker compose up -d php
docker compose run --rm php php contador.php
docker compose run --rm php php contador.php
docker compose exec -T php cat /dados/contador.txt
```

Resultados verificados:

- Antes da etapa, o volume `curso-loja-fullstack_dados-demo` não existia e
  o servidor do curso estava ativo.
- Configuração validada, volume criado e serviço reaplicado sem novo build.
- Execuções em containers temporários diferentes retornaram valores `1` e `2`,
  ambas com código 0. Os containers foram removidos, mas o dado foi mantido.
- Inspeção confirmou `/app` como bind mount sem escrita e `/dados` como volume
  gerenciado pelo Docker com escrita.
- HTTP da raiz retornou 200; `GET /contador.php` retornou 403. O arquivo de dados
  continuou em `2` após a requisição recusada.
- `docker compose ps -a` mostrou apenas o servidor principal, que permaneceu
  ativo em `127.0.0.1:8001`. Outros projetos Docker foram preservados.
- `.env` permaneceu local, e o arquivo de dados não foi criado no repositório.

Conceitos a confirmar: volume nomeado é armazenamento gerenciado pelo Docker,
independente do container que o utiliza; o Compose declara o volume na raiz
e monta-o no serviço. O primeiro `php` de `run` seleciona o serviço, e o segundo
inicia o executável para o script de terminal. O exemplo é sequencial.

Checkpoint: `feat: demonstra persistencia em volume Docker`.
Entendimento da etapa 2.10: confirmado em 09/10/2026 com "entendi".

## Etapa 2.11

Objetivo: resolver o nome do serviço e acessar o servidor pela rede interna
a partir de outro container, distinguindo porta interna e porta publicada.

Implementação: `src/rede.php`, um diagnóstico de terminal que consulta
`gethostbyname("php")`, faz uma requisição HTTP a `http://php:8000/` com timeout
de cinco segundos e imprime a primeira linha de status da resposta.
O script recusa acesso HTTP e não altera dados. Compose, Dockerfile, `.env`
e volume foram preservados.

Aula salva em `docs/aulas/02-11-rede-entre-containers.md`; README atualizado
com o comando de diagnóstico e os endereços interno/externo.

Comando executado:

```bash
docker compose run --rm php php rede.php
```

Resultados verificados:

- Rede `curso-loja-fullstack_default` encontrada, driver `bridge`.
- Diagnóstico concluído com código 0 em outro container temporário.
- DNS resolveu `php`; o IP correspondeu ao da inspeção do servidor, que
  possui alias `php` nessa rede. O IP não foi fixado no código.
- Requisição interna a `http://php:8000/` retornou `HTTP/1.1 200 OK`.
- Requisição do host a `http://127.0.0.1:8001/` também retornou 200.
- Acesso HTTP ao diagnóstico retornou 403, preservando sua execução exclusiva
  pelo terminal e evitando requisições recursivas no servidor de desenvolvimento.
- Container temporário removido; `docker compose ps -a` mostrou apenas o
  servidor principal ativo. Não houve build ou escrita no volume de dados.

Conceitos a confirmar: a rede do Compose permite descoberta pelo nome do
serviço; containers usam a porta interna; o host usa a publicação de porta.
`localhost` dentro de um container refere-se ao próprio container. O diagnóstico
resolve o endereço em vez de fixar um IP que pode mudar.

Checkpoint: `feat: verifica rede interna entre containers`.
Entendimento da etapa 2.11: confirmado em 09/10/2026 com "entendi".
Módulo 2 concluído: ambiente PHP em Docker, Compose, arquivos de configuração,
montagens, dados persistentes, servidor, portas, logs e rede estudados.

## Etapa 3.1

Objetivo: começar o catálogo com uma classe de produto e um exemplo de uso,
explicando propriedades, tipos, construtor, objeto e visibilidade.

Implementação:

- `src/Produto.php`: nome privado `string`, preço privado `int` em centavos,
  construtor tipado e métodos públicos `getNome(): string` e
  `getPrecoEmCentavos(): int`.
- `src/exemplo-produto.php`: carrega a classe com `require_once` e `__DIR__`,
  cria `new Produto("Camiseta", 4990)` e imprime os dados pelos métodos.
- Ambos os arquivos usam `declare(strict_types=1)`. O exemplo aceita apenas
  execução pelo terminal.
- Aula salva em `docs/aulas/03-01-produto-tipado.md`; README e roteiro atualizados
  para refletir conclusão do módulo Docker e início do módulo 3.

Execução principal:

```bash
docker compose run --rm php php exemplo-produto.php
```

Resultados verificados:

- Saída `Produto: Camiseta` e `Preço em centavos: 4990`, com código 0.
- Em chamada estrita, preço como texto `"4990"` gerou `TypeError`.
- Acesso direto externo à propriedade privada `nome` gerou `Error`.
  As exceções esperadas foram capturadas na verificação de comportamento.
- Servidor HTTP da raiz permaneceu em 200; exemplo OOP recusou HTTP com 403.
- Containers temporários removidos; infraestrutura, configuração local e dados
  preservados. Não houve build ou instalação de bibliotecas.

Conceitos a confirmar: classe define estrutura; `new` cria o objeto;
`__construct` recebe seus dados; `$this` refere-se à instância atual; propriedades
privadas são consultadas por métodos públicos. Tipos escalares estritos dependem
do arquivo que faz a chamada. Ainda não há validações de nome vazio ou preço
negativo; o foco desta etapa é a estrutura da classe.

Checkpoint: `feat: inicia catalogo com classe Produto tipada`.
Entendimento da etapa 3.1: confirmado em 09/10/2026 com "entendi".

## Etapa 3.2

Objetivo: validar nome e preço no construtor e mostrar tratamento de exceções
de entrada no código que cria o produto.

Implementação:

- `src/Produto.php`: antes das atribuições, recusa `trim($nome) === ""` e
  `$precoEmCentavos < 0`, lançando `InvalidArgumentException` com mensagem.
- `src/exemplo-produto.php`: mantém o produto válido e demonstra uma tentativa
  de preço negativo em `try/catch`, imprimindo a mensagem por `getMessage()`.
- Aula salva em `docs/aulas/03-02-validacao-e-excecoes.md`; README atualizado
  e aula 3.1 identifica seu checkpoint histórico.

Execução principal:

```bash
docker compose run --rm php php exemplo-produto.php
```

Resultados verificados:

- Produto válido retornou nome e preço, e a tentativa de -100 centavos mostrou
  a mensagem de recusa; demonstração terminou com código 0.
- Uma verificação de seis cenários em PHP dentro do Docker confirmou: preço
  positivo e preço zero aceitos; nome vazio, só espaços e preço negativo
  recusados; dados de um nome válido com bordas preservados.
- As verificações detectariam aceitação indevida, recusa indevida ou alteração
  dos dados válidos. Nenhuma biblioteca foi instalada nesta etapa.
- Infraestrutura, `.env` e volume de dados preservados, sem build.

Conceitos a confirmar: tipos verificam formato, regras verificam valores;
`throw` interrompe o construtor e a exceção pode ser tratada pelo chamador.
`catch` trata o tipo específico; `getMessage()` mostra a mensagem. `trim`
é usado para validar, sem normalizar o valor armazenado.

Checkpoint: `feat: valida dados do produto no construtor`.
Entendimento da etapa 3.2: confirmado pelo aluno com "entendi" em 09/10/2026,
após o exemplo prático solicitado de `trim`. Explicamos remoção dos espaços nas
bordas, preservação dos espaços internos e que a variável original só muda se
receber o resultado. Checkpoint publicado: `ab9ea33`.

## Etapa 3.3

Objetivo: reduzir repetição na classe usando promoção de propriedades no
construtor, recurso disponível desde o PHP 8.0.

Implementação e explicação:

- `src/Produto.php`: os parâmetros agora são `private string $nome` e
  `private int $precoEmCentavos`. Removidas declarações e atribuições separadas.
- Validações e métodos públicos preservados; `src/exemplo-produto.php` inalterado.
- Explicada a ordem real: promoção atribui os argumentos antes do corpo do
  construtor. A versão anterior tinha atribuições explícitas após as validações.
  Uma exceção continua impedindo que `new` entregue a instância ao chamador.
- Aula salva em `docs/aulas/03-03-promocao-de-propriedades.md`; README atualizado
  e aula 3.2 identifica seu checkpoint histórico.

Verificação:

- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas da
  etapa anterior, com código 0.
- Oito verificações em PHP pelo Docker passaram: produto válido, preço zero,
  preservação de bordas no nome; recusa de nome vazio, nome só com espaços e
  preço negativo; `TypeError` para preço textual em chamada estrita e `Error`
  para acesso externo à propriedade privada.
- Código executado pelo bind mount, sem build ou novas dependências.
  Configuração local, servidor e volume de dados preservados.

Checkpoint: `refactor: promove propriedades do construtor de Produto`.
Entendimento da etapa 3.3: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `83f190b`.

## Etapa 3.4

Objetivo: organizar o nome da classe com namespace e explicar importação de
nomes com `use`, distinguindo-a do carregamento do arquivo.

Implementação e explicação:

- `src/Produto.php`: acrescentados `namespace Loja` depois de `declare` e
  `use InvalidArgumentException` para usar a exceção global nos `throw`.
- `src/exemplo-produto.php`: acrescentado `use Loja\Produto`. Continua usando
  o nome curto no `new` e carregando o mesmo arquivo por `require_once`.
- Nome completo agora é `Loja\Produto`; namespace não cria pasta ou move arquivo.
- Importações valem por arquivo. O exemplo permanece no namespace global,
  com seu `catch` apontando à mesma exceção.
- Aula salva em `docs/aulas/03-04-namespace-e-use.md`; README atualizado e
  aula 3.3 identifica seu checkpoint histórico.

Verificação:

- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas
  da demonstração, com código 0.
- `php -l` pelo Docker confirmou sintaxe dos dois arquivos.
- Oito verificações pelo Docker passaram: `use` não carrega a classe;
  `require_once` carrega; classe global não declarada; nome completo do objeto
  correto; criação pelo nome absoluto funciona; nome vazio, nome só com espaços
  e preço negativo lançam a exceção global esperada.
- Código executado pelo bind mount, sem build, dependências ou mudanças na
  infraestrutura e nos dados. Experiência enviada pela entrada padrão.

Checkpoint: `refactor: organiza Produto em namespace Loja`.
Entendimento da etapa 3.4: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `253617c`.

## Etapa 3.5

Objetivo: disponibilizar Composer na imagem PHP e verificar sua execução,
preparando o estudo de configuração de projeto e autoload.

Implementação e explicação:

- `Dockerfile`: adicionada a instrução
  `COPY --from=composer/composer:2.10.3-bin /composer /usr/local/bin/composer`.
- Versão 2.10.3 consultada na página oficial. Imagem de executável recomendada
  pela documentação; disponibilidade da tag confirmada no build.
- Explicados origem externa, arquivo de origem, destino no PATH e execução
  usando o PHP da nossa imagem. Base, WORKDIR, cópia do código e CMD mantidos.
- Composer instalado na imagem; nenhuma instalação no host ou de bibliotecas
  do projeto. Arquivos PHP e carregamento com `require_once` preservados.
- Aula salva em `docs/aulas/03-05-composer-no-docker.md`; README atualizado.

Verificação:

- `docker compose build php`: código 0, base PHP 8.4.26 e cópia concluídas.
- `docker compose run --rm php composer --version`: Composer 2.10.3 usando
  PHP 8.4.26, código 0.
- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas
  da demonstração, código 0.
- `docker compose up -d php`: serviço recriado e iniciado com sucesso.
- Inspeção confirmou que o container do servidor usa a imagem construída.
- HTTP 200 na porta 8001 e versão PHP 8.4.26 após recriação.
- Volumes e configuração local preservados. A instalação de bibliotecas
  e a geração do autoload ainda não foram realizadas nem verificadas.

Checkpoint: `build: adiciona Composer 2.10.3 a imagem PHP`.
Entendimento da etapa 3.5: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `5360ccb`.

## Etapa 3.6

Objetivo: criar a configuração do projeto Composer, declarar requisito de PHP
e explicar o mapeamento de classes por PSR-4.

Implementação e explicação:

- `src/composer.json`: nome `julesjrenck/curso-loja-fullstack`, descrição,
  tipo `project`, requisito PHP `^8.4` e prefixo PSR-4 `Loja\` para `./`.
- Explicados JSON, escape de barra invertida, faixa >=8.4.0 e <9.0.0, e caminho
  relativo à pasta do composer.json. PHP continua definido pela imagem.
- Pelo bind mount, o arquivo fica em `/app/composer.json`; a classe existente
  corresponde a `/app/Produto.php`. Configuração não gera ou ativa autoload.
- Arquivos PHP e carregamento por `require_once` preservados.
- Aula salva em `docs/aulas/03-06-composer-json.md`; README atualizado.

Verificação:

- `docker compose run --rm php composer validate`: arquivo válido, código 0.
  Único aviso: licença não declarada. Campo opcional ainda sem escolha;
  não foi usado `--strict`, que retornaria falha também por avisos.
- Leitura do JSON e resolução do prefixo confirmaram que `Loja\Produto`
  corresponde ao arquivo existente `src/Produto.php`.
- `src/vendor` e `src/composer.lock` continuam ausentes; não foram gerados
  arquivos ou instaladas bibliotecas.
- Sem build, mudança no servidor ou alterações em volumes e configuração local.
  Execução de autoload ainda não verificada, pois não foi gerado.

Checkpoint: `build: configura projeto Composer e mapeamento PSR-4`.
Entendimento da etapa 3.6: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `3e28669`.

## Etapa 3.7

Objetivo: preparar armazenamento gravável para os arquivos gerados pelo
Composer, preservando o código montado como somente leitura.

Implementação e explicação:

- Pasta local vazia `src/vendor` criada como ponto de montagem; regra `vendor/`
  do `.gitignore` confirmada. Pasta não versionada; README inclui `mkdir -p`
  na preparação de um novo clone.
- `compose.yaml`: adicionados montagem `vendor-php:/app/vendor` no serviço
  e volume nomeado `vendor-php` no bloco da raiz.
- `./src:/app:ro` e `dados-demo:/dados` mantidos.
- Explicados nomes, caminhos, blocos YAML e montagem gravável no caminho
  específico `/app/vendor` dentro do bind mount somente leitura.
- Aula salva em `docs/aulas/03-07-volume-vendor.md`; README atualizado.

Verificação:

- `docker compose config --quiet`: configuração válida.
- `docker compose up -d php`: volume `curso-loja-fullstack_vendor-php` criado
  e servidor recriado com sucesso; sem build.
- Inspeção confirmou `/app` somente leitura e `/app/vendor` gravável.
- Arquivo temporário com nome único gravado no volume, lido com o mesmo conteúdo
  em outro container após remoção do primeiro e removido ao final da verificação.
- Tentativa de gravação diretamente em `/app` recusada.
- Pasta local `src/vendor` permaneceu sem o arquivo gerado no volume.
- Hash do contador comparado antes e depois, sem alteração de conteúdo.
- HTTP 200 após aplicação. Verificações terminaram com código 0.
- Nenhuma biblioteca instalada ou autoload gerado. Exemplo mantém `require_once`
  direto de Produto.php; configuração local e dados anteriores preservados.

Checkpoint: `build: prepara volume gravavel para vendor do Composer`.
Entendimento da etapa 3.7: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `07db654`.

## Etapa 3.8

Objetivo: gerar o autoload a partir da configuração e utilizá-lo para carregar
Produto automaticamente quando o PHP precisar da classe.

Implementação e explicação:

- `docker compose run --rm php composer dump-autoload`: arquivos gerados no
  volume de `/app/vendor`, sem instalar bibliotecas ou criar lockfile.
- Estrutura inspecionada: autoload.php e oito arquivos dentro de composer.
  Aula apresenta o papel de todos, destacando entrada, inicialização,
  implementação do carregador, mapeamento PSR-4 e dados estáticos.
- Inspeção de `autoload_psr4.php` confirmou `Loja\` para o diretório base `/app`.
  `platform_check.php` gerado verifica mínimo PHP 8.4.0 nesta configuração.
- `src/exemplo-produto.php`: alterado somente o `require_once`, que agora
  carrega `__DIR__ . "/vendor/autoload.php"`, em vez de Produto.php.
- Explicados nome curto por `use`, registro do autoload e carga por demanda
  em `new`. Classe e restrição CLI preservadas.
- Aula salva em `docs/aulas/03-08-autoload-do-composer.md`; README inclui comando
  de geração na preparação do projeto e explicação do uso atual.

Verificação:

- Geração do autoload e exemplo do produto terminaram com código 0; saída
  da demonstração manteve as mesmas três linhas.
- Classe ausente antes do registro e imediatamente depois; `new` carregou
  automaticamente Loja\Produto e incluiu o arquivo esperado.
- Seis cenários de entrada mantiveram aceitação/recusa e dados válidos.
  Preço textual gerou TypeError e acesso privado externo gerou Error.
- HTTP principal 200; exemplo recusou HTTP com 403.
- Arquivos gerados ficaram no volume; pasta local `src/vendor` continuou vazia
  e `src/composer.lock` ausente. Sem build ou alteração no Compose.

Checkpoint: `feat: carrega Produto com autoload do Composer`.
Entendimento da etapa 3.8: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `af61127`.

## Etapa 3.9

Objetivo: representar opções de estado com um enum e distinguir um caso de sua
representação textual.

Implementação e explicação:

- `src/StatusProduto.php`: enum Loja\StatusProduto com valores string,
  casos Ativo = "ativo" e Inativo = "inativo".
- `src/exemplo-status-produto.php`: exemplo CLI com autoload, seleção do caso
  Ativo e impressão de `name` e `value`.
- Explicados enum, case, acesso com `::`, caso como valor do tipo StatusProduto
  e valor associado como string. Tipar um parâmetro exige um caso do enum.
- Arquivos seguem o namespace e o padrão CLI existentes. Produto e seu exemplo
  não foram alterados; nenhuma regra de transição implementada.
- Aula salva em `docs/aulas/03-09-enum-status-produto.md`; README atualizado.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Exemplo mostrou `Caso: Ativo` e `Valor: ativo`, código 0.
- Seis verificações pelo Docker passaram: enum ausente inicialmente, autoload
  existente encontra arquivo novo, caso diferente do texto, parâmetro tipado
  aceita Ativo e Inativo e recusa string "ativo" com TypeError.
- Função de verificação temporária enviada pela entrada padrão; não adicionada
  ao código da aplicação. O novo exemplo recusou HTTP com 403.
- Sem build, regeneração do autoload, instalação de dependências ou alteração
  no Compose. Configuração local e dados preservados.

Checkpoint: `feat: apresenta enum de estados de produto`.
Entendimento da etapa 3.9: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `377860a`.

## Etapa 3.10

Objetivo: exigir um caso de StatusProduto para o estado inicial do produto,
com Ativo como padrão e consulta pelo getter.

Implementação e explicação:

- `src/Produto.php`: terceiro parâmetro promovido privado
  `StatusProduto $status = StatusProduto::Ativo`; método `getStatus(): StatusProduto`.
- Nome curto do enum é resolvido no namespace Loja da classe. O getter retorna
  o caso; `->value` permite consultar sua representação textual.
- `src/exemplo-produto.php`: importação do enum, impressão do estado padrão
  da camiseta e criação da calça com Inativo explícito, exibindo seu estado.
- Explicados promoção, argumento opcional, ordem dos argumentos, retorno tipado
  e diferença entre omitir o argumento e passar string ou null.
- Validações de nome e preço, autoload e restrição CLI preservados.
- Aula salva em `docs/aulas/03-10-status-no-produto.md`; README atualizado e
  aula 3.9 identifica seu checkpoint histórico.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Exemplo mostrou seis linhas documentadas na aula, com código 0.
- Onze verificações passaram: padrão Ativo; Inativo explícito; Ativo e preço zero;
  dados válidos com bordas preservados; strings ativo/inativo e null recusados;
  nome vazio, só espaços e preço negativo recusados; alteração externa de status
  recusada sem mudar seu valor.
- Verificação enviada pela entrada padrão, sem arquivo de teste persistente.
- Sem build, regeneração do autoload, novas dependências ou mudança no Compose.
  Configuração local e volumes preservados.

Checkpoint: `feat: define estado inicial tipado de Produto`.
Entendimento da etapa 3.10: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `a0e1042`.

## Etapa 3.11

Objetivo: mudar o estado por ações públicas da classe, aprofundando
encapsulamento e estado de cada instância.

Implementação e explicação:

- `src/Produto.php`: métodos `ativar(): void` e `desativar(): void`, atribuindo
  respectivamente Ativo e Inativo a `$this->status`.
- `src/exemplo-produto.php`: desativa e ativa a camiseta, consulta os estados
  após as ações e mostra que a calça continua inativa.
- Explicados método público, acesso interno à propriedade privada, `$this`,
  ação sem resultado declarado por void e consulta posterior pelo getter.
- Repetir a ação mantém o estado escolhido. Cada instância mantém sua
  propriedade; atribuições não modificam os casos do enum.
- Construtor, regras de entrada, autoload e restrição CLI preservados.
- Aula salva em `docs/aulas/03-11-acoes-e-encapsulamento.md`; README atualizado
  e aula 3.10 identifica seu checkpoint histórico.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Demonstração mostrou nove linhas documentadas na aula, código 0.
- Oito verificações passaram: desativar, repetir desativação, ativar, repetir
  ativação, isolamento ao agir na camiseta, isolamento ao agir na calça,
  preservação de nomes/preços e recusa de alteração externa direta de status.
- Verificação enviada pela entrada padrão, sem arquivo de teste persistente.
- Sem build, regeneração do autoload, novas dependências ou mudança no Compose.
  Configuração local e volumes preservados.

Checkpoint: `feat: adiciona acoes de ativar e desativar Produto`.
Entendimento da etapa 3.11: confirmado pelo aluno com "entendi" em 12/10/2026.
Publicação verificada: `8d54d1a`, com HEAD e origin/main iguais antes deste registro.

Retomada em 12/10/2026:

- Nenhuma alteração de implementação. Reapresentados métodos públicos,
  acesso interno ao status privado, `$this`, retorno void e estado por instância.
- `docker compose ps -a` confirmou o servidor PHP ativo na porta local 8001.
- `docker compose run --rm php php exemplo-produto.php` executado novamente:
  as mesmas nove linhas da aula, com código 0. A camiseta foi desativada e
  ativada; a calça permaneceu inativa. A entrada de preço negativo foi recusada.
- Não foram repetidas nesta retomada as oito verificações de comportamento
  ou a verificação de sintaxe da implementação anterior.
- O pedido inicial para continuar não foi tratado como confirmação.
  Após a explicação, o aluno confirmou entendimento com "entendi".
- Código e aula já publicados; registro desta retomada e confirmação preparado
  para checkpoint `docs: confirma entendimento da etapa 3.11`.

Checkpoint do registro de confirmação: `0c2106b`, criado e verificado localmente.
O push foi inicialmente rejeitado pela revisão automática por exigir aprovação
explícita do destino público. Aprovação recebida em 12/10/2026: "Sim, autorizo os
checkpoints concluídos" para `main` de `julesjrenck/curso-loja-fullstack`.
Publicação de `0c2106b` confirmada no envio de `aa9642e..846ada2`; verificação
remota retornou `846ada2` após o push. A pendência de publicação foi resolvida.

## Etapa 3.12

Objetivo: definir um contrato de consulta de preço e fazer Produto implementá-lo,
demonstrando uma função com parâmetro tipado pela interface.

Implementação e explicação:

- `src/Precificavel.php`: interface no namespace Loja, com a declaração pública
  `getPrecoEmCentavos(): int`, sem corpo de método.
- `src/Produto.php`: declaração alterada para `class Produto implements Precificavel`.
  O método público existente já cumpre o contrato; nenhuma duplicação de lógica.
- Explicados interface, assinatura, ponto e vírgula, implements, implementação
  na classe e parâmetro tipado pela interface. Autoload PSR-4 existente utilizado.
- Experiência acompanhada: função temporária `consultarPreco(Precificavel $item): int`
  enviada pela entrada padrão. Produto aceito e seu método fornece 4990 centavos;
  objeto stdClass recusado com TypeError capturado. Nenhuma função de negócio
  ou novo arquivo de exemplo acrescentado à aplicação.
- Aula salva em `docs/aulas/03-12-interface-precificavel.md`; README atualizado.

Verificação:

- `php -l` executado via `docker compose exec -T php` passou para Precificavel.php
  e Produto.php.
- `docker compose run --rm php php exemplo-produto.php` mostrou as mesmas nove
  linhas da aula anterior, com código 0.
- Experiência via `docker compose run --rm -T php php`: preço retornado conferido
  como exatamente 4990; TypeError esperado para objeto sem contrato. Código 0.
- Sem build, regeneração do autoload, instalação de dependências ou mudança no
  Compose. Não executado o contador; configuração local e volumes preservados.
- `git diff --check` passou, sem problemas de espaços nas alterações rastreadas.

Entendimento da etapa 3.12: confirmado com "entendi" em 12/10/2026.
Checkpoint: `846ada2`, `feat: define contrato Precificavel para Produto`.
Publicação autorizada explicitamente e verificada, junto com `0c2106b`.
HEAD, origin/main e a consulta direta à main remota retornaram o mesmo SHA.
Nenhuma nova confirmação necessária para publicar futuros checkpoints
concluídos no mesmo destino autorizado.

## Etapa 3.13

Objetivo: representar um item do carrinho que contém um Produto e uma quantidade
positiva, estudando composição e o uso de métodos do objeto guardado.

Implementação e explicação:

- `src/ItemCarrinho.php`: classe Loja\ItemCarrinho com Produto e quantidade int
  privados promovidos no construtor; recusa quantidade menor que 1 com
  InvalidArgumentException. Getters getProduto(): Produto e getQuantidade(): int.
- Explicados composição, responsabilidades do produto e do item, relação entre
  objetos, promoção de propriedades, validação de valores e chamadas encadeadas.
- O item guarda o mesmo objeto Produto recebido; não clona. Uma alteração de
  estado feita no Produto pode ser observada pelo getter do item.
- Aula salva em `docs/aulas/03-13-composicao-item-carrinho.md`; README atualizado.
- Produto, Precificavel e os exemplos existentes não foram alterados nesta etapa.

Verificação:

- `docker compose exec -T php php -l ItemCarrinho.php`: sem erro de sintaxe.
- Experiência temporária pela entrada padrão de `docker compose run --rm -T php php`
  confirmou o mesmo Produto recebido e quantidade 3, quantidade mínima 1 aceita,
  quantidades 0 e -1 recusadas com a exceção esperada, e estado Inativo observado
  pelo item após desativar o Produto. Saída de sete linhas, código 0.
- O preço unitário continuou 4990 centavos e o nome consultado foi Camiseta.
  Não foi calculado subtotal.
- Sem build, regeneração de autoload, novas dependências ou alteração do Compose.
  Não executado o contador; configuração local e volumes preservados.

Entendimento da etapa 3.13: confirmado com "entendi" em 12/10/2026.
Esclarecimento em 12/10/2026: aluno pediu nova explicação e perguntou onde
ItemCarrinho é chamado. Naquele momento, nenhum script em src instanciava
ItemCarrinho. A chamada `new ItemCarrinho($produto, 3)` foi executada
somente na experiência temporária enviada ao PHP em Docker e está documentada
na aula. Reexplicados definição da classe, chamada de new, construtor automático,
argumentos guardados nas propriedades e getters que acessam o objeto Produto.
Não acrescentado novo código de aplicação no esclarecimento; após a explicação,
o aluno confirmou entendimento.
Checkpoint: `197470b`, `feat: representa item de carrinho por composicao`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `197470b1570cbfa02d736166566e5f796deb8cb4`.

## Etapa 3.14

Objetivo: calcular o subtotal de um item, multiplicando o preço unitário do
Produto composto pela quantidade, e salvar um exemplo executável em src.

Implementação e explicação:

- `src/ItemCarrinho.php`: acrescentado getSubtotalEmCentavos(): int, retornando
  `$this->produto->getPrecoEmCentavos() * $this->quantidade`.
- Explicados consulta ao objeto guardado, multiplicação, return, retorno inteiro
  e cálculo na chamada sem armazenar subtotal em outra propriedade.
- `src/exemplo-item-carrinho.php`: exemplo CLI persistente com autoload;
  cria Camiseta de 4990 centavos e ItemCarrinho com quantidade 3, imprime nome,
  preço unitário, quantidade e subtotal de 14970 centavos.
- A chamada de ItemCarrinho agora pode ser encontrada diretamente nesse script;
  as experiências da etapa anterior foram temporárias. Explicados use, restrição
  CLI, require_once, __DIR__, new, getters, concatenação e PHP_EOL.
- Aula salva em `docs/aulas/03-14-subtotal-item-carrinho.md`; README atualizado
  com o comando do novo exemplo.

Verificação:

- `php -l` via `docker compose exec -T php` passou para ItemCarrinho.php e
  exemplo-item-carrinho.php.
- `docker compose run --rm php php exemplo-item-carrinho.php`: quatro linhas
  esperadas, incluindo `Subtotal em centavos: 14970`, código 0.
- Verificação temporária em PHP via entrada padrão do Docker passou: 4990 x 1
  resulta 4990, 4990 x 3 resulta 14970 e 0 x 3 resulta 0. Conferida também a
  preservação do preço do produto e da quantidade do item em cada cenário.
- HTTP do novo exemplo retornou 403, conforme a restrição CLI existente.
- Sem build, regeneração do autoload, dependências novas ou mudança no Compose.
  Contador não executado; configuração local e volumes preservados.

Entendimento da etapa 3.14: confirmado com "entendi" em 12/10/2026.
Checkpoint: `b45dc75`, `feat: calcula subtotal do item do carrinho`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `b45dc7509c945d5974d6768876c464534f6d4878`.

## Etapa 3.15

Objetivo: apresentar testes automatizados e verificar os requisitos de PHPUnit
no PHP do container antes de instalar a ferramenta.

Implementação e explicação:

- Nenhuma alteração de código ou Dockerfile necessária: PHP e extensões
  carregadas já atendem aos requisitos consultados.
- Explicados teste como entrada/operação/resultado esperado repetíveis,
  papel de PHPUnit, extensão do PHP e dependência do Composer.
- Documentação oficial consultada: série PHPUnit 13 compatível com PHP 8.4;
  composer.json da versão 13.3.2 exige PHP >= 8.4.1 e extensões dom, filter,
  json, libxml, mbstring e xmlwriter. Versão consultada para o diagnóstico;
  revisar a versão exata e fixar pelo lockfile quando instalar.
- Aula salva em `docs/aulas/03-15-requisitos-phpunit.md`; README atualizado.
- PHPUnit ainda não instalado; nenhum teste PHPUnit criado.

Verificação:

- `docker compose exec -T php php --version`: PHP 8.4.26 CLI.
- `docker compose exec -T php php -m`: seis extensões requeridas carregadas;
  xml e tokenizer também disponíveis.
- Verificação temporária via entrada padrão do Docker: version_compare confirmou
  requisito >= 8.4.1, extension_loaded confirmou oito módulos e is_file confirmou
  ausência de /app/vendor/bin/phpunit. Dez linhas de diagnóstico, código 0.
- Essa verificação demonstra requisitos do PHP consultados; instalação e
  funcionamento real da ferramenta ainda serão verificados na próxima etapa.
- Sem build, novas dependências, regeneração de autoload ou mudanças no Compose,
  código PHP, configuração local ou volumes. Contador não executado.

Entendimento da etapa 3.15: confirmado com "entendi" em 12/10/2026.
Checkpoint: `3dba56d`, `docs: verifica requisitos de PHPUnit no Docker`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `3dba56d1d161f9de05e98273950fc785dc1089b8`.

## Etapa 3.16

Objetivo: instalar PHPUnit como dependência de desenvolvimento pelo Composer
em Docker, registrar versões exatas e verificar a execução da ferramenta.

Implementação e explicação:

- `src/composer.json`: require-dev com phpunit/phpunit na faixa ^13.4;
  requisitos do projeto e autoload de Loja preservados.
- `src/composer.lock`: gerado pelo Composer, com PHPUnit 13.4.1 e 26 pacotes
  auxiliares em packages-dev. packages vazio; plataforma PHP ^8.4.
- Versão 13.4.1 consultada no Packagist e requisitos confirmados no composer.json
  oficial da tag: PHP >= 8.4.1 e as mesmas extensões diretas já verificadas.
- `Dockerfile`: RUN instala unzip=6.0-28+deb12u1 pelo apt do Debian Bookworm e
  limpa índices de pacotes. PHP 8.4.26 e Composer 2.10.3 preservados.
- A primeira resolução gerou JSON/lock, mas a instalação parou por ausência de
  zip ou unzip/7z. Após acrescentar unzip e construir a imagem, composer install
  concluiu usando as versões do lockfile, sem refazer a escolha de versões.
- Neste ambiente, volumes adicionais de run em /app mantiveram a montagem ro,
  mesmo com :rw explícito. Diagnóstico confirmou /app ro e /instalacao rw.
  Instalamos com src montado em /instalacao:rw, o volume vendor existente em
  /instalacao/vendor e --workdir /instalacao. Compose não foi alterado.
- Proprietário do novo lockfile alinhado ao de composer.json com chown --reference
  no container temporário; ambos ficaram 1000:1000 e modo 644 no host.
- Pacotes, vendor/bin/phpunit e arquivos regenerados de autoload ficam no volume.
  Explicados os campos do lockfile e os arquivos de metadados em vendor/composer,
  sem percorrer o código das bibliotecas externas.
- Aula salva em `docs/aulas/03-16-instalacao-phpunit.md`; README inclui instalação
  por lockfile na preparação de clones e comando de versão do PHPUnit.

Verificação:

- Montagem gravável e mesmo autoload acessível pelos dois caminhos confirmados
  antes da instalação. A montagem normal do serviço continua /app ro e vendor rw.
- `docker compose build php`: sucesso, unzip fixado instalado. `up -d php`
  aplicou a imagem nova; containers temporários removidos e servidor ativo.
- `composer install`: 27 pacotes instalados e autoload regenerado, código 0.
- `php vendor/bin/phpunit --version`: PHPUnit 13.4.1, código 0.
- `composer check-platform-reqs`: PHP e oito extensões reais dos pacotes passaram.
- `composer validate`: JSON e lockfile válidos, código 0; aviso de licença ausente
  permanece. Nenhuma licença escolhida nesta aula.
- `composer audit --locked --no-interaction`: nenhum aviso de vulnerabilidade
  conhecida encontrado, código 0.
- Exemplo do subtotal manteve quatro linhas e 14970 centavos, código 0.
  HTTP principal 200; exemplo CLI retornou 403.
- vendor e .env continuam ignorados; lockfile permitido para versionamento.
  Contador não executado; configuração local e volumes preservados.

Entendimento da etapa 3.16: confirmado com "entendi" em 12/10/2026.
Checkpoint: `9a9c43a`, `build: instala PHPUnit com dependencias fixadas`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9a9c43a5dce5696ab5230ba8626a761763fdb940`.

## Etapa 3.17

Objetivo: salvar um primeiro teste PHPUnit da regra de subtotal, conhecendo
TestCase, herança, método de teste, asserção e carregamento pelo bootstrap.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: classe global ItemCarrinhoTest extends TestCase,
  com importações de Loja\Produto, Loja\ItemCarrinho e PHPUnit\Framework\TestCase.
- Método público testCalculaSubtotalParaTresUnidades(): void cria Produto de
  4990 centavos e ItemCarrinho com quantidade 3, consulta subtotal e confere
  o inteiro 14970 com `$this->assertSame(14970, $subtotal)`.
- Explicados herança por extends, recursos da classe base TestCase, reconhecimento
  do prefixo test, `$this` como instância de teste, argumentos esperado/obtido,
  comparação de valor e tipo e preparação/execução/conferência do cenário.
- PHPUnit carrega o arquivo e executa o método; não há instanciação manual
  de ItemCarrinhoTest no exemplo da loja. Bootstrap registra o autoload.
- Aula salva em `docs/aulas/03-17-primeiro-teste-phpunit.md`; README inclui o comando.
- Produto, ItemCarrinho, Compose, Dockerfile e arquivos do Composer preservados.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- `docker compose run --rm php php vendor/bin/phpunit --bootstrap vendor/autoload.php
  tests/ItemCarrinhoTest.php`: PHPUnit 13.4.1, PHP 8.4.26,
  `OK (1 test, 1 assertion)`, código 0.
- O teste confirma o cenário de três unidades e retorno inteiro 14970; ainda
  não cobre os demais cenários ou expectativas de exceção.
- Execução com montagem normal somente leitura, sem build ou novas dependências.
  Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.17: confirmado com "entendi" em 12/10/2026.
Checkpoint: `071aacd`, `test: verifica subtotal de tres unidades com PHPUnit`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `071aacd00da4180bd8ec1a210708b91577c79ecf`.

## Etapa 3.18

Objetivo: testar que quantidade zero é recusada com InvalidArgumentException,
conhecendo expectativa de exceção e a obtenção de nomes de classes com ::class.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testRecusaQuantidadeZero(): void.
  Cria Produto válido, configura expectException(InvalidArgumentException::class)
  e tenta construir ItemCarrinho com quantidade 0.
- Explicados expectException como configuração do tipo esperado, ::class como
  nome de classe em string e ordem preparar/esperar/executar. Produto válido
  criado antes da expectativa para evitar confusão com suas validações.
- A expectativa é configurada antes da construção, pois uma exceção interrompe
  a execução normal. O construtor de ItemCarrinho lança a exceção existente;
  PHPUnit recebe e confere o tipo. O teste não passa se ela faltar ou for incompatível.
- Teste de subtotal preservado; Produto e ItemCarrinho não foram alterados.
- Aula salva em `docs/aulas/03-18-teste-quantidade-zero.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (2 tests, 2 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotal inteiro 14970 para três unidades e tipo da exceção na
  recusa de quantidade 0. Quantidade negativa ainda sem teste PHPUnit próprio.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.18: confirmado com "entendi" em 12/10/2026.
Checkpoint: `9d6ceb0`, `test: verifica recusa de quantidade zero`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9d6ceb0fbb7f669203ed6bad2d91789201b11c13`.

## Etapa 3.19

Objetivo: verificar a recusa de uma quantidade negativa e explicar por que
o teste de zero, sozinho, não verifica essa entrada distinta.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testRecusaQuantidadeNegativa(): void.
  Cria Produto válido, configura expectException(InvalidArgumentException::class)
  e tenta construir ItemCarrinho com quantidade -1.
- Reutilizada a ordem preparar/esperar/executar da aula anterior. Explicado que
  -1 é int, mas viola a regra de quantidade positiva do construtor.
- Comparação didática: uma condição `$quantidade === 0` recusaria zero e
  aceitaria -1; o novo teste detectaria essa aceitação indevida. A regra real
  `$quantidade < 1` permaneceu inalterada.
- Testes anteriores preservados. Produto e ItemCarrinho não foram alterados.
- Aula salva em `docs/aulas/03-19-teste-quantidade-negativa.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (3 tests, 3 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotal inteiro 14970 para três unidades e exceções esperadas nas
  tentativas de quantidade 0 e -1. Quantidade mínima 1 ainda sem teste PHPUnit próprio.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.19: confirmado com "entendi" em 12/10/2026.
Checkpoint: `188ff33`, `test: verifica recusa de quantidade negativa`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `188ff3341e1b0abdf63a008f066810cc28852562`.

## Etapa 3.20

Objetivo: verificar que a menor quantidade válida, 1, é aceita e produz o
subtotal correspondente ao preço de uma unidade.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testCalculaSubtotalParaUmaUnidade(): void.
  Cria Produto de 4990 centavos e item de quantidade 1, consulta subtotal e
  confere o inteiro 4990 com assertSame.
- Reutilizada a sequência preparar/executar/conferir. Explicado que uma exceção
  inesperada na construção também impediria a aprovação do teste.
- Explicada a condição real < 1: quantidade 1 deve ser aceita. Comparação didática
  com <= 1 mostrou uma recusa indevida que os três testes anteriores não detectariam.
- Produto e ItemCarrinho não foram alterados; testes anteriores preservados.
- Aula salva em `docs/aulas/03-20-teste-quantidade-minima.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (4 tests, 4 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotais inteiros de 4990 para uma unidade e 14970 para três,
  além das exceções esperadas para quantidades 0 e -1.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.20: confirmado com "entendi" em 12/10/2026.
Checkpoint: `95630cd`, `test: verifica subtotal da menor quantidade valida`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `95630cdea45c1885a277b833ae26a0cca32cafac`.

## Etapa 3.21

Objetivo: verificar preço zero como limite válido de Produto e subtotal inteiro
zero para um item com esse produto e quantidade positiva.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testCalculaSubtotalParaProdutoGratuito(): void.
  Cria Produto Brinde de preço 0 e item de quantidade 3, consulta subtotal e
  confere o inteiro 0 com assertSame.
- Reutilizada a sequência preparar/executar/conferir. Explicadas as regras
  próprias de cada campo: preço mínimo 0, quantidade mínima 1.
- Explicada a validação real de preço < 0, que permite zero. Uma condição
  <= 0 recusaria esse limite válido; os quatro testes anteriores usam preço 4990
  e não detectariam essa recusa. Comparação didática, sem alterar a classe.
- Produto e ItemCarrinho não foram alterados; quatro testes anteriores preservados.
- Aula salva em `docs/aulas/03-21-teste-preco-zero.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (5 tests, 5 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotais inteiros de 4990 para uma unidade e 14970 para três,
  subtotal inteiro 0 para produto gratuito de quantidade 3 e exceções para
  quantidades 0 e -1.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.21: confirmado com "entendi" em 12/10/2026.
Checkpoint: `a5caa53`, `test: verifica subtotal de produto gratuito`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `a5caa5380ea88a83de3f48655c7e8aed926929ff`.

## Etapa 3.22

Objetivo: relacionar os conceitos de PHP moderno e OOP já estudados, revisar
o fluxo das classes e confirmar entendimento antes de concluir o módulo 3.

Implementação e explicação:

- Apenas documentação: `docs/aulas/03-22-revisao-modulo-3.md`, com mapa das relações,
  arquivos, conceitos, demonstração e cenários dos testes; README atualizado.
- Retomados tipos e regras de valor, propriedades privadas, construtor e promoção,
  getters, `$this`, ações void e enum de estado.
- Relacionados Produto implements Precificavel, composição de ItemCarrinho com
  Produto e herança de ItemCarrinhoTest por extends TestCase.
- Retomados namespaces/use, mapeamento PSR-4, autoload, require-dev, lockfile e
  arquivos gerados no volume vendor.
- Revisados assertSame, expectException, ::class, bootstrap e os cinco cenários
  salvos de subtotal e recusa de quantidades inválidas.
- Código PHP, testes, dependências, Compose e Dockerfile permaneceram iguais.

Verificação:

- Demonstração temporária via entrada padrão de `docker compose run --rm -T php php`:
  cria camiseta de 4990 centavos e item de quantidade 3; mostra subtotal 14970,
  desativa Produto e consulta estado inativo pelo item. Duas linhas, código 0.
- A demonstração confirma o uso do mesmo Produto guardado pelo item e retoma
  cálculo, encapsulamento, enum e autoload existentes, sem criar novo exemplo em src.
- Última execução dos testes na 3.21: `OK (5 tests, 5 assertions)`, código 0.
  Não repetida nesta revisão, que não alterou código ou dependências.
- Sem build, nova instalação ou execução do contador. Configuração local e
  volumes preservados.

Entendimento da revisão 3.22: confirmado com "entendi" em 12/10/2026.
Módulo 3 concluído quanto ao entendimento, com os conceitos revisados e cinco
testes PHPUnit já verificados.
Checkpoint: `7a4dc00`, `docs: conclui modulo PHP moderno e OOP`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `7a4dc008fc4418059d7057d913cea9a9336ee612`.

## Etapa 4.1

Objetivo: apresentar o papel do Laravel, conferir requisitos no Docker e definir
a organização do backend antes de gerar o projeto.

Implementação e explicação:

- Apenas documentação: `docs/aulas/04-01-preparacao-laravel.md`; README e roteiro
  atualizados para módulo 3 concluído e módulo 4 iniciado.
- Apresentados os papéis de PHP, Composer, Laravel e Docker. Laravel oferece
  classes e convenções para a aplicação web; rotas/controllers e outros recursos
  serão aprofundados quando seus arquivos forem introduzidos.
- Pasta definida: backend para Laravel; src preservado como laboratório PHP.
  O backend terá Composer e dependências próprios, com armazenamento separado
  do volume vendor-php do laboratório quando suas dependências forem instaladas.
- Requisitos oficiais consultados: Laravel 13 exige PHP >= 8.3, com PHP 8.4
  suportado, e treze extensões. Escolha PHP 8.4 do curso mantida.
- Framework declara composer-runtime-api ^2.2; a plataforma do Composer foi
  consultada para confirmar compatibilidade. Laravel ainda não instalado.

Verificação:

- `docker compose exec -T php php --version`: PHP 8.4.26 CLI.
- `docker compose exec -T php composer --version`: Composer 2.10.3.
- Diagnóstico PHP pela entrada padrão confirmou versão >= 8.3 e carregamento
  de ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO,
  session, tokenizer e xml. Treze módulos e diagnóstico atendido, código 0.
- `composer show --platform composer-runtime-api`: 2.2.2, compatível com ^2.2.
- `test ! -e backend`: código 0; caminho disponível, sem criar pasta nesta etapa.
- `composer create-project --help` confirmou --no-install e --no-scripts.
  O modelo oficial possui scripts de geração de .env, chave e SQLite; suas ações
  serão adiadas e explicadas, preservando a decisão SQL Server do curso.
- Sem mudança em código, Dockerfile ou Compose, build, instalação de pacotes
  ou execução do contador. Configuração local e volumes preservados.
- O diagnóstico cobre os requisitos PHP consultados; dependências completas
  serão resolvidas e verificadas quando forem instaladas no backend.

Entendimento da etapa 4.1: confirmado com "entendi" em 13/10/2026.
Checkpoint: `9807e53`, `docs: prepara ambiente para Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9807e53416d5b45e3f903edf36aa2f3ff8381111`.

## Etapa 4.2

Objetivo: obter o esqueleto oficial de Laravel em backend e apresentar a
estrutura antes de instalar dependências ou executar a aplicação.

Implementação e explicação:

- Esqueleto laravel/laravel v13.11.0, versão consultada no Packagist e tag oficial,
  obtido com create-project, --no-install e --no-scripts, no Docker existente.
- backend ausente antes da operação; mkdir preparou o ponto de montagem local.
  Apenas backend montado em /projeto/backend:rw; --workdir /projeto, destino backend.
- Comando terminou com código 0 e gerou 58 arquivos. Antes do commit, removidos
  somente espaços no fim de três linhas vazias do template welcome.blade.php,
  apontados por git diff --cached --check; comportamento preservado.
  Proprietários alinhados à pasta backend com chown -R --reference;
  backend e composer.json verificados como 1000:1000 no host.
- Apresentados grupos app, bootstrap, config, database, public, resources, routes,
  storage e tests, arquivos de configuração e modelos gerados na raiz.
- Explicados os pontos de entrada public/index.php e artisan, autoload seguido de
  bootstrap/app.php, configuração de rotas e vínculo de / à view welcome.
- JSON declara framework ^13.17 e App\\ para app/; template v13.11.0 e biblioteca
  framework são pacotes diferentes. Dependências ainda não resolvidas/instaladas;
  lockfile será gerado posteriormente. Laboratório src continua independente.
- backend/AGENTS.md e CLAUDE.md lidos: recomendam instalação de runtime no host
  e Laravel Boost. As instruções do aluno e curso prevalecem (PHP 8.4 em Docker,
  dependências somente na etapa necessária); não foram executadas essas recomendações.
  Arquivos do modelo preservados. Não instalar Boost automaticamente em retomadas.
- Aula salva em `docs/aulas/04-02-esqueleto-laravel.md`; README atualizado.

Verificação:

- composer validate --no-check-lock no backend: configuração válida, código 0.
- php -l no Docker passou para artisan, public/index.php, bootstrap/app.php
  e routes/web.php. Sintaxe conferida sem executar o Laravel.
- Diagnóstico PHP confirmou pacote laravel/laravel, framework declarado ^13.17,
  mapeamento App\\ para app/ e inventário de 58 arquivos.
- .env, vendor, composer.lock, node_modules e database/database.sqlite ausentes,
  comprovando os artefatos adiados. Nenhuma migration ou teste Laravel executado.
- Git ignora ambiente local, dependências e SQLite; permite .env.example e código.
- git diff --exit-code -- src Dockerfile compose.yaml: sem alteração do laboratório
  ou infraestrutura. Sem build, novo serviço ou execução do contador.

Entendimento da etapa 4.2: confirmado com "entendi" em 13/10/2026.
Checkpoint: `cfa2e69`, `build: adiciona esqueleto oficial do backend Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `cfa2e69a9f24d6c0417406f340f02a3a079d827b`.
Pendências antes de usar banco/testes de integração: ajustar os padrões SQLite
do modelo conforme SQL Server e banco exclusivo de testes, quando introduzidos.
Próximo passo após confirmação: 4.3, preparar serviço backend no Compose para
comandos PHP/Composer, com ./backend:/app:ro e volume vendor-backend separado
em /app/vendor. Criar backend/vendor como ponto de montagem e conferir código
somente leitura e volume gravável. Dependências em etapa seguinte; não executar
Laravel, instalar Boost, adicionar banco ou frontend antecipadamente.

## Etapa 4.3

Objetivo: preparar o serviço Docker do backend com PHP/Composer e dependências
separadas das do laboratório, antes de instalar os pacotes Laravel.

Implementação e explicação:

- compose.yaml recebeu serviço backend: build da raiz, command php --version,
  bind mount ./backend:/app:ro e volume vendor-backend:/app/vendor gravável.
- Volume vendor-backend declarado na raiz; serviço php e seus volumes preservados.
- mkdir -p backend/vendor preparou ponto de montagem vazio, ignorado pelo Git.
- Dockerfile e .dockerignore preservados. Imagem reutiliza PHP 8.4.26, Composer
  2.10.3 e unzip; montagem sobre /app cobre a cópia src presente na imagem.
- Explicados caminhos local/container, WORKDIR /app, comando padrão e substituição
  por run, declaração/montagem de volumes e persistência após remoção do container.
- Aula em docs/aulas/04-03-servico-backend-e-vendor.md e README atualizados.

Verificação:

- docker compose config --quiet: válido, código 0. Build backend concluído.
- docker compose run --rm backend: PHP 8.4.26, término normal, container removido.
- docker compose run --rm backend composer --version: Composer 2.10.3/PHP 8.4.26.
- Diagnóstico PHP temporário: getcwd /app e manifesto laravel/laravel; /proc/mounts
  confirmou ro em /app e rw em /app/vendor; is_writable confirmou as permissões.
- Volume estava vazio. Marcador criado exclusivamente com fopen em modo x;
  gravação conferida, primeiro container terminou e foi removido.
- Segundo container leu o texto exato, comprovando persistência; unlink removeu
  somente o marcador e scandir comprovou que o volume voltou a ficar vazio.
- docker volume inspect confirmou curso-loja-fullstack_vendor-backend. Compose ps
  mostrou apenas o servidor php do laboratório ativo; backend é temporário.
- backend/vendor local vazio e ignorado; backend/.env e composer.lock ausentes.
  Sem instalação de pacotes, Artisan, migrations, testes Laravel ou contador.

Entendimento da etapa 4.3: confirmado com "entendi" em 13/10/2026.
Checkpoint: dc9f4b8, `build: prepara serviço Docker e vendor do backend`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `dc9f4b88786196896d229fd5785c698d2e8253f8`.
Próximo passo exato: após confirmação, publicar 4.3 e iniciar 4.4, instalação de
dependências de execução com Composer em Docker, sem scripts automáticos e sem
instalar ferramentas de desenvolvimento nesta etapa. Gerar composer.lock usando
uma montagem temporária gravável do backend e o mesmo volume vendor-backend;
apresentar pacotes/autoload e verificar requisitos. SQL Server e testes de
integração permanecem pendentes antes de qualquer uso dos padrões SQLite gerados.

## Etapa 4.4

Objetivo: instalar dependências de execução do backend e verificar lockfile e
autoload pelo Docker antes de inicializar o Laravel.

Implementação e explicação:

- Composer install pelo serviço backend, --no-dev, --no-scripts, --no-interaction
  e --no-progress. Sem lock anterior, resolveu versões e gerou backend/composer.lock.
- Montagem temporária ./backend:/instalacao:rw e workdir /instalacao permitiram
  escrever o lockfile; o volume existente curso-loja-fullstack_vendor-backend
  também montado em /instalacao/vendor recebeu pacotes e carregador.
- 109 pacotes resolvidos: 76 em packages, 33 em packages-dev. Somente os 76 de
  execução instalados. Laravel v13.35.0 e Tinker v3.0.2, compatíveis com as faixas
  ^13.17 e ^3.0. JSON, Compose e Dockerfile preservados.
- Autoload otimizado gerado conforme config do JSON. Scripts automáticos
  desativados; ambiente, descoberta Artisan e execução Laravel permanecem adiados.
- Lockfile inicialmente 0:0, alinhado ao JSON por chown --reference apenas
  nesse arquivo, via Docker e alias gravável; stat confirmou 1000:1000.
- Explicados requisitos versus versões exatas, install/update, packages e
  packages-dev, dependências transitivas, content-hash e arquivos do autoload.
- Aula em docs/aulas/04-04-dependencias-laravel.md e README atualizados.

Verificação:

- Instalação terminou com código 0 e geração do autoload.
- composer validate --strict: JSON e lock coerentes, código 0.
- composer check-platform-reqs --no-dev: PHP 8.4.26, runtime API e requisitos
  listados com success, inclusive os satisfeitos por polyfills declarados.
- PHP temporário no caminho normal /app comparou todos os pares nome/versão:
  packages do lock iguais aos 76 pacotes de vendor/composer/installed.json;
  instalação marcada como dev=false.
- require vendor/autoload.php e class_exists carregaram Illuminate\\Foundation\\Application
  e App\\Http\\Controllers\\Controller; Application::VERSION 13.35.0.
- Mapeamento App\\ presente e Tests\\ ausente; PHPUnit, Pint e Boost ausentes
  no backend, conforme os pacotes adiados. Laboratório src preservado.
- backend/vendor local vazio e ignorado; backend/.env, database.sqlite, node_modules,
  bootstrap/cache/packages.php e services.php ausentes, conforme ações adiadas.
- Sem Artisan, migrations, testes Laravel, servidor Laravel, banco ou contador.
  Verificação comprova instalação/autoload, não ciclo de requisição ou persistência.

Entendimento da etapa 4.4: confirmado com "entendi" em 13/10/2026.
Checkpoint: 4c6df27, `build: instala dependências de execução do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `4c6df27b1e6ec4f04c64c55bc6fa10df2f5c8e84`.
Próximo passo exato: após confirmação, publicar 4.4 e iniciar 4.5, preparar
montagens graváveis para storage e bootstrap/cache no serviço backend, mantendo
o restante do código somente leitura. Necessidade de gravação consultada na
documentação oficial do Laravel. Não inicializar aplicação antes de preparar
esse armazenamento; ambiente Laravel, chave e Artisan serão etapas posteriores.
Padrões SQLite do modelo continuam pendentes de ajuste antes de banco ou testes
de integração; usar SQL Server exclusivo para testes conforme o roteiro.

## Etapa 4.5

Objetivo: preparar os diretórios graváveis exigidos pelo Laravel, preservando
o código somente leitura antes de executar a aplicação.

Implementação e explicação:

- compose.yaml recebeu duas montagens no serviço backend:
  ./backend/storage:/app/storage:rw e
  ./backend/bootstrap/cache:/app/bootstrap/cache:rw.
- Bind mounts usam pastas já presentes no esqueleto; arquivos gerados aparecem
  no host. Sem novos volumes nomeados, pacotes, pastas ou rebuild da imagem.
- Montagem ./backend:/app:ro e volume vendor-backend preservados, assim como
  o serviço php do laboratório, seu vendor e os dados da demonstração.
- Explicados ro/rw, origem e destino, montagens mais específicas dentro de /app,
  funções de storage e bootstrap/cache e exclusões existentes do Git.
- Documentação oficial do Laravel confirma a necessidade de escrita nessas
  duas pastas. Aula em docs/aulas/04-05-pastas-gravaveis-laravel.md; README atualizado.

Verificação:

- docker compose config --quiet: válido, código 0.
- PHP temporário via run --rm -T: /proc/mounts confirmou ro em /app e rw nas
  duas pastas novas. is_writable confirmou código app/config/bootstrap sem
  escrita e storage, subpastas da estrutura e bootstrap/cache graváveis.
- Marcadores exclusivos criados com fopen em modo x em storage/framework/views
  e bootstrap/cache, com quantidade de bytes conferida. Autoload anterior disponível.
- Primeiro container terminou e foi removido; cat no host confirmou o texto
  exato dos dois arquivos, demonstrando a ligação às pastas locais.
- Segundo container leu o conteúdo e removeu somente os dois marcadores com
  unlink. Host confirmou a remoção; git check-ignore confirmou exclusão dos arquivos.
- git diff --exit-code -- backend src Dockerfile .dockerignore: sem alterações.
  Lockfile e bibliotecas anteriores preservados. Apenas Compose alterado na aplicação.
- backend/.env, SQLite e bootstrap/cache/packages.php e services.php ausentes.
- Compose ps mostrou apenas php ativo. Sem Artisan, migrations, testes Laravel,
  novo servidor, banco, frontend ou execução do contador.

Entendimento da etapa 4.5: confirmado com "entendi" em 13/10/2026.
Checkpoint: 7c0fcea, `build: prepara pastas graváveis do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `7c0fcea3b613cb55a29923237281a4b0fd57b91c`.
Próximo passo exato: após confirmação, publicar 4.5 e iniciar 4.6, apresentar
backend/.env.example e preparar backend/.env local para rotas iniciais sem banco,
com sessão/cache em arquivo e fila síncrona. Indicação de banco conforme SQL Server,
sem provisionar banco ou executar migrations. Artisan e geração da chave em
etapas posteriores. Não versionar ambiente local ou credenciais; testes de
integração usarão SQL Server exclusivo quando introduzidos.

## Etapa 4.6

Objetivo: preparar ambiente local Laravel para as primeiras rotas sem depender
de banco, antes de apresentar Artisan e gerar a chave.

Implementação e explicação:

- backend/.env.example: APP_NAME="Loja Fullstack", APP_URL planejada em
  http://127.0.0.1:8002, DB_CONNECTION=sqlsrv, SESSION_DRIVER=file,
  CACHE_STORE=file e QUEUE_CONNECTION=sync. APP_ENV=local e APP_DEBUG=true mantidos.
- APP_KEY mantida vazia. Campos de banco comentados, sem credenciais reais;
  indicação de porta 1433 comentada. Sem provisionar SQL Server ou instalar drivers.
- backend/.env ausente antes da cópia; cp --update=none criou o ambiente local
  preservando destinos existentes. chmod 600; stat confirmou 600 e 1000:1000.
- Explicados modelo versus cópia local, .env do Compose versus .env do backend,
  comentários, aspas, valores tratados por env() e relação com config/*.php.
- Sessão/cache em arquivos usam storage da 4.5; tarefas configuradas como sync.
  Demais grupos do modelo preservados e aprofundados somente quando utilizados.
- Aula em docs/aulas/04-06-ambiente-local-laravel.md e README atualizados.

Verificação:

- PHP temporário no serviço backend carregou autoload e Dotenv da pasta /app,
  sem inicializar Laravel. env() confirmou oito valores esperados e debug true
  booleano; APP_KEY vazia. Sem imprimir dados privados do ambiente.
- Hashes do modelo e cópia local iguais; campos DB_* comentados não carregados.
- Pastas de sessões, cache/data e cache/locks existentes e graváveis.
- git check-ignore confirmou backend/.env ignorado; git ls-files sem esse arquivo.
- Compose válido; src, Compose, Dockerfile, JSON e lockfile do backend sem mudança.
- Sem SQLite ou manifests de inicialização/cache, execução de Artisan, migrations,
  testes Laravel, novo servidor ou contador. Sem banco ou frontend adicionados.
- A verificação cobre leitura do ambiente, não requisições Laravel ou conexão SQL.
  APP_URL define endereço planejado; a porta 8002 ainda não foi publicada.

Entendimento da etapa 4.6: confirmado com "entendi" em 13/10/2026.
Checkpoint: ae521c9, `build: prepara ambiente local do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `ae521c9ea4344cc408201875b454eae9b5a03f19`. .env fora do commit.
Próximo passo exato: após confirmação, publicar 4.6 e iniciar 4.7, apresentar
Artisan, verificar versão e gerar APP_KEY local, sem exibir a chave. Montar
temporariamente apenas backend/.env com escrita em /app/.env e conferir se há
chave existente antes de gerar. Explicar manifests/cache que surgirem na execução.
Modelo de ambiente já indica SQL Server. Fallback SQLite em config/database.php
e configuração SQLite no phpunit.xml ainda originais: ajustar antes de uso de
persistência ou testes de integração, mantendo banco SQL Server exclusivo de testes.

## Etapa 4.7

Objetivo: apresentar Artisan e gerar a chave local da aplicação, preservando
ambientes existentes e sem exibir o valor secreto.

Implementação e explicação:

- php artisan --version e help key:generate executados pelo serviço backend.
  Explicado arquivo artisan: autoload, bootstrap/app.php, ArgvInput, handleCommand
  e código de saída. Primeira execução Laravel pelo console no curso.
- PHP temporário conferiu APP_KEY vazia antes de chamar key:generate --no-interaction.
  Montagem adicional apenas de backend/.env:/app/.env:rw; código somente leitura.
  Guarda preserva uma chave existente. Nesta execução, chave vazia foi gerada.
- APP_KEY gravada somente no .env local; modelo continua vazio. Demais opções
  preservadas; modo 600 e proprietário/grupo 1000:1000 mantidos.
- Manifests bootstrap/cache/packages.php e services.php gerados pela inicialização,
  apresentados como arrays de pacotes/provedores/serviços. Fora do Git.
- Descobertos laravel/tinker, nesbot/carbon e nunomaduro/termwind, já instalados.
  Serviços com grupos providers, eager, deferred e when; aprofundamento posterior.
- Aula em docs/aulas/04-07-artisan-e-chave.md e README atualizados.

Verificação:

- Artisan retornou Laravel Framework 13.35.0; ajuda conferiu as opções, código 0.
- key:generate retornou Application key set successfully, código 0.
- Formato base64 e 32 bytes compatíveis com AES-256-CBC conferidos, sem exibir chave.
- Comparação antes/depois confirmou alteração somente na linha APP_KEY.
- Encrypter criptografou e recuperou texto fixo de teste, com resultado igual.
- Outro container inicializou kernel de console e confirmou config/app.key igual
  à chave local e serviço encrypter utilizando seus bytes. Valor não impresso.
- packages.php e services.php lidos como arrays; três pacotes descobertos.
- Git confirmou .env e manifests ignorados, ausentes da lista versionada.
- Código do backend, src, Compose, Dockerfile, JSON e lockfile sem alterações.
- Sem cache config.php, SQLite, migrations, testes Laravel, banco, frontend ou contador.
  Compose ps mostrou apenas servidor php do laboratório ativo; backend temporário.

Entendimento da etapa 4.7: confirmado com "entendi" em 13/10/2026.
Checkpoint: 590f98a, `docs: apresenta Artisan e valida chave local`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `590f98a7141f8223659711c659b2d857c05afc67`. Chave e manifests locais.
Próximo passo exato: após confirmação, publicar documentação da 4.7 e iniciar 4.8,
configurar servidor de desenvolvimento Laravel no serviço backend, publicar
127.0.0.1:8002 e verificar página inicial de /, preservando laboratório php.
Banco e testes de integração permanecem nas etapas previstas com SQL Server.

## Etapa 4.8

Objetivo: iniciar o servidor Laravel no Docker e verificar a página inicial do
modelo, mantendo o laboratório e as montagens preparados.

Implementação e explicação:

- compose.yaml: backend executa php artisan serve --host=0.0.0.0 --port=8000
  --tries=1 --no-reload, com ports 127.0.0.1:8002:8000 e stop_signal SIGINT.
- init:true acrescentado após parada forçada no diagnóstico inicial; encaminha
  sinais e cuida de processos filhos. Correção verificada antes de encerrar a aula.
- Explicados comando padrão persistente, portas interna/host, opções do servidor,
  init, sinal de parada e comandos up -d, ps, port, logs e stop.
- Montagens, serviço php e imagem preservados. Sem rebuild ou novos pacotes.
- Apresentado caminho básico GET / -> public/index.php -> bootstrap/app.php ->
  routes/web.php -> view welcome -> HTML. Arquivos PHP do backend preservados.
- Aula em docs/aulas/04-08-servidor-laravel.md e README atualizados.

Verificação:

- help serve confirmou opções. Porta 8002 disponível; Compose válido.
- up -d backend criou/iniciou servidor. ps mostrou php e backend ativos;
  port backend 8000 confirmou 127.0.0.1:8002; log de inicialização conferido.
- Diagnóstico PHP em Docker, --network host, consultou portas publicadas: Laravel
  8002 HTTP 200, título Loja Fullstack e texto welcome; laboratório 8001 HTTP 200.
- Primeira requisição gerou uma view compilada e um arquivo de sessão em storage.
  Contagens e legibilidade conferidas sem exibir conteúdo/identificadores de sessão.
- Código somente leitura; pastas de views/sessões graváveis; arquivos ignorados.
- Parada inicial sem init: exit 137, forçada. Com init:true: parada rápida,
  exit 130 por SIGINT; servidor reiniciado, ambas as páginas novamente HTTP 200.
- Backend, src, Dockerfile, .dockerignore e lockfile versionados sem alterações.
  Mudança de implementação somente em compose.yaml. Configuração local preservada.
- Sem banco, migrations, frontend, testes Laravel, pacotes ou contador executados.

Entendimento da etapa 4.8: confirmado com "entendi" em 13/10/2026.
Checkpoint: 6ccf825, `build: inicia servidor de desenvolvimento Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `6ccf825fbb834fdba7db7fb5785bbdb2721089f1`. Artefatos ignorados.
Estado de execução: Laravel em 127.0.0.1:8002 e laboratório em 127.0.0.1:8001 ativos.
Próximo passo exato: após confirmação, publicar 4.8 e iniciar 4.9, acrescentar
GET /loja em backend/routes/web.php com resposta textual usando config('app.name').
Explicar método, caminho, função de atendimento e resposta; controllers/view
própria em etapas posteriores. Persistência e testes de integração seguem SQL Server.

## Etapa 4.9

Objetivo: criar primeira rota própria da loja e explicar método, caminho,
função anônima, retorno tipado e consulta de configuração.

Implementação e explicação:

- backend/routes/web.php recebeu Route::get('/loja', function (): string), com
  return 'Bem-vindo à '.config('app.name').'!';. Rota / e import Route preservados.
- Explicados GET, caminho /loja, URL completa, closure passada como argumento,
  execução pelo Laravel ao corresponder a rota e retorno string como resposta HTTP.
- Explicados concatenação e config('app.name'), ligado à chave name de
  config/app.php e APP_NAME local. Sem mudança no ambiente.
- Aula em docs/aulas/04-09-primeira-rota-loja.md e README atualizados.

Verificação:

- php -l no container backend: sintaxe correta, código 0.
- Artisan route:list --path=loja --except-vendor: uma rota GET|HEAD loja,
  registrada em routes/web.php:9. HEAD apresentado brevemente; HTTP aprofundado depois.
- PHP temporário em Docker com --network host: GET /loja HTTP 200 e corpo exato
  Bem-vindo à Loja Fullstack!; Content-Type text/html; charset=utf-8.
- POST /loja HTTP 405, comprovando restrição do método; corpo de erro/cookies não exibidos.
- GET / permaneceu HTTP 200, com título Loja Fullstack e welcome preservada.
- Código atualizado visível pelo bind mount sem rebuild/reinício. Compose,
  Dockerfile, dependências, chave e laboratório preservados.
- Sem banco, migrations, frontend, testes Laravel ou contador. Diagnóstico cobre
  comportamento HTTP desta rota, não persistência ou regras de catálogo.

Entendimento da etapa 4.9: confirmado com "entendi" em 13/10/2026.
Checkpoint: 1671a0b, `feat: adiciona primeira rota da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `1671a0b15f6bba6f8d8daafa41548d31f76f5614`.
Próximo passo exato: após confirmação, publicar 4.9 e iniciar 4.10, criar
LojaController::index e fazer GET /loja apontar para esse método, preservando
a saudação. Explicar rota -> classe -> método público -> resposta. View própria
da loja em etapa posterior; banco e testes de integração seguem SQL Server.

## Etapa 4.10

Objetivo: mover atendimento de /loja para controller, preservando o comportamento
e apresentando a relação entre rota, classe, método público e resposta.

Implementação e explicação:

- LojaController.php ausente antes da geração. help make:controller conferido;
  classe gerada pelo Artisan no Docker, com --no-interaction e sem --force.
- Montagem temporária apenas da pasta app/Http/Controllers com escrita. Após
  geração, chown --reference da classe base aplicado somente ao arquivo novo;
  stat confirmou 1000:1000. Demais montagens e configurações preservadas.
- Arquivo gerado tinha import Request e classe vazia. Import sem uso retirado;
  método public index(): string recebeu a mesma saudação com config('app.name').
- Explicados namespace App\\Http\\Controllers, extends Controller, base abstrata
  vazia existente, método de instância público, tipo de retorno e concatenação.
- web.php recebeu import LojaController; GET /loja usa [LojaController::class, 'index'].
  Explicados nome completo da classe, array de destino e chamada pelo Laravel.
- Autoload App existente preservado. Aula em docs/aulas/04-10-primeiro-controller.md
  e README atualizados.

Verificação:

- Geração e ajuste de proprietário: código 0.
- php -l no Docker passou para LojaController.php e routes/web.php.
- route:list --path=loja --except-vendor: GET|HEAD loja -> LojaController@index.
- PHP temporário em Docker: GET /loja HTTP 200 e saudação exata preservada;
  POST /loja HTTP 405; GET / HTTP 200 e título welcome preservado.
- Classe nova carregada pelo autoload existente; sem dump-autoload, dependências,
  rebuild ou reinício. src, Compose, Dockerfile, JSON e lockfile preservados.
- Sem banco, frontend, migrations, testes Laravel, mudança de chave ou contador.

Entendimento da etapa 4.10: confirmado com "entendi" em 13/10/2026.
Checkpoint: f31b38e, `refactor: move saudação para controller da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `f31b38eb8d3732cf6e158d8fd9eff82687d4a7fc`.
Próximo passo exato: após confirmação, publicar 4.10 e iniciar 4.11, criar
resources/views/loja.blade.php e adaptar index para retornar view('loja') com o
nome da loja como dado. Explicar tipo View, passagem de dados e Blade {{ }}.
Model, persistência e testes de integração permanecem nas etapas previstas.

## Etapa 4.11

Objetivo: criar primeira view Blade da loja e passar dados pelo controller,
apresentando retorno View, HTML mínimo e exibição com escape.

Implementação e explicação:

- LojaController.php recebeu use Illuminate\\View\\View; index retorna View
  com view('loja', ['nomeLoja' => config('app.name')]).
- resources/views/loja.blade.php ausente antes da criação, criado com HTML mínimo,
  idioma pt-BR, charset utf-8, viewport, title e h1 com {{ $nomeLoja }}.
- Explicados nome do template, array de dados e variável correspondente, objeto
  View, renderização pelo Laravel e distinção de funções do controller e view.
- Explicados elementos HTML utilizados e duplas chaves Blade com escape de dados.
  Não antecipar estudo completo de HTML/CSS ou frontend do módulo próprio.
- Rota para LojaController@index preservada; arquivos de configuração intactos.
- Aula em docs/aulas/04-11-primeira-view-blade.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- PHP temporário em Docker consultou GET /loja: HTTP 200, Content-Type HTML UTF-8,
  doctype, idioma, charset, título e h1 preenchidos com o nome esperado.
- Expressões Blade ausentes no HTML recebido. GET / HTTP 200, welcome preservada.
- Renderização isolada da view com <b>Loja & teste</b> confirmou escape no título
  e h1. Dado temporário fornecido à renderização, sem mudar ambiente/configuração.
- PHP compilado de Blade sob storage/framework/views ignorado pelo Git.
- Rota, src, Compose, Dockerfile, JSON e lockfile preservados; sem rebuild/reinício.
- Sem banco, migrations, testes Laravel, frontend, dependências, chave alterada ou contador.
  Diagnóstico verifica apresentação e dados, não catálogo persistido.

Entendimento da etapa 4.11: confirmado com "entendi" em 13/10/2026.
Checkpoint: 1d93ab8, `feat: apresenta loja em view Blade`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `1d93ab8913540a1d27bcdd0c789622dd37e54567`. Compilados ignorados.
Próximo passo exato: após confirmação, publicar 4.11 e iniciar 4.12, passar pequena
lista de nomes demonstrativos de produtos do controller para a view e exibir com
@foreach. Dados em memória para estudar Blade, sem antecipar model/banco.

## Etapa 4.12

Objetivo: passar lista demonstrativa do controller à view e apresentar @foreach,
elemento atual do laço e lista HTML.

Implementação e explicação:

- LojaController@index recebeu o dado produtos com ['Camiseta', 'Calça', 'Tênis'],
  preservando nomeLoja e retorno View. Dados fixos em memória para demonstração.
- loja.blade.php recebeu h2 Produtos de demonstração e ul com
  @foreach ($produtos as $produto), li com {{ $produto }} e @endforeach.
- Explicados array associativo de dados, lista de strings, variável $produtos
  e elemento atual $produto, relação com foreach PHP e processamento no servidor.
- Explicados h2, ul e li; exibição com escape Blade preservada.
- Aula em docs/aulas/04-12-lista-produtos-blade.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- Diagnóstico PHP temporário em Docker consultou /loja: HTTP 200; título,
  saudação e novo título de seção presentes. Três li com nomes e ordem exatos.
- Diretivas @foreach/@endforeach e {{ }} ausentes no HTML recebido.
- GET / permaneceu HTTP 200, welcome preservada. Sem cookies ou HTML completo impressos.
- Rota, src, Compose, Dockerfile, JSON e lockfile preservados; sem rebuild/reinício.
- Sem entidades de catálogo, preços, banco, migrations, testes Laravel, frontend,
  dependências, mudança de ambiente/chave ou contador. Exercício de apresentação.

Entendimento da etapa 4.12: confirmado com "entendi" em 13/10/2026.
Checkpoint: 37b7485, `feat: exibe lista demonstrativa com Blade`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `37b74854c1b1d5b0a3b72c9b3c65514676bf2a62`.
Próximo passo exato: após confirmação, publicar 4.12 e iniciar 4.13, tratar lista
vazia na view com @if/@else e mensagem. Conferir listas preenchida/vazia por
renderização com dados temporários, mantendo os nomes do controller. Model e banco
continuam nas etapas previstas do roteiro.

## Etapa 4.13

Objetivo: mostrar uma mensagem quando a lista demonstrativa estiver vazia,
apresentando @if/@else, count e condição com comparação.

Implementação e explicação:

- Somente loja.blade.php alterada: @if (count($produtos) > 0) envolve a lista
  existente; @else apresenta p Nenhum produto de demonstração disponível.; @endif encerra.
- Explicados quantidade de elementos, comparação > 0, ramos verdadeiro/falso,
  diferença entre encerramentos de condição e laço e blocos aninhados.
- Controller mantém os três exemplos; nome, título, saudação e rota preservados.
- Aula em docs/aulas/04-13-lista-vazia-blade.md e README atualizados.

Verificação:

- PHP temporário no Docker inicializou o kernel de console e renderizou a view
  com três nomes e depois com []; dados fornecidos apenas às chamadas de renderização.
- Lista preenchida produziu os três itens na ordem, sem mensagem de vazio.
- Lista vazia produziu a mensagem, sem ul/li. Título e saudação preservados em ambos.
- GET /loja real HTTP 200, três exemplos preservados e mensagem de vazio ausente.
- Controller, rota, src, Compose, Dockerfile, JSON e lockfile sem alterações.
  Sem rebuild/reinício, ambiente/chave alterados, banco, migrations, dependências,
  frontend, testes Laravel ou contador.
- Diagnóstico cobre as duas apresentações da view; a página padrão continua
  preenchida, sem alterar o controller para simular o caso vazio.

Entendimento da etapa 4.13: confirmado com "entendi" em 13/10/2026.
Checkpoint: b944f4e, `feat: trata lista vazia na view da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `b944f4e30ae1bce7dc1e6914bdc479cac35ee245`.
Próximo passo exato: após confirmação, publicar 4.13 e iniciar 4.14, middleware
MarcarRespostaCurso para adicionar X-Curso: Laravel à resposta, aplicado somente
a GET /loja. Explicar request -> próximo atendimento -> response e verificar
cabeçalho e conteúdo preservado. Model e persistência permanecem conforme o roteiro.

## Etapa 4.14

Objetivo: apresentar middleware que modifica a resposta depois de continuar o
atendimento, aplicado somente à rota /loja.

Implementação e explicação:

- app/Http/Middleware ausente antes da geração. help make:middleware conferido;
  MarcarRespostaCurso gerado pelo Artisan no Docker com --no-interaction.
- Montagem temporária app/Http gravável para criar a pasta ausente; proprietário
  da pasta e arquivo novos alinhados por chown --reference. stat confirmou 1000:1000.
- Mantidos namespace, imports Closure/Request/Response e assinatura handle.
  Corpo chama $next($request), guarda Response em $resposta, define X-Curso: Laravel
  por headers->set e devolve a resposta.
- Explicados Request, Closure de continuação, Response, chamada de $next,
  trabalho depois do atendimento e cabeçalho como informação fora do corpo HTML.
- web.php recebeu import MarcarRespostaCurso e ->middleware na rota /loja.
  Rota /, controller, view e bootstrap/app.php preservados; sem registro global.
- Aula em docs/aulas/04-14-primeiro-middleware.md, com diagrama do fluxo, e README atualizados.

Verificação:

- Geração e ajuste de proprietário: código 0. php -l passou para middleware e rota.
- route:list --path=loja --except-vendor -v mostrou GET|HEAD loja, LojaController@index,
  grupo web e App\\Http\\Middleware\\MarcarRespostaCurso.
- PHP temporário em Docker: GET /loja HTTP 200, X-Curso: Laravel e título,
  saudação e três produtos preservados. GET / HTTP 200 com título e sem X-Curso.
- Teste não imprimiu cookies ou HTML completo. Atuação e escopo confirmados.
- Controller, view, bootstrap, src, Compose, Dockerfile, JSON e lockfile preservados.
  Sem rebuild/reinício, dependências, banco, migrations, frontend, testes Laravel,
  chave alterada ou contador.

Entendimento da etapa 4.14: confirmado com "entendi" em 13/10/2026.
Checkpoint: 354626c, `feat: marca resposta da loja com middleware`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `354626c0dbd7d89b6c51455d88b124e0d5cb06e2`.
Próximo passo exato: após confirmação, publicar 4.14 e iniciar 4.15, criar
App\\Services\\CatalogoDemonstracao com listarNomes(): array e extrair a lista
do controller. Receber a classe como parâmetro de index para apresentar injeção
pelo container Laravel, preservando HTML e middleware. Dados continuam em memória.

## Etapa 4.15

Objetivo: extrair nomes demonstrativos para uma classe e recebê-la no controller
por injeção de dependência, apresentando o container de serviços Laravel.

Implementação e explicação:

- app/Services/CatalogoDemonstracao.php ausente antes da criação pelo editor;
  namespace App\\Services, método public listarNomes(): array com os mesmos três nomes.
- LojaController importa a classe; index(CatalogoDemonstracao $catalogo): View
  consulta $catalogo->listarNomes() para o dado produtos. Lista literal removida do controller.
- Explicados dependência, parâmetro tipado, objeto entregue pelo framework,
  chamada do método público, autoload e container de serviços como mecanismo PHP.
- Classe concreta sem dependências de construção, resolvida automaticamente.
  AppServiceProvider e bindings preservados; aprofundar registros quando necessários.
- Rota, view e middleware preservados. Aula em docs/aulas/04-15-injecao-dependencia.md
  e README atualizados.

Verificação:

- php -l no Docker passou para classe nova e controller.
- PHP temporário em Docker: GET /loja HTTP 200, título, saudação, três nomes na
  ordem e X-Curso: Laravel preservados. GET / HTTP 200, welcome sem X-Curso.
- Requisição confirma entrega do parâmetro obrigatório e uso da classe pela view.
- Sem alterações em rota, view, middleware, provider, bootstrap, src, Compose,
  Dockerfile, JSON ou lockfile. Sem rebuild/reinício ou dump-autoload.
- Sem banco, migrations, testes Laravel, frontend, dependências, chave alterada ou contador.
  Dados seguem demonstrativos em memória, sem model ou persistência.

Entendimento da etapa 4.15: confirmado com "entendi" em 13/10/2026.
Checkpoint: dca8ccd, `refactor: injeta catálogo demonstrativo no controller`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `dca8ccd583c338c7ce8581a7f639144495fbdc7a`.
Próximo passo exato: após confirmação, publicar 4.15 e iniciar 4.16, receber
CatalogoDemonstracao pelo construtor de LojaController com propriedade promovida;
index consulta $this->catalogo. Comparar pontos de injeção e preservar comportamento.

## Etapa 4.16

Objetivo: comparar injeção no método e no construtor, guardando a dependência
em propriedade promovida e preservando o comportamento.

Implementação e explicação:

- Somente LojaController alterado: __construct(private CatalogoDemonstracao $catalogo)
  com corpo vazio; index(): View usa $this->catalogo->listarNomes().
- Explicados entrega na criação do objeto, construtor público, propriedade
  promovida privada tipada, atribuição automática e acesso por $this.
- Apresentada equivalência com propriedade e atribuição explícitas, apenas didática.
- Comparados pontos de injeção: parâmetro local do método e propriedade da instância.
  Sem registro de singleton ou binding; resolução automática da classe permanece.
- Catálogo, rota, view e middleware preservados. Aula em
  docs/aulas/04-16-injecao-construtor.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- PHP temporário no container backend consultou porta interna 8000: GET /loja
  HTTP 200, título, saudação, três nomes na ordem e X-Curso: Laravel preservados.
- GET / HTTP 200, welcome sem X-Curso. Sem cookies ou respostas completas impressos.
- Atendimento confirmou construção com parâmetro obrigatório e propriedade inicializada.
- Catálogo, rota, view, middleware, provider, src, Compose, Dockerfile, JSON e lockfile
  preservados. Sem rebuild/reinício, dependências, banco, migrations, testes Laravel,
  frontend, chave alterada ou contador.

Entendimento da etapa 4.16: confirmado com "entendi" em 13/10/2026.
Checkpoint: 5da3709, `refactor: recebe catálogo pelo construtor`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `5da37098c407a616d3a521b04864a583b7c947e2`.
Próximo passo exato: após confirmação, publicar 4.16 e iniciar 4.17, interface
App\\Contracts\\Catalogo com listarNomes(): array, implementação em CatalogoDemonstracao,
contrato recebido no construtor e binding em AppServiceProvider::register.
Conjunto inseparável para introduzir contrato, ligação e papel do provider,
preservando dados em memória, HTML e middleware.

## Etapa 4.17

Objetivo: receber interface no controller e ligar o contrato à implementação
com binding, apresentando o papel do AppServiceProvider.

Implementação e explicação:

- app/Contracts/Catalogo.php ausente antes da criação: interface com public
  listarNomes(): array. Autoload App preservado.
- CatalogoDemonstracao importa Catalogo e implements o contrato; lista preservada.
- LojaController importa e recebe Catalogo na propriedade promovida do construtor;
  index continua consultando listarNomes e fornecendo os dados à view.
- AppServiceProvider::register recebeu bind(Catalogo::class, CatalogoDemonstracao::class).
  Explicados nomes ::class, $this->app herdado, registro da ligação e resolução.
- bootstrap/providers.php já inclui AppServiceProvider, carregado pelo Laravel.
  Arquivo preservado; boot permaneceu vazio, com papel apresentado brevemente.
- Conjunto inseparável de quatro arquivos: contrato, implementação, consumidor
  e registro. Aula em docs/aulas/04-17-contrato-e-binding.md e README atualizados.

Verificação:

- php -l no Docker passou para os quatro arquivos.
- Kernel de console inicializado no diagnóstico temporário; binding registrado;
  $app->make(Catalogo::class) resolveu CatalogoDemonstracao, que satisfaz a interface
  e mantém os três nomes na ordem.
- HTTP no container: GET /loja 200, título, saudação, três nomes e X-Curso preservados;
  GET / 200, welcome sem X-Curso. Sem cookies ou respostas completas impressos.
- Rota, view, middleware, bootstrap, src, Compose, Dockerfile, JSON, lockfile e
  ambiente preservados. Sem rebuild/reinício, dependências, banco, migrations,
  testes Laravel, frontend ou contador.

Entendimento da etapa 4.17: confirmado com "entendi" em 13/10/2026.
Checkpoint: 92d6e5f, `refactor: registra contrato de catálogo no container`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `92d6e5f925abb704b9ae57e366a0d7ac024e959b`.
Próximo passo exato: após confirmação, publicar 4.17 e iniciar 4.18, apresentar
M de MVC pelo app/Models/User.php já gerado e demonstrar instância/atributos em
memória, sem consultar ou gravar no banco. Explicar papel do model Eloquent;
persistência SQL Server, factories e autenticação ficam nas etapas previstas.

## Etapa 4.18

Objetivo: apresentar o papel do Model em MVC e o User Eloquent existente,
demonstrando atributos em memória antes de persistência.

Implementação e explicação:

- Sem alteração de código. User.php já gerado na 4.2 foi lido e apresentado.
- Explicados Model como representação de dados/comportamento, Eloquent como ORM,
  relação com controller/view e namespace App\\Models.
- Apresentados alias Authenticatable, herança que inclui Model, convenção User/users,
  metadados PHP Fillable/Hidden, traits HasFactory/Notifiable e método casts.
- Aprofundados apenas atributos usados; factories, notificações, autenticação e
  conversões de senha/data apresentados por função, com prática adiada às etapas próprias.
- Demonstração PHP temporária com nome/e-mail fictícios, usando apenas autoload,
  new User com array de atributos e alteração de name em memória.
- Aula em docs/aulas/04-18-papel-model.md e README atualizados.

Verificação:

- Objeto instanceof Eloquent Model; name/email preenchidos com dados fictícios.
- getTable retornou users, sem verificar/criar tabela. getFillable e getHidden
  confirmaram metadados do modelo.
- Name atualizado e lido por getAttribute. exists=false e getKey=null mantidos.
- Model::getConnectionResolver=null antes/depois; sem inicialização Laravel,
  resolvedor de banco, query, save, migration, factory, notificação ou autenticação.
- git diff --exit-code -- backend src compose.yaml Dockerfile: sem alterações.
  Sem dependências, banco, testes Laravel, frontend, credenciais ou contador.
- Diagnóstico demonstra objetos/atributos em memória, não integração SQL Server.

Entendimento da etapa 4.18: confirmado com "entendi" em 13/10/2026.
Checkpoint: aa372c6, `docs: apresenta papel do model Eloquent`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `aa372c66ef54086f72d9aea2160a67fcdc9aaa86`. Nenhum código novo.
Próximo passo exato: após confirmação, publicar documentação da 4.18 e iniciar
4.19, revisão do módulo 4 com fluxo completo, entrega /loja e pendências para SQL
Server. Encerrar módulo apenas após entendimento da revisão, antes de iniciar 5.

## Etapa 4.19

Objetivo: revisar o módulo 4, conferir sua entrega e pendências antes de SQL Server.

Implementação e explicação:

- Sem alteração de código. Revisados estrutura, Artisan, ambiente, chave, ciclo
  HTTP, rotas, controller, view/Blade, middleware, container, injeção e provider.
- Relacionados Catalogo/implementação/binding/construtor e dados enviados à view.
  Model User estudado separadamente em memória, sem integração na página.
- Diagrama e mapa de arquivos em docs/aulas/04-19-revisao-modulo-4.md; README e
  roteiro atualizados para revisão em encerramento, ainda aguardando entendimento.
- Registradas pendências de drivers, banco, compatibilidade, integração exclusiva
  e padrões SQLite antes de persistência. Não iniciar módulo 5 nesta revisão.

Verificação:

- Compose ps mostrou backend e php ativos, respectivamente em 127.0.0.1:8002 e 8001.
- route:list detalhada confirmou /loja -> LojaController@index, web e middleware.
- PHP temporário em Docker na rede do host: /loja HTTP 200, título/saudação e
  três nomes na ordem, X-Curso: Laravel. / e laboratório HTTP 200, sem X-Curso.
- Checagem de leitura do PHP: sqlsrv e pdo_sqlsrv não carregados, pendentes.
- Código backend, src, Compose e Dockerfile sem alterações; .env continua ignorado.
  Sem instalação, banco, migrations, testes Laravel, frontend, chave alterada ou contador.
- Escape/lista vazia e modelo em memória já verificados nas etapas próprias;
  nesta revisão, conferida a entrega HTTP atual sem repetir verificações desnecessárias.

Entendimento da etapa 4.19: confirmado com "entendi" em 13/10/2026.
Estado do módulo 4: concluído após confirmação desta revisão.
Publicação: checkpoint 2346772, `docs: conclui módulo 4 de Laravel e MVC`.
Push autorizado e verificado; HEAD, origin/main e consulta direta à main remota
retornaram `23467729d7d3d5ebf6587084cab007ad1afa4df7`. Nenhum código novo.
Próximo passo realizado: preparação 5.1, diagnóstico de recursos e compatibilidade.

## Etapa 5.1

Objetivo: conferir arquitetura/recursos Docker, plataforma PHP e requisitos
oficiais antes de introduzir componentes de persistência.

Implementação e explicação:

- Diagnóstico somente de leitura, sem alterar Dockerfile, Compose ou aplicação.
- Explicado caminho Laravel -> PDO/pdo_sqlsrv -> ODBC -> SQL Server -> volume.
  PDO é a interface PHP; drivers ficam no backend; servidor terá outro container.
- Diferenciados objetos em memória de gravação persistente e localhost do backend
  de nome do futuro serviço na rede Docker. Nenhuma conexão já implementada.
- Referências Microsoft e Laravel conferidas. Base do laboratório definida:
  SQL Server 2022 Developer para desenvolvimento/testes; ODBC 18; drivers PHP
  da linha 5.13, release estável consultada 5.13.3. Versões dos pacotes e imagem
  SQL Server serão conferidas/fixadas na instalação, sem uso antecipado de latest.
- Aula docs/aulas/05-01-preparacao-sql-server.md criada; README e roteiro
  atualizados; revisão 4.19 e registro recebem SHA da publicação verificada.

Verificação:

- Docker info: Linux x86_64, 8 CPUs, MemTotal 8.193.597.440 bytes (~7,63 GiB),
  armazenamento overlayfs, diretório /var/lib/docker.
- MemAvailable observado: 5.332.836 KiB (~5,09 GiB), valor variável; clock
  observado até 2419,2 MHz. Diagnóstico de recursos, sem benchmark.
- df -h -T: /var/lib/docker e bind mount /app sobre ext4; ~942 GiB livres.
  Raiz do container overlay. Recursos observados atendem à preparação inicial
  frente aos requisitos Linux de x64, 2 GB de RAM, 6 GB de disco, 2 núcleos/2 GHz.
- Backend Debian 12 bookworm x86_64; PHP 8.4.26 64 bits, sem thread safety.
  PDO carregada, sqlsrv/pdo_sqlsrv ausentes, PDO::getAvailableDrivers apenas sqlite.
- dpkg-query não encontrou msodbcsql18, unixodbc ou libodbc2.
- Matriz Microsoft: drivers 5.13 compatíveis com PHP 8.4, Debian 12, SQL Server
  2022 e ODBC 18. Laravel orienta sqlsrv/pdo_sqlsrv e dependências ODBC.
- Compose ps: backend e php ativos em 8002/8001. Código/ambiente preservados;
  nenhum banco, pacote, credencial, migration, teste Laravel ou contador executado.
- Disponibilidade de recursos varia; inicialização SQL Server e conexão real
  ainda não foram verificadas e terão suas aulas próprias.

Entendimento da etapa 5.1: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 41d0660, `docs: verifica preparação para SQL Server`.
Push autorizado e verificado; HEAD, origin/main e consulta direta à main remota
retornaram `41d0660945bd3b91dc3a036017986e1adc6c2ff5`.
Próximo passo exato: após confirmação, publicar diagnóstico 5.1 e iniciar 5.2,
preparar uma imagem própria do backend com Microsoft ODBC Driver 18, preservando
a imagem do laboratório PHP. Drivers PHP e serviço SQL Server entrarão em etapas
seguintes. Banco SQL Server exclusivo para integração continua obrigatório;
ajustar padrões SQLite do esqueleto antes de persistência/testes.

## Etapa 5.2

Objetivo: preparar a imagem própria do backend com Microsoft ODBC Driver 18,
dependência dos drivers PHP que serão introduzidos na etapa seguinte.

Implementação e explicação:

- Criado Dockerfile.backend com PHP 8.4.26 bookworm e Composer 2.10.3.
- Baixado instalador oficial packages-microsoft-prod para Debian 12; checksum
  conferido antes de dpkg -i. Versão 1.1-debian12; SHA-256
  8434dcb8c346dc95fbd63dbece056c343704590b58b6a5c323d39acf52bf0b48.
- Repositório Microsoft configurado; msodbcsql18=18.7.1.1-1 instalado com
  ACCEPT_EULA=Y, aceite da licença restrito ao comando de instalação.
- unzip=6.0-28+deb12u1 mantido; libgssapi-krb5-2=1.20.1-2+deb12u5 explicitado
  como biblioteca exigida pelo ODBC, já presente na base.
- Explicados curl, checksum, dpkg, índices APT, versões dos pacotes, &&,
  continuação de linhas, limpeza, WORKDIR e CMD. Código Laravel vem do bind mount.
- Compose backend passou a build.context=. e build.dockerfile=Dockerfile.backend;
  .dockerignore permite a receita. Demais opções/montagens preservadas.
- Build e recriação somente do backend; explicada diferença entre imagem
  construída e container existente. Laboratório continua no Dockerfile original.
- Aula docs/aulas/05-02-odbc-backend.md criada; README, roteiro e progresso
  atualizados. Explicação apresentada, sem adiantar extensões PHP ou banco.

Verificação:

- Consulta em Docker ao índice oficial confirmou msodbcsql18 18.7.1.1-1 para
  amd64; instalador do repositório consultado e temporário removido.
- docker compose config --quiet válido; build backend concluído, checksum OK.
  PHP e Composer resolveram os digests registrados na aula, versões mantidas.
- up -d --no-deps backend recriou/aplicou imagem. php manteve ID de container
  009e8bd17b90915bb0f143a0fd0c3bd2cc8a8685ea076aba5f14e75f3e1ffc06 e imagem
  sha256:08de3109b7bf12763cb263a024a9ae838c6793a25f6373440f1920c6fa85654e.
- dpkg-query: ODBC 18.7.1.1-1, unixODBC 2.3.11-2+deb12u1, repositório
  1.1-debian12, libgssapi e unzip nas versões fixadas.
- odbcinst encontrou ODBC Driver 18 for SQL Server e biblioteca
  /opt/microsoft/msodbcsql18/lib64/libmsodbcsql-18.7.so.1.1.
  ldd encontrou dependências resolvidas; PHP confirmou arquivo registrado/legível.
- PHP 8.4.26/Composer 2.10.3 mantidos; check-platform-reqs --no-dev passou.
  Autoload preservado no volume, Laravel 13.35.0; extensões sqlsrv/pdo_sqlsrv ausentes.
- HTTP em PHP/Docker na rede do host: /loja 200 com título, nomes na ordem e
  X-Curso: Laravel; welcome e laboratório 200 sem X-Curso. Serviços ativos em 8002/8001.
- git diff --exit-code -- backend src Dockerfile passou; backend/.env ignorado.
  Sem alteração na aplicação, banco, migration, teste Laravel ou contador.
- Instalação ODBC verificada; nenhuma conexão SQL Server demonstrada nesta etapa.

Entendimento da etapa 5.2: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 5709dfe, `build: prepara ODBC na imagem do backend`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `5709dfefd739105efeff07691e6c127faa54dac6`.
Próximo passo exato: após confirmação, publicar 5.2 e iniciar 5.3, instalar e
habilitar sqlsrv/pdo_sqlsrv 5.13.3 na imagem backend, conferindo método oficial
e dependências de compilação. Serviço SQL Server será introduzido em outra etapa;
banco de integração exclusivo e ajuste de padrões SQLite seguem pendentes.

## Etapa 5.3

Objetivo: instalar e habilitar sqlsrv/pdo_sqlsrv 5.13.3 no PHP do backend,
usando ODBC já preparado e método oficial conferido.

Implementação e explicação:

- Alterado apenas Dockerfile.backend na implementação. Acrescentados git
  1:2.39.5-0+deb12u3, libtool 2.4.7-7~deb12u1 e unixodbc-dev 2.3.11-2+deb12u1,
  com versões consultadas em container temporário. Base já fornece compiladores,
  make, autoconf, pkg-config, phpize e php-config compatíveis com PHP 8.4.26.
- PIE 1.5.2 baixado da release oficial identificável, SHA-256 conferido e
  chmod +x aplicado. Hash: fe70c59738cf56ec00a818cf9cb9593da171aac86f5f1f859995b8839dfd2cc7.
- Método PIE recomendado pela documentação atual Microsoft, suportado pelos
  drivers 5.13.2+. Instalados microsoft/sqlsrv:5.13.3 e microsoft/pdo_sqlsrv:5.13.3
  em comandos separados, sem interação/cache e com dois trabalhos de compilação.
- Explicada diferença entre classes Composer/vendor e extensões PHP/.so;
  funções sqlsrv e driver PDO, compilação para PHP alvo e habilitação por .ini.
- PIE compilou, instalou e habilitou as duas extensões. Arquivos gerados na imagem:
  /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini com extension=sqlsrv e
  /usr/local/etc/php/conf.d/docker-php-ext-pdo_sqlsrv.ini com extension=pdo_sqlsrv.
  Bibliotecas em /usr/local/lib/php/extensions/no-debug-non-zts-20240924/.
- Build e aplicação apenas do backend. Compose, laboratório e código preservados.
  Aula docs/aulas/05-03-extensoes-sql-server.md criada; README/roteiro/progresso atualizados.

Verificação:

- PIE --version e install --help em container descartável confirmaram 1.5.2,
  sintaxe vendor/package:versão e opções utilizadas. Checksum conferido com os
  metadados públicos da release; consultas e ferramentas executadas em Docker.
- config --quiet válido; build backend passou. PIE confirmou alvo PHP 8.4.26
  NTS x86_64, phpize/configure/build/install concluídos para os dois drivers.
- up -d --no-deps backend recriou o serviço. Script no backend verificou
  extension_loaded e phpversion: sqlsrv/pdo_sqlsrv carregadas, exatamente 5.13.3.
- function_exists('sqlsrv_connect') verdadeiro; PDO::getAvailableDrivers passou
  a listar sqlite/sqlsrv. Nenhuma função de conexão, query ou gravação executada.
- .ini efetivamente lidos e conteúdos conferidos; versões git/libtool/unixodbc-dev
  confirmadas, ODBC 18.7.1.1-1 registrado. PIE 1.5.2 mantido na imagem.
- Composer check-platform-reqs --no-dev passou; autoload do volume preservado,
  Laravel 13.35.0. Serviços ativos em 8002/8001; laboratório com mesmo ID/imagem.
- PHP temporário em Docker com rede do host: /loja 200, título e três nomes
  corretos na ordem, X-Curso: Laravel; welcome e laboratório 200 sem X-Curso.
- git diff --exit-code -- backend src compose.yaml Dockerfile .dockerignore
  passou; backend/.env ignorado. Sem SQL Server, banco, migration ou contador.
- Drivers disponíveis não comprovam conexão real: faltam servidor e acesso.

Entendimento da etapa 5.3: confirmado com "entendi" em 13/10/2026, após esclarecimento PIE.
Pergunta do aluno: "o que é eese pie?". Esclarecimento apresentado: PIE significa
PHP Installer for Extensions, ferramenta de instalação de extensões no PHP.
Comparado com Composer, que instala bibliotecas/classes da aplicação em vendor.
Exemplo desta aula: pie install microsoft/pdo_sqlsrv:5.13.3 baixa o pacote,
compila/instala a extensão e configura seu carregamento no PHP da imagem.
Ferramenta utilizada durante o build; aplicação usa a extensão instalada em execução.
Entendimento desse esclarecimento e da 5.3 confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 5ba53e2, `build: instala extensões PHP para SQL Server`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `5ba53e2f6d6fda3b962909b2d3e2eb9c919eb6b8`.
Próximo passo exato: após confirmação, publicar 5.3 e iniciar 5.4, introduzir
SQL Server 2022 Developer no Compose, conferindo imagem/tag/digest, volume
persistente e credenciais locais ignoradas. Conexão Laravel e bancos da loja/testes
terão suas etapas próprias; integração deve usar banco SQL Server exclusivo.

## Etapa 5.4

Objetivo: introduzir SQL Server 2022 Developer no Compose com imagem identificável,
volume persistente e configuração local ignorada, e verificar o servidor.

Implementação e explicação:

- Acrescentado serviço sqlserver a compose.yaml; imagem oficial
  mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04, digest
  sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718.
  Tags e manifesto consultados no registro Microsoft antes do download.
- Explicados image pronta, tag/CU/GDR, digest e serviço separado do PHP.
  ACCEPT_EULA=Y aceita licença; MSSQL_PID=Developer define uso desenvolvimento/testes.
- MSSQL_SA_PASSWORD usa interpolação obrigatória ${MSSQL_SA_PASSWORD:?...}.
  Modelo root .env.example recebe campo vazio; senha aleatória gerada somente
  no root .env ignorado, sem exibir valor, usando PHP em Docker. Conteúdo existente
  preservado, política de senha conferida e modo 600 aplicado.
- MSSQL_MEMORY_LIMIT_MB=2048 e mem_limit=3g limitam SQL Server e container
  separadamente. Diagnóstico inicial: ~7,63 GiB totais, ~5,07 GiB disponíveis,
  8 CPUs x86_64 e ~942 GiB de disco livres; disponibilidade varia.
- Volume dados-sqlserver declarado/montado em /var/opt/mssql. Nome SQL Server
  na rede interna é sqlserver, porta 1433; dentro do backend localhost é o backend.
- Modelo e configuração local são parte inseparável da introdução do serviço.
  Documentado comando PHP/Docker independente do Compose para preparar a senha
  em outro clone, antes dos comandos Compose que agora exigem o campo.
- Aula docs/aulas/05-04-servico-sql-server.md criada; README/roteiro atualizados.
  Apresentados sqlcmd, variável SQLCMDPASSWORD, opções, SELECT 1/metadados e GO.

Verificação:

- config --quiet passou com ambiente real. Validação isolada com .env.example
  e variável SQL ausente recusou configuração com a mensagem prevista, sem segredo.
- pull sqlserver e up -d --no-deps sqlserver concluídos. Serviço running,
  imagem Linux/amd64 e RepoDigest iguais ao conteúdo escolhido.
- Inspect confirmou mem_limit de 3.221.225.472 bytes e volume
  curso-loja-fullstack_dados-sqlserver gravável em /var/opt/mssql.
- sqlcmd dentro do container, senha via variável de ambiente, certificado local
  aceito com -C: SELECT 1 retornou 1; SERVERPROPERTY informou 16.0.4305.5 e
  Developer Edition (64-bit). COUNT em sys.databases com database_id > 4 retornou 0.
- São consultas de diagnóstico somente leitura; motor preparou bancos de sistema,
  sem criação de bancos loja/testes, migrations, tabelas ou dados da aplicação.
- PHP no backend resolveu sqlserver e abriu conexão TCP à porta 1433.
  /loja e laboratório responderam HTTP 200; backend/php continuaram ativos.
- Comando documentado para outro clone executado sobre configuração existente:
  senha preservada. Não imprime senha, usa random_bytes para campo vazio/ausente.
- Root .env e backend/.env ignorados; código backend/src, Dockerfiles e
  .dockerignore preservados. Não alterado contador; nenhum teste Laravel executado.
- Montagem de volume conferida; sem novo teste de remoção/recriação de dados.
  Conexão Laravel ainda não configurada; servidor disponível não é catálogo persistido.

Entendimento da etapa 5.4: confirmado com "entendi" em 13/10/2026.
Pergunta do aluno: "quais os dados para acesso ao banco?". Esclarecimento:
servidor sqlserver e porta 1433 na rede Docker, login sa, senha no campo
MSSQL_SA_PASSWORD do .env local da raiz; valor não copiado para documentação.
Banco master disponível para conexão inicial; loja/loja_test ainda não criados.
Não há publicação de porta no host nesta configuração, portanto acesso por
cliente no computador precisará de configuração própria. Esclarecimentos confirmados
com "entendi". Aluno pediu aviso quando puder conectar pelo DBeaver e autorizou
seguir o curso. Registrar aviso para a etapa de acesso host, sem antecipá-la.
Publicação: checkpoint d9fba40, `build: adiciona serviço SQL Server Developer`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `d9fba40e398512cb63385e970e8578ffe90441d2`.
Próximo passo exato: após confirmação, publicar 5.4 e iniciar 5.5, criar bancos
loja e loja_test com SQL em Docker, explicar servidor/banco e CREATE DATABASE.
Conexão Laravel terá sua etapa; integração usará exclusivamente loja_test.
Padrões SQLite de configuração/phpunit.xml serão ajustados antes de uso.

## Etapa 5.5

Objetivo: criar bancos loja e loja_test no servidor SQL Server local, separar
persistência da aplicação de integração e estudar CREATE DATABASE.

Implementação e explicação:

- Criado apenas docker/sqlserver/criar-bancos.sql na implementação. Pasta
  docker/sqlserver organiza a preparação; arquivo SQL não contém credenciais.
- USE master seleciona contexto administrativo; IF DB_ID(N'nome') IS NULL
  cria cada banco somente quando ausente, usando CREATE DATABASE [nome].
- Explicados servidor versus banco, banco exclusivo de testes, comentário --,
  string Unicode N'...', identificador delimitado [], comparação IS NULL,
  ponto e vírgula e GO como separador de lotes do cliente.
- Executado por sqlcmd no container SQL Server com entrada padrão redirecionada
  do arquivo local. Explicado <, exec -T, variável de senha já existente,
  localhost dentro do servidor, login sa, certificado local e opções -l/-b.
- Arquivo não executa automaticamente ao iniciar Compose; preparação explícita
  registrada no README para outro ambiente, preservando bancos existentes.
- Aula docs/aulas/05-05-criacao-bancos.md criada; README/roteiro/progresso atualizados.
  Pedido DBeaver preservado: preparar acesso local e avisar na 5.6.

Verificação:

- Serviços ativos. Antes da criação, consulta sys.databases não encontrou
  loja ou loja_test, preservando qualquer trabalho existente antes de aplicar SQL.
- Execução do arquivo passou, fora de transação explícita. Consulta posterior:
  loja ID 5 ONLINE, loja_test ID 6 ONLINE. IDs são desta sessão, não fixados na aplicação.
- sys.master_files: loja.mdf/loja_log.ldf e loja_test.mdf/loja_test_log.ldf em
  /var/opt/mssql/data, sob o volume dados-sqlserver já montado.
- Reexecutado o arquivo; conexões sqlcmd -d loja e -d loja_test passaram.
  DB_NAME()/DB_ID() retornaram os mesmos nomes/IDs; sys.tables filtrada por
  is_ms_shipped=0 retornou zero tabelas da aplicação em ambos.
- Nenhum DROP, tabela, dado da aplicação, migration, login novo, teste Laravel
  ou contador executado. Configuração de integração deverá usar loja_test
  explicitamente antes de executar testes; o banco criado sozinho não basta.
- git diff --exit-code -- backend src compose.yaml Dockerfile Dockerfile.backend
  .dockerignore passou; root .env e backend/.env ignorados.
- Verificações demonstram bancos distintos, acessíveis e preparados; não são
  integração Laravel, catálogo persistido ou acesso DBeaver pelo host.

Entendimento da etapa 5.5: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint fc2cdbc, `feat: prepara bancos da loja e integração`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.
Próximo passo exato: após confirmação, publicar 5.5 e iniciar 5.6, configurar
publicação de porta SQL Server somente em 127.0.0.1 para acesso local pelo
DBeaver, conferir acesso e informar os dados ao aluno conforme pedido.
Conexão Laravel, tabelas e configuração dos testes terão etapas próprias.

## Etapa 5.6

Objetivo: disponibilizar acesso SQL Server no computador para DBeaver, conferir
endpoint e informar dados ao aluno conforme pedido de aviso.

Implementação e explicação:

- Acrescentado apenas ports: ["127.0.0.1:1433:1433"] ao serviço sqlserver.
  Explicados endereço do host, porta publicada, porta interna e encaminhamento.
- Diferenciados endereço sqlserver:1433 dentro da rede Compose e 127.0.0.1:1433
  no computador. DBeaver é cliente; os arquivos permanecem no volume SQL Server.
- Confirmado Linux WSL2; consultada documentação Microsoft de localhost Windows/WSL.
  Endpoint testado no host Docker; interface DBeaver depende do teste do aluno.
- Apresentados Microsoft SQL Server no DBeaver, host 127.0.0.1, porta 1433,
  banco loja, autenticação SQL Server, login sa e senha no campo MSSQL_SA_PASSWORD
  do root .env ignorado. Valor não impresso/copiado para documentação pública.
- Para certificado local, Trust Server Certificate ou propriedade
  trustServerCertificate=true, mantendo encrypt=true. Explicada aceitação
  do certificado local sem validação da cadeia, conforme documentação JDBC Microsoft.
- Aula docs/aulas/05-06-acesso-dbeaver.md criada; README/roteiro atualizados.
  Instruído Test Connection, eventual driver JDBC e experiência SELECT DB_NAME().
- Aviso ao aluno emitido após conexão endpoint passar: acesso local disponível.

Verificação:

- ss -ltn anterior: porta 1433 livre. config --quiet passou; up -d --no-deps
  sqlserver recriou apenas esse serviço. port retornou 127.0.0.1:1433.
- Compose ps mostrou publicação 127.0.0.1:1433->1433/tcp; backend/php ativos.
- Cliente sqlcmd em container temporário com --network host e --env-file .env,
  entrypoint sh para executar somente cliente. Senha via SQLCMDPASSWORD sem
  exibição/argumento secreto; -S 127.0.0.1,1433 e -d loja conectaram com sucesso.
- DB_NAME retornou loja, consulta constante retornou 1. sys.databases mostrou
  loja ID 5 ONLINE e loja_test ID 6 ONLINE, preservados após a recriação.
- Inspect confirmou HostIp 127.0.0.1, HostPort 1433 e volume
  curso-loja-fullstack_dados-sqlserver em /var/opt/mssql. ss confirmou LISTEN local.
- Código backend/src, SQL de bancos e Dockerfiles/.dockerignore preservados;
  root .env e backend/.env ignorados. Sem tabelas, migrations, contas novas,
  configuração DBeaver gravada por ferramenta, teste Laravel ou contador.
- Verificado endpoint SQL publicado e autenticação; não inventar conexão
  no DBeaver. Resultado do Test Connection deve ser informado pelo aluno.

Resultado no DBeaver: confirmado pelo aluno com "apareceu loja", após a consulta
SELECT DB_NAME(). Acesso ao banco loja confirmado por relato do aluno.
Entendimento da etapa 5.6: confirmado com "entendi" em 13/10/2026, após resultado
de conexão DBeaver confirmado separadamente com "apareceu loja".
Publicação: checkpoint c7f58ee, `build: publica acesso SQL local para DBeaver`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `c7f58ee64ab62b1b053cd27b96b644772ecac98f`.
Próximo passo exato: responder a dúvidas/erros DBeaver antes de avançar; após
entendimento, publicar 5.6 e iniciar 5.7, preparar login/usuário próprios da
aplicação no banco loja e credencial local ignorada, antes da conexão Laravel.
Banco de testes e configuração de integração terão preparação própria.

## Etapa 5.7

Objetivo: preparar login e usuário próprios da aplicação no banco loja, com
senha local ignorada e papéis de leitura/escrita, antes de configurar Laravel.

Implementação e explicação:

- Criado docker/sqlserver/criar-usuario-loja.sql e acrescentado campo vazio
  MSSQL_LOJA_PASSWORD ao root .env.example. Senha aleatória gerada somente no
  root .env ignorado via PHP/Docker, preservando configuração e modo 600.
- Diferenciados login (autenticação no servidor), usuário (mapeamento no banco)
  e papéis (permissões no banco). Nomes login/usuário loja_app.
- SUSER_ID condiciona CREATE LOGIN com CHECK_POLICY=ON e DEFAULT_DATABASE=loja.
  USE loja seleciona o banco; USER_ID condiciona CREATE USER FOR LOGIN.
- IS_ROLEMEMBER condiciona ALTER ROLE ADD MEMBER para db_datareader e
  db_datawriter. Preparação preserva login/senha/usuário/papéis existentes.
- Explicada variável de script sqlcmd $(MSSQL_LOJA_PASSWORD), preenchida pelo
  ambiente do cliente. Antes da substituição, case restringe valor ao formato
  gerado de letras/dígitos/!, evitando delimitadores no literal SQL.
- Cliente temporário Docker recebe .env por --env-file. SQLCMDPASSWORD usa
  credencial sa para preparar; a variável LOJA fornece senha do login novo.
  Valor não impresso, não passado em argumento secreto nem salvo no SQL público.
- Conta da aplicação tem papéis de dados somente em loja. Criação de tabelas/
  migrations e integração terão suas credenciais na etapa necessária.
- Aula docs/aulas/05-07-usuario-aplicacao.md criada; README/roteiro atualizados.

Verificação:

- Consulta administrativa anterior: login e usuário loja_app inexistentes;
  preparação criada sem sobrescrever trabalho conhecido.
- Execução SQL passou. sys.sql_logins confirmou policy=1 e banco padrão loja.
  sys.database_role_members confirmou db_datareader/db_datawriter no usuário.
- Conexão SQL como loja_app com senha própria: login=loja_app, usuário=loja_app,
  banco=loja. Papéis leitura/escrita=1; db_owner/sysadmin=0;
  HAS_DBACCESS(loja_test)=0 e permissão CREATE TABLE=0.
- Tentativa de conexão como loja_app ao banco loja_test recusada pelo servidor,
  com erro de banco solicitado inacessível e saída 1: resultado esperado.
- Arquivo reexecutado com sucesso; consulta positiva posterior autenticou em
  loja com mesma senha e papéis 1/1, confirmando preparação reaplicável.
- Diagnóstico temporário teve erro de aspas SQL (saída 1); corrigido para
  heredoc e repetido com sucesso. Nenhum erro no arquivo de preparação.
- git diff --exit-code -- backend src compose.yaml Dockerfile Dockerfile.backend
  .dockerignore passou; root .env/backend .env ignorados. Sem tabela, migration,
  novo dado da aplicação, teste Laravel ou contador. Conexão Laravel ainda pendente.

Entendimento da etapa 5.7: confirmado com "entendi" em 13/10/2026, após dúvidas.
Pergunta do aluno: "essa sys.database_principals é uma tabela?". Esclarecimento:
view de catálogo do sistema, consultável com SELECT em linhas/colunas, que
apresenta metadados de usuários/papéis do banco. sys é o esquema e
database_principals o nome da view. CREATE USER atualiza o catálogo e a view
passa a mostrar o usuário. Diferenciada de tabela de dados da loja; entendimento confirmado.
Pergunta do aluno: "já é pra ter criado no banco loja?". Esclarecimento:
usuário loja_app já criado dentro de loja, com login correspondente no servidor.
Conferido novamente em sys.database_principals no banco loja; apresentada
consulta para o aluno verificar no DBeaver. Entendimento confirmado com "entendi".
Publicação: checkpoint 063e4eb publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 063e4ebc0c1ec733b183005c922ffd967f4ac35b.
Próximo passo realizado na 5.8: preparar
backend/.env.example e configuração local Laravel para sqlserver:1433, loja,
loja_app e senha local copiada sem exibir/versionar o valor, preservando
APP_KEY/configurações existentes. Integração e migrations terão preparação própria.

## Etapa 5.8

Objetivo: preparar os valores de conexão que o Laravel lerá, antes da primeira
consulta. Uma etapa com os dois arquivos inseparáveis: modelo de ambiente e
configuração do banco. Aula em docs/aulas/05-08-configuracao-laravel.md.

Implementação:

- backend/.env.example define sqlsrv, sqlserver, 1433, loja, loja_app,
  DB_PASSWORD vazio, DB_ENCRYPT=yes e DB_TRUST_SERVER_CERTIFICATE=true.
- backend/config/database.php usa sqlsrv como fallback de conexão padrão e
  ativa as chaves encrypt/trust_server_certificate, lidas com env(...).
- backend/.env local recebe esses valores e DB_PASSWORD correspondente a
  MSSQL_LOJA_PASSWORD do root .env, por PHP executado em Docker. Senha não
  exibida ou versionada. APP_KEY e todas as variáveis fora do grupo DB alterado
  foram comparadas em memória e preservadas; permissão 600, dono 1000:1000.
- Configurações dos outros drivers e phpunit.xml preservadas. Banco exclusivo
  e credenciais de integração/migrations serão preparados na etapa própria.
- Instruções raiz continuam prevalecendo sobre recomendações geradas do
  backend: PHP 8.4 em Docker e nenhuma instalação antecipada de Boost.

Verificações:

- php -l /app/config/database.php no serviço backend: sem erro de sintaxe.
- Bootstrap Laravel em processo PHP Docker: conexão padrão sqlsrv; host
  sqlserver, porta 1433, banco loja, usuário loja_app, encrypt yes e confiança
  no certificado true (booleano). Valores de senha comparados em memória,
  sem impressão. APP_KEY preservada.
- Configuração sem cache; getConnections() retornou lista vazia. Nenhuma
  conexão ou consulta SQL solicitada pelo diagnóstico; nenhuma migration.
  Isso demonstra carregamento dos valores, ainda não conexão SQL pelo Laravel.
- HTTP GET /loja retornou 200, título, três produtos e cabeçalho X-Curso
  preservados. Sem reconstrução de imagem ou alteração dos dados do contador.
- .env e backend/.env ignorados; git diff --check passou.

Explicação apresentada: papel do .env.example público e .env privado,
DB_HOST interno versus endereço DBeaver, significado das oito variáveis,
env(nome, fallback) no array PHP, criptografia/certificado local, montagem
temporária para a cópia privada e alcance dos diagnósticos.
Entendimento da 5.8: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint e0e06ef publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em e0e06ef063ec245739e18f684336d218751687e9.
Próximo passo realizado na 5.9: primeira
consulta diagnóstica pelo Laravel, apresentando DB facade e resultado, sem
antecipar tabelas, migrations ou catálogo persistido.

## Etapa 5.9

Objetivo: executar a primeira consulta pelo Laravel e conferir a conexão
configurada na 5.8. Aula em docs/aulas/05-09-primeira-consulta-laravel.md.

Implementação: apenas backend/routes/console.php, além dos registros da aula.
Importada a fachada DB e registrado loja:verificar-banco com Artisan::command.
Closure chama DB::selectOne com SELECT DB_NAME() AS banco, SUSER_SNAME() AS
login, USER_NAME() AS usuario. Três saídas via $this->line e purpose para ajuda.
Comando sem argumentos; usa conexão padrão e credenciais locais da 5.8.
Não cria tabelas nem modifica dados. Bootstrap existente já carrega console.php.

Explicação apresentada: entrada de terminal versus rota HTTP, importação use,
fachadas Artisan/DB e serviços do container Laravel, closure ligada ao comando,
SELECT sem FROM, funções de contexto SQL Server, aliases AS, selectOne e objeto
com propriedades acessadas por ->, concatenação PHP e saída line/purpose.

Verificações executadas em Docker:

- php -l /app/routes/console.php: sem erro de sintaxe.
- php artisan help loja:verificar-banco: nome e descrição registrados.
- php artisan loja:verificar-banco --no-ansi: saída Banco: loja, Login: loja_app,
  Usuário: loja_app; código 0. Demonstra conexão e execução de SQL pelo Laravel
  com os drivers instalados, a rede e a conta configurada. Não demonstra ainda
  persistência de produtos ou permissões de escrita sobre tabelas da aplicação.
- HTTP /loja: 200, título, Camiseta/Calça/Tênis e X-Curso preservados.
- git diff --check passou; .env e backend/.env ignorados. Sem migrations,
  nova dependência, novo serviço, mudança de credenciais ou contador didático.

Entendimento da 5.9: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 173ed00 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 173ed0089496181ec510cd521d7995a62045ca54.
Próximo passo realizado na 5.10: modelagem
inicial da tabela produtos (colunas, tipos e chave primária), antes de migration.

## Etapa 5.10

Objetivo: definir estrutura inicial da tabela produtos antes de escrever a
migration. Entrega em docs/aulas/05-10-modelagem-produtos.md, sem código novo.

Desenho documentado:

- id BIGINT, gerado com IDENTITY(1,1), chave primária única e não nula.
- nome NVARCHAR(150), obrigatório; nomes podem se repetir.
- preco_em_centavos INT, obrigatório; mantém a unidade monetária do módulo 3.
- status NVARCHAR(20), obrigatório, valores de negócio ativo/inativo e
  valor inicial planejado ativo; coerente com StatusProduto.
- created_at/updated_at DATETIME2(3) anuláveis, para criação/atualização,
  com convenção UTC na aplicação. Tipo não armazena fuso.
- Regras de nome com conteúdo, preço não negativo e status válido documentadas;
  tipos não garantem essas regras sozinhos. Restrições/validação serão implementadas
  nas etapas próprias, sem alegar que já estão aplicadas no banco.

Explicação apresentada: tabela/linha/coluna; relação com atributos de Produto,
tipos e NULL; chave primária versus nome e geração IDENTITY; preço em centavos;
estado ativo/inativo e datas do registro. Exemplo de duas Camisetas com ids e
preços distintos apenas ilustrativo, sem inserção SQL.

Verificação: comparação com src/Produto.php e src/StatusProduto.php, fontes
oficiais Microsoft sobre tipos/chave/identidade e git diff --check. Documentação
como única alteração da 5.10; sem comando de aplicação, consulta SQL, migration,
nova dependência, credencial ou alteração de volume/contador. Sem testes de
aplicação adicionais, pois nenhum código ou esquema foi modificado nesta etapa.

Entendimento da 5.10: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint b160a68 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em b160a6827c99cd30f6edbea3e1f19556fc06b147.
Próximo passo realizado na 5.11: explicar
migrations e gerar somente o esqueleto de produtos, sem executá-lo no banco.
A credencial de execução de migrations será preparada em etapa própria.

## Etapa 5.11

Objetivo: apresentar migrations e gerar só o arquivo inicial de produtos.
Aula em docs/aulas/05-11-primeira-migration.md. Uma adição PHP:
backend/database/migrations/2026_10_14_123220_create_produtos_table.php.

Implementação: make:migration create_produtos_table --create=produtos
--no-interaction em container backend temporário, com --rm, -T e --no-deps.
Montagem adicional somente de database/migrations como rw e usuário/grupo do
host para arquivo editável. Conteúdo padrão gerado: imports Migration,
Blueprint e Schema; classe anônima retornada, up com Schema::create e
id()/timestamps(); down com dropIfExists. Nenhum ajuste antecipado das colunas.

Explicação apresentada: migration como mudança de estrutura versionada;
gerar arquivo versus aplicar ao banco, pasta/nome/prefixo UTC e ordem;
comando Docker/Artisan, opções e montagem; classe anônima/herança/imports,
up/down, Schema, Blueprint, id/timestamps e remoção de tabela em reversão.
Arquivo inicial difere do desenho completo; nome/preço/status e precisão
das datas serão preenchidos na 5.12.

Verificações:

- Docker Compose: serviços ativos; ajuda make:migration conferida.
- Gerador concluído com código 0; arquivo único, dono 1000:1000, permissão 644.
- php -l no arquivo gerado: sem erro de sintaxe.
- Diagnóstico temporário PHP em Docker fez require do arquivo e confirmou
  instanceof Migration, sem chamar up/down. SELECT de metadados sys.tables
  retornou banco loja e total 0 para dbo.produtos/dbo.migrations.
- git diff --check passou; arquivos PHP anteriores, Compose/imagens, .env e
  contador preservados. Sem execução de migrate/rollback, instalação de Boost
  ou outras dependências. Regras raiz PHP 8.4/Docker prevalecem sobre bootstrap
  gerado de backend/AGENTS.md, como nas etapas anteriores.

Entendimento da 5.11: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 3e5cb93 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 3e5cb9370b37ddc666d4ccd84441589644a0256f.
Próximo passo realizado na 5.12: preencher
a migration com nome, preco_em_centavos, status e precisão planejada de datas,
sem executá-la no banco. Credencial de migrations ainda terá preparação própria.

## Etapa 5.12

Objetivo: preencher a definição de produtos segundo a modelagem 5.10, sem
aplicá-la ao banco. Aula em docs/aulas/05-12-colunas-produtos.md.

Implementação: apenas backend/database/migrations/2026_10_14_123220_create_produtos_table.php,
além dos registros. Adicionados string('nome', 150), integer('preco_em_centavos'),
string('status', 20)->default('ativo'); timestamps() passou a timestamps(3).
Imports, classe, id, up/down e migrations geradas anteriores preservados.

Explicação apresentada: nomes e tipos do Blueprint, encadeamento default na
definição de coluna, valor quando INSERT omite status, campos NOT NULL e
diferença entre default/validação de conteúdo; datas anuláveis com precisão 3.
Relação migration/modelagem e tradução específica de SQL Server para NVARCHAR,
INT e DATETIME2(3), conferida no compilador instalado e no SQL simulado.
Regras de nome com conteúdo, preço não negativo e conjunto de status seguem
documentadas, mas ainda sem validação/restrições de conteúdo implementadas.

Verificações em Docker:

- php -l na migration: sem erro de sintaxe.
- Programa temporário inicializou Laravel e chamou up dentro de
  DB::connection()->pretend(...), capturando uma única instrução CREATE TABLE
  sem executá-la no servidor. Conferidos id BIGINT NOT NULL IDENTITY PRIMARY KEY,
  nome NVARCHAR(150) NOT NULL, preço INT NOT NULL, status NVARCHAR(20) NOT NULL
  DEFAULT 'ativo' e datas DATETIME2(3) NULL.
- SELECT real de metadados após simulação confirmou banco loja e total 0
  para dbo.produtos/dbo.migrations. Isso demonstra geração do SQL, ainda não
  aceitação do DDL pelo servidor ou persistência de catálogo.
- git diff --check passou; .env ignorados; sem migrate/rollback, alteração de
  credencial, dependência, serviço, controller/view ou contador. Regras raiz
  PHP 8.4/Docker seguem prevalecendo sobre bootstrap gerado do backend.

Entendimento da 5.12: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint bbec195 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em bbec195570dc903909bc0a629ce78c57e9ed5d6a.
Próximo passo iniciado na 5.13: preparar
login/usuário exclusivo de migrations no banco loja e explicar permissões
de estrutura versus dados, mantendo a conta da aplicação em seu escopo atual.
Não aplicar migration antes da etapa própria de execução.

## Etapa 5.13 — Conta exclusiva de migrations

Objetivo: preparar login/usuário exclusivo de migrations em loja, com acesso
a dados e estrutura dbo. Aula em docs/aulas/05-13-conta-migracoes.md.

Preparação local:

- .env.example da raiz ganhou MSSQL_MIGRATIONS_PASSWORD vazio.
- docker/sqlserver/criar-usuario-migracoes.sql cria login/usuário loja_migracoes
  quando ausentes, CHECK_POLICY ON, banco padrão loja, esquema padrão dbo;
  associa db_datareader/db_datawriter e concede CREATE TABLE no banco loja
  e ALTER ON SCHEMA::dbo. Nenhum sysadmin/db_owner ou usuário de loja_test proposto.
- PHP 8.4 em Docker gerou a senha local, sem imprimir o valor, com campo
  ausente/vazio, comparação preservando demais linhas e modo 600, dono 1000:1000.
  Conta loja_app e backend/.env preservados; sem configuração Laravel da nova conta.

Explicação apresentada: dados versus estrutura, identidade exclusiva, alcance
de GRANT e esquema dbo, papéis de dados, modelo público e senha privada, script
reaplicável, comando de preparação administrativa usando sqlcmd e variáveis locais.
ALTER em dbo permite modificar/remover objetos desse esquema, além das operações
de dados; alcance apresentado para a autorização necessária.

Verificações realizadas: serviços ativos; ausência de login/usuário consultada
antes da preparação; senha gerada com demais campos preservados; revisão do
SQL contra documentação Microsoft; git diff --check e .env ignorados. Backend,
migrations, laboratório, Compose e imagens sem alteração.

Execução rejeitada antes de iniciar o processo pelo auto-review. Motivo:
"A ação cria uma conta persistente no SQL Server e concede permissões de
leitura, escrita, CREATE TABLE e ALTER no esquema dbo; embora coerente com a
etapa do curso, não há autorização explícita do usuário para esse alvo e esse
escopo de privilégios." Não houve tentativa de contornar a rejeição.
Consulta somente de leitura posterior confirmou zero logins/usuários
loja_migracoes e zero tabelas da aplicação naquele momento.

Autorização explícita recebida em 14/10/2026: "Sim, autorizo criar essa conta
com essas permissões", em resposta à pergunta com login/usuário loja_migracoes,
banco loja, db_datareader/db_datawriter, CREATE TABLE e ALTER em dbo, incluindo
modificar/remover objetos desse esquema. Essa aprovação resolve a rejeição
anterior para o alvo e escopo apresentados. Arquivo executado com código 0,
sem ampliar o escopo. Verificações após autorização:

- Login loja_migracoes com política ativa e banco padrão loja; usuário SQL
  associado no banco loja, com esquema padrão dbo.
- Autenticação com própria senha local: banco loja, login/usuário loja_migracoes.
  db_datareader/db_datawriter = 1/1, CREATE TABLE/ALTER dbo = 1/1,
  db_owner/sysadmin = 0/0, HAS_DBACCESS loja_test = 0. Diagnóstico com código 0.
- Conexão solicitando loja_test recusada pelo SQL Server com erro de banco
  inacessível: resultado esperado. Sem usuário dessa conta em loja_test.
- Arquivo reaplicado com código 0 e diagnóstico repetido após reaplicação:
  autenticação com mesma senha e todas as permissões esperadas preservadas.
- Laravel autenticou como loja_app com leitura/escrita 1/1 e CREATE TABLE/ALTER
  dbo 0/0; banco loja com zero tabelas. Sem migrate/rollback ou teste de DDL.
- git diff --check passou; .env ignorados; backend/migrations/Compose e demais
  código/imagens preservados. Senha não exibida ou versionada.

Implementação SQL, explicação e verificações concluídas; entendimento da 5.13
confirmado com "entendi" em 14/10/2026, após a autorização e execução.
Publicação: checkpoint preparado para commit/push autorizado; último publicado bbec195.
Próximo passo exato: publicar 5.13 confirmada
checkpoint e configurar conexão Laravel exclusiva de migrations na 5.14,
preservando conexão padrão loja_app e copiando senha somente ao .env local.
Autorização persistente de publicação de checkpoints na main continua válida.

## Verificações e limitações do ambiente

- Pasta inicial inspecionada: sem aplicação ou documentação anterior.
- Git instalado e repositório local inicializado na etapa 1.3.
- A inicialização exigiu execução ampliada devido à montagem somente leitura
  de `.git` no modo restrito. As leituras posteriores funcionaram nesse modo.
  Se uma futura escrita falhar, usar o fluxo de execução ampliada autorizado;
  não alterar permissões manualmente nem assumir que o Git está inacessível.
- Docker 29.8.2 e Docker Compose v5.5.1 instalados.
- Acesso ao daemon Docker: verificado na etapa 2.1; modo restrito retorna
  permissão negada, execução ampliada acessa o daemon 29.8.1, Linux x86_64.
  Usar o fluxo ampliado autorizado para operações que acessam o serviço;
  primeiro container PHP do curso executado e removido na etapa 2.2.
- Documentação verificada: três arquivos presentes e legíveis em UTF-8; módulos
  1 a 23 em ordem e sem duplicação; registros de entendimento e publicação
  corretamente pendentes. Nenhum teste de aplicação é aplicável ainda.

## Git e GitHub

- Repositório local: branch `main`; etapa 1.5 registra o primeiro checkpoint
  com os cinco arquivos iniciais. Acompanhamento de `origin/main` configurado.
- Destino remoto: `origin` configurado para `julesjrenck/curso-loja-fullstack`;
  criação, visibilidade pública e histórico publicado verificados.
- Conta pelo conector: `julesjrenck`; acesso Git SSH verificado após o cadastro
  da chave pública pelo aluno.
- Primeiro commit local: `afb0d2c`, `docs: inicia curso e registra progresso`.
- Último commit local publicado nesta retomada: `bbec195`,
  `feat: define colunas da migration de produtos`.
- Primeiro envio verificado: `a43617042726cda586c24b630eab8734b53f7a3c`.
- Último commit publicado: consultar `git rev-parse origin/main` ou a página
  do repositório; comparar com `git rev-parse HEAD` para conferir sincronização.
- Remoto consultado em 14/10/2026 após o push com `git ls-remote`: `bbec195`,
  igual a HEAD e origin/main. Preparação/documentação da 5.13 ainda fora de commit.
  A rejeição inicial foi resolvida por aprovação explícita do aluno para
  publicar os checkpoints concluídos na branch pública `main` deste repositório;
  essa autorização permanece válida para os próximos checkpoints concluídos.
- Publicação das etapas 1.1 a 1.7: primeiro envio concluído; esta atualização
  do registro deve ser enviada após o commit e verificada novamente.

## Esclarecimento sobre SSH

Pergunta do aluno: a configuração SSH vale para todos os projetos? Antes havia
SSH somente local?

Explicação apresentada:

- SSH é um protocolo de comunicação segura. O computador já tinha um par de
  chaves; o curso reutilizou esse par, sem gerar outro.
- A chave privada fica em `~/.ssh/id_ed25519`; a pública tem uma cópia em
  `~/.ssh/id_ed25519.pub` e foi cadastrada na conta GitHub do aluno.
- O título `curso-loja-fullstack` no cadastro é um rótulo, não uma restrição de
  acesso ao repositório. Trata-se de chave de autenticação da conta, não deploy key.
- Neste computador, a mesma chave pode autenticar operações SSH em outros
  repositórios GitHub acessíveis à conta, respeitando suas permissões e políticas.
- A chave identifica a conta; ela não concede automaticamente acesso de escrita
  a repositórios de outras pessoas ou organizações.
- Cada projeto continua precisando do seu próprio endereço remoto. Um endereço
  SSH como `git@github.com:julesjrenck/outro-projeto.git` pode usar a mesma chave.
- Outra máquina não herda automaticamente a chave privada deste computador;
  outros serviços também não herdam o cadastro feito no GitHub.
- `~/.ssh/known_hosts` guarda chaves públicas dos servidores conhecidos, para
  reconhecer o servidor GitHub; não substitui o cadastro da chave do usuário.
- A presença das chaves locais, por si só, não comprova cadastro anterior no
  GitHub nem configuração de um servidor SSH para receber conexões no computador.

Fontes: [Sobre SSH](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/about-ssh),
[Cadastro de chave na conta](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)
e [Diferença para deploy keys](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/managing-deploy-keys).

Explicação registrada e entendimento confirmado pelo aluno com "entendi" antes
do início do módulo 2. O checkpoint anterior `e40d8fa` foi publicado e verificado
antes deste esclarecimento.

### Como as chaves são geradas

Pergunta complementar do aluno: como gerar o par de chaves localmente?

Exemplo didático, não executado durante esta explicação:

```bash
ssh-keygen -t ed25519 -C "seu-email@exemplo.com" -f ~/.ssh/id_ed25519_exemplo
```

- `ssh-keygen` gera o par de chaves no computador.
- `-t ed25519` escolhe o algoritmo; `-C` define um comentário de identificação,
  que não é senha nem faz cadastro no GitHub.
- `-f` escolhe o nome e caminho da chave privada; a pública recebe o sufixo `.pub`.
- O exemplo usa outro nome para preservar o par que já utilizamos.
- A ferramenta pede uma passphrase e sua confirmação. Ela protege a chave privada
  no disco; não é a senha da conta GitHub. Deixar vazio cria a chave sem passphrase.
- O comando cria `id_ed25519_exemplo` e `id_ed25519_exemplo.pub`; não publica,
  não cadastra no GitHub e não configura esse novo nome para uso automático.

Fonte: [Gerar uma chave SSH](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent).

## Dúvidas e próximos passos

- Dúvida da 5.7: sys.database_principals é tabela? Explicada como view de
  catálogo, com metadados de usuários/papéis e esquema sys; entendimento confirmado.
- Dúvida da 5.7: usuário já criado no banco loja? Sim, loja_app está em loja;
  login correspondente pertence ao servidor. Consulta de metadados apresentada.
  Entendimento da 5.7 confirmado com "entendi" em 13/10/2026.
- Dúvida da 5.4: dados de acesso SQL Server. Indicados endereço interno/porta,
  login sa, localização da senha local e master; explicado acesso Docker/host.
  Entendimento confirmado com "entendi"; publicar porta apenas na etapa de acesso.
- Pedido do aluno: avisar quando o acesso pelo DBeaver estiver disponível.
  Aviso cumprido na 5.6 após conexão SQL autenticada pela porta local passar.
  Dados apresentados; aluno relatou "apareceu loja" na consulta pelo DBeaver.
  Acesso confirmado; entendimento da 5.6 confirmado depois com "entendi".
- Dúvida da 5.3: o que é PIE? Esclarecido nome, função, relação com Composer,
  comando de instalação e uso no build; entendimento confirmado com "entendi".
- Dúvida registrada e respondida: alcance da autenticação SSH e diferença entre
  chaves locais, cadastro na conta GitHub e reconhecimento do servidor; exemplo
  de geração local com `ssh-keygen`, sem executar ou substituir as chaves atuais.
- Dúvidas sobre SSH: entendimento confirmado; nenhuma nova dúvida sobre Docker
  registrada até agora.
- Dúvida sobre `trim`: exemplo prático respondido e entendimento confirmado
  junto com a etapa 3.2.
- Dúvida da 3.13: onde ItemCarrinho é chamado e como funciona a composição.
  Chamada identificada na experiência temporária documentada, sem script
  persistente em src naquela etapa. Entendimento confirmado depois da explicação.
  Na 3.14, a chamada foi salva em src/exemplo-item-carrinho.php.
- Ação imediata: publicar conta exclusiva de migrations 5.13 confirmada e iniciar 5.14.
- Aviso do Composer: licença ausente. Configuração válida com código 0;
  nenhuma licença escolhida nesta aula.
- Entendimento da 5.13 recebido: publicar conta e configurar conexão Laravel
  exclusiva de migrations na 5.14, preservando conta padrão da aplicação.
  Integração continuará com banco e credenciais próprios.
- Ao retomar em novo clone, preparar `src/vendor` com `mkdir -p` e gerar
  autoload pelo comando do README; pasta vazia ignorada e arquivos do volume
  não vêm do Git. Não alterar o contador do volume `dados-demo`.
  Não montar antecipadamente Laravel, banco ou frontend.
- Se o repositório já tiver conteúdo, inspecionar antes de enviar; preservar
  o histórico existente, sem sobrescrever ou fazer force-push.

## Histórico

| Data | Etapa | Implementação | Entendimento | GitHub |
| --- | --- | --- | --- | --- |
| 08/10/2026 | 1.1 — Registros do curso | Três arquivos de documentação criados | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.2 — `.gitignore` e README | Regras de exclusão e apresentação criadas | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.3 — Inicialização do Git | Repositório local criado com branch `main` | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.4 — Preparação dos arquivos | Cinco arquivos selecionados para o primeiro commit | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.5 — Primeiro commit | Commit inicial `afb0d2c` verificado | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.6 — Preparação do GitHub | Repositório público criado e `origin` configurado | Confirmado pelo aluno: "criei e entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.7 — Primeiro push | Envio e acompanhamento de `origin/main` verificados | Confirmado pelo aluno: "entendi", após esclarecimentos SSH | Publicado |
| 08/10/2026 | 2.1 — Imagens, containers e acesso | Conceitos apresentados e consulta ao daemon verificada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `7b9008d` |
| 08/10/2026 | 2.2 — Primeiro container PHP | PHP 8.4.26 executado; container removido e imagem preservada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `0a6c1d2` |
| 08/10/2026 | 2.3 — Primeiro Dockerfile | Imagem própria construída e comando padrão verificado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `ec1765a` |
| 08/10/2026 | 2.4 — Código na imagem | Script PHP copiado e executado com diretório de trabalho definido | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `0ae3e9c` |
| 08/10/2026 | 2.5 — Primeiro Compose | YAML validado e serviço PHP construído e executado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `29ed596` |
| 08/10/2026 | 2.6 — Bind mount | Código local alterado lido sem rebuild; cópia da imagem preservada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `79c432c` |
| 08/10/2026 | 2.7 — Servidor e portas | HTTP 200, parada normal e reinício verificados; servidor ativo | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `1b7739d` |
| 08/10/2026 | 2.8 — Variável de ambiente | APP_NAME verificada no container e na resposta HTTP | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `42d152b` |
| 08/10/2026 | 2.9 — .env e modelo | Configuração local interpolada; exclusões e HTTP verificados | Confirmado em 09/10 pelo aluno: "entendi" | Publicado no checkpoint `9dd560f`; .env permanece local |
| 09/10/2026 | 2.10 — Volume de dados | Contador persistido entre containers removidos; HTTP preservado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `99be2d5` |
| 09/10/2026 | 2.11 — Rede interna | Nome php resolvido e HTTP interno/externo verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `72e337e` |
| 09/10/2026 | 3.1 — Primeira classe | Produto tipado criado e utilizado em Docker | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `213486f` |
| 09/10/2026 | 3.2 — Regras do produto | Nome e preço validados; exceção tratada; seis cenários passaram | Confirmado pelo aluno: "entendi", após exemplo de trim | Publicado no checkpoint `ab9ea33` |
| 09/10/2026 | 3.3 — Promoção de propriedades | Construtor simplificado; demonstração e oito verificações passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `83f190b` |
| 09/10/2026 | 3.4 — Namespace e use | Classe Loja\Produto importada; sintaxe e oito verificações passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `253617c` |
| 09/10/2026 | 3.5 — Composer no Docker | Imagem construída; versão, demonstração e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `5360ccb` |
| 09/10/2026 | 3.6 — Configuração Composer | JSON validado com aviso de licença; mapeamento de Produto conferido | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `3e28669` |
| 09/10/2026 | 3.7 — Volume vendor | Volume gravável e persistente; código somente leitura, contador e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `07db654` |
| 09/10/2026 | 3.8 — Autoload Composer | Arquivos gerados; classe carregada por demanda e comportamentos verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `af61127` |
| 09/10/2026 | 3.9 — Enum de estados | Enum e exemplo criados; autoload, casos e tipagem verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `377860a` |
| 09/10/2026 | 3.10 — Estado de Produto | Estado tipado, padrão e getter; sintaxe e onze cenários passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `a0e1042` |
| 09/10/2026 | 3.11 — Ações de Produto | Ativar e desativar; retomada e demonstração em 12/10 | Confirmado pelo aluno: "entendi", em 12/10/2026 | Código em `8d54d1a`; confirmação `0c2106b` publicada no envio de `846ada2` |
| 12/10/2026 | 3.12 — Interface Precificavel | Contrato e implements; sintaxe, demonstração e parâmetro tipado verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em `846ada2` |
| 12/10/2026 | 3.13 — Composição com ItemCarrinho | Classe, getters e quantidade positiva; sintaxe e experiência verificadas | Confirmado pelo aluno: "entendi", após esclarecimento | Publicado e verificado em `197470b` |
| 12/10/2026 | 3.14 — Subtotal do item | Método e exemplo persistente; sintaxe, três cálculos e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em `b45dc75` |
| 12/10/2026 | 3.15 — Requisitos de PHPUnit | Conceito e diagnóstico documentados; PHP e extensões atendem aos requisitos | Confirmado pelo aluno: "entendi" | Publicado e verificado em `3dba56d` |
| 12/10/2026 | 3.16 — Instalação de PHPUnit | PHPUnit 13.4.1, lockfile e unzip; instalação e verificações passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `9a9c43a` |
| 12/10/2026 | 3.17 — Primeiro teste PHPUnit | Teste do subtotal de três unidades; sintaxe e uma asserção passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `071aacd` |
| 12/10/2026 | 3.18 — Teste de quantidade zero | Expectativa de exceção acrescentada; sintaxe e dois testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `9d6ceb0` |
| 12/10/2026 | 3.19 — Teste de quantidade negativa | Cenário -1 acrescentado; sintaxe e três testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `188ff33` |
| 12/10/2026 | 3.20 — Teste da menor quantidade válida | Quantidade 1 e subtotal 4990; sintaxe e quatro testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `95630cd` |
| 12/10/2026 | 3.21 — Teste de preço zero | Produto gratuito e subtotal 0; sintaxe e cinco testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `a5caa53` |
| 12/10/2026 | 3.22 — Revisão do módulo 3 | Revisão e demonstração concluídas; módulo 3 encerrado | Confirmado pelo aluno: "entendi" | Publicado e verificado em `7a4dc00` |
| 12/10/2026 | 4.1 — Preparação para Laravel | Papel e organização documentados; PHP, Composer e treze extensões conferidos | Confirmado pelo aluno: "entendi", em 13/10/2026 | Publicado e verificado em `9807e53` |
| 13/10/2026 | 4.2 — Esqueleto Laravel | Modelo v13.11.0 e 58 arquivos; JSON, quatro sintaxes e artefatos adiados conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em cfa2e69 |
| 13/10/2026 | 4.3 — Serviço Docker do backend | Serviço e volume exclusivos; PHP/Composer, montagens e persistência verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em dc9f4b8 |
| 13/10/2026 | 4.4 — Dependências Laravel | 76 pacotes instalados, lockfile e autoload gerados; validação, plataforma e classes conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 4c6df27 |
| 13/10/2026 | 4.5 — Pastas graváveis | Montagens de storage e bootstrap/cache; escrita, leitura e limpeza verificadas | Confirmado pelo aluno: "entendi" | Publicado e verificado em 7c0fcea |
| 13/10/2026 | 4.6 — Ambiente Laravel | Modelo adaptado, cópia local criada; leitura de variáveis, tipos e exclusões conferidas | Confirmado pelo aluno: "entendi" | Publicado e verificado em ae521c9; .env ignorado |
| 13/10/2026 | 4.7 — Artisan e chave | Console inicializado, chave local e manifests gerados; criptografia e carregamento conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 590f98a; chave e manifests ignorados |
| 13/10/2026 | 4.8 — Servidor Laravel | Backend na porta 8002; welcome HTTP 200, artefatos e parada/reinício verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6ccf825 |
| 13/10/2026 | 4.9 — Primeira rota da loja | GET /loja com saudação configurada; sintaxe, registro e respostas conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1671a0b |
| 13/10/2026 | 4.10 — Primeiro controller | LojaController@index ligado à rota; sintaxes, registro e resposta preservada conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em f31b38e |
| 13/10/2026 | 4.11 — Primeira view Blade | Template loja e dados pelo controller; sintaxe, HTTP, renderização e escape conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1d93ab8 |
| 13/10/2026 | 4.12 — Lista com Blade | Nomes demonstrativos e @foreach; sintaxe e três itens renderizados conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 37b7485 |
| 13/10/2026 | 4.13 — Lista vazia | Condição Blade e mensagem; listas preenchida/vazia renderizadas e HTTP conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em b944f4e |
| 13/10/2026 | 4.14 — Primeiro middleware | Classe ligada a /loja; sintaxes, cabeçalho, conteúdo e escopo HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 354626c |
| 13/10/2026 | 4.15 — Injeção no método | Classe de catálogo recebida pelo controller; sintaxes e HTTP preservado conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em dca8ccd |
| 13/10/2026 | 4.16 — Injeção no construtor | Propriedade promovida e acesso por $this; sintaxe e HTTP preservado conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5da3709 |
| 13/10/2026 | 4.17 — Contrato e binding | Interface, implementação, controller e provider; sintaxes, resolução e HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 92d6e5f |
| 13/10/2026 | 4.18 — Papel do Model | User existente explicado e atributos demonstrados em memória; código preservado | Confirmado pelo aluno: "entendi" | Publicado e verificado em aa372c6 |
| 13/10/2026 | 4.19 — Revisão do módulo 4 | Fluxo e entrega revisados; módulo 4 concluído | Confirmado pelo aluno: "entendi" | Publicado e verificado em 2346772 |
| 13/10/2026 | 5.1 — Preparação SQL Server | Recursos Docker, PHP e compatibilidade conferidos; sem instalação | Confirmado pelo aluno: "entendi" | Publicado e verificado em 41d0660 |
| 13/10/2026 | 5.2 — ODBC no backend | Imagem própria, ODBC 18.7.1.1-1 e recriação; bibliotecas/plataforma/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5709dfe |
| 13/10/2026 | 5.3 — Extensões SQL Server | sqlsrv/pdo_sqlsrv 5.13.3 via PIE 1.5.2; carregamento, PDO, .ini, plataforma e HTTP conferidos | Confirmado pelo aluno: "entendi", após esclarecimento PIE | Publicado e verificado em 5ba53e2 |
| 13/10/2026 | 5.4 — Serviço SQL Server | Imagem fixa, volume e senha local; inicialização, versão, edição, SELECT 1 e rede conferidos | Confirmado pelo aluno: "entendi", após dúvidas de acesso | Publicado e verificado em d9fba40; .env ignorado |
| 13/10/2026 | 5.5 — Bancos loja e loja_test | SQL de preparação; estado, arquivos, conexões e reexecução conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em fc2cdbc |
| 13/10/2026 | 5.6 — Acesso DBeaver | Porta local conferida; aluno relatou "apareceu loja" na consulta pelo DBeaver | Confirmado pelo aluno: "entendi", após resultado de acesso | Publicado e verificado em c7f58ee |
| 13/10/2026 | 5.7 — Login e usuário da aplicação | loja_app em loja, senha local e papéis; autenticação/escopo/reexecução conferidos | Confirmado pelo aluno: "entendi", após dúvidas | Publicado e verificado em 063e4eb; .env ignorado |
| 14/10/2026 | 5.8 — Configuração Laravel | Modelo, configuração e senha local; sintaxe/carregamento/preservação/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em e0e06ef; .env ignorado |
| 14/10/2026 | 5.9 — Primeira consulta Laravel | Comando diagnóstico; sintaxe/ajuda/SQL real/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 173ed00; .env ignorado |
| 14/10/2026 | 5.10 — Modelagem de produtos | Desenho, tipos, chave primária e exemplos revisados; sem tabela criada | Confirmado pelo aluno: "entendi" | Publicado e verificado em b160a68 |
| 14/10/2026 | 5.11 — Primeiro arquivo de migration | Gerador, sintaxe, carregamento e ausência de tabelas conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 3e5cb93 |
| 14/10/2026 | 5.12 — Colunas de produtos | Blueprint preenchido, sintaxe e SQL simulado conferidos; tabela ausente | Confirmado pelo aluno: "entendi" | Publicado e verificado em bbec195 |
| 14/10/2026 | 5.13 — Conta de migrations | Conta criada após autorização explícita; autenticação/permissões/escopo/reexecução conferidos | Confirmado pelo aluno: "entendi" | Checkpoint preparado para publicação; .env ignorado |
