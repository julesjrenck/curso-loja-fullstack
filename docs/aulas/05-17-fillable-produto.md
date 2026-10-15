# Aula 5.17 — Campos permitidos no Produto

## Objetivo

Permitir que nome, preco_em_centavos e status sejam preenchidos por um array
no model, mantendo outros campos fora dessa lista. A 5.16 foi confirmada com
"entendi" em 15/10/2026 e publicada em a953fa4, SHA completo
a953fa4377335a06b5b8fb1089d1d8d6172db6ea, conferido na main remota.

## Alteração no model

backend/app/Models/Produto.php recebeu um import e um atributo PHP:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nome', 'preco_em_centavos', 'status'])]
class Produto extends Model
{
    //
}
```

use importa a classe Fillable. #[...] é a sintaxe de atributo PHP, já vista
no model User na 4.18: fornece uma configuração que o Eloquent lê. O array
contém os nomes dos atributos de dados aceitos na atribuição em massa.

Aqui temos dois usos da palavra atributo: Fillable é um atributo PHP de
configuração; nome, preco_em_centavos e status são atributos de dados do model.

## Preencher vários atributos com um array

Atribuição em massa significa entregar um conjunto de pares campo/valor ao
model, como no construtor ou em fill(). Demonstração executada somente em
memória, com Laravel inicializado em PHP Docker:

```php
use App\Models\Produto;

$produto = new Produto([
    'nome' => 'Camiseta',
    'preco_em_centavos' => 4990,
    'status' => 'ativo',
]);
```

As chaves do array correspondem aos atributos. O construtor herdado de Model
preenche os três porque estão em Fillable. Os valores passam a poder ser
lidos no objeto: $produto->nome retorna Camiseta e o preço é 4990 centavos.
Criar esse objeto com new não executa INSERT. Ainda não chamamos persistência.

Em um objeto existente em memória, podemos preencher apenas um campo:

```php
$produto->fill(['nome' => 'Calça']);
```

O nome muda para Calça; os campos não informados preservam seus valores.
fill não salva automaticamente no banco. Mantivemos exists=false e nenhuma
conexão de banco foi criada durante a demonstração.

## Campos fora da lista

Um segundo objeto recebeu os três campos permitidos, mais id=999 e uma data
created_at. Na configuração atual, os campos extras foram descartados pelo
preenchimento em massa: getAttributes() trouxe somente os três permitidos e
getKey() continuou null. id e datas continuam destinados à geração pelo banco
e ao gerenciamento pelo Eloquent, conforme os conceitos já apresentados.

Essa lista controla o caminho de atribuição em massa. Não torna os campos
imutáveis e não configura permissões SQL. Atribuição individual em código
tem outro funcionamento; não a usamos para contornar a lista nesta etapa.

O Laravel pode ser configurado para lançar exceções em vez de descartar campos
extras. Nesta aula usamos o comportamento existente e o verificamos; não
alteramos AppServiceProvider ou configuração de rigor do Eloquent.

## Permissão de campo e validação de valor

Fillable define quais chaves aceitar. Não verifica se nome está vazio, preço
é negativo ou status pertence a ativo/inativo. Um objeto temporário com
nome vazio, preço -1 e status outro foi aceito em memória, demonstrando esse
alcance. Esses valores não foram enviados ao banco.

As regras de negócio serão implementadas nas etapas próprias. A classe
Loja\Produto do laboratório tem validações no construtor; o model Eloquent
é uma classe diferente e não recebeu automaticamente aquelas validações.
Nesta etapa também não definimos conversões de tipos ou novos padrões de valores.

## Verificações e continuidade

```bash
docker compose exec -T backend php -l /app/app/Models/Produto.php
```

Sintaxe passou. Diagnóstico temporário em PHP Docker conferiu getFillable,
preenchimento pelo construtor, descarte de id/created_at, alteração parcial
por fill, ausência de validação de conteúdo e exists=false dos objetos.
Gerenciador de banco sem conexões criadas; sem consulta ou gravação SQL.
git diff --check passou; demais arquivos PHP e configurações preservados.

Implementação e explicação apresentadas; entendimento da 5.17 confirmado com
"entendi" em 15/10/2026. Checkpoint publicado e conferido em 340d6ea:
HEAD, origin/main e main remota retornaram 340d6ea79fa644031e358b912836fcfd25bc5061.
Registro no checkpoint seguinte. Próximo passo realizado na 5.18: configurar o cast de
preco_em_centavos para integer e demonstrar a conversão em memória, sem gravar dados.

Fonte consultada em 15/10/2026:

- [Atribuição em massa e Fillable no Laravel 13](https://laravel.com/docs/13.x/eloquent#mass-assignment).
