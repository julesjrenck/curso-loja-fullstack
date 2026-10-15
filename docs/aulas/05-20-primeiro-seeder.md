# Aula 5.20 — Estrutura do primeiro seeder

## Objetivo

Conhecer o lugar onde escreveremos o cadastro de um produto de demonstração.
A 5.19 foi confirmada com "entendi" em 15/10/2026 e publicada em 133591a,
SHA completo 133591af4ae4b7f63d982a3241bae67df3a07deb, conferido na main remota.

Migration descreve a estrutura da tabela. Model representa e consulta seus
registros. Seeder reúne instruções para cadastrar dados iniciais ou de
demonstração. O arquivo desta etapa ainda contém somente a estrutura da classe.

## Gerar o arquivo

Na raiz do projeto, executamos:

```bash
docker compose run --rm -T --no-deps --user "$(id -u):$(id -g)" --volume "$PWD/backend/database/seeders:/app/database/seeders:rw" backend php artisan make:seeder ProdutoSeeder --no-interaction
```

run inicia um container temporário do serviço backend; --rm remove esse
container ao terminar. -T dispensa terminal interativo; --no-deps não inicia
serviços relacionados. --user usa UID/GID do aluno para o arquivo ter o dono
correto. --volume permite escrita somente na pasta necessária, mantendo a
montagem geral do código como somente leitura. $PWD é a raiz atual do projeto.

php artisan make:seeder gera uma classe com o nome recebido, ProdutoSeeder;
--no-interaction dispensa perguntas do gerador. A saída confirmou criação em
database/seeders/ProdutoSeeder.php. Gerar esse arquivo não executa cadastros.

## Estrutura gerada

Arquivo backend/database/seeders/ProdutoSeeder.php:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}
```

namespace organiza a classe como Database\Seeders\ProdutoSeeder. O mapeamento
PSR-4 existente em backend/composer.json associa Database\Seeders\ à pasta
database/seeders/. O autoload já consegue encontrá-la, sem nova dependência.

use Illuminate\Database\Seeder importa a classe base. extends Seeder faz
ProdutoSeeder herdar os recursos de um seeder Laravel. O comentário em inglês
apenas descreve o método e não executa nenhuma ação.

public function run(): void declara o método que o Laravel chama ao executar
este seeder: public permite a chamada externa, run é o nome esperado e void
indica ausência de valor de retorno. Entre as chaves há somente //, um
comentário. Ainda não há instruções de cadastro nem import do model Produto.

O gerador também incluiu o import WithoutModelEvents. Apenas importar esse
nome não incorpora o trait na classe nem desliga eventos. Preservamos a
estrutura gerada; eventos serão aprofundados quando forem necessários.

DatabaseSeeder.php já veio no esqueleto como ponto de entrada padrão e pode
chamar outros seeders. Ele permanece intacto, com seu exemplo de User. Não
registramos ProdutoSeeder nele nem executamos o seeder padrão nesta etapa.

## Verificações

```bash
docker compose exec -T backend php -l /app/database/seeders/ProdutoSeeder.php
```

Sintaxe passou. Diagnóstico temporário em PHP Docker carregou o autoload,
inicializou Laravel e instanciou ProdutoSeeder. Conferiu herança de Seeder e,
com ReflectionMethod, run público, sem parâmetros e com retorno void.
Gerenciador do banco permaneceu sem conexões criadas. O diagnóstico não chamou
run. Não executamos db:seed, consultas ou gravações SQL.

Arquivo com modo 644 e dono 1000:1000; git diff --check passou. Demais arquivos
de código, dependências, serviços, credenciais e banco preservados.

## Continuidade

Estrutura implementada e explicação apresentada; verificações concluídas.
Entendimento da 5.20 confirmado com "entendi" em 15/10/2026. Checkpoint
preparado para publicação autorizada; último publicado 133591a.

Próximo passo: publicar 5.20 e iniciar 5.21, preencher run com o cadastro de um
produto usando Eloquent e explicar os campos e a persistência, sem executar
o seeder ainda.

Fonte consultada em 15/10/2026:

- [Seeders no Laravel 13](https://laravel.com/docs/13.x/seeding#writing-seeders).
