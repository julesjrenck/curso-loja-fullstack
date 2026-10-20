# Aula 5.65 — Tentativa da FK e permissão REFERENCES

## Objetivo e resultado encontrado

O plano era aplicar a migration de categoria_id em loja_test e executar a suíte.
A tentativa em 20/10/2026 revelou uma permissão adicional necessária para a FK:
REFERENCES sobre categorias. Migration não aplicada; entendimento da descoberta
confirmado com "entendi" em 20/10/2026. Nenhum código da aplicação alterado.

A 5.64 foi confirmada com "entendi" e publicada em
e5e6156e28addc7f723d900d7953c20a267a9d8a. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Preparação e tentativa

O diagnóstico temporário /tmp/curso-565-conferir-categoria-id.php foi enviado
ao PHP Docker com --env=testing e --antes. Confirmou loja_test/loja_testes,
ALTER dbo permitido, coluna/FK ausentes, categorias/produtos vazios e duas
migrations. Consulta normal confirmou zero categorias, um produto e duas migrations.

Comando executado:

```bash
docker compose exec -T backend php artisan migrate \
  --env=testing --database=sqlsrv \
  --path=database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php \
  --no-interaction --no-ansi
```

Exec usa o backend iniciado; -T dispensa terminal interativo. --env seleciona
testing, --database escolhe sqlsrv configurado para loja_test, e --path limita
ao arquivo. --no-interaction dispensa perguntas e --no-ansi remove cores.

Migrate terminou com código 1: REFERENCES permission denied em categorias,
durante o ALTER TABLE que criaria produtos_categoria_id_foreign.
Os comandos seguintes estavam ligados por &&, portanto a falha impediu sua
execução. A suíte planejada NÃO foi executada.

## Significado da permissão

ALTER permite alterar a tabela do lado do produto. Para criar a chave estrangeira,
SQL Server também exige autorização para referenciar a tabela de destino,
categorias. Essa autorização é REFERENCES; ler categorias com SELECT ou poder
criar tabelas não substitui essa permissão.

Podemos conceder REFERENCES apenas em dbo.categorias ao usuário loja_testes
no banco loja_test, sem atribuir funções amplas de administrador. Essa concessão
ainda não foi preparada ou executada nesta etapa. A conta loja_migracoes no banco
normal também precisará ser tratada antes da futura aplicação ali.

## Conferências após a falha

Repetimos o diagnóstico --antes: coluna categoria_id e FK continuam ausentes;
categorias/produtos vazios e duas migrations. A tentativa não deixou alteração
parcial aplicada. Migrate:status com o mesmo ambiente/conexão/path mostrou Pending:
Laravel não registrou esse arquivo como aplicado.

Leituras com cada conta confirmaram:

```sql
SELECT HAS_PERMS_BY_NAME('dbo.categorias', 'OBJECT', 'REFERENCES');
```

Resultado 0 para loja_testes em loja_test e para loja_migracoes em loja.
As consultas foram enviadas diretamente à entrada padrão do PHP Docker,
inicializando Laravel no ambiente/conexão correspondente. Nenhum GRANT executado.

Banco normal segue zero categorias/um produto/duas migrations. Git diff --check
passou; segredos locais continuam ignorados e fora do índice. Último resultado
de suíte 6 testes/14 asserções é da 5.53, não desta tentativa.

## Continuidade

Entendimento da descoberta 5.65 confirmado. Publicar
o checkpoint e iniciar 5.66: preparar SQL público de GRANT REFERENCES limitado
a loja_test.dbo.categorias para loja_testes, explicando o escopo sem executar ainda.
Aplicar concessão, repetir migration e executar suíte permanecem pendentes para
as etapas seguintes.
