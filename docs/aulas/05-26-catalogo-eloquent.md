# Aula 5.26 — Catálogo com leitura Eloquent

## Objetivo

Criar uma implementação de Catalogo que lê os nomes persistidos em produtos.
A 5.25 foi confirmada com "entendi" em 15/10/2026 e publicada em 8ec24b4,
SHA completo 8ec24b482bd3febe764679f76f5519e740e631af, conferido na main remota.

## Arquivo criado

backend/app/Services/CatalogoEloquent.php:

```php
<?php

namespace App\Services;

use App\Contracts\Catalogo;
use App\Models\Produto;

class CatalogoEloquent implements Catalogo
{
    public function listarNomes(): array
    {
        return Produto::query()->pluck('nome')->all();
    }
}
```

O namespace App\Services acompanha a pasta app/Services pelo autoload PSR-4
existente. O primeiro import identifica a interface Catalogo; o segundo
identifica o model Eloquent Produto. Nenhuma dependência nova ou ajuste de
autoload foi necessário.

implements Catalogo obriga a classe a cumprir o método público listarNomes
com retorno array, já definido em backend/app/Contracts/Catalogo.php.
CatalogoDemonstracao também cumpre essa interface. As duas implementações
entregam o mesmo formato de saída, obtendo os nomes de fontes diferentes.

## A leitura e o retorno

```php
return Produto::query()->pluck('nome')->all();
```

Produto::query() prepara a consulta ligada ao model, à tabela produtos e à
conexão padrão sqlsrv/loja_app. pluck('nome') executa a consulta e reúne apenas
os valores dessa coluna em uma coleção Illuminate\Support\Collection.
Aqui precisamos de nomes, não de models completos com todos os atributos.

all() é chamado nessa coleção e devolve o array interno de valores. Assim,
listarNomes satisfaz seu retorno array, que o controller e a view já esperam.
Esse all não é Produto::all(): é um método da coleção que pluck retornou.
Não dispara uma segunda consulta. return entrega o array ao chamador.

No estado atual do banco, a chamada retorna:

```php
['Camiseta']
```

É um array de strings, não uma coleção de models Produto. A Camiseta não
está escrita no código do serviço: veio da linha cadastrada em produtos.
Se não houver registros, o resultado será um array vazio. Esse caso foi
explicado pelo comportamento dos métodos, sem apagar dados para demonstrar.

## Verificações

Na raiz:

```bash
docker compose exec -T backend php -l /app/app/Services/CatalogoEloquent.php
```

exec usa o backend existente, -T dispensa terminal interativo e php -l
verifica a sintaxe sem executar o arquivo. Sintaxe passou com código 0.

Diagnóstico temporário em PHP Docker inicializou Laravel, instanciou
CatalogoEloquent e chamou listarNomes. Conferiu autoload, instanceof Catalogo,
array exatamente ['Camiseta'], conexão sqlsrv, banco loja e login loja_app.
QueryExecuted capturou uma única consulta, sem parâmetros:

```sql
select [nome] from [produtos]
```

SQL pede somente a coluna nome. Sem filtros ou ordenação explícita nesta
etapa. Não fizemos gravação ou nova execução do seeder.

O diagnóstico também resolveu Catalogo pelo container e recebeu
App\Services\CatalogoDemonstracao, com ['Camiseta', 'Calça', 'Tênis'], sem
consulta adicional. O binding em AppServiceProvider permanece como estava.
Logo, a página /loja ainda recebe o catálogo demonstrativo; nesta etapa
verificamos a nova implementação por uma chamada direta.

Arquivo modo 644, dono 1000:1000; git diff --check passou. Único arquivo de
código novo: CatalogoEloquent. Interface, model, provider, controller, view,
rotas, seeders, migrations, configuração/credenciais e dependências preservados.

## Continuidade

Implementação, explicação e verificação concluídas. Entendimento da 5.26
confirmado com "entendi" em 16/10/2026. Checkpoint preparado para publicação
autorizada; último publicado 8ec24b4.

Próximo passo exato: publicar 5.26 e iniciar 5.27,
trocar o binding de Catalogo em AppServiceProvider para CatalogoEloquent,
explicar a resolução no controller e conferir HTTP /loja com a Camiseta
persistida. Não modificar o controller ou cadastrar novos produtos nessa etapa.

Fontes consultadas em 15/10/2026:

- [pluck para ler uma coluna](https://laravel.com/docs/13.x/queries#retrieving-a-list-of-column-values).
- [all para obter o array da coleção](https://laravel.com/docs/13.x/collections#method-all).
