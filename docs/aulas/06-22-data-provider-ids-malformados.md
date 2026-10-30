# Aula 6.22 — Data provider para IDs malformados na consulta individual

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.21 em a79fc87b9d257899467c7fe161c5ab7819986fbe. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.22 confirmado
pelo aluno com "entendi" em 30/10/2026. Somente backend/tests/Feature/CatalogoApiTest.php alterado
no código: o teste existente passa a executar cinco conjuntos de valores.

## Código

Import acrescentado no início do arquivo:

```php
use PHPUnit\Framework\Attributes\DataProvider;
```

Teste adaptado e provider na mesma classe:

```php
#[DataProvider('idsMalformados')]
public function test_retorna_404_em_json_para_id_malformado(string $id): void
{
    $resposta = $this->getJson('/api/v1/produtos/'.$id);

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonStructure(['message']);
}

public static function idsMalformados(): array
{
    return [
        'letras' => ['abc'],
        'zero' => ['0'],
        'negativo' => ['-1'],
        'decimal' => ['1.5'],
        'zero inicial' => ['01'],
    ];
}
```

## Explicação

O use importa o nome do atributo. #[DataProvider('idsMalformados')] é um
metadado associado ao método de teste; o PHPUnit o lê e busca os argumentos no
método indicado. String $id recebe um valor por execução e o ponto concatena
esse valor ao caminho. Test_ permite descobrir o teste; void indica ausência
de retorno.

O array externo contém os conjuntos. Cada chave, como 'decimal', é um nome
exibido no relatório; o array interno ['1.5'] contém os argumentos daquela
execução. Como o teste tem um parâmetro, cada conjunto fornece um argumento.
O PHPUnit chama o teste com abc, depois 0, -1, 1.5 e 01, como strings. A ordem
não é uma dependência entre testes: cada execução tem preparação própria.
Manter '01' entre aspas preserva o zero inicial no caminho.

Public permite acesso pelo PHPUnit; static permite chamar o provider pela
classe, sem $this; : array declara seu retorno. O provider não começa com test_
e não é contado como teste. Os providers são avaliados antes de setUp, por isso
esse método fornece somente dados simples, sem usar a aplicação ou o banco.
Cada execução do teste continua usando o setUp e DatabaseTransactions existentes,
com identidade loja_test/loja_testes conferida e rollback ao final.

Essas regras de atributo, assinatura do provider, argumentos e nomes dos
conjuntos seguem o [manual oficial do PHPUnit 12.5](https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html#data-providers).

Todos os valores são rejeitados pelo padrão existente [1-9][0-9]* da rota:
abc tem letras; 0 e 01 começam com zero; -1 tem sinal negativo; 1.5 tem ponto.
getJson executa o kernel HTTP interno, sem socket. Cada resposta precisa ter
404, Content-Type application/json e chave message no JSON. O texto continua
livre porque o tratamento do erro é do roteamento Laravel. Os testes verificam
a resposta pública, sem instrumentar chamadas a show ou contar SQL.

Os outros oito métodos de teste e o código da aplicação foram preservados.
O arquivo ganhou um import, um atributo, um parâmetro e um provider; não houve
instalação de pacote ou alteração de configuração.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

php -l verifica sintaxe. --filter seleciona a classe da API; sem filtro executamos
a suíte completa. --do-not-cache-result evita gravar cache de resultados no código
montado somente para leitura.

- Sintaxe válida.
- Classe da API: 13 testes/79 asserções passaram, com os cinco nomes dos conjuntos
  aparecendo separadamente no relatório.
- Suíte completa: 27 testes/133 asserções passaram.
- SELECTs separados antes/depois pelo script temporário /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.

A classe passou de 9 para 13 execuções porque o caso único de abc virou cinco,
somando quatro execuções e 24 asserções. Continuam nove métodos de teste; o
provider não é um deles. Há quatro cenários de listagem e nove execuções
individuais, somando 13. Sem novo HTTP por socket. Formatos como 1e3 e +1 seguem
somente no diagnóstico histórico da 6.16.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
6f49a067ba84f64ede316593b5f40c8164fd461c, `test: parametriza IDs malformados da API`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem incluir o SHA no próprio commit.
Continuidade realizada na 6.23: desenhar o contrato de paginação da listagem
GET /api/v1/produtos, antes de implementar. Módulo 6 continua.
