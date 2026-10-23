# Aula 6.17 — Teste da consulta individual de produto ativo

## Objetivo e estado

Acrescentar o primeiro teste permanente de GET /api/v1/produtos/{id} em
tests/Feature/CatalogoApiTest.php. Implementação, explicação e verificações em
23/10/2026; entendimento confirmado pelo aluno com "entendi" em 23/10/2026. Somente esse arquivo alterado
na aplicação. Controller, rota, serviço e resource preservados.

Etapa 6.16 confirmada com "entendi" em 23/10/2026 e publicada em
10c72935393ae82fe972b78d50413243c8f1a58d. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após o push.

## Cenário e código

Acrescentado o método abaixo; os quatro testes de listagem permanecem:

```php
public function test_retorna_produto_ativo_pelo_id_em_json(): void
{
    Produto::factory()->create([
        'nome' => 'Caneca',
        'status' => 'ativo',
        'preco_em_centavos' => 2990,
    ]);

    $camiseta = Produto::factory()->create([
        'nome' => 'Camiseta',
        'status' => 'ativo',
        'preco_em_centavos' => 4990,
    ]);

    $resposta = $this->getJson('/api/v1/produtos/'.$camiseta->id);

    $resposta
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson([
            'data' => [
                'id' => $camiseta->id,
                'nome' => 'Camiseta',
                'preco_em_centavos' => 4990,
            ],
        ]);
}
```

O nome test_ permite ao PHPUnit descobrir o cenário; void indica que o método
não devolve valor. A factory com create persiste os produtos no banco exclusivo
de testes dentro da transação existente. Nome, status e preço explícitos tornam
o resultado esperado previsível.

A Caneca é criada primeiro para que existam dois produtos candidatos. Pedimos
a Camiseta; retornar o outro produto precisa falhar. Não é teste de ordenação.
$camiseta contém o model persistido e o ID gerado pelo banco. Não assumir ID 1:
SQL Server pode consumir IDs mesmo com rollback de registros.

O ponto concatena o caminho com $camiseta->id, produzindo a URL individual.
getJson percorre o fluxo HTTP do Laravel dentro do processo de teste, com os
cabeçalhos adequados a JSON. Não envia requisição pela porta do servidor e não
simula o catálogo: o binding real continua CatalogoEloquent no banco de testes.

assertStatus exige 200; assertHeader exige application/json; assertExactJson
compara o corpo completo. O array associativo interno de data representa um
objeto JSON com id/nome/preco_em_centavos. Não há uma lista contendo esse objeto,
como na resposta de listagem. Produto errado, lista no lugar de objeto, preço
errado ou campo extra fazem esse contrato falhar.

O teste reutiliza setUp: parent::setUp, identidade loja_test/loja_testes conferida
antes de limpar produtos. DatabaseTransactions desfaz fixtures ao fim de cada
teste. Nenhum cadastro no banco normal ou mudança no mecanismo de isolamento.

## Verificação e resultado

Executado no PHP Docker, código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

php -l verificou a sintaxe. --filter selecionou a classe da API; sem o filtro,
executada a suíte completa. --do-not-cache-result evita gravar cache de resultados
no código montado somente para leitura no container.

- Sintaxe válida.
- CatalogoApiTest: 5 testes/30 asserções passaram, incluindo o cenário novo.
- Suíte completa: 19 testes/84 asserções passaram.
- SELECTs posteriores por /tmp/curso-62-contagens.php: loja_test/loja_testes
  0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto. Identidades
  conferidas separadamente, fixtures desfeitas.

Não repetido diagnóstico por socket: código da aplicação preservado nesta etapa.
Última verificação HTTP real da consulta individual pertence à 6.16. Agora há
um teste permanente de sucesso individual, além dos quatro testes de listagem.
Ausente, inativo e restrições de ID ainda dependem dos diagnósticos da 6.16;
não tratar o teste novo como cobertura desses erros.

## Continuidade

Em 23/10/2026, aluno confirmou entendimento e pediu: "vamos continuar outro dia".
Curso em pausa a pedido do aluno; não iniciar nova aula até pedido de retomada.
Checkpoint publicado em c474f249ea8b071afbc3972da5404d104f7d05d2; HEAD,
origin/main e main consultada diretamente no remoto coincidiram após push.
Resultado da publicação registrado neste salvamento posterior, sem nova aula.
Próximo passo exato, somente quando o aluno pedir para retomar: 6.18, acrescentar um teste permanente de ID válido inexistente
em CatalogoApiTest, com catálogo vazio preparado pelo setUp. Exigir status 404,
Content-Type application/json e JSON exato {"message":"Produto não encontrado."}.
Preservar o restante dos cenários. Exercício DBeaver segue sem relato do aluno.
