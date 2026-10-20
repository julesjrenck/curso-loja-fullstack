# Aula 5.47 — Produto montado em memória pela factory

## Objetivo e estado

Montar um Produto com a factory e conferir seus atributos e seu estado sem
persistir registros. Demonstração e explicação em 19/10/2026; entendimento
confirmado com "entendi" em 19/10/2026. Somente registros da aula adicionados.

A 5.46 foi confirmada com "entendi", após esclarecer definition/make/create,
e publicada em 77dc3f9. HEAD, origin/main e consulta direta à main remota
retornaram 77dc3f9f60a4cb4ceabd699517064e38b76b0467 após o push.

## Código demonstrado

Depois de inicializar Laravel em PHP Docker com --env=testing:

```php
use Database\Factories\ProdutoFactory;

$produto = ProdutoFactory::new()->make();
```

ProdutoFactory é a classe da receita já preparada. new() é um método estático
herdado de Factory, chamado com ::; ele prepara uma instância da factory.
make() usa os atributos de definition para montar uma instância do model
resolvido, App\Models\Produto.

A mesma sequência, separada em duas instruções, seria:

```php
$factory = ProdutoFactory::new();
$produto = $factory->make();
```

$produto agora contém um objeto Eloquent. Podemos ler $produto->nome,
$produto->preco_em_centavos e $produto->status pelos acessores de atributos
do model que já estudamos. O cast do preço continua produzindo um inteiro.

O método definition, chamado diretamente na etapa anterior, devolvia somente
um array. make usa a definição para montar o objeto. Nenhuma chamada create
ou save foi feita. Não alteramos o model para realizar esta chamada direta
pela classe da factory.

## Verificação em Docker

Um diagnóstico temporário inicializou o console Laravel a partir de
vendor/autoload.php e bootstrap/app.php. O argumento --env=testing permitiu
selecionar a configuração de testes durante o bootstrap. Depois executou o
trecho acima, leu o model e conferiu os resultados, sem gravar código na aplicação.

Resultado observado:

| Verificação | Resultado |
| --- | --- |
| Classe | App\Models\Produto |
| Nome fictício | enim quaerat repellendus |
| Preço em centavos | 22479, tipo int |
| Status | ativo |
| exists | false |
| getKey() | null |
| created_at / updated_at | null / null |
| Consultas SQL observadas durante make | 0 |

Nome e preço são uma amostra variável do Faker. O diagnóstico conferiu nome
string de três palavras até 150 caracteres, preço inteiro no intervalo da
definição e status ativo; não exige repetir os valores fictícios dessa amostra.

exists é uma propriedade de estado do Eloquent. false indica que a instância
ainda não está marcada como persistida. Sua leitura não faz SELECT no banco.
getKey() lê a chave do model; como nenhum ID foi atribuído ou gerado pelo
banco nesta montagem, retornou null. As datas também ficaram null nesta factory,
que não as define antes de salvar.

O diagnóstico terminou com código 0. Um listener DB durante make observou
zero consultas SQL. Isso conferiu, nesta factory, que o objeto foi montado
somente em memória. Nenhum registro, migration ou seeder foi executado.

PHP 8.4.26/Composer 2.10.3 e o código instalado de new/makeInstance foram
conferidos em Docker. Git estava limpo após publicar 5.46, antes destes
registros. git diff --check passou e segredos seguem ignorados/fora do índice.

Aplicação, model, factory, testes e configurações preservados. A suíte não foi
repetida porque não houve alteração no código; última execução da 5.44:
6 testes/14 asserções, passou.

## Continuidade

Entendimento da 5.47 confirmado com "entendi" em 19/10/2026. Publicar os registros
e iniciar 5.48: adicionar HasFactory ao model Produto e conferir o atalho
Produto::factory()->make() em memória. Não antecipar persistência ou refatoração
dos testes nessa etapa do atalho.
