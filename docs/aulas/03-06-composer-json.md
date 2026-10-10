# Aula 3.6 — Configuração do composer.json

## Objetivo

Descrever o projeto para o Composer e declarar como ele encontrará nossas
classes quando gerarmos o autoload. Nesta etapa criamos apenas a configuração.

## Arquivo src/composer.json

```json
{
    "name": "julesjrenck/curso-loja-fullstack",
    "description": "Loja construída por etapas em um curso de PHP e fullstack.",
    "type": "project",
    "require": {
        "php": "^8.4"
    },
    "autoload": {
        "psr-4": {
            "Loja\\": "./"
        }
    }
}
```

O formato JSON usa chaves para objetos, dois-pontos para associar uma chave ao
seu valor e vírgulas para separar os campos. Strings usam aspas duplas.
Ao contrário do PHP estudado na aula de promoção, não pode haver vírgula depois
do último campo de um objeto. Este arquivo não contém código PHP nem comentários.

## Identificação do projeto

- `name`: identificador no formato fornecedor/projeto. Usamos o nome da conta
  e o nome do repositório como referência; o campo não cria um repositório nem
  publica o projeto no GitHub ou no Packagist.
- `description`: descrição curta.
- `type`: `project` identifica uma aplicação, em vez de uma biblioteca.

## Requisito de PHP

```json
"require": {
    "php": "^8.4"
}
```

`require` declara o que o projeto exige. `php` representa o PHP do ambiente;
Composer não instala o interpretador através desse requisito.

`^8.4` aceita versões a partir de 8.4.0 e anteriores a 9.0.0. Assim, o PHP 8.4.26
da imagem está dentro da faixa. A imagem continua fixada no Dockerfile; este
campo não a atualiza. Futuras bibliotecas terão suas próprias restrições.

## Mapeamento PSR-4

```json
"autoload": {
    "psr-4": {
        "Loja\\": "./"
    }
}
```

PSR-4 define uma convenção de nomes e caminhos para carregar classes.
`autoload` guarda a configuração; `psr-4` escolhe essa convenção.

`"Loja\\"` representa o prefixo `Loja\`. Cada par `\\` no texto JSON é
decodificado como uma barra invertida. O prefixo termina com a barra que separa
o namespace do restante do nome.

`"./"` é a pasta em que está o `composer.json`. Os caminhos são relativos à
raiz desse projeto Composer, que nesta etapa é `src` no host e `/app` no container.

Para `Loja\Produto`, a regra remove o prefixo `Loja\`, sobra `Produto`, e acrescenta
`.php`. O arquivo esperado é `src/Produto.php` no host e `/app/Produto.php` no
container. Ele já existe e declara a classe nesse namespace.

O mapeamento descreve como localizar a classe. Sua presença no JSON não gera
nem ativa o autoload. `src/exemplo-produto.php` continua com o `require_once`
da aula anterior.

## Docker e validação

O bind mount `./src:/app:ro` apresenta o arquivo atualizado ao container sem
build. Executamos na raiz do repositório:

```bash
docker compose run --rm php composer validate
```

- `run --rm php`: inicia um container temporário do serviço PHP e o remove ao terminar.
- `composer validate`: lê o `composer.json` no diretório de trabalho `/app`
  e verifica sua sintaxe e configuração.

O Composer informou que o arquivo é válido, com código 0. O único aviso foi
`No license specified`, uma recomendação de informar licença. Não adicionamos
esse campo nem escolhemos uma licença nesta etapa.

Também conferimos o caminho calculado pelo mapeamento para `Loja\Produto`:
ele aponta para o arquivo existente `src/Produto.php`. Isso confirma o caminho;
a execução do autoload será verificada quando ele for gerado e utilizado.

A validação não instalou bibliotecas nem criou `vendor` ou `composer.lock`.
Não houve alteração no código PHP, imagem, containers permanentes ou dados.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.7, preparar um volume nomeado
gravável em `/app/vendor`, mantendo o código em `/app` como somente leitura.
Preparar a pasta de montagem e verificar gravação nesse volume.

Gerar o autoload e alterar o `require_once` do exemplo serão uma etapa posterior,
explicando os arquivos produzidos pelo Composer. O estado está em
[progresso](../progresso.md).

## Fontes

- [Composer: campos do composer.json](https://getcomposer.org/doc/04-schema.md).
- [Composer: restrições de versão](https://getcomposer.org/doc/articles/versions.md).
- [Composer: comando validate](https://getcomposer.org/doc/03-cli.md#validate).
- [PHP-FIG: PSR-4](https://www.php-fig.org/psr/psr-4/).
