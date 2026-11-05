# Aula 7.66 — Execução interativa do seeder de usuário

Preparação e orientação em 05/11/2026, após confirmação da 7.65 com "entendi".
Aluno relatou criação da conta e DONE; persistência conferida por metadados.
Entendimento da 7.66 confirmado com "entendi" em 05/11/2026.
Publicação conferida em 35669327d3cef8b7dc56136d4d78e2267329b3c2,
HEAD/origin/main/main remota iguais. Checkpoint anterior publicado e conferido em
16e4c8331093db423f8363ef17e837da4d6a3f5a, HEAD/origin/main/main remota iguais;
registro posterior à publicação.

## Objetivo

Cadastrar a conta fictícia para o laboratório de login usando o
[UsuarioLaboratorioSeeder](../../backend/database/seeders/UsuarioLaboratorioSeeder.php)
preparado na [7.65](07-65-seeder-usuario-laboratorio.md). A senha será escolhida
no campo oculto do terminal do aluno, sem enviá-la ao assistente.
Nenhuma alteração de código da aplicação nesta etapa.

É uma conta de desenvolvimento no banco loja. A suíte automatizada continua
isolada em loja_test. Cadastrar o usuário não cria uma sessão autenticada;
o login no navegador será uma etapa posterior.

## Destino conferido antes da execução

Um diagnóstico PHP no Docker carregou a aplicação e exigiu local, conexão
padrão sqlsrv e destino configurado loja. Conferiu a disponibilidade da classe
do seeder. Depois executou somente estas leituras pela conexão da aplicação:

1. SELECT com DB_NAME(), SUSER_SNAME() e USER_NAME(): confirmou banco loja,
   login loja_app e usuário loja_app. Essa é a identidade SQL, não o usuário
   que fará login na loja.
2. Exists com email aluno@example.test: retornou false nessa conferência.
   Isso não afirma que a tabela users está vazia.

BeforeExecuting recusaria instrução diferente de SELECT. O contador registrou
duas consultas; nenhuma escrita. Saída só com booleanos/contagem, sem dados de
outras contas, senha ou hash. Diagnóstico terminou com código 0, prontidão true.
O caminho de cadastro do seeder não foi executado pelo assistente.

O seeder consulta novamente a existência ao ser executado. Se a conta surgir
entre as duas ações ou já tiver sido criada por outra execução, será preservada.

## Comando no terminal do aluno

Na raiz do projeto:

```sh
docker compose exec backend php artisan db:seed --class=UsuarioLaboratorioSeeder --no-ansi
```

Exec usa o container backend existente. Sem -T, mantém o terminal interativo
necessário à entrada oculta. Artisan db:seed executa o seeder indicado por
--class; não chamamos DatabaseSeeder ou ProdutoSeeder. No-ansi remove códigos
de cor, sem desativar a interação. Não adicionar --no-interaction.

Quando aparecer Escolha uma senha exclusiva para a conta de laboratório,
digitar uma senha de 8 a 72 bytes e pressionar Enter. É normal não aparecerem
caracteres durante a digitação. Secret com fallback false não permite
substituir a entrada oculta por uma entrada visível.

Essa será a senha do login da aplicação. Guardá-la para o exercício posterior;
o relato aqui deve conter somente a mensagem final, sem senha ou hash.
O cast hashed do model User trata o armazenamento, conforme estudado na 7.65.

## Resultados previstos

| Mensagem final do seeder | Significado |
| --- | --- |
| Conta de laboratório criada: aluno@example.test. | Caminho de criação concluído pelo comando. |
| A conta de laboratório já existe e foi preservada. | Terminou sem redefinir senha ou outros dados. |
| Erro de ambiente, banco ou interação | Interrompeu antes da consulta/cadastro conforme a guarda. |
| Erro da senha fora do intervalo | Não chegou ao insert. |

O aluno relatou "Conta de laboratório criada: aluno@example.test." e DONE em
05/11/2026. As demais linhas descrevem alternativas do comando. Se ocorrer erro, informar
somente a mensagem principal, sem SQL, bindings, senha, hash ou dados de outras
contas. Não repetir para tentar redefinir uma conta preservada: esse seeder
não altera sua senha.

## Verificação e limites

Destino e ausência inicial do e-mail fictício foram verificados por leitura.
Depois do relato de criação, fizemos duas SELECTs adicionais com escrita
bloqueada: identidade real loja/loja_app/loja_app, conta persistida, nome/e-mail
fictícios esperados e formato bcrypt do campo password confirmados. Todos os
dez controles retornaram true, diagnóstico código 0. Total de quatro SELECTs
do assistente na etapa, duas antes e duas depois.

O hash foi inspecionado apenas em memória com password_get_info; saída só com
booleanos/contagem, sem valor de hash/senha. O assistente não conhece nem usou
a senha em texto; não comparamos a senha escolhida com o hash. O relato e os
metadados confirmam cadastro, sem medir a entrada oculta independentemente.
Criar o registro não autentica a sessão. O login ainda precisa de verificação
própria; não foi executado nesta etapa.

Não repetimos a sintaxe, as cinco recusas ou o comando sem interação já
verificados na 7.65. Sem nova suíte Laravel; última 7.58, 107 testes/1.586
asserções. Sem nova dependência, serviço, migration, alteração de model,
DatabaseSeeder, página, ambiente, configuração, Compose ou OpenAPI.

Git diff --check passou; sete links locais válidos, somente os quatro
documentos previstos alterados, índice vazio. Seeder/aplicação/página preservados.

## Continuidade

Cadastro e entendimento confirmados; publicação da 7.66 concluída.
Continuidade na [7.67 — formulário de login](07-67-formulario-login-laboratorio.md).
Módulos 8 a 23 não iniciados.
