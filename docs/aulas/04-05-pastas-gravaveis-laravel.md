# Aula 4.5 — Pastas graváveis do Laravel

## Objetivo e conceito

Preparar os dois diretórios em que o Laravel precisa gerar arquivos, mantendo
o código da aplicação somente leitura. As dependências foram instaladas na 4.4;
nesta aula ajustamos as montagens antes de executar a aplicação.

storage contém locais para arquivos da aplicação, logs, sessões em arquivo e
views compiladas. bootstrap/cache recebe arquivos gerados de inicialização,
como manifests de pacotes e caches de configuração. Esses conteúdos serão
aprofundados conforme usados nas aulas.

O código já aparece em /app por um bind mount somente leitura. Acrescentamos
montagens próprias com escrita para essas duas pastas. Assim, ler código e
gravar arquivos gerados têm permissões diferentes dentro do mesmo container.

## Alteração em compose.yaml

O serviço backend ficou assim:

```yaml
  backend:
    build: .
    command: ["php", "--version"]
    volumes:
      - ./backend:/app:ro
      - vendor-backend:/app/vendor
      - ./backend/storage:/app/storage:rw
      - ./backend/bootstrap/cache:/app/bootstrap/cache:rw
```

Somente as duas últimas linhas foram acrescentadas. A imagem, o comando padrão,
o volume de dependências e o serviço php do laboratório foram preservados.

Cada montagem tem origem, destino e modo de acesso separados por dois-pontos:

| Origem | Destino no container | Acesso e conteúdo |
| --- | --- | --- |
| ./backend | /app | ro: código somente leitura. |
| vendor-backend | /app/vendor | Gravável: pacotes PHP no volume nomeado existente. |
| ./backend/storage | /app/storage | rw: arquivos gerados gravados na pasta local storage. |
| ./backend/bootstrap/cache | /app/bootstrap/cache | rw: arquivos gerados gravados na pasta local bootstrap/cache. |

ro é read-only, somente leitura; rw é read-write, leitura e escrita. As montagens
mais específicas oferecem escrita nesses caminhos, embora a montagem de /app
continue somente leitura. /app/app, /app/config e /app/bootstrap continuam sem
escrita; a exceção dentro de bootstrap é a pasta cache.

Como as origens das duas novas linhas começam com ./, são bind mounts de pastas
locais já existentes no esqueleto. Os arquivos gravados aparecem no computador,
nos caminhos correspondentes de backend. A montagem de vendor continua sendo
um volume nomeado administrado pelo Docker, estudado nas etapas anteriores.

Não foi preciso criar pastas, instalar pacotes ou reconstruir a imagem.
Cada novo docker compose run cria um container com a configuração atualizada.
O serviço backend continua executando comandos temporários, sem servidor Laravel.

## Estrutura e Git

O esqueleto já possui subpastas storage/app/private, storage/app/public,
storage/logs, storage/framework/views, storage/framework/sessions e
storage/framework/cache/data, entre outras. Elas ficam visíveis pela montagem
e foram conferidas como graváveis.

Os .gitignore nas pastas geradas usam * para ignorar conteúdo e !.gitignore
para preservar o próprio arquivo de regras. Outros .gitignore do modelo mantêm
as subpastas necessárias. Assim, o Git guarda a estrutura inicial, enquanto
logs, views compiladas e caches são gerados localmente.

Conferimos especificamente os dois marcadores desta aula com git check-ignore:
um em storage/framework/views e outro em bootstrap/cache. Ambos foram ignorados.
Nenhuma regra nova de exclusão foi necessária.

## Verificações executadas

```bash
docker compose config --quiet
```

Esse comando validou o Compose com código 0, sem imprimir as variáveis locais.
Depois executamos PHP temporário pela entrada padrão:

```bash
docker compose run --rm -T backend php
```

run cria o container com as novas montagens; --rm o remove ao terminar; -T
desabilita o terminal. O código PHP foi enviado pela entrada padrão, sem salvar
um script no projeto.

O diagnóstico leu /proc/mounts e conferiu ro em /app, rw em /app/storage e rw em
/app/bootstrap/cache. is_writable confirmou as permissões, incluindo as pastas
de código somente leitura e as subpastas existentes de storage graváveis.

Um marcador foi criado em cada pasta, usando fopen com modo x:

```php
$arquivo = fopen('/app/bootstrap/cache/verificacao-aula-4-5.txt', 'x');
fwrite($arquivo, "Montagem gravável da aula 4.5.");
fclose($arquivo);
```

x cria um arquivo novo somente se ele não existir, evitando sobrescrever algo
desconhecido. fwrite grava o texto; fclose fecha o arquivo. O diagnóstico também
conferiu os bytes gravados. O outro marcador foi criado da mesma forma em
/app/storage/framework/views/verificacao-aula-4-5.txt.

Após a remoção do primeiro container, cat no host leu o texto exato nos dois
arquivos locais. Outro container leu ambos com file_get_contents, comparou o
conteúdo esperado e removeu somente esses arquivos temporários com unlink.
As verificações no host confirmaram a remoção.

| Verificação | Resultado |
| --- | --- |
| Configuração Compose | Válida, código 0. |
| Montagens e permissões | Código somente leitura; storage e bootstrap/cache graváveis. |
| Gravação de marcadores | Dois arquivos criados e conteúdo conferido. |
| Leitura no host | Mesmo conteúdo presente nas duas pastas locais. |
| Outro container | Conteúdo persistiu após remover o primeiro container. |
| Limpeza e Git | Marcadores removidos; arquivos eram ignorados pelo Git. |
| Código e dependências | Backend, lockfile, src e Dockerfile sem alterações; autoload existente disponível. |
| Ambiente | .env do backend, SQLite e manifests Laravel ainda ausentes. |
| Serviços | Apenas o servidor php do laboratório permaneceu ativo. |

Não executamos Artisan, migrations, testes Laravel ou contador. A verificação
comprova as montagens e a escrita, não uma requisição Laravel ou uso de banco.

## Situação e próximo passo

Implementação e verificações concluídas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint preparado para publicação.
Último checkpoint publicado: 4c6df27, etapa 4.4.

Após confirmação, publicar 4.5 e iniciar 4.6: apresentar backend/.env.example
e preparar backend/.env local para as primeiras rotas sem banco, usando sessão
e cache em arquivo e fila síncrona. A indicação de banco deve seguir SQL Server,
sem provisionar o banco ou executar migrations nessa preparação. Artisan e chave
serão apresentados em etapas posteriores. O ambiente local permanece fora do Git.

Fontes oficiais:

- [Diretórios graváveis exigidos pelo Laravel](https://laravel.com/docs/13.x/deployment#directory-permissions).
- [Bind mounts e acesso somente leitura](https://docs.docker.com/engine/storage/bind-mounts/).
