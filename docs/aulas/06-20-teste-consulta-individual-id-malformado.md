# Aula 6.20 — Teste da consulta individual com ID malformado

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.19 em a137a9aeaa07ca6f3c7711ecb4b8cc629ac1f26a. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.20 confirmado
pelo aluno com "entendi" em 30/10/2026. Somente backend/tests/Feature/CatalogoApiTest.php alterado
no código, acrescentando um cenário para ID malformado.

## Código e fluxo

```php
public function test_retorna_404_em_json_para_id_malformado(): void
{
    $resposta = $this->getJson('/api/v1/produtos/abc');

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonStructure(['message']);
}
```

O prefixo test_ identifica o teste e void indica ausência de retorno. getJson
recebe o caminho com abc no lugar do ID e devolve a resposta. Executa o kernel
HTTP do Laravel dentro do processo de teste, sem enviar requisição por socket.
O setUp existente confere loja_test/loja_testes e esvazia produtos dentro da
transação. Não há factory neste cenário: rejeitar abc independe de cadastros.

A rota individual já contém:

```php
->where('id', '[1-9][0-9]*');
```

Esse where restringe o formato do parâmetro da URL; não é o where da consulta
SQL. [1-9] exige primeiro dígito entre 1 e 9; [0-9]* aceita zero ou mais dígitos
seguintes. Portanto 1 e 25 correspondem ao padrão, enquanto abc não corresponde.
O Laravel não encontra rota para essa URL e gera um erro 404, antes de show.

Nos testes de inexistente e inativo, o ID tem formato aceito e show produz
explicitamente {"message":"Produto não encontrado."}. Para abc, quem monta
o JSON é o tratamento de erro do roteamento Laravel. O texto e os campos extras
podem variar, inclusive conforme a configuração de depuração do ambiente.

assertStatus exige 404; assertHeader exige application/json. A novidade é
assertJsonStructure(['message']): exige JSON com a chave message, permitindo
outros campos e valores. Não verifica o texto nem o tipo do valor de message.
assertExactJson, usado nos cenários anteriores, compara o corpo completo.
O contrato de erros de rota continua sem texto padronizado pela aplicação.

O teste confere a resposta pública. A explicação sobre o bloqueio antes de show
vem da restrição existente da rota; o teste não instrumenta chamadas internas
nem conta SQL. O diagnóstico histórico da 6.16 verificou zero consultas para abc.
Os sete testes anteriores, setUp, DatabaseTransactions e a aplicação foram
preservados.

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
- Classe da API: 8 testes/49 asserções passaram.
- Suíte completa: 22 testes/103 asserções passaram.
- SELECTs separados antes/depois pelo script temporário /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.

Há quatro cenários permanentes de listagem e quatro individuais: ativo,
inexistente, inativo e abc malformado. Demais formatos e limite de int continuam
cobertos somente pelo diagnóstico histórico da 6.16. Sem novo HTTP por socket.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint concluído,
publicação em preparação; resultado será registrado após conferir o remoto.
Próximo passo: publicar checkpoint e iniciar somente 6.21, um teste de ID numérico
acima da faixa de int,
que corresponde ao padrão da rota mas recebe 404/message específica de show.
