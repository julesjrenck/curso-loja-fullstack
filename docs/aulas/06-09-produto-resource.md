# Aula 6.9 — ProdutoResource em memória

## Objetivo e estado

Definir os campos de um produto na representação planejada e verificar a
transformação em memória. Implementação, explicação e verificações em 22/10/2026;
entendimento confirmado pelo aluno com "entendi" em 23/10/2026, após esclarecer
que o resource ainda não participa da resposta da API. Único código novo: ProdutoResource.
Ele ainda não está ligado à rota; a API segue retornando nomes.

Etapa anterior 6.8 confirmada com "entendi" em 22/10/2026 e publicada em
3a92c9074c598c715647e2e4c734cb9d1903622d. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## O arquivo

Backend/app/Http/Resources/ProdutoResource.php:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco_em_centavos' => $this->preco_em_centavos,
        ];
    }
}
```

Namespace acompanha a pasta Http/Resources dentro do mapeamento App\ do Composer.
Os imports permitem usar Request e JsonResource pelos nomes curtos.
JsonResource é a classe base do Laravel para transformar um recurso em dados
que poderão compor uma resposta JSON. O construtor herdado recebe o model:

```php
$resource = new ProdutoResource($produto);
```

O resource envolve esse objeto. Ao escrever $this->nome dentro dele, a classe
base encaminha a leitura ao Produto recebido; o mesmo vale para id e preço.
Não declaramos propriedades novas com esses nomes no resource.

ToArray recebe Request conforme a assinatura da classe base e retorna um array
associativo com os campos selecionados. Nesta representação, o método não precisa
ler dados da requisição. O comentário @return array<string, mixed> documenta
chaves textuais com valores de tipos diferentes; não é uma validação executada.
O tipo nativo array informa o tipo de retorno exigido pelo PHP.

O model já oferece cast inteiro para preco_em_centavos e o Eloquent trata a
chave id como inteira por padrão. A transformação usa os atributos lidos desse
model. O resource seleciona campos; não cadastra o produto, não consulta o banco
e não valida a presença ou o preenchimento dos atributos. O uso futuro deve
fornecer um Produto com os dados necessários à representação.

Definimos os dados de um único produto, sem colocar a chave data dentro de
toArray. O envelope e a lista serão tratados na integração HTTP correspondente.
Resolve() produz os dados transformados; uma resposta HTTP completa é outra etapa.

## Demonstração em memória

O diagnóstico temporário /tmp/curso-69-resource-memoria.php inicializou Laravel,
registrou DB::listen e montou:

```php
$produto = new Produto([
    'nome' => 'Camiseta',
    'preco_em_centavos' => '4990',
    'status' => 'ativo',
]);
$produto->id = '123';

$resource = new ProdutoResource($produto);
$requisicao = Request::create('/api/v1/produtos', 'GET');
$dados = $resource->resolve($requisicao);
```

O ID 123 foi atribuído somente para simular um objeto com identificador. Não foi
gerado pelo banco nem salvo. Os valores originais de ID e preço são strings;
suas leituras pelo model entregaram inteiros. Status estava presente no model
e foi omitido do resultado, pois não faz parte do mapeamento de toArray.

Request::create constrói um objeto de requisição em memória; não acessa a URL,
não executa a rota e não cadastra o produto. Resolve chama a transformação com
essa requisição. Json_encode foi usado apenas para apresentar o array obtido:

```json
{"id":123,"nome":"Camiseta","preco_em_centavos":4990}
```

O script exigiu por comparação estrita exatamente os três campos e valores,
incluindo seus tipos. Também exigiu exists false, atributos do model iguais aos
anteriores e nenhuma consulta registrada desde a instalação do listener.
Exists false indica que o objeto não foi persistido; não foi consultada a
existência de uma linha com ID 123 no banco.

## Verificações executadas

```bash
docker compose exec -T backend php -l app/Http/Resources/ProdutoResource.php
docker compose exec -T backend php < /tmp/curso-69-resource-memoria.php
docker compose exec -T backend php < /tmp/curso-62-http.php
```

Php -l verifica sintaxe. Exec -T usa o container backend existente sem terminal
interativo. O redirecionamento envia o diagnóstico local ao PHP do container.
Nenhuma instalação de runtime ou dependência; regras do curso continuam
prevalecendo sobre a recomendação gerada de instalar Boost.

Resultados, código 0:

- Sintaxe válida; classe carregada pelo autoload existente.
- Resolve retornou exatamente id 123/nome Camiseta/preco_em_centavos 4990,
  tipos int/string/int. Model não salvo, atributos preservados e zero SQL no
  trecho observado pelo listener, após o bootstrap.
- HTTP real: GET /api/v1/produtos 200/application/json/{"data":["Camiseta"]};
  GET /loja 200/text/html; charset=utf-8 e item Camiseta.

O resource ainda não participa do caminho HTTP. A verificação em memória cobre
a transformação nova; a requisição real confirma o formato ativo anterior.
Suíte não repetida para a classe ainda isolada: última execução registrada
18 testes/78 asserções da 6.7. Não houve migration, seeder ou cadastro.

Referência oficial consultada:
[API Resources do Laravel](https://laravel.com/framework/docs/13.x/eloquent-resources).

## Continuidade

Entendimento da 6.9 confirmado. Publicar o checkpoint e iniciar somente a 6.10,
adicionando listarProdutos() em
CatalogoEloquent, retornando uma coleção de Produto ativos ordenados com ID,
nome e preço, e verificar a leitura. Preservar listarNomes, interface Catalogo,
controller e resposta da rota nessa etapa de preparação.
Exercício manual sugerido no DBeaver continua sem relato.
