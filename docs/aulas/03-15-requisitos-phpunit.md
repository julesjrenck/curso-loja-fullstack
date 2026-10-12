# Aula 3.15 — Requisitos de PHPUnit

## Objetivo

Entender para que serve PHPUnit e conferir se o PHP do container atende aos
requisitos antes de instalar a ferramenta.

## Testes automatizados

Na aula anterior, verificamos que três camisetas de 4990 centavos resultam em
14970 centavos. Um teste automatizado guarda a entrada, a operação e o resultado
esperado, para repetir essa verificação quando o código mudar.

PHPUnit fornece uma estrutura para escrever esses testes e um comando para
executá-los. Futuramente, poderemos guardar verificações de subtotal, nome vazio
e quantidade inválida em arquivos de teste e executá-las juntas.
Nesta aula conferimos o ambiente; ainda não instalamos PHPUnit nem escrevemos
um teste com a ferramenta.

## Versão e requisitos consultados

A tabela oficial informa que a série PHPUnit 13 é compatível com PHP 8.4.
Para conferir os requisitos específicos, consultamos o composer.json da versão
13.3.2: requisito PHP >= 8.4.1 e as extensões dom, filter, json, libxml,
mbstring e xmlwriter. Essa foi a versão consultada para o diagnóstico;
a versão a instalar será revisada na próxima etapa e fixada por composer.lock.

Uma extensão é um módulo que acrescenta recursos ao próprio PHP. Por exemplo,
mbstring oferece operações de texto com múltiplos bytes, enquanto dom e libxml
oferecem recursos relacionados a XML.

Uma dependência do Composer é um pacote de código instalado no projeto,
normalmente em vendor. PHPUnit será esse tipo de dependência e precisa das
extensões presentes no PHP que o executará.

## Consultar o container

```bash
docker compose exec -T php php --version
docker compose exec -T php php -m
```

- `exec` executa um comando no container do serviço já ativo.
- `-T` desabilita o terminal virtual.
- O primeiro `php` escolhe o serviço definido em compose.yaml.
- O segundo `php` é o executável dentro do container.
- `--version` exibe a versão; `-m` lista os módulos carregados.

Resultado: PHP 8.4.26 e todas as seis extensões exigidas carregadas.
xml e tokenizer também aparecem na lista e foram conferidas no diagnóstico.

O Dockerfile continua usando `php:8.4.26-cli-bookworm`. O ambiente observado
já atende aos requisitos consultados, sem necessidade de acrescentar instruções
de instalação de extensões ou construir outra imagem nesta etapa.

## Verificação acompanhada

Executamos esta verificação temporária, na raiz do projeto:

```bash
docker compose run --rm -T php php <<'PHP'
<?php

declare(strict_types=1);

if (version_compare(PHP_VERSION, "8.4.1", "<")) {
    throw new RuntimeException("PHP abaixo do requisito consultado.");
}

echo "PHP " . PHP_VERSION . ": compatível com o requisito >= 8.4.1" . PHP_EOL;

foreach (["dom", "filter", "json", "libxml", "mbstring", "xmlwriter", "xml", "tokenizer"] as $extensao) {
    if (!extension_loaded($extensao)) {
        throw new RuntimeException("Extensão ausente: " . $extensao);
    }
    echo $extensao . ": carregada" . PHP_EOL;
}

if (is_file("/app/vendor/bin/phpunit")) {
    throw new RuntimeException("O executável do PHPUnit já existe no projeto; revisar o registro.");
}
echo "PHPUnit: executável do projeto ainda ausente" . PHP_EOL;
PHP
```

`version_compare` compara versões; PHP_VERSION informa a versão em execução.
`foreach` percorre os nomes dos módulos e `extension_loaded` consulta se cada
um foi carregado. `!` inverte o resultado lógico. `is_file` verifica a existência
do executável esperado em vendor/bin. Os erros interromperiam a verificação
com uma exceção, em vez de anunciar sucesso com requisito ausente.

`run` cria um container temporário; `--rm` remove-o ao terminar. O bloco
`<<'PHP'` envia o código pela entrada padrão sem expansão das variáveis no shell.
Essa verificação não foi salva como código da aplicação.

Saída verificada, com código 0:

```text
PHP 8.4.26: compatível com o requisito >= 8.4.1
dom: carregada
filter: carregada
json: carregada
libxml: carregada
mbstring: carregada
xmlwriter: carregada
xml: carregada
tokenizer: carregada
PHPUnit: executável do projeto ainda ausente
```

Esse resultado confirma os requisitos de PHP consultados. A instalação e a
execução real do PHPUnit serão verificadas quando a ferramenta for introduzida.
composer.json, Dockerfile, Compose, código PHP e volumes foram preservados;
o contador não foi executado. Apenas a documentação da aula foi acrescentada.

## Continuidade

Entendimento confirmado com "entendi" em 12/10/2026. Próxima etapa: 3.16, instalar PHPUnit como
dependência de desenvolvimento pelo Composer em Docker, revisar a versão
compatível e gerar composer.lock. A instalação precisa escrever composer.json
e composer.lock em src, atualmente montada como somente leitura; explicar e
usar uma montagem gravável apenas no container temporário da instalação,
preservando vendor no volume existente. Conferir a versão instalada e os
requisitos completos das dependências resolvidas. Primeiro teste em etapa
posterior. O estado atualizado fica no [progresso](../progresso.md).

## Fontes

- [PHPUnit: versões suportadas](https://phpunit.de/supported-versions.html).
- [PHPUnit 13.3.2: requisitos declarados no composer.json](https://github.com/sebastianbergmann/phpunit/blob/13.3.2/composer.json).
- [PHPUnit: instalação e uso como dependência de desenvolvimento](https://docs.phpunit.de/en/13.4/installation.html).
