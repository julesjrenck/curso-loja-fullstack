# Aula 5.69 — Produto pertence a Categoria no Eloquent

## Objetivo e estado

Descrever no model como um produto se relaciona com sua categoria. Implementação,
explicação e verificações em 20/10/2026; entendimento confirmado com "entendi" na mesma data.

A 5.68 foi confirmada com "entendi" e publicada em
55f7ea8a8f137dc60d9da6c6109799855f1b11b1. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Alteração em Produto.php

Único arquivo de código alterado: backend/app/Models/Produto.php. Acrescentado:

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;
```

O atributo existente passou a permitir também categoria_id:

```php
#[Fillable(['nome', 'preco_em_centavos', 'status', 'categoria_id'])]
```

Isso permite atribuir o ID da categoria por array, como em create. Não verifica
existência de categoria ao preencher um objeto em memória; a FK verifica o valor
quando o banco recebe a gravação. HasFactory e cast de preço preservados.

Adicionado método público:

```php
public function categoria(): BelongsTo
{
    return $this->belongsTo(Categoria::class);
}
```

Public permite chamar o método externamente. BelongsTo é o tipo de objeto retornado:
o relacionamento do Eloquent, traduzindo "pertence a". $this é o produto atual;
belongsTo é um método herdado. Categoria::class fornece App\Models\Categoria,
que está no mesmo namespace, dispensando outro import.

A implementação instalada de HasRelationships::belongsTo foi consultada.
Pelo nome do método categoria(), a convenção monta categoria_id como coluna
de referência; o model Categoria fornece sua chave id. Assim Eloquent relaciona
produtos.categoria_id a categorias.id. A FK no banco garante integridade; esse
método orienta a navegação/consulta pelo Eloquent.

Chamar categoria() prepara o objeto de relacionamento; não significa que já
buscamos uma categoria no banco. A leitura da categoria pela propriedade será
demonstrada no próximo teste. Relação inversa não foi adicionada nesta etapa.

## Verificações

```bash
docker compose exec -T backend php -l app/Models/Produto.php
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-569-configurar-belongs-to.php
```

Exec usa o backend iniciado; -T dispensa terminal interativo. Php -l confere
sintaxe, que passou. No segundo comando, o shell do host envia o script temporário
pela entrada padrão, PHP lê /dev/stdin e Laravel seleciona testing.

Após inicializar Laravel, o script montou Produto em memória com nome Camiseta,
preço 4990, status ativo e categoria_id 10 ilustrativo; depois chamou
$relacao = $produto->categoria(). Conferiu preenchimento do ID, retorno BelongsTo,
model relacionado Categoria e chaves produtos.categoria_id/categorias.id.
Produto não salvo, ID próprio null e exists false; zero SQL observado pelo
listener. Não foi consultada ou cadastrada uma categoria de ID 10. Código 0.

Como os testes existentes usam Produto, executamos a suíte após alterar o model:

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

PHP executa o PHPUnit instalado; --testdox apresenta cenários, --colors=never
remove cores e --do-not-cache-result evita cache no código somente para leitura.
Resultado: OK (6 tests, 14 assertions), código 0. Esses testes verificam catálogo,
ainda não a leitura da categoria pela relação.

Consultas em processos separados pelo diagnóstico /tmp/curso-569-resumo-bancos.php
confirmaram teste 0 categorias/0 produtos/3 migrations e normal 0 categorias/1
produto/3 migrations. Git diff --check passou; segredos locais ignorados/fora do índice.

## Continuidade

Entendimento da 5.69 confirmado. Publicar o checkpoint
e iniciar 5.70: criar somente primeiro teste de integração ProdutoCategoriaTest,
cadastrar categoria/produto e verificar $produto->categoria com identidade de
testes conferida e rollback. Não adicionar relação inversa ou outros cenários ainda.
