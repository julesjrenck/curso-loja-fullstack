# Aula 5.23 — Leitura dos atributos do Produto

## Objetivo

Mostrar os dados do produto carregado pelo Eloquent no comando existente.
A 5.22 foi confirmada com "entendi" em 15/10/2026 e publicada em 9d03edc,
SHA completo 9d03edc59b912352e2b6fe707637716694689503, conferido na main remota.
Resultado do exercício DBeaver pelo aluno continua não informado.

## Alteração em backend/routes/console.php

Depois do if de coleção vazia, acrescentamos:

```php
foreach ($produtos as $produto) {
    $this->line(
        $produto->id.' | '.$produto->nome.' | '.$produto->preco_em_centavos.' centavos | '.$produto->status
    );
}
```

A consulta Produto::query()->get(), a quantidade e a mensagem de ausência de
cadastros permanecem. O import de App\Models\Produto já existia.

$produtos é a coleção Eloquent carregada por get. A coleção pode ser percorrida
com foreach, como um array. Em cada passagem, $produto recebe um dos models
App\Models\Produto da coleção. O plural e o singular são nomes escolhidos
para facilitar a leitura; não são palavras especiais do PHP.

Cada model contém os atributos de um registro da tabela produtos. O operador
-> acessa id, nome, preco_em_centavos e status no objeto. Não usamos
$produto['nome'] nem precisamos de um getter específico nesta demonstração:
o Eloquent oferece acesso aos atributos pelo model. O cast configurado na
5.18 continua entregando o preço como inteiro.

O ponto concatena os valores e os textos separadores ' | '. O sufixo
' centavos' explicita a unidade; 4990 corresponde a R$ 49,90. Não fizemos
formatação monetária ou conversão do valor para número decimal.
$this continua sendo o comando Artisan; line imprime a string com quebra
de linha no terminal. O laço imprime uma linha por Produto.

Se a coleção estiver vazia, o foreach não entra no corpo. O if anterior
continua responsável pela mensagem Nenhum produto cadastrado. Esse caminho
foi revisado pelo código; não esvaziamos a tabela para reproduzi-lo.

A leitura desses atributos já carregados percorre a coleção em memória,
sem uma nova consulta por atributo. Não estamos acessando relacionamentos.
A consulta SQL continua sendo executada por get, antes do laço.

## Comandos e resultado

Na raiz do projeto:

```bash
docker compose exec -T backend php -l /app/routes/console.php
docker compose exec -T backend php artisan loja:consultar-produtos --no-ansi
```

exec usa o container backend existente; -T dispensa terminal interativo.
php -l verifica a sintaxe sem executar o arquivo. O segundo comando carrega
Laravel e executa nossa consulta, com --no-ansi dispensando cores.

Sintaxe válida e execução com código de saída 0:

```text
Produtos encontrados: 1
1 | Camiseta | 4990 centavos | ativo
```

A quantidade é da coleção; a linha seguinte mostra os atributos de seu único
model. Nenhum valor da Camiseta foi escrito diretamente no comando: veio
do registro cadastrado na 5.22. Não executamos o seeder novamente.

git diff --check passou. Mudança de código somente em routes/console.php;
model, seeders, migrations, configuração/credenciais, dependências e serviços
preservados. Sem INSERT/UPDATE/DELETE ou mudança do catálogo HTTP nesta etapa.

## Continuidade

Implementação, explicação e verificação concluídas. Entendimento da 5.23
confirmado com "entendi" em 15/10/2026. Checkpoint preparado para publicação
autorizada; último publicado 9d03edc.

Próximo passo exato: publicar 5.23 e iniciar 5.24, preparar
ProdutoSeeder para reexecução com firstOrCreate, explicando o critério de
busca didático e os limites sem restrição única, sem executar o seeder ainda.

Fonte consultada em 15/10/2026:

- [Coleções Eloquent no Laravel 13](https://laravel.com/docs/13.x/eloquent#collections).
