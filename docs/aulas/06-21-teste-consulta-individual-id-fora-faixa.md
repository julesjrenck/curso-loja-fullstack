# Aula 6.21 — Teste da consulta individual com ID acima da faixa de int

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após confirmação e
publicação da 6.20 em a23d68800e5c48f503cf29a4d0e477c54cf94386. HEAD,
origin/main e main remota conferidos após push. Entendimento da 6.21 confirmado
pelo aluno com "entendi" em 30/10/2026. Somente backend/tests/Feature/CatalogoApiTest.php alterado
no código, acrescentando um cenário para ID numérico fora da faixa de int.

## Código e fluxo

```php
public function test_retorna_404_em_json_para_id_acima_da_faixa_de_int(): void
{
    $idForaDaFaixa = PHP_INT_MAX.'0';

    $resposta = $this->getJson('/api/v1/produtos/'.$idForaDaFaixa);

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson([
            'message' => 'Produto não encontrado.',
        ]);
}
```

O prefixo test_ identifica o teste e void indica ausência de retorno.
PHP_INT_MAX é uma constante do PHP: contém o maior inteiro suportado naquela
plataforma. Na imagem PHP 64 bits atual, é 9223372036854775807.

O ponto concatena o texto '0' a esse valor, gerando a string
'92233720368547758070'. A variável contém texto composto apenas por dígitos,
maior que PHP_INT_MAX. Não somamos 1 nem multiplicamos o inteiro: operações
que ultrapassam o limite de int podem produzir float. Com concatenação,
preservamos todos os dígitos do valor enviado na URL.

getJson recebe o caminho concatenado com esse ID textual e executa o kernel
HTTP do Laravel no processo de teste, sem socket. Não precisamos criar produto,
pois o valor será recusado antes de consultar o catálogo.

O padrão [1-9][0-9]* da rota confere formato, sem impor quantidade máxima de
dígitos. Portanto esse valor chega a show, que já recebe o ID como string e usa:

```php
$idValidado = filter_var($id, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);
```

FILTER_VALIDATE_INT também verifica se o valor cabe em int; min_range exige
pelo menos 1. Para o ID do teste, retorna false. O ternário existente atribui
null a produto e não chama buscarProduto. O if seguinte devolve explicitamente
404 e {"message":"Produto não encontrado."}.

As asserções exigem status, cabeçalho e corpo completo. Voltamos a
assertExactJson porque esse erro é produzido pelo nosso show com mensagem
definida, enquanto abc na 6.20 é rejeitado pelo roteamento.

O teste confirma a resposta pública. Não instrumenta chamadas ao serviço nem
conta SQL; zero consultas para valor acima da faixa foi conferido no diagnóstico
histórico da 6.16. Os oito cenários anteriores, setUp, identidade
loja_test/loja_testes e DatabaseTransactions foram preservados.

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
- Classe da API: 9 testes/55 asserções passaram.
- Suíte completa: 23 testes/109 asserções passaram.
- SELECTs separados antes/depois pelo script temporário /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.

Há quatro cenários permanentes de listagem e cinco individuais: ativo,
inexistente, inativo, abc malformado e ID acima da faixa de int. Demais formatos
continuam somente no diagnóstico histórico da 6.16. Sem novo HTTP por socket.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint publicado em
a79fc87b9d257899467c7fe161c5ab7819986fbe, `test: verifica consulta com ID acima da faixa de int`.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado registrado na etapa seguinte, sem incluir o SHA no próprio commit.
Continuidade realizada na 6.22: ampliar o teste de ID malformado com data
provider para abc, 0, -1, 1.5 e 01, sem fixar a message do roteamento.
