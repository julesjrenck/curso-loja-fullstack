# Curso prático: loja com Laravel, React, Next.js e microsserviços

## Objetivo

Construir juntos uma loja com catálogo, carrinho, pedidos, estoque e notificações,
do primeiro container até uma aplicação distribuída na AWS. O curso aproveita o
conhecimento de PHP do aluno e aprofunda Laravel, integração com frontend,
arquitetura, testes e operação. Cada tecnologia entra para resolver um problema
concreto. Não há prazo fixo: cada módulo pode ocupar vários chats.

## Como serão as aulas

Não avançaremos sem confirmação de entendimento da etapa atual.

1. Explicar o objetivo e o problema a resolver.
2. Apresentar o conceito necessário, usando referências de PHP quando útil.
3. Criar ou modificar um arquivo ou um pequeno conjunto inseparável.
4. Explicar cada arquivo, seus trechos e suas relações com o projeto.
5. Executar a verificação e interpretar o resultado.
6. Responder às dúvidas e propor uma pequena experiência quando ajudar.
7. Registrar o progresso e publicar checkpoints concluídos no GitHub.

O professor escreve o código com o aluno acompanhando. Exercícios consolidam
o entendimento sem exigir implementação solitária. Arquivos gerados serão
apresentados e aprofundados conforme usados; dependências externas não serão
estudadas arquivo por arquivo. Testes e boas práticas entram desde as primeiras
funcionalidades e recebem aprofundamento em módulos específicos.

## Módulos

Todos os módulos abaixo são planejados, não funcionalidades já implementadas.
O módulo 1 foi concluído. O módulo 2 está em andamento, na etapa de conceitos e
verificação do acesso ao Docker; módulos 3 a 23 ainda não foram iniciados.
O estado detalhado e as confirmações ficam em `docs/progresso.md`.

| Módulo | Conteúdo | Entrega verificável |
| --- | --- | --- |
| 1. Preparação, Git e GitHub | Terminal, repositório, `.gitignore`, alterações, commits, branches, push e documentação. | Repositório público com roteiro e controle de progresso. |
| 2. Docker desde o começo | Imagens, containers, Dockerfile, Compose, portas, redes, volumes, variáveis, logs e comandos. | Ambiente PHP mínimo funcionando e compreendido. |
| 3. PHP moderno e OOP | Tipos, interfaces, encapsulamento, composição, herança, exceções, enums, namespaces, Composer e autoload. | Pequenas regras da loja em PHP com primeiros testes PHPUnit. |
| 4. Laravel e MVC | Estrutura, Artisan, ciclo da requisição, rotas, controllers, models, views, middleware, container e injeção de dependências. | Primeiras rotas e uma pequena página Blade para entender MVC. |
| 5. SQL Server e persistência | Modelagem, chaves, relacionamentos, SQL, joins, migrations, seeders, factories, Eloquent e Query Builder. | Catálogo persistido em SQL Server no Docker. |
| 6. APIs REST | HTTP, recursos, métodos, status, validação, serialização, paginação, filtros, erros e OpenAPI. | API de catálogo documentada e testada. |
| 7. Autenticação e autorização | Sanctum, cookies, sessões, CSRF, CORS, hashing, policies e permissões. | Acesso de clientes e administradores com operações protegidas. |
| 8. HTML5, CSS3 e JavaScript moderno | Semântica, acessibilidade, formulários, Flexbox, Grid, responsividade, módulos, promises, `async/await` e `fetch`. | Protótipo da vitrine consumindo a API. |
| 9. React na prática | JSX, componentes, props, estado, eventos, hooks, efeitos, formulários, carregamento e erros. | Vitrine e carrinho em laboratório React com Vite. |
| 10. TypeScript e Next.js | Tipagem, interfaces, App Router, layouts, navegação, componentes de servidor e cliente, renderização e cache. | Interface principal em Next.js, reaproveitando o aprendizado de React. |
| 11. Integração Laravel + Next.js | URLs internas e públicas dos containers, autenticação, consumo da API, erros e configuração por ambiente. | Login, catálogo e administração funcionando pela interface. |
| 12. Pedidos e regras de negócio | Checkout, cálculo de valores, estados, transações, concorrência e controle de estoque. | Compra completa com pagamento simulado e proteção contra venda sem estoque. |
| 13. PHPUnit em profundidade | Testes unitários, de integração e HTTP, doubles, factories, isolamento e regressões. | Testes dos comportamentos críticos de catálogo, acesso e pedidos. |
| 14. Clean Code, SOLID e Design Patterns | Responsabilidades, dependências, legibilidade, Strategy, Factory e Adapter. | Refatorações motivadas por problemas reais e protegidas por testes. |
| 15. Domain Driven Design | Linguagem do domínio, entidades, objetos de valor, agregados, casos de uso e bounded contexts. | Laravel organizado em módulos de catálogo, pedidos e estoque. |
| 16. Filas no Laravel | Jobs, workers, Redis, processamento após commit, retries, backoff, timeouts e jobs com falha. | Tarefas demoradas executadas fora da requisição HTTP. |
| 17. EDA e RabbitMQ | Eventos, produtores, consumidores, exchanges, filas, routing keys, confirmação, duplicidade e mensagens com falha. | Eventos de pedidos distribuídos pelo RabbitMQ. |
| 18. Node.js como backend | Runtime, npm, assincronismo, Express, configuração, consumo de eventos, logs e testes. | Serviço independente de notificações em Node.js/TypeScript. |
| 19. Microsserviços na prática | Extração gradual, propriedade dos dados, REST, comunicação assíncrona, contratos e implantação independente. | Estoque em Laravel separado do serviço de pedidos. |
| 20. Confiabilidade distribuída | Idempotência, consistência eventual, outbox, compensações, indisponibilidade e correlação de logs. | Pedidos tratados corretamente com falhas e eventos repetidos. |
| 21. AWS: S3, SNS e SQS | SDK, imagens, tópicos, assinaturas, filas, políticas de acesso, retries e dead-letter queues. | Integrações preparadas e testadas localmente; validação real na etapa de nuvem. |
| 22. AWS: ECS, Fargate e RDS | ECR, imagens de produção, tarefas, serviços, rede, secrets, logs, RDS SQL Server e persistência. | Aplicação implantada no ECS usando Fargate. |
| 23. CI/CD e portfólio | GitHub Actions, verificações, build, publicação de imagens, deploy, rollback e documentação. | Projeto reproduzível e demonstrável, com explicação da arquitetura. |

