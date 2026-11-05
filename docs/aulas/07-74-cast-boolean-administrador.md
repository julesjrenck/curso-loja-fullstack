# Aula 7.74 — Cast boolean do indicador de administrador

Implementação e explicação em 05/11/2026, após confirmação da
[7.73](07-73-aplicar-migration-administrador-loja.md) com "entendi".
Checkpoint anterior publicado e conferido em
8a5356ad4e5041fa1594e451fc6d078f420c682f; HEAD/origin/main/main remota iguais.
Entendimento da 7.74 confirmado com "entendi" em 05/11/2026; publicação
conferida em a488fbaa02068250e0a393134a24d579c068d738, HEAD/origin/main/main remota iguais.
Registro atualizado após publicação.

## Objetivo e alteração

Acrescentamos somente uma linha ao método casts do
[User](../../backend/app/Models/User.php):

```php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];
}
```

O método retorna um array associativo. Cada chave é um atributo do model e
cada valor indica sua conversão. O novo mapeamento faz a leitura de is_admin
usar booleano PHP; datetime e hashed continuam com suas funções anteriores.

| Valor bruto ilustrativo | Leitura de $usuario->is_admin |
| --- | --- |
| 0 ou '0' | false |
| 1 ou '1' | true |
| false ou true | O mesmo booleano |
| null | null |

O cast converte a representação ao ler o atributo, sem gravar essa leitura
no banco ou promover a conta. O valor bruto permanece disponível no model.
Não é uma regra de autorização e não adiciona atributo ao Fillable.
Referência: [casts de atributos no Laravel](https://laravel.com/docs/13.x/eloquent-mutators#attribute-casting).

## Cast e valor padrão são responsabilidades diferentes

A migration aplicada na 7.73 define o padrão false e NOT NULL no banco.
Quando uma inserção omite is_admin, o banco fornece o padrão. Este cast
apenas converte um valor que o model lê.

Um User recém-instanciado, sem carregar is_admin, não passa a conter false
automaticamente por causa dessa linha. Sua leitura permanece null. Da mesma
forma, um null fornecido em memória permanece null; o cast não substitui a
restrição NOT NULL da coluna. Não fizemos inserção de null nesta aula.

## Relações com preenchimento e resposta da API

Fillable continua name/email/password. Is_admin fica fora dessa lista:
ter um cast boolean não autoriza preenchimento em massa desse atributo.
O controle de atribuição administrativa continuará no servidor.

O [UsuarioResource](../../backend/app/Http/Resources/UsuarioResource.php)
permanece selecionando id/name/email. O cast não acrescenta is_admin a essa
resposta explícita. Quando uma futura regra de acesso consultar o indicador,
receberá sua representação booleana; a decisão da regra ainda será necessária.

## Verificações

```sh
docker compose exec -T backend php -l /app/app/Models/User.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec -T usa o PHP do container sem terminal interativo. Php -l confere sintaxe.
Artisan test executa a suíte configurada para loja_test. Compact reduz a saída;
do-not-cache-result evita cache no código readonly; colors=never remove cores.

Também executamos um diagnóstico PHP pela entrada padrão, carregando somente
o autoload, sem bootstrap/configuração do aplicativo ou conexão SQL. Instâncias
reais de User receberam atributos brutos fictícios por setRawAttributes, que
representa valores carregados para leitura; esse método não foi acrescentado
ao código da aplicação ou usado para promover uma conta persistida.

Doze controles passaram, código 0: sete entradas (0/1/'0'/'1'/false/true/null)
com comparação estrita e valor bruto preservado; casts anteriores; Fillable
inalterado; fill com name/is_admin aceita o nome e não atribui o indicador;
ausência de padrão automático em User novo; UsuarioResource preserva seu
objeto id/name/email mesmo com is_admin em memória. Usamos toArray do Resource
com Request fictícia, sem enviar HTTP ou executar rota da API. Nenhuma senha
ou hash foi necessário no diagnóstico; saída somente booleanos.

Sintaxe passou. Suíte atual: 108 testes/1.606 asserções passaram, código 0.
Esse é um novo resultado após a alteração do model. Nenhum teste permanente
novo, migração ou SQL em loja nesta aula. Diagnóstico pela entrada padrão, sem arquivo auxiliar.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.75](07-75-gate-acesso-administracao.md): definir o Gate
acessar-administracao, consultando is_admin, e verificar decisões para cliente,
administrador e visitante em memória, antes de criar uma rota administrativa.
Módulos 8 a 23 não iniciados.
