# Aula 3.8 — Autoload do Composer

## Objetivo

Gerar o carregador do Composer a partir do `composer.json` e utilizá-lo no
exemplo de produto. Agora o PHP pode solicitar uma classe pelo seu nome e
o carregador encontra o arquivo correspondente.

## Gerar os arquivos

Na raiz do repositório, com a preparação do README concluída:

```bash
docker compose run --rm php composer dump-autoload
```

O serviço `php` fornece o ambiente. `composer dump-autoload` lê a configuração
em `/app/composer.json` e gera os arquivos de carregamento em `/app/vendor`,
no volume gravável da aula anterior. `--rm` remove o container temporário,
mas o volume nomeado continua disponível aos outros containers do serviço.

Resultado verificado, com código 0:

```text
Generating autoload files
Generated autoload files
```

Esse comando gerou o autoload sem instalar bibliotecas externas ou criar
`composer.lock`. Quando introduzirmos dependências, ensinaremos sua instalação.

## Estrutura gerada e inspecionada

```text
/app/vendor/
├── autoload.php
└── composer/
    ├── ClassLoader.php
    ├── LICENSE
    ├── autoload_classmap.php
    ├── autoload_namespaces.php
    ├── autoload_psr4.php
    ├── autoload_real.php
    ├── autoload_static.php
    └── platform_check.php
```

| Arquivo | Papel |
| --- | --- |
| `autoload.php` | Entrada que nosso código carrega para inicializar o autoload. |
| `autoload_real.php` | Inicializa e registra o carregador, usando os dados gerados. |
| `ClassLoader.php` | Implementação do Composer que localiza e carrega classes. |
| `autoload_psr4.php` | Mapeamento de prefixos PSR-4 para diretórios. |
| `autoload_static.php` | Dados de carregamento usados na inicialização desta versão. |
| `autoload_classmap.php` | Mapeamento direto de nomes de classes para arquivos. |
| `autoload_namespaces.php` | Mapeamento para PSR-0, outra convenção suportada. |
| `platform_check.php` | Verificação de plataforma; aqui exige PHP >=8.4.0. |
| `LICENSE` | Licença do código de carregamento fornecido pelo Composer. |

Apresentamos os papéis desses arquivos. O código interno do carregador é
fornecido pela ferramenta; não precisamos estudar sua implementação inteira.
O arquivo `LICENSE` gerado não escolhe a licença do nosso projeto.

Em `autoload_psr4.php`, conferimos o prefixo `Loja\` apontando para o diretório
base `/app`. Essa é a regra declarada em `composer.json`, transformada em dados
que o carregador utiliza. `autoload.php` inicializa o carregador por meio de
`autoload_real.php`; nesta versão a inicialização usa `autoload_static.php`.

Os arquivos gerados ficam no volume Docker, não em `src/vendor` no host.
Versionamos a configuração e os comandos para recriá-los. Não editamos esses
arquivos manualmente; ao mudar o mapeamento do JSON, executamos novamente
`composer dump-autoload`.

## Alteração em src/exemplo-produto.php

Antes:

```php
require_once __DIR__ . "/Produto.php";
```

Agora:

```php
require_once __DIR__ . "/vendor/autoload.php";
```

`__DIR__` é `/app` quando o exemplo roda no container. A concatenação produz
`/app/vendor/autoload.php`. `require_once` carrega e executa esse arquivo uma vez
na execução atual. Ele inicializa e registra o autoload.

O trecho de uso continua:

```php
use Loja\Produto;

// Depois de carregar vendor/autoload.php:
$produto = new Produto("Camiseta", 4990);
```

`use` faz o nome curto `Produto` referir-se a `Loja\Produto` neste arquivo.
Quando `new` precisa da classe ainda não carregada, o PHP aciona o autoload.
O carregador usa o prefixo `Loja\`, encontra `/app/Produto.php` e carrega o arquivo.
Então o construtor é executado com os argumentos recebidos.

A classe, os getters e as regras não foram alterados. A restrição do exemplo
ao terminal permanece antes do carregamento do autoload.

## Executar e verificar

```bash
docker compose run --rm php php exemplo-produto.php
```

Saída verificada, com código 0:

```text
Produto: Camiseta
Preço em centavos: 4990
Produto recusado: O preço em centavos não pode ser negativo.
```

Uma experiência em PHP pela entrada padrão de outro container confirmou:

- `class_exists(Produto::class, false)` é falso antes de registrar o autoload
  e continua falso imediatamente depois. O segundo argumento impede que
  a própria consulta tente carregar a classe.
- Depois de `new Produto(...)`, a classe está carregada e o nome do objeto
  é `Loja\Produto`.
- A lista de arquivos incluídos contém `/app/Produto.php`.
- As seis entradas das aulas anteriores mantêm seus resultados: nome válido,
  preço zero e nome com bordas são aceitos com dados preservados; nome vazio,
  nome só com espaços e preço negativo são recusados.
- Preço textual em chamada estrita produz `TypeError`; acesso externo à
  propriedade privada produz `Error`.

Essas verificações terminaram com código 0. O servidor principal respondeu
HTTP 200 e o exemplo continuou recusando HTTP com 403. `src/vendor` permaneceu
vazio no host e não houve geração de lockfile. Sem build ou mudança no Compose.

## Continuidade

Aguardar confirmação de entendimento. Na etapa 3.9, introduzir um enum
`Loja\StatusProduto` com valores de ativo e inativo e um pequeno exemplo CLI.
Usar autoload para o novo enum, sem mudar a classe Produto nesta próxima etapa.
O estado está em [progresso](../progresso.md).

## Fontes

- [Composer: autoload de classes](https://getcomposer.org/doc/01-basic-usage.md#autoloading).
- [Composer: comando dump-autoload](https://getcomposer.org/doc/03-cli.md#dump-autoload-dumpautoload).
