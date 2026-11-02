# Aula 6.70 — Captura optativa da resposta 404 em teste HTTP

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.69 com "entendi" e publicação em 7cf816f341084bb7a1d38db68a05ea16725a67bd.
Entendimento da 6.70 confirmado com "entendi" em 01/11/2026; publicação
verificada em a2055b62166a5976ac321411ad2332196d007ca6, referências local e remotas coincidentes.

## Mudança no teste existente

Em [CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php), acrescentamos
o import Illuminate\Support\Facades\File e ampliamos apenas o caso de produto
inexistente. File dá acesso às operações locais de arquivo do Laravel, como
exists, delete, ensureDirectoryExists e put, documentadas na
[referência oficial](https://api.laravel.com/docs/13.x/Illuminate/Filesystem/Filesystem.html).

O método ficou assim:

```php
public function test_retorna_404_em_json_para_id_inexistente(): void
{
    $capturar = getenv('CAPTURAR_CONTRATO_404') === '1';
    $caminhoCaptura = storage_path('app/private/contratos/consulta-404.json');

    if ($capturar && File::exists($caminhoCaptura)) {
        $this->assertTrue(File::delete($caminhoCaptura));
    }

    $resposta = $this->getJson('/api/v1/produtos/1');

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson([
            'message' => 'Produto não encontrado.',
        ]);

    if ($capturar) {
        $corpo = $resposta->getContent();
        json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

        File::ensureDirectoryExists(dirname($caminhoCaptura));
        $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
    }
}
```

Getenv lê a variável do processo. A comparação estrita com a string '1' ativa
a captura; ausente ou com outro valor, os blocos de arquivo ficam desativados.
Storage_path monta o caminho dentro de storage. No container, ele corresponde
a /app/storage/app/private/contratos/consulta-404.json; o volume do Compose
o disponibiliza no host em backend/storage/app/private/contratos/consulta-404.json.

Antes da requisição, apagamos uma captura anterior e conferimos a exclusão.
Depois, as asserções existentes verificam status, cabeçalho e corpo esperado.
Somente após elas, getContent obtém o corpo bruto retornado pela aplicação.

Json_decode com JSON_THROW_ON_ERROR verifica a sintaxe; uma falha interrompe
o teste. Seu resultado não é reencodificado: gravamos o texto original, mantendo
objetos/listas e escapes JSON. EnsureDirectoryExists prepara a pasta retornada
por dirname. File::put grava o corpo e retorna a quantidade de bytes escritos;
assertSame compara esse valor com strlen, que conta bytes do texto bruto.

## Comandos para executar

Execução comum, com captura desativada:

```sh
docker compose exec -T backend php artisan test \
  --do-not-cache-result \
  --filter=test_retorna_404_em_json_para_id_inexistente
```

Execução com captura ativada apenas naquele processo:

```sh
docker compose exec -T -e CAPTURAR_CONTRATO_404=1 backend php artisan test \
  --do-not-cache-result \
  --filter=test_retorna_404_em_json_para_id_inexistente
```

Exec inicia o comando no container backend; -T desativa o terminal interativo.
-e fornece a variável somente ao processo executado. Filter seleciona o caso
existente. Do-not-cache-result evita gravar o cache PHPUnit na pasta /app,
montada somente para leitura. O primeiro teste foi executado sem essa opção:
passou, mas avisou sobre o cache; os comandos seguintes usaram a opção e
terminaram sem esse aviso. Não alteramos permissões ou volumes para resolvê-lo.

O ambiente testing continua selecionando loja_test, com guarda de identidade
loja_test/loja_testes antes do delete e DatabaseTransactions. A requisição
getJson é simulada internamente pelo Laravel; não acessa a porta 8002 pela rede.

## Resultados conferidos

| Execução | Resultado |
| --- | --- |
| Focada sem flag, antes de existir captura | 1 teste/6 asserções, nenhum arquivo criado |
| Focada com flag e marcador antigo de diagnóstico | 1 teste/8 asserções, marcador substituído |
| Suíte comum sem flag | 66 testes/620 asserções, captura intacta |

As duas asserções extras na execução com marcador conferiram exclusão e bytes.
Sem arquivo anterior, a captura acrescenta apenas a asserção de bytes.

O arquivo capturado contém exatamente 42 bytes:

```json
{"message":"Produto n\u00e3o encontrado."}
```

O escape representa a letra ã ao decodificar JSON. PHP em Docker conferiu o
conteúdo, o tamanho e o SHA256; o mesmo hash permaneceu após a suíte comum:

```text
7d5b3a5bdfea032180e3ee337a2e028e7c492036c9acf6af05e9f6c965317c04
```

SELECTs antes/depois confirmaram loja/loja_app com 0 categorias/1 produto e
loja_test/loja_testes com 0 categorias/0 produtos. Git check-ignore confirmou
que a captura está coberta pelo ignore privado existente. Diff e links conferidos.

Esta etapa captura e verifica JSON, sem compará-lo com o schema OpenAPI ainda.
O processo de teste precisa terminar com código 0 antes de consumir a captura.
Se setUp ou outro teste falhar, um arquivo anterior pode permanecer; a existência
do arquivo, sozinha, não comprova sucesso da execução atual.

Nenhuma dependência nova ou mudança em produção/OpenAPI/configuração. A limitação
do validador observada na 6.64 permanece registrada; id path mantém required true.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação verificada em a2055b62166a5976ac321411ad2332196d007ca6.
Continuidade na [aula 06-71](06-71-validacao-captura-404.md).
