# Curso prático: loja com Laravel, React, Next.js e microsserviços

## Objetivo

Construir juntos uma loja com catálogo, carrinho, pedidos, estoque e notificações,
do primeiro container até uma aplicação distribuída na AWS. O curso aproveita o
conhecimento de PHP do aluno e aprofunda Laravel, integração com frontend,
arquitetura, testes e operação. Cada tecnologia entra para resolver um problema
concreto. Não há prazo fixo: cada módulo pode ocupar vários chats.

## Como serão as aulas

Não avançaremos sem confirmação de entendimento da etapa atual.

1. Explicar o objetivo e o problema a resolver.
2. Apresentar o conceito necessário, usando referências de PHP quando útil.
3. Criar ou modificar um arquivo ou um pequeno conjunto inseparável.
4. Explicar cada arquivo, seus trechos e suas relações com o projeto.
5. Executar a verificação e interpretar o resultado.
6. Responder às dúvidas e propor uma pequena experiência quando ajudar.
7. Registrar o progresso e publicar checkpoints concluídos no GitHub.

O professor escreve o código com o aluno acompanhando. Exercícios consolidam
o entendimento sem exigir implementação solitária. Arquivos gerados serão
apresentados e aprofundados conforme usados; dependências externas não serão
estudadas arquivo por arquivo. Testes e boas práticas entram desde as primeiras
funcionalidades e recebem aprofundamento em módulos específicos.

## Módulos

