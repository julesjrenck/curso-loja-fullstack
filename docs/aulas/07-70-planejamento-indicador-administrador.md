# Aula 7.70 — Planejamento do indicador de administrador

Desenho apresentado em 05/11/2026, após confirmação da
[7.69](07-69-autorizacao-apos-login.md) com "entendi".
Checkpoint anterior publicado e conferido em
82b13cf6c6e196d7e873fed5ba2c338b957bd0c8; HEAD/origin/main/main remota iguais.
Entendimento da 7.70 confirmado com "entendi" em 05/11/2026; publicação
conferida em dd9c3911fd9d8965c90541d651e80a0a3b920a22, HEAD/origin/main/main remota iguais.
Registro atualizado após a publicação. Somente documentação alterada.

## Representação mínima

Para a primeira regra administrativa, planejamos um atributo is_admin no User.
É uma pergunta booleana: este usuário tem o indicador de administrador?

| Valor planejado | Significado |
| --- | --- |
| false | Usuário sem privilégio administrativo; caso normal de cliente. |
| true | Usuário com indicador administrativo, que as regras poderão consultar. |

Esse indicador resolve a distinção inicial do curso. Não representa uma lista
completa de funções da loja. Um administrador também poderá comprar, e cada
ação continuará dependendo da sua regra. A coluna sozinha não aplica uma
Policy, protege uma rota ou autentica uma sessão.

## Padrão sem privilégio

A futura coluna será booleana, obrigatória e terá padrão false. Ao criar uma
conta sem definir esse atributo, o banco deverá guardar false. Não haverá
terceiro estado null. A migration também deverá deixar os usuários existentes
com false; verificaremos esse comportamento antes de aplicá-la no banco normal.

O aluno de laboratório continuará sem promoção automática. Fazer login não
muda o indicador; senha correta identifica a conta, não concede administração.
Nenhuma conta foi consultada ou alterada nesta aula.

## Quem pode atribuir true

A atribuição será feita por um procedimento administrativo controlado no
servidor, apresentado em uma etapa futura. O formulário de login continuará
enviando somente email/password. Um campo enviado pelo navegador dizendo
is_admin true não será a fonte da permissão.

O [User atual](../../backend/app/Models/User.php) contém:

```php
#[Fillable(['name', 'email', 'password'])]
```

Fillable define quais atributos podem ser preenchidos em conjunto por
operações do Eloquent, como create/fill/update com um array. Vamos manter
is_admin fora dessa lista. Não usaremos dados completos da requisição para
atribuir privilégios. Essa restrição complementa a validação e o controle
administrativo; não substitui autorização nem impede uma atribuição explícita
feita por código do servidor.

Referência: [atribuição em massa no Eloquent](https://laravel.com/docs/13.x/eloquent#mass-assignment).

## Relação entre banco, model e API

A migration criará a coluna persistida. Depois, o método casts do User ganhará
o mapeamento is_admin para boolean, para acessar o atributo como true/false
em PHP. O cast converte a representação; não cria a coluna e não decide quem
pode alterar o valor. Referências: [casts](https://laravel.com/docs/13.x/eloquent-mutators#attribute-casting)
e [padrão de coluna](https://laravel.com/docs/13.x/migrations#column-modifiers).

O [LoginRequest](../../backend/app/Http/Requests/LoginRequest.php) valida
email/password e o [LoginController](../../backend/app/Http/Controllers/Api/V1/LoginController.php)
entrega os dados validados ao guard. Não vamos acrescentar is_admin como
credencial de login. O [UsuarioResource](../../backend/app/Http/Resources/UsuarioResource.php)
continua selecionando id/name/email; criar um atributo interno não exige
incluí-lo na resposta da API. Qualquer mudança de contrato será estudada
quando a interface precisar dela.

O [seeder do laboratório](../../backend/database/seeders/UsuarioLaboratorioSeeder.php)
e a [UserFactory](../../backend/database/factories/UserFactory.php) atuais
não fornecem is_admin. Quando a coluna existir, o padrão do banco atenderá
inserções que não informarem o atributo. Preparar um administrador em testes
e preparar uma conta administrativa local serão etapas distintas e futuras.

## Verificação e continuidade

Conferidos User, migration inicial, lista de migrations, LoginRequest,
LoginController, UsuarioResource, seeder e factory. O código atual não define
is_admin; não consultamos o schema do banco nesta etapa. Nenhum arquivo de
aplicação, migration ou cast foi alterado. Nenhum comando PHP, API, SQL ou
nova suíte executado. Última suíte permanece 7.58: 107 testes/1.586 asserções.

Entendimento confirmado com "entendi" em 05/11/2026. Continuidade iniciada na
[7.71](07-71-migration-indicador-administrador.md): criar
somente a migration que adiciona is_admin a users, com padrão false e reversão
que remove a coluna, examinar o SQL gerado para SQL Server sem aplicá-la.
Não executar migrations no banco normal nesta próxima etapa. Módulos 8 a 23
não iniciados.

Exercício acompanhado: uma conta nova pode se tornar administradora apenas
enviando is_admin true no formulário? O que deve determinar esse privilégio?
