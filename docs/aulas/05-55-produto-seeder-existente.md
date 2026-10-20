# Aula 5.55 — Revisão do ProdutoSeeder existente

## Objetivo e correção do plano

Relacionar o seeder real da loja com o DatabaseSeeder apresentado. Explicação e
verificação em 19/10/2026; entendimento confirmado com "entendi" na mesma data.

A 5.54 foi confirmada com "entendi" após nova explicação e publicada em
def2f14508754ed2d6e9fafb290f4378a5de87c3. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

O próximo passo previa gerar ProdutoSeeder, mas a inspeção mostrou que ele já
existe: gerado na 5.20 (e811031), preenchido na 5.21 (9da189c) e ajustado com
firstOrCreate na 5.24 (162b7aa). O plano estava incorreto; preservamos o arquivo
e revisamos seu papel em relação ao DatabaseSeeder. Nenhum comando de geração
foi executado, nenhum código alterado e nenhum cadastro repetido.

## Código existente

backend/database/seeders/ProdutoSeeder.php contém:

```php
namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::firstOrCreate(
            ['nome' => 'Camiseta'],
            [
                'preco_em_centavos' => 4990,
                'status' => 'ativo',
            ]
        );
    }
}
```

Namespace organiza a classe, os imports permitem usar Produto e Seeder pelos
nomes curtos, e extends Seeder fornece o suporte de execução do Laravel.
Run reúne a rotina de cadastro, com retorno void.

O primeiro array de firstOrCreate indica a busca por nome Camiseta. Se houver
um produto correspondente, ele será retornado sem atualizar preço/status.
Se não houver, Laravel combina os dois arrays e cadastra Camiseta com preço
4990 centavos e status ativo. A rotina usa Eloquent diretamente; factory é uma
possibilidade para seeders, não uma exigência. Os limites da busca por nome e
de execuções concorrentes continuam os explicados na aula 5.24.

## Relação com DatabaseSeeder

DatabaseSeeder ainda contém o exemplo de User apresentado na 5.54. Ele não
chama ProdutoSeeder. Laravel não executa automaticamente todos os arquivos
existentes em database/seeders.

Nas aulas 5.22/5.25, a seleção foi feita explicitamente com db:seed e a opção
--class=ProdutoSeeder. O padrão DatabaseSeeder não foi usado nessas execuções.
Esses são fatos históricos; não executamos db:seed novamente nesta etapa.

Na próxima etapa, faremos DatabaseSeeder chamar ProdutoSeeder para que a
entrada padrão de seeding corresponda ao catálogo da loja.

## Verificação

```bash
docker compose exec -T backend php -l database/seeders/ProdutoSeeder.php
```

Exec usa o serviço backend iniciado, -T dispensa terminal interativo e php -l
confere sintaxe sem executar run. Resultado: No syntax errors detected,
código 0. Aulas 5.20, 5.24 e 5.25 e histórico do arquivo foram consultados.

Nenhuma consulta SQL, escrita de dados ou execução de seeder. Suíte não repetida
para leitura/documentação; último resultado 6 testes/14 asserções é da 5.53.
Git diff --check passou; credenciais locais continuam ignoradas e fora do índice.

## Continuidade

Entendimento da 5.55 confirmado. Publicar o checkpoint
e iniciar 5.56: substituir o exemplo de User em DatabaseSeeder por chamada a
ProdutoSeeder com call, explicando o encadeamento sem executar db:seed ainda.