Todos os módulos abaixo são planejados, não funcionalidades já implementadas.
Os módulos 1 a 5 foram concluídos, com entendimento da revisão 5.92 confirmado
em 21/10/2026. Os registros abaixo descrevem o percurso do módulo 5.
O módulo 5 confirmou e publicou a descoberta de pacotes da 5.33.
Na 5.34, script de loja_testes em loja_test preparado e analisado com PARSEONLY,
sem executar as instruções de criação/concessão. Ausência da conta e de tabelas
conferida depois. Revisão retomada e entendimento da 5.34 confirmado com
"entendi" em 19/10/2026; confirmação publicada em 49a22c5.
Na 5.35, senha local preparada e conta loja_testes criada em loja_test;
autenticação, permissões, ausência de acesso a loja e reexecução verificadas.
Banco de testes continua sem tabelas. Explicação apresentada; entendimento da
5.35 confirmado com "entendi" em 19/10/2026 e publicado em 04a9a7c.
Na 5.36, backend/.env.testing.example preparado e analisado com phpdotenv;
modelo público versionável, arquivos locais com segredos continuam ignorados.
Explicação apresentada; entendimento da 5.36 confirmado com "entendi" em
19/10/2026 e publicado em 1c8c380. Na 5.37, .env.testing local criado com chave
própria e senha existente de loja_testes; carregamento, criptografia e SELECT
Laravel em loja_test conferidos. Ambiente normal segue loja/loja_app.
Entendimento da 5.37 confirmado com "entendi" em 19/10/2026 e publicado em d80d241.
Na 5.38, phpunit.xml passou a sqlsrv/loja_test; XSD, variáveis pelo carregador
real PHPUnit e SELECT Laravel conferidos, sem executar a suíte. Entendimento
da 5.38 confirmado com "entendi" em 19/10/2026 após esclarecer APP_ENV,
publicado em 734fc5f. Na 5.39, dois testes de exemplo apresentados e executados:
2 testes/2 asserções passaram, sem código alterado. Não consultam SQL nem
verificam catálogo; SELECT separado confirmou zero tabelas em loja_test.
Entendimento da 5.39 confirmado com "entendi" em 19/10/2026 e publicado em bdfb1a3.
Na 5.40, migration existente de produtos aplicada somente em loja_test:
produtos vazia e migrations com lote 1. Esquema/status/reexecução conferidos;
banco normal segue loja/loja_app com um produto. Entendimento da 5.40 confirmado
com "entendi" em 19/10/2026 e publicado em b70f6f0. Na 5.41, primeiro teste
de integração para catálogo vazio criado com DatabaseTransactions. Focado:
1 teste/3 asserções; suíte: 3 testes/5 asserções, passaram. SELECT posterior
confirmou zero produtos em loja_test e um em loja. Entendimento da 5.41
confirmado com "entendi" em 19/10/2026 e publicado em 94e4e3d. Na 5.42, setUp
compartilhado e cenário de produto ativo preparados. Focado: 2 testes/6 asserções;
suíte em ordem inversa: 4 testes/8 asserções, passaram. Zero produtos em loja_test
após rollback. Entendimento da 5.42 confirmado com "entendi" em 19/10/2026 e
publicado em aa8e5a4. Na 5.43, cenário com ativo/inativo exige somente o ativo:
focado 3 testes/9 asserções e suíte 5 testes/11 asserções, passaram. Zero produtos
em loja_test após rollback. Entendimento da 5.43 confirmado com "entendi" em
19/10/2026 e publicado em 62f465e. Na 5.44, cenário de ordenação de dois ativos
adicionado; focado 4 testes/12 asserções e suíte 6 testes/14 asserções, passaram.
Entendimento da 5.44 confirmado com "entendi" em 19/10/2026 e publicado em 5810b26.
Na 5.45, estrutura de ProdutoFactory gerada; sintaxe/autoload/herança/modelName
conferidos, definition vazio e nenhum dado criado. Entendimento da 5.45
confirmado com "entendi" em 19/10/2026 e publicado em 3e094e5. Na 5.46,
definição preenchida com nome/preço fictícios e status ativo; dez arrays
conferidos em memória, sem SQL ou models. Entendimento da 5.46 confirmado com
"entendi" após esclarecer os métodos e publicado em 77dc3f9. Na 5.47,
new()->make() montou Produto em memória, com exists false, ID/datas null,
atributos previstos e zero SQL. Entendimento da 5.47 confirmado com "entendi"
em 19/10/2026 e publicado em d90a8a4. Na 5.48, HasFactory adicionado a Produto;
atalho factory()->make conferido em memória, zero SQL. Suíte existente:
6 testes/14 asserções, passou. Entendimento da 5.48 confirmado com "entendi"
em 19/10/2026, após esclarecer o local da demonstração, publicado em d465778.
Na 5.49, factory()->create aplicada somente ao cadastro do teste de ativo:
nome/status sobrescritos, preço padrão. Teste 1/3 e suíte 6/14 passaram;
rollback conferido. Entendimento da 5.49 confirmado com "entendi" em 19/10/2026,
publicado em 9a08b80. Na 5.50, dois cadastros do cenário ativo/inativo usam
factory com nome/status explícitos e preço padrão. Teste 1/3 e suíte 6/14
passaram; rollback conferido. Entendimento da 5.50 confirmado com "entendi" em
19/10/2026, publicado em 10e723b. Na 5.51, factory nos dois cadastros do cenário
de ordenação, preservando nomes, status e ordem de inserção; teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.51 confirmado com "entendi"
em 19/10/2026, publicado em 5152ba4. Na 5.52, inativo(): static na factory usa
state com array; diagnóstico com make conferiu inativo em memória, padrão ativo
preservado e zero SQL. Suíte existente 6/14 passou. Entendimento da 5.52
confirmado com "entendi" em 19/10/2026, publicado em edd3411. Na 5.53, cadastro
da Caneca no teste usa inativo()->create com nome explícito. Teste 1/3 e suíte
6/14 passaram, rollback conferido. Entendimento da 5.53 confirmado com "entendi"
em 19/10/2026, publicado em 6ac5518. Na 5.54, DatabaseSeeder existente apresentado
sem execução; sintaxe/reflexão e SELECTs passaram. Rotina padrão cria usuário,
depende de users, tabela ainda ausente nos dois bancos. Explicadas diferenças
entre migration/factory/seeder. Entendimento da 5.54 confirmado com "entendi"
em 19/10/2026, após nova explicação com exemplo da loja, publicado em def2f14.
Na 5.55, corrigida previsão de gerar ProdutoSeeder: já existe desde a 5.20,
com firstOrCreate desde a 5.24. Arquivo preservado/revisado em relação ao
DatabaseSeeder; sintaxe passou, sem execução. Entendimento da 5.55 confirmado
com "entendi" em 19/10/2026, publicado em 0f754ae. Na 5.56, DatabaseSeeder chama
ProdutoSeeder por call; exemplo de User removido. Sintaxe/autoload passaram,
sem executar seeders. Entendimento da 5.56 confirmado com "entendi" em 19/10/2026,
publicado em 07af123. Na 5.57, db:seed padrão executado em loja_test dentro de
transação: chamou ProdutoSeeder, criou Camiseta e catálogo retornou seu nome.
Rollback/contagens conferidos: teste com zero produtos, normal com um.
Entendimento da 5.57 confirmado com "entendi" em 19/10/2026, publicado em 5c65e6d.
Na 5.58, modelagem inicial categorias/produtos: um para muitos, chave primária
e estrangeira explicados com exemplos ilustrativos, sem alterar código/esquema.
Entendimento da 5.58 confirmado com "entendi" em 20/10/2026, publicado em f680b99.
Na 5.59, migration de categorias gerada com id, nome string(150) e timestamps(3);
sintaxe passou, sem aplicar. Entendimento da 5.59 confirmado com "entendi" em
20/10/2026, publicado em 9e89010. Na 5.60, migration aplicada somente em loja_test;
esquema/status [2] Ran/reexecução conferidos, categorias e produtos vazios.
Banco normal mantém um produto e uma migration. Entendimento da 5.60 confirmado
em 20/10/2026, publicado em 04ab6bb. Na 5.61, mesma migration aplicada em loja com
loja_migracoes; esquema/status/reexecução e produto preservado conferidos.
Categorias vazia nos dois bancos, duas migrations em cada. Entendimento da 5.61
confirmado com "entendi" em 20/10/2026, publicado em 4d3358d. Na 5.62, model
Categoria criado com Fillable de nome; tabela/chave/timestamps e objeto em memória
conferidos, zero SQL. Entendimento da 5.62 confirmado com "entendi" em 20/10/2026,
publicado em e57dbbe. Na 5.63, create/findOrFail de categoria em loja_test
conferidos com ID/datas, transação desfeita e contagens finais preservadas.
Entendimento da 5.63 confirmado com "entendi" em 20/10/2026, publicado em ce67886.
Na 5.64, migration de categoria_id anulável/FK em produtos preparada, com
noActionOnDelete e reversão da FK/coluna. Sintaxe passou, sem aplicar.
Entendimento da 5.64 confirmado com "entendi" em 20/10/2026, publicado em e5e6156.
Na 5.65, tentativa de aplicação em loja_test falhou por REFERENCES negado em
categorias; coluna/FK ausentes e Pending confirmados após falha. Suíte planejada
não executada. Entendimento da descoberta confirmado com "entendi" em 20/10/2026,
publicado em 91ed884. Na 5.66, script de GRANT REFERENCES restrito a categorias
em loja_test preparado; PARSEONLY passou, permissão continua 0 e migration Pending.
Entendimento da 5.66 confirmado com "entendi" em 20/10/2026, publicado em 3924613.
Na 5.67, concessão aplicada no teste, REFERENCES 1 e FK criada: categoria_id
BIGINT NULL, referência a categorias.id/NO_ACTION, histórico lote 3 conferidos.
Suíte 6/14 passou; teste vazio após testes. Normal segue sem coluna/permissão.
Entendimento da 5.67 confirmado com "entendi" em 20/10/2026, publicado em e384ae1.
Na 5.68, concessão/migration aplicadas em loja com loja_migracoes; FK/histórico e
produto preservado com categoria_id NULL conferidos. Ambos os bancos têm coluna/FK
e três migrations. Entendimento da 5.68 confirmado com "entendi" em 20/10/2026,
publicado em 55f7ea8. Na 5.69, Produto recebeu Fillable de categoria_id e método
categoria com belongsTo; configuração em memória/zero SQL e suíte 6/14 passaram.
Entendimento da 5.69 confirmado com "entendi" em 20/10/2026, publicado em 6292b4b.
Na 5.70, primeiro ProdutoCategoriaTest verifica categoria lida pela propriedade
de produto recarregado; duas categorias e uma Camiseta preparadas no SQL Server.
Focado 1/5 e suíte 7/19 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026 e publicado em 68b586f. Na 5.71, segundo cenário
verifica categoria_id e relação null após recarregar produto sem categoria.
Focado 2/9 e suíte 8/23 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026 e publicado em e41a1d4. Na 5.72, relação inversa
hasMany definida em Categoria; sintaxe e configuração em memória com zero SQL
conferidas. Suíte existente 8/23 passou; ainda não lê produtos por hasMany.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em 593cb81.
Na 5.73, primeiro CategoriaProdutosTest cadastra duas categorias/três produtos,
recarrega Roupas e verifica coleção somente com Camiseta/Calça pelos IDs, sem
exigir ordem. Focado 1/5 e suíte 9/28 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 6ad0d19. Na 5.74, segundo
cenário confere coleção vazia para categoria sem produtos. Focado 2/9 e suíte
10/32 passaram, rollback conferido. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 5b9d800. Na 5.75, terceiro cenário usa
produtos()->where('status', 'ativo')->get(), retornando somente ativo da categoria.
Focado 3/13 e suíte 11/36 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026, publicado em 617408b. Na 5.76, cenário em
ProdutoCategoriaTest confere associate em memória e persistência após save/recarga.
Falha inicial por FK string/ID inteiro corrigida com conversão local na asserção;
focado final 3/15 e suíte 12/42 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 0730204. Na 5.77,
dissociate/save conferidos antes/depois da gravação, com categoria preservada.
Focado 4/22 e suíte 13/49 passaram, rollback conferido. Entendimento confirmado
com "entendi" em 20/10/2026, publicado em 7d94759. Na 5.78, diagnóstico temporário
em loja_test conferiu carregamento sob demanda: 1 SELECT de três produtos e 3
SELECTs de categorias, total 4 (N+1). Nomes/rollback/contagens conferidos, sem mudar
aplicação. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
55d0045. Na 5.79, diagnóstico comparativo com with('categoria') retornou os mesmos
nomes com 2 SELECTs em vez de 4, sem consultas adicionais no foreach. Rollback e
contagens posteriores conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 70d44b5. Na 5.80, cenário permanente em
ProdutoCategoriaTest exige resultados corretos e duas consultas antes/depois
do foreach. Focado 5/27 e suíte 14/54 passaram, rollback conferido. Entendimento
confirmado com "entendi" em 20/10/2026, publicado em 3627952. Na 5.81, INNER JOIN
parametrizado retornou Camiseta/Roupas em 1 SELECT; Caneca sem categoria ficou
fora do resultado e seguiu no banco. Rollback/contagens conferidos, sem mudar
aplicação. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
dca90ec. Na 5.82, comparação com LEFT JOIN retornou também Caneca/null em
1 SELECT/2 linhas, enquanto INNER retornou 1 linha. Nomes/NULL/rollback/contagens
conferidos. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
c700173. Na 5.83, mesmo LEFT JOIN por Query Builder comparado ao SQL: mesmos
nomes/null, 1 SELECT por caso, zero antes de get, Collection de linhas simples.
Rollback/contagens conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em 829236f. Na 5.84, count() no Query Builder retornou
inteiros 2/0 com um SELECT COUNT(*) por categoria, sem carregar lista. SQL/rollback/
contagens conferidos. Entendimento confirmado com "entendi" em 20/10/2026,
publicado em fd95bdd. Na 5.85, GROUP BY categoria_id e COUNT(*) retornaram
dois grupos com totais 2/1 em um SELECT. IDs/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em d797c48.
Na 5.86, agrupamento via selectRaw/groupBy/get comparado ao SQL: mesmos grupos/
totais 2/1, um SELECT por caso, zero antes de get e Collection de linhas simples.
Rollback/contagens conferidos. Entendimento confirmado com "entendi"
em 20/10/2026, publicado em a764ac5. Na 5.87, HAVING COUNT(*) >= 2 filtrou
os grupos e retornou só Roupas/2 em um SELECT. IDs/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 20/10/2026, publicado em 9416c4f.
Na 5.88, havingRaw('COUNT(*) >= ?', [2]) comparado ao SQL: mesmo grupo Roupas/2,
um SELECT por caso, parâmetros e zero antes de get conferidos. Rollback/contagens
passaram. Entendimento confirmado com "entendi" em 20/10/2026, publicado em
0aa0ebc. Na 5.89, LEFT JOIN a partir de categorias e COUNT(produtos.id) retornaram
Roupas/2 e Acessórios/0 em um SELECT. IDs/nomes/zero/rollback/contagens conferidos.
Entendimento confirmado com "entendi" em 21/10/2026, publicado em d7a9051.
Na 5.90, mesmo LEFT JOIN/COUNT no Builder retornou IDs/nomes/totais 2/0 iguais ao
SQL, um SELECT por caso, zero antes de get. Retorno/parâmetros/rollback conferidos.
Entendimento confirmado com "entendi" em 21/10/2026, publicado em 1d801ae.
Na 5.91, withCount('produtos') retornou models Categoria com produtos_count 2/0,
um SELECT e coleção produtos sem carregar. Tipos/IDs/nomes/rollback/contagens
conferidos. Entendimento confirmado com "entendi" em 21/10/2026, publicado em
a5e94b5. Na 5.92, entrega persistida revisada pelo fluxo GET /loja até SQL Server
e Blade; binding/consulta CLI e HTTP 200 com Camiseta conferidos, sem mudar aplicação.
Entendimento da revisão confirmado com "entendi" em 21/10/2026; módulo 5 concluído.
Publicação registrada em docs/progresso.md. Em 21/10/2026, o aluno confirmou o
encerramento do módulo 5 e decidiu iniciar o módulo 6 em outro momento.
Retomada solicitada em 22/10/2026: módulo 6 iniciado na etapa 6.1, HTTP, HTML e
JSON, usando a resposta existente de /loja. Explicação e verificação apresentadas;
entendimento confirmado com "entendi" em 22/10/2026. Nenhuma rota de API criada
nesta etapa. Checkpoint 6.1 publicado e verificado em 7ce865a. Na 6.2, registro
de routes/api.php com prefixo api/v1 e GET /api/v1/produtos com nomes ativos
ordenados em JSON implementados; contrato inicial em docs/api/catalogo.md.
Sintaxes/registro e HTTP real da API e /loja conferidos; suíte existente 14/54
passou, contagens preservadas. Explicação apresentada, entendimento da 6.2
confirmado com "entendi" em 22/10/2026; checkpoint publicado e verificado em
28450ae. Na 6.3, primeiro CatalogoApiTest verifica status, Content-Type e JSON
do catálogo vazio com transação em loja_test. Focado 1/6 e suíte 15/60 passaram;
contagens preservadas. Explicação apresentada, entendimento da 6.3 confirmado
com "entendi" em 22/10/2026; checkpoint publicado e verificado em d9d0911.
Na 6.4, cenário HTTP de produto ativo via factory exige Camiseta no JSON:
classe 2/12 e suíte 16/66 passaram, contagens preservadas. Explicação apresentada,
entendimento da 6.4 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 7defc2c. Na 6.5, cenário HTTP com ativo/inativo usa inativo() e
exige apenas Camiseta no JSON; classe 3/18 e suíte 17/72 passaram, contagens
preservadas. Explicação apresentada, entendimento da 6.5 confirmado com "entendi"
em 22/10/2026; checkpoint publicado e verificado em bc86f52. Na 6.6, cenário HTTP
de dois ativos inseridos em ordem inversa exige Camiseta/Caneca no JSON:
classe 4/24 e suíte 18/78 passaram, contagens preservadas. Explicação apresentada,
entendimento da 6.6 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em daffb95. Na 6.7, função da rota extraída para
Api\V1\ProdutoController@index; rota/DI/sintaxes conferidos, classe 4/24 e suíte
18/78 passaram. HTTP real JSON/HTML e contagens preservados. Explicação apresentada,
entendimento da 6.7 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 0c2a14e. Na 6.8, desenhada representação de produto com
id/nome/preco_em_centavos, campos/tipos e impacto na leitura, consumidores e testes.
Somente documentação; API continua retornando nomes. Explicação apresentada,
entendimento da 6.8 confirmado com "entendi" em 22/10/2026; checkpoint publicado
e verificado em 3a92c90. Na 6.9, ProdutoResource mapeia os três campos e foi
conferido em memória: tipos/valores, model não salvo e zero SQL observado.
HTTP real confirmou formato anterior de nomes e HTML preservados. Explicação
apresentada, entendimento da 6.9 confirmado com "entendi" em 23/10/2026 após
esclarecer que ainda não participa da resposta da API; checkpoint publicado e
verificado em 13d9256. Na 6.10, listarProdutos() retorna coleção de Produto ativos
ordenados com id/nome/preço. Diagnóstico de integração conferiu vazio/dados/
filtro/ordem/campos/tipos/um SELECT e rollback; suíte existente 18/78 passou.
HTTP real e contagens preservados. Explicação apresentada, entendimento da 6.10
confirmado com "entendi" em 23/10/2026; checkpoint publicado e verificado em
9e8e6b6. Na 6.11, contrato declara listarProdutos e demonstração retorna coleção
compatível em memória; binding Eloquent/leitura pelo contrato/zero SQL da demo
conferidos, suíte 18/78 passou e HTTP/contagens preservados. Explicação apresentada,
entendimento da 6.11 confirmado com "entendi" em 23/10/2026; checkpoint publicado
e verificado em 11ccc75. Na 6.12, controller retorna ProdutoResource::collection
de listarProdutos e os quatro testes HTTP exigem objetos id/nome/preço. Contrato
ativo atualizado junto à resposta; classe 4/24 e suíte 18/78 passaram. HTTP real
confirmou objeto/Camiseta/4990 e HTML preservado; contagens mantidas. Explicação
apresentada, entendimento da 6.12 confirmado com "entendi" em 23/10/2026 após
esclarecer a busca no banco; checkpoint publicado e verificado em 1b1d288.
Na 6.13, desenhada consulta individual GET /api/v1/produtos/{id}, sucesso 200
com objeto em data e 404 com message para inexistente/inativo. Somente documentação;
nenhuma rota individual implementada. Entendimento da 6.13 confirmado pelo aluno
com "entendi" em 23/10/2026; checkpoint publicado e verificado em 1690d72.
Na 6.14, CatalogoEloquent recebeu buscarProduto(int $id): ?Produto, filtrando
ativo/ID e selecionando os três atributos. Diagnóstico no banco exclusivo conferiu
dois ativos por IDs diferentes, ausente/inativo null, um SELECT e rollback;
suíte 18/78 e HTTP/contagens preservados. Ainda sem ligação com contrato/demo/rota.
Entendimento da 6.14 confirmado com "entendi" em 23/10/2026; checkpoint publicado
e verificado em 198b07e. Na 6.15, Catalogo declara buscarProduto e a demonstração
busca por foreach da coleção em memória, retornando Produto ou null. Diagnóstico
conferiu contrato/assinatura/demo/zero SQL/binding/Eloquent/rollback; suíte 18/78,
HTTP e contagens preservados. Entendimento da 6.15 confirmado com "entendi" em
23/10/2026; checkpoint publicado e verificado em 8961d02. Na 6.16, show e rota
individual ligados: parâmetro positivo sem zero inicial, conversão validada para
int, busca pelo contrato, ProdutoResource no sucesso e JSON 404/message na ausência.
Diagnóstico HTTP em banco exclusivo/transação conferiu ativo/ausente/inativo e
formato/faixa do ID; suíte 18/78, HTTP real e contagens preservados. Contrato ativo
atualizado. Entendimento da 6.16 confirmado com "entendi" em 23/10/2026; publicado
e verificado em 10c7293. Na 6.17, um teste permanente pede o ID real da Camiseta,
com Caneca também cadastrada, e exige 200/tipo/JSON exato em objeto. Classe 5/30 e
suíte 19/84 passaram, contagens preservadas. Aplicação preservada, HTTP real não
repetido. Entendimento da 6.17 confirmado com "entendi" em 23/10/2026. Aluno pediu
para continuar outro dia; curso em pausa, sem iniciar a 6.18. Quando solicitar
retomada, próximo passo: teste de ID válido inexistente com 404/message na 6.18.
Exercício sugerido no DBeaver segue sem relato. Módulos 7 a 23 não iniciados.
O estado detalhado e as confirmações ficam em `docs/progresso.md`.

