# Aula 5.63 — Cadastro e leitura de Categoria com rollback

## Objetivo e estado

Salvar uma categoria pelo Eloquent e buscá-la pela chave primária, no banco de
testes e dentro de transação desfeita ao terminar. Execução, explicação e
verificações em 20/10/2026; entendimento confirmado com "entendi" na mesma data.
Nenhum código da aplicação alterado nesta etapa.

A 5.62 foi confirmada com "entendi" e publicada em
e57dbbe889c9dd8c7360c69ce9737a5fd203d679. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Local e execução da demonstração

O script temporário /tmp/curso-563-cadastrar-categoria.php foi enviado ao PHP
Docker pela entrada padrão:

```bash
docker compose exec -T backend php /dev/stdin --env=testing < /tmp/curso-563-cadastrar-categoria.php
```

Exec executa no backend iniciado; -T dispensa terminal interativo. O shell lê
o arquivo do host com <; PHP o recebe por /dev/stdin. Laravel lê --env=testing
ao inicializar e seleciona o ambiente de testes.

Antes de escrever, o script conferiu testing/sqlsrv, loja_test/loja_testes,
categorias e produtos vazios, duas migrations e nenhuma transação aberta.
O trecho central, depois das checagens, foi:

```php
$conexao->beginTransaction();
try {
    $categoria = Categoria::create(['nome' => 'Roupas']);
    $lida = Categoria::findOrFail($categoria->id);

    // O diagnóstico confere os objetos e a linha durante a transação.
} finally {
    $conexao->rollBack();
}
```

$conexao é a conexão sqlsrv conferida como loja_test. Create usa Fillable para
preencher nome, insere o registro e devolve o model persistido. SQL Server gera
o ID e Eloquent preenche created_at/updated_at. Não é necessário save adicional.

FindOrFail consulta pela chave primária, usando o ID do registro cadastrado;
retorna um model ou lança uma exceção se não houver registro correspondente.
A leitura devolveu outro objeto Categoria, com o mesmo ID e nome do cadastrado.
O script não acrescentou essas chamadas a testes ou controllers do projeto.

Finally fez rollback. Esse isolamento foi acrescentado na demonstração:
create sozinho normalmente deixa o registro salvo.

## Verificações e resultados

Um listener observou um INSERT na tabela categorias. Durante a transação houve
uma linha; a amostra tinha nome Roupas e ID 1, exists true e datas preenchidas.
Id é gerado: o exemplo não exige que sempre seja 1, nem promete reutilização
de identidades após rollback.

Depois do rollback, zero categorias/zero produtos, duas migrations e zero
transações abertas. Código 0. Consultas separadas pelo script temporário
/tmp/curso-563-resumo-bancos.php, com e sem --env=testing, confirmaram:

| Banco/login | Categorias | Produtos | Migrations |
| --- | --- | --- | --- |
| loja_test/loja_testes | 0 | 0 | 2 |
| loja/loja_app | 0 | 1 | 2 |

Nenhum cadastro foi feito no banco normal, apenas SELECTs de conferência.
Git diff --check passou; segredos continuam ignorados e fora do índice.
Nenhuma migration, factory, relação ou serviço novo. Suíte não repetida após
esta demonstração dirigida; último 6 testes/14 asserções pertence à 5.53.

## Continuidade

Entendimento da 5.63 confirmado. Publicar o checkpoint
e iniciar 5.64: preparar migration para categoria_id anulável em produtos com
chave estrangeira para categorias, explicar regra de exclusão/preservação dos
produtos existentes e conferir sem aplicar ainda.
