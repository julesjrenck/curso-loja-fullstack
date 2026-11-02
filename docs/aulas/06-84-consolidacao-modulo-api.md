# Aula 6.84 — Consolidação do módulo de APIs REST

Consolidação, explicação e verificação em 01/11/2026 após confirmação da 6.83
com "entendi" e publicação em af5cfbd400a118407798f53595163d6ecb9c763f.
Entendimento da 6.84 confirmado com "entendi" em 01/11/2026; módulo 6 concluído.
Publicação da 6.84 em preparação.
Nenhum outro módulo foi iniciado nesta etapa.

## Entrega atual

Construímos uma API pública de leitura do catálogo, sob /api/v1, com listagem
paginada, filtro por nome e consulta de produto ativo pelo ID. As duas rotas
estão em [api.php](../../backend/routes/api.php), com prefixo e tratamento JSON
configurados no [bootstrap](../../backend/bootstrap/app.php).

| Parte | Responsabilidade implementada | Arquivo principal |
| --- | --- | --- |
| Entrada | Validar page/nome e fornecer valores validados | [ListarProdutosRequest](../../backend/app/Http/Requests/ListarProdutosRequest.php) |
| Coordenação | Chamar catálogo, preservar nome nos links e escolher respostas | [ProdutoController](../../backend/app/Http/Controllers/Api/V1/ProdutoController.php) |
| Consulta | Selecionar ativos, filtrar, ordenar, paginar ou buscar por ID | [CatalogoEloquent](../../backend/app/Services/CatalogoEloquent.php) |
| Apresentação | Expor id/nome/preco_em_centavos de cada produto | [ProdutoResource](../../backend/app/Http/Resources/ProdutoResource.php) |
| Descrição | Documentar operações, parâmetros, schemas e exemplos | [OpenAPI](../api/openapi.json) e [contrato em português](../api/catalogo.md) |
| Verificação | Conferir comportamentos e comparar quatro corpos aos schemas | [CatalogoApiTest](../../backend/tests/Feature/CatalogoApiTest.php) e [script conjunto](../../scripts/validar-contratos-catalogo.sh) |

O FormRequest valida antes do corpo de index. O catálogo retorna resultados;
o Resource apresenta os produtos; a infraestrutura paginada organiza
links/meta. Na consulta individual, show escolhe ProdutoResource ou JSON 404
conforme Produto/null. Essas responsabilidades foram revisadas e confirmadas
nas aulas [6.80](06-80-revisao-requisicao-invalida.md),
[6.81](06-81-revisao-listagem-valida.md),
[6.82](06-82-revisao-consulta-individual.md) e
[6.83](06-83-revisao-filtro-nome.md).

## Contratos que já descrevemos

| Operação | Status | Corpo documentado |
| --- | --- | --- |
| GET /api/v1/produtos | 200 | data lista, links e meta da paginação |
| GET /api/v1/produtos | 422 | message texto e errors por campo, com listas de mensagens |
| GET /api/v1/produtos/{id} | 200 | data objeto com Produto |
| GET /api/v1/produtos/{id} | 404 | message texto |

A listagem seleciona ativos e usa nome/id para ordenar. Page ausente significa 1;
quando informado, aceita decimal canônico de 1 a 1000000. Nome é opcional e,
quando enviado, precisa ser texto não vazio de até 100 caracteres após a
normalização. O trecho literal é aplicado antes de contar e paginar; o nome
validado é preservado nos links. A capacidade é 10 produtos por página.

Na consulta individual, o ID precisa ter formato e faixa aceitos. Um ativo
produz 200; produto inexistente/inativo ou identificador inválido resulta 404.
O texto do 404 de roteamento pode variar. Preço permanece inteiro em centavos;
IDs de fixtures vêm das factories e não são fixados como expectativa dos testes.

## Verificação renovada nesta consolidação

Executamos em Docker:

```sh
docker compose exec -T backend php artisan route:list --path=api/v1 --no-ansi
docker compose exec -T backend php artisan test --do-not-cache-result
bash scripts/validar-contratos-catalogo.sh
```

Route:list mostrou duas entradas GET|HEAD, apontando para index e show. A suíte
Laravel passou com 66 testes/620 asserções, código 0, sem flags de captura.
Conferimos hashes antes/depois: preservou as quatro capturas preexistentes.
O comando conjunto depois renovou as capturas e passou:

| Caso | Teste focado | Validação |
| --- | --- | --- |
| Consulta 200 | 1/7 | Código 0 |
| Consulta 404 | 1/7 | Código 0 |
| Listagem 200 | 1/14 | Código 0 |
| Listagem 422 | 1/9 | Código 0 |

O processo conjunto terminou 0 e anunciou os quatro casos validados. São
execuções complementares: a suíte verifica comportamentos e o script compara
os corpos selecionados aos schemas numa cópia temporária integral. O roteiro
de execução está no [README](../../README.md#verificar-o-backend-e-os-contratos-da-api).
PHP/testes/Redocly continuam em Docker, com Bash coordenando no host.

As capturas foram lidas por PHP Docker, conferindo JSON, campos, hashes e
64/42/586/105 bytes respectivamente. A suíte comum não grava capturas; o fluxo
optativo de contratos exige captura atual após teste bem-sucedido. Os arquivos
privados permanecem ignorados e os temporários foram removidos. .env da raiz,
backend/.env e backend/.env.testing também continuam ignorados, sem credenciais
incluídas nesta etapa.

SELECTs antes/depois, com identidades conferidas: loja/loja_app 0 categorias/
1 produto; loja_test/loja_testes 0 categorias/0 produtos. As transações desfazem
as fixtures; arquivos de captura permanecem fora da transação. Diff e links
conferidos. Código de aplicação, scripts, OpenAPI/configuração, Compose, README
e dependências permaneceram como estavam. Acrescentamos esta aula e os registros.

## Alcance, pendências e continuidade

As verificações demonstram os comportamentos testados e a compatibilidade dos
quatro corpos selecionados com os schemas atuais. Outros corpos possíveis não
são todos submetidos ao fluxo de contratos. Na
[aula 6.64](06-64-consulta-id-openapi.md), uma cópia com required false no parâmetro
id passou no lint: limitação observada do validador/configuração. O documento
original mantém required true; o sucesso da ferramenta complementa a leitura
do contrato e os testes. Não adicionamos outro validador nesta consolidação.

As operações HTTP de cadastro/edição/exclusão ficam para etapas futuras.
Autenticação/autorização correspondem ao módulo 7 do
[roteiro](../curso.md); não foram iniciadas. O catálogo de leitura está
implementado e as revisões até 6.83 têm confirmação registrada do aluno.
O exercício sugerido no DBeaver continua sem relato; permanece como atividade
sugerida de acompanhamento.

| Registro | Estado em 01/11/2026 |
| --- | --- |
| Implementação da API de leitura | Existente, documentada e verificada |
| Entendimento das etapas até 6.83 | Confirmado conforme progresso |
| Entendimento desta consolidação 6.84 | Confirmado com "entendi" em 01/11/2026; módulo 6 concluído |
| Publicação da 6.83 | Verificada no SHA informado no início |
| Publicação da 6.84 | Em preparação |
| Continuidade do curso | A definir com o aluno após publicar este checkpoint |

Confirmação registrada em 01/11/2026; módulo 6 concluído. Publicar a 6.84 e
registrar o resultado. A próxima etapa será definida com o aluno; não iniciar outro módulo por conta própria,
conforme [AGENTS.md](../../AGENTS.md). Não há etapa 6.85 ou módulo 7 iniciado
automaticamente por esta consolidação.
