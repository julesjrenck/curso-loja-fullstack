# Aula 6.47 — Aceitação do limite de 100 caracteres no nome

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.46
com "entendi" e publicação em 466053ab71a1faac095b8d42a53795847afe702b.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.47
confirmado com "entendi" em 01/11/2026; publicação verificada em
716032b43e3cd2fb2eb0543210c2cf0b961e38bd, com referências local e remotas coincidentes.

## Alteração

Em backend/tests/Feature/CatalogoApiTest.php, acrescentamos duas entradas ao
provider nomesLiterais:

```php
'limite de 100 caracteres ASCII' => [str_repeat('a', 100)],
'limite de 100 caracteres Unicode' => [str_repeat('á', 100)],
```

Str_repeat repete a string cem vezes, sem escrever ou contar as letras à mão.
Cada lista interna fornece o argumento $nome de uma execução do método
test_busca_nome_literal_e_preserva_texto_nos_links. O provider passou de sete
para nove casos. Nenhum método novo foi necessário.

## O que cada execução confere

O método existente cria um ativo com nome 'Produto '.$nome.' especial',
um ativo Produto comum e um correspondente inativo. Http_build_query prepara
o parâmetro para a URL; getJson executa o GET pelo fluxo da aplicação de teste.

O Form Request recebe o texto decodificado e aplica max:100. Cem caracteres
devem ser aceitos. O teste exige 200/application/json, somente o objeto ativo
correspondente com ID/nome/preço, total 1 e metadados de uma única página.
First/last devem preservar o nome buscado e page=1; prev/next são null.

A aplicação já atendia ao limite; regras, controller, serviço e resource não
foram alterados. O teste não mede SQL nem acrescenta asserções de meta.links.

## Caracteres e bytes

Cem letras a ocupam cem bytes em UTF-8. Cem letras á ocupam duzentos bytes,
mas continuam sendo cem caracteres neste exemplo. A regra de texto max:100
aceita ambos. O caso acentuado verifica especificamente á, sem representar
cobertura de todos os caracteres Unicode.

O parâmetro de busca tem cem caracteres. O nome completo criado pela factory
tem 117, por causa do prefixo e sufixo; cabe nos 150 definidos na migration
create_produtos_table. Limite do filtro e tamanho da coluna são decisões distintas.

Na 6.42, já verificamos a rejeição de 101 letras a/á com 422. Agora temos os
dois lados da fronteira: cem aceitos e cento e um rejeitados.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result --compact
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

php -l verifica sintaxe; --filter seleciona a classe; a última execução inclui
a suíte inteira. --do-not-cache-result evita escrita do cache na montagem de
código. Sintaxe válida, classe com 48 testes/488 asserções e suíte completa com
62 testes/542 asserções: dois casos e 26 asserções a mais que na 6.46.

SetUp continua verificando loja_test/loja_testes e limpando produtos dentro da
transação; DatabaseTransactions desfaz as alterações. SELECTs antes/depois por
/tmp/curso-618-contagens.php: teste com 0 categorias/0 produtos e normal com
0 categorias/1 produto. Git diff --check e links locais conferidos.

## Continuidade

Roteiro, progresso e cobertura do [contrato atual](../api/catalogo.md) atualizados.
Entendimento confirmado com "entendi" em 01/11/2026; publicação verificada em
716032b43e3cd2fb2eb0543210c2cf0b961e38bd, com referências local e remotas coincidentes.
Continuidade na [aula 06-48](06-48-testes-acentos-nome.md).
