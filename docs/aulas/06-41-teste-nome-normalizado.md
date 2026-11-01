# Aula 6.41 — Nome normalizado e parâmetros desconhecidos nos testes

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.40
com "entendi" e publicação em 851adef50e2973dcb66d223fe4424f1326a89677.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.41
confirmado com "entendi" em 01/11/2026; checkpoint publicado em
2128dbb861375af85566e0a2b07adcaaa8018d3b, com remoto conferido.

Conjunto inseparável em backend/tests/Feature/CatalogoApiTest.php: generalizar
o teste de busca para receber query e nome esperado nos links, com um provider.

## Três entradas para o mesmo teste

```php
public static function buscasPorNome(): array
{
    return [
        'nome simples' => ['nome=camiseta', 'camiseta'],
        'espaços externos e caixa' => ['nome=%20%20CAMISETA%20%20', 'CAMISETA'],
        'parâmetro desconhecido' => ['nome=camiseta&ignorado=valor', 'camiseta'],
    ];
}
```

Cada linha fornece dois argumentos. O primeiro é a query enviada; o segundo
é o nome que deve aparecer nos links. As chaves externas identificam as execuções
no relatório. O provider é público e estático, sem acesso ao banco.

O método de teste passa a receber esses argumentos:

```php
#[DataProvider('buscasPorNome')]
public function test_filtra_ativos_por_trecho_do_nome_no_json(string $query, string $nomeNosLinks): void
```

No segundo caso, %20 representa espaço na URL. Após decodificar a query, os
middlewares recebem '  CAMISETA  ' e removem os espaços externos. O texto continua
em maiúsculas, e a busca no banco deve encontrar os mesmos produtos. O link
esperado usa CAMISETA sem espaços; não aplicamos trim dentro do teste para
calcular essa expectativa. O provider a declara explicitamente.

No terceiro caso, ignorado=valor acompanha um nome válido. Os produtos esperados
continuam os mesmos, e o parâmetro desconhecido deve ficar fora dos links.

## Requisição e links esperados

```php
$resposta = $this->getJson('/api/v1/produtos?'.$query);
$url = url('/api/v1/produtos').'?'.http_build_query([
    'nome' => $nomeNosLinks,
    'page' => 1,
]);
```

O ponto concatena a query fornecida à URL da requisição. Http_build_query monta
a query da URL esperada a partir dos dois campos selecionados, codificando os
valores conforme necessário. Não reutilizamos a query original inteira nos
links esperados, pois ela pode conter espaços ou parâmetros desconhecidos.

First e last agora são comparados diretamente com essa URL completa. Prev/next
continuam null. A comparação do objeto links inteiro rejeita a propagação de
ignorado ou a preservação dos espaços da entrada.

## Expectativas mantidas

Cada execução recria as quatro fixtures da 6.40: Kit de camiseta e Camiseta azul
ativos, Caneca ativa e Camiseta antiga inativa. Continua exigindo somente Camiseta
azul e Kit nessa ordem, IDs gerados, nomes/preços/tipos, 200/application/json e
metadados página 1, tamanho 10, total 2, última 1 e posições 1/2.

Cada linha do provider gera uma execução com seu próprio setUp e transação.
As factories são desfeitas ao terminar; IDs são lidos dos models da execução.
O código da aplicação e os demais testes foram preservados.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

Sintaxe válida. A classe da API passou com 30 testes/273 asserções; a suíte
completa passou com 44 testes/327 asserções. Três execuções substituem a única
da 6.40, acrescentando duas execuções e 26 asserções. --filter seleciona a classe;
--do-not-cache-result evita escrita do cache na montagem de código.

SELECTs antes/depois por /tmp/curso-618-contagens.php: teste 0 categorias/0 produtos;
normal 0 categorias/1 produto. Contagens preservadas. Git diff --check e links
locais conferidos.

Normalização e exclusão de desconhecidos nos links first/last têm cobertura
permanente. Casos de meta.links, caracteres especiais, navegação entre páginas
filtradas e erros de nome continuam nos diagnósticos anteriores até receberem
testes permanentes específicos.

## Continuidade

Entendimento confirmado com "entendi" em 01/11/2026; checkpoint publicado em
2128dbb861375af85566e0a2b07adcaaa8018d3b, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.42](06-42-testes-nomes-invalidos.md), com testes
permanentes de nomes inválidos e 422/errors.nome.
