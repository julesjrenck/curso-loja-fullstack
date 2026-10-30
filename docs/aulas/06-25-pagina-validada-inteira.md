# Aula 6.25 — Página validada como inteiro e valor padrão no Form Request

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.24 em 3d89485cd53137a76d9c2d40d55d15a0adff0157. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.25 confirmado
pelo aluno com "entendi" em 30/10/2026. Somente backend/app/Http/Requests/ListarProdutosRequest.php
alterado no código, acrescentando um método. Ainda sem ligação à rota.

## Código e conceito

```php
public function pagina(): int
{
    return (int) $this->validated('page', 1);
}
```

Public permite chamar o método pela instância do Form Request. : int declara o
tipo de retorno. $this representa a requisição atual; validated é herdado de
FormRequest. Com a chave 'page', busca somente esse campo nos dados validados;
o segundo argumento, 1, será usado quando a chave estiver ausente.
Assinatura e implementação conferidas na classe instalada do Laravel.

O cast (int) converte explicitamente a string validada em inteiro. Se o campo
estiver ausente, o padrão 1 já é inteiro. O método fornece uma saída adequada
à futura consulta paginada, sem modificar os dados originais da requisição.

| Entrada após validar | validated() | pagina() |
| --- | --- | --- |
| Page ausente | [] | 1, int |
| Page '1' | ['page' => '1'] | 1, int |
| Page '2' | ['page' => '2'] | 2, int |
| Page '1000000' | ['page' => '1000000'] | 1000000, int |

O fluxo será validar primeiro e depois obter pagina(). Esse método não dispara
validateResolved por si só e não deve ser chamado antes de validar. Valores
como vazio, 0 ou abc continuam sendo rejeitados pelas regras da 6.24; não são
substituídos pelo padrão 1. O padrão trata ausência de page, permitida por
sometimes. Required continua impedindo que page presente seja vazio.

Authorize e rules permanecem iguais. O controller ainda não recebe a classe,
portanto a API executável segue sem validar page e sem paginar. Não houve
alteração em rota, serviço, contrato, resource ou configuração.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Requests/ListarProdutosRequest.php
docker compose exec -T backend php < /tmp/curso-625-pagina.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l verifica sintaxe. O redirecionamento envia o diagnóstico temporário ao
PHP do container. O script adapta a experiência da 6.24: cria Form Request GET,
injeta container/redirector e chama validateResolved. Somente após sucesso chama
pagina(), compara com valores esperados explícitos e confere tipo int. Também
confere que validated() preserva seus dados originais. Para inválidos, renderiza
ValidationException pelo handler real e confere JSON. Não usa kernel/rota ou
middlewares globais. DB::listen confirmou zero SQL no processo.

- Sintaxe válida.
- 4 casos aceitos e saídas inteiras corretas: ausente -> 1; '1' -> 1; '2' -> 2;
  '1000000' -> 1000000. Validated original preservado.
- 12 casos rejeitados antes de pagina(): abc, 0, -1, 1.5, 01, vazio, null,
  array ['1'], +1, 1e3, 1000001 e PHP_INT_MAX.'0'. Handler produziu
  422/application/json, message string e errors.page com uma mensagem por caso.
- Suíte existente: 27 testes/133 asserções passaram. Sem teste permanente novo
  do método nesta etapa; os casos novos estão no diagnóstico temporário.
- SELECTs separados antes/depois por /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.
- Git diff --check passou.

O resultado verifica o método após validação direta, sem comprovar integração
HTTP futura. Não houve cadastro permanente, migration ou dependência nova.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
509ed431eada39804a81c4b04b670fb5cdcd8534, `feat: obtém página validada como inteiro`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem incluir o SHA no próprio commit.
Continuidade realizada na 6.26: adicionar paginarProdutos(int $pagina) a
CatalogoEloquent, com dez ativos por página em ordem nome/ID e retorno
LengthAwarePaginator, ainda sem mudar contrato ou ligar à rota.
