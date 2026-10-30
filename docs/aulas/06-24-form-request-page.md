# Aula 6.24 — Form Request para validar page da listagem

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.23 em 92ce498e85ae0352a2eb5c94103bc6b9f1aad281. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.24 confirmado
pelo aluno com "entendi" em 30/10/2026. Um arquivo novo no código, criado pelo editor:
backend/app/Http/Requests/ListarProdutosRequest.php. Ainda sem ligação à rota.

## Arquivo e código

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListarProdutosRequest extends FormRequest
{
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
            'page' => [
                'bail',
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:1000000',
                'regex:/\A[1-9][0-9]*\z/',
            ],
        ];
    }
}
```

Namespace corresponde à pasta em app/Http/Requests, segundo o autoload existente.
O use permite referir-se à classe FormRequest pelo nome curto. Extends herda a
requisição Laravel e seu mecanismo de autorização/validação. Form Request pode
validar parâmetros de consulta de um GET, além de dados de formulários.

Authorize devolve bool e permite ou recusa a operação. True é adequado ao
catálogo público atual. Esse método permite prosseguir para a validação; ele não
declara que os dados já são válidos.

Rules devolve um array com nomes de campos como chaves e listas de regras como
valores. O PHPDoc descreve essa estrutura: chaves string, arrays internos com
índices inteiros e regras em strings. Não executa validação por si só; o
FormRequest usa essas regras no ciclo de validação.

| Regra de page | Efeito |
| --- | --- |
| bail | Para de validar esse campo depois do primeiro erro. |
| sometimes | Aplica as regras somente quando o campo existe na entrada. |
| required | Se existir, exige valor preenchido; rejeita vazio/null. |
| integer | Exige valor aceito como inteiro, inclusive texto vindo da URL. |
| min:1 | Exige valor numérico maior ou igual a 1. |
| max:1000000 | Limita o valor numérico a 1000000. |
| regex | Exige apenas dígitos decimais, primeiro entre 1 e 9. |

Sometimes e required se complementam: omitir page é permitido; enviar page
vazio é erro. Integer também impede frações e valores acima da faixa de int.
Com a regra integer presente, min/max usam o valor numérico, não a quantidade
de caracteres da string. A regex usa \A para começo absoluto e \z para fim
absoluto; [1-9][0-9]* retoma o padrão conhecido da rota individual e também
rejeita sinal positivo e zero inicial.

Referência: [Form Request e regras de validação no Laravel 13](https://laravel.com/framework/docs/13.x/validation#form-request-validation).

## Entradas, saídas e relação com o fluxo

Na verificação direta, page ausente foi aceito e validated() devolveu [].
Page '2' foi aceito e validated() devolveu ['page' => '2']; o valor continua
string. Validar como inteiro não converte o valor para int. Conversão e padrão
1 serão preparados na próxima etapa, antes de usar esse valor na consulta.

Os inválidos geram ValidationException. No diagnóstico, o handler Laravel
renderizou 422/application/json com message e errors.page, uma lista com uma
mensagem. Não fixamos textos de erro, sujeitos à tradução. Bail manteve somente
o primeiro erro do campo em cada caso.

O arquivo ainda não é recebido por ProdutoController@index. Por isso a API
executável continua sem validar page e sem paginar; o Form Request será ligado
mais adiante. Controller/rotas/serviço/contrato interno/resource foram preservados.
Não houve pacote novo, alteração de configuração ou de esquema do banco.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Requests/ListarProdutosRequest.php
docker compose exec -T backend php < /tmp/curso-624-validar-page.php
docker compose exec -T backend php artisan test --do-not-cache-result
```

Php -l verifica sintaxe. O redirecionamento envia o diagnóstico temporário ao
PHP do container. O script carrega Laravel e cria requisições GET diretamente
como ListarProdutosRequest, injeta container/redirector e chama validateResolved,
exercitando authorize/rules. Para inválidos, captura ValidationException e usa
o handler real para renderizar JSON. Não passa pela rota ou middlewares globais.
DB::listen observa consultas do processo e confirmou zero SQL.

- Sintaxe válida.
- 4 entradas aceitas: ausente, '1', '2' e '1000000'. Saída validada preservada
  e autorização true conferidas; sem valor padrão injetado.
- 12 rejeitadas: abc, 0, -1, 1.5, 01, vazio, null, array ['1'], +1, 1e3,
  1000001 e PHP_INT_MAX.'0'. Todos com 422/application/json, message string e
  errors.page contendo uma mensagem; zero SQL observado.
- Suíte existente: 27 testes/133 asserções passaram. Sem teste permanente novo
  para o Form Request nesta etapa; novos casos estão no diagnóstico temporário.
- SELECTs separados antes/depois por /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.
- Git diff --check passou.

O resultado verifica a classe isoladamente com o mecanismo Laravel, sem
comprovar validação na API publicada. Essa integração terá sua própria etapa
e testes permanentes quando for introduzida.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint concluído,
publicação em preparação; resultado será registrado após conferir o remoto.
Próximo passo: publicar checkpoint e iniciar somente 6.25, acrescentar pagina(): int
ao Form Request
para devolver page validado convertido ou padrão 1, ainda sem ligação à rota.
