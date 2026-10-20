# Aula 5.46 — Atributos padrão da factory de Produto

## Objetivo e estado

Preencher definition e conferir os atributos como arrays em memória.
Implementação, explicação e verificações em 19/10/2026; entendimento confirmado
com "entendi" após esclarecer os métodos. Nenhuma instância de Produto montada ou persistida.

A 5.45 foi confirmada com "entendi" e publicada em 3e094e5. HEAD, origin/main
e consulta direta à main remota retornaram
3e094e543b34f991c84bb05ac174e680f75471fe após o push.

## Código alterado

Somente o array retornado por definition em
backend/database/factories/ProdutoFactory.php foi preenchido:

```php
public function definition(): array
{
    return [
        'nome' => fake()->words(3, true),
        'preco_em_centavos' => fake()->numberBetween(100, 50000),
        'status' => 'ativo',
    ];
}
```

As chaves correspondem aos atributos já estudados no model Produto e às
colunas da tabela produtos. A definição fornece valores padrão para preparar
dados fictícios, sem acrescentar regras de validação ao model ou ao banco.

## fake e Faker

fake() é um helper Laravel que fornece um gerador da biblioteca Faker,
dependência de desenvolvimento já instalada. O código do helper e dos dois
métodos usados foi conferido na versão local em Docker; nenhuma instalação.

words(3, true) solicita três palavras fictícias. O segundo argumento true
faz o resultado ser um texto com palavras separadas por espaços. Com o
padrão false, o método retornaria um array de palavras. Para nome queremos
uma string, como a coluna e o atributo esperam.

numberBetween(100, 50000) retorna um inteiro nesse intervalo, incluindo os
limites. Como o campo representa centavos, os padrões vão de R$ 1,00 a
R$ 500,00. Isso escolhe exemplos para a factory; não proíbe outros preços
válidos nas regras da loja.

status permanece a string fixa ativo. Em cada chamada de definition os
valores gerados podem variar; os atributos não representam registros salvos.

## Conferência em memória

Um diagnóstico temporário em PHP Docker inicializou Laravel e chamou:

```php
$factory = new Database\Factories\ProdutoFactory;
$attributes = $factory->definition();
```

O objeto criado acima é a factory. O retorno é somente um array de atributos,
sem instanciar o model Produto. definition foi chamado dez vezes, conferindo:

- Exatamente as chaves nome, preco_em_centavos e status.
- Nome string de três palavras e comprimento até 150 caracteres.
- Preço inteiro entre 100 e 50000.
- Status exatamente ativo.

Exemplo fictício observado:

```php
[
    'nome' => 'impedit reprehenderit qui',
    'preco_em_centavos' => 20025,
    'status' => 'ativo',
]
```

Esse é apenas um exemplo; não esperamos repetir exatamente o texto ou preço
nas próximas execuções. Cenários de teste poderão informar os campos que
precisam controlar, em etapa posterior.

php -l passou. O diagnóstico terminou com código 0 e um listener DB observou
zero consultas SQL durante a geração dos atributos. Nenhuma chamada make/create,
instância de Produto, migration ou seeder. git diff --check passou; arquivos
privados seguem ignorados/fora do índice.

Model, testes, serviços e configurações preservados. A suíte não foi repetida
porque os testes ainda não usam essa factory. Última execução na 5.44:
6 testes/14 asserções, passou.

## Continuidade

Esclarecimento de 19/10/2026: o aluno perguntou se cada chamada da factory
gera um registro. Instanciar a factory prepara a receita; definition retorna
um array, make monta um model em memória e create persiste o model no banco.
O código instalado de make/create/store foi consultado apenas por leitura.
Na conferência desta aula foram dez chamadas a definition, portanto dez arrays
e nenhum registro. A comparação entre métodos responde à dúvida; make/create
continuaram sem execução naquela etapa. Aluno confirmou entendimento da 5.46
com "entendi" em 19/10/2026 após o esclarecimento.

Entendimento confirmado; publicar o checkpoint
e iniciar 5.47: montar um Produto com ProdutoFactory::new()->make() e conferir
atributos/estado em memória, sem persistir registros ou refatorar testes.
