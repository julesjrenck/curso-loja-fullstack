# Progresso do curso

## Estado atual

- Última atualização: 22/10/2026, referência de data America/Sao_Paulo.
- Módulo atual: 6 — APIs REST.
- Etapa atual: 6.7 — Controller da API de produtos.
- Situação: criado App\Http\Controllers\Api\V1\ProdutoController com
  index(Catalogo $catalogo): JsonResponse; routes/api.php aponta para o método.
  Injeção no método reaproveita o binding Catalogo/CatalogoEloquent. Resposta
  continua data com nomes ativos ordenados; testes/serviço/prefixo preservados.
  Sintaxes e route:list/grupo api corretos; classe 4 testes/24 asserções e suíte
  18 testes/78 asserções passaram com --do-not-cache-result. HTTP real: API 200/
  application/json/{"data":["Camiseta"]}; /loja 200/text/html com Camiseta.
  SELECTs posteriores: loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0/1.
  Aula 06-07 e contrato docs/api/catalogo.md atualizados. Entendimento da 6.7
  confirmado com "entendi" em 22/10/2026; checkpoint pronto para publicação.
  Próximo passo: publicar e iniciar somente 6.8, desenhar representação JSON com id/nome/preco_em_centavos
  e impacto no contrato/testes, sem implementar a nova representação nessa etapa.
  Etapa 6.6 confirmada com "entendi" em 22/10/2026 e publicada em
  daffb9511b15c10f2b358658295f00f332bd17bf; HEAD, origin/main e main remota
  coincidiram após o push.
  Etapa 6.5 confirmada com "entendi" em 22/10/2026 e publicada em
  bc86f52caf0e054fa32c74abaf834a374738f44e; HEAD, origin/main e main remota
  coincidiram após o push.
  Etapa 6.4 confirmada com "entendi" em 22/10/2026 e publicada em
  7defc2c2f695e73d2be27f8167acdb74f28ea746; HEAD, origin/main e main remota
  coincidiram após o push.
  Etapa 6.3 confirmada com "entendi" em 22/10/2026 e publicada em
  d9d091144402ef5d700a1126eabfabd3855c9e4f; HEAD, origin/main e main remota
  coincidiram após o push.
  Etapa 6.2 confirmada com "entendi" em 22/10/2026 e publicada em
  28450ae4ed0ba7562dc07ea92f9f402cbdc18229; HEAD, origin/main e main remota
  coincidiram após o push.
  Etapa 6.1 confirmada com "entendi" em 22/10/2026 e publicada em
  7ce865ade29038292a064649f5b509f9205d3d51; HEAD, origin/main e main remota
  coincidiram após o push. Exercício sugerido no DBeaver continua sem relato.
- Histórico recente do encerramento do módulo 5: fluxo GET /loja -> LojaController/contrato Catalogo -> binding
  CatalogoEloquent -> Produto/SQL Server -> view loja revisado, sem alterar aplicação.
  Diagnóstico /tmp/curso-592-revisar-catalogo.php conferiu loja/loja_app, binding,
  listarNomes ['Camiseta'] e um SELECT no processo CLI. Requisição HTTP separada:
  200, X-Curso Laravel e item Camiseta no HTML. Contagens dos bancos preservadas.
  Última suíte registrada permanece 14/54 da 5.80, não reexecutada nesta revisão.
  Consulta manual sugerida no DBeaver segue sem relato de execução do aluno;
  verificação por ferramenta não foi tratada como execução desse exercício.
  Revisão/verificações da 5.92 concluídas em 21/10/2026; explicação apresentada.
  Entendimento confirmado com "entendi" em 21/10/2026; módulo 5 concluído.
  Etapa 5.92 publicada em 2964f04d5d3054bdcf6f142e1f64cc97f05abd81;
  HEAD, origin/main e consulta direta à main remota coincidiram após o push.
  O aluno confirmou o encerramento do módulo 5 e pediu para iniciar o módulo 6
  em outro momento. Pausa encerrada pelo pedido de retomada em 22/10/2026;
  situação atual e próximo passo registrados acima na etapa 6.1.
  Etapa 5.91 confirmada com "entendi" em 21/10/2026, publicada em a5e94b5.
  Etapa 5.90 confirmada com "entendi" em 21/10/2026, publicada em 1d801ae.
  Etapa 5.89 confirmada com "entendi" em 21/10/2026, publicada em d7a9051.
  Etapa 5.88 confirmada com "entendi" em 20/10/2026, publicada em 0aa0ebc.
  Etapa 5.87 confirmada com "entendi" em 20/10/2026, publicada em 9416c4f.
  Etapa 5.86 confirmada com "entendi" em 20/10/2026, publicada em a764ac5.
  Etapa 5.85 confirmada com "entendi" em 20/10/2026, publicada em d797c48.
  Etapa 5.84 confirmada com "entendi" em 20/10/2026, publicada em fd95bdd.
  Etapa 5.83 confirmada com "entendi" em 20/10/2026, publicada em 829236f.
  Etapa 5.82 confirmada com "entendi" em 20/10/2026, publicada em c700173.
  Etapa 5.81 confirmada com "entendi" em 20/10/2026, publicada em dca90ec.
  Etapa 5.80 confirmada com "entendi" em 20/10/2026, publicada em 3627952.
  Etapa 5.79 confirmada com "entendi" em 20/10/2026, publicada em 70d44b5.
  Etapa 5.78 confirmada com "entendi" em 20/10/2026, publicada em 55d0045.
  Etapa 5.77 confirmada com "entendi" em 20/10/2026, publicada em 7d94759.
  Etapa 5.76 confirmada com "entendi" em 20/10/2026, publicada em 0730204.
  Etapa 5.75 confirmada com "entendi" em 20/10/2026, publicada em 617408b.
  Etapa 5.74 confirmada com "entendi" em 20/10/2026, publicada em 5b9d800.
  Etapa 5.73 confirmada com "entendi" em 20/10/2026, publicada em 6ad0d19.
  Etapa 5.72 confirmada com "entendi" em 20/10/2026, publicada em 593cb81.
  Etapa 5.71 confirmada com "entendi" em 20/10/2026, publicada em e41a1d4.
  Etapa 5.70 confirmada com "entendi" em 20/10/2026, publicada em 68b586f.
  Etapa 5.69 confirmada com "entendi" em 20/10/2026, publicada em 6292b4b.
  Etapa 5.68 confirmada com "entendi" em 20/10/2026, publicada em 55f7ea8.
  Etapa 5.67 confirmada com "entendi" em 20/10/2026, publicada em e384ae1.
  Etapa 5.66 confirmada com "entendi" em 20/10/2026, publicada em 3924613.
  Descoberta da 5.65 confirmada com "entendi" em 20/10/2026, publicada em 91ed884.
  Etapa 5.64 confirmada com "entendi" em 20/10/2026, publicada em e5e6156.
  Etapa 5.63 confirmada com "entendi" em 20/10/2026, publicada em ce67886.
  Etapa 5.62 confirmada com "entendi" em 20/10/2026, publicada em e57dbbe.
  Etapa 5.61 confirmada com "entendi" em 20/10/2026, publicada em 4d3358d.
  Etapa 5.60 confirmada com "entemdi" em 20/10/2026, publicada em 04ab6bb.
  Etapa 5.59 confirmada com "entendi" em 20/10/2026, publicada em 9e89010.
  Etapa 5.58 confirmada com "entendi" em 20/10/2026, publicada em f680b99.
  Etapa 5.57 confirmada com "entendi" em 19/10/2026, publicada em 5c65e6d.
  Etapa 5.56 confirmada com "entendi" em 19/10/2026, publicada em 07af123.
  Etapa 5.55 confirmada com "entendi" em 19/10/2026, publicada em 0f754ae.
  Etapa 5.54 confirmada com "entendi" após nova explicação em 19/10/2026,
  publicada em def2f14.
  Etapa 5.53 confirmada com "entendi" em 19/10/2026, publicada em 6ac5518.
  Etapa 5.52 confirmada com "entendi" em 19/10/2026, publicada em edd3411.
  Etapa 5.51 confirmada com "entendi" em 19/10/2026, publicada em 5152ba4.
  Etapa 5.50 confirmada com "entendi" em 19/10/2026, publicada em 10e723b.
  Etapa 5.49 confirmada com "entendi" em 19/10/2026, publicada em 9a08b80.
  Etapa 5.48 confirmada com "entendi" após esclarecer onde o diagnóstico
  temporário foi executado, publicada em d465778.
  Etapa 5.47 confirmada com "entendi" em 19/10/2026 e publicada em d90a8a4.
  Etapa 5.46 confirmada com "entendi" após esclarecer os métodos e publicada
  em 77dc3f9.
  Etapa 5.45 confirmada com "entendi" em 19/10/2026 e publicada em 3e094e5.
  Etapa 5.44 confirmada com "entendi" em 19/10/2026 e publicada em 5810b26.
  Última suíte na 5.80: 14 testes/54 asserções. Na 5.92, binding/SELECT/HTTP passaram; suíte não reexecutada, código preservado.
  Etapa 5.43 confirmada com "entendi" em 19/10/2026 e publicada em 62f465e.
  Etapa 5.42 confirmada com "entendi" em 19/10/2026 e publicada em aa8e5a4.
  Etapa 5.41 confirmada com "entendi" em 19/10/2026 e publicada em 94e4e3d.
  Etapa 5.40 confirmada com "entendi" em 19/10/2026 e publicada em b70f6f0.
  Etapa 5.39 confirmada com "entendi" em 19/10/2026 e publicada em bdfb1a3.
  Etapa 5.38 confirmada com "entendi" após esclarecer APP_ENV e publicada
  em 734fc5f. Chave/senha continuam apenas locais e ignoradas pelo Git.
  Etapa 5.37 confirmada com "entendi" em 19/10/2026 e publicada em d80d241.
  Etapa 5.36 confirmada com "entendi" em 19/10/2026 e publicada em 1c8c380.
  A pausa posterior ao módulo 5 foi encerrada em 22/10/2026; acompanhar a etapa
  atual 6.7, cujo entendimento foi confirmado em 22/10/2026.
  Exercício manual DBeaver continua sem relato, como atividade sugerida de acompanhamento.
  Conta de testes criada e verificada na 5.35;
  entendimento confirmado com "entendi" em 19/10/2026, publicado em 04a9a7c.
  Etapa 5.34 confirmada com "entendi" em 19/10/2026 e publicada em 49a22c5.
  Descoberta 5.33 confirmada com "entendi" em 16/10/2026 e publicada.
  Estrutura de produtos preparada no banco de testes; exemplos executados na 5.39.
  Instalação 5.32 confirmada com "entendi" em 16/10/2026 e publicada.
  Preparação 5.31 confirmada com "entendi" em 16/10/2026 e publicada.
  Ordenação 5.30 confirmada com "entendi" em 16/10/2026 e publicada.
  Filtro 5.29 confirmado com "entendi" em 16/10/2026 e publicado.
  Textos 5.28 confirmados com "entendi" em 16/10/2026 e publicados.
  Binding 5.27 confirmado com "entrendi" em 16/10/2026 e publicado.
  CatalogoEloquent 5.26 confirmado com "entendi" em 16/10/2026 e publicado.
  Reexecuções 5.25 confirmadas com "entendi" em 15/10/2026 e publicadas.
  firstOrCreate 5.24 confirmado com "entendi" em 15/10/2026 e publicado.
  Leitura de atributos 5.23 confirmada com "entendi" em 15/10/2026 e publicada.
  Persistência 5.22 confirmada com "entendi" em 15/10/2026 e publicada.
  Consulta DBeaver proposta, resultado do aluno ainda não informado.
  Cadastro escrito 5.21 confirmado com "entendi" em 15/10/2026 e publicado.
  Estrutura 5.20 confirmada com "entendi" em 15/10/2026 e publicada.
  Consulta 5.19 confirmada com "entendi" em 15/10/2026 e publicada.
  Cast 5.18 confirmado com "entendi" em 15/10/2026 e publicado.
  Fillable 5.17 confirmado com "entendi" em 15/10/2026 e publicado.
  Model 5.16 confirmado com "entendi" em 15/10/2026 e publicado.
  Aplicação 5.15 confirmada com "entendi" em 14/10/2026 e publicada.
  Conexão 5.14 confirmada com "entendi" em 14/10/2026 e publicada.
  Conta 5.13 confirmada com "entendi" em 14/10/2026 e publicada.
  Colunas 5.12 confirmadas com "entendi" em 14/10/2026 e publicadas.
  DBeaver: acesso confirmado pelo aluno; aviso cumprido na 5.6.
  Último checkpoint pedagógico confirmado/publicado: 2964f04, revisão 5.92 e encerramento do módulo 5.
  Salvamento da pausa publicado: a6ddff9; remoto conferido em 19/10/2026.
  Instaladas somente dependências já declaradas e fixadas no lock; nenhum serviço novo.
- Entendimento confirmado: módulos 1 a 5 completos, cada avanço confirmado
  pelo aluno com "entendi". As etapas 3.1 a 3.10 foram confirmadas em 09/10/2026;
  etapas 3.11 a 3.22 confirmadas com "entendi" em 12/10/2026.
- Módulo 4 iniciado em 12/10/2026 e concluído em 13/10/2026.
- Módulo 5 iniciado em 13/10/2026 e concluído em 21/10/2026, após confirmação da 5.92.
- Módulos 6 a 23 não iniciados.
- Etapas 4.1 a 4.19 confirmadas em 13/10/2026; módulo 4 concluído.
- Etapa 5.1 confirmada com "entendi" em 13/10/2026.
- Etapa 5.2 confirmada com "entendi" em 13/10/2026.
- Etapa 5.3 confirmada com "entendi", após esclarecimento PIE, em 13/10/2026.
- Etapa 5.4 confirmada com "entendi", após esclarecimentos de acesso, em 13/10/2026.
- Etapa 5.5 confirmada com "entendi" em 13/10/2026.
- Etapa 5.6 confirmada com "entendi" em 13/10/2026, após resultado "apareceu loja" no DBeaver.
- Etapa 5.7 confirmada com "entendi" em 13/10/2026, após dúvidas de usuário/view.
- Etapa 5.8 confirmada com "entendi" em 14/10/2026.
- Etapa 5.9 confirmada com "entendi" em 14/10/2026.
- Etapa 5.10 confirmada com "entendi" em 14/10/2026.
- Etapa 5.11 confirmada com "entendi" em 14/10/2026.
- Etapa 5.12 confirmada com "entendi" em 14/10/2026.
- Etapa 5.13 confirmada com "entendi" em 14/10/2026.
- Etapa 5.14 confirmada com "entendi" em 14/10/2026.
- Etapa 5.15 confirmada com "entendi" em 14/10/2026.
- Etapa 5.16 confirmada com "entendi" em 15/10/2026.
- Etapa 5.17 confirmada com "entendi" em 15/10/2026.
- Etapa 5.18 confirmada com "entendi" em 15/10/2026.
- Etapa 5.19 confirmada com "entendi" em 15/10/2026.
- Etapa 5.20 confirmada com "entendi" em 15/10/2026.
- Etapa 5.21 confirmada com "entendi" em 15/10/2026.
- Etapa 5.22 confirmada com "entendi" em 15/10/2026.
- Etapa 5.23 confirmada com "entendi" em 15/10/2026.
- Etapa 5.24 confirmada com "entendi" em 15/10/2026.
- Etapa 5.25 confirmada com "entendi" em 15/10/2026.
- Etapa 5.26 confirmada com "entendi" em 16/10/2026.
- Etapa 5.27 confirmada com "entrendi" em 16/10/2026.
- Etapa 5.28 confirmada com "entendi" em 16/10/2026.
- Etapa 5.29 confirmada com "entendi" em 16/10/2026.
- Etapa 5.30 confirmada com "entendi" em 16/10/2026.
- Etapa 5.31 confirmada com "entendi" em 16/10/2026.
- Etapa 5.32 confirmada com "entendi" em 16/10/2026.
- Etapa 5.33 confirmada com "entendi" em 16/10/2026.
- Etapa 5.34 confirmada com "entendi" em 19/10/2026.
- Etapa 5.35 confirmada com "entendi" em 19/10/2026.
- Etapa 5.36 confirmada com "entendi" em 19/10/2026.
- Etapa 5.37 confirmada com "entendi" em 19/10/2026.
- Etapa 5.38 confirmada com "entendi" em 19/10/2026, após esclarecer APP_ENV.
- Etapa 5.39 confirmada com "entendi" em 19/10/2026.
- Etapa 5.40 confirmada com "entendi" em 19/10/2026.
- Etapa 5.41 confirmada com "entendi" em 19/10/2026.
- Etapa 5.42 confirmada com "entendi" em 19/10/2026.
- Etapa 5.43 confirmada com "entendi" em 19/10/2026.
- Etapa 5.44 confirmada com "entendi" em 19/10/2026.
- Etapa 5.45 confirmada com "entendi" em 19/10/2026.
- Etapa 5.46 confirmada com "entendi" em 19/10/2026, após esclarecer definition/make/create.
- Etapa 5.47 confirmada com "entendi" em 19/10/2026.
- Etapa 5.48 confirmada com "entendi" em 19/10/2026, após esclarecer o local da demonstração.
- Etapa 5.49 confirmada com "entendi" em 19/10/2026.
- Etapa 5.50 confirmada com "entendi" em 19/10/2026.
- Etapa 5.51 confirmada com "entendi" em 19/10/2026.
- Etapa 5.52 confirmada com "entendi" em 19/10/2026.
- Etapa 5.53 confirmada com "entendi" em 19/10/2026.
- Etapa 5.54 confirmada com "entendi" em 19/10/2026, após explicação com exemplo da loja.
- Etapa 5.55 confirmada com "entendi" em 19/10/2026.
- Etapa 5.56 confirmada com "entendi" em 19/10/2026.
- Etapa 5.57 confirmada com "entendi" em 19/10/2026.
- Etapa 5.58 confirmada com "entendi" em 20/10/2026.
- Etapa 5.59 confirmada com "entendi" em 20/10/2026.
- Etapa 5.60 confirmada com "entemdi" em 20/10/2026.
- Etapa 5.61 confirmada com "entendi" em 20/10/2026.
- Etapa 5.62 confirmada com "entendi" em 20/10/2026.
- Etapa 5.63 confirmada com "entendi" em 20/10/2026.
- Etapa 5.64 confirmada com "entendi" em 20/10/2026.
- Etapa 5.65 confirmada com "entendi" em 20/10/2026, quanto à descoberta/permissão.
- Etapa 5.66 confirmada com "entendi" em 20/10/2026.
- Etapa 5.67 confirmada com "entendi" em 20/10/2026.
- Etapa 5.68 confirmada com "entendi" em 20/10/2026.
- Etapa 5.69 confirmada com "entendi" em 20/10/2026.
- Etapa 5.70 confirmada com "entendi" em 20/10/2026.
- Etapa 5.71 confirmada com "entendi" em 20/10/2026.
- Etapa 5.72 confirmada com "entendi" em 20/10/2026.
- Etapa 5.73 confirmada com "entendi" em 20/10/2026.
- Etapa 5.74 confirmada com "entendi" em 20/10/2026.
- Etapa 5.75 confirmada com "entendi" em 20/10/2026.
- Etapa 5.76 confirmada com "entendi" em 20/10/2026.
- Etapa 5.77 confirmada com "entendi" em 20/10/2026.
- Etapa 5.78 confirmada com "entendi" em 20/10/2026.
- Etapa 5.79 confirmada com "entendi" em 20/10/2026.
- Etapa 5.80 confirmada com "entendi" em 20/10/2026.
- Etapa 5.81 confirmada com "entendi" em 20/10/2026.
- Etapa 5.82 confirmada com "entendi" em 20/10/2026.
- Etapa 5.83 confirmada com "entendi" em 20/10/2026.
- Etapa 5.84 confirmada com "entendi" em 20/10/2026.
- Etapa 5.85 confirmada com "entendi" em 20/10/2026.
- Etapa 5.86 confirmada com "entendi" em 20/10/2026.
- Etapa 5.87 confirmada com "entendi" em 20/10/2026.
- Etapa 5.88 confirmada com "entendi" em 20/10/2026.
- Etapa 5.89 confirmada com "entendi" em 21/10/2026.
- Etapa 5.90 confirmada com "entendi" em 21/10/2026.
- Etapa 5.91 confirmada com "entendi" em 21/10/2026.
- Etapa 5.92 confirmada com "entendi" em 21/10/2026; módulo 5 concluído.

## Retomada em outro chat

Estado mais recente, em 22/10/2026: 6.6 confirmada com "entendi" e publicada em
daffb9511b15c10f2b358658295f00f332bd17bf; HEAD, origin/main e main remota
coincidiram após push. Etapa 6.7 implementada/explicada/verificada, entendimento
confirmado pelo aluno com "entendi" em 22/10/2026. Novo backend/app/Http/Controllers/Api/V1/ProdutoController.php
com index(Catalogo $catalogo): JsonResponse e corpo da função anterior.
Routes/api.php usa [ProdutoController::class, 'index']. Binding resolve o serviço
existente por injeção no método. Prefixo api/v1 e contrato de nomes preservados.
Sintaxes e route:list/grupo api corretos; testes existentes sem alterações:
classe 4/24 e suíte 18/78 passaram com --do-not-cache-result. HTTP real por
/tmp/curso-62-http.php: API 200/application/json/{"data":["Camiseta"]}; /loja
200/text/html com Camiseta. SELECTs posteriores: teste 0/0, normal 0/1
(categorias/produtos), identidades conferidas em processos separados.
Aula 06-07 e docs/api/catalogo.md atualizados. Publicar a 6.7 e iniciar somente
6.8: desenhar JSON de produto com
id/nome/preco_em_centavos e impacto no contrato/testes, sem implementar ainda.
Exercício DBeaver continua sem relato; atividade sugerida não bloqueia o curso.

Registro anterior da pausa, em 21/10/2026: 5.92 confirmada com "entendi" e publicada em
2964f04d5d3054bdcf6f142e1f64cc97f05abd81, igual a HEAD, origin/main e main
remota na conferência após esse push. Módulo 5 concluído. Na 5.92, somente
documentação alterada: revisão do fluxo real
de /loja. Routes/web.php -> LojaController@index, contrato Catalogo no construtor,
binding em AppServiceProvider para CatalogoEloquent, consulta Produto filtrando
ativo/ordenando nome/pluck/all, view loja.blade.php renderizando nomes ou mensagem
vazia, middleware MarcarRespostaCurso com X-Curso Laravel.
Diagnóstico temporário /tmp/curso-592-revisar-catalogo.php, PHP Docker sem
--env=testing, conferiu loja/loja_app e implementação resolvida. ListarNomes
retornou ['Camiseta'] em um SELECT no processo CLI, SQL de nome/ativo/order.
Requisição HTTP real separada ao servidor em 127.0.0.1:8000/loja dentro do backend:
HTTP 200, X-Curso Laravel, item HTML Camiseta e título Catálogo de produtos.
Contagem de SELECT foi da chamada CLI do serviço, não da requisição HTTP separada.
Código 0; somente leitura, sem cadastrar/alterar produto. Contagens posteriores:
teste 0 categorias/0 produtos/3 migrations; normal 0/1/3. Suíte não reexecutada,
última execução 14/54 da 5.80. Exercício manual DBeaver da 5.22 continua sem relato
do aluno; não inventar execução. Relações/joins/contagens foram estudados em testes
ou diagnósticos, enquanto página atual lista nomes ativos ordenados.
Revisão/verificação/explicação da 5.92 concluídas; entendimento confirmado com
"entendi" em 21/10/2026. Módulo 5 concluído. Publicação verificada em 2964f04.
Este registro posterior documenta o resultado do envio; consultar Git para o SHA
da atualização do registro. Em seguida, o aluno declarou: "podemos concluir o
modulo 5, mas vamos iniciar o modulo 6 em outro momento". Curso em pausa por
decisão explícita do aluno. Próximo passo: aguardar pedido de retomada e então
iniciar o módulo 6 — APIs REST. Não apresentar nova aula durante a pausa.
Não exigir implementação solitária do exercício sugerido. Registro anterior da
publicação salvo em 13eaadd5b95c525fddd7d64a9f6b7c2e447d3be7; esta atualização
registra a decisão de pausa, sem alterações na aplicação ou novas verificações de execução.
Registros abaixo são históricos.

Retomada realizada em 19/10/2026: AGENTS.md, roteiro, progresso e aula/script
5.34 conferidos. Git inicialmente sem alterações locais; HEAD, origin/main e
consulta direta à main remota retornaram
`a6ddff9ed037e6069bb07ae362e52d003d01f95c`, salvamento da pausa anterior.
`docker compose ps --all` não listou containers deste projeto; nenhum foi iniciado.
Revisão de login/usuário, contextos, permissões, condições e comandos do sqlcmd
reapresentada. Nenhum SQL executado nesta retomada; ausência da conta/tabelas
permanece como resultado da verificação de 16/10, sem nova consulta ao banco.
Entendimento da 5.34 continua aguardando confirmação explícita. Próximo passo:
responder dúvidas e aguardar essa confirmação antes de iniciar a 5.35.

Encerramento mais recente: em 16/10/2026, o aluno pediu "salve o progresso,
continuaremos outro dis". Pedido de pausa e salvamento; não é confirmação de
entendimento da 5.34. Até a 5.33, entendimento confirmado e checkpoint publicado
em f14a335a35b2400324020fedc08aeb4c454a8386.

Ponto exato de retomada: etapa 5.34, script
`docker/sqlserver/criar-usuario-testes.sql`, explicado na aula
`docs/aulas/05-34-script-conta-testes.md`. Login/usuário loja_testes ainda ausentes;
script apenas escrito e analisado com PARSEONLY, sem aplicar CREATE/ALTER/GRANT.
Não há senha local de testes, configuração Laravel de testes ou tabelas em
loja_test. Nenhuma suíte foi executada. Não executar o script ao retomar.

Ler AGENTS.md, roteiro e progresso; conferir Git e arquivos; reapresentar o
script ou responder às dúvidas e aguardar confirmação explícita de entendimento
da 5.34. Só então seguir para a 5.35. A autorização anterior para loja_migracoes
em loja não se estende especificamente à nova conta loja_testes.

Script e registros serão salvos em commit de encerramento e publicados conforme
o pedido de salvamento, sem declarar a etapa pedagogicamente concluída. Para o
SHA deste registro, consultar `git log -1` e comparar HEAD, origin/main e a main
remota; o commit não contém seu próprio SHA. O último checkpoint pedagógico
confirmado continua sendo a 5.33.

Em 09/10/2026, o aluno informou que continuará o curso amanhã em outro chat.
A sessão de 09/10 terminou após a explicação da etapa 3.11, sem confirmação
de entendimento dessa etapa naquele momento.

O ponto de retomada deixado naquela sessão era a aula 3.11: ativar/desativar,
encapsulamento, `$this`, void e estado de cada instância. Essa retomada foi
realizada em 12/10, conforme o registro abaixo.

Código e aula 3.11 publicados e sincronizados no checkpoint `8d54d1a`.
Este registro de encerramento é uma atualização de documentação; não altera
o código ou o ambiente Docker.

Retomada realizada em 12/10/2026: instruções, roteiro, progresso, código da
etapa e estado do Git conferidos. Não havia alterações locais. A consulta
`git ls-remote origin refs/heads/main` confirmou `aa9642e` no GitHub, igual
a HEAD e origin/main; esse commit contém o registro de encerramento anterior.
A explicação da etapa 3.11 foi retomada e a demonstração executada novamente.
Após a reapresentação, o aluno confirmou entendimento com "entendi" em
12/10/2026. Etapa 3.11 concluída; próximo passo: interface da etapa 3.12.
Registro de confirmação salvo no commit local `0c2106b`. O push ficou pendente:
a revisão automática rejeitou a publicação por exigir aprovação explícita da
branch pública `main`. Depois, o aluno autorizou explicitamente os checkpoints
concluídos nesse destino: "Sim, autorizo os checkpoints concluídos".
Etapa 3.12 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint `846ada2` criado e publicado junto com o registro da 3.11.
HEAD, origin/main e `git ls-remote origin refs/heads/main` retornaram
`846ada28c4dfd4ad4db61fd631ac7a3d39dbac6f`; publicação confirmada.
Etapa 3.13 implementada, explicada e verificada. Após o esclarecimento sobre
onde ItemCarrinho é instanciado, o aluno confirmou entendimento com "entendi".
Checkpoint da composição `197470b` publicado conforme autorização existente.
HEAD, origin/main e a consulta direta à branch main remota retornaram
`197470b1570cbfa02d736166566e5f796deb8cb4`; publicação confirmada.
Etapa 3.14 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do subtotal `b45dc75` publicado conforme autorização existente.
HEAD, origin/main e a consulta direta à main remota retornaram
`b45dc7509c945d5974d6768876c464534f6d4878`; publicação confirmada.
Etapa 3.15 apresentada, verificada e confirmada com "entendi": requisitos de
PHPUnit atendidos pelo PHP do container existente. Checkpoint de documentação
`3dba56d` publicado; HEAD, origin/main e consulta direta à main remota retornaram
`3dba56d1d161f9de05e98273950fc785dc1089b8`.
Etapa 3.16 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint da instalação `9a9c43a` publicado conforme autorização existente.
HEAD, origin/main e consulta direta à main remota retornaram
`9a9c43a5dce5696ab5230ba8626a761763fdb940`; publicação confirmada.
Etapa 3.17 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do primeiro teste `071aacd` publicado; HEAD, origin/main e consulta
direta à main remota retornaram `071aacd00da4180bd8ec1a210708b91577c79ecf`.
Etapa 3.18 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de quantidade zero `9d6ceb0` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`9d6ceb0fbb7f669203ed6bad2d91789201b11c13`.
Etapa 3.19 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de quantidade negativa `188ff33` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`188ff3341e1b0abdf63a008f066810cc28852562`.
Etapa 3.20 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint da menor quantidade válida `95630cd` publicado; HEAD, origin/main
e consulta direta à main remota retornaram
`95630cdea45c1885a277b833ae26a0cca32cafac`.
Etapa 3.21 implementada, explicada, verificada e confirmada com "entendi".
Checkpoint do teste de preço zero `a5caa53` publicado; HEAD, origin/main e consulta
direta à main remota retornaram `a5caa5380ea88a83de3f48655c7e8aed926929ff`.
Etapa 3.22 apresentada e documentada, sem mudança no código, e confirmada com
"entendi". Módulo 3 concluído em 12/10/2026. Checkpoint de revisão `7a4dc00`
publicado; HEAD, origin/main e consulta direta à main remota retornaram
`7a4dc008fc4418059d7057d913cea9a9336ee612`.
Etapa 4.1 apresentada e documentada, com diagnóstico do ambiente concluído,
e confirmada com "entendi" em 13/10/2026. Checkpoint da preparação `9807e53`
publicado; HEAD, origin/main e consulta direta à main remota retornaram
`9807e53416d5b45e3f903edf36aa2f3ff8381111`.
Etapa 4.2 gerou e apresentou o esqueleto em backend, sem dependências ou scripts,
e foi confirmada com "entendi" em 13/10/2026. Checkpoint cfa2e69 publicado;
HEAD, origin/main e consulta direta à main remota retornaram
`cfa2e69a9f24d6c0417406f340f02a3a079d827b`.
Etapa 4.3 preparou serviço backend e volume exclusivo, verificou montagens e
persistência. Implementação e explicação concluídas; entendimento confirmado com
"entendi" em 13/10/2026. Checkpoint dc9f4b8 publicado; HEAD, origin/main e
consulta direta à main remota retornaram
`dc9f4b88786196896d229fd5785c698d2e8253f8`.
Etapa 4.4 instalou dependências de execução e gerou lockfile/autoload; validação,
plataforma e carregamento de classes conferidos. Explicação apresentada;
entendimento confirmado com "entendi" em 13/10/2026. Sem execução de Artisan ou
HTTP Laravel. Checkpoint 4c6df27 publicado; HEAD, origin/main e consulta direta
à main remota retornaram `4c6df27b1e6ec4f04c64c55bc6fa10df2f5c8e84`.
Etapa 4.5 preparou storage e bootstrap/cache graváveis, mantendo código somente
leitura. Marcadores conferidos no host e entre containers, depois removidos.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 7c0fcea publicado; HEAD, origin/main e consulta direta à main remota
retornaram `7c0fcea3b613cb55a29923237281a4b0fd57b91c`.
Etapa 4.6 adaptou o modelo e criou ambiente local Laravel; leitura das variáveis
conferida no Docker e exclusão do .env verificada. APP_KEY ainda vazia.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint ae521c9 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `ae521c9ea4344cc408201875b454eae9b5a03f19`.
Etapa 4.7 apresentou Artisan, gerou APP_KEY local e verificou criptografia e
carregamento em outro container. Manifests gerados apresentados e ignorados.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 590f98a publicado; HEAD, origin/main e consulta direta à main remota
retornaram `590f98a7141f8223659711c659b2d857c05afc67`.
Etapa 4.8 iniciou o servidor Laravel e verificou welcome em HTTP 200, montagens,
artefatos gerados e parada/reinício com init. Laboratório preservado.
Explicação apresentada; entendimento confirmado com "entendi" em 13/10/2026.
Checkpoint 6ccf825 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `6ccf825fbb834fdba7db7fb5785bbdb2721089f1`.
Etapa 4.9 acrescentou GET /loja com saudação pelo nome configurado. Sintaxe,
registro e respostas HTTP verificados; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 1671a0b publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`1671a0b15f6bba6f8d8daafa41548d31f76f5614`.
Etapa 4.10 criou LojaController e ligou /loja a index. Sintaxes, registro e
comportamento HTTP preservado conferidos; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint f31b38e publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`f31b38eb8d3732cf6e158d8fd9eff82687d4a7fc`.
Etapa 4.11 criou view loja e retorno View no controller, com dado nomeLoja.
HTTP, renderização e escape verificados; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 1d93ab8 publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`1d93ab8913540a1d27bcdd0c789622dd37e54567`.
Etapa 4.12 enviou nomes demonstrativos para a view e exibiu com @foreach.
Sintaxe e lista renderizada conferidas; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint 37b7485 publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`37b74854c1b1d5b0a3b72c9b3c65514676bf2a62`.
Etapa 4.13 acrescentou condição de lista vazia na view e verificou os dois
ramos por renderização. Explicação apresentada; entendimento confirmado com
"entendi" em 13/10/2026. Checkpoint b944f4e publicado; HEAD, origin/main e
consulta direta à main remota retornaram `b944f4e30ae1bce7dc1e6914bdc479cac35ee245`.
Etapa 4.14 criou middleware de resposta e associou-o a /loja. Sintaxes, registro
e atuação/escopo HTTP verificados; explicação apresentada e entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint 354626c publicado; HEAD, origin/main e
consulta direta à main remota retornaram `354626c0dbd7d89b6c51455d88b124e0d5cb06e2`.
Etapa 4.15 extraiu nomes para CatalogoDemonstracao e recebeu a classe no método
index por injeção. Sintaxes e HTTP conferidos; explicação apresentada e entendimento
confirmado com "entendi" em 13/10/2026. Checkpoint dca8ccd publicado; HEAD,
origin/main e consulta direta à main remota retornaram
`dca8ccd583c338c7ce8581a7f639144495fbdc7a`.
Etapa 4.16 moveu a injeção para o construtor com propriedade promovida; sintaxe
e HTTP conferidos. Explicação apresentada; entendimento confirmado com "entendi"
em 13/10/2026. Checkpoint 5da3709 publicado; HEAD, origin/main e consulta direta
à main remota retornaram `5da37098c407a616d3a521b04864a583b7c947e2`.
Etapa 4.17 definiu contrato, implementação e binding no provider; controller
recebe a interface. Sintaxes, resolução e HTTP conferidos; entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint 92d6e5f publicado; HEAD, origin/main e
consulta direta à main remota retornaram `92d6e5f925abb704b9ae57e366a0d7ac024e959b`.
Etapa 4.18 apresentou User como model Eloquent e demonstrou atributos em memória,
sem aplicação inicializada ou banco. Explicação apresentada; entendimento confirmado
com "entendi" em 13/10/2026. Checkpoint aa372c6 publicado; HEAD, origin/main e
consulta direta à main remota retornaram `aa372c66ef54086f72d9aea2160a67fcdc9aaa86`.
Etapa 4.19 apresentou revisão do módulo 4 e conferiu entrega HTTP e pendências.
Entendimento da revisão confirmado com "entendi" em 13/10/2026; módulo 4 concluído.
Checkpoint 2346772 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `23467729d7d3d5ebf6587084cab007ad1afa4df7`. Módulo 5 iniciado na 5.1,
com diagnóstico de preparação apresentado; entendimento confirmado com "entendi".
Checkpoint 5.1 publicado: 41d0660; HEAD, origin/main e consulta direta à main
remota retornaram `41d0660945bd3b91dc3a036017986e1adc6c2ff5`.
Etapa 5.2 implementou imagem própria do backend com ODBC 18, validada e aplicada;
explicação apresentada, entendimento da 5.2 confirmado com "entendi" em 13/10/2026.
Checkpoint 5709dfe publicado; HEAD, origin/main e consulta direta à main remota
retornaram `5709dfefd739105efeff07691e6c127faa54dac6`.
Etapa 5.3 instalou/habilitou drivers PHP 5.13.3 com PIE 1.5.2 na imagem backend;
explicação apresentada e verificações passaram; entendimento confirmado com "entendi"
em 13/10/2026, após esclarecimento sobre PIE.
Checkpoint 5ba53e2 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `5ba53e2f6d6fda3b962909b2d3e2eb9c919eb6b8`.
Etapa 5.4 introduziu SQL Server 2022 Developer com imagem fixada, volume e
configuração local; servidor/rede conferidos, entendimento confirmado com "entendi"
em 13/10/2026, após esclarecimentos sobre acesso. Aluno pediu aviso quando puder
conectar pelo DBeaver e autorizou seguir o curso; acesso host ainda não configurado.
Checkpoint d9fba40 publicado; HEAD, origin/main e consulta direta à main remota
retornaram `d9fba40e398512cb63385e970e8578ffe90441d2`.
Etapa 5.5 criou loja/loja_test e conferiu estado, arquivos, conexões e reexecução;
entendimento confirmado com "entendi" em 13/10/2026. Acesso local pelo DBeaver
será preparado na 5.6.
Checkpoint fc2cdbc publicado; HEAD, origin/main e consulta direta à main remota
retornaram `fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.
Etapa 5.6 publicou porta SQL local, conferiu conexão autenticada e apresentou
dados DBeaver; aviso ao aluno cumprido. Aluno relatou "apareceu loja" no DBeaver,
confirmando execução da consulta no banco loja; entendimento da 5.6 confirmado
com "entendi" em 13/10/2026.
Checkpoint 5.6 publicado: c7f58ee; HEAD, origin/main e consulta direta à main remota
retornaram `c7f58ee64ab62b1b053cd27b96b644772ecac98f`.
Etapa 5.7 preparou login/usuário da aplicação no banco loja, com credencial local
e papéis de dados; verificações passaram, entendimento confirmado com "entendi"
em 13/10/2026, após esclarecer usuário criado e view sys.database_principals.
Checkpoint 5.7 publicado: 063e4eb; HEAD, origin/main e consulta direta à main
remota retornaram `063e4ebc0c1ec733b183005c922ffd967f4ac35b`.
Etapa 5.8 preparou ambiente Laravel e conferiu configuração sem consulta SQL;
explicação apresentada, entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.8 publicado: e0e06ef; HEAD, origin/main e consulta direta à main
remota retornaram `e0e06ef063ec245739e18f684336d218751687e9`.
Etapa 5.9 realizou primeira consulta pelo Laravel com comando diagnóstico;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.9 publicado: 173ed00; HEAD, origin/main e consulta direta à main
remota retornaram `173ed0089496181ec510cd521d7995a62045ca54`.
Etapa 5.10 documentou desenho de produtos; explicação apresentada e entendimento
confirmado com "entendi" em 14/10/2026. Nenhuma tabela ou migration criada.
Checkpoint 5.10 publicado: b160a68; HEAD, origin/main e consulta direta à main
remota retornaram `b160a6827c99cd30f6edbea3e1f19556fc06b147`.
Etapa 5.11 gerou primeiro arquivo de migration, verificado sem aplicar ao banco;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.11 publicado: 3e5cb93; HEAD, origin/main e consulta direta à main
remota retornaram `3e5cb9370b37ddc666d4ccd84441589644a0256f`.
Etapa 5.12 preencheu colunas e conferiu SQL em simulação, sem aplicar ao banco;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.12 publicado: bbec195; HEAD, origin/main e consulta direta à main
remota retornaram `bbec195570dc903909bc0a629ce78c57e9ed5d6a`.
Etapa 5.13 preparou SQL e senha local; rejeição inicial resolvida pela autorização
explícita do aluno. Conta criada, autenticada e permissões/reexecução conferidas;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.13 publicado: 94e3322; HEAD, origin/main e consulta direta à main
remota retornaram `94e3322369b13dcf3bf6201c90899e2f99b5893a`.
Etapa 5.14 configurou e verificou as duas conexões Laravel, sem aplicar migrations;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.14 publicado: 26e7b5b; HEAD, origin/main e consulta direta à main
remota retornaram `26e7b5b8a674e775b2e882ea4c78f62aeed9d945`.
Etapa 5.15 aplicou somente a migration de produtos e conferiu esquema e registro;
explicação apresentada e entendimento confirmado com "entendi" em 14/10/2026.
Checkpoint 5.15 publicado: 36db8e8; HEAD, origin/main e consulta direta à main
remota retornaram `36db8e85393e59404ba55f3556d2fc9d356746c9`.
Etapa 5.16 gerou model Produto e conferiu convenções em memória;
explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.16 publicado: a953fa4; HEAD, origin/main e consulta direta à main
remota retornaram `a953fa4377335a06b5b8fb1089d1d8d6172db6ea`.
Etapa 5.17 configurou Fillable e demonstrou arrays em memória;
explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.17 publicado: 340d6ea; HEAD, origin/main e consulta direta à main
remota retornaram `340d6ea79fa644031e358b912836fcfd25bc5061`.
Etapa 5.18 configurou cast inteiro do preço e conferiu conversão em memória;
explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.18 publicado: adb466c; HEAD, origin/main e consulta direta à main
remota retornaram `adb466c3fab6e5fcfe0e16f3edef970e49609fd2`.
Etapa 5.19 consultou produtos pelo Eloquent, com coleção vazia e SELECT real;
explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.19 publicado: 133591a; HEAD, origin/main e consulta direta à main
remota retornaram `133591af4ae4b7f63d982a3241bae67df3a07deb`.
Etapa 5.20 gerou ProdutoSeeder com run vazio, sem executar cadastros.
Sintaxe, autoload, herança e assinatura conferidos em memória; explicação
apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.20 publicado: e811031; HEAD, origin/main e consulta direta à main
remota retornaram `e81103197aece04c52b979b3999eebd0ba9fe1db`.
Etapa 5.21 escreveu Produto::create em run com um produto de demonstração;
sintaxe conferida sem executar o cadastro. Explicação apresentada;
entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.21 publicado: 9da189c; HEAD, origin/main e consulta direta à main
remota retornaram `9da189c24c523373501eb30a181087350d3713d5`.
Etapa 5.22 executou somente ProdutoSeeder uma vez; Camiseta persistida,
relida em outro processo e quantidade 1 no comando Eloquent conferidas.
Explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.22 publicado: 9d03edc; HEAD, origin/main e consulta direta à main
remota retornaram `9d03edc59b912352e2b6fe707637716694689503`.
Etapa 5.23 acrescentou foreach da coleção e impressão dos atributos do model
no comando de consulta. Sintaxe e saída real conferidas; explicação
apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.23 publicado: 11f46d2; HEAD, origin/main e consulta direta à main
remota retornaram `11f46d22361d28551ddf6165a8fff042b34a42e5`.
Etapa 5.24 preparou firstOrCreate em ProdutoSeeder com busca pelo nome e
dados adicionais para criação; sintaxe conferida sem executar o seeder.
Explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.24 publicado: 162b7aa; HEAD, origin/main e consulta direta à main
remota retornaram `162b7aa2837f10450b4825ece1513ae3a5395c9d`.
Etapa 5.25 executou duas reexecuções sequenciais, sem novo cadastro ou mudança
dos campos/datas; SELECT capturado e leitura posterior conferidos.
Explicação apresentada e entendimento confirmado com "entendi" em 15/10/2026.
Checkpoint 5.25 publicado: 8ec24b4; HEAD, origin/main e consulta direta à main
remota retornaram `8ec24b482bd3febe764679f76f5519e740e631af`.
Etapa 5.26 criou CatalogoEloquent com leitura de nomes do banco, cumprindo
Catalogo; sintaxe, retorno e SQL real conferidos. Binding preservado;
explicação apresentada e entendimento confirmado com "entendi" em 16/10/2026.
Checkpoint 5.26 publicado: f14564c; HEAD, origin/main e consulta direta à main
remota retornaram `f14564c29d64fdd07a709c48da7db1a978db445c`.
Etapa 5.27 trocou o binding para CatalogoEloquent; resolução e página HTTP
com Camiseta do banco conferidas. Explicação apresentada e entendimento
confirmado com "entrendi" em 16/10/2026.
Checkpoint 5.27 publicado: 0eb7973; HEAD, origin/main e consulta direta à main
remota retornaram `0eb79735c54353519f2d3be5d7237cdde415d64e`.
Etapa 5.28 ajustou dois textos da view e conferiu HTTP real com a Camiseta.
Explicação apresentada e entendimento confirmado com "entendi" em 16/10/2026.
Checkpoint 5.28 publicado: 1cd8038; HEAD, origin/main e consulta direta à main
remota retornaram `1cd8038f21b6f40bfea94d1c5cb1f6f41c4a537d`.
Etapa 5.29 acrescentou filtro de status ativo em CatalogoEloquent; sintaxe,
SQL parametrizado, array e HTTP conferidos. Explicação apresentada,
entendimento confirmado com "entendi" em 16/10/2026.
Checkpoint 5.29 publicado: 7199685; HEAD, origin/main e consulta direta à main
remota retornaram `7199685ec8b6c7b9836535c2f91010c1dcbf7e96`.
Etapa 5.30 acrescentou orderBy('nome'); sintaxe, SQL crescente, retorno e
HTTP conferidos. Explicação apresentada e entendimento confirmado com "entendi" em 16/10/2026.
Checkpoint 5.30 publicado: 8a61f8d; HEAD, origin/main e consulta direta à main
remota retornaram `8a61f8da568429203aeb75cdecd3576ca682cbc6`.
Etapa 5.31 diagnosticou ferramentas, XML e isolamento SQL de testes, sem
instalação/configuração. Explicação apresentada e entendimento confirmado
com "entendi" em 16/10/2026.
Checkpoint 5.31 publicado: 4233936; HEAD, origin/main e consulta direta à main
remota retornaram `423393609a1e7323c6a2a8240542e80e85f4f266`.
Etapa 5.32 instalou 33 pacotes de desenvolvimento do lock e conferiu PHPUnit,
plataforma e autoload; sem suíte ou SQL. Entendimento confirmado com "entendi"
em 16/10/2026. Checkpoint 5.32 publicado: 6d86416; HEAD, origin/main e consulta
remota retornaram `6d864163d3131b367a429a836dc50a953e989f91`.
Etapa 5.33 executou descoberta dos pacotes e conferiu ajuda de artisan test,
manifests e HTTP, sem suíte. Entendimento confirmado com "entendi" em 16/10/2026.
Checkpoint 5.33 publicado: f14a335; HEAD, origin/main e consulta à main remota
retornaram `f14a335a35b2400324020fedc08aeb4c454a8386`.
Etapa 5.34 preparou script SQL para conta exclusiva de testes, com análise
sintática sem execução do DDL e ausência da conta conferida depois.
Explicação apresentada; aguardando entendimento.

## Perfil e escolhas confirmadas no planejamento

- Já programa em PHP; pouca experiência com Laravel.
- JavaScript básico e React inicial.
- Projeto: loja e gestão de pedidos.
- Repositório novo e público, nome sugerido `curso-loja-fullstack`.
- JavaScript antes de TypeScript.
- Node.js também como backend de notificações.
- Desenvolvimento e testes em Docker.
- Prática local antes da AWS; orçamento a definir no módulo de deploy.
- O professor escreve e explica; o aluno acompanha, pergunta e confirma
  entendimento antes de cada avanço.

Aceitar o plano confirmou estas escolhas, não o entendimento das futuras aulas.

## Etapa 1.1

Objetivo: guardar o roteiro e um ponto de retomada que não dependa do histórico
de um chat, além de orientar o professor em novas sessões.

Arquivos criados:

- `docs/curso.md`: roteiro completo, entregas, método, arquitetura e decisões.
- `docs/progresso.md`: estado real da aprendizagem e da publicação.
- `AGENTS.md`: instruções para continuar respeitando o ritmo combinado.

Explicação preparada nesta etapa: Markdown é texto de documentação; `#` define
um título e `-` inicia um item. O roteiro descreve o caminho completo; o registro
de progresso guarda onde paramos; as instruções orientam a retomada do professor.
As próximas sessões devem ler esses arquivos e conferir o estado do código.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.1 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.2

Objetivo: definir o que deve ficar fora do Git e apresentar o projeto a quem
abrir a pasta ou o futuro repositório no GitHub.

Arquivos criados:

- `.gitignore`: configurações `.env`, dependências, resultados gerados, logs e
  configurações locais do ambiente; preserva os modelos `.env.example`.
- `README.md`: apresentação, estado atual, links para documentação, tecnologias
  planejadas e método das aulas. Não anuncia uma aplicação já executável.

Explicação desta etapa: comentários com `#`, padrões de nomes, curinga `*`,
exceção `!`, barra final para pastas e barra inicial para a raiz do projeto.
As regras se aplicam também aos futuros subprojetos; arquivos de lock serão
versionados. O `.gitignore` não retira arquivos já rastreados do histórico.
O README usa títulos, listas e links Markdown relativos à sua localização.

Verificação concluída com `git check-ignore`, usando um repositório temporário
em `/tmp`, removido ao terminar, sem inicializar o Git do projeto: 15 caminhos
de exemplo corretamente ignorados e 11 candidatos a versionamento preservados,
incluindo modelos `.env.example` na raiz e em subpastas, código e lockfiles.
Todos os links relativos do README apontam para arquivos existentes.
Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.2 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.3

Objetivo: transformar a pasta em um repositório local, sem adicionar arquivos,
criar commits ou publicar no GitHub nesta etapa.

Comando explicado e executado: `git init -b main`.

- `git`: programa de controle de versões.
- `init`: inicializa os metadados do repositório na pasta `.git`.
- `-b main`: define `main` como nome da branch inicial.
- Branch: uma linha de desenvolvimento do projeto.
- `.git/HEAD` contém `ref: refs/heads/main`, apontando para essa branch.
- `.git/config` guarda configuração local; `.git/objects` guardará objetos do
  histórico e `.git/refs` guardará referências. São arquivos gerenciados pelo Git.

A pasta `.git` estava montada como somente leitura no modo restrito. A execução
ampliada de `git init -b main` foi aprovada e concluiu a inicialização. Nenhuma
permissão da pasta foi alterada manualmente.

Verificações concluídas: `git rev-parse --git-dir` retornou `.git`;
`git symbolic-ref --short HEAD` retornou `main`; `git status --short`, executado
sem atualizações opcionais de metadados, mostrou `.gitignore`, `AGENTS.md`,
`README.md` e `docs/` como `??` (arquivos ainda não rastreados).
`git remote -v` não retornou remotos. Não houve `git add`, commit ou push.
O README foi atualizado para refletir a inicialização do repositório.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.3 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.4

Objetivo: consultar o estado do repositório e selecionar os cinco arquivos
do checkpoint inicial sem criar o commit nesta etapa.

Conceitos explicados:

- `git status` mostra o estado dos arquivos; `--short` resume a saída.
- `??` identifica arquivos ainda não rastreados.
- Staging, ou área de preparação, guarda o conteúdo selecionado para o próximo
  commit. O índice do Git representa essa seleção.
- `git add .gitignore AGENTS.md README.md docs/curso.md docs/progresso.md`
  seleciona explicitamente os cinco arquivos do curso.
- `A ` na saída curta indica um arquivo novo preparado para o commit. A primeira
  coluna representa a área de preparação; a segunda, alterações locais ainda
  não preparadas. `AM` significa adicionado ao staging e modificado depois.
- Se um arquivo mudar depois do `git add`, é necessário adicioná-lo novamente
  para que o commit inclua a versão atualizada.
- `git diff --cached --stat` resume o conteúdo selecionado, comparado ao último
  commit; como não existe commit, mostra as adições ao repositório vazio.

Seleção executada com execução ampliada devido à proteção de escrita em `.git`.
Verificação concluída: os cinco arquivos apareceram como `A ` em
`git status --short`; `git diff --cached --stat` mostrou apenas os cinco arquivos;
`git diff --cached --check` não apontou problemas de espaços e
`git diff --exit-code` não encontrou mudanças fora da área de preparação.
README e progresso foram atualizados para refletir a seleção e adicionados
novamente para incluir esses registros no checkpoint. Nenhum commit ou push
foi executado nesta etapa.
Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.4 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.5

Objetivo: registrar os cinco arquivos iniciais em um commit local e distinguir
esse registro da publicação no GitHub.

Autoria: identidade já configurada no Git conferida com `git var GIT_AUTHOR_IDENT`
e `git var GIT_COMMITTER_IDENT`; nenhuma configuração global de autoria alterada.

Comando da etapa: `git commit -m "docs: inicia curso e registra progresso"`.

- `commit` registra o conteúdo da área de preparação no histórico local.
- `-m` define a mensagem sem abrir um editor; as aspas agrupam a mensagem.
- `docs:` é uma convenção para identificar mudanças de documentação.
- O commit tem identificador (SHA), autoria, data, mensagem e referência ao
  conteúdo dos arquivos. O primeiro commit não tem um commit anterior.
- `git log -1 --oneline` exibe o último commit com identificador abreviado.
- `git status --short` sem saída significa que não há alterações pendentes
  nos arquivos visíveis ao Git; arquivos ignorados podem continuar no disco.
- Um commit local só será publicado quando enviarmos o histórico ao remoto.

README e progresso atualizados antes de finalizar a seleção com `git add`.
Resultado verificado: commit `afb0d2c` criado na branch `main`, com a mensagem
acima e exatamente os cinco arquivos iniciais. A verificação ao encerrar a
etapa encontrou um commit no histórico, nenhum remoto e nenhuma alteração
pendente no staging ou na pasta de trabalho.

Confirmação do aluno: recebida em 08/10/2026, com a mensagem "entendi".
Etapa 1.5 concluída quanto ao entendimento; publicação confirmada na etapa 1.7.

## Etapa 1.6

Objetivo: preparar o repositório público GitHub e configurar seu endereço no
Git local, sem executar o push antes da confirmação de entendimento.

Verificações de acesso:

- A conexão GitHub identificou a conta autenticada como `julesjrenck`.
- A consulta a `julesjrenck/curso-loja-fullstack` retornou 404. A existência ou
  acessibilidade do repositório não foi confirmada; não afirmar que foi criado.
- As ferramentas GitHub disponíveis não oferecem criação de repositórios.
- GitHub CLI (`gh`), credencial de API nas variáveis usuais e helper de
  credenciais Git não estão disponíveis neste ambiente.
- O acesso pelo conector GitHub não comprova a autenticação do Git no terminal.
  O envio será verificado na etapa 1.7, inclusive pelo transporte SSH existente.

Comando explicado e executado:
`git remote add origin https://github.com/julesjrenck/curso-loja-fullstack.git`.

- Remote: endereço de outro repositório, neste caso hospedado no GitHub.
- `remote add`: adiciona o endereço à configuração local do Git.
- `origin`: apelido convencional para esse endereço.
- Adicionar o remoto não cria o repositório no GitHub nem envia os arquivos.
- `git remote -v`: mostra os endereços usados para buscar (`fetch`) e enviar
  (`push`) o histórico. Mostrar essas linhas não significa que houve envio.

Configuração verificada: a URL HTTPS acima foi gravada em `remote.origin.url`.
Uma regra de URL já existente no ambiente converte HTTPS GitHub para SSH;
por isso `git remote -v` e `git remote get-url origin` exibem
`git@github.com:julesjrenck/curso-loja-fullstack.git`. A regra foi preservada.
Nenhuma tentativa de push foi feita nesta etapa.

Ação necessária do aluno: abrir
[o formulário de criação](https://github.com/new?owner=julesjrenck&name=curso-loja-fullstack&visibility=public)
na conta `julesjrenck`, confirmar nome `curso-loja-fullstack` e visibilidade
pública, e criar o repositório vazio. Não adicionar README, `.gitignore`, licença
ou conteúdo gerado, pois o histórico inicial já existe localmente. Se o GitHub
informar que o nome está em uso, enviar o endereço do repositório para inspeção.

Fonte da orientação: [Adicionar código local ao GitHub](https://docs.github.com/en/migrations/importing-source-code/using-the-command-line-to-import-source-code/adding-locally-hosted-code-to-github).

O registro desta aula será incluído em um checkpoint local usando os comandos
`git add docs/progresso.md` e
`git commit -m "docs: registra preparacao do remoto GitHub"`, já ensinados.

Confirmação do aluno: recebida em 08/10/2026, com "criei e entendi".
A etapa 1.7 confirmou pela API que o repositório existe, é público, pertence a
`julesjrenck` e não tem branches. A etapa 1.6 está concluída.

## Etapa 1.7

Objetivo: enviar os commits locais para o GitHub e verificar a correspondência
entre o histórico local e a branch remota. Execução concluída; entendimento
da explicação do push ainda não confirmado.

Comando explicado e executado: `git push -u origin main`.

- `push`: envia os commits e atualiza a branch no destino remoto.
- `origin`: apelido do repositório GitHub já configurado.
- `main`: branch local que queremos publicar.
- `-u`: configura a branch remota `origin/main` como referência de acompanhamento
  da `main` local; nas próximas publicações, poderemos usar apenas `git push`.

Diagnóstico anterior à publicação:

- A API GitHub confirmou `julesjrenck/curso-loja-fullstack` público e acessível.
  O endpoint de branches retornou `[]`, indicando repositório vazio.
- O modo restrito não resolveu `github.com`; as verificações de rede exigiram
  execução ampliada, conforme autorização já existente para GitHub.
- O primeiro acesso SSH retornou `Host key verification failed`.
- A chave pública Ed25519 do servidor foi obtida da documentação oficial e
  verificada com o fingerprint
  `SHA256:+DiY3wvvV6TuJJhbpZisF/zLDA0zPMSvHdkr4UvCOqU`.
- A entrada oficial foi adicionada a `~/.ssh/known_hosts` com execução ampliada,
  preservando as entradas existentes. Esse arquivo reconhece o servidor;
  não cadastra a identidade do usuário no GitHub.
- O acesso posterior pelo Git retornou `Permission denied (publickey)`.
- O par existente `~/.ssh/id_ed25519` e `~/.ssh/id_ed25519.pub` foi validado:
  as chaves correspondem e a chave privada é utilizável sem senha interativa.
  Nenhuma chave privada foi exibida, copiada para o projeto ou versionada.
- O conector GitHub não oferece cadastro de chaves SSH e sua autenticação não
  autentica automaticamente o Git no terminal.
- Nessa sessão de diagnóstico, nenhum `git push` foi executado: o acesso ainda
  não tinha sido liberado. O resultado após o cadastro está registrado abaixo.

Fontes: [Chaves do servidor GitHub](https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/githubs-ssh-key-fingerprints)
e [Cadastrar chave SSH na conta](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account).

Orientação apresentada ao aluno: abrir [SSH and GPG keys](https://github.com/settings/keys)
na conta `julesjrenck`, escolher `New SSH key`, título `curso-loja-fullstack`,
tipo `Authentication Key`, colar a chave pública apresentada na conversa e
confirmar com `Add SSH key`. A chave pública pode ser obtida novamente no arquivo
`~/.ssh/id_ed25519.pub`; não pedir chave privada ou senha ao aluno.

Resultado após o cadastro, informado pelo aluno com "adicionei":

- `git ls-remote origin` concluiu com sucesso e sem referências; a API de
  branches também retornou `[]`, confirmando que o destino estava vazio.
- `git push -u origin main` concluiu com sucesso e criou `main` no GitHub.
- A saída informou `main -> main` e o acompanhamento de `origin/main`.
- `git rev-parse HEAD` e `git rev-parse origin/main` retornaram o mesmo SHA:
  `a43617042726cda586c24b630eab8734b53f7a3c`.
- A API GitHub para `commits/main` confirmou esse mesmo SHA. Os três commits
  iniciais foram publicados preservando o histórico local.
- `git rev-parse --abbrev-ref --symbolic-full-name '@{upstream}'` retornou
  `origin/main`; `git status --short --branch` mostrou `main...origin/main`
  sem alterações pendentes.
- O cadastro da chave resolve a autenticação. A mensagem "adicionei" não é
  uma confirmação de entendimento da explicação do push.

Explicação da saída: `[new branch] main -> main` informa a criação da branch
remota a partir da local. O vínculo de acompanhamento permite ao Git comparar
as duas branches e usar o destino em futuros comandos `git push`.

README e progresso atualizados para registrar o sucesso, com novo checkpoint
local `docs: registra primeiro push e sincronizacao`. Após o commit, enviar
essa atualização com `git push` e conferir novamente os SHAs local/remoto.
O SHA acima identifica o primeiro envio verificado, não o commit posterior que
contém este registro. Para consultar o último publicado, usar `origin/main`
ou a página do GitHub, evitando inserir o SHA do commit em seu próprio conteúdo.

Registro desta sessão em checkpoint local com os comandos já ensinados:
`git add AGENTS.md README.md docs/progresso.md` e
`git commit -m "docs: registra criacao do repositorio e pendencia SSH"`.

Entendimento da etapa 1.7: confirmado pelo aluno com "entendi", após os
esclarecimentos sobre SSH. Módulo 1 concluído em 08/10/2026.

## Etapa 2.1

Objetivo: entender a diferença entre imagem e container e confirmar que
conseguimos consultar o serviço Docker antes da primeira execução de PHP.

Conceitos apresentados:

- Imagem: pacote de arquivos, executáveis, bibliotecas e configurações que
  serve de base para criar containers; por exemplo, uma imagem com PHP 8.4.
- Container: instância criada a partir da imagem, com ambiente próprio para
  executar um processo. Pode estar em execução ou parada.
- Uma mesma imagem pode originar vários containers, cada um com seu estado.
- Analogia com OOP: imagem se aproxima de uma classe/modelo; container, de uma
  instância. É uma analogia didática, não uma implementação de classes PHP.
- Cliente Docker: programa `docker`, que recebe nossos comandos.
- Serviço Docker, ou daemon: processo que atende esses comandos e gerencia
  imagens, containers, redes e volumes.
- `docker --version` verifica o cliente; `docker compose version`, o Compose;
  `docker info` consulta o serviço. A versão do cliente, sozinha, não comprova
  que o serviço esteja acessível.

Verificações executadas:

- Cliente Docker: 29.8.2; Compose: v5.5.1; contexto ativo: `default`.
- A consulta `docker info` no modo restrito retornou permissão negada no socket
  `/var/run/docker.sock`.
- Com execução ampliada, o comando
  `docker info --format '{{json .ServerVersion}} {{json .OSType}} {{json .Architecture}}'`
  retornou `"29.8.1" "linux" "x86_64"`. `--format` foi usado apenas para
  selecionar os campos relevantes, sem alterar a configuração do Docker.
- O daemon está disponível pela execução ampliada. O acesso no modo restrito
  permanece limitado; não confundir a restrição com serviço desligado.
- Nenhuma instalação, mudança de grupos ou permissões do socket foi feita.
- Nenhum container, imagem PHP, Dockerfile ou arquivo Compose foi criado nesta
  etapa. A execução do primeiro container pertence à etapa seguinte.

Fontes: [Imagem](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-an-image/),
[Container](https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-a-container/)
e [Cliente e daemon Docker](https://docs.docker.com/get-started/docker-overview/).

Arquivos atualizados: README (estado do projeto), roteiro (situação dos módulos)
e este registro (confirmação do módulo 1 e ponto de retomada do módulo 2).
Checkpoint da etapa: `docs: inicia modulo Docker e registra conceitos`.

Confirmação de entendimento da etapa 2.1: recebida em 08/10/2026 com "entendi".

## Etapa 2.2

Objetivo: executar um primeiro comando PHP dentro de um container e observar
o ciclo de criação, execução, término e remoção.

Aula salva em `docs/aulas/02-02-primeiro-container.md`, com comando, explicação
dos argumentos, resultados e fontes. O README aponta para essa página.

Comando explicado e executado:
`docker run --rm --name curso-loja-php-versao php:8.4.26-cli-bookworm php -v`.

- A tag foi conferida na lista oficial da imagem PHP; fixa a versão 8.4.26,
  variante CLI e base Debian 12 (Bookworm).
- A consulta inicial não encontrou container com esse nome. Outros containers
  e imagens do ambiente foram preservados.
- O Docker baixou a imagem oficial e executou PHP 8.4.26 (CLI) com código 0.
- Após o término, a consulta de containers não encontrou o container da aula:
  ele foi removido por `--rm`. A imagem permaneceu disponível.
- Imagem inspecionada: Linux `amd64`, digest
  `php@sha256:836ac6c672d1372a47c8fd61b625015bd07760f493fb2eaab2087636498a2b4b`.
- Não foram compartilhadas pastas ou portas; nenhum servidor web foi iniciado.
- Ainda não há Dockerfile, Compose ou aplicação da loja.

Arquivos atualizados: página da aula, README, resumo do roteiro e progresso.
Checkpoint local:
`docs: registra primeira execucao PHP em Docker`.

Confirmação de entendimento da etapa 2.2: recebida em 08/10/2026 com "entendi".

## Etapa 2.3

Objetivo: construir a primeira imagem própria do curso com um Dockerfile mínimo
e um contexto limitado por `.dockerignore`, e verificar seu comando padrão.

Arquivos de implementação criados e explicados:

- `Dockerfile`: `FROM php:8.4.26-cli-bookworm` e `CMD ["php", "-v"]`.
- `.dockerignore`: exclui tudo com `**` e permite apenas `Dockerfile` e
  `.dockerignore` por exceções com `!`, nesta etapa sem código a copiar.

Explicação e comandos salvos em `docs/aulas/02-03-dockerfile.md`.
O README apresenta o estado atual, aponta para a aula e inclui os comandos.

Comandos explicados e executados, com execução ampliada:

```bash
docker build -t curso-loja-php:aula-2.3 .
docker run --rm --name curso-loja-php-dockerfile curso-loja-php:aula-2.3
```

Resultados verificados:

- Não havia imagem do curso ou container com esses nomes antes da execução.
- Build concluído com sucesso usando a base da etapa 2.2.
- Imagem local criada: `curso-loja-php:aula-2.3`.
- ID observado:
  `sha256:8ccd0f1725de2e7e887784ea9c3ee881c987cef31b2a2d086ca293c4882d815a`.
- Execução sem comando adicional mostrou PHP 8.4.26 CLI, com código 0.
- Inspeção confirmou o `CMD` e a consulta de containers não encontrou o
  container após o término, conforme `--rm`.
- Não foram copiadas pastas do projeto nem compartilhadas portas ou volumes.
  A aplicação da loja e o Compose ainda não foram criados.

Checkpoint da etapa: `feat: adiciona primeiro Dockerfile do curso`.
Confirmação de entendimento da etapa 2.3: recebida em 08/10/2026 com "entendi".

## Etapa 2.4

Objetivo: incluir um script PHP na imagem e executá-lo pelo comando padrão.

Implementação criada e explicada:

- `src/index.php`: imprime "Olá, Docker!" e a versão do PHP, usando `echo`,
  concatenação, `PHP_EOL` e `PHP_VERSION`.
- `Dockerfile`: mantém a base, acrescenta `WORKDIR /app` e `COPY src/ ./`,
  e muda o comando padrão para `["php", "index.php"]`.
- `.dockerignore`: acrescenta `!src/` e `!src/**` para permitir a pasta e seu
  conteúdo no contexto; os demais arquivos continuam excluídos.

Aula salva em `docs/aulas/02-04-codigo-na-imagem.md`. README atualizado com os
comandos atuais. A aula 2.3 recebeu uma nota sobre seu checkpoint histórico,
para diferenciar o Dockerfile daquela etapa da versão atual.

Comandos executados com execução ampliada:

```bash
docker build -t curso-loja-php:aula-2.4 .
docker run --rm --name curso-loja-php-script curso-loja-php:aula-2.4
```

Resultados verificados:

- A imagem da etapa 2.3 foi preservada e os novos nomes estavam disponíveis.
- Build concluído com sucesso; a cópia do script integrou a nova imagem.
- Saída do script: "Olá, Docker!" e "Versão do PHP: 8.4.26", com código 0.
- Inspeção confirmou `/app` como diretório de trabalho e o comando do script.
- Imagem local: `curso-loja-php:aula-2.4`, ID
  `sha256:c5eee4b45f731c0163e84ac817ea98aad2bad3b74600417dced77f5a09bc885e`.
- Container descartável removido ao terminar; sem portas ou volumes publicados.

Conceito a confirmar: `COPY` inclui a versão do arquivo existente no momento
do build. Editar o arquivo local depois exige reconstruir a imagem para usar
a mudança; não há sincronização automática nesta etapa.

Checkpoint: `feat: executa primeiro script PHP na imagem Docker`.
Entendimento da etapa 2.4: confirmado em 08/10/2026 com "entendi".

## Etapa 2.5

Objetivo: criar o primeiro arquivo Compose e executar o script pelo serviço PHP.

Implementação: `compose.yaml`, com nome de projeto `curso-loja-fullstack` e
serviço `php` usando `build: .`. Sem alterações no script, no Dockerfile ou
nas regras de contexto. A explicação cobre YAML, indentação, projeto, serviço
e a relação entre Dockerfile e Compose.

Aula salva em `docs/aulas/02-05-compose.md`; README atualizado com os comandos
Compose e o estado atual.

Comandos explicados e executados:

```bash
docker compose config --quiet
docker compose build
docker compose run --rm php
```

Resultados verificados:

- Configuração validada com código 0 e sem erros.
- Antes de executar, não havia containers, rede ou imagem com o nome do projeto.
- Build concluído, com reutilização de cache de `WORKDIR` e `COPY`.
- Imagem local gerada: `curso-loja-fullstack-php:latest`.
- ID observado:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.
- Execução retornou "Olá, Docker!" e "Versão do PHP: 8.4.26", com código 0.
- Inspeção confirmou diretório `/app` e comando `["php", "index.php"]`.
- `docker compose ps -a` mostrou apenas o cabeçalho após a execução: o
  container temporário foi removido.
- A rede padrão `curso-loja-fullstack_default` foi criada e permanece disponível,
  assim como a imagem. Não houve publicação de portas ou compartilhamento de pastas.
- As operações do daemon usaram execução ampliada; a validação do YAML foi
  realizada no modo restrito.

Checkpoint: `feat: adiciona primeiro servico PHP com Compose`.
Entendimento da etapa 2.5: confirmado em 08/10/2026 com "entendi".

## Etapa 2.6

Objetivo: disponibilizar o código local no container e observar uma alteração
do script sem reconstruir a imagem da aula anterior.

Implementação:

- `compose.yaml`: acrescenta `volumes` ao serviço PHP, com `./src:/app:ro`.
- `src/index.php`: muda a primeira mensagem para "Olá, Docker! Código local
  atualizado." para demonstrar qual versão do script está sendo executada.
- Dockerfile e regras do contexto preservados: `COPY` continua guardando a
  versão existente no momento do build.

Aula salva em `docs/aulas/02-06-bind-mount.md`, com explicação de origem,
destino, modo de leitura, montagem sobre arquivos existentes e comparação.
README atualizado; aulas 2.4 e 2.5 identificam seus checkpoints históricos.

Verificações realizadas sem executar build nesta etapa:

- `docker compose config --quiet` concluiu com sucesso.
- A configuração normalizada mostrou `type: bind`, origem na pasta `src`
  deste projeto, destino `/app` e `read_only: true`.
- `docker compose run --rm php` executou o código local atualizado, mostrando
  "Olá, Docker! Código local atualizado." e PHP 8.4.26, com código 0.
- `docker run --rm curso-loja-fullstack-php:latest`, sem montar a pasta, mostrou
  a mensagem antiga "Olá, Docker!" e PHP 8.4.26, com código 0.
- O identificador da imagem permaneceu igual antes e depois:
  `sha256:395cb4bf033910c6a294a6190a83554e116a57a04477cc4af57ed11befa3fe6d`.
- Os containers temporários foram removidos. O daemon foi acessado pela execução
  ampliada autorizada; nenhuma porta foi publicada nesta etapa.

Conceitos a confirmar: montagem disponibiliza arquivos locais e encobre a cópia
em `/app` sem alterar a imagem; `ro` limita escrita pelo container, não a edição
pelo usuário no host. Reexecutar o script lê as alterações; não há execução
automática ao salvar. Mudanças na imagem ainda precisam de novo build.

Checkpoint: `feat: monta codigo PHP local para desenvolvimento`.
Entendimento da etapa 2.6: confirmado em 08/10/2026 com "entendi".

## Etapa 2.7

Objetivo: iniciar o servidor PHP de desenvolvimento, acessá-lo por HTTP e
apresentar estado, logs, parada e reinício do serviço.

Implementação:

- `compose.yaml`: comando `php -S 0.0.0.0:8000 -t /app`, publicação
  `127.0.0.1:8001:8000` e `stop_signal: SIGINT`. Mantém o bind mount somente leitura.
- `src/index.php`: acrescenta `Content-Type: text/plain; charset=UTF-8` antes
  da saída. Dockerfile e regras de contexto preservados.
- Aula salva em `docs/aulas/02-07-servidor-e-portas.md`; README atualizado e
  aula 2.6 identifica seu checkpoint histórico.

Comandos apresentados:

```bash
docker compose config --quiet
docker compose up -d --build php
docker compose ps
docker compose logs --tail 10 php
docker compose stop php
docker compose ps -a
docker compose up -d php
```

Resultados verificados:

- Porta 8000 sem listener visível na inspeção, mas publicação recusada pelo
  Docker Desktop com erro 500 em `/forwards/expose`.
- Porta local alternativa 8001 publicada com sucesso para a porta 8000 do container;
  a causa específica da falha da porta 8000 não foi estabelecida.
- Configuração final validada e serviço em estado `Up`.
- HTTP retornou `200 OK`, tipo `text/plain; charset=UTF-8`, mensagem do script
  e PHP 8.4.26. Logs confirmaram inicialização e `GET /` com status 200.
- Primeira parada com sinal padrão resultou em código 137 após encerramento
  forçado. Com `stop_signal: SIGINT`, a parada concluiu com código 0.
- Após reinício, nova requisição confirmou HTTP 200 e a publicação
  `127.0.0.1:8001->8000/tcp`.
- Servidor deixado em execução para o aluno acessar. As operações de daemon
  e rede usaram execução ampliada; outros projetos foram preservados.

Conceitos a confirmar: endereço de escuta no container e endereço publicado
no host são distintos; `command` altera o comando do serviço; `-d` mantém o
servidor em segundo plano; o sinal SIGINT permite parar normalmente o PHP;
`header` define metadados HTTP antes do corpo da resposta.

Checkpoint: `feat: inicia servidor PHP com porta local`.
Entendimento da etapa 2.7: confirmado em 08/10/2026 com "entendi".

## Etapa 2.8

Objetivo: definir uma variável de ambiente do serviço e ler seu valor no PHP.

Implementação:

- `compose.yaml`: acrescenta `environment`, com `APP_NAME: "Loja Fullstack"`.
- `src/index.php`: lê `getenv("APP_NAME")` em `$appName` e imprime o nome
  da aplicação antes das mensagens anteriores.
- Aula salva em `docs/aulas/02-08-variaveis-de-ambiente.md`; README atualizado
  e aula 2.7 identifica seu checkpoint histórico.

Comandos apresentados e executados:

```bash
docker compose config --quiet
docker compose up -d php
docker compose exec -T php printenv APP_NAME
```

Resultados verificados:

- YAML validado sem erros.
- `up` recriou e iniciou somente o container PHP para aplicar a configuração.
- `printenv APP_NAME` retornou `Loja Fullstack`, com código 0.
- HTTP retornou status 200 e `text/plain; charset=UTF-8`, com três linhas:
  "Aplicação: Loja Fullstack", a mensagem do script e PHP 8.4.26.
- Servidor permaneceu `Up`, publicado em `127.0.0.1:8001->8000/tcp`.
- Não houve build nesta etapa; o código local continua disponível pelo bind mount.
- Nenhum `.env`, `.env.example` ou novo serviço foi criado.

Conceitos a confirmar: APP_NAME é uma variável de ambiente do container;
`$appName` é uma variável PHP que recebe seu valor. Configuração alterada no
Compose precisa ser aplicada com `up`; código montado pode ser relido ao
atualizar a página; alterações na imagem precisam de build. `exec` executa
um comando no container já em execução.

Checkpoint: `feat: configura nome da aplicacao por ambiente`.
Entendimento da etapa 2.8: confirmado em 08/10/2026 com "entendi".

## Etapa 2.9

Objetivo: criar um modelo versionado e uma configuração local e usar seu valor
pela interpolação do Compose.

Implementação:

- `.env.example`: `APP_NAME="Loja Fullstack"`, valor fictício de exemplo.
- `.env`: criado localmente a partir do modelo; o valor didático foi alterado
  para `Loja Fullstack Local`. O arquivo não deve ser versionado.
- `compose.yaml`: usa `APP_NAME: "${APP_NAME}"` dentro de `environment`.
- PHP, Dockerfile e regras de exclusão preservados.
- Aula salva em `docs/aulas/02-09-env-e-modelo.md`; README atualizado e aula 2.8
  identifica seu checkpoint histórico.

Verificações:

- Antes da etapa, `.env` e `.env.example` não existiam, e APP_NAME não estava
  definida no shell.
- A primeira cópia com `cp -n` funcionou e exibiu aviso de portabilidade;
  `cp --update=none .env.example .env` foi conferido como alternativa que
  preserva o destino existente. O valor local foi mantido.
- Configuração normalizada resolveu APP_NAME como `Loja Fullstack Local`.
- `docker compose config --quiet` validou a configuração.
- `git check-ignore` confirmou `.env` ignorado e `.env.example` permitido.
  O arquivo local não consta em `git ls-files`.
- Um build temporário com `COPY .env` foi recusado por ausência do arquivo no
  contexto; confirmou a exclusão pelo `.dockerignore`, sem alterar o Dockerfile
  do projeto ou concluir uma imagem de teste.
- `docker compose up -d php` aplicou a configuração e recriou o container.
- `docker compose exec -T php printenv APP_NAME` retornou `Loja Fullstack Local`.
- HTTP retornou status 200 e o nome local, com tipo `text/plain; charset=UTF-8`.
- Servidor permaneceu ativo em `http://127.0.0.1:8001/`. Não houve reconstrução
  da imagem da aplicação nem criação de novos serviços.

Conceitos a confirmar: o modelo documenta as variáveis, a cópia local define
seus valores; o Compose lê `.env` para interpolar `${APP_NAME}` e `environment`
passa o resultado ao container. O PHP mantém `getenv` e não lê o arquivo local
diretamente. Variáveis do shell podem prevalecer sobre valores do arquivo.

Checkpoint: `feat: separa configuracao local em arquivo env`.
Entendimento da etapa 2.9: confirmado em 09/10/2026 com "entendi".

## Etapa 2.10

Objetivo: demonstrar persistência de dados em um volume nomeado entre execuções
de containers temporários, mantendo o código local somente leitura.

Implementação:

- `compose.yaml`: monta `dados-demo:/dados` no serviço PHP e declara o volume
  `dados-demo` na raiz do arquivo. O bind mount de código foi preservado.
- `src/contador.php`: exemplo de terminal que lê, incrementa e grava
  `/dados/contador.txt`, com erros explícitos de leitura/escrita.
- O contador recusa execução HTTP com status 403, evitando alterações por GET.
- Aula salva em `docs/aulas/02-10-volume-de-dados.md`; README atualizado.

Comandos executados:

```bash
docker compose config --quiet
docker compose up -d php
docker compose run --rm php php contador.php
docker compose run --rm php php contador.php
docker compose exec -T php cat /dados/contador.txt
```

Resultados verificados:

- Antes da etapa, o volume `curso-loja-fullstack_dados-demo` não existia e
  o servidor do curso estava ativo.
- Configuração validada, volume criado e serviço reaplicado sem novo build.
- Execuções em containers temporários diferentes retornaram valores `1` e `2`,
  ambas com código 0. Os containers foram removidos, mas o dado foi mantido.
- Inspeção confirmou `/app` como bind mount sem escrita e `/dados` como volume
  gerenciado pelo Docker com escrita.
- HTTP da raiz retornou 200; `GET /contador.php` retornou 403. O arquivo de dados
  continuou em `2` após a requisição recusada.
- `docker compose ps -a` mostrou apenas o servidor principal, que permaneceu
  ativo em `127.0.0.1:8001`. Outros projetos Docker foram preservados.
- `.env` permaneceu local, e o arquivo de dados não foi criado no repositório.

Conceitos a confirmar: volume nomeado é armazenamento gerenciado pelo Docker,
independente do container que o utiliza; o Compose declara o volume na raiz
e monta-o no serviço. O primeiro `php` de `run` seleciona o serviço, e o segundo
inicia o executável para o script de terminal. O exemplo é sequencial.

Checkpoint: `feat: demonstra persistencia em volume Docker`.
Entendimento da etapa 2.10: confirmado em 09/10/2026 com "entendi".

## Etapa 2.11

Objetivo: resolver o nome do serviço e acessar o servidor pela rede interna
a partir de outro container, distinguindo porta interna e porta publicada.

Implementação: `src/rede.php`, um diagnóstico de terminal que consulta
`gethostbyname("php")`, faz uma requisição HTTP a `http://php:8000/` com timeout
de cinco segundos e imprime a primeira linha de status da resposta.
O script recusa acesso HTTP e não altera dados. Compose, Dockerfile, `.env`
e volume foram preservados.

Aula salva em `docs/aulas/02-11-rede-entre-containers.md`; README atualizado
com o comando de diagnóstico e os endereços interno/externo.

Comando executado:

```bash
docker compose run --rm php php rede.php
```

Resultados verificados:

- Rede `curso-loja-fullstack_default` encontrada, driver `bridge`.
- Diagnóstico concluído com código 0 em outro container temporário.
- DNS resolveu `php`; o IP correspondeu ao da inspeção do servidor, que
  possui alias `php` nessa rede. O IP não foi fixado no código.
- Requisição interna a `http://php:8000/` retornou `HTTP/1.1 200 OK`.
- Requisição do host a `http://127.0.0.1:8001/` também retornou 200.
- Acesso HTTP ao diagnóstico retornou 403, preservando sua execução exclusiva
  pelo terminal e evitando requisições recursivas no servidor de desenvolvimento.
- Container temporário removido; `docker compose ps -a` mostrou apenas o
  servidor principal ativo. Não houve build ou escrita no volume de dados.

Conceitos a confirmar: a rede do Compose permite descoberta pelo nome do
serviço; containers usam a porta interna; o host usa a publicação de porta.
`localhost` dentro de um container refere-se ao próprio container. O diagnóstico
resolve o endereço em vez de fixar um IP que pode mudar.

Checkpoint: `feat: verifica rede interna entre containers`.
Entendimento da etapa 2.11: confirmado em 09/10/2026 com "entendi".
Módulo 2 concluído: ambiente PHP em Docker, Compose, arquivos de configuração,
montagens, dados persistentes, servidor, portas, logs e rede estudados.

## Etapa 3.1

Objetivo: começar o catálogo com uma classe de produto e um exemplo de uso,
explicando propriedades, tipos, construtor, objeto e visibilidade.

Implementação:

- `src/Produto.php`: nome privado `string`, preço privado `int` em centavos,
  construtor tipado e métodos públicos `getNome(): string` e
  `getPrecoEmCentavos(): int`.
- `src/exemplo-produto.php`: carrega a classe com `require_once` e `__DIR__`,
  cria `new Produto("Camiseta", 4990)` e imprime os dados pelos métodos.
- Ambos os arquivos usam `declare(strict_types=1)`. O exemplo aceita apenas
  execução pelo terminal.
- Aula salva em `docs/aulas/03-01-produto-tipado.md`; README e roteiro atualizados
  para refletir conclusão do módulo Docker e início do módulo 3.

Execução principal:

```bash
docker compose run --rm php php exemplo-produto.php
```

Resultados verificados:

- Saída `Produto: Camiseta` e `Preço em centavos: 4990`, com código 0.
- Em chamada estrita, preço como texto `"4990"` gerou `TypeError`.
- Acesso direto externo à propriedade privada `nome` gerou `Error`.
  As exceções esperadas foram capturadas na verificação de comportamento.
- Servidor HTTP da raiz permaneceu em 200; exemplo OOP recusou HTTP com 403.
- Containers temporários removidos; infraestrutura, configuração local e dados
  preservados. Não houve build ou instalação de bibliotecas.

Conceitos a confirmar: classe define estrutura; `new` cria o objeto;
`__construct` recebe seus dados; `$this` refere-se à instância atual; propriedades
privadas são consultadas por métodos públicos. Tipos escalares estritos dependem
do arquivo que faz a chamada. Ainda não há validações de nome vazio ou preço
negativo; o foco desta etapa é a estrutura da classe.

Checkpoint: `feat: inicia catalogo com classe Produto tipada`.
Entendimento da etapa 3.1: confirmado em 09/10/2026 com "entendi".

## Etapa 3.2

Objetivo: validar nome e preço no construtor e mostrar tratamento de exceções
de entrada no código que cria o produto.

Implementação:

- `src/Produto.php`: antes das atribuições, recusa `trim($nome) === ""` e
  `$precoEmCentavos < 0`, lançando `InvalidArgumentException` com mensagem.
- `src/exemplo-produto.php`: mantém o produto válido e demonstra uma tentativa
  de preço negativo em `try/catch`, imprimindo a mensagem por `getMessage()`.
- Aula salva em `docs/aulas/03-02-validacao-e-excecoes.md`; README atualizado
  e aula 3.1 identifica seu checkpoint histórico.

Execução principal:

```bash
docker compose run --rm php php exemplo-produto.php
```

Resultados verificados:

- Produto válido retornou nome e preço, e a tentativa de -100 centavos mostrou
  a mensagem de recusa; demonstração terminou com código 0.
- Uma verificação de seis cenários em PHP dentro do Docker confirmou: preço
  positivo e preço zero aceitos; nome vazio, só espaços e preço negativo
  recusados; dados de um nome válido com bordas preservados.
- As verificações detectariam aceitação indevida, recusa indevida ou alteração
  dos dados válidos. Nenhuma biblioteca foi instalada nesta etapa.
- Infraestrutura, `.env` e volume de dados preservados, sem build.

Conceitos a confirmar: tipos verificam formato, regras verificam valores;
`throw` interrompe o construtor e a exceção pode ser tratada pelo chamador.
`catch` trata o tipo específico; `getMessage()` mostra a mensagem. `trim`
é usado para validar, sem normalizar o valor armazenado.

Checkpoint: `feat: valida dados do produto no construtor`.
Entendimento da etapa 3.2: confirmado pelo aluno com "entendi" em 09/10/2026,
após o exemplo prático solicitado de `trim`. Explicamos remoção dos espaços nas
bordas, preservação dos espaços internos e que a variável original só muda se
receber o resultado. Checkpoint publicado: `ab9ea33`.

## Etapa 3.3

Objetivo: reduzir repetição na classe usando promoção de propriedades no
construtor, recurso disponível desde o PHP 8.0.

Implementação e explicação:

- `src/Produto.php`: os parâmetros agora são `private string $nome` e
  `private int $precoEmCentavos`. Removidas declarações e atribuições separadas.
- Validações e métodos públicos preservados; `src/exemplo-produto.php` inalterado.
- Explicada a ordem real: promoção atribui os argumentos antes do corpo do
  construtor. A versão anterior tinha atribuições explícitas após as validações.
  Uma exceção continua impedindo que `new` entregue a instância ao chamador.
- Aula salva em `docs/aulas/03-03-promocao-de-propriedades.md`; README atualizado
  e aula 3.2 identifica seu checkpoint histórico.

Verificação:

- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas da
  etapa anterior, com código 0.
- Oito verificações em PHP pelo Docker passaram: produto válido, preço zero,
  preservação de bordas no nome; recusa de nome vazio, nome só com espaços e
  preço negativo; `TypeError` para preço textual em chamada estrita e `Error`
  para acesso externo à propriedade privada.
- Código executado pelo bind mount, sem build ou novas dependências.
  Configuração local, servidor e volume de dados preservados.

Checkpoint: `refactor: promove propriedades do construtor de Produto`.
Entendimento da etapa 3.3: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `83f190b`.

## Etapa 3.4

Objetivo: organizar o nome da classe com namespace e explicar importação de
nomes com `use`, distinguindo-a do carregamento do arquivo.

Implementação e explicação:

- `src/Produto.php`: acrescentados `namespace Loja` depois de `declare` e
  `use InvalidArgumentException` para usar a exceção global nos `throw`.
- `src/exemplo-produto.php`: acrescentado `use Loja\Produto`. Continua usando
  o nome curto no `new` e carregando o mesmo arquivo por `require_once`.
- Nome completo agora é `Loja\Produto`; namespace não cria pasta ou move arquivo.
- Importações valem por arquivo. O exemplo permanece no namespace global,
  com seu `catch` apontando à mesma exceção.
- Aula salva em `docs/aulas/03-04-namespace-e-use.md`; README atualizado e
  aula 3.3 identifica seu checkpoint histórico.

Verificação:

- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas
  da demonstração, com código 0.
- `php -l` pelo Docker confirmou sintaxe dos dois arquivos.
- Oito verificações pelo Docker passaram: `use` não carrega a classe;
  `require_once` carrega; classe global não declarada; nome completo do objeto
  correto; criação pelo nome absoluto funciona; nome vazio, nome só com espaços
  e preço negativo lançam a exceção global esperada.
- Código executado pelo bind mount, sem build, dependências ou mudanças na
  infraestrutura e nos dados. Experiência enviada pela entrada padrão.

Checkpoint: `refactor: organiza Produto em namespace Loja`.
Entendimento da etapa 3.4: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `253617c`.

## Etapa 3.5

Objetivo: disponibilizar Composer na imagem PHP e verificar sua execução,
preparando o estudo de configuração de projeto e autoload.

Implementação e explicação:

- `Dockerfile`: adicionada a instrução
  `COPY --from=composer/composer:2.10.3-bin /composer /usr/local/bin/composer`.
- Versão 2.10.3 consultada na página oficial. Imagem de executável recomendada
  pela documentação; disponibilidade da tag confirmada no build.
- Explicados origem externa, arquivo de origem, destino no PATH e execução
  usando o PHP da nossa imagem. Base, WORKDIR, cópia do código e CMD mantidos.
- Composer instalado na imagem; nenhuma instalação no host ou de bibliotecas
  do projeto. Arquivos PHP e carregamento com `require_once` preservados.
- Aula salva em `docs/aulas/03-05-composer-no-docker.md`; README atualizado.

Verificação:

- `docker compose build php`: código 0, base PHP 8.4.26 e cópia concluídas.
- `docker compose run --rm php composer --version`: Composer 2.10.3 usando
  PHP 8.4.26, código 0.
- `docker compose run --rm php php exemplo-produto.php`: mesmas três linhas
  da demonstração, código 0.
- `docker compose up -d php`: serviço recriado e iniciado com sucesso.
- Inspeção confirmou que o container do servidor usa a imagem construída.
- HTTP 200 na porta 8001 e versão PHP 8.4.26 após recriação.
- Volumes e configuração local preservados. A instalação de bibliotecas
  e a geração do autoload ainda não foram realizadas nem verificadas.

Checkpoint: `build: adiciona Composer 2.10.3 a imagem PHP`.
Entendimento da etapa 3.5: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `5360ccb`.

## Etapa 3.6

Objetivo: criar a configuração do projeto Composer, declarar requisito de PHP
e explicar o mapeamento de classes por PSR-4.

Implementação e explicação:

- `src/composer.json`: nome `julesjrenck/curso-loja-fullstack`, descrição,
  tipo `project`, requisito PHP `^8.4` e prefixo PSR-4 `Loja\` para `./`.
- Explicados JSON, escape de barra invertida, faixa >=8.4.0 e <9.0.0, e caminho
  relativo à pasta do composer.json. PHP continua definido pela imagem.
- Pelo bind mount, o arquivo fica em `/app/composer.json`; a classe existente
  corresponde a `/app/Produto.php`. Configuração não gera ou ativa autoload.
- Arquivos PHP e carregamento por `require_once` preservados.
- Aula salva em `docs/aulas/03-06-composer-json.md`; README atualizado.

Verificação:

- `docker compose run --rm php composer validate`: arquivo válido, código 0.
  Único aviso: licença não declarada. Campo opcional ainda sem escolha;
  não foi usado `--strict`, que retornaria falha também por avisos.
- Leitura do JSON e resolução do prefixo confirmaram que `Loja\Produto`
  corresponde ao arquivo existente `src/Produto.php`.
- `src/vendor` e `src/composer.lock` continuam ausentes; não foram gerados
  arquivos ou instaladas bibliotecas.
- Sem build, mudança no servidor ou alterações em volumes e configuração local.
  Execução de autoload ainda não verificada, pois não foi gerado.

Checkpoint: `build: configura projeto Composer e mapeamento PSR-4`.
Entendimento da etapa 3.6: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `3e28669`.

## Etapa 3.7

Objetivo: preparar armazenamento gravável para os arquivos gerados pelo
Composer, preservando o código montado como somente leitura.

Implementação e explicação:

- Pasta local vazia `src/vendor` criada como ponto de montagem; regra `vendor/`
  do `.gitignore` confirmada. Pasta não versionada; README inclui `mkdir -p`
  na preparação de um novo clone.
- `compose.yaml`: adicionados montagem `vendor-php:/app/vendor` no serviço
  e volume nomeado `vendor-php` no bloco da raiz.
- `./src:/app:ro` e `dados-demo:/dados` mantidos.
- Explicados nomes, caminhos, blocos YAML e montagem gravável no caminho
  específico `/app/vendor` dentro do bind mount somente leitura.
- Aula salva em `docs/aulas/03-07-volume-vendor.md`; README atualizado.

Verificação:

- `docker compose config --quiet`: configuração válida.
- `docker compose up -d php`: volume `curso-loja-fullstack_vendor-php` criado
  e servidor recriado com sucesso; sem build.
- Inspeção confirmou `/app` somente leitura e `/app/vendor` gravável.
- Arquivo temporário com nome único gravado no volume, lido com o mesmo conteúdo
  em outro container após remoção do primeiro e removido ao final da verificação.
- Tentativa de gravação diretamente em `/app` recusada.
- Pasta local `src/vendor` permaneceu sem o arquivo gerado no volume.
- Hash do contador comparado antes e depois, sem alteração de conteúdo.
- HTTP 200 após aplicação. Verificações terminaram com código 0.
- Nenhuma biblioteca instalada ou autoload gerado. Exemplo mantém `require_once`
  direto de Produto.php; configuração local e dados anteriores preservados.

Checkpoint: `build: prepara volume gravavel para vendor do Composer`.
Entendimento da etapa 3.7: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `07db654`.

## Etapa 3.8

Objetivo: gerar o autoload a partir da configuração e utilizá-lo para carregar
Produto automaticamente quando o PHP precisar da classe.

Implementação e explicação:

- `docker compose run --rm php composer dump-autoload`: arquivos gerados no
  volume de `/app/vendor`, sem instalar bibliotecas ou criar lockfile.
- Estrutura inspecionada: autoload.php e oito arquivos dentro de composer.
  Aula apresenta o papel de todos, destacando entrada, inicialização,
  implementação do carregador, mapeamento PSR-4 e dados estáticos.
- Inspeção de `autoload_psr4.php` confirmou `Loja\` para o diretório base `/app`.
  `platform_check.php` gerado verifica mínimo PHP 8.4.0 nesta configuração.
- `src/exemplo-produto.php`: alterado somente o `require_once`, que agora
  carrega `__DIR__ . "/vendor/autoload.php"`, em vez de Produto.php.
- Explicados nome curto por `use`, registro do autoload e carga por demanda
  em `new`. Classe e restrição CLI preservadas.
- Aula salva em `docs/aulas/03-08-autoload-do-composer.md`; README inclui comando
  de geração na preparação do projeto e explicação do uso atual.

Verificação:

- Geração do autoload e exemplo do produto terminaram com código 0; saída
  da demonstração manteve as mesmas três linhas.
- Classe ausente antes do registro e imediatamente depois; `new` carregou
  automaticamente Loja\Produto e incluiu o arquivo esperado.
- Seis cenários de entrada mantiveram aceitação/recusa e dados válidos.
  Preço textual gerou TypeError e acesso privado externo gerou Error.
- HTTP principal 200; exemplo recusou HTTP com 403.
- Arquivos gerados ficaram no volume; pasta local `src/vendor` continuou vazia
  e `src/composer.lock` ausente. Sem build ou alteração no Compose.

Checkpoint: `feat: carrega Produto com autoload do Composer`.
Entendimento da etapa 3.8: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `af61127`.

## Etapa 3.9

Objetivo: representar opções de estado com um enum e distinguir um caso de sua
representação textual.

Implementação e explicação:

- `src/StatusProduto.php`: enum Loja\StatusProduto com valores string,
  casos Ativo = "ativo" e Inativo = "inativo".
- `src/exemplo-status-produto.php`: exemplo CLI com autoload, seleção do caso
  Ativo e impressão de `name` e `value`.
- Explicados enum, case, acesso com `::`, caso como valor do tipo StatusProduto
  e valor associado como string. Tipar um parâmetro exige um caso do enum.
- Arquivos seguem o namespace e o padrão CLI existentes. Produto e seu exemplo
  não foram alterados; nenhuma regra de transição implementada.
- Aula salva em `docs/aulas/03-09-enum-status-produto.md`; README atualizado.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Exemplo mostrou `Caso: Ativo` e `Valor: ativo`, código 0.
- Seis verificações pelo Docker passaram: enum ausente inicialmente, autoload
  existente encontra arquivo novo, caso diferente do texto, parâmetro tipado
  aceita Ativo e Inativo e recusa string "ativo" com TypeError.
- Função de verificação temporária enviada pela entrada padrão; não adicionada
  ao código da aplicação. O novo exemplo recusou HTTP com 403.
- Sem build, regeneração do autoload, instalação de dependências ou alteração
  no Compose. Configuração local e dados preservados.

Checkpoint: `feat: apresenta enum de estados de produto`.
Entendimento da etapa 3.9: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `377860a`.

## Etapa 3.10

Objetivo: exigir um caso de StatusProduto para o estado inicial do produto,
com Ativo como padrão e consulta pelo getter.

Implementação e explicação:

- `src/Produto.php`: terceiro parâmetro promovido privado
  `StatusProduto $status = StatusProduto::Ativo`; método `getStatus(): StatusProduto`.
- Nome curto do enum é resolvido no namespace Loja da classe. O getter retorna
  o caso; `->value` permite consultar sua representação textual.
- `src/exemplo-produto.php`: importação do enum, impressão do estado padrão
  da camiseta e criação da calça com Inativo explícito, exibindo seu estado.
- Explicados promoção, argumento opcional, ordem dos argumentos, retorno tipado
  e diferença entre omitir o argumento e passar string ou null.
- Validações de nome e preço, autoload e restrição CLI preservados.
- Aula salva em `docs/aulas/03-10-status-no-produto.md`; README atualizado e
  aula 3.9 identifica seu checkpoint histórico.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Exemplo mostrou seis linhas documentadas na aula, com código 0.
- Onze verificações passaram: padrão Ativo; Inativo explícito; Ativo e preço zero;
  dados válidos com bordas preservados; strings ativo/inativo e null recusados;
  nome vazio, só espaços e preço negativo recusados; alteração externa de status
  recusada sem mudar seu valor.
- Verificação enviada pela entrada padrão, sem arquivo de teste persistente.
- Sem build, regeneração do autoload, novas dependências ou mudança no Compose.
  Configuração local e volumes preservados.

Checkpoint: `feat: define estado inicial tipado de Produto`.
Entendimento da etapa 3.10: confirmado pelo aluno com "entendi" em 09/10/2026.
Checkpoint publicado: `a0e1042`.

## Etapa 3.11

Objetivo: mudar o estado por ações públicas da classe, aprofundando
encapsulamento e estado de cada instância.

Implementação e explicação:

- `src/Produto.php`: métodos `ativar(): void` e `desativar(): void`, atribuindo
  respectivamente Ativo e Inativo a `$this->status`.
- `src/exemplo-produto.php`: desativa e ativa a camiseta, consulta os estados
  após as ações e mostra que a calça continua inativa.
- Explicados método público, acesso interno à propriedade privada, `$this`,
  ação sem resultado declarado por void e consulta posterior pelo getter.
- Repetir a ação mantém o estado escolhido. Cada instância mantém sua
  propriedade; atribuições não modificam os casos do enum.
- Construtor, regras de entrada, autoload e restrição CLI preservados.
- Aula salva em `docs/aulas/03-11-acoes-e-encapsulamento.md`; README atualizado
  e aula 3.10 identifica seu checkpoint histórico.

Verificação:

- `php -l` pelo Docker confirmou a sintaxe dos dois arquivos.
- Demonstração mostrou nove linhas documentadas na aula, código 0.
- Oito verificações passaram: desativar, repetir desativação, ativar, repetir
  ativação, isolamento ao agir na camiseta, isolamento ao agir na calça,
  preservação de nomes/preços e recusa de alteração externa direta de status.
- Verificação enviada pela entrada padrão, sem arquivo de teste persistente.
- Sem build, regeneração do autoload, novas dependências ou mudança no Compose.
  Configuração local e volumes preservados.

Checkpoint: `feat: adiciona acoes de ativar e desativar Produto`.
Entendimento da etapa 3.11: confirmado pelo aluno com "entendi" em 12/10/2026.
Publicação verificada: `8d54d1a`, com HEAD e origin/main iguais antes deste registro.

Retomada em 12/10/2026:

- Nenhuma alteração de implementação. Reapresentados métodos públicos,
  acesso interno ao status privado, `$this`, retorno void e estado por instância.
- `docker compose ps -a` confirmou o servidor PHP ativo na porta local 8001.
- `docker compose run --rm php php exemplo-produto.php` executado novamente:
  as mesmas nove linhas da aula, com código 0. A camiseta foi desativada e
  ativada; a calça permaneceu inativa. A entrada de preço negativo foi recusada.
- Não foram repetidas nesta retomada as oito verificações de comportamento
  ou a verificação de sintaxe da implementação anterior.
- O pedido inicial para continuar não foi tratado como confirmação.
  Após a explicação, o aluno confirmou entendimento com "entendi".
- Código e aula já publicados; registro desta retomada e confirmação preparado
  para checkpoint `docs: confirma entendimento da etapa 3.11`.

Checkpoint do registro de confirmação: `0c2106b`, criado e verificado localmente.
O push foi inicialmente rejeitado pela revisão automática por exigir aprovação
explícita do destino público. Aprovação recebida em 12/10/2026: "Sim, autorizo os
checkpoints concluídos" para `main` de `julesjrenck/curso-loja-fullstack`.
Publicação de `0c2106b` confirmada no envio de `aa9642e..846ada2`; verificação
remota retornou `846ada2` após o push. A pendência de publicação foi resolvida.

## Etapa 3.12

Objetivo: definir um contrato de consulta de preço e fazer Produto implementá-lo,
demonstrando uma função com parâmetro tipado pela interface.

Implementação e explicação:

- `src/Precificavel.php`: interface no namespace Loja, com a declaração pública
  `getPrecoEmCentavos(): int`, sem corpo de método.
- `src/Produto.php`: declaração alterada para `class Produto implements Precificavel`.
  O método público existente já cumpre o contrato; nenhuma duplicação de lógica.
- Explicados interface, assinatura, ponto e vírgula, implements, implementação
  na classe e parâmetro tipado pela interface. Autoload PSR-4 existente utilizado.
- Experiência acompanhada: função temporária `consultarPreco(Precificavel $item): int`
  enviada pela entrada padrão. Produto aceito e seu método fornece 4990 centavos;
  objeto stdClass recusado com TypeError capturado. Nenhuma função de negócio
  ou novo arquivo de exemplo acrescentado à aplicação.
- Aula salva em `docs/aulas/03-12-interface-precificavel.md`; README atualizado.

Verificação:

- `php -l` executado via `docker compose exec -T php` passou para Precificavel.php
  e Produto.php.
- `docker compose run --rm php php exemplo-produto.php` mostrou as mesmas nove
  linhas da aula anterior, com código 0.
- Experiência via `docker compose run --rm -T php php`: preço retornado conferido
  como exatamente 4990; TypeError esperado para objeto sem contrato. Código 0.
- Sem build, regeneração do autoload, instalação de dependências ou mudança no
  Compose. Não executado o contador; configuração local e volumes preservados.
- `git diff --check` passou, sem problemas de espaços nas alterações rastreadas.

Entendimento da etapa 3.12: confirmado com "entendi" em 12/10/2026.
Checkpoint: `846ada2`, `feat: define contrato Precificavel para Produto`.
Publicação autorizada explicitamente e verificada, junto com `0c2106b`.
HEAD, origin/main e a consulta direta à main remota retornaram o mesmo SHA.
Nenhuma nova confirmação necessária para publicar futuros checkpoints
concluídos no mesmo destino autorizado.

## Etapa 3.13

Objetivo: representar um item do carrinho que contém um Produto e uma quantidade
positiva, estudando composição e o uso de métodos do objeto guardado.

Implementação e explicação:

- `src/ItemCarrinho.php`: classe Loja\ItemCarrinho com Produto e quantidade int
  privados promovidos no construtor; recusa quantidade menor que 1 com
  InvalidArgumentException. Getters getProduto(): Produto e getQuantidade(): int.
- Explicados composição, responsabilidades do produto e do item, relação entre
  objetos, promoção de propriedades, validação de valores e chamadas encadeadas.
- O item guarda o mesmo objeto Produto recebido; não clona. Uma alteração de
  estado feita no Produto pode ser observada pelo getter do item.
- Aula salva em `docs/aulas/03-13-composicao-item-carrinho.md`; README atualizado.
- Produto, Precificavel e os exemplos existentes não foram alterados nesta etapa.

Verificação:

- `docker compose exec -T php php -l ItemCarrinho.php`: sem erro de sintaxe.
- Experiência temporária pela entrada padrão de `docker compose run --rm -T php php`
  confirmou o mesmo Produto recebido e quantidade 3, quantidade mínima 1 aceita,
  quantidades 0 e -1 recusadas com a exceção esperada, e estado Inativo observado
  pelo item após desativar o Produto. Saída de sete linhas, código 0.
- O preço unitário continuou 4990 centavos e o nome consultado foi Camiseta.
  Não foi calculado subtotal.
- Sem build, regeneração de autoload, novas dependências ou alteração do Compose.
  Não executado o contador; configuração local e volumes preservados.

Entendimento da etapa 3.13: confirmado com "entendi" em 12/10/2026.
Esclarecimento em 12/10/2026: aluno pediu nova explicação e perguntou onde
ItemCarrinho é chamado. Naquele momento, nenhum script em src instanciava
ItemCarrinho. A chamada `new ItemCarrinho($produto, 3)` foi executada
somente na experiência temporária enviada ao PHP em Docker e está documentada
na aula. Reexplicados definição da classe, chamada de new, construtor automático,
argumentos guardados nas propriedades e getters que acessam o objeto Produto.
Não acrescentado novo código de aplicação no esclarecimento; após a explicação,
o aluno confirmou entendimento.
Checkpoint: `197470b`, `feat: representa item de carrinho por composicao`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `197470b1570cbfa02d736166566e5f796deb8cb4`.

## Etapa 3.14

Objetivo: calcular o subtotal de um item, multiplicando o preço unitário do
Produto composto pela quantidade, e salvar um exemplo executável em src.

Implementação e explicação:

- `src/ItemCarrinho.php`: acrescentado getSubtotalEmCentavos(): int, retornando
  `$this->produto->getPrecoEmCentavos() * $this->quantidade`.
- Explicados consulta ao objeto guardado, multiplicação, return, retorno inteiro
  e cálculo na chamada sem armazenar subtotal em outra propriedade.
- `src/exemplo-item-carrinho.php`: exemplo CLI persistente com autoload;
  cria Camiseta de 4990 centavos e ItemCarrinho com quantidade 3, imprime nome,
  preço unitário, quantidade e subtotal de 14970 centavos.
- A chamada de ItemCarrinho agora pode ser encontrada diretamente nesse script;
  as experiências da etapa anterior foram temporárias. Explicados use, restrição
  CLI, require_once, __DIR__, new, getters, concatenação e PHP_EOL.
- Aula salva em `docs/aulas/03-14-subtotal-item-carrinho.md`; README atualizado
  com o comando do novo exemplo.

Verificação:

- `php -l` via `docker compose exec -T php` passou para ItemCarrinho.php e
  exemplo-item-carrinho.php.
- `docker compose run --rm php php exemplo-item-carrinho.php`: quatro linhas
  esperadas, incluindo `Subtotal em centavos: 14970`, código 0.
- Verificação temporária em PHP via entrada padrão do Docker passou: 4990 x 1
  resulta 4990, 4990 x 3 resulta 14970 e 0 x 3 resulta 0. Conferida também a
  preservação do preço do produto e da quantidade do item em cada cenário.
- HTTP do novo exemplo retornou 403, conforme a restrição CLI existente.
- Sem build, regeneração do autoload, dependências novas ou mudança no Compose.
  Contador não executado; configuração local e volumes preservados.

Entendimento da etapa 3.14: confirmado com "entendi" em 12/10/2026.
Checkpoint: `b45dc75`, `feat: calcula subtotal do item do carrinho`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `b45dc7509c945d5974d6768876c464534f6d4878`.

## Etapa 3.15

Objetivo: apresentar testes automatizados e verificar os requisitos de PHPUnit
no PHP do container antes de instalar a ferramenta.

Implementação e explicação:

- Nenhuma alteração de código ou Dockerfile necessária: PHP e extensões
  carregadas já atendem aos requisitos consultados.
- Explicados teste como entrada/operação/resultado esperado repetíveis,
  papel de PHPUnit, extensão do PHP e dependência do Composer.
- Documentação oficial consultada: série PHPUnit 13 compatível com PHP 8.4;
  composer.json da versão 13.3.2 exige PHP >= 8.4.1 e extensões dom, filter,
  json, libxml, mbstring e xmlwriter. Versão consultada para o diagnóstico;
  revisar a versão exata e fixar pelo lockfile quando instalar.
- Aula salva em `docs/aulas/03-15-requisitos-phpunit.md`; README atualizado.
- PHPUnit ainda não instalado; nenhum teste PHPUnit criado.

Verificação:

- `docker compose exec -T php php --version`: PHP 8.4.26 CLI.
- `docker compose exec -T php php -m`: seis extensões requeridas carregadas;
  xml e tokenizer também disponíveis.
- Verificação temporária via entrada padrão do Docker: version_compare confirmou
  requisito >= 8.4.1, extension_loaded confirmou oito módulos e is_file confirmou
  ausência de /app/vendor/bin/phpunit. Dez linhas de diagnóstico, código 0.
- Essa verificação demonstra requisitos do PHP consultados; instalação e
  funcionamento real da ferramenta ainda serão verificados na próxima etapa.
- Sem build, novas dependências, regeneração de autoload ou mudanças no Compose,
  código PHP, configuração local ou volumes. Contador não executado.

Entendimento da etapa 3.15: confirmado com "entendi" em 12/10/2026.
Checkpoint: `3dba56d`, `docs: verifica requisitos de PHPUnit no Docker`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `3dba56d1d161f9de05e98273950fc785dc1089b8`.

## Etapa 3.16

Objetivo: instalar PHPUnit como dependência de desenvolvimento pelo Composer
em Docker, registrar versões exatas e verificar a execução da ferramenta.

Implementação e explicação:

- `src/composer.json`: require-dev com phpunit/phpunit na faixa ^13.4;
  requisitos do projeto e autoload de Loja preservados.
- `src/composer.lock`: gerado pelo Composer, com PHPUnit 13.4.1 e 26 pacotes
  auxiliares em packages-dev. packages vazio; plataforma PHP ^8.4.
- Versão 13.4.1 consultada no Packagist e requisitos confirmados no composer.json
  oficial da tag: PHP >= 8.4.1 e as mesmas extensões diretas já verificadas.
- `Dockerfile`: RUN instala unzip=6.0-28+deb12u1 pelo apt do Debian Bookworm e
  limpa índices de pacotes. PHP 8.4.26 e Composer 2.10.3 preservados.
- A primeira resolução gerou JSON/lock, mas a instalação parou por ausência de
  zip ou unzip/7z. Após acrescentar unzip e construir a imagem, composer install
  concluiu usando as versões do lockfile, sem refazer a escolha de versões.
- Neste ambiente, volumes adicionais de run em /app mantiveram a montagem ro,
  mesmo com :rw explícito. Diagnóstico confirmou /app ro e /instalacao rw.
  Instalamos com src montado em /instalacao:rw, o volume vendor existente em
  /instalacao/vendor e --workdir /instalacao. Compose não foi alterado.
- Proprietário do novo lockfile alinhado ao de composer.json com chown --reference
  no container temporário; ambos ficaram 1000:1000 e modo 644 no host.
- Pacotes, vendor/bin/phpunit e arquivos regenerados de autoload ficam no volume.
  Explicados os campos do lockfile e os arquivos de metadados em vendor/composer,
  sem percorrer o código das bibliotecas externas.
- Aula salva em `docs/aulas/03-16-instalacao-phpunit.md`; README inclui instalação
  por lockfile na preparação de clones e comando de versão do PHPUnit.

Verificação:

- Montagem gravável e mesmo autoload acessível pelos dois caminhos confirmados
  antes da instalação. A montagem normal do serviço continua /app ro e vendor rw.
- `docker compose build php`: sucesso, unzip fixado instalado. `up -d php`
  aplicou a imagem nova; containers temporários removidos e servidor ativo.
- `composer install`: 27 pacotes instalados e autoload regenerado, código 0.
- `php vendor/bin/phpunit --version`: PHPUnit 13.4.1, código 0.
- `composer check-platform-reqs`: PHP e oito extensões reais dos pacotes passaram.
- `composer validate`: JSON e lockfile válidos, código 0; aviso de licença ausente
  permanece. Nenhuma licença escolhida nesta aula.
- `composer audit --locked --no-interaction`: nenhum aviso de vulnerabilidade
  conhecida encontrado, código 0.
- Exemplo do subtotal manteve quatro linhas e 14970 centavos, código 0.
  HTTP principal 200; exemplo CLI retornou 403.
- vendor e .env continuam ignorados; lockfile permitido para versionamento.
  Contador não executado; configuração local e volumes preservados.

Entendimento da etapa 3.16: confirmado com "entendi" em 12/10/2026.
Checkpoint: `9a9c43a`, `build: instala PHPUnit com dependencias fixadas`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9a9c43a5dce5696ab5230ba8626a761763fdb940`.

## Etapa 3.17

Objetivo: salvar um primeiro teste PHPUnit da regra de subtotal, conhecendo
TestCase, herança, método de teste, asserção e carregamento pelo bootstrap.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: classe global ItemCarrinhoTest extends TestCase,
  com importações de Loja\Produto, Loja\ItemCarrinho e PHPUnit\Framework\TestCase.
- Método público testCalculaSubtotalParaTresUnidades(): void cria Produto de
  4990 centavos e ItemCarrinho com quantidade 3, consulta subtotal e confere
  o inteiro 14970 com `$this->assertSame(14970, $subtotal)`.
- Explicados herança por extends, recursos da classe base TestCase, reconhecimento
  do prefixo test, `$this` como instância de teste, argumentos esperado/obtido,
  comparação de valor e tipo e preparação/execução/conferência do cenário.
- PHPUnit carrega o arquivo e executa o método; não há instanciação manual
  de ItemCarrinhoTest no exemplo da loja. Bootstrap registra o autoload.
- Aula salva em `docs/aulas/03-17-primeiro-teste-phpunit.md`; README inclui o comando.
- Produto, ItemCarrinho, Compose, Dockerfile e arquivos do Composer preservados.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- `docker compose run --rm php php vendor/bin/phpunit --bootstrap vendor/autoload.php
  tests/ItemCarrinhoTest.php`: PHPUnit 13.4.1, PHP 8.4.26,
  `OK (1 test, 1 assertion)`, código 0.
- O teste confirma o cenário de três unidades e retorno inteiro 14970; ainda
  não cobre os demais cenários ou expectativas de exceção.
- Execução com montagem normal somente leitura, sem build ou novas dependências.
  Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.17: confirmado com "entendi" em 12/10/2026.
Checkpoint: `071aacd`, `test: verifica subtotal de tres unidades com PHPUnit`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `071aacd00da4180bd8ec1a210708b91577c79ecf`.

## Etapa 3.18

Objetivo: testar que quantidade zero é recusada com InvalidArgumentException,
conhecendo expectativa de exceção e a obtenção de nomes de classes com ::class.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testRecusaQuantidadeZero(): void.
  Cria Produto válido, configura expectException(InvalidArgumentException::class)
  e tenta construir ItemCarrinho com quantidade 0.
- Explicados expectException como configuração do tipo esperado, ::class como
  nome de classe em string e ordem preparar/esperar/executar. Produto válido
  criado antes da expectativa para evitar confusão com suas validações.
- A expectativa é configurada antes da construção, pois uma exceção interrompe
  a execução normal. O construtor de ItemCarrinho lança a exceção existente;
  PHPUnit recebe e confere o tipo. O teste não passa se ela faltar ou for incompatível.
- Teste de subtotal preservado; Produto e ItemCarrinho não foram alterados.
- Aula salva em `docs/aulas/03-18-teste-quantidade-zero.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (2 tests, 2 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotal inteiro 14970 para três unidades e tipo da exceção na
  recusa de quantidade 0. Quantidade negativa ainda sem teste PHPUnit próprio.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.18: confirmado com "entendi" em 12/10/2026.
Checkpoint: `9d6ceb0`, `test: verifica recusa de quantidade zero`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9d6ceb0fbb7f669203ed6bad2d91789201b11c13`.

## Etapa 3.19

Objetivo: verificar a recusa de uma quantidade negativa e explicar por que
o teste de zero, sozinho, não verifica essa entrada distinta.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testRecusaQuantidadeNegativa(): void.
  Cria Produto válido, configura expectException(InvalidArgumentException::class)
  e tenta construir ItemCarrinho com quantidade -1.
- Reutilizada a ordem preparar/esperar/executar da aula anterior. Explicado que
  -1 é int, mas viola a regra de quantidade positiva do construtor.
- Comparação didática: uma condição `$quantidade === 0` recusaria zero e
  aceitaria -1; o novo teste detectaria essa aceitação indevida. A regra real
  `$quantidade < 1` permaneceu inalterada.
- Testes anteriores preservados. Produto e ItemCarrinho não foram alterados.
- Aula salva em `docs/aulas/03-19-teste-quantidade-negativa.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (3 tests, 3 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotal inteiro 14970 para três unidades e exceções esperadas nas
  tentativas de quantidade 0 e -1. Quantidade mínima 1 ainda sem teste PHPUnit próprio.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.19: confirmado com "entendi" em 12/10/2026.
Checkpoint: `188ff33`, `test: verifica recusa de quantidade negativa`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `188ff3341e1b0abdf63a008f066810cc28852562`.

## Etapa 3.20

Objetivo: verificar que a menor quantidade válida, 1, é aceita e produz o
subtotal correspondente ao preço de uma unidade.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testCalculaSubtotalParaUmaUnidade(): void.
  Cria Produto de 4990 centavos e item de quantidade 1, consulta subtotal e
  confere o inteiro 4990 com assertSame.
- Reutilizada a sequência preparar/executar/conferir. Explicado que uma exceção
  inesperada na construção também impediria a aprovação do teste.
- Explicada a condição real < 1: quantidade 1 deve ser aceita. Comparação didática
  com <= 1 mostrou uma recusa indevida que os três testes anteriores não detectariam.
- Produto e ItemCarrinho não foram alterados; testes anteriores preservados.
- Aula salva em `docs/aulas/03-20-teste-quantidade-minima.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (4 tests, 4 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotais inteiros de 4990 para uma unidade e 14970 para três,
  além das exceções esperadas para quantidades 0 e -1.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.20: confirmado com "entendi" em 12/10/2026.
Checkpoint: `95630cd`, `test: verifica subtotal da menor quantidade valida`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `95630cdea45c1885a277b833ae26a0cca32cafac`.

## Etapa 3.21

Objetivo: verificar preço zero como limite válido de Produto e subtotal inteiro
zero para um item com esse produto e quantidade positiva.

Implementação e explicação:

- `src/tests/ItemCarrinhoTest.php`: acrescentado testCalculaSubtotalParaProdutoGratuito(): void.
  Cria Produto Brinde de preço 0 e item de quantidade 3, consulta subtotal e
  confere o inteiro 0 com assertSame.
- Reutilizada a sequência preparar/executar/conferir. Explicadas as regras
  próprias de cada campo: preço mínimo 0, quantidade mínima 1.
- Explicada a validação real de preço < 0, que permite zero. Uma condição
  <= 0 recusaria esse limite válido; os quatro testes anteriores usam preço 4990
  e não detectariam essa recusa. Comparação didática, sem alterar a classe.
- Produto e ItemCarrinho não foram alterados; quatro testes anteriores preservados.
- Aula salva em `docs/aulas/03-21-teste-preco-zero.md`; README atualizado.

Verificação:

- `docker compose exec -T php php -l tests/ItemCarrinhoTest.php`: sintaxe válida.
- Comando PHPUnit com --bootstrap vendor/autoload.php e o mesmo arquivo de teste:
  `OK (5 tests, 5 assertions)`, código 0, PHPUnit 13.4.1 e PHP 8.4.26.
- Confirmados subtotais inteiros de 4990 para uma unidade e 14970 para três,
  subtotal inteiro 0 para produto gratuito de quantidade 3 e exceções para
  quantidades 0 e -1.
- Sem build, novas dependências ou alteração em Compose, Dockerfile ou arquivos
  do Composer. Configuração local e volumes preservados; contador não executado.

Entendimento da etapa 3.21: confirmado com "entendi" em 12/10/2026.
Checkpoint: `a5caa53`, `test: verifica subtotal de produto gratuito`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `a5caa5380ea88a83de3f48655c7e8aed926929ff`.

## Etapa 3.22

Objetivo: relacionar os conceitos de PHP moderno e OOP já estudados, revisar
o fluxo das classes e confirmar entendimento antes de concluir o módulo 3.

Implementação e explicação:

- Apenas documentação: `docs/aulas/03-22-revisao-modulo-3.md`, com mapa das relações,
  arquivos, conceitos, demonstração e cenários dos testes; README atualizado.
- Retomados tipos e regras de valor, propriedades privadas, construtor e promoção,
  getters, `$this`, ações void e enum de estado.
- Relacionados Produto implements Precificavel, composição de ItemCarrinho com
  Produto e herança de ItemCarrinhoTest por extends TestCase.
- Retomados namespaces/use, mapeamento PSR-4, autoload, require-dev, lockfile e
  arquivos gerados no volume vendor.
- Revisados assertSame, expectException, ::class, bootstrap e os cinco cenários
  salvos de subtotal e recusa de quantidades inválidas.
- Código PHP, testes, dependências, Compose e Dockerfile permaneceram iguais.

Verificação:

- Demonstração temporária via entrada padrão de `docker compose run --rm -T php php`:
  cria camiseta de 4990 centavos e item de quantidade 3; mostra subtotal 14970,
  desativa Produto e consulta estado inativo pelo item. Duas linhas, código 0.
- A demonstração confirma o uso do mesmo Produto guardado pelo item e retoma
  cálculo, encapsulamento, enum e autoload existentes, sem criar novo exemplo em src.
- Última execução dos testes na 3.21: `OK (5 tests, 5 assertions)`, código 0.
  Não repetida nesta revisão, que não alterou código ou dependências.
- Sem build, nova instalação ou execução do contador. Configuração local e
  volumes preservados.

Entendimento da revisão 3.22: confirmado com "entendi" em 12/10/2026.
Módulo 3 concluído quanto ao entendimento, com os conceitos revisados e cinco
testes PHPUnit já verificados.
Checkpoint: `7a4dc00`, `docs: conclui modulo PHP moderno e OOP`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `7a4dc008fc4418059d7057d913cea9a9336ee612`.

## Etapa 4.1

Objetivo: apresentar o papel do Laravel, conferir requisitos no Docker e definir
a organização do backend antes de gerar o projeto.

Implementação e explicação:

- Apenas documentação: `docs/aulas/04-01-preparacao-laravel.md`; README e roteiro
  atualizados para módulo 3 concluído e módulo 4 iniciado.
- Apresentados os papéis de PHP, Composer, Laravel e Docker. Laravel oferece
  classes e convenções para a aplicação web; rotas/controllers e outros recursos
  serão aprofundados quando seus arquivos forem introduzidos.
- Pasta definida: backend para Laravel; src preservado como laboratório PHP.
  O backend terá Composer e dependências próprios, com armazenamento separado
  do volume vendor-php do laboratório quando suas dependências forem instaladas.
- Requisitos oficiais consultados: Laravel 13 exige PHP >= 8.3, com PHP 8.4
  suportado, e treze extensões. Escolha PHP 8.4 do curso mantida.
- Framework declara composer-runtime-api ^2.2; a plataforma do Composer foi
  consultada para confirmar compatibilidade. Laravel ainda não instalado.

Verificação:

- `docker compose exec -T php php --version`: PHP 8.4.26 CLI.
- `docker compose exec -T php composer --version`: Composer 2.10.3.
- Diagnóstico PHP pela entrada padrão confirmou versão >= 8.3 e carregamento
  de ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO,
  session, tokenizer e xml. Treze módulos e diagnóstico atendido, código 0.
- `composer show --platform composer-runtime-api`: 2.2.2, compatível com ^2.2.
- `test ! -e backend`: código 0; caminho disponível, sem criar pasta nesta etapa.
- `composer create-project --help` confirmou --no-install e --no-scripts.
  O modelo oficial possui scripts de geração de .env, chave e SQLite; suas ações
  serão adiadas e explicadas, preservando a decisão SQL Server do curso.
- Sem mudança em código, Dockerfile ou Compose, build, instalação de pacotes
  ou execução do contador. Configuração local e volumes preservados.
- O diagnóstico cobre os requisitos PHP consultados; dependências completas
  serão resolvidas e verificadas quando forem instaladas no backend.

Entendimento da etapa 4.1: confirmado com "entendi" em 13/10/2026.
Checkpoint: `9807e53`, `docs: prepara ambiente para Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `9807e53416d5b45e3f903edf36aa2f3ff8381111`.

## Etapa 4.2

Objetivo: obter o esqueleto oficial de Laravel em backend e apresentar a
estrutura antes de instalar dependências ou executar a aplicação.

Implementação e explicação:

- Esqueleto laravel/laravel v13.11.0, versão consultada no Packagist e tag oficial,
  obtido com create-project, --no-install e --no-scripts, no Docker existente.
- backend ausente antes da operação; mkdir preparou o ponto de montagem local.
  Apenas backend montado em /projeto/backend:rw; --workdir /projeto, destino backend.
- Comando terminou com código 0 e gerou 58 arquivos. Antes do commit, removidos
  somente espaços no fim de três linhas vazias do template welcome.blade.php,
  apontados por git diff --cached --check; comportamento preservado.
  Proprietários alinhados à pasta backend com chown -R --reference;
  backend e composer.json verificados como 1000:1000 no host.
- Apresentados grupos app, bootstrap, config, database, public, resources, routes,
  storage e tests, arquivos de configuração e modelos gerados na raiz.
- Explicados os pontos de entrada public/index.php e artisan, autoload seguido de
  bootstrap/app.php, configuração de rotas e vínculo de / à view welcome.
- JSON declara framework ^13.17 e App\\ para app/; template v13.11.0 e biblioteca
  framework são pacotes diferentes. Dependências ainda não resolvidas/instaladas;
  lockfile será gerado posteriormente. Laboratório src continua independente.
- backend/AGENTS.md e CLAUDE.md lidos: recomendam instalação de runtime no host
  e Laravel Boost. As instruções do aluno e curso prevalecem (PHP 8.4 em Docker,
  dependências somente na etapa necessária); não foram executadas essas recomendações.
  Arquivos do modelo preservados. Não instalar Boost automaticamente em retomadas.
- Aula salva em `docs/aulas/04-02-esqueleto-laravel.md`; README atualizado.

Verificação:

- composer validate --no-check-lock no backend: configuração válida, código 0.
- php -l no Docker passou para artisan, public/index.php, bootstrap/app.php
  e routes/web.php. Sintaxe conferida sem executar o Laravel.
- Diagnóstico PHP confirmou pacote laravel/laravel, framework declarado ^13.17,
  mapeamento App\\ para app/ e inventário de 58 arquivos.
- .env, vendor, composer.lock, node_modules e database/database.sqlite ausentes,
  comprovando os artefatos adiados. Nenhuma migration ou teste Laravel executado.
- Git ignora ambiente local, dependências e SQLite; permite .env.example e código.
- git diff --exit-code -- src Dockerfile compose.yaml: sem alteração do laboratório
  ou infraestrutura. Sem build, novo serviço ou execução do contador.

Entendimento da etapa 4.2: confirmado com "entendi" em 13/10/2026.
Checkpoint: `cfa2e69`, `build: adiciona esqueleto oficial do backend Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `cfa2e69a9f24d6c0417406f340f02a3a079d827b`.
Pendências antes de usar banco/testes de integração: ajustar os padrões SQLite
do modelo conforme SQL Server e banco exclusivo de testes, quando introduzidos.
Próximo passo após confirmação: 4.3, preparar serviço backend no Compose para
comandos PHP/Composer, com ./backend:/app:ro e volume vendor-backend separado
em /app/vendor. Criar backend/vendor como ponto de montagem e conferir código
somente leitura e volume gravável. Dependências em etapa seguinte; não executar
Laravel, instalar Boost, adicionar banco ou frontend antecipadamente.

## Etapa 4.3

Objetivo: preparar o serviço Docker do backend com PHP/Composer e dependências
separadas das do laboratório, antes de instalar os pacotes Laravel.

Implementação e explicação:

- compose.yaml recebeu serviço backend: build da raiz, command php --version,
  bind mount ./backend:/app:ro e volume vendor-backend:/app/vendor gravável.
- Volume vendor-backend declarado na raiz; serviço php e seus volumes preservados.
- mkdir -p backend/vendor preparou ponto de montagem vazio, ignorado pelo Git.
- Dockerfile e .dockerignore preservados. Imagem reutiliza PHP 8.4.26, Composer
  2.10.3 e unzip; montagem sobre /app cobre a cópia src presente na imagem.
- Explicados caminhos local/container, WORKDIR /app, comando padrão e substituição
  por run, declaração/montagem de volumes e persistência após remoção do container.
- Aula em docs/aulas/04-03-servico-backend-e-vendor.md e README atualizados.

Verificação:

- docker compose config --quiet: válido, código 0. Build backend concluído.
- docker compose run --rm backend: PHP 8.4.26, término normal, container removido.
- docker compose run --rm backend composer --version: Composer 2.10.3/PHP 8.4.26.
- Diagnóstico PHP temporário: getcwd /app e manifesto laravel/laravel; /proc/mounts
  confirmou ro em /app e rw em /app/vendor; is_writable confirmou as permissões.
- Volume estava vazio. Marcador criado exclusivamente com fopen em modo x;
  gravação conferida, primeiro container terminou e foi removido.
- Segundo container leu o texto exato, comprovando persistência; unlink removeu
  somente o marcador e scandir comprovou que o volume voltou a ficar vazio.
- docker volume inspect confirmou curso-loja-fullstack_vendor-backend. Compose ps
  mostrou apenas o servidor php do laboratório ativo; backend é temporário.
- backend/vendor local vazio e ignorado; backend/.env e composer.lock ausentes.
  Sem instalação de pacotes, Artisan, migrations, testes Laravel ou contador.

Entendimento da etapa 4.3: confirmado com "entendi" em 13/10/2026.
Checkpoint: dc9f4b8, `build: prepara serviço Docker e vendor do backend`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `dc9f4b88786196896d229fd5785c698d2e8253f8`.
Próximo passo exato: após confirmação, publicar 4.3 e iniciar 4.4, instalação de
dependências de execução com Composer em Docker, sem scripts automáticos e sem
instalar ferramentas de desenvolvimento nesta etapa. Gerar composer.lock usando
uma montagem temporária gravável do backend e o mesmo volume vendor-backend;
apresentar pacotes/autoload e verificar requisitos. SQL Server e testes de
integração permanecem pendentes antes de qualquer uso dos padrões SQLite gerados.

## Etapa 4.4

Objetivo: instalar dependências de execução do backend e verificar lockfile e
autoload pelo Docker antes de inicializar o Laravel.

Implementação e explicação:

- Composer install pelo serviço backend, --no-dev, --no-scripts, --no-interaction
  e --no-progress. Sem lock anterior, resolveu versões e gerou backend/composer.lock.
- Montagem temporária ./backend:/instalacao:rw e workdir /instalacao permitiram
  escrever o lockfile; o volume existente curso-loja-fullstack_vendor-backend
  também montado em /instalacao/vendor recebeu pacotes e carregador.
- 109 pacotes resolvidos: 76 em packages, 33 em packages-dev. Somente os 76 de
  execução instalados. Laravel v13.35.0 e Tinker v3.0.2, compatíveis com as faixas
  ^13.17 e ^3.0. JSON, Compose e Dockerfile preservados.
- Autoload otimizado gerado conforme config do JSON. Scripts automáticos
  desativados; ambiente, descoberta Artisan e execução Laravel permanecem adiados.
- Lockfile inicialmente 0:0, alinhado ao JSON por chown --reference apenas
  nesse arquivo, via Docker e alias gravável; stat confirmou 1000:1000.
- Explicados requisitos versus versões exatas, install/update, packages e
  packages-dev, dependências transitivas, content-hash e arquivos do autoload.
- Aula em docs/aulas/04-04-dependencias-laravel.md e README atualizados.

Verificação:

- Instalação terminou com código 0 e geração do autoload.
- composer validate --strict: JSON e lock coerentes, código 0.
- composer check-platform-reqs --no-dev: PHP 8.4.26, runtime API e requisitos
  listados com success, inclusive os satisfeitos por polyfills declarados.
- PHP temporário no caminho normal /app comparou todos os pares nome/versão:
  packages do lock iguais aos 76 pacotes de vendor/composer/installed.json;
  instalação marcada como dev=false.
- require vendor/autoload.php e class_exists carregaram Illuminate\\Foundation\\Application
  e App\\Http\\Controllers\\Controller; Application::VERSION 13.35.0.
- Mapeamento App\\ presente e Tests\\ ausente; PHPUnit, Pint e Boost ausentes
  no backend, conforme os pacotes adiados. Laboratório src preservado.
- backend/vendor local vazio e ignorado; backend/.env, database.sqlite, node_modules,
  bootstrap/cache/packages.php e services.php ausentes, conforme ações adiadas.
- Sem Artisan, migrations, testes Laravel, servidor Laravel, banco ou contador.
  Verificação comprova instalação/autoload, não ciclo de requisição ou persistência.

Entendimento da etapa 4.4: confirmado com "entendi" em 13/10/2026.
Checkpoint: 4c6df27, `build: instala dependências de execução do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `4c6df27b1e6ec4f04c64c55bc6fa10df2f5c8e84`.
Próximo passo exato: após confirmação, publicar 4.4 e iniciar 4.5, preparar
montagens graváveis para storage e bootstrap/cache no serviço backend, mantendo
o restante do código somente leitura. Necessidade de gravação consultada na
documentação oficial do Laravel. Não inicializar aplicação antes de preparar
esse armazenamento; ambiente Laravel, chave e Artisan serão etapas posteriores.
Padrões SQLite do modelo continuam pendentes de ajuste antes de banco ou testes
de integração; usar SQL Server exclusivo para testes conforme o roteiro.

## Etapa 4.5

Objetivo: preparar os diretórios graváveis exigidos pelo Laravel, preservando
o código somente leitura antes de executar a aplicação.

Implementação e explicação:

- compose.yaml recebeu duas montagens no serviço backend:
  ./backend/storage:/app/storage:rw e
  ./backend/bootstrap/cache:/app/bootstrap/cache:rw.
- Bind mounts usam pastas já presentes no esqueleto; arquivos gerados aparecem
  no host. Sem novos volumes nomeados, pacotes, pastas ou rebuild da imagem.
- Montagem ./backend:/app:ro e volume vendor-backend preservados, assim como
  o serviço php do laboratório, seu vendor e os dados da demonstração.
- Explicados ro/rw, origem e destino, montagens mais específicas dentro de /app,
  funções de storage e bootstrap/cache e exclusões existentes do Git.
- Documentação oficial do Laravel confirma a necessidade de escrita nessas
  duas pastas. Aula em docs/aulas/04-05-pastas-gravaveis-laravel.md; README atualizado.

Verificação:

- docker compose config --quiet: válido, código 0.
- PHP temporário via run --rm -T: /proc/mounts confirmou ro em /app e rw nas
  duas pastas novas. is_writable confirmou código app/config/bootstrap sem
  escrita e storage, subpastas da estrutura e bootstrap/cache graváveis.
- Marcadores exclusivos criados com fopen em modo x em storage/framework/views
  e bootstrap/cache, com quantidade de bytes conferida. Autoload anterior disponível.
- Primeiro container terminou e foi removido; cat no host confirmou o texto
  exato dos dois arquivos, demonstrando a ligação às pastas locais.
- Segundo container leu o conteúdo e removeu somente os dois marcadores com
  unlink. Host confirmou a remoção; git check-ignore confirmou exclusão dos arquivos.
- git diff --exit-code -- backend src Dockerfile .dockerignore: sem alterações.
  Lockfile e bibliotecas anteriores preservados. Apenas Compose alterado na aplicação.
- backend/.env, SQLite e bootstrap/cache/packages.php e services.php ausentes.
- Compose ps mostrou apenas php ativo. Sem Artisan, migrations, testes Laravel,
  novo servidor, banco, frontend ou execução do contador.

Entendimento da etapa 4.5: confirmado com "entendi" em 13/10/2026.
Checkpoint: 7c0fcea, `build: prepara pastas graváveis do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `7c0fcea3b613cb55a29923237281a4b0fd57b91c`.
Próximo passo exato: após confirmação, publicar 4.5 e iniciar 4.6, apresentar
backend/.env.example e preparar backend/.env local para rotas iniciais sem banco,
com sessão/cache em arquivo e fila síncrona. Indicação de banco conforme SQL Server,
sem provisionar banco ou executar migrations. Artisan e geração da chave em
etapas posteriores. Não versionar ambiente local ou credenciais; testes de
integração usarão SQL Server exclusivo quando introduzidos.

## Etapa 4.6

Objetivo: preparar ambiente local Laravel para as primeiras rotas sem depender
de banco, antes de apresentar Artisan e gerar a chave.

Implementação e explicação:

- backend/.env.example: APP_NAME="Loja Fullstack", APP_URL planejada em
  http://127.0.0.1:8002, DB_CONNECTION=sqlsrv, SESSION_DRIVER=file,
  CACHE_STORE=file e QUEUE_CONNECTION=sync. APP_ENV=local e APP_DEBUG=true mantidos.
- APP_KEY mantida vazia. Campos de banco comentados, sem credenciais reais;
  indicação de porta 1433 comentada. Sem provisionar SQL Server ou instalar drivers.
- backend/.env ausente antes da cópia; cp --update=none criou o ambiente local
  preservando destinos existentes. chmod 600; stat confirmou 600 e 1000:1000.
- Explicados modelo versus cópia local, .env do Compose versus .env do backend,
  comentários, aspas, valores tratados por env() e relação com config/*.php.
- Sessão/cache em arquivos usam storage da 4.5; tarefas configuradas como sync.
  Demais grupos do modelo preservados e aprofundados somente quando utilizados.
- Aula em docs/aulas/04-06-ambiente-local-laravel.md e README atualizados.

Verificação:

- PHP temporário no serviço backend carregou autoload e Dotenv da pasta /app,
  sem inicializar Laravel. env() confirmou oito valores esperados e debug true
  booleano; APP_KEY vazia. Sem imprimir dados privados do ambiente.
- Hashes do modelo e cópia local iguais; campos DB_* comentados não carregados.
- Pastas de sessões, cache/data e cache/locks existentes e graváveis.
- git check-ignore confirmou backend/.env ignorado; git ls-files sem esse arquivo.
- Compose válido; src, Compose, Dockerfile, JSON e lockfile do backend sem mudança.
- Sem SQLite ou manifests de inicialização/cache, execução de Artisan, migrations,
  testes Laravel, novo servidor ou contador. Sem banco ou frontend adicionados.
- A verificação cobre leitura do ambiente, não requisições Laravel ou conexão SQL.
  APP_URL define endereço planejado; a porta 8002 ainda não foi publicada.

Entendimento da etapa 4.6: confirmado com "entendi" em 13/10/2026.
Checkpoint: ae521c9, `build: prepara ambiente local do Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `ae521c9ea4344cc408201875b454eae9b5a03f19`. .env fora do commit.
Próximo passo exato: após confirmação, publicar 4.6 e iniciar 4.7, apresentar
Artisan, verificar versão e gerar APP_KEY local, sem exibir a chave. Montar
temporariamente apenas backend/.env com escrita em /app/.env e conferir se há
chave existente antes de gerar. Explicar manifests/cache que surgirem na execução.
Modelo de ambiente já indica SQL Server. Fallback SQLite em config/database.php
e configuração SQLite no phpunit.xml ainda originais: ajustar antes de uso de
persistência ou testes de integração, mantendo banco SQL Server exclusivo de testes.

## Etapa 4.7

Objetivo: apresentar Artisan e gerar a chave local da aplicação, preservando
ambientes existentes e sem exibir o valor secreto.

Implementação e explicação:

- php artisan --version e help key:generate executados pelo serviço backend.
  Explicado arquivo artisan: autoload, bootstrap/app.php, ArgvInput, handleCommand
  e código de saída. Primeira execução Laravel pelo console no curso.
- PHP temporário conferiu APP_KEY vazia antes de chamar key:generate --no-interaction.
  Montagem adicional apenas de backend/.env:/app/.env:rw; código somente leitura.
  Guarda preserva uma chave existente. Nesta execução, chave vazia foi gerada.
- APP_KEY gravada somente no .env local; modelo continua vazio. Demais opções
  preservadas; modo 600 e proprietário/grupo 1000:1000 mantidos.
- Manifests bootstrap/cache/packages.php e services.php gerados pela inicialização,
  apresentados como arrays de pacotes/provedores/serviços. Fora do Git.
- Descobertos laravel/tinker, nesbot/carbon e nunomaduro/termwind, já instalados.
  Serviços com grupos providers, eager, deferred e when; aprofundamento posterior.
- Aula em docs/aulas/04-07-artisan-e-chave.md e README atualizados.

Verificação:

- Artisan retornou Laravel Framework 13.35.0; ajuda conferiu as opções, código 0.
- key:generate retornou Application key set successfully, código 0.
- Formato base64 e 32 bytes compatíveis com AES-256-CBC conferidos, sem exibir chave.
- Comparação antes/depois confirmou alteração somente na linha APP_KEY.
- Encrypter criptografou e recuperou texto fixo de teste, com resultado igual.
- Outro container inicializou kernel de console e confirmou config/app.key igual
  à chave local e serviço encrypter utilizando seus bytes. Valor não impresso.
- packages.php e services.php lidos como arrays; três pacotes descobertos.
- Git confirmou .env e manifests ignorados, ausentes da lista versionada.
- Código do backend, src, Compose, Dockerfile, JSON e lockfile sem alterações.
- Sem cache config.php, SQLite, migrations, testes Laravel, banco, frontend ou contador.
  Compose ps mostrou apenas servidor php do laboratório ativo; backend temporário.

Entendimento da etapa 4.7: confirmado com "entendi" em 13/10/2026.
Checkpoint: 590f98a, `docs: apresenta Artisan e valida chave local`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `590f98a7141f8223659711c659b2d857c05afc67`. Chave e manifests locais.
Próximo passo exato: após confirmação, publicar documentação da 4.7 e iniciar 4.8,
configurar servidor de desenvolvimento Laravel no serviço backend, publicar
127.0.0.1:8002 e verificar página inicial de /, preservando laboratório php.
Banco e testes de integração permanecem nas etapas previstas com SQL Server.

## Etapa 4.8

Objetivo: iniciar o servidor Laravel no Docker e verificar a página inicial do
modelo, mantendo o laboratório e as montagens preparados.

Implementação e explicação:

- compose.yaml: backend executa php artisan serve --host=0.0.0.0 --port=8000
  --tries=1 --no-reload, com ports 127.0.0.1:8002:8000 e stop_signal SIGINT.
- init:true acrescentado após parada forçada no diagnóstico inicial; encaminha
  sinais e cuida de processos filhos. Correção verificada antes de encerrar a aula.
- Explicados comando padrão persistente, portas interna/host, opções do servidor,
  init, sinal de parada e comandos up -d, ps, port, logs e stop.
- Montagens, serviço php e imagem preservados. Sem rebuild ou novos pacotes.
- Apresentado caminho básico GET / -> public/index.php -> bootstrap/app.php ->
  routes/web.php -> view welcome -> HTML. Arquivos PHP do backend preservados.
- Aula em docs/aulas/04-08-servidor-laravel.md e README atualizados.

Verificação:

- help serve confirmou opções. Porta 8002 disponível; Compose válido.
- up -d backend criou/iniciou servidor. ps mostrou php e backend ativos;
  port backend 8000 confirmou 127.0.0.1:8002; log de inicialização conferido.
- Diagnóstico PHP em Docker, --network host, consultou portas publicadas: Laravel
  8002 HTTP 200, título Loja Fullstack e texto welcome; laboratório 8001 HTTP 200.
- Primeira requisição gerou uma view compilada e um arquivo de sessão em storage.
  Contagens e legibilidade conferidas sem exibir conteúdo/identificadores de sessão.
- Código somente leitura; pastas de views/sessões graváveis; arquivos ignorados.
- Parada inicial sem init: exit 137, forçada. Com init:true: parada rápida,
  exit 130 por SIGINT; servidor reiniciado, ambas as páginas novamente HTTP 200.
- Backend, src, Dockerfile, .dockerignore e lockfile versionados sem alterações.
  Mudança de implementação somente em compose.yaml. Configuração local preservada.
- Sem banco, migrations, frontend, testes Laravel, pacotes ou contador executados.

Entendimento da etapa 4.8: confirmado com "entendi" em 13/10/2026.
Checkpoint: 6ccf825, `build: inicia servidor de desenvolvimento Laravel`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `6ccf825fbb834fdba7db7fb5785bbdb2721089f1`. Artefatos ignorados.
Estado de execução: Laravel em 127.0.0.1:8002 e laboratório em 127.0.0.1:8001 ativos.
Próximo passo exato: após confirmação, publicar 4.8 e iniciar 4.9, acrescentar
GET /loja em backend/routes/web.php com resposta textual usando config('app.name').
Explicar método, caminho, função de atendimento e resposta; controllers/view
própria em etapas posteriores. Persistência e testes de integração seguem SQL Server.

## Etapa 4.9

Objetivo: criar primeira rota própria da loja e explicar método, caminho,
função anônima, retorno tipado e consulta de configuração.

Implementação e explicação:

- backend/routes/web.php recebeu Route::get('/loja', function (): string), com
  return 'Bem-vindo à '.config('app.name').'!';. Rota / e import Route preservados.
- Explicados GET, caminho /loja, URL completa, closure passada como argumento,
  execução pelo Laravel ao corresponder a rota e retorno string como resposta HTTP.
- Explicados concatenação e config('app.name'), ligado à chave name de
  config/app.php e APP_NAME local. Sem mudança no ambiente.
- Aula em docs/aulas/04-09-primeira-rota-loja.md e README atualizados.

Verificação:

- php -l no container backend: sintaxe correta, código 0.
- Artisan route:list --path=loja --except-vendor: uma rota GET|HEAD loja,
  registrada em routes/web.php:9. HEAD apresentado brevemente; HTTP aprofundado depois.
- PHP temporário em Docker com --network host: GET /loja HTTP 200 e corpo exato
  Bem-vindo à Loja Fullstack!; Content-Type text/html; charset=utf-8.
- POST /loja HTTP 405, comprovando restrição do método; corpo de erro/cookies não exibidos.
- GET / permaneceu HTTP 200, com título Loja Fullstack e welcome preservada.
- Código atualizado visível pelo bind mount sem rebuild/reinício. Compose,
  Dockerfile, dependências, chave e laboratório preservados.
- Sem banco, migrations, frontend, testes Laravel ou contador. Diagnóstico cobre
  comportamento HTTP desta rota, não persistência ou regras de catálogo.

Entendimento da etapa 4.9: confirmado com "entendi" em 13/10/2026.
Checkpoint: 1671a0b, `feat: adiciona primeira rota da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `1671a0b15f6bba6f8d8daafa41548d31f76f5614`.
Próximo passo exato: após confirmação, publicar 4.9 e iniciar 4.10, criar
LojaController::index e fazer GET /loja apontar para esse método, preservando
a saudação. Explicar rota -> classe -> método público -> resposta. View própria
da loja em etapa posterior; banco e testes de integração seguem SQL Server.

## Etapa 4.10

Objetivo: mover atendimento de /loja para controller, preservando o comportamento
e apresentando a relação entre rota, classe, método público e resposta.

Implementação e explicação:

- LojaController.php ausente antes da geração. help make:controller conferido;
  classe gerada pelo Artisan no Docker, com --no-interaction e sem --force.
- Montagem temporária apenas da pasta app/Http/Controllers com escrita. Após
  geração, chown --reference da classe base aplicado somente ao arquivo novo;
  stat confirmou 1000:1000. Demais montagens e configurações preservadas.
- Arquivo gerado tinha import Request e classe vazia. Import sem uso retirado;
  método public index(): string recebeu a mesma saudação com config('app.name').
- Explicados namespace App\\Http\\Controllers, extends Controller, base abstrata
  vazia existente, método de instância público, tipo de retorno e concatenação.
- web.php recebeu import LojaController; GET /loja usa [LojaController::class, 'index'].
  Explicados nome completo da classe, array de destino e chamada pelo Laravel.
- Autoload App existente preservado. Aula em docs/aulas/04-10-primeiro-controller.md
  e README atualizados.

Verificação:

- Geração e ajuste de proprietário: código 0.
- php -l no Docker passou para LojaController.php e routes/web.php.
- route:list --path=loja --except-vendor: GET|HEAD loja -> LojaController@index.
- PHP temporário em Docker: GET /loja HTTP 200 e saudação exata preservada;
  POST /loja HTTP 405; GET / HTTP 200 e título welcome preservado.
- Classe nova carregada pelo autoload existente; sem dump-autoload, dependências,
  rebuild ou reinício. src, Compose, Dockerfile, JSON e lockfile preservados.
- Sem banco, frontend, migrations, testes Laravel, mudança de chave ou contador.

Entendimento da etapa 4.10: confirmado com "entendi" em 13/10/2026.
Checkpoint: f31b38e, `refactor: move saudação para controller da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `f31b38eb8d3732cf6e158d8fd9eff82687d4a7fc`.
Próximo passo exato: após confirmação, publicar 4.10 e iniciar 4.11, criar
resources/views/loja.blade.php e adaptar index para retornar view('loja') com o
nome da loja como dado. Explicar tipo View, passagem de dados e Blade {{ }}.
Model, persistência e testes de integração permanecem nas etapas previstas.

## Etapa 4.11

Objetivo: criar primeira view Blade da loja e passar dados pelo controller,
apresentando retorno View, HTML mínimo e exibição com escape.

Implementação e explicação:

- LojaController.php recebeu use Illuminate\\View\\View; index retorna View
  com view('loja', ['nomeLoja' => config('app.name')]).
- resources/views/loja.blade.php ausente antes da criação, criado com HTML mínimo,
  idioma pt-BR, charset utf-8, viewport, title e h1 com {{ $nomeLoja }}.
- Explicados nome do template, array de dados e variável correspondente, objeto
  View, renderização pelo Laravel e distinção de funções do controller e view.
- Explicados elementos HTML utilizados e duplas chaves Blade com escape de dados.
  Não antecipar estudo completo de HTML/CSS ou frontend do módulo próprio.
- Rota para LojaController@index preservada; arquivos de configuração intactos.
- Aula em docs/aulas/04-11-primeira-view-blade.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- PHP temporário em Docker consultou GET /loja: HTTP 200, Content-Type HTML UTF-8,
  doctype, idioma, charset, título e h1 preenchidos com o nome esperado.
- Expressões Blade ausentes no HTML recebido. GET / HTTP 200, welcome preservada.
- Renderização isolada da view com <b>Loja & teste</b> confirmou escape no título
  e h1. Dado temporário fornecido à renderização, sem mudar ambiente/configuração.
- PHP compilado de Blade sob storage/framework/views ignorado pelo Git.
- Rota, src, Compose, Dockerfile, JSON e lockfile preservados; sem rebuild/reinício.
- Sem banco, migrations, testes Laravel, frontend, dependências, chave alterada ou contador.
  Diagnóstico verifica apresentação e dados, não catálogo persistido.

Entendimento da etapa 4.11: confirmado com "entendi" em 13/10/2026.
Checkpoint: 1d93ab8, `feat: apresenta loja em view Blade`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `1d93ab8913540a1d27bcdd0c789622dd37e54567`. Compilados ignorados.
Próximo passo exato: após confirmação, publicar 4.11 e iniciar 4.12, passar pequena
lista de nomes demonstrativos de produtos do controller para a view e exibir com
@foreach. Dados em memória para estudar Blade, sem antecipar model/banco.

## Etapa 4.12

Objetivo: passar lista demonstrativa do controller à view e apresentar @foreach,
elemento atual do laço e lista HTML.

Implementação e explicação:

- LojaController@index recebeu o dado produtos com ['Camiseta', 'Calça', 'Tênis'],
  preservando nomeLoja e retorno View. Dados fixos em memória para demonstração.
- loja.blade.php recebeu h2 Produtos de demonstração e ul com
  @foreach ($produtos as $produto), li com {{ $produto }} e @endforeach.
- Explicados array associativo de dados, lista de strings, variável $produtos
  e elemento atual $produto, relação com foreach PHP e processamento no servidor.
- Explicados h2, ul e li; exibição com escape Blade preservada.
- Aula em docs/aulas/04-12-lista-produtos-blade.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- Diagnóstico PHP temporário em Docker consultou /loja: HTTP 200; título,
  saudação e novo título de seção presentes. Três li com nomes e ordem exatos.
- Diretivas @foreach/@endforeach e {{ }} ausentes no HTML recebido.
- GET / permaneceu HTTP 200, welcome preservada. Sem cookies ou HTML completo impressos.
- Rota, src, Compose, Dockerfile, JSON e lockfile preservados; sem rebuild/reinício.
- Sem entidades de catálogo, preços, banco, migrations, testes Laravel, frontend,
  dependências, mudança de ambiente/chave ou contador. Exercício de apresentação.

Entendimento da etapa 4.12: confirmado com "entendi" em 13/10/2026.
Checkpoint: 37b7485, `feat: exibe lista demonstrativa com Blade`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `37b74854c1b1d5b0a3b72c9b3c65514676bf2a62`.
Próximo passo exato: após confirmação, publicar 4.12 e iniciar 4.13, tratar lista
vazia na view com @if/@else e mensagem. Conferir listas preenchida/vazia por
renderização com dados temporários, mantendo os nomes do controller. Model e banco
continuam nas etapas previstas do roteiro.

## Etapa 4.13

Objetivo: mostrar uma mensagem quando a lista demonstrativa estiver vazia,
apresentando @if/@else, count e condição com comparação.

Implementação e explicação:

- Somente loja.blade.php alterada: @if (count($produtos) > 0) envolve a lista
  existente; @else apresenta p Nenhum produto de demonstração disponível.; @endif encerra.
- Explicados quantidade de elementos, comparação > 0, ramos verdadeiro/falso,
  diferença entre encerramentos de condição e laço e blocos aninhados.
- Controller mantém os três exemplos; nome, título, saudação e rota preservados.
- Aula em docs/aulas/04-13-lista-vazia-blade.md e README atualizados.

Verificação:

- PHP temporário no Docker inicializou o kernel de console e renderizou a view
  com três nomes e depois com []; dados fornecidos apenas às chamadas de renderização.
- Lista preenchida produziu os três itens na ordem, sem mensagem de vazio.
- Lista vazia produziu a mensagem, sem ul/li. Título e saudação preservados em ambos.
- GET /loja real HTTP 200, três exemplos preservados e mensagem de vazio ausente.
- Controller, rota, src, Compose, Dockerfile, JSON e lockfile sem alterações.
  Sem rebuild/reinício, ambiente/chave alterados, banco, migrations, dependências,
  frontend, testes Laravel ou contador.
- Diagnóstico cobre as duas apresentações da view; a página padrão continua
  preenchida, sem alterar o controller para simular o caso vazio.

Entendimento da etapa 4.13: confirmado com "entendi" em 13/10/2026.
Checkpoint: b944f4e, `feat: trata lista vazia na view da loja`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `b944f4e30ae1bce7dc1e6914bdc479cac35ee245`.
Próximo passo exato: após confirmação, publicar 4.13 e iniciar 4.14, middleware
MarcarRespostaCurso para adicionar X-Curso: Laravel à resposta, aplicado somente
a GET /loja. Explicar request -> próximo atendimento -> response e verificar
cabeçalho e conteúdo preservado. Model e persistência permanecem conforme o roteiro.

## Etapa 4.14

Objetivo: apresentar middleware que modifica a resposta depois de continuar o
atendimento, aplicado somente à rota /loja.

Implementação e explicação:

- app/Http/Middleware ausente antes da geração. help make:middleware conferido;
  MarcarRespostaCurso gerado pelo Artisan no Docker com --no-interaction.
- Montagem temporária app/Http gravável para criar a pasta ausente; proprietário
  da pasta e arquivo novos alinhados por chown --reference. stat confirmou 1000:1000.
- Mantidos namespace, imports Closure/Request/Response e assinatura handle.
  Corpo chama $next($request), guarda Response em $resposta, define X-Curso: Laravel
  por headers->set e devolve a resposta.
- Explicados Request, Closure de continuação, Response, chamada de $next,
  trabalho depois do atendimento e cabeçalho como informação fora do corpo HTML.
- web.php recebeu import MarcarRespostaCurso e ->middleware na rota /loja.
  Rota /, controller, view e bootstrap/app.php preservados; sem registro global.
- Aula em docs/aulas/04-14-primeiro-middleware.md, com diagrama do fluxo, e README atualizados.

Verificação:

- Geração e ajuste de proprietário: código 0. php -l passou para middleware e rota.
- route:list --path=loja --except-vendor -v mostrou GET|HEAD loja, LojaController@index,
  grupo web e App\\Http\\Middleware\\MarcarRespostaCurso.
- PHP temporário em Docker: GET /loja HTTP 200, X-Curso: Laravel e título,
  saudação e três produtos preservados. GET / HTTP 200 com título e sem X-Curso.
- Teste não imprimiu cookies ou HTML completo. Atuação e escopo confirmados.
- Controller, view, bootstrap, src, Compose, Dockerfile, JSON e lockfile preservados.
  Sem rebuild/reinício, dependências, banco, migrations, frontend, testes Laravel,
  chave alterada ou contador.

Entendimento da etapa 4.14: confirmado com "entendi" em 13/10/2026.
Checkpoint: 354626c, `feat: marca resposta da loja com middleware`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `354626c0dbd7d89b6c51455d88b124e0d5cb06e2`.
Próximo passo exato: após confirmação, publicar 4.14 e iniciar 4.15, criar
App\\Services\\CatalogoDemonstracao com listarNomes(): array e extrair a lista
do controller. Receber a classe como parâmetro de index para apresentar injeção
pelo container Laravel, preservando HTML e middleware. Dados continuam em memória.

## Etapa 4.15

Objetivo: extrair nomes demonstrativos para uma classe e recebê-la no controller
por injeção de dependência, apresentando o container de serviços Laravel.

Implementação e explicação:

- app/Services/CatalogoDemonstracao.php ausente antes da criação pelo editor;
  namespace App\\Services, método public listarNomes(): array com os mesmos três nomes.
- LojaController importa a classe; index(CatalogoDemonstracao $catalogo): View
  consulta $catalogo->listarNomes() para o dado produtos. Lista literal removida do controller.
- Explicados dependência, parâmetro tipado, objeto entregue pelo framework,
  chamada do método público, autoload e container de serviços como mecanismo PHP.
- Classe concreta sem dependências de construção, resolvida automaticamente.
  AppServiceProvider e bindings preservados; aprofundar registros quando necessários.
- Rota, view e middleware preservados. Aula em docs/aulas/04-15-injecao-dependencia.md
  e README atualizados.

Verificação:

- php -l no Docker passou para classe nova e controller.
- PHP temporário em Docker: GET /loja HTTP 200, título, saudação, três nomes na
  ordem e X-Curso: Laravel preservados. GET / HTTP 200, welcome sem X-Curso.
- Requisição confirma entrega do parâmetro obrigatório e uso da classe pela view.
- Sem alterações em rota, view, middleware, provider, bootstrap, src, Compose,
  Dockerfile, JSON ou lockfile. Sem rebuild/reinício ou dump-autoload.
- Sem banco, migrations, testes Laravel, frontend, dependências, chave alterada ou contador.
  Dados seguem demonstrativos em memória, sem model ou persistência.

Entendimento da etapa 4.15: confirmado com "entendi" em 13/10/2026.
Checkpoint: dca8ccd, `refactor: injeta catálogo demonstrativo no controller`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `dca8ccd583c338c7ce8581a7f639144495fbdc7a`.
Próximo passo exato: após confirmação, publicar 4.15 e iniciar 4.16, receber
CatalogoDemonstracao pelo construtor de LojaController com propriedade promovida;
index consulta $this->catalogo. Comparar pontos de injeção e preservar comportamento.

## Etapa 4.16

Objetivo: comparar injeção no método e no construtor, guardando a dependência
em propriedade promovida e preservando o comportamento.

Implementação e explicação:

- Somente LojaController alterado: __construct(private CatalogoDemonstracao $catalogo)
  com corpo vazio; index(): View usa $this->catalogo->listarNomes().
- Explicados entrega na criação do objeto, construtor público, propriedade
  promovida privada tipada, atribuição automática e acesso por $this.
- Apresentada equivalência com propriedade e atribuição explícitas, apenas didática.
- Comparados pontos de injeção: parâmetro local do método e propriedade da instância.
  Sem registro de singleton ou binding; resolução automática da classe permanece.
- Catálogo, rota, view e middleware preservados. Aula em
  docs/aulas/04-16-injecao-construtor.md e README atualizados.

Verificação:

- php -l no Docker: controller sem erros de sintaxe.
- PHP temporário no container backend consultou porta interna 8000: GET /loja
  HTTP 200, título, saudação, três nomes na ordem e X-Curso: Laravel preservados.
- GET / HTTP 200, welcome sem X-Curso. Sem cookies ou respostas completas impressos.
- Atendimento confirmou construção com parâmetro obrigatório e propriedade inicializada.
- Catálogo, rota, view, middleware, provider, src, Compose, Dockerfile, JSON e lockfile
  preservados. Sem rebuild/reinício, dependências, banco, migrations, testes Laravel,
  frontend, chave alterada ou contador.

Entendimento da etapa 4.16: confirmado com "entendi" em 13/10/2026.
Checkpoint: 5da3709, `refactor: recebe catálogo pelo construtor`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `5da37098c407a616d3a521b04864a583b7c947e2`.
Próximo passo exato: após confirmação, publicar 4.16 e iniciar 4.17, interface
App\\Contracts\\Catalogo com listarNomes(): array, implementação em CatalogoDemonstracao,
contrato recebido no construtor e binding em AppServiceProvider::register.
Conjunto inseparável para introduzir contrato, ligação e papel do provider,
preservando dados em memória, HTML e middleware.

## Etapa 4.17

Objetivo: receber interface no controller e ligar o contrato à implementação
com binding, apresentando o papel do AppServiceProvider.

Implementação e explicação:

- app/Contracts/Catalogo.php ausente antes da criação: interface com public
  listarNomes(): array. Autoload App preservado.
- CatalogoDemonstracao importa Catalogo e implements o contrato; lista preservada.
- LojaController importa e recebe Catalogo na propriedade promovida do construtor;
  index continua consultando listarNomes e fornecendo os dados à view.
- AppServiceProvider::register recebeu bind(Catalogo::class, CatalogoDemonstracao::class).
  Explicados nomes ::class, $this->app herdado, registro da ligação e resolução.
- bootstrap/providers.php já inclui AppServiceProvider, carregado pelo Laravel.
  Arquivo preservado; boot permaneceu vazio, com papel apresentado brevemente.
- Conjunto inseparável de quatro arquivos: contrato, implementação, consumidor
  e registro. Aula em docs/aulas/04-17-contrato-e-binding.md e README atualizados.

Verificação:

- php -l no Docker passou para os quatro arquivos.
- Kernel de console inicializado no diagnóstico temporário; binding registrado;
  $app->make(Catalogo::class) resolveu CatalogoDemonstracao, que satisfaz a interface
  e mantém os três nomes na ordem.
- HTTP no container: GET /loja 200, título, saudação, três nomes e X-Curso preservados;
  GET / 200, welcome sem X-Curso. Sem cookies ou respostas completas impressos.
- Rota, view, middleware, bootstrap, src, Compose, Dockerfile, JSON, lockfile e
  ambiente preservados. Sem rebuild/reinício, dependências, banco, migrations,
  testes Laravel, frontend ou contador.

Entendimento da etapa 4.17: confirmado com "entendi" em 13/10/2026.
Checkpoint: 92d6e5f, `refactor: registra contrato de catálogo no container`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `92d6e5f925abb704b9ae57e366a0d7ac024e959b`.
Próximo passo exato: após confirmação, publicar 4.17 e iniciar 4.18, apresentar
M de MVC pelo app/Models/User.php já gerado e demonstrar instância/atributos em
memória, sem consultar ou gravar no banco. Explicar papel do model Eloquent;
persistência SQL Server, factories e autenticação ficam nas etapas previstas.

## Etapa 4.18

Objetivo: apresentar o papel do Model em MVC e o User Eloquent existente,
demonstrando atributos em memória antes de persistência.

Implementação e explicação:

- Sem alteração de código. User.php já gerado na 4.2 foi lido e apresentado.
- Explicados Model como representação de dados/comportamento, Eloquent como ORM,
  relação com controller/view e namespace App\\Models.
- Apresentados alias Authenticatable, herança que inclui Model, convenção User/users,
  metadados PHP Fillable/Hidden, traits HasFactory/Notifiable e método casts.
- Aprofundados apenas atributos usados; factories, notificações, autenticação e
  conversões de senha/data apresentados por função, com prática adiada às etapas próprias.
- Demonstração PHP temporária com nome/e-mail fictícios, usando apenas autoload,
  new User com array de atributos e alteração de name em memória.
- Aula em docs/aulas/04-18-papel-model.md e README atualizados.

Verificação:

- Objeto instanceof Eloquent Model; name/email preenchidos com dados fictícios.
- getTable retornou users, sem verificar/criar tabela. getFillable e getHidden
  confirmaram metadados do modelo.
- Name atualizado e lido por getAttribute. exists=false e getKey=null mantidos.
- Model::getConnectionResolver=null antes/depois; sem inicialização Laravel,
  resolvedor de banco, query, save, migration, factory, notificação ou autenticação.
- git diff --exit-code -- backend src compose.yaml Dockerfile: sem alterações.
  Sem dependências, banco, testes Laravel, frontend, credenciais ou contador.
- Diagnóstico demonstra objetos/atributos em memória, não integração SQL Server.

Entendimento da etapa 4.18: confirmado com "entendi" em 13/10/2026.
Checkpoint: aa372c6, `docs: apresenta papel do model Eloquent`.
Publicação autorizada e verificada: HEAD, origin/main e consulta direta à main
remota retornaram `aa372c66ef54086f72d9aea2160a67fcdc9aaa86`. Nenhum código novo.
Próximo passo exato: após confirmação, publicar documentação da 4.18 e iniciar
4.19, revisão do módulo 4 com fluxo completo, entrega /loja e pendências para SQL
Server. Encerrar módulo apenas após entendimento da revisão, antes de iniciar 5.

## Etapa 4.19

Objetivo: revisar o módulo 4, conferir sua entrega e pendências antes de SQL Server.

Implementação e explicação:

- Sem alteração de código. Revisados estrutura, Artisan, ambiente, chave, ciclo
  HTTP, rotas, controller, view/Blade, middleware, container, injeção e provider.
- Relacionados Catalogo/implementação/binding/construtor e dados enviados à view.
  Model User estudado separadamente em memória, sem integração na página.
- Diagrama e mapa de arquivos em docs/aulas/04-19-revisao-modulo-4.md; README e
  roteiro atualizados para revisão em encerramento, ainda aguardando entendimento.
- Registradas pendências de drivers, banco, compatibilidade, integração exclusiva
  e padrões SQLite antes de persistência. Não iniciar módulo 5 nesta revisão.

Verificação:

- Compose ps mostrou backend e php ativos, respectivamente em 127.0.0.1:8002 e 8001.
- route:list detalhada confirmou /loja -> LojaController@index, web e middleware.
- PHP temporário em Docker na rede do host: /loja HTTP 200, título/saudação e
  três nomes na ordem, X-Curso: Laravel. / e laboratório HTTP 200, sem X-Curso.
- Checagem de leitura do PHP: sqlsrv e pdo_sqlsrv não carregados, pendentes.
- Código backend, src, Compose e Dockerfile sem alterações; .env continua ignorado.
  Sem instalação, banco, migrations, testes Laravel, frontend, chave alterada ou contador.
- Escape/lista vazia e modelo em memória já verificados nas etapas próprias;
  nesta revisão, conferida a entrega HTTP atual sem repetir verificações desnecessárias.

Entendimento da etapa 4.19: confirmado com "entendi" em 13/10/2026.
Estado do módulo 4: concluído após confirmação desta revisão.
Publicação: checkpoint 2346772, `docs: conclui módulo 4 de Laravel e MVC`.
Push autorizado e verificado; HEAD, origin/main e consulta direta à main remota
retornaram `23467729d7d3d5ebf6587084cab007ad1afa4df7`. Nenhum código novo.
Próximo passo realizado: preparação 5.1, diagnóstico de recursos e compatibilidade.

## Etapa 5.1

Objetivo: conferir arquitetura/recursos Docker, plataforma PHP e requisitos
oficiais antes de introduzir componentes de persistência.

Implementação e explicação:

- Diagnóstico somente de leitura, sem alterar Dockerfile, Compose ou aplicação.
- Explicado caminho Laravel -> PDO/pdo_sqlsrv -> ODBC -> SQL Server -> volume.
  PDO é a interface PHP; drivers ficam no backend; servidor terá outro container.
- Diferenciados objetos em memória de gravação persistente e localhost do backend
  de nome do futuro serviço na rede Docker. Nenhuma conexão já implementada.
- Referências Microsoft e Laravel conferidas. Base do laboratório definida:
  SQL Server 2022 Developer para desenvolvimento/testes; ODBC 18; drivers PHP
  da linha 5.13, release estável consultada 5.13.3. Versões dos pacotes e imagem
  SQL Server serão conferidas/fixadas na instalação, sem uso antecipado de latest.
- Aula docs/aulas/05-01-preparacao-sql-server.md criada; README e roteiro
  atualizados; revisão 4.19 e registro recebem SHA da publicação verificada.

Verificação:

- Docker info: Linux x86_64, 8 CPUs, MemTotal 8.193.597.440 bytes (~7,63 GiB),
  armazenamento overlayfs, diretório /var/lib/docker.
- MemAvailable observado: 5.332.836 KiB (~5,09 GiB), valor variável; clock
  observado até 2419,2 MHz. Diagnóstico de recursos, sem benchmark.
- df -h -T: /var/lib/docker e bind mount /app sobre ext4; ~942 GiB livres.
  Raiz do container overlay. Recursos observados atendem à preparação inicial
  frente aos requisitos Linux de x64, 2 GB de RAM, 6 GB de disco, 2 núcleos/2 GHz.
- Backend Debian 12 bookworm x86_64; PHP 8.4.26 64 bits, sem thread safety.
  PDO carregada, sqlsrv/pdo_sqlsrv ausentes, PDO::getAvailableDrivers apenas sqlite.
- dpkg-query não encontrou msodbcsql18, unixodbc ou libodbc2.
- Matriz Microsoft: drivers 5.13 compatíveis com PHP 8.4, Debian 12, SQL Server
  2022 e ODBC 18. Laravel orienta sqlsrv/pdo_sqlsrv e dependências ODBC.
- Compose ps: backend e php ativos em 8002/8001. Código/ambiente preservados;
  nenhum banco, pacote, credencial, migration, teste Laravel ou contador executado.
- Disponibilidade de recursos varia; inicialização SQL Server e conexão real
  ainda não foram verificadas e terão suas aulas próprias.

Entendimento da etapa 5.1: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 41d0660, `docs: verifica preparação para SQL Server`.
Push autorizado e verificado; HEAD, origin/main e consulta direta à main remota
retornaram `41d0660945bd3b91dc3a036017986e1adc6c2ff5`.
Próximo passo exato: após confirmação, publicar diagnóstico 5.1 e iniciar 5.2,
preparar uma imagem própria do backend com Microsoft ODBC Driver 18, preservando
a imagem do laboratório PHP. Drivers PHP e serviço SQL Server entrarão em etapas
seguintes. Banco SQL Server exclusivo para integração continua obrigatório;
ajustar padrões SQLite do esqueleto antes de persistência/testes.

## Etapa 5.2

Objetivo: preparar a imagem própria do backend com Microsoft ODBC Driver 18,
dependência dos drivers PHP que serão introduzidos na etapa seguinte.

Implementação e explicação:

- Criado Dockerfile.backend com PHP 8.4.26 bookworm e Composer 2.10.3.
- Baixado instalador oficial packages-microsoft-prod para Debian 12; checksum
  conferido antes de dpkg -i. Versão 1.1-debian12; SHA-256
  8434dcb8c346dc95fbd63dbece056c343704590b58b6a5c323d39acf52bf0b48.
- Repositório Microsoft configurado; msodbcsql18=18.7.1.1-1 instalado com
  ACCEPT_EULA=Y, aceite da licença restrito ao comando de instalação.
- unzip=6.0-28+deb12u1 mantido; libgssapi-krb5-2=1.20.1-2+deb12u5 explicitado
  como biblioteca exigida pelo ODBC, já presente na base.
- Explicados curl, checksum, dpkg, índices APT, versões dos pacotes, &&,
  continuação de linhas, limpeza, WORKDIR e CMD. Código Laravel vem do bind mount.
- Compose backend passou a build.context=. e build.dockerfile=Dockerfile.backend;
  .dockerignore permite a receita. Demais opções/montagens preservadas.
- Build e recriação somente do backend; explicada diferença entre imagem
  construída e container existente. Laboratório continua no Dockerfile original.
- Aula docs/aulas/05-02-odbc-backend.md criada; README, roteiro e progresso
  atualizados. Explicação apresentada, sem adiantar extensões PHP ou banco.

Verificação:

- Consulta em Docker ao índice oficial confirmou msodbcsql18 18.7.1.1-1 para
  amd64; instalador do repositório consultado e temporário removido.
- docker compose config --quiet válido; build backend concluído, checksum OK.
  PHP e Composer resolveram os digests registrados na aula, versões mantidas.
- up -d --no-deps backend recriou/aplicou imagem. php manteve ID de container
  009e8bd17b90915bb0f143a0fd0c3bd2cc8a8685ea076aba5f14e75f3e1ffc06 e imagem
  sha256:08de3109b7bf12763cb263a024a9ae838c6793a25f6373440f1920c6fa85654e.
- dpkg-query: ODBC 18.7.1.1-1, unixODBC 2.3.11-2+deb12u1, repositório
  1.1-debian12, libgssapi e unzip nas versões fixadas.
- odbcinst encontrou ODBC Driver 18 for SQL Server e biblioteca
  /opt/microsoft/msodbcsql18/lib64/libmsodbcsql-18.7.so.1.1.
  ldd encontrou dependências resolvidas; PHP confirmou arquivo registrado/legível.
- PHP 8.4.26/Composer 2.10.3 mantidos; check-platform-reqs --no-dev passou.
  Autoload preservado no volume, Laravel 13.35.0; extensões sqlsrv/pdo_sqlsrv ausentes.
- HTTP em PHP/Docker na rede do host: /loja 200 com título, nomes na ordem e
  X-Curso: Laravel; welcome e laboratório 200 sem X-Curso. Serviços ativos em 8002/8001.
- git diff --exit-code -- backend src Dockerfile passou; backend/.env ignorado.
  Sem alteração na aplicação, banco, migration, teste Laravel ou contador.
- Instalação ODBC verificada; nenhuma conexão SQL Server demonstrada nesta etapa.

Entendimento da etapa 5.2: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 5709dfe, `build: prepara ODBC na imagem do backend`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `5709dfefd739105efeff07691e6c127faa54dac6`.
Próximo passo exato: após confirmação, publicar 5.2 e iniciar 5.3, instalar e
habilitar sqlsrv/pdo_sqlsrv 5.13.3 na imagem backend, conferindo método oficial
e dependências de compilação. Serviço SQL Server será introduzido em outra etapa;
banco de integração exclusivo e ajuste de padrões SQLite seguem pendentes.

## Etapa 5.3

Objetivo: instalar e habilitar sqlsrv/pdo_sqlsrv 5.13.3 no PHP do backend,
usando ODBC já preparado e método oficial conferido.

Implementação e explicação:

- Alterado apenas Dockerfile.backend na implementação. Acrescentados git
  1:2.39.5-0+deb12u3, libtool 2.4.7-7~deb12u1 e unixodbc-dev 2.3.11-2+deb12u1,
  com versões consultadas em container temporário. Base já fornece compiladores,
  make, autoconf, pkg-config, phpize e php-config compatíveis com PHP 8.4.26.
- PIE 1.5.2 baixado da release oficial identificável, SHA-256 conferido e
  chmod +x aplicado. Hash: fe70c59738cf56ec00a818cf9cb9593da171aac86f5f1f859995b8839dfd2cc7.
- Método PIE recomendado pela documentação atual Microsoft, suportado pelos
  drivers 5.13.2+. Instalados microsoft/sqlsrv:5.13.3 e microsoft/pdo_sqlsrv:5.13.3
  em comandos separados, sem interação/cache e com dois trabalhos de compilação.
- Explicada diferença entre classes Composer/vendor e extensões PHP/.so;
  funções sqlsrv e driver PDO, compilação para PHP alvo e habilitação por .ini.
- PIE compilou, instalou e habilitou as duas extensões. Arquivos gerados na imagem:
  /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini com extension=sqlsrv e
  /usr/local/etc/php/conf.d/docker-php-ext-pdo_sqlsrv.ini com extension=pdo_sqlsrv.
  Bibliotecas em /usr/local/lib/php/extensions/no-debug-non-zts-20240924/.
- Build e aplicação apenas do backend. Compose, laboratório e código preservados.
  Aula docs/aulas/05-03-extensoes-sql-server.md criada; README/roteiro/progresso atualizados.

Verificação:

- PIE --version e install --help em container descartável confirmaram 1.5.2,
  sintaxe vendor/package:versão e opções utilizadas. Checksum conferido com os
  metadados públicos da release; consultas e ferramentas executadas em Docker.
- config --quiet válido; build backend passou. PIE confirmou alvo PHP 8.4.26
  NTS x86_64, phpize/configure/build/install concluídos para os dois drivers.
- up -d --no-deps backend recriou o serviço. Script no backend verificou
  extension_loaded e phpversion: sqlsrv/pdo_sqlsrv carregadas, exatamente 5.13.3.
- function_exists('sqlsrv_connect') verdadeiro; PDO::getAvailableDrivers passou
  a listar sqlite/sqlsrv. Nenhuma função de conexão, query ou gravação executada.
- .ini efetivamente lidos e conteúdos conferidos; versões git/libtool/unixodbc-dev
  confirmadas, ODBC 18.7.1.1-1 registrado. PIE 1.5.2 mantido na imagem.
- Composer check-platform-reqs --no-dev passou; autoload do volume preservado,
  Laravel 13.35.0. Serviços ativos em 8002/8001; laboratório com mesmo ID/imagem.
- PHP temporário em Docker com rede do host: /loja 200, título e três nomes
  corretos na ordem, X-Curso: Laravel; welcome e laboratório 200 sem X-Curso.
- git diff --exit-code -- backend src compose.yaml Dockerfile .dockerignore
  passou; backend/.env ignorado. Sem SQL Server, banco, migration ou contador.
- Drivers disponíveis não comprovam conexão real: faltam servidor e acesso.

Entendimento da etapa 5.3: confirmado com "entendi" em 13/10/2026, após esclarecimento PIE.
Pergunta do aluno: "o que é eese pie?". Esclarecimento apresentado: PIE significa
PHP Installer for Extensions, ferramenta de instalação de extensões no PHP.
Comparado com Composer, que instala bibliotecas/classes da aplicação em vendor.
Exemplo desta aula: pie install microsoft/pdo_sqlsrv:5.13.3 baixa o pacote,
compila/instala a extensão e configura seu carregamento no PHP da imagem.
Ferramenta utilizada durante o build; aplicação usa a extensão instalada em execução.
Entendimento desse esclarecimento e da 5.3 confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint 5ba53e2, `build: instala extensões PHP para SQL Server`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `5ba53e2f6d6fda3b962909b2d3e2eb9c919eb6b8`.
Próximo passo exato: após confirmação, publicar 5.3 e iniciar 5.4, introduzir
SQL Server 2022 Developer no Compose, conferindo imagem/tag/digest, volume
persistente e credenciais locais ignoradas. Conexão Laravel e bancos da loja/testes
terão suas etapas próprias; integração deve usar banco SQL Server exclusivo.

## Etapa 5.4

Objetivo: introduzir SQL Server 2022 Developer no Compose com imagem identificável,
volume persistente e configuração local ignorada, e verificar o servidor.

Implementação e explicação:

- Acrescentado serviço sqlserver a compose.yaml; imagem oficial
  mcr.microsoft.com/mssql/server:2022-CU27-GDR1-ubuntu-22.04, digest
  sha256:cf8f0ab2ebe61feec2eed2629061a07d247f791c2a8ddda74a4ac9f06a291718.
  Tags e manifesto consultados no registro Microsoft antes do download.
- Explicados image pronta, tag/CU/GDR, digest e serviço separado do PHP.
  ACCEPT_EULA=Y aceita licença; MSSQL_PID=Developer define uso desenvolvimento/testes.
- MSSQL_SA_PASSWORD usa interpolação obrigatória ${MSSQL_SA_PASSWORD:?...}.
  Modelo root .env.example recebe campo vazio; senha aleatória gerada somente
  no root .env ignorado, sem exibir valor, usando PHP em Docker. Conteúdo existente
  preservado, política de senha conferida e modo 600 aplicado.
- MSSQL_MEMORY_LIMIT_MB=2048 e mem_limit=3g limitam SQL Server e container
  separadamente. Diagnóstico inicial: ~7,63 GiB totais, ~5,07 GiB disponíveis,
  8 CPUs x86_64 e ~942 GiB de disco livres; disponibilidade varia.
- Volume dados-sqlserver declarado/montado em /var/opt/mssql. Nome SQL Server
  na rede interna é sqlserver, porta 1433; dentro do backend localhost é o backend.
- Modelo e configuração local são parte inseparável da introdução do serviço.
  Documentado comando PHP/Docker independente do Compose para preparar a senha
  em outro clone, antes dos comandos Compose que agora exigem o campo.
- Aula docs/aulas/05-04-servico-sql-server.md criada; README/roteiro atualizados.
  Apresentados sqlcmd, variável SQLCMDPASSWORD, opções, SELECT 1/metadados e GO.

Verificação:

- config --quiet passou com ambiente real. Validação isolada com .env.example
  e variável SQL ausente recusou configuração com a mensagem prevista, sem segredo.
- pull sqlserver e up -d --no-deps sqlserver concluídos. Serviço running,
  imagem Linux/amd64 e RepoDigest iguais ao conteúdo escolhido.
- Inspect confirmou mem_limit de 3.221.225.472 bytes e volume
  curso-loja-fullstack_dados-sqlserver gravável em /var/opt/mssql.
- sqlcmd dentro do container, senha via variável de ambiente, certificado local
  aceito com -C: SELECT 1 retornou 1; SERVERPROPERTY informou 16.0.4305.5 e
  Developer Edition (64-bit). COUNT em sys.databases com database_id > 4 retornou 0.
- São consultas de diagnóstico somente leitura; motor preparou bancos de sistema,
  sem criação de bancos loja/testes, migrations, tabelas ou dados da aplicação.
- PHP no backend resolveu sqlserver e abriu conexão TCP à porta 1433.
  /loja e laboratório responderam HTTP 200; backend/php continuaram ativos.
- Comando documentado para outro clone executado sobre configuração existente:
  senha preservada. Não imprime senha, usa random_bytes para campo vazio/ausente.
- Root .env e backend/.env ignorados; código backend/src, Dockerfiles e
  .dockerignore preservados. Não alterado contador; nenhum teste Laravel executado.
- Montagem de volume conferida; sem novo teste de remoção/recriação de dados.
  Conexão Laravel ainda não configurada; servidor disponível não é catálogo persistido.

Entendimento da etapa 5.4: confirmado com "entendi" em 13/10/2026.
Pergunta do aluno: "quais os dados para acesso ao banco?". Esclarecimento:
servidor sqlserver e porta 1433 na rede Docker, login sa, senha no campo
MSSQL_SA_PASSWORD do .env local da raiz; valor não copiado para documentação.
Banco master disponível para conexão inicial; loja/loja_test ainda não criados.
Não há publicação de porta no host nesta configuração, portanto acesso por
cliente no computador precisará de configuração própria. Esclarecimentos confirmados
com "entendi". Aluno pediu aviso quando puder conectar pelo DBeaver e autorizou
seguir o curso. Registrar aviso para a etapa de acesso host, sem antecipá-la.
Publicação: checkpoint d9fba40, `build: adiciona serviço SQL Server Developer`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `d9fba40e398512cb63385e970e8578ffe90441d2`.
Próximo passo exato: após confirmação, publicar 5.4 e iniciar 5.5, criar bancos
loja e loja_test com SQL em Docker, explicar servidor/banco e CREATE DATABASE.
Conexão Laravel terá sua etapa; integração usará exclusivamente loja_test.
Padrões SQLite de configuração/phpunit.xml serão ajustados antes de uso.

## Etapa 5.5

Objetivo: criar bancos loja e loja_test no servidor SQL Server local, separar
persistência da aplicação de integração e estudar CREATE DATABASE.

Implementação e explicação:

- Criado apenas docker/sqlserver/criar-bancos.sql na implementação. Pasta
  docker/sqlserver organiza a preparação; arquivo SQL não contém credenciais.
- USE master seleciona contexto administrativo; IF DB_ID(N'nome') IS NULL
  cria cada banco somente quando ausente, usando CREATE DATABASE [nome].
- Explicados servidor versus banco, banco exclusivo de testes, comentário --,
  string Unicode N'...', identificador delimitado [], comparação IS NULL,
  ponto e vírgula e GO como separador de lotes do cliente.
- Executado por sqlcmd no container SQL Server com entrada padrão redirecionada
  do arquivo local. Explicado <, exec -T, variável de senha já existente,
  localhost dentro do servidor, login sa, certificado local e opções -l/-b.
- Arquivo não executa automaticamente ao iniciar Compose; preparação explícita
  registrada no README para outro ambiente, preservando bancos existentes.
- Aula docs/aulas/05-05-criacao-bancos.md criada; README/roteiro/progresso atualizados.
  Pedido DBeaver preservado: preparar acesso local e avisar na 5.6.

Verificação:

- Serviços ativos. Antes da criação, consulta sys.databases não encontrou
  loja ou loja_test, preservando qualquer trabalho existente antes de aplicar SQL.
- Execução do arquivo passou, fora de transação explícita. Consulta posterior:
  loja ID 5 ONLINE, loja_test ID 6 ONLINE. IDs são desta sessão, não fixados na aplicação.
- sys.master_files: loja.mdf/loja_log.ldf e loja_test.mdf/loja_test_log.ldf em
  /var/opt/mssql/data, sob o volume dados-sqlserver já montado.
- Reexecutado o arquivo; conexões sqlcmd -d loja e -d loja_test passaram.
  DB_NAME()/DB_ID() retornaram os mesmos nomes/IDs; sys.tables filtrada por
  is_ms_shipped=0 retornou zero tabelas da aplicação em ambos.
- Nenhum DROP, tabela, dado da aplicação, migration, login novo, teste Laravel
  ou contador executado. Configuração de integração deverá usar loja_test
  explicitamente antes de executar testes; o banco criado sozinho não basta.
- git diff --exit-code -- backend src compose.yaml Dockerfile Dockerfile.backend
  .dockerignore passou; root .env e backend/.env ignorados.
- Verificações demonstram bancos distintos, acessíveis e preparados; não são
  integração Laravel, catálogo persistido ou acesso DBeaver pelo host.

Entendimento da etapa 5.5: confirmado com "entendi" em 13/10/2026.
Publicação: checkpoint fc2cdbc, `feat: prepara bancos da loja e integração`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `fc2cdbcc4199efa9f0636b8a34e2e90beb2978b5`.
Próximo passo exato: após confirmação, publicar 5.5 e iniciar 5.6, configurar
publicação de porta SQL Server somente em 127.0.0.1 para acesso local pelo
DBeaver, conferir acesso e informar os dados ao aluno conforme pedido.
Conexão Laravel, tabelas e configuração dos testes terão etapas próprias.

## Etapa 5.6

Objetivo: disponibilizar acesso SQL Server no computador para DBeaver, conferir
endpoint e informar dados ao aluno conforme pedido de aviso.

Implementação e explicação:

- Acrescentado apenas ports: ["127.0.0.1:1433:1433"] ao serviço sqlserver.
  Explicados endereço do host, porta publicada, porta interna e encaminhamento.
- Diferenciados endereço sqlserver:1433 dentro da rede Compose e 127.0.0.1:1433
  no computador. DBeaver é cliente; os arquivos permanecem no volume SQL Server.
- Confirmado Linux WSL2; consultada documentação Microsoft de localhost Windows/WSL.
  Endpoint testado no host Docker; interface DBeaver depende do teste do aluno.
- Apresentados Microsoft SQL Server no DBeaver, host 127.0.0.1, porta 1433,
  banco loja, autenticação SQL Server, login sa e senha no campo MSSQL_SA_PASSWORD
  do root .env ignorado. Valor não impresso/copiado para documentação pública.
- Para certificado local, Trust Server Certificate ou propriedade
  trustServerCertificate=true, mantendo encrypt=true. Explicada aceitação
  do certificado local sem validação da cadeia, conforme documentação JDBC Microsoft.
- Aula docs/aulas/05-06-acesso-dbeaver.md criada; README/roteiro atualizados.
  Instruído Test Connection, eventual driver JDBC e experiência SELECT DB_NAME().
- Aviso ao aluno emitido após conexão endpoint passar: acesso local disponível.

Verificação:

- ss -ltn anterior: porta 1433 livre. config --quiet passou; up -d --no-deps
  sqlserver recriou apenas esse serviço. port retornou 127.0.0.1:1433.
- Compose ps mostrou publicação 127.0.0.1:1433->1433/tcp; backend/php ativos.
- Cliente sqlcmd em container temporário com --network host e --env-file .env,
  entrypoint sh para executar somente cliente. Senha via SQLCMDPASSWORD sem
  exibição/argumento secreto; -S 127.0.0.1,1433 e -d loja conectaram com sucesso.
- DB_NAME retornou loja, consulta constante retornou 1. sys.databases mostrou
  loja ID 5 ONLINE e loja_test ID 6 ONLINE, preservados após a recriação.
- Inspect confirmou HostIp 127.0.0.1, HostPort 1433 e volume
  curso-loja-fullstack_dados-sqlserver em /var/opt/mssql. ss confirmou LISTEN local.
- Código backend/src, SQL de bancos e Dockerfiles/.dockerignore preservados;
  root .env e backend/.env ignorados. Sem tabelas, migrations, contas novas,
  configuração DBeaver gravada por ferramenta, teste Laravel ou contador.
- Verificado endpoint SQL publicado e autenticação; não inventar conexão
  no DBeaver. Resultado do Test Connection deve ser informado pelo aluno.

Resultado no DBeaver: confirmado pelo aluno com "apareceu loja", após a consulta
SELECT DB_NAME(). Acesso ao banco loja confirmado por relato do aluno.
Entendimento da etapa 5.6: confirmado com "entendi" em 13/10/2026, após resultado
de conexão DBeaver confirmado separadamente com "apareceu loja".
Publicação: checkpoint c7f58ee, `build: publica acesso SQL local para DBeaver`.
Push autorizado e verificado: HEAD, origin/main e consulta direta à main remota
retornaram `c7f58ee64ab62b1b053cd27b96b644772ecac98f`.
Próximo passo exato: responder a dúvidas/erros DBeaver antes de avançar; após
entendimento, publicar 5.6 e iniciar 5.7, preparar login/usuário próprios da
aplicação no banco loja e credencial local ignorada, antes da conexão Laravel.
Banco de testes e configuração de integração terão preparação própria.

## Etapa 5.7

Objetivo: preparar login e usuário próprios da aplicação no banco loja, com
senha local ignorada e papéis de leitura/escrita, antes de configurar Laravel.

Implementação e explicação:

- Criado docker/sqlserver/criar-usuario-loja.sql e acrescentado campo vazio
  MSSQL_LOJA_PASSWORD ao root .env.example. Senha aleatória gerada somente no
  root .env ignorado via PHP/Docker, preservando configuração e modo 600.
- Diferenciados login (autenticação no servidor), usuário (mapeamento no banco)
  e papéis (permissões no banco). Nomes login/usuário loja_app.
- SUSER_ID condiciona CREATE LOGIN com CHECK_POLICY=ON e DEFAULT_DATABASE=loja.
  USE loja seleciona o banco; USER_ID condiciona CREATE USER FOR LOGIN.
- IS_ROLEMEMBER condiciona ALTER ROLE ADD MEMBER para db_datareader e
  db_datawriter. Preparação preserva login/senha/usuário/papéis existentes.
- Explicada variável de script sqlcmd $(MSSQL_LOJA_PASSWORD), preenchida pelo
  ambiente do cliente. Antes da substituição, case restringe valor ao formato
  gerado de letras/dígitos/!, evitando delimitadores no literal SQL.
- Cliente temporário Docker recebe .env por --env-file. SQLCMDPASSWORD usa
  credencial sa para preparar; a variável LOJA fornece senha do login novo.
  Valor não impresso, não passado em argumento secreto nem salvo no SQL público.
- Conta da aplicação tem papéis de dados somente em loja. Criação de tabelas/
  migrations e integração terão suas credenciais na etapa necessária.
- Aula docs/aulas/05-07-usuario-aplicacao.md criada; README/roteiro atualizados.

Verificação:

- Consulta administrativa anterior: login e usuário loja_app inexistentes;
  preparação criada sem sobrescrever trabalho conhecido.
- Execução SQL passou. sys.sql_logins confirmou policy=1 e banco padrão loja.
  sys.database_role_members confirmou db_datareader/db_datawriter no usuário.
- Conexão SQL como loja_app com senha própria: login=loja_app, usuário=loja_app,
  banco=loja. Papéis leitura/escrita=1; db_owner/sysadmin=0;
  HAS_DBACCESS(loja_test)=0 e permissão CREATE TABLE=0.
- Tentativa de conexão como loja_app ao banco loja_test recusada pelo servidor,
  com erro de banco solicitado inacessível e saída 1: resultado esperado.
- Arquivo reexecutado com sucesso; consulta positiva posterior autenticou em
  loja com mesma senha e papéis 1/1, confirmando preparação reaplicável.
- Diagnóstico temporário teve erro de aspas SQL (saída 1); corrigido para
  heredoc e repetido com sucesso. Nenhum erro no arquivo de preparação.
- git diff --exit-code -- backend src compose.yaml Dockerfile Dockerfile.backend
  .dockerignore passou; root .env/backend .env ignorados. Sem tabela, migration,
  novo dado da aplicação, teste Laravel ou contador. Conexão Laravel ainda pendente.

Entendimento da etapa 5.7: confirmado com "entendi" em 13/10/2026, após dúvidas.
Pergunta do aluno: "essa sys.database_principals é uma tabela?". Esclarecimento:
view de catálogo do sistema, consultável com SELECT em linhas/colunas, que
apresenta metadados de usuários/papéis do banco. sys é o esquema e
database_principals o nome da view. CREATE USER atualiza o catálogo e a view
passa a mostrar o usuário. Diferenciada de tabela de dados da loja; entendimento confirmado.
Pergunta do aluno: "já é pra ter criado no banco loja?". Esclarecimento:
usuário loja_app já criado dentro de loja, com login correspondente no servidor.
Conferido novamente em sys.database_principals no banco loja; apresentada
consulta para o aluno verificar no DBeaver. Entendimento confirmado com "entendi".
Publicação: checkpoint 063e4eb publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 063e4ebc0c1ec733b183005c922ffd967f4ac35b.
Próximo passo realizado na 5.8: preparar
backend/.env.example e configuração local Laravel para sqlserver:1433, loja,
loja_app e senha local copiada sem exibir/versionar o valor, preservando
APP_KEY/configurações existentes. Integração e migrations terão preparação própria.

## Etapa 5.8

Objetivo: preparar os valores de conexão que o Laravel lerá, antes da primeira
consulta. Uma etapa com os dois arquivos inseparáveis: modelo de ambiente e
configuração do banco. Aula em docs/aulas/05-08-configuracao-laravel.md.

Implementação:

- backend/.env.example define sqlsrv, sqlserver, 1433, loja, loja_app,
  DB_PASSWORD vazio, DB_ENCRYPT=yes e DB_TRUST_SERVER_CERTIFICATE=true.
- backend/config/database.php usa sqlsrv como fallback de conexão padrão e
  ativa as chaves encrypt/trust_server_certificate, lidas com env(...).
- backend/.env local recebe esses valores e DB_PASSWORD correspondente a
  MSSQL_LOJA_PASSWORD do root .env, por PHP executado em Docker. Senha não
  exibida ou versionada. APP_KEY e todas as variáveis fora do grupo DB alterado
  foram comparadas em memória e preservadas; permissão 600, dono 1000:1000.
- Configurações dos outros drivers e phpunit.xml preservadas. Banco exclusivo
  e credenciais de integração/migrations serão preparados na etapa própria.
- Instruções raiz continuam prevalecendo sobre recomendações geradas do
  backend: PHP 8.4 em Docker e nenhuma instalação antecipada de Boost.

Verificações:

- php -l /app/config/database.php no serviço backend: sem erro de sintaxe.
- Bootstrap Laravel em processo PHP Docker: conexão padrão sqlsrv; host
  sqlserver, porta 1433, banco loja, usuário loja_app, encrypt yes e confiança
  no certificado true (booleano). Valores de senha comparados em memória,
  sem impressão. APP_KEY preservada.
- Configuração sem cache; getConnections() retornou lista vazia. Nenhuma
  conexão ou consulta SQL solicitada pelo diagnóstico; nenhuma migration.
  Isso demonstra carregamento dos valores, ainda não conexão SQL pelo Laravel.
- HTTP GET /loja retornou 200, título, três produtos e cabeçalho X-Curso
  preservados. Sem reconstrução de imagem ou alteração dos dados do contador.
- .env e backend/.env ignorados; git diff --check passou.

Explicação apresentada: papel do .env.example público e .env privado,
DB_HOST interno versus endereço DBeaver, significado das oito variáveis,
env(nome, fallback) no array PHP, criptografia/certificado local, montagem
temporária para a cópia privada e alcance dos diagnósticos.
Entendimento da 5.8: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint e0e06ef publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em e0e06ef063ec245739e18f684336d218751687e9.
Próximo passo realizado na 5.9: primeira
consulta diagnóstica pelo Laravel, apresentando DB facade e resultado, sem
antecipar tabelas, migrations ou catálogo persistido.

## Etapa 5.9

Objetivo: executar a primeira consulta pelo Laravel e conferir a conexão
configurada na 5.8. Aula em docs/aulas/05-09-primeira-consulta-laravel.md.

Implementação: apenas backend/routes/console.php, além dos registros da aula.
Importada a fachada DB e registrado loja:verificar-banco com Artisan::command.
Closure chama DB::selectOne com SELECT DB_NAME() AS banco, SUSER_SNAME() AS
login, USER_NAME() AS usuario. Três saídas via $this->line e purpose para ajuda.
Comando sem argumentos; usa conexão padrão e credenciais locais da 5.8.
Não cria tabelas nem modifica dados. Bootstrap existente já carrega console.php.

Explicação apresentada: entrada de terminal versus rota HTTP, importação use,
fachadas Artisan/DB e serviços do container Laravel, closure ligada ao comando,
SELECT sem FROM, funções de contexto SQL Server, aliases AS, selectOne e objeto
com propriedades acessadas por ->, concatenação PHP e saída line/purpose.

Verificações executadas em Docker:

- php -l /app/routes/console.php: sem erro de sintaxe.
- php artisan help loja:verificar-banco: nome e descrição registrados.
- php artisan loja:verificar-banco --no-ansi: saída Banco: loja, Login: loja_app,
  Usuário: loja_app; código 0. Demonstra conexão e execução de SQL pelo Laravel
  com os drivers instalados, a rede e a conta configurada. Não demonstra ainda
  persistência de produtos ou permissões de escrita sobre tabelas da aplicação.
- HTTP /loja: 200, título, Camiseta/Calça/Tênis e X-Curso preservados.
- git diff --check passou; .env e backend/.env ignorados. Sem migrations,
  nova dependência, novo serviço, mudança de credenciais ou contador didático.

Entendimento da 5.9: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 173ed00 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 173ed0089496181ec510cd521d7995a62045ca54.
Próximo passo realizado na 5.10: modelagem
inicial da tabela produtos (colunas, tipos e chave primária), antes de migration.

## Etapa 5.10

Objetivo: definir estrutura inicial da tabela produtos antes de escrever a
migration. Entrega em docs/aulas/05-10-modelagem-produtos.md, sem código novo.

Desenho documentado:

- id BIGINT, gerado com IDENTITY(1,1), chave primária única e não nula.
- nome NVARCHAR(150), obrigatório; nomes podem se repetir.
- preco_em_centavos INT, obrigatório; mantém a unidade monetária do módulo 3.
- status NVARCHAR(20), obrigatório, valores de negócio ativo/inativo e
  valor inicial planejado ativo; coerente com StatusProduto.
- created_at/updated_at DATETIME2(3) anuláveis, para criação/atualização,
  com convenção UTC na aplicação. Tipo não armazena fuso.
- Regras de nome com conteúdo, preço não negativo e status válido documentadas;
  tipos não garantem essas regras sozinhos. Restrições/validação serão implementadas
  nas etapas próprias, sem alegar que já estão aplicadas no banco.

Explicação apresentada: tabela/linha/coluna; relação com atributos de Produto,
tipos e NULL; chave primária versus nome e geração IDENTITY; preço em centavos;
estado ativo/inativo e datas do registro. Exemplo de duas Camisetas com ids e
preços distintos apenas ilustrativo, sem inserção SQL.

Verificação: comparação com src/Produto.php e src/StatusProduto.php, fontes
oficiais Microsoft sobre tipos/chave/identidade e git diff --check. Documentação
como única alteração da 5.10; sem comando de aplicação, consulta SQL, migration,
nova dependência, credencial ou alteração de volume/contador. Sem testes de
aplicação adicionais, pois nenhum código ou esquema foi modificado nesta etapa.

Entendimento da 5.10: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint b160a68 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em b160a6827c99cd30f6edbea3e1f19556fc06b147.
Próximo passo realizado na 5.11: explicar
migrations e gerar somente o esqueleto de produtos, sem executá-lo no banco.
A credencial de execução de migrations será preparada em etapa própria.

## Etapa 5.11

Objetivo: apresentar migrations e gerar só o arquivo inicial de produtos.
Aula em docs/aulas/05-11-primeira-migration.md. Uma adição PHP:
backend/database/migrations/2026_10_14_123220_create_produtos_table.php.

Implementação: make:migration create_produtos_table --create=produtos
--no-interaction em container backend temporário, com --rm, -T e --no-deps.
Montagem adicional somente de database/migrations como rw e usuário/grupo do
host para arquivo editável. Conteúdo padrão gerado: imports Migration,
Blueprint e Schema; classe anônima retornada, up com Schema::create e
id()/timestamps(); down com dropIfExists. Nenhum ajuste antecipado das colunas.

Explicação apresentada: migration como mudança de estrutura versionada;
gerar arquivo versus aplicar ao banco, pasta/nome/prefixo UTC e ordem;
comando Docker/Artisan, opções e montagem; classe anônima/herança/imports,
up/down, Schema, Blueprint, id/timestamps e remoção de tabela em reversão.
Arquivo inicial difere do desenho completo; nome/preço/status e precisão
das datas serão preenchidos na 5.12.

Verificações:

- Docker Compose: serviços ativos; ajuda make:migration conferida.
- Gerador concluído com código 0; arquivo único, dono 1000:1000, permissão 644.
- php -l no arquivo gerado: sem erro de sintaxe.
- Diagnóstico temporário PHP em Docker fez require do arquivo e confirmou
  instanceof Migration, sem chamar up/down. SELECT de metadados sys.tables
  retornou banco loja e total 0 para dbo.produtos/dbo.migrations.
- git diff --check passou; arquivos PHP anteriores, Compose/imagens, .env e
  contador preservados. Sem execução de migrate/rollback, instalação de Boost
  ou outras dependências. Regras raiz PHP 8.4/Docker prevalecem sobre bootstrap
  gerado de backend/AGENTS.md, como nas etapas anteriores.

Entendimento da 5.11: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 3e5cb93 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 3e5cb9370b37ddc666d4ccd84441589644a0256f.
Próximo passo realizado na 5.12: preencher
a migration com nome, preco_em_centavos, status e precisão planejada de datas,
sem executá-la no banco. Credencial de migrations ainda terá preparação própria.

## Etapa 5.12

Objetivo: preencher a definição de produtos segundo a modelagem 5.10, sem
aplicá-la ao banco. Aula em docs/aulas/05-12-colunas-produtos.md.

Implementação: apenas backend/database/migrations/2026_10_14_123220_create_produtos_table.php,
além dos registros. Adicionados string('nome', 150), integer('preco_em_centavos'),
string('status', 20)->default('ativo'); timestamps() passou a timestamps(3).
Imports, classe, id, up/down e migrations geradas anteriores preservados.

Explicação apresentada: nomes e tipos do Blueprint, encadeamento default na
definição de coluna, valor quando INSERT omite status, campos NOT NULL e
diferença entre default/validação de conteúdo; datas anuláveis com precisão 3.
Relação migration/modelagem e tradução específica de SQL Server para NVARCHAR,
INT e DATETIME2(3), conferida no compilador instalado e no SQL simulado.
Regras de nome com conteúdo, preço não negativo e conjunto de status seguem
documentadas, mas ainda sem validação/restrições de conteúdo implementadas.

Verificações em Docker:

- php -l na migration: sem erro de sintaxe.
- Programa temporário inicializou Laravel e chamou up dentro de
  DB::connection()->pretend(...), capturando uma única instrução CREATE TABLE
  sem executá-la no servidor. Conferidos id BIGINT NOT NULL IDENTITY PRIMARY KEY,
  nome NVARCHAR(150) NOT NULL, preço INT NOT NULL, status NVARCHAR(20) NOT NULL
  DEFAULT 'ativo' e datas DATETIME2(3) NULL.
- SELECT real de metadados após simulação confirmou banco loja e total 0
  para dbo.produtos/dbo.migrations. Isso demonstra geração do SQL, ainda não
  aceitação do DDL pelo servidor ou persistência de catálogo.
- git diff --check passou; .env ignorados; sem migrate/rollback, alteração de
  credencial, dependência, serviço, controller/view ou contador. Regras raiz
  PHP 8.4/Docker seguem prevalecendo sobre bootstrap gerado do backend.

Entendimento da 5.12: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint bbec195 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em bbec195570dc903909bc0a629ce78c57e9ed5d6a.
Próximo passo iniciado na 5.13: preparar
login/usuário exclusivo de migrations no banco loja e explicar permissões
de estrutura versus dados, mantendo a conta da aplicação em seu escopo atual.
Não aplicar migration antes da etapa própria de execução.

## Etapa 5.13 — Conta exclusiva de migrations

Objetivo: preparar login/usuário exclusivo de migrations em loja, com acesso
a dados e estrutura dbo. Aula em docs/aulas/05-13-conta-migracoes.md.

Preparação local:

- .env.example da raiz ganhou MSSQL_MIGRATIONS_PASSWORD vazio.
- docker/sqlserver/criar-usuario-migracoes.sql cria login/usuário loja_migracoes
  quando ausentes, CHECK_POLICY ON, banco padrão loja, esquema padrão dbo;
  associa db_datareader/db_datawriter e concede CREATE TABLE no banco loja
  e ALTER ON SCHEMA::dbo. Nenhum sysadmin/db_owner ou usuário de loja_test proposto.
- PHP 8.4 em Docker gerou a senha local, sem imprimir o valor, com campo
  ausente/vazio, comparação preservando demais linhas e modo 600, dono 1000:1000.
  Conta loja_app e backend/.env preservados; sem configuração Laravel da nova conta.

Explicação apresentada: dados versus estrutura, identidade exclusiva, alcance
de GRANT e esquema dbo, papéis de dados, modelo público e senha privada, script
reaplicável, comando de preparação administrativa usando sqlcmd e variáveis locais.
ALTER em dbo permite modificar/remover objetos desse esquema, além das operações
de dados; alcance apresentado para a autorização necessária.

Verificações realizadas: serviços ativos; ausência de login/usuário consultada
antes da preparação; senha gerada com demais campos preservados; revisão do
SQL contra documentação Microsoft; git diff --check e .env ignorados. Backend,
migrations, laboratório, Compose e imagens sem alteração.

Execução rejeitada antes de iniciar o processo pelo auto-review. Motivo:
"A ação cria uma conta persistente no SQL Server e concede permissões de
leitura, escrita, CREATE TABLE e ALTER no esquema dbo; embora coerente com a
etapa do curso, não há autorização explícita do usuário para esse alvo e esse
escopo de privilégios." Não houve tentativa de contornar a rejeição.
Consulta somente de leitura posterior confirmou zero logins/usuários
loja_migracoes e zero tabelas da aplicação naquele momento.

Autorização explícita recebida em 14/10/2026: "Sim, autorizo criar essa conta
com essas permissões", em resposta à pergunta com login/usuário loja_migracoes,
banco loja, db_datareader/db_datawriter, CREATE TABLE e ALTER em dbo, incluindo
modificar/remover objetos desse esquema. Essa aprovação resolve a rejeição
anterior para o alvo e escopo apresentados. Arquivo executado com código 0,
sem ampliar o escopo. Verificações após autorização:

- Login loja_migracoes com política ativa e banco padrão loja; usuário SQL
  associado no banco loja, com esquema padrão dbo.
- Autenticação com própria senha local: banco loja, login/usuário loja_migracoes.
  db_datareader/db_datawriter = 1/1, CREATE TABLE/ALTER dbo = 1/1,
  db_owner/sysadmin = 0/0, HAS_DBACCESS loja_test = 0. Diagnóstico com código 0.
- Conexão solicitando loja_test recusada pelo SQL Server com erro de banco
  inacessível: resultado esperado. Sem usuário dessa conta em loja_test.
- Arquivo reaplicado com código 0 e diagnóstico repetido após reaplicação:
  autenticação com mesma senha e todas as permissões esperadas preservadas.
- Laravel autenticou como loja_app com leitura/escrita 1/1 e CREATE TABLE/ALTER
  dbo 0/0; banco loja com zero tabelas. Sem migrate/rollback ou teste de DDL.
- git diff --check passou; .env ignorados; backend/migrations/Compose e demais
  código/imagens preservados. Senha não exibida ou versionada.

Implementação SQL, explicação e verificações concluídas; entendimento da 5.13
confirmado com "entendi" em 14/10/2026, após a autorização e execução.
Publicação: checkpoint 94e3322 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 94e3322369b13dcf3bf6201c90899e2f99b5893a.
Próximo passo realizado na 5.14: configurar conexão Laravel exclusiva de migrations,
preservando conexão padrão loja_app e copiando senha somente ao .env local.
Autorização persistente de publicação de checkpoints na main continua válida.

## Etapa 5.14 — Conexão Laravel de migrations

Objetivo: escolher a conta de migrations explicitamente no Laravel mantendo
a conexão padrão da aplicação. Aula em docs/aulas/05-14-conexao-migracoes-laravel.md.

Implementação em dois arquivos inseparáveis:

- backend/config/database.php ganhou connections.sqlsrv_migracoes, driver sqlsrv,
  host/porta/banco e opções comuns, username/password vindos de variáveis
  DB_MIGRATIONS_USERNAME e DB_MIGRATIONS_PASSWORD. Não lê DB_URL da aplicação.
  Conexão sqlsrv original e default preservados.
- backend/.env.example ganhou usuário loja_migracoes e senha vazia.
- PHP em Docker copiou a senha de MSSQL_MIGRATIONS_PASSWORD do root .env
  readonly ao campo DB_MIGRATIONS_PASSWORD do backend/.env privado e definiu
  usuário. Comparação em memória preservou APP_KEY e todas as variáveis fora
  desses dois campos; campos divergentes/duplicados impediriam sobrescrita;
  modo 600, usuário/grupo do host. Sem nova senha ou mudança de permissões SQL.

Explicação apresentada: nome lógico da conexão versus driver SQL Server,
mesmo banco/servidor com contas distintas, seleção DB::connection('sqlsrv_migracoes'),
configuração padrão sqlsrv, variáveis próprias e relação entre os dois .env,
modelo público e ambiente privado; parâmetros/montagens do processo de cópia.

Verificações executadas em Docker:

- php -l config/database.php passou.
- Laravel sem cache, default sqlsrv; correspondência de ambas as senhas com
  os campos locais da raiz conferida sem exibição, por hash_equals.
- SELECT real via sqlsrv: banco loja, login/usuário loja_app, CREATE TABLE/ALTER
  dbo 0/0. Via sqlsrv_migracoes: banco loja, login/usuário loja_migracoes,
  CREATE TABLE/ALTER dbo 1/1. Driver sqlsrv e host sqlserver em ambas.
- SELECT de metadados retornou zero tabelas da aplicação em loja.
- HTTP /loja 200, título, três produtos e X-Curso preservados.
- git diff --check passou; .env ignorados; migrations, controllers/views,
  Compose/imagens, dependências e contador sem mudanças.

Entendimento da 5.14: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 26e7b5b publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 26e7b5b8a674e775b2e882ea4c78f62aeed9d945.
Próximo passo realizado na 5.15: aplicar
somente a migration de produtos com --database=sqlsrv_migracoes e --path apontando
ao arquivo 2026_10_14_123220_create_produtos_table.php; explicar registro migrations
e conferir o esquema persistido. Não aplicar users/cache/jobs antecipadamente.

## Etapa 5.15 — Aplicar a migration de produtos

Objetivo: aplicar o arquivo específico pela conexão de migrations e conferir
o esquema persistido. Aula em docs/aulas/05-15-aplicar-migration-produtos.md.

Implementação no banco, sem alterar código PHP: docker compose exec -T backend
php artisan migrate --database=sqlsrv_migracoes
--path=database/migrations/2026_10_14_123220_create_produtos_table.php --no-interaction.
Criou dbo.migrations e dbo.produtos em loja; registrou apenas esse arquivo no
lote 1. Migrations padrão users/cache/jobs não aplicadas; zero produtos inseridos.

Explicação apresentada: aplicação versus geração, seleção da conexão pelo nome,
limite pelo caminho do arquivo, execução de up/Schema::create, tabela real
migrations com id/migration/batch e distinção entre registro de aplicação no
banco e arquivo versionado no Git. Novas mudanças de esquema devem ser descritas
em novas migrations. DBeaver pode atualizar lista e consultar as duas tabelas;
resultado de exercício do aluno ainda não recebido.

Verificações em Docker:

- Antes: banco loja, login loja_migracoes e zero tabelas conferidos; ajuda migrate.
- migrate terminou código 0; criação do registro e aplicação específica DONE.
- Metadados pela conexão de migrations: somente dbo.migrations/dbo.produtos;
  id BIGINT IDENTITY PK, nome NVARCHAR(150), preço INT, status NVARCHAR(20),
  default ('ativo'), datas DATETIME2(3) NULL; demais campos NOT NULL.
- Primeira comparação do default com loja_app falhou porque a definição ficou
  NULL por visibilidade de metadados. Conferência feita com loja_migracoes,
  diagnóstico corrigido e repetido com sucesso. Nenhuma mudança de schema/permissões
  foi necessária. Não tratar o diagnóstico inicial como aprovação.
- Registro migrations com arquivo 2026_10_14_123220_create_produtos_table, lote 1;
  leitura de produtos como loja_app retornou zero registros.
- Reexecução com mesmo arquivo/conexão via Artisan::call retornou Nothing to
  migrate e código 0; OBJECT_ID das tabelas, único registro e default sqlsrv
  preservados. migrate:status filtrado pelo caminho retornou [1] Ran.
- HTTP /loja 200 com título, três nomes demonstrativos e X-Curso preservados.
- git diff --check passou; arquivos PHP, configuração, credenciais, imagens,
  dependências, serviços e contador didático sem alterações. Sem rollback,
  escrita de produtos ou testes de integração no banco da aplicação.

Entendimento da 5.15: confirmado com "entendi" em 14/10/2026.
Publicação: checkpoint 36db8e8 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 36db8e85393e59404ba55f3556d2fc9d356746c9.
Próximo passo realizado na 5.16: gerar
somente o model Eloquent Produto e explicar sua ligação à tabela, sem inserir
dados ou trocar o catálogo demonstrativo nesta etapa inicial do model.
Regras de conteúdo e testes SQL Server de integração seguem com etapas próprias.

## Etapa 5.16 — Primeiro model Produto

Objetivo: gerar model Eloquent e apresentar sua ligação à tabela de produtos.
Aula em docs/aulas/05-16-model-produto.md. Única adição ao código:
backend/app/Models/Produto.php, com namespace App\Models, import Model e
classe Produto extends Model, corpo inicial do gerador.

Gerador em Docker: compose run --rm -T --no-deps, usuário/grupo do host,
montagem adicional app/Models rw; php artisan make:model Produto --no-interaction.
Somente o model gerado; sem opções de migration/factory/controller, sem novas
configurações ou consultas de catálogo. User existente e classe Loja\Produto
do laboratório preservados.

Explicação apresentada: geração e parâmetros do comando, namespace/import,
herança e ORM; classe/tabela/registro, model versus estrutura criada pela migration;
convenções de plural/snake_case, id inteiro/incremental, datas e conexão padrão;
classe App\Models\Produto do backend e Loja\Produto do laboratório têm escopos distintos.

Verificações em Docker:

- Gerador terminou código 0, arquivo único, dono 1000:1000, permissão 644.
- php -l Produto.php: sem erro de sintaxe.
- Autoload e new App\Models\Produto: instanceof Eloquent Model confirmado;
  getTable produtos, getKeyName id, getKeyType int, getIncrementing true,
  usesTimestamps true, colunas created_at/updated_at.
- getConnectionName null indica ausência de configuração específica no model;
  default sqlsrv e login configurado loja_app conferidos. Objeto exists=false,
  atributos vazios e gerenciador de banco sem conexões criadas, sem consulta SQL.
- git diff --check passou; PHP anterior, controller/catálogo/view, migrations,
  configurações/credenciais, Compose/imagens, dependências e contador preservados.
  Nenhum teste de integração, leitura/gravação de produto ou mudança de banco.

Entendimento da 5.16: confirmado com "entendi" em 15/10/2026.
Publicação: checkpoint a953fa4 publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em a953fa4377335a06b5b8fb1089d1d8d6172db6ea.
Próximo passo realizado na 5.17: definir
campos permitidos para atribuição em massa usando Fillable no model e explicar
arrays de atributos com demonstração em memória, antes de gravar dados.

## Etapa 5.17 — Fillable no Produto

Objetivo: definir campos aceitos por arrays no model e explicar atribuição em
massa em memória. Aula em docs/aulas/05-17-fillable-produto.md.

Implementação somente em backend/app/Models/Produto.php: import da classe
Illuminate\Database\Eloquent\Attributes\Fillable e
#[Fillable(['nome', 'preco_em_centavos', 'status'])] antes da classe.
Sem casts, persistência, nova validação ou mudança de schema nesta etapa.

Explicação apresentada: atributo PHP de configuração e atributos de dados;
construtor herdado com array campo/valor; fill parcial em objeto existente;
campos fora da lista descartados na configuração atual; limite da atribuição
em massa versus validação de valor e imutabilidade. Relembrada a configuração
Fillable do User da 4.18, sem alterar aquele model.

Verificações em Docker:

- php -l Produto.php passou.
- getFillable retornou exatamente nome/preco_em_centavos/status; construtor
  preencheu Camiseta, 4990 e ativo.
- Segundo objeto recebeu os campos e id=999/created_at; extras descartados,
  atributos somente permitidos e chave null.
- fill alterou nome para Calça e preservou demais atributos.
- Objeto temporário com nome vazio, preço -1 e status outro aceito em memória,
  demonstrando que Fillable não valida conteúdo. Nenhum desses dados foi salvo.
- Todos os objetos exists=false, gerenciador de banco sem conexões criadas,
  nenhuma consulta SQL. git diff --check passou; demais código, configurações,
  migrations, credenciais, serviços e contador preservados.

Entendimento da 5.17: confirmado com "entendi" em 15/10/2026.
Publicação: checkpoint 340d6ea publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 340d6ea79fa644031e358b912836fcfd25bc5061.
Próximo passo realizado na 5.18: configurar
cast de preco_em_centavos para integer e demonstrar conversão em memória,
sem gravar dados. Regras de conteúdo e integração SQL terão etapas próprias.

## Etapa 5.18 — Cast inteiro do preço

Objetivo: converter preco_em_centavos para inteiro ao ler o model, demonstrando
em memória. Aula em docs/aulas/05-18-cast-preco-produto.md.

Implementação somente em backend/app/Models/Produto.php: método protegido
casts(): array retorna ['preco_em_centavos' => 'integer'], com anotação
@return array<string, string>. Imports e Fillable preservados.

Explicação apresentada: configuração lida pelo Eloquent, método protegido,
tipo de retorno e comentário de análise/editor, chave do atributo e nome da
conversão; string numérica versus inteiro, acesso pelo model e representação
em array; unidade monetária em centavos preservada. Cast não valida conteúdo
ou obrigatoriedade e não altera a coluna SQL.

Verificações em Docker:

- php -l Produto.php passou.
- getCasts registra integer; objeto com preço '4990' mantém valor bruto string
  em getAttributes, mas entrega int 4990 por leitura e toArray.
- fill com '12990' entrega int 12990; nome/status e Fillable preservados.
- Zero permanece 0; texto '-1' é lido como int -1; null continua null.
- Todos os objetos exists=false, gerenciador de banco sem conexões criadas;
  nenhuma consulta ou gravação SQL. git diff --check passou e demais código,
  banco, migrations, configuração/credenciais, dependências e serviços preservados.

Entendimento da 5.18: confirmado com "entendi" em 15/10/2026.
Publicação: checkpoint adb466c publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em adb466c3fab6e5fcfe0e16f3edef970e49609fd2.
Próximo passo realizado na 5.19: primeira
consulta Eloquent Produto::query()->get(), explicando coleção vazia e SQL
de leitura, sem inserir dados ou trocar o catálogo demonstrativo ainda.
Regras de conteúdo e testes SQL Server de integração seguem com etapas próprias.

## Etapa 5.19 — Primeira consulta Eloquent

Objetivo: consultar produtos pelo model e apresentar coleção vazia. Aula em
docs/aulas/05-19-consulta-eloquent-produtos.md.

Implementação somente em backend/routes/console.php: import App\Models\Produto
e comando Artisan loja:consultar-produtos. Produto::query()->get() executa
a leitura; count informa itens carregados e isEmpty controla a mensagem
Nenhum produto cadastrado. Sem argumentos ou operações de escrita.

Explicação apresentada: import do model, registro de comando, query como
construtor de consulta e get como execução; conexão padrão, tabela do model,
SQL SELECT * FROM produtos; Collection Eloquent, count e isEmpty, resultado
vazio bem sucedido e distinção entre coleção e array/null. count da coleção
carregada não dispara nova consulta SQL. Página permanece demonstrativa.

Verificações em Docker:

- php -l console.php passou; ajuda exibiu descrição/nome.
- Execução real com --no-ansi, código 0: Produtos encontrados: 0 e mensagem
  Nenhum produto cadastrado.
- Diagnóstico confirmou Illuminate\Database\Eloquent\Collection, count 0,
  isEmpty true, conexão sqlsrv, banco loja e login loja_app. Capturada uma
  consulta select * from [produtos], sem parâmetros.
- Comparação inicial adicional esperava aspas duplas, mas o compilador de
  consultas usa colchetes. SQL inspecionado; diagnóstico corrigido e repetido
  com código 0, sem alteração do código da aplicação para essa correção.
- HTTP /loja 200 com título, três nomes e X-Curso preservados.
- git diff --check passou; model, migrations, configuração/credenciais,
  dependências, serviços e contador preservados. Sem INSERT/UPDATE/DELETE
  ou teste de integração escrevendo no banco da aplicação.

Entendimento da 5.19: confirmado com "entendi" em 15/10/2026.
Publicação: checkpoint 133591a publicado com autorização persistente; HEAD,
origin/main e main remota conferidos em 133591af4ae4b7f63d982a3241bae67df3a07deb.
Próximo passo realizado na 5.20: apresentar seeders e gerar somente
ProdutoSeeder, explicando a estrutura, sem preencher ou executar cadastros.

## Etapa 5.20 — Estrutura do primeiro seeder

Objetivo: apresentar seeders e o local das futuras instruções de cadastro.
Aula em docs/aulas/05-20-primeiro-seeder.md.

Implementação: Artisan make:seeder ProdutoSeeder --no-interaction em container
backend temporário, com usuário do aluno e montagem gravável somente da pasta
database/seeders. Arquivo gerado backend/database/seeders/ProdutoSeeder.php,
namespace Database\Seeders, extends Seeder, método public run(): void vazio.
Import WithoutModelEvents preservado como gerado, sem incorporar o trait.

Explicação apresentada: função de seeder versus migration/model, geração de
arquivo versus execução, namespace/autoload PSR-4 existente, import/herança,
comentário, public/run/void e corpo vazio. DatabaseSeeder como entrada padrão
já existente, preservada sem registrar ProdutoSeeder ou executar seu exemplo.
Comando Docker, argumentos, entrada ProdutoSeeder e saída de criação explicados.

Verificações em Docker:

- Gerador terminou código 0 e confirmou criação do arquivo.
- php -l passou; autoload carregou e instância herda Illuminate\Database\Seeder.
- ReflectionMethod conferiu run público, zero parâmetros e retorno void.
- Gerenciador de banco sem conexões criadas; run não chamado, sem db:seed
  ou consultas/gravações SQL. Arquivo modo 644, dono 1000:1000.
- git diff --check passou; alterações de código restritas ao novo seeder;
  model, migrations, rotas, DatabaseSeeder, configuração/credenciais,
  dependências, serviços e contador preservados.

Entendimento da 5.20: confirmado com "entendi" em 15/10/2026.
Publicação da 5.20: checkpoint e811031 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em e81103197aece04c52b979b3999eebd0ba9fe1db.
Próximo passo realizado na 5.21: preencher run com o cadastro de um produto
usando Eloquent, explicando campos e persistência, sem executar o seeder ainda.

## Etapa 5.21 — Cadastro escrito no seeder

Objetivo: escrever o cadastro de um produto pelo Eloquent, antes da execução.
Aula em docs/aulas/05-21-cadastro-produto-seeder.md.

Implementação somente em backend/database/seeders/ProdutoSeeder.php:
import App\Models\Produto no lugar do import WithoutModelEvents sem uso.
run contém Produto::create com nome Camiseta, preco_em_centavos inteiro 4990
e status ativo. Nenhum registro em DatabaseSeeder ou execução de cadastro.

Explicação apresentada: import do model correto, array de atributos/valores,
create como preenchimento e persistência, instância devolvida sem variável
necessária, :: e encaminhamento pelo Eloquent. Tabela produtos e conexão
sqlsrv/loja_app, preço em centavos, status explícito, id pelo SQL Server e
datas pelo Eloquent. Diferença de new em memória para create executado;
escrever instrução no método não o chama automaticamente. Fillable normal,
proteção suspensa durante db:seed, cast sem validação e dados controlados.
Cada execução de create tenta nova linha, podendo duplicar a Camiseta;
próxima demonstração será uma vez, sem limpar dados ou alterar tabela.

Verificações:

- php -l no PHP Docker passou com código 0, sem executar código do arquivo.
- Revisão do import e atributos contra model e migration concluída.
- git diff --check passou; única alteração de código no seeder.
- Nenhuma chamada a run, db:seed ou create executada; sem consultas/gravações
  SQL nesta etapa. A inserção ainda não foi validada por execução.
- DatabaseSeeder, model, migrations, rotas, configuração/credenciais,
  dependências, serviços e contador preservados.

Entendimento da 5.21: confirmado com "entendi" em 15/10/2026.
Publicação da 5.21: checkpoint 9da189c publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 9da189c24c523373501eb30a181087350d3713d5.
Próximo passo realizado na 5.22: executar somente ProdutoSeeder uma vez pela
conexão da aplicação e conferir o registro persistido e a consulta Eloquent.
Apresentar consulta DBeaver sem inventar resultado observado pelo aluno.

## Etapa 5.22 — Primeiro produto persistido

Objetivo: executar o cadastro estudado e observar a persistência no SQL Server.
Aula em docs/aulas/05-22-executar-produto-seeder.md. Sem alteração de código.

Prévia: ajuda de db:seed e leitura de identidade/quantidade conferidas.
Conexão sqlsrv, banco loja, login loja_app, zero produtos antes da execução.

Execução didática única em Docker: php artisan db:seed --class=ProdutoSeeder
--database=sqlsrv --no-interaction --no-ansi. Saída Seeding database,
ProdutoSeeder RUNNING e 91 ms DONE, código 0. DatabaseSeeder padrão não
executado, sem cadastro de User ou aplicação de outras migrations.

Explicação apresentada: exec/-T/PHP/Artisan, db:seed versus make:seeder,
--class selecionando a classe, --database selecionando a conexão sqlsrv
que aponta para loja/loja_app; --no-interaction e --no-ansi. Chamada de run
e create, id pela identity SQL e datas pelo Eloquent. Permanência do registro
após o processo encerrar. Comando de leitura pode repetir; seeder atual com
create tentaria outro cadastro. Página HTTP segue demonstrativa em memória.

Verificações de leitura após o cadastro:

- loja:consultar-produtos terminou código 0: Produtos encontrados: 1;
  a mensagem de coleção vazia deixou de aparecer.
- Diagnóstico em outro processo PHP Docker conferiu banco loja, login
  loja_app, coleção Eloquent com um App\Models\Produto e exists=true.
- id inteiro 1, nome Camiseta, preco_em_centavos int 4990, status ativo.
  created_at e updated_at brutos iguais a 2026-10-15 22:43:40.239.
- Sem nova gravação na conferência. Uma única execução do seeder; sem reset,
  limpeza, rollback ou DDL. Não se trata de suíte de testes de integração
  escrevendo no banco da aplicação; testes SQL terão banco loja_test próprio.
- git diff --check passou. Código, configuração/credenciais, dependências,
  serviços e contador preservados.

Exercício acompanhado proposto: SELECT id, nome, preco_em_centavos, status,
created_at, updated_at FROM dbo.produtos no DBeaver, com banco loja selecionado.
Resultado observado pelo aluno ainda não informado; não inventar confirmação.

Entendimento da 5.22: confirmado com "entendi" em 15/10/2026.
Publicação da 5.22: checkpoint 9d03edc publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 9d03edc59b912352e2b6fe707637716694689503.
Próximo passo realizado na 5.23: exibir os campos de cada
Produto no comando loja:consultar-produtos, usando foreach da coleção e
acesso a atributos. Não executar novamente o seeder ou trocar o catálogo HTTP.

## Etapa 5.23 — Leitura dos atributos do Produto

Objetivo: apresentar os atributos dos models carregados na consulta existente.
Aula em docs/aulas/05-23-atributos-produto.md.

Implementação somente em backend/routes/console.php: foreach ($produtos as
$produto) depois do if de coleção vazia; line concatena id, nome,
preco_em_centavos com sufixo centavos e status, separados por |.
Consulta, quantidade, mensagem de ausência e outros comandos preservados.

Explicação apresentada: coleção versus cada model, foreach sobre coleção
iterável, nomes plural/singular escolhidos pelo programador; -> para ler
atributos do model Eloquent, cast inteiro, concatenação e unidade monetária.
line do comando imprime uma linha por Produto. Dados vêm da consulta, sem
valores fixos da Camiseta no comando. Coleção vazia não entra no laço;
caminho revisto sem apagar dados. Leitura de atributos carregados não faz
nova consulta por atributo, sem relacionamentos envolvidos.

Verificações em Docker:

- php -l routes/console.php passou com código 0.
- loja:consultar-produtos --no-ansi passou com código 0 e saída:
  Produtos encontrados: 1; 1 | Camiseta | 4990 centavos | ativo.
- Somente consulta de leitura; sem repetir seeder ou INSERT/UPDATE/DELETE.
- git diff --check passou; alteração de código restrita ao comando.
  Model, seeders, migrations, configuração/credenciais, dependências,
  serviços, catálogo HTTP e contador preservados.

Entendimento da 5.23: confirmado com "entendi" em 15/10/2026.
Publicação da 5.23: checkpoint 11f46d2 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 11f46d22361d28551ddf6165a8fff042b34a42e5.
Próximo passo realizado na 5.24: preparar ProdutoSeeder com
firstOrCreate, explicando critério de busca didático e limites sem restrição
única, sem executar o seeder ainda.

## Etapa 5.24 — Busca antes do cadastro no seeder

Objetivo: preparar reexecução sequencial do cadastro demonstrativo.
Aula em docs/aulas/05-24-first-or-create-seeder.md.

Implementação somente em backend/database/seeders/ProdutoSeeder.php:
create substituído por firstOrCreate, primeiro array ['nome' => 'Camiseta'],
segundo array com preco_em_centavos 4990 e status ativo. Demais estrutura,
imports e assinatura preservados.

Explicação apresentada: primeiro array define busca, segundo fornece dados
adicionais para criação; registro encontrado é devolvido sem inserir ou
atualizar preço/status; na ausência, os arrays são combinados para cadastro.
Retorno model persistido, sem variável necessária ou save adicional. Nome
como critério didático; preço/status fora da busca para mudanças nesses
valores não alterarem a correspondência. Mudar segundo array não atualiza
registros existentes. Nome não é identidade definitiva, sem unique nesta
etapa; não elimina duplicatas existentes ou garante concorrência sem uma
restrição única adequada. Identificação estável terá contexto de modelagem.

Verificações:

- php -l ProdutoSeeder.php no Docker passou com código 0.
- Revisão dos argumentos, atributos e correspondência com model/migration.
- git diff --check passou; única alteração de código no seeder.
- run/db:seed/firstOrCreate não executados; nenhuma consulta ou gravação SQL.
  Comportamento de reexecução ainda não demonstrado nesta versão.
- Model, migrations, comando de consulta, configuração/credenciais,
  dependências, serviços, catálogo HTTP e contador preservados.

Entendimento da 5.24: confirmado com "entendi" em 15/10/2026.
Publicação da 5.24: checkpoint 162b7aa publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 162b7aa2837f10450b4825ece1513ae3a5395c9d.
Próximo passo realizado na 5.25: executar somente ProdutoSeeder
em duas execuções sequenciais e comparar quantidade, id, atributos e datas
antes/depois, sem limpar dados ou alterar o produto. Demonstração pela conexão
da aplicação, sem gerar dados descartáveis de teste em loja; testes SQL de
integração terão banco exclusivo.

## Etapa 5.25 — Reexecução sequencial do seeder

Objetivo: observar firstOrCreate encontrando o registro existente.
Aula em docs/aulas/05-25-reexecucao-seeder.md. Sem alteração de código.

Diagnóstico temporário em PHP Docker: bootstrap Laravel, identidade loja/loja_app
na conexão sqlsrv e estado inicial de uma Camiseta id 1, preço 4990 e ativo
conferidos. Snapshot dos seis campos guardado somente em memória.
Kernel de console chamou db:seed com --class=ProdutoSeeder, --database=sqlsrv,
--no-interaction e --no-ansi duas vezes em sequência; ambas código 0 e DONE,
49 ms e 2 ms. Comparação dos seis campos após cada chamada idêntica ao início.

Explicação apresentada: comando de terminal equivalente, kernel call e opções
usados no diagnóstico; reencontro da Camiseta, ausência de novo cadastro ou
atualização, conservação de id e datas. SQL SELECT/TOP 1/WHERE, marcador ? e
valor enviado separadamente. Repetição preservando estado nesse cenário
como exemplo de idempotência, com limites de critério e concorrência da 5.24.

Verificações:

- Antes e depois de cada chamada: quantidade 1, id 1, Camiseta, 4990, ativo.
  created_at e updated_at brutos 2026-10-15 22:43:40.239, preservados.
- QueryExecuted capturou exatamente um SELECT por chamada do seeder:
  select top 1 * from [produtos] where ([nome] = ?), bindings ['Camiseta'],
  conexão sqlsrv. Nenhum INSERT/UPDATE/DELETE durante as chamadas observadas.
- Outro processo executou loja:consultar-produtos --no-ansi, código 0:
  Produtos encontrados: 1; 1 | Camiseta | 4990 centavos | ativo.
- Caminho de criação ausente, alteração de preço e concorrência não exercitados.
  Sem limpeza, reset, rollback, DDL ou dados descartáveis em loja.
  Testes SQL de integração continuam previstos para banco exclusivo.
- git diff --check passou. Código, configuração/credenciais, dependências,
  serviços, catálogo HTTP e contador preservados.

Entendimento da 5.25: confirmado com "entendi" em 15/10/2026.
Publicação da 5.25: checkpoint 8ec24b4 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 8ec24b482bd3febe764679f76f5519e740e631af.
Próximo passo realizado na 5.26: criar App\Services\CatalogoEloquent implementando
App\Contracts\Catalogo, com listarNomes lendo nomes do banco. Verificar leitura
e explicar relação com interface/model, sem trocar binding em AppServiceProvider.

## Etapa 5.26 — Catálogo com leitura Eloquent

Objetivo: criar uma implementação do contrato Catalogo que lê nomes do banco.
Aula em docs/aulas/05-26-catalogo-eloquent.md.

Implementação somente no novo backend/app/Services/CatalogoEloquent.php:
namespace App\Services, imports Catalogo e Produto, implements Catalogo,
public listarNomes(): array com retorno Produto::query()->pluck('nome')->all().

Explicação apresentada: namespace/autoload e imports, classe cumprindo interface
existente, formato array comum às implementações. query prepara a consulta,
pluck executa SELECT de nome e retorna coleção de valores; all da coleção
entrega array sem segunda consulta, distinto de Produto::all(). return e
contrato array, strings versus models, lista vazia quando não há registros.
Chamada direta ao novo serviço versus resolução atual pelo container.

Verificações em Docker:

- php -l CatalogoEloquent.php passou com código 0.
- Autoload e instanceof Catalogo conferidos; listarNomes retornou ['Camiseta'].
- Diagnóstico confirmou sqlsrv, banco loja e login loja_app. QueryExecuted
  capturou somente select [nome] from [produtos], bindings vazios.
- Container ainda resolveu CatalogoDemonstracao, com três nomes esperados,
  sem consulta adicional; binding permanece para a página /loja.
- Arquivo modo 644, dono 1000:1000; git diff --check passou.
- Sem gravação SQL ou execução de seeder. Interface/model/provider/controller/
  view/rotas/seeders/migrations, configuração/credenciais, dependências,
  serviços e contador preservados.

Entendimento da 5.26: confirmado com "entendi" em 16/10/2026.
Publicação da 5.26: checkpoint f14564c publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em f14564c29d64fdd07a709c48da7db1a978db445c.
Próximo passo realizado na 5.27: trocar binding de Catalogo em AppServiceProvider
para CatalogoEloquent e conferir HTTP /loja com a Camiseta persistida, explicando
resolução no controller. Não alterar controller ou cadastrar novos produtos.

## Etapa 5.27 — Página com catálogo do banco

Objetivo: fazer o container fornecer o catálogo do banco ao controller existente.
Aula em docs/aulas/05-27-binding-catalogo-eloquent.md.

Implementação somente em backend/app/Providers/AppServiceProvider.php:
import CatalogoDemonstracao substituído por CatalogoEloquent, e register
passou a ligar Catalogo::class a CatalogoEloquent::class no bind.

Explicação apresentada: provider/register/container, primeiro argumento como
interface e segundo como implementação; ::class como nome de classe, não
instanciação imediata. Resolução do construtor de LojaController e propriedade
promovida private Catalogo $catalogo; index chama listarNomes e passa array
para Blade. Serviço usa Produto/sqlsrv/loja_app; view percorre strings com
escape. Contrato e formato preservados permitem a troca sem editar controller.
Consulta ocorre na chamada listarNomes, não no simples registro do binding.

Verificações em Docker:

- php -l AppServiceProvider.php passou com código 0.
- Container resolveu Catalogo como App\Services\CatalogoEloquent.
- Diagnóstico do kernel HTTP conferiu banco loja/login loja_app e GET /loja
  com HTTP 200, título Loja Fullstack, X-Curso Laravel, um li Camiseta.
- QueryExecuted capturou uma consulta da requisição: select [nome] from
  [produtos], bindings vazios. Sem escrita SQL ou execução de seeder.
- Requisição HTTP real ao servidor ativo via PHP Docker, endereço interno
  127.0.0.1:8000/loja, conferiu os mesmos status/título/header/item. Código 0.
- Compose ativo publica backend no host em 127.0.0.1:8002. Link /loja indicado
  para exercício acompanhado; resultado do aluno no navegador não informado.
- git diff --check passou; código alterado somente no import/binding do provider.
  Interface, serviço, model, controller, view, rotas, migrations, credenciais,
  dependências, serviços e contador preservados.

Entendimento da 5.27: confirmado com "entrendi" em 16/10/2026.
Publicação da 5.27: checkpoint 0eb7973 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 0eb79735c54353519f2d3be5d7237cdde415d64e.
Próximo passo realizado na 5.28: ajustar somente título da lista e mensagem de
ausência em backend/resources/views/loja.blade.php para catálogo persistido,
preservando @if/@foreach/escape e verificando HTTP.

## Etapa 5.28 — Textos da página do catálogo

Objetivo: adequar a apresentação do catálogo que recebe dados persistidos.
Aula em docs/aulas/05-28-textos-catalogo.md.

Implementação somente em backend/resources/views/loja.blade.php: h2 passou
a Catálogo de produtos; mensagem no @else passou a Nenhum produto disponível.

Explicação apresentada: textos fixos de apresentação pertencem à view;
nomes dinâmicos chegam por CatalogoEloquent/controller/array e @foreach.
@if/count escolhe lista ou mensagem, escape do Blade preservado.

Verificação: requisição HTTP real ao backend ativo via PHP Docker conferiu
status 200, novo h2, um li Camiseta, title Loja Fullstack e X-Curso Laravel.
Código 0; mensagem do @else revisada no arquivo/diff, sem executar ramo vazio.
Sem apagar dados para demonstrar ausência ou criar testes para mudança de texto.
git diff --check passou. Demais código, configuração/credenciais,
dependências, serviços e contador preservados. Sem gravação SQL ou seeder.

Entendimento da 5.28: confirmado com "entendi" em 16/10/2026.
Publicação da 5.28: checkpoint 1cd8038 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 1cd8038f21b6f40bfea94d1c5cb1f6f41c4a537d.
Próximo passo realizado na 5.29: filtrar status ativo em
CatalogoEloquent antes de pluck, explicando where, parâmetros e SQL gerado.
Conferir leitura/HTTP com a Camiseta existente sem cadastrar dados descartáveis.

## Etapa 5.29 — Filtro de produtos ativos

Objetivo: selecionar somente produtos ativos para o catálogo.
Aula em docs/aulas/05-29-filtro-produtos-ativos.md.

Implementação somente em backend/app/Services/CatalogoEloquent.php:
where('status', 'ativo') entre query e pluck, encadeamento em linhas separadas;
all e retorno array preservados.

Explicação apresentada: where adiciona condição, dois argumentos usam igualdade
implícita, coluna e valor. Filtro executado no banco antes dos nomes chegarem
à view; SQL WHERE e marcador ? com binding ativo. Camiseta continua na lista
porque já está ativa. Filtro seleciona registros sem mudar status, pertence
ao serviço e não é global do model; comando de consulta geral preservado.
Ausência de ativos produz array vazio e mensagem já existente na view.

Verificações em Docker:

- php -l CatalogoEloquent.php passou, código 0.
- Container resolveu CatalogoEloquent; listarNomes retornou ['Camiseta'].
  Banco loja/login loja_app conferidos. QueryExecuted capturou uma consulta:
  select [nome] from [produtos] where [status] = ?, bindings ['ativo'].
- HTTP real no servidor ativo retornou 200, um li Camiseta, title Loja
  Fullstack, h2 Catálogo de produtos e X-Curso Laravel; diagnóstico código 0.
- Exclusão de inativos e ausência de ativos não exercitadas com dados nesta
  etapa. Nenhuma inserção ou alteração da Camiseta para teste; cenários SQL
  de integração terão banco/dados exclusivos.
- git diff --check passou. Única mudança de código no serviço; demais código,
  configuração/credenciais, dependências, serviços e contador preservados.

Entendimento da 5.29: confirmado com "entendi" em 16/10/2026.
Publicação da 5.29: checkpoint 7199685 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 7199685ec8b6c7b9836535c2f91010c1dcbf7e96.
Próximo passo realizado na 5.30: ordenar por nome com orderBy('nome'), explicar
ordem crescente e SQL ORDER BY e verificar consulta/HTTP com dados existentes.

## Etapa 5.30 — Ordenação dos nomes do catálogo

Objetivo: obter nomes de produtos ativos em ordem crescente pelo banco.
Aula em docs/aulas/05-30-ordenacao-catalogo.md.

Implementação somente em backend/app/Services/CatalogoEloquent.php:
linha orderBy('nome') entre where e pluck. Demais código preservado.

Explicação apresentada: coluna de ordenação, direção asc padrão e forma
equivalente explícita; desc como direção decrescente. where seleciona linhas,
orderBy define ordem, pluck executa e all entrega array à view na ordem recebida.
SQL ORDER BY nome ASC, ordenação no banco e exemplo hipotético de três nomes,
sem cadastrá-los na loja.

Verificações em Docker:

- php -l CatalogoEloquent.php passou, código 0.
- Diagnóstico confirmou banco loja/login loja_app, retorno ['Camiseta'],
  uma consulta capturada: select [nome] from [produtos] where [status] = ?
  order by [nome] asc, bindings ['ativo'].
- HTTP real /loja retornou 200, um li Camiseta, title Loja Fullstack,
  h2 Catálogo de produtos e X-Curso Laravel. Diagnóstico código 0.
- Um único produto: mudança visual de ordem entre vários nomes não exercitada.
  Exclusão de inativos/lista vazia/múltiplos nomes terão dados e banco exclusivos.
- git diff --check passou; nenhuma gravação SQL. Interface, model, provider,
  controller, view, comandos, seeders, migrations, configuração/credenciais,
  dependências, serviços e contador preservados.

Entendimento da 5.30: confirmado com "entendi" em 16/10/2026.
Publicação da 5.30: checkpoint 8a61f8d publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 8a61f8da568429203aeb75cdecd3576ca682cbc6.
Próximo passo realizado na 5.31: diagnosticar ferramentas de teste do backend,
composer.lock/vendor, phpunit.xml e banco loja_test/isolamento; explicar
pendências para testes de ativos/inativos/ordenação/lista vazia em banco exclusivo.
Somente preparação, sem instalar dependências, configurar testes ou criar contas.

## Etapa 5.31 — Preparação dos testes do backend

Objetivo: conferir ferramentas e isolamento necessários aos testes do catálogo.
Aula em docs/aulas/05-31-preparacao-testes-backend.md. Sem alteração de código.

Explicação apresentada: teste de integração reúne serviço/model/SQL Server,
com dados conhecidos para ativos/inativos/ordenação/lista vazia em loja_test.
Pacotes declarados no lock versus realmente instalados; PHPUnit do backend
independente do laboratório. phpunit.xml/Unit/Feature/TestCase gerados, ambiente
testing e configuração de banco explícita. Existência do banco versus acesso
e estrutura preparados. Pendências separadas para instalação, acesso e ambiente.

Verificações somente de leitura em Docker:

- PHP 8.4.26, lock com 33 pacotes de desenvolvimento; PHPUnit 12.5.39,
  Faker v1.24.1 e Collision v8.9.5 no lock, não instalados.
  Executável e classe PHPUnit ausentes; autoload-dev Tests configurado no JSON.
- composer check-platform-reqs --lock --format=json passou, incluindo PHP
  e extensões exigidas por dependências de desenvolvimento; drivers SQL disponíveis.
- composer install --dry-run --no-scripts --no-plugins --no-interaction:
  33 instalações previstas, zero updates/remoções, código 0. Conferência após
  dry-run confirmou PHPUnit/executável ainda ausentes. Nada instalado.
- phpunit.xml válido, APP_ENV testing, DB_CONNECTION sqlite, DB_DATABASE
  :memory:, sessões/cache array. .env.testing e cache de configuração ausentes.
  Exemplos Unit/Feature existentes apresentados, sem execução.
- sqlsrv e sqlsrv_migracoes continuam em loja, login correspondente; ambas
  retornaram HAS_DBACCESS(loja_test)=0. Leituras administrativas em loja_test
  confirmaram ONLINE, zero tabelas e zero usuários SQL adicionais, sem usuários
  loja_app/loja_migracoes. Senha passada internamente ao sqlcmd sem exibição.
- Sem criação de contas/permissões/tabelas/dados, aplicação de migrations,
  configuração de testes ou execução de suíte. git diff --check passou;
  código, credenciais, dependências instaladas, serviços e contador preservados.

Entendimento da 5.31: confirmado com "entendi" em 16/10/2026.
Publicação da 5.31: checkpoint 4233936 publicado com autorização persistente;
HEAD, origin/main e main remota conferidos em 423393609a1e7323c6a2a8240542e80e85f4f266.
Próximo passo realizado na 5.32: instalar dependências de desenvolvimento do lock
no backend com install --no-scripts --no-plugins --no-interaction, sem update.
Conferir PHPUnit/plataforma/autoload; não executar suíte ou preparar contas/banco
nessa instalação. Acesso próprio, configuração SQL de testes e estrutura seguem pendentes.

## Etapa 5.32 — Ferramentas de testes instaladas

Objetivo: instalar dependências de desenvolvimento fixadas no lock do backend.
Aula em docs/aulas/05-32-instalacao-ferramentas-testes.md.

Implementação no volume vendor-backend: composer install --no-scripts
--no-plugins --no-interaction executado em PHP Docker; 33 instalações,
zero updates/remoções, código 0. Autoload otimizado com regras de desenvolvimento.
Nenhum arquivo de código/configuração/lock editado nesta etapa.

Explicação apresentada: install e versões do lock, require-dev por padrão,
opções de scripts/plugins/interação, pacotes no volume e fora do Git.
Autoload-dev Tests para tests/, executável vendor/bin/phpunit e mapas do
Composer. Ferramenta instalada versus configuração de testes ainda pendente;
descoberta dos pacotes Laravel adiada porque post-autoload-dump não executou.

Verificações:

- php vendor/bin/phpunit --version: PHPUnit 12.5.39, código 0.
- composer check-platform-reqs passou para a instalação incluindo dev.
- Diagnóstico comparou os 109 pacotes instalados com o lock: 76 execução +
  33 desenvolvimento, nomes/versões correspondentes. Regra Tests /app/tests,
  PHPUnit\Framework\TestCase e Tests\TestCase com herança conferidos.
- Diagnóstico somente de autoload, sem bootstrap da aplicação ou conexão SQL.
  Nenhum teste, migration, seeder ou script de instalação executado.
- Hashes de composer.json, composer.lock e bootstrap/cache/packages.php e
  services.php preservados desde antes do install. git diff --check passou.
- Credenciais, configuração de testes/banco, código, serviços e contador preservados.
  Ferramentas e autoload persistem no volume; JSON/lock sem mudanças a publicar.

Entendimento da 5.32: confirmado com "entendi" em 16/10/2026.
Publicação da 5.32: checkpoint 6d86416 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 6d864163d3131b367a429a836dc50a953e989f91.
Próximo passo realizado na 5.33: executar package:discover, apresentar
os manifests gerados e conferir ajuda de artisan test. Sem suíte, criação de
contas ou configuração de banco nessa etapa de registro dos pacotes.

## Etapa 5.33 — Descoberta dos pacotes de desenvolvimento

Objetivo: registrar os pacotes instalados no Laravel e conferir a ajuda de test.
Aula em docs/aulas/05-33-descoberta-pacotes-testes.md.

Implementação: package:discover --no-interaction --no-ansi executado no backend
Docker, código 0. packages.php reconstruído com seis pacotes; services.php
atualizado na inicialização seguinte. Arquivos gerados continuam ignorados.
composer.json, composer.lock e bootstrap/providers.php preservados.

Explicação apresentada: autoload encontra classes; descoberta identifica providers
que registram serviços/comandos. Metadados extra.laravel.providers dos pacotes,
packages.php versus services.php, caches locais e papel de Collision no test.
help test mostra documentação sem executar suíte. Scripts foram dispensados na
instalação anterior; agora executamos explicitamente apenas a descoberta.

Verificações:

- Descoberta código 0; saída mostrou os três pacotes anteriormente carregados.
  Arquivo posterior tem seis: Pail, Pao, Tinker, Carbon, Collision e Termwind.
  Código instalado de PackageManifest confirma que build escreve o arquivo,
  mas mantém o array manifest anteriormente carregado no objeto usado na saída.
- Novo processo php artisan help test --no-ansi: código 0, descrição, uso e opções
  como compact, coverage, parallel e profile. Somente ajuda; opções não executadas.
- Pail, Pao e Collision presentes em services.php; chaves providers/eager/deferred/when.
  php -l passou nos dois manifests. SHA256 de JSON e lock iguais aos anteriores.
- GET real de /loja: HTTP 200, X-Curso Laravel, título do catálogo e um item Camiseta.
  Conferência HTTP manual, sem suíte. git check-ignore confirmou manifests/vendor/.env.
- Sem .env.testing; phpunit.xml ainda SQLite em memória. Nenhuma suíte, migration,
  seeder, criação de conta, alteração de permissão ou configuração SQL nesta etapa.
  git diff --check passou; código, credenciais, serviços e contador preservados.

Entendimento da 5.33: confirmado com "entendi" em 16/10/2026.
Publicação da 5.33: checkpoint f14a335 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em f14a335a35b2400324020fedc08aeb4c454a8386.
Próximo passo realizado na 5.34: preparar e
explicar script SQL de conta exclusiva de testes limitada a loja_test, sem executá-lo.
Criação da conta, senha local, configuração e estrutura do banco ficarão para depois.

## Etapa 5.34 — Script da conta exclusiva de testes

Objetivo: preparar script SQL de acesso próprio a loja_test, sem criar a conta.
Aula em docs/aulas/05-34-script-conta-testes.md.

Implementação: docker/sqlserver/criar-usuario-testes.sql escrito com login e
usuário loja_testes, DEFAULT_DATABASE loja_test, DEFAULT_SCHEMA dbo, senha via
marcador MSSQL_TESTS_PASSWORD e CHECK_POLICY ON. Papéis db_datareader/db_datawriter,
CREATE TABLE no banco e ALTER no esquema dbo. Condições de existência para
login/usuário/papéis; :ON ERROR EXIT interrompe sqlcmd em erro, GO separa lotes.
Não há criação de usuário/concessão em loja, papéis administrativos ou reset de senha.

Explicação apresentada: identidade de autenticação versus usuário no banco,
banco padrão não restringe acesso, USE define contexto, papéis de dados versus
permissões de estrutura, alcance de ALTER incluindo remover objetos de dbo em
loja_test, variáveis sqlcmd, lotes e verificações condicionais. Permissão para
criar tabela não cria tabela. Acesso real e reexecução ainda não demonstrados.

Verificações:

- SELECT anterior: loja_test existe, login loja_testes NULL, zero usuários dessa
  conta em loja_test e loja; zero tabelas de usuário em loja_test.
- Entrada temporária com SET PARSEONLY ON em lote anterior ao script completo,
  marcador substituído por texto fictício público, sem criar senha local.
  sqlcmd no SQL Server Docker terminou com código 0, sem erro de sintaxe.
- PARSEONLY não compila/executa as instruções; não valida permissões efetivas
  ou criação da conta. Após desativá-lo em outro lote, SELECT confirmou login
  NULL, zero usuários da conta e zero tabelas de usuário em loja_test.
- Nenhum CREATE/ALTER/GRANT aplicado; nenhuma suíte, migration ou seeder executado.
  Senha administrativa usada internamente via SQLCMDPASSWORD, sem exibição.
- git diff --check passou; revisão de contexto, marcador de senha e concessões.
  Ambiente/modelo, configuração Laravel, dependências, serviços e contador preservados.

Entendimento da 5.34: confirmado com "entendi" em 19/10/2026.
Retomada em 19/10/2026: explicação do script reapresentada, sem alteração no SQL
ou execução no banco. Git remoto confirmado em a6ddff9 e nenhum container do
projeto listado. Verificações SQL acima são as realizadas em 16/10/2026.
Salvamento da 5.34: registro de encerramento preparado para commit/push a pedido
expresso do aluno em 16/10/2026; não é confirmação de entendimento. Último
checkpoint confirmado/publicado: f14a335, etapa 5.33. Consultar Git para o SHA
do registro de encerramento, que não será escrito dentro do próprio commit.
Próximo passo após a confirmação recebida: iniciar 5.35, preparar campo
público vazio e senha somente no ambiente local ignorado, aplicar o script e conferir
identidade, permissões em loja_test, ausência de acesso a loja e reexecução.
Configuração Laravel e estrutura de testes serão etapas posteriores. Autorização
anterior de loja_migracoes em loja não é autorização específica da nova conta.

## Etapa 5.35 — Aplicação da conta exclusiva de testes

Data: 19/10/2026. Objetivo: aplicar o script já compreendido e verificar o
acesso próprio de loja_testes a loja_test. Aula em
docs/aulas/05-35-aplicar-conta-testes.md.

Implementação: .env.example da raiz ganhou MSSQL_TESTS_PASSWORD vazio; .env
local recebeu senha gerada em PHP 8.4 Docker, sem exibição. Demais linhas
preservadas e permissão 600. Script SQL existente aplicado por sqlcmd em cliente
Docker temporário com a imagem SQL Server já fixada, sem novo serviço/dependência.
Foi solicitado início apenas do serviço sqlserver nesta etapa. A conferência
final encontrou sqlserver, backend e php ativos; nenhum comando desta etapa
iniciou explicitamente esses dois últimos servidores. PHP Docker temporário
foi usado para gerar a senha; clientes temporários foram removidos.

Explicação apresentada: modelo público versus segredo local; geração aleatória;
--env-file fornece a variável de substituição do script; SQLCMDPASSWORD autentica
sa durante a preparação; depois a senha de testes autentica loja_testes.
Redirecionamento envia o SQL ao cliente; -C, -l 5 e -b controlam certificado
local, tempo de login e código de falha. Conceder permissões não cria tabelas.

Verificações realizadas:

- Antes: loja/loja_test ONLINE, login loja_testes NULL, zero usuários dessa
  conta nos dois bancos, zero tabelas em loja_test e um produto em loja.
- Script aplicado com código 0. Login com CHECK_POLICY ON, habilitado e banco
  padrão loja_test; usuário SQL nesse banco com esquema padrão dbo.
- Autenticação própria retornou banco loja_test, login/usuário loja_testes;
  leitura/escrita/CREATE TABLE/ALTER dbo = 1/1/1/1;
  db_owner/sysadmin/acesso a loja/CREATE ANY DATABASE = 0/0/0/0.
- Conexão explícita solicitando loja recusada: Cannot open database "loja";
  falha esperada. Consulta administrativa confirmou zero usuários dessa conta
  em loja e um produto preservado. Nenhum DML executado.
- Reaplicação do mesmo script com código 0; nova autenticação com a mesma senha
  manteve identidade/permissões e zero tabelas em loja_test.
- .env e backend/.env ignorados; modelo sem senha real. Nenhuma configuração
  Laravel, phpunit.xml, migration, seeder, dependência ou suíte alterada/executada.

Entendimento da 5.35: confirmado com "entendi" em 19/10/2026.
Publicação da 5.35: checkpoint 04a9a7c publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 04a9a7cd16a9d07091b4cbaf50c3adc90e6402fc.
Próximo passo após a confirmação: iniciar 5.36 pelo modelo de ambiente de testes do Laravel, explicando a separação
das configurações e sem executar testes antecipadamente.

## Etapa 5.36 — Modelo do ambiente Laravel de testes

Data: 19/10/2026. Objetivo: documentar as variáveis do ambiente Laravel de
testes sem criar configuração local nem executar a suíte. Aula em
docs/aulas/05-36-modelo-ambiente-testes.md.

Implementação: backend/.env.testing.example com APP_ENV testing, APP_KEY vazio,
DB_URL vazio, conexão sqlsrv, host Docker sqlserver:1433, banco loja_test,
usuário loja_testes e DB_PASSWORD vazio. Opções TLS locais como na conexão
estudada; cache/sessão/mail array, fila sync, broadcast null e BCRYPT_ROUNDS 4.
Exceção !/backend/.env.testing.example no .gitignore da raiz permite versionar
esse modelo específico; .env.testing e os arquivos com segredos continuam ignorados.

Explicação apresentada: modelo público não é carregado automaticamente pelo
Laravel. A cópia local será .env.testing, selecionada quando o ambiente de
testes for solicitado; variáveis externas e phpunit.xml também participam
da configuração. APP_ENV é ambiente Laravel, DB_CONNECTION é nome da conexão,
DB_DATABASE é banco SQL e DB_USERNAME é login. DB_URL vazio evita definir DSN
alternativo no modelo; chave/senha serão preparadas apenas na próxima etapa.
Drivers array mantêm dados no processo; sync executa jobs no próprio processo;
mail array não envia mensagens e broadcast null desativa o envio de broadcasts.

Verificações realizadas:

- PHP 8.4.26 e Composer 2.10.3 conferidos no backend Docker. Código instalado
  de LoadEnvironmentVariables consultado para seleção de .env.testing.
- phpdotenv analisou o modelo em diagnóstico temporário, conferindo os valores
  públicos, chave/senha vazias e variáveis de processo preservadas. Código 0.
  Nenhuma inicialização Laravel, consulta SQL ou suíte executada.
- .env.testing ausente; XML lido confirmou sqlite/:memory: ainda presentes.
- git check-ignore -v --no-index confirmou a exceção exata para o modelo e
  exclusão de backend/.env.testing, backend/.env e .env. git diff --check passou.
- Credenciais, phpunit.xml, config/database.php, dependências, serviços,
  migrations e seeders preservados. Nenhuma instalação de Boost, conforme
  prioridade das instruções do curso sobre o AGENTS.md gerado do backend.

Entendimento da 5.36: confirmado com "entendi" em 19/10/2026.
Publicação da 5.36: checkpoint 1c8c380 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 1c8c3801f6ecfd62a8b6b0c7749caff24fde8582.
Próximo passo após a confirmação: 5.37,
preparar .env.testing local com chave própria e senha já existente de loja_testes,
verificar carregamento e conexão em leitura. Não alterar phpunit.xml nem
executar testes/migrations nessa preparação local.

## Etapa 5.37 — Configuração local Laravel de testes

Data: 19/10/2026. Objetivo: preparar a cópia local do modelo e verificar o
carregamento e a conexão Laravel por leitura. Aula em
docs/aulas/05-37-ambiente-local-testes.md.

Implementação: somente backend/.env.testing local criado, ignorado pelo Git,
permissão 600, dono 1000:1000. PHP Docker leu o modelo público, gerou APP_KEY
própria com Encrypter::generateKey('AES-256-CBC'), codificou com base64: e copiou
MSSQL_TESTS_PASSWORD do .env da raiz para DB_PASSWORD. Valores não exibidos.
Criação exclusiva evita sobrescrever arquivo existente. Hashes internos
confirmaram .env da raiz, backend/.env e modelo preservados. Nenhuma senha
redefinida, conta ou chave da aplicação normal alterada.

Explicação apresentada: APP_KEY atende à criptografia Laravel; DB_PASSWORD
autentica no SQL Server. Arquivos de ambiente isolam a configuração de cada
processo. --env=testing seleciona .env.testing; não altera permanentemente o
servidor HTTP nem a configuração das execuções normais. phpunit.xml ainda
precisa ser alinhado ao SQL Server antes de rodar testes.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3 conferidos no backend Docker; cipher AES-256-CBC
  e geração de chave consultados no código instalado. Sem cache de configuração.
- Diagnóstico temporário iniciou Laravel com --env=testing e confirmou arquivo
  .env.testing, ambiente testing, sqlsrv/sqlserver:1433/loja_test/loja_testes,
  chave e senha carregadas, cache/sessão/mail array e fila sync.
- Chave de 32 bytes diferente da normal; criptografia e descriptografia de
  texto diagnóstico conferidas sem imprimir chave ou conteúdo cifrado.
- SELECT retornou banco loja_test, login/usuário loja_testes, acesso a loja 0
  e zero tabelas. Comando loja:verificar-banco --env=testing repetiu a identidade;
  sem essa opção retornou loja/loja_app. Ambos com código 0, somente leitura.
- git check-ignore confirmou arquivos privados ignorados; git ls-files não
  listou nenhum deles. Modelo público preservado; git diff --check passou.
- Nenhuma alteração em phpunit.xml, código Laravel, dependências, serviços,
  migrations ou seeders; nenhuma suíte executada. Clientes temporários removidos.

Entendimento da 5.37: confirmado com "entendi" em 19/10/2026.
Publicação da 5.37: checkpoint d80d241 publicado conforme autorização persistente,
sem .env.testing. HEAD, origin/main e main remota conferidos em
d80d24172b92045f93f0e9fd3fe1a2fd32bfdf91.
Próximo passo após a confirmação: 5.38,
alinhar phpunit.xml ao SQL Server de testes e verificar sua configuração,
sem executar a suíte ou criar tabelas nessa alteração.

## Etapa 5.38 — Configuração PHPUnit para SQL Server

Data: 19/10/2026. Objetivo: alinhar as variáveis PHPUnit ao ambiente SQL Server
de testes já verificado. Aula em docs/aulas/05-38-phpunit-sql-server.md.

Implementação: somente duas entradas em backend/phpunit.xml alteradas:
DB_CONNECTION de sqlite para sqlsrv e DB_DATABASE de :memory: para loja_test.
APP_ENV testing e demais opções preservados; nenhum segredo no XML. Host,
login, senha e chave continuam vindo de backend/.env.testing local ignorado.

Explicação apresentada: PHPUnit lê o XML e prepara as variáveis do processo;
APP_ENV testing faz Laravel procurar .env.testing; config/database.php usa
DB_CONNECTION/DB_DATABASE para montar a conexão. As entradas não têm force,
portanto variáveis já exportadas podem prevalecer. Diagnóstico confirma o
ambiente Docker atual, não substitui a execução futura da suíte.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3 e classes Loader/PhpHandler conferidos no backend
  Docker. XML validado com DOMDocument::schemaValidate no XSD instalado.
- Diagnóstico temporário leu XML pelo Loader real e aplicou as variáveis pelo
  PhpHandler real do PHPUnit. APP_ENV/DB_CONNECTION/DB_DATABASE/DB_URL efetivos
  corresponderam a testing/sqlsrv/loja_test/vazio.
- Laravel inicializado sem --env=testing manual, selecionando .env.testing a
  partir das variáveis acima. Sem cache de configuração. Conexão sqlsrv,
  banco/login previstos e igualdade de chave/senha locais conferidos sem exibição.
- SELECT retornou loja_test, login/usuário loja_testes, HAS_DBACCESS loja = 0
  e zero tabelas. Diagnóstico com código 0; nenhuma suíte ou caso de teste executado.
- git diff --check passou; arquivos privados ignorados e ausentes do índice.
  Nenhuma migration, seeder, instalação ou alteração de conta/credencial.

Entendimento da 5.38: confirmado com "entendi" em 19/10/2026 após esclarecimento.
Dúvida recebida em 19/10/2026: "como ele sabe que deve ler o .env.testing?"
Esclarecimento apresentado com o código instalado: PHPUnit define APP_ENV
testing antes de Laravel iniciar; LoadEnvironmentVariables lê essa variável,
concatena o nome padrão .env com .testing, verifica se o arquivo existe e
o seleciona. Não é o APP_ENV dentro de .env.testing que seleciona o próprio
arquivo. --env=testing é o caminho explícito do console. Sem arquivo específico,
o carregador mantém o nome anterior, normalmente .env; não cria a cópia.
Após a explicação, aluno confirmou entendimento com "entendi" em 19/10/2026.
Publicação da 5.38: checkpoint 734fc5f publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 734fc5f622c2c2030508e89d62050fbb5f00ec4b.
Próximo passo após a confirmação: 5.39,
apresentar os dois testes de exemplo existentes, executar a suíte inicial e
interpretar o que comprova. Banco de testes ainda sem estrutura de aplicação;
não antecipar testes de catálogo ou criação de tabelas nessa revisão inicial.

## Etapa 5.39 — Primeira execução dos testes de exemplo do backend

Data: 19/10/2026. Objetivo: apresentar os testes gerados e verificar a suíte
inicial sem escrever testes de catálogo ou preparar tabelas antecipadamente.
Aula em docs/aulas/05-39-primeira-suite-backend.md.

Implementação: nenhuma alteração no código. Apresentados tests/Unit/ExampleTest.php,
tests/Feature/ExampleTest.php e tests/TestCase.php já existentes no backend.
Executados em Docker com php vendor/bin/phpunit --testdox --colors=never
--do-not-cache-result. Apenas registros adicionados nesta etapa.

Explicação apresentada: namespace separa as duas classes ExampleTest; use
escolhe o TestCase base. Exemplo unitário herda diretamente do PHPUnit e usa
assertTrue(true). Exemplo Feature herda de Tests\\TestCase, que estende a base
Laravel e prepara a aplicação. Método test_ é descoberto pelo PHPUnit; void
indica ausência de valor retornado. $this->get('/') faz requisição interna
e assertStatus(200) confere somente o status. Rota / retorna welcome;
não é a rota /loja. Nenhum navegador ou servidor HTTP externo é necessário.
RefreshDatabase aparece apenas em comentário, sem uso efetivo no teste.

Verificações realizadas:

- PHPUnit 12.5.39 em PHP 8.4.26 leu /app/phpunit.xml e executou exatamente
  os dois exemplos: OK (2 tests, 2 assertions), código 0, sem falhas/avisos.
- --testdox exibe descrições, --colors=never evita códigos de cor e
  --do-not-cache-result evita escrita do cache de resultados no código somente leitura.
- Casos não fazem consultas SQL nem assertions de catálogo. O resultado
  comprova execução PHPUnit e resposta HTTP 200 da raiz no ambiente Laravel;
  não comprova persistência, filtro, ordenação ou conteúdo do catálogo.
- Diagnóstico separado após a suíte aplicou XML e consultou SQL: loja_test,
  login/usuário loja_testes, HAS_DBACCESS loja = 0 e zero tabelas. Código 0.
- Git limpo antes dos novos registros; arquivos privados continuam ignorados,
  ausentes do índice. git diff --check passou; código/configuração preservados.
  Nenhuma migration, seeder, instalação ou alteração de credencial executada.

Entendimento da 5.39: confirmado com "entendi" em 19/10/2026.
Publicação da 5.39: checkpoint bdfb1a3 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em bdfb1a3ded8be0ef265d6d6bd745e7385fb34354.
Próximo passo após a confirmação: 5.40,
preparar a tabela produtos em loja_test a partir da migration existente,
verificando a identidade da conexão e o esquema. Não antecipar testes de catálogo.

## Etapa 5.40 — Tabela produtos no banco de testes

Data: 19/10/2026. Objetivo: preparar produtos em loja_test usando a migration
existente, sem novos testes ou dados. Aula em docs/aulas/05-40-migration-produtos-testes.md.

Implementação: arquivo 2026_10_14_123220_create_produtos_table.php reutilizado
sem edição. Executado migrate --env=testing --database=sqlsrv --path desse
arquivo --no-interaction --no-ansi no backend Docker. Criadas dbo.migrations
e dbo.produtos em loja_test; não aplicadas as migrations de users, cache e jobs.
Nenhuma alteração no código/configuração da aplicação; somente novos registros.

Explicação apresentada: arquivo de migration é compartilhado entre ambientes,
histórico de execução pertence a cada banco. --env seleciona .env.testing;
--database recebe nome da conexão, não nome do banco; --path limita o arquivo.
up cria produtos; migrations registra nome/batch e evita reaplicar. Preparação
da estrutura não cadastra produtos nem copia dados do banco normal.

Verificações realizadas:

- Ajuda de migrate/migrate:status conferida na versão instalada. Prévia sem
  cache de configuração confirmou testing/.env.testing/sqlsrv/loja_testes,
  banco loja_test, zero tabelas, CREATE TABLE/ALTER dbo = 1/1 e acesso a loja = 0.
- Aplicação com código 0: Creating migration table DONE e migration produtos DONE.
- migrate:status para o mesmo caminho: [1] Ran. Reexecução do mesmo migrate:
  Nothing to migrate, código 0, sem duplicar o registro.
- SELECT confirmou somente migrations/produtos, zero produtos, uma entrada
  2026_10_14_123220_create_produtos_table no lote 1. Colunas: id BIGINT IDENTITY
  PK, nome NVARCHAR(150), preco_em_centavos INT, status NVARCHAR(20) default
  ('ativo'), created_at/updated_at DATETIME2(3) nullable. Demais colunas NOT NULL.
- Execução normal separada confirmou loja/loja_app, um produto e uma migration.
  Nenhuma operação de escrita no banco normal; nenhum seeder executado.
- git diff --check passou; arquivos privados continuam ignorados/fora do índice.
  Nenhuma nova dependência, conta, configuração, teste ou alteração de credencial.
  Suíte inicial da 5.39 não repetida: casos não usam a estrutura criada aqui.

Entendimento da 5.40: confirmado com "entendi" em 19/10/2026.
Publicação da 5.40: checkpoint b70f6f0 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em b70f6f081d99b4009681764ee090a94f0c8ac27d.
Próximo passo após a confirmação: 5.41,
criar o primeiro teste de integração de catálogo vazio, explicando preparação
e isolamento dos dados de teste, sem antecipar os demais cenários.

## Etapa 5.41 — Primeiro teste de integração do catálogo vazio

Data: 19/10/2026. Objetivo: verificar listarNomes com tabela produtos vazia em
SQL Server real, explicando isolamento. Aula em docs/aulas/05-41-teste-catalogo-vazio.md.

Implementação: somente backend/tests/Feature/CatalogoEloquentTest.php criado,
com Tests\\TestCase, imports Produto/CatalogoEloquent/DB e trait DatabaseTransactions.
SELECT DB_NAME/SUSER_SNAME e assertSame conferem loja_test/loja_testes antes de
Produto::query()->delete(). Instância direta do serviço, assertSame([], listarNomes()).
Nenhuma alteração no serviço, model, contrato, configuração ou migrations.

Explicação apresentada: imports use fora da classe resolvem nomes; use dentro
da classe incorpora métodos do trait. DatabaseTransactions inicia transação
na conexão padrão e registra rollback/desconexão no encerramento do teste.
DELETE prepara ausência de produtos sem remover a tabela; rollback desfaz
alterações de dados da transação mesmo quando uma asserção falha no ciclo normal.
assertSame compara valor e tipo; duas asserções conferem destino antes de escrita,
a terceira verifica comportamento. Teste integra serviço, Eloquent e SQL Server;
não faz requisição HTTP nem substitui o banco por simulação.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3 e implementação instalada de DatabaseTransactions
  e seu acionamento no ciclo TestCase conferidos em Docker.
- php -l do novo arquivo passou. PHPUnit focado: OK (1 test, 3 assertions), código 0.
- Suíte completa: OK (3 tests, 5 assertions), código 0; novo cenário e dois
  exemplos anteriores passaram. Mesmas flags testdox/colors/sem cache de resultado.
- Diagnósticos SELECT depois: loja_test/loja_testes, somente migrations/produtos,
  zero produtos, migration lote 1/esquema preservados; ambiente normal
  loja/loja_app com um produto e uma migration.
- git diff --check passou; arquivos privados ignorados/fora do índice. Sem
  migration, seeder, instalação ou alteração de conta/credencial.
- Cobertura atual do catálogo: cenário sem produtos. Retorno de produto ativo,
  filtro de inativos e ordenação ainda sem cenários automatizados.

Entendimento da 5.41: confirmado com "entendi" em 19/10/2026.
Publicação da 5.41: checkpoint 94e4e3d publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 94e4e3dff652e5c76b74064b0e43b12f4d6573c6.
Próximo passo após a confirmação: 5.42,
acrescentar um cenário de produto ativo ao mesmo arquivo, compartilhando a
preparação isolada. Não antecipar outros cenários.

## Etapa 5.42 — Produto ativo no catálogo e preparação compartilhada

Data: 19/10/2026. Objetivo: verificar retorno de produto ativo e compartilhar
a preparação entre cenários. Aula em docs/aulas/05-42-teste-produto-ativo.md.

Implementação: apenas CatalogoEloquentTest.php alterado. setUp protegido/void
chama parent::setUp e executa as duas asserções de banco/login e DELETE antes
de cada teste. Cenário vazio preservado. Novo cenário usa Produto::create com
nome Camiseta, preco_em_centavos 4990 e status ativo; assertSame exige somente
['Camiseta'] de listarNomes. Sem alteração no serviço/model/configuração/migrations.

Explicação apresentada: setUp é um hook chamado pelo PHPUnit antes de cada
teste. parent::setUp preserva inicialização Laravel e início da transação pelo
trait; sua preparação vem depois. Cada teste recebe tabela vazia e tem rollback
próprio. Produto::create grava a fixture no SQL Server dentro da transação;
4990 centavos representam R$ 49,90. A consulta do catálogo relê o nome do banco.
Valor e tipo do array são comparados por assertSame. As conferências também contam como
asserções, duas por execução do setUp.

Verificações realizadas:

- php -l passou. Focado no arquivo: OK (2 tests, 6 assertions), código 0.
- Suíte completa com --order-by=reverse: OK (4 tests, 8 assertions), código 0.
  Casos de catálogo verificados em outra ordem além da execução focada.
- SELECT após a suíte: loja_test/loja_testes, zero produtos, migrations/produtos
  e histórico lote 1/esquema preservados. Registro inserido no cenário foi
  desfeito no rollback. Ambiente normal loja/loja_app com um produto e uma migration.
- git diff --check passou; arquivos privados ignorados/fora do índice.
  Sem nova dependência, migration, seeder, conta ou alteração de credencial.
- Cobertura atual: tabela sem produtos e um produto ativo. Filtro de inativos
  e ordenação ainda não têm seus cenários específicos.

Entendimento da 5.42: confirmado com "entendi" em 19/10/2026.
Publicação da 5.42: checkpoint aa8e5a4 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em aa8e5a4ed0e29cffd879ffa34f232ca271c633c2.
Próximo passo após a confirmação: 5.43,
adicionar cenário com um produto ativo e um inativo para verificar o filtro;
não antecipar o cenário de ordenação.

## Etapa 5.43 — Teste do filtro de produtos inativos

Data: 19/10/2026. Objetivo: verificar exclusão de inativos com produtos dos dois
estados presentes. Aula em docs/aulas/05-43-teste-filtro-inativos.md.

Implementação: somente um método acrescentado a CatalogoEloquentTest.php,
test_omite_produtos_inativos_do_catalogo. Produto::create cadastra Camiseta,
4990, ativo, e Caneca, 2990, inativo. Serviço real listarNomes deve retornar
exatamente ['Camiseta']. setUp, asserções de destino e DatabaseTransactions
reutilizados sem alteração; nenhum outro cenário adicionado.

Explicação apresentada: presença simultânea de ativo/inativo exercita o filtro
where('status', 'ativo') do serviço. assertSame do array completo verifica
inclusão da Camiseta e ausência da Caneca, sem exigir asserções separadas.
As duas inserções são reais no SQL Server e desfeitas pelo rollback. Retorno
com apenas um nome não verifica a ordenação entre vários produtos ativos.

Verificações realizadas:

- php -l passou. Focado no arquivo: OK (3 tests, 9 assertions), código 0.
- Suíte completa: OK (5 tests, 11 assertions), código 0. Cada cenário do
  catálogo tem duas asserções em setUp e uma de comportamento.
- SELECT separado após a suíte: loja_test/loja_testes com zero produtos e uma
  migration; loja/loja_app com um produto e uma migration. Rollback das fixtures
  conferido sem gravação no banco normal.
- git diff --check passou; arquivos privados ignorados/fora do índice.
  Serviço, model, configuração, migrations e preparação de testes preservados;
  sem instalação, seeder, conta nova ou alteração de credencial.

Entendimento da 5.43: confirmado com "entendi" em 19/10/2026.
Publicação da 5.43: checkpoint 62f465e publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 62f465e0d1c266d61fb534bb895e4968ac327276.
Próximo passo após a confirmação: 5.44,
adicionar um cenário com dois produtos ativos cadastrados fora da ordem alfabética
e exigir os nomes ordenados, sem antecipar outros cenários.

## Etapa 5.44 — Teste da ordenação dos nomes do catálogo

Data: 19/10/2026. Objetivo: verificar a ordem alfabética com dois ativos
cadastrados em outra sequência. Aula em docs/aulas/05-44-teste-ordenacao-catalogo.md.

Implementação: somente um método acrescentado a CatalogoEloquentTest.php,
test_retorna_nomes_em_ordem_alfabetica. Produto::create cadastra Caneca, 2990,
ativo, e depois Camiseta, 4990, ativo. assertSame exige ['Camiseta', 'Caneca']
de listarNomes. Serviço e preparação setUp/DatabaseTransactions preservados.

Explicação apresentada: dois produtos ativos permitem observar a ordem dos
nomes. Cadastro começa pela Caneca; a expectativa começa pela Camiseta.
assertSame compara conteúdo, tipo e ordem dos elementos do array. Caso protege
o comportamento de orderBy('nome') já implementado, sem alterar a consulta.
As duas inserções são desfeitas pelo rollback; cenários anteriores preservados.

Verificações realizadas:

- php -l passou. Focado no arquivo: OK (4 tests, 12 assertions), código 0.
- Suíte completa: OK (6 tests, 14 assertions), código 0. Cada cenário do
  catálogo executa duas asserções em setUp e uma de comportamento.
- SELECT separado após a suíte: loja_test/loja_testes com zero produtos e uma
  migration; loja/loja_app com um produto e uma migration.
- git diff --check passou; arquivos privados ignorados/fora do índice.
  Nenhuma mudança no serviço/model/configuração/migrations; sem instalação,
  seeder, nova conta ou alteração de credencial.
- Cenários atuais: tabela vazia, um ativo, exclusão de inativo e ordenação de
  dois ativos com os nomes Camiseta e Caneca.

Entendimento da 5.44: confirmado com "entendi" em 19/10/2026.
Publicação da 5.44: checkpoint 5810b26 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 5810b264a84a4d9f641c9eb8e98e8e166068d198.
Próximo passo após a confirmação: 5.45,
explicar factories para preparação de dados e gerar somente ProdutoFactory,
sem preencher atributos ou refatorar testes nessa etapa inicial.

## Etapa 5.45 — Estrutura da factory de Produto

Data: 19/10/2026. Objetivo: introduzir factories e gerar somente a estrutura
de ProdutoFactory. Aula em docs/aulas/05-45-estrutura-produto-factory.md.

Implementação: backend/database/factories/ProdutoFactory.php gerado por
make:factory ProdutoFactory --model=Produto em container backend temporário,
usuário 1000:1000, montagem gravável apenas em database/factories, sem mudar
Compose. Arquivo com namespace Database\\Factories, imports Produto/Factory,
@extends Factory<Produto>, método definition(): array e retorno [] com comentário.
Model Produto, factory User e testes preservados. Não adicionamos HasFactory.

Explicação apresentada: factory descreve dados padrão para montar models,
útil na preparação de testes e também utilizável por seeders. Migration define
estrutura; seeder executa cadastros; factory organiza a definição de atributos.
Gerar a classe não monta Produto nem insere linhas. namespace se relaciona ao
autoload Database\\Factories já configurado. extends herda recursos Laravel;
anotações @extends/@return são documentação para ferramentas. definition
retorna atributos padrão, ainda vazio. Associação ao Produto resolvida por
convenção de nomes e conferida com modelName; docblock não cria model em execução.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3, ajuda make:factory, stub e resolução modelName
  conferidos no Laravel instalado em Docker.
- Gerador terminou com código 0; container temporário removido. Arquivo dono
  1000:1000, permissão 644. Somente ProdutoFactory apareceu antes dos registros.
- php -l passou. Diagnóstico após bootstrap Laravel confirmou class_exists,
  herança de Factory, definition === [] e modelName === App\\Models\\Produto.
  Listener DB observou zero consultas na inspeção da factory; sem make/create.
- git diff --check passou; segredos continuam ignorados/fora do índice.
  Nenhuma dependência, migration, seeder, credencial ou dado alterado.
- Suíte da 5.44 não repetida: arquivo gerado ainda sem uso em aplicação/testes.
  Último resultado: 6 testes/14 asserções, registrado na etapa anterior.

Entendimento da 5.45: confirmado com "entendi" em 19/10/2026.
Publicação da 5.45: checkpoint 3e094e5 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 3e094e543b34f991c84bb05ac174e680f75471fe.
Próximo passo após a confirmação: 5.46,
preencher nome, preco_em_centavos e status na definição e conferir atributos
em memória. Não persistir models nem refatorar os testes nessa próxima etapa.

## Etapa 5.46 — Atributos padrão da factory de Produto

Data: 19/10/2026. Objetivo: preencher a definição e conferir seus arrays em
memória. Aula em docs/aulas/05-46-atributos-produto-factory.md.

Implementação: somente array de definition em ProdutoFactory.php alterado:
nome com fake()->words(3, true), preco_em_centavos com fake()->numberBetween(100,
50000) e status fixo ativo. Nenhum outro arquivo PHP alterado; factory ainda
não utilizada nos testes e model continua sem HasFactory.

Explicação apresentada: fake() fornece o gerador Faker já instalado; words
gera três palavras e true solicita texto em vez de array. numberBetween retorna
inteiro inclusivo entre 100 e 50000, valores em centavos (R$ 1,00 a R$ 500,00).
São padrões de dados fictícios, não validação de preço. Status ativo permanece
fixo. definition é método PHP que retorna atributos; chamadas podem variar os
valores gerados. Não há persistência ao apenas retornar esse array.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3 e implementações instaladas de fake/words/
  numberBetween conferidos em Docker. Nenhuma dependência adicionada.
- php -l passou. Diagnóstico chamou definition dez vezes, conferindo chaves
  nome/preco_em_centavos/status, nome string de três palavras até 150 caracteres,
  preço inteiro no intervalo e status ativo. Código 0.
- Exemplo fictício observado: nome "impedit reprehenderit qui", preço 20025,
  status ativo. É uma amostra variável, não um valor exigido por testes.
- Listener DB observou zero consultas; sem chamadas make/create, sem instanciar
  Produto ou executar migrations/seeders. Arrays somente em memória.
- git diff --check passou; arquivos privados ignorados/fora do índice.
  Model/testes/configurações preservados. Suíte ainda sem uso da factory não
  repetida; última execução da 5.44: 6 testes/14 asserções.

Entendimento da 5.46: confirmado com "entendi" em 19/10/2026 após esclarecer os métodos.
Dúvida recebida em 19/10/2026: se cada chamada da factory gera um registro.
Esclarecimento apresentado: instanciar a factory prepara o objeto da receita;
definition retorna array de atributos; make monta model em memória; create
persiste o model no banco. Implementações make/create/store conferidas no
framework instalado apenas por leitura. As dez chamadas feitas na 5.46 foram
a definition: dez arrays, nenhum registro. make/create explicados apenas para
responder à dúvida, sem execução ou avanço da etapa. Após esse esclarecimento,
aluno confirmou entendimento com "entendi" em 19/10/2026.
Publicação da 5.46: checkpoint 77dc3f9 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em 77dc3f9f60a4cb4ceabd699517064e38b76b0467.
Próximo passo após a confirmação: 5.47,
montar um Produto por ProdutoFactory::new()->make() e conferir atributos/estado
em memória, sem criar registros ou refatorar testes.

## Etapa 5.47 — Produto montado em memória pela factory

Data: 19/10/2026. Objetivo: usar make e distinguir array de atributos de model
em memória. Aula em docs/aulas/05-47-factory-make-produto.md.

Implementação: demonstração temporária em PHP Docker, recebendo --env=testing,
inicializou Laravel e executou ProdutoFactory::new()->make(). Nenhum arquivo de
aplicação alterado; somente registros da aula. Model continua sem HasFactory.

Explicação apresentada: new é método estático herdado de Factory, chamado com
::, que prepara a factory. make monta um model Produto com os atributos da
definição. Retorno agora é objeto Eloquent; permite ler nome, preço e status
como atributos. exists false e getKey null são estado dessa instância ainda
não salva, não uma consulta para procurar linha no banco. Datas continuam null
nesta montagem. Nenhuma chamada create/save executada.

Verificações realizadas:

- PHP 8.4.26/Composer 2.10.3 e implementações instaladas de new/makeInstance
  conferidos em Docker. Nenhuma dependência adicionada.
- Diagnóstico retornou instanceof Produto; nome string de três palavras até
  150 caracteres, preço int entre 100 e 50000, status ativo. Código 0.
- Amostra fictícia: nome "enim quaerat repellendus", preço 22479, status ativo.
  exists === false, getKey() === null e created_at/updated_at === null.
- Listener DB durante make observou zero consultas SQL; não houve persistência,
  migration ou seeder. Git limpo após publicar 5.46, antes destes novos registros.
- git diff --check passou; segredos ignorados/fora do índice. Aplicação, factory,
  model, testes e configuração preservados. Suíte sem uso da factory não repetida;
  último resultado na 5.44: 6 testes/14 asserções.

Entendimento da 5.47: confirmado com "entendi" em 19/10/2026.
Publicação da 5.47: checkpoint d90a8a4 publicado conforme autorização persistente;
HEAD, origin/main e main remota conferidos em d90a8a407413b93ec597019428abe28b23a2c45f.
Próximo passo após a confirmação: 5.48,
adicionar trait HasFactory ao model Produto e conferir o atalho
Produto::factory()->make() em memória. Sem persistência ou refatoração dos testes.

## Etapa 5.48 — Atalho de factory no model Produto

Data: 19/10/2026. Objetivo: disponibilizar Produto::factory e conferir make
em memória. Aula em docs/aulas/05-48-has-factory-produto.md.

Implementação: somente backend/app/Models/Produto.php alterado. Imports
Database\\Factories\\ProdutoFactory e Illuminate\\Database\\Eloquent\\Factories\\HasFactory;
na classe, @use HasFactory<ProdutoFactory> e use HasFactory, seguindo User.
Fillable, casts e demais arquivos PHP preservados; testes não refatorados.

Explicação apresentada: trait incorpora factory() estático ao model. Import
fora da classe resolve o nome; use dentro da classe incorpora métodos.
Comentário @use informa tipo ao editor/ferramentas, não resolve a factory em
execução. Laravel usa convenção de nomes Produto/ProdutoFactory. factory()
retorna a receita; make retorna model preenchido sem salvar nesta factory.
definition continua concentrando os atributos em ProdutoFactory.

Verificações realizadas:

- HasFactory/factoryForModel consultados no Laravel instalado em Docker.
- php -l de Produto.php passou. Diagnóstico confirmou trait presente,
  factory instanceof ProdutoFactory e make instanceof Produto; atributos
  previstos, preço int, status ativo, exists false, ID/datas null. Código 0.
- Amostra fictícia: nome "sequi et odit", preço 15187, ativo. Listener durante
  make observou zero SQL; nenhuma chamada create/save na demonstração.
- Suíte existente: OK (6 tests, 14 assertions), código 0. Inserções dos cenários
  anteriores continuaram isoladas pelas transações; nenhum teste alterado.
- SELECT após suíte: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration.
- git diff --check passou; segredos ignorados/fora do índice. Nenhuma nova
  dependência, migration, seeder, conta ou alteração de credencial.

Entendimento da 5.48: confirmado com "entendi" em 19/10/2026.
Dúvida recebida: onde foi usado `$produto = Produto::factory()->make();`?
Esclarecimento: somente na demonstração pelo script temporário
`/tmp/curso-548-atalho-factory.php`, enviado pela entrada padrão ao PHP do
container. O diagnóstico executou `$factory = Produto::factory();` e depois
`$produto = $factory->make();`; a expressão encadeada é equivalente. Nenhum
teste ou controller recebeu essa chamada. A alteração de código da 5.48 foi
adicionar HasFactory ao model. Dúvida respondida; entendimento confirmado em seguida.
Publicação da 5.48: d4657785aaa6b481cd241c3358b9f84a2ec437d6, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.49,
usar Produto::factory()->create somente no cenário de ativo, sobrescrevendo
nome/status e deixando o preço padrão. Conferir comportamento e rollback;
não converter os demais cenários nessa etapa.

## Etapa 5.49 — Factory no teste de produto ativo

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-49-factory-teste-produto-ativo.md.

Somente backend/tests/Feature/CatalogoEloquentTest.php alterado no código:
no método test_retorna_nome_do_produto_ativo, Produto::create foi substituído
por Produto::factory()->create. Array mantém nome Camiseta/status ativo;
preço explícito removido, recebendo inteiro padrão da ProdutoFactory.
AssertSame continua exigindo ['Camiseta']. Demais métodos preservados.

Explicação: factory resolve ProdutoFactory pelo HasFactory já apresentado;
definition fornece atributos, array de create sobrescreve os informados.
Create persiste no banco da conexão do model; configuração de testes e
checagens de banco/login do setUp mantêm o cenário em loja_test/loja_testes.
DatabaseTransactions desfaz a transação ao encerrar o teste. Nome/status
controlados tornam a expectativa estável; preço não participa da consulta.
Nenhum uso de make foi acrescentado ao teste.

Verificação em PHP Docker:
- PHPUnit filtrado pelo método alterado: OK (1 test, 3 assertions), código 0.
- Suíte completa: OK (6 tests, 14 assertions), código 0.
- SELECT após suíte: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration. Rollback conferido.
- git diff --check passou. Credenciais continuam ignoradas/fora do índice;
  sem nova migration, dependência ou serviço.

Entendimento da 5.49: confirmado com "entendi" em 19/10/2026.
Publicação da 5.49: 9a08b80eec48aad16cd233bdff2be54dc8ac3acc, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.50,
converter somente os dois cadastros do cenário ativo/inativo para factory create,
sobrescrevendo nome/status e conferindo resultado/rollback.

## Etapa 5.50 — Factory no cenário de ativo/inativo

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-50-factory-teste-inativos.md.

Somente backend/tests/Feature/CatalogoEloquentTest.php alterado no código,
no método test_omite_produtos_inativos_do_catalogo. Dois Produto::create
substituídos por Produto::factory()->create; preços explícitos removidos.
Nome/status continuam Camiseta/ativo e Caneca/inativo. A definição fornece
o preço; array passado a create substitui inclusive o status ativo padrão.
Cada chamada persiste um produto. CatalogoEloquent deve devolver ['Camiseta']
apesar de os dois registros existirem durante o cenário. Expectativa e
DatabaseTransactions preservados; cenário de ordenação ainda não convertido.

Verificações em PHP Docker:

- PHPUnit filtrado pelo método alterado: OK (1 test, 3 assertions), código 0.
- Suíte completa: OK (6 tests, 14 assertions), código 0.
- SELECT posterior: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration. Rollback conferido.
- git diff --check passou; credenciais ignoradas/fora do índice. Nenhuma nova
  migration, dependência, serviço ou alteração na definição da factory.

Entendimento da 5.50: confirmado com "entendi" em 19/10/2026.
Publicação da 5.50: 10e723b30cd8d6906c8a4be95800952c4ca8fb97, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.51,
converter somente os dois cadastros do cenário de ordenação para factory create,
preservando a ordem de inserção e a expectativa, e conferir resultado/rollback.

## Etapa 5.51 — Factory no cenário de ordenação

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-51-factory-teste-ordenacao.md.

Somente backend/tests/Feature/CatalogoEloquentTest.php alterado no código,
no método test_retorna_nomes_em_ordem_alfabetica. Dois Produto::create passaram
a Produto::factory()->create; preços explícitos removidos. Inserção continua
Caneca antes de Camiseta, ambas ativas. Expectativa continua exatamente
['Camiseta', 'Caneca'], conferindo conteúdo e ordem do resultado.

Explicação: nomes controlados são necessários para uma comparação previsível;
preços vêm da definição porque não afetam a consulta. CatalogoEloquent mantém
orderBy('nome'); HasFactory liga model e ProdutoFactory. Cada create persiste
um produto na transação do teste; rollback ao encerrar. Agora todos os cinco
cadastros do arquivo usam factory, sem alterar os demais cenários nesta etapa.

Verificações em PHP Docker:

- PHPUnit filtrado pelo método alterado: OK (1 test, 3 assertions), código 0.
- Suíte completa: OK (6 tests, 14 assertions), código 0.
- SELECT posterior: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration. Rollback conferido.
- git diff --check passou; credenciais ignoradas/fora do índice. Nenhuma nova
  dependência, migration, serviço ou alteração em model/factory/serviço.

Entendimento da 5.51: confirmado com "entendi" em 19/10/2026.
Publicação da 5.51: 5152ba47349add5d6cbfa150dc18e66b3c441c0b, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.52,
adicionar estado inativo em ProdutoFactory e conferir com make em memória,
mantendo aplicação desse estado aos testes para outra etapa.

## Etapa 5.52 — Estado inativo na factory

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-52-estado-inativo-factory.md.

Somente backend/database/factories/ProdutoFactory.php alterado no código.
Método público inativo(): static retorna $this->state(['status' => 'inativo']).
State herdado de Factory devolve uma nova instância com essa transformação;
definition e a factory original continuam com status ativo. O tipo static
descreve a instância da classe chamada, permitindo encadear make/create.
Inativo configura a receita; make monta Produto e create persiste.

Implementação de state e combinação de atributos consultadas no framework
instalado em Docker; nenhum novo pacote ou mudança de dependências.
Diagnóstico temporário /tmp/curso-552-estado-inativo.php enviado pela entrada
padrão ao PHP do container com --env=testing. Usa factory original, chama
inativo, monta um Produto de cada factory e verifica tipos, atributos e estado.
Não foi acrescentada chamada ao novo método em testes ou controllers.

Verificações em PHP Docker:

- php -l da factory passou.
- Diagnóstico: nova ProdutoFactory configurada; Produto inativo e padrão ativo;
  ambos exists false, ID/datas null, nome textual e preço inteiro no intervalo.
  Listener observou zero SQL; código 0.
- Suíte existente: OK (6 tests, 14 assertions), código 0. Não verifica o método
  novo diretamente; esse comportamento foi conferido pelo diagnóstico.
- SELECT posterior: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration.
- git diff --check passou; segredos continuam ignorados/fora do índice.

Entendimento da 5.52: confirmado com "entendi" em 19/10/2026.
Publicação da 5.52: edd34114bb9943bf6860a324368cee4739388d4e, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.53,
usar inativo()->create no cadastro da Caneca no cenário ativo/inativo,
mantendo nome explícito e conferindo resultado/rollback.

## Etapa 5.53 — Estado inativo aplicado ao teste

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-53-estado-inativo-no-teste.md.

Somente backend/tests/Feature/CatalogoEloquentTest.php alterado no código:
cadastro da Caneca em test_omite_produtos_inativos_do_catalogo passou a
Produto::factory()->inativo()->create(['nome' => 'Caneca']). Removido status
inativo do array, pois esse atributo vem do método inativo da ProdutoFactory.
Definition fornece atributos padrão, state substitui status, create usa nome
explícito e persiste. Cadastro da Camiseta e expectativa ['Camiseta'] preservados.
O teste agora verifica o estado em conjunto com a persistência e filtro reais.

Verificações em PHP Docker:

- PHPUnit filtrado pelo método alterado: OK (1 test, 3 assertions), código 0.
- Suíte completa: OK (6 tests, 14 assertions), código 0.
- SELECT posterior: loja_test/loja_testes com zero produtos e uma migration;
  loja/loja_app com um produto e uma migration. Rollback conferido.
- git diff --check passou; segredos ignorados/fora do índice. Sem nova migration,
  dependência, serviço ou alteração em factory/model/serviço.

Entendimento da 5.53: confirmado com "entendi" em 19/10/2026.
Publicação da 5.53: 6ac5518805ab2706980570b94375e82ba495c2ee, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.54,
apresentar DatabaseSeeder existente, distinguir seeders/factories/migrations e
analisar dependências sem executar db:seed.

## Etapa 5.54 — Leitura do DatabaseSeeder existente

Explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-54-leitura-database-seeder.md. Nenhuma alteração no código da aplicação;
somente documentação nesta etapa.

DatabaseSeeder gerado em database/seeders foi apresentado: namespace, imports
User/WithoutModelEvents/Seeder, herança, trait que desativa eventos de model na
execução normal do seeder e run(): void. Linha User::factory(10)->create está
comentada; cadastro executável usa UserFactory com nome/email fictícios fixos.
Explicada a relação com User/HasFactory, atributos restantes de UserFactory e
migration de users. Não aprofundamos autenticação ou dependências externas.

Distinção apresentada: migration define estrutura, factory fornece atributos
e pode montar/salvar models, seeder organiza a rotina de população de dados.
Db:seed é o comando de execução do seeder; não foi executado. Seeders não ganham
automaticamente o rollback que nossos testes têm com DatabaseTransactions.

Verificações em PHP Docker:

- php -l do DatabaseSeeder passou.
- Reflexão confirmou herança de Seeder e método run público/void, sem invocá-lo.
- SELECT de identidade e sys.tables confirmou loja/loja_app e
  loja_test/loja_testes com somente migrations/produtos, sem users.
  O cadastro padrão depende da tabela users, ainda ausente.
- Diagnóstico /tmp/curso-554-inspecionar-seeder.php enviado pela entrada padrão
  ao PHP do container, com e sem --env=testing; código 0 nas duas execuções.
- WithoutModelEvents, Seeder::__invoke e resolução no SeedCommand consultados
  no Laravel instalado. Nenhum INSERT, migration ou db:seed executado.
- git diff --check passou; segredos ignorados/fora do índice. Suíte não repetida
  para leitura/documentação; último resultado 6/14 pertence à etapa 5.53.

Entendimento da 5.54: confirmado com "entendi" em 19/10/2026, após nova explicação.
Dúvida recebida: "não entendi, seja mais claro". Explicação reapresentada com
exemplo da loja: factory guarda atributos padrão; seeder reúne comandos de
cadastro e pode usar a factory. Exemplo hipotético de run cadastrando Camiseta
e Caneca com Produto::factory()->create, sem implementação/execução. Destacado
que create salva em ambos os contextos; nos testes há rollback pelo trait,
enquanto a rotina de seeding pode deixar exemplos cadastrados. Migration cria
a estrutura necessária. O aluno confirmou entendimento com "entendi" em seguida.
Publicação da 5.54: def2f14508754ed2d6e9fafb290f4378a5de87c3, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Correção do próximo passo: a indicação de gerar ProdutoSeeder novamente estava
incorreta; arquivo já gerado na 5.20 e preenchido nas etapas seguintes. Na 5.55,
revisar o seeder existente e sua relação com DatabaseSeeder, sem sobrescrever.

## Etapa 5.55 — Revisão do ProdutoSeeder existente

Explicação e verificação em 19/10/2026. Detalhes em
docs/aulas/05-55-produto-seeder-existente.md. Nenhuma alteração no código.

Antes de gerar um arquivo, inspeção encontrou ProdutoSeeder já versionado.
Histórico conferido: e811031 gerou estrutura na 5.20, 9da189c escreveu cadastro
na 5.21 e 162b7aa introduziu firstOrCreate na 5.24. Aulas 5.20/5.24/5.25
consultadas. Corrigido plano de geração, preservando implementação e confirmações.

Explicação reapresentada: ProdutoSeeder estende Seeder, importa Produto e usa
run para buscar Camiseta pelo primeiro array de firstOrCreate. Se ausente,
cadastra com preço 4990/status ativo do segundo array; se existente, reutiliza
sem atualizar os atributos. Um seeder pode usar Eloquent diretamente, sem
factory. DatabaseSeeder atual ainda não chama ProdutoSeeder: arquivos existentes
não são executados automaticamente só por estarem em database/seeders.
Comando --class=ProdutoSeeder já foi usado na 5.22/5.25 para seleção explícita;
nenhuma nova execução nesta etapa.

Verificação: php -l database/seeders/ProdutoSeeder.php em Docker passou, código 0.
Nenhum run, db:seed, INSERT ou SELECT executado; nenhum model/tabela/dado alterado.
Suíte não repetida para leitura/documentação. git diff --check passou; segredos
continuam ignorados/fora do índice.

Entendimento da 5.55: confirmado com "entendi" em 19/10/2026.
Publicação da 5.55: 0f754aec08f491a658aac7d24f5150bbfefcf774, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.56,
substituir exemplo User em DatabaseSeeder por chamada a ProdutoSeeder com call,
explicando o encadeamento sem executar db:seed nessa etapa.

## Etapa 5.56 — DatabaseSeeder chama ProdutoSeeder

Implementação, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-56-database-seeder-chama-produto.md.

Somente backend/database/seeders/DatabaseSeeder.php alterado no código:
removido import de User, comentário de factory de dez usuários e cadastro
de exemplo. Run agora chama $this->call([ProdutoSeeder::class]); imports de
Seeder/WithoutModelEvents e trait preservados. ProdutoSeeder continua intacto.

Explicação: $this é DatabaseSeeder; call herdado de Seeder resolve e invoca os
seeders listados. ::class fornece nome completo da classe, sem instanciar ou
executar por si só. Ambos estão no namespace Database\Seeders, dispensando
import adicional para ProdutoSeeder. Ao executar a entrada padrão, o fluxo
passará de DatabaseSeeder a ProdutoSeeder e sua busca/cadastro de Camiseta.
WithoutModelEvents desativa eventos durante esse fluxo normal. Factory não é
usada pelo ProdutoSeeder atual; cadastro continua por firstOrCreate.

Verificações em PHP Docker:

- Implementação de Seeder::call consultada no framework instalado.
- php -l DatabaseSeeder.php passou, código 0.
- Diagnóstico pela entrada padrão, sem inicializar app ou chamar run: autoload,
  herança de Seeder e run público/void confirmados para as duas classes.
  ::class imprimiu Database\Seeders\ProdutoSeeder. Código 0.
- Nenhum db:seed, run, SELECT ou INSERT executado. Verificação de estrutura não
  comprova execução/cadastro: isso está reservado à próxima etapa após confirmação.
- git diff --check passou; segredos ignorados/fora do índice. Sem nova dependência,
  migration, serviço ou teste. Suíte não repetida para essa ligação simples.

Entendimento da 5.56: confirmado com "entendi" em 19/10/2026.
Publicação da 5.56: 07af1238a439706caa32d5f543c26bdfd16f88d2, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.57,
executar db:seed padrão em loja_test dentro de transação acompanhada de rollback,
conferindo encadeamento e contagens sem deixar produtos no banco de testes.

## Etapa 5.57 — Execução do seeder padrão com rollback

Execução, explicação e verificações em 19/10/2026. Detalhes em
docs/aulas/05-57-executar-seeder-padrao.md. Nenhum código da aplicação alterado.

Diagnóstico temporário /tmp/curso-557-executar-seeder-padrao.php inicializou
Laravel em PHP Docker com --env=testing. Conferiu ambiente, conexão sqlsrv,
identidade loja_test/loja_testes, zero produtos/uma migration e nenhuma transação
aberta antes de iniciar. BeginTransaction envolveu kernel->call('db:seed', ...)
com --database=sqlsrv/--no-interaction/--no-ansi, sem --class. Finally chamou
rollBack. Esse isolamento vem do diagnóstico, não do db:seed por padrão.

Verificações:

- Implementação de SeedCommand consultada para conferir uso da conexão.
- Saída do Artisan mostrou ProdutoSeeder RUNNING/DONE via DatabaseSeeder.
  Retorno do comando 0; listener observou um INSERT na tabela produtos.
- Dentro da transação: um Produto Camiseta/4990/ativo, exists true, ID/datas
  presentes; CatalogoEloquent retornou exatamente ['Camiseta'].
- Após rollback: zero produtos, uma migration e zero transações abertas.
  Identidades numéricas do SQL Server não são prometidas como reutilizáveis
  após rollback; verificação trata de linhas, não de zerar contadores internos.
- SELECTs em processos separados: loja_test/loja_testes com zero produtos e
  loja/loja_app com um produto; uma migration em cada banco. Código 0.
- Nenhum db:seed no banco normal. Nenhuma migration ou configuração alterada.
- git diff --check passou; segredos ignorados/fora do índice. Suíte não repetida
  após verificação dirigida; último resultado 6/14 pertence à 5.53.

Entendimento da 5.57: confirmado com "entendi" em 19/10/2026.
Publicação da 5.57: 5c65e6d26394b8ac231addbecf80a10eb54257a0, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.58,
apresentar categorias e relação um para muitos com produtos, explicando chave
estrangeira na modelagem, sem criar tabelas/models nessa etapa.

## Etapa 5.58 — Modelagem de categorias e produtos

Explicação e revisão da modelagem em 19/10/2026. Detalhes em
docs/aulas/05-58-modelagem-categorias-produtos.md. Somente documentação alterada.

Problema: agrupar produtos por categoria. Modelo inicial de um para muitos:
uma categoria pode reunir vários produtos; cada produto categorizado pertence
a uma categoria. Exemplo ilustrativo: categorias 1/Roupas e 2/Acessórios;
Camiseta/Calça referenciam 1 e Caneca referencia 2 por categoria_id.
Esses IDs/nomes são exemplos, não resultado de consultas ou cadastros.

Explicadas chave primária categorias.id e referência produtos.categoria_id.
Chave estrangeira, quando implementada, verificará existência da categoria
referenciada. Número sozinho não cria essa restrição. Nome da categoria fica
na tabela de categorias; mudar esse nome não exige alterar cada produto.
Obrigatoriedade/transição de produtos antigos e exclusão de categorias serão
definidas nas etapas de alteração do esquema; não foram implementadas aqui.

Verificação: model e migration atuais de Produto inspecionados, sem categoria_id
ou relacionamento. Pastas de models/migrations conferidas antes de planejar nova
migration; nenhum arquivo de categorias encontrado. Revisão dos exemplos e
git diff --check passaram. Nenhum SQL, teste ou comando de geração nesta etapa.
Segredos continuam ignorados/fora do índice.

Entendimento da 5.58: confirmado com "entendi" em 20/10/2026.
Publicação da 5.58: f680b996432bcb9b8f549d793a79673e90ce847b, conforme autorização
persistente; HEAD, origin/main e main remota conferidos em 20/10/2026 após o push.
Próximo passo após confirmação: 5.59,
preparar migration create_categorias_table com id, nome e timestamps, explicar
up/down e conferir sintaxe, sem aplicar ainda nem alterar produtos/model.

## Etapa 5.59 — Migration de categorias preparada

Implementação, explicação e verificação em 20/10/2026. Detalhes em
docs/aulas/05-59-migration-categorias.md.

Único arquivo de código adicionado:
backend/database/migrations/2026_10_20_113601_create_categorias_table.php.
Gerado com make:migration create_categorias_table --create=categorias em container
temporário do serviço backend, usuário 1000:1000 e bind rw somente de migrations.
Comando código 0; dono local 1000:1000 e modo 644. Compose preservado.

Migration gerada já tinha up/down, id e timestamps. Acrescentado nome string(150)
e timestamps ajustados para (3), conforme precisão dos produtos. Explicados
imports Migration/Blueprint/Schema, classe anônima, callback e métodos:
up descreve criação, down descreve remoção. Nome obrigatório no esquema, sem
unique nesta etapa; timestamps anuláveis e preenchidos pelo Eloquent ao persistir,
não pelo simples fato de a migration existir. ID identifica a categoria.

Verificação: ajuda do gerador consultada no Artisan instalado; php -l da migration
passou em Docker, código 0. Revisão dos trechos e git diff --check passaram.
Nenhum migrate, rollback, INSERT ou SELECT executado. Sintaxe não comprova
aplicação no SQL Server; estrutura/status serão conferidos na etapa seguinte.
Sem alteração de produtos, model, factory, seeder, dependência ou serviço.
Segredos continuam ignorados/fora do índice. Suíte não repetida para arquivo ainda
não aplicado; último resultado 6/14 continua identificado como histórico da 5.53.

Entendimento da 5.59: confirmado com "entendi" em 20/10/2026.
Publicação da 5.59: 9e890107b1a50c90c9df00e717875bb627425317, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.60,
aplicar somente migration de categorias em loja_test e conferir estrutura/status,
sem alterar produtos nem aplicar migrations geradas de users/cache/jobs.

## Etapa 5.60 — Categorias criada no banco de testes

Aplicação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-60-categorias-banco-testes.md. Nenhum código da aplicação alterado.

Antes da aplicação, diagnóstico temporário /tmp/curso-560-antes-categorias.php
em PHP Docker confirmou testing/sqlsrv, loja_test/loja_testes/loja_testes,
CREATE TABLE e ALTER dbo permitidos, somente migrations/produtos, zero produtos
e uma migration de produtos no lote 1. Consulta normal confirmou loja/loja_app
com um produto e uma migration. Somente SELECTs nessa preparação.

Comando aplicado: migrate com --env=testing, --database=sqlsrv e
--path=database/migrations/2026_10_20_113601_create_categorias_table.php,
--no-interaction/--no-ansi. Código 0, migration DONE. Não aplicou outros arquivos.
Explicados ambiente, nome de conexão, caminho relativo a /app e opções de saída.

Verificações:

- migrate:status com mesmo ambiente/conexão/path retornou [2] Ran, código 0.
- Repetição do mesmo migrate retornou Nothing to migrate, código 0.
- Diagnóstico /tmp/curso-560-depois-categorias.php consultou sys.tables,
  sys.columns, sys.types, sys.indexes e histórico: somente categorias/migrations/
  produtos; zero categorias e zero produtos; duas entradas em migrations.
  Produtos continua lote 1, categorias está no lote 2.
- Colunas: id BIGINT não nulo IDENTITY e PK; nome NVARCHAR(150) não nulo;
  created_at/updated_at DATETIME2(3) anuláveis. Código 0.
- Consulta separada normal: loja/loja_app, um produto/uma migration. Nenhuma
  escrita nesse banco. Sem categorias cadastradas, seeder ou categoria_id ainda.
- git diff --check passou; segredos ignorados/fora do índice. Suíte não repetida
  após verificação dirigida de DDL/histórico; último resultado 6/14 é da 5.53.

Entendimento da 5.60: confirmado com "entemdi" em 20/10/2026.
Publicação da 5.60: 04ab6bb0f86c833a08e6582ee2634594aa072dab, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.61,
aplicar somente migration de categorias em loja com conta loja_migracoes,
conferir esquema/histórico e preservar o produto existente.

## Etapa 5.61 — Categorias criada no banco da aplicação

Aplicação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-61-categorias-banco-aplicacao.md. Nenhum código da aplicação alterado.

Diagnóstico temporário /tmp/curso-561-categorias-loja.php enviado ao PHP Docker
pela entrada padrão, sem --env=testing. Conferiu default sqlsrv, identidade
loja/loja_migracoes/loja_migracoes da conexão sqlsrv_migracoes, permissões de
criar tabela/alterar dbo e identidade loja/loja_app da conexão normal.
Antes: somente migrations/produtos, uma migration no lote 1 e um produto.
As seis colunas do produto e OBJECT_ID de produtos foram guardados em memória.

Kernel->call('migrate') recebeu --database=sqlsrv_migracoes e --path apenas da
migration de categorias, --no-interaction/--no-ansi. Não alteramos .env ou conta
padrão; credenciais existentes foram usadas sem exibição. Código 0, DONE.

Verificações:

- migrate:status mostrou [2] Ran; reexecução retornou código 0 e diagnóstico
  validou Nothing to migrate. Histórico com produtos no lote 1/categorias no lote 2.
- Metadados: categorias com id BIGINT IDENTITY/PK, nome NVARCHAR(150) obrigatório
  e datas DATETIME2(3) anuláveis. Somente categorias/migrations/produtos.
- Categorias vazia nas conexões de migrations e da aplicação. Leitura loja_app
  passou; configuração default continua sqlsrv.
- Produto id/nome/preço/status/created_at/updated_at iguais à cópia anterior;
  OBJECT_ID de produtos preservado. Nenhum seeder ou cadastro executado.
- Consulta separada com loja_testes confirmou loja_test, categorias/produtos
  vazios e duas migrations, estrutura preservada. Código 0 nas execuções.
- git diff --check passou; segredos ignorados/fora do índice. Suíte não repetida
  após verificação dirigida de esquema/preservação; último 6/14 é da 5.53.

Entendimento da 5.61: confirmado com "entendi" em 20/10/2026.
Publicação da 5.61: 4d3358d249ecb19e25cf560ba3797895d9620220, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.62,
criar somente model Categoria com nome permitido para preenchimento, explicar
tabela/timestamps e conferir sem persistir categorias ou definir relações ainda.

## Etapa 5.62 — Model Categoria preparado

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-62-model-categoria.md.

Único arquivo de código adicionado: backend/app/Models/Categoria.php. Gerado por
make:model Categoria em PHP Docker, container temporário com usuário 1000:1000
e escrita somente em app/Models. Código 0; dono local, modo 644. Adicionado
import de Attributes\Fillable e #[Fillable(['nome'])]; classe estende Model.

Explicados namespace, import, herança e atributo PHP. Fillable permite preencher
nome por array, não valida conteúdo/tamanho nem preenche outros campos por
esse array. Eloquent associa automaticamente Categoria à tabela categorias,
chave id e timestamps; não foi necessário configurar $table ou casts.
Migration criou a estrutura; model representa/manipula registros em PHP.

Verificações em PHP Docker:

- php -l Categoria.php passou.
- Diagnóstico temporário /tmp/curso-562-model-categoria.php, enviado pela entrada
  padrão com --env=testing, confirmou autoload/herança, tabela categorias, chave
  id/int/incremental, timestamps habilitados e nomes created_at/updated_at.
- new Categoria(['nome' => 'Roupas']) preencheu nome em memória. Fillable apenas
  nome; id não permitido nesse preenchimento. Exists false, ID/datas null,
  listener com zero SQL. Código 0.
- git diff --check passou; segredos ignorados/fora do índice. Nenhum cadastro,
  migration, factory, relação, dependência ou serviço novo. Suíte não repetida
  para model novo ainda não usado pelos cenários; último 6/14 é da 5.53.

Entendimento da 5.62: confirmado com "entendi" em 20/10/2026.
Publicação da 5.62: e57dbbe889c9dd8c7360c69ce9737a5fd203d679, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.63,
demonstrar cadastro/leitura de Categoria em loja_test dentro de transação com
rollback, conferindo ID/datas e contagens, sem cadastro no banco normal.

## Etapa 5.63 — Cadastro e leitura de Categoria com rollback

Execução, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-63-cadastro-leitura-categoria.md. Nenhum código da aplicação alterado.

Diagnóstico temporário /tmp/curso-563-cadastrar-categoria.php inicializou Laravel
em PHP Docker com --env=testing. Antes do cadastro, conferiu ambiente/sqlsrv,
loja_test/loja_testes, categorias/produtos vazios, duas migrations e nenhuma
transação aberta. Executou dentro de beginTransaction/try/finally/rollBack:
Categoria::create(['nome' => 'Roupas']) e Categoria::findOrFail($categoria->id).

Explicação: create preenche nome conforme Fillable, insere no banco e retorna
model persistido. SQL Server gera ID; Eloquent preenche created_at/updated_at.
FindOrFail consulta pela chave primária e retorna model ou lança exceção se
ausente. A leitura retornou outro objeto com mesmo ID/nome; não reutilizou a
instância anterior. Rollback pertence à demonstração, não é automático de create.

Verificações:

- Um INSERT em categorias observado; uma linha durante a transação.
- Amostra: Roupas, ID 1, exists true e datas preenchidas no model cadastrado e
  lido. Novo objeto de leitura com ID/nome iguais. Código 0.
- Após rollback: zero categorias/zero produtos, duas migrations, zero transações
  abertas. Não prometida reutilização de ID após rollback.
- /tmp/curso-563-resumo-bancos.php em processos separados: loja_test/loja_testes
  0 categorias/0 produtos/2 migrations; loja/loja_app 0 categorias/1 produto/2
  migrations. Somente SELECTs no banco normal. Código 0.
- git diff --check passou; segredos ignorados/fora do índice. Nenhuma migration,
  factory ou relação criada. Suíte não repetida após demonstração dirigida;
  último resultado 6/14 é da 5.53.

Entendimento da 5.63: confirmado com "entendi" em 20/10/2026.
Publicação da 5.63: ce678868ac122c51816f47c63de1ae58d8ea582c, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.64,
preparar migration para categoria_id anulável em produtos com chave estrangeira
para categorias, explicar regra de exclusão/preservação e conferir sem aplicar ainda.

## Etapa 5.64 — Migration de categoria_id preparada

Implementação, explicação e verificação em 20/10/2026. Detalhes em
docs/aulas/05-64-migration-categoria-produto.md.

Único arquivo de código adicionado:
backend/database/migrations/2026_10_20_120347_add_categoria_id_to_produtos_table.php.
Gerado com make:migration add_categoria_id_to_produtos_table --table=produtos,
em PHP Docker, container temporário/usuário 1000:1000 e escrita somente em migrations.
Código 0, dono local/modo 644. Migrations já aplicadas não foram alteradas.

Up usa Schema::table, foreignId('categoria_id'), nullable antes de constrained,
constrained('categorias') referenciando id, e noActionOnDelete. Explicados tipo
compatível com categorias.id, NULL para produtos sem categoria e verificação de
categoria existente quando ID preenchido. Exclusão da categoria será impedida
enquanto houver produtos referenciando-a; não há exclusão em cascata nem remoção
automática da associação. Down usa dropConstrainedForeignId, que remove a FK
antes de remover a coluna, preservando a tabela produtos.

Verificação: constrained, noActionOnDelete e dropConstrainedForeignId consultados
no Laravel instalado em Docker; php -l da migration passou, código 0. Revisão dos
trechos e git diff --check passaram. Nenhum migrate, up/down ou SQL executado.
Aplicação/comportamento real da restrição ainda não verificados no SQL Server.
Sem alterações em models/factories/seeders. Segredos ignorados/fora do índice;
suíte não repetida para arquivo ainda não aplicado, último 6/14 pertence à 5.53.

Entendimento da 5.64: confirmado com "entendi" em 20/10/2026.
Publicação da 5.64: e5e6156e28addc7f723d900d7953c20a267a9d8a, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo planejado após confirmação: 5.65,
aplicar somente esta migration em loja_test, conferir coluna/FK/nulabilidade/
histórico e executar suíte existente, sem aplicar em loja nessa etapa.

## Etapa 5.65 — Tentativa da FK e permissão REFERENCES

Tentativa, descoberta e verificações em 20/10/2026. Detalhes em
docs/aulas/05-65-permissao-references.md. Nenhum código da aplicação alterado.

Antes: diagnóstico /tmp/curso-565-conferir-categoria-id.php com --env=testing e
--antes confirmou loja_test/loja_testes, ALTER dbo permitido, categoria_id/FK
ausentes, categorias/produtos vazios e duas migrations. Consulta normal 0/1/2.

Executado migrate com --env=testing, --database=sqlsrv e --path apenas de
2026_10_20_120347_add_categoria_id_to_produtos_table.php. Falhou, código 1:
REFERENCES permission denied em loja_test.dbo.categorias. A falha ocorreu no
ALTER TABLE que criaria a chave estrangeira. Comandos seguintes encadeados
com &&, incluindo a suíte, não foram executados.

Explicação: ALTER sobre produtos permite alterar a tabela, mas criar uma FK
também exige REFERENCES na tabela referenciada. Isso não equivale a SELECT,
CREATE TABLE ou ALTER. A permissão pode ser limitada a dbo.categorias no banco
exclusivo de testes; não é necessário ampliar para db_owner/sysadmin.

Conferências após falha:

- Repetido diagnóstico --antes passou: coluna/FK ausentes; categorias/produtos
  vazios e duas migrations, portanto nenhuma alteração parcial ficou aplicada.
- migrate:status retornou Pending, código 0. Arquivo não registrado como aplicado.
- Consulta normal: loja/loja_app, zero categorias/um produto/duas migrations.
- HAS_PERMS_BY_NAME('dbo.categorias', 'OBJECT', 'REFERENCES') retornou 0 para
  loja_testes em loja_test e loja_migracoes em loja. Somente SELECTs nessas consultas.
- Nenhuma concessão executada. Suíte NÃO executada nesta etapa; último 6/14 é da
  5.53. Aplicação da FK e execução da suíte permanecem pendentes.
- git diff --check passou; segredos ignorados/fora do índice. Migration preservada.

Entendimento da 5.65: confirmado com "entendi" em 20/10/2026, quanto à descoberta/permissão.
Publicação da 5.65: 91ed88437740d62dcfdc824631848195425267de, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.66,
preparar SQL público para GRANT REFERENCES apenas em loja_test.dbo.categorias
ao usuário loja_testes, explicar escopo e não executar nessa etapa de preparação.
Depois será necessário aplicar a concessão, repetir a migration e executar suíte.

## Etapa 5.66 — Script de REFERENCES preparado

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-66-script-references-testes.md.

Único arquivo funcional adicionado:
docker/sqlserver/conceder-references-categorias-testes.sql. Destinado ao sqlcmd,
contém :ON ERROR EXIT, USE [loja_test], GO e GRANT REFERENCES ON OBJECT::[dbo].
[categorias] TO [loja_testes], seguido de GO. Sem credenciais ou novos usuários.
Explicados contexto do banco, permissão, escopo de objeto, esquema/tabela e usuário.
Não concede privilégios de administração ou permissão no banco normal.

Verificações:

- Entrada temporária /tmp/curso-566-parse-references.sql envolveu o arquivo
  integral com SET PARSEONLY ON/OFF em lotes separados. Sqlcmd dentro do serviço
  SQL Server analisou sintaxe, código 0. Não compila/executa GRANT nesta análise.
- Autenticação administrativa usou variável já existente do container via
  SQLCMDPASSWORD, sem exibir senha. Arquivo público não exige valor secreto próprio.
- /tmp/curso-566-conferir-permissao.php em PHP Docker com/sem --env=testing:
  REFERENCES continua 0 para loja_testes em loja_test e loja_migracoes em loja.
  Zero categorias, teste zero produtos/duas migrations; normal um produto/duas
  migrations. Categoria_id ausente nos dois bancos. Código 0.
- Migrate:status no teste confirmou Pending, código 0. Nenhuma migration ou
  suíte executada nesta etapa; último 6/14 continua identificado como histórico.
- git diff --check passou; segredos ignorados/fora do índice. Nenhum GRANT aplicado.

Entendimento da 5.66: confirmado com "entendi" em 20/10/2026.
Publicação da 5.66: 39246132a84eb2b331cfa828e13a2454a3067f28, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.67,
aplicar este script somente em loja_test, conferir REFERENCES efetivo e repetir
apenas migration de categoria_id e suíte existente, verificando FK/histórico/
contagens. Permissão/FK do banco normal continuam para outra etapa.

## Etapa 5.67 — REFERENCES e FK aplicadas no banco de testes

Aplicação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-67-references-fk-testes.md. Nenhum código da aplicação alterado.

Antes: diagnóstico --antes da 5.65 confirmou loja_test/loja_testes, coluna/FK
ausentes e categorias/produtos vazios, duas migrations. Sqlcmd no serviço SQL
Server executou diretamente o script conceder-references-categorias-testes.sql,
sem PARSEONLY, autenticando sa via variável interna SQLCMDPASSWORD. Código 0.

Diagnóstico /tmp/curso-567-conferir-references.php autenticado como loja_testes
conferiu REFERENCES efetivo 1 e sys.database_permissions com GRANT explícito
somente no objeto dbo.categorias para esse usuário. Código 0.

Executada migration de categoria_id com --env=testing, --database=sqlsrv e
--path apenas do arquivo, --no-interaction/--no-ansi: DONE, código 0.
Migrate:status retornou [3] Ran, código 0. Resolvida a pendência da tentativa 5.65.

Verificações:

- Suíte completa em PHP Docker: OK (6 tests, 14 assertions), código 0.
- Diagnóstico pós-migration da 5.65 confirmou categoria_id BIGINT NULL sem
  IDENTITY e FK produtos_categoria_id_foreign para dbo.categorias.id;
  is_disabled/is_not_trusted = 0/0 e DELETE/UPDATE NO_ACTION.
- Histórico: produtos lote 1, categorias lote 2, categoria_id lote 3.
- Após testes, categorias/produtos vazios em loja_test; três migrations.
- Consultas separadas: normal loja/loja_app continua zero categorias/um produto/
  duas migrations, sem categoria_id. Loja_migracoes continua REFERENCES 0.
- A suíte verifica catálogo e compatibilidade dos cadastros sem categoria;
  ainda não testa IDs inválidos ou exclusão de categoria em uso.
- git diff --check passou; segredos ignorados/fora do índice. Nenhum GRANT,
  migration, cadastro ou mudança de conta da aplicação no banco normal.

Entendimento da 5.67: confirmado com "entendi" em 20/10/2026.
Publicação da 5.67: e384ae163143380a1bd17764cdeb92786ed8c38c, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.68,
preparar/aplicar GRANT REFERENCES somente em loja.dbo.categorias para
loja_migracoes, aplicar a mesma migration por sqlsrv_migracoes e conferir
produto existente preservado com categoria_id NULL.

## Etapa 5.68 — REFERENCES e FK aplicadas no banco da aplicação

Implementação, aplicação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-68-references-fk-aplicacao.md.

Único arquivo funcional adicionado:
docker/sqlserver/conceder-references-categorias-migracoes.sql. Mesmo formato
do script de testes, com USE loja e GRANT REFERENCES em dbo.categorias para
loja_migracoes. Explicado escopo e manutenção da conta da aplicação.

Antes: diagnóstico normal confirmou loja/loja_migracoes sem REFERENCES,
zero categorias/um produto/duas migrations e categoria_id ausente. Sqlcmd no
serviço SQL Server executou o novo arquivo com senha existente via variável,
sem exibição. Código 0. Nenhuma mudança de credencial ou função administrativa.

Diagnóstico temporário /tmp/curso-568-aplicar-fk-loja.php em PHP Docker normal:
conferiu loja/loja_migracoes, REFERENCES 1 e GRANT explícito no objeto; loja/loja_app
e default sqlsrv. Guardou em memória seis colunas do produto e OBJECT_ID da tabela.
Kernel->call migrate recebeu --database=sqlsrv_migracoes e --path apenas do arquivo
de categoria_id, --no-interaction/--no-ansi. DONE, código 0; status [3] Ran.

Verificações:

- Categoria_id BIGINT NULL sem IDENTITY; FK produtos_categoria_id_foreign para
  dbo.categorias.id, DELETE/UPDATE NO_ACTION, habilitada/confiável.
- Produto preservado em id/nome/preço/status/created_at/updated_at e categoria_id
  NULL lido por loja_app. OBJECT_ID da tabela produtos e default sqlsrv preservados.
- Zero categorias/um produto/três migrations em loja, lotes 1/2/3 preservados.
- Consulta separada da 5.65 no banco de testes confirmou FK/coluna/histórico e
  contagens 0 categorias/0 produtos/3 migrations. Código 0 em todas as execuções.
- Nenhum seeder ou cadastro executado; nenhuma migration/model alterado.
- git diff --check passou; segredos ignorados/fora do índice. Suíte não repetida
  após alteração apenas no banco normal e verificações dirigidas de preservação;
  último 6/14 pertence à 5.67.

Entendimento da 5.68: confirmado com "entendi" em 20/10/2026.
Publicação da 5.68: 55f7ea8a8f137dc60d9da6c6109799855f1b11b1, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.69,
adicionar categoria_id ao Fillable de Produto e método categoria() com belongsTo,
conferindo configuração sem gravar dados nem adicionar relação inversa ainda.

## Etapa 5.69 — Produto pertence a Categoria no Eloquent

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-69-produto-belongs-to-categoria.md.

Somente backend/app/Models/Produto.php alterado no código: categoria_id no
Fillable, import Relations\BelongsTo e método público categoria(): BelongsTo,
retornando $this->belongsTo(Categoria::class). HasFactory/cast de preço preservados.

Explicação: Fillable permite preencher o ID pelo array; FK verifica integridade
ao gravar. Método descreve relacionamento de produto para categoria; retorna
objeto BelongsTo e não busca um registro só por construir essa configuração.
Categoria::class fornece nome completo do model no mesmo namespace, sem import
adicional. Pelo nome categoria(), Eloquent usa categoria_id em produtos e id em
categorias. Relação inversa e acesso por propriedade ficam para etapas posteriores.

Verificações em PHP Docker:

- HasRelationships::belongsTo consultado no framework instalado: nome do método
  determina coluna de referência; ownerKey vem da chave primária relacionada.
- php -l Produto.php passou.
- Diagnóstico /tmp/curso-569-configurar-belongs-to.php, com --env=testing, montou
  Produto em memória com categoria_id 10 ilustrativo, preencheu pelo Fillable e
  conferiu BelongsTo, model Categoria e chaves qualificadas esperadas. Não consultou
  existência dessa categoria nem persistiu Produto; listener zero SQL. Código 0.
- Suíte existente: OK (6 tests, 14 assertions), código 0. Verifica catálogo,
  ainda não carrega categoria relacionada.
- /tmp/curso-569-resumo-bancos.php em processos separados confirmou teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3.
- git diff --check passou; segredos ignorados/fora do índice. Sem alterações em
  Categoria, migrations, factories, seeders, serviços ou dependências.

Entendimento da 5.69: confirmado com "entendi" em 20/10/2026.
Publicação da 5.69: 6292b4b5019d8a16f3868089ccae28d1b6afb29b, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo após confirmação: 5.70,
criar somente primeiro teste ProdutoCategoriaTest, cadastrar categoria/produto e
verificar $produto->categoria com identidade conferida e rollback. Sem relação
inversa ou outros cenários nessa etapa.

## Etapa 5.70 — Teste de leitura da categoria do produto

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-70-teste-categoria-produto.md.

Único arquivo funcional adicionado: backend/tests/Feature/ProdutoCategoriaTest.php.
Importa Categoria/Produto, DatabaseTransactions, DB e TestCase. Trait envolve cada
cenário em transação; setUp chama parent e confere loja_test/loja_testes com duas
asserções antes dos cadastros. Não modifica TestCase ou testes existentes.

Test_produto_carrega_sua_categoria cadastra Acessórios primeiro e Roupas depois.
A categoria adicional verifica a escolha pela FK entre mais de uma possibilidade.
ProdutoFactory cria Camiseta/ativo com categoria_id de Roupas e preço padrão.
FindOrFail recarrega o produto, conferindo a ligação a partir dos dados persistidos.
$categoriaLida = $produto->categoria acessa a propriedade de relacionamento;
Eloquent usa categoria() e consulta a Categoria correspondente. Três asserções
verificam instância de Categoria, ID esperado e nome Roupas.

Explicada diferença entre categoria() (objeto BelongsTo) e categoria sem
parênteses (registro relacionado, carregado quando necessário). Cadastros e
consulta reais no SQL Server, sem mock ou associação pré-carregada em memória.

Verificações em PHP Docker:

- Arquivo focado: OK (1 test, 5 assertions), código 0. Duas asserções de identidade
  e três de comportamento do relacionamento.
- Suíte completa: OK (7 tests, 19 assertions), código 0.
- SELECTs separados após suíte confirmaram teste 0 categorias/0 produtos/3 migrations
  e normal 0 categorias/1 produto/3 migrations. Rollback conferido.
- git diff --check passou; segredos ignorados/fora do índice. Nenhuma alteração
  em models, migrations, factories, seeders ou serviços. Sem relação inversa ainda.

Entendimento da 5.70: confirmado com "entendi" em 20/10/2026.
Publicação da 5.70: 68b586fb05548f70a1a0b7160ce4bd2e8985e2c2, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato após publicar: 5.71,
adicionar somente cenário de produto sem categoria, conferindo categoria_id e
relação NULL, com o mesmo setUp/rollback e sem outros cenários nessa etapa.

## Etapa 5.71 — Produto sem categoria

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-71-produto-sem-categoria.md.

Única alteração funcional: segundo cenário em ProdutoCategoriaTest.php.
Test_produto_sem_categoria_retorna_relacao_nula cria Camiseta/ativo pela factory,
sem informar categoria_id. Factory fornece preço e não define categoria_id.
Coluna anulável permite persistir NULL. FindOrFail recarrega produto por ID;
assertNull confere categoria_id e $produto->categoria separadamente.
Ausência de associação é representada por null, sem model Categoria.
SetUp com asserções de banco/login e DatabaseTransactions preservados.

Verificações em PHP Docker:

- Arquivo focado: OK (2 tests, 9 assertions), código 0. Cenário novo soma quatro:
  duas asserções de identidade e duas de ausência de categoria.
- Suíte completa: OK (8 tests, 23 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou. Models, migrations, factory e serviços preservados;
  nenhum novo cadastro permanente ou alteração em arquivos privados de ambiente.

Entendimento da 5.71: confirmado com "entendi" em 20/10/2026.
Publicação da 5.71: e41a1d46b5eafff2c4fed34b6389959d3d9b5953, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar 5.71 e iniciar somente 5.72: definir Categoria::produtos() com retorno HasMany e
$this->hasMany(Produto::class), explicando a direção inversa e conferindo em
memória as chaves do relacionamento; teste com persistência em etapa posterior.

## Etapa 5.72 — Categoria hasMany Produto

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-72-categoria-has-many-produtos.md.

Única alteração funcional: import Illuminate\Database\Eloquent\Relations\HasMany
em Categoria.php e método produtos(): HasMany que retorna
$this->hasMany(Produto::class). Fillable de nome preservado.
Explicação: uma categoria pode ter vários produtos; é a direção inversa de
Produto::categoria(). Relação usa Categoria.id e Produto.categoria_id já existentes.
HasMany é o tipo retornado pelo método; hasMany é herdado de Model e configura a
relação. Produto::class identifica o model no mesmo namespace App\Models.
Método configura a relação; acesso por $categoria->produtos carregará coleção
quando necessário. Nesta etapa ainda não se acessou essa propriedade com dados.

Verificações em PHP Docker:

- php -l app/Models/Categoria.php: sem erros de sintaxe.
- /tmp/curso-572-has-many.php com --env=testing monta Categoria apenas em memória,
  ID ilustrativo 10. Confere HasMany, Produto, FK produtos.categoria_id, chave local
  id, parentKey 10, exists false e zero SQL por listener. Código 0.
- Suíte existente: OK (8 tests, 23 assertions), código 0. Ainda não testa leitura
  da relação inversa; testa catálogo e relação Produto->Categoria.
- Contagens posteriores em processos separados: teste 0 categorias/0 produtos/
  3 migrations e normal 0/1/3, com banco/login esperados.
- git diff --check passou; segredos fora do índice, sem mudança em schema,
  migrations, factories, seeders, testes ou serviços.

Entendimento da 5.72: confirmado com "entendi" em 20/10/2026.
Publicação da 5.72: 593cb81fc3e68e2f62f8706e0c8fdfff4f2b7626, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.73: primeiro CategoriaProdutosTest com DatabaseTransactions e
setUp conferindo loja_test/loja_testes. Um cenário com duas categorias, dois
produtos da primeira e um da segunda; recarregar primeira categoria e conferir
que $categoria->produtos traz somente seus dois produtos, sem outros cenários.

## Etapa 5.73 — Teste dos produtos de uma categoria

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-73-teste-produtos-categoria.md.

Único arquivo funcional adicionado: CategoriaProdutosTest.php. Imports de
Categoria, Produto, Eloquent Collection, DatabaseTransactions, DB e TestCase.
SetUp chama parent e confere loja_test/loja_testes antes dos cadastros; trait
faz rollback ao encerrar cenário. TestCase compartilhado preservado.

Test_categoria_carrega_somente_seus_produtos cadastra Roupas e Acessórios.
Factory cria Camiseta/Calça com categoria_id de Roupas e Caneca com o de Acessórios;
nome/status explícitos e preço padrão da factory. FindOrFail recarrega Roupas;
$roupas->produtos usa hasMany para carregar coleção de models Produto.
AssertInstanceOf confere Eloquent Collection; assertCount exige 2; modelKeys
extrai IDs e assertEqualsCanonicalizing compara aos IDs de Camiseta/Calça,
sem exigir ordem. Assim confere inclusão dos dois e exclusão da Caneca.
Não foi definida ordenação no relacionamento.

Verificações em PHP Docker:

- Arquivo focado: OK (1 test, 5 assertions), código 0: duas de identidade e
  três sobre a coleção retornada pelo relacionamento.
- Suíte completa: OK (9 tests, 28 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factories, seeders, cenários existentes e serviços preservados.

Entendimento da 5.73: confirmado com "entendi" em 20/10/2026.
Publicação da 5.73: 6ad0d19d0628b99647c0d562eafaadf3a55863ce, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.74: segundo cenário em CategoriaProdutosTest, categoria sem
produtos; recarregar categoria e conferir que relação retorna coleção vazia,
com o mesmo setUp/rollback e sem outros cenários ainda.

## Etapa 5.74 — Categoria sem produtos

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-74-categoria-sem-produtos.md.

Única alteração funcional: segundo cenário em CategoriaProdutosTest.php.
Test_categoria_sem_produtos_retorna_colecao_vazia cadastra somente Categoria
Roupas, recarrega por findOrFail e acessa $categoria->produtos. AssertInstanceOf
confere Eloquent Collection; assertCount exige zero elementos.
Explicação: hasMany retorna coleção mesmo sem resultados; belongsTo sem
associação retorna null (5.71). Categoria existe, mas não tem produtos associados.
Mesmo setUp com identidade loja_test/loja_testes e DatabaseTransactions preservado.

Verificações em PHP Docker:

- Arquivo focado: OK (2 tests, 9 assertions), código 0. Cenário novo soma quatro:
  duas asserções de identidade e duas de coleção vazia.
- Suíte completa: OK (10 tests, 32 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factories, seeders, cenários anteriores e serviços preservados.

Entendimento da 5.74: confirmado com "entendi" em 20/10/2026.
Publicação da 5.74: 5b9d80059fc54f412bdd32a095e404ce2d52c088, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.75: um novo cenário em CategoriaProdutosTest usando
$categoria->produtos()->where('status', 'ativo')->get(), com ativo/inativo da
categoria e ativo de outra categoria; exigir somente o ativo da primeira.
Explicar método para acrescentar filtro e get para executar, com mesmo
setUp/rollback, sem outros cenários ou mudanças em model nesta etapa seguinte.

## Etapa 5.75 — Consulta de produtos ativos da categoria

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-75-produtos-ativos-categoria.md.

Única alteração funcional: terceiro cenário em CategoriaProdutosTest.php.
Test_categoria_consulta_somente_seus_produtos_ativos cria Roupas com Camiseta
ativa e Calça inativa (factory inativo()->create), e Acessórios com Caneca ativa.
Recarrega Roupas e consulta $roupas->produtos()->where('status', 'ativo')->get().
AssertCount exige 1, assertSame compara modelKeys com array contendo ID da Camiseta.
Confere limite da categoria e filtro de status juntos, excluindo os dois demais.

Explicação: produtos() retorna objeto de relacionamento e permite acrescentar
condições à consulta; where prepara filtro e get executa SQL, devolvendo coleção.
Não se usou produtos->where sobre coleção carregada. Esboço SQL conceitual:
WHERE categoria_id = ID_de_Roupas AND status = 'ativo'. Método produtos/hasMany
em Categoria preservado, portanto filtro pertence somente a essa consulta.

Verificações em PHP Docker:

- Arquivo focado: OK (3 tests, 13 assertions), código 0. Cenário novo soma quatro:
  duas asserções de identidade e duas sobre os produtos retornados.
- Suíte completa: OK (11 tests, 36 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factory, seeders, cenários anteriores e serviços preservados.

Entendimento da 5.75: confirmado com "entendi" em 20/10/2026.
Publicação da 5.75: 617408b86bb0aa90b23f2704d81870d3d9c7a489, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.76: um cenário em ProdutoCategoriaTest criando produto sem
categoria e categoria, usando categoria()->associate($categoria), save e recarga
para conferir FK/relação persistidas. Explicar associação em memória e gravação,
com mesmo setUp/rollback e sem outros cenários nessa etapa seguinte.

## Etapa 5.76 — Associação do produto à categoria

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-76-associar-produto-categoria.md.

Única alteração funcional: terceiro cenário em ProdutoCategoriaTest.php.
Test_produto_pode_ser_associado_a_uma_categoria cria Camiseta sem categoria e
Categoria Roupas. Categoria()->associate($categoria) preenche FK em memória;
assertSame confere ID, e assertNull em Produto::findOrFail separado confere que
banco ainda tem NULL. Save grava a associação; recarga por findOrFail permite
conferir FK e ID da categoria obtida pela propriedade de relacionamento.

Primeira execução focada falhou: assertSame comparou ID inteiro à FK string
retornada após leitura no SQL Server. Focado 3 testes/14 asserções e uma falha;
suíte 12 testes/41 asserções e uma falha. Ajustada somente a comparação da FK
recarregada para assertSame($categoria->id, (int) $produto->categoria_id).
Conversão é local à asserção: model, schema e cast de preço foram preservados.
Explicado que assertSame compara valor e tipo; não era ausência de associação.

Verificações finais em PHP Docker:

- Arquivo focado: OK (3 tests, 15 assertions), código 0. Cenário novo soma seis:
  duas de identidade, duas antes de save e duas depois de save/recarga.
- Suíte completa: OK (12 tests, 42 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factories, seeders, cenários anteriores e serviços preservados.

Entendimento da 5.76: confirmado com "entendi" em 20/10/2026.
Publicação da 5.76: 07302047a83fa48c66b619403a85e0690056d7f8, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.77: um cenário em ProdutoCategoriaTest com produto associado,
removendo associação por categoria()->dissociate(), save e recarga. Conferir
FK/relação null e categoria preservada, com mesmo setUp/rollback e sem outros casos.

## Etapa 5.77 — Remover associação do produto à categoria

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-77-dissociar-produto-categoria.md.

Única alteração funcional: quarto cenário em ProdutoCategoriaTest.php.
Test_produto_pode_ficar_sem_categoria_apos_dissociacao cria Roupas e Camiseta
com categoria_id de Roupas. Categoria()->dissociate() coloca FK null no objeto;
assertNull confere memória. Outra leitura por findOrFail ainda devolve o ID de
Roupas antes de save, comparado como inteiro, conforme diferença de tipo da 5.76.
Após save e recarga, assertNull confere FK e relação. Categoria::findOrFail e
comparação de ID conferem que Roupas continua cadastrada.
Explicação: dissociate prepara remoção da ligação e save grava NULL no produto.
Categoria e produto continuam existindo; não há exclusão de registros.

Verificações em PHP Docker:

- Arquivo focado: OK (4 tests, 22 assertions), código 0. Cenário novo soma sete:
  duas de identidade, duas antes de save e três após save/recarga.
- Suíte completa: OK (13 tests, 49 assertions), código 0.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factories, seeders, cenários anteriores e serviços preservados.

Entendimento da 5.77: confirmado com "entendi" em 20/10/2026.
Publicação da 5.77: 7d94759bc56a862794443e504fd44c4a9cb2e7bd, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.78: demonstrar carregamento sob demanda e problema N+1 em
lista de produtos/categorias, com diagnóstico temporário em loja_test, identidade
conferida, transação/rollback e contagem dos SELECTs apenas da leitura. Preparação
dos dados fora da medição; sem otimização ou mudança na aplicação ainda.

## Etapa 5.78 — Carregamento sob demanda e problema N+1

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-78-carregamento-sob-demanda-n-mais-um.md.

Somente documentação do curso alterada. Diagnóstico temporário
/tmp/curso-578-n-mais-um.php carrega Laravel instalado em Docker e confere
ambiente testing, banco loja_test e login loja_testes antes de qualquer cadastro.
Transação cria Roupas/Acessórios e Camiseta/Calça/Caneca. IDs gerados usados em
whereIn para limitar leitura aos produtos do diagnóstico. Listener DB::listen
conta somente SELECTs enquanto flag de medição está ativa, após os cadastros.

Get de produtos executou 1 SELECT. Foreach com $produto->categoria->nome executou
mais 3 SELECTs; acumulados 2, 3 e 4. Camiseta e Calça consultaram Roupas cada uma,
pois relação é carregada em cada instância de Produto. RelationLoaded conferido
false antes e true depois do acesso; nomes de produto/categoria esperados e
quantidade final 4 conferidos. Chamado carregamento sob demanda (lazy loading).
Padrão N+1: uma busca da lista e N buscas das categorias, neste caso N=3.

Verificações:

- Diagnóstico pelo PHP Docker com --env=testing: código 0, 1+3=4 SELECTs e nomes
  corretos. SQLs parametrizados exibidos, sem valores privados.
- Finally executou rollback. SELECTs posteriores em processos separados:
  loja_test/loja_testes com 0 categorias/0 produtos/3 migrations;
  loja/loja_app com 0/1/3. Nenhum dado de demonstração permaneceu.
- Aplicação/testes não alterados. Suíte não reexecutada nesta etapa; última
  execução 13 testes/49 asserções da 5.77 permanece registrada.
- git diff --check passou; segredos fora do índice. Sem dependências novas.

Entendimento da 5.78: confirmado com "entendi" em 20/10/2026.
Publicação da 5.78: 55d0045667f7fe0f16ac9a3b3caa501938691b1c, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.79: repetir diagnóstico com with('categoria'), explicar
carregamento antecipado e comparar 4 SELECTs com 2 para os mesmos dados/resultados,
com identidade conferida e rollback, sem mudar catálogo ou adicionar serviços.

## Etapa 5.79 — Carregamento antecipado com with

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-79-carregamento-antecipado-with.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-579-carregamento-antecipado.php carrega Laravel Docker e confere
ambiente testing/banco loja_test/login loja_testes antes de cadastro. Transação
cria Roupas/Acessórios e Camiseta/Calça/Caneca; guarda IDs para limitar leitura.
DB::listen conta apenas SELECTs da leitura, com contador reiniciado a cada caso.
Cada caso executa um get novo e recebe novas instâncias de Produto.

Sem with: get gera 1 SELECT, relações não carregadas; foreach categoria->nome
leva total a 4. Com with('categoria') antes de get: get gera 2 SELECTs, relações
já carregadas; foreach mantém total 2. Resultados por nome iguais e corretos.
SELECTs com with: um de produtos e outro de categorias com WHERE id IN das duas
categorias. Eloquent associa os models carregados usando categoria_id/id.
With recebe nome do relacionamento categoria, configurado em Produto::categoria.
Get executa; foreach acessa as categorias já disponíveis em memória.

Verificações:

- Diagnóstico comparativo: código 0, casos 4 versus 2 SELECTs e resultados iguais.
  RelationLoaded false no primeiro caso e true no segundo antes de acesso.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, com identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada nesta etapa. Última execução:
  13 testes/49 asserções na 5.77. git diff --check passou; segredos fora do índice.

Entendimento da 5.79: confirmado com "entendi" em 20/10/2026.
Publicação da 5.79: 70d44b574d876724c9ef326c517abe09cd15f535, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.80: um cenário permanente em ProdutoCategoriaTest com
with('categoria'), vários produtos/duas categorias, resultados corretos e duas
consultas de leitura, sem SQL adicional no foreach. Medição após fixtures e
desativada ao final; mesmo setUp/rollback, sem mudanças na aplicação.

## Etapa 5.80 — Teste de carregamento antecipado

Implementação, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-80-teste-carregamento-antecipado.md.

Única alteração funcional: quinto cenário em ProdutoCategoriaTest.php.
Test_lista_produtos_com_categorias_em_duas_consultas cria Roupas/Acessórios e
Camiseta/Calça/Caneca, guardando IDs gerados. Foreach dos dados usa desestruturação
[$nome, $categoriaId] para factory()->create com nome/status/categoria_id.
DB::connection devolve conexão usada para medir. FlushQueryLog limpa registros
anteriores e enableQueryLog ativa registro em memória após os cadastros.
Consulta whereIn/orderBy/with('categoria')/get, duas consultas exigidas.
Foreach monta produto -> categoria; assertSame verifica os três nomes e
assertCount exige ainda duas consultas depois da leitura das propriedades.
Finally executa disableQueryLog/flushQueryLog mesmo em falha de asserção.
Medição não inclui preparação de dados, identidade ou rollback.

Verificações em PHP Docker:

- Arquivo focado: OK (5 tests, 27 assertions), código 0. Cenário novo soma cinco:
  duas de identidade e três sobre consultas/resultados.
- Suíte completa: OK (14 tests, 54 assertions), código 0, após ajuste apenas de
  formatação do array de dados do foreach.
- SELECTs posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations; loja/loja_app com 0/1/3. Rollback conferido.
- git diff --check passou; segredos fora do índice. Models, migrations,
  factories, seeders, cenários anteriores e serviços preservados.

Entendimento da 5.80: confirmado com "entendi" em 20/10/2026.
Publicação da 5.80: 362795246c945b1adca0abef77ccbb65310beaca, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.81: demonstrar INNER JOIN entre produtos/categorias em SQL
parametrizado, com produto associado e sem categoria, diagnóstico temporário em
loja_test, identidade conferida e rollback. Sem alterar aplicação ou introduzir
outro tipo de JOIN ainda.

## Etapa 5.81 — INNER JOIN entre produtos e categorias

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-81-inner-join-produtos-categorias.md.

Somente documentação alterada. Diagnóstico temporário /tmp/curso-581-inner-join.php
carrega Laravel Docker e confere testing/loja_test/loja_testes antes de cadastro.
Transação cria Roupas e dois produtos: Camiseta associada e Caneca sem categoria.
DB::select executa SELECT de produtos.nome AS produto e categorias.nome AS
categoria, FROM dbo.produtos INNER JOIN dbo.categorias ON categorias.id =
produtos.categoria_id, WHERE produtos.id IN (?, ?) com IDs em array separado,
ORDER BY produtos.id. AS nomeia colunas do resultado; ON define correspondência.
DB::select devolve array de linhas simples, não models/relacionamentos Eloquent.

Listener conta somente SELECT do JOIN, fora da preparação e leituras posteriores.
Resultado: uma consulta e uma linha, Camiseta -> Roupas. Caneca sem categoria não
corresponde à condição ON e fica fora do resultado. Leitura separada por ID
confirma que ela continua no banco, com categoria_id null.

Verificações:

- Diagnóstico: código 0; quantidade 1 consulta/1 linha e nomes esperados conferidos.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, com identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada nesta etapa. Última execução:
  14 testes/54 asserções na 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.81: confirmado com "entendi" em 20/10/2026.
Publicação da 5.81: dca90ec1e18f06b7d8d3f2258a09c780c9bc4ad4, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.82: comparar INNER JOIN com LEFT JOIN nos mesmos produtos,
conferindo que LEFT JOIN inclui Caneca com categoria null. Diagnóstico SQL
parametrizado em loja_test com identidade conferida e rollback, sem mudar
aplicação ou introduzir outros tipos de JOIN.

## Etapa 5.82 — Comparação de INNER JOIN e LEFT JOIN

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-82-left-join-produtos-categorias.md.

Somente documentação alterada. Diagnóstico temporário /tmp/curso-582-left-join.php
carrega Laravel Docker e confere testing/loja_test/loja_testes antes dos cadastros.
Transação prepara os mesmos dados: Roupas, Camiseta associada e Caneca sem categoria.
Duas consultas por DB::select usam mesmos SELECT/ON/WHERE IDs parametrizados/ORDER
BY, mudando INNER JOIN para LEFT JOIN. Listener mede um SELECT por caso; preparação
e leitura posterior da FK fora da medição.

Resultado INNER: uma linha Camiseta/Roupas. Resultado LEFT: duas linhas,
Camiseta/Roupas e Caneca/null. Categoria da segunda linha conferida como null real,
exibida como NULL. Produtos é a tabela à esquerda por estar no FROM; LEFT JOIN
preserva seus produtos selecionados no WHERE mesmo sem correspondência em categorias,
preenchendo colunas da categoria com NULL. Condição ON continua sendo igualdade
entre categorias.id e produtos.categoria_id. Dados não foram alterados pela consulta.

Verificações:

- Diagnóstico: código 0; INNER 1 SELECT/1 linha, LEFT 1 SELECT/2 linhas e nomes/
  categoria null esperados. Caneca com FK null conferida por leitura separada.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, com identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.82: confirmado com "entendi" em 20/10/2026.
Publicação da 5.82: c700173349f2b5a8e8dce074588c67b6572b27c3, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.83: Query Builder para o mesmo LEFT JOIN por
DB::table/leftJoin/select/whereIn/orderBy/get, comparando com SQL parametrizado
nos mesmos dados. Diagnóstico temporário em loja_test com identidade conferida e
rollback, sem mudar aplicação ou introduzir outros tipos de JOIN.

## Etapa 5.83 — LEFT JOIN com Query Builder

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-83-left-join-query-builder.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-583-query-builder-left-join.php carrega Laravel Docker e confere
 testing/loja_test/loja_testes antes de cadastro. Transação prepara Roupas,
Camiseta associada e Caneca sem categoria. SQL LEFT JOIN com DB::select comparado
com consulta por DB::table('produtos'), leftJoin('categorias', 'categorias.id',
'=', 'produtos.categoria_id'), select de nomes com aliases, whereIn com IDs,
orderBy e get. Laravel gera SQL parametrizado para SQL Server.

Explicação: DB::table define FROM; leftJoin define JOIN/ON; select escolhe colunas;
whereIn define filtro; orderBy ordena. Métodos preparam consulta; get executa.
ToSql mostrou SQL gerado sem executar. Zero SELECT antes de get e um depois.
Resultado do Builder é Support Collection com linhas stdClass e propriedades
produto/categoria. Não foram gerados models Eloquent por essa consulta.

Verificações:

- Diagnóstico: código 0; SQL e Builder executaram 1 SELECT cada e retornaram
  exatamente Camiseta/Roupas e Caneca/null, com mesma ordem e colunas.
- Collection/tipo de linha conferidos. Finally rollback; SELECTs posteriores:
  teste 0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.83: confirmado com "entendi" em 20/10/2026.
Publicação da 5.83: 829236f24585c77975b679410afccdec04203538, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.84: count() no Query Builder para contar produtos sem carregar
lista, com Roupas contendo dois produtos e outra categoria vazia; conferir totais
2/0 e SQL COUNT gerado em diagnóstico temporário loja_test com identidade e rollback.
Sem mudar aplicação ou introduzir agrupamento ainda.

## Etapa 5.84 — Contar produtos com count()

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-84-count-produtos-categoria.md.

Somente documentação alterada. Diagnóstico temporário /tmp/curso-584-count-produtos.php
carrega Laravel Docker e confere testing/loja_test/loja_testes antes de cadastro.
Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos. Uma chamada
DB::table('produtos')->where('categoria_id', $categoria->id)->count() por categoria,
com listener medindo somente SELECTs da contagem, fora da preparação.

Resultados conferidos estritamente como inteiros 2 e 0. SQL executado por chamada:
select count(*) as [aggregate] from [produtos] where [categoria_id] = ?.
Count executa agregação no banco e devolve número; não precisa de get e não
carrega os produtos para uma coleção. WHERE limita os registros contados.
Categoria vazia retorna 0. Aggregate é alias interno do resultado da contagem.
Nenhum agrupamento ou JOIN acrescentado nesta etapa.

Verificações:

- Diagnóstico: código 0, totais/tipos 2/0 e um SELECT COUNT(*) por caso.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.84: confirmado com "entendi" em 20/10/2026.
Publicação da 5.84: fd95bdd4e3a77e67db5ff9f9d62fbb937c5c5d34, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.85: GROUP BY categoria_id com COUNT(*) em uma consulta SQL
parametrizada sobre produtos; duas categorias com totais 2/1. Diagnóstico temporário
loja_test com identidade e rollback, sem alterar aplicação ou introduzir JOIN com
agregação ainda.

## Etapa 5.85 — GROUP BY e COUNT por categoria

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-85-group-by-categoria.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-585-group-by-categoria.php carrega Laravel Docker e confere
testing/loja_test/loja_testes antes de cadastro. Transação prepara Roupas com
Camiseta/Calça e Acessórios com Caneca, todos ativos.
DB::select executa SELECT categoria_id, COUNT(*) AS total FROM dbo.produtos
WHERE categoria_id IN (?, ?) GROUP BY categoria_id ORDER BY categoria_id,
com IDs reais das categorias em array de parâmetros separado.

GROUP BY reúne linhas com mesmo categoria_id; COUNT(*) conta cada grupo.
Resultado tem uma linha por grupo: ID de Roupas/2 e ID de Acessórios/1.
Nomes usados apenas na exibição por mapa PHP dos models da preparação. Não há
JOIN ou busca adicional de nomes. Nesta execução IDs 99/100; não foram fixados
no SQL ou verificações. Cast (int) nos valores numéricos apenas para comparar.

Verificações:

- Diagnóstico código 0; um SELECT, dois grupos e IDs/totais exatos 2/1.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.85: confirmado com "entendi" em 20/10/2026.
Publicação da 5.85: d797c48f93f53c94af8cb9a587d9a7881b088dee, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.86: mesmo agrupamento com Query Builder por select de
categoria_id/selectRaw COUNT(*)/whereIn/groupBy/orderBy/get, comparar com SQL
nos mesmos dados. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação ou combinar JOIN com agregação ainda.

## Etapa 5.86 — GROUP BY com Query Builder

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-86-group-by-query-builder.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-586-group-by-query-builder.php carrega Laravel Docker e confere
testing/loja_test/loja_testes antes de cadastro. Mesma preparação: Roupas com
Camiseta/Calça e Acessórios com Caneca. SQL agrupado da 5.85 comparado com
Builder via select('categoria_id'), selectRaw('COUNT(*) as total'), whereIn,
groupBy('categoria_id'), orderBy e get.

SelectRaw acrescenta expressão SQL ao SELECT. GroupBy define o agrupamento no
banco, e get executa. Retorno é Collection de linhas stdClass com categoria_id e
total. Nomes exibidos por mapa PHP dos models da preparação, sem consulta extra.
Construção conferida sem SELECT; cada caso executou um SELECT e devolveu os
mesmos grupos/totais 2/1. IDs numéricos reais 101/102 nesta execução, não fixados
no código; normalização para inteiro só na comparação dos resultados.

Verificações:

- Diagnóstico código 0; SQL/Builder mesmos IDs/totais, Collection/stdClass e
  quantidade de consultas esperados. SQL gerado contém GROUP BY/COUNT(*).
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.86: confirmado com "entendi" em 20/10/2026.
Publicação da 5.86: a764ac58e37f54300634de971ae97ece93c0596b, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push. Timeout
inicial da revisão automática, antes dos comandos, resolvido em uma repetição.
Próximo passo exato: publicar e iniciar somente 5.87: HAVING COUNT(*) >= 2 em SQL parametrizado sobre grupos com
totais 2/1, exigindo só Roupas/2. Explicar WHERE filtra linhas e HAVING filtra
resultado dos grupos. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação ou combinar JOIN com agregação ainda.

## Etapa 5.87 — HAVING para filtrar grupos

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-87-having-grupos.md.

Somente documentação alterada. Diagnóstico temporário /tmp/curso-587-having-grupos.php
carrega Laravel Docker e confere testing/loja_test/loja_testes antes de cadastro.
Prepara Roupas com Camiseta/Calça e Acessórios com Caneca na transação.
SQL da 5.85 recebe HAVING COUNT(*) >= ? após GROUP BY; parâmetros dos dois IDs e
limite 2 passados separadamente ao DB::select. SELECT categoria_id/COUNT(*) AS
total e ORDER BY preservados. Listener mede só SELECT da leitura, fora de cadastros.

WHERE seleciona as linhas de produtos das duas categorias antes do agrupamento.
GROUP BY reúne por categoria_id; COUNT(*) calcula quantidade de cada grupo.
HAVING seleciona grupos com contagem pelo menos 2. Roupas tem dois produtos e
aparece; Acessórios tem um e fica fora do resultado. Resultado não altera cadastros.
Normalização para inteiros apenas na comparação de ID/total; nome exibido por
mapa PHP dos models preparados. Nesta execução Roupas ID 103, sem fixar no código.

Verificações:

- Diagnóstico código 0; um SELECT/um grupo, exatamente ID de Roupas e total 2.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.87: confirmado com "entendi" em 20/10/2026.
Publicação da 5.87: 9416c4f28f276ad91cfccc4df0149b3432f8dc89, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.88: mesmo filtro com Query Builder por
havingRaw('COUNT(*) >= ?', [2]), comparando ao SQL nos mesmos dados. Diagnóstico
temporário loja_test com identidade e rollback, sem mudar aplicação ou combinar
JOIN com agregação ainda.

## Etapa 5.88 — HAVING com Query Builder

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-88-having-query-builder.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-588-having-query-builder.php carrega Laravel Docker e confere
testing/loja_test/loja_testes antes de cadastro. Mesma preparação: Roupas com
Camiseta/Calça e Acessórios com Caneca. SQL HAVING da 5.87 comparado ao Builder
com havingRaw('COUNT(*) >= ?', [2]) após groupBy e antes de orderBy/get.
HavingRaw acrescenta condição SQL ao HAVING, usando array separado de parâmetros.
GetBindings conferiu IDs e limite 2 na ordem esperada; método de construção sem
SELECT. Get executou e retornou Collection de linhas simples com um grupo.

SQL/Builder exigidos com mesmo ID de Roupas/total 2; um SELECT em cada caso.
Acessórios/1 fica fora do resultado. Nesta execução Roupas ID 105, usado via model
sem número fixo no código; casts numéricos somente na comparação dos resultados.
Nomes exibidos por mapa PHP dos models preparados, sem consulta extra.

Verificações:

- Diagnóstico código 0; resultados/quantidade de consultas/retorno e bindings
  esperados conferidos. SQL gerado contém HAVING COUNT(*) >= ?.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.88: confirmado com "entendi" em 20/10/2026.
Publicação da 5.88: 0aa0ebc2ad2d2a09124ce1826e94b47e06b6cb38, conforme autorização
persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.89: LEFT JOIN a partir de categorias e COUNT(produtos.id),
GROUP BY categorias.id/categorias.nome, com Roupas/2 e Acessórios/0. Explicar
COUNT de coluna ignora NULL da linha sem correspondência. Diagnóstico SQL
temporário loja_test com identidade e rollback, sem mudar aplicação.

## Etapa 5.89 — LEFT JOIN com contagem de produtos

Demonstração, explicação e verificações em 20/10/2026. Detalhes em
docs/aulas/05-89-left-join-count-produtos.md.

Somente documentação alterada. Diagnóstico temporário /tmp/curso-589-left-join-count.php
carrega Laravel Docker e confere testing/loja_test/loja_testes antes de cadastro.
Transação prepara Roupas com Camiseta/Calça e Acessórios sem produtos.
SQL parte de categorias, faz LEFT JOIN produtos pela FK, filtra IDs de categorias
por parâmetros e agrupa por categorias.id/categorias.nome. SELECT retorna ID/nome
da categoria e COUNT(produtos.id) AS total. Ordem pelo ID da categoria.

LEFT JOIN preserva a categoria sem produto, com produtos.id NULL na linha
resultante. COUNT(produtos.id) conta valores não nulos e retorna zero nesse grupo.
COUNT(*) contaria a linha preservada, produzindo um nesse grupo; por isso contamos
IDs de produtos. GROUP BY inclui ID/nome, colunas selecionadas fora da agregação.
Agrupar por ID mantém categorias distintas mesmo se tiverem o mesmo nome.

Verificações:

- Diagnóstico código 0; um SELECT/duas categorias, IDs/nomes e totais 2/0 exatos.
  Total da categoria vazia conferido como diferente de null antes da normalização.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.89: confirmado com "entendi" em 21/10/2026.
Publicação da 5.89: d7a9051a18bc3dc54dbbca97cb4226fc3ce5c280 em 21/10/2026,
conforme autorização persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.90: mesma consulta no Query Builder a partir de categorias,
leftJoin produtos/select ID/nome/selectRaw COUNT(produtos.id)/whereIn/groupBy
ID/nome/orderBy/get, comparando ao SQL nos mesmos dados com totais 2/0 e um SELECT
por caso. Diagnóstico temporário loja_test com identidade e rollback, sem mudar aplicação.

## Etapa 5.90 — LEFT JOIN e contagem no Query Builder

Demonstração, explicação e verificações em 21/10/2026. Detalhes em
docs/aulas/05-90-left-join-count-query-builder.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-590-left-join-count-query-builder.php carrega Laravel Docker e confere
testing/loja_test/loja_testes antes de cadastro. Transação prepara Roupas com
Camiseta/Calça e Acessórios sem produtos. SQL da 5.89 comparado ao Builder a partir
de DB::table('categorias'), leftJoin produtos pela FK, select ID/nome com aliases,
selectRaw COUNT(produtos.id), whereIn dos IDs, groupBy ID/nome e orderBy/get.

LEFT JOIN mantém categoria vazia; COUNT da coluna produtos.id ignora NULL e gera
zero nesse grupo. GroupBy reúne ID/nome, e get executa. Antes de get conferidos
zero SELECTs e bindings dos dois IDs. Resultado Builder é Collection de linhas
stdClass com categoria_id/categoria/total, iguais ao SQL em ordem/valores.

Verificações:

- Diagnóstico código 0; um SELECT por caso, mesmos IDs/nomes e totais 2/0, retorno
  e parâmetros esperados. Total vazio diferente de null antes de normalizar.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Docker Compose ps confirmou backend/php/sqlserver já em execução. Aplicação/
  testes preservados; suíte não reexecutada. Última execução: 14 testes/54 asserções
  da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.90: confirmado com "entendi" em 21/10/2026.
Publicação da 5.90: 1d801ae15aeff65989ec35cd245f891b8844c3cc em 21/10/2026,
conforme autorização persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.91: withCount('produtos') na consulta Eloquent de Categoria,
conferindo produtos_count 2/0, models retornados, um SELECT e coleção da relação
produtos sem carregar. Diagnóstico temporário loja_test com identidade e rollback,
sem mudar aplicação.

## Etapa 5.91 — Contagem pelo Eloquent com withCount

Demonstração, explicação e verificações em 21/10/2026. Detalhes em
docs/aulas/05-91-with-count-produtos.md.

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-591-with-count-produtos.php carrega Laravel Docker e confere
testing/loja_test/loja_testes antes de cadastro. Mesma preparação: Roupas com
Camiseta/Calça e Acessórios sem produtos. Consulta Categoria::query/whereIn IDs/
withCount('produtos')/orderBy/get usa o método produtos() hasMany já existente.

WithCount acrescenta atributo produtos_count aos models Categoria retornados,
com totais 2/0. Atributo vem da seleção SQL, sem alteração de schema. SQL observado:
SELECT categorias.* e subconsulta COUNT(*) de produtos pela FK, alias produtos_count.
Contagem incluída em um SELECT; coleção da relação produtos não é carregada.
Get devolve Eloquent Collection de models Categoria. Ler nome/produtos_count no
foreach não executou outro SELECT. Método with('produtos') carregaria os models
relacionados, enquanto withCount disponibiliza o número para essa consulta.

Verificações:

- Diagnóstico código 0; zero SELECTs antes de get, um após get e foreach; tipos,
  IDs/nomes/produtos_count 2/0 e relação produtos não carregada conferidos.
- Finally rollback; SELECTs posteriores em processos separados conferiram teste
  0 categorias/0 produtos/3 migrations e normal 0/1/3, identidades esperadas.
- Aplicação/testes preservados; suíte não reexecutada. Última execução:
  14 testes/54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Entendimento da 5.91: confirmado com "entendi" em 21/10/2026.
Publicação da 5.91: a5e94b5a2821796830b17e2b2fc1fbd550355fef em 21/10/2026,
conforme autorização persistente; HEAD, origin/main e main remota conferidos após o push.
Próximo passo exato: publicar e iniciar somente 5.92: revisão da entrega persistida, caminho GET /loja/LojaController/
Catalogo/binding/CatalogoEloquent/Produto/view loja, resposta HTTP e pendências
registradas do módulo 5. Sem iniciar módulo 6 ou concluir o módulo sem confirmação.

## Etapa 5.92 — Revisão da entrega persistida do módulo 5

Revisão, explicação e verificações em 21/10/2026. Detalhes em
docs/aulas/05-92-revisao-catalogo-persistido.md. Somente documentação alterada.

Fluxo revisado: GET /loja em routes/web.php aponta LojaController@index.
Controller recebe contrato Catalogo pelo construtor. AppServiceProvider liga
Catalogo a CatalogoEloquent. ListarNomes usa Produto para consultar produtos
ativos, ordenar por nome, extrair nomes e retornar array. Controller envia
produtos/nomeLoja à view loja; Blade renderiza lista ou mensagem vazia e aplica
escape. Middleware acrescenta cabeçalho X-Curso Laravel à resposta.

Verificações em PHP Docker:

- /tmp/curso-592-revisar-catalogo.php no ambiente normal: loja/loja_app conferidos,
  binding CatalogoEloquent e listarNomes ['Camiseta'] em um SELECT CLI. Código 0.
- Requisição HTTP real separada GET /loja pelo servidor do backend: 200,
  X-Curso Laravel, título Catálogo de produtos e item Camiseta no HTML.
  Não foi medida a quantidade de queries dessa requisição HTTP separada.
- Contagens posteriores em processos separados: loja_test/loja_testes com
  0 categorias/0 produtos/3 migrations e loja/loja_app com 0/1/3. Somente leitura.
- Aplicação/testes preservados; suíte não reexecutada, última execução 14 testes/
  54 asserções da 5.80. git diff --check passou; segredos fora do índice.

Pendência de acompanhamento: consulta manual DBeaver sugerida na 5.22 não teve
resultado informado pelo aluno. Acesso ao DBeaver foi confirmado na 5.6; isso é
separado da execução desse exercício posterior. Verificação atual por ferramenta
não substitui relato do aluno. Exercício sugerido não exige implementação solitária.
Entrega técnica revisada corresponde ao catálogo persistido do módulo 5; relações,
SQL e agregações estudados em testes/diagnósticos, sem ampliar a página antecipadamente.

Entendimento da 5.92: confirmado com "entendi" em 21/10/2026; módulo 5 concluído.
Publicação da 5.92: 2964f04d5d3054bdcf6f142e1f64cc97f05abd81 em 21/10/2026.
Push concluído e HEAD/origin/main/consulta direta à main remota coincidentes.
Último checkpoint publicado antes desta confirmação: a5e94b5, etapa 5.91.
Próximo passo exato: aguardar pedido de retomada para iniciar o módulo 6,
conforme decisão explícita do aluno de deixá-lo para outro momento. Nenhuma
alteração de aplicação/testes nesta confirmação; verificações da revisão
preservadas, sem reexecutar a suíte para alterações documentais.

## Etapa 6.1 — HTTP, HTML e JSON

Retomada solicitada em 22/10/2026, encerrando a pausa após o módulo 5.
Instruções, roteiro, progresso, arquivos do fluxo atual e estado Git conferidos.
Git inicialmente sem alterações locais; HEAD e origin/main locais em d098927.
Nenhuma consulta remota nesta retomada.

Explicação apresentada em docs/aulas/06-01-http-html-json.md: API como interface
entre programas; requisição com método/endereço/cabeçalhos/corpo; resposta com
status/cabeçalhos/corpo; GET para leitura, 200 para sucesso desta consulta,
Accept e Content-Type; HTML montado por Blade versus dados JSON para um cliente.
Exemplo JSON apenas didático, sem contrato definitivo ou rota implementada.
Introduzida a ideia de recursos e o caminho planejado /api/v1/produtos.

Verificação em PHP Docker, após docker compose ps confirmar serviços ativos:
GET http://127.0.0.1:8000/loja com Accept: text/html retornou HTTP/1.1 200 OK,
Content-Type: text/html; charset=utf-8, X-Curso: Laravel e <li>Camiseta</li>.
Diagnóstico temporário pela entrada padrão exigiu status/tipo/item; código 0.
Cabeçalhos de sessão não exibidos. Somente leitura; sem migration/seeder/cadastro.
Nenhuma rota, controller ou dependência alterada. Suíte não reexecutada para
documentação; última execução registrada 14/54 da 5.80.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação: 7ce865ade29038292a064649f5b509f9205d3d51 em 22/10/2026; push
concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Pendência de acompanhamento: exercício DBeaver segue sem relato do aluno.
Próximo passo exato: publicar o checkpoint e iniciar somente 6.2: registrar routes/api.php em
bootstrap/app.php com prefixo api/v1 e criar GET /api/v1/produtos com nomes do
catálogo em JSON; documentar o contrato inicial. Sem instalar autenticação ou
novas dependências antecipadamente.

## Etapa 6.2 — Primeira rota do catálogo em JSON

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-02-primeira-rota-json.md; contrato inicial em docs/api/catalogo.md.
Somente bootstrap/app.php e routes/api.php alterados na aplicação: api e apiPrefix
registrados em withRouting; GET /produtos recebe Catalogo por injeção e devolve
JsonResponse com data/listarNomes. Prefixo api/v1 completa o caminho público.
Consulta existente de nomes ativos ordenados e binding reaproveitados.

Verificações em Docker:

- PHP 8.4.26, Composer 2.10.3 e assinatura api/apiPrefix instalados conferidos.
- php -l passou nos dois arquivos; route:list --path=api -vv mostrou
  GET|HEAD api/v1/produtos no grupo api.
- /tmp/curso-62-http.php realizou GET real à API e à página. Exigiu 200 e o tipo
  de conteúdo correspondente; JSON decodificado exatamente data: ['Camiseta'];
  HTML com <li>Camiseta</li>. Código 0; cookies de sessão não exibidos.
- php artisan test: 14 testes/54 asserções passaram, código 0. Aviso de escrita
  de .phpunit.result.cache em montagem somente leitura, sem falha dos testes.
  Usar --do-not-cache-result nas próximas execuções. Nenhum teste novo nesta etapa;
  testes HTTP específicos da API começarão na 6.3.
- SELECTs separados via /tmp/curso-62-contagens.php após a suíte: banco/login
  loja_test/loja_testes com 0 categorias/0 produtos; loja/loja_app com 0/1.
  Código 0. Nenhum cadastro permanente, migration, seeder ou dependência adicionada.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.2: 28450ae4ed0ba7562dc07ea92f9f402cbdc18229 em 22/10/2026;
push concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Último checkpoint publicado: 7ce865ade29038292a064649f5b509f9205d3d51, etapa 6.1;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.3: primeiro teste HTTP automatizado do catálogo
vazio em GET /api/v1/produtos, DatabaseTransactions e banco exclusivo loja_test,
conferindo status, tipo de conteúdo e JSON.

## Etapa 6.3 — Teste HTTP do catálogo vazio

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-03-teste-api-catalogo-vazio.md; contrato inicial atualizado em
docs/api/catalogo.md. Único código novo: backend/tests/Feature/CatalogoApiTest.php.

Classe estende Tests\TestCase e usa DatabaseTransactions. SetUp chama o pai,
confere banco loja_test/login loja_testes por SELECT e só então prepara produtos
vazia por DELETE. Método test_retorna_json_com_lista_vazia_quando_nao_ha_produtos
chama getJson('/api/v1/produtos') e exige status 200, Content-Type application/json
e assertExactJson com data: []. Requisição interna Laravel, sem rede; banco e
catálogo reais, transação desfeita ao encerrar. Rota/serviço existentes preservados.

Verificações PHP Docker, código 0:

- php -l no arquivo novo: sintaxe válida.
- php artisan test --filter=CatalogoApiTest --do-not-cache-result: 1 teste/
  6 asserções passou.
- php artisan test --do-not-cache-result: 15 testes/60 asserções passaram,
  sem aviso de cache de resultados.
- SELECTs separados pelo diagnóstico /tmp/curso-62-contagens.php após a suíte:
  loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto.
  Sem migration, seeder, cadastro permanente ou nova dependência.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.3: d9d091144402ef5d700a1126eabfabd3855c9e4f em 22/10/2026;
push concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Último checkpoint publicado: 28450ae4ed0ba7562dc07ea92f9f402cbdc18229, etapa 6.2;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.4: adicionar um cenário HTTP de produto ativo em
CatalogoApiTest com factory, exigindo o nome na lista data da resposta JSON.

## Etapa 6.4 — Produto ativo na resposta JSON

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-04-teste-api-produto-ativo.md; contrato docs/api/catalogo.md atualizado.
Único código alterado: segundo cenário em backend/tests/Feature/CatalogoApiTest.php.

Test_retorna_nome_do_produto_ativo_em_json cadastra Camiseta/ativo por
Produto::factory()->create; preço vem da definição padrão. GetJson passa pela
aplicação e exige 200, Content-Type application/json e JSON exato data: ['Camiseta'].
SetUp, guardas de identidade loja_test/loja_testes e DatabaseTransactions da 6.3
reaproveitados. Nenhuma chamada pela rede; SQL Server real e rollback.

Verificações PHP Docker, código 0:

- php -l em CatalogoApiTest: sintaxe válida.
- php artisan test --filter=CatalogoApiTest --do-not-cache-result: 2 testes/
  12 asserções passaram.
- php artisan test --do-not-cache-result: 16 testes/66 asserções passaram.
- SELECTs separados por /tmp/curso-62-contagens.php após a suíte:
  loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto.
  Sem migration, seeder, cadastro permanente ou dependência nova.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.4: 7defc2c2f695e73d2be27f8167acdb74f28ea746 em 22/10/2026;
push concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Último checkpoint publicado: d9d091144402ef5d700a1126eabfabd3855c9e4f, etapa 6.3;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.5: adicionar um cenário HTTP com produto ativo e
inativo em CatalogoApiTest, usando inativo() e exigindo apenas o nome do ativo
na lista data.

## Etapa 6.5 — Omitir produto inativo da resposta JSON

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-05-teste-api-produto-inativo.md; contrato docs/api/catalogo.md atualizado.
Único código alterado: terceiro cenário em backend/tests/Feature/CatalogoApiTest.php.

Test_omite_produtos_inativos_da_resposta_json cadastra Camiseta/ativo por factory
e Caneca por factory()->inativo()->create, com preço padrão nos dois. GetJson
exige 200, Content-Type application/json e JSON exato data: ['Camiseta'].
Estado inativo() existente na factory e filtro ativo do serviço reaproveitados;
nenhuma alteração desses arquivos. SetUp/DatabaseTransactions existentes mantidos,
banco exclusivo loja_test/loja_testes, SQL Server real e requisição interna Laravel.

Verificações PHP Docker, código 0:

- php -l em CatalogoApiTest: sintaxe válida.
- php artisan test --filter=CatalogoApiTest --do-not-cache-result: 3 testes/
  18 asserções passaram.
- php artisan test --do-not-cache-result: 17 testes/72 asserções passaram.
- SELECTs separados por /tmp/curso-62-contagens.php após a suíte:
  loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto.
  Sem migration, seeder, cadastro permanente ou nova dependência.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.5: bc86f52caf0e054fa32c74abaf834a374738f44e em 22/10/2026;
push concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Último checkpoint publicado: 7defc2c2f695e73d2be27f8167acdb74f28ea746, etapa 6.4;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.6: adicionar cenário HTTP de ordenação em
CatalogoApiTest com dois ativos inseridos em ordem inversa à alfabética,
exigindo a ordem correta dos nomes na lista data da resposta.

## Etapa 6.6 — Ordem dos nomes na resposta JSON

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-06-teste-api-ordenacao.md; contrato docs/api/catalogo.md atualizado.
Único código alterado: quarto cenário em backend/tests/Feature/CatalogoApiTest.php.

Test_retorna_nomes_em_ordem_alfabetica_no_json cadastra Caneca antes de Camiseta,
ambas ativas via factory, preço padrão. GetJson exige 200, application/json e
JSON exato data: ['Camiseta', 'Caneca']. OrderBy('nome') existente no serviço
reaproveitado. Conferida implementação instalada de assertExact/reorderAssocKeys:
normaliza chaves associativas, preservando índices/valores da lista para comparação.
Sem mudança de dependência ou dos testes anteriores.

Verificações PHP Docker, código 0:

- php -l em CatalogoApiTest: sintaxe válida.
- php artisan test --filter=CatalogoApiTest --do-not-cache-result: 4 testes/
  24 asserções passaram.
- php artisan test --do-not-cache-result: 18 testes/78 asserções passaram.
- SELECTs separados por /tmp/curso-62-contagens.php após a suíte:
  loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto.
  Requisições de teste internas Laravel, SQL Server real e rollback.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.6: daffb9511b15c10f2b358658295f00f332bd17bf em 22/10/2026;
push concluído, HEAD, origin/main e main remota conferidos e coincidentes.
Último checkpoint publicado: bc86f52caf0e054fa32c74abaf834a374738f44e, etapa 6.5;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.7: extrair a função da rota para ProdutoController@index
sob App\Http\Controllers\Api\V1 e ajustar routes/api.php; preservar contrato JSON
e verificar os cenários existentes.

## Etapa 6.7 — Controller da API de produtos

Implementação, explicação e verificações em 22/10/2026. Aula em
docs/aulas/06-07-controller-api-produtos.md; contrato docs/api/catalogo.md atualizado.
Dois arquivos de código: controller novo em app/Http/Controllers/Api/V1 e
routes/api.php ajustado para [ProdutoController::class, 'index'].

Index recebe Catalogo por injeção no método e retorna JsonResponse com
data/listarNomes. Namespace/imports/herança e ::class explicados. Binding, serviço,
testes e prefixo existentes preservados. Nenhuma dependência nova.

Verificações PHP Docker, código 0:

- php -l nos dois arquivos: sintaxes válidas.
- route:list --path=api -vv: GET|HEAD api/v1/produtos ->
  Api\V1\ProdutoController@index, grupo api.
- php artisan test --filter=CatalogoApiTest --do-not-cache-result: 4 testes/
  24 asserções passaram, sem mudar os testes.
- php artisan test --do-not-cache-result: 18 testes/78 asserções passaram.
- HTTP real por /tmp/curso-62-http.php: API 200/application/json e
  {"data":["Camiseta"]}; /loja 200/text/html; charset=utf-8 e item Camiseta.
- SELECTs separados por /tmp/curso-62-contagens.php após suíte/HTTP:
  loja_test/loja_testes 0 categorias/0 produtos; loja/loja_app 0 categorias/1 produto.

Entendimento: confirmado pelo aluno com "entendi" em 22/10/2026.
Publicação da 6.7: checkpoint pronto para commit/push conforme autorização
persistente; registrar o resultado após conferir o remoto.
Último checkpoint publicado: daffb9511b15c10f2b358658295f00f332bd17bf, etapa 6.6;
envio e consulta direta ao remoto conferidos neste turno.
Próximo passo exato: publicar e iniciar somente 6.8: desenhar representação JSON de produto com id,
nome e preco_em_centavos; discutir impacto no contrato e testes antes de
implementar a nova consulta/serialização.

## Verificações e limitações do ambiente

- Pasta inicial inspecionada: sem aplicação ou documentação anterior.
- Git instalado e repositório local inicializado na etapa 1.3.
- A inicialização exigiu execução ampliada devido à montagem somente leitura
  de `.git` no modo restrito. As leituras posteriores funcionaram nesse modo.
  Se uma futura escrita falhar, usar o fluxo de execução ampliada autorizado;
  não alterar permissões manualmente nem assumir que o Git está inacessível.
- Docker 29.8.2 e Docker Compose v5.5.1 instalados.
- Acesso ao daemon Docker: verificado na etapa 2.1; modo restrito retorna
  permissão negada, execução ampliada acessa o daemon 29.8.1, Linux x86_64.
  Usar o fluxo ampliado autorizado para operações que acessam o serviço;
  primeiro container PHP do curso executado e removido na etapa 2.2.
- Documentação verificada: três arquivos presentes e legíveis em UTF-8; módulos
  1 a 23 em ordem e sem duplicação; registros de entendimento e publicação
  corretamente pendentes. Nenhum teste de aplicação é aplicável ainda.

## Git e GitHub

- Repositório local: branch `main`; etapa 1.5 registra o primeiro checkpoint
  com os cinco arquivos iniciais. Acompanhamento de `origin/main` configurado.
- Destino remoto: `origin` configurado para `julesjrenck/curso-loja-fullstack`;
  criação, visibilidade pública e histórico publicado verificados.
- Conta pelo conector: `julesjrenck`; acesso Git SSH verificado após o cadastro
  da chave pública pelo aluno.
- Primeiro commit local: `afb0d2c`, `docs: inicia curso e registra progresso`.
- Último checkpoint pedagógico publicado conferido nesta retomada: `daffb95`,
  `test: verifica ordenação dos nomes na API do catálogo`. HEAD, origin/main e main
  consultada diretamente no remoto coincidiram após o push em 22/10/2026.
  Este registro posterior documenta a publicação; alterações da 6.7 ainda locais.
- Primeiro envio verificado: `a43617042726cda586c24b630eab8734b53f7a3c`.
- Último commit publicado: consultar `git rev-parse origin/main` ou a página
  do repositório; comparar com `git rev-parse HEAD` para conferir sincronização.
- Remoto consultado em 21/10/2026 após o push da 5.92 com `git ls-remote`:
  `2964f04d5d3054bdcf6f142e1f64cc97f05abd81`, igual a HEAD e origin/main
  nessa conferência. Etapa 5.92 confirmada e publicada; módulo 5 concluído.
  A rejeição inicial foi resolvida por aprovação explícita do aluno para
  publicar os checkpoints concluídos na branch pública `main` deste repositório;
  essa autorização permanece válida para os próximos checkpoints concluídos.
- Publicação das etapas 1.1 a 1.7: primeiro envio concluído; esta atualização
  do registro deve ser enviada após o commit e verificada novamente.

## Esclarecimento sobre SSH

Pergunta do aluno: a configuração SSH vale para todos os projetos? Antes havia
SSH somente local?

Explicação apresentada:

- SSH é um protocolo de comunicação segura. O computador já tinha um par de
  chaves; o curso reutilizou esse par, sem gerar outro.
- A chave privada fica em `~/.ssh/id_ed25519`; a pública tem uma cópia em
  `~/.ssh/id_ed25519.pub` e foi cadastrada na conta GitHub do aluno.
- O título `curso-loja-fullstack` no cadastro é um rótulo, não uma restrição de
  acesso ao repositório. Trata-se de chave de autenticação da conta, não deploy key.
- Neste computador, a mesma chave pode autenticar operações SSH em outros
  repositórios GitHub acessíveis à conta, respeitando suas permissões e políticas.
- A chave identifica a conta; ela não concede automaticamente acesso de escrita
  a repositórios de outras pessoas ou organizações.
- Cada projeto continua precisando do seu próprio endereço remoto. Um endereço
  SSH como `git@github.com:julesjrenck/outro-projeto.git` pode usar a mesma chave.
- Outra máquina não herda automaticamente a chave privada deste computador;
  outros serviços também não herdam o cadastro feito no GitHub.
- `~/.ssh/known_hosts` guarda chaves públicas dos servidores conhecidos, para
  reconhecer o servidor GitHub; não substitui o cadastro da chave do usuário.
- A presença das chaves locais, por si só, não comprova cadastro anterior no
  GitHub nem configuração de um servidor SSH para receber conexões no computador.

Fontes: [Sobre SSH](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/about-ssh),
[Cadastro de chave na conta](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)
e [Diferença para deploy keys](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/managing-deploy-keys).

Explicação registrada e entendimento confirmado pelo aluno com "entendi" antes
do início do módulo 2. O checkpoint anterior `e40d8fa` foi publicado e verificado
antes deste esclarecimento.

### Como as chaves são geradas

Pergunta complementar do aluno: como gerar o par de chaves localmente?

Exemplo didático, não executado durante esta explicação:

```bash
ssh-keygen -t ed25519 -C "seu-email@exemplo.com" -f ~/.ssh/id_ed25519_exemplo
```

- `ssh-keygen` gera o par de chaves no computador.
- `-t ed25519` escolhe o algoritmo; `-C` define um comentário de identificação,
  que não é senha nem faz cadastro no GitHub.
- `-f` escolhe o nome e caminho da chave privada; a pública recebe o sufixo `.pub`.
- O exemplo usa outro nome para preservar o par que já utilizamos.
- A ferramenta pede uma passphrase e sua confirmação. Ela protege a chave privada
  no disco; não é a senha da conta GitHub. Deixar vazio cria a chave sem passphrase.
- O comando cria `id_ed25519_exemplo` e `id_ed25519_exemplo.pub`; não publica,
  não cadastra no GitHub e não configura esse novo nome para uso automático.

Fonte: [Gerar uma chave SSH](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent).

## Dúvidas e próximos passos

- Dúvida da 5.7: sys.database_principals é tabela? Explicada como view de
  catálogo, com metadados de usuários/papéis e esquema sys; entendimento confirmado.
- Dúvida da 5.7: usuário já criado no banco loja? Sim, loja_app está em loja;
  login correspondente pertence ao servidor. Consulta de metadados apresentada.
  Entendimento da 5.7 confirmado com "entendi" em 13/10/2026.
- Dúvida da 5.4: dados de acesso SQL Server. Indicados endereço interno/porta,
  login sa, localização da senha local e master; explicado acesso Docker/host.
  Entendimento confirmado com "entendi"; publicar porta apenas na etapa de acesso.
- Pedido do aluno: avisar quando o acesso pelo DBeaver estiver disponível.
  Aviso cumprido na 5.6 após conexão SQL autenticada pela porta local passar.
  Dados apresentados; aluno relatou "apareceu loja" na consulta pelo DBeaver.
  Acesso confirmado; entendimento da 5.6 confirmado depois com "entendi".
- Dúvida da 5.3: o que é PIE? Esclarecido nome, função, relação com Composer,
  comando de instalação e uso no build; entendimento confirmado com "entendi".
- Dúvida registrada e respondida: alcance da autenticação SSH e diferença entre
  chaves locais, cadastro na conta GitHub e reconhecimento do servidor; exemplo
  de geração local com `ssh-keygen`, sem executar ou substituir as chaves atuais.
- Dúvidas sobre SSH: entendimento confirmado; nenhuma nova dúvida sobre Docker
  registrada até agora.
- Dúvida sobre `trim`: exemplo prático respondido e entendimento confirmado
  junto com a etapa 3.2.
- Dúvida da 3.13: onde ItemCarrinho é chamado e como funciona a composição.
  Chamada identificada na experiência temporária documentada, sem script
  persistente em src naquela etapa. Entendimento confirmado depois da explicação.
  Na 3.14, a chamada foi salva em src/exemplo-item-carrinho.php.
- Sessão encerrada a pedido do aluno em 16/10/2026; continuar outro dia.
- Retomada da 5.34 realizada; entendimento confirmado com "entendi" em 19/10/2026.
- Aviso do Composer: licença ausente. Configuração válida com código 0;
  nenhuma licença escolhida nesta aula.
- Etapa 5.35 aplicada, verificada e confirmada com "entendi" em 19/10/2026.
  Modelo da 5.36 confirmado/publicado. .env.testing da 5.37 preparado e
  carregamento/conexão verificados por leitura; entendimento confirmado com "entendi".
  Etapa 5.38 ajustou phpunit.xml e verificou XML/variáveis/conexão; entendimento
  confirmado com "entendi" após esclarecer APP_ENV. Na 5.39, exemplos passaram:
  2 testes/2 asserções, entendimento confirmado com "entendi". Na 5.40,
  produtos/migrations criadas em loja_test; esquema/status/reexecução conferidos.
  Entendimento confirmado com "entendi". Na 5.41, integração de catálogo vazio
  implementada/explicada; focado 1 teste/3 asserções e suíte 3 testes/5 asserções.
  Entendimento confirmado com "entendi". Na 5.42, setUp compartilhado e cenário
  ativo passaram: focado 2 testes/6 asserções e suíte inversa 4 testes/8 asserções.
  Entendimento confirmado com "entendi". Na 5.43, filtro com ativo/inativo passou:
  focado 3 testes/9 asserções, suíte 5 testes/11 asserções. Entendimento confirmado com "entendi";
  depois, 5.44 implementou ordenação com dois ativos: focado 4 testes/12 asserções,
  suíte 6 testes/14 asserções. Entendimento confirmado com "entendi". Na 5.45,
  ProdutoFactory gerada, sem atributos/dados/uso em testes; sintaxe/autoload/model
  conferidos. Entendimento confirmado com "entendi". Na 5.46, definição preenchida
  e dez arrays conferidos em memória sem SQL. Entendimento confirmado com "entendi"; depois,
  5.47 demonstrou Produto em memória com new()->make(), exists false/ID null,
  zero SQL. Entendimento confirmado com "entendi". Na 5.48, HasFactory no model
  e atalho make conferidos em memória; suíte existente 6 testes/14 asserções passou.
  Entendimento confirmado com "entendi" e publicado em d465778. Na 5.49,
  factory create aplicada somente ao cenário de ativo; teste 1/3 e suíte 6/14
  passaram, rollback conferido. Entendimento confirmado com "entendi" e publicado
  em 9a08b80. Na 5.50, dois cadastros do cenário ativo/inativo convertidos;
  teste 1/3 e suíte 6/14 passaram, rollback conferido. Entendimento confirmado com "entendi"
  e publicado em 10e723b. Na 5.51, cenário de ordenação convertido; teste 1/3 e
  suíte 6/14 passaram, rollback conferido. Entendimento confirmado com "entendi"
  e publicado em 5152ba4. Na 5.52, estado inativo na factory conferido em memória:
  zero SQL, padrão ativo preservado; suíte existente 6/14 passou. Entendimento
  confirmado com "entendi" e publicado em edd3411. Na 5.53, estado aplicado ao
  cadastro da Caneca no teste; teste 1/3 e suíte 6/14 passaram, rollback conferido.
  Entendimento confirmado com "entendi" e publicado em 6ac5518. Na 5.54,
  DatabaseSeeder apresentado sem execução; dependência users ausente confirmada
  por SELECT nos dois bancos. Entendimento confirmado com "entendi" após nova
  explicação com exemplo da loja e publicado em def2f14. Na 5.55, plano corrigido:
  ProdutoSeeder já existe, foi preservado/revisado, sintaxe passou. Entendimento
  confirmado com "entendi" e publicado em 0f754ae. Na 5.56, ligação escrita com
  call([ProdutoSeeder::class]); sintaxe/autoload passaram, seeders não executados.
  Entendimento confirmado com "entendi" e publicado em 07af123. Na 5.57,
  execução padrão em loja_test chamou ProdutoSeeder/criou Camiseta, catálogo
  conferido e rollback para zero produtos. Entendimento confirmado com "entendi"
  e publicado em 5c65e6d. Na 5.58, modelagem inicial categorias/produtos e chave
  estrangeira apresentadas com exemplos, sem alterar esquema. Entendimento confirmado
  com "entendi" em 20/10/2026 e publicado em f680b99. Na 5.59, migration de
  categorias preparada com id/nome/timestamps(3), sintaxe passou, sem aplicar.
  Entendimento confirmado com "entendi" e publicado em 9e89010. Na 5.60,
  categorias criada em loja_test, esquema/status/reexecução conferidos; teste
  vazio e normal com um produto. Entendimento confirmado com "entemdi" e publicado
  em 04ab6bb. Na 5.61, migration aplicada em loja com loja_migracoes; esquema,
  histórico/reexecução e produto preservado conferidos. Entendimento confirmado com "entendi"
  e publicado em 4d3358d. Na 5.62, model Categoria gerado com Fillable de nome;
  sintaxe/configuração em memória passaram, zero SQL. Entendimento confirmado com "entendi"
  e publicado em e57dbbe. Na 5.63, cadastro/leitura de Categoria em loja_test
  conferidos, rollback para zero categorias. Entendimento confirmado com "entendi"
  e publicado em ce67886. Na 5.64, migration de categoria_id anulável/FK preparada,
  com bloqueio de exclusão de categoria referenciada; sintaxe passou, sem aplicar.
  Entendimento confirmado com "entendi" e publicado em e5e6156. Na 5.65,
  aplicação falhou por REFERENCES negado, sem alteração parcial; status Pending.
  Suíte não executada. Entendimento da descoberta confirmado com "entendi" e
  publicado em 91ed884. Na 5.66, script de REFERENCES restrito a categorias em
  loja_test preparado; PARSEONLY passou, permissões continuam 0. Entendimento
  confirmado com "entendi" e publicado em 3924613. Na 5.67, concessão e FK
  aplicadas no teste; metadados/histórico e suíte 6/14 passaram, contagens após
  testes preservadas. Entendimento confirmado com "entendi" e publicado em e384ae1.
  Na 5.68, concessão/FK no banco normal concluídas, produto preservado com nova
  coluna NULL e metadados/histórico conferidos. Entendimento confirmado com "entendi"
  e publicado em 55f7ea8. Na 5.69, belongsTo/Fillable de categoria_id em Produto
  preparados; configuração em memória/sintaxe e suíte 6/14 passaram. Entendimento
  confirmado com "entendi" e publicado em 6292b4b. Na 5.70, primeiro teste de
  leitura da categoria relacionada criado; focado 1/5 e suíte 7/19 passaram,
  rollback conferido. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 68b586f.
  Na 5.71, cenário sem categoria verifica FK/relação null; focado 2/9 e suíte 8/23
  passaram, rollback conferido. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em e41a1d4.
  Na 5.72, hasMany definido em Categoria, sintaxe/configuração em memória com zero SQL
  e suíte existente 8/23 passaram. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 593cb81.
  Na 5.73, primeiro teste hasMany cadastra duas categorias/três produtos e exige
  somente dois produtos de Roupas. Focado 1/5 e suíte 9/28 passaram, rollback
  conferido. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 6ad0d19.
  Na 5.74, segundo cenário exige coleção vazia para categoria sem produtos;
  focado 2/9 e suíte 10/32 passaram, rollback conferido. Entendimento confirmado
  com "entendi" em 20/10/2026 e publicado em 5b9d800. Na 5.75, consulta por
  produtos()->where/get exige somente Camiseta ativa de Roupas; focado 3/13 e
  suíte 11/36 passaram, rollback conferido. Entendimento confirmado com "entendi"
  em 20/10/2026 e publicado em 617408b. Na 5.76, associate/save verificados antes
  e depois de gravar; comparação da FK normalizada após falha por tipo string/int.
  Focado final 3/15 e suíte 12/42 passaram. Entendimento confirmado com "entendi"
  em 20/10/2026 e publicado em 0730204. Na 5.77, dissociate/save conferidos antes
  e depois de gravar, com categoria preservada; focado 4/22 e suíte 13/49 passaram.
  Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 7d94759.
  Na 5.78, diagnóstico N+1 conferiu 1 SELECT da lista + 3 das categorias = 4,
  com rollback e contagens posteriores preservadas. Somente documentação.
  Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 55d0045.
  Na 5.79, diagnóstico com with confirmou resultados iguais e 2 SELECTs em vez
  de 4, sem SQL adicional no foreach; rollback/contagens conferidos. Entendimento
  confirmado com "entendi" em 20/10/2026 e publicado em 70d44b5. Na 5.80, teste
  permanente exige nomes corretos e duas consultas antes/depois do foreach;
  focado 5/27 e suíte 14/54 passaram, rollback conferido. Entendimento confirmado
  com "entendi" em 20/10/2026 e publicado em 3627952. Na 5.81, INNER JOIN
  parametrizado retornou Camiseta/Roupas em 1 SELECT; Caneca sem categoria ficou
  fora do resultado e continuou no banco. Rollback/contagens conferidos. Entendimento
  confirmado com "entendi" em 20/10/2026 e publicado em dca90ec. Na 5.82, LEFT JOIN
  retornou também Caneca/null: 1 SELECT/2 linhas, comparado ao INNER 1 SELECT/1 linha.
  Rollback/contagens conferidos. Entendimento confirmado com "entendi" em 20/10/2026
  e publicado em c700173. Na 5.83, Query Builder conferido com mesmos resultados
  e 1 SELECT, sem SQL antes de get; rollback/contagens passaram. Entendimento confirmado
  com "entendi" em 20/10/2026 e publicado em 829236f. Na 5.84, count() retornou
  inteiros 2/0 e executou um SELECT COUNT(*) por categoria; rollback/contagens
  conferidos. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em
  fd95bdd. Na 5.85, GROUP BY/COUNT por categoria_id retornou totais 2/1 em um
  SELECT; IDs/rollback/contagens conferidos. Entendimento confirmado com "entendi"
  em 20/10/2026 e publicado em d797c48. Na 5.86, mesmo agrupamento no Builder
  devolveu mesmos grupos/totais 2/1, um SELECT e zero antes de get; rollback
  conferido. Entendimento confirmado com "entendi" em 20/10/2026 e publicado em
  a764ac5. Na 5.87, HAVING COUNT(*) >= 2 retornou só Roupas/2, um SELECT/um grupo;
  rollback/contagens conferidos. Entendimento confirmado com "entendi" em 20/10/2026
  e publicado em 9416c4f. Na 5.88, havingRaw comparado ao SQL retornou só Roupas/2,
  um SELECT por caso, parâmetros separados e zero antes de get; rollback conferido.
  Entendimento confirmado com "entendi" em 20/10/2026 e publicado em 0aa0ebc.
  Na 5.89, LEFT JOIN/COUNT(produtos.id) retornou Roupas/2 e Acessórios/0 em um
  SELECT; IDs/nomes/rollback/contagens conferidos. Entendimento confirmado com
  "entendi" em 21/10/2026 e publicado em d7a9051. Na 5.90, mesmo LEFT JOIN/COUNT
  no Builder retornou mesmos totais 2/0 e nomes em um SELECT; parâmetros/retorno/
  rollback conferidos. Entendimento confirmado com "entendi" em 21/10/2026 e
  publicado em 1d801ae. Na 5.91, withCount retornou models Categoria com totais
  2/0 em um SELECT e coleção produtos sem carregar; rollback conferido. Entendimento
  confirmado com "entendi" em 21/10/2026 e publicado em a5e94b5. Na 5.92, fluxo
  real /loja revisado, binding/SELECT CLI e HTTP 200/Camiseta conferidos. Entendimento
  confirmado com "entendi" em 21/10/2026; publicado em 2964f04, módulo 5 concluído.
  Pausa encerrada em 22/10/2026 a pedido do aluno; etapa 6.1 apresentada,
  entendimento confirmado com "entendi" em 22/10/2026 e publicado em 7ce865a.
  Etapa 6.2 confirmada com "entendi" em 22/10/2026 e publicada em 28450ae.
  Etapa 6.3 confirmada com "entendi" em 22/10/2026 e publicada em d9d0911.
  Etapa 6.4 confirmada com "entendi" em 22/10/2026 e publicada em 7defc2c.
  Etapa 6.5 confirmada com "entendi" em 22/10/2026 e publicada em bc86f52.
  Etapa 6.6 confirmada com "entendi" em 22/10/2026 e publicada em daffb95.
  Etapa 6.7 confirmada com "entendi" em 22/10/2026; publicar e iniciar somente 6.8.
  Exercício manual DBeaver continua sem relato do aluno.
- Ao retomar em novo clone, preparar `src/vendor` com `mkdir -p` e gerar
  autoload pelo comando do README; pasta vazia ignorada e arquivos do volume
  não vêm do Git. Não alterar o contador do volume `dados-demo`.
  Não montar antecipadamente Laravel, banco ou frontend.
- Se o repositório já tiver conteúdo, inspecionar antes de enviar; preservar
  o histórico existente, sem sobrescrever ou fazer force-push.

## Histórico

| Data | Etapa | Implementação | Entendimento | GitHub |
| --- | --- | --- | --- | --- |
| 08/10/2026 | 1.1 — Registros do curso | Três arquivos de documentação criados | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.2 — `.gitignore` e README | Regras de exclusão e apresentação criadas | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.3 — Inicialização do Git | Repositório local criado com branch `main` | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.4 — Preparação dos arquivos | Cinco arquivos selecionados para o primeiro commit | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.5 — Primeiro commit | Commit inicial `afb0d2c` verificado | Confirmado pelo aluno: "entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.6 — Preparação do GitHub | Repositório público criado e `origin` configurado | Confirmado pelo aluno: "criei e entendi" | Publicado no primeiro envio |
| 08/10/2026 | 1.7 — Primeiro push | Envio e acompanhamento de `origin/main` verificados | Confirmado pelo aluno: "entendi", após esclarecimentos SSH | Publicado |
| 08/10/2026 | 2.1 — Imagens, containers e acesso | Conceitos apresentados e consulta ao daemon verificada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `7b9008d` |
| 08/10/2026 | 2.2 — Primeiro container PHP | PHP 8.4.26 executado; container removido e imagem preservada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `0a6c1d2` |
| 08/10/2026 | 2.3 — Primeiro Dockerfile | Imagem própria construída e comando padrão verificado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `ec1765a` |
| 08/10/2026 | 2.4 — Código na imagem | Script PHP copiado e executado com diretório de trabalho definido | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `0ae3e9c` |
| 08/10/2026 | 2.5 — Primeiro Compose | YAML validado e serviço PHP construído e executado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `29ed596` |
| 08/10/2026 | 2.6 — Bind mount | Código local alterado lido sem rebuild; cópia da imagem preservada | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `79c432c` |
| 08/10/2026 | 2.7 — Servidor e portas | HTTP 200, parada normal e reinício verificados; servidor ativo | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `1b7739d` |
| 08/10/2026 | 2.8 — Variável de ambiente | APP_NAME verificada no container e na resposta HTTP | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `42d152b` |
| 08/10/2026 | 2.9 — .env e modelo | Configuração local interpolada; exclusões e HTTP verificados | Confirmado em 09/10 pelo aluno: "entendi" | Publicado no checkpoint `9dd560f`; .env permanece local |
| 09/10/2026 | 2.10 — Volume de dados | Contador persistido entre containers removidos; HTTP preservado | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `99be2d5` |
| 09/10/2026 | 2.11 — Rede interna | Nome php resolvido e HTTP interno/externo verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `72e337e` |
| 09/10/2026 | 3.1 — Primeira classe | Produto tipado criado e utilizado em Docker | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `213486f` |
| 09/10/2026 | 3.2 — Regras do produto | Nome e preço validados; exceção tratada; seis cenários passaram | Confirmado pelo aluno: "entendi", após exemplo de trim | Publicado no checkpoint `ab9ea33` |
| 09/10/2026 | 3.3 — Promoção de propriedades | Construtor simplificado; demonstração e oito verificações passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `83f190b` |
| 09/10/2026 | 3.4 — Namespace e use | Classe Loja\Produto importada; sintaxe e oito verificações passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `253617c` |
| 09/10/2026 | 3.5 — Composer no Docker | Imagem construída; versão, demonstração e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `5360ccb` |
| 09/10/2026 | 3.6 — Configuração Composer | JSON validado com aviso de licença; mapeamento de Produto conferido | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `3e28669` |
| 09/10/2026 | 3.7 — Volume vendor | Volume gravável e persistente; código somente leitura, contador e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `07db654` |
| 09/10/2026 | 3.8 — Autoload Composer | Arquivos gerados; classe carregada por demanda e comportamentos verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `af61127` |
| 09/10/2026 | 3.9 — Enum de estados | Enum e exemplo criados; autoload, casos e tipagem verificados | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `377860a` |
| 09/10/2026 | 3.10 — Estado de Produto | Estado tipado, padrão e getter; sintaxe e onze cenários passaram | Confirmado pelo aluno: "entendi" | Publicado no checkpoint `a0e1042` |
| 09/10/2026 | 3.11 — Ações de Produto | Ativar e desativar; retomada e demonstração em 12/10 | Confirmado pelo aluno: "entendi", em 12/10/2026 | Código em `8d54d1a`; confirmação `0c2106b` publicada no envio de `846ada2` |
| 12/10/2026 | 3.12 — Interface Precificavel | Contrato e implements; sintaxe, demonstração e parâmetro tipado verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em `846ada2` |
| 12/10/2026 | 3.13 — Composição com ItemCarrinho | Classe, getters e quantidade positiva; sintaxe e experiência verificadas | Confirmado pelo aluno: "entendi", após esclarecimento | Publicado e verificado em `197470b` |
| 12/10/2026 | 3.14 — Subtotal do item | Método e exemplo persistente; sintaxe, três cálculos e HTTP verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em `b45dc75` |
| 12/10/2026 | 3.15 — Requisitos de PHPUnit | Conceito e diagnóstico documentados; PHP e extensões atendem aos requisitos | Confirmado pelo aluno: "entendi" | Publicado e verificado em `3dba56d` |
| 12/10/2026 | 3.16 — Instalação de PHPUnit | PHPUnit 13.4.1, lockfile e unzip; instalação e verificações passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `9a9c43a` |
| 12/10/2026 | 3.17 — Primeiro teste PHPUnit | Teste do subtotal de três unidades; sintaxe e uma asserção passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `071aacd` |
| 12/10/2026 | 3.18 — Teste de quantidade zero | Expectativa de exceção acrescentada; sintaxe e dois testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `9d6ceb0` |
| 12/10/2026 | 3.19 — Teste de quantidade negativa | Cenário -1 acrescentado; sintaxe e três testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `188ff33` |
| 12/10/2026 | 3.20 — Teste da menor quantidade válida | Quantidade 1 e subtotal 4990; sintaxe e quatro testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `95630cd` |
| 12/10/2026 | 3.21 — Teste de preço zero | Produto gratuito e subtotal 0; sintaxe e cinco testes passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em `a5caa53` |
| 12/10/2026 | 3.22 — Revisão do módulo 3 | Revisão e demonstração concluídas; módulo 3 encerrado | Confirmado pelo aluno: "entendi" | Publicado e verificado em `7a4dc00` |
| 12/10/2026 | 4.1 — Preparação para Laravel | Papel e organização documentados; PHP, Composer e treze extensões conferidos | Confirmado pelo aluno: "entendi", em 13/10/2026 | Publicado e verificado em `9807e53` |
| 13/10/2026 | 4.2 — Esqueleto Laravel | Modelo v13.11.0 e 58 arquivos; JSON, quatro sintaxes e artefatos adiados conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em cfa2e69 |
| 13/10/2026 | 4.3 — Serviço Docker do backend | Serviço e volume exclusivos; PHP/Composer, montagens e persistência verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em dc9f4b8 |
| 13/10/2026 | 4.4 — Dependências Laravel | 76 pacotes instalados, lockfile e autoload gerados; validação, plataforma e classes conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 4c6df27 |
| 13/10/2026 | 4.5 — Pastas graváveis | Montagens de storage e bootstrap/cache; escrita, leitura e limpeza verificadas | Confirmado pelo aluno: "entendi" | Publicado e verificado em 7c0fcea |
| 13/10/2026 | 4.6 — Ambiente Laravel | Modelo adaptado, cópia local criada; leitura de variáveis, tipos e exclusões conferidas | Confirmado pelo aluno: "entendi" | Publicado e verificado em ae521c9; .env ignorado |
| 13/10/2026 | 4.7 — Artisan e chave | Console inicializado, chave local e manifests gerados; criptografia e carregamento conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 590f98a; chave e manifests ignorados |
| 13/10/2026 | 4.8 — Servidor Laravel | Backend na porta 8002; welcome HTTP 200, artefatos e parada/reinício verificados | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6ccf825 |
| 13/10/2026 | 4.9 — Primeira rota da loja | GET /loja com saudação configurada; sintaxe, registro e respostas conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1671a0b |
| 13/10/2026 | 4.10 — Primeiro controller | LojaController@index ligado à rota; sintaxes, registro e resposta preservada conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em f31b38e |
| 13/10/2026 | 4.11 — Primeira view Blade | Template loja e dados pelo controller; sintaxe, HTTP, renderização e escape conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1d93ab8 |
| 13/10/2026 | 4.12 — Lista com Blade | Nomes demonstrativos e @foreach; sintaxe e três itens renderizados conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 37b7485 |
| 13/10/2026 | 4.13 — Lista vazia | Condição Blade e mensagem; listas preenchida/vazia renderizadas e HTTP conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em b944f4e |
| 13/10/2026 | 4.14 — Primeiro middleware | Classe ligada a /loja; sintaxes, cabeçalho, conteúdo e escopo HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 354626c |
| 13/10/2026 | 4.15 — Injeção no método | Classe de catálogo recebida pelo controller; sintaxes e HTTP preservado conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em dca8ccd |
| 13/10/2026 | 4.16 — Injeção no construtor | Propriedade promovida e acesso por $this; sintaxe e HTTP preservado conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5da3709 |
| 13/10/2026 | 4.17 — Contrato e binding | Interface, implementação, controller e provider; sintaxes, resolução e HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 92d6e5f |
| 13/10/2026 | 4.18 — Papel do Model | User existente explicado e atributos demonstrados em memória; código preservado | Confirmado pelo aluno: "entendi" | Publicado e verificado em aa372c6 |
| 13/10/2026 | 4.19 — Revisão do módulo 4 | Fluxo e entrega revisados; módulo 4 concluído | Confirmado pelo aluno: "entendi" | Publicado e verificado em 2346772 |
| 13/10/2026 | 5.1 — Preparação SQL Server | Recursos Docker, PHP e compatibilidade conferidos; sem instalação | Confirmado pelo aluno: "entendi" | Publicado e verificado em 41d0660 |
| 13/10/2026 | 5.2 — ODBC no backend | Imagem própria, ODBC 18.7.1.1-1 e recriação; bibliotecas/plataforma/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5709dfe |
| 13/10/2026 | 5.3 — Extensões SQL Server | sqlsrv/pdo_sqlsrv 5.13.3 via PIE 1.5.2; carregamento, PDO, .ini, plataforma e HTTP conferidos | Confirmado pelo aluno: "entendi", após esclarecimento PIE | Publicado e verificado em 5ba53e2 |
| 13/10/2026 | 5.4 — Serviço SQL Server | Imagem fixa, volume e senha local; inicialização, versão, edição, SELECT 1 e rede conferidos | Confirmado pelo aluno: "entendi", após dúvidas de acesso | Publicado e verificado em d9fba40; .env ignorado |
| 13/10/2026 | 5.5 — Bancos loja e loja_test | SQL de preparação; estado, arquivos, conexões e reexecução conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em fc2cdbc |
| 13/10/2026 | 5.6 — Acesso DBeaver | Porta local conferida; aluno relatou "apareceu loja" na consulta pelo DBeaver | Confirmado pelo aluno: "entendi", após resultado de acesso | Publicado e verificado em c7f58ee |
| 13/10/2026 | 5.7 — Login e usuário da aplicação | loja_app em loja, senha local e papéis; autenticação/escopo/reexecução conferidos | Confirmado pelo aluno: "entendi", após dúvidas | Publicado e verificado em 063e4eb; .env ignorado |
| 14/10/2026 | 5.8 — Configuração Laravel | Modelo, configuração e senha local; sintaxe/carregamento/preservação/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em e0e06ef; .env ignorado |
| 14/10/2026 | 5.9 — Primeira consulta Laravel | Comando diagnóstico; sintaxe/ajuda/SQL real/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 173ed00; .env ignorado |
| 14/10/2026 | 5.10 — Modelagem de produtos | Desenho, tipos, chave primária e exemplos revisados; sem tabela criada | Confirmado pelo aluno: "entendi" | Publicado e verificado em b160a68 |
| 14/10/2026 | 5.11 — Primeiro arquivo de migration | Gerador, sintaxe, carregamento e ausência de tabelas conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 3e5cb93 |
| 14/10/2026 | 5.12 — Colunas de produtos | Blueprint preenchido, sintaxe e SQL simulado conferidos; tabela ausente | Confirmado pelo aluno: "entendi" | Publicado e verificado em bbec195 |
| 14/10/2026 | 5.13 — Conta de migrations | Conta criada após autorização explícita; autenticação/permissões/escopo/reexecução conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 94e3322; .env ignorado |
| 14/10/2026 | 5.14 — Conexão Laravel de migrations | Modelo/configuração e senha local; sintaxe/conexões/permissões/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 26e7b5b; .env ignorado |
| 14/10/2026 | 5.15 — Aplicar migration de produtos | Tabela vazia, esquema e registro lote 1; reexecução/status/HTTP conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 36db8e8 |
| 15/10/2026 | 5.16 — Primeiro model Produto | Gerador, sintaxe/autoload/herança e convenções em memória conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em a953fa4 |
| 15/10/2026 | 5.17 — Fillable no Produto | Arrays, descarte de extras e alcance sem validação conferidos em memória | Confirmado pelo aluno: "entendi" | Publicado e verificado em 340d6ea |
| 15/10/2026 | 5.18 — Cast inteiro do preço | Leitura/toArray/fill e limites de conversão conferidos em memória | Confirmado pelo aluno: "entendi" | Publicado e verificado em adb466c |
| 15/10/2026 | 5.19 — Consulta Eloquent | Comando, coleção vazia, SELECT real e HTTP conferidos; sem escrita | Confirmado pelo aluno: "entendi" | Publicado e verificado em 133591a |
| 15/10/2026 | 5.20 — Estrutura do primeiro seeder | ProdutoSeeder gerado; sintaxe/autoload/herança/assinatura conferidos sem SQL | Confirmado pelo aluno: "entendi" | Publicado e verificado em e811031 |
| 15/10/2026 | 5.21 — Cadastro escrito no seeder | Produto::create escrito com Camiseta; sintaxe e atributos revisados, sem execução | Confirmado pelo aluno: "entendi" | Publicado e verificado em 9da189c |
| 15/10/2026 | 5.22 — Primeiro produto persistido | Seeder executado uma vez; Camiseta relida em outro processo e quantidade 1 conferidas | Confirmado pelo aluno: "entendi" | Publicado e verificado em 9d03edc |
| 15/10/2026 | 5.23 — Leitura dos atributos do Produto | foreach e leitura de atributos no comando; sintaxe e saída real conferidas, sem gravação | Confirmado pelo aluno: "entendi" | Publicado e verificado em 11f46d2 |
| 15/10/2026 | 5.24 — Busca antes do cadastro no seeder | firstOrCreate preparado com busca/dados separados; sintaxe conferida, sem execução | Confirmado pelo aluno: "entendi" | Publicado e verificado em 162b7aa |
| 15/10/2026 | 5.25 — Reexecução sequencial do seeder | Duas chamadas só SELECT; quantidade/id/atributos/datas preservados e leitura posterior conferida | Confirmado pelo aluno: "entendi" | Publicado e verificado em 8ec24b4 |
| 15/10/2026 | 5.26 — Catálogo com leitura Eloquent | Serviço cumpre interface; sintaxe/autoload/retorno/SELECT conferidos, binding preservado | Confirmado pelo aluno: "entendi", em 16/10/2026 | Publicado e verificado em f14564c |
| 16/10/2026 | 5.27 — Página com catálogo do banco | Binding, sintaxe/resolução e HTTP 200 com um produto do banco conferidos | Confirmado pelo aluno: "entrendi" | Publicado e verificado em 0eb7973 |
| 16/10/2026 | 5.28 — Textos da página do catálogo | Dois textos da view ajustados; HTTP 200 com novo título e Camiseta conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1cd8038 |
| 16/10/2026 | 5.29 — Filtro de produtos ativos | where implementado; sintaxe/SQL com parâmetro/retorno ativo/HTTP conferidos, sem gravação | Confirmado pelo aluno: "entendi" | Publicado e verificado em 7199685 |
| 16/10/2026 | 5.30 — Ordenação dos nomes do catálogo | orderBy implementado; sintaxe/SQL com ASC/retorno/HTTP conferidos, somente leitura | Confirmado pelo aluno: "entendi" | Publicado e verificado em 8a61f8d |
| 16/10/2026 | 5.31 — Preparação dos testes do backend | Ferramentas/lock/XML/banco diagnosticados; plataforma e simulação passaram, sem instalação | Confirmado pelo aluno: "entendi" | Publicado e verificado em 4233936 |
| 16/10/2026 | 5.32 — Ferramentas de testes instaladas | 33 pacotes instalados; PHPUnit/plataforma/109 versões/autoload conferidos, sem suíte | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6d86416 |
| 16/10/2026 | 5.33 — Descoberta dos pacotes de desenvolvimento | Seis pacotes/manifests, ajuda de test, sintaxe e HTTP conferidos, sem suíte | Confirmado pelo aluno: "entendi" | Publicado e verificado em f14a335 |
| 16/10/2026 | 5.34 — Script da conta exclusiva de testes | SQL preparado; PARSEONLY passou, sem DDL aplicado; revisão em 19/10 | Confirmado pelo aluno: "entendi", em 19/10/2026 | Confirmação publicada e verificada em 49a22c5 |
| 19/10/2026 | 5.35 — Aplicação da conta exclusiva de testes | Senha local e conta criadas; autenticação, permissões, isolamento e reexecução conferidos; zero tabelas | Confirmado pelo aluno: "entendi" | Publicado e verificado em 04a9a7c |
| 19/10/2026 | 5.36 — Modelo do ambiente Laravel de testes | Modelo público e exceção Git preparados; análise phpdotenv e exclusões conferidas, sem configuração local | Confirmado pelo aluno: "entendi" | Publicado e verificado em 1c8c380 |
| 19/10/2026 | 5.37 — Configuração local Laravel de testes | .env.testing local criado; chave própria, carregamento, criptografia e SELECT em loja_test conferidos; ambiente normal preservado | Confirmado pelo aluno: "entendi" | Publicado e verificado em d80d241; segredos ignorados |
| 19/10/2026 | 5.38 — Configuração PHPUnit para SQL Server | Duas entradas XML ajustadas; XSD, carregador de variáveis e SELECT Laravel conferidos, sem suíte | Confirmado pelo aluno: "entendi", após esclarecer APP_ENV | Publicado e verificado em 734fc5f |
| 19/10/2026 | 5.39 — Primeira execução dos testes de exemplo do backend | Dois exemplos existentes executados: 2 testes/2 asserções; SELECT separado confirmou zero tabelas | Confirmado pelo aluno: "entendi" | Publicado e verificado em bdfb1a3 |
| 19/10/2026 | 5.40 — Tabela produtos no banco de testes | Migration existente aplicada em loja_test; esquema, registro lote 1, status e reexecução conferidos; zero produtos | Confirmado pelo aluno: "entendi" | Publicado e verificado em b70f6f0 |
| 19/10/2026 | 5.41 — Primeiro teste de integração do catálogo vazio | Um cenário com transação/rollback; focado 1 teste/3 asserções e suíte 3 testes/5 asserções; estado dos bancos conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 94e4e3d |
| 19/10/2026 | 5.42 — Produto ativo e preparação compartilhada | setUp compartilhado e segundo cenário; focado 2 testes/6 asserções e suíte inversa 4 testes/8 asserções; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em aa8e5a4 |
| 19/10/2026 | 5.43 — Teste do filtro de produtos inativos | Terceiro cenário com ativo/inativo; focado 3 testes/9 asserções e suíte 5 testes/11 asserções; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 62f465e |
| 19/10/2026 | 5.44 — Teste da ordenação do catálogo | Quarto cenário com dois ativos; focado 4 testes/12 asserções e suíte 6 testes/14 asserções; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5810b26 |
| 19/10/2026 | 5.45 — Estrutura da factory de Produto | Gerador criou somente classe; sintaxe, autoload, herança e modelName conferidos; definição vazia e zero SQL observado | Confirmado pelo aluno: "entendi" | Publicado e verificado em 3e094e5 |
| 19/10/2026 | 5.46 — Atributos padrão da factory de Produto | Definição preenchida; sintaxe e dez arrays conferidos, sem models ou SQL | Confirmado pelo aluno: "entendi", após esclarecer os métodos | Publicado e verificado em 77dc3f9 |
| 19/10/2026 | 5.47 — Produto em memória pela factory | new()->make() retornou Produto, exists false/ID e datas null, atributos previstos e zero SQL | Confirmado pelo aluno: "entendi" | Publicado e verificado em d90a8a4 |
| 19/10/2026 | 5.48 — HasFactory no model Produto | Atalho resolve factory/monta Produto em memória, sem SQL; suíte existente 6 testes/14 asserções passou | Confirmado pelo aluno: "entendi", após dúvida sobre local da demonstração | Publicado e verificado em d465778 |
| 19/10/2026 | 5.49 — Factory no teste de ativo | Cadastro pela factory com nome/status definidos; teste 1/3 e suíte 6/14 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 9a08b80 |
| 19/10/2026 | 5.50 — Factory no cenário ativo/inativo | Dois cadastros com nome/status explícitos e preço padrão; teste 1/3 e suíte 6/14 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 10e723b |
| 19/10/2026 | 5.51 — Factory no cenário de ordenação | Dois cadastros com nomes controlados e preço padrão; teste 1/3 e suíte 6/14 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5152ba4 |
| 19/10/2026 | 5.52 — Estado inativo na factory | Método inativo com state; make conferido em memória sem SQL, padrão ativo preservado; suíte existente 6/14 passou | Confirmado pelo aluno: "entendi" | Publicado e verificado em edd3411 |
| 19/10/2026 | 5.53 — Estado inativo aplicado ao teste | Cadastro da Caneca usa inativo()->create; teste 1/3 e suíte 6/14 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6ac5518 |
| 19/10/2026 | 5.54 — Leitura do DatabaseSeeder | Código gerado explicado; sintaxe/reflexão e SELECTs passaram, users ausente; seeder não executado | Confirmado pelo aluno: "entendi", após nova explicação | Publicado e verificado em def2f14 |
| 19/10/2026 | 5.55 — Revisão do ProdutoSeeder existente | Corrigido plano de geração duplicada; arquivo preservado/revisado, sintaxe passou; sem execução | Confirmado pelo aluno: "entendi" | Publicado e verificado em 0f754ae |
| 19/10/2026 | 5.56 — DatabaseSeeder chama ProdutoSeeder | Exemplo User substituído por call de ProdutoSeeder; sintaxe/autoload passaram, sem execução | Confirmado pelo aluno: "entendi" | Publicado e verificado em 07af123 |
| 19/10/2026 | 5.57 — Execução do seeder padrão com rollback | db:seed em loja_test chamou ProdutoSeeder, criou Camiseta, catálogo conferido; rollback/contagens passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5c65e6d |
| 19/10/2026 | 5.58 — Modelagem categorias/produtos | Um para muitos, chave primária/estrangeira e referências explicados com exemplos; somente documentação | Confirmado pelo aluno: "entendi" em 20/10/2026 | Publicado e verificado em f680b99 |
| 20/10/2026 | 5.59 — Migration de categorias | Artisan gerou migration; nome string(150) e timestamps(3) preparados, sintaxe passou; sem aplicar | Confirmado pelo aluno: "entendi" | Publicado e verificado em 9e89010 |
| 20/10/2026 | 5.60 — Categorias no banco de testes | Migration aplicada em loja_test, esquema/status/reexecução conferidos; categorias/produtos vazios, duas migrations | Confirmado pelo aluno: "entemdi" | Publicado e verificado em 04ab6bb |
| 20/10/2026 | 5.61 — Categorias no banco da aplicação | Migration aplicada em loja com loja_migracoes; esquema/status/reexecução e produto preservado conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 4d3358d |
| 20/10/2026 | 5.62 — Model Categoria | Classe gerada, Fillable de nome; sintaxe/configuração em memória passaram, zero SQL | Confirmado pelo aluno: "entendi" | Publicado e verificado em e57dbbe |
| 20/10/2026 | 5.63 — Cadastro/leitura de Categoria | Create/findOrFail em loja_test conferidos, ID/datas preenchidos e rollback para zero categorias | Confirmado pelo aluno: "entendi" | Publicado e verificado em ce67886 |
| 20/10/2026 | 5.64 — Migration categoria_id em produtos | Coluna anulável/FK e noActionOnDelete preparados; down remove FK/coluna; sintaxe passou, sem aplicar | Confirmado pelo aluno: "entendi" | Publicado e verificado em e5e6156 |
| 20/10/2026 | 5.65 — Tentativa da FK e REFERENCES | Migrate falhou por permissão; coluna/FK ausentes e Pending confirmados; suíte não executada | Descoberta confirmada pelo aluno: "entendi" | Publicado e verificado em 91ed884 |
| 20/10/2026 | 5.66 — Script REFERENCES para testes | GRANT restrito preparado; PARSEONLY passou, permissão continua 0, migration Pending | Confirmado pelo aluno: "entendi" | Publicado e verificado em 3924613 |
| 20/10/2026 | 5.67 — REFERENCES e FK no teste | Concessão e migration aplicadas; coluna/FK/histórico conferidos, suíte 6/14 passou e teste vazio após rollback | Confirmado pelo aluno: "entendi" | Publicado e verificado em e384ae1 |
| 20/10/2026 | 5.68 — REFERENCES e FK em loja | Concessão/migration aplicadas; FK/histórico e produto preservado com categoria_id NULL conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 55f7ea8 |
| 20/10/2026 | 5.69 — Produto belongsTo Categoria | Fillable e método categoria adicionados; configuração em memória/zero SQL e suíte 6/14 passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6292b4b |
| 20/10/2026 | 5.70 — Leitura da categoria relacionada | Novo teste com categoria/produto persistidos e leitura pela propriedade; focado 1/5 e suíte 7/19 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 68b586f |
| 20/10/2026 | 5.71 — Produto sem categoria | Segundo cenário confere FK/relação null após recarga; focado 2/9 e suíte 8/23 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em e41a1d4 |
| 20/10/2026 | 5.72 — Categoria hasMany Produto | Definição da relação inversa, sintaxe/configuração em memória com zero SQL e suíte existente 8/23 passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em 593cb81 |
| 20/10/2026 | 5.73 — Produtos da categoria | Primeiro teste hasMany confere coleção de dois produtos e exclusão de outra categoria; focado 1/5 e suíte 9/28 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 6ad0d19 |
| 20/10/2026 | 5.74 — Categoria sem produtos | Segundo cenário exige coleção com zero elementos; focado 2/9 e suíte 10/32 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 5b9d800 |
| 20/10/2026 | 5.75 — Produtos ativos da categoria | Terceiro cenário usa produtos()->where/get, exige somente ativo da categoria; focado 3/13 e suíte 11/36 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 617408b |
| 20/10/2026 | 5.76 — Associar produto à categoria | Associate em memória e save/recarga conferidos; falha inicial por tipo da FK corrigida na asserção; focado final 3/15 e suíte 12/42 passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em 0730204 |
| 20/10/2026 | 5.77 — Dissociar produto da categoria | Dissociate em memória e save/recarga conferidos, FK/relação null e categoria preservada; focado 4/22 e suíte 13/49 passaram | Confirmado pelo aluno: "entendi" | Publicado e verificado em 7d94759 |
| 20/10/2026 | 5.78 — Carregamento sob demanda e N+1 | Diagnóstico temporário em loja_test conferiu 1+3=4 SELECTs, nomes e rollback; somente documentação alterada | Confirmado pelo aluno: "entendi" | Publicado e verificado em 55d0045 |
| 20/10/2026 | 5.79 — Carregamento antecipado com with | Diagnóstico comparativo confirmou mesmos resultados, 4 versus 2 SELECTs e zero SQL extra no foreach com with; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 70d44b5 |
| 20/10/2026 | 5.80 — Teste de carregamento antecipado | Quinto cenário exige nomes corretos e duas consultas, sem SQL extra no foreach; focado 5/27 e suíte 14/54 passaram, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 3627952 |
| 20/10/2026 | 5.81 — INNER JOIN produtos/categorias | Diagnóstico parametrizado retornou somente produto associado, 1 SELECT/1 linha; produto sem categoria preservado, rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em dca90ec |
| 20/10/2026 | 5.82 — LEFT JOIN produtos/categorias | INNER 1 SELECT/1 linha e LEFT 1 SELECT/2 linhas, incluindo Caneca/null; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em c700173 |
| 20/10/2026 | 5.83 — LEFT JOIN Query Builder | SQL e Builder com mesmos nomes/null, 1 SELECT por caso e zero antes de get; Collection/stdClass e rollback conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em 829236f |
| 20/10/2026 | 5.84 — Count de produtos por categoria | Count retornou inteiros 2/0, um SELECT COUNT(*) por categoria sem carregar lista; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em fd95bdd |
| 20/10/2026 | 5.85 — GROUP BY categoria | SQL parametrizado agrupou produtos por categoria_id, um SELECT/dois grupos com totais 2/1; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em d797c48 |
| 20/10/2026 | 5.86 — GROUP BY Query Builder | SQL/Builder mesmos grupos e totais 2/1, um SELECT por caso e zero antes de get; retorno/rollback conferidos | Confirmado pelo aluno: "entendi" | Publicado e verificado em a764ac5 |
| 20/10/2026 | 5.87 — HAVING grupos | SQL parametrizado filtrou grupos com COUNT(*) >= 2, somente Roupas/2 em um SELECT; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 9416c4f |
| 20/10/2026 | 5.88 — HAVING Query Builder | SQL/havingRaw mesmos grupo Roupas/2, um SELECT por caso, parâmetros separados e zero antes de get; rollback conferido | Confirmado pelo aluno: "entendi" | Publicado e verificado em 0aa0ebc |
| 20/10/2026 | 5.89 — LEFT JOIN e COUNT produtos | SQL contou produtos por categoria, incluindo vazia com total 0; Roupas/2 e Acessórios/0 em um SELECT, rollback conferido | Confirmado pelo aluno: "entendi" em 21/10/2026 | Publicado e verificado em d7a9051 |
| 21/10/2026 | 5.90 — LEFT JOIN/COUNT Query Builder | SQL/Builder mesmos IDs/nomes/totais 2/0, um SELECT por caso e zero antes de get; retorno/parâmetros/rollback conferidos | Confirmado pelo aluno: "entendi" em 21/10/2026 | Publicado e verificado em 1d801ae |
| 21/10/2026 | 5.91 — WithCount produtos | Models Categoria com produtos_count 2/0, um SELECT e coleção produtos não carregada; tipos/IDs/nomes/rollback conferidos | Confirmado pelo aluno: "entendi" em 21/10/2026 | Publicado e verificado em a5e94b5 |
| 21/10/2026 | 5.92 — Revisão catálogo persistido | Fluxo rota/controller/contrato/binding/Eloquent/SQL/view revisado; binding/SELECT CLI e HTTP 200/Camiseta conferidos, contagens preservadas | Confirmado pelo aluno: "entendi" em 21/10/2026; módulo 5 concluído | Publicado e verificado em 2964f04 |
| 22/10/2026 | 6.1 — HTTP, HTML e JSON | Introdução à API e requisição/resposta; GET /loja real com 200, text/html e Camiseta; somente documentação | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em 7ce865a |
| 22/10/2026 | 6.2 — Primeira rota JSON | Registro/prefixo/rota, contrato inicial e HTTP real JSON/HTML conferidos; suíte 14/54 passou, contagens preservadas | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em 28450ae |
| 22/10/2026 | 6.3 — Teste HTTP catálogo vazio | Novo teste com transação/banco exclusivo, status/cabeçalho/JSON; focado 1/6 e suíte 15/60 passaram, contagens preservadas | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em d9d0911 |
| 22/10/2026 | 6.4 — Produto ativo no JSON | Segundo cenário HTTP via factory; classe 2/12 e suíte 16/66 passaram, rollback e contagens conferidos | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em 7defc2c |
| 22/10/2026 | 6.5 — Omitir inativo no JSON | Terceiro cenário HTTP com estado inativo; classe 3/18 e suíte 17/72 passaram, rollback e contagens conferidos | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em bc86f52 |
| 22/10/2026 | 6.6 — Ordenação no JSON | Quarto cenário HTTP com cadastros invertidos; classe 4/24 e suíte 18/78 passaram, rollback e contagens conferidos | Confirmado pelo aluno: "entendi" em 22/10/2026 | Publicado e verificado em daffb95 |
| 22/10/2026 | 6.7 — Controller da API | Função extraída e rota ligada a index; classe 4/24, suíte 18/78, HTTP real JSON/HTML e contagens conferidos | Confirmado pelo aluno: "entendi" em 22/10/2026 | Pronto para commit/push; conferir remoto após envio |