| Módulo | Conteúdo | Entrega verificável |
| --- | --- | --- |
| 1. Preparação, Git e GitHub | Terminal, repositório, `.gitignore`, alterações, commits, branches, push e documentação. | Repositório público com roteiro e controle de progresso. |
| 2. Docker desde o começo | Imagens, containers, Dockerfile, Compose, portas, redes, volumes, variáveis, logs e comandos. | Ambiente PHP mínimo funcionando e compreendido. |
| 3. PHP moderno e OOP | Tipos, interfaces, encapsulamento, composição, herança, exceções, enums, namespaces, Composer e autoload. | Pequenas regras da loja em PHP com primeiros testes PHPUnit. |
| 4. Laravel e MVC | Estrutura, Artisan, ciclo da requisição, rotas, controllers, models, views, middleware, container e injeção de dependências. | Primeiras rotas e uma pequena página Blade para entender MVC. |
| 5. SQL Server e persistência | Modelagem, chaves, relacionamentos, SQL, joins, migrations, seeders, factories, Eloquent e Query Builder. | Catálogo persistido em SQL Server no Docker. |
| 6. APIs REST | HTTP, recursos, métodos, status, validação, serialização, paginação, filtros, erros e OpenAPI. | API de catálogo documentada e testada. |
| 7. Autenticação e autorização | Sanctum, cookies, sessões, CSRF, CORS, hashing, policies e permissões. | Acesso de clientes e administradores com operações protegidas. |
| 8. HTML5, CSS3 e JavaScript moderno | Semântica, acessibilidade, formulários, Flexbox, Grid, responsividade, módulos, promises, `async/await` e `fetch`. | Protótipo da vitrine consumindo a API. |
| 9. React na prática | JSX, componentes, props, estado, eventos, hooks, efeitos, formulários, carregamento e erros. | Vitrine e carrinho em laboratório React com Vite. |
| 10. TypeScript e Next.js | Tipagem, interfaces, App Router, layouts, navegação, componentes de servidor e cliente, renderização e cache. | Interface principal em Next.js, reaproveitando o aprendizado de React. |
| 11. Integração Laravel + Next.js | URLs internas e públicas dos containers, autenticação, consumo da API, erros e configuração por ambiente. | Login, catálogo e administração funcionando pela interface. |
| 12. Pedidos e regras de negócio | Checkout, cálculo de valores, estados, transações, concorrência e controle de estoque. | Compra completa com pagamento simulado e proteção contra venda sem estoque. |
| 13. PHPUnit em profundidade | Testes unitários, de integração e HTTP, doubles, factories, isolamento e regressões. | Testes dos comportamentos críticos de catálogo, acesso e pedidos. |
| 14. Clean Code, SOLID e Design Patterns | Responsabilidades, dependências, legibilidade, Strategy, Factory e Adapter. | Refatorações motivadas por problemas reais e protegidas por testes. |
| 15. Domain Driven Design | Linguagem do domínio, entidades, objetos de valor, agregados, casos de uso e bounded contexts. | Laravel organizado em módulos de catálogo, pedidos e estoque. |
| 16. Filas no Laravel | Jobs, workers, Redis, processamento após commit, retries, backoff, timeouts e jobs com falha. | Tarefas demoradas executadas fora da requisição HTTP. |
| 17. EDA e RabbitMQ | Eventos, produtores, consumidores, exchanges, filas, routing keys, confirmação, duplicidade e mensagens com falha. | Eventos de pedidos distribuídos pelo RabbitMQ. |
| 18. Node.js como backend | Runtime, npm, assincronismo, Express, configuração, consumo de eventos, logs e testes. | Serviço independente de notificações em Node.js/TypeScript. |
| 19. Microsserviços na prática | Extração gradual, propriedade dos dados, REST, comunicação assíncrona, contratos e implantação independente. | Estoque em Laravel separado do serviço de pedidos. |
| 20. Confiabilidade distribuída | Idempotência, consistência eventual, outbox, compensações, indisponibilidade e correlação de logs. | Pedidos tratados corretamente com falhas e eventos repetidos. |
| 21. AWS: S3, SNS e SQS | SDK, imagens, tópicos, assinaturas, filas, políticas de acesso, retries e dead-letter queues. | Integrações preparadas e testadas localmente; validação real na etapa de nuvem. |
| 22. AWS: ECS, Fargate e RDS | ECR, imagens de produção, tarefas, serviços, rede, secrets, logs, RDS SQL Server e persistência. | Aplicação implantada no ECS usando Fargate. |
| 23. CI/CD e portfólio | GitHub Actions, verificações, build, publicação de imagens, deploy, rollback e documentação. | Projeto reproduzível e demonstrável, com explicação da arquitetura. |

