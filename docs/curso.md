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
Os módulos 1 a 4 foram concluídos, com entendimento da revisão 4.19 confirmado.
O módulo 5 confirmou e publicou a descoberta de pacotes da 5.33.
Na 5.34, script de loja_testes em loja_test preparado e analisado com PARSEONLY,
sem executar as instruções de criação/concessão. Ausência da conta e de tabelas
conferida depois. Revisão retomada e entendimento da 5.34 confirmado com
"entendi" em 19/10/2026; confirmação publicada em 49a22c5.
Na 5.35, senha local preparada e conta loja_testes criada em loja_test;
autenticação, permissões, ausência de acesso a loja e reexecução verificadas.
Banco de testes continua sem tabelas. Explicação apresentada; entendimento da
5.35 confirmado com "entendi" em 19/10/2026 e publicado em 04a9a7c.
Na 5.36, backend/.env.testing.example preparado e analisado com phpdotenv;
modelo público versionável, arquivos locais com segredos continuam ignorados.
Explicação apresentada; entendimento da 5.36 confirmado com "entendi" em
19/10/2026 e publicado em 1c8c380. Na 5.37, .env.testing local criado com chave
própria e senha existente de loja_testes; carregamento, criptografia e SELECT
Laravel em loja_test conferidos. Ambiente normal segue loja/loja_app.
Entendimento da 5.37 confirmado com "entendi" em 19/10/2026 e publicado em d80d241.
Na 5.38, phpunit.xml passou a sqlsrv/loja_test; XSD, variáveis pelo carregador
real PHPUnit e SELECT Laravel conferidos, sem executar a suíte. Entendimento
da 5.38 confirmado com "entendi" em 19/10/2026 após esclarecer APP_ENV,
publicado em 734fc5f. Na 5.39, dois testes de exemplo apresentados e executados:
2 testes/2 asserções passaram, sem código alterado. Não consultam SQL nem
verificam catálogo; SELECT separado confirmou zero tabelas em loja_test.
Entendimento da 5.39 confirmado com "entendi" em 19/10/2026 e publicado em bdfb1a3.
Na 5.40, migration existente de produtos aplicada somente em loja_test:
produtos vazia e migrations com lote 1. Esquema/status/reexecução conferidos;
banco normal segue loja/loja_app com um produto. Entendimento da 5.40 confirmado
com "entendi" em 19/10/2026 e publicado em b70f6f0. Na 5.41, primeiro teste
de integração para catálogo vazio criado com DatabaseTransactions. Focado:
1 teste/3 asserções; suíte: 3 testes/5 asserções, passaram. SELECT posterior
confirmou zero produtos em loja_test e um em loja. Entendimento da 5.41
confirmado com "entendi" em 19/10/2026 e publicado em 94e4e3d. Na 5.42, setUp
compartilhado e cenário de produto ativo preparados. Focado: 2 testes/6 asserções;
suíte em ordem inversa: 4 testes/8 asserções, passaram. Zero produtos em loja_test
após rollback. Entendimento da 5.42 confirmado com "entendi" em 19/10/2026 e
publicado em aa8e5a4. Na 5.43, cenário com ativo/inativo exige somente o ativo:
focado 3 testes/9 asserções e suíte 5 testes/11 asserções, passaram. Zero produtos
em loja_test após rollback. Entendimento da 5.43 confirmado com "entendi" em
19/10/2026 e publicado em 62f465e. Na 5.44, cenário de ordenação de dois ativos
adicionado; focado 4 testes/12 asserções e suíte 6 testes/14 asserções, passaram.
Entendimento da 5.44 confirmado com "entendi" em 19/10/2026 e publicado em 5810b26.
Na 5.45, estrutura de ProdutoFactory gerada; sintaxe/autoload/herança/modelName
conferidos, definition vazio e nenhum dado criado. Entendimento da 5.45
confirmado com "entendi" em 19/10/2026 e publicado em 3e094e5. Na 5.46,
definição preenchida com nome/preço fictícios e status ativo; dez arrays
conferidos em memória, sem SQL ou models. Entendimento da 5.46 confirmado com
"entendi" após esclarecer os métodos e publicado em 77dc3f9. Na 5.47,
new()->make() montou Produto em memória, com exists false, ID/datas null,
atributos previstos e zero SQL. Entendimento da 5.47 confirmado com "entendi"
em 19/10/2026 e publicado em d90a8a4. Na 5.48, HasFactory adicionado a Produto;
atalho factory()->make conferido em memória, zero SQL. Suíte existente:
6 testes/14 asserções, passou. Entendimento da 5.48 confirmado com "entendi"
em 19/10/2026, após esclarecer o local da demonstração, publicado em d465778.
Na 5.49, factory()->create aplicada somente ao cadastro do teste de ativo:
nome/status sobrescritos, preço padrão. Teste 1/3 e suíte 6/14 passaram;
rollback conferido. Entendimento da 5.49 confirmado com "entendi" em 19/10/2026,
publicado em 9a08b80. Na 5.50, dois cadastros do cenário ativo/inativo usam
factory com nome/status explícitos e preço padrão. Teste 1/3 e suíte 6/14
passaram; rollback conferido. Entendimento da 5.50 confirmado com "entendi" em
19/10/2026, publicado em 10e723b. Na 5.51, factory nos dois cadastros do cenário
de ordenação, preservando nomes, status e ordem de inserção; teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.51 confirmado com "entendi"
em 19/10/2026, publicado em 5152ba4. Na 5.52, inativo(): static na factory usa
state com array; diagnóstico com make conferiu inativo em memória, padrão ativo
preservado e zero SQL. Suíte existente 6/14 passou. Entendimento da 5.52
confirmado com "entendi" em 19/10/2026, publicado em edd3411. Na 5.53, cadastro
da Caneca no teste usa inativo()->create com nome explícito. Teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.53 confirmado com "entendi"
em 19/10/2026, publicado em 6ac5518. Na 5.54, DatabaseSeeder existente apresentado
sem execução; sintaxe/reflexão e SELECTs passaram. Rotina padrão cria usuário,
depende de users, tabela ainda ausente nos dois bancos. Explicadas diferenças
entre migration/factory/seeder. Entendimento da 5.54 confirmado com "entendi"
em 19/10/2026, após nova explicação com exemplo da loja, publicado em def2f14.
Na 5.55, corrigida previsão de gerar ProdutoSeeder: já existe desde a 5.20,
com firstOrCreate desde a 5.24. Arquivo preservado/revisado em relação ao
DatabaseSeeder; sintaxe passou, sem execução. Entendimento da 5.55 confirmado
com "entendi" em 19/10/2026, publicado em 0f754ae. Na 5.56, DatabaseSeeder chama
ProdutoSeeder por call; exemplo de User removido. Sintaxe/autoload passaram,
sem executar seeders. Entendimento da 5.56 confirmado com "entendi" em 19/10/2026,
publicado em 07af123. Na 5.57, db:seed padrão executado em loja_test dentro de
transação: chamou ProdutoSeeder, criou Camiseta e catálogo retornou seu nome.
Rollback/contagens conferidos: teste com zero produtos, normal com um.
Entendimento da 5.57 confirmado com "entendi" em 19/10/2026; depois, 5.58: modelagem inicial de
categorias, relação um para muitos e chave estrangeira, sem alterar esquema ainda.
Módulos 6 a 23 não iniciados.
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
