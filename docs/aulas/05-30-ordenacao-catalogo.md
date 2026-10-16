# Aula 5.30 — Ordenação dos nomes do catálogo

## Objetivo

Pedir ao banco os nomes do catálogo em ordem crescente.
A 5.29 foi confirmada com "entendi" em 16/10/2026 e publicada em 7199685,
SHA completo 7199685ec8b6c7b9836535c2f91010c1dcbf7e96, conferido na main remota.

## Alteração em backend/app/Services/CatalogoEloquent.php

```php
public function listarNomes(): array
{
    return Produto::query()
        ->where('status', 'ativo')
        ->orderBy('nome')
        ->pluck('nome')
        ->all();
}
```

Acrescentamos somente orderBy('nome') entre o filtro e a execução da consulta.
O argumento nome é a coluna usada para ordenar. Sem segundo argumento,
o Laravel usa asc, direção crescente. Equivale a orderBy('nome', 'asc').
desc seria a direção decrescente, sem alteração para essa direção nesta aula.

where define quais registros entram: os ativos. orderBy define a ordem
dos resultados. pluck executa a consulta com filtro e ordenação e reúne os
nomes; all entrega o array esperado pelo controller. A view apresenta esse
array na ordem recebida, pelo @foreach existente.

Por exemplo, numa lista hipotética com Boné, Camiseta e Tênis, a direção
crescente apresenta esses nomes nessa sequência. Esse exemplo não foi
cadastrado no banco da loja. A leitura real continua contendo só Camiseta.

## SQL observado

```sql
select [nome] from [produtos] where [status] = ? order by [nome] asc
```

O parâmetro continua ativo. ORDER BY informa a coluna nome e ASC indica
a direção crescente. O SQL Server entrega os nomes ordenados na consulta;
o código PHP não precisa ordenar o array depois.

## Verificações e alcance

Na raiz:

```bash
docker compose exec -T backend php -l /app/app/Services/CatalogoEloquent.php
```

exec usa o container backend, -T dispensa terminal interativo e php -l
confere a sintaxe sem executar o arquivo. Sintaxe passou, código 0.

Diagnóstico temporário em PHP Docker resolveu CatalogoEloquent, conferiu
banco loja/login loja_app, retorno ['Camiseta'] e exatamente uma consulta
capturada por QueryExecuted, com SQL acima e bindings ['ativo'].

Requisição HTTP real ao servidor ativo em http://127.0.0.1:8000/loja conferiu
status 200, um li Camiseta, title Loja Fullstack, h2 Catálogo de produtos e
X-Curso Laravel. Diagnóstico terminou código 0.

Com um único produto, não observamos mudança visual de posição entre nomes.
Conferimos a cláusula ORDER BY no SQL executado. Ordenação de vários produtos,
exclusão de inativos e lista vazia serão exercitadas com dados isolados nos
testes SQL de integração. Não inserimos dados descartáveis na loja.

git diff --check passou. Mudança de código restrita à linha orderBy do serviço.
Contrato, model, binding, controller, view, comandos, seeders, migrations,
configuração/credenciais, dependências e serviços preservados. Somente leitura.

## Continuidade

Ordenação implementada e explicada; sintaxe, SQL e HTTP conferidos.
Entendimento da 5.30 confirmado com "entendi" em 16/10/2026. Checkpoint
preparado para publicação autorizada; último publicado 7199685.

Próximo passo exato: publicar 5.30 e iniciar 5.31,
diagnosticar ferramentas de teste do backend, composer.lock/vendor,
phpunit.xml e situação do banco loja_test/isolamento. Explicar o que falta
para testar ativos, inativos, ordenação e lista vazia em banco exclusivo.
Não instalar dependências, configurar testes ou criar contas nessa preparação.

Fonte consultada em 16/10/2026:

- [Ordenação de consultas no Laravel 13](https://laravel.com/docs/13.x/queries#ordering).
