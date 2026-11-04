# Aula 7.44 — Logout no controller

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.43 com "entendi". Checkpoint anterior publicado e conferido em
86ab952bfd858f2fed5a2d2f47a2bf44b8c93171; HEAD/origin/main/main remota iguais.
Entendimento da 7.44 confirmado com "entendi" em 04/11/2026; publicação pendente.

## Objetivo e arquivo

Alteramos somente [LoginController](../../backend/app/Http/Controllers/Api/V1/LoginController.php)
na aplicação, acrescentando o import Illuminate\Http\Request e o método destroy,
conforme o [contrato de logout](../api/logout.md). Store continua igual.
Não registramos rota ou alteramos o OpenAPI.

```php
public function destroy(Request $request): Response
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->noContent();
}
```

Destroy é público para poder ser usado como ação do controller. Request é a
requisição comum do Laravel: sair usa a sessão atual, sem validar email ou senha.
LoginRequest permanece exclusiva de store. Response declara o tipo de retorno,
e o nome destroy indica a ação de encerrar a autenticação da sessão.

Auth seleciona explicitamente o mesmo guard web usado no login. Logout remove
a identidade do guard; invalidate limpa os atributos, destrói o registro antigo
e gera outro ID; regenerateToken cria o token CSRF depois da limpeza. O marcador
anterior não fica preservado como na renovação após login. NoContent retorna
204 vazio, sem JSON nem redirecionamento.

O método também aceita guard visitante com sessão preparada. A rota futura
aplicará o fluxo de sessão/CSRF da interface própria. Chamar o método diretamente
não verifica middleware, transporte de cookies, resposta 419 ou navegador.

Referência: [logout, invalidação e token CSRF no Laravel](https://laravel.com/docs/13.x/authentication#logging-out).
Conferimos também SessionGuard::logout, Store::invalidate/migrate/regenerateToken
e ArraySessionHandler instalados, por leitura no Docker.

## Diagnóstico direto em ambiente de teste

Script temporário /tmp/curso-7-44-logout.php no host, não versionado. PHP e aplicação
executados no Docker por stdin. Cada caso criou sua aplicação em testing,
sessão/cache array e bcrypt 4 somente na instância. Configuração e identidade
SQL loja_test/loja_testes exigidas antes de transação ou escrita. Seis tabelas,
quatro migrations e cinco tabelas de dados vazias conferidas na entrada.

Caso autenticado criou User fictício na transação e chamou login do guard web
real, sem actingAs/mock ou executar store. Caso visitante começou sem identidade.
Request POST sem corpo recebeu a sessão por setLaravelSession. Marcador/ID/token
guardados apenas em memória; sessão salva no handler array antes da chamada para
comprovar existência e remoção do registro antigo. Nenhum valor privado impresso.

Nos dois casos, 13 condições passaram: 204, corpo vazio, sem Location, guard
visitante/ID null, chave de login removida, marcador removido, ID renovado,
token renovado, somente _token nos atributos, registro antigo destruído,
recarga visitante, recarga com ID/token novos e rollback/contagens preservados.
Para a recarga, salvamos a sessão nova, limpamos atributos em memória,
descartamos guards e carregamos do mesmo handler array. Isso não é outra
requisição HTTP ou prova de transporte por cookie.

Finally desfez a transação de cada caso; cinco contagens anteriores preservadas
e nível de transação zero. Diagnóstico retornou sucesso true/código 0.
Sessões só em memória, sem arquivos/cookies persistidos ou dados na loja normal.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/LoginController.php
docker compose exec -T backend php -l < /tmp/curso-7-44-logout.php
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-7-44-logout.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Exec -T executa sem terminal interativo no serviço backend; o redirecionamento
envia o script do host ao PHP do container. APP_ENV testing seleciona ambiente
de testes. -l verifica sintaxe sem executar a lógica. PHPUnit usa a configuração
existente; do-not-cache-result evita atualizar cache de resultados.

Sintaxe do controller/script válida. Suíte existente passou: 101 testes/1.407
asserções, código 0. Ela confere regressões; ainda não contém cenário permanente
do método destroy. Os dois casos novos foram verificados pelo diagnóstico.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations
com lotes 1/2/3/4 e zero categorias/produtos/users/password_reset_tokens/sessions.
A primeira comparação estrita dos lotes falhou porque o driver devolveu strings;
leitura dos metadados confirmou valores corretos. Conversão explícita para int
no diagnóstico resolveu a comparação; SELECT final código 0, sem alterar banco.

Git diff --check passou. Links locais conferidos: contrato de logout três,
login quatro, consulta cinco, limite um, aula 7.43 três e aula 7.44 dois.
Escopo conferido: somente LoginController e documentos; índice vazio.
Rotas/bootstrap/Compose/OpenAPI sem diff, rota de logout ainda ausente.

## Continuidade

Método implementado, explicado e verificado; entendimento confirmado em 04/11/2026.
Ambientes, dependências, serviços, migrations, rotas, bootstrap, Compose e OpenAPI
preservados. Sem HTTP de logout, verificação de CSRF/cookies ou navegador/CORS.
Auditoria, snapshot do banco normal e contratos HTTP não foram repetidos.
Publicação da 7.44 pendente. Próxima após confirmar/publicar: 7.45 — adicionar
um cenário permanente de logout autenticado em LoginControllerTest, com transação
em loja_test e sessão array, sem registrar rota.