RabbitMQ será o broker implementado. Kafka será estudado por comparação de logs,
partições, offsets e grupos de consumidores com RabbitMQ e SNS/SQS.

## Arquitetura e versões acordadas

Começaremos com um backend Laravel e o dividiremos gradualmente em módulos.
Depois extrairemos estoque e notificações, preservando checkpoints funcionais.

- Next.js/React: vitrine e painel administrativo.
- Laravel: catálogo, clientes e pedidos.
- Laravel independente: estoque.
- Node.js/TypeScript: notificações.
- SQL Server: persistência, com bancos separados por serviço após a extração.
- Redis: filas Laravel iniciais; RabbitMQ: eventos entre serviços localmente.
- AWS: S3 para arquivos, SNS/SQS para mensageria, RDS para SQL Server,
  ECR para imagens e ECS/Fargate para execução.

As APIs de negócio começarão sob `/api/v1`. Contratos REST e de eventos serão
documentados quando introduzidos. Cada serviço acessará seus próprios dados;
a comunicação entre serviços ocorrerá por contratos.

Versões iniciais: Laravel 13, PHP 8.4, Node.js 24 LTS e Next.js 16 com App Router.
A imagem PHP terá ODBC e as extensões `sqlsrv` e `pdo_sqlsrv`. Versões de imagens
e dependências serão fixadas na introdução de cada ferramenta e sua
compatibilidade será verificada na instalação.

Fontes oficiais consultadas no planejamento:

- [Laravel 13 e requisitos de PHP](https://laravel.com/docs/13.x/releases).
- [Laravel e SQL Server](https://laravel.com/docs/13.x/database#microsoft-sql-server-configuration).
- [Requisitos dos drivers PHP para SQL Server](https://learn.microsoft.com/en-us/sql/connect/php/system-requirements-for-the-php-sql-driver).
- [Versões Node.js](https://nodejs.org/en/about/previous-releases).
- [Next.js 16](https://nextjs.org/blog/next-16).

## Ambiente e verificações

PHP, Composer, Node, npm, testes e serviços do projeto rodarão em Docker.
Editor, Git e comandos de controle do Docker podem ficar no host. Containers
serão adicionados conforme as aulas precisarem deles.

Verificaremos progressivamente acesso ao Docker, volumes, respostas e permissões
da API, interface, transações, concorrência, retries, eventos duplicados e deploy.
Testes de integração usarão banco SQL Server exclusivo para testes.

Pagamentos serão simulados. A prática será local primeiro. Ao chegar à AWS,
definiremos conta, região e limite de gastos antes de criar recursos pagos;
testes locais com doubles não comprovarão a integração real com AWS.

## Continuidade e publicação

`AGENTS.md` orienta as próximas sessões. `docs/progresso.md` registra a aula atual,
explicações, confirmações, dúvidas, verificações, publicação e próximo passo.
Código funcionando não significa conteúdo aprendido. É possível encerrar uma
sessão com uma etapa implementada e aguardando entendimento.

O repositório novo será público, com nome sugerido `curso-loja-fullstack`.
Cada checkpoint concluído terá commit e push; falhas de publicação serão
registradas. Credenciais e dados privados não entrarão no repositório.

A primeira aula começa pelos registros e pela pasta de trabalho. Depois
iniciaremos Git/GitHub, diagnosticaremos o acesso ao Docker e construiremos
o primeiro container PHP, explicando cada instrução antes de adicionar serviços.
