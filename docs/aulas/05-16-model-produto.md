# Aula 5.16 — Primeiro model Eloquent de produto

## Objetivo

Gerar App\Models\Produto e apresentar sua ligação à tabela produtos. A 5.15
foi confirmada com "entendi" e publicada em 36db8e8, SHA completo
36db8e85393e59404ba55f3556d2fc9d356746c9, conferido na main remota.

## Geração em Docker

Na raiz do repositório:

```bash
docker compose run --rm -T --no-deps \
  --user "$(id -u):$(id -g)" \
  --volume "$PWD/backend/app/Models:/app/app/Models:rw" \
  backend php artisan make:model Produto --no-interaction
```

run cria um container temporário; --rm o remove; -T desliga terminal interativo;
--no-deps evita iniciar dependências. A montagem adicional permite escrita
somente em app/Models dentro do código normalmente readonly. --user usa o
usuário/grupo do host para manter o arquivo editável pelo aluno.

php artisan make:model recebe o nome da classe, Produto. --no-interaction evita
perguntas do terminal. Usamos somente o gerador de model, sem opções adicionais
de migration, factory ou controller. Gerado backend/app/Models/Produto.php,
com permissão 644 e dono 1000:1000. O model User existente foi preservado.

## Código gerado

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
}
```

namespace App\Models dá o nome completo App\Models\Produto à classe.
use importa a classe base Model do Eloquent. extends Model aplica herança,
conceito do módulo 3: Produto recebe comportamento da classe base. O corpo
da classe é o espaço para futuras configurações e comportamento específico.

Eloquent é um ORM: relaciona objetos PHP a registros de tabelas e oferece
operações para consultar e persistir esses registros. A migration criou a
estrutura no banco; o model fornece a representação e as operações em PHP.
Gerar um model não cria outra tabela nem aplica migrations.

App\Models\Produto é o model do backend Laravel. Loja\Produto em src/Produto.php
continua sendo a classe do laboratório, onde estudamos regras e OOP em PHP.
As duas classes pertencem a namespaces e aplicações diferentes.

## Convenções verificadas

| Convenção do model | Resultado conferido |
| --- | --- |
| Tabela inferida do nome da classe | produtos |
| Chave primária | id |
| Tipo da chave no PHP | int |
| Chave gerada incrementalmente | true |
| Controle de datas | created_at e updated_at |
| Conexão | Padrão sqlsrv, com login loja_app |

O Eloquent calcula o nome da tabela pelo plural do nome da classe em snake_case.
Neste nome concreto, Produto resultou em produtos, como nossa migration.
Essa convenção não significa que todos os nomes portugueses terão o plural
desejado; outros casos podem exigir configuração explícita na etapa correspondente.

As demais convenções também combinam com a estrutura criada: id BIGINT IDENTITY
e datas created_at/updated_at. O model não define uma conexão específica, então
usará a conexão padrão quando solicitarmos operações de banco. A conexão
sqlsrv_migracoes permanece destinada à aplicação das migrations.

O Eloquent gerencia os valores das colunas como atributos do model. Os campos
permitidos para receber arrays e suas conversões serão apresentados nas etapas
seguintes, antes de inserir registros.

## Verificações em memória

```bash
docker compose exec -T backend php -l /app/app/Models/Produto.php
```

Sintaxe sem erro. Um diagnóstico temporário PHP em Docker carregou o autoload,
inicializou Laravel e criou new App\Models\Produto. Conferiu instanceof Model,
getTable(), getKeyName(), getKeyType(), getIncrementing(), usesTimestamps(),
getCreatedAtColumn()/getUpdatedAtColumn() e getConnectionName().

O objeto novo tem exists=false e lista de atributos vazia. O gerenciador de
banco permaneceu sem conexões criadas: nenhuma consulta ou gravação foi solicitada.
Esses resultados verificam a classe e suas convenções; não representam um
produto carregado ou salvo no SQL Server.

git diff --check passou. Apenas Produto.php foi adicionado ao código nesta etapa.
Controller, catálogo, view, banco, migrations, credenciais, imagens e dependências
preservados. O modelo ainda não é utilizado pela página /loja.

## Continuidade

Arquivo gerado, explicação apresentada e verificações concluídas. Entendimento
da 5.16 confirmado com "entendi" em 15/10/2026. Checkpoint publicado e conferido
em a953fa4: HEAD, origin/main e main remota retornaram
a953fa4377335a06b5b8fb1089d1d8d6172db6ea. Registro no checkpoint seguinte.
Próximo passo realizado na 5.17:
definir campos permitidos para atribuição em massa no model com Fillable,
explicando o recebimento de arrays e demonstrando em memória, antes de gravar dados.

Fonte consultada em 14/10/2026:

- [Geração e convenções de models Laravel 13](https://laravel.com/docs/13.x/eloquent#eloquent-model-conventions).
