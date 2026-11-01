# Aula 6.42 — Testes permanentes de nomes inválidos

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.41
com "entendi" e publicação em 2128dbb861375af85566e0a2b07adcaaa8018d3b.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.42
confirmado com "entendi" em 01/11/2026; publicação verificada em
8eab468af794a8d513e0cc9f1237b562a18f93a6, com referências local e remotas coincidentes.

Conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: teste HTTP
de nome inválido e provider com seis entradas. As regras já existiam no Form
Request; agora os casos deixam de depender somente do diagnóstico temporário.

## Método de teste

```php
#[DataProvider('nomesInvalidos')]
public function test_retorna_422_em_json_para_nome_invalido(string $query): void
{
    $resposta = $this->getJson('/api/v1/produtos?'.$query);

    $resposta
        ->assertStatus(422)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonStructure(['message'])
        ->assertJsonValidationErrors(['nome']);
}
```

O atributo seleciona o provider. Cada linha fornece a query de uma execução;
getJson envia GET pedindo JSON pelo fluxo da aplicação de teste.

AssertStatus exige 422. AssertHeader exige application/json. AssertJsonStructure
exige a chave message e assertJsonValidationErrors exige associação ao campo
nome dentro de errors. Não fixamos a tradução das mensagens nem exigimos que
nome seja o único campo com erro. Asserções seguem o padrão dos testes de page.

## Entradas do provider

```php
public static function nomesInvalidos(): array
{
    return [
        'vazio' => ['nome='],
        'somente espaços' => ['nome=%20%20%20'],
        'array simples' => ['nome[]=camiseta'],
        'array associativo' => ['nome[valor]=camiseta'],
        'acima do limite ASCII' => ['nome='.str_repeat('a', 101)],
        'acima do limite Unicode' => ['nome='.rawurlencode(str_repeat('á', 101))],
    ];
}
```

As chaves externas nomeiam os casos no relatório, e cada lista interna fornece
um argumento query. O provider é público/estático, sem acesso à aplicação ou banco.

Nome= está presente, mas vazio. No caso de espaços, %20 representa cada espaço
na URL; a normalização remove os espaços externos e a regra required rejeita
o valor vazio resultante. Omitir nome continua permitido e não é um caso inválido.

As duas sintaxes com colchetes produzem arrays, rejeitados pela regra string.
Str_repeat cria 101 letras sem contagem manual. Rawurlencode prepara o texto
acentuado para a URL; a validação recebe os 101 caracteres após a decodificação.
Os dois textos excedem o máximo de 100 definido no contrato.

## Banco e isolamento

Não precisamos criar produtos: a entrada deve ser rejeitada antes de executar
index. O setUp da classe continua verificando loja_test/loja_testes e limpando
produtos dentro da transação de cada execução. Este teste verifica a resposta
HTTP e não mede consultas SQL. As medições anteriores permanecem como diagnóstico.

Nenhuma regra, controller, serviço ou outro comportamento da aplicação foi alterado.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

Sintaxe válida. A classe da API passou com 36 testes/321 asserções; a suíte
completa passou com 50 testes/375 asserções. Foram acrescentados seis casos e
48 asserções em relação à 6.41. --filter seleciona a classe, e
--do-not-cache-result evita escrita do cache na montagem de código.

SELECTs antes/depois por /tmp/curso-618-contagens.php confirmaram teste com
0 categorias/0 produtos e normal com 0 categorias/1 produto. Git diff --check
e links locais da documentação conferidos.

Os seis casos de rejeição agora são permanentes. A aceitação de 100 caracteres
Unicode e outros limites válidos continua em diagnóstico anterior; este teste
cobre somente as entradas inválidas listadas.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação verificada em
8eab468af794a8d513e0cc9f1237b562a18f93a6, com referências local e remotas coincidentes.
Continuidade na [aula 06-43](06-43-teste-navegacao-filtrada.md).
