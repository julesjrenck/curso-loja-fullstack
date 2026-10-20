# Aula 5.45 — Estrutura da factory de Produto

## Objetivo e estado

Introduzir factories e gerar somente a estrutura de ProdutoFactory.
Implementação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" nessa data. A definição permanece vazia; nenhum dado criado.

A 5.44 foi confirmada com "entendi" e publicada em 5810b26. HEAD, origin/main
e consulta direta à main remota retornaram
5810b264a84a4d9f641c9eb8e98e8e166068d198 após o push.

## Papel da factory

Os testes atuais repetem arrays de nome/preço/status em Produto::create.
Uma factory organiza valores padrão para montar instâncias de um model.
Os cenários poderão depois especificar os campos relevantes ao comportamento
verificado, mantendo os demais padrões na factory.

| Recurso | Papel no projeto |
| --- | --- |
| Migration | Descrever e aplicar a estrutura das tabelas |
| Seeder | Executar uma preparação de registros no banco |
| Factory | Definir atributos padrão para montar models |

Uma factory também pode ser usada por seeders. Gerar o arquivo de factory
não executa cadastro e não preenche a tabela automaticamente.

## Comando executado

Na raiz do repositório:

```bash
docker compose run --rm --no-deps -T --user 1000:1000 \
  --volume "$PWD/backend/database/factories:/app/database/factories:rw" \
  --entrypoint php backend artisan make:factory ProdutoFactory \
  --model=Produto --no-interaction --no-ansi
```

run cria um container temporário com o serviço backend existente. --rm o
remove ao terminar; --no-deps evita iniciar outros serviços; -T dispensa
terminal interativo. --user mantém os arquivos com o usuário local.
--volume libera escrita somente em database/factories, pois o restante do
código está montado como somente leitura. Compose não foi alterado.

--entrypoint php inicia PHP com os argumentos artisan make:factory.
ProdutoFactory é o nome da classe a gerar; --model=Produto informa o model ao
gerador. --no-interaction evita perguntas e --no-ansi remove códigos de cor.
O comando terminou com código 0 e o container temporário foi removido.

## Arquivo gerado

backend/database/factories/ProdutoFactory.php:

```php
<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
```

Database\Factories corresponde ao mapeamento para database/factories já
existente no composer.json. Os imports permitem usar Produto e Factory pelos
nomes curtos. extends Factory herda os recursos de factories do Laravel.

@extends Factory<Produto> documenta para editor/ferramentas o model produzido;
é um comentário, não uma instrução PHP que instancia Produto. Neste caso a
associação em execução é resolvida pela convenção ProdutoFactory/Produto,
e foi conferida com modelName().

definition(): array será o método que fornece os atributos padrão. O comentário
@return array<string, mixed> descreve chaves de texto e valores de tipos variados.
O // é apenas um espaço reservado: atualmente o retorno é um array vazio.
Nenhum campo foi definido e nenhum método de criação de model foi chamado.

O model Produto, UserFactory e os testes permaneceram como estavam. O próximo
passo será preencher a definição antes de utilizar esta factory.

## Verificações realizadas

PHP 8.4.26/Composer 2.10.3, ajuda make:factory, stub do gerador e resolução de
modelName conferidos no Laravel instalado. Arquivo gerado com dono 1000:1000
e permissão 644.

php -l passou. Diagnóstico temporário no backend confirmou autoload da classe,
herança de Factory, definition() === [] e modelName() === App\Models\Produto.
Um listener DB durante a inspeção observou zero consultas SQL. Nenhuma chamada
make/create da factory, migration ou seeder foi executada.

git diff --check passou; segredos continuam ignorados/fora do índice. Nenhuma
dependência ou configuração alterada. A suíte não foi repetida para a classe
gerada ainda sem uso. Última suíte da 5.44: 6 testes/14 asserções, passou.

## Continuidade

Entendimento da 5.45 confirmado com "entendi" em 19/10/2026. Publicar o checkpoint
e iniciar 5.46: preencher nome, preco_em_centavos e status em definition e
conferir os atributos em memória, sem persistir models ou refatorar testes.
