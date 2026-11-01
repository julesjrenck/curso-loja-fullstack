# Aula 6.36 — Nome validado como string ou null

## Objetivo e estado

Implementação, explicação e verificações em 01/11/2026 após confirmação da 6.35
com "entendi" e publicação em 618eb1a55b809e44db0e1cabe0fd21704e8e55a9.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.36
confirmado com "entendu" em 01/11/2026; checkpoint publicado em
0b9afb840eb276b10bbeca3031f68cc393d4d14a, com remoto conferido.

Uma alteração de código em backend/app/Http/Requests/ListarProdutosRequest.php:
oferecer um método para obter o nome validado com um tipo de retorno explícito.

## Método acrescentado

```php
public function nome(): ?string
{
    return $this->validated('nome');
}
```

Public permite que o futuro consumidor do Form Request chame o método. O tipo
?string equivale a string|null: o retorno pode ser texto ou ausência de valor.
Validated é herdado de FormRequest; seleciona o campo dos dados já validados,
devolvendo null quando a chave não existe e nenhum outro padrão é informado.

Este método deve ser usado após a validação. Ele não executa as regras novamente
nem transforma uma entrada inválida em válida. No fluxo HTTP, o Laravel valida
o Form Request antes de chamar o controller.

| Entrada na query | Resultado após a validação |
| --- | --- |
| nome omitido | nome() devolve null. |
| nome=camiseta | nome() devolve a string 'camiseta'. |
| nome com espaços externos | nome() devolve o texto sem esses espaços. |
| nome=0 | nome() devolve a string '0'. |
| nome vazio, array ou acima do limite | Requisição rejeitada com 422 antes do controller. |

Não fazemos cast para string: converter null produziria texto vazio, perdendo
a representação de parâmetro omitido. Também não usamos um fallback baseado em
truthiness, pois o texto '0' é considerado falso em condições PHP, mas é um nome
de busca válido pelo contrato. O método devolve diretamente o valor validado.

Os espaços externos já foram removidos pelos middlewares antes da validação.
O método não precisa repetir essa normalização; espaços internos são preservados.

## Relação com o restante da aplicação

O controller continua chamando somente pagina() ao solicitar a paginação pelo
contrato Catalogo. Nome ainda não é passado ao serviço. Portanto, esta etapa
prepara a leitura do parâmetro, sem aplicar o filtro ou preservá-lo nos links.
Regras de nome/page, authorize, pagina, rotas e demais classes foram preservados.

O retorno tipado permitirá distinguir explicitamente ausência (null) de texto
informado quando a consulta passar a receber o filtro opcional.

## Verificações

Executados em Docker, todos com código 0:

```sh
docker compose exec -T backend php -l app/Http/Requests/ListarProdutosRequest.php
docker compose exec -T -e APP_ENV=testing backend php < /tmp/curso-636-nome-validado.php
docker compose exec -T backend php artisan test --do-not-cache-result --compact
```

Php -l conferiu a sintaxe. O diagnóstico exige loja_test/loja_testes e usa kernel
HTTP com middlewares. Uma rota criada somente na memória do processo CLI recebe
o Form Request e devolve validated, pagina, nome() e get_debug_type(nome()).
Não é uma rota adicionada à aplicação em execução.

- Doze válidos: omitido como null/tipo null; texto simples, espaços externos/
  internos, '0', um caractere, 100 ASCII/Unicode, símbolos %_[, +, &, nome/page=2
  preservados como strings. Valores e tipos comparados estritamente, zero SQL
  nessa rota de inspeção, depois da verificação inicial de identidade.
- Sete inválidos na rota real da listagem continuam 422 com os erros esperados
  e zero SQL por requisição. O novo método ainda não é chamado pelo controller.
- Dois ativos em transação continuam presentes com nome=zzzinexistente, total 2;
  consulta individual mantém 200. Rollback confirmado e transação encerrada.
- Suíte existente: 41 testes/288 asserções passaram. Sem teste permanente novo;
  o diagnóstico verifica os casos do método separadamente.
- SELECTs antes/depois: teste 0 categorias/0 produtos; normal 0 categorias/1
  produto, por /tmp/curso-618-contagens.php. Contagens preservadas.
- Git diff --check e links locais da documentação conferidos.

## Continuidade

Entendimento confirmado com "entendu" em 01/11/2026; checkpoint publicado em
0b9afb840eb276b10bbeca3031f68cc393d4d14a, com HEAD/origin/main/main remota conferidos.
Continuidade realizada na [aula 6.37](06-37-filtro-nome-eloquent.md), preparando
filtro literal de nome opcional no serviço Eloquent, ainda sem integração HTTP.
