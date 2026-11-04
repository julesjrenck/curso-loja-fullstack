# Aula 7.25 — Validação da entrada do login

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.24 com "entendi". Checkpoint anterior publicado e conferido em
7ee449a061c7797b28384490d2b8b488bdcb0846; HEAD/origin/main/main remota iguais.
Entendimento da 7.25 confirmado com "entendi" em 04/11/2026.

## Objetivo e arquivo

Criamos somente [LoginRequest](../../backend/app/Http/Requests/LoginRequest.php)
na aplicação, seguindo ListarProdutosRequest e o [contrato](../api/login.md).
Arquivo escrito pelo editor, sem gerador Artisan ou nova dependência.
Namespace App\Http\Requests identifica a classe. Importamos FormRequest do
Laravel e herdamos sua integração de autorização/validação com a requisição.
Quando o futuro controller receber LoginRequest, o framework poderá validar
a entrada antes da ação. Ainda não criamos esse controller ou rota.

```php
public function authorize(): bool
{
    return true;
}

/**
 * @return array<string, array<int, string>>
 */
public function rules(): array
{
    return [
        'email' => ['bail', 'required', 'string', 'email', 'max:255'],
        'password' => ['bail', 'required', 'string'],
    ];
}
```

Authorize permite processar a requisição, inclusive de visitante. Retornar true
não verifica senha, autentica ou ignora CSRF; não muda a proteção de GET usuario.
Authorize false recusaria a requisição antes de verificar os dados.
Rules devolve um array de regras por campo. O PHPDoc descreve o formato desse
array para ferramentas; bool/array declaram os retornos dos métodos.

| Regra | Efeito neste arquivo |
| --- | --- |
| bail | Para as regras do mesmo campo após sua primeira falha. Outros campos continuam sendo avaliados. |
| required | Exige valor presente e preenchido; null/vazio/somente espaços falham. |
| string | Recusa números, arrays e outros tipos que não sejam string. |
| email | Confere formato de e-mail, sem consultar se existe conta no banco. |
| max:255 | Limita email a 255 caracteres. |

Password não recebe regras de cadastro, min, trim manual, hash ou consulta de
credenciais. Uma string curta pode passar pelo formato e ainda falhar depois
na autenticação. Não usamos exists/unique:users nesta validação de entrada.

Referência: [Form Requests e validação](https://laravel.com/docs/13.x/validation#form-request-validation).

## Verificação em memória

Diagnóstico PHP Docker/testing inicializou aplicação e listener SQL. Requests
POST JSON ilustrativos passaram pelos middlewares reais TrimStrings e
ConvertEmptyStringsToNull em Pipeline, sem rota ou HTTP de rede. Resolver do
diagnóstico indica visitante. Criamos LoginRequest via createFrom, fornecemos
container/redirector e chamamos validateResolved para executar authorize/regras.
Nos casos aceitos, validated devolveu exatamente os campos esperados. Nos
recusados, ValidationException foi renderizada pelo handler existente em memória:
conferimos 422/application/json/message/errors e campos de erro.

| Grupo | Casos e resultado |
| --- | --- |
| Três válidos | Entrada comum; normalização/extras; senha curta de um caractere. |
| Três de ausência | Email ausente; password ausente; ambos ausentes. |
| Seis de email inválido | Null, array, número, vazio, formato inválido e texto acima do limite. |
| Cinco de password inválido | Null, array, número, vazio e somente espaços. |

Total 17 casos, três válidos/14 inválidos, código 0 e zero SQL por listener.
Email perdeu espaços externos, password manteve os seus e remember/id extras
ficaram fora de validated. As entradas originais continuam na Request; o futuro
controller deverá usar os dados validados, não all(). Saída do diagnóstico com
nomes de casos/campos e status, sem imprimir valores de senha. Nenhum usuário,
sessão ou autenticação criado. Isso não prova CSRF, login 204 ou credenciais.
Ainda não há testes permanentes da LoginRequest; serão a próxima etapa.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Http/Requests/LoginRequest.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

Sintaxe válida; suíte existente 71 testes/662 asserções passou, código 0.
Arquivo novo exercitado pelo diagnóstico, não pelos testes anteriores.
SELECT posterior confirmou loja_test/loja_testes, seis tabelas, quatro migrations/
lotes 1/2/3/4 e zero users/password_reset_tokens/sessions/produtos/categorias.
Sem mudanças de rotas, bootstrap, controller, model, dependências ou ambientes.
OpenAPI preservado; auditoria/snapshot normal/quatro contratos não repetidos.

## Continuidade

LoginRequest criada, explicada e verificada; entendimento confirmado com
"entendi" em 04/11/2026; publicação conferida em
ad9f45bfb0f30bc2b3375be441517706e9b356bc, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação. Continuidade na 7.26 —
criar testes automatizados da LoginRequest em memória, cobrindo entradas
válidas/inválidas, normalização e exclusão de campos extras de validated,
antes de criar controller ou registrar rota de login.
