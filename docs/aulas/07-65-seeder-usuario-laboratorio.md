# Aula 7.65 — Preparação da conta fictícia para login

Implementação, explicação e verificações em 05/11/2026, após relato geral de
sucesso da 7.64 e confirmação explícita com "Sim, entendi". Campos individuais
do navegador não fornecidos. Checkpoint anterior publicado e conferido em
8e8de99ac636c48d624d08fed3838cc94e6bf002, HEAD/origin/main/main remota iguais.
Entendimento da 7.65 confirmado com "entendi" em 05/11/2026; publicação pendente.

## Objetivo e arquivo

Criamos [UsuarioLaboratorioSeeder](../../backend/database/seeders/UsuarioLaboratorioSeeder.php),
único arquivo de aplicação alterado. Ele prepara uma conta fictícia para
exercitar login real pelo navegador, depois dos controles de visitante da
[7.64](07-64-logout-visitante-no-navegador.md).

Um seeder é uma rotina Laravel para preparar dados. Este fica separado do
[DatabaseSeeder](../../backend/database/seeders/DatabaseSeeder.php), que continua
chamando apenas ProdutoSeeder. Não acrescentamos conta ao seeding padrão.
A criação da conta ainda não foi executada; não consultamos users para afirmar
se o e-mail já existe no banco normal.

## Namespace, execução e condições

Namespace Database\Seeders corresponde ao autoload PSR-4 já configurado no
Composer. A classe estende Seeder e implementa run(): void, como os seeders
estudados no módulo 5. Não instalamos dependências nem regeneramos autoload.

Antes de consultar usuários, exige:

1. Ambiente local, por app()->environment('local').
2. Conexão padrão sqlsrv com destino loja, por config e getDatabaseName().
3. Um comando associado e ausência de --no-interaction.

Se uma condição falhar, lança LogicException com mensagem fixa. GetDatabaseName
lê o destino configurado da conexão resolvida; não executa SELECT DB_NAME() e
não mede a identidade do servidor. O diagnóstico confirmou PDO ainda não aberto.
O seeder não serve para preparar dados da suíte de integração em loja_test.

## Preservar uma conta existente

```php
$email = 'aluno@example.test';

if (User::query()->where('email', $email)->exists()) {
    $this->command->info('A conta de laboratório já existe e foi preservada.');

    return;
}
```

Esse e-mail é fictício, destinado ao laboratório. Exists consulta somente a
existência. Quando houver correspondência, termina antes de pedir senha ou
alterar nome, senha, identidade ou outros dados. A tabela users já possui
unicidade de email; não usamos updateOrCreate para substituir uma conta.

## Senha digitada no terminal

```php
$senha = $this->command->secret('Escolha uma senha exclusiva para a conta de laboratório', false);
```

Secret lê sem mostrar o que é digitado. O segundo argumento false desativa o
fallback que permitiria entrada visível se a ocultação não estiver disponível.
Essa opção foi conferida no InteractsWithIO instalado. A senha não é argumento
de linha de comando, variável .env, valor padrão ou literal no repositório.
Fonte: [entrada oculta no Artisan](https://laravel.com/docs/13.x/artisan#prompting-for-input).

A validação local do seeder exige string entre 8 e 72 bytes. Strlen conta bytes;
caracteres acentuados podem usar mais de um. Essa regra é do laboratório, sem
alterar LoginRequest. O limite superior atende ao bcrypt atualmente configurado.
Fonte: [limite do bcrypt no PHP](https://www.php.net/manual/en/function.password-hash.php).
Se inválida, a rotina termina antes do insert, sem mostrar a senha.

## Criação por Eloquent

```php
User::query()->create([
    'name' => 'Aluno do laboratório',
    'email' => $email,
    'password' => $senha,
]);
```

Os campos seguem o [model User](../../backend/app/Models/User.php). O cast
password hashed existente transforma o texto em hash ao atribuí-lo, como já
verificado na 7.6. Não acrescentamos Hash::make ou usamos a senha padrão de
UserFactory. Nome e e-mail são fictícios; a senha será escolhida pelo aluno.
O seeder mostra somente a mensagem de conta criada com o e-mail fictício.
Criar esse registro não inicia sessão nem faz login.

## Verificações executadas

```sh
docker compose exec -T backend php -l database/seeders/UsuarioLaboratorioSeeder.php
```

Exec usa o container existente; -T dispensa terminal para a verificação de
sintaxe. PHP -l passou, código 0. A classe foi carregada pelo autoload existente.

Diagnóstico PHP temporário no Docker exerceu somente cinco recusas de run:
fora de local, conexão incorreta, banco incorreto, ausência de comando e comando
sem interação. Comparou as mensagens esperadas, exigiu PDO ainda como Closure
e confirmou que nenhum prompt foi chamado. Os cinco controles passaram.

Para evitar SQL mesmo se uma guarda falhasse, beforeExecuting interromperia
qualquer tentativa. Contador ficou zero. Alterações de configuração/ambiente
foram só em memória e restauradas em finally, com ambas as restaurações
conferidas. Código 0; driver de hash lido como bcrypt, sem valores sensíveis.

Também chamamos o comando Artisan real com classe explícita e --no-interaction
por um diagnóstico com SQL bloqueado. Recusou antes de consultar usuários,
pedir senha ou cadastrar. Três controles passaram: recusa esperada, zero
tentativas SQL e PDO não aberto; diagnóstico terminou com código 0.

Isso verifica carregamento e recusas, não execução do caminho de criação,
preservação de uma conta consultada, prompt real ou persistência do hash.
Nenhuma conta/senha foi criada ou usada nestas verificações. Sem nova suíte
Laravel; última 7.58, 107 testes/1.586 asserções. Sem navegador/HTTP da aplicação, alteração
de ambiente/DatabaseSeeder/model/factory/rotas/configurações/serviços/Compose
ou OpenAPI. Nenhuma dependência instalada.

Git diff --check passou; oito links locais válidos, somente os cinco arquivos
previstos alterados e índice vazio. Única alteração na aplicação: novo seeder.

## Continuidade

Após confirmar entendimento e publicar, próxima 7.66: conferir o destino local
loja e orientar a execução interativa específica no terminal do aluno:

```sh
docker compose exec backend php artisan db:seed --class=UsuarioLaboratorioSeeder --no-ansi
```

Esse comando de cadastro ainda não foi executado. Não usar -T ou --no-interaction:
o terminal interativo permite entrada oculta. O aluno definirá uma senha
exclusiva no terminal; o relato deve conter apenas a mensagem final, sem senha
ou hash. Analisar se criou ou preservou uma conta antes do laboratório de login.
Módulos 8 a 23 não iniciados.
