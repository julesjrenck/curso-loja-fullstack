# Aula 2.11 — Rede entre containers

## Objetivo

Encontrar o servidor PHP pelo nome do serviço na rede Compose e acessar sua
porta interna a partir de outro container temporário.

## Rede já existente

O projeto usa a rede padrão `curso-loja-fullstack_default`, com driver `bridge`.
O Compose conecta os containers a ela e registra o nome do serviço `php` no
DNS interno. Nesta aula não precisamos alterar o `compose.yaml`.

| Origem do acesso | Endereço usado |
| --- | --- |
| Navegador ou terminal do computador | `http://127.0.0.1:8001/` |
| Outro container na rede do projeto | `http://php:8000/` |

`8000` é a porta em que o servidor escuta dentro do container. `8001` é a porta
publicada no host. A comunicação entre containers usa a porta interna.
Dentro de um container, `localhost` refere-se ao próprio container.

O IP de um container pode mudar ao recriá-lo. O código usa o nome do serviço
para resolver seu endereço, sem depender de um IP fixo.

## src/rede.php

Criamos um diagnóstico que aceita apenas execução pelo terminal. Sua lógica
principal é:

```php
$host = "php";
$ip = gethostbyname($host);
```

`gethostbyname` consulta o endereço IPv4 do nome informado. Se a resolução
falhar, a função devolve o próprio nome; o script verifica esse caso e lança
uma exceção para interromper a demonstração.

Em seguida:

```php
$url = "http://" . $host . ":8000/";
$contexto = stream_context_create(["http" => ["timeout" => 5]]);
$cabecalhos = get_headers($url, false, $contexto);
```

- A concatenação monta `http://php:8000/`.
- `stream_context_create` configura a operação HTTP com timeout de cinco segundos.
- `get_headers` faz a requisição e retorna os cabeçalhos da resposta.
- `false` no segundo argumento pede a lista numérica de cabeçalhos.
- O terceiro argumento passa as opções da operação.
- Se a requisição falhar, o script lança uma exceção.

Por fim, o script imprime o serviço, o IP resolvido, a URL e a primeira linha
dos cabeçalhos, que informa o protocolo e o status HTTP. Ele não imprime o
corpo da aplicação, escreve dados ou altera o contador.

## Executar

Com o servidor principal em execução:

```bash
docker compose run --rm php php rede.php
```

O primeiro `php` seleciona o serviço; o segundo inicia o executável PHP.
O Compose cria outro container na rede do projeto, executa `rede.php` em lugar
do servidor nessa instância temporária e remove o container ao terminar.

O resultado observado confirmou:

```text
Serviço: php
URL interna: http://php:8000/
Resposta: HTTP/1.1 200 OK
```

O script também mostrou o IP atual. Ele é um resultado de diagnóstico, não um
valor que deve ser fixado na configuração.

## Verificações

- A rede do projeto foi encontrada com driver `bridge`.
- O diagnóstico executou em outro container e concluiu com código 0.
- A inspeção do servidor confirmou sua presença nessa rede e o alias `php`;
  o endereço resolvido pelo diagnóstico correspondeu ao do servidor.
- O acesso interno retornou HTTP 200 usando a porta 8000.
- O acesso do host continuou retornando HTTP 200 na porta publicada 8001.
- `GET /rede.php` retornou 403, pois o diagnóstico é exclusivo do terminal.
- O container temporário foi removido; servidor, volume e configuração local
  foram preservados. Não houve build ou instalação de dependências.

As operações do daemon e da rede usaram execução ampliada autorizada.

## Continuidade

Esta etapa reúne o último conceito básico planejado para o módulo Docker.
Aguardar confirmação de entendimento antes de encerrar o módulo 2 e começar
PHP moderno e OOP no módulo 3. O estado fica em [progresso](../progresso.md).

## Fontes

- [Rede e descoberta de serviços no Compose](https://docs.docker.com/compose/how-tos/networking/).
- [gethostbyname](https://www.php.net/manual/en/function.gethostbyname.php).
- [get_headers](https://www.php.net/manual/en/function.get-headers.php).
