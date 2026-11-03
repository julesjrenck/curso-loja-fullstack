# Aula 7.2 — Estrutura existente de usuários e autenticação

Apresentada em 03/11/2026, após confirmação da 7.1 com "entendi".
Checkpoint da 7.1 publicado e conferido em
074fcf9415e4d5cba864ca401fce8de6257c6f55: HEAD, origin/main e main remota iguais.
Entendimento da 7.2 confirmado pelo aluno com "entendi" em 03/11/2026.

## Objetivo e relação entre os arquivos

Entender as peças geradas pelo Laravel antes de criar tabelas ou instalar
dependências de autenticação. Nesta etapa, alteramos apenas a documentação.

```text
config/auth.php
  guard web → driver session → provider users → model App\Models\User
                                                    ↓
                                              tabela users
                                                    ↑
               migration 0001_01_01_000000_create_users_table.php
```

O model representa os dados e fornece suporte à autenticação. A configuração
conecta os mecanismos. A migration descreve como criar as tabelas, mas precisa
ser aplicada para executar essa criação. Nenhuma dessas peças, isoladamente,
oferece uma rota de login pronta.

## User.php: o usuário como model

Em [User.php](../../backend/app/Models/User.php), namespace e imports seguem a
organização já estudada. O import abaixo dá um nome curto à classe base:

```php
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
```

`as` define um alias de importação do PHP. A classe base mantém os recursos
de model Eloquent e fornece o suporte ao contrato de autenticação do Laravel.
User continua podendo representar atributos e registros de banco. O nome
convencional de sua tabela é users; isso foi conferido com getTable().

```php
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
```

Esses atributos PHP configuram o model. Fillable permite preencher os três
campos em conjunto, por exemplo ao passar um array para new User([...]).
Não exige esses campos nem valida e-mail ou força de senha.
Hidden exclui senha e token da conversão padrão do model para array/JSON.
Os valores continuam existindo no objeto; ocultá-los na saída não os transforma.

```php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

Como o cast integer de preço no Produto, esses casts definem tratamentos dos
atributos. datetime fornece um objeto de data ao acessar um valor não nulo.
hashed transforma uma senha em texto ao atribuí-la ao model. Depois podemos
conferir a senha informada contra o hash com Hash::check; não recuperamos a
senha original do hash. Aprofundaremos hashing em uma etapa própria.

HasFactory permite usar factories, como já fizemos no catálogo. Notifiable
fornece recursos de notificações; não envia nenhuma por simplesmente estar
declarado. O comentário de UserFactory documenta o tipo para ferramentas.
MustVerifyEmail está apenas comentado; verificação obrigatória de e-mail não
foi ativada. Esses recursos serão aprofundados quando utilizados.

## config/auth.php: como conectar a autenticação

A [configuração](../../backend/config/auth.php) retorna um array PHP:

```php
'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'),
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
],

'guards' => [
    'web' => ['driver' => 'session', 'provider' => 'users'],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', User::class),
    ],
],
```

env lê uma configuração de ambiente e usa o segundo argumento como padrão.
O guard padrão carregado é web. Seu driver session reconhece o usuário com
o mecanismo de sessão; o provider users usa Eloquent e o model User para
obter os usuários. User::class fornece o nome completo da classe.

Guard e provider não são perfis de cliente ou administrador. Ainda não
definimos esses perfis. A configuração de recuperação de senha em passwords
aponta ao provider users e à tabela password_reset_tokens; expire e throttle
controlam validade e intervalo de solicitações. password_timeout define o
prazo de uma confirmação de senha. Sua presença não cria rotas desses fluxos.

O driver session do guard indica o mecanismo de autenticação. Já o driver de
[config/session.php](../../backend/config/session.php) indica onde guardar os
dados da sessão: no ambiente normal carregado, é file. São configurações com
responsabilidades diferentes. Cookies e sessões receberão uma aula própria.

## A migration existente

O [arquivo](../../backend/database/migrations/0001_01_01_000000_create_users_table.php)
retorna uma classe anônima que estende Migration. up descreve a criação de
três tabelas; down descreve sua remoção para reversão. Apenas lemos o arquivo.

| Tabela | Campos e propósito |
| --- | --- |
| users | id; name; email único; email_verified_at opcional; password; remember_token opcional; created_at e updated_at |
| password_reset_tokens | email como chave primária; token; created_at opcional, para recuperação de senha |
| sessions | id textual como chave primária; user_id opcional e indexado; ip_address opcional; user_agent opcional; payload; last_activity indexado |

Schema::create recebe o nome da tabela e uma função que configura suas colunas
com Blueprint. unique impede duplicidade no banco; nullable permite null;
index cria um índice. rememberToken e timestamps são atalhos para as colunas
citadas. foreignId('user_id')->nullable()->index() define a coluna e o índice;
esse trecho não declara uma chave estrangeira com constrained ou foreign.

A existência da tabela sessions no arquivo não obriga usar sessões no banco.
Além disso, esse arquivo cria três tabelas: aplicar essa migration envolve as
três, mesmo que seu nome mencione somente users. Não executamos up nem down.

## Verificações e limites

Um diagnóstico enviado por stdin a `docker compose exec -T backend php`
carregou vendor/autoload.php, bootstrap/app.php e inicializou o kernel de
console. Com configuração carregada, criou um User fictício em memória,
atribuiu data/token ilustrativos e senha aleatória temporária, sem save/create.

Passaram dez verificações: contrato de autenticação, Fillable, senha correta,
senha diferente recusada, senha transformada, senha/token ocultos no array,
data como DateTimeInterface, objeto não persistido e zero consultas SQL.
Senha e hash não foram impressos ou gravados. Isso demonstra o comportamento
do model, não um login HTTP ou uma gravação no SQL Server.

```sh
docker compose exec -T backend php artisan migrate:status --no-ansi
docker compose exec -T backend php artisan migrate:status --env=testing --no-ansi
```

migrate:status consulta o histórico; não aplica migrations. --env=testing
seleciona o ambiente de testes. Nos dois casos, código 0: users/cache/jobs
Pending; produtos/categorias/categoria_id Ran nos lotes 1/2/3. Pending indica
ausência de registro de aplicação dessa migration; essa consulta, sozinha,
não é uma inspeção da existência física de cada tabela.

Sem instalação de dependências ou mudança de aplicação, configuração, banco
ou rotas. Não executamos nova suíte; último resultado completo permanece o
da 6.84 (66 testes/620 asserções e quatro contratos). Entendimento confirmado;
checkpoint preparado para commit e push. Consultar o Git ou registro posterior
para conferir a publicação.

Referências oficiais: [autenticação](https://laravel.com/docs/13.x/authentication#introduction),
[atributos ocultos](https://laravel.com/docs/13.x/eloquent-serialization#hiding-attributes-from-json),
[casts](https://laravel.com/docs/13.x/eloquent-mutators#attribute-casting) e
[status de migrations](https://laravel.com/docs/13.x/migrations#running-migrations).

## Continuidade

Entendimento da relação model/configuração/migration confirmado com "entendi"
em 03/11/2026. Próximo passo, após publicar este checkpoint: 7.3 — inspecionar
o SQL gerado pela migration de usuários para SQL Server, sem aplicar a migration.
