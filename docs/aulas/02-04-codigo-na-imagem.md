# Aula 2.4 — Código PHP dentro da imagem

## Objetivo

Copiar um script do projeto para a imagem e executá-lo no container. Esta página
registra a demonstração da etapa 2.4; a aplicação da loja ainda não foi criada.

## src/index.php

```php
<?php

echo "Olá, Docker!" . PHP_EOL;
echo "Versão do PHP: " . PHP_VERSION . PHP_EOL;
```

- `<?php` inicia o código PHP.
- `echo` escreve a saída no terminal.
- O ponto `.` concatena os trechos de texto.
- `PHP_EOL` acrescenta a quebra de linha do ambiente de execução.
- `PHP_VERSION` informa a versão do PHP que está executando este script.
- O ponto e vírgula encerra cada instrução.

O script informa uma mensagem e a versão do PHP do container.

## Dockerfile

```dockerfile
FROM php:8.4.26-cli-bookworm

WORKDIR /app

COPY src/ ./

CMD ["php", "index.php"]
```

- `FROM` mantém a imagem base da aula anterior.
- `WORKDIR /app` define a pasta de trabalho dentro da imagem e dos containers
  criados a partir dela. O Docker cria essa pasta caso ela não exista.
- Em `COPY src/ ./`, a origem `src/` é relativa ao contexto de build do projeto.
- O destino `./` é relativo ao diretório de trabalho definido por `WORKDIR`.
  Assim, o conteúdo de `src` é copiado para `/app`; o arquivo fica em
  `/app/index.php`, e não em `/app/src/index.php`.
- `CMD ["php", "index.php"]` define a execução do script. O caminho relativo
  `index.php` é resolvido a partir de `/app`.

O build faz a cópia. Se alterarmos o arquivo local depois, precisamos reconstruir
a imagem para incluir a mudança. Esta aula não utiliza pastas compartilhadas.

## .dockerignore

```dockerignore
# Permite os arquivos de build e o codigo PHP desta etapa.
**
!Dockerfile
!.dockerignore
!src/
!src/**
```

Mantivemos a exclusão geral e acrescentamos duas exceções: `!src/` permite a
pasta e `!src/**` permite seu conteúdo, incluindo subpastas. O código fica
disponível no contexto para a instrução `COPY`. Os demais arquivos do projeto
continuam excluídos.

## Construção e execução

Na raiz do projeto:

```bash
docker build -t curso-loja-php:aula-2.4 .
docker run --rm --name curso-loja-php-script curso-loja-php:aula-2.4
```

Usamos a tag `aula-2.4` para identificar esta imagem. O Docker aplica `WORKDIR`
e `COPY` durante a construção; na execução, usa o novo `CMD`.

## Resultado verificado

```text
Olá, Docker!
Versão do PHP: 8.4.26
```

- A imagem da aula anterior foi preservada; os novos nomes estavam disponíveis.
- Build concluído com sucesso, reaproveitando a base PHP já disponível.
- Execução do script por `CMD` concluída com código 0.
- Inspeção confirmou diretório `/app` e comando `["php", "index.php"]`.
- O container descartável foi removido ao terminar; a imagem permaneceu salva.
- ID observado da imagem:
  `sha256:c5eee4b45f731c0163e84ac817ea98aad2bad3b74600417dced77f5a09bc885e`.

As operações Docker usaram a execução ampliada autorizada do ambiente. Não
foram publicadas portas ou adicionados serviços de banco, frontend ou filas.

## Continuidade

Aguardar entendimento antes de criar o primeiro arquivo Compose. A situação
atual da confirmação está em [progresso](../progresso.md).

## Fontes

- [WORKDIR](https://docs.docker.com/reference/dockerfile/#workdir).
- [COPY](https://docs.docker.com/reference/dockerfile/#copy).
- [Regras de contexto](https://docs.docker.com/build/concepts/context/).
