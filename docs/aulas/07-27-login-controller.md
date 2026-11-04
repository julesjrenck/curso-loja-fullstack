# Aula 7.27 — Tentativa de autenticação no controller

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.26 com "entendi". Checkpoint anterior publicado e conferido em
7f3e8edfc055c637d8038ea60c8f2a16e0e7118c; HEAD/origin/main/main remota iguais.
Entendimento da 7.27 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginController](../../backend/app/Http/Controllers/Api/V1/LoginController.php)
na aplicação, com store, conforme o [contrato](../api/login.md). Namespace segue
Api/V1. Imports trazem Controller da aplicação, LoginRequest, Response, facade
Auth e ValidationException. Extends mantém o padrão dos controllers existentes.
Arquivo escrito pelo editor, sem gerador Artisan.

```php
public function store(LoginRequest $request): Response
{
    if (! Auth::guard('web')->attempt($request->validated())) {
        throw ValidationException::withMessages([
            'email' => ['As credenciais informadas são inválidas.'],
        ]);
    }

    $request->session()->regenerate();

    return response()->noContent();
}
```

Store recebe LoginRequest, que será validada antes da ação quando integrarmos
controller/rota. Numa chamada direta, como no diagnóstico, validamos explicitamente
antes. Response declara o retorno de sucesso; o ramo de falha lança exceção.
Store estabelece autenticação; não cadastra um novo usuário.

## Credenciais, falha e sucesso

Validated entrega apenas email/password aceitos, sem remember/id extras.
Auth é a facade de autenticação; guard('web') escolhe o guard de sessão com
provider users/model User. Attempt procura a conta e confere a senha contra
o hash armazenado. Não usamos all(), Hash::make ou consulta manual no controller.

Attempt devolve true ao aceitar e false ao recusar. O operador ! entra no if
quando falha; throw interrompe store antes da renovação/204. WithMessages cria
ValidationException com lista de mensagens em email. O handler existente
renderiza 422 JSON em api/*. Senha incorreta e e-mail inexistente usam o mesmo
erro genérico; igualdade do corpo não afirma igualdade de tempo de processamento.

Após sucesso, session()->regenerate() renova o identificador da sessão. A
implementação instalada também renova o token CSRF; a identidade do guard
permanece na sessão. Renovar após login integra a proteção contra reutilização
de identificador anterior à autenticação. Response()->noContent() produz 204
vazio, sem dados do usuário, token de API ou redirecionamento. A interface
consultará GET /api/v1/usuario para obter os dados públicos depois.

Referência: [attempt, guard e renovação da sessão](https://laravel.com/docs/13.x/authentication#manually-authenticating-users).
Também lemos Store::regenerate e ValidationException::withMessages instalados,
por reflexão em PHP Docker, sem executar autenticação nessa inspeção.

## Diagnóstico com banco de testes

PHP Docker/testing criou aplicação por caso, session.driver array e bcrypt.rounds
4 somente na instância. Loja_test/loja_testes exigidos antes da transação e das
escritas. Cada caso criou User fictício na transação, iniciou sessão array e a
anexou à LoginRequest. Guard web real, sem actingAs ou mock. Entrada JSON inclui
remember/id extras; validateResolved chamado antes de store diretamente.
Guard confirmado visitante inicialmente. Valores privados só comparados em memória.

| Caso | Resultado conferido |
| --- | --- |
| Credenciais corretas | 204 vazio/sem Location, usuário correto no guard/sessão, ID/token CSRF renovados, remember_token null. |
| Senha incorreta | 422 JSON/erro genérico em email, visitante, ID/token preservados. |
| E-mail inexistente | Mesmo corpo 422 da senha incorreta, visitante, ID/token preservados. |

Validated continha somente email/password nos três casos. Nove condições no
sucesso e sete por falha passaram, e corpos das duas falhas foram iguais.
Finally desfez cada transação; consulta posterior contou zero users após cada
rollback. Código 0. Sessões somente em memória, sem arquivos/cookies persistidos;
nenhum valor de senha, hash, cookie, ID de sessão ou token impresso.

Realizamos tentativas pelo guard/banco de testes, sem executar endpoint,
pipeline HTTP, CSRF ou troca de cookies com navegador. A rota continua ausente.
Não usamos o banco normal para dados de autenticação.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Http/Controllers/Api/V1/LoginController.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; suíte existente 88 testes/756 asserções passou, código 0.
Controller exercitado pelo diagnóstico, ainda sem teste permanente dele.
SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Sem mudanças de ambientes, dependências, rotas, bootstrap ou OpenAPI. Auditoria,
snapshot normal e quatro contratos não foram repetidos.

## Continuidade

Controller criado, explicado e verificado; entendimento confirmado com "entendi"
em 04/11/2026; publicação pendente. Após publicar: 7.28 —
testes automatizados do LoginController com sucesso, falhas genéricas e renovação
da sessão, usando loja_test/transações e sessão array, sem registrar rota.
Limitação de tentativas terá regra própria antes de disponibilizar login completo.