RabbitMQ será o broker implementado. Kafka será estudado por comparação de logs,
partições, offsets e grupos de consumidores com RabbitMQ e SNS/SQS.

## Arquitetura e versões acordadas

Começaremos com um backend Laravel e o dividiremos gradualmente em módulos.
Depois extrairemos estoque e notificações, preservando checkpoints funcionais.

- Next.js/React: vitrine e painel administrativo.
- Laravel: catálogo, clientes e pedidos.
- Laravel independente: estoque.
- Node.js/TypeScript: notificações.
- SQL Server: persistência, com bancos separados por serviço após a extração.
- Redis: filas Laravel iniciais; RabbitMQ: eventos entre serviços localmente.
- AWS: S3 para arquivos, SNS/SQS para mensageria, RDS para SQL Server,
  ECR para imagens e ECS/Fargate para execução.

As APIs de negócio começarão sob `/api/v1`. Contratos REST e de eventos serão
documentados quando introduzidos. Cada serviço acessará seus próprios dados;
a comunicação entre serviços ocorrerá por contratos.

Versões iniciais: Laravel 13, PHP 8.4, Node.js 24 LTS e Next.js 16 com App Router.
A imagem PHP terá ODBC e as extensões `sqlsrv` e `pdo_sqlsrv`. Versões de imagens
e dependências serão fixadas na introdução de cada ferramenta e sua
compatibilidade será verificada na instalação.

