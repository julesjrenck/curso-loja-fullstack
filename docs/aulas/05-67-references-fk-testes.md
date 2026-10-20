# Aula 5.67 — REFERENCES e FK aplicadas no banco de testes

## Objetivo e estado

Aplicar a permissão preparada e concluir a migration que falhou na 5.65.
Aplicação, explicação e verificações em 20/10/2026; entendimento confirmado
com "entendi" na mesma data. Nenhum código da aplicação alterado nesta etapa.

A 5.66 foi confirmada com "entendi" e publicada em
39246132a84eb2b331cfa828e13a2454a3067f28. HEAD, origin/main e consulta direta
à main remota devolveram esse SHA após o push.

## Concessão real

Antes, o diagnóstico --antes da 5.65 confirmou loja_test/loja_testes, coluna/FK
ausentes e categorias/produtos vazios, duas migrations. Depois executamos:

```bash
docker compose exec -T sqlserver sh -c 'export SQLCMDPASSWORD="$MSSQL_SA_PASSWORD"; exec /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -C -b -l 5' < docker/sqlserver/conceder-references-categorias-testes.sql
```

Exec usa o serviço SQL Server iniciado. O shell interno fornece a senha existente
por SQLCMDPASSWORD, sem imprimi-la. Sqlcmd recebe servidor/login, confiança no
certificado local, falha em erro e tempo de login de cinco segundos. O arquivo
é enviado pelo shell do host com <. A diferença para 5.66 é executar diretamente
o script público, sem envolver suas instruções em PARSEONLY.

Sqlcmd processou USE/GO e executou GRANT. Código 0, contexto loja_test confirmado.
O script só concede REFERENCES em dbo.categorias ao usuário loja_testes.

O diagnóstico temporário /tmp/curso-567-conferir-references.php, enviado ao PHP
Docker com --env=testing, autenticou como loja_testes e conferiu:

- HAS_PERMS_BY_NAME para REFERENCES em categorias: 1;
- sys.database_permissions: GRANT explícito no objeto para loja_testes.

Código 0. Essa leitura confere a permissão pela identidade que fará a migration.

## Migration e suíte

```bash
docker compose exec -T backend php artisan migrate \
  --env=testing --database=sqlsrv \
  --path=database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php \
  --no-interaction --no-ansi
```

Exec usa o backend; ambiente testing seleciona .env.testing, sqlsrv aponta para
loja_test/loja_testes, --path limita ao arquivo e as opções finais dispensam
perguntas/cores. Migration DONE, código 0. Migrate:status com os mesmos parâmetros
mostrou [3] Ran. O registro agora existe em migrations no lote 3.

```bash
docker compose exec -T backend php vendor/bin/phpunit --testdox --colors=never --do-not-cache-result
```

PHP executa o PHPUnit instalado; --testdox apresenta cenários, --colors=never
remove cores e --do-not-cache-result evita cache no código somente para leitura.
Resultado: OK (6 tests, 14 assertions), código 0. Os cadastros atuais continuam
funcionando sem categoria. A suíte ainda não verifica IDs de categoria inválidos
ou exclusão de categoria em uso; essas verificações serão introduzidas depois.

## Metadados e contagens

O diagnóstico da 5.65, agora no modo posterior, confirmou:

- produtos.categoria_id como BIGINT, aceita NULL e não é IDENTITY;
- produtos_categoria_id_foreign referencia dbo.categorias.id;
- ações DELETE/UPDATE NO_ACTION;
- is_disabled/is_not_trusted 0/0, restrição habilitada e validada;
- migrations de produtos lote 1, categorias lote 2 e categoria_id lote 3.

Consultas separadas pelo diagnóstico de contagens confirmaram após a suíte:

| Banco | Categorias | Produtos | Migrations | categoria_id existe? |
| --- | --- | --- | --- | --- |
| loja_test | 0 | 0 | 3 | Sim |
| loja | 0 | 1 | 2 | Não |

O diagnóstico de permissão no ambiente normal também confirmou REFERENCES 0
para loja_migracoes. Nenhuma concessão ou migration foi aplicada em loja nesta
etapa. Git diff --check passou; segredos continuam ignorados e fora do índice.

## Continuidade

Entendimento da 5.67 confirmado. Publicar o checkpoint
e iniciar 5.68: preparar/aplicar GRANT REFERENCES somente em loja.dbo.categorias
para loja_migracoes, aplicar a mesma migration por sqlsrv_migracoes e conferir
produto existente preservado com categoria_id NULL.
