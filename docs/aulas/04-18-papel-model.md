# Aula 4.18 — Papel do Model em MVC

## Objetivo

Apresentar o M de MVC usando app/Models/User.php, já gerado na estrutura Laravel.
Demonstrar um objeto e seus atributos em memória, antes de estudar persistência
SQL Server. Não alteramos código ou configuração da aplicação nesta etapa.

## Model, controller e view

Model representa dados e comportamento do domínio. Em Laravel, Eloquent oferece
models capazes de representar registros e trabalhar com tabelas de banco usando
objetos PHP. Essa ferramenta é um ORM, um mapeador entre objetos e dados relacionais.

Controller organiza o atendimento da requisição e entrega dados à resposta;
view define a apresentação. Um controller pode consultar um model e passar seus
dados para uma view quando essa funcionalidade for construída.

Na página /loja, os nomes continuam vindo de CatalogoDemonstracao em memória.
User é apresentado separadamente; não adicionamos consulta de usuários, login
ou model de produto antecipadamente.

## User.php existente

O arquivo declara namespace App\Models e usa esta classe base:

```php
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
```

as Authenticatable dá um nome local à classe User do framework, permitindo
distingui-la de nossa classe User. Essa base possui suporte à autenticação e
herda de Eloquent Model. O diagnóstico confirmou que nosso objeto também é
uma instância de Illuminate\Database\Eloquent\Model.

A convenção do Eloquent relaciona User à tabela users. Consultamos getTable()
para conferir o nome esperado; isso não cria nem comprova a existência da tabela.

O modelo também contém estas declarações do Laravel 13:

```php
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
```

#[...] é a sintaxe de atributos PHP para metadados da classe:

- Fillable indica campos permitidos na atribuição em massa, como o array recebido
  pelo construtor. Validação dos valores terá seu próprio estudo nas próximas etapas.
- Hidden indica campos ocultados na representação do model em array/JSON.
  Controla essa representação; o atributo continua fazendo parte do objeto.

name e email são atributos de dados do model. Os metadados PHP acima configuram
como Eloquent trata esses dados. O diagnóstico conferiu getFillable e getHidden,
sem criar senha, token ou dados privados.

Dentro da classe, use HasFactory, Notifiable incorpora traits, blocos reutilizáveis
de comportamento PHP. HasFactory integra factories; Notifiable oferece suporte
a notificações. Os imports e o comentário @use HasFactory<UserFactory> identificam
essas relações para o código e ferramentas de edição. Seus usos serão aprofundados
nas etapas próprias; nenhuma factory ou notificação foi executada aqui.

O método protegido casts(): array declara:

```php
return [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];
```

Essas opções orientam conversões de valores: data/hora e hash de senha. Os dois
campos não foram preenchidos nesta demonstração; persistência e autenticação
aprofundarão seu uso. O import comentado MustVerifyEmail permanece como veio no modelo.

## Demonstração em memória

Executamos PHP temporário no Docker, sem inicializar a aplicação Laravel:

```bash
docker compose exec -T backend php
```

O código foi enviado pela entrada padrão e começou apenas com o autoload:

```php
require '/app/vendor/autoload.php';

$usuario = new App\Models\User([
    'name' => 'Cliente de demonstração',
    'email' => 'cliente@example.test',
]);

$usuario->name = 'Cliente atualizado de demonstração';
```

new cria uma instância. O construtor herdado recebe um array de atributos;
name e email estão entre os campos permitidos. Eloquent oferece leitura e
atribuição desses valores por acessos como $usuario->name, implementados na
classe base. A leitura também foi conferida por getAttribute('name').

Criar e alterar esse objeto trabalha com memória do processo. Operações de
persistência, como save, serão apresentadas com o banco preparado no módulo 5.

## Verificações

- Objeto reconhecido como App\Models\User e Eloquent Model.
- Nome e e-mail fictícios conferidos após construção.
- getTable retornou users como nome esperado pela convenção.
- getFillable e getHidden reconheceram os metadados do arquivo.
- Nome alterado e lido corretamente por getAttribute.
- exists permaneceu false e getKey retornou null: instância nova, sem registro
  carregado ou salvo pelo Eloquent nesta demonstração.
- Model::getConnectionResolver permaneceu null antes e depois. O processo não
  inicializou Laravel nem configurou resolvedor de banco; não houve query ou save.
- Código do backend, src, Compose e Dockerfile sem alterações.

Somente dados fictícios foram exibidos. Não usamos migrations, factories,
notificações, autenticação, banco, credenciais, testes Laravel ou contador.
Esta verificação demonstra atributos em memória, não integração com SQL Server.

## Situação e próximo passo

Explicação e demonstração concluídas; entendimento confirmado com "entendi" em
13/10/2026. Etapa de estudo do arquivo existente, sem implementação nova.
Checkpoint aa372c6 publicado; HEAD, origin/main e consulta direta à main remota
coincidiram.

Após confirmação, publicar a documentação e iniciar 4.19: revisão do módulo 4,
relacionando estrutura, Artisan, ciclo HTTP, rotas, controllers, Blade, middleware,
container, injeção, providers e papel do model. Conferir a entrega /loja e as
pendências antes de SQL Server. Encerrar o módulo somente após entendimento da
revisão; não iniciar o módulo 5 nesta etapa.

Fontes oficiais:

- [Eloquent e convenções de models](https://laravel.com/docs/13.x/eloquent#eloquent-model-conventions).
- [Atribuição em massa](https://laravel.com/docs/13.x/eloquent#mass-assignment).
- [Campos ocultados na representação](https://laravel.com/docs/13.x/eloquent-serialization#hiding-attributes-from-json).
- [Conversões de atributos](https://laravel.com/docs/13.x/eloquent-mutators#attribute-casting).
