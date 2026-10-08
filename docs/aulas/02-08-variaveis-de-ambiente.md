# Aula 2.8 — Variáveis de ambiente

Esta aula registra a configuração literal do checkpoint `42d152b`. A origem
do valor evolui na aula seguinte; o estado atual fica no README e no Compose.

## Objetivo

Definir uma configuração no ambiente do container e ler seu valor no PHP.
O exemplo é o nome da aplicação: `Loja Fullstack`.

## compose.yaml

No serviço `php`, acrescentamos:

```yaml
environment:
  APP_NAME: "Loja Fullstack"
```

- `environment` define variáveis de ambiente do serviço.
- `APP_NAME` é o nome da variável, com maiúsculas por convenção.
- `"Loja Fullstack"` é seu valor, uma string.
- A indentação coloca `APP_NAME` dentro de `environment`, no serviço `php`.

O Compose passa essa configuração para o ambiente do container quando ele é
criado. Ela fica disponível aos processos que executam nele, incluindo PHP.
O valor é público e didático; não representa uma credencial.

## src/index.php

Depois do cabeçalho HTTP e antes das mensagens, acrescentamos:

```php
$appName = getenv("APP_NAME");

echo "Aplicação: " . $appName . PHP_EOL;
```

- `getenv("APP_NAME")` consulta o valor da variável de ambiente.
- `$appName` é uma variável PHP que recebe esse valor.
- `echo` imprime o nome junto ao prefixo `Aplicação: `.

Assim, o PHP usa a configuração recebida. Podemos escolher outro nome no Compose
sem alterar a leitura feita pelo script. Se a variável estiver ausente, `getenv`
retorna `false`; nesta etapa ela é definida explicitamente no serviço.

## Aplicar a configuração

```bash
docker compose config --quiet
docker compose up -d php
```

A validação concluiu sem erro. O `up` identificou a mudança de configuração e
recriou o container para incluir `APP_NAME`. Não foi feito um novo build.

Variáveis de ambiente fazem parte da configuração de criação do container.
Editar o YAML e atualizar somente a página não aplica essa mudança; use `up`.
O bind mount continua disponibilizando as alterações feitas no código local.

## Conferir dentro do container

```bash
docker compose exec -T php printenv APP_NAME
```

- `exec` executa um comando no container do serviço que já está rodando.
- `-T` dispensa o terminal interativo, adequado para essa verificação simples.
- `php` seleciona o serviço.
- `printenv APP_NAME` mostra o valor dessa variável.

A saída foi `Loja Fullstack`, com código 0. Esse comando consultou somente
o nome público da aplicação.

## Resposta HTTP verificada

Em [http://127.0.0.1:8001/](http://127.0.0.1:8001/), a resposta retornou status
200, tipo `text/plain; charset=UTF-8` e o corpo:

```text
Aplicação: Loja Fullstack
Olá, Docker! Código local atualizado.
Versão do PHP: 8.4.26
```

O serviço permaneceu em execução na porta local 8001. As operações do daemon
e da rede usaram a execução ampliada autorizada do ambiente.

## Qual atualização aplicar

| Alteração | Ação neste projeto |
| --- | --- |
| Código PHP montado de `src` | Atualizar a página. |
| Configuração do serviço no Compose | Aplicar com `docker compose up -d php`. |
| Base, dependências ou instruções da imagem | Construir e aplicar com `docker compose up -d --build php`. |

## Continuidade

Aguardar entendimento antes de mover configurações para um arquivo `.env`
local e apresentar seu modelo `.env.example`. O estado da confirmação fica
em [progresso](../progresso.md).

## Fontes

- [Variáveis do serviço no Compose](https://docs.docker.com/reference/compose-file/services/#environment).
- [getenv no PHP](https://www.php.net/manual/en/function.getenv.php).
