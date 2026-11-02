# Aula 6.72 — Captura optativa da resposta 200 em teste HTTP

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.71 com "entendi" e publicação em 6dd65eb7989c4c0547e314c37e3ae76fcd176ade.
Entendimento da 6.72 confirmado com "entendi" em 01/11/2026; publicação
verificada em bd05ce022b0c8af38a8a5fd2573c59757416603b, referências local e remotas coincidentes.

## Capturar o produto escolhido pelo teste

Em [CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php), ampliamos
somente test_retorna_produto_ativo_pelo_id_em_json. No início do método:

```php
$capturar = getenv('CAPTURAR_CONTRATO_200') === '1';
$caminhoCaptura = storage_path('app/private/contratos/consulta-200.json');

if ($capturar && File::exists($caminhoCaptura)) {
    $this->assertTrue(File::delete($caminhoCaptura));
}
```

É a mesma mecânica do 404, com variável e arquivo próprios. A comparação
estrita exige a string '1'. Storage_path aponta para o arquivo dentro de
storage; a captura anterior é removida antes de criar os produtos do caso.
File já estava importado, portanto não houve dependência nova.

O teste mantém duas factories: uma Caneca e uma Camiseta, ambas ativas. O
model retornado pela factory da Camiseta fornece o ID usado na requisição:

```php
$resposta = $this->getJson('/api/v1/produtos/'.$camiseta->id);
```

As asserções existentes exigem status 200, Content-Type application/json e
data objeto com o mesmo $camiseta->id, nome Camiseta e preço inteiro 4990.
O valor esperado do ID vem do model criado naquele teste, sem fixar 1.

Depois dessas asserções, acrescentamos:

```php
if ($capturar) {
    $corpo = $resposta->getContent();
    json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

    File::ensureDirectoryExists(dirname($caminhoCaptura));
    $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
}
```

GetContent lê o corpo bruto produzido pelo Laravel. Json_decode confere sua
sintaxe e lança exceção em caso de erro; gravamos o texto original, mantendo
objetos/listas e escapes. File prepara a pasta e grava; assertSame confere os
bytes escritos contra strlen. A gravação acontece somente depois das asserções.

## Execuções em Docker

Primeiro, sem captura:

```sh
docker compose exec -T backend php artisan test --do-not-cache-result \
  --filter=test_retorna_produto_ativo_pelo_id_em_json
```

Depois, duas vezes com captura:

```sh
docker compose exec -T -e CAPTURAR_CONTRATO_200=1 backend \
  php artisan test --do-not-cache-result \
  --filter=test_retorna_produto_ativo_pelo_id_em_json
```

Exec executa no container backend; -T desativa terminal interativo. A opção
-e fornece a flag somente ao processo. Filter seleciona o caso; do-not-cache-result
evita gravar cache PHPUnit na pasta de código somente para leitura.
Testing/loja_test/loja_testes, guarda de identidade e transações continuam os
existentes. GetJson simula a requisição internamente, sem acesso HTTP pela rede.

| Execução | Resultado |
| --- | --- |
| Sem flag, antes de existir captura 200 | 1 teste/6 asserções; nenhum arquivo criado |
| Primeira opt-in | 1 teste/7 asserções; ID capturado 22654 |
| Segunda opt-in | 1 teste/8 asserções; anterior removida, ID capturado 22656 |
| Suíte comum sem flags | 66 testes/620 asserções; capturas 200/404 intactas |

A primeira captura acrescentou a asserção de bytes. A segunda também conferiu
a exclusão do arquivo anterior. Os IDs são observações dessas execuções;
outras execuções usarão os IDs que suas factories receberem.

O corpo final capturado, compacto e com 64 bytes, foi:

```json
{"data":{"id":22656,"nome":"Camiseta","preco_em_centavos":4990}}
```

PHP em Docker conferiu data objeto, ID inteiro positivo, nome e preço. O hash
da captura permaneceu igual após a suíte comum; o hash 404 também permaneceu
igual ao início da etapa. Ambos os arquivos estão cobertos pelo ignore privado.

SELECTs antes/depois confirmaram loja/loja_app com 0 categorias/1 produto e
loja_test/loja_testes com 0 categorias/0 produtos. O rollback desfaz os dados
do teste; o arquivo conserva o corpo que foi produzido durante sua execução.
Diff e links locais conferidos. Nenhuma mudança em produção, OpenAPI,
configuração ou script 404; nenhuma dependência ou teste novo.

Esta etapa captura o 200 e verifica seu JSON. A comparação com o schema ainda
será feita; o script atual continua validando somente o 404. Consumir a captura
apenas após execução atual bem-sucedida do teste. A limitação do validador
observada na 6.64 permanece registrada; id path continua required true.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em bd05ce022b0c8af38a8a5fd2573c59757416603b.
Continuidade na [aula 06-73](06-73-validacao-captura-200.md).
