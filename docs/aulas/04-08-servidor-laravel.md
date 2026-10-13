# Aula 4.8 — Servidor Laravel e primeira página

## Objetivo

Iniciar o servidor de desenvolvimento Laravel no Docker e acessar a página inicial
que veio no modelo. Ambiente, dependências, chave e pastas graváveis já foram
preparados. Nesta etapa alteramos somente a configuração do serviço backend.

## Serviço no Compose

O backend passou a ter estas opções, preservando suas montagens:

```yaml
  backend:
    build: .
    init: true
    command: ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000", "--tries=1", "--no-reload"]
    stop_signal: SIGINT
    ports:
      - "127.0.0.1:8002:8000"
    volumes:
      - ./backend:/app:ro
      - vendor-backend:/app/vendor
      - ./backend/storage:/app/storage:rw
      - ./backend/bootstrap/cache:/app/bootstrap/cache:rw
```

- php artisan serve inicia o servidor PHP de desenvolvimento com o Laravel.
  O diretório de trabalho é /app e os arquivos públicos ficam em public/.
- --host=0.0.0.0 permite ouvir nas interfaces do container, para receber o tráfego
  encaminhado pelo Docker. --port=8000 define sua porta interna.
- --tries=1 limita a tentativa à porta definida, evitando mudar para outra porta
  interna se ela estiver indisponível. As opções foram conferidas em help serve.
- --no-reload desativa reinício automático ao alterar .env. Alterações de código
  continuam visíveis pelo bind mount; mudanças de ambiente pedem reinício do serviço.
- ports usa endereço do host, porta do host e porta do container: o navegador
  acessa 127.0.0.1:8002 e o Docker encaminha para a porta 8000 do backend.
- init:true habilita o processo inicial do Docker, que encaminha sinais e cuida
  dos processos filhos. Artisan serve inicia um processo PHP para atender HTTP.
- stop_signal:SIGINT define o sinal de interrupção enviado ao parar o serviço.

Os dois serviços podem ouvir em 8000 porque cada um tem seu container. O
laboratório publica 8001 no host; o backend publica 8002. Código continua somente
leitura; vendor, storage e bootstrap/cache mantêm as montagens já estudadas.

APP_URL do ambiente corresponde ao endereço publicado, mas a publicação acontece
pela configuração ports do Compose. O servidor permanece voltado ao estudo local.

## Comandos de operação

```bash
docker compose config --quiet
docker compose up -d backend
docker compose ps
docker compose port backend 8000
docker compose logs --tail 8 backend
```

- config --quiet validou o YAML sem imprimir variáveis locais.
- up cria/inicia o serviço e aplica mudanças de configuração. -d mantém o
  container em execução em segundo plano; backend seleciona apenas esse serviço.
- ps mostrou backend e php ativos, em suas portas locais.
- port backend 8000 confirmou 127.0.0.1:8002.
- logs mostrou Server running on http://0.0.0.0:8000 e o registro da requisição.

Não foi necessário rebuild: o Dockerfile e a imagem não mudaram. O serviço
backend agora permanece ativo, enquanto os comandos de diagnóstico continuam
possíveis com run --rm backend seguido de um comando explícito.

Para parar e iniciar novamente:

```bash
docker compose stop backend
docker compose up -d backend
```

A primeira verificação sem init terminou com saída 137, encerramento forçado.
Após acrescentar init:true, a parada terminou rapidamente com saída 130,
correspondente à interrupção por SIGINT. O backend foi reiniciado e a página
verificada novamente. O laboratório permaneceu ativo durante todo o procedimento.

## De onde veio a página

A rota existente em backend/routes/web.php é:

```php
Route::get('/', function () {
    return view('welcome');
});
```

Uma requisição GET / chega à entrada public/index.php. Ela carrega o autoload,
obtém a aplicação de bootstrap/app.php e chama handleRequest(Request::capture()).
A configuração de bootstrap liga as rotas web ao arquivo routes/web.php.

A rota devolve view('welcome'), que localiza resources/views/welcome.blade.php.
Blade gera PHP a partir do template e o Laravel produz o HTML enviado ao navegador.
O título usa config('app.name', 'Laravel'), que nesta configuração retorna
Loja Fullstack. A página contém o texto Let's get started do modelo oficial.

Nesta etapa apresentamos esse caminho básico; rotas próprias, controllers e
views da loja serão construídos nos próximos passos. O template existente tem
estilos embutidos para funcionar enquanto o frontend e seu build ainda não entraram.

## Arquivos gerados

A primeira requisição gerou uma view compilada sob storage/framework/views,
como um arquivo PHP com nome calculado pelo Laravel, e um arquivo de sessão sob
storage/framework/sessions. A view compilada é um resultado do template; a sessão
guarda dados entre requisições conforme SESSION_DRIVER=file.

O diagnóstico apresentou apenas contagens, sem exibir conteúdo ou identificadores
de sessão. Ambos ficam nas pastas locais graváveis e são ignorados pelo Git.
Depois de outras requisições, novos arquivos de sessão podem surgir.

## Verificações

- Porta 8002 disponível antes da configuração; Compose válido.
- Serviço criado e iniciado, com publicação somente em 127.0.0.1:8002.
- PHP em um container temporário com --network host consultou as portas publicadas
  do computador. O teste executou em Docker, conforme as regras do curso.
- GET http://127.0.0.1:8002/ retornou HTTP 200; título Loja Fullstack e texto do
  template welcome conferidos, sem imprimir HTML completo ou cookies.
- Laboratório em 127.0.0.1:8001 também retornou HTTP 200.
- View e sessão geradas, legíveis; pastas graváveis e código somente leitura.
- Parada/reinício com init verificados; ambas as páginas novamente HTTP 200.
- Git confirmou arquivos gerados ignorados; código, Dockerfile e lockfile preservados.
- Sem instalação de pacotes, banco, migrations, frontend, testes Laravel ou contador.

O resultado demonstra uma primeira requisição Laravel com renderização Blade e
sessão em arquivo. Ainda não demonstra regras da loja ou acesso a banco.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Backend e laboratório permanecem ativos.
Checkpoint preparado para publicação. Último publicado: 590f98a, etapa 4.7.

Após confirmação, publicar 4.8 e iniciar 4.9: acrescentar GET /loja em
backend/routes/web.php, com uma resposta textual usando o nome da aplicação.
Apresentar método HTTP, caminho, função de atendimento e transformação da resposta.
Controllers e uma view própria entrarão em etapas seguintes, sem antecipar banco.

Fontes oficiais:

- [Portas no Docker Compose](https://docs.docker.com/reference/compose-file/services/#ports).
- [Processo init no Compose](https://docs.docker.com/reference/compose-file/services/#init).
- [Ciclo da requisição Laravel](https://laravel.com/docs/13.x/lifecycle).
