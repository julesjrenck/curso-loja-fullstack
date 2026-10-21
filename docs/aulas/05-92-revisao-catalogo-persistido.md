# Aula 5.92 — Revisão do catálogo persistido

## Objetivo e estado

Revisar a entrega do módulo 5 acompanhando a página da loja até o SQL Server.
Revisão, explicação e verificações em 21/10/2026; entendimento confirmado com
"entendi" na mesma data. Módulo 5 concluído; módulo 6 não iniciado.
A publicação deste checkpoint é registrada em docs/progresso.md.

5.91 confirmada com "entendi" e publicada em
a5e94b5a2821796830b17e2b2fc1fbd550355fef. HEAD, origin/main e consulta direta
à main remota coincidiram após o push.

## Caminho dos dados

| Arquivo | Papel no fluxo atual |
| --- | --- |
| backend/routes/web.php | GET /loja aponta para LojaController@index e usa MarcarRespostaCurso. |
| backend/app/Http/Controllers/LojaController.php | Recebe Catalogo pelo construtor, chama listarNomes e envia produtos/nomeLoja à view. |
| backend/app/Contracts/Catalogo.php | Define que listarNomes retorna array. |
| backend/app/Providers/AppServiceProvider.php | Liga o contrato Catalogo à implementação CatalogoEloquent no container. |
| backend/app/Services/CatalogoEloquent.php | Consulta produtos ativos pelo model Produto, ordena e devolve nomes. |
| backend/app/Models/Produto.php | Representa os produtos persistidos; Eloquent usa a conexão SQL Server configurada. |
| backend/resources/views/loja.blade.php | Renderiza nomes em itens de lista ou a mensagem de catálogo vazio; aplica escape do Blade. |
| backend/app/Http/Middleware/MarcarRespostaCurso.php | Acrescenta X-Curso: Laravel à resposta da rota. |

O binding informa qual implementação o Laravel deve entregar quando o controller
pede o contrato Catalogo. O controller usa esse contrato para obter os nomes e
entregar os dados à view. A consulta está concentrada em CatalogoEloquent:

```php
return Produto::query()
    ->where('status', 'ativo')
    ->orderBy('nome')
    ->pluck('nome')
    ->all();
```

Where filtra os ativos; orderBy ordena por nome; pluck busca somente a coluna
nome e devolve uma coleção de valores; all converte essa coleção para array.
Na view, cada elemento de produtos é uma string com o nome, conforme o contrato.

A página atual apresenta nomes de produtos ativos em ordem. Relacionamentos,
joins e contagens foram estudados em testes ou diagnósticos acompanhados.
Migrations organizaram a estrutura, ProdutoSeeder cadastrou Camiseta e as
factories prepararam os dados fictícios usados nos testes/demonstrações.

## Verificação executada

Somente documentação alterada. Diagnóstico temporário
/tmp/curso-592-revisar-catalogo.php executado no ambiente normal pelo PHP Docker:

```bash
docker compose exec -T backend php < /tmp/curso-592-revisar-catalogo.php
```

Exec usa backend iniciado; -T dispensa terminal interativo. Redirecionamento envia
script local ao PHP no container. Script carrega autoload/bootstrap de /app e
confere banco loja/login loja_app antes de consultar. Não usa --env=testing,
pois está revisando a página servida pelo ambiente normal, somente por leitura.

Primeiro resolve Catalogo pelo container, exige CatalogoEloquent e chama
listarNomes. Listener DB::listen registra SELECT dessa chamada CLI. Depois faz
requisição HTTP real a http://127.0.0.1:8000/loja dentro do backend, usando
file_get_contents com timeout de dez segundos. No host, a mesma página está
disponível em http://127.0.0.1:8002/loja pela porta publicada no Compose.

Resultado:

```text
Binding: Catalogo -> CatalogoEloquent | banco/login: loja/loja_app
listarNomes: ["Camiseta"] | 1 SELECT
SQL do catálogo: select [nome] from [produtos] where [status] = ? order by [nome] asc
GET /loja: HTTP 200 | X-Curso: Laravel | itens HTML: Camiseta
Revisão de leitura concluída; nenhum cadastro ou alteração de produto executado.
```

O parâmetro do filtro é ativo. Um SELECT foi medido na chamada CLI do serviço;
a requisição HTTP é um processo separado e suas queries não foram contadas.
HTTP 200, cabeçalho do middleware, título Catálogo de produtos e item Camiseta
no HTML foram conferidos. Código 0.

Consultas posteriores pelo diagnóstico da 5.69 em processos PHP Docker separados
conferiram loja_test/loja_testes com 0 categorias/0 produtos/3 migrations e
loja/loja_app com 0/1/3. Somente leitura, sem necessidade de cadastro ou rollback
nesta revisão. Aplicação/testes preservados; suíte não reexecutada. Última execução
permanece 14 testes/54 asserções da 5.80. Git diff --check passou; segredos fora do índice.

## Pendências e continuidade

O acesso ao DBeaver foi confirmado na 5.6. A consulta manual sugerida na 5.22
continua sem relato de execução pelo aluno. As verificações atuais por ferramenta
não substituem esse relato. É uma atividade sugerida de acompanhamento; o curso
não exige que o aluno implemente sozinho para continuar.

Revisão confirmada; módulo 5 encerrado em 21/10/2026. O aluno confirmou o
encerramento e decidiu iniciar o módulo 6 — APIs REST em outro momento.
Curso em pausa; aguardar pedido de retomada antes de apresentar novo conteúdo.
