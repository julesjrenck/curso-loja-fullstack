# Progresso do curso

## Estado atual

- Última atualização: 08/10/2026, referência de data America/Sao_Paulo.
- Módulo atual: 1 — Preparação, Git e GitHub.
- Etapa atual: 1.7 — Primeiro push e autenticação SSH.
- Situação: autenticação SSH verificada e primeiro push concluído; dúvida sobre
  o alcance das chaves SSH respondida; aguardando confirmação de entendimento
  das explicações de SSH e push antes de iniciar Docker.
- Entendimento confirmado: etapas 1.1 a 1.6; a última confirmada com
  "criei e entendi". A etapa 1.7 ainda não foi confirmada.
- Módulos 2 a 23: não iniciados.

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

Entendimento da etapa 1.7: pendente. Não iniciar Docker até o aluno confirmar
o entendimento da explicação do push.

## Verificações e limitações do ambiente

- Pasta inicial inspecionada: sem aplicação ou documentação anterior.
- Git instalado e repositório local inicializado na etapa 1.3.
- A inicialização exigiu execução ampliada devido à montagem somente leitura
  de `.git` no modo restrito. As leituras posteriores funcionaram nesse modo.
  Se uma futura escrita falhar, usar o fluxo de execução ampliada autorizado;
  não alterar permissões manualmente nem assumir que o Git está inacessível.
- Docker 29.8.2 e Docker Compose v5.5.1 instalados.
- Acesso ao daemon Docker: a inspeção no planejamento retornou permissão negada
  para o socket. Reavaliar na aula de Docker; containers ainda não executados.
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
- Último commit local: consultar `git log -1 --oneline`; mensagem do checkpoint
  desta sessão: `docs: esclarece escopo das chaves SSH`.
- Primeiro envio verificado: `a43617042726cda586c24b630eab8734b53f7a3c`.
- Último commit publicado: consultar `git rev-parse origin/main` ou a página
  do repositório; comparar com `git rev-parse HEAD` para conferir sincronização.
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

Explicação registrada; entendimento ainda não confirmado. O checkpoint anterior
`e40d8fa` foi publicado e verificado antes deste esclarecimento.

## Dúvidas e próximos passos

- Dúvida registrada e respondida: alcance da autenticação SSH e diferença entre
  chaves locais, cadastro na conta GitHub e reconhecimento do servidor.
- Ação imediata: conferir sincronização, explicar o resultado do push e aguardar
  a confirmação de entendimento. Se houver checkpoint local ainda não enviado,
  concluir sua publicação e verificar antes de relatar sincronização.
- Após o aluno confirmar entendimento: concluir o módulo 1 e iniciar a etapa
  2.1 — apresentar imagens e containers e diagnosticar o acesso ao Docker.
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
| 08/10/2026 | 1.7 — Primeiro push | Envio e acompanhamento de `origin/main` verificados | Aguardando entendimento do push | Primeiro envio confirmado; atualização deste registro a conferir após envio |
