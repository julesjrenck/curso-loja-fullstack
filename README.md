# Curso Loja Fullstack

Projeto de estudo acompanhado: uma loja com catálogo, carrinho, pedidos,
estoque e notificações, construída por etapas explicadas e confirmadas pelo aluno.

## Estado atual

Módulo 1 — Preparação, Git e GitHub: concluído.
Módulo 2 — Docker: concluído.
Módulo 3 — PHP moderno e OOP: etapa 3.2, validações do produto e exceções.
O roteiro, os registros de continuidade, as regras de exclusão e a apresentação
do projeto estão criados. O repositório Git local foi inicializado com a branch
`main`. O checkpoint inicial reúne os cinco arquivos de documentação e regras
de exclusão. O histórico local pode ser consultado com `git log --oneline`.
O [repositório público no GitHub](https://github.com/julesjrenck/curso-loja-fullstack)
está configurado como `origin`. A autenticação SSH funcionou, os commits iniciais
foram publicados e a branch local `main` acompanha `origin/main`.

A aplicação ainda não foi criada. Não há comandos para executar a loja.
Docker e Compose estão instalados. O serviço `php` constrói a imagem pelo
Dockerfile e inicia o servidor PHP 8.4.26 de desenvolvimento.
O Compose monta `./src` em `/app` como somente leitura, permitindo executar
alterações do código local sem reconstruir a imagem. A demonstração responde
em [http://127.0.0.1:8001/](http://127.0.0.1:8001/). A próxima etapa, após
confirmação de entendimento, será simplificar a declaração das propriedades
com promoção no construtor, mantendo as regras do produto.
Na rede do projeto, outros containers acessam `http://php:8000/`.
O volume `dados-demo`, montado em `/dados`, mantém um contador didático
entre execuções de containers temporários.
O estado detalhado e atualizado das aulas fica no registro de progresso.

## Documentação

- [Roteiro dos 23 módulos](docs/curso.md)
- [Progresso e ponto de retomada](docs/progresso.md)
- [Instruções para acompanhar o curso](AGENTS.md)
- [Aula 2.2 — Comando do primeiro container PHP](docs/aulas/02-02-primeiro-container.md)
- [Aula 2.3 — Primeiro Dockerfile](docs/aulas/02-03-dockerfile.md)
- [Aula 2.4 — Código PHP dentro da imagem](docs/aulas/02-04-codigo-na-imagem.md)
- [Aula 2.5 — Primeiro Docker Compose](docs/aulas/02-05-compose.md)
- [Aula 2.6 — Código local com bind mount](docs/aulas/02-06-bind-mount.md)
- [Aula 2.7 — Servidor PHP e portas](docs/aulas/02-07-servidor-e-portas.md)
- [Aula 2.8 — Variáveis de ambiente](docs/aulas/02-08-variaveis-de-ambiente.md)
- [Aula 2.9 — .env local e modelo](docs/aulas/02-09-env-e-modelo.md)
- [Aula 2.10 — Volume de dados](docs/aulas/02-10-volume-de-dados.md)
- [Aula 2.11 — Rede entre containers](docs/aulas/02-11-rede-entre-containers.md)
- [Aula 3.1 — Primeira classe de produto](docs/aulas/03-01-produto-tipado.md)
- [Aula 3.2 — Validações e exceções](docs/aulas/03-02-validacao-e-excecoes.md)

## Executar a demonstração atual

Na raiz do projeto, crie a configuração local a partir do modelo. No Linux com
GNU cp, o comando abaixo preserva um `.env` já existente:

```bash
cp --update=none .env.example .env
```

Edite o nome da aplicação no `.env`, se desejar. Depois:

```bash
docker compose config --quiet
docker compose up -d --build php
```

Acesse [http://127.0.0.1:8001/](http://127.0.0.1:8001/). A resposta é texto simples
com o nome da aplicação, uma mensagem e a versão do PHP. O serviço recebe
APP_NAME por interpolação da configuração local e o script lê seu valor com
`getenv`. O modelo usa `Loja Fullstack`; seu `.env` pode definir outro nome.
Ao editar apenas o script, atualize a página. Mudanças na configuração Compose
precisam ser aplicadas com `docker compose up -d php`; mudanças na imagem exigem
build. Mudanças no `.env` também precisam de `up`. Consulte as aulas 2.7 a 2.9
para a explicação das portas e da configuração.

Para acompanhar e parar o serviço:

```bash
docker compose ps
docker compose logs --tail 10 php
docker compose stop php
```

## Demonstração de persistência

Para executar a demonstração de persistência pelo terminal:

```bash
docker compose run --rm php php contador.php
```

Cada execução incrementa `/dados/contador.txt` no volume nomeado. O contador
recusa acesso HTTP; o servidor principal permanece disponível. Os dados ficam
no armazenamento Docker local, fora do Git. Consulte a aula 2.10 para detalhes.

## Demonstração de rede

Para verificar a comunicação a partir de outro container do projeto:

```bash
docker compose run --rm php php rede.php
```

O diagnóstico resolve `php` pelo DNS da rede e consulta `http://php:8000/`.
O navegador do computador continua usando `http://127.0.0.1:8001/`.

## Demonstração de OOP

Para criar um objeto de produto e consultar seus dados:

```bash
docker compose run --rm php php exemplo-produto.php
```

O exemplo cria uma camiseta válida de 4990 centavos e demonstra o tratamento de
uma tentativa de preço negativo. A classe recusa nome vazio ou composto apenas
pelos espaços de `trim`, e preço negativo; preço zero é permitido. Consulte as
aulas 3.1 e 3.2 para a estrutura e as regras do construtor.

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

O `.env` contém configurações locais e fica fora do Git e do contexto de build.
O `.env.example` é o modelo versionado e usa apenas valores de exemplo, sem
credenciais reais. Arquivos de lock serão versionados com as ferramentas
correspondentes para permitir instalações reproduzíveis.
