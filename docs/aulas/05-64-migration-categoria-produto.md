# Aula 5.64 — Migration de categoria_id preparada

## Objetivo e estado

Adicionar uma referência opcional de produto para categoria e garantir que os
IDs preenchidos apontem para categorias existentes. Implementação, explicação e
verificação em 20/10/2026; entendimento confirmado com "entendi" na mesma data.
A migration foi preparada, ainda não aplicada.

A 5.63 foi confirmada com "entendi" e publicada em
ce678868ac122c51816f47c63de1ae58d8ea582c. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Geração

```bash
docker compose run --rm --no-deps -T --user 1000:1000 \
  --volume "$PWD/backend/database/migrations:/app/database/migrations:rw" \
  --entrypoint php backend artisan make:migration add_categoria_id_to_produtos_table \
  --table=produtos --no-interaction --no-ansi
```

Run cria container temporário; --rm o remove ao terminar e --no-deps evita
iniciar dependências. -T dispensa terminal interativo; --user mantém dono local.
--volume permite escrita somente em migrations. --entrypoint php recebe artisan
e seus argumentos. Make:migration gera o arquivo; --table=produtos prepara
Schema::table para alterar uma tabela existente. --no-interaction dispensa
perguntas e --no-ansi remove códigos de cor. Código 0, dono 1000:1000/modo 644.

Arquivo criado:
backend/database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php.
Preservamos a migration que criou produtos, pois já foi aplicada nos bancos;
a mudança futura fica descrita em um novo arquivo no histórico.

## Código preparado

```php
public function up(): void
{
    Schema::table('produtos', function (Blueprint $table) {
        $table->foreignId('categoria_id')
            ->nullable()
            ->constrained('categorias')
            ->noActionOnDelete();
    });
}

public function down(): void
{
    Schema::table('produtos', function (Blueprint $table) {
        $table->dropConstrainedForeignId('categoria_id');
    });
}
```

O arquivo mantém os imports Migration/Blueprint/Schema e a classe anônima
gerados pelo Artisan, como nas migrations anteriores. Schema::table altera a
tabela existente; não a recria.

- foreignId define a coluna de referência, com tipo compatível com o id de
  categorias. No SQL Server, a intenção é BIGINT, sem geração de identidade
  própria: esse valor será o ID da categoria escolhida para o produto.
- nullable permite NULL, significando produto sem categoria. A Camiseta já
  existente poderá continuar assim; não inventamos uma categoria para ela.
  NULL é diferente de 0: preencher 0 exigiria uma categoria de ID 0.
- constrained('categorias') acrescenta a chave estrangeira para categorias.id.
  Quando categoria_id tiver valor, ele deverá corresponder a categoria existente.
  Nullable vem antes de constrained porque configura a coluna, enquanto
  constrained passa a configurar a restrição de chave estrangeira.
- noActionOnDelete especifica que não haverá ação automática nos produtos ao
  tentar excluir uma categoria. Se houver referência, a exclusão será rejeitada;
  não apagaremos produtos em cascata nem zeraremos a associação automaticamente.

Down remove a chave estrangeira e depois a coluna categoria_id. Não remove a
tabela produtos. Reverter futuramente descartaria os valores dessa associação;
não executamos up nem down nesta aula.

## Verificação e limites

Constrained, noActionOnDelete e dropConstrainedForeignId foram consultados no
Laravel instalado em Docker. O último remove a FK antes de remover a coluna.

```bash
docker compose exec -T backend php -l database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php
```

Exec usa o backend iniciado; php -l confere a sintaxe sem aplicar a migration.
Resultado: No syntax errors detected, código 0. Git diff --check passou.

Nenhum migrate, up/down, SELECT ou INSERT nesta etapa. Sintaxe válida não comprova
a aplicação da FK no SQL Server. Models, factories e seeders preservados;
relacionamentos Eloquent não surgem automaticamente com a coluna/FK.
Segredos locais continuam ignorados e fora do índice. Suíte não repetida para
arquivo ainda não aplicado; último 6 testes/14 asserções pertence à 5.53.

## Continuidade

Entendimento da 5.64 confirmado. Publicar o checkpoint
e iniciar 5.65: aplicar somente esta migration em loja_test, conferir coluna,
FK, nulabilidade e histórico e executar suíte existente. Não aplicar em loja
nessa mesma etapa.
