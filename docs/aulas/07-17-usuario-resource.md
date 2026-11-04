# Aula 7.17 — Representação pública do usuário

Implementação, explicação e verificações em 04/11/2026, após confirmação da
7.16 com "entendi". Checkpoint anterior publicado e conferido em
833c010506b8c0b45edd2cb8d959d4aba5d99744; HEAD/origin/main/main remota iguais.
Entendimento da 7.17 confirmado com "entendi" em 04/11/2026.

## Objetivo e alteração

Criamos somente [UsuarioResource](../../backend/app/Http/Resources/UsuarioResource.php)
na aplicação, seguindo ProdutoResource e o
[contrato planejado](../api/autenticacao.md). O Resource recebe um model e
seleciona os dados que representarão o usuário na resposta da API.
Arquivo escrito pelo editor; não executamos gerador Artisan nesta etapa.

```php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
```

Namespace identifica a classe no projeto; os dois use importam os tipos do
Laravel. Extends herda o comportamento de JsonResource e sobrescrevemos toArray
para selecionar os três campos. O PHPDoc descreve chaves string e valores de
tipos variados, sem executar validação. Request é a requisição que o framework
fornece à transformação; neste caso não precisamos consultar seus dados.

O construtor herdado recebe o objeto, por exemplo new UsuarioResource($usuario).
$this é o Resource: o Laravel encaminha acessos como $this->name ao model
recebido. O método devolve um array PHP; o framework o converte em JSON ao
montar a resposta e acrescenta o envelope data padrão. Não escrevemos data
manualmente dentro de toArray.

Password, remember_token e datas não são selecionados. A seleção explícita
controla a representação mesmo que o model contenha outros atributos. O Resource
não autentica, consulta o banco, valida cadastro nem garante ID positivo por
conta própria; receberá um User persistido pelo futuro fluxo autenticado.

Referência: [conceito de API Resources e delegação ao model](https://laravel.com/docs/13.x/eloquent-resources#concept-overview).

## Verificação em memória

PHP executado no Docker, com bootstrap do ambiente testing e listener SQL.
Criamos um User sem salvar, usando setRawAttributes somente no diagnóstico:
id 42, nome/e-mail fictícios, valores fictícios de senha/token e três datas.
Esse método atribui os dados crus sem executar o cast de hash; não é um exemplo
de cadastro. Nenhum segredo real foi usado.

Montamos um Request GET ilustrativo com Accept JSON e chamamos:

```php
$resource = new UsuarioResource($usuario);
$dados = $resource->resolve($request);
$response = $resource->toResponse($request);
```

Resolve aplica a transformação; toResponse monta uma resposta diretamente em
memória. A URL usada no Request não registra nem executa uma rota.
Sete condições passaram: campos/valores exatos, status 200, Content-Type JSON,
envelope data exato, model não persistido, oito atributos originais preservados
e zero SQL. Corpo produzido:

```json
{
  "data": {
    "id": 42,
    "name": "Ana Exemplo",
    "email": "ana@example.test"
  }
}
```

ID 42 é apenas uma entrada fictícia em memória. Os outros cinco atributos
continuaram no model e ficaram fora da resposta. Não houve autenticação,
requisição HTTP real, sessão iniciada ou verificação da resposta 401.

## Sintaxe e suíte existente

```sh
docker compose exec -T backend php -l app/Http/Resources/UsuarioResource.php
docker compose exec -T backend php vendor/bin/phpunit --colors=never --do-not-cache-result
```

O primeiro comando verifica sintaxe; o segundo executa os testes existentes
sem gravar cache de resultados. Sintaxe válida; 67 testes/635 asserções passaram,
código 0. A suíte preserva os comportamentos cobertos anteriormente; o novo
Resource foi exercitado pelo diagnóstico acima, sem teste permanente novo.

SELECT posterior confirmou loja_test/loja_testes, seis tabelas e quatro migrations
nos lotes 1/2/3/4. Zero users/password_reset_tokens/sessions/produtos/categorias
após os rollbacks da suíte. Sem migration, dependência, rota ou ambiente alterado.
Auditoria, snapshot do banco normal e quatro contratos não foram repetidos.

## Continuidade

UsuarioResource criada e explicada; endpoint ainda planejado e sem rota.
Entendimento confirmado com "entendi" em 04/11/2026; publicação conferida em
8cceb303214e66f63cfb3c6ed4a5cf4cecc5733d, HEAD/origin/main/main remota iguais
após push. Registro posterior à publicação.
Após publicar, 7.18 — criar somente UsuarioController::show para
obter o usuário da requisição e devolver UsuarioResource, com diagnóstico em
memória; registrar a rota protegida em etapa posterior.
