# Aula 5.72 — Categoria hasMany Produto

## Objetivo e estado

Definir a relação que parte de uma categoria para seus vários produtos.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" em 20/10/2026. Checkpoint concluído para publicação.

5.71 confirmada com "entendi" e publicada em
e41a1d46b5eafff2c4fed34b6389959d3d9b5953. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Arquivo alterado

Somente backend/app/Models/Categoria.php alterado no código:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nome'])]
class Categoria extends Model
{
    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }
}
```

Namespace, Fillable de nome e herança de Model já existiam. O import novo permite
usar o nome curto HasMany como tipo de retorno do método público produtos.

$this representa a categoria atual. HasMany significa que uma categoria pode
ter vários produtos. O método herdado hasMany recebe Produto::class, o nome
completo do model relacionado. Produto está no mesmo namespace App\Models,
portanto não precisa de import adicional.

Categoria usa id como chave primária. Pela convenção baseada no model Categoria,
Eloquent procura categoria_id no model relacionado Produto. Essa coluna e sua
chave estrangeira já foram criadas pelas migrations anteriores. O método não
cria tabelas, colunas, categorias ou produtos; configura o relacionamento.

Exemplo conceitual: uma categoria Roupas poderia ter Camiseta e Calça.
Produto::categoria() descreve a direção produto para categoria, com BelongsTo.
Categoria::produtos() descreve a direção categoria para produtos, com HasMany.
As duas direções utilizam a mesma coluna produtos.categoria_id.

produtos() devolve o objeto HasMany. A propriedade $categoria->produtos poderá
carregar uma coleção de models Produto. Nesta etapa não executamos essa leitura
com cadastros; o teste será a próxima etapa, após confirmação.

## Verificações

```bash
docker compose exec -T backend php -l app/Models/Categoria.php
```

Exec usa o container backend iniciado; -T dispensa terminal interativo. PHP -l
verifica sintaxe sem executar o model. Resultado: sem erros, código 0.

Diagnóstico temporário /tmp/curso-572-has-many.php executado pelo PHP Docker:

```bash
docker compose exec -T backend php -- --env=testing < /tmp/curso-572-has-many.php
```

O redirecionamento entrega o script local à entrada do PHP no container. O script
carrega a aplicação instalada e monta Categoria em memória, com nome Roupas e
ID 10 ilustrativo. Não supõe que exista registro com esse ID no banco.

Confere HasMany, model Produto, FK produtos.categoria_id, chave local id e
parentKey 10. Categoria continua exists false; listener confirma zero SQL.
Resultado: HasMany -> Produto, chaves esperadas e SQL executado 0; código 0.
Esse script foi um diagnóstico, não um teste permanente adicionado ao projeto.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

Executa a suíte existente pelo PHP do backend. Testdox mostra nomes dos cenários,
colors=never remove cores e do-not-cache-result evita gravar cache no código
montado somente para leitura. Resultado: OK (8 tests, 23 assertions), código 0.
Esses testes ainda não verificam a leitura pela nova relação hasMany.

Contagens pelo diagnóstico da 5.69, em processos separados após a suíte:
loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e loja/loja_app
com 0/1/3. Git diff --check passou; arquivos privados de ambiente fora do índice.

## Continuidade

5.72 confirmada com "entendi". Publicar e iniciar somente 5.73: primeiro CategoriaProdutosTest com DatabaseTransactions
e setUp conferindo loja_test/loja_testes. Um cenário com duas categorias, dois
produtos da primeira e um da segunda, recarregando a primeira categoria para
conferir que $categoria->produtos contém somente seus dois produtos.
