# Aula 6.11 — Listar produtos pelo contrato Catalogo

## Objetivo e estado

Declarar a nova leitura na interface e manter as duas implementações compatíveis.
Implementação, explicação e verificações em 23/10/2026; entendimento confirmado
pelo aluno com "entendi" em 23/10/2026.
Conjunto de código: app/Contracts/Catalogo.php e
app/Services/CatalogoDemonstracao.php. CatalogoEloquent já implementa a leitura
desde a 6.10. O controller continua retornando os nomes nesta etapa.

Etapa anterior 6.10 confirmada com "entendi" em 23/10/2026 e publicada em
9e8e6b6eb7e076880dcf922b1fbecb7c100dbaf4. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O contrato ampliado

Backend/app/Contracts/Catalogo.php:

```php
<?php

namespace App\Contracts;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;

interface Catalogo
{
    public function listarNomes(): array;

    /**
     * @return Collection<int, Produto>
     */
    public function listarProdutos(): Collection;
}
```

Uma interface declara métodos sem implementar seus corpos. Agora o contrato
promete duas operações: nomes como array e produtos como coleção de modelos.
Um consumidor que depende de Catalogo pode se apoiar nessa promessa, mantendo
a escolha da implementação no binding.

Collection é o tipo nativo de retorno exigido pelo PHP; o import permite usar
seu nome curto. Produto é usado no phpdoc, que documenta o tipo dos elementos.
Collection<int, Produto> não é uma verificação nativa dos elementos pelo PHP.
As classes concretas precisam fornecer métodos públicos com assinaturas
compatíveis. CatalogoEloquent já possui listarProdutos(): Collection; nenhum
trecho desse serviço foi alterado na 6.11.

## A implementação de demonstração

CatalogoDemonstracao também declara implements Catalogo, portanto recebeu o
método novo e os imports de Produto e Collection. ListarNomes foi preservado.

```php
/**
 * @return Collection<int, Produto>
 */
public function listarProdutos(): Collection
{
    $calca = new Produto([
        'nome' => 'Calça',
        'preco_em_centavos' => 12990,
        'status' => 'ativo',
    ]);
    $calca->id = 2;

    $camiseta = new Produto([
        'nome' => 'Camiseta',
        'preco_em_centavos' => 4990,
        'status' => 'ativo',
    ]);
    $camiseta->id = 1;

    $tenis = new Produto([
        'nome' => 'Tênis',
        'preco_em_centavos' => 19990,
        'status' => 'ativo',
    ]);
    $tenis->id = 3;

    return new Collection([$calca, $camiseta, $tenis]);
}
```

New Produto monta os modelos em memória com os atributos informados. Não há
create ou save; os objetos continuam exists false. Os IDs são fictícios e
atribuídos diretamente para representar os itens de demonstração. Não são IDs
gerados pelo SQL Server nem indicam que esses objetos foram persistidos.

New Collection reúne os três modelos. A sequência Calça/Camiseta/Tênis já está
ordenada por nome nesse conjunto fixo. Essa implementação fornece dados de
demonstração sem consultar o banco. ListarNomes mantém seu retorno histórico
['Camiseta', 'Calça', 'Tênis']; ele não foi refatorado nesta aula.

As implementações usam fontes diferentes, mas oferecem o retorno prometido:

| Implementação | Origem de listarProdutos | Retorno |
| --- | --- | --- |
| CatalogoEloquent | Consulta SQL Server e filtros da 6.10. | Collection de Produto lidos do banco. |
| CatalogoDemonstracao | Dados fixos construídos em memória. | Collection de Produto fictícios, não salvos. |

AppServiceProvider continua com Catalogo -> CatalogoEloquent. A demonstração
não foi ativada na aplicação. O controller ainda chama listarNomes; a próxima
etapa fará a ligação da leitura e do resource à resposta pública.

## Verificações executadas

```bash
docker compose exec -T backend php -l app/Contracts/Catalogo.php
docker compose exec -T backend php -l app/Services/CatalogoDemonstracao.php
docker compose exec -T backend php < /tmp/curso-611-contrato-catalogo.php
docker compose exec -T backend php artisan test --do-not-cache-result
docker compose exec -T backend php < /tmp/curso-62-http.php
```

Exec -T executa no container backend sem terminal interativo. Php -l verifica
sintaxe; os redirecionamentos enviam os diagnósticos locais ao PHP do container.
Test executa a suíte existente; --do-not-cache-result evita cache de resultados
na montagem de código somente leitura.

O diagnóstico da 6.11 carregou .env.testing e usou reflexão para conferir o
retorno declarado na interface. Instanciou a demonstração, exigiu os três models
Produto com status ativo, campos/valores/tipos esperados e exists false, verificou
listarNomes histórico e zero SQL observado após o listener. Depois resolveu
Catalogo pelo container, exigiu CatalogoEloquent, conferiu loja_test/loja_testes
e chamou listarProdutos pelo objeto resolvido: Collection vazia e um SELECT.
Não cadastrou ou alterou dados nesse diagnóstico.

Resultados, todos com código 0:

- Sintaxes válidas; ambas as classes carregam atendendo à interface ampliada.
- Demonstração com três produtos em memória, dados/tipos corretos e zero SQL.
- Binding preservado e leitura Eloquent pelo contrato em loja_test válida.
- Suíte existente: 18 testes/78 asserções passaram, sem testes novos nesta etapa.
- HTTP real: API 200/application/json/{"data":["Camiseta"]}; /loja
  200/text/html; charset=utf-8 e item Camiseta.
- SELECTs separados via /tmp/curso-62-contagens.php após suíte/HTTP:
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com
  0 categorias/1 produto. Identidades e contagens esperadas conferidas.

Sem migration, seeder, nova dependência, mudança de binding ou cadastro permanente.

## Continuidade

Entendimento da 6.11 confirmado. Publicar o checkpoint e iniciar somente a 6.12,
ligando ProdutoController@index
a listarProdutos e ProdutoResource::collection, ajustando o tipo de retorno e
os testes HTTP para objetos com id/nome/preco_em_centavos. Atualizar o contrato
ativo junto à resposta; preservar vazio, ativos, omissão de inativos e ordenação.
Esse conjunto forma uma única troca de representação. Exercício DBeaver segue sem relato.
