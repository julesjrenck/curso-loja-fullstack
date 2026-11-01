# Aula 6.43 — Teste permanente de navegação filtrada

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.42
com "entendi" e publicação em 8eab468af794a8d513e0cc9f1237b562a18f93a6.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.43
confirmado com "entendi" em 01/11/2026; publicação em preparação.

Um método novo em backend/tests/Feature/CatalogoApiTest.php:
test_mantem_filtro_e_total_ao_seguir_proxima_pagina. O comportamento da API já
existia; agora a navegação filtrada passa a ter cobertura permanente.

## Produtos preparados

O teste cria duas Camiseta 10 ativas, com preços 1000 e 2000 centavos, nessa
ordem. Seus IDs vêm do banco: não assumimos números fixos. Depois cria Camiseta
09 até 01 em ordem decrescente, um Kit de camiseta, oito Canecas ativas e uma
Camiseta 00 inativa. São 21 produtos, mas somente 12 ativos combinam com camiseta.

sprintf('Camiseta %02d', $numero) formata o número com dois dígitos. Isso torna
explícita a ordem textual esperada de 01 a 09. Criá-los em ordem inversa permite
verificar que a resposta segue nome, em vez da ordem de inserção.

As duas Camiseta 10 cruzam a divisão: a de menor ID fica na posição 10, e a
outra na 11. Os preços diferentes também ajudam a distinguir os dois objetos.
O Kit fica na posição 12. A Camiseta inativa e as Canecas ficam fora do resultado.

## Construção da primeira página esperada

```php
$esperadosPrimeiraPagina = array_map(
    fn (Produto $produto): array => [
        'id' => $produto->id,
        'nome' => $produto->nome,
        'preco_em_centavos' => $produto->preco_em_centavos,
    ],
    array_merge(array_reverse($iniciais), [$primeiroEmpate]),
);
```

array_reverse transforma a sequência criada 09–01 em 01–09. array_merge
acrescenta a primeira Camiseta 10. array_map transforma cada model nos três
campos públicos esperados. A expectativa vem das fixtures; não consulta o
serviço que está sendo testado. assertJsonPath('data', ...) compara o array
completo, incluindo quantidade, ordem, IDs, nomes e preços.

## Seguir a resposta da API

```php
$primeira = $this->getJson('/api/v1/produtos?nome=camiseta');
// Asserções da primeira resposta.
$segunda = $this->getJson($primeira->json('links.next'));
```

getJson executa uma requisição GET pelo fluxo HTTP da aplicação de teste,
pedindo JSON. json('links.next') lê a URL devolvida no corpo da primeira
resposta. Essa URL alimenta a segunda requisição, inclusive com nome=camiseta.
O cliente de testes aceita a URL absoluta e executa a requisição no kernel da
aplicação; não acessa um servidor externo.

A variável $url monta apenas as expectativas dos links. A navegação usa o
link realmente recebido. Assim, se a API perder o filtro no next, o teste
detectará o erro no link e no resultado da navegação.

| Campo | Primeira resposta | Segunda resposta |
| --- | --- | --- |
| data | Camiseta 01–09 e primeira Camiseta 10 | Segunda Camiseta 10 e Kit |
| current_page | 1 | 2 |
| per_page | 10 | 10 |
| total | 12 | 12 |
| last_page | 2 | 2 |
| from / to | 1 / 10 | 11 / 12 |
| prev | null | Página 1 com nome |
| next | Página 2 com nome | null |

Ambas exigem status 200, Content-Type application/json e links first/last
para páginas 1/2 com o filtro. Total conta todos os ativos correspondentes à
busca, enquanto data contém somente os itens da página atual.

## Isolamento e verificações

O setUp confere loja_test/loja_testes e limpa os produtos dentro da transação.
DatabaseTransactions desfaz as alterações ao terminar. Não presumimos que o
contador de IDs seja reiniciado. Este teste não mede SQL nem acrescenta
asserções de meta.links. Nenhum código de produção foi alterado.

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

Sintaxe válida; classe com 37 testes/345 asserções e suíte com 51 testes/399
asserções passaram. Um teste e 24 asserções a mais que na 6.42. --filter
seleciona a classe; --do-not-cache-result evita escrita de cache na montagem
de código. A suíte completa verifica também os demais comportamentos existentes.

SELECTs antes/depois por /tmp/curso-618-contagens.php: teste com 0 categorias/0
produtos e normal com 0 categorias/1 produto. Git diff --check e links locais
da documentação conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação em preparação.
Depois da confirmação, publicar e iniciar somente 6.44: testes de busca literal
com caracteres especiais e texto '0', usando DataProvider.
