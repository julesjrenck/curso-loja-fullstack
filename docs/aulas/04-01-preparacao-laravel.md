# Aula 4.1 — Papel do Laravel e preparação do ambiente

## Objetivo

Começar Laravel e MVC entendendo o papel do framework, conferindo os requisitos
no Docker e definindo a pasta do backend. A instalação será a próxima etapa,
após confirmação desta preparação.

## O papel de cada ferramenta

| Ferramenta | Papel no curso |
| --- | --- |
| PHP | Executa o código da aplicação. |
| Composer | Obtém os pacotes PHP e registra suas dependências e versões. |
| Laravel | Oferece classes, uma estrutura e convenções para construir a aplicação web. |
| Docker | Fornece o ambiente em que PHP, Composer e os serviços serão executados. |

Laravel fornece recursos como rotas, controllers, respostas HTTP, validação e
acesso a dados. Na loja, poderemos associar uma URL a uma ação e devolver uma
página ou dados pela aplicação. Introduziremos cada recurso e arquivo quando
a aula precisar dele.

O conhecimento de classes, namespaces, Composer e autoload do módulo 3 será
usado para entender o código do framework e o nosso código dentro dele.

## Organização definida para o repositório

```text
src/       laboratório PHP existente, com classes, exemplos e testes
backend/   projeto Laravel planejado, a criar na etapa 4.2
docs/      roteiro, aulas e progresso do curso
```

O caminho backend foi conferido e ainda não existe. A pasta será criada pelo
Composer ao obter o esqueleto oficial do projeto.

O backend terá composer.json, dependências e autoload próprios. O laboratório
mantém seu composer.json, lockfile e o volume vendor-php existente. As dependências
do backend terão armazenamento separado quando forem instaladas, preservando
a execução dos exemplos e testes já estudados.

Nenhuma pasta ou configuração de serviço foi criada nesta preparação.
O SQL Server será introduzido no módulo 5, conforme o roteiro.

## Requisitos oficiais consultados

Laravel 13 exige PHP >= 8.3. A tabela de versões suportadas inclui PHP 8.4.
Portanto, mantemos a escolha do curso de PHP 8.4, usando a imagem atual 8.4.26.

As extensões listadas na documentação são:

```text
ctype, curl, dom, fileinfo, filter, hash, mbstring,
openssl, pcre, PDO, session, tokenizer, xml
```

São treze extensões. Todas estavam carregadas no container do curso.
O Composer instalado é 2.10.3. O framework também declara composer-runtime-api
^2.2; a consulta da plataforma retornou 2.2.2, compatível. Esse número é a versão
da API de execução fornecida pelo Composer, distinta da versão do programa.

O diagnóstico confirma os requisitos PHP consultados. As dependências completas
serão resolvidas e verificadas quando forem instaladas no projeto Laravel.

## Comandos executados e verificação

```bash
docker compose exec -T php php --version
docker compose exec -T php composer --version
docker compose exec -T php composer show --platform composer-runtime-api
```

`exec -T` usa o container ativo sem terminal virtual. `php` logo depois de -T
é o serviço. O executável seguinte é PHP ou Composer, conforme o comando.
`--version` mostra a versão; `show --platform` consulta a plataforma que o
Composer disponibiliza para as dependências.

Também enviamos uma verificação temporária pela entrada padrão:

```bash
docker compose exec -T php php <<'PHP'
<?php

declare(strict_types=1);

if (version_compare(PHP_VERSION, "8.3.0", "<")) {
    throw new RuntimeException("PHP abaixo do requisito do Laravel 13.");
}

foreach (["ctype", "curl", "dom", "fileinfo", "filter", "hash", "mbstring", "openssl", "pcre", "PDO", "session", "tokenizer", "xml"] as $extensao) {
    if (!extension_loaded($extensao)) {
        throw new RuntimeException("Extensão ausente: " . $extensao);
    }
    echo $extensao . ": carregada" . PHP_EOL;
}
echo "Requisitos PHP consultados para Laravel 13: atendidos" . PHP_EOL;
PHP
```

version_compare verifica a versão. O foreach percorre os módulos e
extension_loaded confirma que cada um está carregado. Uma ausência interromperia
a verificação com RuntimeException. O bloco <<'PHP' envia o código ao executável
PHP sem expandir as variáveis no shell. Nenhum arquivo PHP novo foi salvo.

Resultado: PHP 8.4.26, Composer 2.10.3, API de execução 2.2.2, treze módulos
carregados e diagnóstico final de requisitos atendidos, com código 0.
`test ! -e backend` confirmou no host a ausência desse caminho, código 0.
Não foi necessário alterar Dockerfile, construir outra imagem ou instalar
extensões. Laravel ainda não foi instalado.

## Continuidade

Entendimento confirmado com "entendi" em 13/10/2026. Próxima etapa, 4.2: obter o esqueleto oficial
laravel/laravel da série 13 em backend pelo Composer no Docker. Consultar e
fixar a versão identificável do esqueleto na execução. Usar --no-install e
--no-scripts, apresentando os arquivos gerados antes das próximas operações.

Conferimos as opções por `composer create-project --help`: --no-install adia
a instalação das dependências; --no-scripts adia os comandos automáticos
declarados no composer.json. O modelo oficial possui ações de geração de .env,
chave e banco SQLite; essas ações serão explicadas antes de configurar o projeto,
mantendo a decisão de SQL Server do curso.

Depois de criar o esqueleto, apresentar a estrutura e os arquivos principais.
Instalação das dependências, ambiente local e execução do servidor entrarão
nas etapas seguintes, mantendo as confirmações entre elas.
Estado em [progresso](../progresso.md).

## Fontes

- [Laravel 13: requisitos e versões PHP suportadas](https://laravel.com/framework/docs/13.x/releases).
- [Laravel 13: extensões requeridas](https://laravel.com/framework/docs/13.x/deployment#server-requirements).
- [Laravel: instalação e papel do framework](https://laravel.com/framework/docs/13.x/installation).
- [Esqueleto oficial: dependências e scripts](https://github.com/laravel/laravel/blob/13.x/composer.json).
- [Framework: requisito da API do Composer](https://github.com/laravel/framework/blob/13.x/composer.json).
