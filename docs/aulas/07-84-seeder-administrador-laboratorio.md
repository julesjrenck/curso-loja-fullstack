# Aula 7.84 — Seeder do administrador de laboratório

Preparação e verificações em 05/11/2026, após a
[7.83](07-83-autorizacao-no-navegador.md) confirmada com "entendi" e publicada
em 0e89de3c6f7efd82416f1d3a77d5566087c38d01. SHA de HEAD, origin/main e main
remota conferidos. Entendimento da 7.84 confirmado com "entendi" em
05/11/2026; publicação conferida em 5edfcefabc383534fa239e30bcd61312b0086ffc,
HEAD/origin/main/main remota iguais. Registro posterior à publicação.

## Objetivo

Preparar uma conta administrativa separada do cliente aluno@example.test,
para comparar posteriormente o acesso permitido e o negado no navegador.
Nesta etapa criamos o arquivo; ainda não executamos a criação da conta.

## Arquivo e fluxo

Criado somente
[AdministradorLaboratorioSeeder.php](../../backend/database/seeders/AdministradorLaboratorioSeeder.php)
na aplicação. Ele segue a estrutura do UsuarioLaboratorioSeeder, com identidade
admin@example.test e atribuição explícita de permissão no código do terminal.
DatabaseSeeder não foi alterado: este seeder não entrou na execução geral.

`namespace Database\Seeders` identifica a classe que o Artisan localizará.
`extends Seeder` fornece a estrutura de execução; `run(): void` contém as ações.
Os imports disponibilizam User, Seeder, a facade DB e LogicException.

As três primeiras condições limitam a execução:

- `app()->environment('local')`: recusa ambientes diferentes de local.
- `config('database.default')` e `DB::connection()->getDatabaseName()`:
  exigem conexão sqlsrv e banco loja; consultar o nome configurado não executa SQL.
- `$this->command` e a opção `no-interaction`: exigem execução interativa pelo
  Artisan. Essas condições ocorrem antes da consulta de existência da conta.

`User::query()->where('email', $email)->exists()` consulta apenas se a identidade
administrativa já existe. Se existir, informa a preservação e retorna antes de
pedir a senha. Não muda senha nem permissões; a mensagem não afirma que uma
conta preexistente já seja administradora.

`secret(..., false)` solicita entrada oculta e desativa a alternativa de entrada
visível. A validação usa `strlen`: aceita de 8 a 72 **bytes**, como o seeder do
cliente; bytes e caracteres podem diferir em textos com acentos. Senha ausente
ou fora do intervalo causa exceção antes da criação. Não há senha fixa no arquivo.

`new User` prepara o modelo em memória. As atribuições de name, email e password
preenchem os dados; o cast `password => hashed` do User aplica o hashing existente.
Não foi adicionado outro hashing no seeder.

`$usuario->is_admin = true` atribui a permissão diretamente no código confiável
do terminal. O campo continua fora do Fillable do User. O formulário de login
continua recebendo somente as credenciais; fazer login não promove a conta.
O cast boolean do User permite ao Gate comparar o indicador com `true`.

`$usuario->save()` fará a inserção quando executarmos o seeder de verdade.
Só depois dessa chamada será mostrada a mensagem de criação, sem senha ou hash.
A conta aluno@example.test não é consultada nem alterada por este arquivo.

## Verificações

Executado no container:

```sh
docker compose exec -T backend php -l database/seeders/AdministradorLaboratorioSeeder.php
```

`php -l` verifica a sintaxe sem executar o seeder. O `-T` desativa o terminal
virtual apenas para essa verificação automática. Resultado: sem erros, código 0.
PHP 8.4.26 e Composer 2.10.3 conferidos no container; nenhuma instalação.

Diagnóstico PHP temporário pela entrada padrão, usando o Laravel e o User reais,
com Command, consultas, inserção e obtenção de ID simulados por Mockery:

- Ambiente diferente de local; conexão diferente de sqlsrv; banco loja_test.
- Ausência de comando; execução com no-interaction.
- Conta já existente, sem pedido de senha e sem inserção.
- Senha ausente, curta ou com 73 bytes, sem inserção.
- Senhas fictícias de 8 e 72 bytes, com inserção simulada: identidade administrativa,
  indicador true e hash conferidos; is_admin permanece fora do Fillable.

Resultado final: 11 cenários e 28 verificações passaram, código 0, sem conexão
SQL real. A primeira montagem do diagnóstico falhou no construtor do mock de
conexão; foi corrigida usando mock parcial com métodos explícitos antes do
resultado final. O arquivo do seeder não precisou mudar. Nenhum auxiliar salvo.

Essas verificações não demonstram criação persistida, leitura de senha em um
terminal real ou login administrativo no navegador. Nenhuma conta criada ou
promovida nesta etapa. Sem nova suíte completa: última execução na 7.80,
116 testes/1.653 asserções. Página, rotas, Gate, User, migrações e OpenAPI mantidos.

## Continuidade

Entendimento da 7.84 confirmado com "entendi" em 05/11/2026 sobre a atribuição
direta de is_admin no seeder e manutenção do campo fora do Fillable.
Continuidade iniciada na [7.85](07-85-criacao-administrador-laboratorio.md):
executar o seeder no terminal do aluno, com senha
oculta escolhida por ele, e receber somente a mensagem final. A senha não deve
ser enviada ao assistente. Verificação do acesso administrativo no navegador
virá depois da criação confirmada. Módulos 8 a 23 não iniciados.
