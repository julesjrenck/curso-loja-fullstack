# Aula 6.44 — Testes permanentes de nomes literais

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.43
com "entendi" e publicação em d56c1857a0ad9845194f998ec4daa691a7c07511.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.44
confirmado com "entendi" em 01/11/2026; publicação verificada em
2adfac2afde138762e3549503e376968705b53b0, com referências local e remotas coincidentes.

Conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: método HTTP,
atributo DataProvider e provider de sete entradas. A busca já existia; agora
estes casos recebem cobertura permanente.

## Mesmo teste, sete entradas

```php
#[DataProvider('nomesLiterais')]
public function test_busca_nome_literal_e_preserva_texto_nos_links(string $nome): void
```

O atributo manda executar o método uma vez para cada linha do provider.
Cada lista interna fornece o argumento string $nome daquela execução:

```php
public static function nomesLiterais(): array
{
    return [
        'porcentagem' => ['%'],
        'sublinhado' => ['_'],
        'colchete' => ['['],
        'apóstrofo' => ["'"],
        'mais' => ['+'],
        'e comercial' => ['&'],
        'zero como texto' => ['0'],
    ];
}
```

As chaves externas nomeiam os casos no relatório. O provider é público,
estático e apenas fornece dados; as factories ficam no método de teste.
O apóstrofo está entre aspas duplas para representar o caractere em PHP.
'0' está entre aspas para deixar explícito que é texto.

## Produtos de cada execução

O teste cria três produtos:

- Um ativo com nome 'Produto '.$nome.' especial', preço 4990 centavos e ID
  guardado no model $correspondente.
- Um ativo chamado Produto comum, preço 2990, que não contém a entrada.
- Um inativo com nome 'Produto '.$nome.' inativo', preço 1990, que contém a
  entrada, mas deve ficar fora da listagem.

Por exemplo, para %, somente Produto % especial deve aparecer. Produto comum
evita que uma busca indevidamente ampla passe; o correspondente inativo
confere que o filtro de status continua sendo aplicado. A expectativa de data
contém exatamente um objeto com ID gerado, nome literal e preço inteiro.

## Codificar a URL

```php
$resposta = $this->getJson('/api/v1/produtos?'.http_build_query(['nome' => $nome]));
$url = url('/api/v1/produtos').'?'.http_build_query([
    'nome' => $nome,
    'page' => 1,
]);
```

http_build_query recebe os pares de parâmetros e codifica seus valores.
Um + literal vira %2B; um & literal vira %26. Isso evita interpretar o + como
espaço ou o & como separação entre parâmetros. O % literal vira %25.
Depois da decodificação, o Form Request recebe o texto original.

getJson faz o GET pelo fluxo da aplicação de teste pedindo JSON. A variável
$url constrói first/last esperados com nome e page=1. Comparar os links exige
que a API preserve o texto na navegação. Prev e next devem ser null, pois há
apenas um resultado.

## Asserções e relação com a aplicação

Cada resposta exige 200, Content-Type application/json, data com o único
produto ativo correspondente e links completos. Os metadados exigem
current_page 1, per_page 10, total 1, last_page 1 e from/to 1.

Percentual, sublinhado e colchete devem ser procurados como caracteres do
nome. O apóstrofo também é parte do texto. CatalogoEloquent já usa
CHARINDEX(?, [nome]) > 0 com binding; este teste verifica a resposta pelo HTTP,
sem medir SQL ou afirmar cobertura geral de segurança.

Em PHP, a string '0' é falsa em uma condição simples. Por isso, a consulta
existente verifica $nome !== null: null significa ausência do filtro e '0'
continua sendo uma busca válida. O produto comum permite detectar uma perda
indevida desse filtro. Nenhum código de produção foi alterado.

## Verificações e isolamento

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica a sintaxe. --filter seleciona a classe; a última execução
inclui a suíte inteira. --do-not-cache-result evita escrita de cache na
montagem de código. Resultado: sintaxe válida, classe com 44 testes/436
asserções e suíte com 58 testes/490 asserções. São sete casos e 91 asserções
a mais que na 6.43.

SetUp confere loja_test/loja_testes e limpa produtos dentro da transação;
DatabaseTransactions desfaz as alterações de cada execução. Não presumimos
reinício dos IDs. SELECTs antes/depois por /tmp/curso-618-contagens.php
confirmaram teste com 0 categorias/0 produtos e normal com 0 categorias/1
produto. Git diff --check e links locais da documentação conferidos.
Não acrescentamos medições SQL ou asserções de meta.links.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação verificada em
2adfac2afde138762e3549503e376968705b53b0, com referências local e remotas coincidentes.
Continuidade na [aula 06-45](06-45-teste-busca-sem-correspondencia.md).
