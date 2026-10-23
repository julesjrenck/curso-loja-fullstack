# Aula 6.13 — Desenho da consulta individual de produto

## Objetivo e estado

Desenhar GET /api/v1/produtos/{id}, seu sucesso e seu retorno de não encontrado.
Explicação e verificação documental em 23/10/2026; entendimento confirmado
pelo aluno com "entendi" em 23/10/2026. Nenhuma rota, consulta ou teste implementado nesta etapa. A API
executável continua oferecendo somente a listagem GET /api/v1/produtos.

Etapa anterior 6.12 confirmada com "entendi" em 23/10/2026, após esclarecer onde
o SELECT é executado. Publicada em 1b1d2884526058f394ef8fa02fbc5f7ea247831b.
HEAD, origin/main e main consultada diretamente no remoto coincidiram após o push.

## Coleção e recurso individual

GET /api/v1/produtos identifica a coleção pública de produtos ativos. A resposta
contém data como lista; a lista pode ter zero, um ou vários elementos.

GET /api/v1/produtos/{id} identificará um produto específico dessa coleção.
As chaves indicam um parâmetro de caminho, substituído pelo ID desejado, por
exemplo /api/v1/produtos/1. O número é o identificador do produto, não sua posição
na lista. Não enviar as chaves literalmente. O contrato planeja IDs inteiros
positivos; a restrição do parâmetro será explicada ao implementar a rota.

Ambas usam GET para leitura, sem corpo de requisição e com Accept: application/json.
O controller terá uma ação show, nome convencional de consulta individual.
Ela usará a leitura pelo contrato Catalogo e ProdutoResource para os campos
da representação; o SELECT continuará no serviço.

## Sucesso planejado

Para um ID correspondente a produto ativo: status 200, Content-Type application/json.
Exemplo ilustrativo, ainda não retornado por esse caminho:

```json
{
  "data": {
    "id": 1,
    "nome": "Camiseta",
    "preco_em_centavos": 4990
  }
}
```

Data contém um objeto, pois a consulta pede um único produto. Os campos e tipos
são os mesmos da listagem: id inteiro, nome string e preco_em_centavos inteiro,
obrigatórios e não nulos. O ID da resposta deverá corresponder ao solicitado.
O ID 1 e o preço do exemplo são ilustrativos; esta aula não consultou o banco.

## Produto indisponível no catálogo público

Se o ID não existir ou corresponder a produto inativo, a resposta planejada é
status 404, Content-Type application/json e corpo:

```json
{"message":"Produto não encontrado."}
```

Essa mensagem será a mesma para os dois casos. No catálogo público, um produto
inativo não será oferecido na consulta individual, assim como já é omitido na
listagem. Trata-se de uma decisão da loja; o registro não precisa ter sido
excluído do banco para deixar de estar disponível nessa API.

O corpo de erro usa message e não contém um produto em data. Não retornar 200
com data null ou lista vazia quando o produto individual solicitado não estiver
disponível. Esse formato de erro é planejado para esta operação, não uma promessa
sobre todos os erros do framework. Sua produção será implementada explicitamente.

| Consulta | Situação | Resultado do contrato |
| --- | --- | --- |
| GET /api/v1/produtos | Nenhum produto ativo | 200 com data: [] — já implementado. |
| GET /api/v1/produtos/{id} | Produto ativo encontrado | 200 com data em objeto — planejado. |
| GET /api/v1/produtos/{id} | ID inexistente | 404 com message — planejado. |
| GET /api/v1/produtos/{id} | Produto inativo | 404 com a mesma message — planejado. |

Uma coleção vazia ainda pode ser consultada com sucesso. Já no caminho individual,
o servidor não oferece a representação solicitada. O significado de 200 é sucesso;
404 indica ausência da representação ou que o servidor não a disponibiliza.
A regra de usar 404 para o inativo neste catálogo foi definida acima para a loja.

## Preparação para implementar e verificar

A listagem atual não deverá mudar. Prepararemos uma leitura buscarProduto(int $id)
no serviço, filtrando ativo e ID, com retorno de um Produto ou null. Ela buscará
somente os três atributos públicos. Depois ampliaremos o contrato e a demonstração,
ligaremos a ação show à rota e verificaremos o HTTP com testes de:

- Produto ativo pelo ID, conferindo campos, valores e ID efetivamente cadastrado.
- ID inexistente, conferindo 404 e mensagem JSON.
- Produto inativo, conferindo o mesmo 404, com dados de testes em transação.

Os detalhes de restrição sintática do ID serão tratados ao registrar a rota.
Não acrescentar busca automática pelo model ou consulta no resource nesta etapa.
Ainda não definir corpo geral para exceções, validação ou outras operações da API.

## Verificação desta etapa

Rota, controller, contrato, serviço e resource atuais conferidos para distinguir
o comportamento já implementado do desenho. Os dois blocos JSON desta aula
foram extraídos do Markdown e analisados pelo PHP Docker com JSON_THROW_ON_ERROR,
código 0: sucesso com data em objeto e os três campos tipados; erro com somente
message e o texto definido. Resultado: dois exemplos JSON válidos. Essa análise confere os
exemplos documentais e não comprova uma resposta do endpoint futuro.

Nenhuma consulta ao banco ou nova requisição HTTP é necessária para esse desenho.
Suíte não repetida para documentos: última execução registrada continua
18 testes/78 asserções da 6.12, classe da API 4/24. O diagnóstico atual de listagem
é /tmp/curso-612-http.php; não interpretá-lo como teste da consulta individual.

Referências oficiais consultadas:

- [HTTP 200 OK, RFC 9110](https://www.rfc-editor.org/rfc/rfc9110.html#section-15.3.1).
- [HTTP 404 Not Found, RFC 9110](https://www.rfc-editor.org/rfc/rfc9110.html#section-15.5.5).

## Continuidade

Entendimento confirmado; checkpoint pronto para publicação conforme autorização
persistente. Próximo passo exato: 6.14, adicionar buscarProduto(int $id):
?Produto em CatalogoEloquent, com filtro ativo/ID e leitura dos três atributos;
verificar ativo, inexistente e inativo no banco exclusivo de testes com rollback.
Preservar interface, controller, rota e listagem nessa preparação do serviço.
Exercício manual sugerido no DBeaver continua sem relato.
