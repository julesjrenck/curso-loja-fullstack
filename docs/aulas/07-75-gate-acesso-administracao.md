# Aula 7.75 — Gate de acesso à administração

Implementação, explicação e verificações em 05/11/2026, após confirmação da
[7.74](07-74-cast-boolean-administrador.md) com "entendi".
Checkpoint anterior publicado e conferido em
a488fbaa02068250e0a393134a24d579c068d738; HEAD/origin/main/main remota iguais.
Entendimento da 7.75 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Alteramos somente o
[AppServiceProvider](../../backend/app/Providers/AppServiceProvider.php)
na aplicação. Acrescentamos os imports App\Models\User e
Illuminate\Support\Facades\Gate e a definição no começo de boot:

```php
Gate::define('acessar-administracao', function (User $user): bool {
    return $user->is_admin === true;
});
```

Define registra uma regra com um nome. A string acessar-administracao será
a referência usada para consultá-la; não é nome de rota ou endereço HTTP.
A função recebe User e retorna bool. O Laravel fornece o usuário ao consultar
o Gate. A comparação estrita permite apenas quando a leitura de is_admin
é true; o cast estudado na 7.74 converte os valores carregados para booleano.

False e atributo ausente em memória (null) não satisfazem a comparação.
O parâmetro User não aceita null; um visitante é recusado pelo mecanismo
de Gates sem precisar fornecer um usuário fictício para representar login.
Referência: [definição de Gates](https://laravel.com/docs/13.x/authorization#writing-gates)
e [usuários visitantes](https://laravel.com/docs/13.x/authorization#guest-users).

## Relações entre provider, model e operação

[bootstrap/providers.php](../../backend/bootstrap/providers.php) já registra
AppServiceProvider. Boot é executado na inicialização da aplicação e passa
a registrar a regra. Register mantém o binding Catalogo/CatalogoEloquent;
boot mantém também o limitador de login existente, sem alterar seus valores.

O [User](../../backend/app/Models/User.php) fornece a leitura do indicador.
O Gate não faz login, altera is_admin ou cadastra administradores. Um objeto
de teste com is_admin true não promove a conta real do laboratório.

Registrar a regra não aplica automaticamente uma proteção às
[rotas](../../backend/routes/api.php). Precisaremos consultar/exigir esse Gate
quando introduzirmos a operação administrativa. Nesta aula não acrescentamos
rota, controller ou resposta HTTP 403. Os GETs de produtos continuam públicos
e a consulta do próprio usuário continua protegida por auth:sanctum.

## Como verificamos as decisões

O diagnóstico PHP inicializou o Laravel real em testing, conferiu configuração
sem cache/sqlsrv/loja_test e instalou bloqueio de SQL na conexão. Criou apenas
objetos User em memória: cliente com valor bruto zero, administrador com um
e usuário sem indicador. Não houve inserção ou sessão autenticada.

Usamos o Gate real registrado pelo provider, por exemplo:

```php
Gate::forUser($cliente)->allows('acessar-administracao');
```

ForUser escolhe explicitamente qual objeto será avaliado; não realiza login.
Allows retorna o booleano da decisão. Para visitante, usamos forUser(null).

| Contexto em memória | Decisão observada |
| --- | --- |
| Cliente, indicador false | false |
| Administrador, indicador true | true |
| Visitante, sem User | false |
| User sem carregar indicador | false |

Sete controles passaram, código 0: Gate registrado no boot; quatro decisões
da tabela; zero tentativas SQL; PDO não aberto. Saída somente booleanos,
sem dados privados. Diagnóstico pela entrada padrão, sem arquivo auxiliar
persistido. Nenhuma conta promovida ou pedido de API executado.

Esses resultados verificam o registro e a decisão em memória. Não comprovam
login administrativo, persistência do indicador em uma conta real, transporte
de sessão ou proteção HTTP de uma operação. Esses comportamentos exigem
suas etapas de integração próprias.

## Comandos e continuidade

```sh
docker compose exec -T backend php -l /app/app/Providers/AppServiceProvider.php
docker compose exec -T backend php artisan test --compact --do-not-cache-result --colors=never
```

Exec -T usa o container backend sem terminal interativo. Php -l confere
sintaxe. Artisan test executa a suíte configurada em loja_test; compact reduz
a saída, do-not-cache-result dispensa gravação de cache no código readonly
e colors=never remove cores. O diagnóstico usou APP_ENV testing somente no
processo executado, sem alterar ambientes ou a configuração da aplicação.

Sintaxe passou. Suíte atual: 108 testes/1.606 asserções passaram, código 0,
após a alteração do provider. Não acrescentamos testes permanentes nesta aula.

Entendimento confirmado com "entendi" em 05/11/2026. Próximo após publicar:
7.76 — automatizar os
testes do Gate acessar-administracao para cliente, administrador, visitante
e indicador ausente, sem criar rota administrativa. Módulos 8 a 23 não iniciados.
