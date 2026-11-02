# Aula 6.74 — Captura optativa da listagem paginada

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.73 com "entendi" e publicação em 371ec884061be2107683da4e1f4afcbe98b36d4a.
Entendimento da 6.74 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Objetivo e arquivo alterado

Em [CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php), ampliamos
somente test_retorna_produto_ativo_em_json. Agora podemos guardar a resposta
200 de GET /api/v1/produtos para posteriormente compará-la ao schema da listagem.
A resposta individual contém data em objeto. A listagem contém data em lista,
links de navegação e meta com informações da página, incluindo meta.links.
Precisamos capturar o corpo inteiro para conservar essa estrutura.

## Flag e limpeza da captura anterior

No início do teste acrescentamos:

```php
$capturar = getenv('CAPTURAR_CONTRATO_LISTAGEM_200') === '1';
$caminhoCaptura = storage_path('app/private/contratos/listagem-200.json');

if ($capturar && File::exists($caminhoCaptura)) {
    $this->assertTrue(File::delete($caminhoCaptura));
}
```

Getenv lê a variável daquele processo; somente a string '1' ativa a gravação.
Storage_path resolve o caminho dentro do storage do Laravel. A flag e o arquivo
são próprios da listagem: os casos individuais 200 e 404 continuam independentes.
A remoção acontece antes da factory e da requisição, e seu sucesso é conferido.
Sem a flag, este teste não cria, remove ou sobrescreve a captura.

Mantivemos a factory da Camiseta ativa, preço inteiro 4990, e a requisição:

```php
$resposta = $this->getJson('/api/v1/produtos');
```

GetJson percorre internamente a aplicação no teste HTTP Laravel. O helper
assertPaginaUnica recebe o produto esperado com $camiseta->id e verifica
status, Content-Type, data, links e os valores de paginação já ensinados.
O ID esperado vem do model criado nessa execução; nenhum ID foi fixado.

## Gravar depois das asserções

Depois de assertPaginaUnica acrescentamos:

```php
if ($capturar) {
    $corpo = $resposta->getContent();
    json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

    File::ensureDirectoryExists(dirname($caminhoCaptura));
    $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
}
```

GetContent obtém o texto bruto da resposta. Json_decode verifica a sintaxe,
lançando exceção se houver JSON inválido; o resultado decodificado não é usado
para reescrever o arquivo. Gravamos o texto original, preservando listas,
objetos, URLs, rótulos e escapes produzidos pelo Laravel.

Dirname fornece a pasta do arquivo; ensureDirectoryExists a prepara, e put
grava o corpo. AssertSame compara o número de bytes escritos com strlen.
File já estava importado. O bloco é alcançado depois das asserções existentes;
se elas falharem, a nova captura não é gravada.

## Comandos e resultados

Com backend e SQL Server ativos e o banco exclusivo de testes configurado:

```sh
docker compose exec -T backend php artisan test --do-not-cache-result \
  --filter=test_retorna_produto_ativo_em_json
```

Para ativar a captura somente no processo desse comando:

```sh
docker compose exec -T -e CAPTURAR_CONTRATO_LISTAGEM_200=1 backend \
  php artisan test --do-not-cache-result \
  --filter=test_retorna_produto_ativo_em_json
```

Exec roda no container existente; -T dispensa terminal interativo; -e fornece
a variável sem alterar .env. Filter seleciona o método, e do-not-cache-result
evita escrever o cache de resultados na montagem somente leitura de /app.

| Execução | Resultado observado |
| --- | --- |
| Focado sem flag, arquivo inicialmente ausente | 1 teste/13 asserções; arquivo continuou ausente |
| Primeira captura optativa | 1/14; ID observado 22785 |
| Segunda captura optativa | 1/15; anterior removida, ID observado 22786 |
| Suíte completa sem flags | 66 testes/620 asserções; três hashes preservados |

A asserção adicional da primeira captura confere os bytes gravados; a segunda
execução também confere a remoção do arquivo anterior. IDs são observações das
execuções. A captura atual tem 586 bytes e SHA256
4dca729fa535d6da55da5e08d1d107e613b880ae866d4995f0cbc10937c42e78.

Conferimos o corpo via PHP em Docker: data é uma lista com uma Camiseta,
preco_em_centavos inteiro 4990; links.first/last apontam para page=1 e
prev/next são null. Meta informa current_page=1, per_page=10, total=1,
last_page=1, from=1, to=1, path e três opções em meta.links. URLs observadas
usam http://127.0.0.1:8002; rótulos reais incluem &laquo; Previous e Next &raquo;.
Nenhum valor foi normalizado para coincidir com o exemplo ilustrativo do OpenAPI.

SELECTs antes/depois: loja/loja_app 0 categorias/1 produto;
loja_test/loja_testes 0 categorias/0 produtos. DatabaseTransactions desfaz os
dados da factory; o arquivo gravado fora da transação permanece para leitura.
As três capturas continuam ignoradas pelo Git. Diff e links locais conferidos.

## Alcance e continuidade

Controller, rota, Resource, OpenAPI, scripts de validação e dependências
continuam como estavam. A documentação do catálogo, o roteiro e o progresso
registram esta etapa; a aula anterior registra sua publicação verificada.

Esta etapa verifica a resposta com as asserções existentes e salva JSON válido.
A captura da listagem ainda não foi comparada ao schema. Na 6.75, após confirmar
entendimento e publicar a 6.74, conectaremos esta captura à validação em cópia
temporária do OpenAPI, seguindo o fluxo já estudado. Limite do validador observado
na 6.64 continua registrado. Exercício DBeaver segue sem relato do aluno.
