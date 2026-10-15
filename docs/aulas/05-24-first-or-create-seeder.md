# Aula 5.24 — Busca antes do cadastro no seeder

## Objetivo

Preparar a reexecução do seeder para reutilizar a Camiseta já cadastrada.
A 5.23 foi confirmada com "entendi" em 15/10/2026 e publicada em 11f46d2,
SHA completo 11f46d22361d28551ddf6165a8fff042b34a42e5, conferido na main remota.

## Alteração em backend/database/seeders/ProdutoSeeder.php

No método run, substituímos create por:

```php
Produto::firstOrCreate(
    ['nome' => 'Camiseta'],
    [
        'preco_em_centavos' => 4990,
        'status' => 'ativo',
    ]
);
```

Namespace, imports de App\Models\Produto e Seeder, herança e assinatura
public run(): void permanecem. O model, a tabela e a conexão são os mesmos.

## Dois arrays, duas funções

O primeiro argumento, ['nome' => 'Camiseta'], contém os atributos para procurar
um registro existente. O segundo contém dados adicionais usados para criar
um registro quando a busca não encontra nenhum.

Quando a chamada for executada, o Eloquent procurará o primeiro produto
correspondente ao nome Camiseta. Se encontrar, devolverá esse model. Não
inserirá outra linha nem atualizará preço/status com o segundo array.

Se não encontrar, combinará os atributos dos dois arrays e cadastrará nome
Camiseta, preco_em_centavos 4990 e status ativo. Nesse caminho, o SQL Server
gerará id e o Eloquent preencherá as datas como antes. O retorno também será
um model persistido; aqui não guardamos esse retorno em uma variável.

Preço continua sendo inteiro em centavos. Os atributos continuam compatíveis
com o model Produto e a migration. Não precisamos chamar save depois.

## Escolha do critério de busca

Usamos somente nome como critério didático para esta Camiseta de demonstração.
Preço e status não fazem parte da busca. Assim, se o produto existente tivesse
outro preço, ele ainda seria encontrado e seu preço seria preservado. Alterar
o segundo array não é uma instrução para atualizar registros existentes.

Se usássemos nome e preço juntos na busca, mudar o preço poderia fazer a
busca deixar de encontrar o registro anterior. Por isso separamos o critério
de busca dos valores adicionais para criação.

O nome não é uma identidade definitiva de produto: produtos podem ter nomes
iguais ou ser renomeados. Não adicionamos restrição unique nesta aula.
firstOrCreate não elimina duplicatas já existentes e, sem uma restrição única
adequada, não garante ausência de duplicação em execuções simultâneas.
Estamos preparando reexecuções sequenciais de um cadastro de demonstração.
Identificação estável e restrições serão tratadas com a modelagem pertinente.

## Verificação e alcance

Na raiz do projeto:

```bash
docker compose exec -T backend php -l /app/database/seeders/ProdutoSeeder.php
```

exec usa o container backend; -T dispensa terminal interativo. php -l verifica
a sintaxe sem executar o arquivo. Saída No syntax errors detected, código 0.
Revisão dos dois argumentos e atributos concluída; git diff --check passou.

Não executamos run, db:seed ou firstOrCreate nesta etapa, nem fizemos consulta
ou gravação SQL. A sintaxe válida não comprova o comportamento de reexecução;
ele será observado na etapa seguinte. Única mudança de código no seeder;
demais código, configuração/credenciais, dependências e serviços preservados.

## Continuidade

Alteração implementada e explicada; sintaxe conferida. Entendimento da 5.24
confirmado com "entendi" em 15/10/2026. Checkpoint preparado para publicação
autorizada; último publicado 11f46d2.

Próximo passo exato: publicar 5.24 e iniciar 5.25, executar
somente ProdutoSeeder em duas execuções sequenciais e comparar quantidade,
id, atributos e datas antes/depois, sem limpar dados ou alterar o produto.
Usar a conexão da aplicação na demonstração; testes de integração SQL terão
banco exclusivo. Não executar caminhos de criação com dados descartáveis em loja.

Fonte consultada em 15/10/2026:

- [Buscar ou criar models no Laravel 13](https://laravel.com/docs/13.x/eloquent#retrieving-or-creating-models).
