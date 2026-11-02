# Aula 6.76 — Captura optativa da resposta 422 da listagem

Implementação, explicação e verificação em 01/11/2026 após confirmação da
6.75 com "entendi" e publicação em d3c76b255a91948809c7eac43561f2d840c507ef.
Entendimento da 6.76 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Escolher uma entrada do DataProvider

Alteramos somente test_retorna_422_em_json_para_pagina_invalida em
[CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php).
Esse método recebe onze entradas do DataProvider paginasInvalidas; a entrada
chamada zero fornece a query page=0. A captura deve guardar esse caso específico.
Acrescentamos no início:

```php
$capturar = getenv('CAPTURAR_CONTRATO_LISTAGEM_422') === '1' && $query === 'page=0';
$caminhoCaptura = storage_path('app/private/contratos/listagem-422.json');

if ($capturar && File::exists($caminhoCaptura)) {
    $this->assertTrue(File::delete($caminhoCaptura));
}
```

As duas condições precisam ser verdadeiras: a variável do processo deve conter
a string '1', e a query deve ser exatamente 'page=0'. Isso permite executar
todo o DataProvider com a flag sem os outros casos removerem ou sobrescreverem
o arquivo. A condição usa o valor recebido, sem depender da ordem do provider.
Storage_path resolve o arquivo dentro do storage privado; File já estava
importado. Uma captura anterior é removida no início do caso escolhido, com
asserção sobre o sucesso da remoção. Sem flag, não há alteração no arquivo.

## Conferir a resposta antes de gravar

Mantivemos o GET e as asserções existentes:

```php
$resposta = $this->getJson('/api/v1/produtos?'.$query);

$resposta
    ->assertStatus(422)
    ->assertHeader('Content-Type', 'application/json')
    ->assertJsonStructure(['message'])
    ->assertJsonValidationErrors(['page']);
```

Page=0 é rejeitado pela validação de entrada. O teste confere 422, JSON,
a presença de message e erros de validação para page, sem fixar a frase.
GetJson executa internamente a aplicação Laravel; não é chamada HTTP por socket.
Depois dessas asserções, acrescentamos a mecânica já estudada:

```php
if ($capturar) {
    $corpo = $resposta->getContent();
    json_decode($corpo, false, 512, JSON_THROW_ON_ERROR);

    File::ensureDirectoryExists(dirname($caminhoCaptura));
    $this->assertSame(strlen($corpo), File::put($caminhoCaptura, $corpo));
}
```

GetContent obtém o corpo bruto. Json_decode verifica sua sintaxe, lançando
exceção se inválido; gravamos o texto original. Dirname fornece a pasta,
ensureDirectoryExists a prepara, put grava e assertSame confere os bytes.
Se as asserções anteriores falharem, a gravação não é alcançada. As flags e
arquivos das capturas individuais e da listagem 200 permanecem independentes.

## Comando e corpo observado

Com backend/SQL Server ativos e banco exclusivo de testes configurado:

```sh
docker compose exec -T -e CAPTURAR_CONTRATO_LISTAGEM_422=1 backend \
  php artisan test --do-not-cache-result \
  --filter='test_retorna_422_em_json_para_pagina_invalida@zero'
```

Exec roda no container existente; -T dispensa terminal interativo; -e passa a
flag só para esse processo. Do-not-cache-result evita gravar o cache na montagem
somente leitura de /app. O sufixo @zero seleciona a entrada nomeada do provider,
conforme a [documentação do PHPUnit](https://docs.phpunit.de/en/12.5/textui.html#filtering-by-test-name).
Conferimos --list-tests com esse filtro: exatamente uma entrada selecionada,
PHPUnit instalado 12.5.39. Sem @zero, o filtro do método executa as onze entradas.

O corpo capturado nesta execução foi:

```json
{
  "message": "The page field must be at least 1.",
  "errors": {
    "page": ["The page field must be at least 1."]
  }
}
```

Message é texto; errors é um objeto que associa page a uma lista de mensagens.
A frase acima é uma observação da execução, sem tornar esse texto uma regra
do teste ou do contrato. A captura bruta tem 105 bytes e SHA256
8dab8e21482477f6b0a6b77d2241166d86848d7322f250fb51665982d8bde6d1.
O arquivo privado é ignorado pelo Git e permanece fora da transação do banco.

## Verificações

| Execução em Docker | Resultado |
| --- | --- |
| Caso zero sem flag, arquivo inicialmente ausente | 1 teste/8 asserções; arquivo continuou ausente |
| Caso zero com flag, primeira captura | 1/9; JSON e tipos conferidos via PHP |
| Onze entradas com flag, captura já existente | 11/90; só page=0 remove e grava |
| Caso negativa com flag | 1/8; não entra no bloco de captura |
| Suíte completa sem flags | 66/620; hashes das quatro capturas preservados |

A primeira gravação acrescenta uma asserção de bytes. Quando há arquivo anterior,
a remoção acrescenta mais uma; por isso o conjunto optativo tem 90 asserções.
SELECTs antes/depois: loja/loja_app 0 categorias/1 produto;
loja_test/loja_testes 0 categorias/0 produtos. Identidades e isolamento mantidos.
Diff, links locais e ignore conferidos. Produção, OpenAPI/configuração, scripts
e dependências permanecem como estavam; nenhum serviço novo.

## Continuidade

Aula anterior registra a publicação da 6.75. Catálogo em português, roteiro e
progresso registram implementação, explicação e verificação da 6.76; entendimento
confirmado com "entendi" em 01/11/2026, publicação em preparação. Esta captura ainda não foi comparada
ao schema; o script de validação ainda não aceita 422 listagem.

Após confirmar entendimento e publicar, iniciar somente 6.77: conectar a captura
422 da listagem à comparação com seu schema em cópia temporária do OpenAPI,
seguindo o fluxo Docker já estudado. Limite do validador da 6.64 continua registrado.
Exercício DBeaver continua sem relato do aluno.
