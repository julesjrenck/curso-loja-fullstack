# Progresso do curso

## Estado atual

- Última atualização: 09/10/2026, referência de data America/Sao_Paulo.
- Módulo atual: 3 — PHP moderno e OOP.
- Etapa atual: 3.4 — Namespace e importação com use.
- Situação: classe identificada como `Loja\Produto` e demonstração executada;
  sintaxe e oito comportamentos verificados, aguardando entendimento da etapa 3.4.
- Entendimento confirmado: módulos 1 e 2 completos, cada avanço confirmado
  pelo aluno com "entendi". As etapas 3.1 a 3.3 foram confirmadas em 09/10/2026.
- Módulos 4 a 23: não iniciados.

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
Entendimento da etapa 3.4: pendente. Aguardar confirmação antes de Composer.

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
- Último commit local: consultar `git log -1 --oneline`; mensagem do checkpoint
  desta sessão: `refactor: organiza Produto em namespace Loja`.
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

- Dúvida registrada e respondida: alcance da autenticação SSH e diferença entre
  chaves locais, cadastro na conta GitHub e reconhecimento do servidor; exemplo
  de geração local com `ssh-keygen`, sem executar ou substituir as chaves atuais.
- Dúvidas sobre SSH: entendimento confirmado; nenhuma nova dúvida sobre Docker
  registrada até agora.
- Dúvida sobre `trim`: exemplo prático respondido e entendimento confirmado
  junto com a etapa 3.2.
- Ação imediata: concluir explicação de namespace e `use`, publicar
  o checkpoint e aguardar entendimento da etapa 3.4.
- Após a confirmação: etapa 3.5 — disponibilizar Composer na imagem PHP,
  usando uma versão fixada e compatível, explicar a mudança no Dockerfile,
  construir e verificar `composer --version`. Autoload em etapa posterior.
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
| 09/10/2026 | 3.4 — Namespace e use | Classe Loja\Produto importada; sintaxe e oito verificações passaram | Aguardando confirmação | Checkpoint a conferir após envio |
