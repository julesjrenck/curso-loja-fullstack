# Aula 5.62 — Model Categoria preparado

## Objetivo e estado

Representar categorias pelo Eloquent, com nome permitido para preenchimento.
Implementação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" na mesma data. Nenhuma categoria cadastrada nesta etapa.

A 5.61 foi confirmada com "entendi" e publicada em
4d3358d249ecb19e25cf560ba3797895d9620220. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Geração e arquivo

Na raiz do projeto:

```bash
docker compose run --rm --no-deps -T --user 1000:1000 \
  --volume "$PWD/backend/app/Models:/app/app/Models:rw" \
  --entrypoint php backend artisan make:model Categoria --no-interaction --no-ansi
```

Run cria um container temporário do backend, --rm o remove ao terminar e
--no-deps evita iniciar dependências. -T dispensa terminal interativo. --user
mantém o dono local 1000:1000. --volume libera escrita somente em app/Models,
pois o código do serviço normalmente é somente para leitura; Compose preservado.

--entrypoint php inicia PHP com artisan e seus argumentos. Make:model recebe
Categoria como nome da classe; --no-interaction dispensa perguntas e --no-ansi
remove códigos de cor. Não solicitamos migration, factory ou controller.
Resultado código 0, arquivo app/Models/Categoria.php criado, dono local/modo 644.

Acrescentamos import de Fillable e atributo PHP de configuração. Código final:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nome'])]
class Categoria extends Model
{
}
```

Namespace organiza a classe como App\Models\Categoria. Os imports permitem usar
Fillable e Model pelos nomes curtos. Extends Model fornece as operações do
Eloquent. Embora o corpo esteja vazio, a classe herda esse comportamento e tem
o atributo Fillable configurado, como já apresentado no model Produto.

Fillable permite atribuir nome por um array, por exemplo ao construir o objeto
ou usar create. Não valida o conteúdo do nome nem seu tamanho. Id e datas são
tratados pelo banco/Eloquent ao persistir; não foram liberados nesse array.

Pela convenção instalada e conferida, Categoria usa tabela categorias, chave id
inteira incremental e created_at/updated_at. Não foi necessário configurar
$table ou casts. O model usa a conexão padrão do ambiente: sqlsrv, que aponta
para loja normalmente e loja_test no ambiente de testes.

## Demonstração em memória e verificação

Sintaxe:

```bash
docker compose exec -T backend php -l app/Models/Categoria.php
```

Exec usa o backend iniciado; php -l confere sintaxe. Passou, código 0.
O script temporário /tmp/curso-562-model-categoria.php foi enviado ao PHP Docker:

```bash
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-562-model-categoria.php
```

O shell lê o arquivo do host com <, PHP o recebe por /dev/stdin e Laravel
seleciona testing. Depois de inicializar a aplicação, o script executou:

```php
$categoria = new Categoria(['nome' => 'Roupas']);
```

Isso preencheu nome no objeto, sem salvar. Diagnóstico confirmou autoload/herança,
tabela categorias, chave id/int/incremental, timestamps habilitados e Fillable
somente nome. Exists false, ID/datas null; listener observou zero consultas SQL.
Código 0. A chamada foi feita somente no diagnóstico temporário, não nos testes
ou controllers do projeto.

Git diff --check passou; segredos continuam ignorados e fora do índice. Nenhuma
factory, relação ou novo registro. Suíte não repetida para classe ainda não usada
pelos cenários existentes; último resultado 6 testes/14 asserções é da 5.53.

## Continuidade

Entendimento da 5.62 confirmado. Publicar o checkpoint
e iniciar 5.63: demonstrar cadastro/leitura de Categoria em loja_test dentro de
transação com rollback, conferindo ID/datas e contagens, sem cadastro no banco normal.
