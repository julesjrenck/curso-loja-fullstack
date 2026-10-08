# Aula 2.3 — Primeiro Dockerfile

Esta aula registra o estado do checkpoint `ec1765a`. O Dockerfile evolui nas
aulas seguintes; os comandos da demonstração atual ficam no README do projeto.

## Objetivo

Descrever nossa imagem em um arquivo versionado, construí-la e executar o comando
padrão configurado nela. A base continua sendo PHP 8.4.26 CLI sobre Debian 12.

## Dockerfile

```dockerfile
FROM php:8.4.26-cli-bookworm

CMD ["php", "-v"]
```

- `FROM` escolhe a imagem base da qual herdamos PHP, bibliotecas e configurações.
- A linha vazia separa as instruções para facilitar a leitura.
- `CMD` define o comando padrão que será usado quando iniciarmos um container.
- `["php", "-v"]` é uma lista em formato JSON: executável e seu argumento,
  com strings entre aspas duplas. Ela corresponde ao comando `php -v`.

O build registra essa configuração; o PHP executa quando o container é iniciado.
Se informarmos outro comando depois do nome da imagem em `docker run`, ele
substituirá o padrão de `CMD`. Ainda não copiamos código da loja para a imagem.

## .dockerignore

```dockerignore
# Permite apenas os arquivos usados nesta primeira construcao.
**
!Dockerfile
!.dockerignore
```

- A primeira linha é um comentário.
- `**` exclui os arquivos e pastas do contexto, incluindo subpastas.
- `!Dockerfile` permite o arquivo que descreve a imagem.
- `!.dockerignore` permite o próprio arquivo de regras.
- As exceções vêm depois da regra geral; a última regra correspondente decide.

O contexto é o conjunto de arquivos disponíveis para a construção. Nesta aula,
o Dockerfile só precisa de uma imagem base e do comando padrão, então permitimos
apenas esses dois arquivos. Conforme adicionarmos código, atualizaremos as regras.
Permitir um arquivo no contexto não o copia automaticamente para dentro da imagem.

O `.gitignore` controla o que o Git ignora; o `.dockerignore` controla o contexto
Docker. Um não substitui o outro. Ambos devem ser versionados.

## Construir a imagem

Na raiz do projeto:

```bash
docker build -t curso-loja-php:aula-2.3 .
```

- `build`: constrói a imagem lendo o Dockerfile.
- `-t`: atribui nome e tag à imagem construída.
- `curso-loja-php`: nome escolhido para nossa imagem local.
- `aula-2.3`: tag escolhida para identificar esta etapa; não é a versão do PHP.
- `.`: usa a pasta atual como contexto, filtrado pelo `.dockerignore`.

O Dockerfile e os arquivos relevantes para o build ficam no Git. A imagem
construída fica no armazenamento do Docker deste computador.

## Executar o comando padrão

```bash
docker run --rm --name curso-loja-php-dockerfile curso-loja-php:aula-2.3
```

Não informamos um comando após a imagem: o container usa `CMD ["php", "-v"]`.
`--rm` remove o container ao terminar; `--name` permite identificá-lo.

## Resultado verificado

- Não havia imagem do curso ou container com esses nomes antes da execução.
- O build concluiu com sucesso, usando a imagem base da aula anterior.
- A execução mostrou PHP 8.4.26 CLI e terminou com código 0.
- A inspeção da imagem confirmou o comando padrão `["php", "-v"]`.
- O container descartável não permaneceu após a execução; a imagem ficou salva.
- Identificador observado da imagem construída:
  `sha256:8ccd0f1725de2e7e887784ea9c3ee881c987cef31b2a2d086ca293c4882d815a`.

As operações Docker usaram a execução ampliada autorizada deste ambiente.
Não foram compartilhadas pastas ou portas do host.

## Continuidade

Confirmar o entendimento antes de adicionar o primeiro arquivo PHP à imagem.
O estado atualizado da confirmação fica em [progresso](../progresso.md).

## Fontes

- [Dockerfile: FROM e CMD](https://docs.docker.com/reference/dockerfile/).
- [Contexto de build e .dockerignore](https://docs.docker.com/build/concepts/context/).
