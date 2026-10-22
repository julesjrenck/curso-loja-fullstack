# Aula 6.1 — HTTP, HTML e JSON

## Objetivo e estado

Iniciar o módulo 6 — APIs REST a partir do catálogo persistido do módulo 5.
Explicação e verificação em 22/10/2026. Entendimento confirmado pelo aluno com
"entendi" em 22/10/2026.
Somente documentação alterada; nenhuma rota de API criada nesta etapa.

## Da página aos dados

Uma API é uma interface pela qual programas interagem. Neste módulo construiremos
uma API HTTP: o cliente faz uma requisição e o Laravel devolve uma resposta.
O cliente pode ser uma aplicação React, outro backend ou uma ferramenta de testes.

Hoje, GET /loja segue este caminho:

```text
Cliente -> rota -> controller -> catálogo -> SQL Server
                    |
                    v
               view Blade -> resposta HTML -> cliente
```

O controller entrega os nomes à view, que produz uma página com elementos como
`<li>Camiseta</li>`. O navegador interpreta o HTML para apresentar a página.

Na futura API, o Laravel enviará dados em JSON. Mais adiante, o React lerá esses
dados e decidirá como apresentá-los. Exemplo apenas didático de corpo JSON,
ainda sem endpoint implementado ou contrato definitivo:

```json
{
  "data": ["Camiseta"]
}
```

JSON é um formato textual de dados. Neste exemplo, as chaves delimitam um objeto,
`data` é uma propriedade e os colchetes delimitam uma lista de strings. Um array
PHP pode ser convertido em JSON; essa conversão é chamada serialização.
O cliente recebe o texto JSON, não um objeto PHP em memória.

## Requisição e resposta

Uma requisição informa o método, o endereço, cabeçalhos e, quando necessário,
um corpo. Para consultar a página atual, o exemplo é:

```http
GET /loja HTTP/1.1
Host: 127.0.0.1:8002
Accept: text/html
```

- GET pede uma representação do recurso, para leitura.
- /loja é o caminho solicitado ao servidor.
- Host identifica o servidor e a porta de destino.
- Accept informa o tipo de resposta que o cliente aceita. A rota precisa
  implementar a resposta correspondente; o cabeçalho sozinho não transforma HTML
  em JSON.
- Esta consulta GET não precisa de corpo de requisição.

A resposta possui status, cabeçalhos e corpo. Trechos observados na verificação:

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8
X-Curso: Laravel

... <li>Camiseta</li> ...
```

200 indica sucesso nesta consulta. Content-Type identifica o formato do corpo
enviado: HTML em UTF-8. X-Curso é o cabeçalho acrescentado pelo middleware que
já estudamos. O HTML é o corpo da resposta; a linha de status e os cabeçalhos
não fazem parte desse HTML.

Em uma resposta JSON, Content-Type será application/json. O status continuará
indicando o resultado da operação; o formato do corpo e o status têm funções
diferentes. Uma consulta bem-sucedida pode devolver 200 com HTML ou com JSON.

REST orienta o desenho da API em torno de recursos, como produtos e categorias,
com métodos HTTP de significado consistente. GET /api/v1/produtos será o caminho
planejado para consultar a coleção de produtos, seguindo a decisão de versionar
as APIs da loja sob /api/v1. O prefixo v1 identifica a versão do contrato público,
não a versão do Laravel. Usar JSON, sozinho, não define uma API como REST.
Outros métodos, status, validação e contratos serão aprofundados nas próximas
etapas, um passo de cada vez.

## Arquivos relacionados

| Arquivo existente | Papel observado |
| --- | --- |
| backend/routes/web.php | Registra GET /loja e seu middleware. |
| backend/app/Http/Controllers/LojaController.php | Chama listarNomes e retorna a view loja com os dados. |
| backend/app/Services/CatalogoEloquent.php | Consulta os nomes dos produtos ativos em ordem alfabética. |
| backend/resources/views/loja.blade.php | Converte os dados recebidos em HTML. |
| backend/bootstrap/app.php | Registra as rotas web; ainda não registra routes/api.php. |

O próximo passo reutilizará Catalogo::listarNomes para uma primeira resposta JSON.
Esse contrato atual fornece somente nomes; atributos de produtos, paginação e
demais decisões do contrato da API serão introduzidos quando necessários.

## Verificação executada

`docker compose ps` confirmou backend, php e sqlserver em execução. Um diagnóstico
PHP temporário enviado pela entrada padrão foi executado com:

```bash
docker compose exec -T backend php <<'PHP'
<?php
$contexto = stream_context_create(['http' => [
    'method' => 'GET',
    'header' => "Accept: text/html\r\n",
    'timeout' => 10,
    'ignore_errors' => true,
]]);
$corpo = file_get_contents('http://127.0.0.1:8000/loja', false, $contexto);
if ($corpo === false) {
    throw new RuntimeException('Falha ao obter a resposta HTTP.');
}
$cabecalhos = http_get_last_response_headers();
$status = $cabecalhos[0] ?? '';
echo "GET /loja\n", $status, "\n";
$tipo = '';
foreach ($cabecalhos as $cabecalho) {
    if (stripos($cabecalho, 'Content-Type:') === 0) {
        $tipo = $cabecalho;
        echo $tipo, "\n";
    }
    if (stripos($cabecalho, 'X-Curso:') === 0) {
        echo $cabecalho, "\n";
    }
}
$item = str_contains($corpo, '<li>Camiseta</li>');
echo 'Corpo contém <li>Camiseta</li>: ', $item ? 'sim' : 'não', "\n";
if (!str_contains($status, ' 200 ') || stripos($tipo, 'text/html') === false || !$item) {
    throw new RuntimeException('Resposta diferente da esperada para a página atual.');
}
PHP
```

`exec` executa um comando no container backend existente; `-T` dispensa terminal
interativo; `php` lê o script recebido. O heredoc delimitado por 'PHP' envia o
código literalmente, sem expandir variáveis pelo shell do host.

O diagnóstico usou stream_context_create com método GET, Accept: text/html e
timeout de dez segundos. File_get_contents consultou
http://127.0.0.1:8000/loja dentro do container. Http_get_last_response_headers
permitiu conferir status e cabeçalhos. Str_contains conferiu o item no corpo.
O script exigiu status 200, Content-Type contendo text/html e o item Camiseta;
se algum deles fosse diferente, lançaria uma exceção.

Saída real, código 0:

```text
GET /loja
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8
X-Curso: Laravel
Corpo contém <li>Camiseta</li>: sim
```

A porta interna é 8000; a mesma página está publicada no host em
http://127.0.0.1:8002/loja pelo Compose. A verificação demonstra a resposta HTML
atual. Não verifica uma API JSON, ainda inexistente, nem mede consultas SQL.
Nenhum cadastro, migration ou seeder foi executado. Suíte não reexecutada para
esta etapa documental; a última execução registrada continua 14 testes e
54 asserções da 5.80.

## Continuidade

Entendimento confirmado. Próximo passo: publicar o checkpoint e iniciar somente
a 6.2: registrar routes/api.php em bootstrap/app.php com prefixo
api/v1 e criar GET /api/v1/produtos retornando os nomes do catálogo em JSON.
Definir e documentar o contrato inicial dessa resposta ao introduzir a rota.
Sem instalar autenticação ou adicionar dependências antecipadamente.

Publicação deste checkpoint será registrada após o envio e a conferência remota.
Exercício manual
sugerido no DBeaver no módulo 5 continua sem relato, sem impedir a retomada.
