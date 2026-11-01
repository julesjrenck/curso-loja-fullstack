# Aula 6.51 — Esqueleto do documento OpenAPI

Implementação, explicação e verificação em 01/11/2026 após confirmação da 6.50
com "entendi" e publicação em 697f841ff891660d9bd980ade2aceb1d63a869e7.
HEAD, origin/main e main remota conferidos após push. Entendimento da 6.51
confirmado com "entendi" em 01/11/2026; publicação em preparação.

## Arquivo criado

[docs/api/openapi.json](../api/openapi.json) inicia a descrição planejada na
6.50. Seu conteúdo é:

```json
{
  "openapi": "3.2.1",
  "info": {
    "title": "API de catálogo da loja",
    "version": "0.1.0",
    "description": "Descrição em construção. As operações do catálogo serão acrescentadas gradualmente."
  },
  "servers": [
    {
      "url": "http://127.0.0.1:8002",
      "description": "Ambiente local de desenvolvimento"
    }
  ],
  "paths": {}
}
```

Openapi identifica o formato. Info reúne título, revisão do documento e um
aviso de construção. Servers contém a base local usada pelo aluno no host.
Essa URL não contém /api/v1, pois os caminhos futuros usarão o prefixo completo.
Info.version 0.1.0 continua distinto do formato 3.2.1 e do v1 na URL da API.
Os campos foram consultados na
[especificação oficial](https://spec.openapis.org/oas/v3.2.1.html).

## Objetos e listas

As chaves {} delimitam objetos com propriedades nomeadas, como info. Os
colchetes [] delimitam listas, como servers, que poderia conter outros
servidores em etapas futuras.

Paths é um objeto: suas futuras chaves serão caminhos como /api/v1/produtos.
Por isso usamos {}, mesmo vazio. Uma lista vazia [] tem outro tipo em JSON.
Zero caminhos descritos indica o estágio deste documento; a API Laravel
continua atendendo às rotas existentes.

## Comando executado

```sh
docker compose exec -T backend php -r '
$documento = json_decode(stream_get_contents(STDIN), false, 512, JSON_THROW_ON_ERROR);
echo "JSON válido\n";
echo "OpenAPI: ".$documento->openapi."\n";
echo "Revisão do documento: ".$documento->info->version."\n";
echo "Servidor: ".$documento->servers[0]->url."\n";
echo "paths: ".get_debug_type($documento->paths)."; entradas: ".count(get_object_vars($documento->paths))."\n";
' < docs/api/openapi.json
```

Docker Compose executa PHP no serviço backend. -T desativa o terminal virtual,
permitindo passar o conteúdo por entrada padrão. PHP -r executa o código
informado na linha de comando, sem iniciar o Laravel.

O redirecionamento < lê o arquivo no host e envia seus bytes ao processo no
container. Assim, não é necessário montar docs dentro do backend.
Stream_get_contents(STDIN) recebe os bytes. Json_decode converte o JSON para
valores PHP; false mantém objetos JSON como objetos PHP, 512 limita a
profundidade e JSON_THROW_ON_ERROR lança exceção se houver erro na decodificação.

Get_debug_type mostra o tipo de paths. Get_object_vars expõe suas propriedades
para count contar quantos caminhos existem. Resultado, código de saída 0:

```text
JSON válido
OpenAPI: 3.2.1
Revisão do documento: 0.1.0
Servidor: http://127.0.0.1:8002
paths: stdClass; entradas: 0
```

Isso confirma sintaxe JSON e leitura dos valores. A verificação não executou
um validador OpenAPI nem verificou correspondência com operações, ainda ausentes.
Não instalamos dependências ou alteramos montagens e código de produção.
Não foram executadas consultas SQL ou a suíte de aplicação; a última suíte é
a da 6.49, com 66 testes/620 asserções. Git diff --check e links locais conferidos.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026; publicação em preparação.
Publicar e iniciar somente 6.52: declarar GET
/api/v1/produtos com summary, operationId e descrições de respostas 200/422,
ainda sem parâmetros ou schemas.
