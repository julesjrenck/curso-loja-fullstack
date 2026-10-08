# Curso Loja Fullstack

Projeto de estudo acompanhado: uma loja com catálogo, carrinho, pedidos,
estoque e notificações, construída por etapas explicadas e confirmadas pelo aluno.

## Estado atual

Módulo 1 — Preparação, Git e GitHub: concluído.
Módulo 2 — Docker: etapa 2.4, script PHP copiado para a imagem e executado.
O roteiro, os registros de continuidade, as regras de exclusão e a apresentação
do projeto estão criados. O repositório Git local foi inicializado com a branch
`main`. O checkpoint inicial reúne os cinco arquivos de documentação e regras
de exclusão. O histórico local pode ser consultado com `git log --oneline`.
O [repositório público no GitHub](https://github.com/julesjrenck/curso-loja-fullstack)
está configurado como `origin`. A autenticação SSH funcionou, os commits iniciais
foram publicados e a branch local `main` acompanha `origin/main`.

A aplicação ainda não foi criada. Não há comandos para executar a loja.
Docker e Compose estão instalados. Construímos a imagem `curso-loja-php:aula-2.4`
com PHP 8.4.26 e executamos o script `src/index.php` em um container descartável.
A próxima etapa, após confirmação de entendimento, será introduzir Docker Compose.
O estado detalhado e atualizado das aulas fica no registro de progresso.

## Documentação

- [Roteiro dos 23 módulos](docs/curso.md)
- [Progresso e ponto de retomada](docs/progresso.md)
- [Instruções para acompanhar o curso](AGENTS.md)
- [Aula 2.2 — Comando do primeiro container PHP](docs/aulas/02-02-primeiro-container.md)
- [Aula 2.3 — Primeiro Dockerfile](docs/aulas/02-03-dockerfile.md)
- [Aula 2.4 — Código PHP dentro da imagem](docs/aulas/02-04-codigo-na-imagem.md)

## Executar a demonstração atual

Na raiz do projeto:

```bash
docker build -t curso-loja-php:aula-2.4 .
docker run --rm --name curso-loja-php-script curso-loja-php:aula-2.4
```

A demonstração imprime uma mensagem e a versão do PHP. Consulte a aula 2.4 para
a explicação dos arquivos. Ao editar o script local, reconstrua a imagem antes
de executar para incluir a alteração.

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
