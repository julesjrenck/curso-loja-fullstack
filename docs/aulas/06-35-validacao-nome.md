# Aula 6.35 — Validação do parâmetro nome

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.34
com "entendi" e publicação em 4bb129121f344e1b4c59a1166346b0315cde3a3a.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.35
confirmado com "entendi" em 01/11/2026; publicação em preparação.

Uma alteração de código em backend/app/Http/Requests/ListarProdutosRequest.php:
acrescentar as regras de nome ao array devolvido por rules. A busca por nome
continua planejada; nesta etapa implementamos sua validação de entrada.

## Regras acrescentadas

```php
'nome' => [
    'bail',
    'sometimes',
    'required',
    'string',
    'max:100',
],
```

Cada chave do array de rules identifica um campo; sua lista contém as regras:

| Regra | Efeito sobre nome |
| --- | --- |
| bail | Para na primeira falha desse campo. Outros campos ainda são validados. |
| sometimes | Valida nome quando a chave está presente. Permite omiti-la. |
| required | Quando presente, exige conteúdo. Rejeita null e string vazia. |
| string | Exige texto; arrays são rejeitados. |
| max:100 | Sendo texto, limita o comprimento a 100 caracteres. |

Sometimes e required trabalham juntos: nome omitido é permitido, enquanto nome=
é rejeitado. Não acrescentamos nullable porque o contrato rejeita nome presente
vazio. Required já cobre o limite mínimo de conteúdo neste caso.

Antes do Form Request, os middlewares globais removem espaços das extremidades
e convertem string vazia em null. Nome= com somente espaços continua presente e
falha em required. Espaços internos são preservados. O texto '0' é aceito; não
devemos tratá-lo como ausência usando uma condição de truthiness do PHP.

## Relação com a requisição atual

ProdutoController@index já recebe ListarProdutosRequest. O Laravel resolve e
valida o Form Request antes de executar index; não precisamos mudar a rota ou
o controller para as novas regras entrarem em vigor.

Assim, GET /api/v1/produtos?nome= recebe 422/application/json, com message e
errors.nome. As mensagens continuam traduzíveis. Se page também for inválido,
errors pode conter os dois campos: bail interrompe regras por campo.

GET /api/v1/produtos?nome=camiseta passa pela validação. Contudo, index ainda
chama somente paginarProdutos($request->pagina()). O nome não é usado na consulta
e ainda não é preservado nos links. Aceitar uma entrada e utilizá-la na busca
são responsabilidades implementadas em passos separados do curso.

As regras de page, authorize, pagina e as demais classes foram preservadas.
O [contrato atual](../api/catalogo.md) registra essa implementação parcial.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Requests/ListarProdutosRequest.php
docker compose exec -T backend php artisan test --do-not-cache-result --compact
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-635-validacao-nome.php
```

Php -l conferiu a sintaxe; a suíte existente passou com 41 testes/288 asserções.
--do-not-cache-result evita escrita do cache na montagem de código. Nenhum teste
permanente foi acrescentado para nome nesta etapa; o diagnóstico abaixo é separado.

O script temporário exige loja_test/loja_testes. Usa kernel HTTP com middlewares,
registrando apenas na memória do processo CLI uma rota de diagnóstico que recebe
o mesmo Form Request e devolve validated/pagina. Essa rota não foi gravada nos
arquivos da aplicação nem disponibilizada no servidor em execução.

- Doze entradas válidas: omitido, texto simples, espaços externos/internos,
  texto '0', um caractere, 100 ASCII, 100 caracteres á, símbolos %_[, +, & e
  nome com page=2. Conteúdo validado normalizado e tipos conferidos, zero SQL
  por requisição nessa rota de diagnóstico.
- Sete inválidas na rota real /api/v1/produtos: vazio, somente espaços, array
  lista, array associativo, 101 ASCII, 101 caracteres á e nome vazio com page=0.
  Todas receberam 422 JSON com campos esperados, um erro por campo e zero SQL
  por requisição. O guard de identidade do banco executa antes dessa medição.
- Em transação, dois ativos Camiseta/Caneca; nome=zzzinexistente recebeu ambos
  com total 2 e duas consultas. Isso demonstra que nome ainda não filtra.
  Consulta individual por ID gerado manteve 200. Finally desfez as fixtures.
- SELECTs antes/depois por /tmp/curso-618-contagens.php: teste 0 categorias/0
  produtos; normal 0 categorias/1 produto. Rollback e nível da transação conferidos.
- Git diff --check e links locais da documentação conferidos.

## Continuidade

Roteiro, progresso e contrato atual atualizados. Entendimento confirmado com
"entendi" em 01/11/2026; publicação em preparação. Publicar e iniciar somente 6.36: método
nome(): ?string para obter o nome validado ou null quando omitido, ainda sem
aplicar o filtro à consulta.
