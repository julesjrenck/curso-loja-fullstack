# Aula 7.87 — Primeira Policy de produto

Implementação, explicação e verificações em 05/11/2026, após a
[7.86](07-86-acesso-administrativo-no-navegador.md) confirmada com "entendi".
Checkpoint anterior publicado e conferido em
cee134c4923788c14d3f2b024ebc548bc04deba5; HEAD/origin/main/main remota iguais.
Entendimento da 7.87 confirmado com "entendi" em 05/11/2026; publicação
conferida em a24cdafcbeeecfa1f4d311f37958c6f7736da655, HEAD/origin/main/main
remota iguais. Registro posterior à publicação.

## Objetivo e arquivo

Organizar em uma Policy a permissão para atualizar um produto. O Gate
acessar-administracao continua respondendo sobre o acesso geral à área
administrativa. A nova classe agrupa uma regra associada ao recurso Produto.

Criado somente
[ProdutoPolicy.php](../../backend/app/Policies/ProdutoPolicy.php)
na aplicação:

```php
<?php

namespace App\Policies;

use App\Models\Produto;
use App\Models\User;

class ProdutoPolicy
{
    public function update(User $user, Produto $produto): bool
    {
        return $user->is_admin === true;
    }
}
```

`namespace App\Policies` identifica o local da classe. Os imports permitem
usar os tipos Produto e User. A classe é PHP comum; uma Policy não precisa
herdar uma classe base para funcionar.

`update` é o nome da ação consultada. `User $user` recebe quem pretende agir;
`Produto $produto` recebe sobre qual recurso se consulta a permissão.
`: bool` exige uma decisão booleana. O método decide permissão; não executa
o update no banco, não valida um formulário e não salva o produto.

`$user->is_admin === true` usa o cast boolean já existente em User. A regra
inicial permite administradores e recusa outros usuários. O parâmetro
produto compõe o contexto da ação; seus atributos ainda não condicionam a
decisão, que vale para todos os produtos. Não há regra de propriedade de
produto por cliente nesta loja.

## Descoberta e consulta da regra

Laravel encontra automaticamente App\Policies\ProdutoPolicy para
App\Models\Produto pela convenção de nomes e pastas. Não foi necessário
alterar AppServiceProvider ou adicionar um atributo ao model.

Na verificação, usamos a facade Gate para consultar essa Policy:

```php
Gate::forUser($usuario)->allows('update', $produto);
```

`forUser` seleciona a identidade da verificação; `allows` consulta a ação.
O model Produto informa qual Policy deve ser procurada; update identifica
o método. O resultado é true ou false. A consulta não autentica uma sessão
nem persiste os objetos. Com User obrigatório, o Gate recusa visitante antes
de chamar o método com um usuário ausente.

Referência: [autorização e Policies no Laravel 13](https://laravel.com/docs/13.x/authorization#creating-policies),
com [descoberta automática](https://laravel.com/docs/13.x/authorization#policy-discovery).
Também conferida a implementação de descoberta em Illuminate\Auth\Access\Gate
na versão instalada, sem percorrer outras dependências.

## Verificações

PHP 8.4.26 e Composer 2.10.3 conferidos no container, sem instalação.
Verificação de sintaxe:

```sh
docker compose exec -T backend php -l app/Policies/ProdutoPolicy.php
```

Resultado: sem erros, código 0. PHP -l não executa as decisões da Policy.

Diagnóstico PHP pela entrada padrão, dentro do container com APP_ENV=testing:
ambiente testing e banco configurado loja_test conferidos. Callback bloqueou
qualquer tentativa SQL; PDO permaneceu como Closure sem conexão aberta.
Descoberta automática de ProdutoPolicy e presença do Gate administrativo
conferidas. Dois produtos fictícios em memória, cada um com quatro identidades:
cliente (indicador bruto 0), administrador (1), usuário sem indicador e
visitante (null). Resultados false/true/false/false para ambos os produtos.
Os atributos e o estado limpo dos produtos permaneceram iguais.

Resultado: oito decisões via Gate e 22 verificações passaram, código 0;
zero tentativas SQL. Sem dados, login ou senhas reais, alteração de contas,
requisições HTTP ou atualização persistida de produto. Nenhum auxiliar salvo.
Rotas, controllers, models, Gate anterior, página, OpenAPI e migrations mantidos.
Última suíte completa segue 7.80, 116 testes/1.653 asserções; não repetida.

## Continuidade

Entendimento confirmado com "entendi" em 05/11/2026 sobre a Policy decidir a
permissão sem executar a atualização do produto. Continuidade iniciada na
[7.88](07-88-testes-policy-produto.md), registrando testes da descoberta e das decisões
de update da ProdutoPolicy com modelos em memória e SQL bloqueado.
Não foi criada rota de atualização nesta etapa. Policies ainda em estudo;
módulo 7 não concluído e módulos 8 a 23 não iniciados.
