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
repetido. Entendimento da 6.17 confirmado com "entendi" em 23/10/2026; checkpoint
publicado e verificado em c474f24. Pausa encerrada pelo pedido de retomada em
30/10/2026. Na 6.18, acrescentado teste de ID válido inexistente com catálogo
vazio pelo setUp, exigindo 404/application/json e message exata. Classe 6/36 e
suíte 20/90 passaram; contagens antes/depois preservadas. Explicação apresentada;
entendimento da 6.18 confirmado pelo aluno com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em d6fac24. Na 6.19, teste de produto inativo
por ID exige 404/message e registro ainda inativo após a requisição. Classe 7/43
e suíte 21/97 passaram; contagens preservadas. Explicação apresentada, entendimento
da 6.19 confirmado com "entendi" em 30/10/2026; checkpoint publicado em a137a9a.
Na 6.20, teste de ID malformado abc exige 404/application/json e estrutura com
message, sem fixar texto. Classe 8/49 e suíte 22/103 passaram; contagens
preservadas. Explicação apresentada, entendimento da 6.20 confirmado pelo aluno
com "entendi" em 30/10/2026; checkpoint publicado e verificado em a23d688.
Na 6.21, teste de ID numérico acima da faixa de int usa PHP_INT_MAX.'0' e exige
404/application/json e message exata de show. Classe 9/55 e suíte 23/109 passaram;
contagens preservadas. Explicação apresentada, entendimento da 6.21 confirmado
com "entendi" em 30/10/2026; checkpoint publicado e verificado em a79fc87.
Na 6.22, teste de ID malformado parametrizado com DataProvider/idsMalformados:
abc, 0, -1, 1.5 e 01 em conjuntos nomeados. Cada um exige 404/JSON/estrutura com
message. Classe 13/79 e suíte 27/133 passaram; contagens preservadas. Explicação
apresentada, entendimento da 6.22 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 6f49a06. Na 6.23, desenhada paginação da
listagem: page opcional/padrão 1, fixo 10 por página, page de 1 a 1000000 sem zeros
iniciais, inválidos 422, ativos ordenados por nome/ID e data/links/meta. Três
exemplos conferidos em memória, zero SQL e nenhum cadastro; aplicação permanece
sem paginação. Explicação apresentada, entendimento da 6.23 confirmado com "entendi"
em 30/10/2026; checkpoint publicado e verificado em 92ce498. Na 6.24, criado
ListarProdutosRequest com authorize true e regras de page opcional/inteiro decimal
sem zeros iniciais entre 1 e 1000000. Diagnóstico direto: 4 entradas aceitas,
12 rejeitadas com 422 JSON e zero SQL; suíte existente 27/133 passou, contagens
preservadas. Classe ainda sem ligação à rota, API segue sem paginação/validação
de page. Explicação apresentada; entendimento da 6.24 confirmado com "entendi"
em 30/10/2026; checkpoint publicado e verificado em 3d89485. Na 6.25,
ListarProdutosRequest recebeu pagina(): int, cast de validated('page', 1) para
obter inteiro ou padrão 1 após validação. Diagnóstico de 16 entradas/tipos/erros
passou, zero SQL; suíte existente 27/133 passou e contagens preservadas. API segue
sem paginação/validação de page. Explicação apresentada, entendimento da 6.25
confirmado com "entendi" em 30/10/2026; checkpoint publicado em 509ed43. Na 6.26,
CatalogoEloquent recebeu paginarProdutos com dez ativos por página, ordem nome/ID,
três campos e LengthAwarePaginator. Diagnóstico SQL transacional conferiu vazio,
onze ativos/inativo, empate por ID entre páginas, totais e páginas 1/2/3 com
10/1/0 itens; rollback e contagens conferidos. Suíte existente 27/133 passou.
Ainda sem contrato/demo/rota, API segue sem paginação/validação de page. Explicação
apresentada, entendimento da 6.26 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 407e9a5. Na 6.27, contrato declara
paginarProdutos e demo implementa recorte em memória com paginator. Assinatura,
páginas 1/2 com 3/0 itens, JSON/links/zero SQL da demo, binding Eloquent e leitura
pelo contrato conferidos. Suíte existente 27/133 passou; contagens preservadas.
Ainda sem ligação à rota, API segue sem paginação/validação de page. Explicação
apresentada, entendimento da 6.27 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em 431fced. Na 6.28, index recebe Form Request
e retorna paginação pelo contrato: page validado/default 1, data/links/meta,
inválidos 422. Quatro testes de listagem adaptados e contrato ativo atualizado;
classe 13/107 e suíte 27/161 passaram. Diagnósticos HTTP pelo kernel/transação
conferiram onze ativos/inativo, páginas/limites/erros sem SQL/rollback; socket
confirmou listagem, page=2 vazia, individual, 422 e Blade. Contagens preservadas.
Explicação apresentada; entendimento da 6.28 confirmado com "entendi" em 30/10/2026.
Checkpoint publicado e verificado em ed21a33. Na 6.29, acrescentado um teste
permanente de página 2 com onze ativos, um inativo e empate por ID nas posições
10/11. Exige produto completo, links e metadados; classe 14/120 e suíte 28/174
passaram, contagens preservadas. Explicação apresentada; entendimento da 6.29
confirmado com "entendi" em 30/10/2026. Checkpoint publicado e verificado em
6f0af42. Na 6.30, acrescentado teste de page=0 exigindo 422/JSON, message e erro
associado a page, sem fixar tradução. Classe 15/128 e suíte 29/182 passaram,
contagens preservadas. Explicação apresentada; entendimento da 6.30 confirmado
com "entendi" em 30/10/2026. Checkpoint publicado e verificado em d834624.
Na 6.31, teste de page=0 generalizado com DataProvider de onze queries inválidas,
exigindo 422/JSON/message/errors.page. Classe 25/208 e suíte 39/262 passaram;
contagens preservadas. Explicação apresentada; entendimento da 6.31 confirmado
com "entendi" em 30/10/2026. Checkpoint publicado e verificado em 3a782ca.
Na 6.32, teste de um ativo/page=2 exige 200/data [], total 1, página atual 2,
última 1, from/to null e links. Classe 26/221 e suíte 40/275 passaram; contagens
preservadas. Explicação apresentada; entendimento da 6.32 confirmado com "entendi"
em 30/10/2026. Checkpoint publicado e verificado em db652dd. Na 6.33, teste
após a última generalizado com provider de páginas 2/1000000 e anteriores 1/999999.
Ambas retornam 200/data [], total 1, última 1 e links corretos. Classe da API
passou; suíte completa 41/288 passou, contagens preservadas. Explicação apresentada;
entendimento da 6.33 confirmado com "entendi" em 30/10/2026. Publicação verificada
em d86aa98. Na 6.34, contrato do filtro nome desenhado: trecho literal opcional
1..100, vazio/array/excesso com 422, somente ativos, filtrar antes de contar/paginar,
links preservam nome e comparação segue collation atual. SELECTs confirmaram
caixa ignorada/acentos distintos e contagens preservadas. Filtro ainda não
implementado; somente documentação. Explicação apresentada; entendimento da
6.34 confirmado com "entendi" em 01/11/2026 e publicada em 4bb1291. Na 6.35,
ListarProdutosRequest recebeu nome com bail/sometimes/required/string/max:100.
Validação já ativa no HTTP; nome válido ainda não filtra. Diagnóstico conferiu
12 válidos/7 inválidos, normalização/tipos/Unicode/422 sem SQL e rollback; suíte
existente 41/288 passou, contagens preservadas. Explicação apresentada; entendimento
da 6.35 confirmado com "entendi" em 01/11/2026 e publicada em 618eb1a. Na 6.36,
nome(): ?string retorna validated('nome'), texto normalizado ou null quando omitido.
Diagnóstico de valores/tipos e rejeições passou; suíte existente 41/288 e contagens
preservadas. Controller ainda não usa nome; filtro não aplicado. Explicação
apresentada; entendimento da 6.36 confirmado com "entendu" em 01/11/2026 e
publicada em 0b9afb8. Na 6.37, Eloquent recebe nome opcional e usa CHARINDEX
parametrizado antes de paginar. Diagnóstico de 18 cenários SQL conferiu filtro,
total/páginas/empate, literais, caixa/acentos, null/'0', bindings e rollback;
suíte existente 41/288 passou, contagens preservadas. Contrato/demo/controller
preservados, HTTP ainda sem filtro. Explicação apresentada; entendimento da
6.37 confirmado com "entendi" em 01/11/2026 e publicada em 4d34564. Na 6.38,
Catalogo declara nome opcional e demonstração filtra via mb_stripos/UTF-8 antes
de contar/recortar, usando !== false para aceitar posição zero. Quinze cenários
da demo/JSON sem SQL, assinaturas/binding e passagem pelo contrato conferidos;
suíte existente 41/288 passou, contagens preservadas. HTTP ainda sem filtro.
Explicação apresentada; entendimento da 6.38 confirmado com "entendi" em 01/11/2026
e publicada em 90cdc35. Na 6.39, controller integra pagina/nome e appends apenas
nome validado nos links. Busca HTTP agora filtra e mantém total/links coerentes.
Diagnóstico kernel: 19 sucessos/6 inválidos, navegação next e rollback; HTTP real
confirmou filtro/Camiseta/links/422/individual/Blade. Suíte existente 41/288 passou,
contagens preservadas. Explicação apresentada; entendimento da 6.39 confirmado com "entendi"
em 01/11/2026 e publicada em a1ded6b. Na 6.40, novo teste HTTP permanente
exige só os dois ativos correspondentes ao trecho, data completa/ordem, total 2
e links com nome. Classe 28/247 e suíte 42/301 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.40 confirmado com "entendi" em 01/11/2026
e publicada em 851adef. Na 6.41, teste usa DataProvider com três buscas: simples,
espaços/caixa e desconhecido. Links esperados com nome explícito, normalizado e
sem ignorado; produtos/total/metadados anteriores preservados. Classe 30/273 e
suíte 44/327 passaram, contagens preservadas. Explicação apresentada; entendimento
da 6.41 confirmado com "entendi" em 01/11/2026 e publicada em 2128dbb. Na 6.42,
novo teste permanente com seis nomes inválidos exige 422/JSON/message/errors.nome:
vazio, espaços, arrays e 101 caracteres ASCII/Unicode. Classe 36/321 e suíte
50/375 passaram, contagens preservadas. Explicação apresentada; entendimento da
6.42 confirmado com "entendi" em 01/11/2026 e publicada em 8eab468. Na 6.43,
novo teste percorre duas páginas seguindo links.next recebido; exige 12 ativos
correspondentes entre 20 ativos, desempate por ID na divisão, dados completos,
total e nome preservados. Classe 37/345 e suíte 51/399 passaram; contagens
preservadas. Explicação apresentada; entendimento da 6.43 confirmado com
"entendi" em 01/11/2026 e publicada em d56c185. Na 6.44, teste com provider
confere busca literal por %, _, [, apóstrofo, +, & e string '0', com query
codificada por http_build_query, único ativo correspondente e texto nos links.
Classe 44/436 e suíte 58/490 passaram; contagens preservadas. Explicação
apresentada; entendimento da 6.44 confirmado com "entendi" em 01/11/2026 e
publicada em 2adfac2. Na 6.45, teste com Caneca ativa e Camiseta inativa exige
busca por camiseta com 200, data [], total 0, last_page 1, posições null e links
filtrados. Classe 45/449 e suíte 59/503 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.45 confirmado com "entendi" em
01/11/2026 e publicada em be303c9. Na 6.46, teste cria onze Camisetas ativas,
uma Caneca ativa e uma Camiseta inativa. Busca filtrada na página 3 exige data
vazia, total 11, última página 2, posições null e links com nome. Classe 46/462
e suíte 60/516 passaram; contagens preservadas. Explicação apresentada;
entendimento da 6.46 confirmado com "entendi" em 01/11/2026 e publicada em
466053a. Na 6.47, provider nomesLiterais recebe 100 letras a e 100 letras á;
mesmo teste exige único ativo correspondente, total 1 e links com texto.
Classe 48/488 e suíte 62/542 passaram; contagens preservadas. Explicação
apresentada; entendimento da 6.47 confirmado com "entendi" em 01/11/2026 e
publicada em 716032b. Na 6.48, provider de quatro buscas confere distinção de
acentos e comparação sem diferença de caixa: tenis/TENIS e tênis/TÊNIS.
Exige objeto exclusivo, total e links com texto preservado. Classe 52/540 e
suíte 66/594 passaram; contagens preservadas. Explicação apresentada;
entendimento da 6.48 confirmado com "entendi" em 01/11/2026 e publicada em
35c4bac. Na 6.49, teste de navegação filtrada ampliado: quatro opções em
meta.links nas duas páginas, com url/page/active e filtro preservado, sem
labels fixos. Classe 52/566 e suíte 66/620 passaram; contagens preservadas.
Explicação apresentada; entendimento da 6.49 confirmado com "entendi" em
01/11/2026 e publicada em ddfbada. Na 6.50, introdução e desenho do OpenAPI:
JSON, versão planejada 3.2.1, identificação/revisão e escopo da listagem com
page/nome, 200 e 422. Somente documentação; código/contrato/fontes oficiais,
diff e links conferidos. Documento formal ainda não criado; última suíte é
66/620 da 6.49. Explicação apresentada; entendimento da 6.50 confirmado com
"entendi" em 01/11/2026 e publicada em 697f841. Na 6.51, criado esqueleto de
docs/api/openapi.json com identificação, servidor local e paths objeto vazio.
PHP no Docker confirmou sintaxe e leitura dos metadados; nenhum validador
OpenAPI automatizado ou nova suíte executado. Última suíte é 66/620 da 6.49.
Explicação apresentada; entendimento da 6.51 confirmado com "entendi" em
01/11/2026 e publicada em 5bcb430. Na 6.52, OpenAPI recebeu a operação
GET /api/v1/produtos com summary, operationId listarProdutos e descrições de
respostas 200/422. PHP Docker conferiu sintaxe e leitura; método/caminho/status
confrontados com contrato/código. Ainda sem parâmetros/schemas ou validador
OpenAPI; última suíte 66/620 da 6.49. Explicação apresentada; entendimento da
6.52 confirmado com "entendi" em 01/11/2026 e publicada em 104f8d6. Na 6.53,
page descrito na query: opcional, inteiro de 1 a 1000000, padrão 1; descrição
registra normalização, regra lexical, vazio inválido e página após a última.
PHP Docker leu sintaxe/campos; conferido contra Form Request/contrato. Sem
validador OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação
apresentada; entendimento da 6.53 confirmado com "entendi" em 01/11/2026 e
publicada em b4aa821. Na 6.54, nome como segundo parâmetro: query opcional,
string de 1–100 caracteres, sem default e descrição de normalização/busca
literal/caixa/acentos/links. PHP Docker leu JSON/campos, comparados com código
e contrato. Sem validador OpenAPI ou nova suíte; última suíte 66/620 da 6.49.
Explicação apresentada; entendimento da 6.54 confirmado com "entendi" em
01/11/2026 e publicada em 2210731. Na 6.55, criado components.schemas.Produto:
object, required dos três campos e properties com integer/string/integer;
preço em centavos. PHP Docker leu JSON/campos; conferido contra resource/model/
migration/contrato. Ainda sem referência nas respostas ou validador OpenAPI;
última suíte 66/620 da 6.49. Explicação apresentada; entendimento da 6.55
confirmado com "entendi" em 01/11/2026 e publicada em 9930c33. Na 6.56,
resposta 200 recebeu corpo application/json/object/data obrigatório, array
até dez itens com $ref para Produto. PHP Docker leu campos e percorreu a
referência local. Descrição parcial; links/meta virão depois. Sem validador
OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação apresentada;
entendimento da 6.56 confirmado com "entendi" em 01/11/2026 e publicada em
d1a7b18. Na 6.57, links obrigatório no corpo 200: object com quatro campos
obrigatórios, first/last string e prev/next string ou null. PHP Docker leu
JSON/campos, comparados com contrato/teste existente. Meta será descrito depois;
sem validador OpenAPI ou nova suíte, última suíte 66/620 da 6.49. Explicação
apresentada; entendimento da 6.57 confirmado com "entendi" em 01/11/2026 e
publicada em 12acc7e. Na 6.58, meta obrigatório com sete campos básicos:
página/tamanho/total/última/posições/path, tipos e limites; per_page const 10,
from/to inteiro ou null. PHP Docker leu JSON/campos; conferido contra contrato/
testes/serviço. Meta.links será posterior. Sem validador OpenAPI ou nova suíte;
última suíte 66/620 da 6.49. Explicação apresentada; entendimento da 6.58
confirmado com "entendi" em 01/11/2026 e publicada em 5b108b2. Na 6.59,
meta.links obrigatório, lista de objetos com url/label/page/active obrigatórios,
tipos e descrições; label e quantidade da lista livres, active boolean.
PHP Docker leu JSON/campos, conferidos contra contrato/teste. Sem validador
OpenAPI ou nova suíte; última suíte 66/620 da 6.49. Explicação apresentada;
entendimento da 6.59 confirmado com "entendi" em 01/11/2026 e publicada em
4e8f8ed. Na 6.60, corpo 422 application/json/object com message/errors
obrigatórios; errors é dicionário de campo para listas de textos, com ao menos
um campo e uma mensagem por campo, sem traduções fixas. PHP Docker leu JSON/
campos, conferidos contra código/contrato/testes. Sem validador OpenAPI ou nova
suíte; última suíte 66/620 da 6.49. Explicação apresentada; entendimento
da 6.60 confirmado com "entendi" em 01/11/2026 e publicada em 6ace636.
Na 6.61, Redocly CLI 2.65.0/imagem por digest e redocly.yaml/extends spec.
Documento passou em Docker com código 0; duas cópias inválidas rejeitadas com
código 1 (struct/título e no-unresolved-refs). OpenAPI preservado, sem nova
suíte Laravel; última suíte 66/620 da 6.49. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em a7e7d42. Na 6.62, exemplo 200 completo
com Camiseta e paginação; regra no-invalid-media-type-examples como erro,
allowAdditionalProperties true acompanha schemas abertos. Mesma imagem Docker:
original código 0; cópias com preço texto/nome ausente/per_page 11 rejeitadas
com código 1. Dados ilustrativos, coerência de totais/URLs lida separadamente;
sem captura HTTP, SQL ou nova suíte Laravel. Entendimento confirmado com
"entendi" em 01/11/2026 e publicada em 57e7f4a. Na 6.63, exemplo 422 com
message e errors.nome/lista de mensagens ilustrativas; mesma imagem/regra,
documento código 0. Três cópias inválidas rejeitadas com código 1: mensagem
sem lista, lista vazia e objeto errors vazio. Schemas/exemplo 200 preservados;
sem captura HTTP, SQL ou nova suíte Laravel. Explicação apresentada;
entendimento confirmado com "entendi" em 01/11/2026. Publicar e iniciar somente 6.64:
GET /api/v1/produtos/{id} no OpenAPI, parâmetro id e descrições de 200/404.
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
