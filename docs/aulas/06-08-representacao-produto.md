# Aula 6.8 — Desenho da representação JSON de produto

## Objetivo e estado

Desenhar a próxima representação de produto e explicar o impacto no contrato,
no serviço e nos testes. Somente documentação nesta etapa, em 22/10/2026.
Explicação apresentada; entendimento confirmado pelo aluno com "entendi" em
22/10/2026. A API executável
continua retornando {"data":["Camiseta"]}.

Etapa anterior 6.7 confirmada com "entendi" em 22/10/2026 e publicada em
0c2a14ed063ad24ec4698ef2cc2f511687055ecd. HEAD, origin/main e main consultada
diretamente no remoto coincidiram após git push origin main.

## Problema da loja

Um nome permite exibir o texto Camiseta, mas a vitrine também precisará mostrar
o preço e identificar qual produto o cliente escolheu. O ID identifica o produto;
o nome pode se repetir ou mudar. Vamos evoluir cada item da lista para um objeto
com três campos já existentes em produtos, sem criar colunas nesta etapa.

O JSON abaixo é um exemplo planejado, ainda não retornado pela rota. ID 1 e
preço 4990 são ilustrativos; não representam uma consulta ao banco nesta aula.

```json
{
  "data": [
    {
      "id": 1,
      "nome": "Camiseta",
      "preco_em_centavos": 4990
    }
  ]
}
```

O objeto externo contém data. Data é uma lista; cada elemento dela passa a ser
um objeto com atributos de um produto. O texto Camiseta antes ocupava sozinho
uma posição da lista; no desenho novo ele será o valor da propriedade nome.

| Campo planejado | Tipo JSON | Significado |
| --- | --- | --- |
| id | inteiro | Identificador do produto persistido. |
| nome | string | Nome para apresentação ao cliente. |
| preco_em_centavos | inteiro | Preço expresso em centavos: 4990 corresponde a R$ 49,90. |

Os três campos serão obrigatórios e não nulos nessa representação. Preço em
centavos mantém a unidade já utilizada no banco e no model. O frontend poderá
formatar esse valor em reais; a API entregará o número, sem texto monetário
formatado. Esta etapa não adiciona regras de validação de preço ou cadastro.

A lista vazia manterá o formato:

```json
{"data":[]}
```

O desenho conserva GET /api/v1/produtos, status 200, Content-Type application/json,
somente produtos ativos e ordenação crescente por nome, sem paginação nesta fase.
Categoria, status e timestamps não entram nessa representação inicial. O status
continua sendo usado pelo filtro. A representação pública seleciona os campos
necessários ao consumidor; não precisa reproduzir todas as colunas da tabela.

## Relação com os arquivos existentes

| Arquivo | Consequência do desenho para etapas futuras |
| --- | --- |
| backend/database/migrations/2026_10_14_123220_create_produtos_table.php | Os três campos já existem; nenhuma migration é necessária para esse formato. |
| backend/app/Models/Produto.php | Model já possui os atributos e cast inteiro de preco_em_centavos. |
| backend/app/Contracts/Catalogo.php | ListarNomes promete apenas nomes; não mudar silenciosamente o significado desse método. |
| backend/app/Services/CatalogoEloquent.php | Pluck('nome') busca só nomes; será necessária uma leitura que também forneça ID e preço. |
| backend/app/Http/Controllers/Api/V1/ProdutoController.php | Hoje entrega listarNomes; depois utilizará a leitura e a transformação preparadas para produtos. |
| backend/app/Http/Controllers/LojaController.php e view loja | Consomem strings do catálogo; preservar esse fluxo ao preparar o da API. |
| backend/tests/Feature/CatalogoApiTest.php | Cenários com produtos precisarão esperar objetos com os três campos. |

O exemplo de array associativo PHP correspondente a um produto seria
['id' => 1, 'nome' => 'Camiseta', 'preco_em_centavos' => 4990]. Na serialização,
as chaves desse array tornam-se propriedades do objeto JSON. A lista de produtos
precisa manter índices sequenciais para continuar representada como array JSON.
Não estamos escrevendo essa implementação nesta aula.

## Impacto e sequência

Trocar uma string por um objeto é uma mudança incompatível para quem espera
apenas nomes. O consumidor precisará ler nome dentro de cada item, e as
asserções atuais ['data' => ['Camiseta']] precisarão ser adaptadas na etapa em
que a nova resposta for ligada à rota. Documentação, resposta e testes serão
atualizados de forma coordenada; o formato ativo permanece descrito separadamente
em docs/api/catalogo.md. Avaliar consumidores existentes ao efetivar a troca.

Os IDs gerados no banco de testes não devem ser fixados em 1 nas asserções: usar
o ID do produto criado pela factory. O preço deverá ser explícito nos cenários
que o verificarem, para que a comparação não dependa do valor fictício aleatório.
Permanecem os comportamentos de vazio, ativo, omissão de inativo e ordenação.

A transformação terá um local explícito, ProdutoResource, que será introduzido
na próxima etapa como responsável pelos campos da representação. Ainda será
necessário preparar a leitura e só depois conectar essa representação à API.

## Verificação desta etapa

Migration, model, contrato, serviço, controller, view e testes existentes lidos
para conferir campos disponíveis e consumidores de listarNomes. Os dois blocos
JSON acima foram analisados pelo PHP Docker: sintaxe, raiz com data em lista,
campos exatos de cada produto e tipos inteiro/string/inteiro. Código 0:

```text
2 exemplos JSON validos; data em lista e campos/tipos dos produtos conferidos.
```

O Markdown foi enviado pela entrada padrão para docker compose exec -T backend
php -r. O script extraiu os dois blocos json por preg_match_all, analisou cada
um com json_decode/JSON_THROW_ON_ERROR e exigiu data como array. Para cada item,
conferiu objeto com somente id/nome/preco_em_centavos e tipos por is_int/is_string.
Não carregou o bootstrap Laravel nem consultou o banco. Essa análise confere
os exemplos documentais; não comprova uma nova resposta do endpoint.

Aplicação, banco e testes preservados. Não repetir a suíte para esta alteração
documental: última execução registrada continua 18 testes/78 asserções da 6.7,
com classe da API 4/24, HTTP real e contagens conferidos naquela etapa.
Git diff --check passou; git diff --name-only -- backend não mostrou alterações
de aplicação nesta etapa.

## Continuidade

Entendimento da 6.8 confirmado. Publicar o checkpoint e iniciar somente a 6.9,
criando ProdutoResource com
mapeamento explícito de id, nome e preco_em_centavos e verificar sua resolução
em memória; sem trocar a resposta da rota ou o contrato listarNomes nessa etapa.
Exercício manual sugerido no DBeaver continua sem relato.
