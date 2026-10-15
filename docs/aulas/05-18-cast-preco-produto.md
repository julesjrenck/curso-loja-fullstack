# Aula 5.18 — Cast inteiro do preço

## Objetivo

Configurar a conversão do preço para inteiro ao ler o atributo do model.
A 5.17 foi confirmada com "entendi" em 15/10/2026 e publicada em 340d6ea,
SHA completo 340d6ea79fa644031e358b912836fcfd25bc5061, conferido na main remota.

## Alteração no model

Em backend/app/Models/Produto.php, substituímos o comentário do corpo pelo método:

```php
/**
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'preco_em_centavos' => 'integer',
    ];
}
```

casts() devolve a configuração de conversões que o Eloquent aplicará aos
atributos. protected permite seu uso pela classe e pela herança; não chamamos
esse método diretamente de fora do model. O Laravel o consulta internamente.
: array declara o tipo do retorno em PHP. O comentário @return detalha para
editor/análise que as chaves e os valores desse array são strings.

A chave preco_em_centavos é o atributo de dados; o texto integer identifica
a conversão oferecida pelo Eloquent. O model User já tinha casts na 4.18;
agora aplicamos esse recurso ao nosso Produto. Imports e Fillable preservados.

## Exemplo em memória

```php
use App\Models\Produto;

$produto = new Produto([
    'nome' => 'Camiseta',
    'preco_em_centavos' => '4990',
    'status' => 'ativo',
]);

var_dump($produto->preco_em_centavos); // int(4990)
```

As aspas fazem '4990' ser uma string na entrada. Ao acessar o atributo pelo
model, o Eloquent entrega o inteiro 4990. Esse número continua em centavos:
representa R$ 49,90; não houve divisão por 100 nem formatação monetária.

Na demonstração, getAttributes() ainda continha o valor bruto '4990'. O acesso
ao atributo e toArray() entregaram o valor convertido. Isso mostra que o cast
participa da leitura/representação do model, sem precisar chamar (int) em cada uso.

Depois de fill(['preco_em_centavos' => '12990']), a leitura retornou 12990 como
int. Nome e status mantiveram seus valores e a lista Fillable continuou igual.
Nenhum método de persistência foi chamado.

## Conversão, regras e banco

Fillable escolhe campos aceitos por atribuição em massa. casts define conversões
de representação. Nome preenchido, preço não negativo e status válido continuam
dependendo das regras que implementaremos nas etapas próprias.

O cast inteiro aceita números negativos, e valores null não são convertidos.
Conferimos os dois comportamentos em objetos temporários. Logo, configurar
integer não garante positividade ou obrigatoriedade. A coluna SQL continua
INT NOT NULL como criada na 5.15; alterar o model não altera a tabela.

## Verificações em Docker

```bash
docker compose exec -T backend php -l /app/app/Models/Produto.php
```

Sintaxe passou. Um diagnóstico temporário PHP inicializou Laravel e verificou:

- getCasts registra preco_em_centavos como integer;
- entrada string '4990', valor bruto string, leitura e toArray com inteiro 4990;
- fill com '12990' resulta em leitura inteira 12990;
- zero inteiro preservado, texto '-1' convertido a inteiro -1 e null preservado;
- nome, status e Fillable preservados;
- todos os objetos exists=false e gerenciador de banco sem conexões criadas.

Não houve consulta, gravação SQL ou teste de integração; git diff --check passou.
Única alteração de código no model Produto; demais código, banco, migrations,
configurações, credenciais, dependências e serviços preservados.

## Continuidade

Cast implementado, explicação apresentada e verificações concluídas. Entendimento
da 5.18 confirmado com "entendi" em 15/10/2026. Checkpoint publicado e conferido
em adb466c: HEAD, origin/main e main remota retornaram
adb466c3fab6e5fcfe0e16f3edef970e49609fd2. Registro no checkpoint seguinte.
Próximo passo realizado na 5.19:
primeira consulta Eloquent com Produto::query()->get(), explicando a coleção
vazia e a consulta SQL de leitura, sem inserir dados ou trocar o catálogo ainda.

Fonte consultada em 15/10/2026:

- [Conversão de atributos no Eloquent Laravel 13](https://laravel.com/docs/13.x/eloquent-mutators#attribute-casting).
