# Aula 7.85 — Criação do administrador de laboratório

Roteiro apresentado em 05/11/2026, após entendimento da
[7.84](07-84-seeder-administrador-laboratorio.md) confirmado com "entendi".
Checkpoint anterior publicado e conferido em
5edfcefabc383534fa239e30bcd61312b0086ffc; HEAD/origin/main/main remota iguais.
Aluno relatou criação concluída em 05/11/2026; entendimento da 7.85 confirmado
com "entendi" na mesma data. Publicação conferida em
a8bf8d8fb14fe47865736f6af7aa448ee34ebb17; HEAD/origin/main/main remota iguais.
Registro posterior à publicação.

## Objetivo

Executar o seeder preparado na etapa anterior, escolhendo a senha oculta no
terminal do aluno. A identidade prevista é admin@example.test. A conta de
cliente aluno@example.test continua separada.

## Comando no terminal do aluno

Na raiz do projeto:

```sh
docker compose exec backend php artisan db:seed --class=AdministradorLaboratorioSeeder --no-ansi
```

- `docker compose exec backend`: executa dentro do serviço backend ativo,
  com terminal interativo. Não usar `-T` nesta atividade.
- `php artisan db:seed`: inicia a execução de seeders no Laravel.
- `--class=AdministradorLaboratorioSeeder`: seleciona somente o arquivo da
  7.84; não executa a sequência geral do DatabaseSeeder.
- `--no-ansi`: apresenta a saída sem cores; não desativa a interação.

Escolher uma senha exclusiva de 8 a 72 bytes no campo oculto. É normal nada
aparecer durante a digitação. Guardar a senha para o login administrativo
posterior; não enviá-la ao assistente. A aplicação aplicará o cast hashed.

O seeder verifica local/sqlsrv/loja/comando interativo antes de consultar a
existência da conta. Se ela não existir e a senha for válida, prepara o User,
atribui is_admin true diretamente e salva. Se existir, retorna sem alterar
senha ou permissões e sem pedir uma nova senha.

## Como interpretar a saída

Criação prevista:

```text
Conta administrativa de laboratório criada: admin@example.test.
```

Outra possibilidade:

```text
A conta admin@example.test já existe e foi preservada. Nenhuma permissão foi alterada.
```

A segunda mensagem não demonstra que a conta preexistente seja administrativa.
Em caso de falha, parar e informar somente a mensagem do erro, sem repetir
automaticamente o comando. Não enviar SQL, stack trace, senha ou hash.

Relato recebido em 05/11/2026: "Conta administrativa de laboratório criada:
admin@example.test.", seguido da identificação do seeder e DONE. Pelo código,
essa mensagem vem depois do save do usuário com is_admin true e password
tratada pelo cast hashed. Não houve consulta independente do banco pelo
assistente. Senha e hash não foram enviados.

Criar a conta prepara identidade e permissão no banco; não autentica o
navegador. O relato de criação ainda não demonstra login ou acesso
administrativo no navegador; verificaremos isso depois.

## Verificação e continuidade

O assistente conferiu serviços backend/php/sqlserver ativos por Docker Compose.
Nenhuma execução do seeder, consulta SQL, criação, promoção ou login pelo
assistente nesta etapa. Código da aplicação mantido conforme a 7.84.
Nenhuma suíte repetida: último diagnóstico do seeder na 7.84, 11 cenários/
28 verificações simuladas; última suíte completa na 7.80, 116 testes/
1.653 asserções.

Entendimento confirmado com "entendi" em 05/11/2026 sobre a diferença entre
criação da conta com permissão e autenticação da sessão.
Continuidade iniciada na [7.86](07-86-acesso-administrativo-no-navegador.md)
para verificar o acesso administrativo no navegador. Essa verificação permanece
pendente até o relato do aluno.
Módulos 8 a 23 não iniciados.
