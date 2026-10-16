# Aula 5.29 — Filtro de produtos ativos

## Objetivo

Selecionar para o catálogo somente produtos com status ativo.
A 5.28 foi confirmada com "entendi" em 16/10/2026 e publicada em 1cd8038,
SHA completo 1cd8038f21b6f40bfea94d1c5cb1f6f41c4a537d, conferido na main remota.

## Alteração em backend/app/Services/CatalogoEloquent.php

O método listarNomes passou a ser:

```php
public function listarNomes(): array
{
    return Produto::query()
        ->where('status', 'ativo')
        ->pluck('nome')
        ->all();
}
```

Os imports, a interface e o retorno array permanecem. A quebra de linha
apresenta cada parte do encadeamento separadamente, dentro da mesma instrução
return, encerrada pelo ponto e vírgula.

query prepara a consulta ligada ao model. where acrescenta a condição de
busca, antes de executá-la. Com dois argumentos, where('status', 'ativo')
usa igualdade: equivale a where('status', '=', 'ativo'). O primeiro argumento
é a coluna, o segundo é o valor procurado.

pluck('nome') executa a consulta já filtrada e entrega os nomes em uma
coleção; all devolve o array. A seleção dos registros acontece no SQL Server,
antes de os nomes chegarem ao PHP. Não carregamos todos os nomes para
depois filtrá-los com foreach na view.

Um produto cujo status seja inativo fica fora dessa seleção. O filtro apenas
seleciona o que ler: não muda o status dos registros. Ele está neste serviço,
sem alterar globalmente o model Produto. O comando didático
loja:consultar-produtos continua com sua consulta geral de produtos.

## SQL e parâmetros

Na leitura real, capturamos uma única consulta:

```sql
select [nome] from [produtos] where [status] = ?
```

O parâmetro enviado separadamente foi ativo. Os colchetes delimitam os nomes
das colunas e tabela; ? é o marcador que recebe o valor por binding.
O Eloquent prepara a condição sem concatenar o valor ao texto SQL.
O resultado continua ['Camiseta'], pois a Camiseta já tem status ativo.

Se a seleção não encontrar produtos ativos, listarNomes entregará [] e a
view seguirá seu @else com Nenhum produto disponível. Não alteramos a view
ou o controller nesta etapa.

## Verificações e alcance

Na raiz:

```bash
docker compose exec -T backend php -l /app/app/Services/CatalogoEloquent.php
```

exec usa o container backend existente; -T dispensa terminal interativo;
php -l confere sintaxe sem executar o arquivo. Sintaxe passou, código 0.

Diagnóstico temporário em PHP Docker inicializou Laravel e resolveu Catalogo
como CatalogoEloquent. Conferiu banco loja/login loja_app, array ['Camiseta']
e QueryExecuted com o SQL acima e bindings ['ativo']. Apenas uma consulta
na chamada de listarNomes.

O mesmo diagnóstico fez uma requisição HTTP real ao servidor ativo em
http://127.0.0.1:8000/loja. Conferiu status 200, um li Camiseta, title Loja
Fullstack, h2 Catálogo de produtos e X-Curso Laravel. Código 0.

A conferência cobriu o produto ativo existente e a condição no SQL. Não
cadastramos produto inativo ou alteramos a Camiseta para provar exclusão.
Também não exercitamos a ausência de ativos. Esses cenários terão dados e
banco exclusivos quando introduzirmos testes SQL de integração.

git diff --check passou. Única mudança de código no serviço; model,
interface, binding, controller, view, rotas, seeders, migrations,
configuração/credenciais, dependências e serviços preservados. Sem gravações.

## Continuidade

Filtro implementado e explicado; sintaxe, consulta e HTTP conferidos.
Entendimento da 5.29 confirmado com "entendi" em 16/10/2026. Checkpoint
preparado para publicação autorizada; último publicado 1cd8038.

Próximo passo exato: publicar 5.29 e iniciar 5.30,
acrescentar orderBy('nome') à consulta de CatalogoEloquent, explicar ordem
crescente e SQL ORDER BY, verificando consulta e HTTP com os dados existentes.

Fonte consultada em 16/10/2026:

- [Condições where no Laravel 13](https://laravel.com/docs/13.x/queries#where-clauses).
