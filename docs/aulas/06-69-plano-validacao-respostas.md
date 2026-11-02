# Aula 6.69 — Plano para validar respostas do Laravel contra OpenAPI

Plano documentado, explicado e conferido por leitura em 01/11/2026, após
confirmação da 6.68 com "entendi" e publicação em
cde635101da1d72a2b76f9e12796a6d98cf0d07f. Entendimento da 6.69 confirmado
com "entendi" em 01/11/2026; publicação em preparação. Captura e integração ainda não implementadas.

## Da resposta produzida ao contrato

Até aqui, validamos exemplos escritos em [openapi.json](../api/openapi.json).
O próximo objetivo é obter um corpo produzido pelo Laravel num teste HTTP e
compará-lo com o schema da operação e do status esperados.

GetJson executa uma requisição simulada internamente pelo Laravel e devolve
TestResponse. Isso exercita a aplicação, sem uma chamada pela rede à porta
8002. A distinção está na [documentação de testes HTTP do Laravel](https://laravel.com/docs/13.x/http-tests).
Chamaremos essas saídas de respostas geradas pela aplicação em testes HTTP.

## Fluxo planejado

1. Executar um teste HTTP no container backend, usando o ambiente testing.
2. Conferir status e Content-Type com asserções do teste e obter o JSON retornado.
3. Salvar o corpo de uma execução bem-sucedida em uma captura local ignorada
   pelo Git, preservando a diferença entre objetos e listas JSON.
4. Criar em /tmp uma cópia completa do OpenAPI. Nela, substituir example da
   operação/status pelo corpo capturado, mantendo os schemas e components.
5. Validar essa cópia no Redocly em Docker, com a imagem e configuração atuais.

A regra [no-invalid-media-type-examples](https://redocly.com/docs/cli/rules/oas/no-invalid-media-type-examples)
compara o corpo inserido como exemplo com seu schema. Essa será a estratégia
para reutilizar a ferramenta já introduzida. A integração precisa ser
implementada e verificada; não foi executada nesta aula.

O teste confere status e cabeçalho. O Redocly confere o corpo inserido na cópia.
Asserções existentes sobre filtros, ordenação, valores e paginação continuam
necessárias: os schemas atuais não expressam todas essas regras de negócio.

## Isolamento e arquivos

Conferido por leitura no repositório:

- [phpunit.xml](../../backend/phpunit.xml) seleciona testing/sqlsrv/loja_test.
- [CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php) usa
  DatabaseTransactions e confere DB_NAME() igual a loja_test e SUSER_SNAME()
  igual a loja_testes antes de limpar produtos dentro da transação.
- O rollback desfaz as alterações de dados do teste. Casos de sucesso usarão o
  ID produzido pela factory; não dependerão de um ID fixo ou de reiniciar identity.
- [Compose](../../compose.yaml) monta backend/storage com escrita, enquanto
  o código da aplicação fica somente para leitura.
- Capturas planejadas em backend/storage/app/private/contratos ficam fora do Git,
  cobertas pelo [.gitignore existente](../../backend/storage/app/private/.gitignore).
  A leitura pelo validador ficará restrita aos arquivos necessários.

Essas são conferências de código/configuração, não novas consultas ao banco.
O banco normal loja não será usado nessa verificação. Nenhuma credencial será
colocada nas capturas ou no documento temporário.

O OpenAPI versionado permanece como fonte das regras. A cópia temporária
preserva components para resolver referências como $ref de Produto. O caminho
do contrato usa /api/v1/produtos/{id}, mesmo que a requisição use /api/v1/produtos/7.
Um status ou schema ausente deve interromper a verificação.

## Cobertura a construir gradualmente

| Operação no contrato | Status | Caso inicial de interesse |
| --- | --- | --- |
| GET /api/v1/produtos/{id} | 404 | Produto inexistente |
| GET /api/v1/produtos/{id} | 200 | Produto ativo criado por factory |
| GET /api/v1/produtos | 200 | Página de produtos ativos |
| GET /api/v1/produtos | 422 | Parâmetro inválido |

O primeiro caso será o 404 já coberto pelo teste de ID inexistente. A captura
será optativa, ativada explicitamente, e só será aproveitada se o teste passar.
Será necessário impedir uso de um arquivo antigo quando uma execução falhar
e recusar captura ausente, vazia ou JSON inválido. Depois verificaremos o
caminho completo com uma cópia adulterada do corpo, que deverá ser rejeitada.

Passar nesse fluxo comprovará os casos executados contra os schemas atuais.
Cobertura por rede, todos os cenários e conformidade completa da especificação
continuam além desse primeiro passo. A limitação de required false observada
na 6.64 permanece registrada; o documento mantém required true para id path.

## Verificação desta etapa e continuidade

Leitura de configuração/testes/volumes e fontes oficiais; conferidos os quatro
schemas da tabela e a regra de ignore do caminho planejado. Diff e links locais
conferidos. Sem capturas, pipeline, nova dependência, mudança de produção,
execução Docker, consulta SQL ou nova suíte nesta aula. Última suíte executada:
6.49, 66 testes/620 asserções.

Entendimento confirmado com "entendi" em 01/11/2026; publicar o checkpoint.
Próxima etapa, 6.70: preparar captura optativa do corpo 404 no teste HTTP de
produto inexistente, usando loja_test e um arquivo local ignorado pelo Git.
As etapas de cópia do contrato e validação do corpo capturado serão posteriores.
