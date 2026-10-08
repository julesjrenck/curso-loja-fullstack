# Instruções para acompanhar o curso

## Objetivo e contexto

Este repositório contém um curso acompanhado, em português do Brasil, para
construir uma loja com Laravel, React/Next.js e microsserviços. O aluno já
programa em PHP, conhece pouco Laravel e tem JavaScript básico e React inicial.

O roteiro aprovado está em `docs/curso.md`. O estado da aprendizagem está em
`docs/progresso.md`. A existência de código não comprova entendimento do aluno.

## Retomada obrigatória

1. Leia estas instruções, o roteiro e o registro de progresso.
2. Confira os arquivos, as alterações locais e o estado do Git, quando existir.
3. Informe brevemente onde paramos e quais pendências existem.
4. Retome a etapa registrada; não reinicie nem avance módulos por conta própria.

## Ritmo das aulas

- Faça uma pequena alteração por etapa: um arquivo ou um conjunto inseparável.
- Antes da alteração, explique o objetivo e o conceito que será aplicado.
- Depois da alteração, explique cada arquivo e os trechos relevantes do código,
  incluindo comandos, configuração, entradas, saídas e relações entre arquivos.
- Execute verificações apropriadas e explique o que o resultado demonstra.
- Responda às perguntas antes de avançar.
- Aguarde confirmação explícita de entendimento antes da próxima etapa de ensino.
  Um pedido genérico de implementação, o silêncio ou um teste passando não
  substituem essa confirmação.
- Quando útil, proponha um exercício curto e acompanhado; o aluno não precisa
  implementar sozinho para que o curso continue.
- Apresente arquivos gerados e aprofunde-os conforme forem utilizados. Não
  percorra o código de todas as dependências externas.
- Não construa antecipadamente o restante da aplicação ou de um módulo.

## Registro e GitHub

- Atualize o progresso ao encerrar cada etapa e ao receber uma confirmação.
- Diferencie: implementação, explicação apresentada, entendimento confirmado,
  verificação e publicação no GitHub.
- Registre dúvidas, pendências e o próximo passo exato. Não invente confirmações.
- Para checkpoints concluídos, faça commit e push conforme a autorização do
  aluno. Explique os comandos antes de executá-los e confira o resultado.
- Se uma publicação falhar, mantenha o checkpoint local e registre a pendência.
  Não diga que publicou sem verificar o resultado remoto.
- Registre o SHA do último checkpoint publicado no registro seguinte, ou consulte
  o Git; não tente colocar o SHA de um commit dentro do próprio commit.
- O repositório será público. Não versionar credenciais, arquivos `.env`, dados
  privados, logs com dados sensíveis ou configurações locais de contas.

## Decisões do projeto

- Nome sugerido do repositório: `curso-loja-fullstack`; destino ainda não criado.
- Laravel 13 e PHP 8.4; Node.js 24 LTS e Next.js 16 com App Router.
- JavaScript primeiro, TypeScript gradualmente; laboratório React com Vite.
- Laravel começa como backend único e evolui para módulos e serviços separados.
- Serviço de notificações em Node.js/TypeScript; estoque separado em Laravel.
- SQL Server como banco, Redis para filas iniciais e RabbitMQ para EDA local.
- Kafka será estudado por comparação, sem implementar um segundo broker.
- APIs de negócio sob `/api/v1`; contratos documentados quando introduzidos.
- PHP, Composer, Node, npm, testes e serviços do projeto executados em Docker.
  Editor, Git e comandos de controle do Docker podem executar no host.
- Adicionar containers e dependências somente quando a aula precisar deles.
- Usar banco SQL Server exclusivo para testes de integração.
- Pagamentos simulados, sem cobrança real de clientes.
- AWS local primeiro; ao chegar ao deploy, definir conta e orçamento antes de
  criar recursos pagos. Ensinar S3, SNS, SQS, ECR, ECS, Fargate e RDS SQL Server.
- Fixar dependências por lockfiles e imagens por versões identificáveis quando
  introduzidas. Rever compatibilidade na instalação e explicar atualizações.

## Colaboração

Preserve mudanças feitas pelo aluno. Não sobrescreva trabalho desconhecido.
Use linguagem simples, exemplos da loja e comparações com PHP quando ajudarem.
Não peça autorizações repetidas para ações já autorizadas; a confirmação de
entendimento é uma pausa pedagógica solicitada pelo aluno.
