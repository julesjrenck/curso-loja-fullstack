# Aula 6.19 — Teste da consulta individual de produto inativo

## Objetivo e estado

Implementação, explicação e verificações em 30/10/2026 após a confirmação da 6.18.
Entendimento da 6.19 confirmado pelo aluno com "entendi" em 30/10/2026. Um novo teste em
backend/tests/Feature/CatalogoApiTest.php verifica um produto existente que está
inativo e, por isso, não está disponível no catálogo público.

Checkpoint anterior publicado e conferido em d6fac241a0c9d32315e6403a5cea51040bb7a0c8,
etapa 6.18. HEAD, origin/main e main remota coincidiram após push.

## Código e fluxo

```php
public function test_retorna_404_em_json_para_produto_inativo(): void
{
    $caneca = Produto::factory()->inativo()->create([
        'nome' => 'Caneca',
        'preco_em_centavos' => 2990,
    ]);

    $resposta = $this->getJson('/api/v1/produtos/'.$caneca->id);

    $resposta
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertExactJson([
            'message' => 'Produto não encontrado.',
        ]);

    $this->assertDatabaseHas('produtos', [
        'id' => $caneca->id,
        'status' => 'inativo',
    ]);
}
```

O prefixo test_ permite descobrir o teste e void indica ausência de retorno.
Produto::factory() prepara os dados; inativo() aplica o estado já existente na
factory, sobrescrevendo status para inativo. create persiste o produto em
loja_test e devolve o model com o ID gerado. Nome e preço ficam explícitos para
facilitar a leitura do cenário. Nenhum ID é fixado.

O ponto concatena o caminho com $caneca->id. getJson executa o kernel HTTP do
Laravel no processo de teste, usando rota/controller/contrato/binding/serviço e
SQL Server reais de testes; não usa socket. BuscarProduto filtra ID e status
ativo, portanto first retorna null para essa Caneca. Show devolve o mesmo erro
do ID inexistente: 404 e {"message":"Produto não encontrado."}.

As três asserções encadeadas exigem status, Content-Type e corpo completo.
Não há data no JSON de erro. O catálogo público só disponibiliza produtos ativos;
consultar o produto inativo não o exclui nem muda seu status.

assertDatabaseHas recebe o nome da tabela e os campos que a linha precisa
conter. Aqui exige um registro em produtos com o ID real da Caneca e status
inativo, depois da resposta HTTP. Diferentemente de assertExactJson, que confere
o corpo inteiro, essa asserção verifica os campos indicados da linha no banco.
Se a requisição remover ou ativar a Caneca, essa verificação falha.

O setUp existente confere loja_test/loja_testes antes de esvaziar produtos.
DatabaseTransactions mantém o isolamento. A asserção ocorre antes de o teste
terminar; só ao final o rollback desfaz o cadastro fictício da Caneca. Produto
normal da loja não é alterado. Os demais seis testes e o código da aplicação
foram preservados.

## Verificação

Executados no Docker, todos com código 0:

```sh
docker compose exec -T backend php -l tests/Feature/CatalogoApiTest.php
docker compose exec -T backend php artisan test --filter=CatalogoApiTest --do-not-cache-result
docker compose exec -T backend php artisan test --do-not-cache-result
```

php -l verifica sintaxe; --filter seleciona a classe da API; sem filtro executamos
a suíte completa. --do-not-cache-result evita escrever cache de resultados no
código montado somente para leitura.

- Sintaxe válida.
- Classe da API: 7 testes/43 asserções passaram.
- Suíte completa: 21 testes/97 asserções passaram.
- SELECTs separados antes/depois pelo script temporário /tmp/curso-618-contagens.php:
  loja_test/loja_testes com 0 categorias/0 produtos e loja/loja_app com
  0 categorias/1 produto. Identidades e contagens conferidas.

Agora são quatro testes permanentes de listagem e três de consulta individual:
ativo, inexistente e inativo. Restrições de ID continuam somente no diagnóstico
histórico da 6.16. HTTP por socket não repetido nesta etapa.

## Continuidade

Entendimento confirmado com "entendi" em 30/10/2026. Checkpoint concluído,
publicação em preparação; resultado será registrado após conferir o remoto.
Próximo passo: publicar checkpoint e iniciar somente 6.20, um teste de ID malformado como abc rejeitado
pela rota com 404 JSON, sem exigir a message específica de show.
