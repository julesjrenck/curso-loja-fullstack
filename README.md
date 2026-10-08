# Curso Loja Fullstack

Projeto de estudo acompanhado: uma loja com catálogo, carrinho, pedidos,
estoque e notificações, construída por etapas explicadas e confirmadas pelo aluno.

## Estado atual

Módulo 1 — Preparação, Git e GitHub: concluído.
Módulo 2 — Docker: etapa 2.5, primeiro serviço PHP definido em Docker Compose.
O roteiro, os registros de continuidade, as regras de exclusão e a apresentação
do projeto estão criados. O repositório Git local foi inicializado com a branch
`main`. O checkpoint inicial reúne os cinco arquivos de documentação e regras
de exclusão. O histórico local pode ser consultado com `git log --oneline`.
O [repositório público no GitHub](https://github.com/julesjrenck/curso-loja-fullstack)
está configurado como `origin`. A autenticação SSH funcionou, os commits iniciais
foram publicados e a branch local `main` acompanha `origin/main`.

A aplicação ainda não foi criada. Não há comandos para executar a loja.
Docker e Compose estão instalados. O serviço `php` constrói a imagem pelo
Dockerfile e executa `src/index.php` com PHP 8.4.26 em um container descartável.
A próxima etapa, após confirmação de entendimento, será disponibilizar o código
local no container durante o desenvolvimento com um bind mount.
O estado detalhado e atualizado das aulas fica no registro de progresso.

## Documentação

- [Roteiro dos 23 módulos](docs/curso.md)
- [Progresso e ponto de retomada](docs/progresso.md)
- [Instruções para acompanhar o curso](AGENTS.md)
- [Aula 2.2 — Comando do primeiro container PHP](docs/aulas/02-02-primeiro-container.md)
- [Aula 2.3 — Primeiro Dockerfile](docs/aulas/02-03-dockerfile.md)
- [Aula 2.4 — Código PHP dentro da imagem](docs/aulas/02-04-codigo-na-imagem.md)
- [Aula 2.5 — Primeiro Docker Compose](docs/aulas/02-05-compose.md)

## Executar a demonstração atual

Na raiz do projeto:

```bash
docker compose config --quiet
docker compose build
docker compose run --rm php
```

A demonstração imprime uma mensagem e a versão do PHP. Consulte a aula 2.5 para
a configuração Compose e a aula 2.4 para o código. Ao editar o script local,
reconstrua a imagem antes de executar para incluir a alteração.

## Tecnologias planejadas

- PHP 8.4 e Laravel 13.
- JavaScript, React, TypeScript e Next.js 16.
- Node.js 24 LTS para o serviço de notificações.
- SQL Server, Redis e RabbitMQ.
- Docker para desenvolvimento e testes.
- AWS: S3, SNS, SQS, ECR, ECS, Fargate e RDS.

As tecnologias serão adicionadas conforme as aulas, começando por um ambiente
PHP mínimo e evoluindo gradualmente até microsserviços.

## Como acompanhar

Cada etapa apresenta um objetivo, uma pequena alteração, a explicação dos
arquivos e uma verificação. A próxima etapa começa após a confirmação de
entendimento do aluno. Dúvidas e checkpoints são registrados para retomada
em outros chats.

Arquivos `.env` contêm configurações locais e ficam fora do Git. Quando forem
introduzidos, seus modelos `.env.example` usarão apenas valores de exemplo,
sem credenciais reais. Arquivos de lock serão versionados com as ferramentas
correspondentes para permitir instalações reproduzíveis.