Fontes oficiais consultadas no planejamento:

- [Laravel 13 e requisitos de PHP](https://laravel.com/docs/13.x/releases).
- [Laravel e SQL Server](https://laravel.com/docs/13.x/database#microsoft-sql-server-configuration).
- [Requisitos dos drivers PHP para SQL Server](https://learn.microsoft.com/en-us/sql/connect/php/system-requirements-for-the-php-sql-driver).
- [Versões Node.js](https://nodejs.org/en/about/previous-releases).
- [Next.js 16](https://nextjs.org/blog/next-16).

## Ambiente e verificações

PHP, Composer, Node, npm, testes e serviços do projeto rodarão em Docker.
Editor, Git e comandos de controle do Docker podem ficar no host. Containers
serão adicionados conforme as aulas precisarem deles.

Verificaremos progressivamente acesso ao Docker, volumes, respostas e permissões
da API, interface, transações, concorrência, retries, eventos duplicados e deploy.
Testes de integração usarão banco SQL Server exclusivo para testes.

Pagamentos serão simulados. A prática será local primeiro. Ao chegar à AWS,
definiremos conta, região e limite de gastos antes de criar recursos pagos;
testes locais com doubles não comprovarão a integração real com AWS.

## Continuidade e publicação

`AGENTS.md` orienta as próximas sessões. `docs/progresso.md` registra a aula atual,
explicações, confirmações, dúvidas, verificações, publicação e próximo passo.
Código funcionando não significa conteúdo aprendido. É possível encerrar uma
sessão com uma etapa implementada e aguardando entendimento.

O repositório novo será público, com nome sugerido `curso-loja-fullstack`.
Cada checkpoint concluído terá commit e push; falhas de publicação serão
registradas. Credenciais e dados privados não entrarão no repositório.

A primeira aula começa pelos registros e pela pasta de trabalho. Depois
iniciaremos Git/GitHub, diagnosticaremos o acesso ao Docker e construiremos
o primeiro container PHP, explicando cada instrução antes de adicionar serviços.
