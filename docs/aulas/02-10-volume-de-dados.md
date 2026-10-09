# Aula 2.10 — Volume gerenciado para dados

## Objetivo

Verificar que dados salvos em um volume nomeado permanecem disponíveis depois
da remoção de um container. O exemplo é um contador executado pelo terminal.

## compose.yaml

Acrescentamos uma montagem ao serviço PHP e a declaração do volume na raiz:

```yaml
services:
  php:
    volumes:
      - ./src:/app:ro
      - dados-demo:/dados

volumes:
  dados-demo:
```

Esse trecho mostra as montagens; os demais campos do serviço foram preservados.

- `volumes` dentro de `php` especifica o que montar nesse serviço.
- `./src:/app:ro` mantém o código local como somente leitura.
- `dados-demo:/dados` disponibiliza o volume nomeado em `/dados`, com leitura
  e escrita permitidas para esta demonstração.
- `volumes` na raiz declara os volumes nomeados usados pelo projeto.
- `dados-demo:` usa a configuração padrão de volume do Docker.

| Montagem | Origem | Uso nesta aula |
| --- | --- | --- |
| Bind mount | Pasta `src` do projeto no computador | Código editado pelo aluno. |
| Volume nomeado | Armazenamento criado e gerenciado pelo Docker | Dados gerados pelo programa. |

O Compose criou `curso-loja-fullstack_dados-demo`. O volume é independente
da vida de um container e pode ser reutilizado em outras execuções.

## src/contador.php

O script faz quatro operações: lê o valor anterior, soma um, salva o novo valor
e imprime o resultado. O arquivo de dados é `/dados/contador.txt`.

```php
<?php

if (PHP_SAPI !== "cli") {
    http_response_code(403);
    header("Content-Type: text/plain; charset=UTF-8");
    exit("Execute este exemplo pelo terminal." . PHP_EOL);
}

$arquivo = "/dados/contador.txt";
$conteudo = file_exists($arquivo) ? file_get_contents($arquivo) : "0";

if ($conteudo === false) {
    throw new RuntimeException("Não foi possível ler o contador.");
}

$contador = (int) $conteudo + 1;

if (file_put_contents($arquivo, (string) $contador) === false) {
    throw new RuntimeException("Não foi possível salvar o contador.");
}

echo "Execuções registradas: " . $contador . PHP_EOL;
```

- `PHP_SAPI` identifica como o PHP está executando. Aceitamos somente `cli`,
  para que visitas por HTTP não alterem o contador.
- `file_exists` verifica se já há um arquivo; a expressão `? :` escolhe entre
  ler seu conteúdo e começar em `"0"`.
- `file_get_contents` lê o arquivo; `false` indica falha de leitura.
- `(int)` converte o texto para inteiro; `+ 1` incrementa o contador.
- `file_put_contents` salva o valor convertido para string no volume.
- As exceções interrompem a execução se a leitura ou escrita falhar, evitando
  apresentar sucesso sem salvar os dados.
- `echo` mostra o valor registrado, com a quebra de linha já estudada.

O exemplo usa execuções sequenciais para estudar armazenamento. Concorrência
e transações serão aprofundadas nos módulos de regras de negócio e testes.

## Aplicar e executar

```bash
docker compose config --quiet
docker compose up -d php
docker compose run --rm php php contador.php
docker compose run --rm php php contador.php
```

`up` aplica a montagem ao serviço. Em cada `run`, o primeiro `php` seleciona o
serviço; o segundo inicia o programa PHP, com `contador.php` como argumento.
Esse comando substitui o servidor HTTP somente na execução temporária.
O Compose não publica as portas do serviço nesses comandos `run`.

Na primeira demonstração, o volume não existia. As saídas foram:

```text
Execuções registradas: 1
Execuções registradas: 2
```

O `--rm` remove cada container temporário, mantendo o volume nomeado. Novas
execuções continuam a partir do valor existente; não reiniciam o contador.

## Verificações realizadas

- A configuração validou sem erros e criou o volume nomeado do projeto.
- Ambas as execuções terminaram com código 0, em containers diferentes.
- A inspeção confirmou bind mount `/app` sem escrita e volume `/dados` com escrita.
- O servidor principal continuou ativo, respondendo HTTP 200 na porta local 8001.
- `GET /contador.php` retornou HTTP 403; a leitura posterior confirmou valor `2`.
- `docker compose ps -a` mostrou somente o servidor principal: os containers
  temporários foram removidos.
- `docker compose exec -T php cat /dados/contador.txt` confirmou o dado salvo.
- O código entrou no Git; o arquivo de dados permaneceu no volume Docker.

As operações de daemon e rede usaram execução ampliada autorizada. O volume
foi mantido com os dados de demonstração, e o servidor permaneceu em execução.

## Continuidade

Aguardar entendimento antes de estudar a rede do Compose e o acesso entre
containers pelo nome do serviço. O estado fica em [progresso](../progresso.md).

## Fontes

- [Volumes e seu ciclo de vida](https://docs.docker.com/engine/storage/volumes/).
- [Volumes nomeados no Compose](https://docs.docker.com/reference/compose-file/volumes/).
