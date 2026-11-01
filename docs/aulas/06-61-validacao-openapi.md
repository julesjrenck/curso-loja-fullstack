# Aula 6.61 — Validação OpenAPI em Docker

Implementação, explicação e verificação em 01/11/2026, após confirmação da
6.60 com "entendi" e publicação em 6ace636836a8c4d83eb003f0bcea899ed74b7fb6.
Entendimento da 6.61 confirmado com "entendi" em 01/11/2026; publicação em preparação.

## O que estamos verificando

Até aqui, json_decode conferia a sintaxe JSON e nossos comandos liam os campos
esperados. Um JSON pode ser decodificado corretamente e ainda faltar um campo
obrigatório do OpenAPI ou apontar para uma referência inexistente.

Agora usamos Redocly CLI 2.65.0 para verificar o documento como OpenAPI. A
[regra struct](https://redocly.com/docs/cli/rules/common/struct) suporta OpenAPI
3.2, versão usada pelo nosso documento 3.2.1. Isso verifica a descrição da API;
comparar respostas reais do Laravel com os schemas é outra verificação.

## Configuração

Criado [redocly.yaml](../api/redocly.yaml), ao lado de
[openapi.json](../api/openapi.json):

```yaml
extends:
  - spec
```

Extends carrega uma configuração pronta; a lista contém spec. Esse
[conjunto de regras](https://redocly.com/docs/cli/rules/spec) inclui struct,
que confere a estrutura OpenAPI, e no-unresolved-refs, que detecta referências
sem destino, além de outras regras de conformidade. Não desativamos regras.

Por exemplo, data.items usa $ref para apontar para components.schemas.Produto.
É semelhante a usar um nome de classe em PHP: o destino precisa existir.

## Ferramenta e imagem

A [instalação oficial por Docker](https://redocly.com/docs/cli/installation)
permite usar a ferramenta sem instalar Node ou npm no host. Executamos:

```sh
docker pull redocly/cli:2.65.0
docker image inspect redocly/cli:2.65.0 --format '{{json .RepoDigests}}'
```

Pull baixa a imagem; inspect mostra seus digests. A tag identifica a versão e
o digest identifica o conteúdo exato. As execuções foram fixadas nesta imagem:

```text
redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11
```

Com essa imagem, --version retornou 2.65.0 e código 0. As dependências da
ferramenta estão na imagem; nenhum pacote Composer/npm foi adicionado ao projeto.

## Comando de validação

Executado a partir da raiz do repositório:

```sh
docker run --rm --network none \
  --volume "$PWD/docs/api:/spec:ro" \
  --workdir /spec \
  redocly/cli:2.65.0@sha256:42acee0d7e629a9d0376d8df579dc325e51da727de06a31036bccc02409a7e11 \
  lint openapi.json --config redocly.yaml
```

- Docker run inicia um container; --rm o remove ao terminar.
- --network none desativa a rede desse container. As referências atuais são
  locais, portanto a validação não precisa acessar a internet.
- $PWD é a pasta atual no host. O volume disponibiliza apenas docs/api em
  /spec; ro significa somente leitura.
- --workdir /spec define a pasta de trabalho dentro do container.
- Lint recebe openapi.json como entrada; --config seleciona redocly.yaml.

O comando terminou com código 0 e informou que a descrição da API é válida,
sem erros ou avisos. Nenhum serviço permanente foi adicionado ao Compose.

## Conferência da detecção de erros

Criamos duas cópias temporárias em /tmp/curso-661 e executamos a mesma ferramenta
com a mesma configuração. Essa pasta recebeu um volume adicional somente
leitura em /casos; o argumento de entrada passou a ser cada cópia.

| Entrada | Resultado | O que demonstra |
| --- | --- | --- |
| Documento do projeto | Código 0 | Aceito pelas regras selecionadas |
| Cópia sem info.title | Código 1, regra struct | Campo obrigatório ausente detectado |
| Cópia com $ref para ProdutoInexistente | Código 1, regra no-unresolved-refs | Referência sem destino detectada |

As duas falhas eram esperadas. As cópias ficaram fora do Git; o documento do
projeto permaneceu intacto, conferido por git diff. Não geramos arquivo para
ignorar os erros. Git diff --check e links locais também foram conferidos.

Esta etapa não executou consultas SQL nem uma nova suíte Laravel. A última
suíte executada foi na 6.49: 66 testes e 620 asserções. A validação do documento
não executa os endpoints nem comprova que suas respostas seguem os schemas.

## Continuidade

Contrato em português, roteiro e progresso atualizados. Entendimento confirmado
com "entendi" em 01/11/2026. Publicar este checkpoint. Próxima etapa, 6.62:
acrescentar um exemplo completo de resposta 200 ao OpenAPI e validar seus
valores contra o schema em Docker.
